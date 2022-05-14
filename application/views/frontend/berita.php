<?php $this->load->view('frontend/head') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="header bg-default">
                <h4 class="title"><span class="glyphicon glyphicon-globe"></span> Berita Kegiatan</h4>
                <hr class="hr"/>
            </div>    
            
            <div class="content">
                <?php if($dt_slide){ ?>
                <?php foreach($dt_slide as $slide){ ?>
                <h4 style="margin-bottom: 5px;"><a href="<?php echo site_url('berita/tag/'.$slide->slug) ?>"><?php echo $slide->judul; ?></a></h4>
                <p style="font-size: 10px;"><span class="glyphicon glyphicon-calendar"></span> <i><?php echo tanggal($slide->tgl) ?></i></p>
                
                <p class="leadx"><?php echo word_limiter($slide->isi, 50); ?></p>
                <hr class="hr" style="border-color: #ddd;"/>
                <?php }}else{?>
                <h4 class="text-center"><span class="glyphicon glyphicon-info-sign"></span> Tidak ada berita kegiatan</h4>
                <?php }?>
                
                <div class="text-center"><?php echo $halaman ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <?php $this->load->view('frontend/right_page') ?>
    </div>
</div>
<?php $this->load->view('frontend/footer') ?>