-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2018 at 06:20 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `udaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `id` int(11) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phone_no` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `nic`, `name`, `address`, `phone_no`) VALUES
(1, '851202439v', 'sameera', 'no 10, ', 718131871),
(2, '1021', '970100555v', 'himbutana', 766613021),
(3, '11', '11', '11', 11),
(5, '111', '11', '11', 11),
(6, '11111', '11', '11', 11),
(7, '2', '11', '11', 11),
(10, '11345345', '11', '11', 11),
(11, '1134534544', '11', '11', 11),
(12, '113453454455', '11', '11', 11),
(13, '', '', '', 0),
(14, '3', '2', '4', 5);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `code` varchar(150) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `code`, `description`) VALUES
(1, '001', 'tv'),
(2, '002', 'lap'),
(3, 'ddfgh', 'hhh'),
(4, 'ddfgh', 'hhh');

-- --------------------------------------------------------

--
-- Table structure for table `officer`
--

CREATE TABLE `officer` (
  `id` int(11) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone` int(10) NOT NULL,
  `address` varchar(150) NOT NULL,
  `type` varchar(5) NOT NULL,
  `officer_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_no` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sales_officer_id` int(11) NOT NULL,
  `recovery_officer_id` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `no_of_terms` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `date`, `customer_id`, `sales_officer_id`, `recovery_officer_id`, `payment`, `payment_date`, `no_of_terms`) VALUES
