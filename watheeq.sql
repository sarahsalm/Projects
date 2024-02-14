-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 29, 2023 at 01:01 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `watheeq`
--

-- --------------------------------------------------------

--
-- Table structure for table `accept_transaction`
--

DROP TABLE IF EXISTS `accept_transaction`;
CREATE TABLE IF NOT EXISTS `accept_transaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `trID` int NOT NULL,
  `cardID` int NOT NULL,
  `cardType` varchar(30) NOT NULL,
  `cardNumber` int NOT NULL,
  `checked` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cardID` (`cardID`),
  KEY `trID` (`trID`),
  KEY `userID` (`userID`)
); 

--
-- Dumping data for table `accept_transaction`
--


-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `country` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `streetAddress1` varchar(20) NOT NULL,
  `streetAddress2` varchar(20) NOT NULL,
  `building` varchar(20) NOT NULL,
  `floor` varchar(20) NOT NULL,
  `depNo` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `USERS_ADDRESS` (`userID`)
);

--
-- Dumping data for table `address`
--


-- --------------------------------------------------------

--
-- Table structure for table `transaction_order`
--

DROP TABLE IF EXISTS `transaction_order`;
CREATE TABLE IF NOT EXISTS `transaction_order` (
  `trID` int NOT NULL AUTO_INCREMENT,
  `userID` int DEFAULT NULL,
  `ecommerceName` varchar(40) DEFAULT NULL,
  `cardType` varchar(40) DEFAULT NULL,
  `OTPcode` varchar(20) ,
  PRIMARY KEY (`trID`),
  KEY `userID` (`userID`)
);

--
-- Dumping data for table `transaction_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_card_financail`
--

DROP TABLE IF EXISTS `users_card_financail`;
CREATE TABLE IF NOT EXISTS `users_card_financail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `cardType` varchar(30) NOT NULL,
  `cardName` varchar(30) NOT NULL,
  `cardNumber` varchar(50) ,
  `expiryDate` varchar(15) DEFAULT NULL,
  `CVV` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `USERS_CARDS` (`userID`)
);

--
-- Dumping data for table `users_card_financail`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_information`
--

DROP TABLE IF EXISTS `users_information`;
CREATE TABLE IF NOT EXISTS `users_information` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `secretKey` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

--
-- Dumping data for table `users_information`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `accept_transaction`
--
ALTER TABLE `accept_transaction`
  ADD CONSTRAINT `accept_transaction_ibfk_1` FOREIGN KEY (`cardID`) REFERENCES `users_card_financail` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `accept_transaction_ibfk_2` FOREIGN KEY (`trID`) REFERENCES `transaction_order` (`trID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `accept_transaction_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `users_information` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `USERS_ADDRESS` FOREIGN KEY (`userID`) REFERENCES `users_information` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `transaction_order`
--
ALTER TABLE `transaction_order`
  ADD CONSTRAINT `transaction_order_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users_information` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `users_card_financail`
--
ALTER TABLE `users_card_financail`
  ADD CONSTRAINT `USERS_CARDS` FOREIGN KEY (`userID`) REFERENCES `users_information` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
