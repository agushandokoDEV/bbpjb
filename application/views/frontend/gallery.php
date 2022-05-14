<?php $this->load->view('frontend/head') ?>
<?php $this->load->view('vendor/galery') ?>
<style>
.img-galery{
    border-radius: 0;
}
.img-galery:hover{
    box-shadow: 3px 3px 3px 1px #ddd;
    border: 1px solid red;
}
</style>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="header bg-default">
                <h4 class="title"><span class="glyphicon glyphicon-picture"></span> Gallery Kegiatan</h4>
                <hr class="hr"/>
            </div>    
            
            <div class="content">
                <?php if($dt_slide){ ?>
                <div class="row">
                    <?php foreach($dt_slide as $slide){ ?>
                    <div class="col-md-3 col-xs-12">
                        <a class="thumbnail img-galery" rel="lightbox[group]" href="<?php echo $slide->url_img ?>"><img class="group1" src="<?php echo $slide->url_img ?>" title="<?php echo $slide->judul ?>" style="min-height: 120px;max-height: 120px; width: 100%;"/></a>
                    </div>
                    <?php }?>
                </div>
                <?php }else{?>
                <h4 class="text-center"><span class="glyphicon glyphicon-info-sign"></span> Tidak ada gallery kegiatan</h4>
                <?php }?>
            </div>
        </div>
        
    </div>
    <div class="col-md-4">
        <?php $this->load->view('frontend/right_page') ?>
    </div>
</div>
<?php $this->load->view('frontend/footer') ?>