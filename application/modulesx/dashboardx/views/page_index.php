<?php $this->load->view('template/main') ?>
<link rel="stylesheet" href="<?php echo site_url('assets/vendor/semantic/components/label.css') ?>"/>
<script src="<?php echo site_url('assets/vendor/maphilight/jquery.maphilight.min.js') ?>"></script>
<script>
function get_data(kota){
    //$("html, body").animate({scrollTop: 300}, 1000);
    $('#load-kota').html('<div class="text-center"><?php echo loading() ?></div>');
    $.post('<?php echo site_url('dashboard/ajax_load_kota') ?>',{kota:kota,thn:$('#thn').val()},function(r){
        $('#load-kota').html(r);
    })
    .fail(function(){
        $('#load-kota').html('');
        alert('Terjadi kesalahan..');
    });
}
function get_map(){
    $('#loading-map').html('<?php echo loading() ?>');
    $.post('<?php echo site_url('dashboard/ajax_load_map') ?>',{thn:$('#thn').val()},function(r){
        $('#loading-map').html('');
        $('#load-map').html(r);
    })
    .fail(function(){
        $('#load-map').html('');
        alert('Terjadi kesalahan..');
    });
}
$(function(){
    $('#thn').val('<?php echo date('Y') ?>');
    get_map();
});
</script>
<style>
.xx { background-color: red;}
</style>
<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="content">
                
                <form class="form-inline">
                  <div class="form-group">
                    <div class="input-group">
                      <span style="border-bottom-left-radius: 0;" class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
                      <select style="border-bottom-right-radius: 0;" onchange="get_map()" id="thn" class="form-control" aria-describedby="basic-addon1">
                        <?php
                        for($t=2010; $t<=date(Y); $t++)
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
                  <span id="loading-map"></span>
                </form>
                <div id="load-map"></div>
            </div>
        </div>
        <div id="load-kota">
            
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="header">
                <span class="ui teal ribbon label" style="font-size: 15px;"><i class="fa fa-map-marker"></i> Daftar Kabupaten/Kota</span>
            </div>    
            
            <div class="content">
                <ul class="list-unstyled">
                    <?php $no=1; foreach($dt_map as $map){ ?>
                    <li style="border-bottom: 1px dotted;padding: 5px;"><?php echo $no++.'. '.ucwords($map->nama_kota) ?></li>
                    <?php }?>
                </ul>                
            </div>
        </div>
        <pre>
        <?php print_r($this->session->all_userdata()) ?>
        </pre>        
    </div>
</div>

<?php $this->load->view('template/footer') ?>