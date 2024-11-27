CREATE DATABASE  IF NOT EXISTS `petcare` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `petcare`;
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: petcare
-- ------------------------------------------------------
-- Server version	5.7.24

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
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addresses` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `address_flat_no` varchar(45) NOT NULL,
  `address_street` varchar(45) NOT NULL,
  `address_town` varchar(45) NOT NULL,
  `address_country` varchar(45) NOT NULL,
  `address_user_id` int(11) NOT NULL,
  PRIMARY KEY (`address_id`),
  UNIQUE KEY `idaddresses_UNIQUE` (`address_id`),
  KEY `user_id_idx` (`address_user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`address_user_id`) REFERENCES `user_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES (1,'101','Baker Street','London','UK',11),(2,'102','Elm Street','Springfield','USA',12),(3,'103','Park Avenue','New York','USA',13),(4,'104','High Street','Manchester','UK',14),(5,'105','King Street','Sydney','Australia',15),(6,'106','Queen Street','Melbourne','Australia',16),(7,'107','Oxford Street','Oxford','UK',17),(8,'108','Broadway','Los Angeles','USA',18),(9,'109','Main Street','Toronto','Canada',19),(10,'110','Fifth Avenue','San Francisco','USA',20);
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_details`
--

DROP TABLE IF EXISTS `chat_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_details` (
  `chat_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  PRIMARY KEY (`chat_details_id`),
  KEY `sender_id_fk_idx` (`sender_id`),
  KEY `reciever_id_fk_idx` (`reciever_id`),
  KEY `chat_id_fk_idx` (`chat_id`),
  CONSTRAINT `chat_id_fk` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`chat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reciever_id_fk` FOREIGN KEY (`reciever_id`) REFERENCES `user_details` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sender_id_fk` FOREIGN KEY (`sender_id`) REFERENCES `user_details` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_details`
--

LOCK TABLES `chat_details` WRITE;
/*!40000 ALTER TABLE `chat_details` DISABLE KEYS */;
INSERT INTO `chat_details` VALUES (1,11,12,1),(2,12,13,2),(3,13,14,3),(4,14,15,4),(5,15,16,5),(6,16,17,6),(7,17,18,7),(8,18,19,8),(9,19,20,9),(10,20,11,10);
/*!40000 ALTER TABLE `chat_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chats`
--

DROP TABLE IF EXISTS `chats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `mesg_text` text NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`chat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chats`
--

LOCK TABLES `chats` WRITE;
/*!40000 ALTER TABLE `chats` DISABLE KEYS */;
INSERT INTO `chats` VALUES (1,'Hello, how can I assist you today?','2024-11-20 09:00:00'),(2,'I need help with the service request.','2024-11-20 09:15:00'),(3,'Sure, I will look into your request now.','2024-11-20 09:30:00'),(4,'Thank you for your patience!','2024-11-20 09:45:00'),(5,'Your request has been processed successfully.','2024-11-20 10:00:00'),(6,'Is there anything else I can help you with?','2024-11-20 10:15:00'),(7,'No, that will be all for now. Thank you!','2024-11-20 10:30:00'),(8,'You are welcome! Have a great day ahead!','2024-11-20 10:45:00'),(9,'I have a question about the pet services.','2024-11-20 11:00:00'),(10,'Feel free to ask any questions you have!','2024-11-20 11:15:00');
/*!40000 ALTER TABLE `chats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favourites`
--

DROP TABLE IF EXISTS `favourites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favourites` (
  `favourites_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `favourite_user_id` int(11) NOT NULL,
  PRIMARY KEY (`favourites_id`),
  KEY `user_id_fk_idx` (`user_id`),
  KEY `favourite_user_id_fk_idx` (`favourite_user_id`),
  CONSTRAINT `favourites_favourite_user_id_fk` FOREIGN KEY (`favourite_user_id`) REFERENCES `user_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `favourites_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favourites`
--

LOCK TABLES `favourites` WRITE;
/*!40000 ALTER TABLE `favourites` DISABLE KEYS */;
INSERT INTO `favourites` VALUES (1,11,12),(2,12,13),(3,13,14),(4,14,15),(5,15,16),(6,16,17),(7,17,18),(8,18,19),(9,19,20),(10,20,11);
/*!40000 ALTER TABLE `favourites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pets`
--

DROP TABLE IF EXISTS `pets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pets` (
  `pet_id` int(11) NOT NULL AUTO_INCREMENT,
  `pet_name` varchar(45) NOT NULL,
  `pet_age` int(11) NOT NULL,
  `pet_species` varchar(45) DEFAULT NULL,
  `pet_breed` varchar(45) DEFAULT NULL,
  `pet_medication` varchar(45) DEFAULT NULL,
  `pet_additional_info` varchar(45) DEFAULT NULL,
  `image_path` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`pet_id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `pets_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pets`
--

LOCK TABLES `pets` WRITE;
/*!40000 ALTER TABLE `pets` DISABLE KEYS */;
INSERT INTO `pets` VALUES (1,'Bella',3,'Dog','Labrador','None','Friendly dog','path/to/image1.jpg',11),(2,'Max',2,'Cat','Persian','None','Shy but playful','path/to/image2.jpg',12),(3,'Charlie',4,'Dog','Beagle','None','Loves running','path/to/image3.jpg',13),(4,'Milo',5,'Cat','Siamese','None','Very curious','path/to/image4.jpg',14),(5,'Luna',1,'Dog','Bulldog','None','Very energetic','path/to/image5.jpg',15),(6,'Oliver',7,'Cat','Maine Coon','None','Large and friendly','path/to/image6.jpg',16),(7,'Sophie',6,'Rabbit','Himalayan','None','Loves to hide','path/to/image7.jpg',17),(8,'Rocky',2,'Dog','Pitbull','None','Strong and playful','path/to/image8.jpg',18),(9,'Daisy',3,'Bird','Parrot','None','Loves to sing','path/to/image9.jpg',19),(10,'Sadie',5,'Dog','Golden Retriever','None','Very loyal','path/to/image10.jpg',20);
/*!40000 ALTER TABLE `pets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `rating` int(11) NOT NULL,
  `comments` text,
  `service_request_id` int(11) DEFAULT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`rating_id`),
  KEY `rating_service_request_id_fk_idx` (`service_request_id`),
  CONSTRAINT `rating_service_request_id_fk` FOREIGN KEY (`service_request_id`) REFERENCES `service_request` (`service_request_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating`
--

LOCK TABLES `rating` WRITE;
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
INSERT INTO `rating` VALUES (1,5,'Excellent service!',1,'2024-11-20 09:45:00'),(2,4,'Good, but could be faster.',2,'2024-11-20 10:15:00'),(3,3,'Average service, needs improvement.',3,'2024-11-20 10:45:00'),(4,5,'Very satisfied, will use again!',4,'2024-11-20 11:15:00'),(5,2,'Not happy with the service.',5,'2024-11-20 11:45:00'),(6,4,'The service was good, but a bit expensive.',6,'2024-11-20 12:15:00'),(7,3,'It was okay, nothing special.',7,'2024-11-20 12:45:00'),(8,5,'Amazing service, very professional!',8,'2024-11-20 13:15:00'),(9,4,'Service was great, but there was a delay.',9,'2024-11-20 13:45:00'),(10,1,'Worst experience ever, do not recommend.',10,'2024-11-20 14:15:00'),(11,5,'Highly recommend, great job!',11,'2024-11-20 14:45:00'),(12,4,'Good service, but could use some improvements.',12,'2024-11-20 15:15:00'),(13,3,'Decent service, but needs to be more thorough.',13,'2024-11-20 15:45:00'),(14,2,'Not satisfied with the results.',14,'2024-11-20 16:15:00'),(15,5,'Very happy with the service, thank you!',15,'2024-11-20 16:45:00'),(16,4,'Service was okay, but the technician was friendly.',16,'2024-11-20 17:15:00'),(17,3,'Service was decent, but the communication could be better.',17,'2024-11-20 17:45:00'),(18,5,'Great service, would definitely use again!',18,'2024-11-20 18:15:00'),(19,4,'Good service, but not the best experience.',19,'2024-11-20 18:45:00'),(20,3,'Satisfactory, but could be improved.',20,'2024-11-20 19:15:00');
/*!40000 ALTER TABLE `rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_pet_link`
--

DROP TABLE IF EXISTS `request_pet_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request_pet_link` (
  `request_pet_link_id` int(11) NOT NULL AUTO_INCREMENT,
  `pet_id` int(11) NOT NULL,
  `service_request_id` int(11) NOT NULL,
  PRIMARY KEY (`request_pet_link_id`),
  KEY `pet_request_link_pet_id_fk_idx` (`pet_id`),
  KEY `pet_request_link_request_id_fk_idx` (`service_request_id`),
  CONSTRAINT `pet_request_link_pet_id_fk` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`pet_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pet_request_link_request_id_fk` FOREIGN KEY (`service_request_id`) REFERENCES `service_request` (`service_request_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_pet_link`
--

LOCK TABLES `request_pet_link` WRITE;
/*!40000 ALTER TABLE `request_pet_link` DISABLE KEYS */;
INSERT INTO `request_pet_link` VALUES (1,1,1),(2,2,2),(3,3,3),(4,4,4),(5,5,5),(6,6,6),(7,7,7),(8,8,8),(9,9,9),(10,10,10),(11,1,11),(12,2,12),(13,3,13),(14,4,14),(15,5,15),(16,6,16),(17,7,17),(18,8,18),(19,9,19),(20,10,20);
/*!40000 ALTER TABLE `request_pet_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_request`
--

DROP TABLE IF EXISTS `service_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_request` (
  `service_request_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_type` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  `request_status` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL,
  `acceptor_id` int(11) DEFAULT NULL,
  `service_type_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  PRIMARY KEY (`service_request_id`),
  KEY `service_request_id_idx` (`service_request_id`),
  KEY `user_id_fk` (`user_id`),
  KEY `acceptor_id_fk` (`acceptor_id`),
  KEY `address_id_fk` (`address_id`),
  KEY `service_type_id_fk_idx` (`service_type_id`),
  CONSTRAINT `acceptor_id_fk` FOREIGN KEY (`acceptor_id`) REFERENCES `user_details` (`user_id`),
  CONSTRAINT `address_id_fk` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `service_type_id_fk` FOREIGN KEY (`service_type_id`) REFERENCES `service_type` (`service_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_request`
--

LOCK TABLES `service_request` WRITE;
/*!40000 ALTER TABLE `service_request` DISABLE KEYS */;
INSERT INTO `service_request` VALUES (1,0,'2024-11-20 09:30:00','Pending',11,NULL,11,1),(2,1,'2024-11-20 10:00:00','Completed',12,13,12,2),(3,0,'2024-11-20 10:30:00','Pending',13,NULL,13,3),(4,1,'2024-11-20 11:00:00','Completed',14,15,14,4),(5,0,'2024-11-20 11:30:00','Pending',15,NULL,15,5),(6,1,'2024-11-20 12:00:00','Cancelled',16,17,11,6),(7,0,'2024-11-20 12:30:00','Pending',17,NULL,12,7),(8,1,'2024-11-20 13:00:00','Completed',18,19,13,8),(9,0,'2024-11-20 13:30:00','Pending',19,NULL,14,9),(10,1,'2024-11-20 14:00:00','Cancelled',20,11,15,10),(11,0,'2024-11-20 14:30:00','Pending',11,NULL,11,1),(12,1,'2024-11-20 15:00:00','Completed',12,14,12,2),(13,0,'2024-11-20 15:30:00','Pending',13,NULL,13,3),(14,1,'2024-11-20 16:00:00','Completed',14,16,14,4),(15,0,'2024-11-20 16:30:00','Pending',15,NULL,15,5),(16,1,'2024-11-20 17:00:00','Cancelled',16,18,11,6),(17,0,'2024-11-20 17:30:00','Pending',17,NULL,12,7),(18,1,'2024-11-20 18:00:00','Completed',18,20,13,8),(19,0,'2024-11-20 18:30:00','Pending',19,NULL,14,9),(20,1,'2024-11-20 19:00:00','Cancelled',20,12,15,10);
/*!40000 ALTER TABLE `service_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_type`
--

DROP TABLE IF EXISTS `service_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_type` (
  `service_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_type_name` varchar(45) NOT NULL,
  `service_type_description` varchar(200) NOT NULL,
  PRIMARY KEY (`service_type_id`),
  UNIQUE KEY `service_type_name_UNIQUE` (`service_type_name`),
  UNIQUE KEY `service_type_description_UNIQUE` (`service_type_description`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_type`
--

LOCK TABLES `service_type` WRITE;
/*!40000 ALTER TABLE `service_type` DISABLE KEYS */;
INSERT INTO `service_type` VALUES (11,'Grooming','Comprehensive grooming services including bathing, nail trimming, and fur brushing for pets.'),(12,'Veterinary Checkup','Routine health checkups and consultations to ensure your pet’s well-being.'),(13,'Training','Behavioral and obedience training for dogs and other pets.'),(14,'Daycare','Safe and engaging daycare services with supervised activities for pets.'),(15,'Pet Boarding','Overnight and extended stay boarding services in a comfortable environment.');
/*!40000 ALTER TABLE `service_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_first_name` varchar(45) NOT NULL,
  `user_last_name` varchar(45) NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_username` varchar(45) NOT NULL,
  `user_password` varchar(45) NOT NULL,
  `user_contact_number` varchar(45) DEFAULT NULL,
  `user_email` varchar(45) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `iduser_details_UNIQUE` (`user_id`),
  UNIQUE KEY `user_username_UNIQUE` (`user_username`),
  UNIQUE KEY `user_email_UNIQUE` (`user_email`),
  KEY `iduser_type_idx` (`user_type`),
  CONSTRAINT `iduser_type` FOREIGN KEY (`user_type`) REFERENCES `user_type` (`iduser_type`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_details`
--

LOCK TABLES `user_details` WRITE;
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
INSERT INTO `user_details` VALUES (11,'John','Doe',1,'johndoe','password123','1234567890','john.doe@example.com'),(12,'Jane','Smith',2,'janesmith','securepass456','0987654321','jane.smith@example.com'),(13,'Michael','Brown',3,'mikebrown','mypassword789','1122334455','michael.brown@example.com'),(14,'Emily','Davis',2,'emilydavis','passcode101',NULL,'emily.davis@example.com'),(15,'Chris','Wilson',3,'chriswilson','chris2023','2233445566','chris.wilson@example.com'),(16,'Sarah','Taylor',2,'sarahtaylor','sarah7890','3344556677','sarah.taylor@example.com'),(17,'David','Anderson',3,'davidanderson','anderson1010',NULL,'david.anderson@example.com'),(18,'Laura','Moore',2,'lauramoore','laura333','4455667788','laura.moore@example.com'),(19,'James','Johnson',3,'jamesjohnson','jjpass123','5566778899','james.johnson@example.com'),(20,'Sophia','Martinez',2,'sophiamartinez','martinez555','6677889900','sophia.martinez@example.com');
/*!40000 ALTER TABLE `user_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_type` (
  `iduser_type` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_name` varchar(45) NOT NULL,
  `user_type_description` varchar(45) NOT NULL,
  PRIMARY KEY (`iduser_type`),
  UNIQUE KEY `iduser_type_UNIQUE` (`iduser_type`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES (1,'admin','Use this only for admin users'),(2,'pet_owner','For owner of pets'),(3,'caretaker','for givers of care to pets'),(4,'both','Use this only for pet lovers');
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'petcare'
--

--
-- Dumping routines for database 'petcare'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-21 17:44:09
