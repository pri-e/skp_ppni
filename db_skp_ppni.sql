/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.6.7-MariaDB : Database - skp_ppni
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`skp_ppni` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `skp_ppni`;

/*Table structure for table `m_jenis_peserta` */

DROP TABLE IF EXISTS `m_jenis_peserta`;

CREATE TABLE `m_jenis_peserta` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `nama` varchar(300) DEFAULT NULL,
  `nilai` varchar(8) DEFAULT NULL,
  `nilai_text` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

/*Data for the table `m_jenis_peserta` */

insert  into `m_jenis_peserta`(`id`,`nama`,`nilai`,`nilai_text`,`keterangan`) values (1,'Ketua','2','Dua','<p>\r\n	Ketua Panitia Baksos</p>\r\n'),(2,'Panitia','1','Satu','<p>\r\n	Panitia Baksos</p>\r\n'),(3,'Peserta','1','Satu','Peserta Baksos\r\n'),(4,'Nara Sumber','1','Satu','Nara Sumber Baksos'),(5,'Nara Sumber','2','Dua','Nara Sumber Seminar'),(6,'Ketua','2','Dua','<p>\r\n	Ketua Panitia Seminar</p>\r\n'),(7,'Peserta','2','Dua','Peserta Seminar (K2)'),(8,'Moderator','2','Dua','<p>\r\n	Moderator Seminar</p>\r\n'),(9,'Peserta','1','Satu','Peserta Seminar (K1)'),(13,'Pelaksana','1','Satu','Pelaksana Pengabdian Masyarakat');

/*Table structure for table `m_menu` */

DROP TABLE IF EXISTS `m_menu`;

