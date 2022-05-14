<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-book bg-bulet bg-info"></i> Terbitan</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pengembangan</li>
          <li class="active"><a href="<?php echo site_url('terbitan') ?>">Terbitan</a></li>
          <li class="active">Add</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('terbitan/do_add') ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
            <div class="col-sm-10">
              <select class="form-control" name="kat_terbitan">
                <option value="bahasa">Bahasa</option>
                <option value="sastra">Sastra</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Penulis</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="penulis" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">No. ISBN</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="no_isbn" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tahun Terbit</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="thn_terbit" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi</label>
            <div class="col-sm-10">
              <textarea rows="3" class="form-control" name="deskripsi" placeholder="....."></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Info Produk</label>
            <div class="col-sm-10">
              <select class="form-control" name="info_produk">
                <option value="">Pilih Info</option>
                <option value="pusat">Pusat</option>
                <option value="balai">Balai/Kantor</option>
                <option value="luar">Luar</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('terbitan') ?>">Kembali</a>
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
            penulis: {
                validators: {
                    notEmpty: {
                        message: 'Penulis harus diisi'
                    }
                }
            },
            no_isbn: {
                validators: {
                    notEmpty: {
                        message: 'No. ISBN harus diisi'
                    },
                    numeric: {
                        message: 'harap masukan data berupa angka'
                    }
                }
            },
            thn_terbit: {
                validators: {
                    notEmpty: {
                        message: 'Tahun terbit harus diisi'
                    },
                    stringLength: {
                        min: 4,
                        max: 4,
                        message: 'Format tahun tidak valid, gunakan 4 digit'
                    },
                    numeric: {
                        message: 'harap masukan data berupa angka'
                    }
                }
            }
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>