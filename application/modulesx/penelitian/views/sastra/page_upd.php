<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-info"></i> Penelitian Sastra</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pengembangan</li>
          <li class="active"><a href="<?php echo site_url('penelitian/sastra') ?>">Penelitian Sastra</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){?>
        <script>
        $(function(){
            $('#satuan_lama').val('<?php echo $dt_row->satuan_lama_penelitian ?>');
            $('#publikasi').val('<?php echo $dt_row->publikasi ?>');
        });
        </script>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('penelitian/sastra/do_upd') ?>">
          <input type="hidden" name="id" value="<?php echo $dt_row->id_penelitian ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Unit/Satuan Kerja</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="satuan_kerja" placeholder="....." value="balai bahasa provinsi jawa barat" readonly/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Peneliti</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->peneliti ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="judul" placeholder="....." value="<?php echo $dt_row->judul ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kerja Sama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="kerja_sama" placeholder="....." value="<?php echo $dt_row->kerja_sama ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tgl. Mulai</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_mulai" placeholder="....." value="<?php echo $dt_row->tgl_mulai ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tgl. Selesai</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_selesai" placeholder="....." value="<?php echo $dt_row->tgl_selesai ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Lama Penelitian</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="jum_lama" placeholder="....." value="<?php echo $dt_row->lama_penelitian ?>"/>
            </div>
            <div class="col-sm-8">
              <select name="satuan_lama" id="satuan_lama" class="form-control">
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
              <select class="form-control" id="publikasi" name="publikasi">
                <option value="0">Belum Terbit</option>
                <option value="1">Terbit</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tahun Terbit</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="thn_terbit" placeholder="....." value="<?php echo $dt_row->thn_terbit ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Abstrak</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="abstrak" rows="3" placeholder="....."><?php echo $dt_row->abstraksi ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('penelitian/sastra') ?>">Kembali</a>
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
            peneliti: {
                validators: {
                    notEmpty: {
                        message: 'Peneliti tidak boleh kosong'
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
            thn_terbit: {
                validators: {
                    stringLength: {
                        min: 4,
                        max: 4,
                        message: 'format tahun 4 digit'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Format tahun tidak valid'
                    }
                }
            },
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>