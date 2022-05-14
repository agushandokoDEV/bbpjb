<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/jconfirm') ?>
<script src="<?php echo site_url('assets/vendor/upload/jquery.form.min.js') ?>"></script>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-picture-o bg-bulet bg-app"></i> Album Kegiatan</h4>
        <div class="row">
            <div class="col-md-8">
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
                  <li class="active">Pembinaan</li>
                  <li class="active"><a href="<?php echo site_url('kegiatan') ?>">Kegiatan</a></li>
                  <li class="active">Album kegiatan <?php echo $dt_keg->nama_keg ?></li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="pull-right">
                    <a href="<?php echo site_url('kegiatan') ?>" class="btn btn-danger btn-sm">Kembali</a>
                    <button onclick="get_mdl_upl()" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Tambahkan Foto Kegiatan</button>
                    </div>
            </div>
        </div>
        <hr class="hr"/>
    </div>
    <div class="content">
        <div class="text-center" id="loading_alb"></div>
        <div id="load-img">
            <div class="row">
                <?php foreach($dt_alb as $alb){ ?>
                <div class="col-md-3">
                    <div class="thumbnail"  style="border-radius: 3px;">
                      <img src="<?php echo site_url('common/album/kegiatan/thumb/'.$alb->file_img) ?>" style="height: 200px;"/>
                      <div class="caption">
                        <p><?php echo $alb->jdl_keg ?></p>
                        <p>
                        <button title="Edit foto" onclick="get_mdl_upd('<?php echo $alb->id_album_keg ?>','<?php echo $alb->file_img ?>','<?php echo $alb->jdl_keg ?>')" class="btn btn-sm btn-info" role="button"><span class="glyphicon glyphicon-pencil"></span></button>
                        <button title="Hapus foto" onclick="hapus('<?php echo $alb->id_album_keg ?>','<?php echo $alb->file_img ?>')" class="btn btn-sm btn-danger" role="button"><span class="glyphicon glyphicon-trash"></span></button>
                        </p>
                      </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="mdl-upl">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-upload"></span> Upload foto album</h4>
      </div>
      <div class="modal-body">
        <form id="f" method="post" action="" enctype="multipart/form-data">
            <span id="id_key"></span>
            <span id="fname"></span>
            <input type="hidden" name="isfile" id="isfile" value="0"/>
            <div class="form-group">
                <label for="exampleInputEmail1">Tentang foto</label>
                <input type="text" class="form-control" id="jdl_keg" name="jdl_keg" placeholder="Tentang foto">
                <input type="hidden" name="id_keg" value="<?php echo $dt_keg->id_kegiatan ?>"/>
            </div>
            <div class="form-group">
                <div class="uploadFile upl-ico-cam">
                    <input type="file" name="foto" id="foto" class="custom-file-input" original-title="Change Cover Picture">
                </div>
            </div>
            <div id="v_img"></div>
        <div id="percent-upl"></div>
      </div>
      <div class="modal-footer">
        <button onclick="get_reset()" type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-sm btn-success">Upload</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
var percent = $('#percent-upl');
var load_img=$('#load-img');
var loading_img=$('#loading_alb');
$(document).ready(function(){
    //get_album();
    $("#foto").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        $("#v_img").html('<?php echo loading() ?>');
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
                $('#isfile').val('1');
                $("#v_img").html('<img class="img-thumbnail" src="'+this.result+'" style="width: 100%;height: 300px;"/>');
            }
        }
    });
    
    $('#f').ajaxForm({
        beforeSend: function() {
            var percentVal = '0%';
            //bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            //bar.width(percentVal);
            if(percentVal >= 100){
                $('#percent-upl').hide();
            }
            percent.html('<div class="progress"><div id="myprg" class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: '+percentVal+';">'+percentVal+'</div></div>');
            //console.log(percentVal, position, total);
        },
        complete: function(xhr) {
            $('.progress').remove();
            var obj=jQuery.parseJSON(xhr.responseText);
            if(obj.status == '1'){
                $('#f')[0].reset();
                $('#mdl-upl').modal('hide');
                get_album();
            }else{
                percent.html('<p class="error">*'+obj.error+'</p>');
            }
            console.log(obj);
        }
    });
});
function get_album(){
    loading_img.html('<?php echo loading() ?>');
    $.post('<?php echo site_url('kegiatan/album/load_album') ?>',{id_keg:'<?php echo $dt_keg->id_kegiatan ?>'},function(s){
        load_img.html(s);
        loading_img.html('');
    })
    .fail(function(){
        load_img.html('<p class="error">*Terjadi kesalahan sistem</p>')
    });
}
function get_mdl_upl(){
    $('#f').attr('action','<?php echo site_url('kegiatan/album/do_add') ?>');
    $("#v_img").html('');
    $('.error').html('');
    $('#id_key').html('');
    $('#fname').html('');
    $('#f')[0].reset();
    $('#mdl-upl').modal('show');
}
function get_mdl_upd(id,f,des){
    var p='<?php echo site_url('common/album/kegiatan/thumb') ?>/'+f;
    $('#f').attr('action','<?php echo site_url('kegiatan/album/do_upd') ?>');
    $('#id_key').html('<input type="hidden" name="id_key" value="'+id+'"/>');
    $('#fname').html('<input type="hidden" name="fname" value="'+f+'"/>');
    $("#v_img").html('<img class="img-thumbnail" src="'+p+'" style="width: 100%;height: 300px;"/>');
    $("#jdl_keg").val(des);
    $('#mdl-upl').modal('show');
}
function get_reset(){
    $('#f')[0].reset();
}
function hapus(id,foto){
    $.confirm({
        title: 'Hapus foto',
        content: 'Anda yakin akan hapus foto '+foto+' ???',
        confirmButton: 'Ya',
        icon: 'glyphicon glyphicon-trash',
        cancelButton: 'Batal',
        confirmButtonClass: 'btn-info',
        cancelButtonClass: 'btn-danger',
        confirm: function(){
            $.post('<?php echo site_url('kegiatan/album/hapus') ?>',{key:id,fname:foto},function(r){
                var n=jQuery.parseJSON(r);
                if(n.status == true){
                    get_album();
                    $.alert({
                        title: 'OK!',
                        icon: 'glyphicon glyphicon-ok',
                        content: 'Foto berhasil dihapus'
                    });
                }
            });
        }
    });
}
</script>
<?php $this->load->view('template/footer') ?>