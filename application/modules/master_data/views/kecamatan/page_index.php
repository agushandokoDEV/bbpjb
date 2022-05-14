<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/datatable') ?>
<link rel="stylesheet" href="<?php echo site_url('assets/vendor/semantic/components/label.css') ?>"/>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-database bg-bulet bg-danger"></i> Kecamatan</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('app/home') ?>">Home</a></li>
          <li class="active">Master Data</li>
          <li class="active">Kecamatan</li>
        </ol>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <table class="table table-bordered table-hover" id="toggleColumn-datatable">
            <thead class="thead">
                <tr>
                    <th>Nama Kecamatan</th>
                    <th>Kabupaten / Kota</th>
                    <th>Long</th>
                    <th>Lat</th>
                </tr>
            </thead>
            <tbody style="border: none;">
                <?php for($i=1; $i<=35; $i++){ ?>
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(function(){
    $('#toggleColumn-datatable').dataTable();
});
</script>
<?php $this->load->view('template/footer') ?>