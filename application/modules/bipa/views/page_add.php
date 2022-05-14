<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> BIPA</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pembinaan</li>
          <li class="active"><a href="<?php echo site_url('bipa') ?>">BIPA</a></li>
          <li class="active">Add</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('bipa/do_add') ?>">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Pembelajar</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_pembelajar" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tgl. Pelaksanaan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_pelaksanaan" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Negara</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="negara" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tingkat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tingkat" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('bipa') ?>">Kembali</a>
            </div>
          </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.dp').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    })
    .on('changeDate', function(e) {
        $('#form-add').formValidation('revalidateField', 'tgl_pelaksanaan');
    });
    $('#form-add').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nama_pembelajar: {
                validators: {
                    notEmpty: {
                        message: 'Nama pembelajar naskah harus diisi'
                    }
                }
            },
            tgl_pelaksanaan: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal pelaksanaan tidak boleh kosong'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Format tanggal tidak valid'
                    }
                }
            },
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>