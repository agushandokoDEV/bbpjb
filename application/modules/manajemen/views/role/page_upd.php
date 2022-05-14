<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-sitemap bg-bulet bg-app"></i> Role</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Manajemen</li>
          <li class="active"><a href="<?php echo site_url('manajemen/role') ?>">Role</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <?php if($dt_row != null){ ?>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('manajemen/role/do_upd') ?>">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Role</label>
            <div class="col-sm-10">
              <input type="hidden" name="id_role" value="<?php echo $dt_row->id_role ?>"/>
              <input type="text" class="form-control" name="nm_role" placeholder="Nama Role" value="<?php echo $dt_row->nama_role ?>">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('manajemen/role') ?>">Kembali</a>
            </div>
          </div>
        </form>
        <?php }else{?>
        <div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> Data tidak ada</div>
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
            nm_role: {
                validators: {
                    notEmpty: {
                        message: 'Nama Role harus diisi'
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