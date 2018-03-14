<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"F:\wamp\www\htt\application\index2/../../public/temp/index2\index\sore.html";i:1521011291;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="__ADMIN__/lib/layui/css/layui.css" />
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</head>
<body>

<div style="margin-top: 30px">姓名：<input type="text" id="name" style="width: 200px;height: 50px"> </div>
<div style="margin-top: 30px">电话：<input type="text" id="phone" style="width: 200px;height: 50px"> </div>
<div style="margin-top: 30px">地区：<input type="text" id="city" style="width: 200px;height: 50px"> </div>
<div style="margin-top: 30px">地址：<input type="text" id="addres" style="width: 200px;height: 50px"> </div>
<button style="width: 200px;height: 50px;margin-top: 30px" onclick="adds()">兑换</button>
<div id="ss" style="display: none">
    <p>剩余：<span id="pn"></span></p>
    <p>我的积分：<span id="ms"></span></p>
</div>
</body>
</html>
<script type="text/javascript" src="__ADMIN__/lib/layui/layui.js" ></script>
<script type="text/javascript">
    layui.use(['layer'], function(){
        var layer = layui.layer;
    });
    function adds(){
        var url = "<?php echo url('Index/addInt'); ?>";
        var data = {};
        data.pid = 6;
        data.name = $("#name").val();
        data.phone = $("#phone").val();
        data.city = $("#city").val();
        data.addres = $("#addres").val();
        layer.load(1);
        $.post(url, data, function(res) {
            layer.closeAll();
            if (res.code == 1) {
                $("#ss").show();
                $('#pn').html(res.pNum);
                $('#ms').html(res.myScore);
            } else {
                layer.msg(res.msg,{time: 3000});
            }
        }, 'json');
    }
</script>