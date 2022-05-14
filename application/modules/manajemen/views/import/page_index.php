<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/datatable') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-sitemap bg-bulet bg-app"></i> Menu Import</h4>
        <div class="row">
            <div class="col-md-10">
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
                  <li class="active">Manajemen</li>
                  <li class="active">Menu Import</li>
                </ol>
            </div>
            <div class="col-md-2">
                <div class="pull-right"><a href="<?php echo site_url('manajemen/menu_import/add') ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a></div>
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
                    <th>Function</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="border: none;">
                <?php foreach($dt_menu as $m){ ?>
                <tr>
                    <td><?php echo $this->M_mn->get_menu($m->id_menu_par) ?></td>
                    <td><?php echo $this->M_mn->get_menu($m->id_menu) ?></td>
                    <td><?php echo $m->function ?></td>
                    <td><a href="<?php echo site_url('manajemen/menu_import/upd/'.$m->id_import) ?>" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></a></td>
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
</script>
<?php $this->load->view('template/footer') ?>