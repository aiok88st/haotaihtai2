<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:67:"F:\wamp\www\htt\public/../application/admin2\view\product\edit.html";i:1520308481;s:68:"F:\wamp\www\htt\public/../application/admin2\view\common\common.html";i:1520393002;}*/ ?>
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
                    <span class="x-red">*</span>换购券名称
                </label>
                <div class="layui-input-inline">
                    <div class="layui-input-inline">
                        <input type="text"  name="name" value="<?php echo $data['name']; ?>" required="" lay-verify="required"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>价格
                </label>
                <div class="layui-input-inline">
                    <div class="layui-input-inline">
                        <input type="text" id="name" value="<?php echo $data['price']; ?>" name="price"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>库存
                </label>
                <div class="layui-input-inline">
                    <div class="layui-input-inline">
                        <input type="text" id="number" value="<?php echo $data['number']; ?>" name="number"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>简介
                </label>
                <div class="layui-input-inline">
                    <div class="layui-input-inline">
                        <input type="text" name="short" value="<?php echo $data['short']; ?>"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">图片</label>
                <input type="hidden" name="img" id="logo" value="<?php echo $data['img']; ?>">
                <div class="layui-input-block">
                    <div class="layui-upload">
                        <button type="button" class="layui-btn layui-btn-primary" id="logoBtn"><i class="icon icon-upload3"></i>点击上传</button>
                        <div class="layui-upload-list" style="margin: 10px 12px;">
                            <img class="layui-upload-img" id="cltLogo" width="100px" src="__APP__<?php echo $data['img']; ?>">
                            <p id="demoText"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="add">提交</button>
            </div>
        </form>
    </div>
    <script>
        layui.use(['form', 'layer','upload'], function () {
            var form = layui.form,layer = layui.layer,upload = layui.upload,$ = layui.jquery;
            //普通图片上传
            var uploadInst = upload.render({
                elem: '#logoBtn'
                ,url: '<?php echo url("UpFiles/upload"); ?>'
                ,before: function(obj){
                    //预读本地文件示例，不支持ie8
                    obj.preview(function(index, file, result){
                        $('#cltLogo').attr('src', result); //图片链接（base64）
                    });
                }
                ,done: function(res){
                    //上传成功
                    if(res.code>0){
                        $('#logo').val(res.url);
                    }else{
                        //如果上传失败
                        return layer.msg('上传失败');
                    }
                }
                ,error: function(){
                    //演示失败状态，并实现重传
                    var demoText = $('#demoText');
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                    demoText.find('.demo-reload').on('click', function(){
                        uploadInst.upload();
                    });
                }
            });

            //监听提交
            form.on('submit(add)', function(data){
                AjaxP("<?php echo url('Product/save'); ?>",'POST',data.field,false,false);
                return false;
            });
        });
    </script>

    </body>

</html>