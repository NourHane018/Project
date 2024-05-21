-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 12:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `therapease`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `birthday` text NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `md5_pass` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT 0,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `verification_code` text NOT NULL,
  `email_verified_at` varchar(255) DEFAULT NULL,
  `reset_token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `birthday`, `gender`, `md5_pass`, `isAdmin`, `status`, `verification_code`, `email_verified_at`, `reset_token`) VALUES
(172, 'ibtissam', 'rregaaibti@gmail.com', '18', '2004-08-06', 'female', '6f4922f45568161a8cdf4ad2299f6d23', 0, 'approved', '', NULL, ''),
(173, 'nour', 'nnor@gmail.com', 'VJxx2fVA', '2004-05-05', 'female', '4939fcdfba1c5744e4fd0c872c089e2f', 0, 'approved', '', NULL, ''),
(194, 'somone', 'norarmy0251@gmail.com', '0nmBjUN8', '2000-02-22', 'male', 'a558677b74c53cd919e1b9a08103e6aa', 0, 'approved', '', NULL, '74168'),
(195, 'somone63', 'someone1@gmail.com', '52R0m9IL', '2000-02-22', 'male', '8a05fa99606c8d8edf900ed470e01ceb', 0, 'pending', '', NULL, ''),
(197, 'admin25', 'rritaj0251@gmail.com', 'ZIgEWml8', '0005-05-05', 'male', '768bd02c979f5b6976eb4cbd14e5774f', 0, 'approved', '', NULL, ''),
(198, 'admin25', 'rritaj0251@gmail.com', '4g24JzQr', '0005-05-05', 'male', 'd55261f579bcef3e392423f8dbb501fe', 0, 'approved', '', NULL, ''),
(199, 'admin25', 'rritaj0251@gmail.com', 'QO15wGjH', '0005-05-05', 'male', '9bf70d41e6df9f7a1d15e52fd4f4c94a', 0, 'approved', '', NULL, ''),
(200, 'admin25', 'rritaj0251@gmail.com', 'Nday3jqX', '0005-05-05', 'male', 'a1434486986db6746f787dc3e7f6d2c0', 0, 'approved', '', NULL, ''),
(201, 'khkraa', 'admin@admin.com', 'HXerM0Fc', '0001-11-11', 'male', '4f4478a9d4bbd4ffc340dd1841988a8c', 0, 'approved', '', NULL, ''),
(202, 'khkraa', 'admin@admin.com', 'x4uFQnnE', '0001-11-11', 'male', 'b0a6bca816dfdabad873f4f1ae2d9d5c', 0, 'approved', '', NULL, ''),
(203, 'khkraa', 'admin@admin.com', '8rPeYm2Q', '0001-11-11', 'male', '0ab167bc1b209abc9e20f106d3788934', 0, 'approved', '', NULL, ''),
(204, 'khkraa', 'admin@admin.com', 'FvMU43v9', '0001-11-11', 'male', '9f74c8eab59d9b63cba9c27c39c3507f', 0, 'approved', '', NULL, ''),
(205, 'klklklklklkl', 'admi5n@admin.com', 'Xz1DJ3wi', '0005-05-05', 'male', 'd98be2e364eb6b08a264383537e58ca4', 0, 'approved', '', NULL, ''),
(206, 'klklklklklkl', 'admi5n@admin.com', 'UMsAVEQo', '0005-05-05', 'male', '5ec2994f3767e043cc22fafd4651a4b8', 0, 'approved', '', NULL, ''),
(207, 'klklklklklkl', 'admi5n@admin.com', 'm2j3YwrW', '0005-05-05', 'male', '2e5fc4501d4fe2821e02c77472bff54d', 0, 'approved', '', NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
