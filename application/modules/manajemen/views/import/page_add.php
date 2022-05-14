<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/datatable') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-sitemap bg-bulet bg-app"></i> Menu Import</h4>
        <div class="row">
            <div class="col-md-10">
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
                  <li class="active">Manajemen</li>
                  <li class="active">Menu Import</li>
                </ol>
            </div>
        </div>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <form id="form-add" class="form-horizontal" method="POST" action="<?php echo site_url('manajemen/menu_import/do_add') ?>">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Parent</label>
            <div class="col-sm-10">
              <select name="parent" class="form-control">
              <?php foreach($mn_par as $p){ ?>
              <option value="<?php echo $p->id_menu ?>"><?php echo $p->nama_menu ?></option>
              <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">ID Menu</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="id_menu" placeholder="ID Menu">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Function</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="function" placeholder="Function">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a class="btn btn-danger" href="<?php echo site_url('manajemen/menu_import') ?>">Kembali</a>
            </div>
          </div>
        </form>
    </div>
</div>
<?php $this->load->view('template/footer') ?>