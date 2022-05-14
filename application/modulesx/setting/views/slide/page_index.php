<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/jconfirm') ?>
<script src="<?php echo site_url('assets/vendor/upload/jquery.form.min.js') ?>"></script>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-sitemap bg-bulet bg-app"></i> Foto Slide</h4>
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
                  <li class="active">Setting</li>
                  <li class="active">Foto Slide</li>
                </ol>
            </div>
        </div>
        <hr class="hr"/>
        <?php echo $this->session->flashdata('notif') ?>
    </div>    
    
    <div class="content">
        <form id="f" method="post" action="<?php echo site_url('setting/foto_slide/uploading') ?>" enctype="multipart/form-data">
            <div class="form-group">
                <div class="uploadFile upl-ico-cam">
                    <input type="file" name="foto" id="foto" class="custom-file-input" original-title="Change Cover Picture">
                </div>
            </div>
            
        </form>
        <div id="percent-upl"></div>
        <hr />
        <div class="row" id="load-img"></div>
    </div>
</div>
<script>
var percent = $('#percent-upl');
var load_img=$('#load-img');

$(document).ready(function() {
    get_slide();
    $("#foto").on("change", function(){
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
                    get_slide();
                }else{
                    percent.html('<p class="error">*File terlalu besar</p>');
                }
                console.log(obj);
            }
        }).submit();
    });
});
function get_slide(){
    $.post('<?php echo site_url('setting/foto_slide/get_slide') ?>',function(s){
        load_img.html(s);
    })
    .fail(function(){
        load_img.html('<p class="error">*Terjadi kesalahan sistem</p>')
    });
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
            $.post('<?php echo site_url('setting/foto_slide/hapus') ?>',{key:id,fname:foto},function(r){
                var n=jQuery.parseJSON(r);
                if(n.status == true){
                    get_slide();
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