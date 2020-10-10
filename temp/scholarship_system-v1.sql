-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2020 at 09:00 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scholarship_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `gpax`
--

CREATE TABLE `gpax` (
  `id` int(11) NOT NULL,
  `education_level` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `school_id` int(11) NOT NULL,
  `gpa` float NOT NULL,
  `report_gpa` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privy_council`
--

CREATE TABLE `privy_council` (
  `id` int(11) NOT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `director` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `affiliation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `area_size` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `race` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ไทย',
  `nationality` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ไทย',
  `religions` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'พุทธ',
  `address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `father_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `father_status` int(11) NOT NULL,
  `father_phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `father_career` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `father_income` int(11) NOT NULL,
  `mother_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mother_status` int(11) NOT NULL,
  `mother_phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `mother_career` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mother_income` int(11) NOT NULL,
  `father_address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `mother_address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `siblings` int(11) NOT NULL,
  `relation_beetween_family` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `speciality` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `expectation` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `comment_from_teacher` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `school_id` int(11) NOT NULL,
  `gpax_id` int(11) DEFAULT NULL,
  `privy_council` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hash` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '10',
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `role`, `email`, `status`) VALUES
(1, 'user1', '', '$2y$13$/n6TXl3reKe0xwDa3hyA9ONGL75SkqrA4U4wyANWBDumyOzbJFPtS', 10, 'example@mail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gpax`
--
ALTER TABLE `gpax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privy_council`
--
ALTER TABLE `privy_council`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `students_ibfk_2` (`gpax_id`),
  ADD KEY `privy_council` (`privy_council`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gpax`
--
ALTER TABLE `gpax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privy_council`
--
ALTER TABLE `privy_council`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`gpax_id`) REFERENCES `gpax` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`privy_council`) REFERENCES `privy_council` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
