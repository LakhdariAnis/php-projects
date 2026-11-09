-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2025 at 11:52 PM
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
-- Database: `damsmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblappointment`
--

CREATE TABLE `tblappointment` (
  `ID` int(11) NOT NULL,
  `AppointmentNumber` varchar(80) DEFAULT NULL,
  `Name` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(12) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `AppointmentDate` date DEFAULT NULL,
  `AppointmentTime` time DEFAULT NULL,
  `Specialization` varchar(120) DEFAULT NULL,
  `Doctor` int(10) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Remark` text DEFAULT NULL,
  `ApplyDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblappointment`
--


-- --------------------------------------------------------

--
-- Table structure for table `tblchat`
--

CREATE TABLE `tblchat` (
  `ID` int(11) NOT NULL,
  `AppointmentID` int(11) NOT NULL,
  `SenderType` enum('patient','doctor') NOT NULL,
  `SenderName` varchar(100) NOT NULL,
  `Message` text NOT NULL,
  `MessageType` enum('text','image','file') DEFAULT 'text',
  `IsRead` tinyint(1) DEFAULT 0,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblchat`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbldoctor`
--

CREATE TABLE `tbldoctor` (
  `ID` int(5) NOT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `Specialization` varchar(250) DEFAULT NULL,
  `Password` varchar(259) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbldoctor`
--

INSERT INTO `tbldoctor` (`ID`, `FullName`, `MobileNumber`, `Email`, `Specialization`, `Password`, `CreationDate`) VALUES
(11, 'Dr. Mohamed', 612341201, 'mohamed@example.com', '1', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 00:03:50'),
(12, 'Dr. Ahmed', 569872101, 'ahmed@example.com', '2', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 00:04:21'),
(13, 'Dr. Mourad', 696584102, 'mourad@example.com', '3', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 00:05:30'),
(14, 'Dr. Inas', 521478932, 'inas@example.com', '4', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 00:06:08'),
(15, 'Dr. Sabrin', 785691201, 'sabrin@example.com', '5', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 00:06:39'),
(16, 'Dr. Nourhane', 562142530, 'nourhane@example.com', '5', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 00:07:12'),
(17, 'Dr. Imad', 562212021, 'imad@example.com', '6', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 00:07:50'),
(18, 'Dr. Abdelhakim', 521036987, 'abdelhakim@example.com', '7', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 00:08:24'),
(19, 'Dr. Moustafa', 587410123, 'moustafa@example.com', '8', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 00:08:55'),
(20, 'Dr. Ousama', 698741201, 'oussama@example.com', '8', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 00:09:38'),
(21, 'Dr. Yassmin', 598741201, 'yassmin@example.com', '9', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 00:10:10'),
(22, 'Dr. Yassin', 787412001, 'yassin@example.com', '10', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 00:10:49'),
(23, 'Dr. Omar', 698745120, 'omar@example.com', '11', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 00:11:28'),
(24, 'Dr. Yahia', 587411001, 'yahia@example.com', '11', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 00:11:58'),
(25, 'Dr. Fatima', 787412120, 'fatima@example.com', '12', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 00:12:27'),
(26, 'Dr. Mariam', 698741220, 'mariam@example.com', '13', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 00:13:04'),
(27, 'Dr. Ritaj', 787542103, 'ritaj@example.com', '14', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 00:13:46'),
(28, 'Dr. Dounia', 696275876, 'dounia@example.com', '9', '$2y$10$wH0c8J.9AIzGgTZvDPfee.xFO7wrsWBOzI8mMm1zHRkQyo7JixOUa', '2025-06-14 10:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `tblspecialization`
--

CREATE TABLE `tblspecialization` (
  `ID` int(5) NOT NULL,
  `Specialization` varchar(255) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblspecialization`
--

INSERT INTO `tblspecialization` (`ID`, `Specialization`, `CreationDate`) VALUES
(1, 'Orthopedics', '2022-11-09 14:22:33'),
(2, 'Internal Medicine', '2022-11-09 14:23:42'),
(3, 'Obstetrics and Gynecology', '2022-11-09 14:24:14'),
(4, 'Dermatology', '2022-11-09 14:24:42'),
(5, 'Pediatrics', '2022-11-09 14:25:06'),
(6, 'Radiology', '2022-11-09 14:25:31'),
(7, 'General Surgery', '2022-11-09 14:25:52'),
(8, 'Ophthalmology', '2022-11-09 14:27:18'),
(9, 'Family Medicine', '2022-11-09 14:27:52'),
(10, 'Chest Medicine', '2022-11-09 14:28:32'),
(11, 'Anesthesia', '2022-11-09 14:29:12'),
(12, 'Pathology', '2022-11-09 14:29:51'),
(13, 'ENT', '2022-11-09 14:30:13'),
(14, 'Cardiology', '2025-06-10 12:56:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblappointment`
--
ALTER TABLE `tblappointment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblchat`
--
ALTER TABLE `tblchat`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `AppointmentID` (`AppointmentID`);

--
-- Indexes for table `tbldoctor`
--
ALTER TABLE `tbldoctor`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblspecialization`
--
ALTER TABLE `tblspecialization`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblappointment`
--
ALTER TABLE `tblappointment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=504803647;

--
-- AUTO_INCREMENT for table `tblchat`
--
ALTER TABLE `tblchat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbldoctor`
--
ALTER TABLE `tbldoctor`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tblspecialization`
--
ALTER TABLE `tblspecialization`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblchat`
--
ALTER TABLE `tblchat`
  ADD CONSTRAINT `tblchat_ibfk_1` FOREIGN KEY (`AppointmentID`) REFERENCES `tblappointment` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
