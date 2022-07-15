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
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `students_stream_id_foreign` (`stream_id`),
  CONSTRAINT `students_stream_id_foreign` FOREIGN KEY (`stream_id`) REFERENCES `streams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'student1 Amina','female',1,'2022-06-17 11:02:41','2022-06-17 11:02:41'),(2,'student2 Salumu','male',1,'2022-06-17 11:02:41','2022-06-17 11:02:41'),(3,'Abu Abu','male',2,'2022-06-17 11:02:41','2022-06-17 11:02:41'),(4,'Klaty Asana','female',2,'2022-06-17 11:02:41','2022-06-17 11:02:41'),(5,'Charlie Charlie','male',2,'2022-06-17 11:02:41','2022-06-17 11:02:41'),(6,'Lou Charlie','female',2,'2022-06-17 11:02:41','2022-06-17 11:02:41'),(7,'Parker Json','male',3,'2022-06-17 11:02:41','2022-06-17 11:02:41'),(8,'Athur Athens','male',4,'2022-06-17 11:02:41','2022-06-17 11:02:41'),(9,'Lisamu Hitler','female',4,'2022-06-17 11:02:41','2022-06-17 11:02:41'),(10,'Stregomena Tax','female',5,'2022-06-17 11:02:41','2022-06-17 11:02:41'),(11,'Bashungwa Innocent','male',5,'2022-06-17 11:02:41','2022-06-17 11:02:41'),(12,'Jafo Sulemani','male',5,'2022-06-17 11:02:41','2022-06-17 11:02:41'),(13,'Dj Khalid','male',5,'2022-06-17 11:13:19','2022-06-17 11:13:19'),(14,'rihana','female',5,'2022-06-17 11:13:44','2022-06-17 11:13:44'),(15,'absaolom','male',1,'2022-06-17 11:14:30','2022-06-17 11:14:30'),(16,'simi','female',1,'2022-06-17 11:14:53','2022-06-17 11:14:53'),(17,'Magufuli Mwamba','male',3,'2022-06-25 20:53:39','2022-06-25 20:53:39'),(18,'Benjamini Mkapa','male',3,'2022-06-25 21:02:33','2022-06-25 21:02:33');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-15 19:10:20
