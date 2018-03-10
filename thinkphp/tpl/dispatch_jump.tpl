{__NOLAYOUT__}<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>信息提示</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">

    <script type="text/javascript" src="__PUBLIC__/common/js/jquery.js"></script>
</head>
<body>
        <?php switch ($code) {?>
            <?php case 1:?>
        <input type="hidden" name="icon" id="incon" value="6"/>
            <?php break;?>
            <?php case 0:?>
        <input type="hidden" name="icon" id="incon" value="5"/>
            <?php break;?>
        <?php } ?>

        <p class="jump" style="display: none;">
            页面自动 <a id="href" href="<?php echo($url);?>">跳转</a> 等待时间：
        </p>

    <script src="__STYLE__/lib/layui/layui.js" charset="utf-8"></script>
    <script src="__STYLE__/js/x-admin.js"></script>
    <script src="__STYLE__/js/x-layui.js" charset="utf-8"></script>
    <script type="text/javascript">
        layui.use(['layer'], function(){
            $ = layui.jquery;//jquery
            layer = layui.layer;//弹出层
            var icon=$('#incon').val();
            var wait = document.getElementById('wait'),
                    href = document.getElementById('href').href;
            layer.alert('<?php echo $msg;?>', {icon: icon},function () {
                location.href = href;
            });

            var interval = setInterval(function(){
                var time = --wait.innerHTML;
                if(time <= 0) {
                    location.href = href;
                    clearInterval(interval);
                };
            }, 1000);
        });
    </script>

</body>
</html>
