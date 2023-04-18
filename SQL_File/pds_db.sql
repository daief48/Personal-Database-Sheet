-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.32-0ubuntu0.22.04.2 - (Ubuntu)
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


-- Dumping database structure for pds_db
CREATE DATABASE IF NOT EXISTS `pds_db` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pds_db`;

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
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `social_media` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
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
DELETE FROM `failed_jobs`;

-- Dumping structure for table pds_db.leaves
DROP TABLE IF EXISTS `leaves`;
CREATE TABLE IF NOT EXISTS `leaves` (
  `id` int NOT NULL AUTO_INCREMENT,
  `leave_type` int DEFAULT '0',
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `day` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `description` text COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.leaves: ~0 rows (approximately)
DELETE FROM `leaves`;

-- Dumping structure for table pds_db.leave_types
DROP TABLE IF EXISTS `leave_types`;
CREATE TABLE IF NOT EXISTS `leave_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `leave_type` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `create_at` date DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.leave_types: ~0 rows (approximately)
DELETE FROM `leave_types`;

-- Dumping structure for table pds_db.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `create_at` date DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.offices: ~0 rows (approximately)
DELETE FROM `offices`;

-- Dumping structure for table pds_db.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pds_db.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;

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
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table pds_db.profiles
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `designation` int NOT NULL DEFAULT '0',
  `present_addr_houseno` text COLLATE utf8mb3_unicode_ci,
  `present_addr_roadno` text COLLATE utf8mb3_unicode_ci,
  `present_addr_area` text COLLATE utf8mb3_unicode_ci,
  `present_addr_upazila` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `present_addr_district` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `present_addr_postcode` int DEFAULT '0',
  `permanent_addr_houseno` text COLLATE utf8mb3_unicode_ci,
  `permanent_addr_roadno` text COLLATE utf8mb3_unicode_ci,
  `permanent_addr_area` text COLLATE utf8mb3_unicode_ci,
  `permanent_addr_upazila` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `permanent_addr_district` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `permanent_addr_postcode` int DEFAULT '0',
  `department` int DEFAULT '0',
  `job_location` int DEFAULT '0',
  `joining_date` date DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `spouse_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `number_of_cheild` int DEFAULT '0',
  `emergency_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_relation` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_phn_number` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_email` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_addr` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `emergency_distict` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.profiles: ~0 rows (approximately)
DELETE FROM `profiles`;

-- Dumping structure for table pds_db.promotions
DROP TABLE IF EXISTS `promotions`;
CREATE TABLE IF NOT EXISTS `promotions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `promotion_ref_number` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `promoted_designation` int DEFAULT '0',
  `promotion_date` date DEFAULT NULL,
  `description` text COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.promotions: ~2 rows (approximately)
DELETE FROM `promotions`;
INSERT INTO `promotions` (`id`, `name`, `promotion_ref_number`, `promoted_designation`, `promotion_date`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'arafat', '2211', 2, '2023-03-23', 'good', 1, '2023-03-28 04:20:51', '2023-03-28 05:38:18');

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
DELETE FROM `registered_guest_message_replies`;
INSERT INTO `registered_guest_message_replies` (`id`, `name`, `email`, `title`, `message_body`, `replied_by`, `replied_at`, `event_id`, `subject`, `created_at`, `updated_at`) VALUES
	(1, 'sdfdsf', 'shakiur.cse@gmail.com', NULL, '<p>sdfsdfds</p>', 1, '2022-09-28 12:29:57', 1, 'abc', '2022-09-28 12:29:57', '2022-09-28 12:29:57'),
	(2, 'sdfdsf', 'shakiur.cse@gmail.com', NULL, '<p>sdfsdfds</p>', 1, '2022-09-28 12:31:12', 1, 'abc', '2022-09-28 12:31:12', '2022-09-28 12:31:12'),
	(3, 'sdfdsf', 'shakiur.cse@gmail.com', NULL, '<p>dfsdfdsf</p>', 1, '2022-09-28 12:31:49', 1, 'aaaaaa', '2022-09-28 12:31:49', '2022-09-28 12:31:49'),
	(4, NULL, 'shakiur.cse@gmail.com', NULL, NULL, 1, '2022-09-29 17:16:56', 1, NULL, '2022-09-29 17:16:56', '2022-09-29 17:16:56'),
	(5, NULL, 'shakiur.cse@gmail.com', NULL, '<p>helllllllo</p>', 1, '2022-09-29 17:29:56', 1, 'Hello', '2022-09-29 17:29:56', '2022-09-29 17:29:56');

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
DELETE FROM `settings`;
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
DELETE FROM `speakers`;
INSERT INTO `speakers` (`id`, `name`, `image`, `occupation`, `organization`, `social_link`, `details`, `country`, `order`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Mutarika Pruksapong', 'speaker_image_1664399165.png', 'Programme Management Officer', 'Global Education and Training Institute (GETI) UNDRR', '{"speakerFacebook":"#","speakerInstagram":"#","speakerTwitter":"#","speakerLinkedin":"#"}', '', 'South Korea', 3, 1, '2022-09-08 08:53:08', '2022-10-02 18:07:55'),
	(2, 'Sidnel Furtado Fernandes', 'speaker_image_1664357015.png', 'Director of Civil Defense Campinas', '', '{"speakerFacebook":"#","speakerInstagram":"#","speakerTwitter":"#","speakerLinkedin":"#"}', '', 'Brazil', 4, 0, '2022-09-13 05:10:39', '2022-10-02 18:07:40'),
	(3, 'Sanjaya Bhatia', 'speaker_image_1664358192.png', 'Head, Global Education and Training Institute (GETI) UNDRR', '', '{"speakerFacebook":"#","speakerInstagram":"#","speakerTwitter":"#","speakerLinkedin":"#"}', '', 'India', 5, 1, '2022-09-13 05:49:44', '2022-10-02 18:07:31'),
	(4, 'Sissa Bekombo Priso', 'Sissa_BEKOMBO.jpeg', 'Resilience Project Manager', '', '{"speakerFacebook":"#","speakerInstagram":"#","speakerTwitter":"#","speakerLinkedin":"#"}', '', 'France', 6, 1, '2022-09-13 05:50:57', '2022-10-02 18:07:23'),
	(5, 'Didier Soto', 'didier-soto.jpeg', 'Head of Digital Solutions & Climate Change Resilience Project Manager', '', '{"speakerFacebook":"#","speakerInstagram":"#","speakerTwitter":"#","speakerLinkedin":"#"}', '', 'France', 7, 1, '2022-09-13 05:50:57', '2022-10-02 18:07:07'),
	(6, 'Md. Atiqul Huq', 'speaker_image_1664399385.png', 'Director General of Ministry of Disaster Management and Relief', 'DDM', '{"speakerFacebook":"#","speakerInstagram":"#","speakerTwitter":"#","speakerLinkedin":"#"}', '', 'Bangladesh', 2, 1, '2022-09-22 17:18:37', '2022-09-29 03:09:45'),
	(7, 'Md Kamrul Hasan', 'kamrul-hasan.png', 'GOVERNMENT OF THE PEOPLEÃ¢â‚¬â„¢S REPUBLIC OF BANGLADESH', '', '{"speakerFacebook":"#","speakerInstagram":"#","speakerTwitter":"#","speakerLinkedin":"#"}', '', 'Bangladesh', 1, 1, '2022-09-22 17:18:37', '2022-10-02 18:06:36');

-- Dumping structure for table pds_db.trainings
DROP TABLE IF EXISTS `trainings`;
CREATE TABLE IF NOT EXISTS `trainings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `training_center_name` int DEFAULT '0',
  `training_score` int DEFAULT '0',
  `training_feedback` text COLLATE utf8mb3_unicode_ci,
  `training_strt_date` date DEFAULT NULL,
  `training_end_date` date DEFAULT NULL,
  `description` text COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.trainings: ~0 rows (approximately)
