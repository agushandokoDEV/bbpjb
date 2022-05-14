<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-database bg-bulet bg-danger"></i> Pegawai</h4>
            <ol class="breadcrumb">
              <li><a href="<?php echo site_url('app/home') ?>">Home</a></li>
              <li class="active">Master Data</li>
              <li class="active"><a href="<?php echo site_url('master_data/kerja_sama_mou') ?>">Kerja sama (MOU)</a></li>
              <li class="active">Update</li>
            </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row){ ?>
        <script>
        $(function(){
           $('#instansi_ttd_a').val('<?php echo $dt_row->instansi_ttd_a ?>'); 
        });
        </script>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('master_data/kerja_sama_mou/do_upd') ?>" enctype="multipart/form-data">
          <input type="hidden" name="id_key" value="<?php echo $dt_row->id_kerjasama ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Instansi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_instansi" placeholder="....." value="<?php echo $dt_row->nama_instansi ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tgl. Kerja sama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_kerjasama" placeholder="....." value="<?php echo $dt_row->tgl_kerjasama ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tgl. Berakhir</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_berakhir" placeholder="....." value="<?php echo $dt_row->tgl_berakhir ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">No. Kerja sama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="no_kerjasama" placeholder="....." value="<?php echo $dt_row->no_kerjasama ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Perihal</label>
            <div class="col-sm-10">
              <textarea rows="2" class="form-control" name="perihal" placeholder="....."><?php echo $dt_row->perihal ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
            <div class="col-sm-10">
              <textarea rows="2" class="form-control" name="ket" placeholder="....."><?php echo $dt_row->ket ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Ditandatangani oleh</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="ttd_a" placeholder="1." value="<?php echo $dt_row->ttd_a ?>"/>
            </div>
            <div class="col-sm-5">
              <select class="form-control" name="instansi_ttd_a" id="instansi_ttd_a">
                <option value="">-</option>
                <option value="1">Badan Pengembangan dan Pembinaan Bahasa</option>
                <option value="2">Badan Bahasa Jawa Barat</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label"></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="ttd_b" placeholder="2." value="<?php echo $dt_row->ttd_b ?>"/>
            </div>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="instansi_ttd_b" placeholder="....." value="<?php echo $dt_row->instansi_ttd_b ?>"/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('master_data/kerja_sama_mou') ?>">Kembali</a>
            </div>
          </div>
        </form>
        <?php
        }else{
            alert('danger','Data tidak ditemukan...');
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
            nama: {
                validators: {
                    notEmpty: {
                        message: 'Nama MOU harus diisi'
                    }
                }
            },
            tgl: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal MOU harus diisi'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Format tanggal tidak valid'
                    }
                }
            }
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>