<?php $this->load->view('template/main') ?>
<div class="card">
    <div class="header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="title"><i class="fa fa-bar-chart bg-bulet bg-app"></i> Laporan Bulanan</h4>
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('app/home') ?>">Home</a></li>
                  <li class="active">Laporan</li>
                  <li class="active">Bulanan</li>
                </ol>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    <form id="form-add" class="form-inline" style="margin-top: 15px;" method="get" action="<?php echo site_url('laporan/bulanan/filter') ?>">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                          <select name="bln" id="fbln" class="form-control" aria-describedby="basic-addon1">
                            <?php foreach($dt_bln as $key=>$val){ ?>
                            <option value="<?php echo $key ?>"><?php echo $val ?></option>
                            <?php }?>
                        </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                          <select name="thn" id="fthn" class="form-control" aria-describedby="basic-addon1">
                          <?php
                            for($t=2005; $t<=date('Y'); $t++)
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
                      <button onclick="btn_sub()" id="btn-sub" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-eye-open"></span> Filter</button>
                    </form>
                </div>
            </div>
        </div>
        <hr class="hr"/>
    </div>
    <div class="content">
        <h4 class="title text-center"><i class="fa fa-calendar bg-bulet bg-danger"></i> <?php echo $tanggal; ?></h4>
        <br />
        <table class="table table-bordered table-hover" id="dt_tbl">
            <thead class="thead">
                <tr>
                    <th class="action">No</th>
                    <th>Kategori</th>
                    <th>Kegiatan</th>
                    <th style="width: 5%;">Download</th>
                </tr>
            </thead>
            <tbody style="border: none;">
                <?php $no=1; foreach($dt_menu as $m){ ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $this->M_bln->get_menu($m->menu_par) ?></td>
                    
                    <?php
                    if($m->menu_sub == '49'){
                        $mn= 'Penelitian '.$this->M_bln->get_menu($m->menu_sub);
                    }else if($m->menu_sub == '50'){
                        $mn= 'Penelitian '.$this->M_bln->get_menu($m->menu_sub);
                    }else if($m->menu_sub == '51'){
                        $mn= 'Penyusunan '.$this->M_bln->get_menu($m->menu_sub);
                    }else if($m->menu_sub == '52'){
                        $mn= 'Penyusunan '.$this->M_bln->get_menu($m->menu_sub);
                    }else if($m->menu_sub == '53'){
                        $mn= 'Penyusunan '.$this->M_bln->get_menu($m->menu_sub);
                    }else if($m->menu_sub == '54'){
                        $mn= 'Penyusunan '.$this->M_bln->get_menu($m->menu_sub);
                    }else{
                        $mn= $this->M_bln->get_menu($m->menu_sub);
                    }
                    
                    ?>
                    <td><?php echo $mn ?></td>
                    <td class="text-center">
                    <a title="Download <?php echo $m->url.'-'.date('Y-m-d').'.xls' ?>" href="<?php echo site_url('laporan/bulanan/'.$m->url.'/'.$m->id_mapinglap.'/'.$fthn.'/'.$fbln) ?>"><img src="<?php echo site_url('assets/app/img/excel-ico.png') ?>"/></a>
                    <!--<span title="File download tidak tersedia" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-remove"></span></span>-->
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(function(){
    $('#fbln').val('<?php echo $fbln ?>');
    $('#fthn').val('<?php echo $fthn ?>');
});
function btn_sub(){
    $('#btn-sub').removeClass('btn-danger').addClass('btn-default').html('Loading...<?php echo loading('aa') ?>');
}
</script>
<?php $this->load->view('template/footer') ?>