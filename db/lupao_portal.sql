-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2025 at 05:18 PM
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
(95, 4, 'Logged In', '2024-12-12', '00:00:00'),
(97, 4, 'Sent a message to User ID 9', '2024-12-12', '00:00:00'),
(98, 4, 'Sent a message to User ID 9', '2024-12-12', '00:00:00'),
(100, 4, 'Sent a message to User ID 10', '2024-12-12', '00:00:00'),
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
(128, 4, 'Logged In', '2024-12-14', '22:06:02'),
(129, 4, 'Logged out', '2024-12-14', '22:50:27'),
(130, 4, 'Logged In', '2024-12-15', '03:15:47'),
(131, 4, 'Logged In', '2024-12-15', '17:16:34'),
(132, 4, 'Logged out', '2024-12-15', '17:42:23'),
(133, 4, 'Logged In', '2024-12-15', '20:03:22'),
(134, 4, 'Logged out', '2024-12-15', '20:04:38'),
(135, 15, 'Logged In', '2024-12-15', '20:05:02'),
(136, 15, 'Logged out', '2024-12-15', '20:06:01'),
(137, 4, 'Logged In', '2024-12-15', '20:06:08'),
(138, 4, 'Logged out', '2024-12-15', '20:51:06'),
(139, 4, 'Logged In', '2024-12-16', '08:22:16'),
(140, 4, 'Logged out', '2024-12-16', '08:41:52'),
(141, 4, 'Logged In', '2024-12-16', '08:42:10'),
(142, 4, 'Logged out', '2024-12-16', '08:42:42'),
(143, 4, 'Logged In', '2024-12-16', '00:00:00'),
(144, 4, 'Logged In', '2024-12-16', '08:44:56'),
(145, 4, 'logged out', '2024-12-16', '00:00:00'),
(146, 4, 'Logged In', '2024-12-16', '00:00:00'),
(147, 4, 'Logged In', '2024-12-16', '09:23:48'),
(148, 4, 'Logged out', '2024-12-16', '09:24:20'),
(149, 4, 'Logged In', '2024-12-16', '09:33:59'),
(150, 4, 'Logged In', '2024-12-16', '10:01:19'),
(151, 4, 'Added scholarship program ISKO NG BAYAN', '2024-12-16', '00:00:00'),
(152, 4, 'Added scholarship program ISKO NG BAYAN', '2024-12-16', '00:00:00'),
(153, 4, 'Added scholarship program ISKO NG BAYAN', '2024-12-16', '00:00:00'),
(154, 4, 'Added scholarship program ISKO NG BAYAN', '2024-12-16', '00:00:00'),
(155, 4, 'Added scholarship program jn', '2024-12-16', '00:00:00'),
(156, 4, 'Deleted scholarship program jn', '2024-12-16', '00:00:00'),
(157, 4, 'Deleted scholarship program ISKO NG BAYAN', '2024-12-16', '00:00:00'),
(158, 4, 'Deleted scholarship program ISKO NG BAYAN', '2024-12-16', '00:00:00'),
(159, 4, 'Added scholarship program j', '2024-12-16', '00:00:00'),
(160, 4, 'Added scholarship program ISKO NG BAYAN', '2024-12-16', '00:00:00'),
(161, 4, 'Deleted scholarship program ISKO NG BAYAN', '2024-12-16', '00:00:00'),
(162, 4, 'Deleted scholarship program j', '2024-12-16', '00:00:00'),
(163, 4, 'Added scholarship program BH', '2024-12-16', '00:00:00'),
(164, 4, 'Added scholarship program jn', '2024-12-16', '00:00:00'),
(165, 4, 'Deleted scholarship program BH', '2024-12-16', '00:00:00'),
(166, 4, 'Added scholarship program as', '2024-12-16', '00:00:00'),
(167, 4, 'Added scholarship program ss', '2024-12-16', '00:00:00'),
(168, 4, 'Added scholarship program hh', '2024-12-16', '00:00:00'),
(169, 4, 'Added scholarship program mmm', '2024-12-16', '00:00:00'),
(170, 4, 'Logged In', '2024-12-16', '14:44:02'),
(171, 4, 'Added scholarship program jn', '2024-12-16', '00:00:00'),
(172, 4, 'Added scholarship program sd', '2024-12-16', '00:00:00'),
(173, 4, 'Added scholarship program sd', '2024-12-16', '00:00:00'),
(174, 4, 'Deleted scholarship program Sample', '2024-12-16', '00:00:00'),
(175, 4, 'Deleted scholarship program ISKO NG BAYAN', '2024-12-16', '00:00:00'),
(176, 4, 'Deleted scholarship program ISKO NG BAYAN', '2024-12-16', '00:00:00'),
(177, 4, 'Deleted scholarship program jn', '2024-12-16', '00:00:00'),
(178, 4, 'Deleted scholarship program as', '2024-12-16', '00:00:00'),
(179, 4, 'Added scholarship program Isko ng Bayan', '2024-12-16', '00:00:00'),
(180, 4, 'Edited scholarship program ss', '2024-12-16', '00:00:00'),
(181, 4, 'Edited scholarship program ss', '2024-12-16', '00:00:00'),
(182, 4, 'Added scholarship program kjhkjh8', '2024-12-16', '00:00:00'),
(183, 4, 'Edited scholarship program kjhkjh8', '2024-12-16', '00:00:00'),
(184, 4, 'Edited scholarship program ss', '2024-12-16', '00:00:00'),
(185, 4, 'Edited scholarship program ss', '2024-12-16', '00:00:00'),
(186, 4, 'Logged out', '2024-12-16', '15:08:35'),
(192, 9, 'Graciel Lictawa cleared logs', '2024-12-16', '16:01:13'),
(193, 9, 'Logged out', '2024-12-16', '16:01:33'),
(194, 4, 'Logged In', '2024-12-16', '16:46:40'),
(195, 4, 'Logged out', '2024-12-16', '16:52:12'),
(196, 9, 'Logged In', '2024-12-16', '16:52:27'),
(197, 9, 'Added job Cashier by 7/11', '2024-12-16', '00:00:00'),
(198, 9, 'Logged out', '2024-12-16', '16:54:26'),
(199, 10, 'Logged In', '2024-12-16', '16:54:44'),
(200, 10, 'Logged out', '2024-12-16', '17:01:46'),
(201, 9, 'Logged In', '2024-12-16', '17:56:15'),
(202, 9, 'Logged out', '2024-12-16', '18:07:13'),
(203, 10, 'Logged In', '2024-12-16', '18:07:24'),
(204, 10, 'Logged out', '2024-12-16', '18:09:10'),
(205, 4, 'Logged In', '2024-12-16', '18:09:17'),
(206, 4, 'Scholarship for Super Mario (ss) was rejected', '2024-12-16', '00:00:00'),
(207, 4, 'Deleted rejected application of scholar Super Mario', '2024-12-16', '00:00:00'),
(208, 4, 'Logged out', '2024-12-16', '18:12:03'),
(209, 10, 'Logged In', '2024-12-16', '18:12:15'),
(210, 10, 'Logged out', '2024-12-16', '18:13:05'),
(211, 4, 'Logged In', '2024-12-16', '18:13:14'),
(212, 4, 'Scholarship for Super Mario (Isko ng Bayan) was rejected', '2024-12-16', '00:00:00'),
(213, 4, 'Deleted rejected application of scholar Super Mario', '2024-12-16', '00:00:00'),
(214, 4, 'Logged out', '2024-12-16', '18:13:43'),
(215, 10, 'Logged In', '2024-12-16', '18:13:53'),
(216, 10, 'Sent a message to User ID 4', '2024-12-16', '00:00:00'),
(217, 10, 'Logged out', '2024-12-16', '18:15:32'),
(218, 4, 'Logged In', '2024-12-16', '18:15:37'),
(219, 4, 'Sent a message to User ID 10', '2024-12-16', '00:00:00'),
(220, 4, 'Retreived announcement 1', '2024-12-16', '00:00:00'),
(221, 4, 'Retreived announcement 2', '2024-12-16', '00:00:00'),
(222, 4, 'Retreived announcement 3', '2024-12-16', '00:00:00'),
(223, 4, 'Logged out', '2024-12-16', '18:19:03'),
(224, 4, 'Logged In', '2024-12-16', '00:00:00'),
(225, 4, 'Sent a message to User ID 15', '2024-12-16', '00:00:00'),
(226, 4, 'logged out', '2024-12-16', '00:00:00'),
(227, 4, 'Logged In', '2024-12-16', '20:54:00'),
(228, 4, 'Deleted scholarship program kjhkjh8', '2024-12-16', '00:00:00'),
(229, 4, 'Deleted scholarship program ss', '2024-12-16', '00:00:00'),
(230, 4, 'Deleted scholarship program hh', '2024-12-16', '00:00:00'),
(231, 4, 'Deleted scholarship program mmm', '2024-12-16', '00:00:00'),
(232, 4, 'Deleted scholarship program jn', '2024-12-16', '00:00:00'),
(233, 4, 'Deleted scholarship program sd', '2024-12-16', '00:00:00'),
(234, 4, 'Edited scholarship program ISKOlar', '2024-12-16', '00:00:00'),
(235, 4, 'Logged In', '2024-12-16', '21:27:36'),
(236, 4, 'Logged out', '2024-12-16', '21:46:50'),
(237, 15, 'Logged In', '2024-12-16', '21:47:05'),
(238, 15, 'Logged out', '2024-12-16', '21:55:13'),
(239, 4, 'Logged In', '2024-12-16', '21:55:20'),
(240, 4, 'Logged In', '2024-12-16', '22:53:44'),
(241, 4, 'Logged In', '2024-12-16', '22:53:44'),
(242, 4, 'Logged In', '2024-12-17', '08:49:20'),
(243, 4, 'Logged out', '2024-12-17', '09:17:30'),
(244, 15, 'Logged In', '2024-12-17', '09:25:17'),
(245, 5, 'Logged In', '2024-12-17', '09:36:33'),
(246, 5, 'Logged out', '2024-12-17', '09:43:58'),
(247, 10, 'Logged In', '2024-12-17', '09:44:31'),
(248, 10, 'Logged out', '2024-12-17', '09:57:00'),
(249, 15, 'Logged In', '2024-12-17', '10:18:11'),
(250, 15, 'Logged out', '2024-12-17', '11:16:00'),
(251, 9, 'Logged In', '2024-12-17', '11:16:27'),
(252, 9, 'Logged In', '2024-12-17', '11:16:27'),
(253, 9, 'Logged out', '2024-12-17', '11:20:26'),
(254, 4, 'Logged In', '2024-12-17', '11:20:31'),
(255, 4, 'Logged out', '2024-12-17', '11:35:44'),
(256, 15, 'Logged In', '2024-12-17', '11:35:54'),
(257, 15, 'Logged out', '2024-12-17', '11:36:06'),
(258, 4, 'Logged In', '2024-12-17', '11:36:14'),
(259, 4, 'Scholarship for Dwyn Sy (ISKOlar) was accepted', '2024-12-17', '00:00:00'),
(260, 4, 'Changed Dwyn Sy status and remarks from program ISKOlar', '2024-12-17', '00:00:00'),
(261, 4, 'Logged out', '2024-12-17', '13:20:24'),
(262, 15, 'Logged In', '2024-12-17', '13:20:32'),
(263, 15, 'Logged out', '2024-12-17', '13:21:38'),
(264, 4, 'Logged In', '2024-12-17', '13:21:43'),
(265, 4, 'Logged out', '2024-12-17', '13:23:51'),
(266, 15, 'Logged In', '2024-12-17', '13:24:02'),
(267, 15, 'Logged out', '2024-12-17', '13:24:36'),
(268, 4, 'Logged In', '2024-12-17', '13:24:48'),
(269, 4, 'Added job Janitor by 7/11', '2024-12-17', '00:00:00'),
(270, 4, 'Logged out', '2024-12-17', '13:27:53'),
(271, 15, 'Logged In', '2024-12-17', '13:28:02'),
(272, 4, 'Logged In', '2024-12-17', '13:48:23'),
(273, 4, 'Added scholarship program Access for All', '2024-12-17', '00:00:00'),
(274, 4, 'Changed Dwyn Sy status and remarks from program ISKOlar', '2024-12-17', '00:00:00'),
(275, 15, 'Logged In', '2024-12-17', '13:53:58'),
(276, 15, 'Logged out', '2024-12-17', '13:58:53'),
(277, 4, 'Edited scholarship program ISKOlar', '2024-12-17', '00:00:00'),
(278, 4, 'Changed Dwyn Sy status and remarks from program ISKOlar', '2024-12-17', '00:00:00'),
(279, 15, 'Logged In', '2024-12-17', '14:04:06'),
(280, 4, 'Scholarship for Dwyn Sy (Access for All) was rejected', '2024-12-17', '00:00:00'),
(281, 4, 'Added job dvds by egf', '2024-12-17', '00:00:00'),
(282, 4, 'Edited job Secretary by LGU', '2024-12-17', '00:00:00'),
(283, 4, 'Added announcement sdgbdfthbnd', '2024-12-17', '00:00:00'),
(284, 4, 'Archived announcement 1', '2024-12-17', '00:00:00'),
(285, 4, 'Retreived announcement 1', '2024-12-17', '00:00:00'),
(286, 4, 'Updated announcement Announcement', '2024-12-17', '00:00:00'),
(287, 4, 'Deleted announcement', '2024-12-17', '00:00:00'),
(288, 4, 'Updated announcement try for time', '2024-12-17', '00:00:00'),
(289, 15, 'Logged out', '2024-12-17', '14:18:57'),
(290, 9, 'Logged In', '2024-12-17', '14:19:16'),
(291, 9, 'Super Mario application for Cashier was accepted', '2024-12-17', '00:00:00'),
(292, 9, 'Added job asdasewc by sdewqd', '2024-12-17', '00:00:00'),
(293, 9, 'Edited job asdasewc by sdewqd', '2024-12-17', '00:00:00'),
(294, 9, 'Logged out', '2024-12-17', '14:26:37'),
(295, 4, 'Logged out', '2024-12-17', '16:21:41'),
(296, 9, 'Logged In', '2024-12-17', '16:21:51'),
(297, 9, 'Edited job asdasewc by sdewqd', '2024-12-17', '00:00:00'),
(298, 9, 'Logged out', '2024-12-17', '16:22:32'),
(299, 15, 'Logged In', '2024-12-17', '16:23:28'),
(300, 15, 'Logged out', '2024-12-17', '16:24:12'),
(301, 4, 'Logged In', '2024-12-17', '16:24:17'),
(302, 15, 'Logged In', '2024-12-17', '16:25:23'),
(303, 15, 'Logged out', '2024-12-17', '16:25:34'),
(304, 9, 'Logged In', '2024-12-17', '16:25:58'),
(305, 9, 'Logged out', '2024-12-17', '16:26:24'),
(306, 15, 'Logged In', '2024-12-17', '16:26:39'),
(307, 15, 'Logged out', '2024-12-17', '16:39:13'),
(308, 9, 'Logged In', '2024-12-17', '16:39:19'),
(309, 4, 'Added job Delivery Guy by Water Station', '2024-12-17', '00:00:00'),
(310, 15, 'Logged In', '2024-12-17', '18:16:17'),
(311, 4, 'Logged In', '2024-12-17', '19:09:56'),
(312, 15, 'Logged out', '2024-12-17', '19:34:20'),
(313, 9, 'Logged In', '2024-12-17', '19:34:32'),
(314, 15, 'Logged In', '2024-12-17', '21:04:24'),
(315, 4, 'Logged out', '2024-12-17', '21:08:02'),
(316, 15, 'Logged In', '2024-12-17', '21:08:10'),
(317, 15, 'Logged out', '2024-12-17', '21:41:15'),
(318, 4, 'Logged In', '2024-12-17', '21:41:26'),
(319, 4, 'Logged out', '2024-12-17', '21:41:57'),
(320, 15, 'Logged In', '2024-12-17', '21:42:10'),
(321, 15, 'Logged In', '2024-12-17', '22:24:01'),
(322, 15, 'Profile Edited', '2024-12-18', '00:00:00'),
(323, 15, 'Profile Edited', '2024-12-18', '00:00:00'),
(324, 15, 'Logged out', '2024-12-18', '10:06:28'),
(325, 15, 'Logged In', '2024-12-18', '10:23:58'),
(326, 15, 'Logged out', '2024-12-18', '10:52:28'),
(327, 4, 'Logged In', '2024-12-18', '10:52:35'),
(328, 4, 'Logged In', '2024-12-18', '10:55:27'),
(329, 4, 'Logged In', '2025-01-05', '00:50:48'),
(330, 4, 'Logged out', '2025-01-05', '01:26:19'),
(331, 4, 'Logged In', '2025-01-05', '01:28:11'),
(332, 4, 'Logged In', '2025-01-07', '23:58:35'),
(333, 4, 'Logged In', '2025-01-07', '23:58:35'),
(334, 4, 'Logged In', '2025-01-07', '23:58:35'),
(335, 4, 'Logged In', '2025-01-08', '17:19:32'),
(336, 4, 'Logged out', '2025-01-08', '17:36:15'),
(337, 4, 'Logged In', '2025-01-08', '19:36:45'),
(338, 4, 'Super Mario application for Secretary was accepted', '2025-01-08', '00:00:00'),
(339, 4, 'Added announcement Lorem Ipsum', '2025-01-08', '00:00:00'),
(340, 4, 'Dwyn Sy application for Secretary was accepted', '2025-01-09', '00:00:00'),
(341, 4, 'Dwyn Sy application for Secretary was rejected', '2025-01-09', '00:00:00'),
(342, 4, 'Logged In', '2025-01-10', '21:22:31'),
(343, 4, 'Logged out', '2025-01-10', '21:34:30'),
(344, 4, 'Logged In', '2025-01-10', '21:34:38'),
(345, 4, 'Logged out', '2025-01-10', '21:34:59'),
(346, 15, 'Logged In', '2025-01-10', '21:35:06'),
(347, 15, 'Logged out', '2025-01-10', '21:48:34'),
(348, 4, 'Logged In', '2025-01-10', '21:48:41'),
(349, 4, 'Logged out', '2025-01-10', '21:49:14'),
(350, 4, 'Logged In', '2025-01-10', '21:49:37'),
(351, 4, 'Accept/Enabled registration Wyn Sy', '2025-01-10', '00:00:00'),
(352, 4, 'Logged out', '2025-01-10', '21:50:11'),
(353, 16, 'Logged In', '2025-01-10', '21:50:20'),
(354, 16, 'Logged out', '2025-01-10', '22:37:16'),
(355, 4, 'Logged In', '2025-01-10', '22:37:23'),
(356, 4, 'Scholarship for Wyn Sy (ISKOlar) was accepted', '2025-01-10', '00:00:00'),
(357, 4, 'Logged out', '2025-01-10', '23:27:46'),
(358, 16, 'Logged In', '2025-01-10', '23:29:12'),
(359, 16, 'Logged out', '2025-01-10', '23:29:36'),
(360, 4, 'Logged In', '2025-01-10', '23:29:43'),
(361, 4, 'Scholarship for Wyn Sy (Isko ng Bayan) was accepted', '2025-01-10', '00:00:00'),
(362, 4, 'Logged out', '2025-01-10', '23:35:24'),
(363, 16, 'Logged In', '2025-01-10', '23:35:35'),
(364, 16, 'Logged out', '2025-01-10', '23:35:55'),
(365, 4, 'Logged In', '2025-01-10', '23:36:22'),
(366, 4, 'Scholarship for Wyn Sy (Access for All) was accepted', '2025-01-10', '00:00:00'),
(367, 4, 'Logged In', '2025-01-11', '12:51:44'),
(368, 4, 'Updated announcement try for time', '2025-01-11', '00:00:00'),
(369, 4, 'Updated announcement try for time', '2025-01-11', '00:00:00'),
(370, 4, 'Added announcement dfsfs', '2025-01-11', '00:00:00'),
(371, 4, 'Updated announcement Lorem Ipsum', '2025-01-11', '00:00:00'),
(372, 4, 'Updated announcement Greetings Lupaenos', '2025-01-11', '00:00:00'),
(373, 4, 'Logged out', '2025-01-11', '15:46:50'),
(374, 16, 'Logged In', '2025-01-11', '15:46:59'),
(375, 16, 'Logged out', '2025-01-11', '15:47:39'),
(376, 4, 'Logged In', '2025-01-11', '15:47:44'),
(377, 4, 'Updated announcement try for time', '2025-01-11', '00:00:00'),
(378, 4, 'Logged out', '2025-01-11', '15:49:54'),
(379, 16, 'Logged In', '2025-01-11', '15:50:01'),
(380, 16, 'Logged out', '2025-01-11', '15:50:31'),
(381, 4, 'Logged In', '2025-01-11', '15:50:38'),
(382, 4, 'Deleted announcement', '2025-01-11', '00:00:00'),
(383, 4, 'Added announcement Pagbati!', '2025-01-11', '00:00:00'),
(384, 4, 'Updated announcement Pagbati!', '2025-01-11', '00:00:00'),
(385, 4, 'Deleted announcement', '2025-01-11', '00:00:00'),
(386, 16, 'Logged In', '2025-01-11', '15:53:17'),
(387, 4, 'Added announcement Social media', '2025-01-11', '00:00:00'),
(388, 4, 'Added announcement Try Again', '2025-01-11', '00:00:00'),
(389, 4, 'Updated announcement Social media', '2025-01-11', '00:00:00'),
(390, 4, 'Updated announcement Social media', '2025-01-11', '00:00:00'),
(391, 4, 'Archived announcement 8', '2025-01-11', '00:00:00'),
(392, 4, 'Retreived announcement 8', '2025-01-11', '00:00:00'),
(393, 4, 'Archived announcement 8', '2025-01-11', '00:00:00'),
(394, 4, 'Retreived announcement 8', '2025-01-11', '00:00:00'),
(395, 4, 'Logged In', '2025-01-11', '20:11:32'),
(396, 4, 'Logged out', '2025-01-11', '21:04:53'),
(397, 16, 'Logged In', '2025-01-11', '21:05:01'),
(398, 4, 'Logged In', '2025-01-11', '22:16:58'),
(399, 16, 'Logged out', '2025-01-11', '22:37:37'),
(400, 4, 'Logged In', '2025-01-11', '22:37:43'),
(401, 4, 'Edited scholarship program ISKOlar', '2025-01-11', '00:00:00'),
(402, 4, 'Edited scholarship program ISKOlar', '2025-01-11', '00:00:00'),
(403, 4, 'Edited scholarship program ISKOlar', '2025-01-11', '00:00:00'),
(404, 4, 'Edited scholarship program ISKOlar', '2025-01-11', '00:00:00'),
(405, 4, 'Changed Dwyn Sy status and remarks from program ISKOlar', '2025-01-12', '00:00:00');

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
(1, 'Announcement', 'sample sample', '2024-12-17', 1),
(3, 'try for time', '<p><b>jhcabskjc</b></p><p>sanckjm</p><p>vkyuhg , dshucib e tvuiehgtuvf bea8kanyfisgn fciuweg fuyw gnfnj ngjjfngweuyguegusjgfiusdgfsdgfjhsdgfjhsdbvjhdbdvhjsdbvhbsdhbvhdbvzjhxbvxbv</p><p>s hiugshgsid</p><p>s dhhgi</p>', '2025-01-11', 1),
(5, 'Lorem Ipsum', '<b>Lorem ipsum dolor </b>sit amet, consectetur adipiscing elit. Sed non ligula non ex scelerisque facilisis. Aenean imperdiet justo nec quam scelerisque faucibus. Maecenas et rhoncus nunc. Ut fermentum est nec libero dictum cursus. Nam sed facilisis massa', '2025-01-11', 1),
(6, 'dfsfs', '<p><b><i>sdsdsdsdscds</i></b>vd v fgb gfv g fgfdsff<sub>fdfdfdf</sub><sup>fdsf<strike>dfdffd</strike>fdsfds</sup>fsdsfdffsfsdfsdf<u>sdfdfsf</u></p>', '2025-01-11', 1),
(8, 'Social media', '<p><a href=\"https://www.facebook.com/dwyn.03125/\" target=\"_blank\">FACEBOOK</a><br><p></p></p>', '2025-01-11', 1),
(9, 'Try Again', '<p><a href=\"https://www.instagram.com/_dwiiinnnn/\" target=\"_blank\">instagram</a><br></p>', '2025-01-11', 1);

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

