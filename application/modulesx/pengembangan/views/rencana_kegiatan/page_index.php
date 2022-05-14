<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/datatable') ?>
<link rel="stylesheet" href="<?php echo site_url('assets/vendor/semantic/components/label.css') ?>"/>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-book bg-bulet bg-warning"></i> Rencana Kegiatan</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('app/home') ?>">Home</a></li>
          <li class="active">Pengembangan</li>
          <li class="active">Rencana Kegiatan</li>
        </ol>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        
    </div>
</div>
<script>
$(function(){
    $('#toggleColumn-datatable').dataTable();
});
</script>
<?php $this->load->view('template/footer') ?>