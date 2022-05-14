<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> Lomba Kebahasaan dan Kesastraan</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pembinaan</li>
          <li class="active"><a href="<?php echo site_url('lomba_bhs_sastra') ?>">Lomba Kebahasaan dan Kesastraan</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){?>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('lomba_bhs_sastra/do_upd') ?>">
          <input type="hidden" name="id" value="<?php echo $dt_row->id_lomba_bhs_sastra ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Lomba</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nm_lomba" placeholder="....." value="<?php echo $dt_row->nm_lomba ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tempat Lomba</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tmpt_lomba" placeholder="....." value="<?php echo $dt_row->tmpt_lomba ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Peserta Lomba</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="peserta_lomba" placeholder="....." value="<?php echo $dt_row->peserta_lomba ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
            <div class="col-sm-10">
              <textarea rows="3" class="form-control" name="ket_lomba" placeholder="....."><?php echo $dt_row->ket_lomba ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('lomba_bhs_sastra') ?>">Kembali</a>
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
            nm_lomba: {
                validators: {
                    notEmpty: {
                        message: 'Nama lomba harus diisi'
                    }
                }
            }
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>