CREATE TABLE `m_menu` (
  `id_menu` int(2) NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(35) DEFAULT NULL,
  `link_modul` varchar(120) DEFAULT NULL,
  `aktif` enum('Tidak','Ya') DEFAULT 'Tidak',
  `parent_id` int(2) DEFAULT NULL,
  `urutan` int(3) DEFAULT NULL,
  `urutan1` int(3) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_menu`),
  KEY `id_menu` (`id_menu`,`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COMMENT='Master Menu';

/*Data for the table `m_menu` */

insert  into `m_menu`(`id_menu`,`nama_modul`,`link_modul`,`aktif`,`parent_id`,`urutan`,`urutan1`,`icon`) values (1,'Home','#','Ya',NULL,1,1,'fa fa-home'),(2,'Dashboard','home','Ya',1,1,2,NULL),(3,'Data SKP','#','Ya',NULL,2,1,'fa fa-edit'),(4,'Jenis Kegiatan','skp/jenis_kegiatan','Ya',3,2,2,NULL),(5,'Peserta Kegiatan','skp','Ya',3,2,3,NULL),(6,'Laporan','#','Ya',NULL,5,1,'fa fa-bar-chart-o'),(7,'Setting','#','Ya',NULL,6,1,'fa fa-cogs'),(8,'Master Data Instansi','master_data','Ya',7,6,3,NULL),(9,'Master Data Grup User','master_data/uers_level','Ya',7,6,4,NULL),(10,'Master Data User','master_data/pengguna_aplikasi','Ya',7,6,5,NULL),(11,'Master Menu Aplikasi','master_data/akses_menu','Ya',7,6,6,NULL),(12,'Master Data Jenis Peserta','master_data/jenis_peserta','Ya',7,6,2,NULL),(13,'Registrasi Online','#','Ya',NULL,3,1,'fa fa-internet-explorer'),(14,'Data Peserta','#','Ya',13,3,2,NULL),(15,'Demografi Peserta','#','Ya',6,5,2,NULL),(16,'Verifikasi Quota Peserta','ferifikasi_admin/ferif_jkegiatan','Ya',3,2,4,NULL),(17,'Verivikasi Kegiatan','#','Ya',NULL,4,1,'fa fa-gavel'),(18,'Verivikasi DPW','#','Ya',17,4,2,NULL),(19,'Verivikasi DPD','#','Ya',17,5,3,NULL);

/*Table structure for table `m_menu_pengguna` */

DROP TABLE IF EXISTS `m_menu_pengguna`;

CREATE TABLE `m_menu_pengguna` (
  `id_menu` int(2) DEFAULT NULL,
  `id_user` int(6) DEFAULT NULL,
  `priority` int(2) DEFAULT NULL,
  KEY `id_menu` (`id_menu`,`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Master Menu Pengguna';

/*Data for the table `m_menu_pengguna` */

insert  into `m_menu_pengguna`(`id_menu`,`id_user`,`priority`) values (2,2,7),(3,2,8),(1,2,9),(4,2,10),(6,2,11),(8,2,12),(5,2,13),(7,2,14),(9,2,3),(12,2,4),(10,2,5),(11,2,6),(14,2,1),(13,2,2),(15,2,0),(2,5,0),(14,5,1),(3,5,2),(15,5,3),(1,5,4),(4,5,5),(6,5,6),(5,5,7),(13,5,8),(2,6,1),(14,6,2),(3,6,3),(15,6,4),(1,6,5),(4,6,6),(6,6,7),(9,6,8),(8,6,9),(12,6,10),(10,6,11),(11,6,12),(5,6,13),(13,6,14),(7,6,15),(2,7,0),(14,7,1),(3,7,2),(15,7,3),(1,7,4),(4,7,5),(6,7,6),(5,7,7),(13,7,8),(7,7,9),(16,6,0);

/*Table structure for table `m_pengguna` */

DROP TABLE IF EXISTS `m_pengguna`;

CREATE TABLE `m_pengguna` (
  `id_user` int(8) NOT NULL AUTO_INCREMENT,
  `id_level` int(8) DEFAULT NULL,
  `namapengguna` varchar(100) DEFAULT NULL,
  `sandi` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `id_instansi` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

/*Data for the table `m_pengguna` */

insert  into `m_pengguna`(`id_user`,`id_level`,`namapengguna`,`sandi`,`email`,`nama`,`id_instansi`) values (1,1,'Prie','990c560c52be8d35a207989f7ecce7953718c3c7','priyanto,nugroho@gmail.com','Priyanta Nugraha','1'),(2,1,'wigati','990c560c52be8d35a207989f7ecce7953718c3c7','gatroxs@gmail.com','Wigati.SST','1'),(5,2,'pantinugroho','7b22b6c08a594c8d512631afc9da636cf7a6a48f','pantinugroho@gmail.com','pantinugroho','8'),(6,2,'Ayunita','cde3acb642fc21f778993c0b4afd2edbc1dd97a6','ayoenheeta.ay@gmail.com','Ayunita Purnamasari SST','1'),(7,2,'ppnijih','93f83d108caba306517bde725015177a841b4545','admin@ppnijih.com','ppni rs JIH','9'),(8,1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997','priyanto,nugroho@gmail.com','Priyanta Nugraha','1');

/*Table structure for table `m_pengguna_instansi` */

DROP TABLE IF EXISTS `m_pengguna_instansi`;

CREATE TABLE `m_pengguna_instansi` (
  `id_instansi` int(8) NOT NULL AUTO_INCREMENT,
  `instansi` varchar(200) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_instansi`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

/*Data for the table `m_pengguna_instansi` */

insert  into `m_pengguna_instansi`(`id_instansi`,`instansi`,`alamat`,`keterangan`,`img`) values (1,'RS Jiwa Grhasia','Jl Kaliurang Km 17, Pakem  Sleman Yogyakarta. 55582','RSJ Grhasia','a74db-ppni.jpeg'),(8,'RS Panti Nugroho','JL. KALIURANG KM.17 SUKUNAN SLEMAN',NULL,'e646e-logorspr.png'),(9,'Rumah Sakit JIH','Jl. Ringroad Utara No. 160, Condong Catur, Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta','rsjih','0436d-rs_jih-logo.jpg');

/*Table structure for table `m_pengguna_level` */

DROP TABLE IF EXISTS `m_pengguna_level`;

CREATE TABLE `m_pengguna_level` (
  `id_level` int(8) NOT NULL AUTO_INCREMENT,
  `level` varchar(200) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

/*Data for the table `m_pengguna_level` */

insert  into `m_pengguna_level`(`id_level`,`level`,`keterangan`) values (1,'Su','Super User'),(2,'Admin','Administrator'),(3,'User','User');

/*Table structure for table `t_jenis_kegiatan` */

DROP TABLE IF EXISTS `t_jenis_kegiatan`;

CREATE TABLE `t_jenis_kegiatan` (
  `id_jenis_kegiatan` int(8) NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` text DEFAULT NULL,
  `quota_peserta` varchar(6) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `no_skp` varchar(300) DEFAULT NULL,
  `tempat` text DEFAULT NULL,
  `id_instansi` int(8) DEFAULT NULL,
  `penyelenggara` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `reg_online` varchar(50) DEFAULT NULL,
  `ketua` varchar(200) DEFAULT NULL,
  `nira_ketua` varchar(200) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `legist_nama` varchar(200) DEFAULT NULL,
  `legist_jabatan` varchar(200) DEFAULT NULL,
  `legist_daerah` varchar(200) DEFAULT NULL,
  `legist_nira` varchar(200) DEFAULT NULL,
  `input_by` int(3) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `edit_by` int(3) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `verif_admin` varchar(50) DEFAULT NULL,
  `verif_date` datetime DEFAULT NULL,
  `verif_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_jenis_kegiatan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

/*Data for the table `t_jenis_kegiatan` */

insert  into `t_jenis_kegiatan`(`id_jenis_kegiatan`,`nama_kegiatan`,`quota_peserta`,`tanggal`,`no_skp`,`tempat`,`id_instansi`,`penyelenggara`,`status`,`reg_online`,`ketua`,`nira_ketua`,`keterangan`,`legist_nama`,`legist_jabatan`,`legist_daerah`,`legist_nira`,`input_by`,`input_date`,`edit_by`,`edit_date`,`verif_admin`,`verif_date`,`verif_by`) values (1,'Bakti Sosial Penyuluhan Dan Pemeriksaan Kesehatan','25','2017-09-24','2800/DPW.PPNI-DIY/TAP/K.S/IX/2017','Plosokuning IV Minomartani Ngaglik Sleman  ',1,NULL,'Non Aktiv','Tidak','Lita Tarsia Nuswantari.SST','34040105637',NULL,NULL,NULL,NULL,NULL,2,'2017-10-05 17:01:36',NULL,NULL,'Di Setujui','2017-11-08 00:18:46',NULL),(2,'Seminar Kegawat daruratan Psikiatri (test_aplikasi)','5','2017-12-01','2802/DPW.PPNI-DIY/TAP/K.S/IX/2017	','RSJ Grhasia Propinsi DIY',1,NULL,'Non Aktif','Tidak','Ayunita Purnamasari ,SST','33333333','RSJ Grhasia','Tri Prabowo S.Kp.,M.Sc','Ketua DPW PPNI','Daerah Istimewa Yogyakarta','34040080589',6,'2017-11-08 00:33:18',NULL,NULL,'Tidak Disetujui','2017-11-13 19:39:26',1),(3,'\"Update Penanganan Kegawatdaruratan\" ','5','2017-12-15','2803/DPW.PPNI-DIY/TAP/K.S/IX/2017	','RS Panti Nugroho',8,NULL,'Non Aktif','Tidak','Sumarjono, S.Kep.Ns','9898989898','','Tri Prabowo S.Kp.,M.Sc','Ketua DPW PPNI','Daerah Istimewa Yogyakarta','34040080589',5,'2017-11-08 09:00:17',NULL,NULL,'Di Setujui','2017-11-20 14:15:12',1),(4,'Pengabdian Masyarakat : Senam Lansia dan Penyuluhan Kesehatan Jiwa ','30','2017-11-26','3600/DPW.PPNI-DIY/Tap/K.S/XI/2017','Dusun Karanglo Argomulyo Cangkringan, Sleman',1,NULL,'Aktif','Tidak','Ambar Bawono, SST','34040105606','RSJ Grhasia','Tri Prabowo','Ketua DPW PPNI DIY','DIY','34040080589',2,'2017-11-22 19:16:07',NULL,NULL,'Di Setujui','2017-11-28 16:10:40',2);

/*Table structure for table `t_peserta` */

DROP TABLE IF EXISTS `t_peserta`;

CREATE TABLE `t_peserta` (
  `id_peserta` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama_peserta` varchar(300) DEFAULT NULL,
  `instansi_asal` varchar(300) DEFAULT NULL,
  `sebagai` int(8) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `id_jenis_kegiatan` int(8) DEFAULT NULL,
  `id_provinsi` varchar(2) DEFAULT NULL,
  `id_kabupaten` varchar(4) DEFAULT NULL,
  `id_kecamatan` varchar(7) DEFAULT NULL,
  `id_desa` varchar(10) DEFAULT NULL,
  `input_by` int(3) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `edit_by` int(3) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `id_instansi` int(8) DEFAULT NULL,
  PRIMARY KEY (`id_peserta`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb3;

/*Data for the table `t_peserta` */

insert  into `t_peserta`(`id_peserta`,`nama_peserta`,`instansi_asal`,`sebagai`,`no_hp`,`alamat`,`email`,`id_jenis_kegiatan`,`id_provinsi`,`id_kabupaten`,`id_kecamatan`,`id_desa`,`input_by`,`input_date`,`edit_by`,`edit_date`,`id_instansi`) values (1,'Yayuk Sami Rahayu, S.Kep.Ns','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(2,'Wahyu Indriyono, SST','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(3,'Lita Tarsia Nuswantari, SST','RSJ Grhasia',1,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(4,'R Lelly Isnaini, SST','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(5,'Deny Laksono, A.Md.Kep','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(6,'Pudji Hastuti, S.Kep','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(7,'Ayunita Purnamasari, SST','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(8,'Wigati, SST','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(9,'Siska Ariyani, S.Kep','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(10,'Riza Umaroch, A.Md. Kep','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(11,'Dennis Andantin Seviyana, S.Kep.Ns','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(12,'Darojatun Nur Isnaini, AMK','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(13,'Sunardi, A.Md.Kep','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(14,'Retno Tri Widyastuti, A.Md.Kep','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(15,'Mamat Supri Rohmat, S.Kep.Ns','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(16,'Indarti Werdiningsih, SST','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(17,'Suratinem, AMK','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(18,'Ch Ika Purwandari, SST','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(19,'Agus Sukendro, AMK','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2017-10-09 17:29:55',NULL,NULL,1),(20,'Adi Kuswantoro, A.Md.Kep','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(21,'Dionisius Robiantara, A.Md.Kep','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(22,'Yuna Mustafa, A.Md.Kep','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(23,'Nafi\'atun Aliyya, A.Md.Kep','RSJ Grhasia',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(24,'M Fathoni, AMK','PSTW Abiyoso',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(25,'Anisa Nurul Khasanah, A.Md.Kep ','Panti Sosial Bina Laras',3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1),(27,'Ambar Bawono, SST','RS Jiwa Grhasia ',1,'087739711572','Tampungan','ambarbawono11@gmail.com',4,'34','3404','3404080','3404080001',2,'2017-11-22 19:29:54',NULL,NULL,1),(28,'Parjiyanto, A.Md.Kep','RS Jiwa Grhasia ',13,'081228102510','Jl Parangtritis','',4,'34','3402','3402080','3402080001',2,'2017-11-22 19:54:45',NULL,NULL,1),(29,'Dwi Iswanto, AMK','RS Jiwa Grhasia ',13,'085327816073','','',4,'34','3402','3402080','3402080001',2,'2017-11-22 20:02:18',NULL,NULL,1),(30,'Aris Pranjana, SST','RS Jiwa Grhasia',13,'08179419850','','',4,'','','','',2,'2017-11-22 22:02:09',NULL,NULL,1),(31,'Yonni Prianto, S.Kep.Ns.,M.Kep.Sp.Jiwa','RS Jiwa Grhasia',13,'082242067919','','',4,'','','','',2,'2017-11-22 22:12:59',NULL,NULL,1),(32,'Muhammad Taufik, AMK','RS Jiwa Grhasia',13,'087838830300','','',4,'','','','',2,'2017-11-22 22:19:47',NULL,NULL,1),(33,'Priyanta Nugraha, A.Md.Kep','RS Jiwa Grhasia',13,'081215700650','','',4,'','','','',2,'2017-11-23 10:14:33',NULL,NULL,1),(34,'Eti Daniavani, S.Kep.Ns','RS Jiwa Grhasia',13,'081328024774','','',4,'','','','',2,'2017-11-23 10:18:37',NULL,NULL,1),(35,'Hadi Pramono, S.Kep.Ns','RS Jiwa Grhasia',13,'085642569050','','',4,'','','','',2,'2017-11-23 10:21:12',NULL,NULL,1),(36,'Triyana Yulianti, S.Kep.Ns','RS Jiwa Grhasia',13,'085292172280','','',4,'','','','',2,'2017-11-23 10:23:53',NULL,NULL,1),(37,'Lisa Dwi Astuti, A.Md.Kep','RS Jiwa Grhasia',13,'085601568886','','',4,'','','','',2,'2017-11-23 19:06:59',NULL,NULL,1),(38,'Hesti Prastiwi, A.Md.Kep','RS Jiwa Grhasia',13,'085729403512','','',4,'','','','',2,'2017-11-23 19:08:22',NULL,NULL,1),(39,'Himawan Susanto, A.Md.Kep','RS Jiwa Grhasia',13,'085741889006','','',4,'','','','',2,'2017-11-23 19:09:53',NULL,NULL,1),(40,'Basuki Rachmat, SST','RS Jiwa Grhasia',13,'085725721444','','',4,'','','','',2,'2017-11-23 19:11:37',NULL,NULL,1),(41,'Windu Adi Yudha Permana, A.Md.Kep','RS Jiwa Grhasia',13,'085743438399','','',4,'','','','',2,'2017-11-23 19:12:43',NULL,NULL,1),(42,'Eka Suwartana, A.Md.Kep','RS Jiwa Grhasia',13,'085743202068','','',4,'','','','',2,'2017-11-23 19:14:38',NULL,NULL,1),(43,'Sriyatun, SST','RS Jiwa Grhasia',13,'081578621288','','',4,'','','','',2,'2017-11-23 19:16:00',NULL,NULL,1),(44,'Hardi Sumarti, SST','RS Jiwa Grhasia',13,'087838831909','','',4,'','','','',2,'2017-11-23 19:16:57',NULL,NULL,1),(45,'Ani Nur\'aini, SST','RS Jiwa Grhasia',13,'081227104516','','',4,'','','','',2,'2017-11-23 19:18:07',NULL,NULL,1),(46,'Sri Widodo, SST','RS Jiwa Grhasia',13,'081328227646','','',4,'','','','',2,'2017-11-23 19:19:18',NULL,NULL,1),(47,'Sri Suyatmi, S.Kep.Ns.,M.Kep','RS Jiwa Grhasia',13,'085868180373','','',4,'','','','',2,'2017-11-23 19:22:03',NULL,NULL,1),(48,'Akrim Wasniati, S.Kep.Ns.,MPH','RS Jiwa Grhasia',13,'081328667768','','',4,'','','','',2,'2017-11-23 19:23:51',NULL,NULL,1),(49,'Suharti, SST','RS Jiwa Grhasia',13,'085743179219','','',4,'','','','',2,'2017-11-23 19:26:36',NULL,NULL,1),(50,'Erna Sulistiyowati, A.Md.Kep','PSTW Abiyoso',13,'085725725050','','',4,'','','','',2,'2017-11-26 08:05:54',NULL,NULL,1),(51,'Ervina Fitrianingtias, A.Md.Kep','Panti Sosial Bina Laras',13,'085802274744','','',4,'','','','',2,'2017-11-26 08:07:36',NULL,NULL,1);

/*Table structure for table `wilayah_desa` */

DROP TABLE IF EXISTS `wilayah_desa`;

CREATE TABLE `wilayah_desa` (
  `id` varchar(10) NOT NULL,
  `kecamatan_id` varchar(7) DEFAULT NULL,
  `nama` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `wilayah_desa` */


/*Table structure for table `wilayah_kabupaten` */

DROP TABLE IF EXISTS `wilayah_kabupaten`;

CREATE TABLE `wilayah_kabupaten` (
  `id` varchar(4) NOT NULL,
  `provinsi_id` varchar(2) NOT NULL DEFAULT '',
  `nama` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `wilayah_kabupaten` */

insert  into `wilayah_kabupaten`(`id`,`provinsi_id`,`nama`) values ('1101','11','Kab. Simeulue'),('1102','11','Kab. Aceh Singkil'),('1103','11','Kab. Aceh Selatan'),('1104','11','Kab. Aceh Tenggara'),('1105','11','Kab. Aceh Timur'),('1106','11','Kab. Aceh Tengah'),('1107','11','Kab. Aceh Barat'),('1108','11','Kab. Aceh Besar'),('1109','11','Kab. Pidie'),('1110','11','Kab. Bireuen'),('1111','11','Kab. Aceh Utara'),('1112','11','Kab. Aceh Barat Daya'),('1113','11','Kab. Gayo Lues'),('1114','11','Kab. Aceh Tamiang'),('1115','11','Kab. Nagan Raya'),('1116','11','Kab. Aceh Jaya'),('1117','11','Kab. Bener Meriah'),('1118','11','Kab. Pidie Jaya'),('1171','11','Kota Banda Aceh'),('1172','11','Kota Sabang'),('1173','11','Kota Langsa'),('1174','11','Kota Lhokseumawe'),('1175','11','Kota Subulussalam'),('1201','12','Kab. Nias'),('1202','12','Kab. Mandailing Natal'),('1203','12','Kab. Tapanuli Selatan'),('1204','12','Kab. Tapanuli Tengah'),('1205','12','Kab. Tapanuli Utara'),('1206','12','Kab. Toba Samosir'),('1207','12','Kab. Labuhan Batu'),('1208','12','Kab. Asahan'),('1209','12','Kab. Simalungun'),('1210','12','Kab. Dairi'),('1211','12','Kab. Karo'),('1212','12','Kab. Deli Serdang'),('1213','12','Kab. Langkat'),('1214','12','Kab. Nias Selatan'),('1215','12','Kab. Humbang Hasundutan'),('1216','12','Kab. Pakpak Bharat'),('1217','12','Kab. Samosir'),('1218','12','Kab. Serdang Bedagai'),('1219','12','Kab. Batu Bara'),('1220','12','Kab. Padang Lawas Utara'),('1221','12','Kab. Padang Lawas'),('1222','12','Kab. Labuhan Batu Selatan'),('1223','12','Kab. Labuhan Batu Utara'),('1224','12','Kab. Nias Utara'),('1225','12','Kab. Nias Barat'),('1271','12','Kota Sibolga'),('1272','12','Kota Tanjung Balai'),('1273','12','Kota Pematang Siantar'),('1274','12','Kota Tebing Tinggi'),('1275','12','Kota Medan'),('1276','12','Kota Binjai'),('1277','12','Kota Padangsidimpuan'),('1278','12','Kota Gunungsitoli'),('1301','13','Kab. Kepulauan Mentawai'),('1302','13','Kab. Pesisir Selatan'),('1303','13','Kab. Solok'),('1304','13','Kab. Sijunjung'),('1305','13','Kab. Tanah Datar'),('1306','13','Kab. Padang Pariaman'),('1307','13','Kab. Agam'),('1308','13','Kab. Lima Puluh Kota'),('1309','13','Kab. Pasaman'),('1310','13','Kab. Solok Selatan'),('1311','13','Kab. Dharmasraya'),('1312','13','Kab. Pasaman Barat'),('1371','13','Kota Padang'),('1372','13','Kota Solok'),('1373','13','Kota Sawah Lunto'),('1374','13','Kota Padang Panjang'),('1375','13','Kota Bukittinggi'),('1376','13','Kota Payakumbuh'),('1377','13','Kota Pariaman'),('1401','14','Kab. Kuantan Singingi'),('1402','14','Kab. Indragiri Hulu'),('1403','14','Kab. Indragiri Hilir'),('1404','14','Kab. Pelalawan'),('1405','14','Kab. S I A K'),('1406','14','Kab. Kampar'),('1407','14','Kab. Rokan Hulu'),('1408','14','Kab. Bengkalis'),('1409','14','Kab. Rokan Hilir'),('1410','14','Kab. Kepulauan Meranti'),('1471','14','Kota Pekanbaru'),('1473','14','Kota D U M A I'),('1501','15','Kab. Kerinci'),('1502','15','Kab. Merangin'),('1503','15','Kab. Sarolangun'),('1504','15','Kab. Batang Hari'),('1505','15','Kab. Muaro Jambi'),('1506','15','Kab. Tanjung Jabung Timur'),('1507','15','Kab. Tanjung Jabung Barat'),('1508','15','Kab. Tebo'),('1509','15','Kab. Bungo'),('1571','15','Kota Jambi'),('1572','15','Kota Sungai Penuh'),('1601','16','Kab. Ogan Komering Ulu'),('1602','16','Kab. Ogan Komering Ilir'),('1603','16','Kab. Muara Enim'),('1604','16','Kab. Lahat'),('1605','16','Kab. Musi Rawas'),('1606','16','Kab. Musi Banyuasin'),('1607','16','Kab. Banyu Asin'),('1608','16','Kab. Ogan Komering Ulu Selatan'),('1609','16','Kab. Ogan Komering Ulu Timur'),('1610','16','Kab. Ogan Ilir'),('1611','16','Kab. Empat Lawang'),('1671','16','Kota Palembang'),('1672','16','Kota Prabumulih'),('1673','16','Kota Pagar Alam'),('1674','16','Kota Lubuklinggau'),('1701','17','Kab. Bengkulu Selatan'),('1702','17','Kab. Rejang Lebong'),('1703','17','Kab. Bengkulu Utara'),('1704','17','Kab. Kaur'),('1705','17','Kab. Seluma'),('1706','17','Kab. Mukomuko'),('1707','17','Kab. Lebong'),('1708','17','Kab. Kepahiang'),('1709','17','Kab. Bengkulu Tengah'),('1771','17','Kota Bengkulu'),('1801','18','Kab. Lampung Barat'),('1802','18','Kab. Tanggamus'),('1803','18','Kab. Lampung Selatan'),('1804','18','Kab. Lampung Timur'),('1805','18','Kab. Lampung Tengah'),('1806','18','Kab. Lampung Utara'),('1807','18','Kab. Way Kanan'),('1808','18','Kab. Tulangbawang'),('1809','18','Kab. Pesawaran'),('1810','18','Kab. Pringsewu'),('1811','18','Kab. Mesuji'),('1812','18','Kab. Tulang Bawang Barat'),('1813','18','Kab. Pesisir Barat'),('1871','18','Kota Bandar Lampung'),('1872','18','Kota Metro'),('1901','19','Kab. Bangka'),('1902','19','Kab. Belitung'),('1903','19','Kab. Bangka Barat'),('1904','19','Kab. Bangka Tengah'),('1905','19','Kab. Bangka Selatan'),('1906','19','Kab. Belitung Timur'),('1971','19','Kota Pangkal Pinang'),('2101','21','Kab. Karimun'),('2102','21','Kab. Bintan'),('2103','21','Kab. Natuna'),('2104','21','Kab. Lingga'),('2105','21','Kab. Kepulauan Anambas'),('2171','21','Kota B A T A M'),('2172','21','Kota Tanjung Pinang'),('3101','31','Kab. Kepulauan Seribu'),('3171','31','Kota Jakarta Selatan'),('3172','31','Kota Jakarta Timur'),('3173','31','Kota Jakarta Pusat'),('3174','31','Kota Jakarta Barat'),('3175','31','Kota Jakarta Utara'),('3201','32','Kab. Bogor'),('3202','32','Kab. Sukabumi'),('3203','32','Kab. Cianjur'),('3204','32','Kab. Bandung'),('3205','32','Kab. Garut'),('3206','32','Kab. Tasikmalaya'),('3207','32','Kab. Ciamis'),('3208','32','Kab. Kuningan'),('3209','32','Kab. Cirebon'),('3210','32','Kab. Majalengka'),('3211','32','Kab. Sumedang'),('3212','32','Kab. Indramayu'),('3213','32','Kab. Subang'),('3214','32','Kab. Purwakarta'),('3215','32','Kab. Karawang'),('3216','32','Kab. Bekasi'),('3217','32','Kab. Bandung Barat'),('3218','32','Kab. Pangandaran'),('3271','32','Kota Bogor'),('3272','32','Kota Sukabumi'),('3273','32','Kota Bandung'),('3274','32','Kota Cirebon'),('3275','32','Kota Bekasi'),('3276','32','Kota Depok'),('3277','32','Kota Cimahi'),('3278','32','Kota Tasikmalaya'),('3279','32','Kota Banjar'),('3301','33','Kab. Cilacap'),('3302','33','Kab. Banyumas'),('3303','33','Kab. Purbalingga'),('3304','33','Kab. Banjarnegara'),('3305','33','Kab. Kebumen'),('3306','33','Kab. Purworejo'),('3307','33','Kab. Wonosobo'),('3308','33','Kab. Magelang'),('3309','33','Kab. Boyolali'),('3310','33','Kab. Klaten'),('3311','33','Kab. Sukoharjo'),('3312','33','Kab. Wonogiri'),('3313','33','Kab. Karanganyar'),('3314','33','Kab. Sragen'),('3315','33','Kab. Grobogan'),('3316','33','Kab. Blora'),('3317','33','Kab. Rembang'),('3318','33','Kab. Pati'),('3319','33','Kab. Kudus'),('3320','33','Kab. Jepara'),('3321','33','Kab. Demak'),('3322','33','Kab. Semarang'),('3323','33','Kab. Temanggung'),('3324','33','Kab. Kendal'),('3325','33','Kab. Batang'),('3326','33','Kab. Pekalongan'),('3327','33','Kab. Pemalang'),('3328','33','Kab. Tegal'),('3329','33','Kab. Brebes'),('3371','33','Kota Magelang'),('3372','33','Kota Surakarta'),('3373','33','Kota Salatiga'),('3374','33','Kota Semarang'),('3375','33','Kota Pekalongan'),('3376','33','Kota Tegal'),('3401','34','Kab. Kulon Progo'),('3402','34','Kab. Bantul'),('3403','34','Kab. Gunung Kidul'),('3404','34','Kab. Sleman'),('3471','34','Kota Yogyakarta'),('3501','35','Kab. Pacitan'),('3502','35','Kab. Ponorogo'),('3503','35','Kab. Trenggalek'),('3504','35','Kab. Tulungagung'),('3505','35','Kab. Blitar'),('3506','35','Kab. Kediri'),('3507','35','Kab. Malang'),('3508','35','Kab. Lumajang'),('3509','35','Kab. Jember'),('3510','35','Kab. Banyuwangi'),('3511','35','Kab. Bondowoso'),('3512','35','Kab. Situbondo'),('3513','35','Kab. Probolinggo'),('3514','35','Kab. Pasuruan'),('3515','35','Kab. Sidoarjo'),('3516','35','Kab. Mojokerto'),('3517','35','Kab. Jombang'),('3518','35','Kab. Nganjuk'),('3519','35','Kab. Madiun'),('3520','35','Kab. Magetan'),('3521','35','Kab. Ngawi'),('3522','35','Kab. Bojonegoro'),('3523','35','Kab. Tuban'),('3524','35','Kab. Lamongan'),('3525','35','Kab. Gresik'),('3526','35','Kab. Bangkalan'),('3527','35','Kab. Sampang'),('3528','35','Kab. Pamekasan'),('3529','35','Kab. Sumenep'),('3571','35','Kota Kediri'),('3572','35','Kota Blitar'),('3573','35','Kota Malang'),('3574','35','Kota Probolinggo'),('3575','35','Kota Pasuruan'),('3576','35','Kota Mojokerto'),('3577','35','Kota Madiun'),('3578','35','Kota Surabaya'),('3579','35','Kota Batu'),('3601','36','Kab. Pandeglang'),('3602','36','Kab. Lebak'),('3603','36','Kab. Tangerang'),('3604','36','Kab. Serang'),('3671','36','Kota Tangerang'),('3672','36','Kota Cilegon'),('3673','36','Kota Serang'),('3674','36','Kota Tangerang Selatan'),('5101','51','Kab. Jembrana'),('5102','51','Kab. Tabanan'),('5103','51','Kab. Badung'),('5104','51','Kab. Gianyar'),('5105','51','Kab. Klungkung'),('5106','51','Kab. Bangli'),('5107','51','Kab. Karang Asem'),('5108','51','Kab. Buleleng'),('5171','51','Kota Denpasar'),('5201','52','Kab. Lombok Barat'),('5202','52','Kab. Lombok Tengah'),('5203','52','Kab. Lombok Timur'),('5204','52','Kab. Sumbawa'),('5205','52','Kab. Dompu'),('5206','52','Kab. Bima'),('5207','52','Kab. Sumbawa Barat'),('5208','52','Kab. Lombok Utara'),('5271','52','Kota Mataram'),('5272','52','Kota Bima'),('5301','53','Kab. Sumba Barat'),('5302','53','Kab. Sumba Timur'),('5303','53','Kab. Kupang'),('5304','53','Kab. Timor Tengah Selatan'),('5305','53','Kab. Timor Tengah Utara'),('5306','53','Kab. Belu'),('5307','53','Kab. Alor'),('5308','53','Kab. Lembata'),('5309','53','Kab. Flores Timur'),('5310','53','Kab. Sikka'),('5311','53','Kab. Ende'),('5312','53','Kab. Ngada'),('5313','53','Kab. Manggarai'),('5314','53','Kab. Rote Ndao'),('5315','53','Kab. Manggarai Barat'),('5316','53','Kab. Sumba Tengah'),('5317','53','Kab. Sumba Barat Daya'),('5318','53','Kab. Nagekeo'),('5319','53','Kab. Manggarai Timur'),('5320','53','Kab. Sabu Raijua'),('5371','53','Kota Kupang'),('6101','61','Kab. Sambas'),('6102','61','Kab. Bengkayang'),('6103','61','Kab. Landak'),('6104','61','Kab. Pontianak'),('6105','61','Kab. Sanggau'),('6106','61','Kab. Ketapang'),('6107','61','Kab. Sintang'),('6108','61','Kab. Kapuas Hulu'),('6109','61','Kab. Sekadau'),('6110','61','Kab. Melawi'),('6111','61','Kab. Kayong Utara'),('6112','61','Kab. Kubu Raya'),('6171','61','Kota Pontianak'),('6172','61','Kota Singkawang'),('6201','62','Kab. Kotawaringin Barat'),('6202','62','Kab. Kotawaringin Timur'),('6203','62','Kab. Kapuas'),('6204','62','Kab. Barito Selatan'),('6205','62','Kab. Barito Utara'),('6206','62','Kab. Sukamara'),('6207','62','Kab. Lamandau'),('6208','62','Kab. Seruyan'),('6209','62','Kab. Katingan'),('6210','62','Kab. Pulang Pisau'),('6211','62','Kab. Gunung Mas'),('6212','62','Kab. Barito Timur'),('6213','62','Kab. Murung Raya'),('6271','62','Kota Palangka Raya'),('6301','63','Kab. Tanah Laut'),('6302','63','Kab. Kota Baru'),('6303','63','Kab. Banjar'),('6304','63','Kab. Barito Kuala'),('6305','63','Kab. Tapin'),('6306','63','Kab. Hulu Sungai Selatan'),('6307','63','Kab. Hulu Sungai Tengah'),('6308','63','Kab. Hulu Sungai Utara'),('6309','63','Kab. Tabalong'),('6310','63','Kab. Tanah Bumbu'),('6311','63','Kab. Balangan'),('6371','63','Kota Banjarmasin'),('6372','63','Kota Banjar Baru'),('6401','64','Kab. Paser'),('6402','64','Kab. Kutai Barat'),('6403','64','Kab. Kutai Kartanegara'),('6404','64','Kab. Kutai Timur'),('6405','64','Kab. Berau'),('6409','64','Kab. Penajam Paser Utara'),('6471','64','Kota Balikpapan'),('6472','64','Kota Samarinda'),('6474','64','Kota Bontang'),('6501','65','Kab. Malinau'),('6502','65','Kab. Bulungan'),('6503','65','Kab. Tana Tidung'),('6504','65','Kab. Nunukan'),('6571','65','Kota Tarakan'),('7101','71','Kab. Bolaang Mongondow'),('7102','71','Kab. Minahasa'),('7103','71','Kab. Kepulauan Sangihe'),('7104','71','Kab. Kepulauan Talaud'),('7105','71','Kab. Minahasa Selatan'),('7106','71','Kab. Minahasa Utara'),('7107','71','Kab. Bolaang Mongondow Utara'),('7108','71','Kab. Siau Tagulandang Biaro'),('7109','71','Kab. Minahasa Tenggara'),('7110','71','Kab. Bolaang Mongondow Selatan'),('7111','71','Kab. Bolaang Mongondow Timur'),('7171','71','Kota Manado'),('7172','71','Kota Bitung'),('7173','71','Kota Tomohon'),('7174','71','Kota Kotamobagu'),('7201','72','Kab. Banggai Kepulauan'),('7202','72','Kab. Banggai'),('7203','72','Kab. Morowali'),('7204','72','Kab. Poso'),('7205','72','Kab. Donggala'),('7206','72','Kab. Toli-toli'),('7207','72','Kab. Buol'),('7208','72','Kab. Parigi Moutong'),('7209','72','Kab. Tojo Una-una'),('7210','72','Kab. Sigi'),('7271','72','Kota Palu'),('7301','73','Kab. Kepulauan Selayar'),('7302','73','Kab. Bulukumba'),('7303','73','Kab. Bantaeng'),('7304','73','Kab. Jeneponto'),('7305','73','Kab. Takalar'),('7306','73','Kab. Gowa'),('7307','73','Kab. Sinjai'),('7308','73','Kab. Maros'),('7309','73','Kab. Pangkajene Dan Kepulauan'),('7310','73','Kab. Barru'),('7311','73','Kab. Bone'),('7312','73','Kab. Soppeng'),('7313','73','Kab. Wajo'),('7314','73','Kab. Sidenreng Rappang'),('7315','73','Kab. Pinrang'),('7316','73','Kab. Enrekang'),('7317','73','Kab. Luwu'),('7318','73','Kab. Tana Toraja'),('7322','73','Kab. Luwu Utara'),('7325','73','Kab. Luwu Timur'),('7326','73','Kab. Toraja Utara'),('7371','73','Kota Makassar'),('7372','73','Kota Parepare'),('7373','73','Kota Palopo'),('7401','74','Kab. Buton'),('7402','74','Kab. Muna'),('7403','74','Kab. Konawe'),('7404','74','Kab. Kolaka'),('7405','74','Kab. Konawe Selatan'),('7406','74','Kab. Bombana'),('7407','74','Kab. Wakatobi'),('7408','74','Kab. Kolaka Utara'),('7409','74','Kab. Buton Utara'),('7410','74','Kab. Konawe Utara'),('7471','74','Kota Kendari'),('7472','74','Kota Baubau'),('7501','75','Kab. Boalemo'),('7502','75','Kab. Gorontalo'),('7503','75','Kab. Pohuwato'),('7504','75','Kab. Bone Bolango'),('7505','75','Kab. Gorontalo Utara'),('7571','75','Kota Gorontalo'),('7601','76','Kab. Majene'),('7602','76','Kab. Polewali Mandar'),('7603','76','Kab. Mamasa'),('7604','76','Kab. Mamuju'),('7605','76','Kab. Mamuju Utara'),('8101','81','Kab. Maluku Tenggara Barat'),('8102','81','Kab. Maluku Tenggara'),('8103','81','Kab. Maluku Tengah'),('8104','81','Kab. Buru'),('8105','81','Kab. Kepulauan Aru'),('8106','81','Kab. Seram Bagian Barat'),('8107','81','Kab. Seram Bagian Timur'),('8108','81','Kab. Maluku Barat Daya'),('8109','81','Kab. Buru Selatan'),('8171','81','Kota Ambon'),('8172','81','Kota Tual'),('8201','82','Kab. Halmahera Barat'),('8202','82','Kab. Halmahera Tengah'),('8203','82','Kab. Kepulauan Sula'),('8204','82','Kab. Halmahera Selatan'),('8205','82','Kab. Halmahera Utara'),('8206','82','Kab. Halmahera Timur'),('8207','82','Kab. Pulau Morotai'),('8271','82','Kota Ternate'),('8272','82','Kota Tidore Kepulauan'),('9101','91','Kab. Fakfak'),('9102','91','Kab. Kaimana'),('9103','91','Kab. Teluk Wondama'),('9104','91','Kab. Teluk Bintuni'),('9105','91','Kab. Manokwari'),('9106','91','Kab. Sorong Selatan'),('9107','91','Kab. Sorong'),('9108','91','Kab. Raja Ampat'),('9109','91','Kab. Tambrauw'),('9110','91','Kab. Maybrat'),('9171','91','Kota Sorong'),('9401','94','Kab. Merauke'),('9402','94','Kab. Jayawijaya'),('9403','94','Kab. Jayapura'),('9404','94','Kab. Nabire'),('9408','94','Kab. Kepulauan Yapen'),('9409','94','Kab. Biak Numfor'),('9410','94','Kab. Paniai'),('9411','94','Kab. Puncak Jaya'),('9412','94','Kab. Mimika'),('9413','94','Kab. Boven Digoel'),('9414','94','Kab. Mappi'),('9415','94','Kab. Asmat'),('9416','94','Kab. Yahukimo'),('9417','94','Kab. Pegunungan Bintang'),('9418','94','Kab. Tolikara'),('9419','94','Kab. Sarmi'),('9420','94','Kab. Keerom'),('9426','94','Kab. Waropen'),('9427','94','Kab. Supiori'),('9428','94','Kab. Mamberamo Raya'),('9429','94','Kab. Nduga'),('9430','94','Kab. Lanny Jaya'),('9431','94','Kab. Mamberamo Tengah'),('9432','94','Kab. Yalimo'),('9433','94','Kab. Puncak'),('9434','94','Kab. Dogiyai'),('9435','94','Kab. Intan Jaya'),('9436','94','Kab. Deiyai'),('9471','94','Kota Jayapura');

/*Table structure for table `wilayah_kecamatan` */

DROP TABLE IF EXISTS `wilayah_kecamatan`;

CREATE TABLE `wilayah_kecamatan` (
  `id` varchar(7) NOT NULL,
  `kabupaten_id` varchar(4) NOT NULL DEFAULT '',
  `nama` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `wilayah_kecamatan` */


/*Table structure for table `wilayah_provinsi` */

DROP TABLE IF EXISTS `wilayah_provinsi`;

CREATE TABLE `wilayah_provinsi` (
  `id` varchar(2) NOT NULL,
  `nama` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `wilayah_provinsi` */

insert  into `wilayah_provinsi`(`id`,`nama`) values ('11','Aceh'),('12','Sumatera Utara'),('13','Sumatera Barat'),('14','Riau'),('15','Jambi'),('16','Sumatera Selatan'),('17','Bengkulu'),('18','Lampung'),('19','Kepulauan Bangka Belitung'),('21','Kepulauan Riau'),('31','Dki Jakarta'),('32','Jawa Barat'),('33','Jawa Tengah'),('34','Di Yogyakarta'),('35','Jawa Timur'),('36','Banten'),('51','Bali'),('52','Nusa Tenggara Barat'),('53','Nusa Tenggara Timur'),('61','Kalimantan Barat'),('62','Kalimantan Tengah'),('63','Kalimantan Selatan'),('64','Kalimantan Timur'),('65','Kalimantan Utara'),('71','Sulawesi Utara'),('72','Sulawesi Tengah'),('73','Sulawesi Selatan'),('74','Sulawesi Tenggara'),('75','Gorontalo'),('76','Sulawesi Barat'),('81','Maluku'),('82','Maluku Utara'),('91','Papua Barat'),('94','Papua');

/*Table structure for table `menu_user` */

DROP TABLE IF EXISTS `menu_user`;

/*!50001 DROP VIEW IF EXISTS `menu_user` */;
/*!50001 DROP TABLE IF EXISTS `menu_user` */;

/*!50001 CREATE TABLE  `menu_user`(
 `id_user` int(6) ,
 `id_menu` int(2) ,
 `nama_modul` varchar(35) ,
 `link_modul` varchar(120) ,
 `aktif` enum('Tidak','Ya') ,
 `parent_id` int(2) ,
 `urutan` int(3) ,
 `urutan1` int(3) ,
 `icon` varchar(100) 
)*/;

/*View structure for view menu_user */

/*!50001 DROP TABLE IF EXISTS `menu_user` */;
/*!50001 DROP VIEW IF EXISTS `menu_user` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `menu_user` AS (select `m_menu_pengguna`.`id_user` AS `id_user`,`m_menu`.`id_menu` AS `id_menu`,`m_menu`.`nama_modul` AS `nama_modul`,`m_menu`.`link_modul` AS `link_modul`,`m_menu`.`aktif` AS `aktif`,`m_menu`.`parent_id` AS `parent_id`,`m_menu`.`urutan` AS `urutan`,`m_menu`.`urutan1` AS `urutan1`,`m_menu`.`icon` AS `icon` from (`m_menu_pengguna` join `m_menu` on(`m_menu_pengguna`.`id_menu` = `m_menu`.`id_menu`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;