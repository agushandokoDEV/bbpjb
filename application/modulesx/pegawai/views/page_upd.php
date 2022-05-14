<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> Pegawai</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Master Data</li>
          <li class="active"><a href="<?php echo site_url('pegawai') ?>">Pegawai</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){?>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('pegawai/do_upd') ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nip" placeholder="....." value="<?php echo $dt_row->nip ?>" readonly/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Pegawai</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_peg" placeholder="....." value="<?php echo $dt_row->nama ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal lahir</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="ttl" placeholder="....." value="<?php echo $dt_row->tgl_lahir ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="email" placeholder="....." value="<?php echo $dt_row->email ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">No Tlp</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="no_tlp" placeholder="....." value="<?php echo $dt_row->no_tlp ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-10">
              <textarea name="alamat" rows="3" class="form-control" placeholder="....."><?php echo $dt_row->alamat ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Pangkat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="pangkat" placeholder="....." value="<?php echo $dt_row->pangkat ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Golongan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="gol" placeholder="....." value="<?php echo $dt_row->gol ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Penata</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="penata" placeholder="....." value="<?php echo $dt_row->penata ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Jabatan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="jabatan" placeholder="....." value="<?php echo $dt_row->jabatan ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Foto</label>
            <div class="col-sm-10">
              <input type="hidden" name="file_img" value="<?php echo $dt_row->foto; ?>"/>
              <input type="file" class="form-control" name="foto" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
              <img class="img-thumbnail" src="<?php echo site_url('common/album/pegawai/'.$dt_row->foto) ?>" style="height: 100px;;"/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('pegawai') ?>">Kembali</a>
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
    $('.dp').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    })
    .on('changeDate', function(e) {
        $('#form-add').formValidation('revalidateField', 'ttl');
    });
    $('#form-add').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nama_peg: {
                validators: {
                    notEmpty: {
                        message: 'Nama pegawai harus diisi'
                    }
                }
            },
            email: {
                validators: {
                    emailAddress: {
                        message: 'Email tidak valid'
                    }
                }
            },
            foto: {
                validators: {
                    file: {
                        extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        maxSize: 2097152,   // 2048 * 1024
                        message: 'haraf masukan foto/image'
                    }
                }
            },
            ttl: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal lahir harus diisi'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Format tanggal tidak valid'
                    }
                }
            },
            no_tlp: {
                validators: {
                    numeric: {
                        message: 'harap masukan nomor'
                    }
                }
            }
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>