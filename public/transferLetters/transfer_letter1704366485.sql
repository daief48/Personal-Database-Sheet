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
DROP TABLE IF EXISTS `acrs`;
CREATE TABLE IF NOT EXISTS `acrs` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `bin_number` int NOT NULL DEFAULT '0',
  `file_number` int NOT NULL DEFAULT '0',
  `remarks` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.acrs: ~3 rows (approximately)
INSERT INTO `acrs` (`id`, `employee_id`, `emp_name`, `designation`, `department`, `office_name`, `acr_year`, `score`, `file`, `rack_number`, `created_at`, `updated_at`, `bin_number`, `file_number`, `remarks`, `status`) VALUES
	(2, 1, 1, 1, 1, 3, '2023', '11', '1', 11, '2023-11-05 05:43:35', '2023-11-05 05:43:35', 11, 11, '1', 1),
	(3, 1, 0, 0, 0, 0, NULL, NULL, NULL, 0, '2023-11-05 08:31:05', '2023-11-05 08:31:05', 0, 0, NULL, 1);

-- Dumping structure for table pds_db.blood_groups
DROP TABLE IF EXISTS `blood_groups`;
CREATE TABLE IF NOT EXISTS `blood_groups` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int DEFAULT NULL,
  `blood_group` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `last_donate` date DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pds_db.blood_groups: ~11 rows (approximately)
INSERT INTO `blood_groups` (`id`, `employee_id`, `blood_group`, `last_donate`, `status`, `created_at`, `updated_at`) VALUES
	(7, 32, 'AB+', '2023-12-05', 2, '2023-12-06 06:55:54', '2023-12-10 11:36:01'),
	(8, 32, 'AB+', '2023-12-06', 0, '2023-12-05 06:56:08', '2023-12-05 06:56:09'),
	(9, 1, 'O+', '2023-12-05', 2, '2023-12-05 06:56:26', '2023-12-09 05:12:18'),
	(11, 32, 'A+', '2023-12-05', 0, '2023-12-10 11:54:48', '2023-12-10 11:54:48'),
	(12, 1, 'AB+', '2023-11-07', 1, '2023-12-20 08:39:08', '2023-12-20 08:39:08'),
	(13, 32, 'AB+', '2023-11-07', 1, '2023-12-20 08:47:19', '2023-12-20 08:47:19'),
	(14, NULL, NULL, NULL, 0, '2023-12-20 08:50:30', '2023-12-20 08:50:30'),
	(15, NULL, NULL, NULL, 0, '2023-12-20 08:52:18', '2023-12-20 08:52:18'),
	(17, NULL, 'AB+', '2023-12-29', 0, '2023-12-20 08:56:17', '2023-12-20 08:56:17'),
	(18, 32, 'AB+', '2024-01-04', 0, '2023-12-20 08:56:52', '2023-12-20 08:56:52'),
	(19, 32, 'AB+', '2027-10-19', 0, '2023-12-20 08:59:08', '2023-12-20 08:59:08'),
	(20, 32, 'AB+', '2028-11-23', 0, '2023-12-20 09:00:43', '2023-12-20 09:00:43'),
	(21, 58, 'null', '2024-01-04', 0, '2024-01-04 05:29:10', '2024-01-04 05:29:10');

-- Dumping structure for table pds_db.contacts
DROP TABLE IF EXISTS `contacts`;
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
DROP TABLE IF EXISTS `contact_messages`;
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
DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `create_at` date DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.departments: ~2 rows (approximately)
INSERT INTO `departments` (`id`, `dept_name`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'png', '2023-10-21', 1, '2023-10-23 06:56:26', '2023-10-23 06:56:26'),
	(14, 'IT', NULL, 1, '2023-12-05 05:10:51', '2023-12-05 05:10:51');

-- Dumping structure for table pds_db.designations
DROP TABLE IF EXISTS `designations`;
CREATE TABLE IF NOT EXISTS `designations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `designation_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `create_at` date DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.designations: ~0 rows (approximately)
INSERT INTO `designations` (`id`, `designation_name`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'didar', '2023-03-23', 0, '2023-10-23 06:54:10', '2023-11-13 06:23:51');

