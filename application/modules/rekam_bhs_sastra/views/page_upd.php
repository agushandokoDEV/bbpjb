<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-book bg-bulet bg-info"></i> Perekaman Bahasa dan Ekspresi Sastra</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pengembangan</li>
          <li class="active"><a href="<?php echo site_url('rekam_bhs_sastra') ?>">Perekaman Bahasa dan Ekspresi Sastra</a></li>
          <li class="active">Add</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){ ?>
        <script>
        $(function(){
            $('#genre').val('<?php echo $dt_row->genre ?>');
            $('#id_kabkot').val('<?php echo $dt_row->id_kabkot ?>');
        });
        </script>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('rekam_bhs_sastra/do_upd') ?>" enctype="multipart/form-data">
          <input type="hidden" name="id_key" value="<?php echo $dt_row->id_rekam_bhs ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kota :</label>
            <div class="col-sm-10">
              <select name="kabkot" id="id_kabkot" class="form-control">
                <option value="">Pilih</option>
                <?php foreach($dt_kabkot as $k){ ?>
                <option value="<?php echo $k->id_kabkot ?>"><?php echo ucwords($k->nama_kota) ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
            <div class="col-sm-10">
              <textarea rows="2" class="form-control" name="judul" placeholder="....."><?php echo $dt_row->judul ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Mulai :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_mulai" placeholder="....." value="<?php echo $dt_row->tgl_mulai ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Selesai :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_selesai" placeholder="....." value="<?php echo $dt_row->tgl_selesai ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Penyusun</label>
            <div class="col-sm-10">
              <textarea rows="2" class="form-control" name="penyusun" placeholder="....."><?php echo $dt_row->penyusun ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Lokasi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="lokasi" placeholder="....." value="<?php echo $dt_row->lokasi ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Narasumber</label>
            <div class="col-sm-10">
              <textarea rows="3" class="form-control" name="nara_sumber" placeholder="....."><?php echo $dt_row->nara_sumber ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Genre</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="genre" placeholder="....." value="<?php echo $dt_row->genre ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Narasi</label>
            <div class="col-sm-10">
              <textarea rows="2" class="form-control" name="narasi" placeholder="....."><?php echo $dt_row->narasi ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('rekam_bhs_sastra') ?>">Kembali</a>
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
            judul: {
                validators: {
                    notEmpty: {
                        message: 'Judul perekaman harus diisi'
                    }
                }
            },
            tgl_pelaksanaan: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal pelaksanaan harus diisi'
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
            kabkot: {
                validators: {
                    notEmpty: {
                        message: 'Kab/Kota harus diisi'
                    }
                }
            }
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>