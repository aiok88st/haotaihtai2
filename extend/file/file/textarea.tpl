<?php if(!empty($id)){ ?>
<div class="layui-form-item">
    <label for="link" class="layui-form-label">
        <span class="x-red"></span><?php echo $value['name'];?>
    </label>
    <div class="layui-input-block">
        <textarea name="<?php echo $key;?>" placeholder="" class="layui-textarea" <?php if($value['minleng'] >0){ ?>lay-verify="required"<?php } ?>
            <?php echo $value['style'];?>><?php echo $data[$key];?></textarea>
    </div>
</div>
<?php }else{ ?>
    <div class="layui-form-item">
        <label for="link" class="layui-form-label">
            <span class="x-red"></span><?php echo $value['name'];?>
        </label>
        <div class="layui-input-block">
        <textarea name="<?php echo $key;?>" placeholder="" class="layui-textarea" <?php if($value['minleng'] >0){ ?>lay-verify="required"<?php } ?>
            <?php echo $value['style'];?>></textarea>
        </div>
    </div>
<?php } ?>
