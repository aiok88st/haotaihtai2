<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"F:\wamp\www\htt\application\index/../../public/template/index\index\index.html";i:1520559591;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="__ADMIN__/lib/layui/css/layui.css" />
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</head>
<body>
    <div style="margin-top: 30px">
        换购券：<select id="pid" style="width: 200px;height: 50px">
                    <?php if(is_array($ticket) || $ticket instanceof \think\Collection): $i = 0; $__LIST__ = $ticket;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                </select>
    </div>
    <div style="margin-top: 30px">姓名：<input type="text" id="name" style="width: 200px;height: 50px"> </div>
    <div style="margin-top: 30px">电话：<input type="text" id="phone" style="width: 200px;height: 50px"> </div>
    <div style="margin-top: 30px">旧款品牌：<input type="text" id="old_brand" style="width: 200px;height: 50px"> </div>
    <div><input type="hidden" id="cr" value="<?php echo $cr; ?>"> </div>
    <button style="width: 200px;height: 50px;margin-top: 30px" onclick="adds()">提交</button>
</body>
</html>
<script type="text/javascript" src="__ADMIN__/lib/layui/layui.js" ></script>
<script type="text/javascript">
    layui.use(['layer'], function(){
        var layer = layui.layer;
    });
    function adds(){
        var url = "<?php echo url('Pay/buy_ticket'); ?>";
        var data = {};
        data.pid = $('#pid option:selected') .val();
        data.name = $("#name").val();
        data.phone = $("#phone").val();
        data.old_brand = $("#old_brand").val();
        data.old_img = '';
        data.cr = $("#cr").val();
        layer.load(1);
        $.post(url, data, function(res) {
            layer.closeAll();
            if (res.code == 1) {
                layer.msg(res.msg,{time: 3000});
            } else {
                layer.msg(res.msg,{time: 3000});
            }
        }, 'json');
    }
</script>