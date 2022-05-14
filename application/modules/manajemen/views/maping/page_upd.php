<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/formvalidation') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-sitemap bg-bulet bg-app"></i> Maping</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Manajemen</li>
          <li class="active"><a href="<?php echo site_url('manajemen/maping') ?>">Maping</a></li>
          <li class="active">Update</li>
        </ol>
        <hr class="hr"/>
    </div>    
    <script>
    $(function(){
        $('#parent').val('<?php echo $dt_row->parent ?>');
    });
    </script>
    <div class="content">
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('manajemen/maping/do_upd') ?>">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Parent</label>
            <div class="col-sm-10">
              <select name="parent" id="parent" class="form-control">
              <?php foreach($mn_par as $p){ ?>
              <option value="<?php echo $p->id_menu ?>"><?php echo $p->nama_menu ?></option>
              <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">ID Menu</label>
            <div class="col-sm-10">
              <input type="hidden" name="id_maping" value="<?php echo $dt_row->id_maping ?>"/>
              <input type="text" class="form-control" name="id_menu" placeholder="ID Menu" value="<?php echo $dt_row->id_menu ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Views</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="views" placeholder="Views" value="<?php echo $dt_row->views ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Function</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="func" placeholder="Func" value="<?php echo $dt_row->function ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Table</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tbl" placeholder="Table" value="<?php echo $dt_row->table ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Map</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="map" placeholder="Table" value="<?php echo $dt_row->map ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Map Alldata</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="map_alldata" placeholder="Map Alldata" value="<?php echo $dt_row->map_alldata ?>">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('manajemen/maping') ?>">Kembali</a>
            </div>
          </div>
        </form>
    </div>
</div>
<?php $this->load->view('template/footer') ?>