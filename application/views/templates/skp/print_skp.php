<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title2 ;?></title>
    <link rel="icon" href="<?php echo base_url('assets/img/logo/favicon.ico'); ?>" type="image/ico">
    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
   
  </head>
  <body>
  	<div  class="col-sm-12 text-center">
  		<hr>
  		<a href="#"><img class="profile-user-img" src="<?php echo base_url('assets/qrcode/img/');?><?php echo $qrnya;?>" alt="User Image" width="100" height="100"></a>
  		<br><?php echo $nama_peserta?>
  		<hr>
  		<a href="#"><img class="profile-user-img" src="<?php echo base_url('assets/qrcode/img/');?><?php echo $qrnya;?>" alt="User Image" width="150" height="150"></a>
  		<br><?php echo $nama_peserta?>
  		<hr>
  		<a href="#"><img class="profile-user-img" src="<?php echo base_url('assets/qrcode/img/');?><?php echo $qrnya;?>" alt="User Image" width="200" height="200"></a>
  		<br><?php echo $nama_peserta?>
  	</div>

  </body>
</html>