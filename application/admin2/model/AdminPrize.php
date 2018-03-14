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
    protected $field = ['name','group','pro','add_time','number','tl','ml'];
    protected $veri=[
        'name|奖品名称'   => 'require|max:255',
        'group|奖品类型'   => 'require|in:1,2,3,4',
        'pro|中奖概率'   => 'require|number',
    ];
    public function getGroupAttr($value){
        $attr=[
            1=>'实物礼品',
            2=>'积分',
            3=>'代金券',
            4=>'红包'
        ];
        return $attr[$value];
    }

}

?>