--
-- Dumping data for table `employment_job_applications`
--

INSERT INTO `employment_job_applications` (`id`, `job_id`, `applicant_id`, `requirement_1`, `requirement_2`, `requirement_3`, `requirement_4`, `applied_on`, `approved_on`, `status`, `remarks`) VALUES
(3, 2, 15, 'requirements_1/Lab Activity 6 Report Template - Load Balancing and Auto-scaling (2).docx', 'requirements_2/Lab Activity 6 Report Template - Load Balancing and Auto-scaling (2).docx', 'requirements_3/Lab Activity 6 Report Template - Load Balancing and Auto-scaling (2).docx', 'requirements_4/Lab Activity 6 Report Template - Load Balancing and Auto-scaling (2).docx', '2024-12-15', '2025-01-08', 1, NULL),
(4, 2, 15, 'requirements_1/Group-Activity-3.pdf', 'requirements_2/', 'requirements_3/', 'requirements_4/', '2024-12-15', NULL, NULL, NULL),
(5, 2, 15, 'requirements_1/poster.png', 'requirements_2/', 'requirements_3/', 'requirements_4/', '2024-12-15', '2025-01-08', 0, NULL),
(6, 3, 10, 'requirements_1/Lab Activity 6 Report Template - Load Balancing and Auto-scaling (4).docx', 'requirements_2/requirements_1_poster.png', 'requirements_3/requirements_1_poster (1).png', 'requirements_4/Lab Activity 6 Report Template - Load Balancing and Auto-scaling (4).docx', '2024-12-16', '2024-12-17', 1, 'Final Interview'),
(7, 2, 10, 'requirements_1/Lab Activity 6 Report Template - Load Balancing and Auto-scaling (4).docx', 'requirements_2/requirements_1_poster (1).png', 'requirements_3/', 'requirements_4/', '2024-12-16', NULL, NULL, NULL),
(8, 2, 10, 'requirements_1/COMMANDS_DOCUMENTATION.docx', 'requirements_2/Evaluation Tool for User Acceptability.pdf', 'requirements_3/requirements_1_poster (1).png', 'requirements_4/requirements_1_poster.png', '2024-12-17', '2025-01-08', 1, NULL),
(9, 0, 0, 'requirements_1/QUESTIONNAIRE (1).docx', 'requirements_2/Evaluation Tool for User Acceptability.pdf', 'requirements_3/requirements_1_poster (1).png', 'requirements_4/', '2024-12-17', NULL, NULL, NULL),
(10, 0, 0, 'requirements_1/QUESTIONNAIRE (1).docx', 'requirements_2/Evaluation Tool for User Acceptability.pdf', 'requirements_3/requirements_1_poster (1).png', 'requirements_4/requirements_1_poster.png', '2024-12-17', NULL, NULL, NULL),
(11, 0, 0, 'requirements_1/Evaluation Tool for User Acceptability.pdf', 'requirements_2/Lab Activity 6 Report Template - Load Balancing and Auto-scaling (4) (1).docx', 'requirements_3/requirements_1_poster (1).png', 'requirements_4/requirements_1_poster.png', '2024-12-17', NULL, NULL, NULL),
(12, 3, 0, 'requirements_1/requirements_2_Lab Activity 6 Report Template - Load Balancing and Auto-scaling (2).docx', 'requirements_2/', 'requirements_3/', 'requirements_4/', '2024-12-17', NULL, NULL, NULL),
(13, 3, 0, 'requirements_1/requirements_2_Lab Activity 6 Report Template - Load Balancing and Auto-scaling (2).docx', 'requirements_2/', 'requirements_3/', 'requirements_4/', '2024-12-17', NULL, NULL, NULL),
(14, 6, 0, 'requirements_1/requirements_2_Lab Activity 6 Report Template - Load Balancing and Auto-scaling (2).docx', 'requirements_2/', 'requirements_3/', 'requirements_4/', '2024-12-17', NULL, NULL, NULL),
(15, 4, 0, 'requirements_1/requirements_2_Lab Activity 6 Report Template - Load Balancing and Auto-scaling (2).docx', 'requirements_2/', 'requirements_3/', 'requirements_4/', '2024-12-17', NULL, NULL, NULL),
(16, 2, 0, 'requirements_1/Lab Activity 6 Report Template - Load Balancing and Auto-scaling (4) (1).docx', 'requirements_2/', 'requirements_3/', 'requirements_4/', '2024-12-17', NULL, NULL, NULL),
(17, 3, 0, 'requirements_1/Lab Activity 6 Report Template - Load Balancing and Auto-scaling (4) (1).docx', 'requirements_2/', 'requirements_3/', 'requirements_4/', '2024-12-17', NULL, NULL, NULL),
(18, 3, 0, 'requirements_1/Lab Activity 6 Report Template - Load Balancing and Auto-scaling (4) (1).docx', 'requirements_2/', 'requirements_3/', 'requirements_4/', '2024-12-17', NULL, NULL, NULL),
(19, 3, 0, 'requirements_1/Lab Activity 6 Report Template - Load Balancing and Auto-scaling (4) (1).docx', 'requirements_2/', 'requirements_3/', 'requirements_4/', '2024-12-17', NULL, NULL, NULL),
(20, 6, 0, 'requirements_1/requirements_1_Lab Activity 6 Report Template - Load Balancing and Auto-scaling (2) (2).docx', 'requirements_2/', 'requirements_3/', 'requirements_4/', '2024-12-17', NULL, NULL, NULL),
(21, 6, 0, 'requirements_1/requirements_1_Lab Activity 6 Report Template - Load Balancing and Auto-scaling (2) (2).docx', 'requirements_2/', 'requirements_3/', 'requirements_4/', '2024-12-17', NULL, NULL, NULL),
(22, 5, 0, 'requirements_1/requirements_1_Lab Activity 6 Report Template - Load Balancing and Auto-scaling (2) (2).docx', 'requirements_2/', 'requirements_3/', 'requirements_4/', '2024-12-17', NULL, NULL, NULL),
(23, 3, 0, 'requirements_1/CAPSTONE-2-DEFENDED.docx', 'requirements_2/result.docx', 'requirements_3/', 'requirements_4/', '2024-12-18', NULL, NULL, NULL),
(24, 3, 0, 'requirements_1/CAPSTONE-2-DEFENDED.docx', 'requirements_2/result.docx', 'requirements_3/', 'requirements_4/', '2024-12-18', NULL, NULL, NULL),
(25, 3, 0, 'requirements_1/CAPSTONE-2-DEFENDED.docx', 'requirements_2/result.docx', 'requirements_3/', 'requirements_4/', '2024-12-18', NULL, NULL, NULL),
(26, 3, 0, 'requirements_1/CAPSTONE-2-DEFENDED.docx', 'requirements_2/result.docx', 'requirements_3/', 'requirements_4/', '2024-12-18', NULL, NULL, NULL),
(27, 3, 0, 'requirements_1/CAPSTONE-2-DEFENDED.docx', 'requirements_2/result.docx', 'requirements_3/', 'requirements_4/', '2024-12-18', NULL, NULL, NULL),
(28, 3, 0, 'requirements_1/CAPSTONE-2-DEFENDED.docx', 'requirements_2/result.docx', 'requirements_3/', 'requirements_4/', '2024-12-18', NULL, NULL, NULL),
(29, 7, 0, 'requirements_1/poster.png', 'requirements_2/requirements_1_Lab Activity 6 Report Template - Load Balancing and Auto-scaling (2) (2).docx', 'requirements_3/', 'requirements_4/', '2024-12-18', NULL, NULL, NULL),
(30, 7, 0, 'requirements_1/poster.png', 'requirements_2/requirements_1_Lab Activity 6 Report Template - Load Balancing and Auto-scaling (2) (2).docx', 'requirements_3/', 'requirements_4/', '2024-12-18', NULL, NULL, NULL),
(31, 7, 0, 'requirements_1/poster.png', 'requirements_2/requirements_1_Lab Activity 6 Report Template - Load Balancing and Auto-scaling (2) (2).docx', 'requirements_3/', 'requirements_4/', '2024-12-18', NULL, NULL, NULL),
(32, 3, 0, 'requirements_1/CAPSTONE-2-DEFENDED.docx', 'requirements_2/result.docx', 'requirements_3/', 'requirements_4/', '2024-12-18', NULL, NULL, NULL),
(33, 3, 0, 'requirements_1/end-users.docx', 'requirements_2/ISO-25010-evaluation-tool-for-REDOMADA SYSTEM-mjbagsic-17122024.pdf', 'requirements_3/end-users (1).docx', 'requirements_4/result.docx', '2024-12-18', NULL, NULL, NULL),
(34, 3, 0, 'requirements_1/result.docx', 'requirements_2/', 'requirements_3/requirements_1_poster (1).png', 'requirements_4/', '2025-01-10', NULL, NULL, NULL),
(35, 6, 0, 'requirements_1/00Template-OJT-CLSU-MOA-ONSITE-1.pdf', 'requirements_2/requirements_1_poster.png', 'requirements_3/', 'requirements_4/', '2025-01-11', NULL, NULL, NULL),
(36, 6, 0, 'requirements_1/00Template-OJT-CLSU-MOA-ONSITE-1.pdf', 'requirements_2/requirements_1_poster.png', 'requirements_3/', 'requirements_4/', '2025-01-11', NULL, NULL, NULL),
(37, 6, 0, 'requirements_1/00Template-OJT-CLSU-MOA-ONSITE-1.pdf', 'requirements_2/requirements_1_poster.png', 'requirements_3/', 'requirements_4/', '2025-01-11', NULL, NULL, NULL),
(38, 6, 0, 'requirements_1/00Template-OJT-CLSU-MOA-ONSITE-1.pdf', 'requirements_2/requirements_1_poster.png', '', '', '2025-01-11', NULL, NULL, NULL),
(39, 6, 0, 'requirements_1/00Template-OJT-CLSU-MOA-ONSITE-1.pdf', 'requirements_2/requirements_1_poster.png', '', '', '2025-01-11', NULL, NULL, NULL),
(40, 6, 0, 'requirements_1/00Template-OJT-CLSU-MOA-ONSITE-1.pdf', 'requirements_2/requirements_1_poster.png', 'requirements_3/', 'requirements_4/', '2025-01-11', NULL, NULL, NULL);

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
(2, 4, 'LGU', 'Secretary', 'Lorem ipsum dolor sit amet. Et enim dolorum sed vero placeat aut laborum explicabo vel commodi repellendus. Qui eius sunt qui incidunt voluptas cum perspiciatis amet 33 quasi dolorum eos galisum sunt sed maxime adipisci. Aut reiciendis rerum est voluptate', '25000', 'cedula\r\nindegency\r\nresume', '2024-12-11', '2024-12-24', 0),
(3, 9, '7/11', 'Cashier', 'sample', '8000', 'sample', '2024-12-16', '2024-12-31', 1),
(4, 4, '7/11', 'Janitor', 'ABdhabscuhjwsBA', '3500', 'sadfshbgrdfhbdt', '2024-12-17', '2024-12-17', 1),
(5, 4, 'egf', 'dvds', 'asdvfsdgvsrdfxgr', '5254', 'sdgvsxcsgbvscsgbv', '2024-12-17', '2024-12-18', 1),
(6, 9, 'sdewqd', 'asdasewc', 'sadfcwesdcfws', '1212122', 'qwdxcasddcxwas', '2024-12-17', '2024-12-18', 1),
(7, 4, 'Water Station', 'Delivery Guy', 'Deliver a water within the barangay', '300', 'Drivers License', '2024-12-17', '2024-12-18', 1);

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
(6, 4, 9, 'fr fr ns???', 1, '2024-12-12 00:16:53'),
(7, 4, 9, 'wapak', 1, '2024-12-12 00:17:33'),
(8, 9, 4, 'ehe', 1, '2024-12-12 00:17:44'),
(9, 4, 10, 'try natin\n', 1, '2024-12-12 00:19:56'),
(10, 4, 10, 'tryy ulit\n', 1, '2024-12-12 00:20:53'),
(11, 10, 4, 'ayown', 1, '2024-12-12 00:22:47'),
(12, 9, 4, 'sd', 1, '2024-12-16 15:10:27'),
(13, 9, 5, 'sd', NULL, '2024-12-16 15:12:00'),
(14, 10, 4, 'hoy kingksndiuwehuijfc', 1, '2024-12-16 18:14:47'),
(15, 4, 10, 're-submit your form', NULL, '2024-12-16 18:16:38'),
(16, 4, 15, 'helooo\n', NULL, '2024-12-16 20:50:57');

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
(21, 'lupaoportal@gmail.com', 'e9b81d5dcfafaecc6e35fcb038b019729aefe532313de3d941e2890462fe3c8d', '2024-12-02 05:07:23', '2024-12-02 03:07:23'),
(22, 'dwynsy2127@gmail.com', '73e297f505a36e285bb7ecfdf9896f6ac7fa84c7b99bb9296ec92c9b9231eb2f', '2024-12-15 12:15:07', '2024-12-15 10:15:07'),
(23, 'dwynsy2127@gmail.com', '0d9a5c762ae3e0190e87d18a7e34b0eed539d64ebe8e362b12affe55a2edb63c', '2024-12-15 12:15:22', '2024-12-15 10:15:22'),
(24, 'dwynsy2127@gmail.com', 'c9a91136e288b1be949b6557f7588b4ae836098b046f17c1ebd1a37cf08c1967', '2024-12-15 12:15:44', '2024-12-15 10:15:44'),
(25, 'dwynsy2127@gmail.com', '5fb2109d1c27be8569eac5bd228ddb1969c89b1b4e3342ad26fd074a8604f3db', '2024-12-16 10:02:42', '2024-12-16 08:02:42'),
(28, 'ushellname@gmail.com', '5afab214ebf2f885e1671d3aeaba5677167b61f80ac1442445add7b451ab2e0f', '2024-12-17 03:57:24', '2024-12-17 01:57:24');

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
(5, 1, 10, '2024-12-11', NULL, 'requirements_1/Lab Activity 6 Report Template - Load Balancing and Auto-scaling.docx', 'requirements_2/ninong-ninang.docx', 'requirements_3/', 'requirements_4/', NULL, NULL),
(8, 17, 15, '2024-12-16', '2024-12-17', 'requirements_1/Lab Activity 6 Report Template - Load Balancing and Auto-scaling (4) (1).docx', 'requirements_2/requirements_1_poster.png', 'requirements_3/', 'requirements_4/', 1, 'old'),
(9, 20, 15, '2024-12-17', '2024-12-17', 'requirements_1/requirements_1_poster (1).png', 'requirements_2/requirements_1_poster.png', 'requirements_3/QUESTIONNAIRE (1).docx', 'requirements_4/Evaluation Tool for User Acceptability.pdf', 0, NULL),
(10, 18, 15, '2024-12-17', '2025-01-10', 'requirements_1/COMMANDS_DOCUMENTATION.docx', 'requirements_2/Evaluation Tool for User Acceptability.pdf', 'requirements_3/requirements_1_poster (1).png', 'requirements_4/requirements_1_poster.png', 1, NULL),
(11, 17, 16, '2025-01-10', '2025-01-10', 'requirements_1/PAPER FORMAT (1).docx', 'requirements_2/ACCESS FOR ALL POSTER.png', 'requirements_3/', 'requirements_4/', 1, NULL),
(12, 18, 16, '2025-01-10', '2025-01-10', 'requirements_1/Letter-of-Consent-and-Responsibility-Fil.pdf', 'requirements_2/LSA_Template-Version2023-Agustin-signed.pdf', 'requirements_3/', 'requirements_4/', 1, NULL),
(13, 20, 16, '2025-01-10', '2025-01-10', 'requirements_1/00Template-OJT-CLSU-MOA-ONSITE-1.pdf', 'requirements_2/', 'requirements_3/', 'requirements_4/', 1, NULL);

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
(17, 'Mayor', 'ISKOlar', 'Kabataan para sa bayan', 'SHS STUDENTS', 'School Id', '2024-12-16', '2024-12-16', 1, 1, '2025-01-11 14:46:41'),
(18, 'Edwin', 'Isko ng Bayan', 'Para sa kabtaan', 'College Students', 'School ID\nBirth Certificate(PSA)\nCertificate of Enrollment \nCertificate of Grades', '2024-12-16', '2024-12-28', 1, 9, '2025-01-10 15:34:46'),
(20, 'Vice Mayor', 'Access for All', 'Access for All: This is a financial help to those students who lack financial for education. ', 'College Students', 'School ID\nBirth Certificate(PSA)\nCertificate of Enrollment \nCertificate of Grades', '2024-12-17', '2024-12-18', 1, 24, '2025-01-10 15:36:38');

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
(5, 3, 'Edwin', 'Tejada', 'tejadadwyn@gmail.com', '$2y$10$JXRMzwfa4Pb3wXeumrlUkOZAm1KFiNJJwRbCo3hLXtzbkKYk1obb6', 'Alalay Grande', '949497918144666', '2003-05-12', 'male', 1, '2024-12-02 03:12:37', NULL, NULL, NULL, 'uploads/gov_id/ceo.png', NULL, NULL, ''),
(6, 3, 'HR', 'Admin', 'lupaoportal+1@gmail.com', '$2y$10$hWc0tEncSnz89lR1EZGSeeFskpYNfVDukGivcZ1L2s4AWGMoghcd6', 'Poblacion North', '9497918141', '2008-09-02', 'male', 1, '2024-12-03 13:17:46', NULL, NULL, NULL, 'uploads/gov_id/poster.png', NULL, NULL, ''),
(7, 1, 'Admin', 'Lupao', 'edwintejada196@gmail.com', '$2y$10$rWP05MWkUBjVMy.u7w3MLOAjawXkImCxku3ZBTLlwVPAgJSQHT1Pq', NULL, NULL, NULL, NULL, 1, '2024-12-03 14:08:09', NULL, NULL, NULL, NULL, NULL, NULL, ''),
(9, 2, 'Graciel', 'Lictawa', 'lictawa.mary@clsu2.edu.ph', '$2y$10$fFBKNfcoC9jUwPPxDpywqO2t2wxMCnB/ho7TdkjiQuB10jaXuUZOW', 'Salvacion I', '09152589017', '2002-09-07', 'Male', 1, '2024-12-05 06:50:16', NULL, NULL, NULL, NULL, NULL, NULL, ''),
(10, 3, 'Super', 'Mario', 'ushellname@gmail.com', '$2y$10$6unfkOHfndNWzIzb/.J7KuZQYq2Va6Yv2fw5r8PxXivbaCJ8oirUa', 'Salvacion I', '09282474839', '2003-02-13', 'Male', 1, '2024-12-05 07:03:33', NULL, NULL, NULL, NULL, NULL, NULL, ''),
(11, 2, 'Ariel ', 'Pascual', 'lictawa.ariel@clsu2.edu.ph', '$2y$10$yp.2Bnhs6Dtpgs2vpEJ0OOFTWET0/eaUKs0LiMP7fGsW9DfE8cDZm', 'Poblacion East', '09497918144', '2002-05-24', 'male', 1, '2024-12-05 07:26:15', NULL, NULL, NULL, NULL, NULL, NULL, ''),
(12, 1, 'IT ', 'Admin ', 'jericoverdillo55@gmail.com', '$2y$10$g6e44no/MumPcwFgftYajOr0fXNa7f62CwYFWQHH/g43tBak7.6LS', 'Poblacion North', '', '1999-07-17', 'male', 1, '2024-12-05 12:09:57', NULL, NULL, NULL, NULL, NULL, NULL, ''),
(13, 3, 'Mariel', 'Lics', 'lictawa.mariel@clsu2.edu.ph', '$2y$10$73YnxcV.3ipnQoFIDYouzuHS5g7z.1jVmeKnW3615jq2FL67UzK8S', 'Salvacion I', '', '2002-10-02', 'female', 3, '2024-12-08 05:06:51', NULL, NULL, NULL, NULL, NULL, NULL, ''),
(15, 3, 'Dwyn', 'Sy', 'dwynsy2127@gmail.com', '$2y$10$NEzwEkNq1MA6aRONx.iulu2DblNfdJVQ7mlmco1YvMjxxRzj/ssJ2', 'Poblacion East', '09152589017', '2009-06-11', 'Male', 1, '2024-12-10 16:09:46', NULL, NULL, NULL, 'uploads/gov_id/DSC00201.JPG', NULL, NULL, ''),
(16, 3, 'Wyn', 'Sy', 'tejada.edwin@clsu2.edu.ph', '$2y$10$jbqy3mi6Pk7IismjlFTcVu4iiaRnpSevs9U.700tH5QrRu4CuZwJa', 'Balbalungao', '09557598636', '2025-01-05', 'male', 1, '2025-01-04 16:35:21', NULL, NULL, NULL, 'uploads/gov_id/ACCESS FOR ALL INTEGRATED EDUCATIONAL AND EMPLOYMENT SYSTEM FOR LUPAOEÑOS_ALO_LICTAWA_TEJADA.png', NULL, NULL, ''),
(17, 2, 'Adrian', 'Tejada', 'adriana@gmail.com', '$2y$10$rMMbqISTXNT3/4kwf4uA7esjkY9gUkBgxR6NcnRCl43gbh2FVyKa.', 'Bagong Flores', '09123456875', '2000-12-05', 'other', NULL, '2025-01-04 17:27:55', NULL, 'uploads/psa/PAPER FORMAT (1).docx', NULL, 'uploads/gov_id/ACCESS FOR ALL POSTER.png', NULL, 'uploads/business_permit/PAPER FORMAT.docx', 'uploads/cedula/IEEE FORMAT.pdf');

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
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=406;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employment_job_applications`
--
ALTER TABLE `employment_job_applications`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `employmment_jobs`
--
ALTER TABLE `employmment_jobs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages_table`
--
ALTER TABLE `messages_table`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `scholarships_scholars`
--
ALTER TABLE `scholarships_scholars`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `scholarship_programs`
--
ALTER TABLE `scholarship_programs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
