-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for pds_db
CREATE DATABASE IF NOT EXISTS `pds_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pds_db`;

-- Dumping structure for table pds_db.acrs
CREATE TABLE IF NOT EXISTS `acrs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int DEFAULT NULL,
  `emp_name` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `designation` int DEFAULT NULL,
  `department` int DEFAULT NULL,
  `office_name` int DEFAULT NULL,
  `acr_year` year DEFAULT NULL,
  `score` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `file` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `rack_number` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bin_number` int DEFAULT NULL,
  `file_number` int DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  `acr_date` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.acrs: ~2 rows (approximately)
INSERT INTO `acrs` (`id`, `employee_id`, `emp_name`, `designation`, `department`, `office_name`, `acr_year`, `score`, `file`, `rack_number`, `created_at`, `updated_at`, `bin_number`, `file_number`, `remarks`, `status`, `acr_date`) VALUES
	(55, 55, NULL, NULL, NULL, NULL, '2024', '8896', NULL, NULL, '2024-01-17 08:44:00', '2024-01-17 08:44:00', NULL, NULL, NULL, 1, NULL),
	(56, 55, NULL, NULL, NULL, NULL, '2025', '3443', NULL, NULL, '2024-01-17 08:45:33', '2024-01-17 08:50:59', NULL, NULL, NULL, 1, '2025');

-- Dumping structure for table pds_db.blood_groups
CREATE TABLE IF NOT EXISTS `blood_groups` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `last_donate` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pds_db.blood_groups: ~2 rows (approximately)
INSERT INTO `blood_groups` (`id`, `employee_id`, `blood_group`, `last_donate`, `updated_at`, `status`, `created_at`) VALUES
	(41, 60, 'AB+', '2024-01-18', '2024-01-18 11:25:27', 0, '2024-01-18 11:25:27'),
	(42, 60, 'AB+', '2024-10-31', '2024-01-18 11:25:45', 0, '2024-01-18 11:25:45');

-- Dumping structure for table pds_db.contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `social_media` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pds_db.contacts: ~0 rows (approximately)
INSERT INTO `contacts` (`id`, `phone_number`, `email`, `social_media`, `address`, `created_at`, `updated_at`) VALUES
	(1, 'stringup', 'stringup', 'stringup', 'stringup', '2022-09-08 11:23:04', '2022-09-08 11:41:44');

-- Dumping structure for table pds_db.contact_messages
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table pds_db.contact_messages: ~0 rows (approximately)
INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
	(2, 'shakiur', 'shakiur.cse@gmail.com', 'test', 'aaaaaaaaaaaaaaa', '2022-09-27 11:16:49', '2022-09-27 11:16:49');

