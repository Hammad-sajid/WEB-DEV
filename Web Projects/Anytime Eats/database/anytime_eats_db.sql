-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 07:30 PM
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
-- Database: `anytime_eats_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `item_id` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `price` int(8) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`item_id`, `name`, `category`, `quantity`, `price`, `description`, `image`) VALUES
('mc-cb', 'Chicken Briyani', 'main course', 10, 250, 'Delicious chicken biryani ', 'img\\chicken-biryani.jpg'),
('mc-ck', 'Chicken Karahi', 'main course', 10, 1200, 'Tasty chicken karahi ', 'img\\chicken-karahi.jpg'),
('mc-cp', 'Chicken Pulao', 'main course', 10, 250, 'Home like chicken pulao', 'img\\chicken-pulao.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `otp_storage`
--

CREATE TABLE `otp_storage` (
  `oid` int(11) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `otp` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp_storage`
--

INSERT INTO `otp_storage` (`oid`, `email`, `phone`, `otp`, `created_at`, `expiration`) VALUES
(12, 'Hammad.sajid1308@gmail.com', NULL, 206482, '2024-05-26 18:11:39', '2024-05-26 20:41:39'),
(13, '', '03475292023', 822188, '2024-05-26 18:12:06', '2024-05-26 20:42:06'),
(14, 'Hammad.sajid1308@gmail.com', NULL, 529501, '2024-05-26 18:24:50', '2024-05-26 20:54:50'),
(15, '', '03475292023', 212768, '2024-05-26 18:27:12', '2024-05-26 20:57:12'),
(16, 'Hammad.sajid1308@gmail.com', NULL, 739281, '2024-05-26 20:15:49', '2024-05-26 22:45:49'),
(17, '', '03475292023', 544589, '2024-05-26 20:16:31', '2024-05-26 22:46:31'),
(18, '', '03475292023', 101572, '2024-05-26 20:20:40', '2024-05-26 22:50:40'),
(19, '', '03475292023', 160850, '2024-05-26 20:29:46', '2024-05-26 22:59:46'),
(20, 'Hammad.sajid1308@gmail.com', NULL, 217956, '2024-05-26 20:40:12', '2024-05-26 23:10:12'),
(21, '', '923475292023', 743604, '2024-05-26 20:41:03', '2024-05-26 23:11:03'),
(22, '', '923475292023', 963290, '2024-05-26 20:44:30', '2024-05-26 23:14:30'),
(23, '', '923475292023', 454870, '2024-05-26 20:45:54', '2024-05-26 23:15:54'),
(24, '', '923475292023', 905269, '2024-05-26 20:49:04', '2024-05-26 23:19:04'),
(25, '', NULL, 725894, '2024-05-27 07:23:43', '2024-05-27 09:53:43'),
(26, 'Hammad.sajid1308@gmail.com', NULL, 951312, '2024-05-27 07:27:08', '2024-05-27 09:57:08'),
(27, 'Hammad.sajid1308@gmail.com', NULL, 364564, '2024-05-27 07:50:53', '2024-05-27 10:20:53'),
(28, 'Hammad.sajid1308@gmail.com', NULL, 788828, '2024-05-27 07:50:55', '2024-05-27 10:20:55'),
(29, 'Hammad.sajid1308@gmail.com', NULL, 948207, '2024-05-27 07:50:56', '2024-05-27 10:20:56'),
(30, 'Hammad.sajid1308@gmail.com', NULL, 947580, '2024-05-27 07:50:57', '2024-05-27 10:20:57'),
(31, 'Hammad.sajid1308@gmail.com', NULL, 707011, '2024-05-27 07:50:57', '2024-05-27 10:20:57'),
(32, 'Hammad.sajid1308@gmail.com', NULL, 767258, '2024-05-27 07:50:59', '2024-05-27 10:20:59'),
(33, 'Hammad.sajid1308@gmail.com', NULL, 426440, '2024-05-27 07:51:13', '2024-05-27 10:21:13'),
(34, 'Hammad.sajid1308@gmail.com', NULL, 684257, '2024-05-27 07:51:21', '2024-05-27 10:21:21'),
(35, 'Hammad.sajid1308@gmail.com', NULL, 527363, '2024-05-27 08:49:43', '2024-05-27 11:19:43'),
(36, 'Hammad.sajid1308@gmail.com', NULL, 805111, '2024-05-27 09:00:44', '2024-05-27 11:30:44'),
(37, 'Hammad.sajid1308@gmail.com', NULL, 501167, '2024-05-29 04:11:42', '2024-05-29 06:41:42'),
(38, 'ahsanjawad70@gmail.com', NULL, 408945, '2024-05-29 06:50:13', '2024-05-29 09:20:13'),
(39, '', '03468687255', 924785, '2024-05-29 06:53:01', '2024-05-29 09:23:01'),
(40, 'hassanglzar484@gmail.com', NULL, 257623, '2024-05-29 08:31:04', '2024-05-29 11:01:04'),
(41, '', '03028356758', 130736, '2024-05-29 08:34:24', '2024-05-29 11:04:24'),
(42, 'Hammad.sajid1308@gmail.com', NULL, 581975, '2024-05-29 09:10:33', '2024-05-29 11:40:33'),
(43, '', '03475292023', 407059, '2024-05-29 09:13:30', '2024-05-29 11:43:30'),
(44, 'hassangulzar484@gmail.com', NULL, 700608, '2024-05-29 09:31:17', '2024-05-29 12:01:17'),
(45, '', '03028356758', 341986, '2024-05-29 09:32:46', '2024-05-29 12:02:46'),
(46, 'fadishah.1457@gmail.com', NULL, 455116, '2024-05-31 07:17:13', '2024-05-31 09:47:13'),
(47, '', '923475292023', 281861, '2024-05-31 07:18:36', '2024-05-31 09:48:36'),
(48, 'fadishah.1457@gmail.com', NULL, 377910, '2024-05-31 07:23:43', '2024-05-31 09:53:43');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `rid` bigint(15) NOT NULL,
  `tid` varchar(15) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_time` datetime NOT NULL,
  `people` varchar(15) NOT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`rid`, `tid`, `name`, `email`, `date_time`, `people`, `message`) VALUES
(1, 'fm-1', 'hammad sajid', 'Hammad.sajid1308@gmail.com', '2024-05-28 13:38:00', '8', ''),
(2, 'fm-2', 'ahmed', 'hooney.khan7@gmail.com', '2024-05-28 13:38:00', '6', ''),
(3, 'fm-3', 'ali', 'hassangulzar484@gmail.com', '2024-05-29 19:00:00', '4', ''),
(4, 'fd-1', 'hammad sajid', 'Hammad.sajid1308@gmail.com', '2024-05-28 13:38:00', '4', ''),
(5, 'fd-1', 'hammad sajid', 'Hammad.sajid1308@gmail.com', '2024-05-28 14:30:00', '6', ''),
(6, 'fm-1', 'Hammad Sajid', 'Hammad.sajid1308@gmail.com', '2024-05-28 17:55:00', '8', ''),
(7, 'fd-1', 'ali', 'hooney.khan7@gmail.com', '2024-05-28 17:58:00', '4', ''),
(8, 'cp-1', 'hammad sajid', 'Hammad.sajid1308@gmail.com', '2024-05-28 18:01:00', '2', ''),
(9, 'fm-2', 'ahmed', 'hooney.khan7@gmail.com', '2024-05-28 18:48:00', '6', ''),
(12, 'fd-1', 'hammad sajid', 'Hammad.sajid1308@gmail.com', '2024-05-28 22:39:00', '4', ''),
(13, 'fd-2', 'ahmed', 'Hammad.sajid1308@gmail.com', '2024-05-28 22:57:00', '6', ''),
(14, 'fm-1', 'hammad sajid', 'Hammad.sajid1308@gmail.com', '2024-05-30 18:30:00', '8', ''),
(15, 'fd-2', 'Fahad', 'fadishah.1457@gmail.com', '2024-06-01 19:20:00', '6', '');

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_jobs`
--

