-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 05:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `emp_name` varchar(50) DEFAULT NULL,
  `designation` int(11) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `office_name` int(11) DEFAULT NULL,
  `acr_year` year(4) DEFAULT NULL,
  `score` varchar(50) DEFAULT NULL,
  `file` varchar(50) DEFAULT NULL,
  `rack_number` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bin_number` int(11) DEFAULT NULL,
  `file_number` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `acr_date` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acrs`
--

INSERT INTO `acrs` (`id`, `employee_id`, `emp_name`, `designation`, `department`, `office_name`, `acr_year`, `score`, `file`, `rack_number`, `created_at`, `updated_at`, `bin_number`, `file_number`, `remarks`, `status`, `acr_date`) VALUES
(55, 55, NULL, NULL, NULL, NULL, '2024', '8896', NULL, NULL, '2024-01-17 08:44:00', '2024-01-17 08:44:00', NULL, NULL, NULL, 1, NULL),
(56, 55, NULL, NULL, NULL, NULL, '2025', '3443', NULL, NULL, '2024-01-17 08:45:33', '2024-01-17 08:50:59', NULL, NULL, NULL, 1, '2025');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `social_media` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
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
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `message` text DEFAULT NULL,
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
  `id` int(11) NOT NULL,
  `dept_name` varchar(255) DEFAULT NULL,
  `create_at` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept_name`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Software', '2023-10-21', 1, '2023-10-23 06:56:26', '2023-10-23 06:56:26'),
(6, 'HR', NULL, 1, '2023-12-06 05:58:48', '2023-12-06 05:58:48'),
(7, 'Data Entry', NULL, 1, '2024-01-14 05:36:49', '2024-01-14 05:36:49'),
(8, 'Food Processing', NULL, 1, '2024-01-16 11:09:18', '2024-01-16 11:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(11) NOT NULL,
  `designation_name` varchar(255) DEFAULT NULL,
  `create_at` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation_name`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Engineer', '2023-03-23', 1, '2023-10-23 06:54:10', '2023-11-13 06:23:51'),
(4, 'Programmer', NULL, 1, '2023-12-06 05:58:23', '2023-12-06 05:58:23'),
(5, 'Data Entry', NULL, 1, '2024-01-14 05:44:33', '2024-01-14 05:44:33'),
(6, 'Project', NULL, 1, '2024-01-16 11:10:10', '2024-01-16 11:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `date_of_birth` varchar(200) DEFAULT NULL,
  `blood_group` varchar(50) DEFAULT NULL,
  `nid_number` int(11) DEFAULT NULL,
  `passport_number` int(11) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `designation` int(11) DEFAULT NULL,
  `office` int(11) DEFAULT NULL,
  `present_addr_houseno` text DEFAULT NULL,
  `present_addr_roadno` text DEFAULT NULL,
  `present_addr_area` text DEFAULT NULL,
  `present_addr_upazila` varchar(255) DEFAULT NULL,
  `present_addr_district` varchar(255) DEFAULT NULL,
  `present_addr_postcode` varchar(50) DEFAULT NULL,
  `permanent_addr_houseno` text DEFAULT NULL,
  `permanent_addr_roadno` text DEFAULT NULL,
  `permanent_addr_area` text DEFAULT NULL,
  `permanent_addr_upazila` varchar(255) DEFAULT NULL,
  `permanent_addr_district` varchar(255) DEFAULT NULL,
  `permanent_addr_postcode` varchar(50) DEFAULT NULL,
  `job_grade` int(11) DEFAULT NULL,
  `job_location` tinytext DEFAULT NULL,
  `joining_date` varchar(200) DEFAULT NULL,
  `freedom_fighter_status` int(11) DEFAULT 0,
  `father_name` varchar(255) DEFAULT NULL,
  `education_history` text DEFAULT NULL,
  `document` text DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `spouse_name` varchar(255) DEFAULT NULL,
  `number_of_child` int(11) DEFAULT NULL,
  `emergency_name` varchar(255) DEFAULT NULL,
  `emergency_relation` varchar(255) DEFAULT NULL,
  `emergency_phn_number` varchar(255) DEFAULT NULL,
  `emergency_email` varchar(255) DEFAULT NULL,
  `emergency_addr` varchar(255) DEFAULT NULL,
  `emergency_district` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `document_file` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `image`, `name`, `gender`, `mobile_number`, `email`, `date_of_birth`, `blood_group`, `nid_number`, `passport_number`, `department`, `designation`, `office`, `present_addr_houseno`, `present_addr_roadno`, `present_addr_area`, `present_addr_upazila`, `present_addr_district`, `present_addr_postcode`, `permanent_addr_houseno`, `permanent_addr_roadno`, `permanent_addr_area`, `permanent_addr_upazila`, `permanent_addr_district`, `permanent_addr_postcode`, `job_grade`, `job_location`, `joining_date`, `freedom_fighter_status`, `father_name`, `education_history`, `document`, `mother_name`, `spouse_name`, `number_of_child`, `emergency_name`, `emergency_relation`, `emergency_phn_number`, `emergency_email`, `emergency_addr`, `emergency_district`, `status`, `created_at`, `updated_at`, `document_file`) VALUES
