<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> Kegiatan Lainnya</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pembinaan</li>
          <li class="active"><a href="<?php echo site_url('kegiatan') ?>">Kegiatan Lainnya</a></li>
          <li class="active">Add</li>
        </ol>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('kegiatan/do_add') ?>">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Kegiatan :</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="nm_keg" placeholder="....." rows="2"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tempat :</label>
            <div class="col-sm-10">
              <input type="text" name="tempat" class="form-control" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kota :</label>
            <div class="col-sm-10">
              <select name="kabkot" class="form-control">
                <option value="">Pilih</option>
                <?php foreach($dt_kabkot as $k){ ?>
                <option value="<?php echo $k->id_kabkot ?>"><?php echo ucwords($k->nama_kota) ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tgl. Kegiatan :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_keg" placeholder=".....">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Jumlah :</label>
            <div class="col-sm-5">
              <input type="text" name="jum_peserta" class="form-control" placeholder="Jumlah peserta"/>
            </div>
            <div class="col-sm-5">
              <input type="text" name="jum_penyuluh" class="form-control" placeholder="Jumlah penyuluh"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Penyuluh :</label>
            <div class="col-sm-7">
              <input type="text" name="nm_penyuluh" class="form-control" placeholder="Nama penyuluh"/>
            </div>
            <div class="col-sm-3">
              <input type="text" name="jum_peserta_penyuluh" class="form-control" placeholder="Jumlah peserta penyuluh"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Sasaran :</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="sasaran" placeholder="....." rows="2"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Keterangan :</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="ket" placeholder="....." rows="3"></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('kegiatan') ?>">Kembali</a>
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
        $('#form-add').formValidation('revalidateField', 'tgl_keg');
    });
    $('#form-add').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nm_keg: {
                validators: {
                    notEmpty: {
                        message: 'Nama Kegiatan harus diisi'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9  \.\-]+$/,
                        message: 'Karakter tidak valid, gunakan huruf kecil'
                    }
                }
            },
            tempat: {
                validators: {
                    notEmpty: {
                        message: 'Tempat kegiatan harus diisi'
                    }
                }
            },
            tgl_keg: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal kegiatan harus diisi'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Format tanggal tidak valid'
                    }
                }
            },
            jum_peserta:{
                validators: {
                    integer: {
                        message: 'Masukan jumlah data berupa angka'
                    }
                }
            },
            jum_penyuluh:{
                validators: {
                    integer: {
                        message: 'Masukan jumlah data berupa angka'
                    }
                }
            },
            kabkot:{
                validators: {
                    notEmpty: {
                        message: 'Pilih Kota'
                    }
                }
            },
            jum_peserta_penyuluh:{
                validators: {
                    integer: {
                        message: 'Masukan jumlah data berupa angka'
                    }
                }
            },
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>