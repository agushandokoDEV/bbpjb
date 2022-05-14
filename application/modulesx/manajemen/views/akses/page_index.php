<?php $this->load->view("template/main"); ?>
<?php $this->load->view('vendor/jconfirm') ?>
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-sitemap bg-bulet bg-app"></i> Menu Akses</h4>
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="<?php echo site_url('dashboard') ?>">Home</a></li>
                  <li class="active">Manajemen</li>
                  <li class="active">Menu Akses</li>
                </ol>
            </div>
        </div>
        <hr class="hr"/>
        <?php echo $this->session->flashdata('notif') ?>
    </div>    
    
    <div class="content">
        <form class="form-inline" id="frm" method="POST" action="<?php echo base_url()?>manajemen/akses">
      <div class="form-group">
        <?php //echo form_dropdown('role', $role, $id,"class='form-control' id='role'");?>
        <select class="form-control" name="role" id="role">
            <?php foreach($role as $role){ ?>
            <option value="<?php echo $role->id_role ?>"><?php echo ucwords($role->nama_role) ?></option>
            <?php }?>
        </select>
      </div>
      <button type="submit" id="submit" class="btn btn-info btn-fill">Tampilkan</button>
    </form>
    <br />
    <div id="base-isi">
        <table  class="table table-bordered table-hover table-striped">
          <thead class="thead">
            <tr>
              <th class="pink">Nama Menu</th>
              <th class="pink" style="width: 10%;">Akses</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($akses as $akses){?>
            <tr>
              <td><?php echo $akses['nama_menu'];?></td>
              <td style="text-center">
                <?php if($akses['akses']==0){
                  ?><input data-toggle="switch" type='checkbox' onchange="inp('<?php echo $akses['id_menu'];?>','<?php echo $id;?>')" id="id_<?php echo $akses['id_menu'];?>" name="id_<?php echo $akses['id_menu'];?>"><?php 
                }else{?>
                  <input data-toggle="switch" type='checkbox' onchange="inp('<?php echo $akses['id_menu'];?>','<?php echo $id;?>')" id="id_<?php echo $akses['id_menu'];?>" name="id_<?php echo $akses['id_menu'];?>" checked><?php 
                } ?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
    </div>
    </div>
</div>         
<script type="text/javascript">
    $('#frm').submit(function(){
      var role=$('#role').val();
      $('#submit').text('Loading...');
      //$('#frm-list').hide();
      $.post("<?php echo base_url()?>manajemen/akses/get_d",{role:role},function(data){
        $('#base-isi').html(data);
        
        $('#submit').text('Tampilkan');
      })
      .fail(function(){
        $.alert({
            title: 'Upss..!',
            icon: 'glyphicon glyphicon-delete',
            content: 'Terjadi kesalahan sistem'
        });
      });
      return false;
    });
    function inp(id,rol)
    {
      if(document.getElementById('id_'+id).checked)
      {
        
        $.post("<?php echo base_url()?>manajemen/akses/beri/1/"+id+"/"+rol);
        
      }
      else
      {
        
        $.post("<?php echo base_url()?>manajemen/akses/beri/0/"+id+"/"+rol);
        
      }
      
    }
</script>
<?php $this->load->view("template/footer"); ?>