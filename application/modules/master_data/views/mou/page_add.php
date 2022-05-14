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
              <li class="active">Add</li>
            </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('master_data/kerja_sama_mou/do_add') ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Instansi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_instansi" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tgl. Kerja sama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_kerjasama" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tgl. Berakhir</label>
            <div class="col-sm-10">
              <input type="text" class="form-control dp" name="tgl_berakhir" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">No. Kerja sama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="no_kerjasama" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Perihal</label>
            <div class="col-sm-10">
              <textarea rows="2" class="form-control" name="perihal" placeholder="....."></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
            <div class="col-sm-10">
              <textarea rows="2" class="form-control" name="ket" placeholder="....."></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Ditandatangani oleh</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="ttd_a" placeholder="1."/>
            </div>
            <div class="col-sm-5">
              <select class="form-control" name="instansi_ttd_a">
                <option value="">-</option>
                <option value="1">Badan Pengembangan dan Pembinaan Bahasa</option>
                <option value="2">Badan Bahasa Jawa Barat</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label"></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="ttd_b" placeholder="2."/>
            </div>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="instansi_ttd_a" placeholder="....."/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('master_data/kerja_sama_mou') ?>">Kembali</a>
            </div>
          </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.dp').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    })
    .on('changeDate', function(e) {
        $('#form-add').formValidation('revalidateField', 'tgl_kerjasama');
        $('#form-add').formValidation('revalidateField', 'tgl_berakhir');
    });
    $('#form-add').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nama_instansi: {
                validators: {
                    notEmpty: {
                        message: 'Nama instansi harus diisi'
                    }
                }
            },
            tgl_kerjasama: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal kerja sama harus diisi'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        max: 'tgl_berakhir',
                        message: 'Format tanggal tidak valid'
                    }
                }
            },
            tgl_berakhir: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal berakhir sama harus diisi'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        min: 'tgl_kerjasama',
                        message: 'Format tanggal tidak valid'
                    }
                }
            },
            no_kerjasama:{
                validators: {
                    integer: {
                        message: 'Masukan no kerja sama data berupa angka'
                    }
                }
            },
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>