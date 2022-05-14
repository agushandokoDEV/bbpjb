<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-book bg-bulet bg-info"></i> Majalah</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pengembangan</li>
          <li class="active"><a href="<?php echo site_url('majalah') ?>">Majalah</a></li>
          <li class="active">Add</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('majalah/do_add') ?>">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
            <div class="col-sm-10">
                <select class="form-control" name="kat">
                    <option value="m">Majalah</option>
                </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="judul" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tim Redaksi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tim_redaksi" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Volume</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="volume" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">No. ISSN</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="no_issn" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Lingkup</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="lingkup" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Akreditasi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="akreditasi" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">penerbit</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="penerbit" placeholder="....."/>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="thn_terbit" placeholder="Tahun terbit"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
            <div class="col-sm-10">
              <textarea rows="3" class="form-control" name="ket" placeholder="....."></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Info Produk</label>
            <div class="col-sm-10">
                <select class="form-control" name="info_produk">
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
              <a class="btn btn-danger" href="<?php echo site_url('majalah') ?>">Kembali</a>
            </div>
          </div>
        </form>
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