<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-book bg-bulet bg-info"></i> Bahan Ajar</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Manajemen</li>
          <li class="active"><a href="<?php echo site_url('bahan_ajar') ?>">Bahan Ajar</a></li>
          <li class="active">Add</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('bahan_ajar/do_add') ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="judul" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
            <div class="col-sm-10">
              <select class="form-control" name="kat">
                <option value="">-</option>
                <option value="a">A</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Penyusun</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_penyusun" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tahun Penyusun</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="thn_penyusun" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tingkat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tingkat" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Sasaran</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sasaran" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tema</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tema" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Sumber Bahan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sumber_bahan" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('bahan_ajar') ?>">Kembali</a>
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
            judul: {
                validators: {
                    notEmpty: {
                        message: 'Judul harus diisi'
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
            }
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>