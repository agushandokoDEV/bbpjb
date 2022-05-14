<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> BIPA</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pembinaan</li>
          <li class="active"><a href="<?php echo site_url('siaran_rri') ?>">BIPA</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){?>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('bipa/do_upd') ?>">
          <input type="hidden" name="id" value="<?php echo $dt_row->id_bipa ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Pembelajar</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_pembelajar" placeholder="....." value="<?php echo $dt_row->nama_pembelajar ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Negara</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="negara" placeholder="....." value="<?php echo $dt_row->negara ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tingkat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tingkat" placeholder="....." value="<?php echo $dt_row->tingkat ?>"/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('bipa') ?>">Kembali</a>
            </div>
          </div>
        </form>
        <?php
        }else{
            echo alert('danger','Data tidak ditemukan..');
        }
        ?>
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
            nama_pembelajar: {
                validators: {
                    notEmpty: {
                        message: 'Nama pembelajar naskah harus diisi'
                    }
                }
            }
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>