# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.25)
# Database: seminar
# Generation Time: 2017-06-11 16:34:50 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table member
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `member_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT '',
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT '',
  `password` varchar(50) DEFAULT '',
  `gender` varchar(2) DEFAULT NULL,
  `dob` date NOT NULL DEFAULT '0000-00-00',
  `phone` varchar(20) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `code_activation` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;

INSERT INTO `member` (`member_id`, `firstname`, `lastname`, `email`, `password`, `gender`, `dob`, `phone`, `photo`, `status`, `code_activation`, `created_date`, `modified_date`)
VALUES
	(1,'luqmans','hakim','luqman@gmail.com','MmY5OTRlZTJjNTg3ZDJhNmM5ZmVhOTVjMDMwMDk3M2I=','L','1992-06-16','021','http://localhost/seminar/assets/uploads/no-photo.png',1,'uLRswK9Y4vajn6tiXBiY','2017-05-20 12:51:12','2017-05-25 19:52:30'),
	(3,'rio','josef','rio@gmail.com','Mjk2NTA2OTAyYzY5M2I0NTg3MDdhZDZmN2UyNGE1NDQ=','L','1990-06-18','0812','http://localhost/seminar/assets/uploads/no-photo.png',1,'21f5IEeHx1XIocrdUV46','2017-05-25 17:26:09',NULL),
	(4,'pentry','yurhadi','pentry@gmail.com','Mjk2NTA2OTAyYzY5M2I0NTg3MDdhZDZmN2UyNGE1NDQ=','L','1989-08-16','021','http://localhost/seminar/assets/uploads/no-photo.png',1,'k8IgMFlrR1tZhBqRbwHr','2017-05-29 23:53:55',NULL),
	(7,'sandra','DJ','sandra@gmail.com','Mjk2NTA2OTAyYzY5M2I0NTg3MDdhZDZmN2UyNGE1NDQ=','L','1993-10-20','0812','http://localhost/seminar/assets/uploads/no-photo.png',1,'PTs64BzMboVmveaRcEl8','2017-06-08 13:28:14',NULL),
	(9,'robert','purnama','robert@gmail.com','Mjk2NTA2OTAyYzY5M2I0NTg3MDdhZDZmN2UyNGE1NDQ=','L','1980-05-12','021','http://localhost/seminar/assets/uploads/no-photo.png',1,'UaDo9J0q4TgiJ9b7PtpC','2017-06-11 14:36:35',NULL),
	(10,'isaac','omy','isaac@gmail.com','Mjk2NTA2OTAyYzY5M2I0NTg3MDdhZDZmN2UyNGE1NDQ=','L','1992-05-04','021','http://localhost/seminar/assets/uploads/no-photo.png',1,'Br2yCCtTF8vqcmjr1aFq','2017-06-11 14:38:21',NULL),
	(16,'Muhammad','Haveis','haveis@gmail.com','ODdkOWJiNDAwYzA2MzQ2OTFmMGUzYmFhZjFlMmZkMGQ=','L','1989-08-09','112233445566','http://localhost/seminar/assets/uploads/member/display/100/150/NdZaaJfr1o.jpg',1,'8sVReOWnbO5c2SO7U85G','2017-06-11 23:32:40',NULL);

/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table seminar
# ------------------------------------------------------------

DROP TABLE IF EXISTS `seminar`;

CREATE TABLE `seminar` (
  `seminar_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tema` varchar(50) DEFAULT NULL,
  `description` text,
  `jadwal` datetime DEFAULT NULL,
  `tempat` varchar(50) DEFAULT NULL,
  `pembicara` varchar(100) DEFAULT NULL,
  `kuota` int(11) DEFAULT NULL,
  `sisa_kuota` int(11) DEFAULT NULL,
  `poster` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`seminar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `seminar` WRITE;
/*!40000 ALTER TABLE `seminar` DISABLE KEYS */;

INSERT INTO `seminar` (`seminar_id`, `user_id`, `tema`, `description`, `jadwal`, `tempat`, `pembicara`, `kuota`, `sisa_kuota`, `poster`, `status`, `created_date`, `modified_date`)
VALUES
	(1,1,'Big Data','IT Big Data','2017-07-28 08:55:00','Auditorium Mercu Buana','Agus',50,47,'http://localhost/seminar/assets/uploads/poster_seminar/display/250/400/fypepd7sox.jpg',1,'2017-05-20 12:43:13','2017-05-20 12:46:03'),
	(2,1,'IT Security','IT Security','2017-08-17 08:00:00','Auditorium Mercu Buana','Budi',100,98,'http://localhost/seminar/assets/uploads/poster_seminar/display/250/400/VW4BQBljgJ.jpg',1,'2017-05-20 12:47:19','2017-06-10 21:45:18'),
	(4,1,'Mobile Application','Android','2017-07-20 09:00:00','Auditorium Mercu Buana','Harianto',50,49,'http://localhost/seminar/assets/uploads/poster_seminar/display/250/400/A6VJMchr5p.jpg',1,'2017-05-23 19:50:48','2017-05-25 17:06:37'),
	(5,1,'Smart City','Smart City','2017-06-10 21:50:00','Auditorium Mercu Buana','Ibnu Sina',100,97,NULL,1,'2017-06-10 21:28:59','2017-06-10 21:54:54');

/*!40000 ALTER TABLE `seminar` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table seminar_order
# ------------------------------------------------------------

DROP TABLE IF EXISTS `seminar_order`;

CREATE TABLE `seminar_order` (
  `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `seminar_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `serial` varchar(150) NOT NULL DEFAULT '',
  `attended` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `seminar_order` WRITE;
/*!40000 ALTER TABLE `seminar_order` DISABLE KEYS */;

INSERT INTO `seminar_order` (`order_id`, `seminar_id`, `member_id`, `serial`, `attended`, `created_date`)
VALUES
	(1,1,3,'BGDT-0001',0,'2017-06-10 20:34:10'),
	(2,2,1,'TSCRTY-0001',0,'2017-06-10 20:43:55'),
	(3,5,1,'SMRTCTY-0001',0,'2017-06-10 21:33:14'),
	(4,1,1,'BGDT-0002',0,'2017-06-10 21:51:07'),
	(5,5,3,'SMRTCTY-0002',0,'2017-06-10 21:52:33'),
	(6,5,7,'SMRTCTY-0003',0,'2017-06-10 21:53:21'),
	(7,4,3,'MBLPPLCTN-0001',0,'2017-06-11 14:29:18'),
	(8,2,3,'TSCRTY-0002',0,'2017-06-11 15:43:24'),
	(9,1,7,'BGDT-0003',0,'2017-06-11 21:03:54');

/*!40000 ALTER TABLE `seminar_order` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL DEFAULT '',
  `username` varchar(50) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(20) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`user_id`, `role`, `username`, `fullname`, `email`, `password`, `phone`, `created_date`, `modified_date`)
VALUES
	(1,'admin','isankhairul','khairul ihksan','isankhairul@gmail.com','MDczMzM1MTg3OWIyZmE5YmQwNWM3Y2EzMDYxNTI5YzA=','021','2017-05-13 15:08:36','2017-05-13 16:27:27'),
	(2,'editor','luqman','luqman hakim ','alakazamta@gmail.com','Y2NmNWQ4ODUzNDZmYzAxZjBjYTk1Njk4MTQyY2QxMDM=','021','2017-05-13 16:30:44','2017-05-13 18:40:02');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
