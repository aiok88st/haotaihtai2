<?php
namespace app\admin2\controller;


use think\Controller;
use think\Request;
use think\Cache;
use app\common\controller\From;
use app\admin2\model\System as SystemModel;
class System extends Fater
{
    //活动设置
    public function index(SystemModel $system)
    {
        $s = $system::get(['id'=>1]);
        return view('',[
            'system'=>$s
        ]);
    }

    public function save(Request $request,SystemModel $system){
        $param=$request->post();
        $re = $system->where('id',1)->update($param);
        if($re !== false){
            Cache::clear();
            return json(['code'=>1,'msg'=>'设置成功']);
        }else{
            return json(['code'=>0,'msg'=>'设置失败']);
        }

    }
}