(54, 143, '', 'Ovi', 'Male', '01751684550', 'ovi@gmail.com', NULL, 'AB+', 1223, 1221, 6, 5, 7, '123', '23', '23', 'Amtali', 'Barguna', '23', '23', '23', '32', 'Betagi', 'Pirojpur', '23', 6, 'Dhaka', '2024-01-16', 0, 'Abul Akter', NULL, NULL, 'Moriyom', 'Laila', 2, 'Daief Sikder', NULL, '01924529986', 'daiefsikder425@gmail.com', '34', 'Dhaka', 1, '2024-01-16 11:06:00', '2024-01-17 10:23:52', NULL),
(55, 145, '', 'Medza Vi', 'Male', '01920519595', '', '2024-01-26', 'B-', 2, 4, 6, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'a', '[{\"exam_name\":\"\",\"institute_name\":\"a\",\"district\":\"\",\"upazila\":\"\",\"subject\":\"c\",\"passing_year\":2202,\"grade\":\"33\",\"board\":\"b\",\"group\":\"d\"}]', '[{\"document_name\":\"test \",\"document_file\":\"Md Nafis Rabbi.doc\"},{\"document_name\":\"3w332\",\"document_file\":\"PMS & GIT  (1).pdf\"}]', 'b', 'as', 2, 'Daief Sikder', 'Sister', '01924529986', 'hr@gmail.com', '34', NULL, 0, '2024-01-17 04:29:24', '2024-01-17 10:31:41', NULL),
(60, 151, '', 'Daief Sikder', NULL, '01924529986', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '[{\"exam_name\":\"4343\",\"institute_name\":\"54\",\"district\":\"g\",\"upazila\":\"34\",\"subject\":\"gf\",\"passing_year\":2343,\"grade\":\"3443\"}]', '[{\"document_name\":\"4343\",\"document_file\":\"document (8).pdf\"},{\"document_name\":\"3434\",\"document_file\":\"PMS & GIT  (1).pdf\"}]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-18 09:05:36', '2024-01-18 11:25:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL DEFAULT 0,
  `leave_type` int(11) DEFAULT 0,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `day` varchar(50) DEFAULT '0',
  `description` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `employee_id`, `leave_type`, `from_date`, `to_date`, `day`, `description`, `status`, `created_at`, `updated_at`) VALUES
(24, 52, 12, '2024-01-19', '2024-01-16', '3', 'I need to go for study tour.', 1, '2024-01-16 10:59:19', '2024-01-16 11:08:36'),
(25, 54, 12, '2024-01-16', '2024-01-19', '3', '2343', 1, '2024-01-16 11:08:55', '2024-01-16 11:08:58');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL,
  `leave_type` varchar(255) DEFAULT NULL,
  `days` int(11) NOT NULL DEFAULT 0,
  `create_at` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `leave_type`, `days`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
