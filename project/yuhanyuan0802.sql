-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2023 at 08:09 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yuhanyuan0802`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `phone` int(11) NOT NULL,
  `address` text NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `date_of_birth` date NOT NULL,
  `registration_date_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gender` enum('male','female') NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`user_id`, `username`, `first_name`, `last_name`, `password`, `email`, `date_of_birth`, `registration_date_time`, `gender`, `status`) VALUES
(1, 'yuhanyuan0802', 'yu', 'hanyuan', '$2y$10$h1Qz2G2mNwn6QYMQvCDxE.4KF8/ygQinhkxyWrbxD4jNRMNRk7/ay', 'hanyuan@gmail.com', '2002-01-08', '2023-07-11 21:54:00', 'male', 'active'),
(2, 'skychong', 'sky', 'chong', '$2y$10$zG8cPs1zA6e3qyt6rayOTeoaLNUrJdpEGbNVBr1hrIPX.TqQLx0kq', 'chong@gmail.com', '2002-06-01', '2023-07-11 23:00:00', 'male', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `promote_price` float NOT NULL,
  `manufacture_date` datetime NOT NULL,
  `expired_date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `promote_price`, `manufacture_date`, `expired_date`, `created`, `modified`) VALUES
(1, 'Basketball', 'A ball used in the NBA.', 49.99, 0, '2022-07-01 13:36:09', '2023-07-09 13:36:09', '2015-08-02 12:04:03', '2023-07-10 05:56:21'),
(2, 'Gatorade', 'This is a very good drink for athletes.', 1.99, 1, '2022-07-06 13:36:09', '2023-07-09 13:36:09', '2015-08-02 12:14:29', '2023-07-10 05:37:40'),
(3, 'Eye Glasses', 'It will make you read better.', 6, 5, '2022-07-05 13:36:09', '2023-07-09 13:36:09', '2015-08-02 12:15:04', '2023-07-10 05:37:40'),
(4, 'Trash Can', 'It will help you maintain cleanliness.', 3.95, 2, '2022-07-05 13:36:09', '2023-07-06 13:36:09', '2015-08-02 12:16:08', '2023-07-10 05:37:40'),
(5, 'Mouse', 'Very useful if you love your computer.', 11.35, 10, '2022-07-05 13:36:09', '2023-07-09 13:36:09', '2015-08-02 12:17:58', '2023-07-10 05:37:40'),
(6, 'Earphone', 'You need this one if you love music.', 7, 6, '2022-07-03 13:36:09', '2023-07-09 13:36:09', '2015-08-02 12:18:21', '2023-07-10 05:37:40'),
(7, 'Pillow', 'Sleeping well is important.', 8.99, 7, '2022-07-03 13:36:09', '2023-07-09 13:36:09', '2015-08-02 12:18:56', '2023-07-10 05:37:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`),
  ADD UNIQUE KEY `first_name` (`first_name`,`last_name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
