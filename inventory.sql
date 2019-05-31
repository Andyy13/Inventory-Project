-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 05, 2017 at 04:39 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventarymgt`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `DeptID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  PRIMARY KEY (`DeptID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`DeptID`, `Name`) VALUES
(1, 'ELECTRICAL'),
(2, 'MECHANICAL'),
(3, 'CIVIL'),
(4, 'PC&A'),
(5, 'C&IT');

-- --------------------------------------------------------

--
-- Table structure for table `itemdescription`
--

CREATE TABLE IF NOT EXISTS `itemdescription` (
  `ItemID` int(5) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Type` text,
  `Unit` varchar(10) NOT NULL DEFAULT 'Percentage',
  `Value` int(5) NOT NULL DEFAULT '80',
  `MaxUnit` int(5) NOT NULL DEFAULT '100',
  `InitialStock` int(5) NOT NULL DEFAULT '20',
  `WeighingUnit` text,
  PRIMARY KEY (`ItemID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `itemdescription`
--

INSERT INTO `itemdescription` (`ItemID`, `Name`, `Type`, `Unit`, `Value`, `MaxUnit`, `InitialStock`, `WeighingUnit`) VALUES
(1, 'AC', 'Mechanical', 'Percentage', 5, 100, 20, 'NUMBER'),
(2, 'printer HP', 'computer', 'Percentage', 10, 100, 20, 'NUMBER'),
(3, 'HPScanner', 'COMPUTER', 'Percentage', 5, 100, 20, 'NUMBER'),
(6, 'Laptop', NULL, 'Percentage', 80, 100, 5, 'NUMBER'),
(7, 'stapler', NULL, 'Percentage', 80, 100, 10, 'LOT'),
(8, 'Pen', NULL, 'Percentage', 80, 100, 50, 'NUMBER'),
(9, 'Books', NULL, 'Percentage', 80, 100, 5, 'NUMBER'),
(11, 'Milk', NULL, 'Percentage', 80, 100, 10, 'LITRE'),
(12, 'JACKET', NULL, 'Percentage', 80, 100, 10, 'NUMBER'),
(13, 'UTP CABLE', NULL, 'Percentage', 80, 100, 20, 'LOT');

-- --------------------------------------------------------

--
-- Table structure for table `itemhistory`
--

CREATE TABLE IF NOT EXISTS `itemhistory` (
  `ItemID` int(5) NOT NULL,
  `HistoryID` int(10) NOT NULL AUTO_INCREMENT,
  `DateOfIssue` date DEFAULT NULL,
  `DateOfRequest` date NOT NULL,
  `IssuedBy` int(10) DEFAULT '0',
  `IssuedTo` int(10) DEFAULT '0',
  `IssuedFor` varchar(20) DEFAULT NULL,
  `Quantity` int(5) NOT NULL DEFAULT '0',
  `TransType` enum('debit','credit') NOT NULL DEFAULT 'debit',
  `RequestRem` text,
  `IssueRem` text,
  `DateOfAction` date DEFAULT NULL,
  `ActionType` int(1) NOT NULL DEFAULT '0',
  `DateOfDelivery` date DEFAULT NULL,
  `DeliveryStatus` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`HistoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `itemhistory`
--

INSERT INTO `itemhistory` (`ItemID`, `HistoryID`, `DateOfIssue`, `DateOfRequest`, `IssuedBy`, `IssuedTo`, `IssuedFor`, `Quantity`, `TransType`, `RequestRem`, `IssueRem`, `DateOfAction`, `ActionType`, `DateOfDelivery`, `DeliveryStatus`) VALUES
(1, 1, NULL, '2016-07-20', 176, 3364, 'F001115', 1, 'debit', 'abcd', NULL, '2016-07-25', 1, '2016-11-22', 2),
(2, 16, NULL, '2016-07-24', 176, 3364, 'I000285', 2, 'debit', 'for self', NULL, '2016-08-26', 1, NULL, 0),
(3, 17, NULL, '2016-07-25', 176, 3364, 'J000126', 1, 'debit', 'for self', NULL, '2016-09-19', 1, NULL, 0),
(1, 18, NULL, '2016-07-25', 176, 3364, '3364', 1, 'debit', 'for dept', NULL, '2016-07-26', 2, NULL, 0),
(2, 21, NULL, '2016-07-25', 176, 3364, 'J000300', 1, 'debit', 'abcd', NULL, '2016-08-26', 1, '2016-11-22', 1),
(6, 22, NULL, '2016-07-25', 176, 3364, 'J000332', 2, 'debit', 'abcd', NULL, '2016-07-25', 1, NULL, 0),
(2, 23, NULL, '2016-07-29', 176, 511, 'B034200', 2, 'debit', 'abcd', NULL, '2016-08-26', 1, NULL, 0),
(7, 24, NULL, '2016-07-29', 176, 3364, 'J000332', 1, 'debit', 'abcd', NULL, '2016-08-08', 1, NULL, 0),
(3, 25, NULL, '2016-08-08', 176, 3364, '3364', 1, 'debit', 'For Use', NULL, '2016-09-19', 1, '2016-12-23', 1),
(2, 26, NULL, '2016-08-26', 176, 5710, 'J000321', 1, 'debit', 'abcdf', NULL, '2016-08-26', 1, NULL, 0),
(8, 27, NULL, '2016-11-08', 176, 3364, 'F001115', 2, 'debit', 'BY C&IT', 'Item exhausted', '2016-11-08', 2, NULL, 0),
(8, 30, NULL, '2016-11-08', 176, 3364, 'F001115', 2, 'debit', 'test', NULL, '2016-11-08', 1, '2016-11-22', 2),
(1, 32, '2016-11-08', '0000-00-00', 176, 0, NULL, 5, 'credit', NULL, 'test', NULL, 0, NULL, 0),
(2, 33, '2016-11-08', '0000-00-00', 176, 0, NULL, 3, 'credit', NULL, 'test', NULL, 0, NULL, 0),
(6, 34, NULL, '2016-11-21', 176, 4650, '4650', 1, 'debit', 'test', '', '2016-11-22', 1, NULL, 0),
(11, 35, '2016-11-22', '0000-00-00', 176, 0, NULL, 5, 'credit', NULL, 'test', NULL, 0, NULL, 0),
(12, 36, NULL, '2016-12-23', 176, 3364, 'J000332', 1, 'debit', 'TEST', 'ACCEPTED', '2016-12-23', 1, '2016-12-23', 2),
(8, 37, NULL, '2017-06-02', 176, 3364, 'J000300', 2, 'debit', 'TEST', 'ITEM ISSUED', '2017-06-02', 1, '2017-06-02', 2),
(11, 38, '2017-06-02', '0000-00-00', 176, 0, NULL, 5, 'credit', NULL, 'TEST', NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(10) NOT NULL,
  `Passwd` text NOT NULL,
  `PhNo` bigint(11) NOT NULL,
  `EmailID` text NOT NULL,
  `Department` text NOT NULL,
  `UserType` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Passwd`, `PhNo`, `EmailID`, `Department`, `UserType`) VALUES
(1, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'BUSINESS EXCELLENCE', 0),
(150, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'ED SECRETARIAT', 0),
(151, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'GM SECTT', 0),
(155, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'BHADRAVATI SUB-CENTRE', 0),
(156, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'BHILAI', 0),
(157, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'BOKARO', 0),
(158, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'BURNPUR SUB-CENTRE', 0),
(160, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'DELHI (IPSS)', 0),
(161, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'DURGAPUR SUB-CENTRE', 0),
(162, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'KOLKATA UNIT OFFICE', 0),
(163, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'ROURKELA SUB-CENTRE', 0),
(170, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'UTILITIES & SERVICES', 0),
(172, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'FINANCE', 0),
(175, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'IRON & SINTER', 0),
(176, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'P&A', 1),
(180, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'COST TECHNO-ECONOMICS & BUDGET', 0),
(181, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'PFC', 0),
(182, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'CONTRACTS & COMMERCIAL', 0),
(183, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'RAW MATERIAL', 0),
(184, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'ROLLING MILLS', 0),
(185, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'STEEL', 0),
(187, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'TOTAL QUALITY PROCESS', 0),
(511, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'COAL COKE & CHEMICAL', 0),
(600, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'PROJECTS  ', 0),
(701, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'VIGILANCE ', 0),
(3070, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'MECHANICAL', 0),
(3072, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'ELECTRICAL', 0),
(3146, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'STRUCTURAL', 0),
(3222, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'RAW MATERIALS  ', 0),
(3288, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'REFRACTORY', 0),
(3362, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'RDCIS    ', 0),
(3364, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'C&IT ', 0),
(3374, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'CET', 0),
(3486, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'DELHI UNIT OFFICE', 0),
(4290, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'BHILAI SUB-CENTRE', 0),
(4350, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'BOKARO SUB-CENTRE', 0),
(4650, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'CIVIL & STRUCTURAL', 0),
(5710, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'Process Control & Automation', 0),
(8923, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'GM OFFICE', 0),
(9029, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'CIVIL', 0),
(9271, 'e321c8104b80aaf1848763bfbe6d2936', 0, '', 'PROJECT CO-ORDN.', 0);
