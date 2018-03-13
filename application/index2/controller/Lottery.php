<?php

namespace app\index2\controller;

use think\Controller;
use think\Request;

use app\index2\model\AdminLottery;

class Lottery extends Fater
{
    public function _initialize()
    {
        parent::_initialize();
    }

    public function lottery1(AdminLottery $adminLottery){
//        return rejson(0,'抽奖已结束，可以继续在首页领取红利1288元优惠购GW-1561');
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == false) {
            return "<h1 style='font-size: 40px'>请用微信浏览器打开</h1>";
        }
        
        if(session('rc')!=input('post.rc')){
            return rejson(0,'网络错误，请关闭页面重新打开');
        }

        $result = $this->validate(
            [
                '__token__'=>input('post.__toen__')
            ],
            [
                '__token__|令牌'=>'require|token'
            ],
            [
               '__token__.token'=>'您的操作频繁，请稍后再试'
        ]);

        if(true !== $result){
            return rejson(0,$result);
        }
        return $adminLottery->lottery1();
    }
    public function lottery2(AdminLottery $adminLottery){
        $result = $this->validate(
            [
                '__token__'=>input('post.__toen__')
            ],
            [
                '__token__|令牌'=>'require|token'
            ],[
            '__token__.token'=>'您的操作频繁，请稍后再试'
        ]);

        if(true !== $result){
            return rejson(0,$result);
        }
        return $adminLottery->lottery2();
    }

}
