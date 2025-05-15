-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 14, 2025 at 10:57 AM
-- Server version: 9.1.0
-- PHP Version: 8.4.0

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coursebox`
--
CREATE DATABASE IF NOT EXISTS `coursebox` DEFAULT CHARACTER SET utf32 COLLATE utf32_persian_ci;
USE `coursebox`;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL,
  `username` varchar(30) COLLATE utf8mb3_persian_ci NOT NULL,
  `orderdate` date NOT NULL,
  `pro_code` int NOT NULL,
  `pro_qty` int NOT NULL,
  `pro_price` float NOT NULL,
  `mobile` varchar(11) COLLATE utf8mb3_persian_ci NOT NULL,
  `address` varchar(400) COLLATE utf8mb3_persian_ci NOT NULL,
  `trackcode` varchar(24) COLLATE utf8mb3_persian_ci NOT NULL,
  `state` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `pro_code` int NOT NULL,
  `pro_name` varchar(200) COLLATE utf8mb3_persian_ci NOT NULL,
  `pro_qty` int NOT NULL,
  `pro_price` float NOT NULL,
  `pro_image` varchar(80) COLLATE utf8mb3_persian_ci NOT NULL,
  `pro_type` text CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `realname` varchar(30) COLLATE utf32_persian_ci NOT NULL,
  `username` varchar(30) COLLATE utf32_persian_ci NOT NULL,
  `email` varchar(30) COLLATE utf32_persian_ci NOT NULL,
  `number` varchar(30) COLLATE utf32_persian_ci NOT NULL,
  `password` varchar(30) COLLATE utf32_persian_ci NOT NULL,
  `type` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf32 COLLATE=utf32_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`realname`, `username`, `email`, `number`, `password`, `type`) VALUES
('مهدی صالحی', 'mahdi', 'mahdisalehi@gmail.com', '09112345678', '123', 1);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
