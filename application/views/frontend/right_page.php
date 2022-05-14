<!--<div class="card">
    <div class="header bg-default">
        <h4 class="title text-left"><i class="fa fa-lock bg-bulet bg-danger"></i> <b class="black">LOGIN</b></h4>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <form id="form-logx" method="post" action="<?php echo site_url('auth/do_login') ?>">
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
          <div class="checkbox">
            <label>
              <input type="checkbox"> Remember
            </label>
          </div>
          <button type="submit" class="btn btn-danger" style="width: 100%;"><span class="glyphicon glyphicon-lock"></span> <b>LOGIN</b></button>
        </form>
        <br />
        <?php //echo $this->session->flashdata('notif') ?>
    </div>
</div>
-->

<div class="card">
    <div class="header bg-default">
        <h4 class="title text-left"><i class="fa fa-newspaper-o bg-bulet bg-success" style="border: 1px solid wheat;padding: 7px;border-radius: 20px;color: white;"></i> <b class="black">Informasi Kegiatan Terbaru</b></h4>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <?php if($newsticker){ ?>
        <div class="myWrapper">
            <ul class="list-unstyled">
                <?php foreach($newsticker as $news){ ?>
                <li style="padding-top: 5px;padding-bottom: 5px;border-bottom: 1px dashed #ccc;">
                <h5 style="margin-bottom: 5px;font-size: 15px;font-weight: bold;font-style: italic;"><a href="<?php echo site_url('berita/tag/'.$news->slug) ?>"><?php echo $news->judul; ?></a></h5>
                <p style="font-size: 10px;" class="label label-danger"><span class="glyphicon glyphicon-calendar"></span> <i><?php echo tanggal($news->tgl) ?></i></p>
                <p class="leadx"><?php echo word_limiter($news->isi, 10); ?></p>
                </li>
                <?php }?>
            </ul>
        </div>
        <br />
        <a class="text-center" href="<?php echo site_url('berita') ?>">Tampilkan semua kegiatan...</a>
        <?php }else{?>
        <p class="text-center"><span class="glyphicon glyphicon-info-sign"></span> Tidak ada berita kegiatan</p>
        <?php }?>
    </div>
</div>