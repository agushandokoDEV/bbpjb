<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<?php $this->load->view('vendor/datepicker') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-info"></i> Karya Ilmiah</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Pengembangan</li>
          <li class="active"><a href="<?php echo site_url('karyailmiah') ?>">Karya Ilmiah</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>
    
    <div class="content">
        <?php if($dt_row != null){?>
        <script>
        $(function(){
            $('#jenis').val('<?php echo $dt_row->jenis ?>');
            $('#bln_pelaksanaan').val('<?php echo $dt_row->bln_pelaksanaan ?>');
        });
        </script>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('karyailmiah/do_upd') ?>">
          <input type="hidden" name="id" value="<?php echo $dt_row->id_karyailmiah ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Unit/Satuan Kerja</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="satuan_kerja" placeholder="....." value="balai bahasa provinsi jawa barat" readonly/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Jenis Karya Ilmiah</label>
            <div class="col-sm-10">
              <select class="form-control" name="jenis" id="jenis">
                <option value="skripsi">SKRIPSI</option>
                <option value="tesis">TESIS</option>
                <option value="disertasi">DISERTASI</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="judul" placeholder="....." value="<?php echo $dt_row->judul ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Penulis</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="penulis" placeholder="....." value="<?php echo $dt_row->penulis ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Pelaksanaan</label>
            <div class="col-sm-5">
              <select class="form-control" name="bln_pelaksanaan" id="bln_pelaksanaan">
                  <option value="">Bulan</option>
                  <?php foreach($dt_bln as $key=>$val){ ?>
                  <option value="<?php echo $key ?>"><?php echo $val ?></option>
                  <?php }?>
              </select>
            </div>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="tahun" placeholder="Tahun pelaksanaan" value="<?php echo $dt_row->tahun ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Program Studi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="prodi" placeholder="....." value="<?php echo $dt_row->prodi ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Perguruan Tinggi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="perguruan_t" placeholder="....." value="<?php echo $dt_row->perguruan_t ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Abstraksi</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="abstraksi" rows="3" placeholder="....."><?php echo $dt_row->abstraksi ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('karyailmiah') ?>">Kembali</a>
            </div>
          </div>
          <?php
        }else{
            echo alert('danger','Data tidak ditemukan..');
        }
        ?>
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
        $('#form-add').formValidation('revalidateField', 'tgl_mulai');
        $('#form-add').formValidation('revalidateField', 'tgl_selesai');
    });
    $('#form-add').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            jenis: {
                validators: {
                    notEmpty: {
                        message: 'Jenis karya ilmiah tidak boleh kosong'
                    }
                }
            },
            judul: {
                validators: {
                    notEmpty: {
                        message: 'Judul karya ilmiah tidak boleh kosong'
                    }
                }
            },
            penulis: {
                validators: {
                    notEmpty: {
                        message: 'Penulis tidak boleh kosong'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'Format data hanya alphabet'
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
                    notEmpty: {
                        message: 'Tahun tidak boleh kosong'
                    },
                    numeric: {
                        message: 'harap masukan data berupa angka'
                    }
                }
            }
        }
    });
});
</script>
<?php $this->load->view('template/footer') ?>