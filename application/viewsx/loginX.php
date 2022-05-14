<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Admin Login</title>

    <link href="<?php echo site_url('assets/dist/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="<?php echo site_url('assets/app/css/login.css') ?>" rel="stylesheet" />
    
    <script src="<?php echo site_url('assets/vendor/jquery-1.10.2.min.js') ?>"></script>
    <script src="<?php echo site_url('assets/dist/js/bootstrap.min.js') ?>"></script>
    <?php $this->load->view('vendor/formvalidation') ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <style>
    

    </style>

  <body> 

<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="azure" data-image="http://192.168.1.4/pilkada/assets/img/full-screen-image-1.jpg">   
        
    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content" style="padding-top: 7%;">
            <div class="container">
                <div class="row">                   
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <form id="form-log" method="post" action="<?php echo site_url('auth/do_login') ?>">
                            
                        <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
                            <div class="card">
                                <div class="header text-center"><b><i class="fa fa-user"></i> ADMIN LOGIN</b></div>
                                <div class="content">
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="sizing-addon2" style="border-color: #bbb;"><i class="fa fa-user" style="font-size: 25px;"></i></span>
                                          <input type="text" name="username" class="form-control" placeholder="Username" aria-describedby="sizing-addon2">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="sizing-addon2" style="border-color: #bbb;"><i class="fa fa-lock" style="font-size: 25px;"></i></span>
                                          <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="sizing-addon2">
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
                                    <button type="submit" class="btn btn-fill btn-danger btn-lg" style="width: 100%;"><b><i class="fa fa-lock"></i> LOGIN</b></button>
                                </div>
                            </div>
                        </form>
                        <?php echo $this->session->flashdata('notif') ?>
                    </div>                    
                </div>
            </div>
        </div>
</div>
<?php //echo phpinfo(); ?>
<script>
$(document).ready(function(){
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
                        message: 'Username harus diisi'
                    }
                }
            },
            password: {
                validators: {
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
