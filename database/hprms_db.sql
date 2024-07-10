-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2024 at 06:37 AM
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
(12, 18, 1, '2024-06-21 06:06:00', '2024-06-22 06:06:00', '1', '2024-06-22 06:06:30', NULL),
(13, 36, 8, '2024-06-19 06:52:00', '2024-06-20 06:52:00', '1', '2024-06-22 06:52:50', NULL),
(14, 37, 8, '2024-07-08 12:22:00', '2024-07-09 12:22:00', '1', '2024-07-10 12:22:34', NULL);

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
(17, 'Doctor MD1', 'general practitioner', 'doctor@md.com', '09285243690', 0, '2024-05-10 22:05:54', '2024-06-22 06:44:46'),
(18, 'Doctor MD2', 'pediatrician', '', '', 0, '2024-06-08 03:48:48', '2024-06-22 06:44:59'),
(19, 'Doctor MD3', 'ob-gyn', '', '', 0, '2024-06-22 05:37:56', '2024-06-22 06:45:13'),
(20, 'Doctor MD4', 'geriatrics', '', '', 0, '2024-06-22 05:38:05', '2024-06-22 06:45:39'),
(21, 'Doctor MD5', 'family medicine', '', '', 0, '2024-07-10 08:47:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_type_list`
--

CREATE TABLE `equipment_type_list` (
  `id` int(30) NOT NULL,
  `equipment` text NOT NULL,
  `description` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment_type_list`
--

INSERT INTO `equipment_type_list` (`id`, `equipment`, `description`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'test', 'test', 1, '2024-06-24 17:59:56', '2024-06-24 18:08:34'),
(2, 'test', 'test', 1, '2024-06-24 18:22:39', '2024-06-24 18:22:45'),
(3, 'test', 'test', 1, '2024-06-24 18:22:52', '2024-06-24 18:22:57'),
(4, 'test equipment', 'test equipment', 0, '2024-06-24 22:06:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hospital_staff`
--

CREATE TABLE `hospital_staff` (
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
-- Dumping data for table `hospital_staff`
--

INSERT INTO `hospital_staff` (`id`, `fullname`, `specialization`, `email`, `contact`, `delete_flag`, `date_created`, `date_added`) VALUES
(13, 'Staff Receptionist1', 'hospital reception ', '', '', 0, '2024-06-22 05:33:45', '2024-06-22 06:21:02'),
(14, 'Staff Janitor1', 'cleaning and sanitization', '', '', 0, '2024-06-22 05:34:08', '2024-06-22 06:20:41'),
(15, 'Staff Security Guard1', 'hospital security', '', '', 0, '2024-06-22 05:34:33', '2024-06-22 06:21:13'),
(16, '2', '', '', '', 1, '2024-06-22 05:35:30', '2024-06-22 05:35:44'),
(17, 'Staff IT Admin1', 'information technology', 'it@it.com', '09285243690', 0, '2024-06-22 06:14:54', '2024-06-22 16:42:29'),
(18, 'Staff Ambulance Driver1', 'ambulance driver', '', '', 0, '2024-06-22 06:18:57', '2024-06-22 06:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(30) NOT NULL,
  `equipment_type_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `quantity` int(5) NOT NULL DEFAULT 0,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `equipment_type_id`, `name`, `description`, `quantity`, `delete_flag`, `date_created`, `date_updated`) VALUES
(9, 4, 'test', 'test', 2, 1, '2024-06-24 22:12:15', '2024-06-24 22:32:50'),
(10, 4, 'test', 'test', 3, 0, '2024-06-24 22:33:08', '2024-06-24 22:48:27');

-- --------------------------------------------------------

--
-- Table structure for table `message_list`
--

CREATE TABLE `message_list` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `doctor_schedule` varchar(255) NOT NULL,
  `doctor_schedule_appointment_date` datetime NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message_list`
--

INSERT INTO `message_list` (`id`, `fullname`, `first_name`, `last_name`, `sex`, `doctor_schedule`, `doctor_schedule_appointment_date`, `email`, `mobile`, `appointment_date`, `message`, `status`, `date_created`) VALUES
(1, 'Jassim Phillip Tagarda', 'Jassim Phillip', 'Tagarda', 'LGBTQ+', 'Doctor MD1 (General Practitioner)', '2024-07-13 11:43:00', 'jazz41.jazz04@gmail.com', '09285243690', '0000-00-00 00:00:00', 'test1', 1, '2024-07-10 10:24:07');

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
(7, 'Nurse RN1', 'nurse', 'nurse@rn.com', '09285243690', 0, '2023-05-10 20:32:40', '2024-06-22 06:40:25'),
(8, 'example nurse', 'example nurse', 'example nurse', 'example nurse', 1, '2023-06-15 16:00:02', '2024-05-08 19:30:04'),
(9, 'Nurse RN2', 'nurse', '', '', 0, '2024-05-10 00:04:15', '2024-06-22 06:40:31'),
(10, 'Nurse RN3', 'nurse', '', '', 0, '2024-05-10 00:05:47', '2024-06-22 06:40:39'),
(11, 'Nurse RN4', '', '', '', 1, '2024-05-10 00:05:54', '2024-05-10 02:00:10'),
(12, 'Nurse RN4', 'nurse', '', '', 0, '2024-06-09 03:06:38', '2024-06-22 06:40:42'),
(13, 'Nurse RN5', 'nurse', '', '', 0, '2024-06-22 05:37:15', '2024-06-22 06:40:46'),
(14, 'Nurse RN6', 'nurse', '', '', 0, '2024-06-22 05:37:24', '2024-06-22 06:40:50'),
(15, 'Nurse RN7', 'nurse', '', '', 0, '2024-06-22 05:37:33', '2024-06-22 06:40:55'),
(16, 'Nurse RN8', 'nurse', '', '', 0, '2024-06-22 05:37:44', '2024-06-22 06:42:17'),
(17, 'Nursing Aid RNAID1', 'nursing aid', '', '', 0, '2024-06-22 06:40:12', NULL),
(18, 'Head Nurse HRN1', 'nursing supervisor', '', '', 0, '2024-06-22 06:43:10', NULL),
(19, 'Nursing Aid RNAID2', 'nursing aid', '', '', 0, '2024-06-22 06:43:47', '2024-06-22 06:44:05');

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
(19, 'firstname', 'PATIENT2'),
(19, 'middlename', ''),
(19, 'lastname', 'SAMPLE'),
(19, 'suffix', ''),
(19, 'gender', 'Male'),
(19, 'dob', ''),
(19, 'email', ''),
(19, 'contact', ''),
(19, 'address', ''),
(20, 'firstname', 'PATIENT3'),
(20, 'middlename', ''),
(20, 'lastname', 'SAMPLE'),
(20, 'suffix', ''),
(20, 'gender', 'Male'),
(20, 'dob', ''),
(20, 'email', 'jazz41.jazz04@gmail.com'),
(20, 'contact', '09285243690'),
(20, 'address', ''),
(21, 'firstname', 'PATIENT4'),
(21, 'middlename', ''),
(21, 'lastname', 'SAMPLE'),
(21, 'suffix', ''),
(21, 'gender', 'Male'),
(21, 'dob', ''),
(21, 'email', ''),
(21, 'contact', ''),
(21, 'address', ''),
(22, 'firstname', 'PATIENT5'),
(22, 'middlename', ''),
(22, 'lastname', 'SAMPLE'),
(22, 'suffix', ''),
(22, 'gender', 'Male'),
(22, 'dob', ''),
(22, 'email', ''),
(22, 'contact', ''),
(22, 'address', ''),
(23, 'firstname', 'PATIENT6'),
(23, 'middlename', ''),
(23, 'lastname', 'SAMPLE'),
(23, 'suffix', ''),
(23, 'gender', 'Male'),
(23, 'dob', ''),
(23, 'email', ''),
(23, 'contact', ''),
(23, 'address', ''),
(26, 'firstname', 'PATIENT7'),
(26, 'middlename', ''),
(26, 'lastname', 'SAMPLE'),
(26, 'suffix', ''),
(26, 'gender', 'Male'),
(26, 'dob', ''),
(26, 'email', ''),
(26, 'contact', ''),
(26, 'address', ''),
(27, 'firstname', 'PATIENT8'),
(27, 'middlename', ''),
(27, 'lastname', 'SAMPLE'),
(27, 'suffix', ''),
(27, 'gender', 'Male'),
(27, 'dob', ''),
(27, 'email', ''),
(27, 'contact', ''),
(27, 'address', ''),
(28, 'firstname', 'PATIENT9'),
(28, 'middlename', ''),
(28, 'lastname', 'SAMPLE'),
(28, 'suffix', ''),
(28, 'gender', 'Male'),
(28, 'dob', ''),
(28, 'email', ''),
(28, 'contact', ''),
(28, 'address', ''),
(18, 'firstname', 'PATIENT1'),
(18, 'middlename', 'MNU'),
(18, 'lastname', 'SAMPLE'),
(18, 'suffix', ''),
(18, 'gender', 'Male'),
(18, 'dob', '1991-10-15'),
(18, 'email', 'patient@patient.com'),
(18, 'contact', '09285243690'),
(18, 'address', 'B2 L9 Magnolia St., West Fairview Park Subd. Fairview'),
(36, 'firstname', 'PATIENT'),
(36, 'middlename', 'MNU'),
(36, 'lastname', 'SAMPLE'),
(36, 'suffix', ''),
(36, 'gender', 'Male'),
(36, 'dob', '1991-10-15'),
(36, 'email', 'patient@patient.com'),
(36, 'contact', '09285243690'),
(36, 'address', 'B2 L9 Magnolia St., West Fairview Park Subd. Fairview'),
(37, 'firstname', 'Test'),
(37, 'middlename', 'No Middle Name'),
(37, 'lastname', 'Patient'),
(37, 'suffix', ''),
(37, 'gender', 'Male'),
(37, 'dob', '1991-10-15'),
(37, 'email', 'test@patient.com'),
(37, 'contact', '09285243690'),
(37, 'address', 'B2 L9 Magnolia St., West Fairview Park Subd. Fairview');

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

--
-- Dumping data for table `patient_history`
--

INSERT INTO `patient_history` (`id`, `patient_id`, `illness`, `diagnosis`, `treatment`, `remarks`, `doctor_id`, `date_created`, `date_updated`) VALUES
(12, 18, 'cephalalgia/acute migraine.', 'severe headaches.', 'provide pain medication.\r\nRX. \r\nRM PARACETAMOL 500 MG TAB, \r\nRM MEFENAMIC ACID 500 MG TAB.', 'the patient has no history of severe illness.\r\nfamily history includes relatives diagnosed with high blood pressure and diabetes.\r\nthe patient has a normal temperature, pulse rate, and respiratory rate.\r\nblood pressure is slightly elevated but within normal range.\r\nfor observation if blood pressure continues to fluctuate.\r\n', 17, '2024-06-22 06:05:54', '2024-06-22 06:13:48'),
(13, 36, 'physical trauma', 'physical injuries to the head and extremities', 'admit to the emergency room for urgent care', 'blunt force trauma to the head and extremities.\r\nprovided pain medication and IV fluids.', 17, '2024-06-22 06:52:32', NULL),
(14, 37, 'physical trauma', 'physical injuries to the head and extremities', 'admit to the emergency room for urgent care', 'blunt force trauma to the head and extremities. provided pain killer medication and IV fluids.', 17, '2024-07-10 12:22:05', NULL);

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
(18, 'PA-2024060001', 'SAMPLE PATIENT1 MNU', 0, 0, '2024-06-22 05:45:38', '2024-06-22 06:08:01'),
(19, 'PA-2024060002', 'SAMPLE PATIENT2', 0, 0, '2024-06-22 05:45:56', NULL),
(20, 'PA-2024060003', 'SAMPLE PATIENT3', 0, 0, '2024-06-22 05:46:08', NULL),
(21, 'PA-2024060004', 'SAMPLE PATIENT4', 0, 0, '2024-06-22 05:46:19', NULL),
(22, 'PA-2024060005', 'SAMPLE PATIENT5', 0, 0, '2024-06-22 05:46:36', NULL),
(23, 'PA-2024060006', 'SAMPLE PATIENT6', 0, 0, '2024-06-22 05:47:14', NULL),
(26, 'PA-2024060007', 'SAMPLE PATIENT7', 0, 0, '2024-06-22 05:49:30', NULL),
(27, 'PA-2024060008', 'SAMPLE PATIENT8', 0, 0, '2024-06-22 05:49:47', NULL),
(28, 'PA-2024060009', 'SAMPLE PATIENT9', 0, 0, '2024-06-22 05:50:04', NULL),
(36, 'PA-2024060010', 'SAMPLE PATIENT MNU', 0, 0, '2024-06-22 06:47:53', '2024-06-22 06:49:15'),
(37, 'PA-2024070001', 'PATIENT TEST NO MIDDLE NAME', 0, 0, '2024-07-10 12:20:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `patient_name` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `billing_reference` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `patient_id`, `code`, `patient_name`, `amount`, `payment_method`, `payment_status`, `payment_date`, `billing_reference`) VALUES
(1, 18, '', 'SAMPLE PATIENT MNU', 1.00, 'gcash', 'Pending', '2024-06-24 06:12:43', NULL),
(3, 18, '', 'SAMPLE PATIENT MNU', 10.00, 'gcash', 'Pending', '2024-06-24 19:00:15', NULL),
(4, 18, '', 'SAMPLE PATIENT MNU', 10.00, 'gcash', 'Pending', '2024-06-24 19:01:03', NULL),
(5, 18, '', 'SAMPLE PATIENT MNU', 100.00, 'cash', 'Pending', '2024-06-27 18:44:11', 'BR-667db2fbeb520'),
(6, 18, '', 'SAMPLE PATIENT MNU', 100.00, 'paymaya', 'Pending', '2024-06-27 18:45:22', ''),
(7, 36, '', 'SAMPLE PATIENT MNU', 1000.00, 'cash', 'Pending', '2024-06-27 18:53:49', 'BR-667db53d9b920'),
(8, 36, '', 'SAMPLE PATIENT MNU', 10000.00, 'cash', 'Pending', '2024-06-27 18:57:39', 'BR-667db623c4573');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `medication_name` varchar(100) DEFAULT NULL,
  `dosage` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `interval_hours` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `patient_id`, `medication_name`, `dosage`, `start_date`, `end_date`, `interval_hours`, `doctor_id`, `notes`, `user_id`) VALUES
(38, NULL, 'amoxicilin', '1 every 8 hours', '2024-06-24', '2024-06-28', 8, 17, 'x', 18),
(39, NULL, 'amoxicilin', '1 every 8 hours', '2024-06-25', '2024-06-27', 8, 17, 'x', 20),
(40, NULL, 'amoxicilin', '1 every 8 hours', '2024-06-25', '2024-06-28', 8, 17, 'x', 21),
(41, NULL, 'amoxicilin', '1 every 8 hours', '2024-06-25', '2024-06-28', 8, 17, 'x', 21),
(42, NULL, 'amoxicilin', '1 every 8 hours', '2024-06-28', '2024-06-30', 8, 17, 'x', 18),
(43, NULL, 'analgesics, etodolac, tramadol', 'etodolac 500mg , Tramadol 0.10ml syringe', '2024-07-08', '2024-07-09', 4, 17, 'provide etodolac 500mg once every 4 hours, administer Tramadol 0.10ml syringe once every 4 hours, observe patient and adjust dosage as necessary until recovered', 37);

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) DEFAULT NULL,
  `reminder_time` datetime DEFAULT NULL,
  `sent` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `section` varchar(50) NOT NULL,
  `capacity` int(11) NOT NULL,
  `current_capacity` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `section`, `capacity`, `current_capacity`, `status`) VALUES
(1, 404, '1A', 6, 6, ''),
(2, 404, '2B', 6, 6, ''),
(3, 404, '3C', 6, 6, ''),
(4, 404, '4D', 6, 6, ''),
(5, 404, '5E', 6, 6, '');

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
(1, 3, 'Room-201', 'Sample Ward Good for 6 Patients', 6, 0, '2021-12-30 10:33:24', '2024-06-22 06:36:13'),
(2, 1, 'Room-301', 'Sample Single Bed Room', 1, 0, '2021-12-30 10:33:46', NULL),
(3, 2, 'Room-302', 'Sample 2 Bed Room', 2, 0, '2021-12-30 10:34:06', NULL),
(4, 4, 'Room-202', 'Sample Ward Good for 12 Patents', 12, 0, '2021-12-30 10:35:01', '2024-06-22 06:36:17'),
(5, 4, 'Room-303', 'Sample Deleted Room', 101, 1, '2021-12-30 10:35:19', '2021-12-30 10:35:52'),
(8, 6, 'Room-404', 'Sample 24/7 Emergency Room with 24 Beds', 24, 0, '2024-06-22 06:34:44', NULL),
(9, 8, 'test', 'test', 1, 1, '2024-06-24 23:21:09', '2024-06-24 23:21:37');

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
(1, 'Single Room', 'Private Room with Single Patient Bed', 0, '2021-12-30 10:05:45', '2024-06-22 06:37:03'),
(2, '2 Bed Room', 'Private Room with 2 Bed Room', 0, '2021-12-30 10:10:56', '2024-06-22 06:36:57'),
(3, 'Ward 6', 'Ward Room with 6 Beds', 0, '2021-12-30 10:11:54', '2024-06-22 06:37:09'),
(4, 'Ward 12', 'Ward Room with 12 Beds', 0, '2021-12-30 10:12:38', '2024-06-22 06:37:07'),
(5, 'ward 32', 'Sample Deleted Room Type', 1, '2021-12-30 10:19:17', '2021-12-30 10:19:22'),
(6, '24/7 Emergency Room', 'Emergency Room with a 24 Bed Capacity', 0, '2024-06-22 06:31:58', '2024-06-22 06:37:00'),
(7, 'test', 'test', 1, '2024-06-24 18:00:24', '2024-06-24 18:00:28'),
(8, 'test', 'test', 1, '2024-06-24 23:21:01', '2024-06-24 23:21:18');

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
  `user_id` int(60) NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `type` enum('0','1','2','3') NOT NULL DEFAULT '2',
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
(24, 'Test', NULL, 'Patient', 'testpatient', '81dc9bdb52d04dc20036dbd8313ed055', 'test@patient.com', '09285243690', NULL, NULL, '2', 1, '2024-06-09 08:39:57', '2024-06-26 05:21:30'),
(27, 'Test', NULL, 'Doctor', 'testdoctor', '81dc9bdb52d04dc20036dbd8313ed055', 'md@md.com', '09285243690', NULL, NULL, '0', 1, '2024-06-23 12:51:56', '2024-07-10 08:16:46'),
(28, 'Test', NULL, 'Driver', 'testdriver', '81dc9bdb52d04dc20036dbd8313ed055', 'driver@driver.com', '09285243690', NULL, NULL, '3', 1, '2024-07-10 06:46:32', '2024-07-10 06:46:52'),
(32, 'Test', NULL, 'Nurse', 'testnurse', 'e10adc3949ba59abbe56e057f20f883e', 'nurse@rn.com', '09285243690', NULL, NULL, '0', 1, '2024-07-10 08:19:22', '2024-07-10 08:20:17');

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
-- Indexes for table `doctor_list`
--
ALTER TABLE `doctor_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_type_list`
--
ALTER TABLE `equipment_type_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital_staff`
--
ALTER TABLE `hospital_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_type_id` (`equipment_type_id`);

--
-- Indexes for table `message_list`
--
ALTER TABLE `message_list`
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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`patient_id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescription_id` (`prescription_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
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
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `doctor_list`
--
ALTER TABLE `doctor_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `equipment_type_list`
--
ALTER TABLE `equipment_type_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hospital_staff`
--
ALTER TABLE `hospital_staff`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `message_list`
--
ALTER TABLE `message_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nurse_list`
--
ALTER TABLE `nurse_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `patient_history`
--
ALTER TABLE `patient_history`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `patient_list`
--
ALTER TABLE `patient_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room_list`
--
ALTER TABLE `room_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `room_type_list`
--
ALTER TABLE `room_type_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `timekeeping`
--
ALTER TABLE `timekeeping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`equipment_type_id`) REFERENCES `equipment_type_list` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient_list` (`id`);

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reminders`
--
ALTER TABLE `reminders`
  ADD CONSTRAINT `reminders_ibfk_1` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`);

--
-- Constraints for table `room_list`
--
ALTER TABLE `room_list`
  ADD CONSTRAINT `room_list_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_type_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
