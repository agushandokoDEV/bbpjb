<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> Jurnal</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pengembangan</li>
          <li class="active"><a href="<?php echo site_url('jurnal') ?>">Jurnal</a></li>
          <li class="active">Add</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('jurnal/do_add') ?>">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="judul" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Pelaksanaan</label>
            <div class="col-sm-5">
              <select class="form-control" name="bln_pelaksanaan">
                  <option value="">Bulan</option>
                  <?php foreach($dt_bln as $key=>$val){ ?>
                  <option value="<?php echo $key ?>"><?php echo $val ?></option>
                  <?php }?>
              </select>
            </div>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="thn_pelaksanaan" placeholder="Tahun pelaksanaan"/>
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
            <label for="inputEmail3" class="col-sm-2 control-label">Penerbit</label>
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
              <a class="btn btn-danger" href="<?php echo site_url('jurnal') ?>">Kembali</a>
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
                        message: 'Judul tidak boleh kosong'
                    }
                }
            },
            penerbit: {
                validators: {
                    notEmpty: {
                        message: 'Penerbit tidak boleh kosong'
                    }
                }
            },
            bln_pelaksanaan: {
                validators: {
                    notEmpty: {
                        message: 'Bulan pelaksanaan tidak boleh kosong'
                    }
                }
            },
            thn_pelaksanaan: {
                validators: {
                    notEmpty: {
                        message: 'Tahun pelaksanaan tidak boleh kosong'
                    },
                    stringLength: {
                        min: 4,
                        max: 4,
                        message: 'format tahun 4 digit'
                    },
                    numeric: {
                        message: 'harap masukan data berupa angka'
                    }
                }
            },
            thn_terbit: {
                validators: {
                    notEmpty: {
                        message: 'Tahun terbit tidak boleh kosong'
                    },
                    stringLength: {
                        min: 4,
                        max: 4,
                        message: 'format tahun 4 digit'
                    },
                    numeric: {
                        message: 'harap masukan data berupa angka'
                    }
                }
            },
            no_issn:{
                validators: {
                    numeric: {
                        message: 'harap masukan data berupa angka'
                    }
                }
            },
            
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>