(12, 'Emergency', 10, '2023-03-23', 1, '2023-10-25 11:44:31', '2024-01-16 11:11:04'),
(15, 'Eid', 7, NULL, 1, '2024-01-14 05:45:21', '2024-01-14 05:45:21'),
(16, 'Puja', 7, NULL, 1, '2024-01-14 05:45:35', '2024-01-14 05:45:35'),
(17, 'Summer', 19, NULL, 1, '2024-01-14 05:45:49', '2024-01-14 05:45:49'),
(18, 'Winter', 24, NULL, 1, '2024-01-16 11:10:52', '2024-01-16 11:10:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
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
  `id` int(11) NOT NULL,
  `office_name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `office_name`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Zamuna', 1, '2023-10-23 06:57:31', '2023-10-23 06:57:31'),
(5, 'Golden Harvest', 1, '2023-12-05 11:23:41', '2023-12-05 11:23:41'),
(6, 'Data Soft', 1, '2023-12-05 11:37:52', '2023-12-05 11:37:52'),
(7, 'N.I BIZ', 1, '2024-01-14 05:45:02', '2024-01-14 05:45:02'),
(8, 'Implevista', 1, '2024-01-16 11:10:26', '2024-01-16 11:10:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
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
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `designation` int(11) NOT NULL DEFAULT 0,
  `present_addr_houseno` text DEFAULT NULL,
  `present_addr_roadno` text DEFAULT NULL,
  `present_addr_area` text DEFAULT NULL,
  `present_addr_upazila` varchar(255) DEFAULT NULL,
  `present_addr_district` varchar(255) DEFAULT NULL,
  `present_addr_postcode` int(11) DEFAULT 0,
  `permanent_addr_houseno` text DEFAULT NULL,
  `permanent_addr_roadno` text DEFAULT NULL,
  `permanent_addr_area` text DEFAULT NULL,
  `permanent_addr_upazila` varchar(255) DEFAULT NULL,
  `permanent_addr_district` varchar(255) DEFAULT NULL,
  `permanent_addr_postcode` int(11) DEFAULT 0,
  `department` int(11) DEFAULT 0,
  `job_location` int(11) DEFAULT 0,
  `joining_date` date DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `spouse_name` varchar(255) DEFAULT NULL,
  `number_of_cheild` int(11) DEFAULT 0,
  `emergency_name` varchar(255) DEFAULT NULL,
  `emergency_relation` varchar(255) DEFAULT NULL,
  `emergency_phn_number` varchar(255) DEFAULT NULL,
  `emergency_email` varchar(255) DEFAULT NULL,
  `emergency_addr` varchar(255) DEFAULT NULL,
  `emergency_distict` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  `promotion_ref_number` varchar(255) DEFAULT NULL,
  `promotion_date` date DEFAULT NULL,
  `to_office` int(11) DEFAULT NULL,
  `from_office` int(11) DEFAULT NULL,
  `to_department` int(11) DEFAULT NULL,
  `from_department` int(11) DEFAULT NULL,
  `to_designation` int(11) DEFAULT NULL,
  `from_designation` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `employee_id`, `name`, `promotion_ref_number`, `promotion_date`, `to_office`, `from_office`, `to_department`, `from_department`, `to_designation`, `from_designation`, `description`, `status`, `created_at`, `updated_at`) VALUES
(9, 52, NULL, '1223', '2024-01-16', NULL, NULL, NULL, NULL, NULL, NULL, 'I need immediate promotion.', 0, '2024-01-16 10:56:21', '2024-01-16 10:58:40'),
(10, NULL, NULL, '5655', '2024-01-19', NULL, NULL, NULL, NULL, NULL, NULL, 'SFS SFS', 0, '2024-01-16 11:07:36', '2024-01-16 11:07:36');

-- --------------------------------------------------------

--
-- Table structure for table `registered_guest_message_replies`
--

CREATE TABLE `registered_guest_message_replies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `message_body` text DEFAULT NULL,
  `replied_by` int(11) DEFAULT NULL,
  `replied_at` datetime DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
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
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT 0,
  `office_schedule_id` int(11) DEFAULT 0,
  `date` date DEFAULT NULL,
  `remark` tinytext DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_title` varchar(255) DEFAULT NULL,
  `site_logo` text DEFAULT NULL,
  `favicon` text DEFAULT NULL,
  `copy_write` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `site_logo`, `favicon`, `copy_write`, `created_at`, `updated_at`) VALUES
(1, 'Test_update', 'Test_update', 'Test_update', 'Test_update', '2022-09-07 06:20:49', '2022-09-07 06:37:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acrs`
--
ALTER TABLE `acrs`
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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acrs`
--
ALTER TABLE `acrs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `registered_guest_message_replies`
--
ALTER TABLE `registered_guest_message_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rosters`
--
ALTER TABLE `rosters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
