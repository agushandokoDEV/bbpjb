<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> Jurnal</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pengembangan</li>
          <li class="active"><a href="<?php echo site_url('jurnal') ?>">Jurnal</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){?>
        <script>
        $(function(){
            $('#kat').val('<?php echo $dt_row->kat ?>');
            $('#info_produk').val('<?php echo $dt_row->info_produk ?>');
        });
        </script>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('jurnal/do_upd') ?>">
          <input type="hidden" name="id" value="<?php echo $dt_row->id_majalah ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
            <div class="col-sm-10">
                <select class="form-control" name="kat" id="kat">
                    <option value="m">jurnal</option>
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
              <textarea rows="3" class="form-control" name="tim_redaksi" placeholder="....."><?php echo $dt_row->tim_redaksi ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Volume</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="volume" placeholder="....." value="<?php echo $dt_row->volume ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">No. ISSN</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="no_issn" placeholder="....." value="<?php echo $dt_row->no_issn ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Lingkup</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="lingkup" placeholder="....." value="<?php echo $dt_row->lingkup ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Akreditasi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="akreditasi" placeholder="....." value="<?php echo $dt_row->akreditasi ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">penerbit</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="penerbit" placeholder="....." value="<?php echo $dt_row->penerbit ?>"/>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="thn_terbit" placeholder="Tahun terbit" value="<?php echo $dt_row->thn_terbit ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
            <div class="col-sm-10">
              <textarea rows="3" class="form-control" name="ket" placeholder="....."><?php echo $dt_row->ket ?></textarea>
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
              <a class="btn btn-danger" href="<?php echo site_url('jurnal') ?>">Kembali</a>
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
    $('#form-add').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            kat: {
                validators: {
                    notEmpty: {
                        message: 'Kategori tidak boleh kosong'
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
            }
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>