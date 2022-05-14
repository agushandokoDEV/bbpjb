<?php $this->load->view('frontend/head') ?>
<div class="row">
    <div class="col-md-8">
        <?php if($berita){ ?>
        <div class="card">
            <div class="header bg-default">
                <h4 class="title"><span class="glyphicon glyphicon-globe"></span> <?php echo $berita->judul; ?></h4>
                <hr class="hr"/>
            </div>    
            
            <div class="content">
                <p style="font-size: 10px;"><span class="glyphicon glyphicon-calendar"></span> <i><?php echo tanggal($berita->tgl) ?></i></p>
                <img class="media-object img-thumbnail" src="<?php echo $berita->url_img ?>"  data-holder-rendered="true" style="width:100%;border-radius: 0;margin-top: 10px; max-height: 500px;">
                <p style="margin-top: 20px;text-indent: 50px;"><?php echo $berita->isi; ?></p>
            </div>
        </div>
        <?php }else{?>
        <h4 class="text-center"><span class="glyphicon glyphicon-info-sign"></span> Tidak ada berita kegiatan</h4>
        <?php }?>
    </div>
    <div class="col-md-4">
        <?php $this->load->view('frontend/right_page') ?>
    </div>
</div>
<?php $this->load->view('frontend/footer') ?>