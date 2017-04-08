# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.25)
# Database: seminar
# Generation Time: 2017-04-08 06:50:29 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table fakultas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fakultas`;

CREATE TABLE `fakultas` (
  `id_fakultas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_fakultas` varchar(40) NOT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `status_fakultas` varchar(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_fakultas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `fakultas` WRITE;
/*!40000 ALTER TABLE `fakultas` DISABLE KEYS */;

INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`, `date_create`, `date_update`, `status_fakultas`)
VALUES
	(1,'FIKOM','2016-06-14 19:21:53','2016-06-20 13:30:12','1'),
	(2,'FASILKOM','2016-06-15 11:36:17','2016-06-15 11:39:00','1'),
	(3,'FPSI','2016-06-19 14:59:48',NULL,'1'),
	(4,'FDSK','2016-06-20 11:55:39',NULL,'1');

/*!40000 ALTER TABLE `fakultas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table jurusan_fakultas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jurusan_fakultas`;

CREATE TABLE `jurusan_fakultas` (
  `id_jurusan_fakultas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(60) NOT NULL,
  `id_fakultas` varchar(5) NOT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `status_jurusan` varchar(5) DEFAULT '1',
  PRIMARY KEY (`id_jurusan_fakultas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `jurusan_fakultas` WRITE;
/*!40000 ALTER TABLE `jurusan_fakultas` DISABLE KEYS */;

INSERT INTO `jurusan_fakultas` (`id_jurusan_fakultas`, `nama_jurusan`, `id_fakultas`, `date_create`, `date_update`, `status_jurusan`)
VALUES
	(1,'TI','2','2016-06-20 11:59:18','2016-06-20 13:33:11','1'),
	(2,'SI','2','2016-06-27 14:16:20',NULL,'1'),
	(3,'PSIKOLOGI','3','2016-06-27 14:16:36',NULL,'1'),
	(4,'PUBLIC RELATION','1','2016-06-27 14:16:52',NULL,'1'),
	(5,'DESIGN KOMUNIKASI','1','2016-06-27 14:17:04',NULL,'1');

/*!40000 ALTER TABLE `jurusan_fakultas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kategori_peserta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kategori_peserta`;

CREATE TABLE `kategori_peserta` (
  `id_kategori_peserta` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_peserta` int(11) NOT NULL,
  `create_date_kategori_peserta` date NOT NULL,
  `update_date_kategori_peserta` date NOT NULL,
  PRIMARY KEY (`id_kategori_peserta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table kategori_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kategori_user`;

CREATE TABLE `kategori_user` (
  `id_kategori_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori_user` varchar(100) NOT NULL,
  `create_date_kategori_user` date NOT NULL,
  `update_date_kategori_user` date DEFAULT NULL,
  PRIMARY KEY (`id_kategori_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `kategori_user` WRITE;
/*!40000 ALTER TABLE `kategori_user` DISABLE KEYS */;

INSERT INTO `kategori_user` (`id_kategori_user`, `nama_kategori_user`, `create_date_kategori_user`, `update_date_kategori_user`)
VALUES
	(1,'admin 234','2016-05-19','2016-05-23');

/*!40000 ALTER TABLE `kategori_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table mahasiswa
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mahasiswa`;

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT,
  `nama_depan` varchar(100) NOT NULL,
  `nama_belakang` varchar(100) DEFAULT NULL,
  `nim_mahasiswa` varchar(20) NOT NULL,
  `email_mahasiswa` varchar(175) NOT NULL,
  `alamat_mahasiswa` varchar(250) DEFAULT NULL,
  `telp_mahasiswa` varchar(14) DEFAULT NULL,
  `tipe_mahasiswa` varchar(5) CHARACTER SET big5 NOT NULL COMMENT 'untuk mengetahui,\n1 = reguler\n2 = paraler',
  `tahun_masuk` varchar(8) NOT NULL,
  `semester_mahasiswa` varchar(10) NOT NULL,
  `password_mahasiswa` varchar(150) NOT NULL,
  `id_jurusan_fak` varchar(5) NOT NULL,
  `photo_mahasiswa` varchar(200) DEFAULT NULL,
  `status_mahasiswa` varchar(15) DEFAULT '1',
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id_mahasiswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `mahasiswa` WRITE;
/*!40000 ALTER TABLE `mahasiswa` DISABLE KEYS */;

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama_depan`, `nama_belakang`, `nim_mahasiswa`, `email_mahasiswa`, `alamat_mahasiswa`, `telp_mahasiswa`, `tipe_mahasiswa`, `tahun_masuk`, `semester_mahasiswa`, `password_mahasiswa`, `id_jurusan_fak`, `photo_mahasiswa`, `status_mahasiswa`, `date_create`, `date_update`)
VALUES
	(1,'Luqman','Hakim','4151412013712','luqman@gmail.com','jkarta','mament','1','2014','ganjil','NmZkNzQyYTYxYmQwMzQ4MDRjMDBjNDliMTgwNDUwMjA=','1','http://localhost/seminar3/assets/uploads/mahasiswa/display/100/150/e86yjfcqoq.jpg','1','2016-06-17 00:00:00',NULL),
	(2,'Luqman','Hakim','4151412','luqman@gmail.com','Jakarta Barat','090909','1','2015','ganjil','202cb962ac59075b964b07152d234b70','2','http://localhost/seminar3/assets/uploads/mahasiswa/display/100/150/955lu4ve1m.jpg','1','2016-06-18 00:00:00',NULL),
	(3,'Luqman','aja','6767','test@gmail.com','jakarta brat','098988','1','2016','genap','NmZkNzQyYTYxYmQwMzQ4MDRjMDBjNDliMTgwNDUwMjA=','2','http://localhost/seminar/assets/uploads/mahasiswa/display/100/150','1','2016-06-27 00:00:00',NULL),
	(4,'isan','ssss','1234','sss@ddd.fd','ssssaaq','11111','1','2016','ganjil','MDBmZmE3YjJjYjY1NjU2ZDBmODgxNWU3YTBlNDFjMWI=','1','http://localhost/seminar/assets/uploads/mahasiswa/display/100/150/no-photo.png','1','2016-06-27 00:00:00','2017-03-22 14:58:28'),
	(5,'sss','sss','123','s@ss.ss','saas','123','1','2016','ganjil','NmZkNzQyYTYxYmQwMzQ4MDRjMDBjNDliMTgwNDUwMjA=','2','http://localhost/seminar/assets/uploads/mahasiswa/display/100/150/no-photo.png','1','2016-06-27 00:00:00',NULL),
	(6,'san','san','1234567890','san@sa.sa','sa','1234567890','1','2016','ganjil','NmZkNzQyYTYxYmQwMzQ4MDRjMDBjNDliMTgwNDUwMjA=','4','http://localhost/seminar/assets/uploads/mahasiswa/display/100/150/no-photo.png','1','2016-06-27 00:00:00',NULL);

/*!40000 ALTER TABLE `mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table order
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `id_seminar` int(11) DEFAULT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `id_ticket` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;

INSERT INTO `order` (`id_order`, `id_seminar`, `id_mahasiswa`, `id_ticket`, `create_date`)
VALUES
	(10,5,4,251,'2017-03-22 13:26:47'),
	(11,5,3,252,'2017-04-01 12:40:19');

/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table peserta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `peserta`;

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL AUTO_INCREMENT,
  `nama_peserta` varchar(50) NOT NULL,
  `password_peserta` varchar(100) NOT NULL,
  `email_peserta` varchar(100) NOT NULL,
  `alamat_peserta` varchar(200) NOT NULL,
  `nomor_telepon_peserta` varchar(15) NOT NULL,
  `nim_peserta` varchar(15) NOT NULL,
  `status_peserta` int(11) NOT NULL,
  `bukti_pembayaran_peserta` varchar(300) NOT NULL,
  `create_date_peserta` date NOT NULL,
  `update_date_peserta` date NOT NULL,
  PRIMARY KEY (`id_peserta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table seminar
# ------------------------------------------------------------

DROP TABLE IF EXISTS `seminar`;

CREATE TABLE `seminar` (
  `id_seminar` int(11) NOT NULL AUTO_INCREMENT,
  `tema_seminar` varchar(200) NOT NULL,
  `jadwal_seminar` datetime NOT NULL,
  `pembicara_seminar` varchar(50) NOT NULL,
  `tempat_seminar` varchar(50) NOT NULL,
  `kuota_seminar` int(11) NOT NULL,
  `sisa_kuota` varchar(5) DEFAULT NULL,
  `untuk_kelas` varchar(5) NOT NULL COMMENT '1 = reguler\n2 = paralel',
  `semester_seminar` varchar(200) DEFAULT NULL COMMENT 'untuk semester 1 - 8 ',
  `jurusan_seminar` varchar(200) CHARACTER SET big5 DEFAULT NULL,
  `poster_seminar` varchar(200) NOT NULL,
  `sertifikat_seminar` varchar(200) DEFAULT NULL,
  `status_seminar` int(11) NOT NULL DEFAULT '1',
  `create_date_seminar` date NOT NULL,
  `update_date_seminar` date NOT NULL,
  PRIMARY KEY (`id_seminar`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `seminar` WRITE;
/*!40000 ALTER TABLE `seminar` DISABLE KEYS */;

INSERT INTO `seminar` (`id_seminar`, `tema_seminar`, `jadwal_seminar`, `pembicara_seminar`, `tempat_seminar`, `kuota_seminar`, `sisa_kuota`, `untuk_kelas`, `semester_seminar`, `jurusan_seminar`, `poster_seminar`, `sertifikat_seminar`, `status_seminar`, `create_date_seminar`, `update_date_seminar`)
VALUES
	(1,'MEMBANGUN','2016-06-30 13:19:00','ADHIWONGSO','A089',50,'50','1','4,6','1','http://localhost/seminar/assets/uploads/poster_seminar/display/250/400/vfxfbsgyza.jpg','http://localhost/seminar/assets/uploads/sertifikat_seminar/display/400/150/5rz6aze4gd.jpg',1,'2016-06-27','0000-00-00'),
	(2,'TESTER SEMINAR 2','2016-06-27 20:23:00','BANG ALI','A089',80,'80','1','6','1','http://localhost/seminar/assets/uploads/poster_seminar/display/250/400/6eglncfvya.jpg','http://localhost/seminar/assets/uploads/sertifikat_seminar/display/400/150/qmihdpx1pq.jpg',1,'2016-06-27','0000-00-00'),
	(3,'PENGEMBANGAN KARAKTER','2016-09-06 01:38:00','LUQMAN','A089',30,'30','2','2,4,6','1','http://localhost/seminar/assets/uploads/poster_seminar/display/250/400/2e84sbqhu8.jpg','http://localhost/seminar/assets/uploads/sertifikat_seminar/display/400/150/ds6vdgtup1.jpg',1,'2016-06-27','0000-00-00'),
	(4,'MEMBANGUN','1970-01-01 07:00:00','TESTER KETIGA','JAKARTA',90,'90','1','1,5','1','http://localhost/seminar/assets/uploads/poster_seminar/display/250/400/lodms43b1r.jpg','http://localhost/seminar/assets/uploads/sertifikat_seminar/display/400/150/k5l69xcbaj.jpg',1,'2016-06-27','0000-00-00'),
	(5,'PERJUANGAN BANGSA','2017-05-09 07:00:00','LUQMAN','JAKRTA',10,'8','1','1,2,3,4,5,6','4,1,3','http://localhost/seminar/assets/uploads/poster_seminar/display/250/400/cx7id8js1t.jpg','http://localhost/seminar/assets/uploads/sertifikat_seminar/display/400/150/9pe3bkerlg.jpg',1,'2016-06-27','2017-03-22');

/*!40000 ALTER TABLE `seminar` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ticket_manual
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ticket_manual`;

CREATE TABLE `ticket_manual` (
  `id_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `id_seminar` varchar(10) DEFAULT NULL,
  `serial` varchar(20) DEFAULT NULL,
  `secret` varchar(20) DEFAULT NULL,
  `expire_time` int(11) DEFAULT NULL,
  `consume` int(3) DEFAULT '0',
  `used` tinyint(1) DEFAULT '0',
  `created_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ticket`),
  KEY `deal_id` (`id_seminar`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(75) NOT NULL,
  `email_user` varchar(150) NOT NULL,
  `telp_user` varchar(15) DEFAULT NULL,
  `kategori_user` varchar(15) NOT NULL,
  `username_user` varchar(75) NOT NULL,
  `password` varchar(300) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id_user`, `nama_user`, `email_user`, `telp_user`, `kategori_user`, `username_user`, `password`, `create_date`, `update_date`)
VALUES
	(1,'isan','isankhairul@gmail.com','081293939831','admin','isan','MDBmZmE3YjJjYjY1NjU2ZDBmODgxNWU3YTBlNDFjMWI=','2016-06-03 23:40:30','2016-06-04 23:59:40');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
