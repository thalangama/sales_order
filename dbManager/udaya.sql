-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2018 at 05:13 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `udaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE IF NOT EXISTS `customer_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nic` varchar(15) NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phone_no` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nic` (`nic`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `nic`, `name`, `address`, `phone_no`) VALUES
(1, '851202439v', 'sameera', 'no 09', 718131871);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(150) NOT NULL,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `code`, `description`) VALUES
(1, '001', 'tv'),
(2, '002', 'lap');

-- --------------------------------------------------------

--
-- Table structure for table `officer`
--

CREATE TABLE IF NOT EXISTS `officer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nic` varchar(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone` int(10) NOT NULL,
  `address` varchar(150) NOT NULL,
  `type` varchar(5) NOT NULL,
  `officer_id` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nic` (`nic`),
  UNIQUE KEY `officer_id` (`officer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `officer`
--

INSERT INTO `officer` (`id`, `nic`, `name`, `phone`, `address`, `type`, `officer_id`) VALUES
(1, '851450412v', 'shani', 775906464, 'no 10', 's', '0123456'),
(2, '851450452v', 'madusanka', 775906464, 'no 11', 'r', '0123457');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sales_officer_id` int(11) NOT NULL,
  `recovery_officer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `date`, `customer_id`, `sales_officer_id`, `recovery_officer_id`) VALUES
(1, '01253', '2018-01-24', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `price`) VALUES
(1, 1, 1, 1000),
(2, 1, 2, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `payment_date` date NOT NULL,
  `officer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `amount`, `payment_date`, `officer_id`) VALUES
(1, 1, 250, '2018-01-24', 2),
(2, 1, 300, '2018-02-24', 2);

-- --------------------------------------------------------

--
-- Table structure for table `payment_plan`
--

CREATE TABLE IF NOT EXISTS `payment_plan` (
  `id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` double NOT NULL,
  `term` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_plan`
--

INSERT INTO `payment_plan` (`id`, `payment_date`, `payment_amount`, `term`, `order_id`) VALUES
(1, '2018-01-24', 250, 1, 1),
(2, '2018-02-24', 250, 1, 1),
(3, '2018-03-24', 250, 1, 1),
(4, '2018-04-24', 250, 1, 1),
(5, '2018-05-24', 250, 1, 1),
(6, '2018-06-24', 250, 1, 1),
(7, '2018-07-24', 250, 1, 1),
(8, '2018-08-24', 250, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_type` varchar(1) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `first_name`, `last_name`, `user_type`, `password`, `is_deleted`) VALUES
('Dilsh', 'Dilshan', 'Madushanka', 'M', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
