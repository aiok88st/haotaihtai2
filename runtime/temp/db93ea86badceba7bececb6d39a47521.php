<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"F:\wamp\www\htt\public/../application/admin2\view\repair\detail.html";i:1520910449;s:68:"F:\wamp\www\htt\public/../application/admin2\view\common\common.html";i:1520393002;}*/ ?>
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

    <body>
    <div class="x-body">
        <table class="layui-table">
            <colgroup>
                <col width="150">
                <col width="200">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <td>订单号</td>
                <td><?php echo $data['out_trade_no']; ?></td>
            </tr>
            <tr>
                <td>活动码</td>
                <td><?php echo $data['code']; ?></td>
            </tr>
            <tr>
                <td>换购券名称</td>
                <td><?php echo $data['pid']; ?></td>
            </tr>
            <tr>
                <td>状态</td>
                <td><?php echo $data['status']; ?></td>
            </tr>
            <tr>
                <td>姓名</td>
                <td><?php echo $data['name']; ?></td>
            </tr>
            <tr>
                <td>电话</td>
                <td><?php echo $data['phone']; ?></td>
            </tr>
            <tr>
                <td>购买时间</td>
                <td><?php echo $data['add_time']; ?></td>
            </tr>
            <tr>
                <td>旧款品牌</td>
                <td><?php echo $data['old_brand']; ?></td>
            </tr>
            <?php if($data['old_img']): ?>
            <tr>
                <td>旧款图片</td>
                <td>
                    <?php if(is_array($data['old_img']) || $data['old_img'] instanceof \think\Collection): $i = 0; $__LIST__ = $data['old_img'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <img src="<?php echo $v; ?>" width="100" alt="" onclick="show_img('<?php echo $v; ?>')" style="margin-right: 5px;"/>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </td>
            </tr>
            <?php endif; ?>
            <tr>
                <td>城市码</td>
                <td><?php echo $data['city_code']; ?></td>
            </tr>
            <tr>
                <td>新款品牌</td>
                <td><?php echo $data['new_brand']; ?></td>
            </tr>
            <?php if($data['new_img']): ?>
                <tr>
                    <td>新款图片</td>
                    <td>

                        <?php if(is_array($data['new_img']) || $data['new_img'] instanceof \think\Collection): $i = 0; $__LIST__ = $data['new_img'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <img src="<?php echo $v; ?>" width="100" alt="" onclick="show_img('<?php echo $v; ?>')" style="margin-right: 5px;"/>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
            <tr>
                <td>使用时间</td>
                <td><?php echo $data['use_time']; ?></td>
            </tr>
            <tr>
                <td>产品满意度</td>
                <td><?php echo $data['proStar']; ?>星</td>
            </tr>
            <tr>
                <td>服务满意度</td>
                <td><?php echo $data['serStar']; ?>星</td>
            </tr>
            <tr>
                <td>意见反馈</td>
                <td><?php echo $data['content']; ?></td>
            </tr>

            </tbody>
        </table>
    </div>
    <script>

    </script>

    </body>
    <div id="tong" style="display: none">
        <img src="">
    </div>

</html>