-- Dumping structure for table pds_db.employees
DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `gender` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `mobile_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `blood_group` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.employees: ~9 rows (approximately)
INSERT INTO `employees` (`id`, `user_id`, `image`, `name`, `gender`, `mobile_number`, `email`, `date_of_birth`, `blood_group`, `nid_number`, `passport_number`, `department`, `designation`, `office`, `present_addr_houseno`, `present_addr_roadno`, `present_addr_area`, `present_addr_upazila`, `present_addr_district`, `present_addr_postcode`, `permanent_addr_houseno`, `permanent_addr_roadno`, `permanent_addr_area`, `permanent_addr_upazila`, `permanent_addr_district`, `permanent_addr_postcode`, `job_grade`, `job_location`, `joining_date`, `freedom_fighter_status`, `father_name`, `education_history`, `document`, `mother_name`, `spouse_name`, `number_of_child`, `emergency_name`, `emergency_relation`, `emergency_phn_number`, `emergency_email`, `emergency_addr`, `emergency_district`, `status`, `created_at`, `updated_at`) VALUES
	(1, 29, 'photo-64943e66d297e-2023-Jun-Thu.png', 'Shakiur', 'male', '01738528292', 'shakiur.cse@gmail.com', '1977-10-22', 'A+', 0, 0, 1, 1, 0, '34', '13', 'adsfsd', 'aaa', 'Dhaka', '1216', '3', '4', '15', 'bbbb', 'Rangpur', '5400', 3, 'Mirpur1', '2023-04-06', 0, '4 ahmed', '[{"exam_name":"Bsc","institute_name":"UODA","district":"Dhaka","upazila":"","subject":"CSE","passing_year":"2013","grade":"x"},{"exam_name":"HSC","institute_name":"Technical School & College","district":"Rangpur","upazila":"","subject":"Science","passing_year":"2006","grade":"x"},{"exam_name":"SSC","institute_name":"Technical School and College","district":"Rangpur","upazila":"","subject":"Science","passing_year":"2004","grade":"x"}]', '', 'b ahmed', 'c ahmedl', 4, 'Arafat2', 'Brother', '1234567890', 'arafath@email.com', 'Khilkhet', 'Dhaka3', 1, '2023-04-11 05:53:47', '2023-09-11 08:59:25'),
	(4, 85, '', 'didar', 'male', '01738528321', '', '1950-01-22', 'O+', 0, 0, 1, 1, 0, 'dfg', 'fg', 'df', 'df', 'df', '23', '12', 'fg', 'df', 'df', 'df', '32', 1, 'fg', '2023-03-27', 0, 'fg', 'fg', '', 'fg', 'fg', 0, 'hf', 'dg', '0', 's@gmail.com', 'ttttttttt', '', 1, '2023-10-22 10:39:35', '2023-10-22 10:39:35'),
	(31, 86, NULL, 'Ahsanul', NULL, '01767590306', NULL, NULL, NULL, 0, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-11-07 08:31:05', '2023-11-07 08:31:05'),
	(32, 89, NULL, 'didar', NULL, '01648414032', NULL, NULL, 'AB+', 0, 0, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-11-07 08:55:25', '2023-11-07 08:55:25'),
	(33, 90, 'df', 'sdf', 'fg', '01738528346', 's@gmail.com', '2023-11-08', 's', 2351, 124, 1, 1, 0, 'hd', 'dfh', 'sg', 'sdg', 'sdg', 'sdg', 'sdg', 'sdg', 'sdgds', 'sd', 'sdf', '324', 1, 'dfg', '2023-11-08', 0, 'sdf', 'ssd', '', 'sdf', 'sd', 0, 'sdf', 'sdf', '0', 's@gmail.com', 'wer', '', 0, '2023-11-08 04:23:15', '2023-11-08 04:23:15'),
	(34, 91, '2', 'sdf', 'df', '01738528347', 'dd@gmail.com', '2023-11-08', 'o', 464, 565, 6, 5, 5, 'g', 'dfg', 'df', 'df', 'df', '56', '56', '56', 'fg', 'fg', 'fg', '65', 6, '6', '2023-11-08', 1, 'fg', 'dg', '', 'fg', 'fg', 0, '34', 'gh', '0', 'dd@gmail.com', 'er', '', 0, '2023-11-27 04:39:50', '2023-11-27 04:39:50'),
	(35, 93, '2', 'sdf', 'df', '01738528348', 'ddtt@gmail.com', '2023-11-08', 'o', 464, 565, 6, 5, 5, 'g', 'dfg', 'df', 'df', 'df', '56', '56', '56', 'fg', 'fg', 'fg', '65', 6, '6', '2023-11-08', 1, 'fg', 'dg', '', 'fg', 'fg', 0, '34', 'gh', '0', 'dd@gmail.com', 'er', '', 0, '2023-11-27 04:40:44', '2023-11-27 04:40:44'),
	(53, 126, '123456', 'Ovi', 'Male', '01751684550', 'hr@gmail.com', '2023-11-20', 'B+', 123, 123, 1, 1, 3, '123', '123', '123', 'Bamna', 'Bhola', '123', '67123', '123', '123', 'Patharghata', 'Pirojpur', '123', 11, '234234', '2023-11-18', 0, '2323', '[{"exam_name":"3223","institute_name":"2332","board":"23","group":"2332","subject":"23","passing_year":"2023-11-03","grade":"2332"}]', '[]', '32233', '3232', 3232, '2342', 'Mother', '01738528292', 'avi@gmail.com', '234234', '3232', 0, '2023-11-27 08:52:46', '2023-12-03 10:18:35'),
	(54, 127, '123456', '2342', 'Male', '01738528292', 'avi@gmail.com', '2023-11-15', '', 123456, 122312, 1, 11, 1, '122312', '122312', '122312', 'Bamna', 'Barisal', '122312', '122312', '122312', '122312', 'Patharghata', 'Patuakhali', '122312', 11, '122312', '2023-11-15', 0, '122312', '[]', '[]', '122312', '122312', 122312, '122312', 'Father', '122312', '122312', '122312', '122312', 0, '2023-11-27 10:56:58', '2023-11-28 06:47:02'),
	(55, 142, '233232', 'arif', 'Male', '01767590306', 'arif@gmail.com', '2023-12-13', 'AB+', 2323454, 2323454, 3, 10, 3, '2323454', '2323454', '2323454', 'Bamna', 'Barisal', '2323454', '2323454', '2323454', '2323454', 'Muladi', 'Bandarban', '2323454', 10, '234234', '2023-12-06', 0, '2323454', '[]', '[]', '2323454', '2323454', 2323454, '2323454', 'Father', '2323454', '2323454', '2323454', '2323454', 0, '2023-12-03 11:35:07', '2023-12-04 11:31:39'),
	(56, 143, '123456', 'galib', 'Male', '01744444444', 'galib@gmail.com', '2023-12-04', 'AB+', 2323454, 2323454, 1, 9, 1, '123', '2323', '2323', 'Barguna Sadar', 'Barisal', '1212', '67', '13', '23', 'Muladi', 'Patuakhali', '2332', 9, '234234', '2023-12-10', 0, '2332', '[{"exam_name":"","institute_name":"","board":"","group":"","subject":"","passing_year":"","grade":""}]', '[]', '2332', '2332', 2332, '2332', '', '2332', 'galib@gmail.com', '2332', '3232', 0, '2023-12-04 11:35:11', '2023-12-09 06:55:47'),
	(57, 147, '123456', 'Hr Name2', 'Female', '01738528293', 'hr12323@gmail.com', '2023-12-27', 'A-', 2323, 343443, 1, 1, 3, '3443', '43', '3443', 'Barguna Sadar', 'Jhalokati', '4343', '43', '34', '43', 'Bamna', 'Pirojpur', '434', 11, '234234', '2023-12-15', 0, '43', 'null', '[]', '43', '43434', 343, '432543', '', '432543', 'hr123@gmail.com', '432543', '4343', 0, '2023-12-27 06:23:06', '2023-12-27 06:52:59'),
	(58, 148, '', NULL, NULL, '01738528292', 'avi@gmail.com', '2024-01-04', 'null', 0, 0, 1, 1, 0, 'null', 'null', 'null', 'null', 'null', 'null', 'null', 'null', 'null', 'null', 'null', 'null', 0, 'null', '2024-01-04', 0, NULL, '[]', '[]', NULL, NULL, 0, 'null', 'null', 'null', 'null', 'null', 'null', NULL, '2024-01-04 05:16:45', '2024-01-04 05:21:35');

-- Dumping structure for table pds_db.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
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
DROP TABLE IF EXISTS `freedom_fighters`;
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pds_db.freedom_fighters: ~12 rows (approximately)
INSERT INTO `freedom_fighters` (`id`, `employee_id`, `freedom_fighter_num`, `fighting_divi`, `Sector`, `status`, `created_at`, `updated_at`) VALUES
	(4, 35, 56, 'chg', 9, 0, '2023-11-27 04:40:44', '2023-11-27 04:40:44'),
	(5, 1, 234, '234', 234, 1, '2023-11-27 08:04:55', '2023-11-27 08:04:55'),
	(8, NULL, 23, '23', 232, 0, '2023-11-27 08:37:56', '2024-01-04 05:21:35'),
	(9, 53, 23, '23', 32, 0, '2023-11-27 08:52:46', '2023-11-27 08:52:46'),
	(10, NULL, 23, '23', 32, 0, '2023-11-27 10:16:54', '2023-11-27 10:16:54'),
	(11, NULL, 23455, '23', 32, 0, '2023-11-27 10:17:03', '2023-11-27 10:17:03'),
	(12, NULL, 23455, '45546787998798', 32, 0, '2023-11-27 10:17:13', '2023-11-27 10:17:13'),
	(14, NULL, 23, '23323', 32, 0, '2023-11-27 10:21:15', '2023-11-27 10:21:15'),
	(15, 54, 122312, '122312', 122312, 0, '2023-11-27 10:56:58', '2023-11-27 10:56:58'),
	(16, 55, 2323454, '2323454', 2323454, 0, '2023-12-03 11:35:07', '2023-12-03 11:35:07'),
	(17, 56, 34334, '3434', 4343, 0, '2023-12-04 11:35:11', '2023-12-04 11:35:11'),
	(18, 57, 23, '23', 232, 0, '2023-12-27 06:23:06', '2023-12-27 06:23:06');

-- Dumping structure for table pds_db.grades
DROP TABLE IF EXISTS `grades`;
CREATE TABLE IF NOT EXISTS `grades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `job_grade` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pds_db.grades: ~5 rows (approximately)
INSERT INTO `grades` (`id`, `job_grade`, `status`, `created_at`, `updated_at`) VALUES
	(5, 'A', 1, '2023-11-27 05:29:36', '2023-11-27 05:29:36'),
	(6, 'B', 1, '2023-11-27 05:29:45', '2023-11-27 05:29:57'),
	(7, 'C', 1, '2023-11-27 05:29:49', '2023-11-27 05:29:59'),
	(9, 'D', 1, '2023-11-27 05:33:09', '2023-11-27 05:33:09'),
	(10, 'F', 1, '2023-11-27 05:33:25', '2023-11-27 05:33:25'),
	(11, 'G', 1, '2023-11-27 05:36:22', '2023-11-27 05:37:02');

