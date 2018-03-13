<?php

namespace app\admin2\model;

use think\Exception;
use think\Model;
class Order extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_order';

    public function getPIdAttr($value)
    {
        $pro=Product::get($value);
        return $pro['name'];
    }

    public function getStatusAttr($value)
    {
        $html = '';
        switch($value){
            case 4:
                $html = '<button class="layui-btn layui-btn-warm">已使用</button>';
                break;
            case 3:
                $html = '<button class="layui-btn layui-btn-warm">已使用</button>';
                break;
            case 2:
                $html = '<button class="layui-btn layui-btn-warm">已使用</button>';
                break;
            case 1:
                $html = '<button class="layui-btn">已支付</button>';
                break;
            case 0:
                $html = '<button class="layui-btn layui-btn-danger">未支付</button>';
                break;

        }
        return $html;
    }

}