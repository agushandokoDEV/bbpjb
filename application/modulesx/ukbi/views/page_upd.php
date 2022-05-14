<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> UKBI</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pembinaan</li>
          <li class="active"><a href="<?php echo site_url('ukbi') ?>">UKBI</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <?php if($dt_ukbi != null){?>
        <script>
        $(function(){
            $('#kabkot').val('<?php echo $dt_ukbi->id_kabkot ?>');
        });
        </script>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('ukbi/do_upd') ?>">
          <input type="hidden" name="id_ukbi" value="<?php echo $dt_ukbi->id_ukbi ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kota :</label>
            <div class="col-sm-10">
              <select id="kabkot" name="kabkot" class="form-control">
                <option value="">Pilih</option>
                <?php foreach($dt_kabkot as $k){ ?>
                <option value="<?php echo $k->id_kabkot ?>"><?php echo ucwords($k->nama_kota) ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Lokasi Pengajuan :</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="lokasi_pengajuan" placeholder="....." rows="2"><?php echo $dt_ukbi->lokasi_pengajuan ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Pengajuan :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_pengajuan" placeholder="....." value="<?php echo $dt_ukbi->tgl_pengajuan ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Jenis pengajuan :</label>
            <div class="col-sm-10">
              <input type="text" name="jenis_pengajuan" class="form-control" placeholder="....." value="<?php echo $dt_ukbi->jenis_pengajuan ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Materi pengajuan :</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="materi_pengajuan" placeholder="....." rows="2"><?php echo $dt_ukbi->materi_pengajuan ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kategori peserta :</label>
            <div class="col-sm-10">
              <input type="text" name="kat_peserta" class="form-control" placeholder="....." value="<?php echo $dt_ukbi->kat_peserta ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Peserta :</label>
            <div class="col-sm-10">
              <input type="text" name="jum_peserta" class="form-control" placeholder="....." value="<?php echo $dt_ukbi->jum_peserta ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Hasil pengajuan :</label>
            <div class="col-sm-10">
              <input type="text" name="hasil_pengajuan" class="form-control" placeholder="....." value="<?php echo $dt_ukbi->hasil_pengajuan ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Lampiran :</label>
            <div class="col-sm-10">
              <input type="text" name="lampiran" class="form-control" placeholder="....." value="<?php echo $dt_ukbi->lampiran ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Keterangan :</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="ket" placeholder="....." rows="3"><?php echo $dt_ukbi->ket ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('ukbi') ?>">Kembali</a>
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
            kabkot:{
                validators: {
                    notEmpty: {
                        message: 'Pilih Kota'
                    }
                }
            },
            tgl_pengajuan: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal pengajuan harus diisi'
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
            }
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>