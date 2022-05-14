<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/datatable') ?>
<link rel="stylesheet" href="<?php echo site_url('assets/vendor/semantic/components/label.css') ?>"/>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> Pelatihan dan Peningkatan Mutu Pegawai</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('app/home') ?>">Home</a></li>
          <li class="active">Pembinaan</li>
          <li class="active">Pelatihan dan Peningkatan Mutu Pegawai</li>
        </ol>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <table class="table table-bordered table-hover" id="toggleColumn-datatable">
            <thead class="thead">
                <tr>
                    <th>Nama Pelatihan</th>
                    <th>Tgl Pelatihan</th>
                    <th>Jumlah Peserta</th>
                    <th>Nama Lembaga</th>
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