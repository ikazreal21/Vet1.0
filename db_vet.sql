-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2024 at 07:21 PM
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
-- Database: `db_vet`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(255) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `pet_gender` varchar(255) NOT NULL,
  `pet_type` varchar(255) NOT NULL,
  `pet_breed` varchar(255) NOT NULL,
  `pet_bday` varchar(255) DEFAULT NULL,
  `pet_color` varchar(255) NOT NULL,
  `neutered` varchar(255) NOT NULL,
  `history` mediumtext NOT NULL,
  `service_title` varchar(255) DEFAULT NULL,
  `service_price` double DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'pending'
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
  `price` varchar(255) DEFAULT NULL,
  `item_stocks` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archive_inventory`
--

INSERT INTO `archive_inventory` (`id`, `item_name`, `item_date`, `item_expiration`, `price`, `item_stocks`) VALUES
(15, 'Dog Food', '2024-02-18', '2024-04-18', NULL, 10),
(14, 'Anti Rabis', '2024-02-09', '2027-02-09', NULL, 10);

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

--
-- Dumping data for table `archive_patients`
--

INSERT INTO `archive_patients` (`ID`, `name`, `email`, `contact`, `address`, `pet_name`, `pet_gender`, `pet_breed`, `pet_color`, `pet_type`, `pet_bday`, `neutered`, `history`, `service`, `total`, `date`, `time`, `date_created`, `action`, `notes`, `datetime_ended`) VALUES
(83, 'Marcus Osalvo', 'osalvomarcus@gmail.com', '+63 927 455 9756', 'dsadassada', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '2024-02-09', 'no', 'asdaas', 'Surgery', 2500, '0000-00-00', '00:00:00', '2024-02-09 17:52:46', 'Accepted', '', '2024-02-10 15:18:21');

-- --------------------------------------------------------

--
-- Table structure for table `archive_services`
--

CREATE TABLE `archive_services` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `price` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `time_consume` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `client` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `doctor` varchar(255) DEFAULT NULL,
  `addfee` varchar(255) DEFAULT NULL,
  `product_item` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `total_price` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`client`, `service`, `doctor`, `addfee`, `product_item`, `notes`, `total_price`) VALUES
('86', '[{\"service\":\"Consultation\",\"title\":\"Consultation\",\"price\":\"300\"}]', '300', '300', NULL, 'style - 300', '1400'),
('86', 'Consultation', '300', '150', NULL, 'style- 150', '1200'),
('86', 'Consultation', '300', '300', NULL, '', '1400'),
('86', 'Consultation', '300', '300', NULL, '', '1400'),
('86', 'Consultation', '300', '300', NULL, 'style-300', '1400'),
('86', 'Consultation', '300', '300', 'Dog Food (150), Dog Food 1kg (50)', 'style-300', '1400'),
('86', 'Consultation', '300', '150', 'Dog Food (150)', 'style-150', '1200'),
('86', 'Consultation', '300', '300', 'Dog Food (150), Dog Food 1kg (50)', 'style-300', '1400'),
('86', 'Consultation', '300', '300', 'Dog Food (150)', 'style-300', '1350'),
('86', 'Consultation', '300', '300', 'Dog Food (150), Dog Food 1kg (50)', '', '1400'),
('86', 'Consultation', '300', '300', 'Dog Food (150), Dog Food 1kg (50)', '', '1400'),
('87', 'Consultation', '0', '0', 'dog food peanut butter  (500)', '', '800'),
('87', 'Consultation', '200', '100', '', '', '600');

-- --------------------------------------------------------

--
-- Table structure for table `clientregister`
--

CREATE TABLE `clientregister` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientregister`
--

INSERT INTO `clientregister` (`id`, `name`, `username`, `email`, `phone`, `password`, `address`) VALUES
(6, 'Marcus Osalvo', 'Marcus', 'osalvomarcus@gmail.com', '09274559756', '12345', 'San mateo, rizal'),
(7, 'Jhanel', 'MPJV', 'villamorjhanel11@gmail.com', '09567492255', 'BOBO123', 'taytay, rizal'),
(8, '', 'jbl', 'Jblaraa@gmail.com', '09369123287', '123', ''),
(9, '', 'jb', 'Jblaraa@gmail.com', '+63 927 455 9', '12345', '');

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
  `pet_id` varchar(255) NOT NULL,
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

