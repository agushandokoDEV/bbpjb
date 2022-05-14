<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-book bg-bulet bg-info"></i> Jambore</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pengembangan</li>
          <li class="active"><a href="<?php echo site_url('jambore') ?>">Jambore</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){?>
        <script>
        $(function(){
            $('#jtam').val('<?php echo $dt_row->jenis_tampilan ?>');
        });
        </script>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('jambore/do_upd') ?>">
          <input type="hidden" name="id" value="<?php echo $dt_row->id_jambore ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Waktu</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="waktu" placeholder="....." value="<?php echo $dt_row->waktu ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">utusan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="utusan" placeholder="....." value="<?php echo $dt_row->utusan ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tempat</label>
            <div class="col-sm-10">
              <textarea rows="2" class="form-control" name="tempat" placeholder="....."><?php echo $dt_row->tempat ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Panitia</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_panitia" placeholder="....." value="<?php echo $dt_row->nama_panitia ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Jenis Tampilan</label>
            <div class="col-sm-10">
              <select name="jenis_tampilan" class="form-control" id="jtam">
                <option value="">-</option>
                <option value="a">A</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('jambore') ?>">Kembali</a>
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
            waktu: {
                validators: {
                    notEmpty: {
                        message: 'Waktu jambore harus diisi'
                    }
                }
            }
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>