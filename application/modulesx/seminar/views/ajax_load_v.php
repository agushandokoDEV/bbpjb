<input type="hidden" name="id_key" id="id_key" value="<?php echo $dt_row->id_seminar ?>"/>
<div class="form-group">
    <label for="exampleInputEmail1">Nama Seminar :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->nama_seminar ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Pemateri :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->pemateri ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Tanggal Seminar :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->tgl_seminar ?>" readonly/>
</div>