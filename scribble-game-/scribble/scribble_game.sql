-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 18, 2025 at 02:18 PM
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
-- Database: `scribble_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `player_name` varchar(50) NOT NULL,
  `room_id` int(11) NOT NULL CHECK (`room_id` between 10000 and 99999),
  `score` int(11) DEFAULT 0,
  `is_drawer` tinyint(1) DEFAULT 0,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `player_name`, `room_id`, `score`, `is_drawer`, `joined_at`) VALUES
(1, 'tg', 25828, 0, 0, '2025-07-18 04:49:09'),
(2, 'bg', 25828, 0, 0, '2025-07-18 05:47:29');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_code` int(10) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `total_time` int(11) NOT NULL,
  `round_time` int(11) NOT NULL,
  `game_started` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `current_word` varchar(100) DEFAULT NULL,
  `current_drawer` varchar(100) DEFAULT NULL,
  `round_number` int(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_code`, `room_name`, `total_time`, `round_time`, `game_started`, `created_at`, `current_word`, `current_drawer`, `round_number`, `start_time`, `end_time`) VALUES
(1, 25828, 'was-1', 50, 80, 2, '2025-07-17 06:16:45', NULL, NULL, NULL, NULL, '2025-07-17 11:16:45'),
(2, 69546, 'was-0', 50, 80, 0, '2025-07-17 06:27:07', NULL, NULL, NULL, NULL, '2025-07-17 11:27:07'),
(3, 65459, 'was-1', 50, 80, 2, '2025-07-17 06:27:43', NULL, NULL, NULL, NULL, '2025-07-17 11:27:43'),
(4, 43177, 'was-2', 0, 0, 2, '2025-07-17 06:44:02', NULL, NULL, NULL, NULL, '2025-07-17 12:14:02'),
(5, 91860, 'was-1', 50, 70, 0, '2025-07-17 07:13:41', NULL, NULL, NULL, NULL, '2025-07-17 12:13:41'),
(6, 85947, 'was-2', 50, 70, 0, '2025-07-17 07:19:27', NULL, NULL, NULL, NULL, '2025-07-17 12:19:27'),
(7, 99087, 'was-0', 50, 70, 0, '2025-07-17 07:19:57', NULL, NULL, NULL, NULL, '2025-07-17 12:19:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_code` (`room_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
