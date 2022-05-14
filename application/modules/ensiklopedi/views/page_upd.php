<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-book bg-bulet bg-info"></i> Ensiklopedi</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pengembangan</li>
          <li class="active">Penyusunan</li>
          <li class="active"><a href="<?php echo site_url('ensiklopedi') ?>">Ensiklopedi</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){ ?>
        <script>
        $(function(){
            $('#id_kabkot').val('<?php echo $dt_row->id_kabkot ?>');
            $('#kat').val('<?php echo $dt_row->kat ?>');
            $('#lingkup').val('<?php echo $dt_row->lingkup ?>');
            $('#info_produk').val('<?php echo $dt_row->info_produk ?>');
        });
        </script>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('ensiklopedi/do_upd') ?>">
          <input type="hidden" name="id_key" value="<?php echo $dt_row->id_ensiklopedi ?>"/>
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
            <label for="inputEmail3" class="col-sm-2 control-label">Tgl. Pelaksanaan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_pelaksanaan" placeholder="....." value="<?php echo $dt_row->tgl_pelaksanaan ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
            <div class="col-sm-10">
              <select class="form-control" name="kat" id="kat">
                <option value="">-</option>
                <option value="kamus">Kamus</option>
                <option value="ensiklopedia">Ensiklopedia</option>
                <option value="tesaurus">Tesaurus</option>
                <option value="glosarium">Glosarium</option>
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
            <label for="inputEmail3" class="col-sm-2 control-label">Tim Redaksi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tim_redaksi" placeholder="....." value="<?php echo $dt_row->tim_redaksi ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Lingkup</label>
            <div class="col-sm-10">
              <select class="form-control" name="lingkup" id="lingkup">
                <option value="">-</option>
                <option value="daerah">Daerah</option>
                <option value="nasional">Nasional</option>
                <option value="internasional">Internasional</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Info Produk</label>
            <div class="col-sm-10">
                <select class="form-control" name="info_produk" id="info_produk">
                    <option value="">-</option>
                    <option value="0">Produk Pusat</option>
                    <option value="1">Produk Balai/Kantor</option>
                    <option value="2">Produk Luar</option>
                </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('ensiklopedi') ?>">Kembali</a>
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
                        message: 'Nama kegiatan harus diisi'
                    }
                }
            },
            kabkot: {
                validators: {
                    notEmpty: {
                        message: 'Kab/Kota harus diisi'
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
            }
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>