DELETE FROM `trainings`;

-- Dumping structure for table pds_db.training_setups
DROP TABLE IF EXISTS `training_setups`;
CREATE TABLE IF NOT EXISTS `training_setups` (
  `id` int NOT NULL AUTO_INCREMENT,
  `training_name` text COLLATE utf8mb3_unicode_ci,
  `create_at` date DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.training_setups: ~0 rows (approximately)
DELETE FROM `training_setups`;

-- Dumping structure for table pds_db.transfers
DROP TABLE IF EXISTS `transfers`;
CREATE TABLE IF NOT EXISTS `transfers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `to_office` text COLLATE utf8mb3_unicode_ci,
  `department` int DEFAULT '0',
  `designation` int DEFAULT '0',
  `transfer_order` text COLLATE utf8mb3_unicode_ci,
  `transfer_type` int DEFAULT '0',
  `transfer_date` date DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `transfer_letter` text COLLATE utf8mb3_unicode_ci,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pds_db.transfers: ~0 rows (approximately)
DELETE FROM `transfers`;

-- Dumping structure for table pds_db.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pds_db.users: ~6 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `phone`, `status`, `email_verified_at`, `password`, `remember_token`, `otp`, `otp_expire_at`, `otp_verified`, `created_at`, `updated_at`) VALUES
	(29, 1, 'Shakiur Rahman', 'shakiur.cse@gmail.com', NULL, 1, NULL, '$2y$10$gESZqlnul6VxKcgUfo34s.D0RijylcboNrbjx3/dAtuHWIdpLLIBi', NULL, NULL, NULL, NULL, '2022-08-25 10:46:50', '2022-09-08 08:28:57'),
	(48, 1, 'admin', 'admin@email.com', NULL, 1, NULL, '$2y$10$6HFeFgMQ5kKul/BmNY0smu2/RAhAUPU3RyJiFoIioPNwAH2FxsGv2', NULL, NULL, NULL, NULL, '2022-09-29 17:50:28', '2022-09-29 17:52:49'),
	(51, 2, 'arafat', 'arafat@gmail.com', '01704916412', 1, NULL, '$2y$10$fyPDWLvIxrx6kOMOwaOMLeOorgjDighFCoE/WIZ/QQKqeiZcj5fqa', NULL, NULL, NULL, NULL, '2023-03-23 04:56:37', '2023-03-23 04:56:37'),
	(52, 2, 'yeasin', 'yeasin@mail.com', '01704916413', 1, NULL, '$2y$10$MNYDKRhQmIzyiRgG1XBkfO4JTZghjwJBkiHiQq2sK9dv7FOjoHRHS', NULL, NULL, NULL, NULL, '2023-03-23 06:54:24', '2023-03-23 06:54:24'),
	(76, 2, 'shakiur', 'shakiur@gmail.com', '01738528292', 0, NULL, '$2y$10$.8J7MRwtBeCSEf8aAyX/muqHBcmk7Jpo2vqQo80GmHSJNP2wLtWYG', NULL, 937614, '2023-03-27 12:14:17', 0, '2023-03-27 06:11:17', '2023-03-27 06:41:27'),
	(77, 2, 'rahin', 'rahin@gmail.com', '01704916412', 0, NULL, '$2y$10$7aJnz5FtAVKSAAKpXhYGyeI4zyRTqVkCrl8YgCLR4OmPOIJ5LOcEe', NULL, 617728, '2023-04-01 09:38:00', 0, '2023-04-01 03:37:00', '2023-04-01 03:37:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
