<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <h4 class="title"><i class="fa fa-cloud-upload bg-bulet bg-info"></i> Import data penyusunan bahan ajar</h4>
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
                  <li class="active">Pengembangan</li>
                  <li class="active"><a href="<?php echo site_url('bahan_ajar') ?>">Penyusunan bahan ajar</a></li>
                  <li class="active">Import data</li>
                </ol>
                <hr class="hr"/>
            </div>
            
            <div class="content">
                <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('bahan_ajar/import_data/import_data') ?>" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">File upload</label>
                    <div class="col-sm-10">
                      <input type="hidden" name="kat" value="sastra"/>
                      <input type="file" class="form-control" name="excel" placeholder="....."/>
                      <p class="help-block"><i>Nama file harus : '<?php echo $filenamexl ?>'</i></p>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button id="btn-import" type="submit" class="btn btn-primary">Simpan</button>
                      <a id="btn-back" class="btn btn-danger" href="<?php echo site_url('bahan_ajar') ?>">Kembali</a>
                    </div>
                  </div>
                </form>
                
                <?php echo $this->session->flashdata('notif') ?>
                <?php echo $this->session->flashdata('import') ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <h4 class="title"><i class="fa fa-list bg-bulet bg-warning"></i> Data bahan ajar</h4>
                <hr class="hr"/>
            </div>
            
            <div class="content">
                <h4 class="text-center"><i>Total data keseluruhan : <?php echo $total_data ?></i></h4>
                <h4 class="text-center"><i>Total Import data hari ini : <?php echo $total_import ?></i></h4>
                <?php if($total_import != 0){ ?>
                <hr/>
                <div class="text-center"><button onclick="del_import()" class="btn btn-danger btn-lgx"><span class="glyphicon glyphicon-trash"></span> Reset data import</button></div>
                <?php }?>
                <?php echo $this->session->flashdata('notif_del') ?>
            </div>
        </div>
    </div>
</div>
<div data-keyboard="false" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" id="mdl-del" style="margin-top: 10%;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-trash bg-bulet bg-danger"></span> Hapus data import</h4>
      </div>
      <div class="modal-body">
        <p>Data import untuk hari ini akan terhapus semua, anda yakin ???</p>
      </div>
      <div class="modal-footer">
        <form method="post" action="<?php echo site_url('bahan_ajar/import_data/del_import') ?>">
        <button id="btn-close" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <button onclick="del_loading()" id="btn-del" type="submit" class="btn btn-primary">Ya, hapus</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
            excel: {
                validators: {
                    file: {
                        extension: 'xls',
                        type: 'application/vnd.ms-excel',
                        maxSize: 2097152,   // 2048 * 1024
                        message: 'haraf masukan file ms.excel'
                    },
                    notEmpty: {
                        message: 'harap masukan file ms.excel'
                    },
                }
            },
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
        $('#btn-import').removeClass('btn-primary').addClass('btn-default').html('Transfering data... <?php echo loading('wek') ?>');
        $('#btn-back').hide();
    });
});
function del_import(){
    $('#mdl-del').modal('show');
}
function del_loading(){
    $('#btn-close').hide();
    $('#btn-del').removeClass('btn-primary').addClass('btn-default').html('Sedang menghapus data... <?php echo loading('wek') ?>');
}
</script>
<?php $this->load->view('template/footer') ?>