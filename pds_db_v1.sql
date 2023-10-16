-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.34-0ubuntu0.22.04.1 - (Ubuntu)
-- Server OS:                    Linux
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

-- Dumping structure for table pds_db.acrs
DROP TABLE IF EXISTS `acrs`;
CREATE TABLE IF NOT EXISTS `acrs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `emp_id` int DEFAULT '0',
  `emp_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `designation` int DEFAULT '0',
  `department` int DEFAULT '0',
  `office_name` int DEFAULT '0',
  `acr_year` year DEFAULT NULL,
  `score` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `file` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.acrs: ~0 rows (approximately)
DELETE FROM `acrs`;
INSERT INTO `acrs` (`id`, `emp_id`, `emp_name`, `designation`, `department`, `office_name`, `acr_year`, `score`, `file`, `remarks`, `status`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Yeasin', 2, 2, 2, '2023', '4', 'file_update', 'remark_update', 0, '2023-03-30 07:43:16', '2023-03-30 08:08:08');

-- Dumping structure for table pds_db.contacts
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `social_media` text COLLATE utf8mb4_general_ci,
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pds_db.contacts: ~0 rows (approximately)
DELETE FROM `contacts`;
INSERT INTO `contacts` (`id`, `phone_number`, `email`, `social_media`, `address`, `created_at`, `updated_at`) VALUES
	(1, 'stringup', 'stringup', 'stringup', 'stringup', '2022-09-08 11:23:04', '2022-09-08 11:41:44');

-- Dumping structure for table pds_db.contact_messages
DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subject` text COLLATE utf8mb4_general_ci,
  `message` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table pds_db.contact_messages: ~0 rows (approximately)
DELETE FROM `contact_messages`;
INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
	(2, 'shakiur', 'shakiur.cse@gmail.com', 'test', 'aaaaaaaaaaaaaaa', '2022-09-27 11:16:49', '2022-09-27 11:16:49');

-- Dumping structure for table pds_db.departments
DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `create_at` date DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.departments: ~0 rows (approximately)
DELETE FROM `departments`;
INSERT INTO `departments` (`id`, `dept_name`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Accounts', '2023-04-13', 1, '2023-04-13 03:31:46', '2023-04-13 03:31:47');

-- Dumping structure for table pds_db.designations
DROP TABLE IF EXISTS `designations`;
CREATE TABLE IF NOT EXISTS `designations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `designation_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `create_at` date DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.designations: ~0 rows (approximately)
DELETE FROM `designations`;
INSERT INTO `designations` (`id`, `designation_name`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Officer', '2023-04-11', 1, '2023-04-11 07:46:37', NULL);

-- Dumping structure for table pds_db.employees
DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `department` int DEFAULT NULL,
  `designation` int DEFAULT '0',
  `present_addr_houseno` text COLLATE utf8mb3_unicode_ci,
  `present_addr_roadno` text COLLATE utf8mb3_unicode_ci,
  `present_addr_area` text COLLATE utf8mb3_unicode_ci,
  `present_addr_upazila` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `present_addr_district` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `present_addr_postcode` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `permanent_addr_houseno` text COLLATE utf8mb3_unicode_ci,
  `permanent_addr_roadno` text COLLATE utf8mb3_unicode_ci,
  `permanent_addr_area` text COLLATE utf8mb3_unicode_ci,
  `permanent_addr_upazila` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `permanent_addr_district` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `permanent_addr_postcode` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `job_location` tinytext COLLATE utf8mb3_unicode_ci,
  `joining_date` date DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `education_history` text COLLATE utf8mb3_unicode_ci,
  `mother_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `spouse_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `number_of_child` int DEFAULT '0',
  `emergency_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_relation` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_phn_number` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_email` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_addr` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_district` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.employees: ~0 rows (approximately)
DELETE FROM `employees`;
INSERT INTO `employees` (`id`, `user_id`, `image`, `name`, `mobile_number`, `email`, `department`, `designation`, `present_addr_houseno`, `present_addr_roadno`, `present_addr_area`, `present_addr_upazila`, `present_addr_district`, `present_addr_postcode`, `permanent_addr_houseno`, `permanent_addr_roadno`, `permanent_addr_area`, `permanent_addr_upazila`, `permanent_addr_district`, `permanent_addr_postcode`, `job_location`, `joining_date`, `father_name`, `education_history`, `mother_name`, `spouse_name`, `number_of_child`, `emergency_name`, `emergency_relation`, `emergency_phn_number`, `emergency_email`, `emergency_addr`, `emergency_district`, `status`, `created_at`, `updated_at`) VALUES
	(1, 29, 'photo-64943e66d297e-2023-Jun-Thu.png', 'Shakiur', '01738528292', 'shakiur.cse@gmail.com', 1, 1, '34', '13', 'adsfsd', 'aaa', 'Dhaka', '1216', '3', '4', '15', 'bbbb', 'Rangpur', '5400', 'Mirpur1', '2023-04-06', '4 ahmed', '[{"exam_name":"Bsc","institute_name":"UODA","district":"Dhaka","upazila":"","subject":"CSE","passing_year":"2013","grade":"x"},{"exam_name":"HSC","institute_name":"Technical School & College","district":"Rangpur","upazila":"","subject":"Science","passing_year":"2006","grade":"x"},{"exam_name":"SSC","institute_name":"Technical School and College","district":"Rangpur","upazila":"","subject":"Science","passing_year":"2004","grade":"x"}]', 'b ahmed', 'c ahmedl', 4, 'Arafat2', 'Brother', '1234567890', 'arafath@email.com', 'Khilkhet', 'Dhaka3', 1, '2023-04-11 05:53:47', '2023-09-11 08:59:25');

-- Dumping structure for table pds_db.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pds_db.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table pds_db.leaves
DROP TABLE IF EXISTS `leaves`;
CREATE TABLE IF NOT EXISTS `leaves` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL DEFAULT '0',
  `leave_type` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `apply_data` date DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `day` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.leaves: ~4 rows (approximately)
DELETE FROM `leaves`;
INSERT INTO `leaves` (`id`, `employee_id`, `leave_type`, `created_at`, `updated_at`, `apply_data`, `from_date`, `to_date`, `day`, `description`, `status`) VALUES
	(2, 0, 2, '2023-10-15 06:09:33', '2023-10-15 06:19:22', NULL, '2023-03-23', '2023-03-23', '2', 'good', 0),
	(3, 0, 1, '2023-10-15 06:10:57', '2023-10-15 06:10:57', '2023-10-15', '2023-10-15', '2023-10-15', '2', 'gg', 0),
	(4, 0, 1, '2023-10-15 06:21:59', '2023-10-15 06:21:59', NULL, '2023-03-23', '2023-03-23', '4', 'sick', NULL),
	(5, 0, 1, '2023-10-15 06:23:21', '2023-10-15 06:23:21', NULL, '2023-03-23', '2023-03-23', '4', 'sick', NULL);

-- Dumping structure for table pds_db.leave_types
DROP TABLE IF EXISTS `leave_types`;
CREATE TABLE IF NOT EXISTS `leave_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `leave_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `day` int DEFAULT '0',
  `create_at` date DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.leave_types: ~1 rows (approximately)
DELETE FROM `leave_types`;
INSERT INTO `leave_types` (`id`, `leave_type`, `day`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
	(2, NULL, 0, NULL, NULL, '2023-10-15 05:59:11', '2023-10-15 05:59:11');

-- Dumping structure for table pds_db.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pds_db.migrations: ~4 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- Dumping structure for table pds_db.offices
DROP TABLE IF EXISTS `offices`;
CREATE TABLE IF NOT EXISTS `offices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `office_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `office_start_date` date DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.offices: ~2 rows (approximately)
DELETE FROM `offices`;
INSERT INTO `offices` (`id`, `office_name`, `office_start_date`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Dhaka', '2023-04-30', 1, '2023-05-02 05:18:45', NULL),
	(2, 'Sylhet', '2023-05-02', 1, '2023-05-02 05:18:44', NULL);

-- Dumping structure for table pds_db.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pds_db.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;

-- Dumping structure for table pds_db.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pds_db.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table pds_db.promotions
DROP TABLE IF EXISTS `promotions`;
CREATE TABLE IF NOT EXISTS `promotions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `promotion_ref_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `promoted_designation` int DEFAULT '0',
  `promotion_date` date DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.promotions: ~1 rows (approximately)
DELETE FROM `promotions`;
INSERT INTO `promotions` (`id`, `employee_id`, `name`, `promotion_ref_number`, `promoted_designation`, `promotion_date`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'arafat', '2211', 1, '2023-03-23', 'good', 1, '2023-03-28 04:20:51', '2023-10-15 09:40:18'),
	(3, 12, NULL, '1234', 1, '2023-03-23', 'dood', 0, '2023-10-15 04:55:55', '2023-10-15 04:55:55');

-- Dumping structure for table pds_db.registered_guest_message_replies
DROP TABLE IF EXISTS `registered_guest_message_replies`;
CREATE TABLE IF NOT EXISTS `registered_guest_message_replies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_general_ci,
  `message_body` text COLLATE utf8mb4_general_ci,
  `replied_by` int DEFAULT NULL,
  `replied_at` datetime DEFAULT NULL,
  `event_id` int DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pds_db.registered_guest_message_replies: ~5 rows (approximately)
DELETE FROM `registered_guest_message_replies`;
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
DELETE FROM `rosters`;

-- Dumping structure for table pds_db.settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `site_logo` text COLLATE utf8mb4_general_ci,
  `favicon` text COLLATE utf8mb4_general_ci,
  `copy_write` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pds_db.settings: ~0 rows (approximately)
DELETE FROM `settings`;
INSERT INTO `settings` (`id`, `site_title`, `site_logo`, `favicon`, `copy_write`, `created_at`, `updated_at`) VALUES
	(1, 'Test_update', 'Test_update', 'Test_update', 'Test_update', '2022-09-07 06:20:49', '2022-09-07 06:37:13');

-- Dumping structure for table pds_db.speakers
DROP TABLE IF EXISTS `speakers`;
CREATE TABLE IF NOT EXISTS `speakers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_link` text COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pds_db.speakers: ~7 rows (approximately)
DELETE FROM `speakers`;
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
  `training_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `training_center_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `training_score` int DEFAULT '0',
  `training_feedback` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `training_strt_date` date DEFAULT NULL,
  `training_end_date` date DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.trainings: ~3 rows (approximately)
DELETE FROM `trainings`;
INSERT INTO `trainings` (`id`, `employee_id`, `training_name`, `training_center_name`, `training_score`, `training_feedback`, `description`, `training_strt_date`, `training_end_date`, `status`, `created_at`, `updated_at`) VALUES
	(2, 0, '', '', 34, 'good', 'good', '2023-10-17', '2023-10-17', 1, '2023-10-14 07:34:20', '2023-10-14 07:34:20'),
	(3, 0, 'Software', 'Dhaka', 98, 'good', 'software program', '2023-10-17', '2023-10-17', 0, '2023-10-15 04:32:34', '2023-10-15 04:32:34'),
	(4, 0, 'Software', 'Dhaka', 98, 'good', 'software program', '2023-10-17', '2023-10-17', 0, '2023-10-15 04:32:39', '2023-10-15 04:32:39');

-- Dumping structure for table pds_db.training_setups
DROP TABLE IF EXISTS `training_setups`;
CREATE TABLE IF NOT EXISTS `training_setups` (
  `id` int NOT NULL AUTO_INCREMENT,
  `training_name` text COLLATE utf8mb3_unicode_ci,
  `training_center_name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `create_at` date DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.training_setups: ~1 rows (approximately)
DELETE FROM `training_setups`;
INSERT INTO `training_setups` (`id`, `training_name`, `training_center_name`, `create_at`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Software', 'Dhaka', '2023-10-17', 1, NULL, NULL);

-- Dumping structure for table pds_db.transfers
DROP TABLE IF EXISTS `transfers`;
CREATE TABLE IF NOT EXISTS `transfers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL DEFAULT '0',
  `from_office` text COLLATE utf8mb3_unicode_ci,
  `to_office` text COLLATE utf8mb3_unicode_ci,
  `department` int DEFAULT '0',
  `designation` int DEFAULT '0',
  `transfer_order` varchar(250) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `transfer_order_number` int DEFAULT NULL,
  `transfer_type` int DEFAULT '0',
  `transfer_date` date DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `transfer_letter` text COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.transfers: ~3 rows (approximately)
DELETE FROM `transfers`;
INSERT INTO `transfers` (`id`, `employee_id`, `from_office`, `to_office`, `department`, `designation`, `transfer_order`, `transfer_order_number`, `transfer_type`, `transfer_date`, `join_date`, `transfer_letter`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Mymensingh', 'Dhaka', 3, 23, '23', 1204, 2, '2023-10-11', '2023-10-11', 'abc.pdf', 0, '2023-04-29 09:04:34', '2023-10-15 04:11:03'),
	(2, 0, 'Mymensingh', 'Dhaka', 3, 23, '23', 1204, 2, '2023-10-11', '2023-10-11', 'df', 0, '2023-10-14 06:17:45', '2023-10-14 06:24:59'),
	(3, 0, 'mymensingh', 'dhaka', 2, 2, '2', 2, 2, '2023-04-29', '2023-04-29', 'df', 0, '2023-10-14 06:17:47', '2023-10-14 06:17:47');

-- Dumping structure for table pds_db.transfer_types
DROP TABLE IF EXISTS `transfer_types`;
CREATE TABLE IF NOT EXISTS `transfer_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` tinytext COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table pds_db.transfer_types: ~2 rows (approximately)
DELETE FROM `transfer_types`;
INSERT INTO `transfer_types` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'General Transfer', 1, '2023-04-29 08:57:03', '2023-04-29 08:57:06'),
	(2, 'Punishment Tranfer', 1, '2023-04-29 08:57:42', '2023-04-29 08:57:43');

-- Dumping structure for table pds_db.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` int DEFAULT NULL,
  `otp_expire_at` datetime DEFAULT NULL,
  `otp_verified` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pds_db.users: ~0 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `phone`, `status`, `email_verified_at`, `password`, `remember_token`, `otp`, `otp_expire_at`, `otp_verified`, `created_at`, `updated_at`) VALUES
	(29, 1, 'Shakiur Rahman', 'shakiur.cse@gmail.com', '01738528292', 1, NULL, '$2a$12$2JZmOW6P367DZP/W6gA.mOTQJob1H388f7G43UN.2w4JDXaboLXv6', NULL, 123456, NULL, 1, '2022-08-25 10:46:50', '2023-06-18 04:24:42'),
	(121, 2, 'Didar', 'didar@gmail.com', '01767590306', 0, NULL, '$2y$10$MyJbPaz2ngLzavMiX.nCGuMJ2V3tXELqxMjKis0UV4yRp45D0f7ca', NULL, 648038, '2023-10-14 12:40:46', 1, '2023-10-14 06:38:46', '2023-10-14 06:38:46');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
