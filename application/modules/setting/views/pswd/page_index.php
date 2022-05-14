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
                    <h4 class="title"><i style="padding-left: 10px;padding-right: 10px;" class="fa fa-lock bg-bulet bg-app"></i> Ubah Password</h4>
                    <div class="row">
                        <div class="col-md-8">
                            <ol class="breadcrumb">
                              <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
                              <li class="active">Setting</li>
                              <li class="active">Ubah password</li>
                            </ol>
                        </div>
                        
                    </div>
                    <hr class="hr"/>
                    <?php echo $this->session->flashdata('notif') ?>
                </div>
                
                <div class="content">
                    <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('setting/ubah_password/do_save') ?>" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="old_password" class="form-control" placeholder="Password sekarang" aria-describedby="sizing-addon2">
                          </div>
                        </div>
                        
                      </div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Password baru</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="new_password" class="form-control" placeholder="Password baru" aria-describedby="sizing-addon2">
                          </div>
                        </div>
                        
                      </div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Ulangi password</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="re_password" class="form-control" placeholder="Ulangi password baru" aria-describedby="sizing-addon2">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
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
            old_password: {
                validators: {
                    notEmpty: {
                        message: 'Password sekarang tidak boleh kosong'
                    }
                }
            },
            new_password: {
                validators: {
                    notEmpty: {
                        message: 'Password baru tidak boleh kosong'
                    },
                    stringLength: {
                        min: 6,
                        max: 50,
                        message: 'Minimal panjang 6 karakter dan maksimal 50 karakter'
                    },
                }
            },
            re_password: {
                validators: {
                    notEmpty: {
                        message: 'ulangi password tidak boleh kosong'
                    },
                    identical: {
                        field: 'new_password',
                        message: 'Password tidak sama'
                    },
                }
            },
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