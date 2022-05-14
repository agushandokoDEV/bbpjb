<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>BBPJB</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url('assets/app/img/favicon.ico') ?>"/>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo site_url('assets/dist/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="<?php echo site_url('assets/app/css/app.css') ?>" rel="stylesheet" />
    <script src="<?php echo site_url('assets/vendor/jquery-1.10.2.min.js') ?>"></script>
    <script src="<?php echo site_url('assets/dist/js/bootstrap.min.js') ?>"></script>
    <?php echo $this->load->view('vendor/smenu') ?>
    <script src="<?php echo base_url('assets/vendor/pace/pace.min.js') ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/pace/themes/red/pace-theme-minimal.css') ?>"/>
    <script src="<?php echo base_url('assets/vendor/autosize/autosize.min.js') ?>"></script>
    <script>
    $(function(){
        autosize($('textarea'));
    });
    </script>
    
</head>
<body>
<?php
$master=$this->M_app->getMenu();
$profil=$this->M_app->my_profil();
?>
<nav class="navbar navbar-default navbar-fixed-top" style="border-bottom: 1px solid gold;">
  <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!--<a class="navbar-brand" href="<?php echo site_url('dashboard') ?>" style="color: white;text-shadow: 1px 1px 1px 1px black;font-weight: bold;">BALAI BAHASA</a>-->
      <a href="<?php echo site_url('dashboard') ?>" class="navbar-brand" style="padding: 0 5px 0 5px;margin: 0;height: 70px;"><img  src="<?php echo site_url('assets/app/img/tutwurihandayani.png') ?>" style="height: 60px;margin-top: 5px;"/></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!--<li class="hvr-grow"><a href="<?php echo site_url('app/home') ?>"><i class="fa fa-home"></i> Home</a></li>-->
        <li class="hvr-grow"><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-home bg-bulet bg-app" style="border: 1px solid #ddd;"></i> Beranda</a></li>
        <?php if($master != null){ ?>
        <?php foreach($master as $m){  ?>
        <?php if($m->controllers != null){ ?>
        
        <?php }else{?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle hvr-grow" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="<?php echo $m->icon ?> bg-bulet bg-danger" style="border: 1px solid gold;"></i> <?php echo $m->nama_menu ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php foreach($this->M_app->getSubMenu($m->id_menu) as $s){  ?>
            <?php
            $sub=$this->M_app->getSubMenu($s->id_menu);
            ?>
            <?php if($sub != null){ ?>
            <li><a href="<?php echo site_url($s->controllers) ?>"><?php echo $s->nama_menu ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php foreach($sub as $sub){  ?>
                    <li><a href="<?php echo site_url($sub->controllers) ?>"><?php echo $sub->nama_menu ?></a></li>
                    <?php }?>
                </ul>
            </li>
            <?php }else{?>
            <li><a href="<?php echo site_url($s->controllers) ?>"><?php echo $s->nama_menu ?></a></li>
            <?php }?>
            <?php }?>
          </ul>
        </li>
         <?php }}}?>
      </ul>
      <!--
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      -->
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle hvr-grow" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user bg-bulet bg-app" style="border: 1px solid #ddd;"></i> <?php echo ucwords($profil->nama_user) ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('setting/profil') ?>"><i class="fa fa-user" aria-hidden="true"></i> Profil</a></li>
            <li><a href="<?php echo site_url('setting/ubah_password') ?>"><i class="fa fa-lock" aria-hidden="true"></i> Ubah Password</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo site_url('auth/logout') ?>"><i class="fa fa-power-off" aria-hidden="true"></i> Keluar</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
</nav>
<div class="container-fluid main-content"> 
<!-- Content here -->