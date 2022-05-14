<input type="hidden" name="id_key" id="id_key" value="<?php echo $dt_row->id_siaran ?>"/>
<div class="form-group">
    <label for="exampleInputEmail1">Judul Naskah :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->judul_naskah ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Nama Penulis :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->penulis_naskah ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Tanggal Perekaman :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->tgl_perekaman ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Tanggal Disiarkan :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->tgl_disiarkan ?>" readonly/>
</div>