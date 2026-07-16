-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 16, 2026 at 09:57 AM
-- Server version: 10.11.18-MariaDB-log
-- PHP Version: 8.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spahhse1_sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(127) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(127) NOT NULL,
  `lname` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `fname`, `lname`) VALUES
(1, 'elias', '$2y$10$H7obJEdmLzqqcPy7wQWhsOLUvrgzC8f1Y1or2Gxaza5z1PT0tvLy6', 'Elias', 'Abdurrahman'),
(2, 'msam', '$2y$10$H7obJEdmLzqqcPy7wQWhsOLUvrgzC8f1Y1or2Gxaza5z1PT0tvLy6', 'Saker', 'Ali Miah');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `discipline` enum('Science','Humanities','Business Studies','None') NOT NULL DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `class_name`, `discipline`) VALUES
(1, 'Class-6', 'None'),
(2, 'Class-7', 'None'),
(3, 'Class-8', 'None'),
(13, 'Class-9', 'None'),
(14, 'Class-10', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `class_routines`
--

CREATE TABLE `class_routines` (
  `routine_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `routine_image` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `uploaded_by` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_subjects`
--

CREATE TABLE `class_subjects` (
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `event_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `location` varchar(255) NOT NULL,
  `is_online` tinyint(1) DEFAULT 0,
  `event_type` enum('Competition','Seminar','Workshop','Sports','Cultural') DEFAULT 'Seminar',
  `featured_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `title`, `description`, `event_date`, `start_time`, `end_time`, `location`, `is_online`, `event_type`, `featured_image`, `created_at`, `updated_at`) VALUES
(1, 'Annual Quiz Competition', 'Inter-school quiz competition with exciting prizes', '2023-11-15', '10:00:00', '13:00:00', 'School Auditorium', 0, 'Competition', NULL, '2025-07-20 07:54:38', '2025-07-20 07:54:38'),
(2, 'Debate Championship', 'National level debate competition on current affairs', '2023-11-20', '09:30:00', '16:00:00', 'City Convention Center', 0, 'Competition', NULL, '2025-07-20 07:54:38', '2025-07-20 07:54:38'),
(3, 'Science Fair', 'Student projects exhibition and competition', '2023-12-05', '09:00:00', '15:00:00', 'School Ground', 0, 'Competition', NULL, '2025-07-20 07:54:38', '2025-07-20 07:54:38'),
(4, 'Career Guidance Seminar', 'Interactive session with industry experts', '2023-11-25', '14:00:00', '16:30:00', 'Online', 1, 'Seminar', NULL, '2025-07-20 07:54:38', '2025-07-20 07:54:38'),
(5, 'Robotics Workshop', 'Hands-on workshop for beginners', '2023-12-10', '10:00:00', '13:00:00', 'Computer Lab', 0, 'Workshop', NULL, '2025-07-20 07:54:38', '2025-07-20 07:54:38'),
(6, 'Prize Cerimony', 'addsav s sdasd sdsdasdsa dsad sasasa ', '2025-08-04', '11:15:00', '16:00:00', 'School', 0, 'Seminar', NULL, '2025-08-03 09:12:46', '2025-08-03 09:12:46');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `thumbnail_path` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `file_type` enum('image','video') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `file_name`, `file_path`, `thumbnail_path`, `caption`, `upload_date`, `file_type`) VALUES
(1, '1.jpeg', 'uploads/gallery/688522f71d5988.21250635.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(2, '2.jpeg', 'uploads/gallery/688522f72baf52.43707671.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(3, '3.jpeg', 'uploads/gallery/688522f730f926.38922105.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(4, '4.jpeg', 'uploads/gallery/688522f734be97.02370982.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(5, '5.jpeg', 'uploads/gallery/688522f73bd8c7.90597702.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(6, '6.jpeg', 'uploads/gallery/688522f742fe87.67693554.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(7, '7.jpeg', 'uploads/gallery/688522f7496862.04096302.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(8, '8.jpeg', 'uploads/gallery/688522f75344b8.94753195.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(9, '9.jpeg', 'uploads/gallery/688522f7569ab4.89762728.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(10, '10.jpeg', 'uploads/gallery/688522f759dfe6.99013186.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(11, '11.jpeg', 'uploads/gallery/688522f75d7042.75097231.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(12, '12.jpeg', 'uploads/gallery/688522f760df88.29135726.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(13, '13.jpeg', 'uploads/gallery/688522f767fde2.51554366.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(14, '14.jpeg', 'uploads/gallery/688522f76b7123.69813834.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(15, '15.jpeg', 'uploads/gallery/688522f770f0d6.73808993.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(16, '16.jpeg', 'uploads/gallery/688522f7760693.85036376.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(17, '17.jpeg', 'uploads/gallery/688522f7798435.30301804.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(18, '18.jpeg', 'uploads/gallery/688522f77cd091.11007983.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(19, '19.jpeg', 'uploads/gallery/688522f7800145.90043711.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(20, '20.jpeg', 'uploads/gallery/688522f7832218.96882728.jpeg', NULL, '', '2025-07-26 18:48:23', 'image'),
(21, '1.mp4', 'uploads/gallery/6885377d9dffa8.33871858.mp4', 'uploads/gallery/6885377d9e7d95.65699255_thumb.jpg', 'sports', '2025-07-26 20:15:57', 'video'),
(25, '3.mp4', 'uploads/gallery/688538074dcb71.68923780.mp4', 'uploads/gallery/688538074e0e42.87669239_thumb.jpg', 'group study', '2025-07-26 20:18:15', 'video'),
(27, '1000066506.jpg', 'uploads/gallery/689d678f46dcb0.66517484.jpg', NULL, '', '2025-08-14 04:35:27', 'image'),
(28, '1000066512.jpg', 'uploads/gallery/689d678f47d920.78851980.jpg', NULL, '', '2025-08-14 04:35:27', 'image'),
(29, '1000066514.jpg', 'uploads/gallery/689d67a67654f2.79081658.jpg', NULL, '', '2025-08-14 04:35:50', 'image'),
(30, '1000066506.jpg', 'uploads/gallery/689d67a6795663.69387671.jpg', NULL, '', '2025-08-14 04:35:50', 'image'),
(32, '1000067472.jpg', 'uploads/gallery/68b18dca2da231.17804730.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(33, '1000067468.jpg', 'uploads/gallery/68b18dca2e7b54.71399730.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(34, '1000063780.jpg', 'uploads/gallery/68b18dca302520.29776455.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(35, '1000063776.jpg', 'uploads/gallery/68b18dca30bc43.76017896.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(36, '1000063771.jpg', 'uploads/gallery/68b18dca318577.38563103.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(37, '1000063774.jpg', 'uploads/gallery/68b18dca3250f1.40435132.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(38, '1000063782.jpg', 'uploads/gallery/68b18dca32e498.66348405.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(39, '1000063752.jpg', 'uploads/gallery/68b18dca33a591.41668377.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(40, '1000063746.jpg', 'uploads/gallery/68b18dca364dc5.64517361.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(41, '1000063750.jpg', 'uploads/gallery/68b18dca372bf1.46208523.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(42, '1000063748.jpg', 'uploads/gallery/68b18dca37c454.15419424.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(43, '1000063744.jpg', 'uploads/gallery/68b18dca398506.21893207.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(44, '1000063740.jpg', 'uploads/gallery/68b18dca3a2ca4.03462688.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(45, '1000063738.jpg', 'uploads/gallery/68b18dca3aca61.11080995.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(46, '1000063731.jpg', 'uploads/gallery/68b18dca3c2394.80794626.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(47, '1000063727.jpg', 'uploads/gallery/68b18dca3cb7f5.04759723.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(48, '1000063725.jpg', 'uploads/gallery/68b18dca3d4de8.37099893.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(49, '1000063702.jpg', 'uploads/gallery/68b18dca3ddfe0.17890060.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(50, '6040b9cc-9970-47ae-8772-41627f72e684-1_all_38380.jpg', 'uploads/gallery/68b18dca3f3b62.62243497.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(51, '1000063695.jpg', 'uploads/gallery/68b18dca3fb316.43558889.jpg', NULL, '', '2025-08-29 11:23:54', 'image'),
(52, '1000058925.jpg', 'uploads/gallery/68b18fb5ef3dd7.84113341.jpg', NULL, '', '2025-08-29 11:32:05', 'image'),
(53, '1000058922.jpg', 'uploads/gallery/68b18fb5f1e553.48157806.jpg', NULL, '', '2025-08-29 11:32:05', 'image'),
(54, '1000058928.jpg', 'uploads/gallery/68b18fb5f24f40.07560383.jpg', NULL, '', '2025-08-29 11:32:05', 'image'),
(55, '1000058931.jpg', 'uploads/gallery/68b18fb5f2cae1.23317303.jpg', NULL, '', '2025-08-29 11:32:05', 'image'),
(56, '1000058935.png', 'uploads/gallery/68b18fb6003ac1.54007381.png', NULL, '', '2025-08-29 11:32:06', 'image'),
(57, '1000052440.jpg', 'uploads/gallery/68b18fb6011265.82015833.jpg', NULL, '', '2025-08-29 11:32:06', 'image'),
(58, '1000052443.jpg', 'uploads/gallery/68b18fb6017065.69476252.jpg', NULL, '', '2025-08-29 11:32:06', 'image'),
(59, '1000052422.jpg', 'uploads/gallery/68b18fb601ea50.93053061.jpg', NULL, '', '2025-08-29 11:32:06', 'image'),
(60, '1000052433.jpg', 'uploads/gallery/68b18fb603a146.00767825.jpg', NULL, '', '2025-08-29 11:32:06', 'image'),
(61, '1000060106.jpg', 'uploads/gallery/68b18fb6041fd1.01733035.jpg', NULL, '', '2025-08-29 11:32:06', 'image'),
(62, '1000060107.jpg', 'uploads/gallery/68b18fb604e7f7.32398852.jpg', NULL, '', '2025-08-29 11:32:06', 'image'),
(63, '1000060109.jpg', 'uploads/gallery/68b18fb605dc68.17419426.jpg', NULL, '', '2025-08-29 11:32:06', 'image'),
(64, '1000060111.jpg', 'uploads/gallery/68b18fb6068f76.81607230.jpg', NULL, '', '2025-08-29 11:32:06', 'image'),
(65, '1000060112.jpg', 'uploads/gallery/68b18fb61608d9.46990115.jpg', NULL, '', '2025-08-29 11:32:06', 'image'),
(66, '1000060113.jpg', 'uploads/gallery/68b18fb62a5278.80316183.jpg', NULL, '', '2025-08-29 11:32:06', 'image'),
(67, '1000060115.jpg', 'uploads/gallery/68b18fb63bfb09.14150635.jpg', NULL, '', '2025-08-29 11:32:06', 'image'),
(68, '1000060068.jpg', 'uploads/gallery/68b18fb64984d2.08864354.jpg', NULL, '', '2025-08-29 11:32:06', 'image'),
(69, '1000060067.jpg', 'uploads/gallery/68b18fb64afc81.80184376.jpg', NULL, '', '2025-08-29 11:32:06', 'image'),
(70, '1000073064.jpg', 'uploads/gallery/68c423d026b912.63595348.jpg', NULL, '', '2025-09-12 13:44:48', 'image'),
(72, '1000073062.jpg', 'uploads/gallery/68c423d02837f8.62230876.jpg', NULL, '', '2025-09-12 13:44:48', 'image'),
(74, '1000074392.jpg', 'uploads/gallery/68cfb0c8be7f84.31237785.jpg', NULL, '', '2025-09-21 08:01:12', 'image'),
(75, '1000074391.jpg', 'uploads/gallery/68cfb0c8bf0923.59868333.jpg', NULL, '', '2025-09-21 08:01:12', 'image'),
(76, '1000074128.jpg', 'uploads/gallery/68cfb0c8bfc386.07864159.jpg', NULL, '', '2025-09-21 08:01:12', 'image'),
(77, '1000074099.jpg', 'uploads/gallery/68cfb0c8c020e2.89663294.jpg', NULL, '', '2025-09-21 08:01:12', 'image'),
(78, '1000074089.jpg', 'uploads/gallery/68cfb0c8c1c974.10351633.jpg', NULL, '', '2025-09-21 08:01:12', 'image'),
(79, '1000074054.jpg', 'uploads/gallery/68cfb0c8c22e65.29043146.jpg', NULL, '', '2025-09-21 08:01:12', 'image'),
(80, '1000074061.jpg', 'uploads/gallery/68cfb0c8c2ba68.57244562.jpg', NULL, '', '2025-09-21 08:01:12', 'image'),
(81, '1000092629.jpg', 'uploads/gallery/695ced19129c96.95686961.jpg', NULL, '', '2026-01-06 11:08:09', 'image'),
(82, '1000092630.jpg', 'uploads/gallery/695ced19177eb8.12159222.jpg', NULL, '', '2026-01-06 11:08:09', 'image'),
(83, '1000092632.jpg', 'uploads/gallery/695ced1919e617.01385906.jpg', NULL, '', '2026-01-06 11:08:09', 'image'),
(84, '1000092631.jpg', 'uploads/gallery/695ced191c1112.70939759.jpg', NULL, '', '2026-01-06 11:08:09', 'image'),
(85, '1000092628.jpg', 'uploads/gallery/695ced191efab0.53987087.jpg', NULL, '', '2026-01-06 11:08:09', 'image'),
(86, '1000092627.jpg', 'uploads/gallery/695ced19250ac2.96237551.jpg', NULL, '', '2026-01-06 11:08:09', 'image'),
(87, '1000092626.jpg', 'uploads/gallery/695ced192b3651.13681595.jpg', NULL, '', '2026-01-06 11:08:09', 'image'),
(88, '1000092623.jpg', 'uploads/gallery/695ced19340562.65595154.jpg', NULL, '', '2026-01-06 11:08:09', 'image'),
(89, '1000092624.jpg', 'uploads/gallery/695ced19386592.37468683.jpg', NULL, '', '2026-01-06 11:08:09', 'image'),
(90, '1000092625.jpg', 'uploads/gallery/695ced193ba694.18426668.jpg', NULL, '', '2026-01-06 11:08:09', 'image'),
(91, '1000096307.jpg', 'uploads/gallery/6992a6e17187c2.77419858.jpg', NULL, '', '2026-02-16 05:10:57', 'image'),
(92, '1000096325.jpg', 'uploads/gallery/6992a6e1754ce5.11616787.jpg', NULL, '', '2026-02-16 05:10:57', 'image'),
(93, '1000096305.jpg', 'uploads/gallery/6992a6e17634c1.28423739.jpg', NULL, '', '2026-02-16 05:10:57', 'image'),
(94, '1000096323.jpg', 'uploads/gallery/6992a6e1770636.91646318.jpg', NULL, '', '2026-02-16 05:10:57', 'image'),
(95, '1000096321.jpg', 'uploads/gallery/6992a6e177e712.52525228.jpg', NULL, '', '2026-02-16 05:10:57', 'image'),
(96, '1000096303.jpg', 'uploads/gallery/6992a6e178a948.49138787.jpg', NULL, '', '2026-02-16 05:10:57', 'image'),
(97, '1000096283.jpg', 'uploads/gallery/6992a6e1798971.59637766.jpg', NULL, '', '2026-02-16 05:10:57', 'image'),
(98, '1000096289.jpg', 'uploads/gallery/6992a6e17a4994.55798935.jpg', NULL, '', '2026-02-16 05:10:57', 'image'),
(99, '1000096292.jpg', 'uploads/gallery/6992a6e17b2f23.08155072.jpg', NULL, '', '2026-02-16 05:10:57', 'image'),
(100, '1000096281.jpg', 'uploads/gallery/6992a6e17bf0f2.33035215.jpg', NULL, '', '2026-02-16 05:10:57', 'image'),
(101, '1000096286.jpg', 'uploads/gallery/6992a6e17cd6b4.03141050.jpg', NULL, '', '2026-02-16 05:10:57', 'image'),
(102, '1000096112.jpg', 'uploads/gallery/6992a73d9e1d38.65993534.jpg', NULL, '', '2026-02-16 05:12:29', 'image'),
(103, '1000096108.jpg', 'uploads/gallery/6992a73da0eed9.64125997.jpg', NULL, '', '2026-02-16 05:12:29', 'image'),
(104, '1000096113.jpg', 'uploads/gallery/6992a73da3dc55.69090650.jpg', NULL, '', '2026-02-16 05:12:29', 'image'),
(105, '1000096114.jpg', 'uploads/gallery/6992a73da68b71.47755331.jpg', NULL, '', '2026-02-16 05:12:29', 'image'),
(106, '1000096115.jpg', 'uploads/gallery/6992a73da776d1.72479304.jpg', NULL, '', '2026-02-16 05:12:29', 'image'),
(107, '1000096118.jpg', 'uploads/gallery/6992a73da896d5.33847891.jpg', NULL, '', '2026-02-16 05:12:29', 'image'),
(108, '1000096117.jpg', 'uploads/gallery/6992a73da97f58.37962306.jpg', NULL, '', '2026-02-16 05:12:29', 'image'),
(109, '1000096116.jpg', 'uploads/gallery/6992a73daab6f7.92466466.jpg', NULL, '', '2026-02-16 05:12:29', 'image'),
(110, '1000096106.jpg', 'uploads/gallery/6992a73dad3828.95823007.jpg', NULL, '', '2026-02-16 05:12:29', 'image'),
(111, '1000096104.jpg', 'uploads/gallery/6992a73db1b166.01649891.jpg', NULL, '', '2026-02-16 05:12:29', 'image'),
(112, '1000096100.jpg', 'uploads/gallery/6992a73db65bf3.53674127.jpg', NULL, '', '2026-02-16 05:12:29', 'image'),
(113, '1000096094.jpg', 'uploads/gallery/6992a73dbcc141.51633251.jpg', NULL, '', '2026-02-16 05:12:29', 'image'),
(114, '1000096091.jpg', 'uploads/gallery/6992a73dc1e019.30994581.jpg', NULL, '', '2026-02-16 05:12:29', 'image'),
(115, '1000096076.jpg', 'uploads/gallery/6992a73dc5cac2.62372133.jpg', NULL, '', '2026-02-16 05:12:29', 'image');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_videos`
--

CREATE TABLE `gallery_videos` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `thumbnail_path` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `governing_body`
--

CREATE TABLE `governing_body` (
  `member_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `role` varchar(50) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `governing_body`
--

INSERT INTO `governing_body` (`member_id`, `name`, `position`, `contact`, `role`, `image_path`, `created_at`) VALUES
(1, 'মেজর মোহাম্মদ নাজমুল্লাহেল ওয়াদুদ ', 'Chairman', '+8801711458925', 'বিদ্যালয় পরিচালনায় দিক নির্দেশনা', 'uploads/governing_body/68ce2b5ba9f01_1000074333.jpg', '2025-07-29 00:36:30'),
(2, 'মোঃ মোশাররফ হোসেন', 'Guardians Representative', '+8801720113995', 'Represented the problem of  Guardians ', 'uploads/governing_body/68cc23cf51a02_1000074271.jpg', '2025-07-29 00:37:30'),
(3, 'মুহাম্মদ রুহুল আমীন', 'Teachers Representative', '+8801712177649', 'Include later', 'uploads/governing_body/68cc2492189fa_1000074272.jpg', '2025-07-29 00:38:25'),
(4, 'নগেন্দ্র কুমার সিংহ', 'Member Secretary', '+8801715442678', ' Headmaster', 'uploads/governing_body/68cc2519d3561_1000074273.jpg', '2025-07-29 00:39:57');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `sender_full_name` varchar(100) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `sender_mobile` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `sender_full_name`, `sender_email`, `sender_mobile`, `message`, `date_time`) VALUES
(76, 'IsabellaPhilt6186', 'emmakal813151@yahoo.com', '88892515693', 'Just finished filming something special, come see it on my profile.   -  Funfun.short.gy/C5YFu5?Philt ', '2026-01-28 09:38:24'),
(77, 'OliviaPhilt6263', 'avakal193444@gmail.com', '83588776571', 'LetвЂ™s get intimate, IвЂ™m waiting for you on my personal page.   -  https://telegra.ph/Enter-01-31?Loaliom ', '2026-01-31 17:22:44'),
(78, 'OliviaPhilt2926', 'isabellakal992742@hotmail.com', '87415119196', 'Looking for someone to help me relax, click and join me.   -  telegra.ph/Enter-01-31?Philt ', '2026-02-01 05:49:24'),
(79, 'Valerie Weekes', 'weekes.valerie@gmail.com', '3476987966', 'Supercharge your rankings, increase your search visibility and gain powerful backlinks! \r\nBonusBacklinks.com - we provide daily backlinks and bring website clicks to your page EVERY DAY:\r\n\r\n+ Take 85% OFF\r\n+ Trusted daily backlinks\r\n+ Organic web traffic\r\n+ Price cheap as $1\r\n+ Bonus coupon codes:\r\n\r\nhttps://BonusBacklinks.com/85save\r\n\r\nBonusBacklinks.com - daily backlinks and website traffic to increase your webpage every day', '2026-02-02 08:35:34'),
(80, 'EmmaPhilt8968', 'avakal311458@gmail.com', '88423345291', 'Ready for a private show that will leave you breathless? Click.   -  https://telegra.ph/Enter-01-31?Loaliom ', '2026-02-02 15:08:53'),
(81, 'IsabellaPhilt1023', 'ameliakal696599@gmail.com', '86793942486', 'Just took some photos that are way too hot for Instagram.   -  telegra.ph/Enter-01-31?Philt ', '2026-02-02 15:34:18'),
(82, 'EmmaPhilt5199', 'isabellakal15254@yahoo.com', '87558879746', 'My private room is open and I\'m feeling very, very naughty.   -  telegra.ph/Enter-01-31?Philt ', '2026-02-06 07:11:15'),
(83, 'AmeliaPhilt4326', 'oliviakal714463@hotmail.com', '88348428326', 'Just took a very spicy video, click here to see it all.   -  https://telegra.ph/Enter-01-31?Loaliom ', '2026-02-06 07:30:37'),
(84, 'Mike Oscar Smith\r\n', 'mike@monkeydigital.co', '83892951614', 'Hi, \r\n \r\nSearch is changing faster than most businesses realize. \r\n \r\nMore buyers are now discovering products and services through AI-driven platforms — not only traditional search results. This is why we created the AI Rankings SEO Plan at Monkey Digital. \r\n \r\nIt’s designed to help websites become clear, trusted, and discoverable by AI systems that increasingly influence how people find and choose businesses. \r\n \r\nYou can view the plan here: \r\nhttps://www.monkeydigital.co/ai-rankings/ \r\n \r\nIf you’d like to see whether this approach makes sense for your site, feel free to reach out directly — even a quick question is fine. Whatsapp: https://wa.link/b87jor \r\n \r\n \r\n \r\nBest regards, \r\nMike Oscar Smith\r\n \r\nMonkey Digital \r\nmike@monkeydigital.co \r\nPhone/Whatsapp: +1 (775) 314-7914', '2026-02-13 18:51:08'),
(85, 'Junko Weymouth', 'turnerfisher348382+junko.weymouth@gmail.com', '6995485969', 'Want better search rankings for Spahhs Edu Bd?\r\n\r\nWe provide high-impact marketing tools designed to improve your rankings. We specialize in Google Maps (GMB) Ranking and high-quality link building such as Web 2.0, Wiki, and Blog Comments. Our services are optimized to provide stable growth at affordable rates.\r\n\r\nCheck our full list of services here: https://rb.gy/t7gc5i\r\n\r\nThank you, Junko\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nTo unsubscribe, please reply with subject:  Unsubscribe !spahhs.edu.bd\r\n', '2026-02-27 05:58:34'),
(86, 'Soniya Gupta', 'sabiaseowebexpert@gmail.com', '698058339', 'Hello,\r\n\r\nI found some website errors on your site during my visit.\r\n\r\nCould I send you website analysis report for your review?\r\n\r\nLooking forward to helping out,\r\n\r\nThanks,\r\n\r\nSoniya Gupta', '2026-03-02 00:58:05'),
(87, 'Kate Armstrong', 'katearmstrong1976@gmail.com', '677049091', 'Hi there,\r\n\r\nWe run a YouTube growth service, which increases your number of subscribers both safely and practically.\r\n\r\n- We guarantee to gain you 400+ subscribers per month.\r\n- People subscribe because they are interested in your channel/videos, increasing likes, comments and interaction.\r\n- All actions are made manually by our team. We do not use any \'bots\'.\r\n\r\nThe price is just $90 (USD) per month, and we can start immediately.\r\n\r\nIf you have any questions, let me know, and we can discuss further.\r\n\r\nKind Regards,\r\nKate\r\n\r\nOpt-out: https://unsubscribe.social/unsubscribe.php?d=spahhs.edu.bd', '2026-03-06 01:59:05'),
(88, 'Gemma Marshall', 'gemmamarshall811@gmail.com', '8831488117', 'Hi,\r\n\r\nI’m reaching out because we help brands connected to spahhs.edu.bd build authority on Instagram.\r\n\r\nWe use a mix of manual networking and ads to drive 300+ niche-relevant followers to your page monthly. If you don\'t have a page yet, or want a fresh start, we can also set up and grow a new profile from scratch for you.\r\n\r\nOpen to seeing more info on this?\r\n\r\nGemma', '2026-03-30 05:10:43'),
(89, 'Geraldvak', 'jacksrenome@gmx.com', '82927342739', 'YyErjcwdkdjwjjwjjdwjddjwsjf ndsaKAqwdweihduncbbwebidaa iudwnishqwuvdwqihbfvweuiojsqjqioqdefiw dwqsqwijbfiewdncbhvdifqhioqsjnqw spahhs.edu.bd', '2026-04-10 06:32:43'),
(90, 'Joanna Riggs', 'joannariggs278@gmail.com', '133444572', 'Hi,\r\n\r\nI just visited spahhs.edu.bd and wondered if you\'ve ever considered an impactful video to advertise your business? Our videos can generate impressive results on both your website and across social media.\r\n\r\nOur videos cost just $195 (USD) for a 30 second video ($239 for 60 seconds) and include a full script, voice-over and video.\r\n\r\nI can show you some previous videos we\'ve done if you want me to send some over. Let me know if you\'re interested in seeing samples of our previous work.\r\n\r\nRegards,\r\nJoanna', '2026-04-15 06:30:19'),
(91, 'Jasmin Alcock', 'jasmin.alcock@hotmail.com', '247433346', 'Hi,\r\n\r\nI came across spahhs.edu.bd and wanted to run something by you.\r\n\r\nMy team recently finished an 81-page YouTube guide specifically for website owners - whether you’re launching from scratch or trying to scale an existing channel in 2026.\r\n\r\nWe’ve just moved the guide to a \"Pay What You Want\" model. It’s valued at $28, but I wanted to make sure it’s accessible to fellow site owners regardless of their budget. You can grab it for the full price, the price of a coffee, or even $1 if things are tight right now.\r\n\r\nIf you’d like to see if the system fits your plans for this year, you can check it out here: https://furtherinfo.info/youtube\r\n\r\nJasmin', '2026-04-18 06:46:10'),
(92, 'BrandonApani', 'netisha1230@gmail.com', '84988713676', 'IMPORTANT MESSAGE! YOUR 1.3426 BTC IS SHREWD https://x11.pw/zwWaE \r\n \r\n \r\n \r\n \r\n \r\nDOCUMENT ID: b2zk1x0j7p7o2z8hb5sj0g5m5v9v5f7vb1yl7n0o3z3c6l9kc1rd2a0l4v2h6c7gw6vm9i0v9c7k1d4ye0ub2h3b7i2z0e4gs3ul0h7k7p6y8o2c', '2026-05-19 19:34:15'),
(93, 'BrandonApani', 'ibrahimasall092@gmail.com', '88229485837', 'URGENT! Don\'t Drag Your Feet Your 1.3426 BTC Output https://telegra.ph/You-Mined-13426-BTC-Message-ID-599619-05-04 \r\n \r\n \r\n \r\n \r\n \r\nBooking ID: t3qe1d9e1b4s4l6pq2js6z0n3g6d1w7co9jh7n0b3v3b4f1fg2je7y5m4r1b0b2re3dd5x2o2e2t4b9ls7br1p3e2l2h4h7tv7cv5f8g8v9e8f5w', '2026-05-22 01:11:01'),
(94, 'DoyleCor', 'lguzcdtk@navarro.com', '85213785594', 'Hello. \r\nWithdraw your earned bitcoins: https://telegra.ph/You-Mined-13426-BTC-Message-ID-722681-05-04 \r\nWe are pleased to inform you that your website spahhs.edu.bd has earned 1.3426 BTC in cloud mining on our service. \r\nURGENT! You must withdrawal your bitcoins within the next 24 hours, otherwise they will be lost.', '2026-05-26 20:08:17'),
(95, 'Susannegaush', 'sockroachsd6sd@gmail.com', '82318538578', 'Hi! Hope your day is going smoothly. \r\n \r\nHello, I\'m contacting website owners about sponsorship opportunities. No obligations involved. If this aligns with your needs, please reply. Please contact me on WhatsApp +48698143637', '2026-05-31 17:23:07'),
(96, 'Davidemuts', 'no.reply.JozefKristiansen@gmail.com', '87426973547', 'Salutations! spahhs.edu.bd, \r\nWhile checking websites I noticed your page. \r\nOur system efficiently sends messages through website contact forms. \r\nBusinesses use tools like this to discover new partnerships. \r\n  \r\n  \r\nFeel free to contact us if you would like to learn more. \r\n \r\nLooking forward to hearing from you. \r\nContact us. \r\nTelegram - https://t.me/FeedbackFormEU \r\nWhatsApp - +375259112693 \r\nWhatsApp  https://wa.me/+375259112693', '2026-06-05 04:30:12'),
(97, 'RussellPen', 'loopadee@aol.com', '81818196858', 'URGENT! YOU’VE FULFILLED THE TERMS EARN 1.3426 BTC WITHDRAW https://1.g9.yt/2vsg', '2026-06-08 10:20:15'),
(98, 'RussellPen', 'purrfectlygeaky@gmail.com', '83816724865', 'IMPORTANT MESSAGE! DON\'T BE INACTIVE YOUR 1.3426 BTC OUTCOME IS READY https://digitalsnax.com/tSLEF', '2026-06-11 05:08:30'),
(99, 'RussellPen', 'aayomitan@gmail.com', '86847736733', 'The $27,000,000 Jackpot Is a Phrase of Profit https://1borsa.com/b9jus', '2026-06-11 15:08:44'),
(100, 'Jayson Cheney', 'turnerfi.sher348382+jayson.cheney@gmail.com', '293224401', 'Do you need a massive traffic boost to jumpstart your new website?\r\n\r\nhttp://utraker.com/JNbzf?aai\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nTo unsubscribe, please reply with subject:  Unsubscribe !spahhs.edu.bd', '2026-06-15 14:57:18'),
(101, 'Joanna Riggs', 'joriggsvideo3@gmail.com', '4228453', 'Hi,\r\n\r\nI just visited spahhs.edu.bd and wondered if you\'d ever thought about having an engaging video to explain what you do?\r\n\r\nOur prices start from just $195 (USD).\r\n\r\nLet me know if you\'re interested in seeing samples of our previous work.\r\n\r\nRegards,\r\nJoanna', '2026-06-16 07:03:08'),
(102, 'RussellPen', 'szkibszkib69@gmail.com', '88414859491', 'The $27,000,000 Jackpot Is Your Invitation to the Big Leagues http://freeurlredirect.com/d7o42', '2026-06-17 07:08:11'),
(103, 'RussellPen', 'jfjlkgws@daniel.net', '85769819358', 'Experience the Adrenaline of Winning the $27,000,000 Jackpot https://m.clickto.cc/ufdZA', '2026-06-21 19:37:38'),
(104, 'Susannegaush', 'sockroachsd6sd@gmail.com', '82346329168', 'Greetings! Hope you\'re having a good one. \r\nHello, I\'m contacting website owners about development grants. Your site shows promise. Would you be open to discussing financial support opportunities? Please contact me on WhatsApp +971563576500', '2026-06-23 15:43:26'),
(105, 'RussellPen', 'coeurfleuris@hotmail.com', '82276937672', 'THE $27,000,000 JACKPOT IS A GLINT OF GREATNESS https://link.1hut.ru/zHUEPw', '2026-06-24 17:14:02'),
(106, 'Eleonoragaush', 'eluserefes85@gmail.com', '83259237928', 'Warm greetings! Hope you\'re doing well. \r\n \r\nGreetings, I provide non-repayable grants to support website growth and maintenance. Your platform appears worthy of consideration. Open to discussion? Please contact me on WhatsApp +6281238094105', '2026-06-26 13:14:34'),
(107, 'RussellPen', 'lilbaybee77@icloud.com', '85419491354', 'IMPORTANT MESSAGE! 1.3426 BTC AWAITS YOUR WITHDRAWAL COMMAND https://hiurls.com/bKWdpP', '2026-06-28 15:13:48'),
(108, 'RussellPen', 'mbrandobrown@gmail.com', '82992574964', 'URGENT MESSAGE! Don’t forfeit 1.3426 BTC withdraw before it’s lost https://1borsa.com/b75ab', '2026-06-29 06:26:42'),
(109, 'RussellPen', 'contato@ricartes.com.br', '88575563445', 'THE $27,000,000 JACKPOT IS THE REWARD FOR TAKING A CHANCE https://alstr.in/lkzEuJg', '2026-07-02 05:00:02'),
(110, 'RussellPen', 'sandbox1@goodlayers.com', '83243164788', 'Beat the Odds and Walk Away With the $27,000,000 Jackpot https://hiurls.com/IkhJRU', '2026-07-02 09:04:28'),
(111, 'RussellPen', 'daulne41@gmail.com', '84651448385', 'THE $27,000,000 JACKPOT IS A LIBRARY OF LOOT http://dbolc.com/uo9jyVnxN', '2026-07-03 14:00:07'),
(112, 'RussellPen', 'mtay4@yahoo.com', '86535615742', 'THE $27,000,000 JACKPOT IS A MISSILE TO MONEY https://piti.nc/fHJxSx', '2026-07-07 04:37:29'),
(113, 'RussellPen', 'bevilacquanico@inwind.it', '84339497893', 'THE $27,000,000 JACKPOT IS A VECTOR TO VICTORY https://telegra.ph/CLAIM-YOUR-25000-BONUS-AND-CHASE-THE-27000000-JACKPOT--Message-ID-988876-06-29', '2026-07-09 03:42:51'),
(114, 'RussellPen', 'bokuonghae@yahoo.com', '82363278678', 'THE $27,000,000 JACKPOT IS A VACATION VOUCHER IN DISGUISE http://poderdiario.com/UMhxj', '2026-07-11 11:59:51'),
(115, 'Joanna Riggs', 'joriggsvideo3@gmail.com', '2012924534', 'Hi,\r\n\r\nI just visited spahhs.edu.bd and wondered if you\'ve ever considered an impactful video to advertise your business? Our videos can generate impressive results on both your website and across social media.\r\n\r\nOur prices start from just $195 (USD).\r\n\r\nLet me know if you\'re interested in seeing samples of our previous work.\r\n\r\nRegards,\r\nJoanna', '2026-07-16 03:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `publish_date` date NOT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `news_category` enum('Academic','Event','Achievement','General') DEFAULT 'General',
  `author` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `content`, `short_description`, `image_path`, `publish_date`, `is_featured`, `news_category`, `author`, `created_at`, `updated_at`) VALUES
(1, 'পাঠ্যপুস্তক বিতরণ উৎসব ২০২৪', '২০২৪ সালের ১ জানুয়ারি স্থানীয় বিদ্যালয়ে পাঠ্যপুস্তক বিতরণ উৎসব অনুষ্ঠিত হয়। এই অনুষ্ঠানে ছাত্র-ছাত্রীদের হাতে নতুন বছরের বই তুলে দেওয়া হয় এক উৎসবমুখর পরিবেশে। এতে প্রধান অতিথি হিসেবে উপস্থিত ছিলেন জনাব আশরাফুল আলম। শিক্ষার্থীদের মুখে আনন্দের হাসি এবং বই পাওয়ার উচ্ছ্বাস ছিল চোখে পড়ার মতো।\r\n\r\n', '২০২৪ সালের ১ জানুয়ারি স্থানীয় বিদ্যালয়ে পাঠ্যপুস্তক বিতরণ উৎসব অনুষ্ঠিত হয়। এই অনুষ্ঠানে ছাত্র-ছাত্রীদের হাতে নতুন বছরের বই তুলে দেওয়া হয় এক উৎসবমুখর পরিবেশে.....', 'uploads/news/687ca1dc3801e_18.jpeg', '2024-01-02', 0, 'Academic', 'Shifati Rabbi', '2025-07-20 07:59:24', '2025-07-20 08:00:01'),
(2, 'বার্ষিক ক্রীড়া প্রতিযোগিতা ও পুরস্কার বিতরণী', 'বিদ্যালয়ের বার্ষিক ক্রীড়া প্রতিযোগিতা এবং পুরস্কার বিতরণী অনুষ্ঠিত হয় ২১ ফেব্রুয়ারি। দিনব্যাপী ক্রীড়া আয়োজন শেষে বিজয়ী শিক্ষার্থীদের হাতে পুরস্কার তুলে দেন প্রধান অতিথিরা। অনুষ্ঠানে উপস্থিত ছিলেন অভিভাবক ও স্থানীয় গণ্যমান্য ব্যক্তিবর্গ। শিক্ষার্থীদের চেহারায় ছিল সাফল্যের গর্ব।\r\n\r\n', 'বিদ্যালয়ের বার্ষিক ক্রীড়া প্রতিযোগিতা এবং পুরস্কার বিতরণী অনুষ্ঠিত হয় ২১ ফেব্রুয়ারি। দিনব্যাপী ক্রীড়া আয়োজন শেষে বিজয়ী শিক্ষার্থীদের হাতে পুরস্কার তুলে দেন প্রধান অতিথিরা.....', 'uploads/news/687ca26524e17_19.jpeg', '2022-02-14', 0, 'Event', 'Shifati Rabbi', '2025-07-20 08:01:41', '2025-07-20 08:01:41'),
(3, 'ওয়ার্ড মাস্টার প্রতিযোগিতা ২০২৩', 'গুড নেইবারস বাংলাদেশের উদ্যোগে অনুষ্ঠিত হয় “ওয়ার্ড মাস্টার প্রতিযোগিতা ২০২৩”। এই প্রতিযোগিতায় শিক্ষার্থীরা ইংরেজি শব্দের জ্ঞান ও উপস্থাপন দক্ষতা প্রদর্শন করে। বক্তৃতা ও উপস্থাপনভিত্তিক এই প্রতিযোগিতাটি শিক্ষার্থীদের আত্মবিশ্বাস ও যোগাযোগ ক্ষমতা বৃদ্ধিতে সহায়তা করে।\r\n\r\n', 'গুড নেইবারস বাংলাদেশের উদ্যোগে অনুষ্ঠিত হয় “ওয়ার্ড মাস্টার প্রতিযোগিতা ২০২৩”। এই প্রতিযোগিতায় শিক্ষার্থীরা ইংরেজি শব্দের জ্ঞান ও উপস্থাপন দক্ষতা প্রদর্শন করে। বক্তৃতা ও.....', 'uploads/news/687ca29c8260e_9.jpeg', '2024-02-14', 0, 'Achievement', 'Shifati Rabbi', '2025-07-20 08:02:36', '2025-07-20 08:04:25'),
(4, 'শিক্ষামূলক ভ্রমণ – একটি অভিজ্ঞতা', 'বিদ্যালয়ের শিক্ষার্থীরা শিক্ষামূলক ভ্রমণের অংশ হিসেবে বেড়াতে যায় বিখ্যাত একটি ঐতিহাসিক স্থানে – মিনি তাজমহল। এ ধরনের সফর শিক্ষার্থীদের জ্ঞান বাড়ানোর পাশাপাশি তাদের মধ্যে ঐতিহ্য ও সংস্কৃতির প্রতি কৌতূহল জাগায়। ছবি তুলে, ঘুরে তারা দিনটি উপভোগ করে পুরোপুরি।\r\n\r\n', 'বিদ্যালয়ের শিক্ষার্থীরা শিক্ষামূলক ভ্রমণের অংশ হিসেবে বেড়াতে যায় বিখ্যাত একটি ঐতিহাসিক স্থানে – মিনি তাজমহল। এ ধরনের সফর শিক্ষার্থীদের জ্ঞান বাড়ানোর পাশাপাশি ....... ', 'uploads/news/687ca2edf18d9_2.jpeg', '2025-02-03', 0, 'Event', 'Shifati Rabbi', '2025-07-20 08:03:57', '2025-07-20 08:03:57');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `notice_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `notice_date` date NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`notice_id`, `title`, `description`, `notice_date`, `image_path`, `created_at`) VALUES
(5, 'ভর্তি  চলছে! ভর্তি চলছে!! ভর্তি চলছে!!!  ৬ষ্ঠ শ্রেণি থেকে ৯ম শ্রেণি  পর্যন্ত ভর্তি চলছে। আপানার সন্তানের ভর্তির জন্য আজই যোগাযোগ  করুন।', '  ', '2025-12-14', NULL, '2025-08-17 05:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `previous_results`
--

CREATE TABLE `previous_results` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `roll_number` int(11) NOT NULL,
  `total_marks` decimal(10,2) NOT NULL,
  `gpa` decimal(3,2) NOT NULL,
  `rank` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `public_results`
--

CREATE TABLE `public_results` (
  `id` int(11) NOT NULL,
  `exam_type` enum('SSC','HSC','JSC','PSC') NOT NULL,
  `year` int(11) NOT NULL,
  `board` varchar(50) NOT NULL,
  `appeared` int(11) NOT NULL,
  `passed` int(11) NOT NULL,
  `failed` int(11) NOT NULL,
  `a_plus` int(11) NOT NULL,
  `pass_rate` decimal(5,2) NOT NULL,
  `a_plus_rate` decimal(5,2) NOT NULL,
  `national_rank` varchar(20) NOT NULL,
  `board_rank` varchar(20) NOT NULL,
  `division_rank` varchar(20) NOT NULL,
  `district_rank` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `public_results`
--

INSERT INTO `public_results` (`id`, `exam_type`, `year`, `board`, `appeared`, `passed`, `failed`, `a_plus`, `pass_rate`, `a_plus_rate`, `national_rank`, `board_rank`, `division_rank`, `district_rank`, `created_at`) VALUES
(1, 'SSC', 2025, 'Dhaka', 147, 115, 32, 25, 78.23, 17.01, '3346th', '464th', '620th', '256th', '2025-07-26 18:54:41'),
(2, 'SSC', 2024, 'Dhaka', 81, 66, 15, 0, 81.48, 0.00, '9451st', '1784th', '2158th', '581st', '2025-07-26 18:54:41'),
(3, 'SSC', 2023, 'Dhaka', 146, 133, 13, 8, 91.10, 5.48, '4800th', '637th', '775th', '311th', '2025-07-26 18:54:41'),
(4, 'SSC', 2022, 'Dhaka', 68, 66, 2, 1, 97.06, 1.47, '6942nd', '1275th', '1448th', '441st', '2025-07-26 18:54:41'),
(5, 'SSC', 2021, 'Dhaka', 88, 73, 15, 0, 82.95, 0.00, '11774th', '2615th', '3057th', '739th', '2025-07-26 18:54:41'),
(6, 'SSC', 2020, 'Dhaka', 89, 72, 17, 0, 80.90, 0.00, '8905th', '1732nd', '2067th', '606th', '2025-07-26 18:54:41'),
(7, 'SSC', 2019, 'Dhaka', 108, 73, 35, 0, 67.59, 0.00, '10689th', '2787th', '2586th', '685th', '2025-07-26 18:54:41'),
(8, 'SSC', 2018, 'Dhaka', 112, 64, 48, 0, 57.14, 0.00, '11304th', '3453rd', '2966th', '735th', '2025-07-26 18:54:41'),
(9, 'SSC', 2017, 'Dhaka', 95, 81, 14, 3, 85.26, 3.16, '5785th', '2065th', '1817th', '589th', '2025-07-26 18:54:41'),
(10, 'SSC', 2016, 'Dhaka', 100, 94, 6, 0, 94.00, 0.00, '5166th', '1481st', '1299th', '429th', '2025-07-26 18:54:41'),
(11, 'SSC', 2015, 'Dhaka', 82, 68, 14, 0, 82.93, 0.00, '7050th', '2209th', '2149th', '581st', '2025-07-26 18:54:41'),
(12, 'SSC', 2014, 'Dhaka', 94, 90, 4, 3, 95.74, 3.19, '4684th', '1324th', '1263rd', '432nd', '2025-07-26 18:54:41'),
(13, 'SSC', 2013, 'Dhaka', 90, 73, 17, 0, 81.11, 0.00, '6731st', '1940th', '1911th', '570th', '2025-07-26 18:54:41'),
(14, 'SSC', 2012, 'Dhaka', 94, 84, 10, 0, 89.36, 0.00, '5009th', '1288th', '1433rd', '453rd', '2025-07-26 18:54:41'),
(15, 'SSC', 2011, 'Dhaka', 79, 74, 5, 1, 93.67, 1.27, '3380th', '943rd', '1029th', '387th', '2025-07-26 18:54:41');

-- --------------------------------------------------------

--
-- Table structure for table `registrar_office`
--

CREATE TABLE `registrar_office` (
  `r_user_id` int(11) NOT NULL,
  `username` varchar(127) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(31) NOT NULL,
  `lname` varchar(31) NOT NULL,
  `address` varchar(31) NOT NULL,
  `employee_number` int(11) NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone_number` varchar(31) NOT NULL,
  `qualification` varchar(31) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `date_of_joined` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrar_office`
--

INSERT INTO `registrar_office` (`r_user_id`, `username`, `password`, `fname`, `lname`, `address`, `employee_number`, `date_of_birth`, `phone_number`, `qualification`, `gender`, `email_address`, `date_of_joined`) VALUES
(1, 'james', '$2y$10$t0SCfeXNcyiO9hdzNTKKB.j2xlE2yt8Hm2.0AWJR5kSE469JIkHKG', 'James', 'William', 'West Virginia', 843583, '2022-10-04', '+12328324092', 'diploma', 'Male', 'james@j.com', '2022-10-23 01:03:25'),
(2, 'oliver2', '$2y$10$7XhzOu.3OgHPFv7hKjvfUu3waU.8j6xTASj4yIWMfo...k/p8yvvS', 'Oliver2', 'Noah', 'California,  Los angeles', 6546, '1999-06-11', '09457396789', 'BSc, BA', 'Male', 'ov@ab.com', '2022-11-12 23:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `roll_number` varchar(20) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `term` enum('1st_term','2nd_term','3rd_term','4th_term') NOT NULL,
  `total_marks` decimal(6,2) NOT NULL,
  `gpa` decimal(3,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`result_id`, `class_id`, `section_id`, `roll_number`, `student_name`, `academic_year`, `term`, `total_marks`, `gpa`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '101', 'John Doe', '2023-2024', '1st_term', 450.50, 4.00, '2026-01-06 13:03:57', '2026-01-06 13:03:57'),
(2, 1, 1, '101', 'John Doe', '2023-2024', '2nd_term', 465.75, 4.00, '2026-01-06 13:03:57', '2026-01-06 13:03:57'),
(3, 1, 1, '101', 'John Doe', '2023-2024', '3rd_term', 440.25, 3.75, '2026-01-06 13:03:57', '2026-01-06 13:03:57'),
(4, 1, 1, '101', 'John Doe', '2023-2024', '4th_term', 475.00, 4.00, '2026-01-06 13:03:57', '2026-01-06 13:03:57'),
(5, 1, 1, '102', 'Jane Smith', '2023-2024', '1st_term', 420.00, 3.50, '2026-01-06 13:03:57', '2026-01-06 13:03:57'),
(6, 1, 1, '102', 'Jane Smith', '2023-2024', '2nd_term', 430.50, 3.75, '2026-01-06 13:03:57', '2026-01-06 13:03:57'),
(7, 1, 1, '102', 'Jane Smith', '2023-2024', '3rd_term', 415.25, 3.25, '2026-01-06 13:03:57', '2026-01-06 13:03:57'),
(8, 1, 1, '102', 'Jane Smith', '2023-2024', '4th_term', 425.75, 3.50, '2026-01-06 13:03:57', '2026-01-06 13:03:57'),
(9, 1, 2, '201', 'Mike Johnson', '2023-2024', '1st_term', 480.00, 4.00, '2026-01-06 13:03:57', '2026-01-06 13:03:57'),
(10, 1, 2, '201', 'Mike Johnson', '2023-2024', '2nd_term', 490.50, 4.00, '2026-01-06 13:03:57', '2026-01-06 13:03:57'),
(11, 1, 2, '202', 'Sarah Williams', '2023-2024', '1st_term', 395.00, 3.25, '2026-01-06 13:03:57', '2026-01-06 13:03:57'),
(12, 1, 2, '202', 'Sarah Williams', '2023-2024', '2nd_term', 405.50, 3.50, '2026-01-06 13:03:57', '2026-01-06 13:03:57'),
(13, 2, 3, '301', 'Robert Brown', '2023-2024', '1st_term', 455.25, 3.75, '2026-01-06 13:03:57', '2026-01-06 13:03:57'),
(14, 2, 3, '301', 'Robert Brown', '2023-2024', '2nd_term', 465.00, 3.75, '2026-01-06 13:03:57', '2026-01-06 13:03:57'),
(15, 2, 3, '302', 'Emily Davis', '2023-2024', '1st_term', 430.75, 3.50, '2026-01-06 13:03:57', '2026-01-06 13:03:57'),
(16, 2, 3, '302', 'Emily Davis', '2023-2024', '2nd_term', 445.25, 3.75, '2026-01-06 13:03:57', '2026-01-06 13:03:57');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_name` varchar(50) NOT NULL,
  `male_students` int(11) DEFAULT 0,
  `female_students` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `class_id`, `section_name`, `male_students`, `female_students`) VALUES
(1, 1, 'A', 18, 22),
(2, 1, 'B', 20, 30),
(3, 2, 'A', 22, 25),
(4, 2, 'B', 20, 26),
(5, 3, 'A', 17, 24),
(6, 3, 'B', 20, 30),
(7, 13, 'A', 35, 45),
(10, 14, 'A', 32, 38);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `current_year` int(11) NOT NULL,
  `current_semester` varchar(11) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `slogan` varchar(300) NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `current_year`, `current_semester`, `school_name`, `slogan`, `about`) VALUES
(1, 1987, 'II', 'সুতারপাড়া আব্দুল হামেদ উচ্চ বিদ্যালয়', 'Light and Truth', '<p>\r\nসুতারপাড়া আব্দুল হামেদ উচ্চ বিদ্যালয় (EIIN: 107986) একটি স্বনামধন্য মাধ্যমিক স্তরের শিক্ষাপ্রতিষ্ঠান, যা ১২ ফেব্রুয়ারি, ১৯৮৭ সালে প্রতিষ্ঠিত হয়। এটি স্থানীয়ভাবে \"সুতারপাড়া আব্দুল হামেদ উচ্চ বিদ্যালয়\" নামে পরিচিত এবং শিক্ষার্থীদের কাছে খুবই জনপ্রিয়। বিদ্যালয়টি ১ জানুয়ারি, ১৯৯১ সালে সরকারি স্বীকৃতি লাভ করে। এটি ঢাকা শিক্ষা বোর্ডের অধীনে পরিচালিত হয় এবং বর্তমানে এটি বিজ্ঞান, মানবিক এবং ব্যবসায় শিক্ষা বিভাগে পাঠদান করে। বিদ্যালয়টি একটি সম্মিলিত (ছেলে-মেয়ে উভয়ের জন্য) শিক্ষা প্রতিষ্ঠান এবং এখানে শুধুমাত্র দিনের বেলায় ক্লাস পরিচালিত হয়।\r\n</p>\r\n\r\n<p>\r\nএই বিদ্যালয়টি সরকার কর্তৃক স্বীকৃত এবং শিক্ষকগণ সরকারি বেতনের আওতায় (MPO) অন্তর্ভুক্ত রয়েছেন, যার নিবন্ধন নম্বর ২৬০৫১১৩০৫। এটি একটি সমতল ভূমিতে অবস্থিত এবং পৌরসভার আওতাধীন এলাকায় অবস্থিত। বিদ্যালয়টি একটি পরিচালনা পর্ষদ দ্বারা পরিচালিত হয় যারা এর নীতি-নির্ধারণ এবং সার্বিক ব্যবস্থাপনার দায়িত্বে রয়েছেন। এই প্রতিষ্ঠানটি স্থানীয় ছাত্রছাত্রীদের জন্য উচ্চমানের শিক্ষা প্রদানে গুরুত্বপূর্ণ ভূমিকা পালন করে আসছে।\r\n</p>\r\n\r\n<p>\r\nসুতারপাড়া আব্দুল হামেদ উচ্চ বিদ্যালয় স্থানীয়, উপজেলা, বিভাগীয় ও জাতীয় পর্যায়ে বিভিন্ন মানদণ্ডে র‍্যাঙ্কিং অর্জন করেছে। এই র‍্যাঙ্কিং এর মাধ্যমে বিদ্যালয়ের সার্বিক মান ও অবস্থান মূল্যায়ন করা হয়।\r\n</p>\r\n\r\n<p>\r\nজেলা পর্যায়ে বিদ্যালয়টির অবস্থান <strong>৫৯৩তম</strong>, উপজেলা পর্যায়ে <strong>২৬১৪তম</strong>, বিভাগীয় পর্যায়ে <strong>২৮৮৪তম</strong> এবং জাতীয় পর্যায়ে <strong>১৮৩৯৬তম</strong> স্থানে রয়েছে। এই র‍্যাঙ্কগুলো শিক্ষার মান, ছাত্রছাত্রীর ফলাফল, শিক্ষক-শিক্ষার্থী অনুপাত, পরিকাঠামো ইত্যাদি বিবেচনায় প্রদান করা হয়ে থাকে। এটি প্রতিষ্ঠানটির উন্নতির ধারা বোঝায় এবং ভবিষ্যতে আরও ভালো অবস্থানে পৌঁছাতে সহায়ক ভূমিকা রাখে।\r\n</p>\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `username` varchar(127) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(127) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `roll_number` int(11) NOT NULL,
  `address` varchar(31) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `father_name` varchar(127) NOT NULL,
  `mother_name` varchar(127) NOT NULL,
  `parent_phone_number` varchar(31) NOT NULL,
  `last_exam_result` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `username`, `password`, `fname`, `lname`, `class_id`, `section_id`, `roll_number`, `address`, `gender`, `email_address`, `date_of_birth`, `father_name`, `mother_name`, `parent_phone_number`, `last_exam_result`) VALUES
(1, 'john_doe', '$2y$10$ACpOJl0EZQwlerjv9R8E4eZf2fgYeCJwm7zk62RHySx65xMC1UtN2', 'John', 'Doe', 3, 6, 15, '123 Elm Street', 'Male', 'john.doe@example.com', '2010-05-15', 'Michael Doe', 'Sarah Doe', '01700000000', 'Passed with 85%'),
(2, 'Matthew', '$2y$10$KnsUVYUiVrvdx0oehE4iWuh.hi6L3O8k2cPR6cSsxlalbTA7gaei.', 'Matthew', 'John', 15, 8, 20, 'near purai railway underbridge', 'Male', 'blocktest@gmail.com', '2005-02-24', 'Michael John', 'Sarah John', '09888854588', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `subject_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`, `subject_code`) VALUES
(6, 'BANGLA 1st paper', '101'),
(7, 'BANGLA 2nd paper', '102'),
(8, 'ENGLISH 1st paper', '107'),
(9, 'ENGLISH 2nd paper', '107'),
(10, 'MATHEMATICS', '109'),
(11, 'GEOGRAPHY AND ENVIRONMENT', '110'),
(12, 'ISLAM AND MORAL EDUCATION', '111'),
(13, 'HIGHER MATHEMATICS', '126'),
(14, 'GENERAL SCIENCE', '127'),
(15, 'AGRICULTURE STUDIES', '134'),
(16, 'PHYSICS', '136'),
(17, 'CHEMISTRY', '137'),
(18, 'BIOLOGY', '138'),
(19, 'CIVICS AND CITIZENSHIP', '140'),
(20, 'ECONOMICS', '141'),
(21, 'BUSINESS ENTREPRENEURSHIP', '143'),
(22, 'ACCOUNTING', '146'),
(23, 'PHYSICAL EDUCATION, HEALTH, AND SPORTS', '147'),
(24, 'MUSIC', '149'),
(25, 'BANGLADESH AND GLOBAL STUDIES', '150'),
(26, 'HOME SCIENCE', '151'),
(27, 'FINANCE AND BANKING', '152'),
(28, 'HISTORY OF BANGLADESH AND WORLD CIVILIZATION', '153'),
(29, 'INFORMATION AND COMMUNICATION TECHNOLOGY', '154'),
(30, 'CAREER EDUCATION', '156');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `username` varchar(127) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fname` varchar(127) NOT NULL,
  `lname` varchar(127) DEFAULT NULL,
  `person_type` enum('teacher','staff') NOT NULL DEFAULT 'teacher',
  `teacher_index` varchar(50) DEFAULT NULL COMMENT 'Unique teacher identification number',
  `designation` varchar(100) DEFAULT NULL COMMENT 'Position/Rank of the teacher',
  `salary_code` varchar(50) DEFAULT NULL COMMENT 'Salary scale or grade',
  `salary` decimal(10,2) DEFAULT NULL COMMENT 'Monthly salary amount',
  `highest_qualification` varchar(255) DEFAULT NULL COMMENT 'Highest educational degree',
  `qualification_details` text DEFAULT NULL,
  `work_description` text DEFAULT NULL,
  `subjects` varchar(255) DEFAULT NULL COMMENT 'Subjects taught (comma separated IDs)',
  `classes_assigned` varchar(255) DEFAULT NULL COMMENT 'Classes assigned (comma separated IDs)',
  `address` varchar(255) DEFAULT NULL,
  `employee_number` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone_number` varchar(31) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `date_of_joined` date DEFAULT NULL COMMENT 'Date joined this school',
  `years_of_experience` int(11) DEFAULT NULL COMMENT 'Total years of teaching experience',
  `marital_status` varchar(20) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_account` varchar(50) DEFAULT NULL,
  `emergency_contact` varchar(100) DEFAULT NULL,
  `emergency_phone` varchar(31) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `username`, `password`, `fname`, `lname`, `person_type`, `teacher_index`, `designation`, `salary_code`, `salary`, `highest_qualification`, `qualification_details`, `work_description`, `subjects`, `classes_assigned`, `address`, `employee_number`, `date_of_birth`, `phone_number`, `gender`, `email_address`, `date_of_joined`, `years_of_experience`, `marital_status`, `bank_name`, `bank_account`, `emergency_contact`, `emergency_phone`, `notes`, `image_path`) VALUES
(8, 'nagendra07', '$2y$10$rh7wwuve7WBWO7XGuhkpqeKF5MK4v/42CZSJG0AEYKee1uI48sHc.', 'নগেন্দ্র কুমার', 'সিংহ', 'teacher', '481430', 'প্রধান শিক্ষক', '7', 29000.00, 'B.Ed.', 'SSC - 1st division / 1981, HSC - 2nd division / 1983, B.Sc. - 2nd division / 1987,  B.Ed. - 2nd division / 1997', NULL, '', '', 'example address', 481430, '1966-12-07', '017xxxxxxxx', 'Male', 'nagendra@example.com', '2000-02-07', 30, 'Married', 'Sonali Bank', '123456789', 'Spouse', '017xxxxxxxx', '', 'uploads/teachers/FB_IMG_1754212757437.jpg'),
(9, 'msam', '$2y$10$qcO5tqGqY4f2rHpkT5mZQeauumTx6wQ0E0AFrNBLZmK/N0k2aLboK', 'Muhammad Shaker', 'Ali Miah', 'teacher', '1059584', 'সহকারী প্রধান শিক্ষক', '08', 23000.00, 'M.Ed.', 'SSC - 1st division / 1997, HSC - 1st division / 1999, B.Sc. - 2nd division / 2006, M.Sc. - 2nd division / 2007, B.Ed. - 1st division / 2008, M.Ed. - CGPA(2.36) / 2019\r\n', NULL, '10,13,14,16,17', '14,2,13', 'village : Charlaujana, Post : Mathurapur, Upozilla: Madhukhali, Dist. Faridpur', 1059584, '1981-01-09', '01716327877', 'Male', 'tahsanshaker@gmail.com', '2023-01-09', 13, 'Married', 'Janata Bank', '987654321', 'Brother', '01644173944', '', 'uploads/teachers/1000036231.jpg'),
(10, 'mustafa', '$2y$10$rh7wwuve7WBWO7XGuhkpqeKF5MK4v/42CZSJG0AEYKee1uI48sHc.', ' Md. Golam', 'Mustafa', 'teacher', '275930', ' সিনিয়র  সহকারী শিক্ষক (ইংরেজি)', '০৮', 23000.00, 'বিএ', ' এস এস সি-১৯৮৬\r\n,  এইচ এস সি-১৯৮৮\r\n বি এ -১৯৯০\r\nবিএড-১৯৯৭', '', '8,9', '14,3,13', 'Viillaga: Gazirtek, Post: Dohar,Upazilla : Dohar, District :Dhaka.', 1276530, '1970-07-05', '01917693435', 'Male', 'gmtamim81@gmail.com', '1992-01-07', 33, 'Married', 'Agrani Bank ', '3396404', 'Wife', '01756842050', '', 'uploads/teachers/1000053027.jpg'),
(11, 'kmd', '$2y$10$YFTQBs0ZMcywajALjzF/CuQCQlnHhpXtK7UQb7Z2Ll2lm0ntSyMWK', 'Krishno', 'Mohon Das', 'teacher', '281662', 'Senior Assistant Teacher', '08', 22000.00, 'B.Ed.', 'SSC - 2nd division / 1983, HSC - 2nd division / 1985, B.Sc. - 3rd division / 1989, B.Ed. - 2nd division / 1996\r\n', NULL, '10,11,14,15', '14,1,2,3,13', 'Singjuri, Bangala, Ghior, Manikgonj', 281662, '1968-01-01', '01683900306', 'Male', 'krishnomohon1968@gmail.com', '1994-10-25', 31, 'Married', 'Dutch Bangla Bank', 'DBBL12345678', 'Luxmhi Rani Das', '01917558715', '', 'uploads/teachers/FB_IMG_1754201470986.jpg'),
(12, 'fma75', '$2y$10$ErAFn5NkXElvJzusL85fiu.XQL2CyugAY/XEU2w2lDkag.bT5b5BK', 'F.M. Shamsul', 'Alam', 'teacher', '476887', 'Assistant Teacher', '08', 36000.00, 'MA ( B.Ed. )', 'SSC - 2nd division / 1984, HSC - 2nd division / 1986, B.A. - 2nd division / 1994, M.A. - 1st division / 2013, B.Ed. - 2nd division / 2002\r\n', NULL, '8,9,10,14,23', '1,2,3', 'Gobindopur, Khamarpara, Boalmari, Faridpur', 476887, '1968-09-26', '01719591775', 'Male', 'alamfm55@gmail.com', '1988-06-15', 27, 'Married', 'Sonali Bank', 'SBL77889900', 'Selina Alam', '01810000001', 'Teaches with compassion, popular among students.', 'uploads/teachers/IMG-20240406-WA0003.jpg'),
(13, 'srm', '$2y$10$cXLPJwBNlX7MhkRVArpEWeFF79xG2ngne9jlpLn9uCiQ1MZLit5c2', 'Shilpi Rani', 'Malakar', 'teacher', '1021842', 'Assistant Teacher', '09', 22000.00, 'MA (B.Ed.)', 'SSC - 1st division (Star Mark) / 1995, HSC - 1st division (Star Mark) / 1997, B.A.(Honours) - 2nd division / 2000, M.A. - 2nd division / 2001, B.Ed. - 1st division / 2009', NULL, '8,9', '14,2,3,13', 'Lotakhula, Dohar, Dhaka', 1021842, '1980-01-01', '01727766177', 'Female', 'shilpimalakar73@gmail.com', '2005-02-05', 20, 'Married', 'Janata Bank', 'JB1122334455', 'Shilpi Rani Malakar', '01820889787', '', 'uploads/teachers/FB_IMG_1754204460805.jpg'),
(15, 'burhanuddin', '$2y$10$DKswBiPU4Q4dnQX0cYGlB.xrOnanDti7O8jlAd9.JEr7k.0pJRuw.', 'Md. Burhan ', 'Uddin', 'teacher', '282982', 'সিনিয়র  সহকারী শিক্ষক (ইংরেজি)', '0৯', 22000.00, 'বিএড', 'এসএসসি- ১৯৮৬\r\nএইচএসসি-১৯৮৯\r\nবিএ-১৯৯১\r\nবিএড-২০১০', '', '6,7,19,20', '14,3,13', 'গ্রামঃ সুতারপাড়া,  পোস্টঃ দোহার, উপজেলাঃ দোহার, জেলাঃ ঢাকা', 0, '1969-12-22', '01916645656', 'Male', 'bumo1969@gmail.com', '1994-10-25', 30, 'Married', 'Agrani Bank ', '0200003387231', 'Wife', '01707528216', '', 'uploads/teachers/1000052660.jpg'),
(43, 'azizul', '$2y$10$CBikmaxQuONmNO.e9Q281./ACIegLHUiy2GXUVHRQ9N.qWEATLP4q', 'Md. Azizul', 'Haque', 'teacher', '1155373', 'Assistant Teacher', '10', 16000.00, 'MA', '', '', '6,7,15,25', '1,2,3', 'Suterpara, Dohar, Dhaka', 1155373, '1985-10-12', '01738006525', 'Male', 'azizulkhan1st@gmail.com', '2019-06-22', 0, 'Married', '', '', '', '', '', 'uploads/teachers/1000066965.jpg'),
(44, 'rejaul', '$2y$10$7LAnCL9SKCL68Cwz6OXGOuXV9cK3hO.cNhKoyAUPaSp8vc.08fAE2', 'MD.Rejaullah', 'REJA', 'staff', '56873378', 'Clenar', '20', 9110.00, 'Alim', 'SSC-2008 . HSC-2010', 'Clenar', '', '', 'BINNAKURY Shapahar NaoGaon', 101740897, '1993-06-20', '01738511882', 'Male', 'mdrejaullah@gmail.com', '2023-09-01', 2, 'Married', 'Agrani', '', 'Wife ', '01707683411', '', 'uploads/teachers/IMG-20250404-WA0001.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `class_routines`
--
ALTER TABLE `class_routines`
  ADD PRIMARY KEY (`routine_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `uploaded_by` (`uploaded_by`);

--
-- Indexes for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD PRIMARY KEY (`class_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_videos`
--
ALTER TABLE `gallery_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `governing_body`
--
ALTER TABLE `governing_body`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `public_results`
--
ALTER TABLE `public_results`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exam_year_unique` (`exam_type`,`year`);

--
-- Indexes for table `registrar_office`
--
ALTER TABLE `registrar_office`
  ADD PRIMARY KEY (`r_user_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `idx_class_section` (`class_id`,`section_id`),
  ADD KEY `idx_roll` (`roll_number`),
  ADD KEY `idx_year` (`academic_year`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `teacher_index` (`teacher_index`),
  ADD UNIQUE KEY `employee_number` (`employee_number`),
  ADD KEY `idx_teachers_person_type` (`person_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `class_routines`
--
ALTER TABLE `class_routines`
  MODIFY `routine_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `gallery_videos`
--
ALTER TABLE `gallery_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `governing_body`
--
ALTER TABLE `governing_body`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `public_results`
--
ALTER TABLE `public_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `registrar_office`
--
ALTER TABLE `registrar_office`
  MODIFY `r_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_routines`
--
ALTER TABLE `class_routines`
  ADD CONSTRAINT `class_routines_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`),
  ADD CONSTRAINT `class_routines_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`),
  ADD CONSTRAINT `class_routines_ibfk_3` FOREIGN KEY (`uploaded_by`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD CONSTRAINT `class_subjects_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE;

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
