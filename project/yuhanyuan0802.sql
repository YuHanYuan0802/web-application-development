-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2023 at 07:08 PM
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
(1, 'Processor', 'The processor is a circuit that performs all of the calculations needed to run the computer.'),
(2, 'Motherboard', 'A motherboard is the main printed circuit board (PCB) in a computer.'),
(3, 'Power Supply', 'A power supply is an electrical device that supplies electric power to an electrical load.'),
(4, 'Graphics Card', 'The graphics card, also known as Graphics Processing Unit (GPU), is responsible for calculating images in a computer, which can then be displayed on a monitor.'),
(5, 'CPU Cooler', 'A component that draws heat away from a CPU chip.'),
(6, 'RAM', 'RAM is the main memory in a computer.'),
(7, 'Storage', 'The storage keep the all the data for long term.'),
(8, 'Case', 'ATX form factor pc case'),
(9, 'Others', 'Beside pc accessories like furniture.');

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
  `image` varchar(100) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `date_of_birth` date NOT NULL,
  `registration_date_time` datetime NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`user_id`, `username`, `image`, `first_name`, `last_name`, `password`, `email`, `date_of_birth`, `registration_date_time`, `gender`, `status`) VALUES
(1, 'yuhanyuan', 'default_user.png', 'yu', 'hanhan', '$2y$10$agVXb3XqRLW37ZSrvJrZGupCKle.mJ32YsegiUVlWfV7OYsckZChq', 'yu@gmail.com', '2022-07-21', '2023-08-24 17:08:39', 'male', 'active'),
(2, 'limsinkuan', 'default_user.png', 'lim', 'sinkuan', '$2y$10$kvq2zkbC7iwJdL/68MOIS.NI6bHwWTK5Ltk3eY2B1OCUJGrZ18aMa', 'lim@gmail.com', '2023-07-25', '2023-07-30 13:56:23', 'male', 'active'),
(3, 'haw123', 'default_user.png', 'Haw', 'EngEng', '$2y$10$azfP2yf426md46tNF.Umj.WPKLLm0nr7YBaJAoROBsWzXPRs16ueG', 'haw@gmail.com', '2002-01-01', '2023-08-18 23:45:00', 'male', 'active'),
(4, 'KienMing123', 'default_user.png', 'Tan', 'KienMing', '$2y$10$REtzKxkS.xgi7oyqKwsD6OdxKVDDkUsptOuTYoWW0ZtJUetyBe0de', 'kienming@gmail.com', '2002-01-01', '2023-08-21 16:06:44', 'male', 'inactive'),
(5, 'Chow123', 'default_user.png', 'Chow', 'KuiHeng', '$2y$10$GJzTY1gH2XWyTFKmBCO9OeKmG3LaCuk4IgHYJYT6hTG0EBiWbwWLG', 'chow123@gmail.com', '2002-01-01', '2023-08-24 18:10:17', 'male', 'active'),
(6, 'chong123', 'default_user.png', 'Chong', 'Xukai', '$2y$10$HVILWSxdhDEb9mEuuvp38.gGhbETlgNeK8bqamLoO3BKMG3dDApFG', 'chong@gmail.com', '2002-01-01', '2023-08-28 14:52:03', 'male', 'inactive');

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
(2, 1, 4, 1),
(3, 1, 5, 1),
(4, 1, 7, 1),
(5, 1, 10, 1),
(6, 1, 11, 2),
(7, 1, 12, 1),
(8, 1, 13, 1),
(9, 2, 2, 1),
(10, 2, 3, 1),
(11, 2, 6, 1),
(12, 2, 8, 1),
(13, 2, 9, 1),
(14, 2, 11, 1),
(15, 2, 12, 1),
(16, 2, 13, 1),
(17, 3, 12, 1),
(18, 3, 11, 4),
(21, 4, 12, 2),
(22, 5, 11, 1),
(23, 5, 12, 1);

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
(1, 2, '2023-08-26 18:48:26'),
(2, 3, '2023-08-26 18:50:11'),
(3, 1, '2023-08-26 18:52:08'),
(4, 5, '2023-08-26 18:53:38'),
(5, 3, '2023-08-26 19:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `promote_price` float NOT NULL,
  `manufacture_date` date NOT NULL,
  `expired_date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `description`, `image`, `price`, `promote_price`, `manufacture_date`, `expired_date`, `created`, `modified`) VALUES
(1, 'Intel I9-13900KS', 1, 'The latest Intel processor.', '998e080a75ee32f6745f5de88cddf6952f816c48-intel-i9-139000.jpg', 3243, 3143, '2023-03-29', '2030-12-26', '2023-08-26 17:17:39', '2023-08-27 09:44:05'),
(2, 'AMD Ryzen 9 7950X3D', 1, 'The latest AMD processor.', '170a162c47bdd24699138e793cd52b62ea53c396-amd-ryzen-9-7950x3d.jpg', 3250, 2983, '2023-02-28', '2030-06-19', '2023-08-26 17:23:27', '2023-08-28 06:03:01'),
(3, 'MSI B550m-A Pro AMD motherboard', 2, 'The b550m motherboard for AMD socket.', 'd42052a627092f7842108e1894a659670e7f1be4-msi-b550m-amd.jpg', 499, 0, '2020-06-17', '2030-10-26', '2023-08-26 17:44:07', '2023-08-27 09:58:00'),
(4, 'MSI PRO B660-A LGA-1700 Intel socket', 2, 'The motherboard suitable for Intel\'s processor.', '5e8ba014b6f1d911f8812a8e8a768a872aef1eef-msi-b660-intel.jpg', 489, 0, '2022-08-03', '2030-06-14', '2023-08-26 17:52:15', '2023-08-26 09:52:15'),
(5, ' 1ST PLAYER STEAMPUNK PS-750SP 80Plus Gold Power Supply', 3, '750w power supply with full modular support.', '0f26d3b7a726057f0a71be37c5c9fd2e74dc1324-power-supply-750w.jpg', 499, 399, '2019-11-18', '2030-06-04', '2023-08-26 17:57:27', '2023-08-26 09:57:27'),
(6, 'Corsair CX Series 80-Plus Bronze Power-supply', 3, '750w power supply with half modular.', '873c94a4fd439cc0da82aeb54500b226b58c11b9-half-modular-750w-power-supply.jpg', 449, 0, '2016-11-03', '2030-06-21', '2023-08-26 18:05:02', '2023-08-26 10:05:02'),
(7, 'Asus Dual Geforce RTX-3060-v2 12GB', 4, 'Graphic card RTX-3060 with 12GB vram from Asus.', 'dddede398d05ebae8c8ea001e5dd277fc0da0bd9-asus-dual-rtx-3060-12gb.jpg', 1699, 1599, '2021-02-05', '2030-12-31', '2023-08-26 18:11:18', '2023-08-26 11:10:05'),
(8, 'Asus Amd Radeon Dual RX-6600-XT 8GB', 4, 'Graphic card from Asus features with 8GB vram.', '5453f1362f3934d5392cfae9fc456705dcbb8857-asus-dual-amd-rx6600-xt-8gb.jpg', 1723, 0, '2021-08-11', '2030-06-09', '2023-08-26 18:17:49', '2023-08-26 10:17:49'),
(9, 'MSI Core Frozr-s CPU cooler fan', 5, 'CPU cooler from MSI with air cooling technique suitable with AMD socket.', '64414c40be54d7cd8098bd364fddc6ff99fa7155-msi-frozrs-cpu-cooler.jpg', 320, 0, '2020-11-03', '2030-09-28', '2023-08-26 18:25:52', '2023-08-26 10:25:52'),
(10, 'ID-Cooling Auraflow-x Watercooling', 5, 'CPU cooler from ID-Cooling with water-cooling technique suitable with both AMD and Intel socket.', 'c772dc6e58b31f5323566eff2f23669a6530704a-id-cooling-auraflow-x-cpu-cooler.jpg', 329, 299, '2019-06-07', '2030-05-28', '2023-08-26 18:32:05', '2023-08-26 10:32:05'),
(11, 'Kingston HyperX-Fury DIMM RAM', 6, 'RAM stick suitable for desktop with 16GB RAM and DDR4 3200MHZ clock speed.', '46a09a9d21c5b3deb51f0aeed66dba84a893da43-kingston-hyper-x-16gb.jpg', 499, 399, '2021-03-24', '2030-05-05', '2023-08-26 18:39:53', '2023-08-26 10:39:53'),
(12, 'Western Digital 1TB WD Blue SN570', 7, 'SSD from Western Digital with 1TB storage space.', '99984a0b578225593a8a47a1905eada6f33c4080-wd-ssd-1tb.jpg', 239, 195, '2021-12-21', '2030-08-06', '2023-08-26 18:44:08', '2023-08-26 10:44:08'),
(13, '1ST Player TRILOBITE T3 Casing', 8, 'ATX Pc casing equipped with additional 4 cooling fan at top and side panel.', 'd2e2bef77cf1f8891c0d9862427b849e5b19efa6-1st-t3-case.jpg', 199, 0, '2022-09-02', '2030-07-09', '2023-08-26 18:48:04', '2023-08-26 10:48:04'),
(14, 'Wood Table', 9, 'Make from high quality wood.', 'product_image_coming_soon.jpg', 199, 0, '2022-09-02', '2030-09-07', '2023-08-26 19:11:05', '2023-08-26 11:11:05'),
(15, 'Secretlab TITAN Evo Gaming chair', 9, 'Gaming chair from Secretlab.', 'product_image_coming_soon.jpg', 2950, 2550, '2021-09-01', '2030-04-03', '2023-08-26 19:12:54', '2023-08-26 11:12:54'),
(16, 'Fantech vx7 Pro Gaming Mouse', 9, 'Gaming mouse from Fantech with highest 8400dpi and customizable side keys.', 'product_image_coming_soon.jpg', 85, 0, '2020-03-08', '2030-05-03', '2023-08-26 19:14:57', '2023-08-26 11:14:57'),
(17, 'Fantech membrane keyboard', 9, 'Membrane keyboard from Fantech with RGB.', 'product_image_coming_soon.jpg', 55, 0, '2020-05-05', '2030-06-06', '2023-08-26 19:15:54', '2023-08-26 11:15:54');

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
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_summary`
--
ALTER TABLE `order_summary`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
