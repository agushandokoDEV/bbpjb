<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-sitemap bg-bulet bg-app"></i> Maping</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Manajemen</li>
          <li class="active"><a href="<?php echo site_url('manajemen/mapinglap') ?>">Maping</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('manajemen/mapinglap/do_upd') ?>">
          <input type="hidden" name="id_key" value="<?php echo $dt_row->id_mapinglap ?>"/>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Parent</label>
            <div class="col-sm-10">
              <select name="parent" id="id_p" class="form-control">
              <?php foreach($mn_par as $p){ ?>
              <option value="<?php echo $p->id_menu ?>"><?php echo $p->nama_menu ?></option>
              <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">ID </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="menu_sub" placeholder="ID Menu" value="<?php echo $dt_row->menu_sub ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Field</label>
            <div class="col-sm-10">
              <textarea rows="2" class="form-control" name="field" placeholder="Field kolom tabel"><?php echo $dt_row->field ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tabel</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="query" placeholder="Tabel" value="<?php echo $dt_row->query ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">URL</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="url" placeholder="URL" value="<?php echo $dt_row->url ?>">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('manajemen/mapinglap') ?>">Kembali</a>
            </div>
          </div>
        </form>
    </div>
</div>
<script>
$(function(){
    $('#id_p').val('<?php echo $dt_row->menu_par ?>');
});
</script>
<?php $this->load->view('template/footer') ?>