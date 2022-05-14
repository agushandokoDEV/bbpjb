<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> Pelatihan dan Peningkatan Mutu Pegawai</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pembinaan</li>
          <li class="active"><a href="<?php echo site_url('pelatihan_mutu_pegawai') ?>">Pelatihan dan Peningkatan Mutu Pegawai</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){?>
        <script>
        $(function(){
            $('#id_kabkot').val('<?php echo $dt_row->id_kabkot ?>');
        });
        </script>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('pelatihan_mutu_pegawai/do_upd') ?>">
          <input type="hidden" name="id" value="<?php echo $dt_row->id_pelatihan_mutu ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kota :</label>
            <div class="col-sm-10">
              <select name="id_kabkot" id="id_kabkot" class="form-control">
                <option value="">Pilih</option>
                <?php foreach($dt_kabkot as $k){ ?>
                <option value="<?php echo $k->id_kabkot ?>"><?php echo ucwords($k->nama_kota) ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Pelatihan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nm_pelatihan" placeholder="....." value="<?php echo $dt_row->nm_pelatihan ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Lembaga</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nm_lembaga" placeholder="....." value="<?php echo $dt_row->nm_lembaga ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Peserta</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="jum_peserta" placeholder="....." value="<?php echo $dt_row->jum_peserta ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Latihan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_latihan" placeholder="....." value="<?php echo $dt_row->tgl_latihan ?>"/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('pelatihan_mutu_pegawai') ?>">Kembali</a>
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
        $('#form-add').formValidation('revalidateField', 'tgl_latihan');
    });
    $('#form-add').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nm_pelatihan: {
                validators: {
                    notEmpty: {
                        message: 'Nama pembelajar naskah harus diisi'
                    }
                }
            },
            tgl_latihan: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal latihan harus diisi'
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