-- MySQL dump 10.16  Distrib 10.1.37-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: demo
-- ------------------------------------------------------
-- Server version	10.1.37-MariaDB

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
-- Table structure for table `be_alerts`
--

DROP TABLE IF EXISTS `be_alerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_alerts`
--

LOCK TABLES `be_alerts` WRITE;
/*!40000 ALTER TABLE `be_alerts` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_alerts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_audioplayer_albums`
--

DROP TABLE IF EXISTS `be_audioplayer_albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_audioplayer_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `groups_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `status` enum('public','private') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_audioplayer_albums`
--

LOCK TABLES `be_audioplayer_albums` WRITE;
/*!40000 ALTER TABLE `be_audioplayer_albums` DISABLE KEYS */;
INSERT INTO `be_audioplayer_albums` VALUES (1,0,13,'Audio_Album 1','/files/be_demo/audioplayer/images/audio_placeholder.png','Members','public'),(2,0,13,'Audio_Album 2','/files/be_demo/audioplayer/images/audio_placeholder.png','Members','public'),(3,0,13,'Audio_Album 3','/files/be_demo/audioplayer/images/audio_placeholder.png','Members','public'),(4,0,13,'Audio_Album 4','/files/be_demo/audioplayer/images/audio_placeholder.png','Members','public'),(5,0,13,'Audio_Album 5','/files/be_demo/audioplayer/images/audio_placeholder.png','Members','public'),(6,0,13,'Audio_Album 6','/files/be_demo/audioplayer/images/audio_placeholder.png','Members','public'),(7,0,13,'Audio_Album 7','/files/be_demo/audioplayer/images/audio_placeholder.png','Members','public'),(8,0,13,'Audio_Album 8','/files/be_demo/audioplayer/images/audio_placeholder.png','Members','public');
/*!40000 ALTER TABLE `be_audioplayer_albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_audioplayer_comment_reports`
--

DROP TABLE IF EXISTS `be_audioplayer_comment_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_audioplayer_comment_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) DEFAULT '0',
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_of_creation` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_audioplayer_comment_reports`
--

LOCK TABLES `be_audioplayer_comment_reports` WRITE;
/*!40000 ALTER TABLE `be_audioplayer_comment_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_audioplayer_comment_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_audioplayer_comments`
--

DROP TABLE IF EXISTS `be_audioplayer_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_audioplayer_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) DEFAULT NULL,
  `channel_owner_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `time_created` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_audioplayer_comments`
--

LOCK TABLES `be_audioplayer_comments` WRITE;
/*!40000 ALTER TABLE `be_audioplayer_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_audioplayer_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_audioplayer_follows`
--

DROP TABLE IF EXISTS `be_audioplayer_follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_audioplayer_follows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `follower_id` int(11) DEFAULT NULL,
  `following_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_audioplayer_follows`
--

LOCK TABLES `be_audioplayer_follows` WRITE;
/*!40000 ALTER TABLE `be_audioplayer_follows` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_audioplayer_follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_audioplayer_likes`
--

DROP TABLE IF EXISTS `be_audioplayer_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_audioplayer_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_audioplayer_likes`
--

LOCK TABLES `be_audioplayer_likes` WRITE;
/*!40000 ALTER TABLE `be_audioplayer_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_audioplayer_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_audioplayer_medias`
--

DROP TABLE IF EXISTS `be_audioplayer_medias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_audioplayer_medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `album_id` int(11) DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL,
  `comments_allowed` enum('yes','no','hide') COLLATE utf8mb4_unicode_ci DEFAULT 'yes',
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_created` int(11) DEFAULT '0',
  `groups_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `status` enum('public','private') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `featured` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  PRIMARY KEY (`id`),
  FULLTEXT KEY `title_fulltext` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_audioplayer_medias`
--

LOCK TABLES `be_audioplayer_medias` WRITE;
/*!40000 ALTER TABLE `be_audioplayer_medias` DISABLE KEYS */;
INSERT INTO `be_audioplayer_medias` VALUES (1,'Drama_Piano','Drama Piano - John Doe','/files/be_demo/audioplayer/audio/Drama Piano.mp3','/files/be_demo/audioplayer/images/audio-demo-1.jpg',1,13,'yes','Art, Drama, Sound, Audio, Music ',1503777009,'Members','public','no'),(2,'Electro_Groove','ElectroGroove - John Doe','/files/be_demo/audioplayer/audio/ElectroGroove.mp3','/files/be_demo/audioplayer/images/audio-demo-2.jpg',1,13,'yes','Groove, Electro, Sound, Audio, Music ',1503777009,'Members','public','no'),(3,'Extreme_Sports','Extreme Sports- John Doe','/files/be_demo/audioplayer/audio/Extreme Sports.mp3','/files/be_demo/audioplayer/images/audio-demo-3.jpg',2,13,'yes','Sports, Extreme, Sound, Audio, Music ',1503777009,'Members','public','no'),(4,'Get_On','Get On - John Doe','/files/be_demo/audioplayer/audio/Get On.mp3','/files/be_demo/audioplayer/images/audio-demo-4.jpg',2,13,'yes','Get, On, Rock, Sound, Audio, Music ',1503777009,'Members','public','yes'),(5,'Happy_Motivational','Happy Motivational - John Doe','/files/be_demo/audioplayer/audio/Happy Motivational.mp3','/files/be_demo/audioplayer/images/audio-demo-5.jpg',3,13,'yes','Happy, Motivational, Sound, Audio, Music ',1503777009,'Members','public','no'),(6,'Extreme_Sports','Extreme Sports- John Doe','/files/be_demo/audioplayer/audio/Extreme Sports.mp3','/files/be_demo/audioplayer/images/audio-demo-3.jpg',3,13,'yes','Sports, Extreme, Sound, Audio, Music ',1503777009,'Members','public','no'),(7,'Drama_Piano','Drama Piano - John Doe','/files/be_demo/audioplayer/audio/Drama Piano.mp3','/files/be_demo/audioplayer/images/audio-demo-1.jpg',4,13,'yes','Art, Drama, Sound, Audio, Music ',1503777009,'Members','public','no'),(8,'Infinite_Disco','Infinite Disco - John Doe','/files/be_demo/audioplayer/audio/Infinite Disco.mp3','/files/be_demo/audioplayer/images/audio-demo-6.jpg',4,13,'yes','Disco, Infinite, Sound, Audio, Music ',1503777009,'Members','public','no'),(9,'Get_On','Get On - John Doe','/files/be_demo/audioplayer/audio/Get On.mp3','/files/be_demo/audioplayer/images/audio-demo-4.jpg',5,13,'yes','Get, On, Rock, Sound, Audio, Music ',1503777009,'Members','public','no'),(10,'Electro_Groove','ElectroGroove - John Doe','/files/be_demo/audioplayer/audio/ElectroGroove.mp3','/files/be_demo/audioplayer/images/audio-demo-2.jpg',5,13,'yes','Groove, Electro, Sound, Audio, Music ',1503777009,'Members','public','no'),(11,'Happy_Motivational','Happy Motivational - John Doe','/files/be_demo/audioplayer/audio/Happy Motivational.mp3','/files/be_demo/audioplayer/images/audio-demo-5.jpg',6,13,'yes','Happy, Motivational, Sound, Audio, Music ',1503777009,'Members','public','no'),(12,'Infinite_Disco','Infinite Disco - John Doe','/files/be_demo/audioplayer/audio/Infinite Disco.mp3','/files/be_demo/audioplayer/images/audio-demo-6.jpg',6,13,'yes','Disco, Infinite, Sound, Audio, Music ',1503777009,'Members','public','no'),(13,'Drama_Piano','Drama Piano - John Doe','/files/be_demo/audioplayer/audio/Drama Piano.mp3','/files/be_demo/audioplayer/images/audio-demo-1.jpg',7,13,'yes','Art, Drama, Sound, Audio, Music ',1503777009,'Members','public','no'),(14,'Get_On','Get On - John Doe','/files/be_demo/audioplayer/audio/Get On.mp3','/files/be_demo/audioplayer/images/audio-demo-4.jpg',7,13,'yes','Get, On, Rock, Sound, Audio, Music ',1503777009,'Members','public','no'),(15,'Extreme_Sports','Extreme Sports- John Doe','/files/be_demo/audioplayer/audio/Extreme Sports.mp3','/files/be_demo/audioplayer/images/audio-demo-3.jpg',8,13,'yes','Sports, Extreme, Sound, Audio, Music ',1503777009,'Members','public','no'),(16,'Happy_Motivational','Happy Motivational - John Doe','/files/be_demo/audioplayer/audio/Happy Motivational.mp3','/files/be_demo/audioplayer/images/audio-demo-5.jpg',8,13,'yes','Happy, Motivational, Sound, Audio, Music ',1503777009,'Members','public','no');
/*!40000 ALTER TABLE `be_audioplayer_medias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_audioplayer_ratings`
--

DROP TABLE IF EXISTS `be_audioplayer_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_audioplayer_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_audioplayer_ratings`
--

LOCK TABLES `be_audioplayer_ratings` WRITE;
/*!40000 ALTER TABLE `be_audioplayer_ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_audioplayer_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_audioplayer_sound_reports`
--

DROP TABLE IF EXISTS `be_audioplayer_sound_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_audioplayer_sound_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) DEFAULT '0',
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_of_creation` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_audioplayer_sound_reports`
--

LOCK TABLES `be_audioplayer_sound_reports` WRITE;
/*!40000 ALTER TABLE `be_audioplayer_sound_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_audioplayer_sound_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_audioplayer_user_settings`
--

DROP TABLE IF EXISTS `be_audioplayer_user_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_audioplayer_user_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `background_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `channel_comments` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_audioplayer_user_settings`
--

LOCK TABLES `be_audioplayer_user_settings` WRITE;
/*!40000 ALTER TABLE `be_audioplayer_user_settings` DISABLE KEYS */;
INSERT INTO `be_audioplayer_user_settings` VALUES (1,13,'Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod. 	Eum et doctus delicatissimi, sea te dicant fuisset pertinax. At debet oblique omnesque ius.	Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.','/files/be_demo/audioplayer/images/reserved.png','yes','yes');
/*!40000 ALTER TABLE `be_audioplayer_user_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_block_relations`
--

DROP TABLE IF EXISTS `be_block_relations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_block_relations` (
  `parent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`parent`,`child`,`version`),
  KEY `version_parent` (`parent`,`version`),
  KEY `version` (`version`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_block_relations`
--

LOCK TABLES `be_block_relations` WRITE;
/*!40000 ALTER TABLE `be_block_relations` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_block_relations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_blocks`
--

DROP TABLE IF EXISTS `be_blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `global` enum('yes','no') CHARACTER SET utf8 DEFAULT 'no',
  `type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `data` longblob,
  `options` blob,
  `active` enum('yes','no') CHARACTER SET utf8 DEFAULT 'yes',
  PRIMARY KEY (`id`,`version`),
  UNIQUE KEY `name_version_unique` (`version`,`name`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_blocks`
--

LOCK TABLES `be_blocks` WRITE;
/*!40000 ALTER TABLE `be_blocks` DISABLE KEYS */;
INSERT INTO `be_blocks` VALUES (1,1,'be_body_styler_default_theme','yes','generic','{\"html\":\"{content} {elements}\",\"resizable\":true,\"size\":\"span12\",\"css_attributes\":[]}',NULL,'yes');
/*!40000 ALTER TABLE `be_blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_blog_categories`
--

DROP TABLE IF EXISTS `be_blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_blog_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_created` int(11) DEFAULT NULL,
  `groups_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_blog_categories`
--

LOCK TABLES `be_blog_categories` WRITE;
/*!40000 ALTER TABLE `be_blog_categories` DISABLE KEYS */;
INSERT INTO `be_blog_categories` VALUES (1,0,13,'Unallocated','',1394228780,'Administrators'),(2,0,13,'Blog Posts','/files/be_demo/blog/categories/men-at-work.png',1520002692,'Guests,Members,Administrators');
/*!40000 ALTER TABLE `be_blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_blog_comment_reports`
--

DROP TABLE IF EXISTS `be_blog_comment_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_blog_comment_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) DEFAULT '0',
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_of_creation` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_blog_comment_reports`
--

LOCK TABLES `be_blog_comment_reports` WRITE;
/*!40000 ALTER TABLE `be_blog_comment_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_blog_comment_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_blog_comments`
--

DROP TABLE IF EXISTS `be_blog_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_blog_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `time_created` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_blog_comments`
--

LOCK TABLES `be_blog_comments` WRITE;
/*!40000 ALTER TABLE `be_blog_comments` DISABLE KEYS */;
INSERT INTO `be_blog_comments` VALUES (1,4,13,'admin','Placeholder blog comment',1520006947);
/*!40000 ALTER TABLE `be_blog_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_blog_posts`
--

DROP TABLE IF EXISTS `be_blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_created` int(11) DEFAULT '0',
  `category_id` int(11) DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL,
  `comments_allowed` enum('yes','no','hide') COLLATE utf8mb4_unicode_ci DEFAULT 'yes',
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `groups_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  FULLTEXT KEY `title_fulltext` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_blog_posts`
--

LOCK TABLES `be_blog_posts` WRITE;
/*!40000 ALTER TABLE `be_blog_posts` DISABLE KEYS */;
INSERT INTO `be_blog_posts` VALUES (1,'Blog Post 4','<h4>Professor</h4>  <p>Contrary to popular belief Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.&nbsp;</p>  <p>Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.&nbsp;</p>  <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p> ','/files/be_demo/blog/posts/blog_image_3.jpg',1520006467,2,13,'yes','Business,Blog,Working','Guests,Members,Administrators','blog-post-4'),(2,'Blog Post 3','<h4>Standard Blog</h4>  <p>Contrary to popular belief Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.&nbsp;</p>  <p>Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.&nbsp;</p>  <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p> ','/files/be_demo/blog/posts/blog_image_4.jpg',1520006525,2,13,'yes','Personal,Holidays,Sunset','Guests,Members,Administrators','blog-post-3'),(3,'Blog Post 2','<h4>Translation</h4>  <p>Contrary to popular belief Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.&nbsp;</p>  <p>Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.&nbsp;</p>  <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p> ','/files/be_demo/blog/posts/blog_image_1.jpg',1520006602,2,13,'yes','BuilderEngine,Members,Laptop','Guests,Members,Administrators','blog-post-2'),(4,'Blog Post 1','<h4>Lorem Ipsum</h4>  <p>Contrary to popular belief Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.&nbsp;</p>  <p>Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.&nbsp;</p>  <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p> ','/files/be_demo/blog/posts/blog_image_2.jpg',1520006649,2,13,'yes','Tutorials,Support,Business','Guests,Members,Administrators','blog-post-1');
/*!40000 ALTER TABLE `be_blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_event_addon_services`
--

DROP TABLE IF EXISTS `be_booking_event_addon_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_event_addon_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `price_opt` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_event_addon_services`
--

LOCK TABLES `be_booking_event_addon_services` WRITE;
/*!40000 ALTER TABLE `be_booking_event_addon_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_booking_event_addon_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_event_categories`
--

DROP TABLE IF EXISTS `be_booking_event_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_event_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_created` int(11) DEFAULT NULL,
  `groups_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_event_categories`
--

LOCK TABLES `be_booking_event_categories` WRITE;
/*!40000 ALTER TABLE `be_booking_event_categories` DISABLE KEYS */;
INSERT INTO `be_booking_event_categories` VALUES (1,0,13,'Event Listing 1','/files/be_demo/booking_events/images/photo_placeholder.png','be-category-bar-blue',1503390421,'Guests,Members,Administrators,Frontend Editor,Frontend Manager'),(2,0,13,'Event Listing 2','/files/be_demo/booking_events/images/photo_placeholder.png','be-category-bar-green',1503390450,'Guests,Members,Administrators,Frontend Editor,Frontend Manager'),(3,0,13,'Event Listing 3','/files/be_demo/booking_events/images/photo_placeholder.png','be-category-bar-orange',1503390467,'Guests,Members,Administrators,Frontend Editor,Frontend Manager'),(4,1,13,'Events Extra 1','/files/be_demo/booking_events/images/photo_placeholder.png','be-category-bar-yellow',1503390495,'Guests,Members,Administrators,Frontend Editor,Frontend Manager');
/*!40000 ALTER TABLE `be_booking_event_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_event_early_discounts`
--

DROP TABLE IF EXISTS `be_booking_event_early_discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_event_early_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `num_days` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `price_opt` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_event_early_discounts`
--

LOCK TABLES `be_booking_event_early_discounts` WRITE;
/*!40000 ALTER TABLE `be_booking_event_early_discounts` DISABLE KEYS */;
INSERT INTO `be_booking_event_early_discounts` VALUES (1,1,10,10.00,'percent'),(2,4,5,25.00,'flat');
/*!40000 ALTER TABLE `be_booking_event_early_discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_event_featured_fields`
--

DROP TABLE IF EXISTS `be_booking_event_featured_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_event_featured_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_event_featured_fields`
--

LOCK TABLES `be_booking_event_featured_fields` WRITE;
/*!40000 ALTER TABLE `be_booking_event_featured_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_booking_event_featured_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_event_group_discounts`
--

DROP TABLE IF EXISTS `be_booking_event_group_discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_event_group_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_persons` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `price_opt` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_event_group_discounts`
--

LOCK TABLES `be_booking_event_group_discounts` WRITE;
/*!40000 ALTER TABLE `be_booking_event_group_discounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_booking_event_group_discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_event_images`
--

DROP TABLE IF EXISTS `be_booking_event_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_event_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_event_images`
--

LOCK TABLES `be_booking_event_images` WRITE;
/*!40000 ALTER TABLE `be_booking_event_images` DISABLE KEYS */;
INSERT INTO `be_booking_event_images` VALUES (1,1,'/files/be_demo/booking_events/images/event_1_2.jpg'),(2,1,'/files/be_demo/booking_events/images/event_1_3.jpg'),(3,1,'/files/be_demo/booking_events/images/event_1_4.jpg'),(4,4,'/files/be_demo/booking_events/images/event_1_4.jpg'),(5,4,'/files/be_demo/booking_events/images/event_1_2.jpg'),(6,4,'/files/be_demo/booking_events/images/event_1.jpg'),(7,3,'/files/be_demo/booking_events/images/event_1.jpg'),(8,3,'/files/be_demo/booking_events/images/event_1_4.jpg'),(9,3,'/files/be_demo/booking_events/images/event_1_3.jpg'),(10,2,'/files/be_demo/booking_events/images/event_1_3.jpg'),(11,2,'/files/be_demo/booking_events/images/event_1_2.jpg'),(12,2,'/files/be_demo/booking_events/images/event_1.jpg');
/*!40000 ALTER TABLE `be_booking_event_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_event_orders`
--

DROP TABLE IF EXISTS `be_booking_event_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_event_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `tickets` int(11) NOT NULL,
  `paid` decimal(10,2) DEFAULT '0.00',
  `paid_toggle` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_created` int(11) DEFAULT NULL,
  `time_paid` int(11) DEFAULT NULL,
  `trans_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_event_orders`
--

LOCK TABLES `be_booking_event_orders` WRITE;
/*!40000 ALTER TABLE `be_booking_event_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_booking_event_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_event_usergroup_discounts`
--

DROP TABLE IF EXISTS `be_booking_event_usergroup_discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_event_usergroup_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `usergroup_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `price_opt` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_event_usergroup_discounts`
--

LOCK TABLES `be_booking_event_usergroup_discounts` WRITE;
/*!40000 ALTER TABLE `be_booking_event_usergroup_discounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_booking_event_usergroup_discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_event_vouchers`
--

DROP TABLE IF EXISTS `be_booking_event_vouchers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_event_vouchers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `price_opt` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_event_vouchers`
--

LOCK TABLES `be_booking_event_vouchers` WRITE;
/*!40000 ALTER TABLE `be_booking_event_vouchers` DISABLE KEYS */;
INSERT INTO `be_booking_event_vouchers` VALUES (1,1,'20% Off','20off','2018-11-30',20.00,'percent'),(2,3,'Training Voucher','voffer','2018-12-12',5.00,'flat');
/*!40000 ALTER TABLE `be_booking_event_vouchers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_events`
--

DROP TABLE IF EXISTS `be_booking_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(11,2) DEFAULT NULL,
  `categories` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `vat` decimal(11,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `booked` int(11) DEFAULT NULL,
  `show_capacity` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `active` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'yes',
  `available_days` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recurrence_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `early_discount` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `voucher_discount` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `group_discount` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `usergroup_discount` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `addon_service` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `link` text COLLATE utf8mb4_unicode_ci,
  `time_created` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_events`
--

LOCK TABLES `be_booking_events` WRITE;
/*!40000 ALTER TABLE `be_booking_events` DISABLE KEYS */;
INSERT INTO `be_booking_events` VALUES (1,13,'Media Event','media-event','/files/be_demo/booking_events/images/event_1.jpg','<p><strong>Lorem ipsum dolor </strong>sit amet, consectetur adipiscing elit. Sed vestibulum id dui sed tempor. Ut porttitor et augue et eleifend. Maecenas in justo ligula. Suspendisse vitae nulla accumsan, sollicitudin ipsum non, elementum risus. Aliquam quam dui, finibus ac dictum eget, vulputate eu tortor. Donec et nibh at ex laoreet sodales. Nullam aliquet ut quam non feugiat. Proin porttitor venenatis lorem fermentum viverra. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Vestibulum non nibh scelerisque, mollis magna in, egestas lacus. Sed hendrerit ligula ac elit luctus ultricies. Sed nec turpis scelerisque, aliquet risus a, pellentesque metus.</p>\r\n\r\n<p>Maecenas elementum justo ullamcorper sollicitudin dictum. Donec eu venenatis odio. Fusce in ligula sit amet ipsum gravida venenatis vitae quis lorem. Phasellus at turpis sit amet ante varius faucibus ac euismod dolor. Nulla sed vulputate urna. Phasellus justo risus, auctor at vehicula accumsan, euismod at metus. Morbi at sem leo. Donec magna neque, viverra imperdiet nisi sed, porta scelerisque tellus. In vestibulum nunc eu bibendum luctus. Sed eget justo consequat metus accumsan ultrices vel at turpis. Maecenas lacinia est vel felis convallis auctor. Nunc vel maximus urna. Ut eget ipsum quam.</p>\r\n\r\n<p>Morbi blandit elementum massa, non accumsan enim sagittis ac. Quisque interdum quam vitae orci vestibulum, quis laoreet ligula mollis. Mauris vitae velit fringilla, cursus lacus in, consequat sem. Vestibulum eros nisi, interdum vitae orci nec, aliquet sagittis urna. Sed posuere sollicitudin mi sed laoreet. Fusce pharetra, velit blandit lacinia efficitur, elit lacus finibus ipsum, non venenatis ligula risus id nisl. Praesent venenatis lectus ut consequat rhoncus. Sed non eros maximus, bibendum lacus at, laoreet ligula.</p>\r\n\r\n<p><strong>Booking Event 1 Example</strong></p>\r\n',25.00,'Event Listing 1',1,23.00,'2018-11-01','2018-11-01','18:02','21:02',50,0,'yes','Eyre Square, Galway City, Galway, 00000, Ireland','no','yes','Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday','','yes','yes',NULL,NULL,NULL,NULL,1503391004),(2,13,'Speakers Event','speakers-event','/files/be_demo/booking_events/images/event_1_4.jpg','<p><strong>Lorem ipsum dolor </strong>sit amet, consectetur adipiscing elit. Sed vestibulum id dui sed tempor. Ut porttitor et augue et eleifend. Maecenas in justo ligula. Suspendisse vitae nulla accumsan, sollicitudin ipsum non, elementum risus. Aliquam quam dui, finibus ac dictum eget, vulputate eu tortor. Donec et nibh at ex laoreet sodales. Nullam aliquet ut quam non feugiat. Proin porttitor venenatis lorem fermentum viverra. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Vestibulum non nibh scelerisque, mollis magna in, egestas lacus. Sed hendrerit ligula ac elit luctus ultricies. Sed nec turpis scelerisque, aliquet risus a, pellentesque metus.</p>\r\n\r\n<p>Maecenas elementum justo ullamcorper sollicitudin dictum. Donec eu venenatis odio. Fusce in ligula sit amet ipsum gravida venenatis vitae quis lorem. Phasellus at turpis sit amet ante varius faucibus ac euismod dolor. Nulla sed vulputate urna. Phasellus justo risus, auctor at vehicula accumsan, euismod at metus. Morbi at sem leo. Donec magna neque, viverra imperdiet nisi sed, porta scelerisque tellus. In vestibulum nunc eu bibendum luctus. Sed eget justo consequat metus accumsan ultrices vel at turpis. Maecenas lacinia est vel felis convallis auctor. Nunc vel maximus urna. Ut eget ipsum quam.</p>\r\n\r\n<p>Morbi blandit elementum massa, non accumsan enim sagittis ac. Quisque interdum quam vitae orci vestibulum, quis laoreet ligula mollis. Mauris vitae velit fringilla, cursus lacus in, consequat sem. Vestibulum eros nisi, interdum vitae orci nec, aliquet sagittis urna. Sed posuere sollicitudin mi sed laoreet. Fusce pharetra, velit blandit lacinia efficitur, elit lacus finibus ipsum, non venenatis ligula risus id nisl. Praesent venenatis lectus ut consequat rhoncus. Sed non eros maximus, bibendum lacus at, laoreet ligula.</p>\r\n\r\n<p><strong>Booking Event 2 Example</strong></p>\r\n',50.00,'Event Listing 2',1,23.00,'2018-11-04','2018-11-05','13:00','17:00',25,0,'yes','Eyre Square, Galway, 000000, Ireland','yes','yes','Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday','','no','no',NULL,NULL,NULL,NULL,1503408094),(3,13,'Training Session','training-session','/files/be_demo/booking_events/images/event_1_2.jpg','<p><strong>Lorem ipsum dolor </strong>sit amet, consectetur adipiscing elit. Sed vestibulum id dui sed tempor. Ut porttitor et augue et eleifend. Maecenas in justo ligula. Suspendisse vitae nulla accumsan, sollicitudin ipsum non, elementum risus. Aliquam quam dui, finibus ac dictum eget, vulputate eu tortor. Donec et nibh at ex laoreet sodales. Nullam aliquet ut quam non feugiat. Proin porttitor venenatis lorem fermentum viverra. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Vestibulum non nibh scelerisque, mollis magna in, egestas lacus. Sed hendrerit ligula ac elit luctus ultricies. Sed nec turpis scelerisque, aliquet risus a, pellentesque metus.</p>\r\n\r\n<p>Maecenas elementum justo ullamcorper sollicitudin dictum. Donec eu venenatis odio. Fusce in ligula sit amet ipsum gravida venenatis vitae quis lorem. Phasellus at turpis sit amet ante varius faucibus ac euismod dolor. Nulla sed vulputate urna. Phasellus justo risus, auctor at vehicula accumsan, euismod at metus. Morbi at sem leo. Donec magna neque, viverra imperdiet nisi sed, porta scelerisque tellus. In vestibulum nunc eu bibendum luctus. Sed eget justo consequat metus accumsan ultrices vel at turpis. Maecenas lacinia est vel felis convallis auctor. Nunc vel maximus urna. Ut eget ipsum quam.</p>\r\n\r\n<p>Morbi blandit elementum massa, non accumsan enim sagittis ac. Quisque interdum quam vitae orci vestibulum, quis laoreet ligula mollis. Mauris vitae velit fringilla, cursus lacus in, consequat sem. Vestibulum eros nisi, interdum vitae orci nec, aliquet sagittis urna. Sed posuere sollicitudin mi sed laoreet. Fusce pharetra, velit blandit lacinia efficitur, elit lacus finibus ipsum, non venenatis ligula risus id nisl. Praesent venenatis lectus ut consequat rhoncus. Sed non eros maximus, bibendum lacus at, laoreet ligula.</p>\r\n\r\n<p><strong>Booking Event 3 Example</strong></p>\r\n',15.00,'Event Listing 3',1,23.00,'2018-11-14','2018-11-14','09:00','18:00',20,0,'yes','Eyre Square, Galway, 000000, Ireland','no','yes','Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday','','no','yes',NULL,NULL,NULL,NULL,1503408077),(4,13,'Tech Conference','tech-conference','/files/be_demo/booking_events/images/event_1_3.jpg','<p><strong>Lorem ipsum dolor </strong>sit amet, consectetur adipiscing elit. Sed vestibulum id dui sed tempor. Ut porttitor et augue et eleifend. Maecenas in justo ligula. Suspendisse vitae nulla accumsan, sollicitudin ipsum non, elementum risus. Aliquam quam dui, finibus ac dictum eget, vulputate eu tortor. Donec et nibh at ex laoreet sodales. Nullam aliquet ut quam non feugiat. Proin porttitor venenatis lorem fermentum viverra. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae  Vestibulum non nibh scelerisque, mollis magna in, egestas lacus. Sed hendrerit ligula ac elit luctus ultricies. Sed nec turpis scelerisque, aliquet risus a, pellentesque metus.</p>\r\n\r\n<p>Maecenas elementum justo ullamcorper sollicitudin dictum. Donec eu venenatis odio. Fusce in ligula sit amet ipsum gravida venenatis vitae quis lorem. Phasellus at turpis sit amet ante varius faucibus ac euismod dolor. Nulla sed vulputate urna. Phasellus justo risus, auctor at vehicula accumsan, euismod at metus. Morbi at sem leo. Donec magna neque, viverra imperdiet nisi sed, porta scelerisque tellus. In vestibulum nunc eu bibendum luctus. Sed eget justo consequat metus accumsan ultrices vel at turpis. Maecenas lacinia est vel felis convallis auctor. Nunc vel maximus urna. Ut eget ipsum quam.</p>\r\n\r\n<p>Morbi blandit elementum massa, non accumsan enim sagittis ac. Quisque interdum quam vitae orci vestibulum, quis laoreet ligula mollis. Mauris vitae velit fringilla, cursus lacus in, consequat sem. Vestibulum eros nisi, interdum vitae orci nec, aliquet sagittis urna. Sed posuere sollicitudin mi sed laoreet. Fusce pharetra, velit blandit lacinia efficitur, elit lacus finibus ipsum, non venenatis ligula risus id nisl. Praesent venenatis lectus ut consequat rhoncus. Sed non eros maximus, bibendum lacus at, laoreet ligula.</p>\r\n\r\n<p><strong>Booking Event 4 Example</strong></p>\r\n',150.00,'Events Extra 1',1,23.00,'2018-11-20','2018-11-24','11:00','16:00',100,1,'yes','Eyre Square, Galway, 000000, Ireland','no','yes','Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday','','yes','no',NULL,NULL,NULL,NULL,1503408040);
/*!40000 ALTER TABLE `be_booking_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_membership_addon_services`
--

DROP TABLE IF EXISTS `be_booking_membership_addon_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_membership_addon_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `price_opt` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_membership_addon_services`
--

LOCK TABLES `be_booking_membership_addon_services` WRITE;
/*!40000 ALTER TABLE `be_booking_membership_addon_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_booking_membership_addon_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_membership_categories`
--

DROP TABLE IF EXISTS `be_booking_membership_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_membership_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_created` int(11) DEFAULT NULL,
  `groups_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_membership_categories`
--

LOCK TABLES `be_booking_membership_categories` WRITE;
/*!40000 ALTER TABLE `be_booking_membership_categories` DISABLE KEYS */;
INSERT INTO `be_booking_membership_categories` VALUES (1,0,13,'Memberships','/builderengine/public/img/photo_placeholder.png',1520943118,'Guests,Members,Administrators');
/*!40000 ALTER TABLE `be_booking_membership_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_membership_early_discounts`
--

DROP TABLE IF EXISTS `be_booking_membership_early_discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_membership_early_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_id` int(11) NOT NULL,
  `num_days` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `price_opt` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_membership_early_discounts`
--

LOCK TABLES `be_booking_membership_early_discounts` WRITE;
/*!40000 ALTER TABLE `be_booking_membership_early_discounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_booking_membership_early_discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_membership_featured_fields`
--

DROP TABLE IF EXISTS `be_booking_membership_featured_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_membership_featured_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_membership_featured_fields`
--

LOCK TABLES `be_booking_membership_featured_fields` WRITE;
/*!40000 ALTER TABLE `be_booking_membership_featured_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_booking_membership_featured_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_membership_group_discounts`
--

DROP TABLE IF EXISTS `be_booking_membership_group_discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_membership_group_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_persons` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `price_opt` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_membership_group_discounts`
--

LOCK TABLES `be_booking_membership_group_discounts` WRITE;
/*!40000 ALTER TABLE `be_booking_membership_group_discounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_booking_membership_group_discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_membership_images`
--

DROP TABLE IF EXISTS `be_booking_membership_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_membership_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_membership_images`
--

LOCK TABLES `be_booking_membership_images` WRITE;
/*!40000 ALTER TABLE `be_booking_membership_images` DISABLE KEYS */;
INSERT INTO `be_booking_membership_images` VALUES (1,1,'/files/be_demo/photogallery/images/Far%20Horizon.jpg'),(2,1,'/files/be_demo/photogallery/images/Red%20House.jpg');
/*!40000 ALTER TABLE `be_booking_membership_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_membership_questionnaire_fields`
--

DROP TABLE IF EXISTS `be_booking_membership_questionnaire_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_membership_questionnaire_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `required` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `options` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_membership_questionnaire_fields`
--

LOCK TABLES `be_booking_membership_questionnaire_fields` WRITE;
/*!40000 ALTER TABLE `be_booking_membership_questionnaire_fields` DISABLE KEYS */;
INSERT INTO `be_booking_membership_questionnaire_fields` VALUES (1,1,'In one sentence tell us more about you.','textarea','yes','',1),(2,1,'Which industry are you involved in?','text','yes','',2),(3,1,'How did you hear about us?','select','yes','Advertisement, Social Media, Friend, Other',3),(4,1,'What is your address information?','text','yes','',4),(5,1,'Enter your Website Address URL','url','yes','',5),(6,1,'How many years are you considering to be a member?','number','yes','',6),(7,1,'Extra Information','textarea','yes','',7),(8,3,'Describe yourself in one sentence','text','yes','',8),(9,3,'Extra Details','textarea','yes','',9);
/*!40000 ALTER TABLE `be_booking_membership_questionnaire_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_membership_usergroup_discounts`
--

DROP TABLE IF EXISTS `be_booking_membership_usergroup_discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_membership_usergroup_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_id` int(11) NOT NULL,
  `usergroup_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `price_opt` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_membership_usergroup_discounts`
--

LOCK TABLES `be_booking_membership_usergroup_discounts` WRITE;
/*!40000 ALTER TABLE `be_booking_membership_usergroup_discounts` DISABLE KEYS */;
INSERT INTO `be_booking_membership_usergroup_discounts` VALUES (1,2,'Members',10.00,'percent');
/*!40000 ALTER TABLE `be_booking_membership_usergroup_discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_membership_vouchers`
--

DROP TABLE IF EXISTS `be_booking_membership_vouchers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_membership_vouchers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `price_opt` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_membership_vouchers`
--

LOCK TABLES `be_booking_membership_vouchers` WRITE;
/*!40000 ALTER TABLE `be_booking_membership_vouchers` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_booking_membership_vouchers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_memberships`
--

DROP TABLE IF EXISTS `be_booking_memberships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_memberships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(11,2) DEFAULT NULL,
  `categories` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `vat` decimal(11,2) DEFAULT NULL,
  `show_vat` enum('no','yes') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `featured` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `active` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'yes',
  `usergroups` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pro_rata` enum('no','yes') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `recurrence_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `early_discount` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `voucher_discount` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `group_discount` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `usergroup_discount` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `addon_service` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `questionnaire` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `approval` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `time_created` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_memberships`
--

LOCK TABLES `be_booking_memberships` WRITE;
/*!40000 ALTER TABLE `be_booking_memberships` DISABLE KEYS */;
INSERT INTO `be_booking_memberships` VALUES (1,13,'Membership Premium','membership-premium','/files/blogimage.jpg','<p>You cant connect the dots looking forward; you can only connect them looking backwards.&nbsp;</p>\r\n\r\n<p>So you have to trust that the dots will somehow connect in your future. You have to trust in something - your gut, destiny, life, or karma. The only people who never tumble are those who never mount the high wire.</p>\r\n',120.00,'Memberships',1,0.00,'yes','2019-01-03','2020-01-03',20,'yes','yes','Premium Member','6-month','no','','no','no','no','no','no','yes','yes',1521705214),(2,13,'Membership Upgrade','membership-upgrade','/files/be_demo/photogallery/images/Colorful%20Pier.jpg','<ul>\r\n	<li>24/7 Workspace Access</li>\r\n	<li>1 Coffee <strong>Free</strong></li>\r\n	<li>Heating &amp; Internet</li>\r\n	<li><strong>1 Workspace Seat</strong></li>\r\n	<li>2 Month License</li>\r\n	<li>Premium Support</li>\r\n</ul>\r\n',20.00,'Memberships',1,23.00,'no','2019-01-03','2020-01-03',10,'yes','yes','Basic Member','1-year','no','','no','no','no','yes','no','no','no',1521704409),(3,13,'Club Membership','club-membership','/files/be_demo/photogallery/images/Starry%20Night.jpg','<ul>\r\n	<li>1 Year Membership</li>\r\n	<li>Entry For&nbsp;<strong>Free</strong></li>\r\n	<li>Discount Offers</li>\r\n	<li><strong>Support &amp; Assistants</strong></li>\r\n	<li>Covers All Areas</li>\r\n	<li>Outstanding Support</li>\r\n</ul>\r\n',10.00,'Memberships',1,23.00,'no','2019-01-03','2020-01-03',15,'yes','yes','Basic Member','30-day','no','','no','no','no','no','no','yes','yes',1521704443);
/*!40000 ALTER TABLE `be_booking_memberships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_reservations`
--

DROP TABLE IF EXISTS `be_booking_reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `object_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `object_id` int(11) DEFAULT NULL,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `data` longblob,
  `price` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_reservations`
--

LOCK TABLES `be_booking_reservations` WRITE;
/*!40000 ALTER TABLE `be_booking_reservations` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_booking_reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_room_categories`
--

DROP TABLE IF EXISTS `be_booking_room_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_room_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_created` int(11) DEFAULT NULL,
  `groups_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_room_categories`
--

LOCK TABLES `be_booking_room_categories` WRITE;
/*!40000 ALTER TABLE `be_booking_room_categories` DISABLE KEYS */;
INSERT INTO `be_booking_room_categories` VALUES (1,0,13,'Meeting Rooms','Meeting Rooms with Free Booking','/files/be_demo/booking_rooms/images/roomlogo.png',1505896512,'Guests,Members,Administrators,Frontend Editor,Frontend Manager'),(2,0,13,'Venue Rooms','Meeting Venue Rooms with Paid Booking','/builderengine/public/img/photo_placeholder.png',1505896560,'Guests,Members,Administrators,Frontend Editor,Frontend Manager');
/*!40000 ALTER TABLE `be_booking_room_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_room_department_addon_services`
--

DROP TABLE IF EXISTS `be_booking_room_department_addon_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_room_department_addon_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `price_opt` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_room_department_addon_services`
--

LOCK TABLES `be_booking_room_department_addon_services` WRITE;
/*!40000 ALTER TABLE `be_booking_room_department_addon_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_booking_room_department_addon_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_room_department_early_discounts`
--

DROP TABLE IF EXISTS `be_booking_room_department_early_discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_room_department_early_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `num_days` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `price_opt` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_room_department_early_discounts`
--

LOCK TABLES `be_booking_room_department_early_discounts` WRITE;
/*!40000 ALTER TABLE `be_booking_room_department_early_discounts` DISABLE KEYS */;
INSERT INTO `be_booking_room_department_early_discounts` VALUES (1,3,100,10.00,'percent');
/*!40000 ALTER TABLE `be_booking_room_department_early_discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_room_department_group_discounts`
--

DROP TABLE IF EXISTS `be_booking_room_department_group_discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_room_department_group_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_persons` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `price_opt` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_room_department_group_discounts`
--

LOCK TABLES `be_booking_room_department_group_discounts` WRITE;
/*!40000 ALTER TABLE `be_booking_room_department_group_discounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_booking_room_department_group_discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_room_department_images`
--

DROP TABLE IF EXISTS `be_booking_room_department_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_room_department_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_room_department_images`
--

LOCK TABLES `be_booking_room_department_images` WRITE;
/*!40000 ALTER TABLE `be_booking_room_department_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_booking_room_department_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_room_department_reservations`
--

DROP TABLE IF EXISTS `be_booking_room_department_reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_room_department_reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `object_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `object_id` int(11) DEFAULT NULL,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `data` longblob,
  `price` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_room_department_reservations`
--

LOCK TABLES `be_booking_room_department_reservations` WRITE;
/*!40000 ALTER TABLE `be_booking_room_department_reservations` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_booking_room_department_reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_room_department_usergroup_discounts`
--

DROP TABLE IF EXISTS `be_booking_room_department_usergroup_discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_room_department_usergroup_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `usergroup_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `price_opt` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_room_department_usergroup_discounts`
--

LOCK TABLES `be_booking_room_department_usergroup_discounts` WRITE;
/*!40000 ALTER TABLE `be_booking_room_department_usergroup_discounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_booking_room_department_usergroup_discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_room_department_vouchers`
--

DROP TABLE IF EXISTS `be_booking_room_department_vouchers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_room_department_vouchers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `price_opt` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_room_department_vouchers`
--

LOCK TABLES `be_booking_room_department_vouchers` WRITE;
/*!40000 ALTER TABLE `be_booking_room_department_vouchers` DISABLE KEYS */;
INSERT INTO `be_booking_room_department_vouchers` VALUES (1,3,'Event 1 Discount','event1discount','2018-12-01',20.00,'percent');
/*!40000 ALTER TABLE `be_booking_room_department_vouchers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_room_departments`
--

DROP TABLE IF EXISTS `be_booking_room_departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_room_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(11,2) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `vat` decimal(11,2) DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `featured` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `active` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'yes',
  `available_days` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `early_discount` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `voucher_discount` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `group_discount` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `usergroup_discount` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `addon_service` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `time_created` int(11) DEFAULT NULL,
  `groups_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `default_view` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_room_departments`
--

LOCK TABLES `be_booking_room_departments` WRITE;
/*!40000 ALTER TABLE `be_booking_room_departments` DISABLE KEYS */;
INSERT INTO `be_booking_room_departments` VALUES (1,13,1,'Meeting Room 1','meeting-room-1','/files/be_demo/booking_rooms/images/roomlogo.png','<p><strong>Meeting Rooms 1</strong></p>\r\n\r\n<p>Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.</p>\r\n',0.00,1,0.00,'be-category-bar-green','2018-06-03','2018-06-03','10:00','21:02',8,'yes','yes','Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday','no','no',NULL,NULL,NULL,1505898330,'','listYear'),(2,13,1,'Meeting Room 2','meeting-room-2','/files/be_demo/booking_rooms/images/roomlogo.png','<p><strong>Meeting Room 2</strong></p>\r\n\r\n<p>Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.</p>\r\n',0.00,1,0.00,'be-category-bar-blue','2018-06-07','2018-06-07','10:00','17:00',5,'no','yes','Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday','no','no',NULL,NULL,NULL,1505898339,'','listYear'),(3,13,2,'Venue Space 1','venue-space-1','/files/be_demo/booking_rooms/images/roomlogo.png','<p><strong>Venue Space 1</strong></p>\r\n\r\n<p>Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.</p>\r\n',0.50,1,23.00,'be-category-bar-orange','2018-06-14','2018-06-14','10:00','16:30',35,'no','yes','Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday','yes','yes',NULL,NULL,NULL,1505898349,'','listYear'),(4,13,2,'Venue Space 2','venue-space-2','/files/be_demo/booking_rooms/images/roomlogo.png','<p><strong>Venue Space 2</strong></p>\r\n\r\n<p>Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.</p>\r\n',2.00,1,23.00,'be-category-bar-purple','2018-06-20','2018-06-24','10:00','18:00',100,'no','yes','Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday','no','no',NULL,NULL,NULL,1505898360,'','listYear');
/*!40000 ALTER TABLE `be_booking_room_departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_room_orders`
--

DROP TABLE IF EXISTS `be_booking_room_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_room_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `booking_room_id` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `paid` decimal(10,2) DEFAULT '0.00',
  `paid_toggle` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_created` int(11) DEFAULT NULL,
  `time_paid` int(11) DEFAULT NULL,
  `trans_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_room_orders`
--

LOCK TABLES `be_booking_room_orders` WRITE;
/*!40000 ALTER TABLE `be_booking_room_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_booking_room_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_booking_rooms`
--

DROP TABLE IF EXISTS `be_booking_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_booking_rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `department_id` int(11) unsigned NOT NULL,
  `date` date DEFAULT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `recurrence_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','reserved','approved','canceled','completed','denied','booked') COLLATE utf8mb4_unicode_ci DEFAULT 'booked',
  `time_created` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_booking_rooms`
--

LOCK TABLES `be_booking_rooms` WRITE;
/*!40000 ALTER TABLE `be_booking_rooms` DISABLE KEYS */;
INSERT INTO `be_booking_rooms` VALUES (35,13,2,'2018-11-09','14:00','17:00','','booked',1505898120),(36,13,1,'2018-11-12','12:00','15:00','','booked',1505898127),(37,13,1,'2018-11-12','12:00','15:00','','booked',1505898127),(38,13,3,'2018-11-11','17:30','21:30','','booked',1505898131),(39,13,4,'2018-11-08','20:00','21:30','','booked',1505898137),(40,13,1,'2018-11-25','9:00','21:30','','booked',1505898147),(41,13,1,'2018-11-25','10:00','21:30','','booked',1505898152),(42,13,2,'2018-11-22','11:30','18:00','','booked',1505898159),(43,13,2,'2018-11-20','11:30','12:00','','booked',1505898166),(44,13,1,'2018-11-21','12:30','13:00','','booked',1505898170),(45,13,2,'2018-11-22','14:00','14:30','','booked',1505898175),(46,13,1,'2018-11-23','15:30','16:00','','booked',1505898179),(47,13,1,'2018-11-24','17:00','17:30','','booked',1505898183),(48,13,2,'2018-11-19','16:00','16:30','','booked',1505898188),(49,13,3,'2018-11-20','18:00','18:30','','booked',1505898194),(50,13,4,'2018-11-21','20:00','20:30','','booked',1505898201);
/*!40000 ALTER TABLE `be_booking_rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_builderpayment_addresses`
--

DROP TABLE IF EXISTS `be_builderpayment_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_builderpayment_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_builderpayment_addresses`
--

LOCK TABLES `be_builderpayment_addresses` WRITE;
/*!40000 ALTER TABLE `be_builderpayment_addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_builderpayment_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_builderpayment_link_order_bill_addr`
--

DROP TABLE IF EXISTS `be_builderpayment_link_order_bill_addr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_builderpayment_link_order_bill_addr` (
  `id` int(11) NOT NULL,
  `billingaddress_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_builderpayment_link_order_bill_addr`
--

LOCK TABLES `be_builderpayment_link_order_bill_addr` WRITE;
/*!40000 ALTER TABLE `be_builderpayment_link_order_bill_addr` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_builderpayment_link_order_bill_addr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_builderpayment_link_order_product`
--

DROP TABLE IF EXISTS `be_builderpayment_link_order_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_builderpayment_link_order_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_builderpayment_link_order_product`
--

LOCK TABLES `be_builderpayment_link_order_product` WRITE;
/*!40000 ALTER TABLE `be_builderpayment_link_order_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_builderpayment_link_order_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_builderpayment_link_order_ship_addr`
--

DROP TABLE IF EXISTS `be_builderpayment_link_order_ship_addr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_builderpayment_link_order_ship_addr` (
  `id` int(11) NOT NULL,
  `shippingaddress_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_builderpayment_link_order_ship_addr`
--

LOCK TABLES `be_builderpayment_link_order_ship_addr` WRITE;
/*!40000 ALTER TABLE `be_builderpayment_link_order_ship_addr` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_builderpayment_link_order_ship_addr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_builderpayment_link_ship_user`
--

DROP TABLE IF EXISTS `be_builderpayment_link_ship_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_builderpayment_link_ship_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shippingaddress_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_builderpayment_link_ship_user`
--

LOCK TABLES `be_builderpayment_link_ship_user` WRITE;
/*!40000 ALTER TABLE `be_builderpayment_link_ship_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_builderpayment_link_ship_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_builderpayment_order_products`
--

DROP TABLE IF EXISTS `be_builderpayment_order_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_builderpayment_order_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `custom_data` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_builderpayment_order_products`
--

LOCK TABLES `be_builderpayment_order_products` WRITE;
/*!40000 ALTER TABLE `be_builderpayment_order_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_builderpayment_order_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_builderpayment_orders`
--

DROP TABLE IF EXISTS `be_builderpayment_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_builderpayment_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT '0',
  `custom_data` longblob,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','paid','canceled') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `billingaddress_id` int(11) DEFAULT NULL,
  `shippingaddress_id` int(11) DEFAULT NULL,
  `callback` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `gross` decimal(11,2) DEFAULT NULL,
  `paid_gross` decimal(11,2) DEFAULT '0.00',
  `shipped` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `time_created` int(11) DEFAULT '0',
  `time_paid` int(11) DEFAULT '0',
  `trans_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_builderpayment_orders`
--

LOCK TABLES `be_builderpayment_orders` WRITE;
/*!40000 ALTER TABLE `be_builderpayment_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_builderpayment_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_cache`
--

DROP TABLE IF EXISTS `be_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_cache` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `object` blob,
  `timeout` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_cache`
--

LOCK TABLES `be_cache` WRITE;
/*!40000 ALTER TABLE `be_cache` DISABLE KEYS */;
INSERT INTO `be_cache` VALUES ('be_visitor_location_::1','a:3:{s:7:\"message\";s:14:\"reserved range\";s:5:\"query\";s:3:\"::1\";s:6:\"status\";s:4:\"fail\";}',1552579666),('f_populate_admin_links-modules','a:19:{i:0;s:1:\".\";i:1;s:2:\"..\";i:2;s:9:\".htaccess\";i:3;s:11:\"audioplayer\";i:4;s:4:\"blog\";i:5;s:14:\"booking_events\";i:6;s:19:\"booking_memberships\";i:7;s:13:\"booking_rooms\";i:8;s:14:\"builder_market\";i:9;s:14:\"builderpayment\";i:10;s:11:\"classifieds\";i:11;s:2:\"cp\";i:12;s:9:\"ecommerce\";i:13;s:5:\"forum\";i:14;s:13:\"layout_system\";i:15;s:13:\"module_system\";i:16;s:4:\"page\";i:17;s:12:\"photogallery\";i:18;s:9:\"videotube\";}',0),('latest_be_version','s:212:\"<br />\n<b>Notice</b>:  Undefined index: client in <b>/websites/update2018/public_html/check.php</b> on line <b>6</b><br />\n{\"result\":false,\"message\":\"What are you trying to do exactly?, thanks for passing by...\"}\";',1549901386);
/*!40000 ALTER TABLE `be_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_classifieds_ad_reports`
--

DROP TABLE IF EXISTS `be_classifieds_ad_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_classifieds_ad_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT '0',
  `text` text COLLATE utf8mb4_unicode_ci,
  `time_of_creation` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_classifieds_ad_reports`
--

LOCK TABLES `be_classifieds_ad_reports` WRITE;
/*!40000 ALTER TABLE `be_classifieds_ad_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_classifieds_ad_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_classifieds_categories`
--

DROP TABLE IF EXISTS `be_classifieds_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_classifieds_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int(255) DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_classifieds_categories`
--

LOCK TABLES `be_classifieds_categories` WRITE;
/*!40000 ALTER TABLE `be_classifieds_categories` DISABLE KEYS */;
INSERT INTO `be_classifieds_categories` VALUES (1,'Clothes & Lifestyles',0,'/files/be_demo/classifieds/images/c1.jpg','/files/be_demo/classifieds/images/c2.jpg'),(2,'Clothes',1,'',''),(3,'Clothing Accessories',1,'',''),(4,'Electronics',0,'/files/be_demo/classifieds/images/c6.jpg','/files/be_demo/classifieds/images/c5.jpg'),(5,'Phones & Tablets',4,'',''),(6,'Home Electronics',4,'',''),(7,'Motors',0,'/files/be_demo/classifieds/images/c10.jpg','/files/be_demo/classifieds/images/c9.jpg'),(8,'Cars',7,'',''),(9,'MotorBikes',7,'',''),(10,'Trucks',7,'',''),(11,'Sports',0,'/files/be_demo/classifieds/images/c12.jpg','/files/be_demo/classifieds/images/c11.jpg'),(12,'Gym',11,'',''),(13,'Cycling',11,'',''),(14,'Sport Kits',11,'',''),(17,'Furniture',0,'/files/be_demo/classifieds/images/c16.jpg','/files/be_demo/classifieds/images/c15.jpg'),(18,'Interiors',17,'',''),(19,'Outdoors',17,'',''),(20,'Business',0,'/files/be_demo/classifieds/images/c22.jpg','/files/be_demo/classifieds/images/c21.jpg'),(21,'Services',20,'',''),(22,'Job Vacancies',20,'',''),(23,'Jobs Wanted',20,'',''),(24,'Property',0,'/files/be_demo/classifieds/images/c24.jpg','/files/be_demo/classifieds/images/c23.jpg'),(25,'House For Sale',24,'',''),(26,'House For Rent',24,'',''),(27,'Land For Sale',24,'',''),(28,'Commercial Property',24,'','');
/*!40000 ALTER TABLE `be_classifieds_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_classifieds_followers`
--

DROP TABLE IF EXISTS `be_classifieds_followers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_classifieds_followers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `following_user` int(11) DEFAULT NULL,
  `followed_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_classifieds_followers`
--

LOCK TABLES `be_classifieds_followers` WRITE;
/*!40000 ALTER TABLE `be_classifieds_followers` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_classifieds_followers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_classifieds_images`
--

DROP TABLE IF EXISTS `be_classifieds_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_classifieds_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_classifieds_images`
--

LOCK TABLES `be_classifieds_images` WRITE;
/*!40000 ALTER TABLE `be_classifieds_images` DISABLE KEYS */;
INSERT INTO `be_classifieds_images` VALUES (1,2,'/files/be_demo/classifieds/images/909ec9d75c9d7e0b59e32068bd9af5cc.jpg'),(2,2,'/files/be_demo/classifieds/images/8a669c2f504f38310195191dc773a95c.jpg'),(3,1,'/files/be_demo/classifieds/images/7e61c72548883b38111e0268a7ad0725.jpg'),(4,1,'/files/be_demo/classifieds/images/aff50af9a56cbb56ce07819ca286b950.jpg'),(5,3,'/files/be_demo/classifieds/images/e7b6c878445ee0945579932be6d5582b.jpg'),(6,4,'/files/be_demo/classifieds/images/d14e9c727824281e32c56c74446a7e66.jpg'),(7,5,'/files/be_demo/classifieds/images/16e52b9a29026e94a2d02a90c16ac595.jpg'),(8,5,'/files/be_demo/classifieds/images/ac980db3c6daf4ff9050d143b89b63dc.jpg');
/*!40000 ALTER TABLE `be_classifieds_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_classifieds_items`
--

DROP TABLE IF EXISTS `be_classifieds_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_classifieds_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posting_member_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `currency_id` int(255) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `time_of_creation` int(11) DEFAULT NULL,
  `views` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sold` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `activation_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ad_completed` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `condition` enum('very good','good','preserved','damaged','excellent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_of_sell` int(11) DEFAULT NULL,
  `lga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seller_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_renew_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_classifieds_items`
--

LOCK TABLES `be_classifieds_items` WRITE;
/*!40000 ALTER TABLE `be_classifieds_items` DISABLE KEYS */;
INSERT INTO `be_classifieds_items` VALUES (1,13,2,1,'Fashion Item 1',25.00,'/files/be_demo/classifieds/images/7e61c72548883b38111e0268a7ad0725.jpg','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum id dui sed tempor. Ut porttitor et augue et eleifend. Maecenas in justo ligula. Suspendisse vitae nulla accumsan, sollicitudin ipsum non, elementum risus. Aliquam quam dui, finibus ac','001459382715','info@yourwebsite.com','yes',1503908757,'25',NULL,NULL,NULL,'Portershed, Eyre Square, Galway City','no','','yes',NULL,NULL,NULL,NULL,NULL,'Ireland','Connacht',NULL),(2,13,2,1,'Fashion Item 2',15.00,'/files/be_demo/classifieds/images/909ec9d75c9d7e0b59e32068bd9af5cc.jpg','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum id dui sed tempor. Ut porttitor et augue et eleifend. Maecenas in justo ligula. Suspendisse vitae nulla accumsan, sollicitudin ipsum non, elementum risus. Aliquam quam dui, finibus ac','3256968822','info@yourwebsite.com','no',1503908069,'4',NULL,NULL,NULL,'GPO, OConnell Street Lower, North City, Dublin 1','no','','yes',NULL,NULL,NULL,NULL,NULL,'Ireland','Leinster',NULL),(3,13,3,1,'Bag Item 3',55.00,'/files/be_demo/classifieds/images/e7b6c878445ee0945579932be6d5582b.jpg','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum id dui sed tempor. Ut porttitor et augue et eleifend. Maecenas in justo ligula. Suspendisse vitae nulla accumsan, sollicitudin ipsum non, elementum risus. Aliquam quam dui, finibus ac','547773323335','info@yoursite.com','no',1503908891,'5',NULL,NULL,NULL,'GPO, 30 Oliver Plunkett Street, Centre, Cork','no','','yes',NULL,NULL,NULL,NULL,NULL,'Ireland','Munster',NULL),(4,13,5,1,'Phone Item 1',200.00,'/files/be_demo/classifieds/images/d14e9c727824281e32c56c74446a7e66.jpg','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum id dui sed tempor. Ut porttitor et augue et eleifend. Maecenas in justo ligula. Suspendisse vitae nulla accumsan, sollicitudin ipsum non, elementum risus. Aliquam quam dui, finibus ac','4667770333667','you@yourwebsite.com','no',1503909438,'2',NULL,NULL,NULL,'Manhattan, New York','no','','yes',NULL,NULL,NULL,NULL,NULL,'United States','New York',NULL),(5,13,6,1,'Laptop Item 2',750.00,'/files/be_demo/classifieds/images/16e52b9a29026e94a2d02a90c16ac595.jpg','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum id dui sed tempor. Ut porttitor et augue et eleifend. Maecenas in justo ligula. Suspendisse vitae nulla accumsan, sollicitudin ipsum non, elementum risus. Aliquam quam dui, finibus ac','689693338666','info@yourwebsite.com','no',1503910193,'77',NULL,NULL,NULL,'New Town Plaza, 18-19 Shatin Centre Street, Shatin','no','','yes',NULL,NULL,NULL,NULL,NULL,'Hong Kong','New Territories',NULL);
/*!40000 ALTER TABLE `be_classifieds_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_classifieds_items_extend`
--

DROP TABLE IF EXISTS `be_classifieds_items_extend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_classifieds_items_extend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `make` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_car` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `milage` int(255) DEFAULT NULL,
  `vin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_classifieds_items_extend`
--

LOCK TABLES `be_classifieds_items_extend` WRITE;
/*!40000 ALTER TABLE `be_classifieds_items_extend` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_classifieds_items_extend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_classifieds_items_users`
--

DROP TABLE IF EXISTS `be_classifieds_items_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_classifieds_items_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_classifieds_items_users`
--

LOCK TABLES `be_classifieds_items_users` WRITE;
/*!40000 ALTER TABLE `be_classifieds_items_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_classifieds_items_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_classifieds_locations`
--

DROP TABLE IF EXISTS `be_classifieds_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_classifieds_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_classifieds_locations`
--

LOCK TABLES `be_classifieds_locations` WRITE;
/*!40000 ALTER TABLE `be_classifieds_locations` DISABLE KEYS */;
INSERT INTO `be_classifieds_locations` VALUES (1,4,'Connacht'),(2,4,'Ulster'),(3,4,'Munster'),(4,4,'Leinster'),(5,3,'Greater London'),(6,3,'South East'),(7,3,'West Midlands'),(8,3,'North West'),(9,1,'California'),(10,1,'New York'),(11,1,'Texas'),(12,1,'Washington'),(13,44,'Central'),(14,44,'Kowloon'),(15,44,'New Territories'),(16,44,'Hong Kong Island');
/*!40000 ALTER TABLE `be_classifieds_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_classifieds_makes`
--

DROP TABLE IF EXISTS `be_classifieds_makes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_classifieds_makes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_classifieds_makes`
--

LOCK TABLES `be_classifieds_makes` WRITE;
/*!40000 ALTER TABLE `be_classifieds_makes` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_classifieds_makes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_classifieds_messages`
--

DROP TABLE IF EXISTS `be_classifieds_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_classifieds_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `time_of_creation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viewed` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `linked_product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_classifieds_messages`
--

LOCK TABLES `be_classifieds_messages` WRITE;
/*!40000 ALTER TABLE `be_classifieds_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_classifieds_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_classifieds_models`
--

DROP TABLE IF EXISTS `be_classifieds_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_classifieds_models` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `make_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_classifieds_models`
--

LOCK TABLES `be_classifieds_models` WRITE;
/*!40000 ALTER TABLE `be_classifieds_models` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_classifieds_models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_classifieds_regions`
--

DROP TABLE IF EXISTS `be_classifieds_regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_classifieds_regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_classifieds_regions`
--

LOCK TABLES `be_classifieds_regions` WRITE;
/*!40000 ALTER TABLE `be_classifieds_regions` DISABLE KEYS */;
INSERT INTO `be_classifieds_regions` VALUES (1,'United States'),(2,'Canada'),(3,'United Kingdom'),(4,'Ireland'),(5,'Germany'),(6,'France'),(7,'Belgium'),(8,'Netherlands'),(9,'Switzerland'),(10,'Croatia'),(11,'Greece'),(12,'Italy'),(13,'Malta'),(14,'Portugal'),(15,'Serbia'),(16,'Spain'),(17,'Bulgaria'),(18,'Denmark'),(19,'Estonia'),(20,'Finland'),(21,'Iceland'),(22,'Latvia'),(23,'Norway'),(24,'Sweden'),(25,'Mexico'),(26,'Russia'),(27,'Ukraine'),(28,'Kenya'),(29,'Egypt'),(30,'Morocco'),(31,'South Africa'),(32,'Nigeria'),(33,'Bahamas'),(34,'Cayman Islands'),(35,'Jamaica'),(36,'Panama'),(37,'Argentina'),(38,'Brazil'),(39,'Chile'),(40,'Colombia'),(41,'Paraguay'),(42,'Peru'),(43,'China'),(44,'Hong Kong'),(45,'Japan'),(46,'Mongolia'),(47,'South Korea'),(48,'Taiwan'),(49,'Indonesia'),(50,'Malaysia'),(51,'Philippines'),(52,'Singapore'),(53,'Thailand'),(54,'Vietnam'),(55,'India'),(56,'Cyprus'),(57,'Israel'),(58,'Turkey');
/*!40000 ALTER TABLE `be_classifieds_regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_classifieds_review_reports`
--

DROP TABLE IF EXISTS `be_classifieds_review_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_classifieds_review_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review_id` int(11) DEFAULT '0',
  `text` text COLLATE utf8mb4_unicode_ci,
  `time_of_creation` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_classifieds_review_reports`
--

LOCK TABLES `be_classifieds_review_reports` WRITE;
/*!40000 ALTER TABLE `be_classifieds_review_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_classifieds_review_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_classifieds_reviews`
--

DROP TABLE IF EXISTS `be_classifieds_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_classifieds_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `user` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_classifieds_reviews`
--

LOCK TABLES `be_classifieds_reviews` WRITE;
/*!40000 ALTER TABLE `be_classifieds_reviews` DISABLE KEYS */;
INSERT INTO `be_classifieds_reviews` VALUES (1,1,'admin',NULL,NULL,'Test comment','10/10/2017'),(2,1,'Guest112',NULL,NULL,'Guest112 test comment.','10/10/2017');
/*!40000 ALTER TABLE `be_classifieds_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_classifieds_user_watchlist`
--

DROP TABLE IF EXISTS `be_classifieds_user_watchlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_classifieds_user_watchlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_classifieds_user_watchlist`
--

LOCK TABLES `be_classifieds_user_watchlist` WRITE;
/*!40000 ALTER TABLE `be_classifieds_user_watchlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_classifieds_user_watchlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_classifieds_users_extend`
--

DROP TABLE IF EXISTS `be_classifieds_users_extend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_classifieds_users_extend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activation_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_completed` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `password_reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `post_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business` enum('individual','professional') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_classifieds_users_extend`
--

LOCK TABLES `be_classifieds_users_extend` WRITE;
/*!40000 ALTER TABLE `be_classifieds_users_extend` DISABLE KEYS */;
INSERT INTO `be_classifieds_users_extend` VALUES (1,13,NULL,NULL,NULL,NULL,NULL,NULL,'','yes',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `be_classifieds_users_extend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_currencies`
--

DROP TABLE IF EXISTS `be_currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol_position` enum('after','before') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_currencies`
--

LOCK TABLES `be_currencies` WRITE;
/*!40000 ALTER TABLE `be_currencies` DISABLE KEYS */;
INSERT INTO `be_currencies` VALUES (1,'Euro Member Countries','EUR','€','before'),(2,'United Kingdom Pound','GBP','£','before'),(3,'United States Dollar','USD','$','before'),(4,'Aruba Guilder','AWG','ƒ','before'),(5,'Australia Dollar','AUD','$','before'),(6,'Azerbaijan New Manat','AZN','ман','before'),(7,'Bahamas Dollar','BSD','$','before'),(8,'Barbados Dollar','BBD','$','before'),(9,'Belarus Ruble','BYN','Br','before'),(10,'Belize Dollar','BZD','BZ$','before'),(11,'Bermuda Dollar','BMD','$','before'),(12,'Bolivia Bolíviano','BOB','$b','before'),(13,'Bosnia and Herzegovina Convertible Marka','BAM','KM','before'),(14,'Botswana Pula','BWP','P','before'),(15,'Bulgaria Lev','BGN','лв','before'),(16,'Brazil Real','BRL','R$','before'),(17,'Brunei Darussalam Dollar','BND','$','before'),(18,'Cambodia Riel','KHR','៛','before'),(19,'Canada Dollar','CAD','$','before'),(20,'Cayman Islands Dollar','KYD','$','before'),(21,'Chile Peso','CLP','$','before'),(22,'China Yuan Renminbi','CNY','¥','before'),(23,'Colombia Peso','COP','$','before'),(24,'Costa Rica Colon','CRC','₡','before'),(25,'Croatia Kuna','HRK','kn','before'),(26,'Cuba Peso','	CUP','₱','before'),(27,'Czech Republic Koruna','CZK','Kč','before'),(28,'Denmark Krone','DKK','kr','before'),(29,'Dominican Republic Peso','DOP','RD$','before'),(30,'East Caribbean Dollar','XCD','$','before'),(31,'Egypt Pound','EGP','£','before'),(32,'El Salvador Colon','SVC','$','before'),(33,'Albania Lek','ALL','Lek','before'),(34,'Falkland Islands (Malvinas) Pound','FKP','£','before'),(35,'Fiji Dollar','FJD','$','before'),(36,'Ghana Cedi','GHS','¢','before'),(37,'Gibraltar Pound','GIP','£','before'),(38,'Guatemala Quetzal','GTQ','Q','before'),(39,'Guernsey Pound','GGP','£','before'),(40,'Guyana Dollar','GYD','$','before'),(41,'Honduras Lempira','HNL','L','before'),(42,'Hong Kong Dollar','HKD','$','before'),(43,'Hungary Forint','HUF','Ft','before'),(44,'Iceland Krona','ISK','kr','before'),(45,'India Rupee','INR','₹','before'),(46,'Indonesia Rupiah','IDR','Rp','before'),(47,'Iran Rial','IRR','﷼','before'),(48,'Isle of Man Pound','IMP','£','before'),(49,'Israel Shekel','ILS','₪','before'),(50,'Jamaica Dollar','JMD','J$','before'),(51,'Japan Yen','JPY','¥','before'),(52,'Jersey Pound','JEP','£','before'),(53,'Kazakhstan Tenge','KZT','лв','before'),(54,'Korea (North) Won','KPW','₩','before'),(55,'Korea (South) Won','KRW','₩','before'),(56,'Kyrgyzstan Som','KGS','лв','before'),(57,'Laos Kip','LAK','₭','before'),(58,'Lebanon Pound','LBP','£','before'),(59,'Liberia Dollar','LRD','$','before'),(60,'Macedonia Denar','MKD','ден','before'),(61,'Malaysia Ringgit','MYR','RM','before'),(62,'Mauritius Rupee','MUR','₨','before'),(63,'Mexico Peso','MXN','$','before'),(64,'Mongolia Tughrik','MNT','₮','before'),(65,'Mozambique Metical','MZN','MT','before'),(66,'Namibia Dollar','NAD','$','before'),(67,'Nepal Rupee','NPR','₨','before'),(68,'Netherlands Antilles Guilder','ANG','ƒ','before'),(69,'New Zealand Dollar','NZD','$','before'),(70,'Nicaragua Cordoba','NIO','C$','before'),(71,'Nigeria Naira','NGN','₦','before'),(72,'Korea (North) Won','KPW','₩','before'),(73,'Norway Krone','NOK','kr','before'),(74,'Oman Rial','OMR','﷼','before'),(75,'Pakistan Rupee','PKR','₨','before'),(76,'Panama Balboa','PAB','B/.','before'),(77,'Paraguay Guarani','PYG','Gs','before'),(78,'Peru Sol','PEN','S/.','before'),(79,'Philippines Peso','PHP','₱','before'),(80,'Poland Zloty','PLN','zł','before'),(81,'Qatar Riyal','QAR','﷼','before'),(82,'Romania New Leu','RON','lei','before'),(83,'Russia Ruble','RUB','руб','after'),(84,'Saint Helena Pound','SHP','£','before'),(85,'Saudi Arabia Riyal','SAR','﷼','before'),(86,'Serbia Dinar','RSD','Дин.','after'),(87,'Seychelles Rupee','SCR','₨','before'),(88,'Singapore Dollar','SGD','$','before'),(89,'Solomon Islands Dollar','SBD','$','before'),(90,'Somalia Shilling','SOS','S','before'),(91,'South Africa Rand','ZAR','R','before'),(92,'Korea (South) Won','KRW','₩','before'),(93,'Sri Lanka Rupee','LKR','₨','before'),(94,'Sweden Krona','SEK','kr','before'),(95,'Switzerland Franc','CHF','CHF','before'),(96,'Suriname Dollar','SRD','$','before'),(97,'Syria Pound','SYP','£','before'),(98,'Taiwan New Dollar','TWD','NT$','before'),(99,'Thailand Baht','THB','฿','before'),(100,'Trinidad and Tobago Dollar','TTD','TT$','before'),(101,'Turkey Lira','TRY','₺','before'),(102,'Tuvalu Dollar','TVD','$','before'),(103,'Ukraine Hryvnia','UAH','₴','before'),(104,'Afghanistan Afghani','AFN','؋','before'),(105,'Argentina Peso','ARS','$','before'),(106,'Uruguay Peso','UYU','$U','before'),(107,'Uzbekistan Som','UZS','лв','before'),(108,'Venezuela Bolivar','VEF','Bs','before'),(109,'Viet Nam Dong','VND','₫','before'),(110,'Yemen Rial','YER','﷼','before'),(111,'Zimbabwe Dollar','ZWD','Z$','before');
/*!40000 ALTER TABLE `be_currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_brands`
--

DROP TABLE IF EXISTS `be_ecommerce_brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_brands`
--

LOCK TABLES `be_ecommerce_brands` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_brands` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_ecommerce_brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_categories`
--

DROP TABLE IF EXISTS `be_ecommerce_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'yes',
  `parent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_categories`
--

LOCK TABLES `be_ecommerce_categories` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_categories` DISABLE KEYS */;
INSERT INTO `be_ecommerce_categories` VALUES (1,'Laptops','','yes','0'),(2,'Phones','','yes','0'),(3,'Watches','/files/be_demo/ecommerce/watches/watchco-banner.jpg','yes','0');
/*!40000 ALTER TABLE `be_ecommerce_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_category_fields`
--

DROP TABLE IF EXISTS `be_ecommerce_category_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_category_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `field_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_category_fields`
--

LOCK TABLES `be_ecommerce_category_fields` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_category_fields` DISABLE KEYS */;
INSERT INTO `be_ecommerce_category_fields` VALUES (1,3,6),(2,3,7),(3,3,8),(4,3,9),(5,3,10),(6,3,11),(7,3,12),(8,1,41),(9,1,42),(10,1,43),(11,1,44),(12,1,45),(13,1,46),(14,1,47),(15,1,48),(16,2,50),(17,2,51),(18,2,52),(19,2,53),(20,2,54),(21,2,55);
/*!40000 ALTER TABLE `be_ecommerce_category_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_checkout_custom_fields`
--

DROP TABLE IF EXISTS `be_ecommerce_checkout_custom_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_checkout_custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `input_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `displayed_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('text','textarea','select') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `required` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_checkout_custom_fields`
--

LOCK TABLES `be_ecommerce_checkout_custom_fields` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_checkout_custom_fields` DISABLE KEYS */;
INSERT INTO `be_ecommerce_checkout_custom_fields` VALUES (8,'Comment','Comment','textarea','no','yes',NULL),(9,'Shipping_Method','Shipping Method','select','yes','yes','Airmail,Express,Free,Economy');
/*!40000 ALTER TABLE `be_ecommerce_checkout_custom_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_comments`
--

DROP TABLE IF EXISTS `be_ecommerce_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_comments`
--

LOCK TABLES `be_ecommerce_comments` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_ecommerce_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_company`
--

DROP TABLE IF EXISTS `be_ecommerce_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_vat_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_company`
--

LOCK TABLES `be_ecommerce_company` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_company` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_ecommerce_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_currency_exchange_rates`
--

DROP TABLE IF EXISTS `be_ecommerce_currency_exchange_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_currency_exchange_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_one` int(11) NOT NULL,
  `currency_two` int(11) NOT NULL,
  `rate` decimal(10,5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_currency_exchange_rates`
--

LOCK TABLES `be_ecommerce_currency_exchange_rates` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_currency_exchange_rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_ecommerce_currency_exchange_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_customer_shipping_billing`
--

DROP TABLE IF EXISTS `be_ecommerce_customer_shipping_billing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_customer_shipping_billing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_customer_shipping_billing`
--

LOCK TABLES `be_ecommerce_customer_shipping_billing` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_customer_shipping_billing` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_ecommerce_customer_shipping_billing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_fields`
--

DROP TABLE IF EXISTS `be_ecommerce_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_fields`
--

LOCK TABLES `be_ecommerce_fields` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_fields` DISABLE KEYS */;
INSERT INTO `be_ecommerce_fields` VALUES (1,'Warranty:','custom'),(2,'Manners','custom'),(3,'Some one','custom'),(4,'Price/Grams','custom'),(5,'some/ses','custom'),(6,'Manufacturer','category'),(7,'Movement','category'),(8,'Case','category'),(9,'Strap','category'),(10,'Water Resistance','category'),(11,'Diameter','category'),(12,'Thickness','category'),(13,'Oscillator','custom'),(14,'Power reserve','custom'),(15,'Functions','custom'),(16,'Oscillator','custom'),(17,'Power reserve','custom'),(18,'Functions','custom'),(19,'Power Reserve','custom'),(20,'Features','custom'),(21,'Functions','custom'),(22,'Features','custom'),(23,'Functions','custom'),(24,'Features','custom'),(25,'Functions','custom'),(26,'Features','custom'),(27,'Dial','custom'),(28,'Features','custom'),(29,'Additional','custom'),(30,'Functions','custom'),(31,'Features','custom'),(32,'Finish & Care','custom'),(33,'Power Reserve','custom'),(34,'Features','custom'),(35,'CHRONOMETER','custom'),(36,'Functions','custom'),(37,'Dial','custom'),(38,'Functions','custom'),(39,'Features','custom'),(40,'Power Reserve','custom'),(41,'Brand',NULL),(42,'Screen',NULL),(43,'Resolution',NULL),(44,'Processor',NULL),(45,'Storage',NULL),(46,'Graphics',NULL),(47,'Colour',NULL),(48,'Weight',NULL),(49,'Special Option',NULL),(50,'Brand',NULL),(51,'Screen',NULL),(52,'Resolution',NULL),(53,'Processor',NULL),(54,'Storage',NULL),(55,'WiFi',NULL);
/*!40000 ALTER TABLE `be_ecommerce_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_member_extended_info_links`
--

DROP TABLE IF EXISTS `be_ecommerce_member_extended_info_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_member_extended_info_links` (
  `member_id` int(11) NOT NULL,
  `extended_info_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_member_extended_info_links`
--

LOCK TABLES `be_ecommerce_member_extended_info_links` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_member_extended_info_links` DISABLE KEYS */;
INSERT INTO `be_ecommerce_member_extended_info_links` VALUES (13,1);
/*!40000 ALTER TABLE `be_ecommerce_member_extended_info_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_product_fields`
--

DROP TABLE IF EXISTS `be_ecommerce_product_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_product_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `field_id` int(11) DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_product_fields`
--

LOCK TABLES `be_ecommerce_product_fields` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_product_fields` DISABLE KEYS */;
INSERT INTO `be_ecommerce_product_fields` VALUES (72,16,30,'hours - minutes - seconds'),(73,16,31,'Sea-Gull TY2807,  Jewel Bearing: 21 jewels, Power Reserve: 36 hours, Frequency: 21,600 BPH (beats per hour), Accuracy: +/- 3 seconds /day'),(74,16,32,'The natural koa is hand finished and pretreated with tung oils. Lemon or orange oil extract is best for cleaning the natural wood. When storing this timepiece, avoid extremely hot, cold, and excessively dry/humid environments.'),(75,16,6,'Jord'),(76,16,7,'Self-winding automatic (requires no battery)'),(77,16,8,'Natural Koa Wood'),(78,16,9,'Natural Koa Wood'),(79,16,10,'No '),(80,16,11,'41 mm'),(81,16,12,'12 mm'),(82,17,33,'60 hours'),(83,17,34,'Bi-directional rotating bezel, Chronometer, Date, Helium escape valve, Screw-in crown'),(84,17,35,'Label given to a watch which has undergone precision tests and received a certificate from an official body (COSC)'),(85,17,6,'Omega'),(86,17,7,'Self-winding movement with Co-Axial escapement.'),(87,17,8,'Steel'),(88,17,9,'Rubber'),(89,17,10,'120 bar'),(90,17,11,'55 mm'),(91,17,12,'48 mm'),(92,18,36,'Alarm Chronograph 7T62, Chronograph up to 60 minutes in 1/5 second increments, Split time measurement, Alarm'),(93,18,6,'Seiko'),(94,18,7,'Self-Winding'),(95,18,8,'Stainless Steel'),(96,18,9,'Various'),(97,18,10,'10 bar'),(98,18,11,'42 mm'),(99,18,12,'na'),(127,13,41,'Commodore'),(128,13,42,'15 Inch'),(129,13,43,'1920 x 1080'),(130,13,44,'Intel Core i5 Processor'),(131,13,45,'128 GB SSD'),(132,13,46,'Intel Iris Plus Graphics 640'),(133,13,47,'Space Grey, Black, White'),(134,13,48,'1.37 kg'),(143,14,41,'Amiga'),(144,14,42,'13 Inch'),(145,14,43,'1920 x 1080'),(146,14,44,'Intel Core i5 Processor'),(147,14,45,'128 GB SSD'),(148,14,46,'Intel Iris Plus Graphics 640'),(149,14,47,'Space Grey, Black, White'),(150,14,48,'1.17 kg'),(159,10,50,'Orange Cell'),(160,10,51,'5.5'),(161,10,52,'1920 x 1080'),(162,10,53,'Intel Core i5 Processor'),(163,10,54,'32 GB SSD'),(164,10,55,'4G'),(165,11,50,'Red Cell'),(166,11,51,'5.5'),(167,11,52,'1920 x 1080'),(168,11,53,'Intel Core i5 Processor'),(169,11,54,'64 GB SSD'),(170,11,55,'4G'),(171,12,50,'Interactive Touch Inc'),(172,12,51,'9.5'),(173,12,52,'1920 x 1080'),(174,12,53,'Intel Core i5 Processor'),(175,12,54,'128 GB SSD'),(176,12,55,'4G');
/*!40000 ALTER TABLE `be_ecommerce_product_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_product_images`
--

DROP TABLE IF EXISTS `be_ecommerce_product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=286 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_product_images`
--

LOCK TABLES `be_ecommerce_product_images` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_product_images` DISABLE KEYS */;
INSERT INTO `be_ecommerce_product_images` VALUES (217,15,'/files/be_demo/ecommerce/store/store-image-16.jpg'),(218,15,'/files/be_demo/ecommerce/store/store-image-17.jpg'),(219,15,'/files/be_demo/ecommerce/store/store-image-18.jpg'),(242,18,'/files/be_demo/ecommerce/watches/seiko_sportura_01.jpg'),(243,18,'/files/be_demo/ecommerce/watches/seiko_sportura_02.jpg'),(247,14,'/files/be_demo/ecommerce/store/store-image-13.jpg'),(248,14,'/files/be_demo/ecommerce/store/store-image-12.jpg'),(249,17,'/files/be_demo/ecommerce/watches/omega_seamaster_1200m_02.jpg'),(250,17,'/files/be_demo/ecommerce/watches/omega_seamaster_1200m_03.jpg'),(273,11,'/files/be_demo/ecommerce/store/store-image-6.jpg'),(274,11,'/files/be_demo/ecommerce/store/store-image-7.jpg'),(275,11,'/files/be_demo/ecommerce/store/store-image-8.jpg'),(276,16,'/files/be_demo/ecommerce/watches/jord_dover_01.jpg'),(277,16,'/files/be_demo/ecommerce/watches/jord_dover_03.jpg'),(278,16,'/files/be_demo/ecommerce/watches/jord_dover_04.jpg'),(279,12,'/files/be_demo/ecommerce/store/store-image-9.jpg'),(280,12,'/files/be_demo/ecommerce/store/store-image-10.jpg'),(281,13,'/files/be_demo/ecommerce/store/store-image-2.jpg'),(282,13,'/files/be_demo/ecommerce/store/store-image-4.jpg'),(283,10,'/files/be_demo/ecommerce/store/store-image-26.jpg'),(284,10,'/files/be_demo/ecommerce/store/store-image-27.jpg'),(285,10,'/files/be_demo/ecommerce/store/store-image-25.jpg');
/*!40000 ALTER TABLE `be_ecommerce_product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_product_options`
--

DROP TABLE IF EXISTS `be_ecommerce_product_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_product_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `option_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options_prices` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_product_options`
--

LOCK TABLES `be_ecommerce_product_options` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_product_options` DISABLE KEYS */;
INSERT INTO `be_ecommerce_product_options` VALUES (36,15,'Add Extra Products','Extra Fans, i7 CPU, Refurbished Version','10, 150, -400, 0'),(37,15,'Select Color','Space Grey, Black Color, White Color','0, 0, 0, 0'),(53,18,'Add Extra Products','Extra Links, Insurance, Refurbished Version','10, 50, 100, 0'),(54,18,'Select Color','Red Color, Black Color, Silver Color','0, 0, 0, 0'),(57,14,'Add Extra Products','Backpack,  256 SSD Storage,  Refurbished Version','10, 50, -500'),(58,14,'Select Color','Space Grey,  Black Color,  White Color','0, 0, 0'),(59,17,'Add Extra Products','Extra Links,  Insurance,  Refurbished Version','10, 50, 500'),(60,17,'Select Color','Red Color,  Black Color,  Silver Color','0, 0, 0'),(77,11,'Add Extra Products','Cover,    128 SSD Storage,    Refurbished Version','10, 50, -200'),(78,11,'Select Color','Space Grey,    Black Color,    White Color','0, 0, 0'),(79,16,'Add Extra Products','Extra Links,   Insurance,   Refurbished Version','10, 50, -100'),(80,16,'Select Color','Red Color,   Black Color,   Silver Color','0, 0, 0'),(81,12,'Add Extra Products','Cover,   256 SSD Storage,   Refurbished Version','10, 50, -100'),(82,12,'Select Color','Space Grey,   Black Color,   White Color','0, 0, 0'),(83,13,'Add Extra Products','Backpack,                    256 SSD Storage,                    Refurbished Version','10, 50, -500'),(84,13,'Select Color','Space Grey,                 Black Color,                 White Color','0, 0, 0'),(85,10,'Add Extra Products','Cover,       128 SSD Storage,       Refurbished Version','10, 50, -200'),(86,10,'Select Color','Space Grey,       Black Color,       White Color','0, 0, 0');
/*!40000 ALTER TABLE `be_ecommerce_product_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_product_shipping_links`
--

DROP TABLE IF EXISTS `be_ecommerce_product_shipping_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_product_shipping_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `shipping_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=281 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_product_shipping_links`
--

LOCK TABLES `be_ecommerce_product_shipping_links` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_product_shipping_links` DISABLE KEYS */;
INSERT INTO `be_ecommerce_product_shipping_links` VALUES (181,15,1),(182,15,2),(183,15,3),(184,15,4),(213,18,1),(214,18,2),(215,18,3),(216,18,4),(221,14,1),(222,14,2),(223,14,3),(224,14,4),(225,17,1),(226,17,2),(227,17,3),(228,17,4),(261,11,1),(262,11,2),(263,11,3),(264,11,4),(265,16,1),(266,16,2),(267,16,3),(268,16,4),(269,12,1),(270,12,2),(271,12,3),(272,12,4),(273,13,1),(274,13,2),(275,13,3),(276,13,4),(277,10,1),(278,10,2),(279,10,3),(280,10,4);
/*!40000 ALTER TABLE `be_ecommerce_product_shipping_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_products`
--

DROP TABLE IF EXISTS `be_ecommerce_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(11,2) unsigned DEFAULT NULL,
  `old_price` decimal(11,2) unsigned DEFAULT '0.00',
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `views` int(11) unsigned NOT NULL DEFAULT '0',
  `time_created` int(11) DEFAULT NULL,
  `active` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_products`
--

LOCK TABLES `be_ecommerce_products` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_products` DISABLE KEYS */;
INSERT INTO `be_ecommerce_products` VALUES (10,'2','Phone 1 Plus 32GB Black','<div class=\"be-store-product-details\">\r\n<h3>Next Generation Smart Phone</h3>\r\n\r\n<p>The Computer is powered by an Intel&reg; Core&trade; i5 processor that delivers responsive, reliable computing whatever the task thanks to a capable 2.9 GHz TurboBoost clock speed.</p>\r\n</div>\r\n<!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-28.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 1</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-26.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 2</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-27.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 3</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-25.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 4</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc -->','/files/be_demo/ecommerce/store/store-image-28.jpg',NULL,NULL,499.00,600.00,'10','yes',79,1520278575,'yes','Discounted'),(11,'2','Phone 2 XE 64GB Sliver','<div class=\"be-store-product-details\">\r\n<h3>Next Generation Smart Phone</h3>\r\n\r\n<p>The Computer is powered by an Intel&reg; Core&trade; i5 processor that delivers responsive, reliable computing whatever the task thanks to a capable 2.9 GHz TurboBoost clock speed.</p>\r\n</div>\r\n<!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-5.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 1</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-6.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 2</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-7.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 3</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-8.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 4</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc -->','/files/be_demo/ecommerce/store/store-image-5.jpg',NULL,NULL,800.00,0.00,'10','no',15,1520278507,'yes','New'),(12,'2','Tablet X 128GB Duel Core','<div class=\"be-store-product-details\">\r\n<h3>Next Generation Smart Tablet</h3>\r\n\r\n<p>The Computer is powered by an Intel&reg; Core&trade; i5 processor that delivers responsive, reliable computing whatever the task thanks to a capable 2.9 GHz TurboBoost clock speed.</p>\r\n</div>\r\n<!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-11.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 1</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-9.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 2</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-10.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 3</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-11.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 4</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc -->','/files/be_demo/ecommerce/store/store-image-11.jpg',NULL,NULL,299.00,0.00,'5','yes',23,1520278558,'yes','Special Offer'),(13,'1','Computer Pro 15 Quad','<div class=\"be-store-product-details\">\r\n<h3>Responsive Computing</h3>\r\n\r\n<p>The Computer is powered by an Intel&reg; Core&trade; i5 processor that delivers responsive, reliable computing whatever the task thanks to a capable 2.9 GHz TurboBoost clock speed.</p>\r\n</div>\r\n<!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-1.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 1</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-2.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 2</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-4.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 3</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-1.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 4</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc -->','/files/be_demo/ecommerce/store/store-image-1.jpg',NULL,NULL,1049.00,1250.00,'5','yes',202,1520278568,'yes','Discounted'),(14,'1','Laptop Air 13 Duel Core','<div class=\"be-store-product-details\">\r\n<h3>Responsive Computing</h3>\r\n\r\n<p>The Computer is powered by an Intel&reg; Core&trade; i5 processor that delivers responsive, reliable computing whatever the task thanks to a capable 2.9 GHz TurboBoost clock speed.</p>\r\n</div>\r\n<!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-14.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 1</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-13.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 2</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-12.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 3</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-14.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 4</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc -->','/files/be_demo/ecommerce/store/store-image-14.jpg',NULL,NULL,899.00,0.00,'10','no',19,1520272252,'yes','Sale'),(15,'1','Motherboard Extreme','<div class=\"be-store-product-details\">\r\n<h3>Responsive Computing</h3>\r\n\r\n<p>The Computer is powered by an Intel&reg; Core&trade; i5 processor that delivers responsive, reliable computing whatever the task thanks to a capable 2.9 GHz TurboBoost clock speed.</p>\r\n</div>\r\n<!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-15.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 1</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-16.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 2</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-17.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 3</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/store/store-image-18.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 4</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc -->','/files/be_demo/ecommerce/store/store-image-15.jpg',NULL,NULL,2300.00,0.00,'5','yes',39,1520271140,'yes','Sale'),(16,'3','Jord Dover Black & Koa','<div class=\"be-store-product-details\">\r\n<h3>Experience The Best Watch Designed</h3>\r\n\r\n<p>The Computer is powered by an Intel&reg; Core&trade; i5 processor that delivers responsive, reliable computing whatever the task thanks to a capable 2.9 GHz TurboBoost clock speed.</p>\r\n</div>\r\n<!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/watches/jord_dover_02.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 1</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/watches/jord_dover_01.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 2</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/watches/jord_dover_03.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 3</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/watches/jord_dover_04.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 4</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc -->','/files/be_demo/ecommerce/watches/jord_dover_02.jpg',NULL,NULL,300.00,0.00,'45','yes',20,1520278544,'yes','Sale'),(17,'3','Omega Seamaster 1200M','<div class=\"be-store-product-details\">\r\n<h3>Experience The Best Watch Designed</h3>\r\n\r\n<p>The Computer is powered by an Intel&reg; Core&trade; i5 processor that delivers responsive, reliable computing whatever the task thanks to a capable 2.9 GHz TurboBoost clock speed.</p>\r\n</div>\r\n<!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/watches/omega_seamaster_1200m_01.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 1</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/watches/omega_seamaster_1200m_02.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 2</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/watches/omega_seamaster_1200m_03.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 3</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/watches/omega_seamaster_1200m_01.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 4</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc -->','/files/be_demo/ecommerce/watches/omega_seamaster_1200m_01.jpg',NULL,NULL,7299.00,7700.00,'23','no',17,1520272277,'yes','Discounted'),(18,'3','Seiko Sportura','<div class=\"be-store-product-details\">\r\n<h3>Experience The Best Watch Designed</h3>\r\n\r\n<p>The Computer is powered by an Intel&reg; Core&trade; i5 processor that delivers responsive, reliable computing whatever the task thanks to a capable 2.9 GHz TurboBoost clock speed.</p>\r\n</div>\r\n<!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/watches/seiko_sportura_03.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 1</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/watches/seiko_sportura_01.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 2</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/watches/seiko_sportura_02.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 3</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc --><!-- BEGIN product-desc -->\r\n\r\n<div class=\"be-store-product-desc right\">\r\n<div class=\"be-store-product-image\"><img alt=\"\" src=\"/files/be_demo/ecommerce/watches/seiko_sportura_03.jpg\" /></div>\r\n\r\n<div class=\"be-store-product-details\">\r\n<h3>Product Info 4</h3>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\r\n</div>\r\n</div>\r\n<!-- END product-desc -->','/files/be_demo/ecommerce/watches/seiko_sportura_03.jpg',NULL,NULL,200.00,0.00,'67','no',18,1520272142,'yes','Sale');
/*!40000 ALTER TABLE `be_ecommerce_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_products_brands`
--

DROP TABLE IF EXISTS `be_ecommerce_products_brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_products_brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_products_brands`
--

LOCK TABLES `be_ecommerce_products_brands` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_products_brands` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_ecommerce_products_brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_reviews`
--

DROP TABLE IF EXISTS `be_ecommerce_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `content` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `date_added` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_reviews`
--

LOCK TABLES `be_ecommerce_reviews` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_reviews` DISABLE KEYS */;
INSERT INTO `be_ecommerce_reviews` VALUES (1,'admin',5,'This is a review comment',13,1520241814),(3,'admin',5,'Product Review & Rating Placeholder',12,1520272506),(4,'admin',5,'Great Product - Review Feedback',10,1520272573);
/*!40000 ALTER TABLE `be_ecommerce_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_shippings`
--

DROP TABLE IF EXISTS `be_ecommerce_shippings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_shippings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `type` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT 'flat',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_shippings`
--

LOCK TABLES `be_ecommerce_shippings` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_shippings` DISABLE KEYS */;
INSERT INTO `be_ecommerce_shippings` VALUES (1,'Free',0.00,'flat'),(2,'Airmail',7.00,'percent'),(3,'Express',5.00,'percent'),(4,'Economy',10.00,'flat');
/*!40000 ALTER TABLE `be_ecommerce_shippings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_users_extend`
--

DROP TABLE IF EXISTS `be_ecommerce_users_extend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_users_extend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_users_extend`
--

LOCK TABLES `be_ecommerce_users_extend` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_users_extend` DISABLE KEYS */;
INSERT INTO `be_ecommerce_users_extend` VALUES (1,'091000000','Portershed,Eyre Square','Ireland',NULL,'Galway City',0);
/*!40000 ALTER TABLE `be_ecommerce_users_extend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_ecommerce_wishlist`
--

DROP TABLE IF EXISTS `be_ecommerce_wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_ecommerce_wishlist` (
  `member_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_ecommerce_wishlist`
--

LOCK TABLES `be_ecommerce_wishlist` WRITE;
/*!40000 ALTER TABLE `be_ecommerce_wishlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_ecommerce_wishlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_forum_areas`
--

DROP TABLE IF EXISTS `be_forum_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_forum_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `groups_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_forum_areas`
--

LOCK TABLES `be_forum_areas` WRITE;
/*!40000 ALTER TABLE `be_forum_areas` DISABLE KEYS */;
INSERT INTO `be_forum_areas` VALUES (1,13,'Forum Area 1','Forum Area 1 description','/files/be_demo/forum/images/icon-star.png','Members',1503385372),(2,13,'Forum Area 2','Forum Area 2 description','/files/be_demo/forum/images/icon-code.png','Members',1503385372),(3,13,'Forum Area 3','Forum Area 3 description','/files/be_demo/forum/images/icon-news.png','Members',1503385372);
/*!40000 ALTER TABLE `be_forum_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_forum_categories`
--

DROP TABLE IF EXISTS `be_forum_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_forum_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `groups_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_created` int(11) NOT NULL,
  `locked` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `views` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_forum_categories`
--

LOCK TABLES `be_forum_categories` WRITE;
/*!40000 ALTER TABLE `be_forum_categories` DISABLE KEYS */;
INSERT INTO `be_forum_categories` VALUES (1,1,13,'Test thread 1','Ius an ullum persius apeirian, has at libris interpretaris.Te tation option vim, ad duo quot iuvaret.Aperiri blandit honestatis vel ei, mel ex dicant intellegebat.Ad sint consetetur per.Et modo quando duo.Mei referrentur reprehendunt ea, mel ut possit graeco.','/files/be_demo/forum/images/icon-star.png','Members',1503385372,'no',0),(2,2,13,'Test thread 2','Ius an ullum persius apeirian, has at libris interpretaris.Te tation option vim, ad duo quot iuvaret.Aperiri blandit honestatis vel ei, mel ex dicant intellegebat.Ad sint consetetur per.Et modo quando duo.Mei referrentur reprehendunt ea, mel ut possit graeco.','/files/be_demo/forum/images/icon-code.png','Members',1503385372,'no',0),(3,3,13,'Test thread 3','Ius an ullum persius apeirian, has at libris interpretaris.Te tation option vim, ad duo quot iuvaret.Aperiri blandit honestatis vel ei, mel ex dicant intellegebat.Ad sint consetetur per.Et modo quando duo.Mei referrentur reprehendunt ea, mel ut possit graeco.','/files/be_demo/forum/images/icon-news.png','Members',1503385372,'no',0);
/*!40000 ALTER TABLE `be_forum_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_forum_icons`
--

DROP TABLE IF EXISTS `be_forum_icons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_forum_icons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_forum_icons`
--

LOCK TABLES `be_forum_icons` WRITE;
/*!40000 ALTER TABLE `be_forum_icons` DISABLE KEYS */;
INSERT INTO `be_forum_icons` VALUES (1,'icon-chat-bubble','icon-chat-bubble.png'),(2,'icon-code','icon-code.png'),(3,'icon-cog','icon-cog.png'),(4,'icon-cone','icon-cone.png'),(5,'icon-discussion-blue','icon-discussion-blue.png'),(6,'icon-discussion-grey','icon-discussion-grey.png'),(7,'icon-discussion-red','icon-discussion-red.png'),(8,'icon-folder','icon-folder.png'),(9,'icon-folder-blue','icon-folder-blue.png'),(10,'icon-folder-green','icon-folder-green.png'),(11,'icon-gold-note','icon-gold-note.png'),(12,'icon-home','icon-home.png'),(13,'icon-news','icon-news.png'),(14,'icon-note','icon-note.png'),(15,'icon-rss','icon-rss.png'),(16,'icon-star','icon-star.png');
/*!40000 ALTER TABLE `be_forum_icons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_forum_likes`
--

DROP TABLE IF EXISTS `be_forum_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_forum_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_forum_likes`
--

LOCK TABLES `be_forum_likes` WRITE;
/*!40000 ALTER TABLE `be_forum_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_forum_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_forum_threads`
--

DROP TABLE IF EXISTS `be_forum_threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_forum_threads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_created` int(11) DEFAULT '0',
  `category_id` int(11) DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL,
  `groups_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `edited` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`),
  FULLTEXT KEY `title_fulltext` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_forum_threads`
--

LOCK TABLES `be_forum_threads` WRITE;
/*!40000 ALTER TABLE `be_forum_threads` DISABLE KEYS */;
INSERT INTO `be_forum_threads` VALUES (1,'Test Post 1','Ius an ullum persius apeirian, has at libris interpretaris.Te tation option vim, ad duo quot iuvaret.Aperiri blandit honestatis vel ei, mel ex dicant intellegebat.Ad sint consetetur per.Et modo quando duo.Mei referrentur reprehendunt ea, mel ut possit graeco.','/files/be_demo/forum/images/user-5.jpg',1503385371,1,13,'Members','no'),(2,'Test Post 2','Ius an ullum persius apeirian, has at libris interpretaris.Te tation option vim, ad duo quot iuvaret.Aperiri blandit honestatis vel ei, mel ex dicant intellegebat.Ad sint consetetur per.Et modo quando duo.Mei referrentur reprehendunt ea, mel ut possit graeco.','/files/be_demo/forum/images/user-5.jpg',1503385372,2,13,'Members','no'),(3,'Test Post 3','Ius an ullum persius apeirian, has at libris interpretaris.Te tation option vim, ad duo quot iuvaret.Aperiri blandit honestatis vel ei, mel ex dicant intellegebat.Ad sint consetetur per.Et modo quando duo.Mei referrentur reprehendunt ea, mel ut possit graeco.','/files/be_demo/forum/images/user-5.jpg',1503385373,3,13,'Members','no');
/*!40000 ALTER TABLE `be_forum_threads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_forum_topics`
--

DROP TABLE IF EXISTS `be_forum_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_forum_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `area_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `groups_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_forum_topics`
--

LOCK TABLES `be_forum_topics` WRITE;
/*!40000 ALTER TABLE `be_forum_topics` DISABLE KEYS */;
INSERT INTO `be_forum_topics` VALUES (1,13,1,'Test forum 1','Ius an ullum persius apeirian, has at libris interpretaris.Te tation option vim, ad duo quot iuvaret.Aperiri blandit honestatis vel ei, mel ex dicant intellegebat.Ad sint consetetur per.Et modo quando duo.Mei referrentur reprehendunt ea, mel ut possit graeco.','/files/be_demo/forum/images/icon-star.png','Members',1503385372),(2,13,2,'Test forum 2','Ius an ullum persius apeirian, has at libris interpretaris.Te tation option vim, ad duo quot iuvaret.Aperiri blandit honestatis vel ei, mel ex dicant intellegebat.Ad sint consetetur per.Et modo quando duo.Mei referrentur reprehendunt ea, mel ut possit graeco.','/files/be_demo/forum/images/icon-code.png','Members',1503385372),(3,13,3,'Test forum 3','Ius an ullum persius apeirian, has at libris interpretaris.Te tation option vim, ad duo quot iuvaret.Aperiri blandit honestatis vel ei, mel ex dicant intellegebat.Ad sint consetetur per.Et modo quando duo.Mei referrentur reprehendunt ea, mel ut possit graeco.','/files/be_demo/forum/images/icon-news.png','Members',1503385372);
/*!40000 ALTER TABLE `be_forum_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_link_groups_users`
--

DROP TABLE IF EXISTS `be_link_groups_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_link_groups_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_link_groups_users`
--

LOCK TABLES `be_link_groups_users` WRITE;
/*!40000 ALTER TABLE `be_link_groups_users` DISABLE KEYS */;
INSERT INTO `be_link_groups_users` VALUES (1,13,2),(2,13,1),(3,13,4),(4,13,5),(5,13,6),(6,13,7);
/*!40000 ALTER TABLE `be_link_groups_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_link_permissions`
--

DROP TABLE IF EXISTS `be_link_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_link_permissions` (
  `link_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`link_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_link_permissions`
--

LOCK TABLES `be_link_permissions` WRITE;
/*!40000 ALTER TABLE `be_link_permissions` DISABLE KEYS */;
INSERT INTO `be_link_permissions` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(2,1),(2,2),(2,3),(2,4),(2,5),(2,6),(2,7),(3,1),(3,2),(3,3),(3,4),(3,5),(4,1),(4,2),(4,3),(4,4),(4,5),(5,1),(5,2),(5,3),(5,4),(5,5),(6,1),(6,2),(6,3),(6,4),(6,5),(7,1),(7,2),(7,3),(7,4),(7,5),(8,1),(8,2),(8,3),(8,4),(8,5),(9,1),(9,2),(9,3),(9,4),(9,5),(10,1),(10,2),(10,3),(10,4),(10,5),(11,1),(11,2),(11,3),(11,4),(11,5),(12,1),(12,2),(12,3),(12,4),(12,5),(13,1),(13,2),(13,3),(13,4),(13,5),(14,1),(14,2),(14,3),(14,4),(14,5),(15,1),(15,2),(15,3),(15,4),(15,5),(16,1),(16,2),(16,3),(16,4),(16,5),(17,1),(17,2),(17,3),(17,4),(17,5),(18,1),(18,2),(18,3),(18,4),(18,5),(19,1),(19,2),(19,3),(19,4),(19,5),(20,1),(20,2),(20,3),(20,4),(20,5);
/*!40000 ALTER TABLE `be_link_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_links`
--

DROP TABLE IF EXISTS `be_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `target` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `tags` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `parent` int(11) DEFAULT '0',
  `order` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_links`
--

LOCK TABLES `be_links` WRITE;
/*!40000 ALTER TABLE `be_links` DISABLE KEYS */;
INSERT INTO `be_links` VALUES (1,'Home','/','',NULL,0,1),(2,'Pages','#','',NULL,0,2),(3,'Blank Page','/page-example-page.html','',NULL,2,0),(4,'Content Blocks','/page-content-blocks.html','',NULL,2,2),(5,'Module Blocks','/page-module-blocks.html','',NULL,2,3),(6,'About','/page-about.html','',NULL,2,4),(7,'Contact','/page-contact.html','',NULL,2,5),(8,'Modules','#','',NULL,0,3),(9,'AudioPlayer','/audioplayer/all_audios','',NULL,8,0),(10,'Booking Events','/booking_events/events','',NULL,8,1),(11,'Booking Rooms','/booking_rooms/calendar','',NULL,8,2),(12,'Blog','/blog/all_posts','',NULL,8,4),(13,'Classifieds','/classifieds/view_category/All','',NULL,8,5),(14,'Forum','/forum/all_topics','',NULL,8,6),(15,'Online Store','/ecommerce/category/All','',NULL,8,7),(16,'Photo Gallery','/photogallery/all_photos','',NULL,8,8),(17,'VideoTube','/videotube/all_videos','',NULL,8,9),(18,'Admin CP','/admin','',NULL,0,4),(19,'Account CP','/cp/dashboard','',NULL,0,5),(20,'Booking Memberships','/booking_memberships/memberships','',NULL,8,3);
/*!40000 ALTER TABLE `be_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_module_permissions`
--

DROP TABLE IF EXISTS `be_module_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_module_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `access` enum('frontend','backend') COLLATE utf8mb4_unicode_ci DEFAULT 'frontend',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_module_permissions`
--

LOCK TABLES `be_module_permissions` WRITE;
/*!40000 ALTER TABLE `be_module_permissions` DISABLE KEYS */;
INSERT INTO `be_module_permissions` VALUES (1,1,2,'frontend'),(2,1,3,'frontend'),(3,1,1,'backend'),(4,2,2,'frontend'),(5,2,3,'frontend'),(6,2,1,'backend'),(7,3,2,'frontend'),(8,3,3,'frontend'),(9,3,1,'backend'),(10,4,2,'frontend'),(11,4,3,'frontend'),(12,4,1,'backend'),(13,5,2,'frontend'),(14,5,3,'frontend'),(15,5,1,'backend'),(16,6,2,'frontend'),(17,6,3,'frontend'),(18,6,1,'backend'),(19,7,2,'frontend'),(20,7,3,'frontend'),(21,7,1,'backend'),(22,8,2,'frontend'),(23,8,3,'frontend'),(24,8,1,'backend'),(25,9,2,'frontend'),(26,9,3,'frontend'),(27,9,1,'backend'),(28,10,2,'frontend'),(29,10,3,'frontend'),(30,10,1,'backend'),(31,11,2,'frontend'),(32,11,3,'frontend'),(33,11,1,'backend'),(34,12,2,'frontend'),(35,12,3,'frontend'),(36,12,1,'backend'),(37,13,2,'frontend'),(38,13,3,'frontend'),(39,13,1,'backend');
/*!40000 ALTER TABLE `be_module_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_modules`
--

DROP TABLE IF EXISTS `be_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installer_id` int(11) DEFAULT NULL,
  `install_time` int(11) DEFAULT NULL,
  `active` enum('true','false') COLLATE utf8mb4_unicode_ci DEFAULT 'true',
  `installed` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `market_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_modules`
--

LOCK TABLES `be_modules` WRITE;
/*!40000 ALTER TABLE `be_modules` DISABLE KEYS */;
INSERT INTO `be_modules` VALUES (1,'Page','page','1.0.0',0,1394228161,'true','yes',0),(2,'Blog','blog','1.0.0',0,1394228780,'true','yes',0),(3,'BuilderPayment','builderpayment','1.0.0',0,1394228780,'true','yes',0),(4,'Online Store','ecommerce','1.0.0',0,1394228780,'true','yes',0),(5,'Booking Events','booking_events','1.0.0',0,1394228780,'true','yes',0),(6,'Classifieds','classifieds','1.0.0',0,1394228780,'true','yes',0),(7,'Forum','forum','1.0.0.',0,1394228780,'true','yes',0),(8,'VideoTube','videotube','1.0.0',0,1394228161,'true','yes',0),(9,'Photo Gallery','photogallery','1.0.0',0,1394228161,'true','yes',0),(10,'Audio Player','audioplayer','1.0.0',0,1394228161,'true','yes',0),(11,'Booking Rooms','booking_rooms','1.0.0',0,1394228161,'true','yes',0),(12,'Account Dashboard','cp','1.0.0',0,1394228161,'true','yes',0),(13,'Booking Memberships','booking_memberships','1.0.0',0,1394228161,'true','yes',0);
/*!40000 ALTER TABLE `be_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_options`
--

DROP TABLE IF EXISTS `be_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `option_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=216 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_options`
--

LOCK TABLES `be_options` WRITE;
/*!40000 ALTER TABLE `be_options` DISABLE KEYS */;
INSERT INTO `be_options` VALUES (1,'active_frontend_theme','default_theme'),(2,'active_backend_theme','dashboard'),(3,'version','1.0.7'),(4,'active_user_backend_theme','user_dashboard'),(5,'default_registration_group','Members'),(6,'login_title','Account Login'),(7,'register_title','Register Account'),(8,'sign_up_verification','admin'),(9,'register_email','<h2>Registration completed</h2><br>You have new account on '),(10,'verification_email','<h2>Verification completed</h2><br>You account has already been on '),(11,'welcome_email','<h2>Welcome</h2><br>We are happy to see you on '),(12,'email_address','noreply@mysite.com'),(13,'user_dashboard_activ','yes'),(14,'notify_admin_registered_user','no'),(15,'be_blog_access_groups','Members'),(16,'default_website_access_group','Administrators,Members,Guests'),(17,'user_account_deletion','no'),(18,'goodbye_email','<h2>Goodbye</h2><br>Thank you for using our service '),(19,'be_ecommerce_payment_methods','Cash on Delivery'),(20,'be_ecommerce_settings_currency','3'),(21,'be_ecommerce_settings_log_in_info','<p>Welcome to the Store Login Page</p>\r\n'),(22,'be_ecommerce_settings_register_info','<p>Welcome to the Store Registration Page</p>\r\n'),(23,'be_ecommerce_display_views','yes'),(24,'be_ecommerce_settings_shipping_options','all'),(25,'be_ecommerce_settings_url','www.company.dom/terms.html'),(26,'be_ecommerce_shop_groups','Administrators,Members,Guests'),(27,'be_ecommerce_reviews_groups','Administrators,Members'),(28,'be_ecommerce_access_groups','Administrators,Members,Guests'),(29,'be_default_currency','1'),(30,'be_ecommerce_company_name','Company Ltd'),(31,'be_ecommerce_company_address','1234 Main Street'),(32,'be_ecommerce_company_zip','54382'),(33,'be_ecommerce_company_city','Dublin'),(34,'be_ecommerce_company_country','Ireland'),(35,'be_ecommerce_company_phone','123-456 7890'),(36,'be_ecommerce_company_email','company@company.dom'),(37,'be_ecommerce_company_tax_vat_number','ABCD-01234-EFGH'),(38,'be_ecommerce_company_bank_account_number','123-234-345'),(39,'be_ecommerce_company_payment_option','10 days'),(40,'be_ecommerce_company_logo','/files/be_demo/ecommerce/company/company-logo.jpg'),(41,'be_booking_events_shop_groups','Administrators,Members,Guests'),(42,'be_booking_events_access_groups','Members'),(43,'be_booking_events_add_event_groups','Administrators'),(44,'be_booking_events_add_service_groups','Administrators'),(45,'be_booking_events_default_currency','1'),(46,'be_booking_events_payment_methods','Cash on Delivery'),(47,'be_booking_events_company_name','Company Ltd'),(48,'be_booking_events_company_address','1234 Main Street'),(49,'be_booking_events_company_city','Dublin'),(50,'be_booking_events_company_country','Ireland'),(51,'be_booking_events_company_zip','45543'),(52,'be_booking_events_company_phone','123-456 7890'),(53,'be_booking_events_company_email','company@company.dom'),(54,'be_booking_events_company_tax_vat_number','ABCD-01234-EFGH'),(55,'be_booking_events_company_bank_account_number','1234-567-789'),(56,'be_booking_events_company_payment_option','30 Days'),(57,'be_booking_events_company_logo','/files/be_demo/ecommerce/company/company-logo.jpg'),(58,'be_booking_events_settings_url','www.company.dom/terms.html'),(59,'be_classifieds_shop_groups','Administrators,Members'),(60,'be_classifieds_access_groups','Members'),(61,'be_classifieds_create_ads_groups','Administrators,Members'),(62,'be_classifieds_add_service_groups','Administrators'),(63,'be_classifieds_default_currency','1'),(64,'be_classifieds_payment_methods','Cash on Delivery'),(65,'be_classifieds_products_per_page','9'),(66,'be_classifieds_admin_email','admin@admin.com'),(67,'be_classifieds_company_name','Company Ltd'),(68,'be_classifieds_company_address','1234 Main Street'),(69,'be_classifieds_company_city','Dublin'),(70,'be_classifieds_company_country','Ireland'),(71,'be_classifieds_company_zip','45543'),(72,'be_classifieds_company_phone','123-456 7890'),(73,'be_classifieds_company_email','company@company.dom'),(74,'be_classifieds_company_tax_vat_number','ABCD-01234-EFGH'),(75,'be_classifieds_company_bank_account_number','1234-567-789'),(76,'be_classifieds_company_payment_option','30 Days'),(77,'be_classifieds_company_logo','/files/be_demo/ecommerce/company/company-logo.jpg'),(78,'be_classifieds_settings_url','www.company.dom/terms.html'),(79,'user_login_option','both'),(80,'force_https','off'),(81,'forum_terms','http://link-to-your-term-page'),(82,'forum_active','yes'),(83,'forum_visibility','public'),(84,'forum_access_groups','Members'),(85,'forum_num_posts_displayed','5'),(86,'forum_num_categories_displayed','10'),(87,'forum_num_recent_posts_displayed','3'),(88,'forum_thread_image','avatar'),(89,'forum_thread_admin_image','/builderengine/public/img/avatar.png'),(90,'forum_register_info','<h4>Register with our Forum</h4><p>By creating an account with our Forum, you will be able to discuss, share, post and more.</p><br />'),(91,'forum_login_info','<h4>Register Today</h4><p>By creating an account with our Forum, you will be able to discuss, share, post and more.</p><br />'),(92,'booking_events_permission','yes'),(93,'photogallery_show_tags','yes'),(94,'photogallery_num_tags_displayed','5'),(95,'photogallery_terms','http://path-to-your-term-page'),(96,'photogallery_medias_per_page','10'),(97,'photogallery_option','open'),(98,'photogallery_allow_ratings','yes'),(99,'photogallery_allow_comments','yes'),(100,'photogallery_comments_private','public'),(101,'photogallery_num_recent_medias_displayed','5'),(102,'photogallery_num_medias_displayed','10'),(103,'photogallery_access_groups','Members'),(104,'photogallery_register_info','<h4>Register Your Account</h4><p>By creating an account with us, you will be able to upload, share, post and more.</p><br />'),(105,'photogallery_login_info','<h4>Register Today</h4><p>By creating an account with us, you will be able to upload, share, post and more.</p><br />'),(106,'audioplayer_show_tags','yes'),(107,'audioplayer_num_tags_displayed','5'),(108,'audioplayer_terms','http://path-to-your-term-page'),(109,'audioplayer_medias_per_page','10'),(110,'audioplayer_option','open'),(111,'audioplayer_allow_ratings','yes'),(112,'audioplayer_allow_comments','yes'),(113,'audioplayer_comments_private','public'),(114,'audioplayer_num_recent_medias_displayed','5'),(115,'audioplayer_num_medias_displayed','10'),(116,'audioplayer_access_groups','Members'),(117,'audioplayer_register_info','<h4>Register Your Account</h4><p>By creating an account with us, you will be able to upload, share, post and more.</p><br />'),(118,'audioplayer_login_info','<h4>Register Today</h4><p>By creating an account with us, you will be able to upload, share, post and more.</p><br />'),(119,'videotube_show_tags','yes'),(120,'videotube_num_tags_displayed','5'),(121,'videotube_terms','http://path-to-your-term-page'),(122,'videotube_medias_per_page','10'),(123,'videotube_option','open'),(124,'videotube_allow_ratings','yes'),(125,'videotube_allow_comments','yes'),(126,'videotube_comments_private','public'),(127,'videotube_num_recent_medias_displayed','5'),(128,'videotube_num_medias_displayed','10'),(129,'videotube_access_groups','Members'),(130,'videotube_register_info','<h4>Register Your Account</h4><p>By creating an account with us, you will be able to upload, share, post and more.</p><br />'),(131,'videotube_login_info','<h4>Register Today</h4><p>By creating an account with us, you will be able to upload, share, post and more.</p><br />'),(132,'user_dashboard_file_manager','yes'),(133,'be_classifieds_admin_ad_approval','no'),(134,'blog_active','yes'),(135,'booking_events_active','yes'),(136,'audioplayer_active','yes'),(137,'videotube_active','yes'),(138,'photogallery_active','yes'),(139,'classifieds_active','yes'),(140,'ecommerce_active','yes'),(141,'user_dashboard_blog','no'),(142,'user_dashboard_ecommerce','no'),(143,'user_dashboard_forum','no'),(144,'user_dashboard_booking_events','no'),(145,'user_dashboard_classifieds','no'),(146,'user_dashboard_videotube','no'),(147,'user_dashboard_photogallery','no'),(148,'user_dashboard_audioplayer','no'),(149,'be_classifieds_buy_now','no'),(150,'be_booking_rooms_shop_groups','Administrators,Members'),(151,'be_booking_rooms_access_groups','Members'),(152,'be_booking_rooms_add_room_groups','Administrators,Members'),(153,'be_booking_rooms_add_service_groups','Administrators'),(154,'be_booking_rooms_default_currency','1'),(155,'be_booking_rooms_payment_methods','Cash on Delivery'),(156,'be_booking_rooms_company_name','Company Ltd'),(157,'be_booking_rooms_company_address','1234 Main Street'),(158,'be_booking_rooms_company_city','Dublin'),(159,'be_booking_rooms_company_country','Ireland'),(160,'be_booking_rooms_company_zip','45543'),(161,'be_booking_rooms_company_phone','123-456 7890'),(162,'be_booking_rooms_company_email','company@company.dom'),(163,'be_booking_rooms_company_tax_vat_number','ABCD-01234-EFGH'),(164,'be_booking_rooms_company_bank_account_number','1234-567-789'),(165,'be_booking_rooms_company_payment_option','30 Days'),(166,'be_booking_rooms_company_logo','/files/be_demo/ecommerce/company/company-logo.jpg'),(167,'be_booking_rooms_settings_url','www.company.dom/terms.html'),(168,'booking_rooms_permission','no'),(169,'booking_rooms_active','yes'),(170,'user_dashboard_booking_rooms','no'),(171,'admin_dashboard_selection','default'),(172,'login_count_attempts','yes'),(173,'login_max_attempts','15'),(174,'login_attempt_expire','86400'),(175,'notify_admin_about_banned_user','yes'),(176,'login_description','Please login to access your account.'),(177,'register_description','Sign up for your new membership account.'),(178,'be_booking_memberships_shop_groups','Administrators,Members,Guests'),(179,'be_booking_memberships_access_groups','Members'),(180,'be_booking_memberships_add_membership_groups','Administrators'),(181,'be_booking_memberships_default_currency','1'),(182,'be_booking_memberships_payment_methods','Cash on Delivery'),(183,'be_booking_memberships_company_name','Company Ltd'),(184,'be_booking_memberships_company_address','1234 Main Street'),(185,'be_booking_memberships_company_city','Dublin'),(186,'be_booking_memberships_company_country','Ireland'),(187,'be_booking_memberships_company_zip','45543'),(188,'be_booking_memberships_company_phone','123-456 7890'),(189,'be_booking_memberships_company_email','company@company.dom'),(190,'be_booking_memberships_company_tax_vat_number','ABCD-01234-EFGH'),(191,'be_booking_memberships_company_bank_account_number','1234-567-789'),(192,'be_booking_memberships_company_payment_option','30 Days'),(193,'be_booking_memberships_company_logo','/files/be_demo/ecommerce/company/company-logo.jpg'),(194,'be_booking_memberships_settings_url','www.company.dom/terms.html'),(195,'booking_memberships_permission','no'),(196,'booking_memberships_active','yes'),(197,'user_dashboard_booking_memberships','no'),(198,'be_booking_memberships_approval_email','<p>Congratulations,Your Application has been approved !</p>'),(199,'be_booking_memberships_rejected_email','<p>We regret to inform you that your Application has been rejected.</p>'),(200,'be_blog_allow_comments','yes'),(201,'be_blog_comments_private','private'),(202,'be_blog_captcha','no'),(203,'be_blog_show_tags','yes'),(204,'be_blog_num_tags_displayed','0'),(205,'be_blog_num_recent_posts_displayed','0'),(206,'be_blog_num_posts_displayed',''),(207,'google_maps_api_key','AIzaSyAyoLgzKTuHntTdtYN1vnA68ZvSfANoWJc'),(208,'admin_theme_color_pattern','default'),(209,'admin_left_sidebar_minimized','off'),(210,'account_pages_section_name','Account Pages'),(211,'extra_registration_active','no'),(212,'extra_registration_usergroups',''),(213,'website_name','demoSite'),(214,'website_title','demoSite'),(215,'adminemail','prachee.ye@gmail.com');
/*!40000 ALTER TABLE `be_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_page_versions`
--

DROP TABLE IF EXISTS `be_page_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_page_versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `approver` int(11) NOT NULL DEFAULT '-1',
  `name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `status` enum('pending','submitted') CHARACTER SET utf8mb4 DEFAULT 'pending',
  `active` enum('yes','no') CHARACTER SET utf8mb4 DEFAULT 'no',
  `time_created` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `path_active` (`path`(191),`active`),
  KEY `path_status` (`path`(191),`status`),
  KEY `path` (`path`(191))
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_page_versions`
--

LOCK TABLES `be_page_versions` WRITE;
/*!40000 ALTER TABLE `be_page_versions` DISABLE KEYS */;
INSERT INTO `be_page_versions` VALUES (1,'layout',0,0,'Initial Version','submitted','yes',1549901249),(2,'themes/dashboard/assets/css/style-responsive.min.css',0,0,'Initial Version','submitted','yes',1549901250);
/*!40000 ALTER TABLE `be_page_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_pages`
--

DROP TABLE IF EXISTS `be_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `groups` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('default','cp') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `meta_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_index` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_follow` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_snippet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_archive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_img_index` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_odp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`(191))
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_pages`
--

LOCK TABLES `be_pages` WRITE;
/*!40000 ALTER TABLE `be_pages` DISABLE KEYS */;
INSERT INTO `be_pages` VALUES (11,'Example Page','blank.tpl',1426204004,13,'example-page','Guests,Members,Administrators','default','','','noindex,','nofollow,','','','',''),(100,'Content Blocks','contentblocks.tpl',1426204004,13,'content-blocks','Guests,Members,Administrators','default','','','noindex,','nofollow,','','','',''),(101,'Module Blocks','xblocks.tpl',1426204004,13,'module-blocks','Guests,Members,Administrators','default','','','noindex,','nofollow,','','','',''),(103,'About','about.tpl',1426204004,13,'about','Guests,Members,Administrators','default','','','noindex,','nofollow,','','','',''),(104,'Contact','contact.tpl',1426204004,13,'contact','Guests,Members,Administrators','default','','','noindex,','nofollow,','','','','');
/*!40000 ALTER TABLE `be_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_photo_gallery_albums`
--

DROP TABLE IF EXISTS `be_photo_gallery_albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_photo_gallery_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `groups_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `status` enum('public','private') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_photo_gallery_albums`
--

LOCK TABLES `be_photo_gallery_albums` WRITE;
/*!40000 ALTER TABLE `be_photo_gallery_albums` DISABLE KEYS */;
INSERT INTO `be_photo_gallery_albums` VALUES (1,0,13,'Photo_Album 1','/files/be_demo/photogallery/images/photo_placeholder.png','Members','public'),(2,0,13,'Photo_Album 2','/files/be_demo/photogallery/images/photo_placeholder.png','Members','public'),(3,0,13,'Photo_Album 3','/files/be_demo/photogallery/images/photo_placeholder.png','Members','public'),(4,0,13,'Photo_Album 4','/files/be_demo/photogallery/images/photo_placeholder.png','Members','public'),(5,0,13,'Photo_Album 5','/files/be_demo/photogallery/images/photo_placeholder.png','Members','public'),(6,0,13,'Photo_Album 6','/files/be_demo/photogallery/images/photo_placeholder.png','Members','public');
/*!40000 ALTER TABLE `be_photo_gallery_albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_photo_gallery_comment_reports`
--

DROP TABLE IF EXISTS `be_photo_gallery_comment_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_photo_gallery_comment_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) DEFAULT '0',
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_of_creation` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_photo_gallery_comment_reports`
--

LOCK TABLES `be_photo_gallery_comment_reports` WRITE;
/*!40000 ALTER TABLE `be_photo_gallery_comment_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_photo_gallery_comment_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_photo_gallery_comments`
--

DROP TABLE IF EXISTS `be_photo_gallery_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_photo_gallery_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) DEFAULT NULL,
  `channel_owner_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `time_created` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_photo_gallery_comments`
--

LOCK TABLES `be_photo_gallery_comments` WRITE;
/*!40000 ALTER TABLE `be_photo_gallery_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_photo_gallery_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_photo_gallery_follows`
--

DROP TABLE IF EXISTS `be_photo_gallery_follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_photo_gallery_follows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `follower_id` int(11) DEFAULT NULL,
  `following_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_photo_gallery_follows`
--

LOCK TABLES `be_photo_gallery_follows` WRITE;
/*!40000 ALTER TABLE `be_photo_gallery_follows` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_photo_gallery_follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_photo_gallery_likes`
--

DROP TABLE IF EXISTS `be_photo_gallery_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_photo_gallery_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_photo_gallery_likes`
--

LOCK TABLES `be_photo_gallery_likes` WRITE;
/*!40000 ALTER TABLE `be_photo_gallery_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_photo_gallery_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_photo_gallery_medias`
--

DROP TABLE IF EXISTS `be_photo_gallery_medias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_photo_gallery_medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `album_id` int(11) DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL,
  `comments_allowed` enum('yes','no','hide') COLLATE utf8mb4_unicode_ci DEFAULT 'yes',
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_created` int(11) DEFAULT '0',
  `groups_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `status` enum('public','private') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `featured` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  PRIMARY KEY (`id`),
  FULLTEXT KEY `title_fulltext` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_photo_gallery_medias`
--

LOCK TABLES `be_photo_gallery_medias` WRITE;
/*!40000 ALTER TABLE `be_photo_gallery_medias` DISABLE KEYS */;
INSERT INTO `be_photo_gallery_medias` VALUES (1,'Abstract_Wall','Modern art = I could do that + Yeah, but you didn’t. - Craig Damraeur','/files/be_demo/photogallery/images/Abstract Wall.jpg',1,13,'yes','Art, Modern Art, Color, Wall ',1503731796,'Members','public','no'),(2,'Artist_Street_Stall','Everything you can imagine is real - Pablo Picasso','/files/be_demo/photogallery/images/Artist Street Stall.jpg',2,13,'yes','Street, Market, Vendor, Stall, Man, Cobblestones, Paintings, Drawings, Color',1503731796,'Members','public','yes'),(3,'Sparkles','Life is a blank canvas and you need to throw all the paint on it you can. - Danny Kaye','/files/be_demo/photogallery/images/Sparkles.jpg',3,13,'yes','Blonde, Girl, Sparklers, Woods, Laughing',1503731796,'Members','public','no'),(4,'Blue_Shades','The sides of buildings should be like the top of lakes. I would fish through your window hoping to catch a smile. - Jarod Kintz','/files/be_demo/photogallery/images/Blue Shades.jpg',4,13,'yes','Sunglasses, Shades, Blue, Street',1503731796,'Members','public','no'),(5,'Laughing','You only live once, but if you do it right, once is enough - Mae West','/files/be_demo/photogallery/images/Laughing.jpg',5,13,'yes','Tag,Flower,Oldeander,Second,Photo,Gallery,Photo 2',1503731796,'Members','public','no'),(6,'Colorful_Pier','Light must always win.	- Maurice Smith','/files/be_demo/photogallery/images/Colorful Pier.jpg',6,13,'yes','Color, Pier, Sea, Sunset',1503731796,'Members','public','no'),(7,'Far_Horizon','Though we travel the world over to find the beautiful, we must carry it with us, or we find it not. - Ralph Waldo Emerson','/files/be_demo/photogallery/images/Far Horizon.jpg',1,13,'yes','Man, Lake, Mountains, Nature, Sky',1503731796,'Members','public','no'),(8,'Golden_Light','Art is not what you see, but what you make others see	- Edgar Degas','/files/be_demo/photogallery/images/Golden Light.jpg',2,13,'yes','Light, Interior, Sky, Golden, Architecture, Color',1503731796,'Members','public','no'),(9,'Guy_in_Jeep','I travel not to go anywhere, but to go. I travel for travels sake. The great affair is to move - Robert Louis Stevenson','/files/be_demo/photogallery/images/Guy in Jeep.jpg',3,13,'yes','Guy, Beard, Sunglasses, Jeep, Travel, Desert',1503731796,'Members','public','no'),(10,'Hot_Silhouette','You do not take a photograph, you make it - Ansel Adams','/files/be_demo/photogallery/images/Hot Silhouette.jpg',4,13,'yes','Hot, Fire, Shadow, Silhouette, Man',1503731796,'Members','public','no'),(11,'Kiss_Me','Speak softly, but carry a big can of paint - Banksy','/files/be_demo/photogallery/images/Kiss Me.jpg',5,13,'yes','Graffiti, Mural, Street, Color, Kiss, Couple, Man, Woman, Sailor,',1503731796,'Members','public','no'),(12,'Red_Heart','You know you are in love when you cannot fall asleep because reality is finally better than your dreams. - Dr. Seuss','/files/be_demo/photogallery/images/Red Heart.jpg',6,13,'yes','Heart, Red, Crayon, Paper, Table, Love',1503731796,'Members','public','no'),(13,'Red_House','I live in my own little world. But its ok, they know me here - Lauren Myracle','/files/be_demo/photogallery/images/Red House.jpg',1,13,'yes','Red, House, Street, Bicycle, Door',1503731796,'Members','public','no'),(14,'Starry_Night','Imagination will often carry us to worlds that never were. But without it we go nowhere. - Carl Sagan','/files/be_demo/photogallery/images/Starry Night.jpg',1,13,'yes','Stars, Man, Color, Cosmos, Nature',1503731796,'Members','public','no'),(15,'Winding_Road','The journey of a thousand miles begins with a single step - Lao Tzu','/files/be_demo/photogallery/images/Winding Road.jpg',1,13,'yes','Road, Desert, Red, Winding, Sky',1503731796,'Members','public','no');
/*!40000 ALTER TABLE `be_photo_gallery_medias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_photo_gallery_photo_reports`
--

DROP TABLE IF EXISTS `be_photo_gallery_photo_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_photo_gallery_photo_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) DEFAULT '0',
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_of_creation` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_photo_gallery_photo_reports`
--

LOCK TABLES `be_photo_gallery_photo_reports` WRITE;
/*!40000 ALTER TABLE `be_photo_gallery_photo_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_photo_gallery_photo_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_photo_gallery_ratings`
--

DROP TABLE IF EXISTS `be_photo_gallery_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_photo_gallery_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_photo_gallery_ratings`
--

LOCK TABLES `be_photo_gallery_ratings` WRITE;
/*!40000 ALTER TABLE `be_photo_gallery_ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_photo_gallery_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_photo_gallery_user_settings`
--

DROP TABLE IF EXISTS `be_photo_gallery_user_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_photo_gallery_user_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `background_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `channel_comments` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_photo_gallery_user_settings`
--

LOCK TABLES `be_photo_gallery_user_settings` WRITE;
/*!40000 ALTER TABLE `be_photo_gallery_user_settings` DISABLE KEYS */;
INSERT INTO `be_photo_gallery_user_settings` VALUES (1,13,'Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod. 	Eum et doctus delicatissimi, sea te dicant fuisset pertinax. At debet oblique omnesque ius.	Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.','/files/be_demo/photogallery/images/reserved.png','yes','yes');
/*!40000 ALTER TABLE `be_photo_gallery_user_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_products`
--

DROP TABLE IF EXISTS `be_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `remote_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_products`
--

LOCK TABLES `be_products` WRITE;
/*!40000 ALTER TABLE `be_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_social_links`
--

DROP TABLE IF EXISTS `be_social_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_social_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_social_links`
--

LOCK TABLES `be_social_links` WRITE;
/*!40000 ALTER TABLE `be_social_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_social_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_tutorial_steps`
--

DROP TABLE IF EXISTS `be_tutorial_steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_tutorial_steps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tutorial_id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `position_type` enum('absolute','element','window_border') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `highlighter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_tutorial_steps`
--

LOCK TABLES `be_tutorial_steps` WRITE;
/*!40000 ALTER TABLE `be_tutorial_steps` DISABLE KEYS */;
INSERT INTO `be_tutorial_steps` VALUES (1,1,'Hello and welcome to BuilderEngine. This is our frontend editor. To get started click on \"Designer\".','window_border','top-left',''),(2,1,'Now that the page is broken down into it\'s components (don\'t worry it looks like this to you only) it\'s time to learn to modify it. All elements have a dark-blue top part where their type is written. Some are \"Row\" others \"Column\" etc.','window_border','left-center',''),(3,1,'Pick any row or column element and hold the right mouse button on it\'s top dark-blue part to see a settings wheel pop-open. It will only stay open for as long as you hold the right mouse button.','window_border','bottom-left',''),(4,1,'Now that you know how to open the settings wheel, open it on any row or column you like and try and select the \"Add block\" option by letting go of the right-mouse button you\'r holding while it\'s on top of the \"Add block\" button.','window_border','top-left',''),(5,1,'A sidebar with possible blocks to add has appeared on the right. It\'s time to add a block. Click on \"generic block\" and one will appear inside the element you right-clicked on. You have just added your first block. ','window_border','left-center',''),(6,1,'Being a generic block you can write any text or even add images in it. To do so just click on the \"Your new block\" text inside the generic block and an editor will appear allowing you to write down any stylized text you like.','window_border','bottom-left',''),(7,1,'You now know the basics of adding a block to your website. Feel free to add a different type of block to your element next just so to see what you can do. Try any row or column element you like. Click next for an example.','window_border','top-left',''),(8,1,'Add a column to a row (you can find columns in the add-block sidebar in Page System->Add Column->Simple Width Size) with a size of \"Half\". After that add another with the same size in the same row.','window_border','left-center',NULL),(9,1,'Go inside the first column you created and add a generic block into it and write down \"This is my left column\". After that do the same with the second column you added but write \"And this is my right column\". ','window_border','bottom-left',NULL),(10,1,'Your simplistic structure is now done. Try it next with other more exciting blocks like the Bootstrap or Content ones. If you have questions feel free to contact us for help. Have a nice time creating your website!','window_border','top-center',NULL),(11,2,'Welcome to your website\'s dashboard. This is the administration part of the website that only you, the admin can see. It is also known as the \"backend\" of your website.','window_border','top-center',''),(12,2,'This is the information hub of your website. Here you can see how many users visited your website today, from which country they hail or how many accounts exists. You can even see the revenue of your online store module.','window_border','top-right',''),(13,2,'The Dashboard is also the place where you can access all the information needed to manage your website. Let\'s go through a couple of links. Clicking on them will cancel this tutorial so do read up a bit first before continuing.','window_border','right-center',''),(14,2,'To change the links that appear on your website\'s navbar see the Navbar Menu Links on the sidebar to the left. There you can both add new ones or edit and see the ones you already have.','window_border','bottom-right',''),(15,2,'To select another active theme on your website click on templates in that same sidebar to the left. There you can switch the active template with ease. To further manage or download new ones do visit your builderengine cloud account.','window_border','top-right',''),(16,2,'On the bottom on the sidebar you can see the Modules/Apps Panel. The basic ones you have access to are the Blog and the Online Store. Those have many options of their own this tutorial cannot effectively cover.','window_border','right-center',''),(17,2,'Using the blog module you can create and use a blog of your own in your builderengine website. The online store module makes you able to create your own online shop through which you can make your own revenue.','window_border','bottom-right',''),(18,2,'Revenue made with the online store module is 100% yours. BuilderEngine takes no cut out of it. Feel free to explore our modules because soon we will add even more new ones you will have access to if you wish.','window_border','top-center',''),(19,3,'Here to add a product to your online shop? The Online Store module\'s capabilities go far beyond your standart online shop so let\'s learn how to utilize them to their full potential.','window_border','top-center',''),(20,3,'The first field you need to know about is \"Quantity\". The value you input here reflects the number of items of that type you want to sell. When the users buy the quantity will reflect that by substracting it from this number.','absolute','300,1350',''),(21,3,'When the quantity of the sold items reaches the quantity you have inputted the product will start displaying an \"out of stock\" message. You can change the quantity at any time using the edit option when viewing all products.','absolute','300,1350',''),(22,3,'All products need an image but the online store gives you the option to add not one or two but an unlimited number of images that will be shown in the online store\'s product page carousel.','window_border','right-center',''),(23,3,'The main image is the one the users will see while browsing through all products and also the first one they will see after landing on the page of that specific product.','window_border','right-center',''),(24,3,'The additional images interface can be used to add an unlimited number of extra pictures. Just click \"add additional image\" \r\nand then \"browse\" on the newly created segment.','window_border','right-center',''),(25,3,'An first unique option of the online store is the \"add another field\" interface. Just click on it and you will be presented will two new fields: \"field name\" and \"field value\".','window_border','top-right',''),(26,3,'Here is an example of those two being used. If we write \"Transmission\" as field name and \"Automatic\" as field value your product will now display it has an automatic transmission as part of it\'s description.','window_border','top-right',''),(27,3,'Another example would be adding a field name of \"fabric\" and value of \"cotton\". This way you can create a page for anything from cars and technology to clothes and gift baskets. You can add however many fields you like.','window_border','top-right',''),(28,3,'The second unique option of the online store is the \"add a new option\" interface. By clicking on you can add a new option for users to choose from when buying your product.','window_border','right-center',''),(29,3,'Each option has it\'s name and options. An example would be adding an option named \"color\" and then options to it like \"black\", \"red\", \"silver\". You can add however many of these you like to any product you wish.','window_border','right-bottom',''),(30,3,'Options can also have an effect on the price. For an example the black version might cost 20 currency more. You can also lower the price by inputting -20. This way product price may vary depending on the option the user has chosen.','window_border','right-bottom',''),(31,3,'With these clarifications you should have a good basic understanding of the Online Store module. If you have any questions be sure to contact us. Have fun managing your own online business!','window_border','top-center','');
/*!40000 ALTER TABLE `be_tutorial_steps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_tutorials`
--

DROP TABLE IF EXISTS `be_tutorials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_tutorials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel` enum('yes','no','confirm') COLLATE utf8mb4_unicode_ci DEFAULT 'yes',
  `display` enum('always','first_load','discreet_notification','important_notification','hidden') COLLATE utf8mb4_unicode_ci DEFAULT 'always',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_tutorials`
--

LOCK TABLES `be_tutorials` WRITE;
/*!40000 ALTER TABLE `be_tutorials` DISABLE KEYS */;
INSERT INTO `be_tutorials` VALUES (1,'Frontend Editor Introduction','confirm','first_load','/?iframed=true');
/*!40000 ALTER TABLE `be_tutorials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_user_groups`
--

DROP TABLE IF EXISTS `be_user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `allow_posts` int(2) DEFAULT NULL,
  `allow_categories` int(2) DEFAULT NULL,
  `use_created_categories` int(1) DEFAULT '0',
  `default_user_post_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_user_groups`
--

LOCK TABLES `be_user_groups` WRITE;
/*!40000 ALTER TABLE `be_user_groups` DISABLE KEYS */;
INSERT INTO `be_user_groups` VALUES (1,'Administrators','Usergroup for all website administrators and complete control over everything.',1,1,0,''),(2,'Members','Usergroup for logged in members, update the permissions of this usergroup for access to pages & modules of your website.',0,0,0,''),(3,'Guests','Usergroup for non-logged in users. This usergroup controls what the public visitors can view or not on your website.',0,0,0,''),(4,'Frontend Editor','Members of this usergroup can edit frontend pages but can not publish them.',0,0,0,''),(5,'Frontend Manager','Members of this usergroup can approve edits by the Frontend Editor, publish pages and control versions.',0,0,0,''),(6,'Basic Member','Usergroup for registered basic members.',0,0,0,''),(7,'Premium Member','Usergroup for registered premium members.',0,0,0,'');
/*!40000 ALTER TABLE `be_user_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_user_login_attempts`
--

DROP TABLE IF EXISTS `be_user_login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_user_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_user_login_attempts`
--

LOCK TABLES `be_user_login_attempts` WRITE;
/*!40000 ALTER TABLE `be_user_login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_user_login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_user_settings`
--

DROP TABLE IF EXISTS `be_user_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_user_settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `allow_avatar` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_user_settings`
--

LOCK TABLES `be_user_settings` WRITE;
/*!40000 ALTER TABLE `be_user_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_user_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_user_subscriptions`
--

DROP TABLE IF EXISTS `be_user_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_user_subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_data` longblob,
  `type` enum('recurring','onetime') COLLATE utf8mb4_unicode_ci DEFAULT 'onetime',
  `status` enum('active','pending','expired','terminated','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `time_created` int(11) DEFAULT NULL,
  `expiry_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_user_subscriptions`
--

LOCK TABLES `be_user_subscriptions` WRITE;
/*!40000 ALTER TABLE `be_user_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_user_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_users`
--

DROP TABLE IF EXISTS `be_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_registered` int(11) DEFAULT NULL,
  `level` enum('Member','Administrator') COLLATE utf8mb4_unicode_ci DEFAULT 'Member',
  `last_activity` int(11) DEFAULT '0',
  `pass_reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `verified` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `cache_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  FULLTEXT KEY `user_search_fulltext` (`username`,`first_name`,`email`),
  FULLTEXT KEY `username_fulltext` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_users`
--

LOCK TABLES `be_users` WRITE;
/*!40000 ALTER TABLE `be_users` DISABLE KEYS */;
INSERT INTO `be_users` VALUES (13,'admin','3e7bf1383bcdd338f3d837f3dc948f80','Admin','Manager','prachee.ye@gmail.com','http://localhost/demoSite/builderengine/public/img/avatar.png',1549901100,'Administrator',1549901269,'','yes','',0,'');
/*!40000 ALTER TABLE `be_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_users_extended`
--

DROP TABLE IF EXISTS `be_users_extended`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_users_extended` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT 'male',
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_ua_version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_os` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_device` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_users_extended`
--

LOCK TABLES `be_users_extended` WRITE;
/*!40000 ALTER TABLE `be_users_extended` DISABLE KEYS */;
INSERT INTO `be_users_extended` VALUES (1,13,'091000000','Portershed,Eyre Square','Galway City','Ireland','H91 HY5','Ireland','male',NULL,'::1','Chrome','71.0.3578.98','Windows 8.1','desktop');
/*!40000 ALTER TABLE `be_users_extended` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_videotube_albums`
--

DROP TABLE IF EXISTS `be_videotube_albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_videotube_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `groups_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `status` enum('public','private') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_videotube_albums`
--

LOCK TABLES `be_videotube_albums` WRITE;
/*!40000 ALTER TABLE `be_videotube_albums` DISABLE KEYS */;
INSERT INTO `be_videotube_albums` VALUES (1,0,13,'Video_Album_1','/files/be_demo/videotube/videos/video_placeholder.png',NULL,'public'),(2,0,13,'Video_Album_2','/builderengine/public/img/video_placeholder.png','Administrators,Members,Guests','public'),(3,0,13,'Video_Album_3','/builderengine/public/img/video_placeholder.png','Administrators,Members,Guests','public'),(4,0,13,'Video_Album_4','/builderengine/public/img/video_placeholder.png','Administrators,Members,Guests','public');
/*!40000 ALTER TABLE `be_videotube_albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_videotube_comment_reports`
--

DROP TABLE IF EXISTS `be_videotube_comment_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_videotube_comment_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) DEFAULT '0',
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_of_creation` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_videotube_comment_reports`
--

LOCK TABLES `be_videotube_comment_reports` WRITE;
/*!40000 ALTER TABLE `be_videotube_comment_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_videotube_comment_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_videotube_comments`
--

DROP TABLE IF EXISTS `be_videotube_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_videotube_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) DEFAULT '0',
  `channel_owner_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `time_created` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_videotube_comments`
--

LOCK TABLES `be_videotube_comments` WRITE;
/*!40000 ALTER TABLE `be_videotube_comments` DISABLE KEYS */;
INSERT INTO `be_videotube_comments` VALUES (1,0,13,13,'admin','comment comment comment',1504847536),(2,0,13,13,'admin','comment commentcomment comment commentcomment',1504847545),(3,0,13,13,'admin','comment  comment   comment  commentcomment',1504847558),(4,0,13,13,'admin','Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit. Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit. Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.',1504847574),(5,2,0,13,'admin','Nice Video Demo, this is placeholder text. ',1505118466),(6,2,0,13,'admin','Testing another comment on this video. ',1505118825);
/*!40000 ALTER TABLE `be_videotube_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_videotube_follows`
--

DROP TABLE IF EXISTS `be_videotube_follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_videotube_follows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `follower_id` int(11) DEFAULT NULL,
  `following_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_videotube_follows`
--

LOCK TABLES `be_videotube_follows` WRITE;
/*!40000 ALTER TABLE `be_videotube_follows` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_videotube_follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_videotube_likes`
--

DROP TABLE IF EXISTS `be_videotube_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_videotube_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_videotube_likes`
--

LOCK TABLES `be_videotube_likes` WRITE;
/*!40000 ALTER TABLE `be_videotube_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_videotube_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_videotube_medias`
--

DROP TABLE IF EXISTS `be_videotube_medias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_videotube_medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `album_id` int(11) DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL,
  `comments_allowed` enum('yes','no','hide') COLLATE utf8mb4_unicode_ci DEFAULT 'yes',
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_created` int(11) DEFAULT '0',
  `groups_allowed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `status` enum('public','private') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `featured` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `views` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `type` enum('file','youtube','vimeo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'file',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_videotube_medias`
--

LOCK TABLES `be_videotube_medias` WRITE;
/*!40000 ALTER TABLE `be_videotube_medias` DISABLE KEYS */;
INSERT INTO `be_videotube_medias` VALUES (1,'Video Demo 1','Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.','/files/be_demo/videotube/videos/video1.mp4',3,13,'yes','Tag,Third,Video,Tube,Video 1,Reserved',1503657884,'Members','public','no','10','file'),(2,'Video Demo 2','Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.','/files/be_demo/videotube/videos/video7.mp4',1,13,'yes','Tag,Third,Video,Tube,Video 2,Reserved,Color',1503657884,'Members','public','yes','3497','file'),(3,'Video Demo 3','Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.','/files/be_demo/videotube/videos/video5.mp4',1,13,'yes','Tag,Third,Video,Tube,Video 3,Reserved,Ladybug,Ladybird-HD',1503657884,'Members','public','no','7983384','file'),(4,'Video Demo 4','Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.','/files/be_demo/videotube/videos/video6.mp4',3,13,'yes','Tag,Third,Video,Tube,Video 4,Reserved,Slow Motion',1503657884,'Members','public','no','9387','file'),(5,'Video Demo 5','Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.','/files/be_demo/videotube/videos/video8.mp4',2,13,'yes','Tag,Third,Video,Tube,Video 5,Reserved,Stars',1503657884,'Members','public','no','24332','file'),(6,'Video Demo 6','Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.','/files/be_demo/videotube/videos/video4.mp4',4,13,'yes','Tag,Third,Video,Tube,Video 6,Reserved,Street',1503657884,'Members','public','no','0','file'),(7,'Video Demo 7','Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.','/files/be_demo/videotube/videos/video2.mp4',4,13,'yes','Tag,Third,Video,Tube,Video 7,Reserved',1503657884,'Members','public','no','0','file'),(8,'Video Demo 8','Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.','/files/be_demo/videotube/videos/video3.mp4',4,13,'yes','Tag,Third,Video,Tube,Video 8,Reserved',1503657884,'Members','public','no','0','file'),(9,'Video Demo 9','Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.','/files/be_demo/videotube/videos/video7.mp4',3,13,'yes','Tag,Third,Video,Tube,Video 9,Reserved',1503657884,'Members','public','no','0','file'),(10,'Video Demo 10','Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.','/files/be_demo/videotube/videos/video1.mp4',2,13,'yes','Tag,Third,Video,Tube,Video 10,Reserved',1503657884,'Members','public','no','0','file'),(11,'Video Demo 11','Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.','/files/be_demo/videotube/videos/video6.mp4',3,13,'yes','Tag,Third,Video,Tube,Video 11,Reserved',1503657884,'Members','public','no','0','file'),(12,'Video Demo 12','Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.','/files/be_demo/videotube/videos/video5.mp4',1,13,'yes','Tag,Third,Video,Tube,Video 12,Reserved',1503657884,'Members','public','no','0','file');
/*!40000 ALTER TABLE `be_videotube_medias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_videotube_ratings`
--

DROP TABLE IF EXISTS `be_videotube_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_videotube_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_videotube_ratings`
--

LOCK TABLES `be_videotube_ratings` WRITE;
/*!40000 ALTER TABLE `be_videotube_ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_videotube_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_videotube_user_settings`
--

DROP TABLE IF EXISTS `be_videotube_user_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_videotube_user_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `background_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `channel_comments` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_videotube_user_settings`
--

LOCK TABLES `be_videotube_user_settings` WRITE;
/*!40000 ALTER TABLE `be_videotube_user_settings` DISABLE KEYS */;
INSERT INTO `be_videotube_user_settings` VALUES (1,13,'Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.\r\n\r\nLorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod.Eum et doctus delicatissimi, sea te dicant fuisset pertinax.At debet oblique omnesque ius.Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.','/files/be_demo/videotube/videos/reserved.png','yes','yes');
/*!40000 ALTER TABLE `be_videotube_user_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_videotube_video_reports`
--

DROP TABLE IF EXISTS `be_videotube_video_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_videotube_video_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) DEFAULT '0',
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `time_of_creation` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_videotube_video_reports`
--

LOCK TABLES `be_videotube_video_reports` WRITE;
/*!40000 ALTER TABLE `be_videotube_video_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_videotube_video_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `be_visits`
--

DROP TABLE IF EXISTS `be_visits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `be_visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ua_version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referrer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `timestamp` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `be_visits`
--

LOCK TABLES `be_visits` WRITE;
/*!40000 ALTER TABLE `be_visits` DISABLE KEYS */;
/*!40000 ALTER TABLE `be_visits` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-11 21:42:56
