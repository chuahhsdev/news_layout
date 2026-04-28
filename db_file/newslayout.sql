-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2026 at 10:06 AM
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
-- Database: `newslayout`
--

-- --------------------------------------------------------

--
-- Table structure for table `authentication`
--

CREATE TABLE `authentication` (
  `id` int(11) NOT NULL,
  `GUID` varchar(100) NOT NULL,
  `consent_date` datetime NOT NULL,
  `version` int(10) NOT NULL,
  `accepted` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authentication`
--

INSERT INTO `authentication` (`id`, `GUID`, `consent_date`, `version`, `accepted`) VALUES
(1, 'c99867a25ca9e632afefb83eab578e8f', '2026-04-27 12:03:20', 1, 'Y'),
(2, '7b81312b85d83092bff0e6ccac4011c2', '2026-04-27 16:24:26', 1, 'N'),
(3, 'd230b875d3d8e2407017079d2b0a3b07', '2026-04-27 16:25:47', 1, 'Y'),
(4, '4f143a82bcf7b2ad3b2a9f1e9fc644a6', '2026-04-28 15:51:27', 1, 'N'),
(5, '99d1d5ea11904b17eee39293d8ea5e20', '2026-04-28 16:03:08', 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `just_in`
--

CREATE TABLE `just_in` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `just_in`
--

INSERT INTO `just_in` (`id`, `title`, `created_at`) VALUES
(1, 'Heavy traffic reported on LDP following flash floods.', '2026-04-28 11:17:45'),
(2, 'Bank Negara maintains OPR at 3.00% amid stable outlook.', '2026-04-28 10:42:45'),
(3, 'Health Ministry to launch new nationwide vaccination drive.', '2026-04-28 10:27:45'),
(4, 'Local tech startup wins global innovation award in Paris.', '2026-04-28 10:02:45'),
(5, 'Public transport users urged to check new schedules.', '2026-04-28 09:17:45');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `is_main_story` varchar(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `summary`, `content`, `image`, `category`, `is_main_story`, `created_at`, `created_by`) VALUES
(1, 'Anwar Ibrahim Announces Fuel Prices 2026', 'KUALA LUMPUR: It appears that the Fuel Prices have changed yet again, with everyone complaining about the recent hike.', 'KUALA LUMPUR: Prime Minister Anwar Ibrahim announced today that fuel prices will be revised effective immediately. The new pricing structure affects RON95, RON97 and diesel. Citizens have expressed mixed reactions to the announcement.', 'petrol.jpg', 'NATION', 'Y', '2026-04-27 17:51:21', 1),
(2, 'Global markets rally as inflation cools down', '', '', '', 'BUSINESS', 'Y', '2026-04-27 16:51:21', 1),
(3, 'Tech: New silicon chip designed in Penang', '', '', '', 'TECHNOLOGY', 'Y', '2026-04-27 14:51:21', 1),
(4, 'Weather Alert: Flash floods warned in Klang Valley', '', '', '', 'NATION', 'Y', '2026-04-27 12:51:21', 1),
(5, 'Ringgit hits 6-month high against USD', 'The Malaysian Ringgit surged to a 6-month high against the US Dollar amid positive economic sentiment.', '', 'ringgit.jpg', 'STARBIZ', 'Y', '2026-04-27 15:51:21', 1),
(6, 'Oil prices stabilize amid supply shifts', 'Global oil prices have stabilized following weeks of volatility caused by shifting supply agreements.', '', 'oil.jpg', 'STARBIZ', 'Y', '2026-04-27 13:51:21', 1),
(7, 'Palm oil exports set to rise in Q3', 'Malaysian palm oil exports are projected to increase significantly in the third quarter of 2026.', '', 'palmoil.jpg', 'STARBIZ', 'Y', '2026-04-27 11:51:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authentication`
--
ALTER TABLE `authentication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `just_in`
--
ALTER TABLE `just_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authentication`
--
ALTER TABLE `authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `just_in`
--
ALTER TABLE `just_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
