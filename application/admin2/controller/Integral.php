<?php
namespace app\admin2\controller;


use think\Controller;
use think\Exception;
use think\Request;
use app\common\controller\Table;
use app\admin2\model\AdminIntegral;
use app\common\controller\Search;
use app\common\controller\Tool;
use app\common\controller\From;
class Integral extends Fater
{
    public function index(Table $table, Search $search, AdminIntegral $integral, Tool $tool)
    {
        $this->userauth('activity');
        $table->init($integral);
        $table->editAction();  //禁用修改按钮
        $table->deleteAction(); //禁用删除按钮
        $table->createAction=false; //禁用添加按钮
        $table->column('pid', '商品名称');
        $table->column('open_id', '兑换用户');
        $table->column('add_time', '兑换时间');
        $table->column('name', '姓名');
        $table->column('phone', '电话');
        $table->column('city', '地区');
        $table->column('addres', '地址');

        $table->searchs(function() use ($search){
            $search->set_name('name','姓名')->rule('LIKE')->text();
            $search->set_name('phone','电话')->rule('=')->text();
        },$search);
        $table->tool(function() use ($tool){
            $tool->export2(url('Integral/e_csv'));
        },$tool);
        return $table->start();
    }

    //导出数据
    public function e_csv(){
        $file_name='好太太积分兑换.csv';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$file_name);
        header('Cache-Control: max-age=0');
        //接收条件，查询表
        $user = new AdminIntegral;
        $data='积分商品,姓名,手机,地区,地址,兑换时间'."\r\n";
        $arr = $user->order('id desc')->select();
        if(!$arr){
            $data .='没有找到相应的数据'."\r\n";
        }
        foreach($arr as $k=>$v){
            $city=$this->strG($v['city']);
            $data .= "{$v['pid']},{$v['name']},{$v['phone']},{$city},{$v['addres']},{$v['add_time']}"."\r\n";
        }
        return $data;
    }

    public function strG($data){
        $data=str_replace(',','，',$data);
        $data=str_replace("\r\n",'',$data);
        $data=str_replace("\r",'',$data);
        $data=str_replace("\n",'',$data);
        $data=str_replace("\"",'',$data);
        return $data;
    }
}