<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-book bg-bulet bg-info"></i> Bahan Ajar</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pengembangan</li>
          <li class="active">Penyusunan</li>
          <li class="active"><a href="<?php echo site_url('bahan_ajar') ?>">Bahan Ajar</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){ ?>
        <script>
        $(function(){
            $('#kabkot').val('<?php echo $dt_row->id_kabkot ?>');
        });
        </script>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('bahan_ajar/do_upd') ?>" enctype="multipart/form-data">
          <input type="hidden" name="id_key" value="<?php echo $dt_row->id_bahan_ajar ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kota :</label>
            <div class="col-sm-10">
              <select name="kabkot" id="kabkot" class="form-control">
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
              <input type="text" class="form-control dp" name="tgl_pelaksanaan" placeholder="....." value="<?php echo $dt_row->tgl_pelaksanaan ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="judul" placeholder="....." value="<?php echo $dt_row->judul ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="kat" placeholder="....." value="<?php echo $dt_row->kat ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Penyusun</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_penyusun" placeholder="....." value="<?php echo $dt_row->nama_penyusun ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tahun Penyusun</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="thn_penyusun" placeholder="....." value="<?php echo $dt_row->thn_penyusun ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tingkat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tingkat" placeholder="....." value="<?php echo $dt_row->tingkat?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Sasaran</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sasaran" placeholder="....." value="<?php echo $dt_row->sasaran ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tema</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tema" placeholder="....." value="<?php echo $dt_row->tema ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Sumber Bahan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sumber_bahan" placeholder="....." value="<?php echo $dt_row->sumber_bahan ?>"/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('bahan_ajar') ?>">Kembali</a>
            </div>
          </div>
        </form>
        <?php
        }else{
            echo alert('danger','Data tidak terdaftar..');
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
            judul: {
                validators: {
                    notEmpty: {
                        message: 'Judul harus diisi'
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
            kat: {
                validators: {
                    notEmpty: {
                        message: 'Kategori harus diisi'
                    }
                }
            },
            nama_penyusun: {
                validators: {
                    notEmpty: {
                        message: 'Nama penyusun harus diisi'
                    }
                }
            },
            jum_pengajar: {
                validators: {
                    stringLength: {
                        min: 4,
                        max: 4,
                        message: 'Format tahun tidak valid, gunakan 4 digit'
                    },
                    numeric: {
                        message: 'harap masukan data berupa nomor'
                    }
                }
            },
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>