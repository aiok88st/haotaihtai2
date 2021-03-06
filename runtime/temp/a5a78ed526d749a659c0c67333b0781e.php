<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"F:\wamp\www\htt\public/../application/admin2\view\repair\index.html";i:1520826757;s:68:"F:\wamp\www\htt\public/../application/admin2\view\common\common.html";i:1520393002;s:65:"F:\wamp\www\htt\public/../application/admin2\view\common\nav.html";i:1520391761;}*/ ?>
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


    <div class="x-nav">
     <?php 

         $action=request()->action();
         $controller=request()->controller();
         $route=$controller.'/'.$action;

         $menu=db('admin_menu')->where(['route'=>$route])->find();
         if($menu['parent_id']!=0){
         $menu2=db('admin_menu')->where('id',$menu['parent_id'])->value('name');
         }
      ?>
      <span class="layui-breadcrumb">

        <a href="javascript:;"><?php echo $menu2; ?></a>

        <a><cite><?php echo $menu['name']; ?></cite></a>
      </span>

    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="<?php echo url($route); ?>" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i>
    </a>
</div>
    <div class="x-body">
        <div class="layui-row">
            <form method="get" action="<?php echo url('Repair/index'); ?>" class="layui-form layui-col-md12 x-so">
                <div class="layui-input-inline">
                    <input type="text" name="key" value="<?php echo $sreach['key']; ?>" placeholder="请输入姓名/电话" autocomplete="off" class="layui-input">
                </div>
                <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
            </form>
        </div>
        <xblock>
            <button class="layui-btn" onclick="get_csv()">导出数据</button>
        </xblock>

        <input class="layui-input" type="hidden" name="__token__" value="<?php echo $token; ?>">
        <table class="layui-table">
            <thead>
            <tr>
                <th>换购券名称</th>
                <th>状态</th>
                <th>姓名</th>
                <th>电话</th>
                <th>购买时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo $vo['pid']; ?></td>
                    <td><?php echo $vo['status']; ?></td>
                    <td><?php echo $vo['name']; ?></td>
                    <td><?php echo $vo['phone']; ?></td>
                    <td><?php echo $vo['add_time']; ?></td>
                    <td class="td-manage" >
                        <a title="查看详情"  onclick="x_admin_show('查看详情','<?php echo url('Repair/detail',['id'=>$vo['id']]); ?>')" href="javascript:;">
                            查看详情
                        </a>
                    </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
    </table>

    <div class="page">
        <?php echo $list->render(); ?>
    </div>
    </div>
    <script type="text/javascript">
        layui.use(['layer'], function(){
            $ = layui.jquery;
            var layer = layui.layer;

        });
        function get_csv(){
            window.location.href="<?php echo url('Repair/e_csv'); ?>";
        }
    </script>
    </body>

</html>