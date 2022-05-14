<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <h4 class="title"><i class="fa fa-sitemap bg-bulet bg-app"></i> Backup database</h4>
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
                  <li class="active">Manajemen</li>
                  <li class="active">Backup database</li>
                </ol>
                </ol>
                <hr class="hr"/>
            </div>
            
            <div class="content">
                <div class="text-center"><a href="<?php echo site_url('manajemen/backupdb/export') ?>" class="btn btn-danger btn-lg"><i class="fa fa-database"></i> Download database</a></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <h4 class="title"><i class="fa fa-list bg-bulet bg-warning"></i> Recent backup</h4>
                <hr class="hr"/>
            </div>
            
            <div class="content">
                <table class="table table-bordered table-hover" id="dt_tbl">
                    <thead class="thead">
                        <tr>
                            <th class="action">No</th>
                            <th>Filename</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody style="border: none;">
                        <?php $no=1; foreach($dt_res as $r){ ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $r->filename?></td>
                            <td><?php echo $r->user_download?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('template/footer') ?>