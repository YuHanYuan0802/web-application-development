-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 10, 2023 at 09:42 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

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

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `contact_id` int NOT NULL,
  `first_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` text NOT NULL,
  `phone` int NOT NULL,
  `address` text NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`contact_id`),
  UNIQUE KEY `first_name` (`first_name`,`last_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `date_of_birth` date NOT NULL,
  `registration_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `gender` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` enum('active','Inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`user_id`, `username`, `first_name`, `last_name`, `password`, `email`, `date_of_birth`, `registration_date_time`, `gender`, `status`) VALUES
(1, 'yuhanyuan0802', 'yu', 'hanyuan', '123456', '1@gmail.com', '2023-07-05', '2023-07-10 16:19:00', 'male', 'active'),
(2, 'sinkuan123', 'lim', 'sinkuan', '123456', 'sinkuan@gmail.com', '2023-07-04', '2023-07-10 16:25:00', 'male', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `price` double NOT NULL,
  `promote_price` float NOT NULL,
  `manufacture_date` datetime NOT NULL,
  `expired_date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
