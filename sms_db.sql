-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 12, 2025 at 01:54 PM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u773621413_spahhs`
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
(1, 'elias', '$2y$10$H7obJEdmLzqqcPy7wQWhsOLUvrgzC8f1Y1or2Gxaza5z1PT0tvLy6', 'Elias', 'Abdurrahman');

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
(24, '2.mp4', 'uploads/gallery/688537e69d8518.79430647.mp4', 'uploads/gallery/688537e69e0011.95744111_thumb.jpg', 'school', '2025-07-26 20:17:42', 'video'),
(25, '3.mp4', 'uploads/gallery/688538074dcb71.68923780.mp4', 'uploads/gallery/688538074e0e42.87669239_thumb.jpg', 'group study', '2025-07-26 20:18:15', 'video');

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
(1, 'KANIK CHANDRA SHARMA', 'Chairman', '+8801701067677', 'Include Later', 'uploads/governing_body/6888178e2cebd_12.jpeg', '2025-07-29 00:36:30'),
(2, 'GONESH SUTRADHAR', 'Member', '+8801720113995', 'Include later', 'uploads/governing_body/688817ca36dbd_13.jpeg', '2025-07-29 00:37:30'),
(3, 'MD. ABDUL KADIR', 'Member', '+8801712177649', 'Include later', 'uploads/governing_body/688818017ab1f_14.jpg', '2025-07-29 00:38:25'),
(4, 'MD. HARUNUR RASHID TALUKDER', 'Others Member', '+8801715442678', 'Later', 'uploads/governing_body/6888185d0908c_15.jpeg', '2025-07-29 00:39:57');

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
(1, 'John doe', 'es@gmail.com', NULL, 'Hello, world', '2023-02-17 23:39:15'),
(2, 'John doe', 'es@gmail.com', NULL, 'Hi', '2023-02-17 23:49:19'),
(3, 'John doe', 'es@gmail.com', NULL, 'Hey, ', '2023-02-17 23:49:36'),
(4, 'Shifati Rabbi', 'rabbishifati@gmail.com', '01571501416', 'Hello, it is a test feedback message', '2025-07-19 18:25:39');

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
(1, 'অর্ধবার্ষিক পরীক্ষার সময়সূচী পরিবর্তন', 'অর্ধবার্ষিক পরীক্ষার সময়সূচী পরিবর্তন', '2025-07-28', 'uploads/notices/68880f9b0b27c_68.jpg', '2025-07-29 00:02:35'),
(2, 'অর্ধ বার্ষিক পরীক্ষা সংক্রান্ত নোটিশ', 'অর্ধ বার্ষিক পরীক্ষা সংক্রান্ত নোটিশ', '2025-07-29', 'uploads/notices/68880f9b0b27c_68.jpg', '2025-07-29 00:03:05'),
(3, '5 August উদযাপন', 'New independence', '2025-07-29', 'uploads/notices/68880f9b0b27c_68.jpg', '2025-07-29 00:03:59');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `teacher_index` varchar(50) DEFAULT NULL COMMENT 'Unique teacher identification number',
  `designation` varchar(100) DEFAULT NULL COMMENT 'Position/Rank of the teacher',
  `salary_code` varchar(50) DEFAULT NULL COMMENT 'Salary scale or grade',
  `salary` decimal(10,2) DEFAULT NULL COMMENT 'Monthly salary amount',
  `highest_qualification` varchar(255) DEFAULT NULL COMMENT 'Highest educational degree',
  `qualification_details` text DEFAULT NULL,
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

INSERT INTO `teachers` (`teacher_id`, `username`, `password`, `fname`, `lname`, `teacher_index`, `designation`, `salary_code`, `salary`, `highest_qualification`, `qualification_details`, `subjects`, `classes_assigned`, `address`, `employee_number`, `date_of_birth`, `phone_number`, `gender`, `email_address`, `date_of_joined`, `years_of_experience`, `marital_status`, `bank_name`, `bank_account`, `emergency_contact`, `emergency_phone`, `notes`, `image_path`) VALUES
(8, 'nagendra07', '$2y$10$rh7wwuve7WBWO7XGuhkpqeKF5MK4v/42CZSJG0AEYKee1uI48sHc.', 'নগেন্দ্র কুমার', 'সিংহ', '481430', 'প্রধান শিক্ষক', '7', 29000.00, 'B.Ed.', 'SSC - 1st division / 1981, HSC - 2nd division / 1983, B.Sc. - 2nd division / 1987,  B.Ed. - 2nd division / 1997', '', '', 'example address', 481430, '1966-12-07', '017xxxxxxxx', 'Male', 'nagendra@example.com', '2000-02-07', 30, 'Married', 'Sonali Bank', '123456789', 'Spouse', '017xxxxxxxx', '', 'uploads/teachers/FB_IMG_1754212757437.jpg'),
(9, 'msam', '$2y$10$qcO5tqGqY4f2rHpkT5mZQeauumTx6wQ0E0AFrNBLZmK/N0k2aLboK', 'Mohammed Saker', 'Ali Miah', '1059584', 'সহ প্রধান শিক্ষক', '08', 23000.00, 'M.Ed.', 'SSC - 1st division / 1997, HSC - 1st division / 1999, B.Sc. - 2nd division / 2006, M.Sc. - 2nd division / 2007, B.Ed. - 1st division / 2008, M.Ed. - CGPA(2.36) / 2019\r\n', '13,14,16', '14,13', 'example address', 1059584, '1981-01-09', '01716327877', 'Male', 'msam@example.com', '2023-01-09', 18, 'Married', 'Janata Bank', '987654321', 'Brother', '01644173944', '', 'uploads/teachers/shaker-ali.jpg'),
(10, 'giasuddin', '$2y$10$rh7wwuve7WBWO7XGuhkpqeKF5MK4v/42CZSJG0AEYKee1uI48sHc.', 'মোঃ গোলাম', 'মোয়াজ্জেম', '38', 'সহকারী শিক্ষক (ইংরেজি)', '52000', 52000.00, 'এস এস সি', '১৯৮৮ এ এস এস সি, ১৯৯০ এ এইচ এস সি, ১৯৯৩ এ বি এ (অনার্স)', '', NULL, 'example address', 1276530, '1968-03-01', '017xxxxxxxx', 'Male', 'gias@example.com', '1993-03-01', 25, 'Married', 'Sonali Bank', '123456780', 'Wife', '017xxxxxxxx', NULL, NULL),
(11, 'kmd', '$2y$10$YFTQBs0ZMcywajALjzF/CuQCQlnHhpXtK7UQb7Z2Ll2lm0ntSyMWK', 'Krishno', 'Mohon Das', '281662', 'Senior Assistant Teacher', '08', 22000.00, 'B.Ed.', 'SSC - 2nd division / 1983, HSC - 2nd division / 1985, B.Sc. - 3rd division / 1989, B.Ed. - 2nd division / 1996\r\n', '10,11,14,15', '14,1,2,3,13', 'Singjuri, Bangala, Ghior, Manikgang', 281662, '1968-01-01', '01683900306', 'Male', 'krishnomohon1968@gmail.com', '1994-10-25', 31, 'Married', 'Dutch Bangla Bank', 'DBBL12345678', 'Luxmhi Rani Das', '01917558715', '', 'uploads/teachers/FB_IMG_1754201470986.jpg'),
(12, 'fma75', '$2y$10$ErAFn5NkXElvJzusL85fiu.XQL2CyugAY/XEU2w2lDkag.bT5b5BK', 'F.M. Shamsul', 'Alam', '476887', 'Assistant Teacher', '08', 36000.00, 'MA ( B.Ed. )', 'SSC - 2nd division / 1984, HSC - 2nd division / 1986, B.A. - 2nd division / 1994, M.A. - 1st division / 2013, B.Ed. - 2nd division / 2002\r\n', '8,9,10,14,23', '1,2,3', 'Gobindopur, Khamarpara, Boalmari, Faridpur', 476887, '1968-09-26', '01719591775', 'Male', 'alamfm55@gmail.com', '1988-06-15', 27, 'Married', 'Sonali Bank', 'SBL77889900', 'Selina Alam', '01810000001', 'Teaches with compassion, popular among students.', 'uploads/teachers/IMG-20240406-WA0003.jpg'),
(13, 'srm', '$2y$10$cXLPJwBNlX7MhkRVArpEWeFF79xG2ngne9jlpLn9uCiQ1MZLit5c2', 'Shilpi Rani', 'Malakar', '1021842', 'Assistant Teacher', '09', 22000.00, 'MA (B.Ed.)', 'SSC - 1st division (Star Mark) / 1995, HSC - 1st division (Star Mark) / 1997, B.A.(Honours) - 2nd division / 2000, M.A. - 2nd division / 2001, B.Ed. - 1st division / 2009', '8,9', '14,2,3,13', 'Lotakhula, Dohar, Dhaka', 1021842, '1980-01-01', '01727766177', 'Female', 'shilpimalakar73@gmail.com', '2005-02-05', 20, 'Married', 'Janata Bank', 'JB1122334455', 'Shilpi Rani Malakar', '01820889787', '', 'uploads/teachers/FB_IMG_1754204460805.jpg');

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
  ADD UNIQUE KEY `employee_number` (`employee_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `gallery_videos`
--
ALTER TABLE `gallery_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `governing_body`
--
ALTER TABLE `governing_body`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
