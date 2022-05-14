<?php $this->load->view('frontend/head') ?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="card">
        <div class="header">
            <h4 class="title"><i class="fa fa-lock bg-bulet bg-danger" style="border-radius: 30px;padding-left: 10px;padding-right: 10px;"></i> Aktivasi user</h4>
            <hr class="hr"/>
        </div>    
        
        <div class="content">
            <form id="form-aktivasi" class="form-horizontal" method="POST" action="<?php echo site_url('auth/do_aktvasi') ?>">
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
                    <input type="password" name="re_password" class="form-control" placeholder="Ulangi password" aria-describedby="sizing-addon2">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <button type="submit" class="btn btn-success"><i class="fa fa-lock"></i> Aktivasi</button>
                  <a href="<?php echo site_url('auth/logout') ?>" class="btn btn-danger">Batal dan login kembali</a>
                </div>
              </div>
            </form>
        </div>
    </div>
    </div>
</div>
<script>
$(function(){
    $('#form-aktivasi').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove'
        },
        fields: {
            new_password: {
                validators: {
                    notEmpty: {
                        message: 'Password harus diisi'
                    },
                    stringLength: {
                        min: 6,
                        max: 50,
                        message: 'Minimal panjang 6 karakter dan maksimal 50 karakter'
                    },
                },
            },
            re_password: {
                validators: {
                    identical: {
                        field: 'new_password',
                        message: 'Password tidak sama'
                    },
                    notEmpty: {
                        message: 'Password harus diisi'
                    }
                }
            }
        }
    });
});
</script>
<?php $this->load->view('frontend/footer') ?>