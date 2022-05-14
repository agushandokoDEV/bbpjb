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
<body style="overflow-y: hidden;">
<nav class="navbar navbar-default navbar-fixed-topx" style="border-bottom: 1px solid gold;">
  <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="<?php echo site_url('auth/aktivasi') ?>" class="navbar-brand" style="padding: 0;margin: 0;"><img  src="<?php echo site_url('assets/app/img/tutwurihandayani.png') ?>" style="height: 60px;width: 100%;"/></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-bottom: 15px;">
      
    </div><!-- /.navbar-collapse -->
</nav>
<div class="container-fluid main-contentx"> 
<div class="container" style="width: 50%;">
    <div class="card" style="margin-top: 20%;">
        <div class="header">
            <h4 class="title"><span class="glyphicon glyphicon-remove bg-bulet bg-danger" style="border-radius: 30px;"></span> Upss...</h4>
            <hr class="hr"/>
        </div>    
        
        <div class="content">
            <h4 class="text-center">Akun ini tidak aktif, silahkan hubungi admin...!!!</h4>
            <div class="text-center"><a title="home" href="<?php echo site_url() ?>"><i class="fa fa-home fa-2x bg-bulet bg-app" style="padding: 7px;"></i></a></div>
        </div>
    </div>
</div>
</div>
<footer class="container-fluid footer text-center navbar-inverse" style="margin-top: 16%;">
	Copyright &copy; 2016 <a href="#">Balai Bahasa Jawa Barat</a>
    <!--<a href="#" class="pull-right scrollToTop"><i class="fa fa-chevron-up"></i></a>-->
</footer>
</body>
</html>