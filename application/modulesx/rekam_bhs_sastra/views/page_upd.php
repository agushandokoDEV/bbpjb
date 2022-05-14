<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-book bg-bulet bg-info"></i> Perekaman Bahasa dan Ekspresi Sastra</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pengembangan</li>
          <li class="active"><a href="<?php echo site_url('rekam_bhs_sastra') ?>">Perekaman Bahasa dan Ekspresi Sastra</a></li>
          <li class="active">Add</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){ ?>
        <script>
        $(function(){
            $('#genre').val('<?php echo $dt_row->genre ?>');
        });
        </script>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('rekam_bhs_sastra/do_upd') ?>" enctype="multipart/form-data">
          <input type="hidden" name="id_key" value="<?php echo $dt_row->id_rekam_bhs ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="judul" placeholder="....." value="<?php echo $dt_row->judul ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl" placeholder="....." value="<?php echo $dt_row->tgl ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Lokasi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="lokasi" placeholder="....." value="<?php echo $dt_row->lokasi ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Narasumber</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nara_sumber" placeholder="....." value="<?php echo $dt_row->nara_sumber ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Genre</label>
            <div class="col-sm-10">
              <select class="form-control" name="genre" id="genre">
                <option value="a">A</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('rekam_bhs_sastra') ?>">Kembali</a>
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
        $('#form-add').formValidation('revalidateField', 'tgl');
    });
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
                        message: 'Judul perekaman harus diisi'
                    }
                }
            },
            tgl: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal perekaman harus diisi'
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