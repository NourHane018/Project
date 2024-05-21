-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 12:50 AM
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
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(30) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `status` varchar(30) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT 0,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_name`, `appointment_date`, `status`, `isAdmin`, `user_id`) VALUES
(17, 'ibtissam', '0220-02-22 02:52:00', 'Scheduled', 0, 172),
(56, 'nour', '2024-05-05 11:01:00', 'Scheduled', 0, 173),
(58, 'ibtissam', '0111-11-11 11:11:00', 'Scheduled', 0, 172),
(59, 'ibtissam', '0055-05-05 05:55:00', 'Scheduled', 0, 172),
(81, 'ibtissam', '0005-05-05 05:05:00', 'Scheduled', 0, 172),
(82, 'ibtissam', '0005-05-05 05:05:00', 'Scheduled', 0, 172),
(83, 'ibtissam', '0005-05-05 05:05:00', 'Scheduled', 0, 172),
(84, 'ibtissam', '0005-05-05 05:05:00', 'Scheduled', 0, 172);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
