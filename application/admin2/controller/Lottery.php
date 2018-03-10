<?php
namespace app\admin2\controller;


use think\Controller;
use think\Exception;
use think\Request;
use app\common\controller\Table;

use app\admin2\model\AdminLottery;
use app\admin2\model\AdminPrize;
use app\common\controller\Search;
use app\common\controller\Tool;

use app\common\controller\From;
class Lottery extends Fater{
    public function index(Table $table,AdminLottery $adminLottery,Search $search,AdminPrize $adminPrize,Tool $tool){
        $this->userauth('activity');
        $table->init($adminLottery);
        $table->editAction();
        $table->deleteAction();
        $table->createAction=false;
        $table->column('code','编码');
        $table->column('prize_id','奖品名称');
        $table->column('status','是否兑换',[
            '未兑换'=>'layui-btn-warm',
            '已兑换'=>'layui-btn-normal',
        ]);
        $table->column('member_id','中奖用户');
        $table->column('add_time','中奖时间');
        $table->column('name','姓名');
        $table->column('mobile','电话');
        $table->column('city','地区');
        $table->column('addres','地址');

        $table->searchs(function() use ($search,$adminPrize){
            $option=[
                ['value'=>0,'name'=>'请选择']
            ];
            $prize=$adminPrize->field('id,name')->select();
            $k=1;
            foreach ($prize as $key=>$v){
                $option[$k]['value']=$v['id'];
                $option[$k]['name']=$v['name'];
                $k++;
            }
            $search->set_name('prize_id')->rule('=')->option($option)->select();
            $search->set_name('name')->rule('LIKE')->text();
        },$search);
        $table->tool(function() use ($tool){
            $tool->news();
        },$tool);
        return $table->start();
    }
    public function export(Request $request,From $from){
        $from->field('select')->option([
            ['value'=>11,'name'=>'1288元购GW-1561'],
            ['value'=>10,'name'=>'100代金券'],
            ['value'=>9,'name'=>'安迪人偶'],
            ['value'=>8,'name'=>'抱枕'],
            ['value'=>7,'name'=>'炫彩简约晾衣架'],
            ['value'=>6,'name'=>'垃圾桶'],
            ['value'=>5,'name'=>'落地晾衣架GW-5823'],
            ['value'=>4,'name'=>'智能晾衣机GW-1583']
        ])->render('prize_id','奖品');
        $from->field('l_date')->render('start','开始日期');
        $from->field('l_date')->render('end','结束日期');
        $from->addAction(url('Lottery/save'));
        return $from->start();

    }
    public function save(Request $request,AdminLottery $adminLottery){
        $param=$request->param();
        $prize_id=$param['prize_id'];
        if(!$param['start']){
            $this->error('请选择开始日期',url('lottery/export'));
        }
        $end=isset($param['end'])?$param['end']:date('Y-m-d');

        $list=$adminLottery->where('prize_id',$prize_id)
            ->where('add_time','between',[$param['start'],$end])
            ->select();
        $res=togbk("ID,微信昵称,微信ID,奖品类型,奖品编号,中奖时间,姓名,电话,城市,地址")."\r\n";
        $pre='/title="(.*?)"/';
        $pre2='/date-name="(.*?)"/';
        foreach ($list as $key=>$value){
            $id=togbk($value['id']);
            preg_match($pre,$value['member_id'],$open_id);
            preg_match($pre2,$value['member_id'],$open_name);
            $open_name=togbk($open_name[1]);
            $open_id=togbk($open_id[1]);
            $prize=togbk($value['prize_id']);
            $code=togbk($value['code']);
            $add_time=togbk($value['add_time']);
            $name=togbk($value['name']);
            $mobile=togbk($value['mobile']);
            $city=togbk($value['city']);
            $addres=togbk($value['addres']);
            $res .=$id.','.$open_name.','.$open_id.','.$prize.','.$code.','.$add_time.','.$name.','.$mobile.','.$city.','.$addres."\r\n";
        }
        $file_name='list-'.date('Y-m-d').'.csv';
        header("Content-type: text/html; charset=utf-8");
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$file_name);
        header('Cache-Control: max-age=0');
        echo $res;
    }
    public function drmb(){
        $res=togbk("ID,微信昵称,微信ID,奖品类型,奖品编号,中奖时间,姓名,电话,城市,地址,物流单号")."\r\n";
        $file_name='list-'.date('Y-m-d').'.csv';
        header("Content-type: text/html; charset=utf-8");
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$file_name);
        header('Cache-Control: max-age=0');
        echo $res;
    }

    public function sms(AdminLottery $adminLottery){
        set_time_limit(0);
        try{
            $wxapi=new \org\Wxapi();
            $members= $adminLottery
                ->where('prize_id','NEQ',10)
                ->where('prize_id','NEQ',11)
                ->where('addres',NULL)
                ->group('member_id')
                ->field('member_id,add_time')->select();

            $pre='/title="(.*?)"/';
            $pre2='/date-name="(.*?)"/';
            foreach ($members as $key=>$value){
                preg_match($pre,$value['member_id'],$open_id);
                preg_match($pre2,$value['member_id'],$open_name);
                $temp=$this->tpm_msg([
                    'open_id'=>$open_id,
                    'open_name'=>$open_name,
                    'add_time'=>date('Y-m-d H:i:s')
                ]);
                $res=$wxapi->get_template_msg($temp);
                ob_flush();
                flush();
                sleep(5);
            }
            return rejson(1,'发送成功');
        }catch (Exception $e){
            return rejson(0,$e->getMessage());
        }

    }

    
    public function import(){
          return view();
    }
    public function do_import(){
        header('Content-type:text/html;charset=utf-8');
        //上传文件
        if (!empty($_FILES)) {
            foreach($_FILES as $key => $val) {
                if ($val['size'] <= 0 || empty($val['name'])) {
                    unset($_FILES[$key]);
                }
            }
        }else {
            $this->error('请选择文件后再导入！');
        }
        if (!empty($_FILES)) {

            $path="Upload/Excel";
            if(!file_exists($path)){
                $makedir = explode('/',$path);

                $curdir = '';
                foreach($makedir as $key=>$value){
                    if($curdir == ''){
                        $curdir .= $value;
                    }else{
                        $curdir .= '/'.$value;
                    }
                    if(!file_exists($curdir)){
                        mkdir($curdir);
                    }
                }
            }
            $upload = request()->file('temp');
            $file_name=time().'.csv';
            $info=$upload->validate(['ext' => 'csv'])->move($path,$file_name);
            if($info) {
                $file = './Upload/Excel/'.$file_name;
            }else {
                $this->error($upload->getError());
            }
            $db=new AdminLottery;

            $arr=$this->getCSV($file);
            $erro=0;

            if(count($arr)<=201){
                foreach ($arr as $key=>$value){
                    if($key>0){
                        $id=$value[0];
                        if(!empty($id)){
                            $logistics=mb_convert_encoding($value[10], "UTF-8", "GBK");

                            if($logistics ){
                                $k=$db->where('id',$id)->update(['logistics'=>$logistics]);
                                if(!$k){
                                    $erro++;
                                }
                            }else{
                                $erro++;
                            }
                        }
                    }
                }
            }

            $text='导入成功！';
            if($erro>0){
                $text='导入成功,但是有'.$erro.'条数据导入失败';
            }
            $this->success($text,url('lottery/import'));
        }else {
            $this->error('请选择文件后再导入！',url('lottery/import'));
        }
    }
    public function getCSV($files){
        $file = fopen($files,"r");
        $goods_list=[];
        while ($data = fgetcsv($file)) { //每次读取CSV里面的一行内容

            array_push($goods_list,$data);
        }

        fclose($file);
        return $goods_list;
    }
    private function tpm_msg($open){
        $first="奖品地址填写通知";
        $remark='您在好太太上市敲钟红利共享微信活动中奖，请在12月31日前在活动H5的礼品中心填写奖品邮寄地址信息，否则视为放弃领奖';
        $template=[
            'touser'=>$open['open_id'],
            'template_id'=>'MuPtzCRahr88DR3DLix8gL790flkxCHegL8UjN95n9I',
            'url'=>'https://haotaitai.hengdikeji.com/listing',
            'topcolor'=>'#FF0000',
            'data'=>[
                'first'=>['value'=>$first,'color'=>'#000000'],
                'keyword1'=>['value'=>$open['open_name'],'color'=>'#000000'],
                'keyword2'=>['value'=>'上市好礼','color'=>'#000000'],
                'keyword3'=>['value'=>$open['add_time'],'color'=>'#000000'],
                'remark'=>['value'=>$remark,'color'=>'#000000'],

            ]
        ];
        return $template;
    }
    public function nolog(AdminLottery $adminLottery){

        $res=togbk("ID,微信昵称,微信ID,奖品类型,奖品编号,中奖时间,姓名,电话,城市,地址,物流单号")."\r\n";
        $file_name='list-'.date('Y-m-d').'.csv';
        header("Content-type: text/html; charset=utf-8");
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$file_name);
        header('Cache-Control: max-age=0');

        $list=$adminLottery->where('prize_id',"IN","9,8,7,6,5,4")
            ->where('logistics','null')
            ->where('addres','not null')
            ->select();

        $pre='/title="(.*?)"/';
        $pre2='/date-name="(.*?)"/';

        foreach ($list as $key=>$value){
            $id=togbk($value['id']);
            preg_match($pre,$value['member_id'],$open_id);
            preg_match($pre2,$value['member_id'],$open_name);
            $open_name=togbk($open_name[1]);
            $open_id=togbk($open_id[1]);
            $prize=togbk($value['prize_id']);
            $code=togbk($value['code']);
            $add_time=togbk($value['add_time']);
            $name=togbk($value['name']);
            $mobile=togbk($value['mobile']);
            $city=togbk($value['city']);
            $addres=togbk($value['addres']);
            $res .=$id.','.$open_name.','.$open_id.','.$prize.','.$code.','.$add_time.','.$name.','.$mobile.','.$city.','.$addres.','.''."\r\n";
        }


        echo $res;
    }
}
