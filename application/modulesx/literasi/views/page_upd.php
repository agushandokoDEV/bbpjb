<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> Literasi</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pengembangan</li>
          <li class="active"><a href="<?php echo site_url('literasi') ?>">Literasi</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){?>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('literasi/do_upd') ?>">
          <input type="hidden" name="id_key" value="<?php echo $dt_row->id_literasi?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="judul" placeholder="....." value="<?php echo $dt_row->judul?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Penyusun</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="penyusun" placeholder="....." value="<?php echo $dt_row->penyusun?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tahun</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tahun" placeholder="....." value="<?php echo $dt_row->tahun?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tingkatan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tingkatan" placeholder="....." value="<?php echo $dt_row->tingkatan?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tema</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tema" placeholder="....." value="<?php echo $dt_row->tema?>"/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('literasi') ?>">Kembali</a>
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
            judul: {
                validators: {
                    notEmpty: {
                        message: 'Judul literasi tidak boleh kosong'
                    }
                }
            },
            tahun: {
                validators: {
                    stringLength: {
                        min: 4,
                        max: 4,
                        message: 'format tahun 4 digit'
                    },
                    numeric: {
                        message: 'data harus berupa angka',
                    }
                }
            }
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>