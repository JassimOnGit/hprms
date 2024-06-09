-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 04:23 AM
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
-- Database: `hprms_db`
--
CREATE DATABASE IF NOT EXISTS `hprms_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hprms_db`;

-- --------------------------------------------------------

--
-- Table structure for table `admission_history`
--

CREATE TABLE `admission_history` (
  `id` int(30) NOT NULL,
  `patient_id` int(30) NOT NULL,
  `room_id` int(30) DEFAULT NULL,
  `date_admitted` datetime NOT NULL,
  `date_discharged` datetime DEFAULT NULL,
  `status` text NOT NULL DEFAULT '1',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_history`
--

INSERT INTO `admission_history` (`id`, `patient_id`, `room_id`, `date_admitted`, `date_discharged`, `status`, `date_created`, `date_updated`) VALUES
(4, 1, 1, '2021-12-29 15:00:00', '2021-12-31 15:20:00', '1', '2021-12-30 14:49:29', '2021-12-30 15:20:55'),
(7, 3, 1, '2021-10-15 08:00:00', '2021-10-16 20:00:00', '1', '2023-05-13 08:51:53', NULL),
(8, 3, NULL, '2023-06-15 15:00:00', '2023-06-16 04:59:00', '1', '2023-06-15 15:59:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ahp_list`
--

CREATE TABLE `ahp_list` (
  `id` int(30) NOT NULL,
  `fullname` text NOT NULL,
  `specialization` text NOT NULL,
  `email` text NOT NULL,
  `contact` varchar(100) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_added` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ahp_list`
--

INSERT INTO `ahp_list` (`id`, `fullname`, `specialization`, `email`, `contact`, `delete_flag`, `date_created`, `date_added`) VALUES
(17, 'Allied Health Professional MD1', '', '', '', 0, '2024-05-10 22:10:47', '2024-05-10 22:11:17');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `first_name`, `last_name`, `email`, `mobile`, `sex`, `appointment_date`, `message`) VALUES
(1, 'Jassim Phillip', 'Tagarda', 'jazz41.jazz04@gmail.com', '09285243690', 'Male', '2024-05-14 14:48:00', ' aaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_list`
--

CREATE TABLE `doctor_list` (
  `id` int(30) NOT NULL,
  `fullname` text NOT NULL,
  `specialization` text NOT NULL,
  `email` text NOT NULL,
  `contact` varchar(100) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_added` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_list`
--

INSERT INTO `doctor_list` (`id`, `fullname`, `specialization`, `email`, `contact`, `delete_flag`, `date_created`, `date_added`) VALUES
(17, 'Doctor MD1', '', '', '', 0, '2024-05-10 22:05:54', NULL),
(18, 'Doctor MD2', '', '', '', 0, '2024-06-08 03:48:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nurse_list`
--

CREATE TABLE `nurse_list` (
  `id` int(30) NOT NULL,
  `fullname` text NOT NULL,
  `specialization` text NOT NULL,
  `email` text NOT NULL,
  `contact` varchar(100) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_added` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nurse_list`
--

INSERT INTO `nurse_list` (`id`, `fullname`, `specialization`, `email`, `contact`, `delete_flag`, `date_created`, `date_added`) VALUES
(7, 'Nurse RN1', '', '', '', 0, '2023-05-10 20:32:40', '2024-05-10 01:52:52'),
(8, 'example nurse', 'example nurse', 'example nurse', 'example nurse', 1, '2023-06-15 16:00:02', '2024-05-08 19:30:04'),
(9, 'Nurse RN2', '', '', '', 0, '2024-05-10 00:04:15', '2024-05-10 01:53:02'),
(10, 'Nurse RN3', '', '', '', 0, '2024-05-10 00:05:47', '2024-05-10 01:53:12'),
(11, 'Nurse RN4', '', '', '', 1, '2024-05-10 00:05:54', '2024-05-10 02:00:10'),
(12, 'Nurse RN4', '', '', '', 0, '2024-06-09 03:06:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

CREATE TABLE `patient_details` (
  `patient_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_details`
--

INSERT INTO `patient_details` (`patient_id`, `meta_field`, `meta_value`) VALUES
(2, 'firstname', 'John'),
(2, 'middlename', ''),
(2, 'lastname', 'Doe'),
(2, 'suffix', ''),
(2, 'gender', 'Male'),
(2, 'dob', '1991-10-15'),
(2, 'email', 'jd@gmail.com'),
(2, 'contact', '123456789'),
(2, 'address', 'Quezon City'),
(3, 'firstname', 'Jane '),
(3, 'middlename', ''),
(3, 'lastname', 'Doe'),
(3, 'suffix', ''),
(3, 'gender', 'Female'),
(3, 'dob', '1990-10-04'),
(3, 'email', 'jd1@gmail.com'),
(3, 'contact', '123456789'),
(3, 'address', 'Quezon City'),
(1, 'firstname', 'Mark'),
(1, 'middlename', 'Makisig'),
(1, 'lastname', 'Malakas'),
(1, 'suffix', ''),
(1, 'gender', 'Male'),
(1, 'dob', '1987-08-02'),
(1, 'email', 'mm2@gmail.com'),
(1, 'contact', '1234567890'),
(1, 'address', 'Quezon City'),
(4, 'firstname', 'JANE'),
(4, 'middlename', ''),
(4, 'lastname', 'DOE'),
(4, 'suffix', ''),
(4, 'gender', 'Female'),
(4, 'dob', ''),
(4, 'email', ''),
(4, 'contact', ''),
(4, 'address', ''),
(6, 'firstname', 'Patient2'),
(6, 'middlename', ''),
(6, 'lastname', 'Sample'),
(6, 'suffix', ''),
(6, 'gender', 'Male'),
(6, 'dob', ''),
(6, 'email', ''),
(6, 'contact', ''),
(6, 'address', ''),
(5, 'firstname', 'patient1'),
(5, 'middlename', ''),
(5, 'lastname', 'sample'),
(5, 'suffix', ''),
(5, 'gender', 'Male'),
(5, 'dob', '1970-01-01'),
(5, 'email', ''),
(5, 'contact', ''),
(5, 'address', ''),
(7, 'firstname', 'patient3'),
(7, 'middlename', ''),
(7, 'lastname', 'sample'),
(7, 'suffix', ''),
(7, 'gender', 'Male'),
(7, 'dob', ''),
(7, 'email', ''),
(7, 'contact', ''),
(7, 'address', ''),
(8, 'firstname', 'patient4'),
(8, 'middlename', ''),
(8, 'lastname', 'sample'),
(8, 'suffix', ''),
(8, 'gender', 'Male'),
(8, 'dob', ''),
(8, 'email', ''),
(8, 'contact', ''),
(8, 'address', ''),
(9, 'firstname', 'patient5'),
(9, 'middlename', ''),
(9, 'lastname', 'sample'),
(9, 'suffix', ''),
(9, 'gender', 'Male'),
(9, 'dob', ''),
(9, 'email', ''),
(9, 'contact', ''),
(9, 'address', ''),
(10, 'firstname', 'patient6'),
(10, 'middlename', ''),
(10, 'lastname', 'sample'),
(10, 'suffix', ''),
(10, 'gender', 'Male'),
(10, 'dob', ''),
(10, 'email', ''),
(10, 'contact', ''),
(10, 'address', ''),
(12, 'firstname', 'PATIENT8'),
(12, 'middlename', ''),
(12, 'lastname', 'SAMPLE '),
(12, 'suffix', ''),
(12, 'gender', 'Male'),
(12, 'dob', ''),
(12, 'email', ''),
(12, 'contact', ''),
(12, 'address', ''),
(13, 'firstname', 'Patient8'),
(13, 'middlename', ''),
(13, 'lastname', 'Sample'),
(13, 'suffix', ''),
(13, 'gender', 'Male'),
(13, 'dob', ''),
(13, 'email', ''),
(13, 'contact', ''),
(13, 'address', '');

-- --------------------------------------------------------

--
-- Table structure for table `patient_history`
--

CREATE TABLE `patient_history` (
  `id` int(30) NOT NULL,
  `patient_id` int(30) NOT NULL,
  `illness` text DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `doctor_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_list`
--

CREATE TABLE `patient_list` (
  `id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `fullname` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_list`
--

INSERT INTO `patient_list` (`id`, `code`, `fullname`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'PA-2021120001', 'MALAKAS MARK MAKISIG', 0, 1, '2021-12-30 12:00:44', '2024-05-10 00:06:06'),
(2, 'PA-2023050001', 'DOE JOHN', 0, 1, '2023-05-08 20:49:49', '2024-05-08 19:29:57'),
(3, 'PA-2023050002', 'DOE JANE ', 0, 1, '2023-05-08 20:54:43', '2024-05-08 19:29:52'),
(4, 'PA-2023070001', 'DOE JANE', 0, 1, '2023-07-18 02:48:07', '2024-05-08 19:29:54'),
(5, 'PA-2024050001', 'SAMPLE PATIENT1', 0, 0, '2024-05-10 00:05:08', '2024-05-10 00:06:40'),
(6, 'PA-2024050002', 'SAMPLE PATIENT2', 0, 0, '2024-05-10 00:06:22', NULL),
(7, 'PA-2024050003', 'SAMPLE PATIENT3', 0, 0, '2024-05-10 00:18:38', NULL),
(8, 'PA-2024050004', 'SAMPLE PATIENT4', 0, 0, '2024-05-10 00:18:56', NULL),
(9, 'PA-2024050005', 'SAMPLE PATIENT5', 0, 0, '2024-05-10 01:46:53', NULL),
(10, 'PA-2024050006', 'SAMPLE PATIENT6', 0, 0, '2024-05-10 01:47:20', NULL),
(11, 'PA-2024050007', 'SAMPLE PATIENT7', 0, 0, '2024-05-10 01:47:51', NULL),
(12, 'PA-2024060001', 'SAMPLE  PATIENT8', 0, 1, '2024-06-09 03:07:03', '2024-06-09 03:07:29'),
(13, 'PA-2024060002', 'SAMPLE PATIENT8', 0, 0, '2024-06-09 03:07:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_list`
--

CREATE TABLE `room_list` (
  `id` int(30) NOT NULL,
  `room_type_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `capacity` int(5) NOT NULL DEFAULT 0,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_list`
--

INSERT INTO `room_list` (`id`, `room_type_id`, `name`, `description`, `capacity`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 3, 'Room-201', 'Sample Ward Room Good for 6 Patient', 6, 0, '2021-12-30 10:33:24', '2021-12-30 10:34:36'),
(2, 1, 'Room-301', 'Sample Single Bed Room', 1, 0, '2021-12-30 10:33:46', NULL),
(3, 2, 'Room-302', 'Sample 2 Bed Room', 2, 0, '2021-12-30 10:34:06', NULL),
(4, 4, 'Room-202', 'Sample Ward Good 12 Patents', 12, 0, '2021-12-30 10:35:01', NULL),
(5, 4, 'Room-303', 'Sample Deleted Room', 101, 1, '2021-12-30 10:35:19', '2021-12-30 10:35:52'),
(7, 2, 'aaa', '', 0, 1, '2023-05-09 19:55:29', '2023-05-09 19:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `room_type_list`
--

CREATE TABLE `room_type_list` (
  `id` int(30) NOT NULL,
  `room` text NOT NULL,
  `description` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_type_list`
--

INSERT INTO `room_type_list` (`id`, `room`, `description`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Single Room', 'Private Room with Single Patient Bed.', 0, '2021-12-30 10:05:45', NULL),
(2, '2 Bed Room', 'Private Room with 2 Bed Room.', 0, '2021-12-30 10:10:56', NULL),
(3, 'Ward 6', 'Ward Room With 6 Beds', 0, '2021-12-30 10:11:54', NULL),
(4, 'Ward 12', 'Ward Room with 12 Bed Space', 0, '2021-12-30 10:12:38', NULL),
(5, 'ward 32', 'Sample Deleted Room Type', 1, '2021-12-30 10:19:17', '2021-12-30 10:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'CHMC Hospital Management System'),
(6, 'short_name', 'CHMC HMS'),
(11, 'logo', 'uploads/CHMC_LOGO.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/CHMC_COVER2.png'),
(15, 'content', 'Array'),
(16, 'email', 'info@xyzhostpital.com'),
(17, 'contact', '09854698789 / 78945632'),
(18, 'from_time', '11:00'),
(19, 'to_time', '21:30'),
(20, 'address', 'XYZ Street, There City, Here, 2306');

-- --------------------------------------------------------

--
-- Table structure for table `timekeeping`
--

CREATE TABLE `timekeeping` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timekeeping`
--

INSERT INTO `timekeeping` (`id`, `user_id`, `time_in`, `time_out`) VALUES
(24, 0, '2024-06-08 04:41:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` enum('0','1','2') NOT NULL DEFAULT '2',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0=not verified, 1 = verified',
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `email`, `mobile`, `avatar`, `last_login`, `type`, `status`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', NULL, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', '', '', 'uploads/avatar-1.png?v=1639468007', NULL, '1', 1, '2021-01-20 14:02:37', '2024-06-09 03:00:52'),
(5, 'Charl Stevene', NULL, 'Cadigoy', 'herocdgy', '0192023a7bbd73250516f069df18b500', '', '', 'uploads\\Charl_Avatar.png', NULL, '1', 1, '2023-05-08 14:05:45', '2024-06-08 00:07:35'),
(6, 'Matthew Luis', NULL, 'Serrano', 'matthewluis', '0192023a7bbd73250516f069df18b500', '', '', 'uploads\\Matt_Avatar.png', NULL, '1', 1, '2023-05-09 17:01:12', '2024-06-08 00:07:41'),
(8, 'Jassim Phillip', NULL, 'Tagarda', 'jazz41jazz04', '0192023a7bbd73250516f069df18b500', '', '', 'uploads\\Jass_Avatar.png', NULL, '1', 1, '2023-05-09 23:07:53', '2024-06-08 02:29:12'),
(24, 'Test', NULL, 'Patient', 'testpatient', '81dc9bdb52d04dc20036dbd8313ed055', 'test@patient.com', '09285243690', NULL, NULL, '2', 1, '2024-06-09 08:39:57', '2024-06-09 08:42:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_history`
--
ALTER TABLE `admission_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `ahp_list`
--
ALTER TABLE `ahp_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_list`
--
ALTER TABLE `doctor_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nurse_list`
--
ALTER TABLE `nurse_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `patient_history`
--
ALTER TABLE `patient_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `patient_list`
--
ALTER TABLE `patient_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_list`
--
ALTER TABLE `room_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_type_id` (`room_type_id`);

--
-- Indexes for table `room_type_list`
--
ALTER TABLE `room_type_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timekeeping`
--
ALTER TABLE `timekeeping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission_history`
--
ALTER TABLE `admission_history`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ahp_list`
--
ALTER TABLE `ahp_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctor_list`
--
ALTER TABLE `doctor_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `nurse_list`
--
ALTER TABLE `nurse_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `patient_history`
--
ALTER TABLE `patient_history`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `patient_list`
--
ALTER TABLE `patient_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `room_list`
--
ALTER TABLE `room_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `room_type_list`
--
ALTER TABLE `room_type_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `timekeeping`
--
ALTER TABLE `timekeeping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admission_history`
--
ALTER TABLE `admission_history`
  ADD CONSTRAINT `admission_history_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room_list` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `admission_history_ibfk_3` FOREIGN KEY (`patient_id`) REFERENCES `patient_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD CONSTRAINT `patient_details_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_history`
--
ALTER TABLE `patient_history`
  ADD CONSTRAINT `patient_history_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_history_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `room_list`
--
ALTER TABLE `room_list`
  ADD CONSTRAINT `room_list_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_type_list` (`id`) ON DELETE CASCADE;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"hprms_db\",\"table\":\"users\"},{\"db\":\"hprms_db\",\"table\":\"doctor_list\"},{\"db\":\"hprms_db\",\"table\":\"timekeeping\"},{\"db\":\"hprms_db\",\"table\":\"patient_history\"},{\"db\":\"hprms_db\",\"table\":\"patient_list\"},{\"db\":\"phpmyadmin\",\"table\":\"pma__users\"},{\"db\":\"performance_schema\",\"table\":\"accounts\"},{\"db\":\"information_schema\",\"table\":\"CHECK_CONSTRAINTS\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'hprms_db', 'users', '{\"CREATE_TIME\":\"2024-06-09 02:38:20\",\"col_order\":[0,1,2,3,4,5,6,7,8,9,10,11,12,13],\"col_visib\":[1,1,1,1,1,1,1,1,1,1,1,1,1,1]}', '2024-06-09 00:57:02');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2024-06-09 02:23:00', '{\"Console\\/Mode\":\"collapse\",\"NavigationWidth\":286}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
