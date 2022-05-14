<script>
$(function(){
    $('#dt_tbl').DataTable();
});
</script>
<div class="card" id="map-data">
    <div class="header bg-warningx" style="padding-bottom: 10px;border-bottom: 1px dotted #ddd;">
        <h3 style="margin-top: 0;"><i class="fa fa-file-text-o bg-bulet bg-info"></i> <b><?php echo ucwords($mn_menu->nama_menu) ?></b></h3>
        <?php
        if(isset($kota_nm->nama_kota)){
            $kota=ucwords($kota_nm->nama_kota);
        }else{
            $kota='Semua wilayah';
        }
        ?>
        <p style="font-size: 14px;"><span class="glyphicon glyphicon-map-marker"></span><i><?php echo $kota.' ('.$thn.') - Total : '.count($dt_map) ?></i></p>
    </div>    
    
    <div class="content">
        <div class="media media-keg">
          <div class="media-body">
            <table class="table table-bordered table-hover" id="dt_tbl">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>Jenis</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Prodi</th>
                        <th>Perguruan Tinggi</th>
                    </tr>
                </thead>
                <tbody style="border: none;">
                    <?php $no=1; foreach($dt_map as $val){ ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $val->jenis ?></td>
                        <td><?php echo $val->judul ?></td>
                        <td><?php echo $val->penulis ?></td>
                        <td><?php echo $val->tahun ?></td>
                        <td><?php echo $val->prodi ?></td>
                        <td><?php echo $val->perguruan_t ?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
          </div>
        </div>
    </div>
</div>