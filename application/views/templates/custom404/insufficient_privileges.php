<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h4><b><?php echo $title1?></b></h4>
      </div>
      
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><?php echo $title2?></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          

          <div class="x_content"> 
                <div class="col-sm-12">
                  <div class="error-page">
                     <div class="count green"><h1>403</h1></div>
                      <img src="<?php echo base_url('assets/img/nurse.png'); ?>" alt="Not Found" style="width:304px;height:228px;">
                    <div class="error-content">
                      <h3><i class="fa fa-warning text-yellow"></i> Oops! Halaman Tidak DiTemukan.</h3>
                      <p>
                        
                        <p><b>Maaf Anda Tidak memiliki Hak akses ke Halaman yang anda Cari.</b><br>
                        Anda bisa <a href="<?php echo base_url('index.php/home/'); ?>"><b>Kembali Ke Beranda</b></a> Atau Jika anda Yakin terjadi kesalahan System Hubungi Admin.
                      </p>
                      
                     
                    </div>
                  </div>
                </div>                                    
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->