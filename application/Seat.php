<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\Exception;
use think\Request;
use app\index\model\AdminSeat;
class Seat extends Controller{

    public function index(){ //页面
        return $this->fetch();
    }
    public function search(Request $request,AdminSeat $adminSeat){  //搜索
        try{
            $name=$request->param('username','');
            if(empty($name))return json(['code'=>0,'msg'=>'请输入姓名']);
            $list=db('admin_seat')->where('name',$name)->order('id asc')->select();
            foreach($list as $k=>$v){
                $list[$k]['seat'] = sprintf("%03d",$v['seat']);
            }
            return $list;
        }catch (Exception $e){
            return json(['code'=>0,'msg'=>$e->getMessage()]);
        }
    }
}
?>