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