CREATE TABLE `scheduled_jobs` (
  `id` int(11) NOT NULL,
  `tid` varchar(15) NOT NULL,
  `schedule_datetime` datetime NOT NULL,
  `action` enum('update_availability') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scheduled_jobs`
--

INSERT INTO `scheduled_jobs` (`id`, `tid`, `schedule_datetime`, `action`) VALUES
(13, 'fd-2', '2024-06-02 01:20:00', 'update_availability');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `tid` varchar(15) NOT NULL,
  `t_type` varchar(50) NOT NULL,
  `availability` enum('available','reserved') DEFAULT 'available',
  `num_seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`tid`, `t_type`, `availability`, `num_seats`) VALUES
('cp-1', 'couple', 'available', 2),
('cp-2', 'couple', 'available', 2),
('fd-1', 'friends', 'available', 4),
('fd-2', 'friends', 'reserved', 6),
('fm-1', 'family', 'available', 8),
('fm-2', 'family', 'available', 8),
('fm-3', 'family', 'available', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` bigint(12) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `email`, `password`, `phone`, `address`) VALUES
(26, 'hamza', 'hooney.khan7@gmail.com', '$2y$10$0G9p.CcHP4JjgulSOEMe8.y7y5TKyXW7ytJhiO.uH2rB.iSjiDDFG', NULL, NULL),
(49, 'jawad', 'ahsanjawad70@gmail.com', '$2y$10$6z8LSbFYdSXY1v1nYJWgsucVBY7ic6L3EQzBs4sUWVoZXuyBE4qfm', '03468687255', 'allabad rawalpindi'),
(50, 'hassan', 'hassanglzar484@gmail.com', '$2y$10$lJKajwnIfKcACJrcHZzEeuXWrh.vTT3oZEmCQWF7lW3AkYZLeJ3Ry', '03028356758', ''),
(51, 'hammad', 'Hammad.sajid1308@gmail.com', '$2y$10$aZ3KcDqXl9toyn7sHI8HMugcJ365Nx.PrTp6VCKn4ewyi5MLAXnly', '03475292023', 'Street#158/E, Gulshanabad, Adyala road'),
(52, 'hasan', 'hassangulzar484@gmail.com', '$2y$10$aF0fY.qXbn3mfOAlM9S8sOP1J8IUadV7qTZ/TtioMQc0LoytjQk/O', '03028356758', NULL),
(53, 'Fahad', 'fadishah.1457@gmail.com', '$2y$10$sZnouS6umaudyvoVVptSDuTWZeQNOpomshZ2/VuxIz4e1Ulbqw1C6', '923475292023', 'gulshan Abad rawalpindi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `otp_storage`
--
ALTER TABLE `otp_storage`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `fk_tid` (`tid`);

--
-- Indexes for table `scheduled_jobs`
--
ALTER TABLE `scheduled_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tid` (`tid`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `otp_storage`
--
ALTER TABLE `otp_storage`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `rid` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `scheduled_jobs`
--
ALTER TABLE `scheduled_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` bigint(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_tid` FOREIGN KEY (`tid`) REFERENCES `tables` (`tid`),
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `tables` (`tid`);

--
-- Constraints for table `scheduled_jobs`
--
ALTER TABLE `scheduled_jobs`
  ADD CONSTRAINT `scheduled_jobs_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `tables` (`tid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
