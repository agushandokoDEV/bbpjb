<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-sitemap bg-bulet bg-app"></i> Berita</h4>
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
                  <li class="active">Manajemen</li>
                  <li class="active"><a href="<?php echo site_url('manajemen/berita') ?>">Berita</a></li>
                  <li class="active">Add</li>
                </ol>
            </div>
        </div>
        <hr class="hr"/>
    </div>    
    <div class="content">
        <?php if($dt_row){ ?>
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('manajemen/berita/do_upd') ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Judul berita</label>
            <div class="col-sm-10">
              <input type="hidden" name="id_key" value="<?php echo $dt_row->id_berita ?>"/>
              <input type="text" class="form-control" name="judul" placeholder="....." value="<?php echo $dt_row->judul ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Isi berita</label>
            <div class="col-sm-10">
              <textarea name="isi" rows="3" class="form-control" placeholder="....."><?php echo $dt_row->isi ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Foto</label>
            <div class="col-sm-3">
              <select id="ops" name="foto" class="form-control" onchange="showupl(this.value)">
                <option value="0">Upload</option>
                <option value="1">Url</option>
              </select>
            </div>
            <div class="col-sm-7">
              <input id="uplimg" type="file" class="form-control" name="uplimg" placeholder="....."/>
              <input id="urlimg" type="url" class="form-control" name="urlimg" placeholder="Url gambar..." value="<?php echo $dt_row->url_img ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
              <?php if($dt_row->foto != null){ ?>
              <img src="<?php echo site_url('common/album/slide/thumb/'.$dt_row->foto) ?>" class="img-thumbnail no-radius"/>
              <?php }else{?>
              <img src="<?php echo $dt_row->url_img ?>" class="img-thumbnail no-radius"/>
              <?php }?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button id="btn-sub" type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('manajemen/berita') ?>">Kembali</a>
            </div>
          </div>
        </form>
        <?php
        }else{
            echo alert('danger','Data tidak ditemukan....');
        }
        ?>
    </div>
</div>
<script>
<?php if($dt_row->foto != null){ ?>
$('#ops').val('0');
$('#uplimg').show();
$('#urlimg').hide();
$('#urlimg').val('');
<?php }else{?>
$('#ops').val('1');
$('#urlimg').show();
$('#uplimg').hide();
<?php }?>
function showupl(val){
    if(val == '0'){
        $('#uplimg').show();
        $('#urlimg').hide();
        $('#form-add').formValidation('revalidateField', 'uplimg');
    }else if(val == '1'){
        $('#uplimg').hide();
        $('#urlimg').show();
        $('#form-add').formValidation('revalidateField', 'urlimg');
    }else{
        $('#uplimg').hide();
        $('#urlimg').hide();
    }
    //$('#urlimg').val('');
    $('.help-block').hide();
}
$(document).ready(function() {
    $('#form-add').formValidation({
        framework: 'bootstrap',
        
        fields: {
            judul: {
                validators: {
                    notEmpty: {
                        message: 'Judul berita harus diisi'
                    }
                }
            },
            isi: {
                validators: {
                    notEmpty: {
                        message: 'Isi berita harus diisi'
                    }
                }
            },
            foto: {
                validators: {
                    notEmpty: {
                        message: 'Harap pilih sumber foto'
                    },
                }
            },
            uplimg: {
                validators: {
                    file: {
                        extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        maxSize: 2097152,   // 2048 * 1024
                        message: 'haraf masukan foto/image'
                    }
                }
            },
            urlimg: {
                validators: {
                    regexp: {
                        regexp: /\.(gif|jpg|jpeg|tiff|png)$/i,
                        message: 'Harap akhiri url dengan (.jpg, .jpeg .png) contoh : www.domain.com/nama_gambar.jpg'
                    },
                    uri: {
                        message: 'URL tidak valid'
                    }
                }
            }
        }
    })
    .on('success.form.fv', function(e) {
        // Prevent form submission
        //e.preventDefault();
        //console.log(e.target);        
        var $form = $(e.target);
        //var bar = $('#progress-bar-xl');
        //var percent = $('#percent-xl');
        //var status = $('#status');
        var loading=$('#loading-tf');
        $('#btn-sub').removeClass('btn-primary').addClass('btn-default').html('Loading...<?php echo loading('a'); ?>');
    });
});
</script>
<?php $this->load->view('template/footer') ?>