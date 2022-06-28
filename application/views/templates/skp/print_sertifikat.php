<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
	  <link rel="icon" href="<?php echo base_url('assets/img/logo/favicon.ico'); ?>" type="image/ico">
      <link href="<?php echo base_url('assets/build/css/print.css'); ?>" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Arizonia|Great+Vibes|Roboto+Mono|Satisfy" rel="stylesheet">
      <title>Cetak</title>
   </head>
    <body id="common" onload="window.print()">
		<table width="100%" class="tabel-info center">
			<tr>
				<td></td>
				<td></td>
				<td>
					<h1><br></br></h1>
					<h1 class="sertifikat">Sertifikat</h1><br></br>
					<h5>NO SKP:  <?php echo $no_skp ;?><br>Satuan Kredit Profesi Sebesar: <?php echo $nilai?></h5><br>
					<h3>Diberikan Kepada</h3><br></br>
					<u><h2 class="n_peserta"><?php echo $nama_peserta ;?></h2></u><br></br>
					<h4>Sebagai:</h4><br>
					<h4><?php echo strtoupper($sebagai) ;?></h4><br></br>
					<h4><b><?php echo $nama_kegiatan?> Pada Tanggal <?php echo tgl_indo($tanggal);?><br> Di <?php echo $tempat;?></b><br></br></h4><br></br>					
				</td>
				<td></td>
			</tr>	
		</table>
		<table class="tabel-info center" width="100%">
			<tr>
				<td width="30%"><?php echo $legist_jabatan?></td>
				<td width="40%"></td>
				<td>
					Ketua Panitia<br>									
				</td>				
			</tr>
			<tr>
				<td colspan="3" height="80">
					<img class="profile-user-img" src="<?php echo base_url('assets/qrcode/img/');?><?php echo $qrnya;?>" alt="User Image" width="80" height="80">
				</td>
			</tr>
			<tr>
				<td width="30%"><u><?php echo $legist_nama?></u><br>NIRA : <?php echo $legist_nira?></td>
				<td width="40%"></td>
				<td><u><?php echo $ketua?></u><br>NIRA : <?php echo $nira_ketua?></td>
			</tr>
			<tr>
				<td colspan="3" height="30"></td>
			</tr>			
		</table>	
	</body>
</html>