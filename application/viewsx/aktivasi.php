<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>BBPJB</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <!-- Bootstrap core CSS -->
    <link href="<?php echo site_url('assets/dist/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="<?php echo site_url('assets/app/css/app.css') ?>" rel="stylesheet" />
    <script src="<?php echo site_url('assets/vendor/jquery-1.10.2.min.js') ?>"></script>
    <script src="<?php echo site_url('assets/dist/js/bootstrap.min.js') ?>"></script>
    
    <script src="<?php echo base_url('assets/vendor/pace/pace.min.js') ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/pace/themes/white/pace-theme-minimal.css') ?>"/>
    <?php $this->load->view('vendor/formvalidation') ?>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
  <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo site_url('auth/aktivasi') ?>" style="color: white;text-shadow: 1px 1px 1px 1px black;font-weight: bold;">BALAI BAHASA</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle hvr-grow" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Setting</a></li>
            <li><a href="#">Profil</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo site_url('auth/logout') ?>">Keluar</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
</nav>
<div class="container-fluid main-content"> 
<div class="container" style="width: 50%;">
    <div class="card" style="margin-top: 15%;">
        <div class="header">
            <h4 class="title"><i class="fa fa-lock bg-bulet bg-danger" style="border-radius: 30px;padding-left: 10px;padding-right: 10px;"></i> Aktivasi user</h4>
            <hr class="hr"/>
        </div>    
        
        <div class="content">
            <form id="form-aktivasi" class="form-horizontal" method="POST" action="<?php echo site_url('auth/do_aktvasi') ?>">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Password baru</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                    <input type="password" name="new_password" class="form-control" placeholder="Password baru" aria-describedby="sizing-addon2">
                  </div>
                </div>
                
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Ulangi password</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                    <input type="password" name="re_password" class="form-control" placeholder="Ulangi password" aria-describedby="sizing-addon2">
                  </div>
                  
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <button type="submit" class="btn btn-success"><i class="fa fa-lock"></i> Aktivasi</button>
                  <a href="<?php echo site_url('auth/logout') ?>" class="btn btn-danger">Batal dan login kembali</a>
                </div>
              </div>
            </form>
        </div>
    </div>
</div>
</div>
<footer class="container-fluid footer text-center navbar-inverse">
	Copyright &copy; 2016 <a href="#">Balai Bahasa Provinsi Jawa Barat</a>
    <!--<a href="#" class="pull-right scrollToTop"><i class="fa fa-chevron-up"></i></a>-->
</footer>
<script>
$(function(){
    $('#form-aktivasi').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove'
        },
        fields: {
            new_password: {
                validators: {
                    notEmpty: {
                        message: 'Password harus diisi'
                    },
                    stringLength: {
                        min: 6,
                        max: 50,
                        message: 'Minimal panjang 6 karakter dan maksimal 50 karakter'
                    },
                },
            },
            re_password: {
                validators: {
                    identical: {
                        field: 'new_password',
                        message: 'Password tidak sama'
                    },
                    notEmpty: {
                        message: 'Password harus diisi'
                    }
                }
            }
        }
    });
});
</script>
</body>
</html>