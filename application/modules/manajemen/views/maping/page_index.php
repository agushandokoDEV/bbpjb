<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/datatable') ?>
<?php $this->load->view('vendor/jconfirm') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-sitemap bg-bulet bg-app"></i> Maping</h4>
        <div class="row">
            <div class="col-md-10">
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
                  <li class="active">Manajemen</li>
                  <li class="active">Maping</li>
                </ol>
            </div>
            <div class="col-md-2">
                <div class="pull-right"><a href="<?php echo site_url('manajemen/maping/add') ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a></div>
            </div>
        </div>
        <hr class="hr"/>
        <?php echo $this->session->flashdata('notif') ?>
    </div>    
    
    <div class="content">
        <table class="table table-bordered table-hover" id="dt_tbl">
            <thead class="thead">
                <tr>
                    <th>Parent</th>
                    <th>Menu</th>
                    <th>Views</th>
                    <th>Function</th>
                    <th>Table</th>
                    <th>Map</th>
                    <th>Map Alldata</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="border: none;">
                <?php foreach($dt_menu as $m){ ?>
                <tr id="del<?php echo $m->id_maping ?>">
                    <td><?php echo $this->M_maping->get_menu($m->parent) ?></td>
                    <td><?php echo $this->M_maping->get_menu($m->id_menu) ?></td>
                    <td><?php echo $m->views ?></td>
                    <td><?php echo $m->function ?></td>
                    <td><?php echo $m->table ?></td>
                    <td><?php echo $m->map ?></td>
                    <td><?php echo $m->map_alldata ?></td>
                    <td>
                        <a href="<?php echo site_url('manajemen/maping/upd/'.$m->id_maping) ?>" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a onclick="hapus('<?php echo $m->id_maping ?>')" href="#delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(document).ready(function(){
    $('#dt_tbl').DataTable();
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
            $.post('<?php echo site_url('manajemen/maping/hapus') ?>',{key:id},function(r){
                var n=jQuery.parseJSON(r);
                if(n.status == true){
                    //table.ajax.reload(null,false);
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