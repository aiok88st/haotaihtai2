<?php
namespace app\admin2\model;

use think\Model;
class AdminPrize extends Model
{
    protected $pk = 'id';
    protected $table = 'admin_prize';
    protected $insert = ['add_time'];
    protected function setAddTimeAttr()
    {
        return date('Y-m-d H:i:s');
    }
    protected $field = ['name','group','pro','add_time','number'];
    protected $veri=[
        'name|奖品名称'   => 'require|max:255',
        'group|奖品类型'   => 'require|in:1,2',
        'pro|中奖概率'   => 'require|number',
    ];
    public function getGroupAttr($value){
        $attr=[
            1=>'上市好礼',
            2=>'上市红利',
            3=>'代金券'
        ];
        return $attr[$value];
    }

}

?>