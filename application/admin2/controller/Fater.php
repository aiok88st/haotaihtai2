<?php

namespace app\admin2\controller;

use think\Controller;
use think\Request;
use app\admin2\model\AdminAdmin as Admin;
use app\admin2\model\Menu;

class Fater extends Controller
{
    public function _initialize()
    {
        $member_id=session('admin_user')['user_id'];
        define('UID',$member_id);
        if(!UID){
            $this->redirect('login/login');
        }
        $Admin=new Admin;
        $login_num=$Admin->where('id',UID)->value('login_num');
        $action=Request::instance()->action();
        if($action!="loginout"){
            if(session('admin_user')['login_num']!=$login_num){
                $this->error('您的账号已在别处登录',url('index/loginout'));
            }
        }
        if(Request::instance()->isPost()){

            $result = $this->validate(
                [
                    '__token__'=>input('post.__token__')
                ],
                [
                    '__token__|令牌数据'=>'require|token'
                ]);

            if(true !== $result){
                return rejson(0,$result);
            }
        }

    }
    //用户权限验证
    protected function userauth($action_code) {
        //判断是否是系统用户，如果是，则不用验证权限，否则验证
        $action_list=user_action_list(UID);
        if(!in_array($action_code,$action_list)){
            $this->error('对不起，您没有该项操作权限','');
        }

    }
    public function get_region(TpRegion $region){
        $pid=request()->param()['pid'];
        $list=$region->where('parent_id',$pid)->select();
        return $list;
    }
}
