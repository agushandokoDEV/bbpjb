<a href="<?php echo site_url('question/detail/'.$dt_post->id_ques) ?>" style="text-decoration: none; color: black;">
<div class="media" style="border-bottom: 1px dotted #ddd;padding-bottom: 5px;">
    <div class="media-left">
        <img class="media-object img-thumbnail" src="<?php echo site_url('common/album/pegawai/default.png') ?>"  data-holder-rendered="true" style="width: 64px; height: 64px;border-radius: 0;">
    </div>
    <div class="media-body">
        <h4 class="media-heading"><?php echo ucfirst($dt_post->nama) ?></h4>
        <?php echo word_limiter($dt_post->isi,30) ?>
        <br />
        <div class="row">
            <div class="col-md-12">
                <p class="label label-danger" style="font-size: 10px;"><span class="glyphicon glyphicon-calendar"></span> <?php echo tanggal($dt_post->tgl) ?></p>
                <p class="label label-success" style="font-size: 10px;"><span class="glyphicon glyphicon-comment"></span> 0 Komentar</p>
            </div>
        </div>
    </div>
</div>
</a>