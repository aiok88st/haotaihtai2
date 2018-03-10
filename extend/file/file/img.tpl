<?php if(!empty($id)){ ?>
    <div class="layui-form-item">
        <label for="link" class="layui-form-label">
            <span class="x-red"></span><?php echo $value['name'];?>
        </label>
        <div class="layui-input-inline">
            <div>
                <?php if(!empty($data[$key])){ ?>
                    <img id="<?php echo $key;?>_img" src="<?php echo __ROOT__.'/'.$data[$key]?>" width="112" alt=""  <?php echo $value['style'];?> />
                <?php }else{ ?>
                    <img id="<?php echo $key;?>_img" src="__STYLE__/images/avatar.png" width="112" alt=""  <?php echo $value['style'];?> />
                <?php } ?>
                <input type="hidden" name="<?php echo $key;?>" value="<?php echo $data[$key]?>" id="<?php echo $key;?>" autocomplete="off" class="layui-input" />
            </div>
            <div class="site-demo-upbar">
                <input type="file" name="file" class="layui-upload-file file_<?php echo $key;?>" id="test"  />
            </div>
            <div>
                <span class="x-gray"></span>
            </div>
    </div>

<?php }else{ ?>
    <div class="layui-form-item">
        <label for="link" class="layui-form-label">
            <span class="x-red"></span><?php echo $value['name'];?>
        </label>
        <div class="layui-input-inline">
            <div>
                <img id="<?php echo $key;?>_img" src="__STYLE__/images/avatar.png" width="112" alt=""  <?php echo $value['style'];?> />
                <input type="hidden" name="<?php echo $key;?>" value="" id="<?php echo $key;?>" autocomplete="off" class="layui-input" />
            </div>
            <div class="site-demo-upbar">
                <input type="file" name="file" class="layui-upload-file file_<?php echo $key;?>" id="test"  />
            </div>
            <div>
                <span class="x-gray"></span>
            </div>
    </div>

<?php } ?>
    <script type="text/javascript">
        layui.use(['upload','layer'],function(){
            var layer = layui.layer;
            var load;
            //图片上传接口
            layui.upload({
                elem:".file_<?php echo $key;?>",
                url: "<?php echo $uploadUrl;?>", //上传接口
                before:function(){
                    load = layer.load(2, {time: 10*1000});
                }
                ,success: function(res){ //上传成功后的回调
                    layer.close(load);
                    if(res.code==1){
                        layer.msg(res.msg, {icon: 6});
                        $('#<?php echo $key;?>_img').attr('src',res.img);
                        $('#<?php echo $key;?>').val(res.url);
                    }else{
                        layer.msg(res.msg, {icon: 5,time:1000});
                    }

                }
            });
        });
    </script>
</div>