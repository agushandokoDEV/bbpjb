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

    <title>Admin Login</title>

    <link href="<?php echo site_url('assets/dist/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="<?php echo site_url('assets/app/css/login.css') ?>" rel="stylesheet" />
    <script src="<?php echo site_url('assets/vendor/jquery-1.10.2.min.js') ?>"></script>
    <script src="<?php echo site_url('assets/dist/js/bootstrap.min.js') ?>"></script>
    <?php $this->load->view('vendor/formvalidation') ?>
    <!--
    <script src="http://badanbahasa.net/engine/js/mootools.js"></script>
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/slideshow/slideshow.css') ?>"/>
    <script src="<?php echo site_url('assets/vendor/slideshow/visualslideshow.js') ?>"></script>
    -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="overflow: hidden;">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="#"><img class="navbar-brand" src="<?php echo site_url('assets/app/img/tutwurihandayani.png') ?>" style="width: 100%;height: 70px;padding: 0;" /></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#login" onclick="box_log()" style="color: white;"><i class="fa fa-lock fa-2x bg-bulet bg-danger"></i></a></li>
        <li><a title="home" href="<?php echo site_url() ?>"><i class="fa fa-home fa-2x bg-bulet bg-app" style="padding: 7px;"></i></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container main-content">
    <div class="thumbnail" style="border-radius: 0;">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol>
        
          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <?php foreach($dt_slide as $slide){ ?>
            <div class="item">
              <a href="<?php echo site_url('berita/tag/'.$slide->slug) ?>"><img src="<?php echo $slide->url_img ?>" style="width: 100%;height: 500px; min-height: 500px;" alt="..."></a>
              <div class="carousel-caption">
                <h3><a style="color: white;" href="<?php echo site_url('berita/tag/'.$slide->slug) ?>"><?php echo $slide->judul ?></a></h3>
              </div>
            </div>
            <?php } ?>
          </div>
        
          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="mdl-log" style="margin-top: 100px;">
  <div class="modal-dialog" style="width: 400px;">
    <form id="form-log" method="post" action="<?php echo site_url('auth/do_login') ?>">
        <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
            <div class="card" style="padding-bottom: 30px;background: url('<?php echo site_url('assets/app/img/bg-kayu.jpg') ?>') repeat;">
                
                <div class="header text-center">
                    <img src="<?php echo site_url('assets/app/img/tutwurihandayani.png') ?>"/>
                    <br />
                    <b><i class="fa fa-user"></i> ADMIN LOGIN</b>
                </div>
                
                <div class="content">
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="sizing-addon2" style="border-color: #bbb;"><span class="glyphicon glyphicon-user" style="font-size: 20px;"></span></span>
                          <input style="border: 1px solid #bbb;" type="text" name="username" class="form-control" placeholder="Username" aria-describedby="sizing-addon2">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="sizing-addon2" style="border-color: #bbb;"><span class="glyphicon glyphicon-lock" style="font-size: 20px;"></span></span>
                          <input style="border: 1px solid #bbb;" type="password" name="password" class="form-control" placeholder="Password" aria-describedby="sizing-addon2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="checkbox">
                            <input type="checkbox" data-toggle="checkbox" value="">
                            Remember
                        </label>    
                    </div>                                 
                </div>
                <div class="footer text-center">
                    <button type="submit" id="btn-log" class="btn btn-fill btn-danger btn-lg" style="width: 100%;border-radius: 0;"><b><i class="fa fa-lock"></i> LOGIN</b></button>
                </div>
                <?php echo $this->session->flashdata('notif') ?>
                <div id="notif"></div>
            </div>
        </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<footer class="container-fluid footer text-center navbar-inverse">
	<div id="cont-fot">Copyright &copy; 2016 <a href="#">Balai Bahasa Jawa Barat</a></div>
    <!--<a href="#" class="pull-right scrollToTop"><i class="fa fa-chevron-up"></i></a>-->
</footer>
<script>

$(document).ready(function() {
    <?php echo $this->session->flashdata('notif-mdl') ?>
    $(".item" ).first().addClass('active');
    $('#btn-logx').click(function(e){
        //e.preventDefault();
        if($('input[name="username"]').val() == ''){
            $('#notif').html('<div class="alert alert-danger" style="border-radius: 0;"><span class="glyphicon glyphicon-info-sign"></span> Ups !!! Username harus di isi</div>');
        }else if($('input[name="password"]').val() == ''){
            $('#notif').html('<div class="alert alert-danger" style="border-radius: 0;"><span class="glyphicon glyphicon-info-sign"></span> Ups !!! Password harus di isi</div>');
        }else if($('input[name="username"]').val() == '' && $('input[name="password"]').val() == ''){
            $('#notif').html('<p>Data tidak lengkap</p>');
        }else{
            $('#notif').html('');
            $.post('<?php echo site_url('auth/ajax_login') ?>',{u:$('input[name="username"]').val(),p:$('input[name="password"]').val()},function(r){
                var res=jQuery.parseJSON(r);
                if(res.logged){
                    window.location.href=res.redirect;
                }else{
                    $('#notif').html('<div class="alert alert-danger" style="border-radius: 0;"><span class="glyphicon glyphicon-info-sign"></span>'+res.notif+'</div>');
                }
            })
            .fail(function(){
                alert('Terjadi kesalahan');
            });
        }
    });
    $('#form-log').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: ''
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: ''
                    }
                }
            }
        }
    })
    .on('err.field.fv', function(e, data) {
            // $(e.target)  --> The field element
            // data.fv      --> The FormValidation instance
            // data.field   --> The field name
            // data.element --> The field element

            // Hide the messages
            data.element
                .data('fv.messages')
                .find('.help-block[data-fv-for="' + data.field + '"]').hide();
    })
    .on('success.form.fv', function(e) {
        // Prevent form submission
        //e.preventDefault();
        //console.log(e.target);        
        var $form = $(e.target);
        //var bar = $('#progress-bar-xl');
        //var percent = $('#percent-xl');
        //var status = $('#status');
        var loading=$('#loading-tf');
        $('#btn-log').removeClass('btn-danger').addClass('btn-default').html('Mohon tunggu...<?php echo loading('wek') ?>');
    });
});
function box_log(){
    $('#mdl-log').modal('show');
}
</script>
</body>
</html>