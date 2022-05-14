<input type="hidden" name="id_key" id="id_key" value="<?php echo $dt_row->id_penyuluhan ?>"/>
<div class="form-group">
    <label for="exampleInputEmail1">Kota :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $this->M_penyuluhan->get_kabkot_row($dt_row->id_kabkot)->nama_kota ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Nama Kegiatan :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->nama_keg ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Kategori :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->kat ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Tanggal Mulai :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->tgl_mulai ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Mulai :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->tgl_mulai ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Tanggal Selesai :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->tgl_selesai ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Narasumber :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->narasumber ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Jumlah Peserta :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->jum_peserta ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Sasaran :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->sasaran ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Materi :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->materi ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Materi :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->materi ?>" readonly/>
</div>