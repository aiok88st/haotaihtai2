<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"F:\wamp\www\htt\public/../application/admin2\view\lottery\import.html";i:1520391761;s:68:"F:\wamp\www\htt\public/../application/admin2\view\common\common.html";i:1520393002;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>好太太后台管理系统</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="__STYLE__/css/font.css">
    <link rel="stylesheet" href="__STYLE__/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="__STYLE__/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="__STYLE__/js/xadmin.js"></script>
    
</head>

<div class="x-body">
    <blockquote class="layui-elem-quote">
        <span class="x-gray">鉴于数据量大，每次导入不超过200条</span>
        <a href="<?php echo url('lottery/drmb'); ?>" style="color: blue">下载导入模版</a>
        <br />
        <a href="<?php echo url('lottery/nolog'); ?>" style="color: blue">下载没有物流的数据</a>
    </blockquote>
    <form action="<?php echo url('lottery/do_import'); ?>" method="post" enctype="multipart/form-data" class="layui-form">
        <div class="layui-form-item">
            <label for="link" class="layui-form-label">
                <span class="x-red"></span>文件上传
            </label>
            <div class="layui-input-inline">
                <input type="file" name="temp"/>
                <div>

                </div>
            </div>
            <div class="layui-form-item">

            </div>
            <div class="layui-form-item">
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button class="layui-btn">上传</button>
            </div>
    </form>
</div>

</html>