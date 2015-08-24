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
-- Table structure for table `cd_category`
--

DROP TABLE IF EXISTS `cd_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cd_category` (
  `idcategory` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`idcategory`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cd_category`
--

LOCK TABLES `cd_category` WRITE;
/*!40000 ALTER TABLE `cd_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `cd_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cd_counsellor`
--

DROP TABLE IF EXISTS `cd_counsellor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cd_counsellor` (
  `coid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `secondname` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL,
  `description` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  PRIMARY KEY (`coid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cd_counsellor`
--

LOCK TABLES `cd_counsellor` WRITE;
/*!40000 ALTER TABLE `cd_counsellor` DISABLE KEYS */;
/*!40000 ALTER TABLE `cd_counsellor` ENABLE KEYS */;
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
  `duration` varchar(50) NOT NULL,
  `idcategory` int(11) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL,
  PRIMARY KEY (`cid`),
  KEY `fk_cd_courses_cd_category_idx` (`idcategory`),
  CONSTRAINT `fk_cd_courses_cd_category` FOREIGN KEY (`idcategory`) REFERENCES `cd_category` (`idcategory`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cd_courses`
--

LOCK TABLES `cd_courses` WRITE;
/*!40000 ALTER TABLE `cd_courses` DISABLE KEYS */;
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
  `cupo` varchar(45) NOT NULL,
  `status` enum('CONFIRM','NO CONFIRM') NOT NULL DEFAULT 'NO CONFIRM',
  `final` enum('YES','NO') NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`ccyid`),
  KEY `fk_cd_coursesYears_has_cd_courses_cd_courses1_idx` (`cid`),
  KEY `fk_cd_coursesYears_has_cd_courses_cd_coursesYears1_idx` (`cyid`),
  CONSTRAINT `fk_cd_coursesYears_has_cd_courses_cd_coursesYears1` FOREIGN KEY (`cyid`) REFERENCES `cd_coursesYears` (`cyid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cd_coursesYears_has_cd_courses_cd_courses1` FOREIGN KEY (`cid`) REFERENCES `cd_courses` (`cid`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  `rol` enum('ADMIN','GUESTS','COORDINATOR') NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `date_creation` datetime NOT NULL,
  `status` enum('INACTIVE','ACTIVE') NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cd_user`
--

LOCK TABLES `cd_user` WRITE;
/*!40000 ALTER TABLE `cd_user` DISABLE KEYS */;
INSERT INTO `cd_user` VALUES (1,'Edgar Alexander','Sanchez Montejo','','M','','alex','$2a$08$D8PzqLFDMUy5SXN0592qPOZwSrtCHPH3QcFm1fGqE5XYNSVOxUIvC','edgar.alexander.sm@gmail.com','ADMIN','no-image.jpg','2015-08-10 10:10:10','ACTIVE');
/*!40000 ALTER TABLE `cd_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-10 14:33:00