INSERT INTO `complete_patients` (`ID`, `name`, `email`, `contact`, `address`, `pet_id`, `pet_name`, `pet_gender`, `pet_breed`, `pet_color`, `pet_type`, `pet_bday`, `neutered`, `history`, `service`, `total`, `date`, `time`, `date_created`, `action`, `notes`, `datetime_ended`) VALUES
(84, 'Marcus Osalvo', 'osalvomarcus@gmail.com', '09274559756', 'San mateo, rizal', '', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '0000-00-00', 'no', 'none', 'Surgery', 2500, '2024-02-10', '14:00:00', '2024-02-10 12:27:18', 'Completed', NULL, NULL),
(84, 'Marcus Osalvo', 'osalvomarcus@gmail.com', '09274559756', 'San mateo, rizal', '', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '0000-00-00', 'no', 'none', 'Surgery', 2500, '2024-02-10', '14:00:00', '2024-02-10 12:27:18', 'Completed', NULL, NULL),
(85, 'Marcus Osalvo', 'osalvomarcus@gmail.com', '09274559756', 'San mateo, rizal', '', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '0000-00-00', 'no', 'none', 'Surgery', 2500, '2024-02-16', '09:00:00', '2024-02-16 20:45:23', 'Completed', NULL, '2024-02-16 15:26:45'),
(95, '', 'Jblaraa@gmail.com', '09369123287', '', '', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '2024-02-24', 'no', '', 'Surgery', 2500, '2024-02-26', '09:00:00', '2024-02-25 23:02:59', 'Completed', NULL, '2024-02-28 08:42:48'),
(94, '', 'Jblaraa@gmail.com', '09369123287', '', '', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '2024-02-24', 'no', '', 'Surgery,Consultation', 2800, '2024-02-25', '09:00:00', '2024-02-25 22:54:51', 'Completed', NULL, '2024-02-28 08:47:27'),
(93, '', 'Jblaraa@gmail.com', '09369123287', '', '', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '2024-02-24', 'no', '', 'Surgery,Consultation', 2800, '2024-02-25', '09:00:00', '2024-02-25 22:52:43', 'Completed', NULL, '2024-02-28 14:49:32'),
(93, '', 'Jblaraa@gmail.com', '09369123287', '', '', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '2024-02-24', 'no', '', 'Surgery,Consultation', 2800, '2024-02-25', '09:00:00', '2024-02-25 22:52:43', 'Completed', NULL, '2024-02-28 14:49:51'),
(86, 'Marcus Osalvo', 'osalvomarcus@gmail.com', '09274559756', 'San mateo, rizal', '', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '0000-00-00', 'no', 'none', 'Consultation', 600, '2024-02-17', '09:00:00', '2024-02-17 08:51:05', 'Completed', 'Style - 300', '2024-02-28 14:50:17'),
(87, 'Marcus Osalvo', 'osalvomarcus@gmail.com', '09274559756', 'San mateo, rizal', '', 'Skye', 'female', 'Pomeranian', 'Orange', 'dog', '0000-00-00', 'no', '', 'Consultation', 300, '2024-02-16', '15:00:00', '2024-02-16 22:54:15', 'Completed', NULL, '2024-02-28 14:51:07'),
(86, 'Marcus Osalvo', 'osalvomarcus@gmail.com', '09274559756', 'San mateo, rizal', '', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '0000-00-00', 'no', 'none', 'Consultation', 600, '2024-02-17', '09:00:00', '2024-02-17 08:51:05', 'Completed', 'Style - 300', '2024-02-28 14:53:29'),
(86, 'Marcus Osalvo', 'osalvomarcus@gmail.com', '09274559756', 'San mateo, rizal', '', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '0000-00-00', 'no', 'none', 'Consultation', 600, '2024-02-17', '09:00:00', '2024-02-17 08:51:05', 'Completed', 'Style - 300', '2024-02-28 14:58:17'),
(87, 'Marcus Osalvo', 'osalvomarcus@gmail.com', '09274559756', 'San mateo, rizal', '', 'Skye', 'female', 'Pomeranian', 'Orange', 'dog', '0000-00-00', 'no', '', 'Consultation', 300, '2024-02-16', '15:00:00', '2024-02-16 22:54:15', 'Completed', NULL, '2024-02-28 15:04:26'),
(87, 'Marcus Osalvo', 'osalvomarcus@gmail.com', '09274559756', 'San mateo, rizal', '', 'Skye', 'female', 'Pomeranian', 'Orange', 'dog', '0000-00-00', 'no', '', 'Consultation', 300, '2024-02-16', '15:00:00', '2024-02-16 22:54:15', 'Completed', NULL, '2024-02-28 15:05:25'),
(89, '', 'Jblaraa@gmail.com', '09369123287', '', '', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '2024-02-24', 'no', '', 'Surgery,Consultation', 2800, '2024-02-26', '10:00:00', '2024-02-25 22:41:13', 'Completed', NULL, '2024-02-28 15:05:50'),
(88, '', 'Jblaraa@gmail.com', '09369123287', '', '', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '2024-02-24', 'no', '', 'Surgery,Consultation', 2800, '2024-02-25', '09:00:00', '2024-02-25 21:03:48', 'Completed', NULL, '2024-02-28 15:07:28'),
(93, '', 'Jblaraa@gmail.com', '09369123287', '', '', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '2024-02-24', 'no', '', 'Surgery,Consultation', 2800, '2024-02-25', '09:00:00', '2024-02-25 22:52:43', 'Completed', NULL, '2024-02-28 15:08:17'),
(92, '', 'Jblaraa@gmail.com', '09369123287', '', '', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '2024-02-24', 'no', '', 'Surgery,Consultation', 2800, '2024-02-25', '09:00:00', '2024-02-25 22:51:45', 'Completed', NULL, '2024-02-28 15:21:30'),
(91, '', 'Jblaraa@gmail.com', '09369123287', '', '', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '2024-02-24', 'no', '', 'Surgery,Consultation', 2800, '2024-02-25', '09:00:00', '2024-02-25 22:45:14', 'Completed', NULL, '2024-02-28 15:23:11'),
(96, 'Marcus Osalvo', 'osalvomarcus@gmail.com', '09274559756', 'San mateo, rizal', '18', 'Skye', 'female', 'Pomeranian', 'Orange', 'dog', '0000-00-00', 'no', '', 'Surgery,Consultation', 2800, '2024-02-28', '09:00:00', '2024-02-28 22:45:13', 'Completed', NULL, '2024-02-28 15:46:29'),
(87, 'Marcus Osalvo', 'osalvomarcus@gmail.com', '09274559756', 'San mateo, rizal', '', 'Skye', 'female', 'Pomeranian', 'Orange', 'dog', '0000-00-00', 'no', '', 'Consultation', 300, '2024-02-16', '15:00:00', '2024-02-16 22:54:15', 'Completed', NULL, '2024-02-28 17:16:42'),
(97, 'Marcus Osalvo', 'osalvomarcus@gmail.com', '09274559756', 'San mateo, rizal', '17', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '0000-00-00', 'no', 'none', 'Surgery,Consultation', 2800, '2024-02-29', '09:00:00', '2024-02-29 00:20:22', 'Completed', NULL, '2024-02-28 17:20:48');

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
-- Table structure for table `declined_app`
--

