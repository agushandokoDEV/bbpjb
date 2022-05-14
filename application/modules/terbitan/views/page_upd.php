<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-book bg-bulet bg-info"></i> Terbitan</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pengembangan</li>
          <li class="active"><a href="<?php echo site_url('terbitan') ?>">Terbitan</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){ ?>
        <script>
        $(function(){
            $('#kat').val('<?php echo $dt_row->kat_terbitan ?>');
            $('#info_produk').val('<?php echo $dt_row->info_produk ?>');
            $('#bln_pelaksanaan').val('<?php echo $dt_row->bln_pelaksanaan ?>');
            
        });
        </script>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('terbitan/do_upd') ?>" enctype="multipart/form-data">
          <input type="hidden" name="id_key" value="<?php echo $dt_row->id_terbitan ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
            <div class="col-sm-10">
              <select class="form-control" name="kat_terbitan" id="kat">
                <option value="bahasa">Bahasa</option>
                <option value="sastra">Sastra</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Penulis</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="penulis" placeholder="....." value="<?php echo $dt_row->penulis ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Pelaksanaan</label>
            <div class="col-sm-5">
              <select class="form-control" name="bln_pelaksanaan" id="bln_pelaksanaan">
                  <option value="">Bulan</option>
                  <?php foreach($dt_bln as $key=>$val){ ?>
                  <option value="<?php echo $key ?>"><?php echo $val ?></option>
                  <?php }?>
              </select>
            </div>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="thn_pelaksanaan" placeholder="Tahun pelaksanaan" value="<?php echo $dt_row->thn_pelaksanaan ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">No. ISBN</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="no_isbn" placeholder="....." value="<?php echo $dt_row->no_isbn ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tahun Terbit</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="thn_terbit" placeholder="....." value="<?php echo $dt_row->thn_terbit ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi</label>
            <div class="col-sm-10">
              <textarea rows="3" class="form-control" name="deskripsi" placeholder="....."><?php echo $dt_row->deskripsi ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Info Produk</label>
            <div class="col-sm-10">
              <select class="form-control" name="info_produk" id="info_produk">
                <option value="">Pilih Info</option>
                <option value="0">Pusat</option>
                <option value="1">Balai/Kantor</option>
                <option value="2">Luar</option>
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
        <?php
        }else{
            echo alert('danger','Data tidak terdaftar..');
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
            penulis: {
                validators: {
                    notEmpty: {
                        message: 'Penulis harus diisi'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'Format data hanya alphabet'
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