<?php if(!empty($id)){ ?>
    <div class="layui-form-item">
        <label for="link" class="layui-form-label">
            <span class="x-red"></span><?php echo $value['name'];?>
        </label>
        <div class="layui-input-block">
            <textarea id="<?php echo $key;?>" name="<?php echo $key;?>" style="display: none;" <?php if($value['minleng'] >0){ ?>lay-verify="required"<?php } ?>>
                <?php echo htmlspecialchars_decode($data[$key])?>
            </textarea>
        </div>
    </div>
<?php }else{ ?>
    <div class="layui-form-item">
        <label for="link" class="layui-form-label">
            <span class="x-red"></span><?php echo $value['name'];?>
        </label>
        <div class="layui-input-block">
            <textarea id="<?php echo $key;?>" name="<?php echo $key;?>" style="display: none;" <?php if($value['minleng'] >0){ ?>lay-verify="required"<?php } ?>></textarea>
        </div>
    </div>
<?php } ?>
<script>
    var layedit_name="<?php echo $key;?>";
    layui.use('layedit', function(){
        var layedit = layui.layedit
            ,$ = layui.jquery;
        layedit.set({
            uploadImage: {
                url: '<?php echo $layeditupload;?>' //接口url
                ,type: 'post' //默认post
            }
        });
        //构建一个默认的编辑器
        var index = layedit.build('<?php echo $key;?>');

        layedit_index.push({name:layedit_name,index:index});


    });
</script>