<div class="media" style="border-bottom: 1px dotted #ddd;padding-bottom: 5px;">
    <div class="media-left">
        <img class="media-object img-thumbnail" src="<?php echo site_url('common/album/pegawai/default.png') ?>"  data-holder-rendered="true" style="width: 64px; height: 64px;border-radius: 0;">
    </div>
    <div class="media-body">
        <h4 class="media-heading"><?php echo ucfirst($dt_kom->nama) ?></h4>
        <p class="label label-danger" style="font-size: 10px;"><span class="glyphicon glyphicon-calendar"></span> <?php echo tanggal($dt_kom->tgl_komentar) ?></p>
        <p><?php echo $dt_kom->komentar; ?></p>
        <br />
        <div class="row">
            <div class="col-md-2">
                
            </div>
            <div class="col-md-10">
                <!--<a style="text-decoration: none;" href="#"><p class="label label-info" style="font-size: 10px;"><span class="glyphicon glyphicon-comment"></span> 0 Jawaban</p></a>-->
            </div>
        </div>
    </div>
</div>