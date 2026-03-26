-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2026 at 03:49 PM
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
-- Database: `hospital_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `Patient_ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `Gender` enum('Male','Female','Other') DEFAULT NULL,
  `Contact` varchar(15) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `Blood_Group` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`Patient_ID`, `Name`, `Age`, `Gender`, `Contact`, `Address`, `Blood_Group`) VALUES
(1, 'Rishabh Kumar', 22, 'Male', '9876543210', 'Ghaziabad, UP', 'B+'),
(2, 'Anjali Singh', 25, 'Female', '8877665544', 'New Delhi, Delhi', 'O-'),
(3, 'Suresh Raina', 38, 'Male', '7766554433', 'Noida, Sector 62', 'A+'),
(4, 'Meena Kumari', 60, 'Female', '9988776655', 'Gurugram, HR', 'AB+'),
(5, 'Vikram Rathore', 42, 'Male', '9122334455', 'Faridabad, HR', 'O+');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`Patient_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `Patient_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
