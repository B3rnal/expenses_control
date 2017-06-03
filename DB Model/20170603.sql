CREATE DATABASE  IF NOT EXISTS `exprep_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ExpRep_DB`;
-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: ExpRep_DB
-- ------------------------------------------------------
-- Server version	5.5.42

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
-- Table structure for table `Currency`
--

DROP TABLE IF EXISTS `Currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Currency` (
  `idCurrency` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Code` varchar(45) NOT NULL,
  PRIMARY KEY (`idCurrency`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Currency`
--

LOCK TABLES `Currency` WRITE;
/*!40000 ALTER TABLE `Currency` DISABLE KEYS */;
INSERT INTO `Currency` VALUES (1,'US Dollar','USD'),(2,'CA Dollar','CAD'),(3,'Colones','CRC');
/*!40000 ALTER TABLE `Currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CurrencyValue`
--

DROP TABLE IF EXISTS `CurrencyValue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CurrencyValue` (
  `idCurrencyValue` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Value` decimal(10,0) DEFAULT NULL,
  `Currency_id` int(11) NOT NULL,
  PRIMARY KEY (`idCurrencyValue`,`Date`),
  KEY `fk_CurrencyId` (`Currency_id`),
  CONSTRAINT `CurrencyId_fk` FOREIGN KEY (`Currency_id`) REFERENCES `Currency` (`idCurrency`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CurrencyValue`
--

LOCK TABLES `CurrencyValue` WRITE;
/*!40000 ALTER TABLE `CurrencyValue` DISABLE KEYS */;
INSERT INTO `CurrencyValue` VALUES (1,'2017-05-14',564,1),(2,'2017-05-15',565,1);
/*!40000 ALTER TABLE `CurrencyValue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ExpenseLine`
--

DROP TABLE IF EXISTS `ExpenseLine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ExpenseLine` (
  `idExpenseLine` int(11) NOT NULL,
  `Date` varchar(45) NOT NULL,
  `Detail` varchar(150) DEFAULT NULL,
  `Place` varchar(100) DEFAULT NULL,
  `Amount` decimal(10,0) DEFAULT NULL,
  `FilePath` longtext,
  `ModificationDate` varchar(45) DEFAULT NULL,
  `ExpenseReportId` int(11) NOT NULL,
  `InvoiceId` int(11) NOT NULL,
  `ExpenseTypeid` int(11) NOT NULL,
  `CurrencyId` int(11) NOT NULL,
  PRIMARY KEY (`idExpenseLine`,`ExpenseReportId`,`InvoiceId`),
  KEY `fk_ExpenseReportId` (`ExpenseReportId`),
  KEY `fk_InvoiceId` (`InvoiceId`),
  KEY `fk_ExpenseTypeId` (`ExpenseTypeid`),
  KEY `fk_CurrencyId` (`CurrencyId`),
  CONSTRAINT `CurrencyIdEL_fk` FOREIGN KEY (`CurrencyId`) REFERENCES `Currency` (`idCurrency`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ExpenseReportIdEL_fk` FOREIGN KEY (`ExpenseReportId`) REFERENCES `ExpenseReport` (`idExpenseReport`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ExpenseTypeIdEL_fk` FOREIGN KEY (`ExpenseTypeid`) REFERENCES `ExpenseType` (`idExpenseType`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `InvoiceIdEL_fk` FOREIGN KEY (`InvoiceId`) REFERENCES `Invoice` (`idInvoice`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ExpenseLine`
--

LOCK TABLES `ExpenseLine` WRITE;
/*!40000 ALTER TABLE `ExpenseLine` DISABLE KEYS */;
/*!40000 ALTER TABLE `ExpenseLine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ExpenseReport`
--

DROP TABLE IF EXISTS `ExpenseReport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ExpenseReport` (
  `idExpenseReport` int(11) NOT NULL AUTO_INCREMENT,
  `ExpenseCustomId` varchar(45) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Billable` tinyint(4) DEFAULT '0',
  `Department` varchar(45) DEFAULT NULL,
  `Proyect` varchar(50) DEFAULT NULL,
  `CreationDate` date DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `ReportDetail` varchar(100) DEFAULT NULL,
  `CashAdvance` decimal(10,0) DEFAULT NULL,
  `Refund` decimal(10,0) DEFAULT NULL,
  `EmployeeId` int(11) NOT NULL,
  `SupervisorId` int(11) NOT NULL,
  `ExpenseStatusId` int(11) NOT NULL,
  PRIMARY KEY (`idExpenseReport`),
  KEY `fk_ExpenseStatusId` (`ExpenseStatusId`),
  KEY `EmployeeId_fk_idx` (`EmployeeId`),
  KEY `Suppervisor_fk_idx` (`SupervisorId`),
  CONSTRAINT `EmployeeId_fk` FOREIGN KEY (`EmployeeId`) REFERENCES `User` (`EmployeeNumber`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ExpenseStatusId_fk` FOREIGN KEY (`ExpenseStatusId`) REFERENCES `ExpenseStatus` (`idExpenseStatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SupervisorId_fk` FOREIGN KEY (`EmployeeId`) REFERENCES `User` (`EmployeeNumber`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ExpenseReport`
--

LOCK TABLES `ExpenseReport` WRITE;
/*!40000 ALTER TABLE `ExpenseReport` DISABLE KEYS */;
INSERT INTO `ExpenseReport` VALUES (1,'20170514','Calgary-Nissan',1,'NCI-Nissan Canada','Onboarding ','2017-05-14','2017-05-20','2017-05-27','Travel for Bernal to the Onboardig of the new account',500,NULL,318,3,1),(4,'123123123','NY',0,'Nissan','onboarding','2017-05-14','2017-05-28','2017-05-30','onboarding meeting',500,0,318,14,1),(5,'1231231235','Name1',0,'Dep1','Pro','2017-05-14','2017-05-28','2017-05-28','detail',500,0,14,318,1),(6,'3453','sdfs',0,'sdfsf','dfgd','2017-05-14','0000-00-00','0000-00-00','dfg',0,0,14,318,1),(8,'444444','name',0,'depatmer ','proyecto ','2017-05-14','0000-00-00','0000-00-00','detail',7000,0,14,318,1),(9,'6666','nME',0,'','','0000-00-00','0000-00-00','0000-00-00','',0,0,14,318,1);
/*!40000 ALTER TABLE `ExpenseReport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ExpenseStatus`
--

DROP TABLE IF EXISTS `ExpenseStatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ExpenseStatus` (
  `idExpenseStatus` int(11) NOT NULL,
  `Status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idExpenseStatus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ExpenseStatus`
--

LOCK TABLES `ExpenseStatus` WRITE;
/*!40000 ALTER TABLE `ExpenseStatus` DISABLE KEYS */;
INSERT INTO `ExpenseStatus` VALUES (1,'Open'),(2,'Waiting for Approval'),(3,'Approved'),(4,'Processed'),(5,'Closed');
/*!40000 ALTER TABLE `ExpenseStatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ExpenseType`
--

DROP TABLE IF EXISTS `ExpenseType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ExpenseType` (
  `idExpenseType` int(11) NOT NULL AUTO_INCREMENT,
  `ExpenseName` varchar(45) NOT NULL,
  PRIMARY KEY (`idExpenseType`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ExpenseType`
--

LOCK TABLES `ExpenseType` WRITE;
/*!40000 ALTER TABLE `ExpenseType` DISABLE KEYS */;
INSERT INTO `ExpenseType` VALUES (1,'Transportation'),(2,'Lodging, Hotel'),(3,'Auto Rental & Gas'),(4,'Parking'),(5,'Business Meals'),(6,'Personal Meals'),(7,'Internet'),(8,'Mobile'),(9,'Telephone & Fax'),(10,'Enterteiment'),(11,'Supplies'),(12,'Other');
/*!40000 ALTER TABLE `ExpenseType` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Invoice`
--

DROP TABLE IF EXISTS `Invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Invoice` (
  `idInvoice` int(11) NOT NULL,
  `InvoiceCustomId` varchar(45) DEFAULT NULL,
  `ProyectCode` varchar(45) DEFAULT NULL,
  `CreationDate` varchar(45) DEFAULT NULL,
  `ReportDetail` varchar(45) DEFAULT NULL,
  `CurrencyValue` varchar(45) DEFAULT NULL,
  `EmployeeNumber` varchar(45) DEFAULT NULL,
  `ExpenseId` int(11) NOT NULL,
  PRIMARY KEY (`idInvoice`,`ExpenseId`),
  KEY `fk_ExpenseReportId` (`ExpenseId`),
  CONSTRAINT `ExpenseReport_fk` FOREIGN KEY (`ExpenseId`) REFERENCES `ExpenseReport` (`idExpenseReport`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Invoice`
--

LOCK TABLES `Invoice` WRITE;
/*!40000 ALTER TABLE `Invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `Invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `StatusLog`
--

DROP TABLE IF EXISTS `StatusLog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `StatusLog` (
  `idStatusLog` int(11) NOT NULL,
  `Date` varchar(45) DEFAULT NULL,
  `ExpenseReportId` int(11) NOT NULL,
  `ExpenseStatus` int(11) NOT NULL,
  PRIMARY KEY (`idStatusLog`,`ExpenseReportId`),
  KEY `ExpenseReportId_fk` (`ExpenseReportId`),
  CONSTRAINT `ExpenseReportId_fk` FOREIGN KEY (`ExpenseReportId`) REFERENCES `ExpenseReport` (`idExpenseReport`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `StatusLog`
--

LOCK TABLES `StatusLog` WRITE;
/*!40000 ALTER TABLE `StatusLog` DISABLE KEYS */;
/*!40000 ALTER TABLE `StatusLog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeNumber` int(11) DEFAULT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Department` varchar(45) NOT NULL,
  `UserTypeId` int(11) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `EmployeeNumber_UNIQUE` (`EmployeeNumber`),
  KEY `UserTypeId_fk` (`UserTypeId`),
  CONSTRAINT `Permission_fk` FOREIGN KEY (`UserTypeId`) REFERENCES `UserType` (`idUserType`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (7,14,'teerer','lalalala','',2),(8,1000,'xxx','xxx','',1),(9,3,'Nancy','nanaromo@gmail.com','',2),(10,319,'bernal','sdfsdf','',2),(11,318,'Bernal Araya','bernala@gmail.com','',2),(12,123,'name','','asd',1);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserType`
--

DROP TABLE IF EXISTS `UserType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserType` (
  `idUserType` int(11) NOT NULL,
  `TypeName` varchar(45) NOT NULL,
  PRIMARY KEY (`idUserType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserType`
--

LOCK TABLES `UserType` WRITE;
/*!40000 ALTER TABLE `UserType` DISABLE KEYS */;
INSERT INTO `UserType` VALUES (1,'Administrator'),(2,'Basic');
/*!40000 ALTER TABLE `UserType` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-03 10:18:33
