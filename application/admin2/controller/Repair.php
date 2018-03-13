<?php

namespace app\admin2\controller;

use think\Controller;
use think\Request;
use app\admin2\model\Order;
class Repair extends Fater
{
    //订单管理
    public function index(Request $request)
    {
        $key=$request->get('key');
        $sreach['key']=$key?$key:'';
        $where=[];
        if($key){
            $where['name|phone']=['LIKE','%'.$key.'%'];
        }
        $list=(new Order)->where($where)->order('id asc')->paginate(15);
        return view('',[
            'list'=>$list,
            'token'=>$request->token(),
            'sreach'=>$sreach
        ]);
    }

    public function detail(Request $request,Order $order){
        $id=$request->param()['id'];
        $data=$order::get($id);
        if(!$data){
            $this->error('查询的数据为空');
        }
        if($data['old_img'])  $data['old_img']=unserialize($data['old_img']);
        if($data['new_img'])  $data['new_img']=unserialize($data['new_img']);

        return view('',[
            'token'=>$request->token(),
            'data'=>$data,
        ]);
    }

    public function e_csv(){
        $file_name='好太太换购券订单.csv';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$file_name);
        header('Cache-Control: max-age=0');
        //接收条件，查询表
        $data='订单号,活动码,换购券名称,状态,姓名,电话,购买时间,旧款品牌,城市码,新款品牌,使用时间'."\r\n";
        $arr = db('admin_order')->order('id desc')->select();
        if(!$arr){
            $data .='没有找到相应的数据'."\r\n";
        }
        foreach($arr as $k=>$v){
            if($v['status'] == 0){
                $s = '未支付';
            }elseif($v['status'] == 1){
                $s = '已支付';
            }else{
                $s = '已使用';
            }
            $p = db('admin_product')->where('id',$v['pid'])->value('name');
            $data .= "{$v['out_trade_no']},{$v['code']},{$p},{$s},{$v['name']},{$v['phone']},{$v['add_time']},{$v['old_brand']},{$v['city_code']},{$v['new_brand']},{$v['use_time']}"."\r\n";
        }
        return $data;
    }
    public function strG($data){
        $data=str_replace(',','，',$data);
        $data=str_replace("\r\n",'',$data);
        $data=str_replace("\r",'',$data);
        $data=str_replace("\n",'',$data);
        $data=str_replace("\"",'',$data);
        return $data;
    }
}