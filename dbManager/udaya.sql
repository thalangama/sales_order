-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2018 at 10:34 AM
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
(13, '', '', '', 0);

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
(12, '0001', '2018-02-01', 1, 1, 2, 100, '2018-02-10', 7);

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
(13, 12, 1, 150, 1, 1),
(14, 12, 1, 150, 1, 1),
(15, 12, 1, 750, 3, 1);

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
(1, '2018-01-24', 250, 1, 1, 1),
(2, '2018-02-24', 250, 1, 1, 1),
(3, '2018-03-24', 250, 1, 1, 1),
(4, '2018-04-24', 250, 1, 1, 1),
(5, '2018-05-24', 250, 1, 1, 1),
(6, '2018-06-24', 250, 1, 1, 1),
(7, '2018-07-24', 250, 1, 1, 1),
(8, '2018-08-24', 250, 1, 1, 1),
(0, '2018-02-10', 364.28571428571, 1, 12, 0),
(0, '2018-02-10', 364.28571428571, 2, 12, 0),
(0, '2018-02-10', 364.28571428571, 3, 12, 0),
(0, '2018-02-10', 364.28571428571, 4, 12, 0),
(0, '2018-02-10', 364.28571428571, 5, 12, 0),
(0, '2018-02-10', 364.28571428571, 6, 12, 0),
(0, '2018-02-10', 364.28571428571, 7, 12, 0),
(0, '2018-02-10', 364.28571428571, 1, 12, 1),
(0, '2018-02-10', 364.28571428571, 2, 12, 1),
(0, '2018-02-10', 364.28571428571, 3, 12, 1),
(0, '2018-02-10', 364.28571428571, 4, 12, 1),
(0, '2018-02-10', 364.28571428571, 5, 12, 1),
(0, '2018-02-10', 364.28571428571, 6, 12, 1),
(0, '2018-02-10', 364.28571428571, 7, 12, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
