<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/datatable') ?>
<?php $this->load->view('vendor/jconfirm') ?>
<link rel="stylesheet" href="<?php echo site_url('assets/vendor/semantic/components/label.css') ?>"/>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> Pelatihan dan Peningkatan Mutu Pegawai</h4>
        <div class="row">
            <div class="col-md-8">
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
                  <li class="active">Pembinaan</li>
                  <li class="active">Pelatihan dan Peningkatan Mutu Pegawai</li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="pull-right">
                    <a href="<?php echo site_url('common/excel/template-pelatihan.xls') ?>" class="btn btn-sm btn-warning"><i class="fa fa-file-excel-o"></i> Template Ms.excel</a>
                    <a href="<?php echo site_url('pelatihan_mutu_pegawai/import_data') ?>" class="btn btn-sm btn-info"><i class="fa fa-cloud-upload"></i> Import</a>
                    <a href="<?php echo site_url('pelatihan_mutu_pegawai/add') ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a>
                </div>
            </div>
        </div>
        <hr class="hr"/>
        <?php echo $this->session->flashdata('notif') ?>
    </div>    
    
    <div class="content">
        <table class="table table-bordered table-hover" id="dt_tbl">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    <th>Kab/Kota</th>
                    <th>Tgl Pelatihan</th>
                    <th>Nama Pelatihan</th>
                    <th>Nama Lembaga</th>
                    <th>Jumlah Peserta</th>
                    <th class="action">Action</th>
                </tr>
            </thead>
            <tbody style="border: none;">
                
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="mdl-v">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-question-sign bg-bulet bg-success"></span> Verifikasi Data</h4>
      </div>
      <div class="modal-body">
        <form>
         <div id="load-v"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="button" value="3" onclick="do_verify(this.value)" class="btn btn-warning"><span class="glyphicon glyphicon-remove-sign"></span> Tidak Verifikasi</button>
        <button type="button" value="2" onclick="do_verify(this.value)" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Verifikasi</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
var table;
$(document).ready(function() {
  
  table = $('#dt_tbl').DataTable({ 
    
    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    
    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": "<?php echo site_url('pelatihan_mutu_pegawai/ajax_data')?>",
        "type": "POST"
    },

    //Set column definition initialisation properties.
    "columnDefs": [
    { 
      "targets": [ -1 ], //last column
      "orderable": false, //set not orderable
    },
    ],

  });
});

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
            $.post('<?php echo site_url('pelatihan_mutu_pegawai/hapus') ?>',{key:id},function(r){
                var n=jQuery.parseJSON(r);
                if(n.status == true){
                    table.ajax.reload(null,false);
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
function verify(id){
    $('#mdl-v').modal('show');
    $('#load-v').html('<div class="text-center"><?php echo loading() ?></div>');
    $.post('<?php echo site_url('pelatihan_mutu_pegawai/ajax_load_v') ?>',{key:id},function(r){
        $('#load-v').html(r);
    });
}
function do_verify(stts){
    //$('#id_key').val();
    //alert($('#id_key').val());
    if(stts == '2'){
        nt='Verifikasi data berhasil';
    }else{
        nt='Verifikasi data berhasil dirubah ke Tidak terverifikasi';
    }
    $.post('<?php echo site_url('pelatihan_mutu_pegawai/do_verify') ?>',{key:$('#id_key').val(),stts:stts},function(r){
        var n=jQuery.parseJSON(r);
        if(n.status == true){
            $('#mdl-v').modal('hide');
            table.ajax.reload(null,false);
            $.alert({
                title: 'OK!',
                icon: 'glyphicon glyphicon-ok',
                content: 'OK...!!! '+nt
            });
        }
    });
}
</script>
<?php $this->load->view('template/footer') ?>