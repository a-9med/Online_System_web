-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2026 at 11:34 AM
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
-- Database: `voterdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `addcandidate`
--

CREATE TABLE `addcandidate` (
  `id` int(11) NOT NULL,
  `cname` text NOT NULL,
  `symbol` varchar(100) NOT NULL,
  `cparty` varchar(100) NOT NULL,
  `photo` varchar(225) NOT NULL,
  `votes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addcandidate`
--

INSERT INTO `addcandidate` (`id`, `cname`, `symbol`, `cparty`, `photo`, `votes`) VALUES
(1, 'Malik', 'uploads/symbols/1774971815_sym_power4.webp', 'Kingdom', 'uploads/candidates/1774971815_can_A4VLZC4Q5kDv6S6X.jpg', 3),
(2, 'Anifa', 'uploads/symbols/1774971899_sym_power1.webp', 'PLC', 'uploads/candidates/1774971899_can_pt4azo28mrAnk0wY.jpg', 3),
(3, 'Diom', 'uploads/symbols/1775036402_sym_power3.webp', 'Kom', 'uploads/candidates/1775036402_can_rxXi_XYIR_-FFxd6.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `name`, `password`) VALUES
(1, 'Admin', '100d2e313c9d0547b4cdb7bf0eb3f874'),
(2, 'Ahmed', '72523b032456ddaf30305a662f23640c');

-- --------------------------------------------------------

--
-- Table structure for table `voterregistration`
--

CREATE TABLE `voterregistration` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `dob` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` int(9) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `idtype` text NOT NULL,
  `cnic` int(100) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `expire` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `cpass` varchar(100) NOT NULL,
  `status` int(100) NOT NULL,
  `votes` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voterregistration`
--

INSERT INTO `voterregistration` (`id`, `name`, `dob`, `email`, `mobile`, `gender`, `photo`, `idtype`, `cnic`, `issue`, `expire`, `pass`, `cpass`, `status`, `votes`) VALUES
(3, 'perry', '2026-03-06', 'perty@gmail.com', 654944855, 'Male', 'uploads/1774966029_K9Tzkl0zxRFas06a.jpg', '123456', 123456, '2026-03-18', '2026-03-28', 'e10adc3949ba59abbe56e057f20f883e', '', 1, 0),
(4, 'Ahmed', '2024-11-07', 'fadil@gmail.com', 654944833, 'Male', 'uploads/1774973007_0NxTwM7o62G9IeTO.jpg', '123456789', 123456789, '2026-03-04', '2026-03-28', '25f9e794323b453885f5181f1b624d0b', '', 1, 0),
(5, 'Amira', '2026-03-01', 'amira@gmail.com', 654944811, 'Male', 'uploads/1774974720_3bUcS6mFOJhnAkCy.jpg', '1234567', 1234567, '2026-03-03', '2026-03-29', 'fcea920f7412b5da7be0cf42b8c93759', '', 1, 0),
(6, 'Jamila', '2027-03-20', 'jamila@gmail.com', 654944800, 'Male', 'uploads/1775037036_ufaV1wtOSYyaGVM9.jpg', '1234567890', 1234567890, '2025-11-06', '2026-07-18', 'e807f1fcf82d132f9bb018ca6738a19f', '', 1, 0),
(7, 'Youssoufa', '2026-04-02', 'youssoufa@gmail.com', 654944812, 'Male', 'uploads/1775288782_0NxTwM7o62G9IeTO.jpg', '123456789123', 2147483647, '2026-04-06', '2026-04-26', 'df96220fa161767c5cbb95567855c86b', '', 0, 0),
(8, 'Brayan', '2026-04-08', 'brayan@gmail.com', 654944813, 'Male', 'uploads/1775289517_1774971815_can_A4VLZC4Q5kDv6S6X.jpg', '654944813', 12345000, '2026-04-01', '2026-05-02', '873bc7ad9caa50d8265fb15968a3be06', '', 0, 0),
(9, 'Princess', '2026-04-24', 'princess@gmail.com', 654944815, 'Female', 'uploads/1775290029_kGyZbUupPlXVTZFz.jpg', '123450000', 123450000, '2025-10-06', '2026-04-24', '0307e8217e14515f2053033903e9fd0a', '', 0, 0),
(10, 'Moussa', '2007-01-01', 'moussa@gmail.com', 699096183, 'Male', 'uploads/1775465166_0NxTwM7o62G9IeTO.jpg', '1001001', 1001001, '2026-04-01', '2026-05-03', '57b9cdfbafb42a79ef2c2afa8875bb9f', '', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addcandidate`
--
ALTER TABLE `addcandidate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voterregistration`
--
ALTER TABLE `voterregistration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addcandidate`
--
ALTER TABLE `addcandidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `voterregistration`
--
ALTER TABLE `voterregistration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