(1, '123', '2018-01-24', 1, 1, 1, 1250, '0000-00-00', 0),
(2, '11', '0000-00-00', 0, 11, 11, 0, '0000-00-00', 0),
(3, '11', '0000-00-00', 0, 11, 11, 0, '0000-00-00', 0),
(4, '11', '0000-00-00', 0, 11, 11, 0, '0000-00-00', 0),
(5, '11', '0000-00-00', 0, 11, 11, 0, '0000-00-00', 0),
(6, '11', '0000-00-00', 0, 11, 11, 0, '0000-00-00', 0),
(7, '003', '2018-02-01', 1, 1, 2, 0, '0000-00-00', 0),
(8, '003', '2018-02-01', 1, 1, 2, 0, '0000-00-00', 0),
(12, '0001', '2018-02-01', 1, 1, 2, 100, '2018-01-31', 5),
(13, '6', '2018-02-06', 0, 1, 2, 20, '2018-02-06', 5);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(5) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `price`, `quantity`, `status`) VALUES
(1, 1, 1, 1000, 1, 1),
(2, 1, 2, 2000, 2, 1),
(3, 6, 1, 11, 1, 1),
(4, 6, 2, 11, 2, 1),
(5, 12, 1, 3, 0, 0),
(6, 12, 1, 150, 1, 0),
(7, 12, 1, 150, 1, 0),
(8, 12, 1, 150, 1, 0),
(9, 12, 1, 750, 3, 0),
(10, 12, 1, 150, 1, 0),
(11, 12, 1, 150, 1, 0),
(12, 12, 1, 750, 3, 0),
(13, 12, 1, 150, 1, 0),
(14, 12, 1, 150, 1, 0),
(15, 12, 1, 750, 3, 0),
(16, 12, 1, 150, 1, 0),
(17, 12, 1, 150, 1, 0),
(18, 12, 1, 750, 3, 0),
(19, 12, 1, 150, 1, 0),
(20, 12, 1, 150, 1, 0),
(21, 12, 1, 750, 3, 0),
(22, 12, 1, 150, 1, 0),
(23, 12, 1, 150, 1, 0),
(24, 12, 1, 750, 3, 0),
(25, 12, 1, 150, 1, 0),
(26, 12, 1, 150, 1, 0),
(27, 12, 1, 750, 3, 0),
(28, 12, 1, 150, 1, 0),
(29, 12, 1, 150, 1, 0),
(30, 12, 1, 750, 3, 0),
(31, 12, 1, 150, 1, 0),
(32, 12, 1, 150, 1, 0),
(33, 12, 1, 750, 3, 0),
(34, 12, 1, 150, 1, 0),
(35, 12, 1, 150, 1, 0),
(36, 12, 1, 750, 3, 0),
(37, 12, 1, 150, 1, 0),
(38, 12, 1, 150, 1, 0),
(39, 12, 1, 750, 3, 0),
(40, 12, 1, 150, 1, 0),
(41, 12, 1, 150, 1, 0),
(42, 12, 1, 750, 3, 0),
(43, 13, 1, 9, 8, 1),
(44, 12, 1, 150, 1, 0),
(45, 12, 1, 150, 1, 0),
(46, 12, 1, 750, 3, 0),
(47, 12, 1, 150, 1, 0),
(48, 12, 1, 150, 1, 0),
(49, 12, 1, 750, 3, 0),
(50, 12, 1, 150, 1, 0),
(51, 12, 1, 150, 1, 0),
(52, 12, 1, 750, 3, 0),
(53, 12, 1, 150, 1, 1),
(54, 12, 1, 150, 1, 1),
(55, 12, 1, 750, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `payment_date` date NOT NULL,
  `officer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `payment_plan` (
  `id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` double NOT NULL,
  `term` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_plan`
--

INSERT INTO `payment_plan` (`id`, `payment_date`, `payment_amount`, `term`, `order_id`, `status`) VALUES
(1, '2018-02-25', 510, 1, 12, 0),
(2, '2018-03-25', 510, 2, 12, 0),
(3, '2018-04-25', 510, 3, 12, 0),
(4, '2018-05-25', 510, 4, 12, 0),
(5, '2018-06-25', 510, 5, 12, 0),
(6, '2018-07-25', 510, 6, 12, 0),
(7, '2018-01-31', 510, 1, 12, 0),
(8, '2018-02-28', 510, 2, 12, 0),
(9, '2018-03-31', 510, 3, 12, 0),
(10, '2018-04-30', 510, 4, 12, 0),
(11, '2018-05-31', 510, 5, 12, 0),
(12, '2018-06-30', 510, 6, 12, 0),
(13, '2018-02-06', 14.4, 1, 13, 1),
(14, '2018-02-06', 14.4, 2, 13, 1),
(15, '2018-02-06', 14.4, 3, 13, 1),
(16, '2018-02-06', 14.4, 4, 13, 1),
(17, '2018-02-06', 14.4, 5, 13, 1),
(18, '2018-02-06', 14.4, 1, 13, 1),
(19, '2018-03-06', 14.4, 2, 13, 1),
(20, '2018-04-06', 14.4, 3, 13, 1),
(21, '2018-05-06', 14.4, 4, 13, 1),
(22, '2018-06-06', 14.4, 5, 13, 1),
(23, '2018-07-06', 14.4, 6, 13, 1),
(24, '2018-01-31', 510, 1, 12, 0),
(25, '2018-02-28', 510, 2, 12, 0),
(26, '2018-03-31', 510, 3, 12, 0),
(27, '2018-04-30', 510, 4, 12, 0),
(28, '2018-05-31', 510, 5, 12, 0),
(29, '2018-06-30', 510, 6, 12, 0),
(30, '2018-01-31', 510, 1, 12, 0),
(31, '2018-02-28', 510, 2, 12, 0),
(32, '2018-03-31', 510, 3, 12, 0),
(33, '2018-04-30', 510, 4, 12, 0),
(34, '2018-05-31', 510, 5, 12, 0),
(35, '2018-06-30', 510, 6, 12, 0),
(36, '2018-01-31', 510, 1, 12, 0),
(37, '2018-02-28', 510, 2, 12, 0),
(38, '2018-03-31', 510, 3, 12, 0),
(39, '2018-04-30', 510, 4, 12, 0),
(40, '2018-05-31', 510, 5, 12, 0),
(41, '2018-06-30', 510, 6, 12, 0),
(42, '2018-01-31', 510, 1, 12, 1),
(43, '2018-02-28', 510, 2, 12, 1),
(44, '2018-03-31', 510, 3, 12, 1),
(45, '2018-04-30', 510, 4, 12, 1),
(46, '2018-05-31', 510, 5, 12, 1),
(47, '2018-06-30', 510, 6, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_type` varchar(1) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `first_name`, `last_name`, `user_type`, `password`, `is_deleted`) VALUES
('Dilsh', 'Dilshan', 'Madushanka', 'M', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nic` (`nic`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officer`
--
ALTER TABLE `officer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nic` (`nic`),
  ADD UNIQUE KEY `officer_id` (`officer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_plan`
--
ALTER TABLE `payment_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `officer`
--
ALTER TABLE `officer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `payment_plan`
--
ALTER TABLE `payment_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
