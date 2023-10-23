-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 19, 2023 at 10:18 AM
-- Server version: 8.0.34-0ubuntu0.22.04.1
-- PHP Version: 8.1.24

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `speakers`
--
ALTER TABLE `speakers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `speakers`
--
ALTER TABLE `speakers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
