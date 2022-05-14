<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-book bg-bulet bg-info"></i> Penelitian Sastra</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pengembangan</li>
          <li class="active"><a href="<?php echo site_url('penelitian/sastra') ?>">Penelitian Sastra</a></li>
          <li class="active">Add</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('penelitian/sastra/do_add') ?>">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Unit/Satuan Kerja</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="satuan_kerja" placeholder="....." value="balai bahasa provinsi jawa barat" readonly/>
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
            <label for="inputEmail3" class="col-sm-2 control-label">Tgl. Pelaksanaan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_pelaksanaan" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Peneliti</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="peneliti" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="judul" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kerja Sama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="kerja_sama" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tgl. Mulai</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_mulai" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tgl. Selesai</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_selesai" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Lama Penelitian</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="jum_lama" placeholder="....."/>
            </div>
            <div class="col-sm-8">
              <select name="satuan_lama" class="form-control">
                <option value="">-</option>
                <option value="tahun">Tahun</option>
                <option value="bulan">Bulan</option>
                <option value="minggu">Minggu</option>
                <option value="hari">Hari</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Publikasi</label>
            <div class="col-sm-10">
              <select class="form-control" name="publikasi">
                <option value="0">Belum Terbit</option>
                <option value="1">Terbit</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tahun Terbit</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="thn_terbit" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Abstrak</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="abstrak" rows="3" placeholder="....."></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('penelitian/sastra') ?>">Kembali</a>
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
            peneliti: {
                validators: {
                    notEmpty: {
                        message: 'Peneliti tidak boleh kosong'
                    }
                }
            },
            judul: {
                validators: {
                    notEmpty: {
                        message: 'Judul tidak boleh kosong'
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
            tgl_mulai: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal mulai tidak boleh kosong'
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
                        message: 'Tanggal selesai tidak boleh kosong'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        min: 'tgl_mulai',
                        message: 'Format tanggal tidak valid, atau tanggal selesai lebih kecil dari tanggal mulai'
                    }
                }
            },
            thn_terbit: {
                validators: {
                    stringLength: {
                        min: 4,
                        max: 4,
                        message: 'format tahun 4 digit'
                    },
                    numeric: {
                        message: 'data harus berupa angka',
                    }
                }
            },
            kabkot:{
                validators:{
                    notEmpty: {
                        message: 'Kab/Kota tidak boleh kosong'
                    }
                }
            },
            tahun: {
                validators: {
                    stringLength: {
                        min: 4,
                        max: 4,
                        message: 'format tahun 4 digit'
                    },
                    numeric: {
                        message: 'data harus berupa angka',
                    },
                    notEmpty: {
                        message: 'Tahun tidak boleh kosong'
                    }
                }
            },
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>