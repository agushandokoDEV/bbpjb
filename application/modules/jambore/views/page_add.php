<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-book bg-bulet bg-info"></i> Jambore</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pengembangan</li>
          <li class="active"><a href="<?php echo site_url('jambore') ?>">Jambore</a></li>
          <li class="active">Add</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('jambore/do_add') ?>">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Waktu</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="waktu" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Utusan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="utusan" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tempat</label>
            <div class="col-sm-10">
              <textarea rows="2" class="form-control" name="tempat" placeholder="....."></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Panitia</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_panitia" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Jenis Tampilan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="jenis_tampilan" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('jambore') ?>">Kembali</a>
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
        $('#form-add').formValidation('revalidateField', 'waktu');
    });
    $('#form-add').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
             waktu: {
                validators: {
                    notEmpty: {
                        message: 'waktu pengajuan harus diisi'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Format waktu tidak valid'
                    }
                }
            },
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>