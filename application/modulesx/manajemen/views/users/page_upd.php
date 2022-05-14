<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-sitemap bg-bulet bg-app"></i> Users</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Manajemen</li>
          <li class="active"><a href="<?php echo site_url('manajemen/users') ?>">Users</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <?php if($dt_row != null){ ?>
        <script>
        $(function(){
            $('#nm_role').val('<?php echo $dt_row->id_role ?>');
        });
        </script>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('manajemen/users/do_upd') ?>">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $dt_row->username ?>" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Role</label>
            <div class="col-sm-10">
              <select name="nm_role" id="nm_role" class="form-control">
                <option value="">Pilih Role</option>
                <?php foreach($dt_role as $r){ ?>
                <option value="<?php echo $r->id_role ?>"><?php echo ucwords($r->nama_role) ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nm_lengkap" placeholder="Nama Lengkap" value="<?php echo $dt_row->nama_user ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="email" placeholder="Alamat email" value="<?php echo $dt_row->email ?>">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('manajemen/users') ?>">Kembali</a>
            </div>
          </div>
        </form>
        <?php }else{?>
        <div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> Data tidak ada...</div>
        <?php }?>
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
            email: {
                validators: {
                    emailAddress: {
                        message: 'Alamat email tidak valid'
                    }
                }
            },
            nm_role: {
                validators: {
                    notEmpty: {
                        message: 'Harap pilih Role'
                    }
                }
            },
            nm_lengkap: {
                validators: {
                    notEmpty: {
                        message: 'Nama lengkap harus diisi'
                    },
                    stringLength: {
                        min: 2,
                        max: 50,
                        message: 'Minimal panjang 2 karakter dan maksimal 50 karakter'
                    },
                    regexp: {
                        regexp: /^[a-z ]+$/,
                        message: 'Karakter tidak valid..'
                    }
                }
            }
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>