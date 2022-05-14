<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/qtip') ?>
<?php $this->load->view('vendor/datatable') ?>
<?php $this->load->view('vendor/jconfirm') ?>
<script src="<?php echo site_url('assets/vendor/maphilight/jquery.maphilight.min.js') ?>"></script>
<script src="<?php echo site_url('assets/vendor/maphilight/jquery.rwdImageMaps.min.js') ?>"></script>

<script>
$(function(){
    $('img[usemap]').rwdImageMaps();
    $('#thn').val('<?php echo date('Y') ?>');
    //get_map();
});
function valmap(){
    $.alert({
        confirmButton: 'OK',
        title: 'Upss...!',
        icon: 'glyphicon glyphicon-remove',
        content: 'Untuk menampilkan data maping harap pilih menu kegiatan disamping'
    });
}
function get_map(menu){
    $('img[usemap]').rwdImageMaps();
    var nm_all='';
    $('#key-menu').val(menu);
    $('#map-data').remove();
    $('#loading-map').html('<?php echo loading() ?>');
    $.post('<?php echo site_url('dashboard/maping/load_map') ?>',{thn:$('#thn').val(),menu:menu},function(r){
        $('#loading-map').html('');
        $('#load-map').html(r);
        $.post('<?php echo site_url('dashboard/maping/get_nm_alldata') ?>',{thn:$('#thn').val(),menu:menu},function(rs_all){
            get_alldata(menu,rs_all);
        })
        .fail(function(){
            alert('Terjadi kesalahan, harap cek koneksi internet anda..');
        });
    })
    .fail(function(){
        $('#load-map').html('');
        alert('Terjadi kesalahan, harap cek koneksi internet anda..');
    });
}
function get_mapb(thn){
    $('img[usemap]').rwdImageMaps();
    var nm_all='';
    var menu=$('#key-menu').val();
    if(menu != ''){
        $('#map-data').remove();
        $('#loading-map').html('<?php echo loading() ?>');
        $.post('<?php echo site_url('dashboard/maping/load_map') ?>',{thn:$('#thn').val(),menu:menu},function(r){
            $('#loading-map').html('');
            $('#load-map').html(r);
            $.post('<?php echo site_url('dashboard/maping/get_nm_alldata') ?>',{thn:$('#thn').val(),menu:menu},function(rs_all){
                get_alldata(menu,rs_all);
            })
            .fail(function(){
                alert('Terjadi kesalahan, harap cek koneksi internet anda..');
            });
        })
        .fail(function(){
            $('#load-map').html('');
            alert('Terjadi kesalahan, harap cek koneksi internet anda..');
        });
    }
}
function get_data(kota,menu,func){
    //$("html, body").animate({scrollTop: 300}, 1000);
    $('#load-kota').html('<div class="text-center"><?php echo loading() ?></div>');
    $.post('<?php echo site_url('dashboard/maping/') ?>/'+func,{kota:kota,thn:$('#thn').val(),menu:menu},function(r){
        $('#load-kota').html(r);
    })
    .fail(function(){
        $('#load-kota').html('');
        alert('Terjadi kesalahan, harap cek koneksi internet anda..');
    });
}
function get_alldata(menu,rel){
    //console.log(rel);
    $.post('<?php echo site_url('dashboard/maping/') ?>/'+rel,{thn:$('#thn').val(),menu:menu},function(rs_all){
        $('#load-kota').html(rs_all);
    })
    .fail(function(){
        $('#load-kota').html('');
        alert('Terjadi kesalahan, harap cek koneksi internet anda..');
    });
}
</script>
<input type="hidden" id="key-menu"/>
<div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="content" style="padding-left: 35px;">
                    <!--
                    <form class="form-inline" style="display: none;">
                      <div class="form-group">
                        <div class="input-group">
                          <span style="border-bottom-left-radius: 0;" class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
                          <select style="border-bottom-right-radius: 0;" onchange="get_map()" id="thn" class="form-control" aria-describedby="basic-addon1">
                            
                          </select>
                        </div>
                      </div>
                      
                    </form>
                    -->
                    
                    <div id="load-map">
                        <img onclick="valmap()" class="mapjabar" id="Image-Maps-Com-image-maps-2016-03-27-231822" src="<?php echo site_url('common/map/jabar.png') ?>" border="0" width="918" height="500" orgWidth="918" orgHeight="500" usemap="#image-maps-2016-03-27-231822" alt="" />
                    </div>
                    <div class="text-center"><span id="loading-map"></span></div>
                </div>
            </div>
        <div class="panel-group" id="accordionx" role="tablist" aria-multiselectable="true">
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOnex">
              <h4 class="panel-title">
                <a style="text-decoration: none;" role="button" data-toggle="collapse" data-parent="#accordionx" href="#collapseOnex" aria-expanded="true" aria-controls="collapseOnex">
                  <span classx="ui red ribbon label text-left" style="font-size: 25px; width: 50%;"><i class="fa fa-street-view bg-bulet bg-danger" style="padding-left: 10px;padding-right: 10px;"></i> <b>Daftar Kota</b></span>
                </a>
              </h4>
            </div>
            <div id="collapseOnex" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOnex">
              <div class="panel-body">
                <?php
                $from=0;
                ?>
                <div class="row">
                    <div class="col-md-3">
                        <?php $dt_kabkot=$this->M_dashboard->get_kabkot($from); ?>
                        <ul class="list-unstyled">
                        <?php foreach($dt_kabkot as $k){ $from++; ?>
                            <li><?php echo $k->kode.'. '.ucwords($k->nama_kota) ?></li>
                        <?php }?>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <?php $dt_kabkot=$this->M_dashboard->get_kabkot($from); ?>
                        <ul class="list-unstyled">
                        <?php foreach($dt_kabkot as $k){ $from++; ?>
                            <li><?php echo $k->kode.'. '.ucwords($k->nama_kota) ?></li>
                        <?php }?>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <?php $dt_kabkot=$this->M_dashboard->get_kabkot($from); ?>
                        <ul class="list-unstyled">
                        <?php foreach($dt_kabkot as $k){ $from++; ?>
                            <li><?php echo $k->kode.'. '.ucwords($k->nama_kota) ?></li>
                        <?php }?>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <?php $dt_kabkot=$this->M_dashboard->get_kabkot($from); ?>
                        <ul class="list-unstyled">
                        <?php foreach($dt_kabkot as $k){ $from++; ?>
                            <li><?php echo $k->kode.'. '.ucwords($k->nama_kota) ?></li>
                        <?php }?>
                        </ul>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="load-kota"></div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="header bg-appx" style="padding-bottom: 5px;border-bottom: 1px dotted #ddd;">
                <h4 style="margin-top: 0; color: whitex;"><i class="fa fa-file-text bg-bulet bg-app" style="border: 1px solid gold;"></i> <b>Filter Maping</b></h4>
            </div> 
            
            <div class="content">
                
                <form>
                    <div class="form-group" style="margin-bottom: 3px;">
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1" style="color: black;background: white;"><span class="glyphicon glyphicon-calendar"></span></span>
                      <select onchange="get_mapb(this.value)" id="thn" class="form-control" aria-describedby="basic-addon1" style="height: 40px;">
                        <?php
                        for($t=2010; $t<=date('Y'); $t++)
                        {
                            $ar_thn[]=$t;
                        }
                        rsort($ar_thn);
                        foreach($ar_thn as $ar_thn)
                        {
                            echo '<option value="'.$ar_thn.'">'.$ar_thn.'</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </form>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <?php $no=1; foreach($dt_map as $map){$no++; ?>
                  <div class="panel panel-default" style="margin-top: 3px;">
                    <div class="panel-heading" role="tab" id="headingOne<?php echo $no; ?>" style="background: white;">
                      <h4 class="panel-title">
                        <a style="text-decoration: none;" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $no; ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $no; ?>">
                          <i class="<?php echo $map->icon ?>"></i> <?php echo ucwords($map->nama_menu); ?>
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne<?php echo $no; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne<?php echo $no; ?>">
                      <div class="panel-body">
                        <ul class="list-unstyled">
                            <?php foreach($this->M_dashboard->getMaping($map->id_menu)as $subm){ ?>
                            <?php
                            
                            if($subm->id_menu == '49'){
                                $mn= ucwords('Penelitian '.$subm->nama_menu);
                            }else if($subm->id_menu == '50'){
                                $mn= ucwords('Penelitian '.$subm->nama_menu);
                            }else if($subm->id_menu == '51'){
                                $mn= ucwords('Penyusunan '.$subm->nama_menu);
                            }else if($subm->id_menu == '52'){
                                $mn= ucwords('Penyusunan '.$subm->nama_menu);
                            }else if($subm->id_menu == '53'){
                                $mn= ucwords('Penyusunan '.$subm->nama_menu);
                            }else if($subm->id_menu == '54'){
                                $mn= ucwords('Penyusunan '.$subm->nama_menu);
                            }else{
                                $mn= ucwords($subm->nama_menu);
                            }
                            ?>
                            <li style="padding: 5px;border-bottom: 1px dotted gray;"><a class="hvr-grow" onclick="get_map('<?php echo $subm->id_menu ?>')" style="text-decoration: none;color: black;" href="#"><?php echo $mn; ?></a></li>
                            <?php }?>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <?php }?>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="header bg-appx" style="padding-bottom: 5px;border-bottom: 1px dotted #ddd;">
                <h4 style="margin-top: 0;"><i class="glyphicon glyphicon-info-sign bg-bulet bg-info" style="border: 1px solid gold;"></i> <b>Informasi</b></h4>
            </div> 
            <div class="content">
                <p>
                File excel sudah tersedia untuk semua menu <b>PEMBINAAN</b> dan <b>PENGEMBANGAN</b>,
                silahkan download dan isi data dengan format tabel yang sudah disediakan.
                Jika ada pertanyaan atau masukan(menu atau data yang tidak sesuai/error)
                silahkan klik <a href="<?php echo site_url('question') ?>">disini</a>. Terimakasih 
                </p>
            </div>
        </div>
              
    </div>
</div>

<?php $this->load->view('template/footer') ?>