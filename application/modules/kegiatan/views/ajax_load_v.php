<input type="hidden" name="id_key" id="id_key" value="<?php echo $dt_row->id_kegiatan ?>"/>
<div class="form-group">
    <label for="exampleInputEmail1">Nama Kegiatan :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->nama_keg ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Tempat :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->tempat ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Kota :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->tempat ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Jumlah :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->jum_peserta ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Jumlah Peserta :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->jum_peserta ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Jumlah Penyuluh :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->jum_penyuluh ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Jumlah peserta Penyuluh :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->jum_peserta_penyuluh ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Sasaran :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->sasaran ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Sasaran :</label>
    <textarea class="form-control" name="sasaran" placeholder="Sssaran.." rows="2" readonly><?php echo $dt_row->sasaran ?></textarea>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Keterangan :</label>
    <textarea class="form-control" name="sasaran" placeholder="Sssaran.." rows="2" readonly><?php echo $dt_row->ket ?></textarea>
</div>