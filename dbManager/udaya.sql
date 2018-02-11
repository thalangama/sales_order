-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2018 at 05:26 PM
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
(1, '851202439v', 'sam HAR THA', 'medirigiriya', 774231616),
(2, '851202440V', 'SHANI', '11 11', 123456792),
(5, '1', '1', '1', 1),
(6, '1 id', '1 sam', '1 add', 1),
(8, '100', '1', '1', 1),
(9, '1001', '1', '1', 1),
(10, '10011', '1', '1', 1),
(12, '100111', '1', '1', 1),
(13, '1001111', '1', '1', 1),
(14, '10011112', '1', '1', 1);

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
(1, '001', 'Samsung 32 tv'),
(2, '002', 'Damro washine machine'),
(3, '003', 'dell laptop'),
(4, '004', 'lg ac ');

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
(1, '851202439v', 'sameera harshana T', 718131871, 'no 09', '', '01'),
(2, '911202439v', 'shanika dilhani', 775906464, 'no 10', '', '02'),
(3, '253123456v', 'dilhan ', 2147483647, '11', '', '03');

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
(6, '0004', '2018-02-11', 14, 1, 2, 100, '2018-02-12', 10);

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
(1, 3, 1, 111, 1, 1),
(2, 4, 1, 1500, 2, 1),
(3, 5, 1, 1500, 2, 1),
(4, 6, 1, 1500, 2, 1);

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
(1, 6, 0, '0000-00-00', 1);

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
(1, '0000-00-00', 0, 1, 1, 1),
(2, '0000-00-00', 0, 1, 2, 1),
(3, '2018-02-12', 111, 1, 3, 1),
(4, '2018-02-12', 111, 1, 3, 1),
(5, '2018-03-12', 111, 2, 3, 1),
(6, '2018-02-27', 1500, 1, 4, 1),
(7, '2018-02-27', 1500, 2, 4, 1),
(8, '2018-02-27', 1500, 1, 4, 1),
(9, '2018-03-27', 1500, 2, 4, 1),
(10, '2018-04-27', 1500, 3, 4, 1),
(11, '2018-02-12', 300, 1, 5, 1),
(12, '2018-02-12', 300, 2, 5, 1),
(13, '2018-02-12', 300, 3, 5, 1),
(14, '2018-02-12', 300, 4, 5, 1),
(15, '2018-02-12', 300, 5, 5, 1),
(16, '2018-02-12', 300, 6, 5, 1),
(17, '2018-02-12', 300, 7, 5, 1),
(18, '2018-02-12', 300, 8, 5, 1),
(19, '2018-02-12', 300, 9, 5, 1),
(20, '2018-02-12', 300, 10, 5, 1),
(21, '2018-02-12', 300, 1, 5, 1),
(22, '2018-03-12', 300, 2, 5, 1),
(23, '2018-04-12', 300, 3, 5, 1),
(24, '2018-05-12', 300, 4, 5, 1),
(25, '2018-06-12', 300, 5, 5, 1),
(26, '2018-07-12', 300, 6, 5, 1),
(27, '2018-08-12', 300, 7, 5, 1),
(28, '2018-09-12', 300, 8, 5, 1),
(29, '2018-10-12', 300, 9, 5, 1),
(30, '2018-11-12', 300, 10, 5, 1),
(31, '2018-12-12', 300, 11, 5, 1),
(42, '2018-02-12', 300, 1, 6, 1),
(43, '2018-03-12', 300, 2, 6, 1),
(44, '2018-04-12', 300, 3, 6, 1),
(45, '2018-05-12', 300, 4, 6, 1),
(46, '2018-06-12', 300, 5, 6, 1),
(47, '2018-07-12', 300, 6, 6, 1),
(48, '2018-08-12', 300, 7, 6, 1),
(49, '2018-09-12', 300, 8, 6, 1),
(50, '2018-10-12', 300, 9, 6, 1),
(51, '2018-11-12', 300, 10, 6, 1),
(52, '2018-12-12', 300, 11, 6, 1);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_no` (`order_no`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `officer`
--
ALTER TABLE `officer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payment_plan`
--
ALTER TABLE `payment_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
