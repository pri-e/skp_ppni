<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title ;?></title>
    <meta name="description" content="<?php echo $title ;?>" />
    <meta name="keywords" content="<?php echo $title ;?>" />
    <meta name="author" content="Priyanta Nugraha" />
    <link rel="icon" href="<?php echo base_url('assets/img/logo/ppni.jpeg'); ?>" type="image/gif">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>"
    <!-- Font Awesome -->     
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/production/css/AdminLTE.css'); ?>"     

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">      
      <div class="login-box-body">
        <img src="<?php echo base_url('assets/img/logo/ppni.jpeg'); ?>" alt="Logo PPNI" class="img-responsive center-block" width='150px'>
        <center>
        <h4><b><?php echo $title ;?></b></h4>
        <h6><?php echo $instansi;?></h6>
        <h5 class="text-success"><?php echo $versi;?></h5>
        </center>             
          <?php echo form_open('login/proses_login'); ?>              
                <div class="form-group has-feedback">
                  <input type="text" name="username" class="form-control" placeholder="Username">
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <input type="password" name="password"class="form-control" placeholder="Password">
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                  <div class="col-xs-8">              
                  </div><!-- /.col -->
                  <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                  </div><!-- /.col -->
                </div>
              <div class="row">
                <?php echo ($msg) ? $msg : "";?>
              </div>
          <?php echo form_close(); ?>  
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->        
  </body>
</html>
