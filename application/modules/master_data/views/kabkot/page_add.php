<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-database bg-bulet bg-danger"></i> Kabupaten / Kota</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Master Data</li>
          <li class="active"><a href="<?php echo site_url('master_data/kabkot') ?>">Kota</a></li></li>
          <li class="active">Add</li>
        </ol>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('master_data/kabkot/do_add') ?>">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Kota</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nm_kota" placeholder="Nama Kota">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Koordinat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="kordinat" placeholder="Koordinat lokasi">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('master_data/kabkot') ?>">Kembali</a>
            </div>
          </div>
        </form>
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
            nm_kota: {
                validators: {
                    remote: {
                        message: 'Nama Kota sudah ada, silahkan masukan nama lain',
                        url: '<?php echo site_url('master_data/kabkot/checked') ?>',
                        type: 'POST'
                    },
                    notEmpty: {
                        message: 'Nama Kota harus diisi'
                    },
                    stringLength: {
                        min: 2,
                        max: 50,
                        message: 'Minimal panjang 2 karakter dan maksimal 50 karakter'
                    },
                    regexp: {
                        regexp: /^[a-z ]+$/,
                        message: 'Karakter tidak valid, gunakan huruf kecil'
                    }
                }
            }
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>