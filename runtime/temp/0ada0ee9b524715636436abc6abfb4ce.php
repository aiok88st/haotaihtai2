<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:64:"F:\wamp\www\htt\public/../application/admin2\view\menu\edit.html";i:1520391762;s:68:"F:\wamp\www\htt\public/../application/admin2\view\common\common.html";i:1520393002;}*/ ?>
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
        <form action="" method="post" class="layui-form layui-form-pane">
            <input class="layui-input" type="hidden" name="__token__" value="<?php echo $token; ?>">
            <input class="layui-input" type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>上级菜单
                </label>
                <div class="layui-input-inline">
                    <select name="parent_id" lay-verify="required">
                        <option value="0">作为一级菜单</option>
                        <?php if(is_array($menu_list) || $menu_list instanceof \think\Collection): $i = 0; $__LIST__ = $menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>" <?php if($data['parent_id'] == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>菜单名称
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="name" value="<?php echo $data['name']; ?>" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red"></span>菜单icon
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="icon" name="icon" value="<?php echo htmlentities($data['icon']); ?>"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red"></span>菜单路由
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="route" name="route" value="<?php echo $data['route']; ?>"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>权限标识
                </label>
                <div class="layui-input-inline">
                    <select name="auth" lay-verify="required">
                        <?php if(is_array($auth_list) || $auth_list instanceof \think\Collection): $i = 0; $__LIST__ = $auth_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['auth']; ?>" <?php if($data['auth'] == $vo['auth']): ?>selected<?php endif; ?> ><?php echo $vo['name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red"></span>菜单排序
                </label>
                <div class="layui-input-inline">
                    <input type="number" id="listorder" name="listorder" value="<?php echo $data['listorder']; ?>"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="add">提交</button>
            </div>
        </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
            var form = layui.form
                ,layer = layui.layer;

            //监听提交
            form.on('submit(add)', function(data){
                AjaxP("<?php echo url('menu/save'); ?>",'POST',data.field,false,false);
                return false;
            });


        });
    </script>

    </body>

</html>