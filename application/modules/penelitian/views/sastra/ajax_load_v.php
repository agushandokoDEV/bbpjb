<input type="hidden" name="id_key" id="id_key" value="<?php echo $dt_row->id_penelitian ?>"/>
<div class="form-group">
    <label for="exampleInputEmail1">Unit/Satuan Kerja :</label>
    <input type="text" class="form-control" name="satuan_kerja" placeholder="....." value="balai bahasa provinsi jawa barat" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Peneliti :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->peneliti ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Judul :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->judul ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Kerja Sama :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->kerja_sama ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Tgl. Mulai :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->tgl_mulai ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Tgl. Selesai :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->tgl_selesai ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Lama Penelitian :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->lama_penelitian.' '.$dt_row->satuan_lama_penelitian ?>" readonly/>
</div>
<?php
if($dt_row->publikasi == '0'){
    $pub='Belum Terbit';
}else{
    $pub='Terbit';
}
?>
<div class="form-group">
    <label for="exampleInputEmail1">Publikasi :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $pub; ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Tahun Terbit :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->thn_terbit ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Abstrak :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->abstraksi ?>" readonly/>
</div>