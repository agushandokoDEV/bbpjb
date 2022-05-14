<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/qtip') ?>
<link rel="stylesheet" href="<?php echo site_url('assets/vendor/semantic/components/label.css') ?>"/>
<script src="<?php echo site_url('assets/vendor/maphilight/jquery.maphilight.min.js') ?>"></script>

<script>
$(function(){
    $('#thn').val('<?php echo date('Y') ?>');
    get_map();
});
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
</script>
<style>
.xx { background-color: red;}
</style>
<div class="row">
        <div class="col-md-9">
        <div class="card">
            <div class="content">
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
                <span id="loading-map"></span>
                <div id="load-map"></div>
            </div>
        </div>
        <div id="load-kota"></div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="header">
                <span class="ui teal ribbon label" style="font-size: 15px;"><i class="fa fa-map-marker"></i> Daftar Kabupaten/Kota</span>
            </div>    
            
            <div class="content">
                
                <form>
                    <div class="form-group" style="margin-bottom: 5px;">
                    <div class="input-group">
                      <span class="input-group-addon bg-app" id="basic-addon1" style="color: white;"><span class="glyphicon glyphicon-calendar"></span></span>
                      <select id="thn" class="form-control" aria-describedby="basic-addon1" style="height: 40px;">
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
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne<?php echo $no; ?>">
                      <h4 class="panel-title">
                        <a style="text-decoration: none;" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $no; ?>" aria-expanded="true" aria-controls="collapseOne">
                          <i class="<?php echo $map->icon ?>"></i> <?php echo ucwords($map->nama_menu); ?>
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne<?php echo $no; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne<?php echo $no; ?>">
                      <div class="panel-body">
                        <ul class="list-unstyled">
                            <?php foreach($this->M_dashboard->getSubMenu($map->id_menu)as $subm){ ?>
                            <li style="padding: 5px;border-bottom: 1px dotted gray;"><a style="text-decoration: none;color: black;" href="#"><?php echo ucwords($subm->nama_menu); ?></a></li>
                            <?php }?>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <?php }?>
                </div>
            </div>
        </div>
        <pre>
        <?php print_r($this->session->all_userdata()) ?>
        </pre>        
    </div>
</div>

<?php $this->load->view('template/footer') ?>