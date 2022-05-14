<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/datatable') ?>
<?php $this->load->view('vendor/jconfirm') ?>
<link rel="stylesheet" href="<?php echo site_url('assets/vendor/semantic/components/label.css') ?>"/>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-book bg-bulet bg-info"></i> Penelitian</h4>
        <div class="row">
            <div class="col-md-8">
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
                  <li class="active">Pengembangan</li>
                  <li class="active">Penyusunan</li>
                  <li class="active">Penelitian</li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="pull-right">
                    <a href="<?php echo site_url('common/excel/template-penelitian_sastra.xls') ?>" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-download"></span> Download</a>
                    <a href="<?php echo site_url('penelitian/add') ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a>
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
                    <th>Kab/Kota</th>
                    <th>Judul</th>
                    <th>Tahun Penelitian</th>
                    <th>Lokasi</th>
                    <th>Peneliti</th>
                    <th>Publikasi</th>
                    <th>Tahun Terbit</th>
                    <th class="action">Action</th>
                </tr>
            </thead>
            <tbody style="border: none;">
                
            </tbody>
        </table>
    </div>
</div>
<script>
var table;
$(document).ready(function() {
  
  table = $('#dt_tbl').DataTable({ 
    
    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    
    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": "<?php echo site_url('penelitian/ajax_data')?>",
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

function hapus(id,fl){
    $.confirm({
        title: 'Hapus data',
        content: 'Anda yakin ???',
        confirmButton: 'Ya',
        icon: 'glyphicon glyphicon-trash',
        cancelButton: 'Batal',
        confirmButtonClass: 'btn-info',
        cancelButtonClass: 'btn-danger',
        confirm: function(){
            $.post('<?php echo site_url('penelitian/hapus') ?>',{key:id,fl:fl},function(r){
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
</script>
<?php $this->load->view('template/footer') ?>