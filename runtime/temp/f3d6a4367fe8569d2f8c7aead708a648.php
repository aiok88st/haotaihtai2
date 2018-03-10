<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"F:\wamp\www\htt\public/../application/admin\view\product\index.html";i:1520404014;s:67:"F:\wamp\www\htt\public/../application/admin\view\common\common.html";i:1520393002;s:64:"F:\wamp\www\htt\public/../application/admin\view\common\nav.html";i:1520391761;}*/ ?>
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
            <form method="get" action="<?php echo url('Product/index'); ?>" class="layui-form layui-col-md12 x-so">
                <div class="layui-input-inline">
                    <input type="text" name="key" value="<?php echo $sreach['key']; ?>" placeholder="请输入换购券名称" autocomplete="off" class="layui-input">
                </div>
                <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
            </form>
        </div>
        <xblock>
            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
            <button class="layui-btn" onclick="x_admin_show('添加换购券','<?php echo url('Product/create'); ?>')"><i class="layui-icon"></i>添加</button>

        </xblock>

        <input class="layui-input" type="hidden" name="__token__" value="<?php echo $token; ?>">
        <table class="layui-table">
            <thead>
            <tr>
                <th>
                    <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
                </th>
                <th>图片</th>
                <th>换购券名称</th>
                <th>价格</th>
                <th>库存</th>
                <th>简介</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td>
                        <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $vo['id']; ?>'><i class="layui-icon">&#xe605;</i></div>
                    </td>
                    <td><img src="__APP__<?php echo $vo['img']; ?>" width="100px"/></td>
                    <td><?php echo $vo['name']; ?></td>
                    <td><?php echo $vo['price']; ?></td>
                    <td><?php echo $vo['number']; ?></td>
                    <td><?php echo $vo['short']; ?></td>
                    <td><?php echo date("Y-m-d H:i:s",$vo['add_time']); ?></td>
                    <td class="td-manage" >
                        <a title="编辑"  onclick="x_admin_show('编辑换购券','<?php echo url('Product/edit',['id'=>$vo['id']]); ?>')" href="javascript:;">
                            编辑
                        </a>
                        <a title="删除" onclick="delAll('<?php echo $vo['id']; ?>')" href="javascript:;">
                            删除
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

        function delAll(argument) {
            var data;
            if(argument){
                data =[argument];
            }else{
                data = tableCheck.getData();
            }
            var token=$('[name="__token__"]').val();
            layer.confirm('确认删除这条数据？',function(index){
                //捉到所有被选中的，发异步进行删除
                //捉到所有被选中的，发异步进行删除
                var url="<?php echo url('Product/delete'); ?>";
                AjaxP(url,'POST',{"ids":data,"__token__":token},function(res){
                    if(res.code==1){
                        deleCall();
                    }

                });

            });
        }

    </script>
    </body>

</html>