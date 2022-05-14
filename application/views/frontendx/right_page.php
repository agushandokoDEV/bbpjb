<div class="card">
    <div class="header bg-default">
        <h4 class="title text-left"><i class="fa fa-lock bg-bulet bg-danger"></i> <b class="black">LOGIN</b></h4>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <form id="form-log" method="post" action="<?php echo site_url('auth/do_login') ?>">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
              <input type="text" name="username" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
              <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
            </div>
          </div>
          <!--<div class="checkbox">
            <label>
              <input type="checkbox"> Remember
            </label>
          </div>-->
          <button type="submit" class="btn btn-danger" style="width: 100%;"><span class="glyphicon glyphicon-lock"></span> <b>LOGIN</b></button>
        </form>
        <br />
        <?php echo $this->session->flashdata('notif') ?>
    </div>
</div>

<div class="card">
    <div class="header bg-default">
        <h4 class="title text-left"><i class="glyphicon glyphicon-info-sign bg-bulet bg-info"></i> <b class="black">Informasi</b></h4>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <p>
        File excel sudah tersedia untuk semua menu <b>PEMBINAAN</b> dan <b>PENGEMBANGAN</b>,
        silahkan download dan isi data dengan format tabel yang sudah disediakan.
        Jika ada pertanyaan atau masukan(menu atau data yang tidak sesuai/error)
        silahkan klik <a href="<?php echo site_url('question') ?>">disini</a>. Terimakasih 
        </p>
    </div>
</div>