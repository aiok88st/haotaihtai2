<?php
/*
 * 工具按钮
 * */
namespace app\common\controller;
class Tool{
    protected $export_url;
    protected $tool=[];
    public function __construct()
    {
        $controller=request()->controller();

        $url=url($controller.'/export');
        $this->export_url=$url.'?';
    }

    public function export(){
        $html=<<<EOF
    
EOF;
        array_push($this->tool,$html);
    }

    public function news(){
        $controller=request()->controller();

        $url=url($controller.'/sms');
        $html=<<<EOF
         <button class="layui-btn" onclick="get_ajax('{$url}')"><i class="layui-icon"></i>模板消息发送</button>
            
EOF;
        array_push($this->tool,$html);
    }

    //导入数据
    public function export_add($url){
        $html=<<<EOF
        <button class="layui-btn" onclick="x_admin_show('导入数据','{$url}',500,400)">导入数据</button>
EOF;
        array_push($this->tool,$html);//e_csv
    }
    /*
   * 获取按钮
   * */
    public function get_tool(){
        return $this->tool;
    }

}
