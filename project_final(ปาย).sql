-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2025 at 08:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `amount_of_money`
--

CREATE TABLE `amount_of_money` (
  `contract_id` int(11) NOT NULL,
  `academic_year` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `board`
--

CREATE TABLE `board` (
  `faculty_id` int(11) NOT NULL,
  `faculty_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collegian`
--

CREATE TABLE `collegian` (
  `student_id` varchar(13) NOT NULL,
  `student_code` int(11) NOT NULL,
  `password` varchar(255) NOT NULL COMMENT 'รหัสผ่าน',
  `f_name` varchar(255) NOT NULL COMMENT 'ชื่อ',
  `l_name` varchar(255) NOT NULL COMMENT 'นามสกุล',
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_image` longtext DEFAULT NULL,
  `spouse_id` varchar(13) DEFAULT NULL,
  `father_id` varchar(13) DEFAULT NULL,
  `mother_id` varchar(13) DEFAULT NULL,
  `guardian_id` varchar(13) DEFAULT NULL,
  `endorser_id` varchar(13) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `family_status_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collegian`
--

INSERT INTO `collegian` (`student_id`, `student_code`, `password`, `f_name`, `l_name`, `address`, `phone_number`, `email`, `profile_image`, `spouse_id`, `father_id`, `mother_id`, `guardian_id`, `endorser_id`, `department_id`, `family_status_id`) VALUES
('1234567890123', 1234567890, '', 'test', 'test', 'test', '1234567890', 'test@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `faculty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `endorsee`
--

CREATE TABLE `endorsee` (
  `endorser_id` varchar(13) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `family_status`
--

CREATE TABLE `family_status` (
  `family_status_id` varchar(255) NOT NULL,
  `status_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `father`
--

CREATE TABLE `father` (
  `father_id` varchar(13) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `income` decimal(10,2) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `education_level` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guardian`
--

CREATE TABLE `guardian` (
  `guardian_id` varchar(13) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `income` decimal(10,2) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `education_level` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_contract`
--

CREATE TABLE `loan_contract` (
  `contract_id` int(11) NOT NULL,
  `contract_date` datetime NOT NULL,
  `loan_limit` decimal(10,2) NOT NULL,
  `student_id` varchar(13) NOT NULL,
  `officer_id` varchar(13) NOT NULL,
  `academic_year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mother`
--

CREATE TABLE `mother` (
  `mother_id` varchar(13) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `income` decimal(10,2) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `education_level` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `officer`
--

CREATE TABLE `officer` (
  `officer_id` varchar(13) NOT NULL,
  `password` varchar(255) NOT NULL COMMENT 'รหัสผ่าน',
  `f_name` varchar(255) NOT NULL COMMENT 'ชื่อ',
  `l_name` varchar(255) NOT NULL COMMENT 'นามสกุล',
  `campus` varchar(255) NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `position` varchar(255) NOT NULL,
  `profile_image` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sibling`
--

CREATE TABLE `sibling` (
  `full_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `total_siblings` int(11) NOT NULL,
  `current_year` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `workplace` varchar(255) NOT NULL,
  `income` decimal(10,2) NOT NULL,
  `education_level` varchar(255) NOT NULL,
  `student_id` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spouse`
--

CREATE TABLE `spouse` (
  `spouse_id` varchar(13) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `income` decimal(10,2) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `education_level` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE `term` (
  `academic_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `certifier_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `profile_image` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amount_of_money`
--
ALTER TABLE `amount_of_money`
  ADD PRIMARY KEY (`contract_id`,`academic_year`);

--
-- Indexes for table `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `collegian`
--
ALTER TABLE `collegian`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_code` (`student_code`),
  ADD KEY `family_status_id` (`family_status_id`),
  ADD KEY `father_id` (`father_id`),
  ADD KEY `mother_id` (`mother_id`),
  ADD KEY `guardian_id` (`guardian_id`),
  ADD KEY `spouse_id` (`spouse_id`),
  ADD KEY `endorser_id` (`endorser_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `department_ibfk_1` (`faculty_id`);

--
-- Indexes for table `endorsee`
--
ALTER TABLE `endorsee`
  ADD PRIMARY KEY (`endorser_id`);

--
-- Indexes for table `family_status`
--
ALTER TABLE `family_status`
  ADD PRIMARY KEY (`family_status_id`);

--
-- Indexes for table `father`
--
ALTER TABLE `father`
  ADD PRIMARY KEY (`father_id`);

--
-- Indexes for table `guardian`
--
ALTER TABLE `guardian`
  ADD PRIMARY KEY (`guardian_id`);

--
-- Indexes for table `loan_contract`
--
ALTER TABLE `loan_contract`
  ADD PRIMARY KEY (`contract_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `officer_id` (`officer_id`);

--
-- Indexes for table `mother`
--
ALTER TABLE `mother`
  ADD PRIMARY KEY (`mother_id`);

--
-- Indexes for table `officer`
--
ALTER TABLE `officer`
  ADD PRIMARY KEY (`officer_id`);

--
-- Indexes for table `sibling`
--
ALTER TABLE `sibling`
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `spouse`
--
ALTER TABLE `spouse`
  ADD PRIMARY KEY (`spouse_id`);

--
-- Indexes for table `term`
--
ALTER TABLE `term`
  ADD PRIMARY KEY (`academic_year`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `board`
--
ALTER TABLE `board`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `loan_contract`
--
ALTER TABLE `loan_contract`
  MODIFY `contract_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `amount_of_money`
--
ALTER TABLE `amount_of_money`
  ADD CONSTRAINT `amount_of_money_ibfk_1` FOREIGN KEY (`contract_id`) REFERENCES `loan_contract` (`contract_id`);

--
-- Constraints for table `collegian`
--
ALTER TABLE `collegian`
  ADD CONSTRAINT `collegian_ibfk_1` FOREIGN KEY (`family_status_id`) REFERENCES `family_status` (`family_status_id`),
  ADD CONSTRAINT `collegian_ibfk_2` FOREIGN KEY (`father_id`) REFERENCES `father` (`father_id`),
  ADD CONSTRAINT `collegian_ibfk_3` FOREIGN KEY (`mother_id`) REFERENCES `mother` (`mother_id`),
  ADD CONSTRAINT `collegian_ibfk_4` FOREIGN KEY (`guardian_id`) REFERENCES `guardian` (`guardian_id`),
  ADD CONSTRAINT `collegian_ibfk_5` FOREIGN KEY (`spouse_id`) REFERENCES `spouse` (`spouse_id`),
  ADD CONSTRAINT `collegian_ibfk_6` FOREIGN KEY (`endorser_id`) REFERENCES `endorsee` (`endorser_id`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `board` (`faculty_id`);

--
-- Constraints for table `loan_contract`
--
ALTER TABLE `loan_contract`
  ADD CONSTRAINT `loan_contract_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `collegian` (`student_id`),
  ADD CONSTRAINT `loan_contract_ibfk_2` FOREIGN KEY (`officer_id`) REFERENCES `officer` (`officer_id`);

--
-- Constraints for table `sibling`
--
ALTER TABLE `sibling`
  ADD CONSTRAINT `sibling_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `collegian` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
