<div class="card">
    <div class="header">
        <div class="row">
            <div class="col-md-10">
                <h4 class="title text-center"><i class="fa fa-calendar bg-bulet bg-danger"></i> <?php echo $tanggal; ?></h4>
            </div>
        </div>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <table class="table table-bordered table-hover" id="dt_tbl">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Kegiatan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody style="border: none;">
                <?php $no=1; foreach($dt_grafik as $g){ ?>
                <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo ucfirst($g->jenis);?></td>
                    <td><?php echo $g->menu?></td>
                    <td><?php echo $g->jumlah?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