CREATE TABLE `declined_app` (
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
  `datetime_ended` datetime DEFAULT NULL,
  `date_declined` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `declined_app`
--

INSERT INTO `declined_app` (`ID`, `name`, `email`, `contact`, `address`, `pet_name`, `pet_gender`, `pet_breed`, `pet_color`, `pet_type`, `pet_bday`, `neutered`, `history`, `service`, `total`, `date`, `time`, `date_created`, `action`, `notes`, `datetime_ended`, `date_declined`) VALUES
(0, 'Jhanel', 'villamorjhanel11@gmail.com', '09567492255', 'taytay, rizal', 'JAY', 'female', 'Aspin', 'Orange', 'cat', '0000-00-00', 'no', 'none', 'Surgery', 2500, '2024-02-16', '09:00:00', '2024-02-16 21:24:51', 'DECLINED', NULL, NULL, ''),
(0, 'Marcus Osalvo', 'osalvomarcus@gmail.com', '09274559756', 'San mateo, rizal', 'Skye', 'female', 'Pomeranian', 'Orange', 'dog', '0000-00-00', 'no', '', 'Surgery', 2500, '2024-02-16', '09:00:00', '2024-02-16 21:58:25', 'DECLINED', NULL, NULL, '2024-02-16 15:19:41');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `ID` int(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_date` date NOT NULL,
  `item_expiration` date NOT NULL,
  `price` varchar(255) DEFAULT NULL,
  `item_stocks` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`ID`, `item_name`, `item_date`, `item_expiration`, `price`, `item_stocks`) VALUES
(16, 'Dog Food', '2024-02-18', '2024-04-18', '150', -31),
(17, 'Dog Food 1kg', '2024-02-18', '2024-01-18', '50', -20),
(18, 'dog food strawberry ', '2024-02-18', '2024-02-24', '300', -8),
(19, 'dog food peanut butter ', '2024-02-18', '2024-02-18', '500', -2);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `client_id` varchar(255) DEFAULT NULL,
  `total_price` varchar(255) DEFAULT NULL,
  `notes` varchar(1028) DEFAULT NULL
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
  `log_datetime` varchar(255) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `username`, `position`, `action`, `log_datetime`) VALUES
(211, 'admin', 'Admin', 'Logged in', '2024-02-17 08:51:25'),
(212, 'admin', 'Admin', 'Logged out', '2024-02-17 08:52:20'),
(213, 'admin', 'Admin', 'Logged in', '2024-02-17 16:03:24'),
(214, 'admin', 'Admin', 'Logged out', '2024-02-17 16:35:23'),
(215, 'admin', 'Admin', 'Logged in', '2024-02-18 19:28:23'),
(216, '', '', 'Logged out', '2024-02-18 21:53:22'),
(217, 'admin', 'Admin', 'Logged in', '2024-02-18 21:54:14'),
(218, 'admin', 'Admin', 'Logged in', '2024-02-20 20:15:24'),
(219, 'admin', 'Admin', 'Logged in', '2024-02-25 21:04:18'),
(220, 'admin', 'Admin', 'Logged in', '2024-02-28 15:42:25');

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
  `pet_id` varchar(255) NOT NULL,
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
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`ID`, `name`, `email`, `contact`, `address`, `pet_id`, `pet_name`, `pet_gender`, `pet_breed`, `pet_color`, `pet_type`, `pet_bday`, `neutered`, `history`, `service`, `total`, `date`, `time`, `date_created`, `action`, `notes`, `datetime_ended`) VALUES
(89, '', 'Jblaraa@gmail.com', '09369123287', '', '', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '2024-02-24', 'no', '', 'Surgery,Consultation', 2800, '2024-02-26', '10:00:00', '2024-02-25 22:41:13', 'Completed', NULL, '2024-02-28 15:05:50'),
(90, '', 'Jblaraa@gmail.com', '09369123287', '', '', 'Bruce', 'male', 'Doberman', 'Black', 'dog', '2024-02-24', 'no', '', 'Surgery,Consultation', 2800, '2024-02-25', '09:00:00', '2024-02-25 22:44:20', 'ACCEPTED', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pet_name` varchar(100) DEFAULT NULL,
  `pet_gender` varchar(255) NOT NULL,
  `pet_type` varchar(50) DEFAULT NULL,
  `pet_breed` varchar(255) NOT NULL,
  `pet_bday` varchar(255) DEFAULT NULL,
  `pet_color` varchar(255) NOT NULL,
  `neutered` varchar(255) NOT NULL,
  `pet_history` varchar(255) NOT NULL,
  `pet_picture` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `user_id`, `pet_name`, `pet_gender`, `pet_type`, `pet_breed`, `pet_bday`, `pet_color`, `neutered`, `pet_history`, `pet_picture`) VALUES
(17, 6, 'Bruce', 'male', 'dog', 'Doberman', NULL, 'Black', 'no', 'none', NULL),
(18, 6, 'Skye', 'female', 'dog', 'Pomeranian', NULL, 'Orange', 'no', '', 0x75706c6f61642f696d67382e6a7067),
(19, 8, 'Bruce', 'male', 'dog', 'Doberman', '2024-02-24', 'Black', 'no', '', 0x75706c6f61642f696d67312e6a7067),
(20, 7, 'JAY', 'female', 'cat', 'Aspin', NULL, 'Orange', 'no', 'none', NULL);

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
  `status` varchar(255) NOT NULL,
  `time_consume` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ID`, `title`, `description`, `price`, `status`, `time_consume`) VALUES
(28, 'Surgery', 'Surgery is a medical procedure that involves the physical intervention and alteration of a patient\'s body for therapeutic or diagnostic purposes. It is a crucial branch of medicine that encompasses a wide range of procedures, from minor interventions to complex surgeries. Surgeons, highly trained medical professionals, perform these procedures with precision and expertise, often using advanced technologies and techniques.', 2500, 'Active', '00:10:00'),
(37, 'Consultation', 'During your pet\'s consultation, we will take a history and discuss with you your pet\'s symptoms. Your pet will be examined by the vet, looking at key areas of concern but also taking into account a wider overview of their body systems.', 300, 'Active', '00:20:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientregister`
--
ALTER TABLE `clientregister`
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
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `clientregister`
--
ALTER TABLE `clientregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `clientregister` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