-- Dumping structure for table pds_db.leaves
DROP TABLE IF EXISTS `leaves`;
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.leaves: ~6 rows (approximately)
INSERT INTO `leaves` (`id`, `employee_id`, `leave_type`, `from_date`, `to_date`, `day`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(17, 1, 8, '2023-10-22', '2023-10-22', '4', 'nnn', 1, '2023-10-31 10:45:37', '2023-10-31 10:45:37'),
	(18, 1, 8, '2023-10-22', '2023-10-22', '3', 'nnn', 1, '2023-10-31 10:45:57', '2023-10-31 10:45:57'),
	(19, 1, 12, '2023-10-22', '2023-10-22', '2', 'f', 1, '2023-10-31 10:50:40', '2023-10-31 10:50:40'),
	(20, 1, 12, '2023-10-22', '2023-10-22', '2', 'f', 1, '2023-10-31 10:51:52', '2023-10-31 10:51:52'),
	(21, 32, 12, '2023-12-31', '2023-12-28', '2', 'sadfdsdsf', 0, '2023-12-28 06:29:48', '2023-12-28 06:29:48'),
	(22, 32, 12, '2023-12-29', '2023-12-11', '11', 'ewrw', 0, '2023-12-28 06:31:38', '2023-12-28 06:31:38');

-- Dumping structure for table pds_db.leave_types
DROP TABLE IF EXISTS `leave_types`;
CREATE TABLE IF NOT EXISTS `leave_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `leave_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `days` int NOT NULL DEFAULT '0',
  `create_at` date DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.leave_types: ~0 rows (approximately)
INSERT INTO `leave_types` (`id`, `leave_type`, `days`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
	(12, 'emergency', 10, '2023-03-23', 1, '2023-10-25 11:44:31', '2023-10-25 11:44:31');

-- Dumping structure for table pds_db.messages
DROP TABLE IF EXISTS `messages`;
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
	(20, 'test', 1924529986, 'ghit', 'intern', 'dhaka', 'dhaka', '2023-11-06 11:22:48', '2023-11-06 11:22:48'),
	(21, '1234', 1767590306, 'it', 'didar', '2023-12-04', '2023-12-04', '2023-12-04 11:29:49', '2023-12-04 11:29:49');

-- Dumping structure for table pds_db.migrations
DROP TABLE IF EXISTS `migrations`;
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
DROP TABLE IF EXISTS `offices`;
CREATE TABLE IF NOT EXISTS `offices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `office_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.offices: ~0 rows (approximately)
INSERT INTO `offices` (`id`, `office_name`, `status`, `created_at`, `updated_at`) VALUES
	(3, 'it', 2, '2023-10-23 06:57:31', '2023-11-27 05:19:09');

-- Dumping structure for table pds_db.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pds_db.password_resets: ~0 rows (approximately)

-- Dumping structure for table pds_db.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
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
DROP TABLE IF EXISTS `profiles`;
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
DROP TABLE IF EXISTS `promotions`;
CREATE TABLE IF NOT EXISTS `promotions` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.promotions: ~6 rows (approximately)
INSERT INTO `promotions` (`id`, `employee_id`, `name`, `promotion_ref_number`, `promotion_date`, `to_office`, `from_office`, `to_department`, `from_department`, `to_designation`, `from_designation`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(1, 4, 'arafat', '2211', '2023-03-23', 3, 3, 1, 1, 1, 1, 'good', 2, '2023-03-28 04:20:51', '2023-11-28 06:37:30'),
	(3, 1, NULL, '15665', '2023-03-23', 3, 3, 1, 1, 1, 1, 's45665', 1, '2023-11-26 07:05:42', '2023-11-28 06:11:27'),
	(11, 32, NULL, '3232', '2023-11-29', 3, 3, 1, 1, 1, 1, '23322', 1, '2023-11-28 05:17:28', '2023-12-28 06:18:54'),
	(12, 1, NULL, '464565', '2023-12-05', 3, 3, 6, 14, 1, 1, 'dfrtggtfh', 0, '2023-12-05 09:01:54', '2023-12-05 09:01:54'),
	(13, 55, NULL, '23455546', '2023-12-11', 3, 3, 1, 14, 1, 1, 'dfvdgt', 0, '2023-12-05 09:12:14', '2023-12-05 09:12:14'),
	(14, 32, NULL, '1', '2023-12-27', 3, 3, 1, 1, 1, 1, '555  tbdb y6hty', 0, '2023-12-28 06:24:03', '2023-12-28 06:29:10'),
	(15, 58, NULL, '333', '2024-01-04', 3, 3, 1, 14, 1, 1, '33', 0, '2024-01-04 05:28:26', '2024-01-04 05:28:26');

-- Dumping structure for table pds_db.registered_guest_message_replies
DROP TABLE IF EXISTS `registered_guest_message_replies`;
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
DROP TABLE IF EXISTS `rosters`;
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
DROP TABLE IF EXISTS `salaries`;
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
DROP TABLE IF EXISTS `settings`;
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
DROP TABLE IF EXISTS `speakers`;
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
DROP TABLE IF EXISTS `trainings`;
CREATE TABLE IF NOT EXISTS `trainings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL DEFAULT '0',
  `training_center_name` int DEFAULT '0',
  `training_name` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `training_score` int DEFAULT '0',
  `training_feedback` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `training_strt_date` date DEFAULT NULL,
  `training_end_date` date DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.trainings: ~4 rows (approximately)
INSERT INTO `trainings` (`id`, `employee_id`, `training_center_name`, `training_name`, `training_score`, `training_feedback`, `training_strt_date`, `training_end_date`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(3, 32, 23, '23', 32, '23', '2023-11-28', '2023-12-30', 'asdas', 1, '2023-11-28 08:15:44', '2023-12-27 11:24:28'),
	(4, 31, 23, '23', 32, '23', '2023-11-29', '2023-11-28', 'qweqwew', 0, '2023-11-28 08:16:04', '2023-11-28 08:16:04'),
	(9, 32, 2, '1', 32, '43', '2023-12-28', '2023-12-29', '3443', 0, '2023-12-28 06:03:10', '2023-12-28 06:14:38'),
	(10, 58, 23, '33', 33, '33', '2024-01-04', '2024-01-04', '33', 1, '2024-01-04 05:27:29', '2024-01-04 05:27:47');

-- Dumping structure for table pds_db.training_setups
DROP TABLE IF EXISTS `training_setups`;
CREATE TABLE IF NOT EXISTS `training_setups` (
  `id` int NOT NULL AUTO_INCREMENT,
  `training_name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `create_at` date DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.training_setups: ~0 rows (approximately)
INSERT INTO `training_setups` (`id`, `training_name`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
	(2, 'hhh', '2023-04-29', 0, '2023-10-19 10:05:32', '2023-10-19 10:05:32');

-- Dumping structure for table pds_db.transfers
DROP TABLE IF EXISTS `transfers`;
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

-- Dumping data for table pds_db.transfers: ~4 rows (approximately)
INSERT INTO `transfers` (`id`, `employee_id`, `to_office`, `from_office`, `to_department`, `from_department`, `to_designation`, `from_designation`, `transfer_order`, `transfer_type`, `transfer_date`, `join_date`, `transfer_letter`, `status`, `created_at`, `updated_at`, `transfer_order_number`) VALUES
	(31, 31, 3, 3, 14, 14, 1, 1, '1', 22, '2023-10-21', '2023-10-21', 'transfer_letter1701760725.jpg', 1, '2023-10-23 06:49:29', '2023-12-28 04:28:51', -1),
	(35, 4, 3, 3, 14, 14, 1, 1, '23', 22, '2023-12-11', '2023-12-22', 'transfer_letter1703740996.pdf', 1, '2023-12-28 05:23:16', '2023-12-28 05:23:53', 12),
	(36, 4, 3, 3, 1, 14, 1, 1, '12', 22, '2023-12-25', '2023-12-12', 'transfer_letter1703741076.pdf', 0, '2023-12-28 05:24:36', '2023-12-28 05:24:36', 12),
	(37, 32, 3, 3, 14, 14, 1, 1, '23', 21, '2023-12-02', '2023-12-22', 'transfer_letter1703741374.pdf', 0, '2023-12-28 05:29:34', '2023-12-28 05:29:34', 32),
	(39, 58, 3, 3, 1, 1, 1, 1, '23', 22, '2024-01-05', '2024-01-08', 'transfer_letter1704345972.sql', 1, '2024-01-04 05:26:12', '2024-01-04 05:26:48', 222);

-- Dumping structure for table pds_db.transfer_types
DROP TABLE IF EXISTS `transfer_types`;
CREATE TABLE IF NOT EXISTS `transfer_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL DEFAULT '0',
  `title` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table pds_db.transfer_types: ~2 rows (approximately)
INSERT INTO `transfer_types` (`id`, `employee_id`, `title`, `status`, `created_at`, `updated_at`) VALUES
	(21, 0, 'Eid', 1, '2023-11-27 11:16:24', '2023-11-27 11:16:26'),
	(22, 0, 'Puja', 1, '2023-11-27 11:16:27', '2023-11-27 11:16:28');

-- Dumping structure for table pds_db.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` int DEFAULT NULL,
  `otp_expire_at` datetime DEFAULT NULL,
  `otp_verified` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pds_db.users: ~9 rows (approximately)
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `phone`, `status`, `email_verified_at`, `password`, `remember_token`, `otp`, `otp_expire_at`, `otp_verified`, `created_at`, `updated_at`) VALUES
	(29, 1, 'Shakiur Rahman', 'shakiur.cse@gmail.com', NULL, 1, NULL, '$2y$10$gESZqlnul6VxKcgUfo34s.D0RijylcboNrbjx3/dAtuHWIdpLLIBi', NULL, NULL, NULL, NULL, '2022-08-25 10:46:50', '2022-09-08 08:28:57'),
	(48, 1, 'admin', 'admin@email.com', '01924529986', 1, NULL, '$2y$10$VJH/KD4hGJwFwdnsMLyx8.JgPZYcuqVf27Qsuj2Zi2JMCoL96DnEK', NULL, NULL, NULL, 1, '2022-09-29 17:50:28', '2022-09-29 17:52:49'),
	(85, 2, 'Ahsanul', 'ahsanul@gmail.com', '01767590306', 1, NULL, '$2y$10$VJH/KD4hGJwFwdnsMLyx8.JgPZYcuqVf27Qsuj2Zi2JMCoL96DnEK', NULL, 475520, '2023-11-07 14:32:50', 1, '2023-11-07 08:30:50', '2023-11-07 08:31:05'),
	(89, 2, 'didar', 'didar@gmail.com', '01648414032', 1, NULL, '$2y$10$VJH/KD4hGJwFwdnsMLyx8.JgPZYcuqVf27Qsuj2Zi2JMCoL96DnEK', NULL, 405766, '2023-11-07 14:57:14', 1, '2023-11-07 08:55:14', '2023-11-07 08:55:25'),
	(90, 0, 'sdf', 's@gmail.com', NULL, 0, NULL, '$2y$10$szau4ebas/H6T2hZhipF.uq77LKpaVYh1FOWPiR80/Q8ZO/I.N2hu', NULL, NULL, NULL, 1, '2023-11-08 04:23:15', '2023-11-08 04:23:15'),
	(91, 0, 'sdf', 'dd@gmail.com', NULL, 0, NULL, '$2y$10$ay7qemmkasPzknBss9bE9e/37rGzZCuO3yMF321/vuwF3ze9dAmOS', NULL, NULL, NULL, 1, '2023-11-27 04:39:50', '2023-11-27 04:39:50'),
	(93, 0, 'sdf', 'ddtt@gmail.com', NULL, 0, NULL, '$2y$10$N0OCJdD9qYANa4iuR2nFm.Y/BR6183OJdDZEgB5BF4Uv.0TlmOlUa', NULL, NULL, NULL, 1, '2023-11-27 04:40:44', '2023-11-27 04:40:44'),
	(126, 0, 'Ovi', 'hr@gmail.com', '01751684550', 0, NULL, '$2y$10$LE4uUsZ/5VzDm7rsOCVioeHBQQHHoWvw9TzbC0QkuNOagQt.jDzq.', NULL, NULL, NULL, 1, '2023-11-27 08:52:46', '2023-11-27 08:52:46'),
	(127, 0, '2342', 'avi@gmail.com', '01738528292', 0, NULL, '$2y$10$ZJhznr6BqB.G4FeCc5/ZGur7j1LDmdwjskh.OSEMIVQS2v9/LldOG', NULL, NULL, NULL, 1, '2023-11-27 10:56:58', '2023-11-28 06:43:22'),
	(142, 0, 'arif', 'arif@gmail.com', '01767590306', 0, NULL, '$2y$10$zVtCR.7DMRU2bHtD4bdGC.MERuF52q3NMgIQQFOIx0WBmBq5PVhEq', NULL, NULL, NULL, 1, '2023-12-03 11:35:07', '2023-12-03 11:35:07'),
	(143, 0, 'galib', 'galib@gmail.com', '01744444444', 0, NULL, '$2y$10$Dwni.9iP.tKDGr807rKbYuBbzkFghET2TABvY302ADON2YM1Ej4VC', NULL, NULL, NULL, 1, '2023-12-04 11:35:11', '2023-12-04 11:35:11'),
	(144, 0, 'tgfgy drtgdr', '', '5768890090', 0, NULL, '$2y$10$KL8JJ/cyxhREWxcPilHmJeioKJUgCr5dRvgw88aODZninlvV98llW', NULL, NULL, NULL, 1, '2023-12-05 06:30:13', '2023-12-05 06:30:13'),
	(147, 0, 'Hr Name', 'hr12323@gmail.com', '01738528293', 0, NULL, '$2y$10$GQLzucF/cV1R7xOeaslVmuwrm9aR0RyVgkKq6k4KlrRB2husfYLfy', NULL, NULL, NULL, 1, '2023-12-27 06:23:06', '2023-12-27 06:23:06'),
	(148, 2, 'Mezba Uddin', 'abc@gmail.com', '01920519595', 1, NULL, '$2y$10$UfPMYUZbVoX6Z3gcFhNm8.GB7xi3h6qhPrT97b0/WecnZqtO1qiYa', NULL, 757328, '2024-01-04 11:17:24', 1, '2024-01-04 05:15:24', '2024-01-04 05:19:48');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