-- Dumping structure for table pds_db.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `create_at` date DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.departments: ~2 rows (approximately)
INSERT INTO `departments` (`id`, `dept_name`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Software', '2023-10-21', 1, '2023-10-23 06:56:26', '2023-10-23 06:56:26'),
	(6, 'HR', NULL, 1, '2023-12-06 05:58:48', '2023-12-06 05:58:48'),
	(7, 'Data Entry', NULL, 1, '2024-01-14 05:36:49', '2024-01-14 05:36:49'),
	(8, 'Food Processing', NULL, 1, '2024-01-16 11:09:18', '2024-01-16 11:09:18');

-- Dumping structure for table pds_db.designations
CREATE TABLE IF NOT EXISTS `designations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `designation_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `create_at` date DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.designations: ~2 rows (approximately)
INSERT INTO `designations` (`id`, `designation_name`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Engineer', '2023-03-23', 1, '2023-10-23 06:54:10', '2023-11-13 06:23:51'),
	(4, 'Programmer', NULL, 1, '2023-12-06 05:58:23', '2023-12-06 05:58:23'),
	(5, 'Data Entry', NULL, 1, '2024-01-14 05:44:33', '2024-01-14 05:44:33'),
	(6, 'Project', NULL, 1, '2024-01-16 11:10:10', '2024-01-16 11:10:10');

-- Dumping structure for table pds_db.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `gender` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `mobile_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `date_of_birth` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `blood_group` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `nid_number` int DEFAULT NULL,
  `passport_number` int DEFAULT NULL,
  `department` int DEFAULT NULL,
  `designation` int DEFAULT NULL,
  `office` int DEFAULT NULL,
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
  `job_grade` int DEFAULT NULL,
  `job_location` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `joining_date` varchar(200) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `freedom_fighter_status` int DEFAULT '0',
  `father_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `education_history` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `document` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `mother_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `spouse_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `number_of_child` int DEFAULT NULL,
  `emergency_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_relation` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_phn_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_addr` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_district` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `document_file` text COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.employees: ~2 rows (approximately)
INSERT INTO `employees` (`id`, `user_id`, `image`, `name`, `gender`, `mobile_number`, `email`, `date_of_birth`, `blood_group`, `nid_number`, `passport_number`, `department`, `designation`, `office`, `present_addr_houseno`, `present_addr_roadno`, `present_addr_area`, `present_addr_upazila`, `present_addr_district`, `present_addr_postcode`, `permanent_addr_houseno`, `permanent_addr_roadno`, `permanent_addr_area`, `permanent_addr_upazila`, `permanent_addr_district`, `permanent_addr_postcode`, `job_grade`, `job_location`, `joining_date`, `freedom_fighter_status`, `father_name`, `education_history`, `document`, `mother_name`, `spouse_name`, `number_of_child`, `emergency_name`, `emergency_relation`, `emergency_phn_number`, `emergency_email`, `emergency_addr`, `emergency_district`, `status`, `created_at`, `updated_at`, `document_file`) VALUES
	(54, 143, '', 'Ovi', 'Male', '01751684550', 'ovi@gmail.com', NULL, 'AB+', 1223, 1221, 6, 5, 7, '123', '23', '23', 'Amtali', 'Barguna', '23', '23', '23', '32', 'Betagi', 'Pirojpur', '23', 6, 'Dhaka', '2024-01-16', 0, 'Abul Akter', NULL, NULL, 'Moriyom', 'Laila', 2, 'Daief Sikder', NULL, '01924529986', 'daiefsikder425@gmail.com', '34', 'Dhaka', 1, '2024-01-16 11:06:00', '2024-01-17 10:23:52', NULL),
	(55, 145, '', 'Medza Vi', 'Male', '01920519595', '', '2024-01-26', 'B-', 2, 4, 6, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'a', '[{"exam_name":"","institute_name":"a","district":"","upazila":"","subject":"c","passing_year":2202,"grade":"33","board":"b","group":"d"}]', '[{"document_name":"test ","document_file":"Md Nafis Rabbi.doc"},{"document_name":"3w332","document_file":"PMS & GIT  (1).pdf"}]', 'b', 'as', 2, 'Daief Sikder', 'Sister', '01924529986', 'hr@gmail.com', '34', NULL, 0, '2024-01-17 04:29:24', '2024-01-17 10:31:41', NULL),
	(60, 151, '', 'Daief Sikder', NULL, '01924529986', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '[{"exam_name":"4343","institute_name":"54","district":"g","upazila":"34","subject":"gf","passing_year":2343,"grade":"3443"}]', '[{"document_name":"4343","document_file":"document (8).pdf"},{"document_name":"3434","document_file":"PMS & GIT  (1).pdf"}]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-18 09:05:36', '2024-01-18 11:25:27', NULL);

-- Dumping structure for table pds_db.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pds_db.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table pds_db.freedom_fighters
CREATE TABLE IF NOT EXISTS `freedom_fighters` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int DEFAULT '0',
  `freedom_fighter_num` int DEFAULT '0',
  `fighting_divi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Sector` int DEFAULT '0',
  `status` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pds_db.freedom_fighters: ~2 rows (approximately)
INSERT INTO `freedom_fighters` (`id`, `employee_id`, `freedom_fighter_num`, `fighting_divi`, `Sector`, `status`, `created_at`, `updated_at`) VALUES
	(13, 54, 23, '3', 4, 0, '2024-01-16 11:06:00', '2024-01-16 11:06:00');

-- Dumping structure for table pds_db.grades
CREATE TABLE IF NOT EXISTS `grades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `job_grade` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pds_db.grades: ~4 rows (approximately)
INSERT INTO `grades` (`id`, `job_grade`, `status`, `created_at`, `updated_at`) VALUES
	(6, 'A', 1, '2024-01-11 03:54:16', '2024-01-11 03:54:16'),
	(7, 'B', 1, '2024-01-11 03:54:25', '2024-01-11 03:54:25'),
	(8, 'C', 1, '2024-01-14 05:46:43', '2024-01-14 05:46:43'),
	(9, 'D', 1, '2024-01-14 05:46:52', '2024-01-14 05:46:52'),
	(10, 'F', 1, '2024-01-14 05:47:07', '2024-01-14 05:47:07'),
	(11, 'V.I.P', 1, '2024-01-16 11:11:21', '2024-01-16 11:11:21');

-- Dumping structure for table pds_db.leaves
CREATE TABLE IF NOT EXISTS `leaves` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL DEFAULT '0',
  `leave_type` int DEFAULT '0',
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `day` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.leaves: ~2 rows (approximately)
INSERT INTO `leaves` (`id`, `employee_id`, `leave_type`, `from_date`, `to_date`, `day`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(24, 52, 12, '2024-01-19', '2024-01-16', '3', 'I need to go for study tour.', 1, '2024-01-16 10:59:19', '2024-01-16 11:08:36'),
	(25, 54, 12, '2024-01-16', '2024-01-19', '3', '2343', 1, '2024-01-16 11:08:55', '2024-01-16 11:08:58');

-- Dumping structure for table pds_db.leave_types
CREATE TABLE IF NOT EXISTS `leave_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `leave_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `days` int NOT NULL DEFAULT '0',
  `create_at` date DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.leave_types: ~3 rows (approximately)
INSERT INTO `leave_types` (`id`, `leave_type`, `days`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
	(12, 'Emergency', 10, '2023-03-23', 1, '2023-10-25 11:44:31', '2024-01-16 11:11:04'),
	(15, 'Eid', 7, NULL, 1, '2024-01-14 05:45:21', '2024-01-14 05:45:21'),
	(16, 'Puja', 7, NULL, 1, '2024-01-14 05:45:35', '2024-01-14 05:45:35'),
	(17, 'Summer', 19, NULL, 1, '2024-01-14 05:45:49', '2024-01-14 05:45:49'),
	(18, 'Winter', 24, NULL, 1, '2024-01-16 11:10:52', '2024-01-16 11:10:52');

-- Dumping structure for table pds_db.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject` text,
  `phone` int DEFAULT NULL,
  `office` text,
  `designation` text,
  `from` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pds_db.messages: ~15 rows (approximately)
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

-- Dumping structure for table pds_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pds_db.migrations: ~4 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- Dumping structure for table pds_db.offices
CREATE TABLE IF NOT EXISTS `offices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `office_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.offices: ~3 rows (approximately)
INSERT INTO `offices` (`id`, `office_name`, `status`, `created_at`, `updated_at`) VALUES
	(4, 'Zamuna', 1, '2023-10-23 06:57:31', '2023-10-23 06:57:31'),
	(5, 'Golden Harvest', 1, '2023-12-05 11:23:41', '2023-12-05 11:23:41'),
	(6, 'Data Soft', 1, '2023-12-05 11:37:52', '2023-12-05 11:37:52'),
	(7, 'N.I BIZ', 1, '2024-01-14 05:45:02', '2024-01-14 05:45:02'),
	(8, 'Implevista', 1, '2024-01-16 11:10:26', '2024-01-16 11:10:26');

-- Dumping structure for table pds_db.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pds_db.password_resets: ~0 rows (approximately)

-- Dumping structure for table pds_db.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pds_db.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table pds_db.profiles
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.profiles: ~0 rows (approximately)

-- Dumping structure for table pds_db.promotions
CREATE TABLE IF NOT EXISTS `promotions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `promotion_ref_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `promotion_date` date DEFAULT NULL,
  `to_office` int DEFAULT NULL,
  `from_office` int DEFAULT NULL,
  `to_department` int DEFAULT NULL,
  `from_department` int DEFAULT NULL,
  `to_designation` int DEFAULT NULL,
  `from_designation` int DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.promotions: ~1 rows (approximately)
INSERT INTO `promotions` (`id`, `employee_id`, `name`, `promotion_ref_number`, `promotion_date`, `to_office`, `from_office`, `to_department`, `from_department`, `to_designation`, `from_designation`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(9, 52, NULL, '1223', '2024-01-16', NULL, NULL, NULL, NULL, NULL, NULL, 'I need immediate promotion.', 0, '2024-01-16 10:56:21', '2024-01-16 10:58:40'),
	(10, NULL, NULL, '5655', '2024-01-19', NULL, NULL, NULL, NULL, NULL, NULL, 'SFS SFS', 0, '2024-01-16 11:07:36', '2024-01-16 11:07:36');

-- Dumping structure for table pds_db.registered_guest_message_replies
CREATE TABLE IF NOT EXISTS `registered_guest_message_replies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `message_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `replied_by` int DEFAULT NULL,
  `replied_at` datetime DEFAULT NULL,
  `event_id` int DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pds_db.registered_guest_message_replies: ~5 rows (approximately)
INSERT INTO `registered_guest_message_replies` (`id`, `name`, `email`, `title`, `message_body`, `replied_by`, `replied_at`, `event_id`, `subject`, `created_at`, `updated_at`) VALUES
	(1, 'sdfdsf', 'shakiur.cse@gmail.com', NULL, '<p>sdfsdfds</p>', 1, '2022-09-28 12:29:57', 1, 'abc', '2022-09-28 12:29:57', '2022-09-28 12:29:57'),
	(2, 'sdfdsf', 'shakiur.cse@gmail.com', NULL, '<p>sdfsdfds</p>', 1, '2022-09-28 12:31:12', 1, 'abc', '2022-09-28 12:31:12', '2022-09-28 12:31:12'),
	(3, 'sdfdsf', 'shakiur.cse@gmail.com', NULL, '<p>dfsdfdsf</p>', 1, '2022-09-28 12:31:49', 1, 'aaaaaa', '2022-09-28 12:31:49', '2022-09-28 12:31:49'),
	(4, NULL, 'shakiur.cse@gmail.com', NULL, NULL, 1, '2022-09-29 17:16:56', 1, NULL, '2022-09-29 17:16:56', '2022-09-29 17:16:56'),
	(5, NULL, 'shakiur.cse@gmail.com', NULL, '<p>helllllllo</p>', 1, '2022-09-29 17:29:56', 1, 'Hello', '2022-09-29 17:29:56', '2022-09-29 17:29:56');

-- Dumping structure for table pds_db.rosters
CREATE TABLE IF NOT EXISTS `rosters` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int DEFAULT '0',
  `office_schedule_id` int DEFAULT '0',
  `date` date DEFAULT NULL,
  `remark` tinytext,
  `status` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table pds_db.rosters: ~0 rows (approximately)

-- Dumping structure for table pds_db.salaries
CREATE TABLE IF NOT EXISTS `salaries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `grade` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `basic_pay` int NOT NULL DEFAULT '0',
  `house_rent` int NOT NULL DEFAULT '0',
  `medical_allowance` int NOT NULL DEFAULT '0',
  `others` int NOT NULL DEFAULT '0',
  `salary_amount` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pds_db.salaries: ~3 rows (approximately)
INSERT INTO `salaries` (`id`, `employee_id`, `grade`, `created_at`, `updated_at`, `basic_pay`, `house_rent`, `medical_allowance`, `others`, `salary_amount`, `status`) VALUES
	(3, 1, 2, '2023-11-02 06:57:39', '2023-11-02 10:06:38', 2, 2, 2, 1, 7, 1),
	(5, 0, 3, '2023-11-02 08:53:42', '2023-11-02 08:53:42', 3, 3, 3, 3, 12, 0),
	(7, 0, 4, '2023-11-02 09:05:37', '2023-11-02 09:05:37', 4, 4, 4, 4, 16, 0);

-- Dumping structure for table pds_db.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `site_logo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `favicon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `copy_write` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pds_db.settings: ~0 rows (approximately)
INSERT INTO `settings` (`id`, `site_title`, `site_logo`, `favicon`, `copy_write`, `created_at`, `updated_at`) VALUES
	(1, 'Test_update', 'Test_update', 'Test_update', 'Test_update', '2022-09-07 06:20:49', '2022-09-07 06:37:13');

-- Dumping structure for table pds_db.speakers
CREATE TABLE IF NOT EXISTS `speakers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pds_db.speakers: ~7 rows (approximately)
INSERT INTO `speakers` (`id`, `name`, `image`, `occupation`, `organization`, `social_link`, `details`, `country`, `order`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Mutarika Pruksapong', 'speaker_image_1664399165.png', 'Programme Management Officer', 'Global Education and Training Institute (GETI) UNDRR', '{"speakerFacebook":"#","speakerInstagram":"#","speakerTwitter":"#","speakerLinkedin":"#"}', '', 'South Korea', 3, 1, '2022-09-08 08:53:08', '2022-10-02 18:07:55'),
	(2, 'Sidnel Furtado Fernandes', 'speaker_image_1664357015.png', 'Director of Civil Defense Campinas', '', '{"speakerFacebook":"#","speakerInstagram":"#","speakerTwitter":"#","speakerLinkedin":"#"}', '', 'Brazil', 4, 0, '2022-09-13 05:10:39', '2022-10-02 18:07:40'),
	(3, 'Sanjaya Bhatia', 'speaker_image_1664358192.png', 'Head, Global Education and Training Institute (GETI) UNDRR', '', '{"speakerFacebook":"#","speakerInstagram":"#","speakerTwitter":"#","speakerLinkedin":"#"}', '', 'India', 5, 1, '2022-09-13 05:49:44', '2022-10-02 18:07:31'),
	(4, 'Sissa Bekombo Priso', 'Sissa_BEKOMBO.jpeg', 'Resilience Project Manager', '', '{"speakerFacebook":"#","speakerInstagram":"#","speakerTwitter":"#","speakerLinkedin":"#"}', '', 'France', 6, 1, '2022-09-13 05:50:57', '2022-10-02 18:07:23'),
	(5, 'Didier Soto', 'didier-soto.jpeg', 'Head of Digital Solutions & Climate Change Resilience Project Manager', '', '{"speakerFacebook":"#","speakerInstagram":"#","speakerTwitter":"#","speakerLinkedin":"#"}', '', 'France', 7, 1, '2022-09-13 05:50:57', '2022-10-02 18:07:07'),
	(6, 'Md. Atiqul Huq', 'speaker_image_1664399385.png', 'Director General of Ministry of Disaster Management and Relief', 'DDM', '{"speakerFacebook":"#","speakerInstagram":"#","speakerTwitter":"#","speakerLinkedin":"#"}', '', 'Bangladesh', 2, 1, '2022-09-22 17:18:37', '2022-09-29 03:09:45'),
	(7, 'Md Kamrul Hasan', 'kamrul-hasan.png', 'GOVERNMENT OF THE PEOPLEÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢S REPUBLIC OF BANGLADESH', '', '{"speakerFacebook":"#","speakerInstagram":"#","speakerTwitter":"#","speakerLinkedin":"#"}', '', 'Bangladesh', 1, 1, '2022-09-22 17:18:37', '2022-10-02 18:06:36');

-- Dumping structure for table pds_db.trainings
CREATE TABLE IF NOT EXISTS `trainings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL DEFAULT '0',
  `training_center_name` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `training_score` int DEFAULT '0',
  `training_feedback` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `training_strt_date` date DEFAULT NULL,
  `training_end_date` date DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `training_name` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.trainings: ~1 rows (approximately)
INSERT INTO `trainings` (`id`, `employee_id`, `training_center_name`, `training_score`, `training_feedback`, `training_strt_date`, `training_end_date`, `description`, `status`, `created_at`, `updated_at`, `training_name`) VALUES
	(8, 52, 'Ghit Info Tech', NULL, NULL, '2024-01-16', '2024-02-29', NULL, 0, '2024-01-16 10:55:38', '2024-01-16 10:55:58', 'Computer'),
	(9, 54, 'Ghit Info Tech', NULL, NULL, NULL, NULL, NULL, 0, '2024-01-16 11:08:20', '2024-01-16 11:08:20', 'Data Entry');

-- Dumping structure for table pds_db.training_setups
CREATE TABLE IF NOT EXISTS `training_setups` (
  `id` int NOT NULL AUTO_INCREMENT,
  `training_name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `create_at` date DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.training_setups: ~3 rows (approximately)
INSERT INTO `training_setups` (`id`, `training_name`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
	(3, 'Software', NULL, 1, '2024-01-14 05:38:58', '2024-01-14 05:38:58'),
	(4, 'Data Entry', NULL, 1, '2024-01-14 05:39:16', '2024-01-14 05:39:16'),
	(5, 'Web Development', NULL, 1, '2024-01-14 05:39:27', '2024-01-14 05:39:27'),
	(6, 'Computer', NULL, 1, '2024-01-16 11:09:37', '2024-01-16 11:09:37');

-- Dumping structure for table pds_db.transfers
CREATE TABLE IF NOT EXISTS `transfers` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `transfer_order_number` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.transfers: ~2 rows (approximately)
INSERT INTO `transfers` (`id`, `employee_id`, `to_office`, `from_office`, `to_department`, `from_department`, `to_designation`, `from_designation`, `transfer_order`, `transfer_type`, `transfer_date`, `join_date`, `transfer_letter`, `status`, `created_at`, `updated_at`, `transfer_order_number`) VALUES
	(37, 52, NULL, NULL, 7, 6, NULL, NULL, NULL, 23, NULL, NULL, '', 1, '2024-01-16 10:52:35', '2024-01-16 11:06:43', 4502),
	(38, 54, NULL, NULL, NULL, NULL, NULL, NULL, '6767', 23, '2024-01-17', '2024-01-19', '', 0, '2024-01-16 11:06:54', '2024-01-16 11:07:08', 1212),
	(39, 55, 7, 6, 6, 6, 4, 4, '222', 23, NULL, NULL, 'transfer_letter1705466169.pdf', 0, '2024-01-17 04:35:52', '2024-01-17 04:36:09', 22222);

-- Dumping structure for table pds_db.transfer_types
CREATE TABLE IF NOT EXISTS `transfer_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL DEFAULT '0',
  `title` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table pds_db.transfer_types: ~2 rows (approximately)
INSERT INTO `transfer_types` (`id`, `employee_id`, `title`, `status`, `created_at`, `updated_at`) VALUES
	(21, 48, 'Emergency', 1, NULL, NULL),
	(22, 0, 'Imediate', 1, '2024-01-14 05:43:14', '2024-01-14 05:43:14'),
	(23, 0, 'Departmental Transfer', 1, '2024-01-14 05:44:16', '2024-01-14 05:44:16'),
	(24, 0, 'Punsihment', 1, '2024-01-16 11:09:56', '2024-01-16 11:09:56');

-- Dumping structure for table pds_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` int DEFAULT NULL,
  `otp_expire_at` datetime DEFAULT NULL,
  `otp_verified` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pds_db.users: ~4 rows (approximately)
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `phone`, `status`, `email_verified_at`, `password`, `remember_token`, `otp`, `otp_expire_at`, `otp_verified`, `created_at`, `updated_at`) VALUES
	(142, 1, 'Didar Vi', NULL, '01767590306', 1, NULL, '$2y$10$teuMREy7..huIsXdPdz6Eu4i7V2XQD8mGVodiu8aixKk.GzhUSZQy', NULL, 178863, '2024-01-16 17:02:35', 1, '2024-01-16 11:00:35', '2024-01-16 11:02:38'),
	(143, 0, 'Ovi', NULL, '01751684550', 1, NULL, '$2y$10$5CugAY5NNNesF6VRYd1utOz0IkCubIi.XX2vRKL.QVFoBaaE/R75C', NULL, NULL, NULL, 1, '2024-01-16 11:06:00', '2024-01-16 11:06:18'),
	(145, 2, 'Medza Vi', '', '01920519595', 1, '2024-01-18 08:47:31', '$2y$10$gMoxS/Eqye.oHD2SKITFmOqIRpqkZcI3PgcJo0qFca2XaEecrHwMy', NULL, 415432, '2024-01-17 10:30:59', 1, '2024-01-17 04:28:59', '2024-01-18 08:46:37'),
	(151, 2, 'Daief Sikder', NULL, '01924529986', 1, NULL, '$2y$10$uVZ4vwc7OCYIE5kmtQ8PX.Mkyv1kykPR3UB.LSZg7IndAVwoDJf3.', NULL, 727169, '2024-01-18 15:07:21', 1, '2024-01-18 09:05:21', '2024-01-18 09:06:01');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
