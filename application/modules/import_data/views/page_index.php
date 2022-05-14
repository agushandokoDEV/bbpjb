<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<script type="text/javascript" src="<?php echo site_url('assets/vendor/upload/jquery.form.min.js') ?>"></script>
<div class="container" style="width: 80%;">
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="fa fa-cloud-upload bg-bulet bg-danger"></i> Import Data</h4>
                    <hr class="hr"/>
                </div>
                <div class="content">
                    <div class="text-center" id="loading-post"></div>
                    <div id="load-form">
                        <p>Pilih menu disamping, sesuai dengan file yang akan diupload.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="glyphicon glyphicon-user bg-bulet bg-app"></i> Menu</h4>
                    <hr class="hr"/>
                </div>
                <div class="content">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                      <?php $no=1; foreach($dt_menu as $menu){$no++; ?>
                      <div class="panel panel-default" style="margin-top: 3px;">
                        <div class="panel-heading" role="tab" id="headingOne<?php echo $no; ?>" style="background: white;">
                          <h4 class="panel-title">
                            <a style="text-decoration: none;" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $no; ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $no; ?>">
                              <i class="<?php echo $menu->icon ?>"></i> <?php echo ucwords($menu->nama_menu); ?>
                            </a>
                          </h4>
                        </div>
                        <div id="collapseOne<?php echo $no; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne<?php echo $no; ?>">
                          <div class="panel-body">
                            <ul class="list-unstyled">
                                <?php foreach($this->M_import->getSubMenu($menu->id_menu)as $subm){ ?>
                                <li style="padding: 5px;border-bottom: 1px dotted gray;"><a onclick="load_form('<?php echo $subm->function ?>','<?php echo $this->M_import->get_menu($subm->id_menu) ?>')" class="hvr-growx" style="text-decoration: none;color: black;" href="#"><?php echo ucwords($this->M_import->get_menu($subm->id_menu)); ?></a></li>
                                <?php }?>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

function load_form(func,nm){
    $('#loading-post').html('<?php echo loading(); ?>');
    $.post('<?php echo site_url('import_data/load_form') ?>',{func:func,nm:nm},function(r){
        $('#load-form').html(r);
        $('#loading-post').html('');
    })
    .fail(function(){
        alert('Terjadi kesalahan...');
        $('#loading-post').html('');
    });
}
</script>
<?php $this->load->view('template/footer') ?>