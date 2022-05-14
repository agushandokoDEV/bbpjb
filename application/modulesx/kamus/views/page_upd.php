<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-book bg-bulet bg-info"></i> Kamus</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Manajemen</li>
          <li class="active"><a href="<?php echo site_url('kamus') ?>">Kamus</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){ ?>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('kamus/do_upd') ?>">
          <input type="hidden" name="id_key" value="<?php echo $dt_row->id_kamus ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="judul" placeholder="....." value="<?php echo $dt_row->judul ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tahun</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tahun" placeholder="....." value="<?php echo $dt_row->tahun ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Jenis</label>
            <div class="col-sm-10">
              <select class="form-control" name="jenis" id="jns">
                <option value="">Pilih Jenis</option>
                <option value="1">1</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Penyusun</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="penyusun" placeholder="....." value="<?php echo $dt_row->penyusun ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Sasaran</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sasaran" placeholder="....." value="<?php echo $dt_row->sasaran ?>"/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('kamus') ?>">Kembali</a>
            </div>
          </div>
        </form>
        <script>
            $(function(){
                $('#jns').val('<?php echo $dt_row->jenis ?>');
            });
        </script>
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
            judul: {
                validators: {
                    notEmpty: {
                        message: 'Nama kegiatan harus diisi'
                    }
                }
            },
            tahun: {
                validators: {
                    notEmpty: {
                        message: 'Tahun harus diisi'
                    },
                    numeric: {
                            message: 'masukan data berupa nomor',
                    },
                    stringLength: {
                        min: 4,
                        max: 4,
                        message: 'format tahun harus 4 digit'
                    },
                }
            },
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>