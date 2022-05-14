<?php $this->load->view('template/main') ?>
<div class="card">
    <div class="header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="title"><i class="fa fa-bar-chart bg-bulet bg-app"></i> tes laporan</h4>
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('app/home') ?>">Home</a></li>
                  <li class="active">Laporan</li>
                  <li class="active">Bulanan</li>
                </ol>
            </div>
        </div>
        <hr class="hr"/>
    </div>
    <div class="content">
        <table class="table table-bordered table-hover" id="dt_tbl">
            <thead class="thead">
                <tr>
                    <?php echo $dhtml ?>
                </tr>
            </thead>
            <tbody style="border: none;">
                
            </tbody>
        </table>
    </div>
</div>

<?php $this->load->view('template/footer') ?>