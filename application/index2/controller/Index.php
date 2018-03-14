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
use app\index2\model\AdminIntegral;
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
        return view('',[
            'token'=>$request->token(),
            'cr'=>$rc,
        ]);
    }
    //换购券
    public function my_ticket_status(AdminOrder $order){
        $p1 = $order->where('pid',1)->where('open_id',UID)->value('status');
        $p2 = $order->where('pid',2)->where('open_id',UID)->value('status');
        $p = [$p1?$p1:0,$p2?$p2:0];
        return $p;
    }
    //我的订单
    public function my_order(Request $request,AdminOrder $order){
        $id=$request->param()['pid'];
        $data=$order->where('pid',$id)->where('open_id',UID)->find();
        if(!$data){
            return json(['code' => 0, 'msg' => '查询的数据为空']);
        }
        if($data['old_img'])  $data['old_img']=unserialize($data['old_img']);
        if($data['new_img'])  $data['new_img']=unserialize($data['new_img']);
        return json_encode($data);
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
                ]);
            if (true !== $result) {
                // 验证失败 输出错误信息
                return json(['code' => 0, 'msg' => $result]);
            }
            $act = $order->where(['pid'=>$param['pid']])->where('open_id',UID)->find();
            if(!$act || $act['status'] != 1)return json(['code'=>0,'msg'=>'换购券不能使用']);

            $act->use_time=date('Y-m-d H:i:s');
            $act->status=2;
            $act->city_code=$param['city_code'];
            $act->new_brand=$param['new_brand'];
            $act->save();

            return json(['code' => 1, 'msg' => '使用成功']);
        }catch (Exception $e){
            return json(['code'=>0,'msg'=>$e->getMessage()]);
        }
    }
    //评价
    public function pj_ticket(Request $request,AdminOrder $order){
        try{
            $param=$request->param();
            //规则
            $result = $this->validate(
                $param,
                [
                    'pid|换购券' => 'require',
                    'proStar|产品满意度' => 'require',
                    'serStar|服务满意度'=>'require',
                    'content|意见反馈'=>'require|max:255',
                    'new_img|新款图片'=>'require',
                ]);
            if (true !== $result) {
                // 验证失败 输出错误信息
                return json(['code' => 0, 'msg' => $result]);
            }
            $act = $order->where(['pid'=>$param['pid']])->where('open_id',UID)->find();
            if(!$act)return json(['code'=>0,'msg'=>'查询的数据为空']);

            $act->proStar=$param['proStar'];
            $act->serStar=$param['serStar'];
            $act->content=$param['content'];
            $act->new_img=serialize($param['new_img']);
            $act->status=3;
            $act->save();
            //增加抽奖次数
            $open=AdminOpen::get(UID);
            $open->where('id',UID)->setInc('draw',1);

            return json(['code' => 1, 'msg' => '评价成功']);
        }catch (Exception $e){
            return json(['code'=>0,'msg'=>$e->getMessage()]);
        }
    }
    //积分商品
    public function sore_products(AdminProduct $product,AdminIntegral $integral){
        $ps = $product->where('type',2)->select();
        foreach($ps as $k=>$v){
            $in = $integral->where('pid',$v['id'])->where('open_id',UID)->find();
            $ps[$k]['status'] = $in?1:0;
        }
        //status 1已兑换 0未兑换
        return json_encode($ps);
    }
    //兑换积分
    public function addInt(Request $request,AdminIntegral $integral,AdminProduct $product,AdminOpen $open){
        try{
            $param=$request->param();
            //规则
            $result = $this->validate(
                $param,
                [
                    'pid|积分商品' => 'require',
                    'name|姓名' => 'require|max:255',
                    'phone|手机号码' => ['require', "regex:/^1[34578]{1}[0-9]{9}$/"],
                    'city|地区'=>'require|max:255',
                    'addres|详细地址'=>'require|max:255',
                ]);
            if (true !== $result) {
                // 验证失败 输出错误信息
                return json(['code' => 0, 'msg' => $result]);
            }
            //是否已兑换
            $act = $integral->where(['pid'=>$param['pid']])->where('open_id',UID)->find();
            if($act)return json(['code'=>0,'msg'=>'该商品您已兑换']);
            //没有就添加
            $re = $integral->save([
                'pid'=>$param['pid'],
                'name' =>$param['name'],
                'phone' =>$param['phone'],
                'city' =>$param['city'],
                'addres' =>$param['addres'],
                'open_id' =>UID,
                'IP' => request()->ip(),
                'add_time'=>date('Y-m-d H:i:s')
            ]);
            if($re){
                //兑换成功，商品减少
                $p = $product::get($param['pid']);
                $p->number=$p->number-1;
                $p->save();
                //减少积分
                $need = $p->needIntegral;
                $o = $open::get(UID);
                $o->score=$p->score-$need;
                $o->save();

                return json(['code'=>1,'msg'=>'兑换成功','sy'=>$p->number,'su'=>$o->score]);
            }else{
                return json(['code'=>0,'msg'=>'网络错误，请稍后再试']);
            }

        }catch (Exception $e){
            return json(['code'=>0,'msg'=>$e->getMessage()]);
        }
    }

    //微信分享
    public function jssdk_all(){
        $wxapi=new \org\Wxapi;
        $url=$_SERVER['HTTP_REFERER'];
        $signPackage=$wxapi->getSignPackage($url);
        return json($signPackage);
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
