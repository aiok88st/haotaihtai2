<?php

namespace app\index2\controller;

use think\Controller;
use think\Request;
use app\index2\model\AdminPrize;
class Fater extends Controller
{
    protected $site_info;
    public function _initialize()
    {
        $member_id=session('user')['user_id'];
        define('UID',$member_id);
        if(!UID){
            $this->redirect(url('weixin/index'));
        }
        $all=AdminPrize::all(['group'=>['IN','1,3']]);
        $prize1=cache('prize1');
        if(!$prize1)cache('prize1',$all);

        //活动时间、协议
        $this->site_info=cache('site_info');
        if(!$this->site_info){
            $sys=db('admin_system')->where('id',1)->find();
            cache('site_info',$sys);
        }


        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == false) {
            return "<h1 style='font-size: 40px'>请用微信浏览器打开</h1>";
        }

    }

    //活动时间
    public function timeMsg(){
        $begin = strtotime($this->site_info['begin_time']);
        $end = strtotime($this->site_info['end_time']);
        $toDay = strtotime(date('Y-m-d'));
        if($toDay<$begin){
            return rejson(0,'活动未开始');
        }elseif($toDay>$end){
            return rejson(0,'活动已经结束');
        }else{
            return rejson(1,'活动期间');
        }
    }
}
