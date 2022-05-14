<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> Siaran RRI</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pembinaan</li>
          <li class="active"><a href="<?php echo site_url('siaran_rri') ?>">Siaran RRI</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_rri != null){?>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('siaran_rri/do_upd') ?>">
          <input type="hidden" name="id_pk" value="<?php echo $dt_rri->id_siaran ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Judul Naskah</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="judul_naskah" placeholder="....." value="<?php echo $dt_rri->judul_naskah ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Penulis</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nm_penulis" placeholder="....." value="<?php echo $dt_rri->penulis_naskah ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Perekaman</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_perekaman" placeholder="....." value="<?php echo $dt_rri->tgl_perekaman ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Disiarkan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_disiarkan" placeholder="....." value="<?php echo $dt_rri->tgl_disiarkan ?>">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('siaran_rri') ?>">Kembali</a>
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
    $('.dp').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    })
    .on('changeDate', function(e) {
        $('#form-add').formValidation('revalidateField', 'tgl_perekaman');
        $('#form-add').formValidation('revalidateField', 'tgl_disiarkan');
    });
    
    $('#form-add').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            judul_naskah: {
                validators: {
                    notEmpty: {
                        message: 'Judul naskah harus diisi'
                    }
                }
            },
            nm_penulis: {
                validators: {
                    notEmpty: {
                        message: 'Nama penulis harus diisi'
                    }
                }
            },
            tgl_perekaman: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal perekaman harus diisi'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        max: 'tgl_disiarkan',
                        message: 'Format tanggal tidak valid'
                    }
                }
            },
            tgl_disiarkan: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal disiarkan harus diisi'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        min: 'tgl_perekaman',
                        message: 'Format tanggal tidak valid, atau tanggal disiarkan lebih kecil dari tanggal perekaman'
                    }
                }
            },
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>