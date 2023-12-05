-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2023 at 04:54 AM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pds_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `acrs`
--

CREATE TABLE `acrs` (
  `id` int NOT NULL,
  `employee_id` int DEFAULT '0',
  `emp_name` int DEFAULT '0',
  `designation` int DEFAULT '0',
  `department` int DEFAULT '0',
  `office_name` int DEFAULT '0',
  `acr_year` year DEFAULT NULL,
  `score` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `file` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `rack_number` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bill_number` int NOT NULL DEFAULT '0',
  `file_number` int NOT NULL DEFAULT '0',
  `remarks` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `acrs`
--

INSERT INTO `acrs` (`id`, `employee_id`, `emp_name`, `designation`, `department`, `office_name`, `acr_year`, `score`, `file`, `rack_number`, `created_at`, `updated_at`, `bill_number`, `file_number`, `remarks`, `status`) VALUES
(2, 1, 1, 1, 1, 1, 2023, '11', '1', 11, '2023-11-05 05:43:35', '2023-11-05 05:43:35', 11, 11, '1', NULL),
(3, 1, 0, 0, 0, 0, NULL, NULL, NULL, 0, '2023-11-05 08:31:05', '2023-11-05 08:31:05', 0, 0, NULL, NULL),
(4, 1, 0, 0, 0, 0, NULL, NULL, NULL, 0, '2023-11-05 08:31:30', '2023-11-05 08:31:30', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blood_groups`
--

CREATE TABLE `blood_groups` (
  `id` int NOT NULL,
  `employee_id` int DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `last_donate` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `blood_groups`
--

INSERT INTO `blood_groups` (`id`, `employee_id`, `blood_group`, `last_donate`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'o+', 24, 0, '2023-11-02 09:36:06', '2023-11-02 10:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `social_media` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `phone_number`, `email`, `social_media`, `address`, `created_at`, `updated_at`) VALUES
(1, 'stringup', 'stringup', 'stringup', 'stringup', '2022-09-08 11:23:04', '2022-09-08 11:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(2, 'shakiur', 'shakiur.cse@gmail.com', 'test', 'aaaaaaaaaaaaaaa', '2022-09-27 11:16:49', '2022-09-27 11:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int NOT NULL,
  `dept_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `create_at` date DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept_name`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'png', '2023-10-21', 1, '2023-10-23 06:56:26', '2023-10-23 06:56:26');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int NOT NULL,
  `designation_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `create_at` date DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation_name`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'didar', '2023-03-23', 0, '2023-10-23 06:54:10', '2023-11-13 06:23:51');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `gender` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `mobile_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `blood_group` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `nid_number` int DEFAULT '0',
  `passport_number` int DEFAULT '0',
  `department` int DEFAULT NULL,
  `designation` int DEFAULT '0',
  `office` int DEFAULT '0',
  `present_addr_houseno` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `present_addr_roadno` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `present_addr_area` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `present_addr_upazila` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `present_addr_district` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `present_addr_postcode` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `permanent_addr_houseno` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `permanent_addr_roadno` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `permanent_addr_area` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `permanent_addr_upazila` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `permanent_addr_district` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `permanent_addr_postcode` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `job_grade` int DEFAULT '0',
  `job_location` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `joining_date` date DEFAULT NULL,
  `freedom_fighter_status` int DEFAULT '0',
  `father_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `education_history` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `document` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `mother_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `spouse_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `number_of_child` int DEFAULT '0',
  `emergency_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_relation` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_phn_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_addr` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_district` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `image`, `name`, `gender`, `mobile_number`, `email`, `date_of_birth`, `blood_group`, `nid_number`, `passport_number`, `department`, `designation`, `office`, `present_addr_houseno`, `present_addr_roadno`, `present_addr_area`, `present_addr_upazila`, `present_addr_district`, `present_addr_postcode`, `permanent_addr_houseno`, `permanent_addr_roadno`, `permanent_addr_area`, `permanent_addr_upazila`, `permanent_addr_district`, `permanent_addr_postcode`, `job_grade`, `job_location`, `joining_date`, `freedom_fighter_status`, `father_name`, `education_history`, `document`, `mother_name`, `spouse_name`, `number_of_child`, `emergency_name`, `emergency_relation`, `emergency_phn_number`, `emergency_email`, `emergency_addr`, `emergency_district`, `status`, `created_at`, `updated_at`) VALUES
(1, 29, 'photo-64943e66d297e-2023-Jun-Thu.png', 'Shakiur', 'male', '01738528292', 'shakiur.cse@gmail.com', '1977-10-22', 'A+', 0, 0, 1, 1, 0, '34', '13', 'adsfsd', 'aaa', 'Dhaka', '1216', '3', '4', '15', 'bbbb', 'Rangpur', '5400', 3, 'Mirpur1', '2023-04-06', 0, '4 ahmed', '[{\"exam_name\":\"Bsc\",\"institute_name\":\"UODA\",\"district\":\"Dhaka\",\"upazila\":\"\",\"subject\":\"CSE\",\"passing_year\":\"2013\",\"grade\":\"x\"},{\"exam_name\":\"HSC\",\"institute_name\":\"Technical School & College\",\"district\":\"Rangpur\",\"upazila\":\"\",\"subject\":\"Science\",\"passing_year\":\"2006\",\"grade\":\"x\"},{\"exam_name\":\"SSC\",\"institute_name\":\"Technical School and College\",\"district\":\"Rangpur\",\"upazila\":\"\",\"subject\":\"Science\",\"passing_year\":\"2004\",\"grade\":\"x\"}]', '', 'b ahmed', 'c ahmedl', 4, 'Arafat2', 'Brother', '1234567890', 'arafath@email.com', 'Khilkhet', 'Dhaka3', 1, '2023-04-11 05:53:47', '2023-09-11 08:59:25'),
(4, 85, '', 'didar', 'male', '0', '', '1950-01-22', 'O+', 0, 0, 1, 1, 0, 'dfg', 'fg', 'df', 'df', 'df', '23', '12', 'fg', 'df', 'df', 'df', '32', 1, 'fg', '2023-03-27', 0, 'fg', 'fg', '', 'fg', 'fg', 0, 'hf', 'dg', '0', 's@gmail.com', 'ttttttttt', '', 1, '2023-10-22 10:39:35', '2023-10-22 10:39:35'),
(31, 86, NULL, 'Ahsanul', NULL, '01767590306', NULL, NULL, NULL, 0, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-11-07 08:31:05', '2023-11-07 08:31:05'),
(32, 89, NULL, 'didar', NULL, '01648414032', NULL, NULL, NULL, 0, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-11-07 08:55:25', '2023-11-07 08:55:25'),
(33, 90, 'df', 'sdf', 'fg', '0', 's@gmail.com', '2023-11-08', 's', 2351, 124, 1, 1, 0, 'hd', 'dfh', 'sg', 'sdg', 'sdg', 'sdg', 'sdg', 'sdg', 'sdgds', 'sd', 'sdf', '324', 1, 'dfg', '2023-11-08', 0, 'sdf', 'ssd', '', 'sdf', 'sd', 0, 'sdf', 'sdf', '0', 's@gmail.com', 'wer', '', 0, '2023-11-08 04:23:15', '2023-11-08 04:23:15'),
(34, 91, '2', 'sdf', 'df', '0', 'dd@gmail.com', '2023-11-08', 'o', 464, 565, 6, 5, 5, 'g', 'dfg', 'df', 'df', 'df', '56', '56', '56', 'fg', 'fg', 'fg', '65', 6, '6', '2023-11-08', 1, 'fg', 'dg', '', 'fg', 'fg', 0, '34', 'gh', '0', 'dd@gmail.com', 'er', '', 0, '2023-11-27 04:39:50', '2023-11-27 04:39:50'),
(35, 93, '2', 'sdf', 'df', '0', 'ddtt@gmail.com', '2023-11-08', 'o', 464, 565, 6, 5, 5, 'g', 'dfg', 'df', 'df', 'df', '56', '56', '56', 'fg', 'fg', 'fg', '65', 6, '6', '2023-11-08', 1, 'fg', 'dg', '', 'fg', 'fg', 0, '34', 'gh', '0', 'dd@gmail.com', 'er', '', 0, '2023-11-27 04:40:44', '2023-11-27 04:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `freedom_fighters`
--

CREATE TABLE `freedom_fighters` (
  `id` int NOT NULL,
  `employee_id` int DEFAULT '0',
  `freedom_fighter_num` int DEFAULT '0',
  `fighting_divi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Sector` int DEFAULT '0',
  `status` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `freedom_fighters`
--

INSERT INTO `freedom_fighters` (`id`, `employee_id`, `freedom_fighter_num`, `fighting_divi`, `Sector`, `status`, `created_at`, `updated_at`) VALUES
(4, 35, 56, 'chg', 9, 0, '2023-11-27 04:40:44', '2023-11-27 04:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int NOT NULL,
  `job_grade` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `job_grade`, `status`, `created_at`, `updated_at`) VALUES
(4, 'rt', 1, '2023-11-26 06:44:00', '2023-11-26 06:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int NOT NULL,
  `employee_id` int NOT NULL DEFAULT '0',
  `leave_type` int DEFAULT '0',
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `day` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `employee_id`, `leave_type`, `from_date`, `to_date`, `day`, `description`, `status`, `created_at`, `updated_at`) VALUES
(17, 1, 8, '2023-10-22', '2023-10-22', '4', 'nnn', 1, '2023-10-31 10:45:37', '2023-10-31 10:45:37'),
(18, 1, 8, '2023-10-22', '2023-10-22', '3', 'nnn', 1, '2023-10-31 10:45:57', '2023-10-31 10:45:57'),
(19, 1, 12, '2023-10-22', '2023-10-22', '2', 'f', 1, '2023-10-31 10:50:40', '2023-10-31 10:50:40'),
(20, 1, 12, '2023-10-22', '2023-10-22', '2', 'f', 1, '2023-10-31 10:51:52', '2023-10-31 10:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` int NOT NULL,
  `leave_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `days` int NOT NULL DEFAULT '0',
  `create_at` date DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `leave_type`, `days`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
(12, 'emergency', 10, '2023-03-23', 1, '2023-10-25 11:44:31', '2023-10-25 11:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `subject` text,
  `phone` int DEFAULT NULL,
  `office` text,
  `designation` text,
  `from` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `subject`, `phone`, `office`, `designation`, `from`, `message`, `created_at`, `updated_at`) VALUES
(6, 'Leave', NULL, 'GHIT', 'Software Engineer', NULL, 'I am unable to join today\'s office due to family problem. Please consider my situation.', '2023-11-06 08:37:17', '2023-11-06 08:37:17'),
(7, 'tdy', NULL, 'hgj', 'hj', 'fhgj', 'fjh', '2023-11-06 08:39:23', '2023-11-06 08:39:23'),
(8, 'tdy', NULL, 'hgj', 'hj', 'fhgj', 'fjh', '2023-11-06 08:40:00', '2023-11-06 08:40:00'),
(9, 'tdy', NULL, 'hgj', 'hj', 'fhgj', 'fjh', '2023-11-06 08:42:48', '2023-11-06 08:42:48'),
(10, 'tdy', NULL, 'hgj', 'hj', 'fhgj', 'fjh', '2023-11-06 08:42:52', '2023-11-06 08:42:52'),
(11, '34s', NULL, 'sdfg', 'sfdg', 'sfgd', 'dgf', '2023-11-06 08:43:44', '2023-11-06 08:43:44'),
(12, '34s', 345, 'sdfg', 'sfdg', 'sfgd', 'dgf', '2023-11-06 08:44:43', '2023-11-06 08:44:43'),
(13, '34s', 1767590306, 'sdfg', 'sfdg', 'sfgd', 'dgf', '2023-11-06 08:45:01', '2023-11-06 08:45:01'),
(14, '34s', 1924529986, 'sdfg', 'sfdg', 'sfgd', 'dgf', '2023-11-06 08:45:26', '2023-11-06 08:45:26'),
(15, '34s', 1754761489, 'sdfg', 'sfdg', 'sfgd', 'dgf', '2023-11-06 08:46:33', '2023-11-06 08:46:33'),
(16, 'sr', 1751684550, 'dgf', 'fg', 'gf', 'dgf', '2023-11-06 08:48:04', '2023-11-06 08:48:04'),
(17, 'sr', 1767590306, 'dgf', 'fg', 'gf', 'dgf', '2023-11-06 08:48:24', '2023-11-06 08:48:24'),
(18, 'sr', 1767590306, 'dgf', 'fg', 'gf', 'dgf', '2023-11-06 08:49:46', '2023-11-06 08:49:46'),
(19, 'leave', 1767590306, 'Ghit', 'ENG', 'GHIT', 'GHIT', '2023-11-06 10:52:08', '2023-11-06 10:52:08'),
(20, 'test', 1924529986, 'ghit', 'intern', 'dhaka', 'dhaka', '2023-11-06 11:22:48', '2023-11-06 11:22:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `id` int NOT NULL,
  `office_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `office_name`, `status`, `created_at`, `updated_at`) VALUES
(3, 'it', 1, '2023-10-23 06:57:31', '2023-10-23 06:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `designation` int NOT NULL DEFAULT '0',
  `present_addr_houseno` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `present_addr_roadno` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `present_addr_area` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `present_addr_upazila` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `present_addr_district` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `present_addr_postcode` int DEFAULT '0',
  `permanent_addr_houseno` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `permanent_addr_roadno` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `permanent_addr_area` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `permanent_addr_upazila` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `permanent_addr_district` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `permanent_addr_postcode` int DEFAULT '0',
  `department` int DEFAULT '0',
  `job_location` int DEFAULT '0',
  `joining_date` date DEFAULT NULL,
  `father_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `spouse_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `number_of_cheild` int DEFAULT '0',
  `emergency_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_relation` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_phn_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_addr` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_distict` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int NOT NULL,
  `employee_id` int NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `promotion_ref_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `promotion_date` date DEFAULT NULL,
  `to_office` int NOT NULL DEFAULT '0',
  `from_office` int NOT NULL DEFAULT '0',
  `to_department` int NOT NULL DEFAULT '0',
  `from_department` int NOT NULL DEFAULT '0',
  `to_designation` int NOT NULL DEFAULT '0',
  `from_designation` int NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `employee_id`, `name`, `promotion_ref_number`, `promotion_date`, `to_office`, `from_office`, `to_department`, `from_department`, `to_designation`, `from_designation`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'arafat', '2211', '2023-03-23', 0, 0, 0, 0, 0, 0, 'good', 1, '2023-03-28 04:20:51', '2023-03-28 05:38:18'),
(3, 1, NULL, '1', '2023-03-23', 1, 1, 1, 1, 1, 1, 's', 1, '2023-11-26 07:05:42', '2023-11-26 07:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `registered_guest_message_replies`
--

CREATE TABLE `registered_guest_message_replies` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `message_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `replied_by` int DEFAULT NULL,
  `replied_at` datetime DEFAULT NULL,
  `event_id` int DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registered_guest_message_replies`
--

INSERT INTO `registered_guest_message_replies` (`id`, `name`, `email`, `title`, `message_body`, `replied_by`, `replied_at`, `event_id`, `subject`, `created_at`, `updated_at`) VALUES
(1, 'sdfdsf', 'shakiur.cse@gmail.com', NULL, '<p>sdfsdfds</p>', 1, '2022-09-28 12:29:57', 1, 'abc', '2022-09-28 12:29:57', '2022-09-28 12:29:57'),
(2, 'sdfdsf', 'shakiur.cse@gmail.com', NULL, '<p>sdfsdfds</p>', 1, '2022-09-28 12:31:12', 1, 'abc', '2022-09-28 12:31:12', '2022-09-28 12:31:12'),
(3, 'sdfdsf', 'shakiur.cse@gmail.com', NULL, '<p>dfsdfdsf</p>', 1, '2022-09-28 12:31:49', 1, 'aaaaaa', '2022-09-28 12:31:49', '2022-09-28 12:31:49'),
(4, NULL, 'shakiur.cse@gmail.com', NULL, NULL, 1, '2022-09-29 17:16:56', 1, NULL, '2022-09-29 17:16:56', '2022-09-29 17:16:56'),
(5, NULL, 'shakiur.cse@gmail.com', NULL, '<p>helllllllo</p>', 1, '2022-09-29 17:29:56', 1, 'Hello', '2022-09-29 17:29:56', '2022-09-29 17:29:56');

-- --------------------------------------------------------

--
-- Table structure for table `rosters`
--

CREATE TABLE `rosters` (
  `id` int NOT NULL,
  `employee_id` int DEFAULT '0',
  `office_schedule_id` int DEFAULT '0',
  `date` date DEFAULT NULL,
  `remark` tinytext,
  `status` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` int NOT NULL,
  `employee_id` int NOT NULL,
  `grade` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `basic_pay` int NOT NULL DEFAULT '0',
  `house_rent` int NOT NULL DEFAULT '0',
  `medical_allowance` int NOT NULL DEFAULT '0',
  `others` int NOT NULL DEFAULT '0',
  `salary_amount` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `employee_id`, `grade`, `created_at`, `updated_at`, `basic_pay`, `house_rent`, `medical_allowance`, `others`, `salary_amount`, `status`) VALUES
(3, 1, 2, '2023-11-02 06:57:39', '2023-11-02 10:06:38', 2, 2, 2, 1, 7, 1),
(5, 0, 3, '2023-11-02 08:53:42', '2023-11-02 08:53:42', 3, 3, 3, 3, 12, 0),
(7, 0, 4, '2023-11-02 09:05:37', '2023-11-02 09:05:37', 4, 4, 4, 4, 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `site_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `site_logo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `favicon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `copy_write` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `site_logo`, `favicon`, `copy_write`, `created_at`, `updated_at`) VALUES
(1, 'Test_update', 'Test_update', 'Test_update', 'Test_update', '2022-09-07 06:20:49', '2022-09-07 06:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `speakers`
--

CREATE TABLE `speakers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `speakers`
--

INSERT INTO `speakers` (`id`, `name`, `image`, `occupation`, `organization`, `social_link`, `details`, `country`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mutarika Pruksapong', 'speaker_image_1664399165.png', 'Programme Management Officer', 'Global Education and Training Institute (GETI) UNDRR', '{\"speakerFacebook\":\"#\",\"speakerInstagram\":\"#\",\"speakerTwitter\":\"#\",\"speakerLinkedin\":\"#\"}', '', 'South Korea', 3, 1, '2022-09-08 08:53:08', '2022-10-02 18:07:55'),
(2, 'Sidnel Furtado Fernandes', 'speaker_image_1664357015.png', 'Director of Civil Defense Campinas', '', '{\"speakerFacebook\":\"#\",\"speakerInstagram\":\"#\",\"speakerTwitter\":\"#\",\"speakerLinkedin\":\"#\"}', '', 'Brazil', 4, 0, '2022-09-13 05:10:39', '2022-10-02 18:07:40'),
(3, 'Sanjaya Bhatia', 'speaker_image_1664358192.png', 'Head, Global Education and Training Institute (GETI) UNDRR', '', '{\"speakerFacebook\":\"#\",\"speakerInstagram\":\"#\",\"speakerTwitter\":\"#\",\"speakerLinkedin\":\"#\"}', '', 'India', 5, 1, '2022-09-13 05:49:44', '2022-10-02 18:07:31'),
(4, 'Sissa Bekombo Priso', 'Sissa_BEKOMBO.jpeg', 'Resilience Project Manager', '', '{\"speakerFacebook\":\"#\",\"speakerInstagram\":\"#\",\"speakerTwitter\":\"#\",\"speakerLinkedin\":\"#\"}', '', 'France', 6, 1, '2022-09-13 05:50:57', '2022-10-02 18:07:23'),
(5, 'Didier Soto', 'didier-soto.jpeg', 'Head of Digital Solutions & Climate Change Resilience Project Manager', '', '{\"speakerFacebook\":\"#\",\"speakerInstagram\":\"#\",\"speakerTwitter\":\"#\",\"speakerLinkedin\":\"#\"}', '', 'France', 7, 1, '2022-09-13 05:50:57', '2022-10-02 18:07:07'),
(6, 'Md. Atiqul Huq', 'speaker_image_1664399385.png', 'Director General of Ministry of Disaster Management and Relief', 'DDM', '{\"speakerFacebook\":\"#\",\"speakerInstagram\":\"#\",\"speakerTwitter\":\"#\",\"speakerLinkedin\":\"#\"}', '', 'Bangladesh', 2, 1, '2022-09-22 17:18:37', '2022-09-29 03:09:45'),
(7, 'Md Kamrul Hasan', 'kamrul-hasan.png', 'GOVERNMENT OF THE PEOPLEÃ¢â‚¬â„¢S REPUBLIC OF BANGLADESH', '', '{\"speakerFacebook\":\"#\",\"speakerInstagram\":\"#\",\"speakerTwitter\":\"#\",\"speakerLinkedin\":\"#\"}', '', 'Bangladesh', 1, 1, '2022-09-22 17:18:37', '2022-10-02 18:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` int NOT NULL,
  `employee_id` int NOT NULL DEFAULT '0',
  `training_center_name` int DEFAULT '0',
  `training_score` int DEFAULT '0',
  `training_feedback` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `training_strt_date` date DEFAULT NULL,
  `training_end_date` date DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`id`, `employee_id`, `training_center_name`, `training_score`, `training_feedback`, `training_strt_date`, `training_end_date`, `description`, `status`, `created_at`, `updated_at`) VALUES
(2, 32, 0, 0, NULL, NULL, NULL, NULL, 0, '2023-11-02 06:26:15', '2023-11-02 06:26:15');

-- --------------------------------------------------------

--
-- Table structure for table `training_setups`
--

CREATE TABLE `training_setups` (
  `id` int NOT NULL,
  `training_name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `create_at` date DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `training_setups`
--

INSERT INTO `training_setups` (`id`, `training_name`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
(2, 'hhh', '2023-04-29', 0, '2023-10-19 10:05:32', '2023-10-19 10:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` int NOT NULL,
  `employee_id` int NOT NULL DEFAULT '0',
  `to_office` int DEFAULT '0',
  `from_office` int DEFAULT '0',
  `to_department` int DEFAULT '0',
  `from_department` int DEFAULT '0',
  `to_designation` int DEFAULT '0',
  `from_designation` int DEFAULT '0',
  `transfer_order` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `transfer_type` int DEFAULT '0',
  `transfer_date` date DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `transfer_letter` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transfer_order_number` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `employee_id`, `to_office`, `from_office`, `to_department`, `from_department`, `to_designation`, `from_designation`, `transfer_order`, `transfer_type`, `transfer_date`, `join_date`, `transfer_letter`, `status`, `created_at`, `updated_at`, `transfer_order_number`) VALUES
(31, 31, 1, 1, 1, 1, 1, 1, '1', 1, '2023-10-21', '2023-10-21', '1', 1, '2023-10-23 06:49:29', '2023-10-23 06:49:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_types`
--

CREATE TABLE `transfer_types` (
  `id` int NOT NULL,
  `employee_id` int NOT NULL DEFAULT '0',
  `title` tinytext COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` int UNSIGNED DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` int DEFAULT NULL,
  `otp_expire_at` datetime DEFAULT NULL,
  `otp_verified` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `phone`, `status`, `email_verified_at`, `password`, `remember_token`, `otp`, `otp_expire_at`, `otp_verified`, `created_at`, `updated_at`) VALUES
(29, 1, 'Shakiur Rahman', 'shakiur.cse@gmail.com', NULL, 1, NULL, '$2y$10$gESZqlnul6VxKcgUfo34s.D0RijylcboNrbjx3/dAtuHWIdpLLIBi', NULL, NULL, NULL, NULL, '2022-08-25 10:46:50', '2022-09-08 08:28:57'),
(48, 1, 'admin', 'admin@email.com', '01924529986', 1, NULL, '$2y$10$mLJPVW3c1gj0a3FDTCCOGu0fSWvdBjOzbzxkvPT8LqOnxf.71XHzS', NULL, NULL, NULL, NULL, '2022-09-29 17:50:28', '2022-09-29 17:52:49'),
(85, 1, 'Ahsanul', 'ahsanul@gmail.com', '01767590306', 1, NULL, '$2y$10$mLJPVW3c1gj0a3FDTCCOGu0fSWvdBjOzbzxkvPT8LqOnxf.71XHzS', NULL, 475520, '2023-11-07 14:32:50', 1, '2023-11-07 08:30:50', '2023-11-07 08:31:05'),
(89, 2, 'didar', 'didar@gmail.com', '01648414032', 1, NULL, '$2y$10$mLJPVW3c1gj0a3FDTCCOGu0fSWvdBjOzbzxkvPT8LqOnxf.71XHzS', NULL, 405766, '2023-11-07 14:57:14', 1, '2023-11-07 08:55:14', '2023-11-07 08:55:25'),
(90, 0, 'sdf', 's@gmail.com', NULL, 0, NULL, '$2y$10$szau4ebas/H6T2hZhipF.uq77LKpaVYh1FOWPiR80/Q8ZO/I.N2hu', NULL, NULL, NULL, 1, '2023-11-08 04:23:15', '2023-11-08 04:23:15'),
(91, 0, 'sdf', 'dd@gmail.com', NULL, 0, NULL, '$2y$10$ay7qemmkasPzknBss9bE9e/37rGzZCuO3yMF321/vuwF3ze9dAmOS', NULL, NULL, NULL, 1, '2023-11-27 04:39:50', '2023-11-27 04:39:50'),
(93, 0, 'sdf', 'ddtt@gmail.com', NULL, 0, NULL, '$2y$10$N0OCJdD9qYANa4iuR2nFm.Y/BR6183OJdDZEgB5BF4Uv.0TlmOlUa', NULL, NULL, NULL, 1, '2023-11-27 04:40:44', '2023-11-27 04:40:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acrs`
--
ALTER TABLE `acrs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_groups`
--
ALTER TABLE `blood_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `freedom_fighters`
--
ALTER TABLE `freedom_fighters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered_guest_message_replies`
--
ALTER TABLE `registered_guest_message_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rosters`
--
ALTER TABLE `rosters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `speakers`
--
ALTER TABLE `speakers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_setups`
--
ALTER TABLE `training_setups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_types`
--
ALTER TABLE `transfer_types`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acrs`
--
ALTER TABLE `acrs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blood_groups`
--
ALTER TABLE `blood_groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `freedom_fighters`
--
ALTER TABLE `freedom_fighters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registered_guest_message_replies`
--
ALTER TABLE `registered_guest_message_replies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rosters`
--
ALTER TABLE `rosters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `speakers`
--
ALTER TABLE `speakers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `training_setups`
--
ALTER TABLE `training_setups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `transfer_types`
--
ALTER TABLE `transfer_types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
