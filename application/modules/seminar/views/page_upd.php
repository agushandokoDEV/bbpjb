<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> Seminar</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pembinaan</li>
          <li class="active"><a href="<?php echo site_url('seminar') ?>">Seminar</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){?>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('seminar/do_upd') ?>">
          <input type="hidden" name="id_pk" value="<?php echo $dt_row->id_seminar ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Seminar</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_seminar" placeholder="....." value="<?php echo $dt_row->nama_seminar ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Pemateri</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="pemateri" placeholder="....." value="<?php echo $dt_row->pemateri ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Seminar</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_seminar" placeholder="....." value="<?php echo $dt_row->tgl_seminar ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Lokasi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="lokasi" placeholder="....." value="<?php echo $dt_row->lokasi ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tempat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tempat" placeholder="....." value="<?php echo $dt_row->tempat ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Peserta</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="jum_peserta" placeholder="....." value="<?php echo $dt_row->jum_peserta ?>">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('seminar') ?>">Kembali</a>
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
            nama_seminar: {
                validators: {
                    notEmpty: {
                        message: 'Judul naskah harus diisi'
                    }
                }
            },
            pemateri: {
                validators: {
                    notEmpty: {
                        message: 'Nama penulis harus diisi'
                    }
                }
            },
            tgl_seminar: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal perekaman harus diisi'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Format tanggal tidak valid'
                    }
                }
            },
            jum_peserta: {
                validators: {
                    numeric: {
                        message: 'harap masukan data berupa angka'
                    }
                }
            }
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>