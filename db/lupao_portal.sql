-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 03:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lupao_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(250) NOT NULL,
  `user_id` int(250) NOT NULL,
  `activity_name` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `activity_name`, `date`, `time`) VALUES
(11, 14, 'Logged In', '2024-12-10', '00:00:00'),
(12, 14, 'Profile Edited', '2024-12-10', '00:00:00'),
(13, 14, 'logged out', '2024-12-10', '00:00:00'),
(19, 15, 'Logged In', '2024-12-10', '00:00:00'),
(20, 15, 'logged out', '2024-12-10', '00:00:00'),
(27, 15, 'Logged In', '2024-12-10', '00:00:00'),
(28, 15, 'logged out', '2024-12-10', '00:00:00'),
(33, 15, 'Logged In', '2024-12-10', '00:00:00'),
(34, 15, 'logged out', '2024-12-10', '00:00:00'),
(59, 4, 'Lupao Admin cleared logs', '2024-12-11', '17:41:52'),
(60, 4, 'Logged out', '2024-12-11', '17:42:59'),
(61, 4, 'Logged In', '2024-12-11', '17:43:15'),
(62, 4, 'Archived announcement 2', '2024-12-11', '18:10:46'),
(63, 4, 'Logged out', '2024-12-11', '18:11:43'),
(64, 10, 'Logged In', '2024-12-11', '18:13:06'),
(65, 10, 'Logged out', '2024-12-11', '18:14:02'),
(67, 9, 'Graciel Lictawa cleared logs', '2024-12-11', '18:15:07'),
(68, 9, 'Logged out', '2024-12-11', '18:24:27'),
(69, 4, 'Logged In', '2024-12-11', '18:24:34'),
(70, 4, 'Added job Secretary by LGU', '2024-12-11', '18:33:40'),
(71, 10, 'Logged In', '2024-12-11', '19:35:13'),
(72, 10, 'Logged out', '2024-12-11', '19:35:57'),
(73, 4, 'Logged In', '2024-12-11', '19:36:15'),
(74, 4, 'Logged out', '2024-12-11', '22:13:06'),
(75, 4, 'Logged In', '2024-12-11', '00:00:00'),
(76, 4, 'Sent a message to User ID 15', '2024-12-11', '00:00:00'),
(77, 4, 'Logged out', '2024-12-11', '22:14:26'),
(78, 4, 'logged out', '2024-12-11', '00:00:00'),
(79, 10, 'Logged In', '2024-12-11', '00:00:00'),
(80, 10, 'logged out', '2024-12-11', '00:00:00'),
(81, 4, 'Logged In', '2024-12-11', '00:00:00'),
(82, 4, 'Sent a message to User ID 10', '2024-12-11', '00:00:00'),
(83, 4, 'logged out', '2024-12-11', '00:00:00'),
(84, 10, 'Logged In', '2024-12-11', '00:00:00'),
(85, 10, 'Logged out', '2024-12-12', '00:06:28'),
(86, 4, 'Logged In', '2024-12-12', '00:00:00'),
(87, 4, 'Logged In', '2024-12-12', '00:00:00'),
(88, 4, 'Sent a message to User ID 9', '2024-12-12', '00:00:00'),
(89, 4, 'logged out', '2024-12-12', '00:00:00'),
(90, 9, 'Logged In', '2024-12-12', '00:00:00'),
(91, 9, 'Sent a message to User ID 4', '2024-12-12', '00:00:00'),
(92, 9, 'logged out', '2024-12-12', '00:00:00'),
(93, 9, 'Logged In', '2024-12-12', '00:00:00'),
(94, 9, 'logged out', '2024-12-12', '00:00:00'),
(95, 4, 'Logged In', '2024-12-12', '00:00:00'),
(96, 9, 'Logged In', '2024-12-12', '00:00:00'),
(97, 4, 'Sent a message to User ID 9', '2024-12-12', '00:00:00'),
(98, 4, 'Sent a message to User ID 9', '2024-12-12', '00:00:00'),
(99, 9, 'Sent a message to User ID 4', '2024-12-12', '00:00:00'),
(100, 4, 'Sent a message to User ID 10', '2024-12-12', '00:00:00'),
(101, 9, 'logged out', '2024-12-12', '00:00:00'),
(102, 4, 'Sent a message to User ID 10', '2024-12-12', '00:00:00'),
(103, 10, 'Logged In', '2024-12-12', '00:00:00'),
(104, 10, 'Sent a message to User ID 4', '2024-12-12', '00:00:00'),
(105, 4, 'logged out', '2024-12-12', '00:00:00'),
(106, 10, 'Logged In', '2024-12-12', '00:00:00'),
(107, 10, 'logged out', '2024-12-12', '00:00:00'),
(108, 4, 'Logged In', '2024-12-12', '00:00:00'),
(109, 4, 'logged out', '2024-12-12', '00:00:00'),
(110, 4, 'Logged In', '2024-12-12', '00:00:00'),
(111, 4, 'Logged In', '2024-12-13', '00:00:00'),
(112, 4, 'Logged out', '2024-12-13', '13:18:27'),
(113, 4, 'Logged In', '2024-12-13', '13:18:33'),
(114, 4, 'Logged In', '2024-12-13', '13:34:06'),
(115, 4, 'Logged out', '2024-12-13', '14:53:36'),
(116, 10, 'Logged In', '2024-12-13', '14:53:51'),
(117, 10, 'Logged out', '2024-12-13', '15:03:04'),
(118, 4, 'Logged In', '2024-12-13', '15:05:18'),
(119, 4, 'Logged out', '2024-12-13', '15:06:45'),
(120, 15, 'Logged In', '2024-12-13', '15:06:51'),
(121, 15, 'Logged out', '2024-12-13', '15:08:52'),
(122, 4, 'Logged In', '2024-12-14', '20:56:46'),
(123, 4, 'Logged out', '2024-12-14', '21:28:02'),
(124, 4, 'Logged In', '2024-12-14', '21:28:23'),
(125, 4, 'Logged out', '2024-12-14', '21:34:03'),
(126, 15, 'Logged In', '2024-12-14', '21:34:10'),
(127, 15, 'Logged out', '2024-12-14', '22:05:53'),
(128, 4, 'Logged In', '2024-12-14', '22:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `description`, `created_at`, `status`) VALUES
(1, 'Announcement', 'sample sample', '2024-12-10', 0),
(2, 'try again', 'please gumana ka HAHAHAHH', '2024-12-10', 0),
(3, 'try for time', 'activity log time HAHAHAHAH', '2024-12-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employment_job_applications`
--

CREATE TABLE `employment_job_applications` (
  `id` int(255) NOT NULL,
  `job_id` int(255) NOT NULL,
  `applicant_id` int(255) NOT NULL,
  `requirement_1` varchar(255) DEFAULT NULL,
  `requirement_2` varchar(255) DEFAULT NULL,
  `requirement_3` varchar(255) DEFAULT NULL,
  `requirement_4` varchar(255) DEFAULT NULL,
  `applied_on` date DEFAULT NULL,
  `approved_on` date DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `remarks` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employmment_jobs`
--

CREATE TABLE `employmment_jobs` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `requirements` varchar(1000) DEFAULT NULL,
  `application_start` date DEFAULT NULL,
  `application_deadline` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employmment_jobs`
--

INSERT INTO `employmment_jobs` (`id`, `user_id`, `company`, `position`, `description`, `salary`, `requirements`, `application_start`, `application_deadline`, `status`) VALUES
(1, 1, 'Sample', 'Sample', 'Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample ', '50000', 'Sample 1\r\nSample 2\r\nSample 3', '2024-10-01', '2024-10-21', 1),
(2, 4, 'LGU', 'Secretary', 'Lorem ipsum dolor sit amet. Et enim dolorum sed vero placeat aut laborum explicabo vel commodi repellendus. Qui eius sunt qui incidunt voluptas cum perspiciatis amet 33 quasi dolorum eos galisum sunt sed maxime adipisci. Aut reiciendis rerum est voluptate', '25000', 'cedula\r\nindegency\r\nresume', '2024-12-11', '2024-12-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages_table`
--

CREATE TABLE `messages_table` (
  `id` int(255) NOT NULL,
  `sender_id` int(255) NOT NULL,
  `receiver_id` int(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages_table`
--

INSERT INTO `messages_table` (`id`, `sender_id`, `receiver_id`, `message`, `status`, `created_at`) VALUES
(1, 4, 5, 'hello\n', NULL, '2024-12-03 14:37:10'),
(2, 4, 15, 'helooo\n', 1, '2024-12-11 22:14:02'),
(3, 4, 10, 'hiiii\n', 1, '2024-12-11 22:17:01'),
(4, 4, 9, 'try natin\n', 1, '2024-12-12 00:12:00'),
(5, 9, 4, 'gooooo', 1, '2024-12-12 00:12:49'),
(6, 4, 9, 'fr fr ns???', NULL, '2024-12-12 00:16:53'),
(7, 4, 9, 'wapak', 1, '2024-12-12 00:17:33'),
(8, 9, 4, 'ehe', 1, '2024-12-12 00:17:44'),
(9, 4, 10, 'try natin\n', 1, '2024-12-12 00:19:56'),
(10, 4, 10, 'tryy ulit\n', 1, '2024-12-12 00:20:53'),
(11, 10, 4, 'ayown', 1, '2024-12-12 00:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `email`, `token`, `expires`, `created_at`) VALUES
(21, 'lupaoportal@gmail.com', 'e9b81d5dcfafaecc6e35fcb038b019729aefe532313de3d941e2890462fe3c8d', '2024-12-02 05:07:23', '2024-12-02 03:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `scholarships_scholars`
--

CREATE TABLE `scholarships_scholars` (
  `id` int(255) NOT NULL,
  `program_id` int(255) NOT NULL,
  `student_id` int(255) NOT NULL,
  `date_applied` date NOT NULL,
  `date_approved` date DEFAULT NULL,
  `requirement_1` varchar(255) DEFAULT NULL,
  `requirement_2` varchar(255) DEFAULT NULL,
  `requirement_3` varchar(255) DEFAULT NULL,
  `requirement_4` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scholarships_scholars`
--

INSERT INTO `scholarships_scholars` (`id`, `program_id`, `student_id`, `date_applied`, `date_approved`, `requirement_1`, `requirement_2`, `requirement_3`, `requirement_4`, `status`, `remarks`) VALUES
(2, 1, 15, '2024-12-10', '2024-12-10', 'requirements_1/RENESON-12-10-2024.png', 'requirements_2/22.png', 'requirements_3/', 'requirements_4/', 1, 'new'),
(3, 1, 15, '2024-12-10', NULL, 'requirements_1/22.png', 'requirements_2/', 'requirements_3/', 'requirements_4/', NULL, NULL),
(4, 1, 10, '2024-12-11', NULL, 'requirements_1/RENESON-12-10-2024.png', 'requirements_2/', 'requirements_3/', 'requirements_4/', NULL, NULL),
(5, 1, 10, '2024-12-11', NULL, 'requirements_1/Lab Activity 6 Report Template - Load Balancing and Auto-scaling.docx', 'requirements_2/ninong-ninang.docx', 'requirements_3/', 'requirements_4/', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_programs`
--

CREATE TABLE `scholarship_programs` (
  `id` int(255) NOT NULL,
  `grantor` varchar(255) NOT NULL,
  `program_title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `beneficiaries` varchar(255) NOT NULL,
  `requirements` varchar(255) NOT NULL,
  `application_start` date NOT NULL,
  `application_deadline` date NOT NULL,
  `status` int(10) NOT NULL,
  `slot` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scholarship_programs`
--

INSERT INTO `scholarship_programs` (`id`, `grantor`, `program_title`, `description`, `beneficiaries`, `requirements`, `application_start`, `application_deadline`, `status`, `slot`, `created_at`) VALUES
(1, 'Sample', 'Sample', 'Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample Sample ', 'Sample', 'Sample \nSample\nSample', '2024-10-01', '2024-10-21', 1, 50, '2024-10-20 03:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id` int(255) NOT NULL,
  `user_type` int(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `baranggay` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `psa_path` varchar(255) DEFAULT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `gov_id_path` varchar(255) DEFAULT NULL,
  `cert_residency` varchar(255) DEFAULT NULL,
  `business_permit_path` varchar(255) DEFAULT NULL,
  `cedula_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `user_type`, `firstname`, `lastname`, `email`, `password`, `baranggay`, `contact_no`, `birthday`, `gender`, `status`, `created_at`, `updated_at`, `psa_path`, `student_id`, `gov_id_path`, `cert_residency`, `business_permit_path`, `cedula_path`) VALUES
(4, 1, 'Lupao', 'Admin', 'lupaoportal@gmail.com', '$2y$10$hk7AW3eflEiq3bFUzS3m8.ebwZOIgQRCDuMhcTIm.C.hzBrivz7DC', 'Poblacion South', '09497918145', '1983-09-02', 'male', 1, '2024-12-01 02:01:10', NULL, NULL, NULL, 'uploads/gov_id/bgbg.png', NULL, NULL, ''),
(5, 3, 'Edwin', 'Tejada', 'tejadadwyn@gmail.com', '$2y$10$VTz3fLFwmzvsvfdo1k59EOtDEsCqN2AW5bA3dSr69f1347R.JVwWa', 'Alalay Grande', '949497918144666', '2003-05-12', 'male', 1, '2024-12-02 03:12:37', NULL, NULL, NULL, 'uploads/gov_id/ceo.png', NULL, NULL, ''),
(6, 3, 'HR', 'Admin', 'lupaoportal+1@gmail.com', '$2y$10$hWc0tEncSnz89lR1EZGSeeFskpYNfVDukGivcZ1L2s4AWGMoghcd6', 'Poblacion North', '9497918141', '2008-09-02', 'male', 1, '2024-12-03 13:17:46', NULL, NULL, NULL, 'uploads/gov_id/poster.png', NULL, NULL, ''),
(7, 1, 'Admin', 'Lupao', 'edwintejada196@gmail.com', '$2y$10$rWP05MWkUBjVMy.u7w3MLOAjawXkImCxku3ZBTLlwVPAgJSQHT1Pq', NULL, NULL, NULL, NULL, 1, '2024-12-03 14:08:09', NULL, NULL, NULL, NULL, NULL, NULL, ''),
(9, 2, 'Graciel', 'Lictawa', 'lictawa.mary@clsu2.edu.ph', '$2y$10$fFBKNfcoC9jUwPPxDpywqO2t2wxMCnB/ho7TdkjiQuB10jaXuUZOW', 'Salvacion I', '', '2002-09-07', 'female', 1, '2024-12-05 06:50:16', NULL, NULL, NULL, NULL, NULL, NULL, ''),
(10, 3, 'Super', 'Mario', 'ushellname@gmail.com', '$2y$10$6unfkOHfndNWzIzb/.J7KuZQYq2Va6Yv2fw5r8PxXivbaCJ8oirUa', 'Salvacion I', '09282474839', '2003-02-13', 'Male', 1, '2024-12-05 07:03:33', NULL, NULL, NULL, NULL, NULL, NULL, ''),
(11, 2, 'Ariel ', 'Pascual', 'lictawa.ariel@clsu2.edu.ph', '$2y$10$yp.2Bnhs6Dtpgs2vpEJ0OOFTWET0/eaUKs0LiMP7fGsW9DfE8cDZm', 'Poblacion East', '09497918144', '2002-05-24', 'male', 1, '2024-12-05 07:26:15', NULL, NULL, NULL, NULL, NULL, NULL, ''),
(12, 1, 'IT ', 'Admin ', 'jericoverdillo55@gmail.com', '$2y$10$g6e44no/MumPcwFgftYajOr0fXNa7f62CwYFWQHH/g43tBak7.6LS', 'Poblacion North', '', '1999-07-17', 'male', 1, '2024-12-05 12:09:57', NULL, NULL, NULL, NULL, NULL, NULL, ''),
(13, 3, 'Mariel', 'Lics', 'lictawa.mariel@clsu2.edu.ph', '$2y$10$73YnxcV.3ipnQoFIDYouzuHS5g7z.1jVmeKnW3615jq2FL67UzK8S', 'Salvacion I', '', '2002-10-02', 'female', 1, '2024-12-08 05:06:51', NULL, NULL, NULL, NULL, NULL, NULL, ''),
(15, 3, 'Dwyn', 'Sy', 'dwynsy2127@gmail.com', '$2y$10$nGrdiZBTVihTF6IdugXjEukClFtqTSOVQpJn2SqIa0sM5hBbJ0vzy', 'Poblacion East', '', '2009-06-11', 'male', 1, '2024-12-10 16:09:46', NULL, NULL, NULL, 'uploads/gov_id/DSC00201.JPG', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Employer'),
(3, 'Applicant');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employment_job_applications`
--
ALTER TABLE `employment_job_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employmment_jobs`
--
ALTER TABLE `employmment_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages_table`
--
ALTER TABLE `messages_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholarships_scholars`
--
ALTER TABLE `scholarships_scholars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholarship_programs`
--
ALTER TABLE `scholarship_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employment_job_applications`
--
ALTER TABLE `employment_job_applications`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employmment_jobs`
--
ALTER TABLE `employmment_jobs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages_table`
--
ALTER TABLE `messages_table`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `scholarships_scholars`
--
ALTER TABLE `scholarships_scholars`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `scholarship_programs`
--
ALTER TABLE `scholarship_programs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_table`
--
ALTER TABLE `user_table`
  ADD CONSTRAINT `user_table_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_type` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
