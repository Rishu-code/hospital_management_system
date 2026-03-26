-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2026 at 04:11 PM
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
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicine_id` int(11) NOT NULL,
  `medicine_name` varchar(100) NOT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `price_per_unit` decimal(10,2) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicine_id`, `medicine_name`, `stock_quantity`, `price_per_unit`, `expiry_date`) VALUES
(1, 'Paracetamol 500mg', 450, 2.50, '2027-12-01'),
(2, 'Amoxicillin 250mg', 15, 12.00, '2026-06-15'),
(3, 'Cetirizine 10mg', 200, 5.00, '2027-01-20'),
(4, 'Insulin Glargine', 8, 450.00, '2026-03-30'),
(5, 'Pantoprazole 40mg', 300, 8.50, '2027-05-10'),
(6, 'Paracetamol', 100, NULL, '2027-12-31'),
(7, 'Amoxicillin', 50, NULL, '2026-06-15'),
(8, 'Cetirizine', 200, NULL, '2028-01-20'),
(9, 'Paracetamol 500mg', 450, 2.50, '2027-12-01'),
(10, 'Amoxicillin 250mg', 15, 12.00, '2026-06-15'),
(11, 'Paracetamol 500mg', 450, 2.50, '2027-12-01'),
(12, 'Amoxicillin 250mg', 15, 12.00, '2026-06-15'),
(13, 'Cetirizine 10mg', 199, 5.00, '2027-01-20'),
(14, 'Paracetamol 500mg', 450, 2.50, '2027-12-01'),
(15, 'Amoxicillin 250mg', 11, 15.00, '2026-08-15'),
(16, 'Insulin Glargine', 5, 450.00, '2026-05-20'),
(17, 'Cetirizine 10mg', 300, 5.00, '2027-01-20'),
(18, 'Pantoprazole 40mg', 149, 12.50, '2027-03-10'),
(19, 'Aspirin 500mg', 100, 50.00, NULL),
(20, 'Paracetamol 650mg', 150, 45.00, NULL),
(21, 'Ibuprofen 400mg', 80, 60.00, NULL),
(22, 'Amoxicillin 500mg', 50, 120.00, NULL),
(23, 'Metformin 500mg', 200, 80.00, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicine_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
