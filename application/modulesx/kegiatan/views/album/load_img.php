<div class="row">
    <?php foreach($dt_alb as $alb){ ?>
    <div class="col-md-3">
        <div class="thumbnail"  style="border-radius: 3px;">
          <img src="<?php echo site_url('common/album/kegiatan/thumb/'.$alb->file_img) ?>" style="height: 200px;"/>
          <div class="caption">
            <p><?php echo $alb->jdl_keg ?></p>
            <p>
            <button title="Edit foto" onclick="get_mdl_upd('<?php echo $alb->id_album_keg ?>','<?php echo $alb->file_img ?>','<?php echo $alb->jdl_keg ?>')" class="btn btn-sm btn-info" role="button"><span class="glyphicon glyphicon-pencil"></span></button>
            <button title="Hapus foto" onclick="hapus('<?php echo $alb->id_album_keg ?>','<?php echo $alb->file_img ?>')" class="btn btn-sm btn-danger" role="button"><span class="glyphicon glyphicon-trash"></span></button>
            </p>
          </div>
        </div>
    </div>
    <?php }?>
</div>