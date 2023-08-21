-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 21, 2023 at 08:57 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

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
(8, 'Toy', 'Make for children.');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'default_user.png',
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`user_id`, `username`, `image`, `first_name`, `last_name`, `password`, `email`, `date_of_birth`, `registration_date_time`, `gender`, `status`) VALUES
(1, 'yuhanyuan', 'default_user.png', 'yu', 'hanhan', '$2y$10$qaSjHdXR1Vweix.kb2FjXewTHUYKa78RUy6XIWSyxANKgHGth/MdW', 'yu@gmail.com', '2023-07-25', '2023-07-25 12:08:00', 'male', 'active'),
(2, 'limsinkuan', 'default_user.png', 'lim', 'sinkuan', '$2y$10$kvq2zkbC7iwJdL/68MOIS.NI6bHwWTK5Ltk3eY2B1OCUJGrZ18aMa', 'lim@gmail.com', '2023-07-25', '2023-07-30 13:56:23', 'male', 'active'),
(3, 'haw123', 'default_user.png', 'Haw', 'EngEng', '$2y$10$azfP2yf426md46tNF.Umj.WPKLLm0nr7YBaJAoROBsWzXPRs16ueG', 'haw@gmail.com', '2002-01-01', '2023-08-18 23:45:00', 'male', 'active'),
(4, 'KienMing123', 'default_user.png', 'Tan', 'KienMing', '$2y$10$REtzKxkS.xgi7oyqKwsD6OdxKVDDkUsptOuTYoWW0ZtJUetyBe0de', 'kienming@gmail.com', '2002-01-01', '2023-08-21 16:06:44', 'male', 'inactive');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2),
(3, 2, 3, 3),
(4, 3, 2, 2),
(5, 3, 3, 3),
(6, 4, 6, 6),
(7, 4, 8, 8),
(8, 5, 8, 8),
(9, 5, 4, 4),
(10, 6, 1, 1),
(17, 7, 11, 1),
(18, 7, 8, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_summary`
--

INSERT INTO `order_summary` (`order_id`, `customer_id`, `order_date`) VALUES
(1, 1, '2023-07-24 04:29:58'),
(2, 1, '2023-07-24 04:30:36'),
(3, 2, '2023-08-06 06:21:09'),
(4, 1, '2023-08-13 14:48:16'),
(5, 2, '2023-08-13 14:52:00'),
(6, 3, '2023-08-21 13:34:00'),
(7, 4, '2023-08-21 15:50:00');

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
  `image` varchar(100) CHARACTER SET utf8mb4 NOT NULL DEFAULT '"product_image_coming_soon.jpg"',
  `price` double NOT NULL,
  `promote_price` float NOT NULL,
  `manufacture_date` date NOT NULL,
  `expired_date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `description`, `image`, `price`, `promote_price`, `manufacture_date`, `expired_date`, `created`, `modified`) VALUES
(1, 'Basketball', 1, 'A ball used in the NBA.', 'ed7ad76e18c25d636476987c146a6126ec77afe4-basketball.jpg', 49.98, 40, '2022-05-12', '0000-00-00', '2015-08-02 12:04:03', '2023-08-21 07:07:31'),
(2, 'Gatorade', 3, 'This is a very good drink for athletes.', '53d89d4c72810ccd7eb37829efa6472953b6bc57-gatorade.jpg', 1.99, 1, '2023-08-13', '2024-08-14', '2015-08-02 12:14:29', '2023-08-15 02:27:40'),
(3, 'Eye Glasses', 5, 'It will make you read better.', '6c88630487456ab97a4131099f39bb0056f1c651-glasses.jpg', 6, 5.5, '2022-10-15', '0000-00-00', '2015-08-02 12:15:04', '2023-08-15 02:28:41'),
(4, 'Trash Can', 5, 'It will help you maintain cleanliness.', '5587ecc2a5a7066631b3c1d3ec00fb337d936635-trashcan.jpg', 3.95, 2, '2022-06-10', '0000-00-00', '2015-08-02 12:16:08', '2023-08-15 02:29:39'),
(5, 'Mouse', 4, 'Very useful if you love your computer.', '90b01134caa6cb714d4623840d45f9a539d1ec79-mouse.jpg', 11.35, 10, '2023-12-01', '0000-00-00', '2015-08-02 12:17:58', '2023-08-15 02:30:14'),
(6, 'Earphone', 4, 'You need this one if you love music.', '784acfe8121f68ae9be74228322099e3590692ad-earphone.jpg', 7, 6.7, '2021-07-23', '0000-00-00', '2015-08-02 12:18:21', '2023-08-15 02:30:47'),
(7, 'Pillow', 5, 'Sleeping well is important.', 'fefb917abedce543dc99cbe086c6ee4ebefb7353-pillow.jpg', 8.99, 7.99, '2022-05-20', '0000-00-00', '2015-08-02 12:18:56', '2023-08-15 02:31:25'),
(8, 'Coca cola', 3, 'Soft drink', 'd59980a5da135146fdceb31fe3de8feda53ee127-cocacola.jpg', 5, 2.5, '2023-07-07', '2023-07-17', '2023-07-17 08:25:43', '2023-08-15 02:32:31'),
(9, 'Pepsi', 3, 'A soft drink alternative of Coca Cola.', 'e14075ec8b1c8722b02c737181ff3365f227361e-pepsi.jpg', 2.5, 2, '2022-01-13', '2024-01-28', '2023-08-13 09:46:48', '2023-08-15 02:33:02'),
(10, 'French Fry', 2, 'Make from Potato', '7dc4220ed4c2c3b1c5068053df13529c21888d3f-d6cf3640302554ca2130ddcba02b1efcdf49e2a1-french_fries.jpg', 5.99, 4, '2020-01-20', '2024-03-22', '2023-08-15 03:56:39', '2023-08-18 15:22:04'),
(11, 'Chicken Wing', 2, 'Chicken from organic farm.', 'product_image_coming_soon.jpg', 19, 15, '2022-07-21', '2024-06-28', '2023-08-21 05:22:25', '2023-08-21 07:32:06'),
(12, 'Table', 5, 'Make from sturdy wood.', 'product_image_coming_soon.jpg', 55, 0, '2023-08-21', '2023-09-07', '2023-08-21 08:17:21', '2023-08-21 08:17:21');

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
