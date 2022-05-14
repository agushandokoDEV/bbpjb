<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="fa fa-image bg-bulet bg-app"></i> Foto</h4>
                    <hr class="hr"/>
                </div>
                
                <div class="content">
                    <img class="img-thumbnail no-radius" style="width: 100%;" src="<?php echo site_url('common/album/profil/thumb/'.$dt_row->foto) ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="fa fa-user bg-bulet bg-app"></i> Profil</h4>
                    <div class="row">
                        <div class="col-md-8">
                            <ol class="breadcrumb">
                              <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
                              <li class="active">Setting</li>
                              <li class="active">Profil</li>
                            </ol>
                        </div>
                        
                    </div>
                    <hr class="hr"/>
                    <?php echo $this->session->flashdata('notif') ?>
                </div>
                
                <div class="content">
                    <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('setting/profil/do_save') ?>" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="nama" placeholder="....." value="<?php echo $dt_row->nama_user ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-10">
                          <textarea rows="2" class="form-control" name="alamat" placeholder="....."><?php echo $dt_row->alamat ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="email" placeholder="....." value="<?php echo $dt_row->email ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Foto</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" name="foto" placeholder=".....">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button id="btn-submit" type="submit" class="btn btn-primary">Simpan perubahan</button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#form-add').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nama: {
                validators: {
                    notEmpty: {
                        message: 'Nama lengkap harus diisi'
                    }
                }
            },
            foto: {
                validators: {
                    file: {
                        extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        maxSize: 2097152,   // 2048 * 1024
                        message: 'harap masukan foto (jpg,png)'
                    }
                }
            }
        }
    })
    .on('success.form.fv', function(e) {
        // Prevent form submission
        //e.preventDefault();
        //console.log(e.target);        
        var $form = $(e.target);
        //var bar = $('#progress-bar-xl');
        //var percent = $('#percent-xl');
        //var status = $('#status');
        var loading=$('#loading-tf');
        $('#btn-submit').removeClass('btn-primary').addClass('btn-default').html('Loading... <?php echo loading('wek') ?>');
    });
});
</script>
<?php $this->load->view('template/footer') ?>