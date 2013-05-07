# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.28)
# Database: sitemap
# Generation Time: 2013-05-06 22:50:36 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table sitemap
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sitemap`;

CREATE TABLE `sitemap` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `type_id` int(11) NOT NULL DEFAULT '1',
  `job_id` int(11) NOT NULL,
  `URL` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `sitemap` WRITE;
/*!40000 ALTER TABLE `sitemap` DISABLE KEYS */;

INSERT INTO `sitemap` (`id`, `name`, `pid`, `order`, `type_id`, `job_id`, `URL`)
VALUES
	(1,'UX Studies',NULL,1,1,1,NULL),
	(2,'1800 Flowers',1,1,1,1,NULL),
	(3,'Study 1',2,1,1,1,NULL),
	(4,'Study 2',2,2,1,1,NULL),
	(5,'Study 3',2,3,1,1,NULL),
	(6,'Study 4',2,4,1,1,NULL),
	(7,'Fannie May',1,2,1,1,NULL),
	(8,'Study 1',7,1,1,1,NULL),
	(9,'Examples',7,2,2,1,NULL),
	(10,'The Popcorn Factory',1,3,1,1,NULL),
	(11,'About Us',NULL,2,1,1,NULL),
	(12,'Our Team',11,1,1,1,NULL),
	(13,'Employee 1',12,1,1,1,NULL),
	(14,'Employee 2',12,2,1,1,NULL),
	(15,'Employee 3',12,3,1,1,NULL),
	(16,'Employee 3\'s Dog',15,1,1,1,NULL),
	(17,'Puppy 1',16,1,1,1,NULL),
	(18,'Chew Toy',17,1,1,1,NULL),
	(19,'Chew Toy',17,2,1,1,NULL),
	(20,'Puppy 2',16,2,1,1,NULL),
	(21,'Puppy 3',16,3,1,1,NULL),
	(22,'Employee 4',12,4,1,1,NULL),
	(23,'Our Mission',11,2,1,1,NULL),
	(24,'Our BS Story',11,3,1,1,NULL),
	(25,'Work',NULL,3,1,1,NULL),
	(26,'Fannie May',25,1,1,1,NULL),
	(27,'Cheryls',25,2,1,1,NULL),
	(28,'The Popcorn Factory',25,3,1,1,NULL),
	(29,'Work 1',26,1,1,1,NULL),
	(30,'Work 1',27,1,1,1,NULL),
	(31,'Work 2',27,2,1,1,NULL),
	(32,'Work 3',27,3,1,1,NULL);

/*!40000 ALTER TABLE `sitemap` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
