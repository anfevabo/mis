-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2012 at 11:40 AM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mis`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl`
--

CREATE TABLE IF NOT EXISTS `acl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `Level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `acl`
--

INSERT INTO `acl` (`id`, `name`, `Level`) VALUES
(1, 'SuperUser', 100),
(2, 'BranchAdmin', 50),
(3, 'SeniorStaff', 25),
(4, 'Staff', 10);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `is_active`) VALUES
(1, 'Udaipur Branch', 1),
(2, 'Bhilwara Branch', 1);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '	',
  `name` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `joined_on` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `acl_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `username`, `password`, `joined_on`, `is_active`, `branch_id`, `acl_id`) VALUES
(1, 'root', 'admin', 'admin', '2012-10-01 00:00:00', 1, 0, 1),
(2, 'Simple Staff', 'staff1', 'staff', '2012-10-01 00:00:00', 1, 1, 4),
(3, 'Branch Admin BHL', 'bhl', 'bhl', '2012-10-01 00:00:00', 1, 2, 2),
(4, 'BHL Staff2', 'bhl1', 'bhl', '2012-10-01 00:00:00', 1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '	',
  `name` varchar(45) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `is_renewable` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `is_active`, `is_renewable`) VALUES
(1, 'FD', 1, '1'),
(2, 'RD', 1, ''),
(3, 'DBY', 1, '1'),
(4, 'MIS', 1, ''),
(5, 'Petro Card', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `Qty` int(11) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `Renew` int(11) DEFAULT NULL,
  `sales_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `branch_id`, `member_id`, `product_id`, `Qty`, `Amount`, `Renew`, `sales_date`, `is_active`) VALUES
(1, 1, 2, 1, 12, 5000, 1, '2012-10-17 00:00:00', 1),
(2, 2, 4, 1, 4, 2000, 0, '2012-10-18 00:00:00', 1),
(8, 1, 2, 1, 5, 2500, 0, '2012-10-19 00:00:00', 1),
(9, 1, 2, 2, 7, 1300, 200, '2012-10-19 00:00:00', 1),
(10, 1, 2, 5, 7, 16500, 10000, '2012-10-20 00:00:00', 1),
(11, 2, 3, 1, 1, 1200, 200, '2012-10-21 00:00:00', 1),
(12, 2, 4, 3, 6, 1225, 120, '2012-10-19 00:00:00', 1),
(13, 2, 3, 4, 12, 10000, 2000, '2012-10-18 00:00:00', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
