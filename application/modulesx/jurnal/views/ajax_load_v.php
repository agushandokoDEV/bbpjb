<?php
if($dt_row->info_produk == '0'){
    $p='Produk Pusat';
}else if($dt_row->info_produk == '1'){
    $p='Produk Balai/Kantor';
}else if($dt_row->info_produk == '2'){
    $p='Produk Luar';
}else{
    $p='-';
}
?>
<input type="hidden" name="id_key" id="id_key" value="<?php echo $dt_row->id_majalah ?>"/>
<div class="form-group">
    <label for="exampleInputEmail1">Kategori :</label>
    <select class="form-control" name="kat" id="kat" readonly>
        <option value="j">Majalah</option>
    </select>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Judul :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->judul ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Tim Redaksi :</label>
    <textarea rows="3" class="form-control" name="ket" placeholder="....." readonly><?php echo $dt_row->tim_redaksi ?></textarea>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Volume :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->volume ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">No. ISSN :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->no_issn ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Lingkup :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->lingkup ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Akreditasi :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->akreditasi ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Penerbit :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->penerbit ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Tahun Penerbit :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $dt_row->thn_terbit ?>" readonly/>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Ket :</label>
    <textarea rows="3" class="form-control" name="ket" placeholder="....." readonly><?php echo $dt_row->ket ?></textarea>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Akreditasi :</label>
    <input type="text" class="form-control" name="peneliti" placeholder="....." value="<?php echo $p ?>" readonly/>
</div>