-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2026 at 03:45 PM
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
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `app_date` date NOT NULL,
  `app_time` time NOT NULL,
  `status` enum('Scheduled','Completed','Cancelled') DEFAULT 'Scheduled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `patient_name`, `doctor_name`, `app_date`, `app_time`, `status`) VALUES
(1, 'Rishabh Kumar', 'Dr. Sharma (Cardio)', '2026-03-26', '10:30:00', 'Scheduled'),
(2, 'Anjali Singh', 'Dr. Verma (Neuro)', '2026-03-26', '11:45:00', 'Scheduled'),
(3, 'Suresh Raina', 'Dr. Khanna (Ortho)', '2026-03-27', '09:00:00', 'Scheduled'),
(4, 'RAJU', 'DR VERMA', '2026-03-12', '06:49:00', 'Scheduled');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
