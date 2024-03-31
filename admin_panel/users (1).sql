-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2024 at 04:46 PM
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
-- Database: `test`
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
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `birthday`, `gender`, `md5_pass`, `isAdmin`, `status`) VALUES
(1, 'riadh', 'riadh20@gmail.com', '123456', '5555-05-05', 'male', 'e10adc3949ba59abbe56e057f20f883e', 0, 'pending'),
(4, 'looooooooool', 'nor@hotmail.com', '123456789', '', 'female', '25f9e794323b453885f5181f1b624d0b', 0, 'pending'),
(8, 'norrrrrr', 'lmlmlm@k.com', '56', '5555-05-05', 'male', '', 0, 'pending'),
(9, 'ibtissam', 'rregaaibtissam@gmail.com', 'newpassword', '06-08-2004', 'male', '', 0, 'pending'),
(11, 'klklklklklkl', 'norarmy0251@gmail.com', '123456', '16-2-2005', 'female', 'e10adc3949ba59abbe56e057f20f883e', 0, 'pending');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
