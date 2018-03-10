<?php

namespace app\index2\controller;

use think\Controller;
use think\Exception;
use think\Request;
use app\index2\model\AdminOpen;
use app\index2\model\AdminShare;
use app\index2\model\AdminLottery;
use app\index2\model\AdminProduct;
use app\index2\model\AdminOrder;
class Index extends Fater
{

    public function _initialize()
    {
        parent::_initialize();
//        $open=AdminOpen::get(UID);
//        if($open['update_time']<time()){
//            $open->update_time=strtotime(date('Y-m-d 23:59:59'));
//            $open->count=1;
//            $open->save();
//        }
    }


    public function index(Request $request,AdminProduct $product)
    {
        $rc=randChar(8);
        session('rc',$rc);
        $p = $this->ticket();
        return view('',[
            'token'=>$request->token(),
            'cr'=>$rc,
            'ticket'=>$p
        ]);
    }

    //换购券
    public function ticket(){
        $p = (new AdminProduct)->where('type',1)->order('id desc')->select();
        return $p;
    }
    //使用换购券
    public function use_ticket(Request $request,AdminOrder $order){
        try{
            $param=$request->param();
            //规则
            $result = $this->validate(
                $param,
                [
                    'pid|换购券' => 'require',
                    'city_code|城市代码' => 'require|max:255',
                    'new_brand|新款品牌'=>'require|max:255',
//                    'new_img|旧款照片'=>'require',
                ]);
            if (true !== $result) {
                // 验证失败 输出错误信息
                return json(['code' => 0, 'msg' => $result]);
            }
            $act = $order->where(['pid'=>$param['pid']])->where('open_id',UID)->find();
            if(!$act || $act['status'] != 1)return json(['code'=>0,'msg'=>'换购券不能使用']);
            $data['status'] = 2;
            $data['city_code'] = $param['city_code'];
            $data['new_brand'] = $param['new_brand'];
            $data['new_img'] = serialize($param['new_img']);
            $data['use_time'] = date('Y-m-d H:i:s');
            $order->where(['id'=>$act['id']])->update($data);
            return json(['code' => 1, 'msg' => '使用成功']);
        }catch (Exception $e){
            return json(['code'=>0,'msg'=>$e->getMessage()]);
        }
    }


    public function award(Request $request,AdminLottery $adminLottery)
    {
        $lid=$request->get('lid','');

        $l=$adminLottery::get($lid);

//        if(!$l)$this->error('数据错误');
        $prize=[
            '-1'=>['name'=>'100元智能代金券','img'=>'g1.png'],
            11=>['name'=>'1288元购GW-1561','img'=>'gift.png'],
            10=>['name'=>'100元智能代金券','img'=>'g1.png'],
            9=>['name'=>'安迪人偶','img'=>'g2.png'],
            8=>['name'=>'抱枕（价值58元）','img'=>'g3.png'],
            7=>['name'=>'铝合金衣架礼盒','img'=>'g4.png'],
            6=>['name'=>'智能垃圾桶','img'=>'g5.png'],
            5=>['name'=>'落地晾衣架','img'=>'g6.png'],
            4=>['name'=>'智能晾衣机GW-1583','img'=>'g7.png'],
        ];

        $data=[
            'id'=>$lid,
            'prize'=>$prize[$l['prize_id']]
        ];
        return view('',[
            'token'=>$request->token(),
            'data'=>$data,
            'prize_id'=>$l['prize_id'],
        ]);
    }
    public function addres(Request $request,AdminLottery $adminLottery){
        try{
            $param=$request->param();
            $isMob="/^1[34578]{1}[0-9]{9}$/";
            $v=[
                'name|姓名' =>['require','length:2,6'],  //这里的pk值 只要在要验证的data里面加上主建的值
                'mobile|联系电话'=>['require','regex:/^1[34578]{1}[0-9]{9}$/'],
                'city|地区' =>['require','max:100'],
            ];
            if(!in_array($param['prize_id'],[10,11])){
                $v['addres|详细地址']=['require','max:255'];
            }
            $result = $this->validate(
                $param,
                $v,[
                  'name.length'=>'请填写2-6个字的姓名',
                  'mobile.regex'=>'手机号码格式错误',
                  'city.require'=>'请选择您的城市',
            ]);
            if(true !== $result){
                // 验证失败 输出错误信息
                return rejson(0,$result);
            }
            $old=$adminLottery->get($param['id']);
            $adminLottery->save([
                'name'=>$param['name'],
                'mobile'=>$param['mobile'],
                'city'=>$param['city'],
                'addres'=>isset($param['addres'])?$param['addres']:'',
                'add_time'=>$old->add_time,
                'update_time'=>date('Y-m-d H:i:s'),
                'status'=>1
            ],['id'=>$param['id'],'member_id'=>UID]);

            return json(['code'=>1,'msg'=>'提交成功']);

        }catch (Exception $e){
            return json(['code'=>0,'msg'=>$e->getMessage()]);
         
        }
    }
    public function share(Request $request,AdminShare $adminShare){
        try{
            $group=input('group',1);

            $today=strtotime(date('Y-m-d'));
            $tc=$adminShare->where('member_id',UID)
                ->where('add_time','>=',$today)
                ->count();
            $msg="分享成功";
            if($tc<=0){
                $open=AdminOpen::get(UID);
                $open->count=$open->count+1;
                $open->save();
                $msg="分享成功，增加了一次机会";
            }
            $adminShare->save([
                'group'=>$group,
                'member_id'=>UID,
                'add_time'=>time()
            ]);
            return rejson(1,$msg);
        }catch (\Exception $e){
            return rejson(0,$e->getMessage());
        }

    }
    public function gift(Request $request,AdminLottery $adminLottery){
        $data=$adminLottery::all(['member_id'=>UID,'prize_id'=>['NEQ',10]]);
        $status=[
            11=>0,
            10=>1,
            9=>2,
            8=>3,
            7=>4,
            6=>5,
            5=>6,
            4=>7,
        ];
        $list=[];

        foreach ($data as $key=>$value){
            $list['all'][$key]['lid']=$value['id'];
            $list['all'][$key]['id']=$status[$value['prize_id']];
            $list['all'][$key]['dan']=$value['logistics']?$value['logistics']:"暂无单号";
            $list['all'][$key]['status']=$value['status'];
        }

        $on00=$adminLottery->where('prize_id',10)
            ->where('status',0)
            ->where('member_id',UID)
            ->count();
        $lid=$adminLottery->where('prize_id',10)
            ->where('status',0)
            ->where('member_id',UID)
            ->order('id asc')
            ->value('id');

        if($on00>0){
            if(empty($list['all']))$list['all']=[];
            array_push($list['all'],[
                'lid'=>$lid,
                'id'=>1,
                'dan'=>'',
                'status'=>0,
                'number'=>$on00
            ]);
        }
        return $list;
    }
    public function change(Request $request,AdminLottery $adminLottery){
        try{
            $id=$request->post('id',0);
            $data=$adminLottery::get($id);
            if(!$data)return rejson(0,'系统发生错误，兑换失败');
            $data->status=1;
            $data->save();
            return rejson(1,'兑换成功');
        }catch (Exception $e){
            return rejson(0,'系统发生错误，兑换失败');
        }
    }
    public function numbers(AdminOpen $adminOpen){
        $number=$adminOpen->count();
        $value=db('admin_set')->where('id',1)->value('value');
        $cs=unserialize($value);
        $cs=$cs?$cs:0;
        return json(['number'=>$number+$cs]);
    }
    public function video(){
        return view();
    }
}
