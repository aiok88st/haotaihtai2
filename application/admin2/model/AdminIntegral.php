<?php

namespace app\admin2\model;

use think\Exception;
use think\Model;
use think\Log;

use think\Db;
class AdminIntegral extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_integral';

    public function getPIdAttr($value){
        $prize=Product::get($value);
        return $prize['name'];
    }
    public function getOpenIdAttr($value){
        $open=AdminOpen::get($value);

        return '<img src="'.$open['open_face'].'" width="50" title="'.$open['open_id'].'" date-name="'.$open['open_name'].'"/>&nbsp;&nbsp;'.$open['open_name'];
    }
}