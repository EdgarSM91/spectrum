-- MySQL dump 10.13  Distrib 5.5.38, for Linux (x86_64)
--
-- Host: localhost    Database: cd_spectrum
-- ------------------------------------------------------
-- Server version	5.5.38

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Temporary table structure for view `VListCourses`
--

DROP TABLE IF EXISTS `VListCourses`;
/*!50001 DROP VIEW IF EXISTS `VListCourses`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `VListCourses` (
  `cid` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `permalink` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `date_creation` tinyint NOT NULL,
  `name_user` tinyint NOT NULL,
  `name_category` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `cd_category`
--

DROP TABLE IF EXISTS `cd_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cd_category` (
  `cgid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`cgid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cd_category`
--

LOCK TABLES `cd_category` WRITE;
/*!40000 ALTER TABLE `cd_category` DISABLE KEYS */;
INSERT INTO `cd_category` VALUES (17,'Tecnología','2015-08-10'),(18,'Petróleo','2015-08-10'),(20,'Conejo','2015-08-14'),(21,'Pollo','2015-08-19');
/*!40000 ALTER TABLE `cd_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cd_client`
--

DROP TABLE IF EXISTS `cd_client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cd_client` (
  `clid` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`clid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cd_client`
--

LOCK TABLES `cd_client` WRITE;
/*!40000 ALTER TABLE `cd_client` DISABLE KEYS */;
/*!40000 ALTER TABLE `cd_client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cd_courses`
--

DROP TABLE IF EXISTS `cd_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cd_courses` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `permalink` varchar(45) NOT NULL,
  `image` varchar(200) NOT NULL,
  `description` varchar(250) NOT NULL,
  `objective` text NOT NULL,
  `directed` text NOT NULL,
  `content` text NOT NULL,
  `cgid` int(11) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL,
  `uid` int(11) NOT NULL,
  `uid_update` int(11) DEFAULT NULL,
  `date_creation` datetime NOT NULL,
  PRIMARY KEY (`cid`),
  KEY `fk_cd_courses_cd_category_idx` (`cgid`),
  KEY `fk_cd_courses_cd_user1_idx` (`uid`),
  CONSTRAINT `fk_cd_courses_cd_category` FOREIGN KEY (`cgid`) REFERENCES `cd_category` (`cgid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cd_courses_cd_user1` FOREIGN KEY (`uid`) REFERENCES `cd_user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cd_courses`
--

LOCK TABLES `cd_courses` WRITE;
/*!40000 ALTER TABLE `cd_courses` DISABLE KEYS */;
INSERT INTO `cd_courses` VALUES (1,'Curso de acercamiento al petróleo','curso-de-acercamiento-al-petroleo','55cd1fa019429-2015.png','Curso para principiantes','<ol>\r\n	<li>Primer punto bajo especialidades</li>\r\n	<li>Segundo punto bajo especialidades</li>\r\n	<li>Tercer punto bajo especialidades</li>\r\n</ol>\r\n','<ol>\r\n	<li>A todo publico</li>\r\n	<li>A personas mayores</li>\r\n	<li>A Graduados</li>\r\n	<li>A Estudiantes de Universidades</li>\r\n	<li>Bajo el mismo modelo de voda</li>\r\n</ol>\r\n\r\n<ol>\r\n	<li>A todo publico</li>\r\n	<li>A personas mayores</li>\r\n	<li>A Graduados</li>\r\n	<li>A Estudiantes de Universidades</li>\r\n	<li>Bajo el mismo modelo de voda</li>\r\n</ol>\r\n','<ol>\r\n	<li>A todo publico</li>\r\n	<li>A personas mayores</li>\r\n	<li>A Graduados</li>\r\n	<li>A Estudiantes de Universidades</li>\r\n	<li>Bajo el mismo modelo de voda</li>\r\n</ol>\r\n\r\n<ul>\r\n	<li>Primer punto bajo especialidades</li>\r\n	<li>Segundo punto bajo especialidades</li>\r\n	<li>Tercer punto bajo especialidades</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>Primer punto bajo especialidades</li>\r\n	<li>Segundo punto bajo especialidades</li>\r\n	<li>Tercer punto bajo especialidades</li>\r\n</ul>\r\n',18,'ACTIVE',1,1,'2015-08-13 17:54:14'),(2,'curso de despedida','curso-de-despedida','55cd2187608b9-2015.png','curso de despedida','<ul>\r\n	<li>uno</li>\r\n	<li>dos</li>\r\n	<li>tres</li>\r\n	<li>cuatro</li>\r\n	<li>cinco</li>\r\n	<li>seis</li>\r\n	<li>siete</li>\r\n	<li>ocho</li>\r\n	<li>nueve</li>\r\n	<li>diez</li>\r\n	<li>uno</li>\r\n	<li>dos</li>\r\n	<li>tres</li>\r\n	<li>cuatro</li>\r\n	<li>cinco</li>\r\n	<li>seis</li>\r\n	<li>siete</li>\r\n	<li>ocho</li>\r\n	<li>nueve</li>\r\n	<li>diez</li>\r\n</ul>\r\n','<ol>\r\n	<li>hola como esta la direcci&oacute;n t&eacute;cnica de la empresa</li>\r\n	<li>hola como esta la direcci&oacute;n t&eacute;cnica de la empresa</li>\r\n	<li>hola como esta la direcci&oacute;n t&eacute;cnica de la empresa</li>\r\n</ol>\r\n','<p>hola como esta la direcci&oacute;n t&eacute;cnica de la empresahola como esta la direcci&oacute;n t&eacute;cnica de la empresahola como esta la direcci&oacute;n t&eacute;cnica de la empresahola como esta la direcci&oacute;n t&eacute;cnica de la empresahola como esta la direcci&oacute;n t&eacute;cnica de la empresahola como esta la direcci&oacute;n t&eacute;cnica de la empresa</p>\r\n',17,'ACTIVE',1,1,'2015-08-13 18:03:06'),(3,'petróleos mexicanos','petroleos-mexicanos','55cd232f93dd9-2015.png','Comenzando a caminar :D','<p>hola mundo como estas hola mundo como estas</p>\r\n\r\n<p>hola mundo como estashola mundo como estashola mundo como estas&nbsp;</p>\r\n','<p>Basado en relaciones p&uacute;blicas :D&nbsp;Basado en relaciones p&uacute;blicas :D</p>\r\n\r\n<p>Basado en relaciones p&uacute;blicas :D</p>\r\n','<p>contenido general del cms&nbsp;contenido general del cmscontenido general del cmscontenido general del cmscontenido general del cmscontenido general del cmscontenido general del cmscontenido general del cmscontenido general del cms</p>\r\n',17,'ACTIVE',1,1,'2015-08-13 18:17:42'),(4,'Edgar Alexander Sanchez','edgar-alexander-sanchez','55cd2609acae7-2015.png','jloksalksaklsaklsalksakl','<p>skas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;lskas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;lskas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;lskas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;lskas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;l</p>\r\n','<p>skas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;lskas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;lskas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;lskas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;lskas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;l</p>\r\n','<p>skas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;lskas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;lskas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;lskas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;lskas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;lskas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;lskas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;lskas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;lskas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;lskas&ntilde;klsa&ntilde;lksa&ntilde;lsa&ntilde;lsal&ntilde;as&ntilde;lsa&ntilde;lsa&ntilde;las&ntilde;las&ntilde;lsa&ntilde;lsa&ntilde;l</p>\r\n',18,'ACTIVE',1,1,'2015-08-13 18:20:19'),(5,'Primer curso','primer-curso','55ce729a46d0c-2015.png','primer u\r\ncurso del mes','<ul>\r\n	<li>jhaskjksakjsa</li>\r\n	<li>jkaskjaskjsajk</li>\r\n	<li>kjaskjasjksajkjsak</li>\r\n	<li>jasjkaslkaskj</li>\r\n	<li>kjaaskjjkasjkas</li>\r\n	<li>jaskjsakjsajkasjk</li>\r\n</ul>\r\n','<ul>\r\n	<li>aslksalkaslkasklksal</li>\r\n	<li>kjasjksakjaskjasjk</li>\r\n	<li>jaskhsakjaskjkjasjk</li>\r\n	<li>kjasjksajksakjasjkaskjaskj</li>\r\n	<li>khsajkasjksajkaskjaskj</li>\r\n	<li>lk</li>\r\n</ul>\r\n','<ul>\r\n	<li>aslksalkaslkasklksal</li>\r\n	<li>kjasjksakjaskjasjk</li>\r\n	<li>jaskhsakjaskjkjasjk</li>\r\n	<li>kjasjksajksakjasjkaskjaskj</li>\r\n	<li>khsajkasjksajkaskjaskj</li>\r\n	<li>lk</li>\r\n	<li>aslksalkaslkasklksal</li>\r\n	<li>kjasjksakjaskjasjk</li>\r\n	<li>jaskhsakjaskjkjasjk</li>\r\n	<li>kjasjksajksakjasjkaskjaskj</li>\r\n	<li>khsajkasjksajkaskjaskj</li>\r\n	<li>lk</li>\r\n	<li>aslksalkaslkasklksal</li>\r\n	<li>kjasjksakjaskjasjk</li>\r\n	<li>jaskhsakjaskjkjasjk</li>\r\n	<li>kjasjksajksakjasjkaskjaskj</li>\r\n	<li>khsajkasjksajkaskjaskj</li>\r\n	<li>lk</li>\r\n</ul>\r\n',17,'INACTIVE',1,1,'2015-08-14 18:08:43'),(6,'curso numero 2','curso-numero-2','55d58ef8a10fa-2015.png','conejox conejox jajaja','<p>conejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejox</p>\r\n','<p>conejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejox</p>\r\n','<p>conejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejoxconejox conejox</p>\r\n',17,'ACTIVE',1,1,'2015-08-20 03:29:41');
/*!40000 ALTER TABLE `cd_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cd_coursesYears`
--

DROP TABLE IF EXISTS `cd_coursesYears`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cd_coursesYears` (
  `cyid` int(11) NOT NULL AUTO_INCREMENT,
  `years` varchar(4) NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`cyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cd_coursesYears`
--

LOCK TABLES `cd_coursesYears` WRITE;
/*!40000 ALTER TABLE `cd_coursesYears` DISABLE KEYS */;
/*!40000 ALTER TABLE `cd_coursesYears` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cd_coursesYears_has_courses`
--

DROP TABLE IF EXISTS `cd_coursesYears_has_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cd_coursesYears_has_courses` (
  `ccyid` int(11) NOT NULL AUTO_INCREMENT,
  `cyid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `min` varchar(45) NOT NULL,
  `cupo` varchar(45) NOT NULL,
  `status` enum('CONFIRM','NO CONFIRM') NOT NULL DEFAULT 'NO CONFIRM',
  `final` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `duration` varchar(50) NOT NULL,
  `lat` varchar(45) NOT NULL,
  `long` varchar(45) NOT NULL,
  `inid` int(11) NOT NULL,
  PRIMARY KEY (`ccyid`),
  KEY `fk_cd_coursesYears_has_cd_courses_cd_courses1_idx` (`cid`),
  KEY `fk_cd_coursesYears_has_cd_courses_cd_coursesYears1_idx` (`cyid`),
  KEY `fk_cd_coursesYears_has_courses_cd_instructor1_idx` (`inid`),
  CONSTRAINT `fk_cd_coursesYears_has_cd_courses_cd_courses1` FOREIGN KEY (`cid`) REFERENCES `cd_courses` (`cid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cd_coursesYears_has_cd_courses_cd_coursesYears1` FOREIGN KEY (`cyid`) REFERENCES `cd_coursesYears` (`cyid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cd_coursesYears_has_courses_cd_instructor1` FOREIGN KEY (`inid`) REFERENCES `cd_instructor` (`inid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cd_coursesYears_has_courses`
--

LOCK TABLES `cd_coursesYears_has_courses` WRITE;
/*!40000 ALTER TABLE `cd_coursesYears_has_courses` DISABLE KEYS */;
/*!40000 ALTER TABLE `cd_coursesYears_has_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cd_instructor`
--

DROP TABLE IF EXISTS `cd_instructor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cd_instructor` (
  `inid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `secondname` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `image` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `jurisdiction` enum('NATIONAL','INTERNATIONAL') NOT NULL,
  `curriculum` varchar(200) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL,
  `date_creation` datetime NOT NULL,
  `beginning` date NOT NULL,
  `sex` enum('M','F') NOT NULL,
  PRIMARY KEY (`inid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cd_instructor`
--

LOCK TABLES `cd_instructor` WRITE;
/*!40000 ALTER TABLE `cd_instructor` DISABLE KEYS */;
INSERT INTO `cd_instructor` VALUES (1,'Edgar Alexander','Sanchez','Montejo','Ingeniero en Sistemas Computacionales','55d638c5a73fe-2015.png','<p>descripcion del instructor&nbsp;descripcion del instructor&nbsp;descripcion del instructor&nbsp;descripcion del instructor&nbsp;descripcion del instructor&nbsp;descripcion del instructor&nbsp;descripcion del instructor&nbsp;descripcion del instruc','NATIONAL','55d638c5a74fe-2015.pdf','ACTIVE','2015-08-20 15:31:55','2015-08-31','M');
/*!40000 ALTER TABLE `cd_instructor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cd_process`
--

DROP TABLE IF EXISTS `cd_process`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cd_process` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `ccyid` int(11) NOT NULL,
  `clid` int(11) NOT NULL,
  `key` varchar(60) NOT NULL,
  `status` enum('REGISTERED','PAYMENT','PAID') NOT NULL,
  PRIMARY KEY (`tid`),
  KEY `fk_cd_coursesYears_has_courses_has_cd_client_cd_client1_idx` (`clid`),
  KEY `fk_cd_coursesYears_has_courses_has_cd_client_cd_coursesYear_idx` (`ccyid`),
  CONSTRAINT `fk_cd_coursesYears_has_courses_has_cd_client_cd_client1` FOREIGN KEY (`clid`) REFERENCES `cd_client` (`clid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cd_coursesYears_has_courses_has_cd_client_cd_coursesYears_1` FOREIGN KEY (`ccyid`) REFERENCES `cd_coursesYears_has_courses` (`ccyid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cd_process`
--

LOCK TABLES `cd_process` WRITE;
/*!40000 ALTER TABLE `cd_process` DISABLE KEYS */;
/*!40000 ALTER TABLE `cd_process` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cd_user`
--

DROP TABLE IF EXISTS `cd_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cd_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `second_name` varchar(20) DEFAULT NULL,
  `sex` char(1) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(75) NOT NULL,
  `rol` enum('ADMIN','GUESTS','COORDINATOR') NOT NULL DEFAULT 'GUESTS',
  `photo` varchar(200) DEFAULT NULL,
  `date_creation` datetime NOT NULL,
  `status` enum('INACTIVE','ACTIVE') NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cd_user`
--

LOCK TABLES `cd_user` WRITE;
/*!40000 ALTER TABLE `cd_user` DISABLE KEYS */;
INSERT INTO `cd_user` VALUES (1,'Edgar','Sanchez ','Montejo','M','9933221741','alex','$2a$08$Esq7533rmb4O5J9TPZR28eiEHWp4GRbaArA31dh7nLgfnswwuFveS','edgar.alexander.sm@gmail.com','ADMIN','no-image.jpg','2015-08-10 10:10:10','ACTIVE'),(4,'Martin Eduardo','Padron','Pacheco','M','+529933221471','CDevelopers','$2a$08$vfKze2FhegUc36I6SJRJt.ZzE8hGQ8oZcanl.axcmEOsZ7fYQHXlG','deportes.en.red.mx@gmail.com','COORDINATOR','no-image.jpg','2015-08-19 14:07:12','INACTIVE');
/*!40000 ALTER TABLE `cd_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `VListCourses`
--

/*!50001 DROP TABLE IF EXISTS `VListCourses`*/;
/*!50001 DROP VIEW IF EXISTS `VListCourses`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `VListCourses` AS select `c`.`cid` AS `cid`,`c`.`name` AS `name`,`c`.`permalink` AS `permalink`,`c`.`status` AS `status`,`c`.`date_creation` AS `date_creation`,`u`.`name` AS `name_user`,`cg`.`name` AS `name_category` from ((`cd_courses` `c` join `cd_user` `u` on((`c`.`uid` = `u`.`uid`))) join `cd_category` `cg` on((`cg`.`cgid` = `c`.`cgid`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-24 10:46:04
