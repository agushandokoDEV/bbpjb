<?php if($dt_slide != null){ ?>
<?php foreach($dt_slide as $val){ ?>
<div class="col-md-3" id="slide<?php echo $val->id_slide ?>">
    <div class="thumbnail no-radius">
        <img style="width: 100%;" src="<?php echo site_url('common/album/slide/'.$val->foto) ?>"/>
        <hr class="hr" />
        <p><?php echo $val->foto ?> <a class="btn btn-danger btn-xs" href="#hapus" onclick="hapus('<?php echo $val->id_slide ?>','<?php echo $val->foto ?>')"><span class="glyphicon glyphicon-trash"></span></a></p>
    </div>
</div>
<?php }}?>