-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: poss_app_v1
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `phonenumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_api_token_unique` (`api_token`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','0','0','admin@gmail.com',NULL,'$2y$10$2erFqwBSKamBm8xJ3IaFfenHW8/UsQgPMA6Qmc9Y8UgsEPX5/ehQC','W2ePfGxjt7O6DPRjvjmxgyQ1Maa8wznh0wYf9pVkZ4nqCUmuvtTD7Elcw35U',NULL,'2022-06-17 11:02:41','2022-06-23 01:37:06'),(2,'flora','massawe','077728781212','floramassawe@gmail.com',NULL,'$2y$10$eHY5SjhrnQUF9uWWxZEBrOa4kzpaIgfPo7hq6y4bzrARyUYXGYJf6',NULL,NULL,'2022-06-17 11:15:14','2022-06-17 11:15:14'),(3,'mfura','tango','077728781212','testingteacher@gmail.com',NULL,'$2y$10$.BF91KivB/Fr5JGGPwyDuu.zHPEOI41.eJ4lX/5W5c67PZdv4t8rq',NULL,NULL,'2022-06-17 11:15:45','2022-06-17 11:15:45'),(4,'anna','usalama','077728781','maria@gmail.com',NULL,'$2y$10$2u6iMJ3w0TG9N/O2HIw9lu6e3aj3SAcMb2XFDJ5TBV0aZfNvwOo/y',NULL,NULL,'2022-06-29 08:59:59','2022-06-29 08:59:59'),(5,'sample','usalama','077728781','mariana@gmail.com',NULL,'$2y$10$KG1p.xklr3KZaa5tpGxbweg8gmIiH0KOPe73AdABgxBwKLfWz8E36',NULL,NULL,'2022-06-29 09:08:56','2022-06-29 09:08:56'),(6,'massoud','saidi','0772712124','masoud@gmail.com',NULL,'$2y$10$CGnruq5FOqgC8uH9rJ5J6.1DjypRRAAuJuT8i3u.XNLXiFCHOe2MS',NULL,NULL,'2022-06-29 14:16:23','2022-06-29 14:16:23'),(7,'amina','saidi','0772712124','amina@gmail.com',NULL,'$2y$10$3K7SIeIyf3MdEWVDWDkwA.RZTY0Yrodj1D6ZKZ.RBX9U8kOGsXxfG',NULL,NULL,'2022-06-29 14:16:42','2022-06-29 14:16:42'),(8,'Grace','mosha','0772712124','graceMosha@gmail.com',NULL,'$2y$10$uc9tANjmKHHNhLD7zt5Gp.sLV8cli1gJr5s1kKsTCc6V/0lg5htoq',NULL,NULL,'2022-06-29 14:18:59','2022-06-29 14:18:59'),(9,'Hamis','mosha','0772712124','tambwe@gmail.com',NULL,'$2y$10$nyPlSh.iaf0Yy6aOR9yv9OXamJDRAd9QS3ezP0TL.TdjGIgVARSN6',NULL,NULL,'2022-06-29 14:19:20','2022-06-29 14:19:20'),(10,'Jokate','mwegelo','0765344343','jokatemwegelo@gmail.com',NULL,'$2y$10$xJW1V.DZLqO6cndwrU72AeFFdWckqyIaTwk3eQaJWYEAP3gjIiKuC',NULL,NULL,'2022-06-29 14:25:27','2022-06-29 14:25:27'),(11,'Mamito','dullah','0764273233','mamito@gmail.com',NULL,'$2y$10$KFuXBl8zoO.XUA2CcAaBoeqXYqshVKmT6LT8TMMwacStNP94bfUMe',NULL,NULL,'2022-06-29 14:25:59','2022-06-29 14:25:59'),(13,'Hamis','mosha','0772712124','tambwe2@gmail.com',NULL,'$2y$10$hSGTUbThKg47yhUGIk1Nt.UsDK6yIZijBwMLXcTEvZ4KcgVsnaa/u',NULL,NULL,'2022-06-29 14:26:32','2022-06-29 14:26:32'),(14,'desi','mushi','0772712124','mushi@gmail.com',NULL,'$2y$10$PbHwvOWeVIaGLAXOt/6N9uIRySEtXjsx0iK7BW/PhksIZfDEmoeGq',NULL,NULL,'2022-06-29 14:31:45','2022-06-29 14:31:45'),(15,'Godwin','Gondwe','0765344343','godwingondwe@gmail.com',NULL,'$2y$10$pa7GQ5Xx0g6IXaU4ynsqMu5/rz/imms.gVxYe1nI6jlG32khXirWG',NULL,NULL,'2022-07-05 20:40:15','2022-07-05 20:40:15'),(16,'test','test','+255676994832','geminideogratias8@gmail.com',NULL,'$2y$10$AY/BhQvfSnpJ0BXJFx3A3OVLUAQQJekP9z6rqeVTiOa8ZV2t8IGHW',NULL,NULL,'2022-07-12 16:47:19','2022-07-12 16:47:19'),(17,'test','test','+255676994832','geminideogratias8ii@gmail.com',NULL,'$2y$10$.tE062jZ68Okj3ptLXCjQOMj40vrHMfbgsSpSszequ7ZMkbh2qvem',NULL,NULL,'2022-07-12 18:19:48','2022-07-12 18:19:48'),(18,'Athur','Shebly','+255676994832','athur@gmail.com',NULL,'$2y$10$l9Nq.Ff7CEztaYGHzKfBbu8BnX2btTegY8OY1xSHq27c92xkzBsIi',NULL,NULL,'2022-07-14 18:19:21','2022-07-14 18:19:21'),(19,'Thomas','Shelby','+255676994832','tomasshebly@gmail.com',NULL,'$2y$10$mXmh8ht8MUDkgT61eNmlCeCLGdAgudtxXl01uzd3H8AAx82HTXSK2',NULL,NULL,'2022-07-14 18:43:02','2022-07-14 18:43:02');
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

-- Dump completed on 2022-07-15 19:10:19
