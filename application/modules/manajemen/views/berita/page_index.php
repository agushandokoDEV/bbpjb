<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/jconfirm') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-sitemap bg-bulet bg-app"></i> Berita</h4>
        <div class="row">
            <div class="col-md-10">
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
                  <li class="active">Manajemen</li>
                  <li class="active">Berita</li>
                </ol>
            </div>
            <div class="col-md-2">
                <div class="pull-right"><a href="<?php echo site_url('manajemen/berita/add') ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a></div>
            </div>
        </div>
        <hr class="hr"/>
        <?php echo $this->session->flashdata('notif') ?>
    </div>    
    <div class="content">
        <?php foreach($dt_b as $b){ ?>
        <div id="del<?php echo $b->id_berita ?>" class="media" style="border-bottom: 1px dotted #ddd;padding-bottom: 5px;">
            <div class="media-left">
                <a onclick="loadimg('<?php echo $b->url_img ?>','<?php echo $b->judul ?>')" href="#loadimage"><img class="media-object img-thumbnail" src="<?php echo $b->url_img ?>"  data-holder-rendered="true" style="width: 150px;height: 150px;border-radius: 0;"></a>
            </div>
            <div class="media-body">
                <h3 class="media-heading"><?php echo $b->judul ?></h3>
                <p class="label label-danger" style="font-size: 10px;"><span class="glyphicon glyphicon-calendar"></span> <?php echo tanggal($b->tgl) ?></p>
                <p style="min-height:50px;margin-top: 5px;"><?php echo word_limiter($b->isi, 50); ?></p>
                <div class="hidex">
                    <a onclick="hapus('<?php echo $b->id_berita ?>')" href="#hapus" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                    <a href="<?php echo site_url('manajemen/berita/upd/'.$b->id_berita) ?>" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="mdl-img">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="mdl-jdl"></h4>
      </div>
      <img id="imgsrc" src="" style="width: 100%;"/>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
function loadimg(img,jdl){
    $('#mdl-img').modal('show');
    $('#mdl-jdl').text(jdl);
    $('#imgsrc').attr('src',img).css('width','100%');
}
function hapus(id){
    $.confirm({
        title: 'Hapus data',
        content: 'Anda yakin ???',
        confirmButton: 'Ya',
        icon: 'glyphicon glyphicon-trash',
        cancelButton: 'Batal',
        confirmButtonClass: 'btn-info',
        cancelButtonClass: 'btn-danger',
        confirm: function(){
            $.post('<?php echo site_url('manajemen/berita/hapus') ?>',{key:id},function(r){
                var n=jQuery.parseJSON(r);
                if(n.status == true){
                    $('#del'+id).remove();
                    $.alert({
                        title: 'OK!',
                        icon: 'glyphicon glyphicon-ok',
                        content: 'Data berhasil dihapus'
                    });
                }
            });
        }
    });
}
</script>
<?php $this->load->view('template/footer') ?>