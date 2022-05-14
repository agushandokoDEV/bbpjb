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
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/pace/themes/red/pace-theme-minimal.css') ?>"/>
    
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
      <!--<a class="navbar-brand" href="<?php echo site_url('dashboard') ?>" style="color: white;text-shadow: 1px 1px 1px 1px black;font-weight: bold;">BALAI BAHASA</a>-->
      <a href="<?php echo site_url('dashboard') ?>" class="navbar-brand" style="padding: 0;margin: 0;"><img  src="<?php echo site_url('assets/app/img/tutwurihandayani.png') ?>" style="height: 60px;width: 100%;"/></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!--<li class="hvr-grow"><a href="<?php echo site_url('app/home') ?>"><i class="fa fa-home"></i> Home</a></li>-->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle hvr-grow" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sitemap"></i> Manajemen <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('manajemen/role') ?>">Role</a></li>
            <li><a href="<?php echo site_url('manajemen/users') ?>">Users</a></li>
            <!--<li><a href="#">Menu</a></li>-->
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle hvr-grow" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-database"></i> Master Data <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('master_data/sekolah') ?>">Sekolah</a></li>
            <li><a href="<?php echo site_url('master_data/pegawai') ?>">Pegawai</a></li>
            <li><a href="<?php echo site_url('master_data/kecamatan') ?>">Kecamatan</a></li>
            <li><a href="<?php echo site_url('master_data/kabkot') ?>">Kabupaten / Kota</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle hvr-grow" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-book"></i> Pengembangan <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('pengembangan/rencana_kegiatan') ?>">Rencana Kegiatan</a></li>
            <li><a href="<?php echo site_url('pengembangan/hasil_kegiatan') ?>">Hasil Kegiatan</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle hvr-grow" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-suitcase"></i> Pembinaan <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('pembinaan/ukbi') ?>">UKBI</a></li>
            <li><a href="<?php echo site_url('pembinaan/bengkel_bhs_sastra') ?>">Bengkel Bahasa & Sastra</a></li>
            <li><a href="<?php echo site_url('pembinaan/penyuluhan') ?>">Penyuluhan</a></li>
            <li><a href="<?php echo site_url('pembinaan/siaran_rri') ?>">Siaran RRI</a></li>
            <li><a href="<?php echo site_url('pembinaan/bipa') ?>">Bipa</a></li>
            <li><a href="<?php echo site_url('pembinaan/lomba_kebahasaan_kesastraan') ?>">Lomba Kebahasaan dan Kesastraan</a></li>
            <li><a href="<?php echo site_url('pembinaan/sosialisasi_pemartabatan_bhs_megara') ?>">Sosialisasi Pemartabatan Bahasa Negara</a></li>
            <li><a href="<?php echo site_url('pembinaan/jambore') ?>">Jambore</a></li>
            <li><a href="<?php echo site_url('pembinaan/seminar') ?>">Seminar</a></li>
            <li><a href="<?php echo site_url('pembinaan/pelatihan_peningkatan_mutu_pegawai') ?>">Pelatihan dan Peningkatan Mutu Pegawai</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle hvr-grow" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bar-chart"></i> Laporan <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('laporan/pengembangan') ?>">Pengembangan</a></li>
            <li><a href="<?php echo site_url('laporan/pembinaan') ?>">Pembinaan</a></li>
          </ul>
        </li>
        <!--<li class="dropdown">
          <a href="#" class="dropdown-toggle hvr-grow" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Example <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('app/news') ?>">News</a></li>
            <li><a href="<?php echo site_url('app/form') ?>">Form</a></li>
            <li><a href="<?php echo site_url('app/login') ?>">Login</a></li>
          </ul>
        </li>
        -->
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
<!-- Content here -->