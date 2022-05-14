<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> Duta Bahasa</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pembinaan</li>
          <li class="active"><a href="<?php echo site_url('duta_bahasa') ?>">Duta Bahasa</a></li>
          <li class="active">Add</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('duta_bahasa/do_add') ?>">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tahun</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tahun" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tempat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tempat" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Lokasi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="lokasi" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Peserta</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="jum_peserta" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Pemenang</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="pemenang" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Asal Pendidikan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="asal_pddkn" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Ket</label>
            <div class="col-sm-10">
              <textarea rows="3" class="form-control" name="ket_juara" placeholder="....."></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('duta_bahasa') ?>">Kembali</a>
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
            tempat: {
                validators: {
                    notEmpty: {
                        message: 'tempat harus diisi'
                    }
                }
            },
            asal_pddkn: {
                validators: {
                    notEmpty: {
                        message: 'Asal pendidikan harus diisi'
                    }
                }
            },
            tahun: {
                validators: {
                    notEmpty: {
                        message: 'Tahun harus diisi'
                    },
                    stringLength: {
                        min: 4,
                        max: 4,
                        message: 'Format tahun tidak valid, gunakan 4 digit'
                    },
                    numeric: {
                        message: 'harap masukan data berupa angka'
                    }
                }
            },
            jum_peserta: {
                validators: {
                    numeric: {
                        message: 'harap masukan data berupa angka'
                    }
                }
            },

        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>