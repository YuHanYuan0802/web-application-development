-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 31, 2023 at 08:23 AM
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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `description`) VALUES
(1, 'Sport equipment', 'Balls, racket, dump bell, etc'),
(2, 'Food', 'Main dish or side dish'),
(3, 'Beverage', 'Soft drink, juices, wine, etc'),
(4, 'Electronic devices', 'Earphone, tracking devices, phone, etc.'),
(5, 'Daily items', 'Item used in daily life like furniture, personal items, decorations, etc.'),
(6, 'Music', 'Sound that can be played.'),
(7, 'Movie', 'Recording of moving images that tells a story.'),
(8, 'Game', 'Can be played by people.');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `contact_id` int NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
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
  `username` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `date_of_birth` date NOT NULL,
  `registration_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `gender` enum('male','female') NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`user_id`, `username`, `first_name`, `last_name`, `password`, `email`, `date_of_birth`, `registration_date_time`, `gender`, `status`) VALUES
(1, 'yuhanyuan', 'yu', 'hanhan', '$2y$10$qaSjHdXR1Vweix.kb2FjXewTHUYKa78RUy6XIWSyxANKgHGth/MdW', 'yu@gmail.com', '2023-07-25', '2023-07-25 12:08:00', 'male', 'active'),
(2, 'limsinkuan', 'lim', 'sinkuan', '$2y$10$kvq2zkbC7iwJdL/68MOIS.NI6bHwWTK5Ltk3eY2B1OCUJGrZ18aMa', 'lim@gmail.com', '2023-07-25', '2023-07-30 13:56:23', 'male', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE IF NOT EXISTS `order_detail` (
  `order_detail_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`order_detail_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2),
(3, 2, 3, 3),
(4, 3, 1, 2),
(5, 3, 2, 2),
(6, 4, 1, 1),
(7, 4, 2, 1),
(8, 5, 1, 2),
(9, 6, 1, 3),
(10, 6, 2, 4),
(11, 7, 2, 2),
(12, 7, 3, 3),
(13, 8, 2, 2),
(14, 8, 3, 3),
(15, 9, 1, 1),
(16, 9, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_summary`
--

DROP TABLE IF EXISTS `order_summary`;
CREATE TABLE IF NOT EXISTS `order_summary` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `order_date` datetime NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_summary`
--

INSERT INTO `order_summary` (`order_id`, `customer_id`, `order_date`) VALUES
(1, 1, '2023-07-24 04:29:58'),
(2, 1, '2023-07-24 04:30:36'),
(3, 2, '2023-07-31 02:55:46'),
(4, 1, '2023-07-31 03:26:34'),
(5, 2, '2023-07-31 03:28:01'),
(6, 1, '2023-07-31 03:53:09'),
(7, 1, '2023-07-31 03:57:07'),
(8, 1, '2023-07-31 03:57:07'),
(9, 2, '2023-07-31 03:59:09');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `category_id` int NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `promote_price` float NOT NULL,
  `manufacture_date` datetime NOT NULL,
  `expired_date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `description`, `price`, `promote_price`, `manufacture_date`, `expired_date`, `created`, `modified`) VALUES
(1, 'Basketball', 1, 'A ball used in the NBA.', 49.98, 40, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-08-02 12:04:03', '2023-07-22 06:16:45'),
(2, 'Gatorade', 3, 'This is a very good drink for athletes.', 1.99, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-08-02 12:14:29', '2023-07-22 06:16:52'),
(3, 'Eye Glasses', 5, 'It will make you read better.', 6, 5.5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-08-02 12:15:04', '2023-07-22 06:17:01'),
(4, 'Trash Can', 5, 'It will help you maintain cleanliness.', 3.95, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-08-02 12:16:08', '2023-07-22 06:17:16'),
(5, 'Mouse', 4, 'Very useful if you love your computer.', 11.35, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-08-02 12:17:58', '2023-07-22 06:17:24'),
(6, 'Earphone', 4, 'You need this one if you love music.', 7, 6.7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-08-02 12:18:21', '2023-07-22 06:17:34'),
(7, 'Pillow', 5, 'Sleeping well is important.', 8.99, 7.99, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-08-02 12:18:56', '2023-07-22 06:19:06'),
(8, 'Coca cola', 3, 'Soft drink', 5, 2.5, '2023-07-07 00:00:00', '2023-07-17 00:00:00', '2023-07-17 08:25:43', '2023-07-17 08:25:43'),
(9, 'Pepsi', 3, 'Soft drink', 4, 2, '2023-07-13 00:00:00', '2023-07-17 00:00:00', '2023-07-17 08:27:24', '2023-07-17 08:27:24');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_summary` (`order_id`),
  ADD CONSTRAINT `order_detail_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `order_summary`
--
ALTER TABLE `order_summary`
  ADD CONSTRAINT `order_summary_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`user_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
