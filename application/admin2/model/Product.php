<?php

namespace app\admin2\model;

use think\Exception;
use think\Model;
class Product extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_product';
//    protected $field = ['name', 'img', 'price','number','short','add_time'];
    protected $veri=[
        'name|名称' => 'require|max:255',
    ];

    public function add($param){
        try{
            $adminLog=new AdminLog;
            if(isset($param['id'])){
                $result = (new Product)
                    ->allowField(true)
                    ->validate($this->veri)
                    ->save($param,['id'=>$param['id']]);

                if(false === $result){
                    // 验证失败 输出错误信息
                    return rejson(0,$this->getError());
                }
                return $adminLog->admin_log(1,'修改成功','edit',$param,UID);
            }else{
                $result =$this->allowField(true)->validate($this->veri)->save($param);
                if(false === $result){
                    // 验证失败 输出错误信息
                    return rejson(0,$this->getError());
                }
                return $adminLog->admin_log(1,'提交成功','add',$param,UID);
            }
        }catch (\Exception $e){
            return rejson(0,$e->getMessage());
        }
    }

    public function dele($param){
        try{
            $adminLog=new AdminLog;
            $ids=implode(',',$param);
            $this::destroy($ids);
            return $adminLog->admin_log(1,'删除成功','delete',$param,UID);
        }catch (\Exception $e){
            return rejson(0,$e->getMessage());
        }
    }
}