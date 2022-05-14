<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/highchart') ?>
<?php $this->load->view('vendor/datatable') ?>
<style>
ul.list-grafik li a{
    font-size: 15px;
    color: black;
}
</style>
<div class="card">
    <div class="header">
        <div class="row">
            <div class="col-md-10">
                <h4 class="title"><i class="fa fa-bar-chart bg-bulet bg-app"></i> Grafik Data Pengembangan dan Pembinaan</h4>
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('app/home') ?>">Home</a></li>
                  <li class="active">Laporan</li>
                  <li class="active">Pengembangan</li>
                </ol>
            </div>
            <div class="col-md-2">
                <!--<ul class="nav pull-right list-grafik">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pengembangan <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Rencana Kegiatan</a></li>
                        <li><a href="#">Hasil Kegiatan</a></li>
                      </ul>
                    </li>
                </ul>-->
                <form>
                    <div class="form-group" style="margin-bottom: 3px;">
                    <div class="input-group">
                      <span class="input-group-addon bg-app" id="basic-addon1" style="color: white;"><span class="glyphicon glyphicon-calendar"></span></span>
                      <select onchange="get_grafik(this.value)" id="gthn" class="form-control" aria-describedby="basic-addon1" style="height: 40px;">
                        <?php
                        for($t=2010; $t<=date('Y'); $t++)
                        {
                            $ar_thn[]=$t;
                        }
                        rsort($ar_thn);
                        foreach($ar_thn as $ar_thn)
                        {
                            echo '<option value="'.$ar_thn.'">'.$ar_thn.'</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </form>
            </div>
        </div>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <div id="load-grafik"></div>
    </div>
</div>
<div id="load-grafikx"></div>
<script>
$(function(){
    get_grafik($('#gthn').val());
});
function get_grafik(thn){
    $('#load-grafikx').html('');
    $('#load-grafik').html('<div class="text-center"><?php echo loading('aa') ?></div>');
    $.post('<?php echo site_url('laporan/grafik_data/load_grafik') ?>',{thn:thn},function(rs){
        $('#load-grafik').html(rs);
    })
    .error(function(){
        alert('Terjadi kesalahan, mohon cek koneksi internet..');
    });
}
</script>
<?php $this->load->view('template/footer') ?>