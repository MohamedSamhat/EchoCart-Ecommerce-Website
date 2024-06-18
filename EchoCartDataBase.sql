CREATE DATABASE  IF NOT EXISTS `echocart` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `echocart`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: echocart
-- ------------------------------------------------------
-- Server version	8.0.34

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name_UNIQUE` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Vehicles','Images/CarIcon.jpg'),(2,'Mobiles & Accessories','Images/PhoneIcon.jpg'),(3,'Electronics & Appliances','Images/ElectronicsIcon.jpg'),(4,'Furniture & Decor','Images/FurnitureIcon.jpg'),(5,'Pets','Images/PetsIcon.jpg'),(6,'Sports & Equipments','Images/SportsIcon.jpg');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `image_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `image_url` varchar(150) NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `product_fk_idx` (`product_id`),
  CONSTRAINT `product_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (12,25,'PostImages/volvo.jpeg'),(13,25,'PostImages/volvo1.jpeg'),(16,27,'PostImages/cclass2021_1.jpg'),(17,27,'PostImages/cclass2021_2.jpg'),(18,27,'PostImages/cclass2021_3.jpg'),(19,28,'PostImages/gclass63amg_1.jpg'),(20,28,'PostImages/gclass63amg_2.jpg'),(21,28,'PostImages/gclass63amg_3.jpg'),(22,29,'PostImages/lamborginiUrus_1.jpg'),(23,29,'PostImages/lamborginiUrus_2.jpg'),(24,29,'PostImages/lamborginiUrus_3.jpg'),(27,31,'PostImages/german_shepered.jpg'),(28,32,'PostImages/iphone15_128GB.jpg'),(29,33,'PostImages/x52023_1.jpg'),(30,34,'PostImages/iphone7_2.jpg'),(31,34,'PostImages/iphone7_1.jpg'),(32,35,'PostImages/Intercon.jpg'),(33,36,'PostImages/airpods2&1.jpg'),(34,37,'PostImages/table with 4 stairs.jpg'),(35,38,'PostImages/antique_french.jpg'),(36,39,'PostImages/goldenretriever_2.jpg'),(37,39,'PostImages/goldenretriever_1.jpg'),(38,40,'PostImages/DogChewingToy.jpg'),(39,40,'PostImages/fuufomeDogChewToys.jpg'),(40,41,'PostImages/Dog-Care-Products.jpg'),(41,42,'PostImages/kiapicanto2020_1.jpg'),(42,43,'PostImages/football.jpg'),(43,45,'PostImages/cherokee_1.jpg'),(44,45,'PostImages/cherokee_2.jpg');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `price_dollar` float NOT NULL,
  `price_lb` float DEFAULT NULL,
  `category_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phone_nb` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `title_UNIQUE` (`title`),
  KEY `users_fk_idx` (`user_id`),
  KEY `categories_fk_idx` (`category_id`),
  CONSTRAINT `categories_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (25,8,'Volvo','Volvo 1997 good conditions',3000,270000000,1,'2024-06-01 19:47:56','+961 71 331 445'),(27,3,'Mercedes C-CLASS','Mercedes C-Class model 2021 in great condition, white',35500,3195000000,1,'2024-06-16 11:39:34','+961 76 917 710'),(28,3,'GClass 63 AMG','Mercedes GClass AMG 63 for sale or rent. Condition:New',143000,12870000000,1,'2024-06-16 11:42:04','+961 76 917 710'),(29,3,'Lamborgini URUS','Lamborgini car',245000,22050000000,1,'2024-06-16 11:43:26','+961 76 917 710'),(31,3,'German Shepherd','German Shephered Dog. Long Hair. 2 year old. Adoption',500,45000000,5,'2024-06-16 11:50:22','+961 76 917 710'),(32,3,'Iphone 15 Blue','New Iphone 15 128GB Blue',900,81000000,2,'2024-06-16 11:51:47','+961 76 917 710'),(33,3,'BMW X5','BMW X5 BLUE MODEL 2023',85000,7650000000,1,'2024-06-16 11:54:51','+961 76 917 710'),(34,9,'Iphone 7','iphone 7',200,18000000,2,'2024-06-16 12:16:39','+961 71 331 445'),(35,9,'Video Home Intecom','Video Interphone Home Security 4.3 inches video doorphone',50,4500000,3,'2024-06-16 12:29:09','+961 71 331 445'),(36,9,'Airpod case','Mobile Airpods Case Black',20,1800000,2,'2024-06-16 12:31:18','+961 71 331 445'),(37,8,'Table With 4 chairs','4 chairs and a table',100,9000000,4,'2024-06-16 12:56:14','+961 70 550 317'),(38,8,'French antique','French status antique',25,2250000,4,'2024-06-16 12:56:52','+961 70 550 317'),(39,10,'Golden Retriever','golden retriever dog',300,27000000,5,'2024-06-16 13:06:56','+961 03 321 213'),(40,10,'Dog Toys','Dog Chewing toy, Fuufome Toy',50,4500000,5,'2024-06-16 13:08:11','+961 03 321 213'),(41,10,'Dog Care Products','Dog Care Products',20,1800000,5,'2024-06-16 13:11:28','+961 03 321 213'),(42,10,'Kia Picanto','Kia Picanto 2020 Red',3500,315000000,1,'2024-06-16 13:12:13','+961 03 321 213'),(43,10,'Football Ball','fottball',50,4500000,6,'2024-06-16 13:38:31','+961 71 331 445'),(45,9,'Grand Cherokee','Grand Cherokee 2024 mate black Located in Werdenieh',4000,360000000,1,'2024-06-17 10:58:47','+961 71 331 445');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(70) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `security_question` varchar(70) NOT NULL,
  `answer` varchar(70) NOT NULL,
  `dob` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` varchar(45) NOT NULL,
  `pfp` varchar(100) NOT NULL DEFAULT 'Images/DefaultPFP.jpg',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'mohamedsamhat','mohamed_samhat@yahoo.com','$2y$10$tFifQFanbpeiWnNB1VV9duTimStxM.3P.qdGwEPh0IfgwaKeN9sme','Mohamed','Samhat','da7cfd1ff8fbf6ee9411ac7284194b008ccec8e0850d008f80576ac79b067c3c','68af3e93fe5bfaeb5a9b9f831c5ae195092fc949788fdc2492d8fb9f4cf2adc6','2003-05-06 21:00:00','male','PostImages/520.jpg','2024-05-27 16:12:27'),(7,'mohamedsamhat1','msamhat@yahoo.com','$2y$10$UU2Xn0.6uEmCrKV1jQqRquX10Fpilki4dSZE7rQ6ii8b9OsoG5VkG','Mohamed','Samhat','da7cfd1ff8fbf6ee9411ac7284194b008ccec8e0850d008f80576ac79b067c3c','68af3e93fe5bfaeb5a9b9f831c5ae195092fc949788fdc2492d8fb9f4cf2adc6','2003-05-06 21:00:00','male','Images/DefaultPFP.jpg','2024-05-27 20:58:54'),(8,'mohamedshames','mohamed_shames@yahoo.com','$2y$10$iIcjrzrpAW2DL6VTmaFueedYnuN8dqP6KDxaf3I30IZ5LkGX4kX2i','Mohamed','Shames','da7cfd1ff8fbf6ee9411ac7284194b008ccec8e0850d008f80576ac79b067c3c','68af3e93fe5bfaeb5a9b9f831c5ae195092fc949788fdc2492d8fb9f4cf2adc6','1994-09-05 21:00:00','male','PostImages/mohamedshames.jpg','2024-06-01 19:44:26'),(9,'ali_al_hajj','alialhajj@gmail.com','$2y$10$z62krcUTmxXZ1DLetw47weXNoYRYHWUzVvNESt58We30oUFBFKSvi','Ali','Al hajj','da7cfd1ff8fbf6ee9411ac7284194b008ccec8e0850d008f80576ac79b067c3c','661ba6c99e50cbd9f9202b0d59e1fef60be5713ba33f6c44a092f3c54a6a5ec6','2000-06-20 21:00:00','male','PostImages/AliALHajjpfp.jpg','2024-06-15 10:32:03'),(10,'joudsamhat','joudsamhat@gmail.com','$2y$10$qRVM5PPeRiC8zgakXqKThuD2S1zsNxifxYuJe1gYUxYLpgrNR6XGa','Joud','Samhat','da7cfd1ff8fbf6ee9411ac7284194b008ccec8e0850d008f80576ac79b067c3c','68af3e93fe5bfaeb5a9b9f831c5ae195092fc949788fdc2492d8fb9f4cf2adc6','2014-07-18 21:00:00','female','PostImages/joudPFP.jpg','2024-06-16 13:05:41');
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

-- Dump completed on 2024-06-18 14:48:26
