-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2023 at 02:16 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms_db`
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
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `sender_full_name` varchar(100) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `sender_full_name`, `sender_email`, `message`, `date_time`) VALUES
(1, 'John doe', 'es@gmail.com', 'Hello, world', '2023-02-17 23:39:15'),
(2, 'John doe', 'es@gmail.com', 'Hi', '2023-02-17 23:49:19'),
(3, 'John doe', 'es@gmail.com', 'Hey, ', '2023-02-17 23:49:36');

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
(1, 2023, 'II', 'Y School', 'Lux et Veritas Light and Truth', 'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.');

-- --------------------------------------------------------
-- Table structure for table `students`
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

-- Table structure for table `previous_results`
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
-- Table structure for table `class`
CREATE TABLE `class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(50) NOT NULL,
  `discipline` enum('Science','Humanities','Business Studies','None') NOT NULL DEFAULT 'None',
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for table `section`
CREATE TABLE `section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `section_name` varchar(50) NOT NULL,
  `male_students` int(11) DEFAULT 0,
  `female_students` int(11) DEFAULT 0,
  PRIMARY KEY (`section_id`),
  FOREIGN KEY (`class_id`) REFERENCES `class`(`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for table `class_routines`

CREATE TABLE `class_routines` (
  `routine_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `routine_image` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `uploaded_by` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`routine_id`),
  FOREIGN KEY (`class_id`) REFERENCES `class`(`class_id`),
  FOREIGN KEY (`section_id`) REFERENCES `section`(`section_id`),
  FOREIGN KEY (`uploaded_by`) REFERENCES `admin`(`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Table structure for table `subjects`
CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(100) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Junction table for class-subject relationship
CREATE TABLE `class_subjects` (
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`class_id`, `subject_id`),
  FOREIGN KEY (`class_id`) REFERENCES `class`(`class_id`),
  FOREIGN KEY (`subject_id`) REFERENCES `subjects`(`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `username` varchar(127) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(127) NOT NULL,
  `lname` varchar(127) NOT NULL,
  `teacher_index` varchar(50) NOT NULL COMMENT 'Unique teacher identification number',
  `designation` varchar(100) NOT NULL COMMENT 'Position/Rank of the teacher',
  `salary_code` varchar(50) NOT NULL COMMENT 'Salary scale or grade',
  `salary` decimal(10,2) NOT NULL COMMENT 'Monthly salary amount',
  `highest_qualification` varchar(255) NOT NULL COMMENT 'Highest educational degree',
  `qualification_details` text DEFAULT NULL COMMENT 'Details of all qualifications',
  `subjects` varchar(255) NOT NULL COMMENT 'Subjects taught (comma separated IDs)',
  `classes_assigned` varchar(255) DEFAULT NULL COMMENT 'Classes -> section assigned (comma separated IDs)',
  `address` varchar(255) NOT NULL,
  `employee_number` int(11) NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone_number` varchar(31) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `date_of_joined` date NOT NULL COMMENT 'Date joined this school',
  `years_of_experience` int(11) DEFAULT NULL COMMENT 'Total years of teaching experience',
  `marital_status` varchar(20) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_account` varchar(50) DEFAULT NULL,
  `emergency_contact` varchar(100) DEFAULT NULL,
  `emergency_phone` varchar(31) DEFAULT NULL,
  `notes` text DEFAULT NULL COMMENT 'Additional notes or comments'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 
--

-- Gallery Images Table
CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `file_type` enum('image','video') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Gallery Videos Table (or you can combine with images using file_type)
CREATE TABLE `gallery_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `thumbnail_path` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Create results table
CREATE TABLE `public_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_type` enum('SSC','HSC','JSC','PSC') NOT NULL,
  `year` int(4) NOT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `exam_year_unique` (`exam_type`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data (SSC results from your example)
INSERT INTO `public_results` 
(`exam_type`, `year`, `board`, `appeared`, `passed`, `failed`, `a_plus`, `pass_rate`, `a_plus_rate`, `national_rank`, `board_rank`, `division_rank`, `district_rank`) VALUES
('SSC', 2025, 'Dhaka', 147, 115, 32, 25, 78.23, 17.01, '3346th', '464th', '620th', '256th'),
('SSC', 2024, 'Dhaka', 81, 66, 15, 0, 81.48, 0.00, '9451st', '1784th', '2158th', '581st'),
('SSC', 2023, 'Dhaka', 146, 133, 13, 8, 91.10, 5.48, '4800th', '637th', '775th', '311th'),
('SSC', 2022, 'Dhaka', 68, 66, 2, 1, 97.06, 1.47, '6942nd', '1275th', '1448th', '441st'),
('SSC', 2021, 'Dhaka', 88, 73, 15, 0, 82.95, 0.00, '11774th', '2615th', '3057th', '739th'),
('SSC', 2020, 'Dhaka', 89, 72, 17, 0, 80.90, 0.00, '8905th', '1732nd', '2067th', '606th'),
('SSC', 2019, 'Dhaka', 108, 73, 35, 0, 67.59, 0.00, '10689th', '2787th', '2586th', '685th'),
('SSC', 2018, 'Dhaka', 112, 64, 48, 0, 57.14, 0.00, '11304th', '3453rd', '2966th', '735th'),
('SSC', 2017, 'Dhaka', 95, 81, 14, 3, 85.26, 3.16, '5785th', '2065th', '1817th', '589th'),
('SSC', 2016, 'Dhaka', 100, 94, 6, 0, 94.00, 0.00, '5166th', '1481st', '1299th', '429th'),
('SSC', 2015, 'Dhaka', 82, 68, 14, 0, 82.93, 0.00, '7050th', '2209th', '2149th', '581st'),
('SSC', 2014, 'Dhaka', 94, 90, 4, 3, 95.74, 3.19, '4684th', '1324th', '1263rd', '432nd'),
('SSC', 2013, 'Dhaka', 90, 73, 17, 0, 81.11, 0.00, '6731st', '1940th', '1911th', '570th'),
('SSC', 2012, 'Dhaka', 94, 84, 10, 0, 89.36, 0.00, '5009th', '1288th', '1433rd', '453rd'),
('SSC', 2011, 'Dhaka', 79, 74, 5, 1, 93.67, 1.27, '3380th', '943rd', '1029th', '387th');


--
--  for table `notices`
--

CREATE TABLE notices (
    notice_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    notice_date DATE NOT NULL,
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
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
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `registrar_office`
--
ALTER TABLE `registrar_office`
  ADD PRIMARY KEY (`r_user_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `username` (`username`);


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
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registrar_office`
--
ALTER TABLE `registrar_office`
  MODIFY `r_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_score`
--
ALTER TABLE `student_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;