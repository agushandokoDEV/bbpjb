<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> Bengkel Bahasa & Sastra</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pembinaan</li>
          <li class="active"><a href="<?php echo site_url('bengkel_bhs_sastra') ?>">Bengkel Bahasa & Sastra</a></li></li>
          <li class="active">Add</li>
        </ol>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('bengkel_bhs_sastra/do_add') ?>">
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
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Kegiatan :</label>
            <div class="col-sm-10">
              <input type="text" name="nama_keg" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kategori :</label>
            <div class="col-sm-10">
              <input type="text" name="kat" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Mulai :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_mulai" placeholder=".....">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Selesai :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_selesai" placeholder=".....">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Pematri :</label>
            <div class="col-sm-10">
              <input type="text" name="pematri" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Peserta :</label>
            <div class="col-sm-10">
              <input type="text" name="jum_peserta" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Peserta :</label>
            <div class="col-sm-10">
              <input type="text" name="peserta" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Lembaga :</label>
            <div class="col-sm-10">
              <input type="text" name="nama_lembaga" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('bengkel_bhs_sastra') ?>">Kembali</a>
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
        $('#form-add').formValidation('revalidateField', 'tgl_mulai');
        $('#form-add').formValidation('revalidateField', 'tgl_selesai');
    });
    $('#form-add').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            kabkot:{
                validators: {
                    notEmpty: {
                        message: 'Pilih Kota'
                    }
                }
            },
            nama_keg:{
                validators: {
                    notEmpty: {
                        message: 'Nama kegiatan harus di isi'
                    }
                }
            },
            tgl_mulai: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal mulai harus diisi'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        max: 'tgl_selesai',
                        message: 'Format tanggal tidak valid'
                    }
                }
            },
            tgl_selesai: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal selesai harus diisi'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        min: 'tgl_mulai',
                        message: 'Format tanggal tidak valid, atau tanggal selesai lebih kecil dari tanggal mulai'
                    }
                }
            },
            jum_peserta:{
                validators: {
                    integer: {
                        message: 'Masukan jumlah data berupa angka'
                    }
                }
            }
        }
    })
    .on('success.field.fv', function(e, data) {
        if (data.field === 'tgl_mulai' && !data.fv.isValidField('tgl_selesai')) {
            // We need to revalidate the end date
            data.fv.revalidateField('tgl_selesai');
        }

        if (data.field === 'tgl_selesai' && !data.fv.isValidField('tgl_mulai')) {
            // We need to revalidate the start date
            data.fv.revalidateField('tgl_mulai');
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>