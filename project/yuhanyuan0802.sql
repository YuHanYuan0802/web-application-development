-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2023 at 11:02 AM
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(20) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `password` text NOT NULL,
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
(1, 'yuhanyuan', 'yu', 'hanhan', '$2y$10$qaSjHdXR1Vweix.kb2FjXewTHUYKa78RUy6XIWSyxANKgHGth/MdW', 'yu@gmail.com', '2023-07-25', '2023-07-25 12:08:00', 'male', 'active'),
(2, 'limsinkuan', 'lim', 'sinkuan', '$2y$10$kvq2zkbC7iwJdL/68MOIS.NI6bHwWTK5Ltk3eY2B1OCUJGrZ18aMa', 'lim@gmail.com', '2023-07-25', '2023-07-30 13:56:23', 'male', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2),
(3, 2, 3, 3),
(4, 3, 2, 2),
(5, 3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_summary`
--

CREATE TABLE `order_summary` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_summary`
--

INSERT INTO `order_summary` (`order_id`, `customer_id`, `order_date`) VALUES
(1, 1, '2023-07-24 04:29:58'),
(2, 1, '2023-07-24 04:30:36'),
(3, 2, '2023-08-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `promote_price` float NOT NULL,
  `manufacture_date` datetime NOT NULL,
  `expired_date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

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
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_summary`
--
ALTER TABLE `order_summary`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_summary`
--
ALTER TABLE `order_summary`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
