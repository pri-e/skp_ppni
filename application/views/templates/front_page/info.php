<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title1?></title>
	<meta name="description" content="<?php echo $title1 ;?>" />
    <meta name="keywords" content="<?php echo $title1 ;?>" />
    <meta name="author" content="Priyanta Nugraha" />
	<link rel="icon" href="<?php echo base_url('assets/img/logo/favicon.ico'); ?>" type="image/ico">
	
	<!-- Bootstrap -->
    <link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/build/css/footer.css'); ?>" rel="stylesheet">

	
</head>
<body>
	<div class="container-fluid">
		<div class="col-md-12">
			<div class="text-center">
				<h4><?php echo $title2?></h4>
				<hr>
			</div>
		  <div class="panel panel-default">
		    <div class="panel-heading">
		      <h3 class="panel-title"><i class="fa fa-user-secret"></i>
		      </h3>
		    </div>
		    <div class="panel-body">
		    	<?php if (!empty($datapeserta)) {?>
		    		<div class="alert alert-success text-center" role="alert">
					  Verifikasi Data success!
					</div>
					<?php foreach ($datapeserta->result() as  $item) {?>
						<div class="col-sm-12">
							<div class="col-sm-12">Nama Peserta:  <?php echo $item->nama_peserta?></div>
							<div class="col-sm-12">Instansi Asal:  <?php echo $item->instansi_asal?></div>
							<div class="col-sm-12">Kegiatan:  <?php echo $item->nama_kegiatan?></div>
							<div class="col-sm-12">Tanggal:  <?php echo tgl_indo($item->tanggal)?></div>
							<div class="col-sm-12">NO SKP:  <?php echo $item->no_skp?></div>
							<div class="col-sm-12">Tempat:  <?php echo $item->tempat?></div>
							<div class="col-sm-12">Sebagai:  <?php echo $item->nama?></div>
						</div>
					<?php } ?>
					
		    	<?php }else{?>
					<div class="alert alert-warning text-center" role="alert">
					  Peringatan....!!!Verifikasi Data Tidak berhasil!
					</div>
					<div class="alert alert-danger text-center" role="alert">
					  Tidak ditemukan data Peserta....! Silahkan Coba  Scan Ulang QR Code...!
					</div>
				<?php }?>

		    </div>
		  </div>
			</div>
			

			
		</div>
	</div>
	<footer class="footer">
      <div class="container-fluid">
        <span class="text-muted">
        	Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
        </span>
      </div>
    </footer>
</body>
</html>