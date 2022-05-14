<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url('assets/app/img/favicon.ico') ?>"/>

    <title>Pangkalan Data Balai Bahasa Jawa Barat</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo site_url('assets/dist/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="<?php echo site_url('assets/app/css/frontend.css') ?>" rel="stylesheet" />
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- Custom styles for this template -->
    <script src="<?php echo site_url('assets/vendor/jquery-1.10.2.min.js') ?>"></script>
    <script src="<?php echo site_url('assets/dist/js/bootstrap.min.js') ?>"></script>
    <?php $this->load->view('vendor/formvalidation') ?>
    <script src="<?php echo base_url('assets/vendor/pace/pace.min.js') ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/pace/themes/red/pace-theme-minimal.css') ?>"/>
    <script src="<?php echo base_url('assets/vendor/autosize/autosize.min.js') ?>"></script>
    
    <script src="<?php echo base_url('assets/vendor/jquery-ticker/jquery.easy-ticker.min.js') ?>"></script>
    <script>
    $(function(){
        autosize($('textarea'));
        $('.myWrapper').easyTicker({
            direction: 'down',
            visible: 3,
            interval: 4000
        });
    });
    </script>
    <style>
    textarea{
        resize: none;
    }
    </style>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
   

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container top-content">
        <?php
        $brand='BBPJB';
        if($this->mobile_detect->isMobile() == false){
        $brand='';
        ?>
        <div class="thumbnail no-radius thub-nav" style="height:100px;">
		<div style="float:left; margin : 5px;"><img src="<?php echo site_url('assets/app/img/tutwurihandayani.png') ?>" style="width: auto;height: 80px;padding: 0;" /></div>
            
            <h3 class="balai-brand text-center" style="margin:25px 0 0 0;">PANGKALAN DATA BALAI BAHASA JAWA BARAT</h3>
            <div class="text-center balai-brand-sub">Jalan Sumbawa Nomor 11 Bandung Jawa Barat 40113 Indonesia</div>
        </div>
        <?php }?>
        <nav class="navbar navbar-default no-radius navbar-menu">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a title="Beranda" class="navbar-brand" href="<?php echo site_url() ?>"><i class="fa fa-home fa-lg"></i><?php echo $brand ?></a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-nav-menu">
                <li style="margin-top: 3px;"><a title="Berita Kegiatan" href="<?php echo site_url('berita') ?>"><i class="fa fa-globe fa-lg"></i></a></li>
                <li style="margin-top: 3px;"><a title="Gallery Kegiatan" href="<?php echo site_url('tag/gallery') ?>"><i class="fa fa-picture-o fa-lg"></i></a></li>
                <!--<li style="margin-top: 3px;"><a title="Profil" href="<?php echo site_url('tag/profil') ?>"><i class="fa fa-user fa-lgx"></i> Profil</a></li>
                <li style="margin-top: 3px;"><a title="Sejarah" href="<?php echo site_url('tag/sejarah') ?>"><i class="fa fa-hourglass-half fa-lgx"></i> Sejarah</a></li>
                <li style="margin-top: 3px;"><a title="Visi Misi" href="<?php echo site_url('tag/visimisi') ?>"><i class="fa fa-street-view fa-lgx"></i> Visi Misi</a></li>
                <li style="margin-top: 3px;"><a title="Kontak Kami" href="<?php echo site_url('tag/kontak') ?>"><i class="fa fa-newspaper-o fa-lgx"></i> Kontak</a></li>-->
              </ul>
              <!--<form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
              </form>-->
              <ul class="nav navbar-nav navbar-right">
                <li style="margin-top: 3px;"><a onclick="box_log()" title="Login" href="#login"><i class="fa fa-lock fa-lg"></i></a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </div>
    <!-- Begin page content -->
    <div class="container main-content">
        
            
            