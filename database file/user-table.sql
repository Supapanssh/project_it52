-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2020 at 08:08 PM
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
-- Database: `dbname`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hash` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `roles` int(11) NOT NULL DEFAULT '10',
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `roles`, `email`, `status`) VALUES
(1, 'developer', 'zDw2FZ638lG69RWusZ7FSWvZjqNh0hoa', '$2y$13$ryqPh67kM6vCD3NoI94UaOGYUtZU7e9xgmtpuzyUCBO8V9KOZAlG6', 30, 'dev@exam.com', 1),
(2, 'user', 'zDw2FZ638lG69RWusZ7FSWvZjqNh0hoa', '$2y$13$ryqPh67kM6vCD3NoI94UaOGYUtZU7e9xgmtpuzyUCBO8V9KOZAlG6', 10, 'user@exam.com', 1),
(3, 'admin', 'zDw2FZ638lG69RWusZ7FSWvZjqNh0hoa', '$2y$13$ryqPh67kM6vCD3NoI94UaOGYUtZU7e9xgmtpuzyUCBO8V9KOZAlG6', 20, 'admin@exam.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
