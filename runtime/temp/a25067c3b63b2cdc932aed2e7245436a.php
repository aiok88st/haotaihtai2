<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"F:\wamp\www\htt\public/../application/admin2\view\system\index.html";i:1521012889;s:68:"F:\wamp\www\htt\public/../application/admin2\view\common\common.html";i:1520393002;s:65:"F:\wamp\www\htt\public/../application/admin2\view\common\nav.html";i:1520391761;}*/ ?>
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
        <form action="" method="post" class="layui-form layui-form-pane">
            <div class="layui-inline">
                <label class="layui-form-label" style="width: 130px;">开始时间</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="begin_time" id="begin_time" value='<?php echo $system['begin_time']; ?>' placeholder="年-月-日">
                </div>
            </div>
            <div class="layui-inline">
                <label>&nbsp;&nbsp;-&nbsp;&nbsp;</label>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label" style="width: 130px;">结束时间</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="end_time" id="end_time" value='<?php echo $system['end_time']; ?>' placeholder="年-月-日">
                </div>
            </div>

            <div class="layui-form-item" style="margin-top: 15px">
                <label  class="layui-form-label" style="width: 130px;">系统公告</label>
                <div class="layui-input-inline">
                    <input type="text"  name="notice" required="" value='<?php echo $system['notice']; ?>' lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" style="margin-top: 15px">
                <label  class="layui-form-label" style="width: 130px;">游戏第一关积分</label>
                <div class="layui-input-inline">
                    <input type="text"  name="game_one" required="" value='<?php echo $system['game_one']; ?>' lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" style="margin-top: 15px">
                <label  class="layui-form-label" style="width: 130px;">游戏第二关积分</label>
                <div class="layui-input-inline">
                    <input type="text"  name="game_two" required="" value='<?php echo $system['game_two']; ?>' lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" style="margin-top: 15px">
                <label  class="layui-form-label" style="width: 130px;">游戏第三关积分</label>
                <div class="layui-input-inline">
                    <input type="text"  name="game_three" required="" value='<?php echo $system['game_three']; ?>' lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" style="margin-top: 15px">
                <label  class="layui-form-label" style="width: 130px;">过三关抽奖次数</label>
                <div class="layui-input-inline">
                    <input type="text"  name="game_award" required="" value='<?php echo $system['game_award']; ?>' lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <!--<div class="layui-form-item">-->
                <!--<label  class="layui-form-label">活动协议</label>-->
                <!--<div class="layui-input-block">-->
                    <!--<textarea id="des" name="agree" lay-verify="required" placeholder="" style="height: 300px"><?php echo $system['agree']; ?></textarea>-->
                <!--</div>-->
            <!--</div>-->
            <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="add">设置</button>
            </div>
        </form>
    </div>
    <!--<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor/ueditor.config.js"></script>-->
    <!--<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor/ueditor.all.min.js"> </script>-->
    <!--<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor/lang/zh-cn/zh-cn.js"></script>-->
    <!--<script type="text/javascript">-->
        <!--var ue = UE.getEditor('ued');-->
        <!--var ue = UE.getEditor('des');-->
    <!--</script>-->
    <script type="text/javascript">
        layui.use(['layer','laydate','form'], function(){
            $ = layui.jquery;
            var layer = layui.layer,laydate = layui.laydate,form = layui.form;

            //墨绿主题
            laydate.render({
                elem: '#begin_time'
                ,theme: 'molv'
            });

            laydate.render({
                elem: '#end_time'
                ,theme: 'molv'
            });

            //监听提交
            form.on('submit(add)', function(data){
                $.post("<?php echo url('save'); ?>",data.field,function(re){
                    if(re.code == 1){
                        layer.msg('设置成功', {icon: 1 ,time:3000},function(){
                            window.location.reload();
                        });
                    }else{
                        layer.msg('设置失败', {icon: 5 ,time:3000},function(){
                            window.location.reload();
                        });
                    }
                });
            });


        });
    </script>
    </body>

</html>