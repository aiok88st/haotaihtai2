<?php
namespace app\admin2\controller;
use think\Db;
use think\Request;
use think\Controller;
class UpFiles extends Fater
{
    public function upload(){
        try{
            // 获取上传文件表单字段名
            $fileKey = array_keys(request()->file());
            // 获取表单上传文件
            $file = request()->file($fileKey['0']);
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'Upload');
            if($info){
                $result['code'] = 1;
                $result['info'] = '图片上传成功!';
                $path=str_replace('\\','/',$info->getSaveName());
                $result['url'] = '/Upload/'. $path;
                return $result;
            }else{
                // 上传失败获取错误信息
                $result['code'] =0;
                $result['info'] = '图片上传失败!';
                $result['url'] = '';
                return $result;
            }
        }catch(\Exception $e){
            return ['code'=>0,'msg'=>$e->getMessage()];
        }
    }

}