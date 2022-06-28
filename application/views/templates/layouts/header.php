<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title;?></title>
    <link rel="icon" href="<?php echo base_url('assets/img/logo/favicon.ico'); ?>" type="image/ico">
    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets/vendors/nprogress/nprogress.css'); ?>" rel="stylesheet">

    <!-- css -->
      <!-- iCheck -->
      <link href="<?php echo base_url('assets/vendors/iCheck/skins/flat/green.css'); ?>" rel="stylesheet">
      <!-- Datatables -->
      <link href="<?php echo base_url('assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>" rel="stylesheet">
      <link href="<?php echo base_url('assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css'); ?>" rel="stylesheet">
      <link href="<?php echo base_url('assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css'); ?>" rel="stylesheet">
      <link href="<?php echo base_url('assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css'); ?>" rel="stylesheet">
      <link href="<?php echo base_url('assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css'); ?>" rel="stylesheet">
      <link rel="stylesheet" href="<?php echo base_url('assets/vendors/datepicker/datepicker3.min.css'); ?>">

    <!-- css -->
    

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/build/css/custom.min.css'); ?>" rel="stylesheet">
  </head>

  <Body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-heartbeat"></i> <span><?php echo $title;?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <?php foreach ($datalogin->result() as $d) {?>
              <div class="profile_pic">
                <img src="<?php echo base_url('assets/img/instansi/'); ?><?php echo $d->img;?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <div>Selamat Datang</div>
                <h2><?php echo $d->nama;?><br><?php echo $d->instansi;?></h2>
              </div>
              <div class="clearfix"></div>
              <?php } ?>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <?php echo $menu?>
                <!--
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo $base_url;?>index.php/home">Dashboard</a></li>                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i>Data SKP<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo $base_url;?>index.php/skp/jenis_kegiatan">Data Jenis Pelatihan</a></li>
                      <li><a href="<?php echo $base_url;?>index.php/skp">Peserta Pelatihan</a></li>
                      <li><a href="form_validation.html">Data Registrasi Online</a></li>                      
                    </ul>
                  </li>
                  
                  
                  <li><a><i class="fa fa-bar-chart-o"></i> Data Pelaporan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">Laporan 1</a></li>
                      <li><a href="#">Laporan 2</a></li>
                      <li><a href="#">Laporan 3</a></li>
                      <li><a href="#">Laporan 4</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-cogs"></i>Setting<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo $base_url;?>index.php/master_data">Master Data Instansi</a></li>
                      <li><a href="<?php echo $base_url;?>index.php/master_data/uers_level">Master Data Group User</a></li>
                      <li><a href="<?php echo $base_url;?>index.php/master_data/pengguna_aplikasi">Master Data User</a></li>
                      <li><a href="<?php echo $base_url;?>index.php/master_data/akses_menu">Menu Aplikasi</a></li>                      
                    </ul>
                  </li>                  
                </ul>
                -->
              </div>
              <div class="menu_section">
                <h3>Live On</h3>
                
                
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo $base_url; ?>index.php/home/logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <?php foreach ($datalogin->result() as $d) {?>
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url('assets/img/instansi/'); ?><?php echo $d->img;?>" alt=""><?php echo $this->session->userdata('nama') ;?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    
                    <li><a href="<?php echo $base_url; ?>index.php/home/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
                <?php } ?>

                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
       