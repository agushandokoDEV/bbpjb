<script>
$(function(){
    $('#dt_tbl').DataTable();
});
</script>
<div class="card" id="map-data">
    <div class="header bg-warningx" style="padding-bottom: 10px;border-bottom: 1px dotted #ddd;">
        <h3 style="margin-top: 0;"><i class="fa fa-file-text-o bg-bulet bg-info"></i> <b><?php echo ucwords($mn_menu->nama_menu) ?></b></h3>
        <p style="font-size: 14px;"><span class="glyphicon glyphicon-map-marker"></span><i> Semua Wilayah <?php echo '('.$thn.')' ?></i></p>
    </div>    
    
    <div class="content">
        <div class="media media-keg">
          <div class="media-body">
            <table class="table table-bordered table-hover" id="dt_tbl">
                <thead class="thead">
                    <tr>
                        <th>Judul</th>
                        <th>Tim Redaksi</th>
                        <th>Vol</th>
                        <th>No ISSN</th>
                        <th>Lingkup</th>
                        <th>Akreditasi</th>
                        <th>Penerbit</th>
                    </tr>
                </thead>
                <tbody style="border: none;">
                    <?php foreach($dt_map as $val){ ?>
                    <tr>
                        <td><?php echo $val->judul ?></td>
                        <td><?php echo $val->tim_redaksi ?></td>
                        <td><?php echo $val->volume ?></td>
                        <td><?php echo $val->no_issn ?></td>
                        <td><?php echo $val->lingkup ?></td>
                        <td><?php echo $val->akreditasi ?></td>
                        <td><?php echo $val->penerbit ?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
          </div>
        </div>
    </div>
</div>