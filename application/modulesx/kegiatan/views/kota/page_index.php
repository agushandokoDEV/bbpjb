<?php $this->load->view('template/main') ?>
<link rel="stylesheet" href="<?php echo site_url('assets/vendor/semantic/components/label.css') ?>"/>
<style>
.cardx{
    background: rgba(247,247,247,1);
background: -moz-linear-gradient(top, rgba(247,247,247,1) 0%, rgba(255,255,255,1) 53%, rgba(255,255,255,1) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(247,247,247,1)), color-stop(53%, rgba(255,255,255,1)), color-stop(100%, rgba(255,255,255,1)));
background: -webkit-linear-gradient(top, rgba(247,247,247,1) 0%, rgba(255,255,255,1) 53%, rgba(255,255,255,1) 100%);
background: -o-linear-gradient(top, rgba(247,247,247,1) 0%, rgba(255,255,255,1) 53%, rgba(255,255,255,1) 100%);
background: -ms-linear-gradient(top, rgba(247,247,247,1) 0%, rgba(255,255,255,1) 53%, rgba(255,255,255,1) 100%);
background: linear-gradient(to bottom, rgba(247,247,247,1) 0%, rgba(255,255,255,1) 53%, rgba(255,255,255,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f7f7f7', endColorstr='#ffffff', GradientType=0 );
}
ul.list-keg{
    margin-top: 10px;
    margin-left: 20px;
}
ul.list-keg li{
    padding: 5px;
    font-style: italic;
}
.media-keg{
    padding: 10px 10px 0 10px;
}
.media-kegx:hover{
    background:  white;
}
</style>
<div class="card">
    <div class="header bg-warningx" style="padding-bottom: 10px;border-bottom: 1px dotted #ddd;">
        <div class="row">
            <div class="col-md-5">
                <span classx="ui red ribbon label text-left" style="font-size: 25px; width: 50%;"><i class="fa fa-street-view bg-bulet bg-danger" style="padding-left: 10px;padding-right: 10px;"></i> <b><?php echo ucwords($dt_kota->nama_kota).' ('.$thn.')' ?></b></span>
            </div>
            <div class="col-md-7"></div>
        </div>
    </div>    
    
    <div class="content">
        <?php if($dt_keg != null){ ?>
        <?php foreach($dt_keg as $keg){ ?>
        <div class="media media-keg">
          <div class="media-body">
            <h4 class="media-heading ui brown tag label" style="font-size: 17px;"><i class="fa fa-link" aria-hidden="true"></i> <?php echo ucfirst($keg->nama_keg) ?></h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="ui circular labels">
                    <ul class="list-unstyled list-keg">
                        <li><span class="ui red label"><span class="glyphicon glyphicon-calendar"></span></span> <?php echo fullday($keg->tgl_keg) ?></li>
                        <li><span class="ui brown label"><i class="fa fa-map-marker"></i></span> <?php echo $keg->tempat ?></li>
                        <li><span class="ui grey label"><i class="fa fa-users"></i></span> <?php echo $keg->jum_peserta ?> Peserta</li>
                        <li><span class="ui blue label"><i class="fa fa-users"></i></span> <?php echo $keg->jum_penyuluh ?> Penyuluh</li>
                        <li><span class="ui green label"><i class="fa fa-user"></i></span> <?php echo $keg->nama_penyuluh ?></li>
                    </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <p><?php echo $keg->nama_penyuluh ?></p>
                    <p><?php echo $keg->ket ?></p>
                </div>
            </div>
            
          </div>
        </div>
        <hr class="hr"/>
        <?php }?>
        <div class="text-center"><?php echo $halaman ?></div>
        <?php }else{?>
        <p class="error"><i><span class="glyphicon glyphicon-info-sign"></span> Kegiatan belum tersedia..</i></p>
        <?php }?>
    </div>
</div>
<?php $this->load->view('template/footer') ?>