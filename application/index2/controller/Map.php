<?php
namespace app\index2\controller;

use think\Controller;
use think\Request;
class Map extends Controller{
    //计算地图
    public function shoplist(){
        try{
            //获取cookie值,如果收到cookie，表示定位成功，可以通过用户的位置进行周边搜索
            if (cookie('userLocationHasRecord') && cookie('userLocationHasRecord')==1) {
                $location=cookie('userLocation');
                $map=new \org\Map;
                $search=[];
                $search['location']=$location;
                $list=$map->geosearch($search);

                $locations=explode(',',$location);
                $code=[];
                $code['x']=$locations[0];
                $code['y']=$locations[1];

                $code['list']=$list;

                return json($code);
            }
        }catch (Exception $e){
            $this->error('页面错误');
        }
    }
}
?>