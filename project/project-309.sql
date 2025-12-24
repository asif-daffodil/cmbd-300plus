-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2025 at 05:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-309`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `amount`, `address`, `status`, `transaction_id`, `currency`, `created_at`) VALUES
(1, 'John Doe', 'john.doe@email.com', '01711111111', 0, 'Dhaka', 'Pending', 'SSLCZ_TEST_69482b28ee6dd', 'BDT', '2025-12-24 16:46:29'),
(2, 'John Doe', 'john.doe@email.com', '01711111111', 777065, 'Dhaka', 'Pending', 'SSLCZ_TEST_69482c5e2bea6', 'BDT', '2025-12-24 16:46:29'),
(3, 'John Doe', 'john.doe@email.com', '01711111111', 777065, 'Dhaka', 'Pending', 'SSLCZ_TEST_69482ce71fb79', 'BDT', '2025-12-24 16:46:29'),
(4, 'Asif Mohammad Abir', 'asif.abir@hotmail.com', '01711111111', 60000, '9 Sher-E-Bangla Road', 'Pending', 'SSLCZ_TEST_69482e7da3734', 'BDT', '2025-12-24 16:46:29'),
(5, 'John Zaman', 'aoulad1508@gmail.com', '06136687785', 62500, '413 Atkins Ave', 'Pending', 'SSLCZ_TEST_69482efe0a251', 'BDT', '2025-12-24 16:46:29'),
(6, 'John Zaman', 'aoulad1508@gmail.com', '06136687785', 55000, '413 Atkins Ave', 'Pending', 'SSLCZ_TEST_69482f3663266', 'BDT', '2025-12-24 16:46:29'),
(7, 'John Zaman', 'aoulad1508@gmail.com', '06136687785', 62500, '413 Atkins Ave', 'Pending', 'SSLCZ_TEST_69482f6c8d20f', 'BDT', '2025-12-24 16:46:29');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `description`, `created_at`) VALUES
(1, 'Asus 1990s', 60000, './uploads/products/laptop1.webp', 'he ASUS Model 1990 is a sleek and reliable laptop designed for everyday productivity. It features smooth performance for browsing, studying, and office tasks. With its lightweight build, it’s easy to carry anywhere. Overall, the ASUS 1990 is a solid choice for users who need a dependable device at an affordable price.', '2025-12-03 17:26:35'),
(2, 'HP Probook 2310', 65000, './uploads/products/laptop2.webp', 'The HP ProBook 2310 is a durable and professional notebook built for work and study. Its performance is smooth enough for multitasking, office tools, and online activities. The laptop’s sturdy design makes it reliable for long-term daily use. Overall, the ProBook 2310 offers a balanced mix of practicality and value.', '2025-12-03 17:33:01'),
(3, 'Lenevo 20225', 55000, './uploads/products/laptop3.webp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-12-07 16:29:06'),
(4, 'Dell 1003s', 62500, './uploads/products/laptop4.webp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-12-07 16:29:51'),
(5, 'Samsung', 55750, './uploads/products/laptop5.webp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-12-07 16:30:36'),
(7, 'Del 2222', 22222, './uploads/products/laptop3.webp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-12-14 16:50:37'),
(8, 'Asus 4200', 42000, './uploads/products/laptop2.webp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-12-14 16:51:47'),
(9, 'Asus 6545', 654565, './uploads/products/laptop4.webp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-12-14 16:52:04'),
(10, 'Lenevo Danger', 652565, './uploads/products/laptop1.webp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-12-14 16:52:39'),
(11, 'Hp p100', 75000, './uploads/products/laptop5.webp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-12-14 16:53:13'),
(12, 'Del d500', 70000, './uploads/products/laptop3.webp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-12-14 16:53:32'),
(13, 'Del N20', 65000, './uploads/products/laptop4.webp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-12-14 16:53:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` enum('user','admin','','') NOT NULL DEFAULT 'user',
  `gender` enum('male','female','others','') DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `password`, `image`, `role`, `gender`, `address`, `created_at`) VALUES
(1, 'Asif', 'asif@gmail.com', NULL, '$2y$10$v/iT0/zUVIaXjs5UKk/diOsL8e3v/44.j2U2KqG/M8FejlDXcM1N.', './uploads/images/d204e360e7d6f5a2126a5c70a5474a62.png', 'admin', NULL, NULL, '2025-11-26 17:21:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
