-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2025 at 09:04 AM
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
-- Database: `soil_farming`
--

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

CREATE TABLE `distributors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `crops_supplied` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distributors`
--

INSERT INTO `distributors` (`id`, `name`, `location`, `contact`, `crops_supplied`, `created_at`) VALUES
(3, 'ADIDHAN', 'mulki', '8867315102', 'jh', '2025-08-20 12:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `action`, `timestamp`) VALUES
(1, 2, 'User logged in', '2025-08-19 13:01:40'),
(2, 3, 'User logged in', '2025-08-19 13:02:14'),
(3, 2, 'User logged in', '2025-08-19 13:06:56'),
(4, 2, 'User logged in', '2025-08-20 05:53:45'),
(5, 4, 'User logged in', '2025-08-20 06:14:04'),
(6, 2, 'User logged in', '2025-08-20 06:20:06'),
(7, 4, 'User logged in', '2025-08-20 06:20:21'),
(8, 4, 'User logged in', '2025-08-20 06:27:56'),
(9, 4, 'User logged in', '2025-08-20 06:29:11'),
(10, 4, 'User logged in', '2025-08-20 06:30:59'),
(11, 4, 'User logged in', '2025-08-20 06:42:33'),
(12, 4, 'User logged in', '2025-08-20 07:18:24'),
(13, 2, 'User logged in', '2025-08-20 07:25:46'),
(14, 2, 'User logged in', '2025-08-20 07:26:02'),
(15, 2, 'User logged in', '2025-08-20 07:31:43'),
(16, 4, 'User logged in', '2025-08-20 11:54:49'),
(17, 2, 'User logged in', '2025-08-20 11:56:07'),
(18, 2, 'Added distributor: c', '2025-08-20 12:05:19'),
(19, 2, 'Deleted distributor ID: 2', '2025-08-20 12:05:21'),
(20, 4, 'User logged in', '2025-08-20 12:06:39'),
(21, 2, 'User logged in', '2025-08-20 12:07:13'),
(22, 4, 'User logged in', '2025-08-20 12:10:48'),
(23, 3, 'User logged in', '2025-08-20 12:13:40'),
(24, 4, 'User logged in', '2025-08-20 12:30:16'),
(25, 2, 'User logged in', '2025-08-20 12:30:46'),
(26, 2, 'Added distributor: ADIDHAN', '2025-08-20 12:31:26'),
(27, 2, 'Updated distributor ID: 3', '2025-08-20 12:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `soil`
--

CREATE TABLE `soil` (
  `id` int(11) NOT NULL,
  `soil_type` varchar(100) NOT NULL,
  `characteristics` text NOT NULL,
  `suitable_crops` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soil`
--

INSERT INTO `soil` (`id`, `soil_type`, `characteristics`, `suitable_crops`, `created_at`) VALUES
(2, 'alluvial', '3d', '344,rffd', '2025-08-19 11:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin User', 'admin@example.com', '$2y$10$6J4i9jrmR0r8bdyM5u5E6ex87Pnbf0oOIf7pFlTvDumQ5n7v8z8tW', 'admin', '2025-08-19 10:50:13'),
(2, 'Hithesh Y Salian', 'hithesh021@gmail.com', '$2y$10$ZrElMoreaCZWrTi/loaxp.Wq9vjSFJO337dQrrEnEzQNoi9cpImbC', 'admin', '2025-08-19 10:51:10'),
(3, 'sac', 'hithesh2106@gmail.com', '$2y$10$SOJqFcfslqsuPX.v/IwA/uJZ3OfbIiag.Mq/OIf7k1mUfRtK/8/RW', 'user', '2025-08-19 13:02:02'),
(4, 'ADIDHAN', 'mulki.sachin@gmail.com', '$2y$10$r2RQlxRHz2kut8TmYwL3UO3CwPhnWNE3iP6U3bgtAxh8a3he2mWwm', 'user', '2025-08-20 06:07:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `distributors`
--
ALTER TABLE `distributors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `soil`
--
ALTER TABLE `soil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `distributors`
--
ALTER TABLE `distributors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `soil`
--
ALTER TABLE `soil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
