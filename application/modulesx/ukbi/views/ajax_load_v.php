<input type="hidden" name="id_key" id="id_key" value="<?php echo $dt_row->id_ukbi ?>"/>
<div class="form-group">
    <label for="exampleInputEmail1">Kota :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $this->M_ukbi->get_kabkot_row($dt_row->id_kabkot)->nama_kota ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Lokasi Pengajuan :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->lokasi_pengajuan ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Tanggal Pengajuan :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->tgl_pengajuan ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Jenis pengajuan :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->jenis_pengajuan ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Materi pengajuan :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->materi_pengajuan ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Kategori peserta :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->kat_peserta ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Jumlah Peserta :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->jum_peserta ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Hasil pengajuan :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->hasil_pengajuan ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Lampiran :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->lampiran ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Ket :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->ket ?>" readonly/>
</div>