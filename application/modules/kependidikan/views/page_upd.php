<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-database bg-bulet bg-danger"></i> Kependidikan</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Master Data</li>
          <li class="active"><a href="<?php echo site_url('kependidikan') ?>">Kependidikan</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){?>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('kependidikan/do_upd') ?>" enctype="multipart/form-data">
          <input type="hidden" name="id_key" value="<?php echo $dt_row->id_kependidikan ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">No</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="no" placeholder="....." value="<?php echo $dt_row->no ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Sekolah</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_sekolah" placeholder="....." value="<?php echo $dt_row->nama_sekolah ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kabupaten/Kota</label>
            <div class="col-sm-10">
              <select class="form-control" name="kabkot" id="kabkot">
                <option value="">-</option>
                <?php foreach($dt_kabkot as $k){ ?>
                <option value="<?php echo $k->id_kabkot ?>"><?php echo ucwords($k->nama_kota) ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="kec" placeholder="....." value="<?php echo $dt_row->kec ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Alamat lengkap</label>
            <div class="col-sm-10">
              <textarea name="alamat" rows="3" class="form-control" placeholder="....."><?php echo $dt_row->alamat ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Alamat sekolah</label>
            <div class="col-sm-10">
              <textarea name="alamat_sklh" rows="3" class="form-control" placeholder="....."><?php echo $dt_row->alamat_sklh ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
            <div class="col-sm-10">
              <select class="form-control" name="stts" id="stts_sek">
                <option value="1">Aktif</option>
                <option value="0">Tidak aktif</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('kependidikan') ?>">Kembali</a>
            </div>
          </div>
        </form>
        <script>
        $(function(){
            $('#kabkot').val('<?php echo $dt_row->id_kabkot ?>');
            $('#stts_sek').val('<?php echo $dt_row->stts_sekolah ?>');
        });
        </script>
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
            no: {
                validators: {
                    notEmpty: {
                        message: 'No kependidikan harus diisi'
                    },
                    numeric: {
                        message: 'harap masukan data berupa nomor'
                    }
                }
            },
            nama_sekolah: {
                validators: {
                    notEmpty: {
                        message: 'Nama sekolah harus diisi'
                    }
                }
            },
            kabkot: {
                validators: {
                    notEmpty: {
                        message: 'Kab/Kota sekolah harus diisi'
                    }
                }
            },
            jum_pengajar: {
                validators: {
                    notEmpty: {
                        message: 'Jumlah pengajar harus diisi'
                    },
                    numeric: {
                        message: 'harap masukan data berupa nomor'
                    }
                }
            },
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>