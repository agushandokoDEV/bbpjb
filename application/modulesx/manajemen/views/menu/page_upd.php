<?php $this->load->view("template/main"); ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-sitemap bg-bulet bg-app"></i> Tambah Menu</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
          <li class="active">Manajemen</li>
          <li class="active"><a href="<?php echo site_url('manajemen/menu') ?>">Menu</a></li>
          <li class="active">Add</li>
        </ol>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <form action="<?php echo base_url('manajemen/menu/do_upd') ?>" method="post" id="form-add">
                <div class="form-group">
                    <label>Nama Menu</label>
                    <input type="text" name="nm_menu" placeholder="Nama Menu" class="form-control" value="<?php echo $dt_row->nama_menu ?>">
                    <input type="hidden" name="id_key" value="<?php echo $dt_row->id_menu ?>"/>
                </div>
                <div class="form-group">
                    <label>Icon</label>
                    <input type="text" name="icon" placeholder="Ico" class="form-control" value="<?php echo $dt_row->icon ?>">
                </div>
                <div class="form-group">
                    <label>Controllers</label>
                    <input type="text" name="controllers" placeholder="Controllers" class="form-control" value="<?php echo $dt_row->controllers ?>">
                </div>
                <div class="form-group">
                    <label>Function</label>
                    <input type="text" placeholder="Function" name="function" class="form-control" value="<?php echo $dt_row->function ?>">
                </div>
                <div class="form-group">
                    <label>SUb</label>
                    <select class="form-control chosen" name="sub">
                        <option value="0">-</option>
                        <?php foreach($dt_menu as $m){ ?>
                        <option value="<?php echo $m->id_menu ?>"><?php echo $m->nama_menu ?></option>
                        <?php }?>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-fill btn-info btn-wd">Simpan</button>
                <a href="<?php echo base_url('manajemen/menu') ?>" class="btn btn-fill btn-danger btn-wd"> Kembali ke list data</a>
            </form>
    </div>
</div>
<script>
$(document).ready(function() {
  
});
$(function(){
    $('select[name="sub"]').val('<?php echo $dt_row->sub ?>').trigger("chosen:updated");
});
</script>
<?php $this->load->view("template/footer"); ?>