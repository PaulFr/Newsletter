-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: newsletter
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

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
-- Table structure for table `lists`
--

DROP TABLE IF EXISTS `lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lists`
--

LOCK TABLES `lists` WRITE;
/*!40000 ALTER TABLE `lists` DISABLE KEYS */;
INSERT INTO `lists` VALUES (5,'soutenance','test');
/*!40000 ALTER TABLE `lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `content` text,
  `category` varchar(255) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`users_id`),
  KEY `fk_newsletters_users_idx` (`users_id`),
  CONSTRAINT `fk_newsletters_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletters`
--

LOCK TABLES `newsletters` WRITE;
/*!40000 ALTER TABLE `newsletters` DISABLE KEYS */;
INSERT INTO `newsletters` VALUES (4,'Campagne de test','2016-06-22 05:40:59','<p>Votre <a href=\"http://google.fr\">contenu</a></p>','test',1),(5,'toto','2016-06-22 05:36:31','<p align=\"justify\"><b><strike>Votre contenu</strike></b></p><p align=\"justify\"><b><strike>dfsdfsd<br></strike></b></p>','pub',1);
/*!40000 ALTER TABLE `newsletters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletters_lists`
--

DROP TABLE IF EXISTS `newsletters_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletters_lists` (
  `newsletters_id` int(11) NOT NULL,
  `newsletters_users_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  PRIMARY KEY (`newsletters_id`,`newsletters_users_id`,`list_id`),
  KEY `fk_newsletters_has_groups_groups1_idx` (`list_id`),
  KEY `fk_newsletters_has_groups_newsletters1_idx` (`newsletters_id`,`newsletters_users_id`),
  CONSTRAINT `fk_newsletters_has_groups_groups1` FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_newsletters_has_groups_newsletters1` FOREIGN KEY (`newsletters_id`, `newsletters_users_id`) REFERENCES `newsletters` (`id`, `users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletters_lists`
--

LOCK TABLES `newsletters_lists` WRITE;
/*!40000 ALTER TABLE `newsletters_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletters_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletters_subscribers`
--

DROP TABLE IF EXISTS `newsletters_subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletters_subscribers` (
  `newsletters_id` int(11) NOT NULL,
  `newsletters_users_id` int(11) NOT NULL,
  `subscriber_id` int(11) NOT NULL,
  PRIMARY KEY (`newsletters_id`,`newsletters_users_id`,`subscriber_id`),
  KEY `fk_newsletters_has_clients_clients1_idx` (`subscriber_id`),
  KEY `fk_newsletters_has_clients_newsletters1_idx` (`newsletters_id`,`newsletters_users_id`),
  CONSTRAINT `fk_newsletters_has_clients_clients1` FOREIGN KEY (`subscriber_id`) REFERENCES `subscribers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_newsletters_has_clients_newsletters1` FOREIGN KEY (`newsletters_id`, `newsletters_users_id`) REFERENCES `newsletters` (`id`, `users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletters_subscribers`
--

LOCK TABLES `newsletters_subscribers` WRITE;
/*!40000 ALTER TABLE `newsletters_subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletters_subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriber_lists`
--

DROP TABLE IF EXISTS `subscriber_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscriber_lists` (
  `list_id` int(11) NOT NULL,
  `subscriber_id` int(11) NOT NULL,
  PRIMARY KEY (`list_id`,`subscriber_id`),
  KEY `fk_groups_has_clients_clients1_idx` (`subscriber_id`),
  KEY `fk_groups_has_clients_groups1_idx` (`list_id`),
  CONSTRAINT `fk_groups_has_clients_clients1` FOREIGN KEY (`subscriber_id`) REFERENCES `subscribers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_groups_has_clients_groups1` FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriber_lists`
--

LOCK TABLES `subscriber_lists` WRITE;
/*!40000 ALTER TABLE `subscriber_lists` DISABLE KEYS */;
INSERT INTO `subscriber_lists` VALUES (5,28),(5,29),(5,48),(5,49);
/*!40000 ALTER TABLE `subscriber_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `newsletter` tinyint(1) DEFAULT 1,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
INSERT INTO `subscribers` VALUES (26,'Test1','Toto001','toto001@yopmail.com',1,'2016-06-22 05:38:23'),(27,'Test2','Toto002','toto002@yopmail.com',1,'2016-06-22 05:38:23'),(28,'Te11stff','Toto003','toto003@yopmail.com',1,'2016-06-22 05:38:23'),(29,'Tes542dffdt','Toto004','toto004@yopmail.com',1,'2016-06-22 05:38:23'),(30,'Ted14fst','Toto005','toto005@yopmail.com',1,'2016-06-22 05:38:23'),(31,'Tedfhtst','Toto006','toto006@yopmail.com',1,'2016-06-22 05:38:23'),(32,'Tegf7dst','Toto007','toto007@yopmail.com',1,'2016-06-22 05:38:23'),(33,'Terr4hst','Toto008','toto008@yopmail.com',1,'2016-06-22 05:38:23'),(34,'Tef4dgst','Toto009','toto009@yopmail.com',1,'2016-06-22 05:38:23'),(35,'Tefdst','Toto010','toto010@yopmail.com',1,'2016-06-22 05:38:23'),(36,'Tes889fdt','Toto011','toto011@yopmail.com',1,'2016-06-22 05:38:23'),(48,'pierre','sanie','pierre@cabantous.com',1,'2016-06-22 05:39:28'),(49,NULL,NULL,'keryan.sanie@gmail.com',1,'2016-06-22 05:40:08');
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracks`
--

DROP TABLE IF EXISTS `tracks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  `data` tinytext,
  `newsletter_id` int(11) NOT NULL,
  `subscriber_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`newsletter_id`,`subscriber_id`),
  KEY `fk_tracks_newsletters1_idx` (`newsletter_id`),
  KEY `fk_tracks_clients1_idx` (`subscriber_id`),
  CONSTRAINT `fk_tracks_clients1` FOREIGN KEY (`subscriber_id`) REFERENCES `subscribers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tracks_newsletters1` FOREIGN KEY (`newsletter_id`) REFERENCES `newsletters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracks`
--

LOCK TABLES `tracks` WRITE;
/*!40000 ALTER TABLE `tracks` DISABLE KEYS */;
INSERT INTO `tracks` VALUES (72,'send','1',4,28),(73,'send','1',4,29),(74,'send','1',4,48),(75,'send','1',4,49),(76,'link','http://google.fr',4,29);
/*!40000 ALTER TABLE `tracks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `visited` datetime DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Frinchaboy','Paul','pfrinchaboy@gmail.com','d033e22ae348aeb5660fc2140aec35850c4da997','2016-01-22 00:00:00','2016-06-22 05:50:44','192.168.12.129',1),(3,'sanie','keryan','keryan.sanie@gmail.com','aa368952d0ba4cb3de0d7426737c4ae9176c5cc4','2016-06-10 15:31:11',NULL,NULL,NULL),(5,'Frinchaboy','Paul','pfrinchaboy@gmail.com','d033e22ae348aeb5660fc2140aec35850c4da997','2016-06-10 15:51:00',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-24  7:16:26
