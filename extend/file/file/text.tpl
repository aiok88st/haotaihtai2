<?php if(!empty($id)){ ?>
    <div class="layui-form-item">
        <label for="link" class="layui-form-label">
            <span class="x-red"></span><?php echo $value['name'];?>
        </label>
        <div class="layui-input-block">
            <input type="text" name="<?php echo $key;?>" value="<?php echo $data[$key];?>" <?php if($value['minleng'] >0){ ?>lay-verify="required"<?php } ?> autocomplete="off" class="layui-input"
                   style=" <?php echo $value['style'];?>">
        </div>
    </div>
<?php }else{ ?>
    <div class="layui-form-item">
        <label for="link" class="layui-form-label">
            <span class="x-red"></span><?php echo $value['name'];?>
        </label>
        <div class="layui-input-block">
            <input type="text" name="<?php echo $key;?>" <?php if($value['minleng'] >0){ ?>lay-verify="required"<?php } ?> autocomplete="off" class="layui-input"
                style=" <?php echo $value['style'];?>">
        </div>
    </div>
<?php } ?>