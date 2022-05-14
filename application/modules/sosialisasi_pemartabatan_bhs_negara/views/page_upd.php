<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> Sosialisasi Pemartabatan bahasa Negara</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pembinaan</li>
          <li class="active"><a href="<?php echo site_url('sosialisasi_pemartabatan_bhs_negara') ?>">Sosialisasi Pemartabatan bahasa Negara</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){?>
        <script>
        $(function(){
            $('#kabkot').val('<?php echo $dt_row->id_kabkot ?>');
        });
        </script>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('sosialisasi_pemartabatan_bhs_negara/do_upd') ?>">
          <input type="hidden" name="id" value="<?php echo $dt_row->id_sosial_p_bhs_negara ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kota :</label>
            <div class="col-sm-10">
              <select name="id_kabkot" id="kabkot" class="form-control">
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
              <input type="text" class="form-control" name="judul" placeholder="....." value="<?php echo $dt_row->judul ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Waktu</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="waktu" placeholder="....." value="<?php echo $dt_row->waktu ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tempat Sosialisasi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tmpt_sosialisasi" placeholder="....." value="<?php echo $dt_row->tmpt_sosialisasi ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Peserta Sosialisasi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="peserta_sosialisasi" placeholder="....." value="<?php echo $dt_row->peserta_sosialisasi ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Panitia Daerah</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="panitia_daerah" placeholder="....." value="<?php echo $dt_row->panitia_daerah ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Ranah</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="ranah" placeholder="....." value="<?php echo $dt_row->ranah ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Narasumber</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nara_sumber" placeholder="....." value="<?php echo $dt_row->nara_sumber ?>"/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('sosialisasi_pemartabatan_bhs_negara') ?>">Kembali</a>
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
        $('#form-add').formValidation('revalidateField', 'waktu');
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
                        message: 'Judul sosialisasi harus diisi'
                    }
                }
            },
            id_kabkot: {
                validators: {
                    notEmpty: {
                        message: 'Kab/Kota harus diisi'
                    }
                }
            },
            waktu: {
                validators: {
                    notEmpty: {
                        message: 'waktu pengajuan harus diisi'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Format waktu tidak valid'
                    }
                }
            },
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>