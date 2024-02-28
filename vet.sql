-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 09:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vet`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(255) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `pet_gender` varchar(255) NOT NULL,
  `pet_breed` varchar(255) NOT NULL,
  `pet_color` varchar(255) NOT NULL,
  `pet_species` varchar(255) NOT NULL,
  `pet_bday` date NOT NULL,
  `neutered` varchar(255) NOT NULL,
  `history` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `service` varchar(255) NOT NULL,
  `total` int(255) NOT NULL,
  `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `archive_inventory`
--

CREATE TABLE `archive_inventory` (
  `id` int(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_date` date NOT NULL,
  `item_expiration` date NOT NULL,
  `item_stocks` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `archive_patients`
--

CREATE TABLE `archive_patients` (
  `ID` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `pet_gender` varchar(255) NOT NULL,
  `pet_breed` varchar(255) NOT NULL,
  `pet_color` varchar(255) NOT NULL,
  `pet_type` varchar(255) NOT NULL,
  `pet_bday` date DEFAULT NULL,
  `neutered` varchar(255) NOT NULL,
  `history` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `total` int(255) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `notes` mediumtext DEFAULT NULL,
  `datetime_ended` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `archive_services`
--

CREATE TABLE `archive_services` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `price` int(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archive_services`
--

INSERT INTO `archive_services` (`id`, `title`, `description`, `price`, `status`) VALUES
(15, 'Surgery', 'Surgery is a medical procedure that involves the physical intervention and alteration of a patient\'s body for therapeutic or diagnostic purposes. It is a crucial branch of medicine that encompasses a wide range of procedures, from minor interventions to complex surgeries. Surgeons, highly trained medical professionals, perform these procedures with precision and expertise, often using advanced technologies and techniques.', 2500, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `archive_users`
--

CREATE TABLE `archive_users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complete_patients`
--

CREATE TABLE `complete_patients` (
  `ID` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `pet_gender` varchar(255) NOT NULL,
  `pet_breed` varchar(255) NOT NULL,
  `pet_color` varchar(255) NOT NULL,
  `pet_type` varchar(255) NOT NULL,
  `pet_bday` date DEFAULT NULL,
  `neutered` varchar(255) NOT NULL,
  `history` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `total` int(255) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `notes` mediumtext DEFAULT NULL,
  `datetime_ended` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complete_patients`
--

INSERT INTO `complete_patients` (`ID`, `name`, `email`, `contact`, `address`, `pet_name`, `pet_gender`, `pet_breed`, `pet_color`, `pet_type`, `pet_bday`, `neutered`, `history`, `service`, `total`, `date`, `time`, `date_created`, `action`, `notes`, `datetime_ended`) VALUES
(61, 'Marcus Osalvo', 'osalvomarcus@gmail.com', '+63 927 455 9756', 'San mateo', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '0000-00-00', 'no', 'none', 'Grooming', 1800, '2023-12-14', '09:00:00', '2023-12-14 15:30:42', 'Completed', 'style -1000', '2023-12-14 15:55:52');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `datetime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `decline_app`
--

CREATE TABLE `decline_app` (
  `id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `pet_gender` varchar(255) NOT NULL,
  `pet_breed` varchar(255) NOT NULL,
  `pet_color` varchar(255) NOT NULL,
  `pet_species` varchar(255) NOT NULL,
  `pet_bday` date NOT NULL,
  `neutered` varchar(255) NOT NULL,
  `history` varchar(1028) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `service` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `ID` int(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_date` date NOT NULL,
  `item_expiration` date NOT NULL,
  `item_stocks` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `log_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `username`, `position`, `action`, `log_datetime`) VALUES
(132, 'admin', 'Admin', 'Logged in', '2023-12-14 06:45:31'),
(133, 'admin', 'Admin', 'Logged out', '2023-12-14 07:02:15'),
(134, 'admin', 'Admin', 'Logged in', '2023-12-14 07:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `ID` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `pet_gender` varchar(255) NOT NULL,
  `pet_breed` varchar(255) NOT NULL,
  `pet_color` varchar(255) NOT NULL,
  `pet_type` varchar(255) NOT NULL,
  `pet_bday` date DEFAULT NULL,
  `neutered` varchar(255) NOT NULL,
  `history` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `total` int(255) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `notes` mediumtext DEFAULT NULL,
  `datetime_ended` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `ID` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`ID`, `Name`, `Username`, `Password`, `Position`) VALUES
(10, 'admin', 'admin', 'admin', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `price` int(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ID`, `title`, `description`, `price`, `status`) VALUES
(13, 'Grooming', '\"Grooming is an essential aspect of personal care and hygiene that goes beyond mere appearance. It encompasses a range of practices aimed at maintaining one\'s physical health and presenting oneself well to the world. From regular haircuts and skincare routines to nail care and maintaining oral hygiene, grooming plays a pivotal role in self-presentation. It boosts confidence, cultivates a sense of self-respect, and often reflects an individual\'s attention to detail and personal well-being. Beyond its outward impact, grooming contributes to a positive mindset and can significantly influence how one is perceived by others, emphasizing the importance of a holistic approach to personal care.\"', 500, 'Active'),
(14, 'Surgery', 'Surgery is a medical procedure that involves the physical intervention and alteration of a patient\'s body for therapeutic or diagnostic purposes. It is a crucial branch of medicine that encompasses a wide range of procedures, from minor interventions to complex surgeries. Surgeons, highly trained medical professionals, perform these procedures with precision and expertise, often using advanced technologies and techniques.', 2500, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
