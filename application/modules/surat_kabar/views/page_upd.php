<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> Surat Kabar</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pembinaan</li>
          <li class="active"><a href="<?php echo site_url('surat_kabar') ?>">Surat Kabar</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){?>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('surat_kabar/do_upd') ?>">
          <input type="hidden" name="id_key" value="<?php echo $dt_row->id_surat_kbr ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Penulis</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="penulis" placeholder="....." value="<?php echo $dt_row->penulis ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Judul tulisan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="jdl_tulisan" placeholder="....." value="<?php echo $dt_row->jdl_tulisan ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tgl. Pelaksanaan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_pelaksanaan" placeholder="....." value="<?php echo $dt_row->tgl_pelaksanaan ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tgl. Terbit</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_terbit" placeholder="....." value="<?php echo $dt_row->tgl_terbit ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama surat kabar</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nm_surat_kbr" placeholder="....." value="<?php echo $dt_row->nm_surat_kbr ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Rubrik</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="rubrik" placeholder="....." value="<?php echo $dt_row->rubrik ?>"/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('surat_kabar') ?>">Kembali</a>
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
    $('.dp').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    })
    .on('changeDate', function(e) {
        $('#form-add').formValidation('revalidateField', 'tgl_terbit');
        $('#form-add').formValidation('revalidateField', 'tgl_pelaksanaan');
    });
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
            jdl_tulisan: {
                validators: {
                    notEmpty: {
                        message: 'Judul tulisan harus diisi'
                    }
                }
            },
            tgl_pelaksanaan: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal pelaksanaan tidak boleh kosong'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Format tanggal tidak valid'
                    }
                }
            },
            tgl_terbit: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal terbit harus diisi'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Format tanggal tidak valid'
                    }
                }
            },

        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>