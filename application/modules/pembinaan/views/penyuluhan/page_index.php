<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/datatable') ?>
<link rel="stylesheet" href="<?php echo site_url('assets/vendor/semantic/components/label.css') ?>"/>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-suitcase bg-bulet bg-success"></i> Penyuluhan</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('app/home') ?>">Home</a></li>
          <li class="active">Pembinaan</li>
          <li class="active">Penyuluhan</li>
        </ol>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <table class="table table-bordered table-hover" id="toggleColumn-datatable">
            <thead class="thead">
                <tr>
                    <th>Provinsi</th>
                    <th>Kab/Kota</th>
                    <th>Kategori</th>
                    <th>Nama Kegiatan</th>
                    <th>Tgl Mulai</th>
                    <th>Tgl Selesai</th>
                    <th>Narasumber</th>
                    <th>Sasaran</th>
                    <th>Jumlah Peserta</th>
                    <th>Materi</th>
                </tr>
            </thead>
            <tbody style="border: none;">
                <?php for($i=1; $i<=35; $i++){ ?>
                <tr>
                    <td>Jawa Barat</td>
                    <td>Bandung Kota</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
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