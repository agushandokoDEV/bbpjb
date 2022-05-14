<?php $this->load->view('frontend/head') ?>
<div class="row">
    <div class="col-md-8">
        <?php if($dt_slide){ ?>
        <div id="carousel-example-generic" class="carousel slide thumbnail" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol>
        
          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <?php foreach($dt_slide as $slide){ ?>
            <div class="item">
              <a href="<?php echo site_url('berita/tag/'.$slide->slug) ?>"><img src="<?php echo $slide->url_img ?>" style="width: 100%;height: 500px; min-height: 500px;" alt="..."></a>
              <div class="carousel-caption">
                <h3><a style="color: white;" href="<?php echo site_url('berita/tag/'.$slide->slug) ?>"><?php echo $slide->judul ?></a></h3>
              </div>
            </div>
            <?php } ?>
          </div>
        
          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <?php }?>
        <div class="card">
            <div class="header bg-default">
                <h4 class="title"><span class="glyphicon glyphicon-globe"></span> Berita Kegiatan</h4>
                <hr class="hr"/>
            </div>    
            
            <div class="content">
                <?php if($dt_slide){ ?>
                <?php foreach($dt_slide as $slide){ ?>
                <h4 style="margin-bottom: 5px;"><a href="<?php echo site_url('berita/tag/'.$slide->slug) ?>"><?php echo htmlspecialchars($slide->judul); ?></a></h4>
                <p style="font-size: 10px;"><span class="glyphicon glyphicon-calendar"></span> <i><?php echo tanggal($slide->tgl) ?></i></p>
                
                <p class="leadx"><?php echo htmlspecialchars( word_limiter($slide->isi, 50)); ?></p>
                <hr class="hr" style="border-color: #ddd;"/>
                <?php }}else{?>
                <h4 class="text-center"><span class="glyphicon glyphicon-info-sign"></span> Tidak ada berita kegiatan</h4>
                <?php }?>
            </div>
        </div>
        
    </div>
    <div class="col-md-4">
        <?php $this->load->view('frontend/right_page') ?>
    </div>
</div>
<?php $this->load->view('frontend/footer') ?>