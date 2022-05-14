<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/datatable') ?>
<?php $this->load->view('vendor/jconfirm') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-sitemap bg-bulet bg-app"></i> Maping Laporan Bulanan</h4>
        <div class="row">
            <div class="col-md-10">
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
                  <li class="active">Manajemen</li>
                  <li class="active">Maping Laporan Bulanan</li>
                </ol>
            </div>
            <div class="col-md-2">
                <div class="pull-right"><a href="<?php echo site_url('manajemen/mapinglap/add') ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a></div>
            </div>
        </div>
        <hr class="hr"/>
        <?php echo $this->session->flashdata('notif') ?>
    </div>    
    
    <div class="content">
        <table class="table table-bordered table-hover" id="dt_tbl">
            <thead class="thead">
                <tr>
                    <td>ID</td>
                    <th>Parent</th>
                    <th>Menu</th>
                    <th>Field</th>
                    <th>Tabel</th>
                    <th>URL</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="border: none;">
                <?php foreach($dt_menu as $m){ ?>
                <tr id="del<?php echo $m->id_mapinglap ?>">
                    <td><?php echo $m->id_mapinglap?></td>
                    <td><?php echo $this->M_mapinglap->get_menu($m->menu_par) ?></td>
                    <td><?php echo $this->M_mapinglap->get_menu($m->menu_sub) ?></td>
                    <td><?php echo $m->field?></td>
                    <td><?php echo $m->query?></td>
                    <td><?php echo $m->url?></td>
                    <td>
                        <a href="<?php echo site_url('manajemen/mapinglap/upd/'.$m->id_mapinglap) ?>" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a onclick="hapus('<?php echo $m->id_mapinglap ?>')" href="#delete" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
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
            $.post('<?php echo site_url('manajemen/mapinglap/hapus') ?>',{key:id},function(r){
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