CREATE DATABASE  IF NOT EXISTS `school` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `school`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: school
-- ------------------------------------------------------
-- Server version	5.6.16

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
-- Table structure for table `daily schedules`
--

DROP TABLE IF EXISTS `daily schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `public` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `to_serie` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `looked` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily schedules`
--

LOCK TABLES `daily schedules` WRITE;
/*!40000 ALTER TABLE `daily schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_schedules`
--

DROP TABLE IF EXISTS `daily_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `public` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `to_serie` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `looked` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_schedules`
--

LOCK TABLES `daily_schedules` WRITE;
/*!40000 ALTER TABLE `daily_schedules` DISABLE KEYS */;
INSERT INTO `daily_schedules` VALUES (1,1,'2015-11-09','Rolezinho com a galerinha no parque','INACTIVE','1Âª SÃ©rie A',0);
/*!40000 ALTER TABLE `daily_schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `public` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `to_serie` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `looked` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,1,'2015-11-09','Evento XPTO 123 ABC - Parquinho livre ','ACTIVE','',0),(3,1,'2015-10-09','Rolezinho no parque com a galerinha ','INACTIVE','1Âª SÃ©rie A',0);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grids`
--

DROP TABLE IF EXISTS `grids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grids` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serie_id` int(11) NOT NULL,
  `seven` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `eight` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `nine` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `quarter_past_nine` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `quarter_past_ten` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `quarter_past_eleven` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `twelve` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fourteen` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fifteen` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sixteen` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grids`
--

LOCK TABLES `grids` WRITE;
/*!40000 ALTER TABLE `grids` DISABLE KEYS */;
INSERT INTO `grids` VALUES (1,9,'PortuguÃªs,PortuguÃªs,PortuguÃªs,PortuguÃªs,PortuguÃªs','MatemÃ¡tica,MatemÃ¡tica,MatemÃ¡tica,MatemÃ¡tica,MatemÃ¡tica','- intervalo -,- intervalo -,- intervalo -,- intervalo -,- intervalo -','CiÃªncias,CiÃªncias,CiÃªncias,CiÃªncias,CiÃªncias','Geografia,Geografia,Geografia,Geografia,Geografia','AlemÃ£o,AlemÃ£o,AlemÃ£o,AlemÃ£o,AlemÃ£o','- AlmoÃ§o -,- AlmoÃ§o -,- AlmoÃ§o -,- AlmoÃ§o -,- AlmoÃ§o -','- de boas -,- de boas -,- de boas -,- de boas -,- de boas -','MÃºsica,MÃºsica,MÃºsica,MÃºsica,MÃºsica','DanÃ§a,DanÃ§a,DanÃ§a,DanÃ§a,DanÃ§a');
/*!40000 ALTER TABLE `grids` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `note_to` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_id` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES (1,6,'1Âª SÃ©rie A','Sobre festa das crianÃ§as','0000-00-00','WAIT',1),(2,6,'adm','gdfgfdgdfsfg','0000-00-00','READ',1),(3,6,'adm','dsafdsfsdfds','2015-09-25','WAIT',1);
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `responsible_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `responsible_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schools`
--

LOCK TABLES `schools` WRITE;
/*!40000 ALTER TABLE `schools` DISABLE KEYS */;
INSERT INTO `schools` VALUES (1,'E. E. Marcelino Freire','Rua do nove - nÂº 120','99999999','marcelino@freire.com','Matheus Odilon Dias Ferreira','matheusodilon0@gmail.com','matheusodilon0@gmail.com','e10adc3949ba59abbe56e057f20f883e','../img/school/logo/jezzy1.jpg','Matheus Odilon','90907888');
/*!40000 ALTER TABLE `schools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `series`
--

DROP TABLE IF EXISTS `series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `series` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `teachers` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `school_id` int(4) NOT NULL,
  `students_qtd` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `series`
--

LOCK TABLES `series` WRITE;
/*!40000 ALTER TABLE `series` DISABLE KEYS */;
INSERT INTO `series` VALUES (9,'1Âª SÃ©rie A','Professo ABC',1,45);
/*!40000 ALTER TABLE `series` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cod_serie` int(4) NOT NULL,
  `responsible_name_1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `responsible_email_1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `responsible_name_2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `responsible_email_2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `school_id` int(5) DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Matheus Odilon Dias Ferreira',1,'Valdeci Odilon Ferreira','valdeci@odilon.com','Alessandra Cristina','alessandra@cristina.com','','0000-00-00','',NULL,NULL),(3,'Matheus Odilon Dias Ferreira',9,'Joaquim Barbosa','joaquim.barbosa@supremo.com','Oprah','oprah@emailcom','male','0000-00-00','../img/school/students/',1,NULL),(4,'Mark Zuk',9,'asdsfdsfa','dgsadgsagddg','dfggd','gdgfdsfgd','male','0000-00-00','../img/school/students/',1,NULL),(5,'adssdasdaf',9,'sdafads','fasdf','fsadf','fsadf','male','0000-00-00','../img/school/students/jezzy1.jpg',1,NULL),(6,'Passenger',9,'ResponsÃ¡vel MASc','responsavel@masculino.com','ResponsÃ¡vel FEMININO 2','responsavel@feminino.com','male','0000-00-00','../img/school/students/il_fullxfull.369666952_580a.jpg',1,'e10adc3949ba59abbe56e057f20f883e'),(7,'Joaquim RomÃ£o',9,'ResponsÃ¡vel MASCULINO 1','responsavel@masculino.com','ResponsÃ¡vel FEMININO 2','responsavel@feminino.com','male','0000-00-00','../img/school/students/il_fullxfull.369666952_580a.jpg',1,'e10adc3949ba59abbe56e057f20f883e');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `school_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` VALUES (2,'Marta Freitas','marta@freitas.com','matheus@freitas.com','e10adc3949ba59abbe56e057f20f883e','http://orig10.deviantart.net/d2fd/f/2013/359/a/f/cersei_lannister_avatar_by_sethghetto-d6zcdvq.png',1),(3,'Roger F.','roger@tenis.com','123123','e10adc3949ba59abbe56e057f20f883e','http://homeplants002.more-flowers.ru/wp-content/uploads/2015/04/matrix-2.jpg',1);
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warnings`
--

DROP TABLE IF EXISTS `warnings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warnings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `description` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `public` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `to_serie` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `to_students` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `school_id` int(5) DEFAULT NULL,
  `looked` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warnings`
--

LOCK TABLES `warnings` WRITE;
/*!40000 ALTER TABLE `warnings` DISABLE KEYS */;
INSERT INTO `warnings` VALUES (1,'2015-11-09','ReuniÃ£o de pais e mestres.','ACTIVE','','',1,0),(2,'0000-00-00','Essa Ã© a descriÃ§Ã£o do aviso que serÃ¡ direcionado somente para a 1Âª SÃ©rie A','INACTIVE','1Âª SÃ©rie A','',1,60);
/*!40000 ALTER TABLE `warnings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-25 18:33:39
