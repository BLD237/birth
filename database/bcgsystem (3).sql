-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2024 at 09:40 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bcgsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `application_number` int(11) NOT NULL,
  `applicant_name` varchar(255) NOT NULL,
  `applicant_contact` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `admin_review` varchar(255) DEFAULT NULL,
  `child_id` int(100) NOT NULL,
  `child_name` varchar(255) NOT NULL,
  `child_dob` date NOT NULL,
  `child_place_of_birth` varchar(255) NOT NULL,
  `father_id` varchar(30) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `father_dob` date NOT NULL,
  `father_place_of_birth` varchar(255) NOT NULL,
  `mother_id` varchar(30) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `mother_dob` date NOT NULL,
  `mother_place_of_birth` varchar(255) NOT NULL,
  `applied_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`application_number`, `applicant_name`, `applicant_contact`, `status`, `admin_review`, `child_id`, `child_name`, `child_dob`, `child_place_of_birth`, `father_id`, `father_name`, `father_dob`, `father_place_of_birth`, `mother_id`, `mother_name`, `mother_dob`, `mother_place_of_birth`, `applied_on`) VALUES
(193125778, 'MIKE', '+237 672796256', 'verified', NULL, 966249666, 'BELMOND', '2004-04-01', 'BAMENDA', '0878653211', 'francis mufor', '1974-08-15', 'SANTA', '234342345453211', '', '1984-04-14', 'santa', '2024-04-04 21:58:44'),
(359488853, 'MIKE', '+237 672796256', 'rejected', NULL, 102240351, 'BELMOND', '2004-04-01', 'BAMENDA', '1367823', 'francis mufor', '1974-08-15', 'SANTA', '99008675', '', '1984-04-14', 'santa', '2024-04-04 21:56:54'),
(687300341, 'MUFOR BELMOND ', '+237 672796256', 'rejected', NULL, 408448929, 'BELMOND', '0004-03-12', 'BAMENDA', 'KITT221', 'francis mufor', '0000-00-00', 'SANTA', 'kitt675', '', '1111-11-11', 'santa', '2024-04-05 19:00:23'),
(791095543, 'MIKE', '+237 672796256', 'verified', NULL, 827887889, 'BELMOND', '2004-04-01', 'BAMENDA', '1367823123', 'francis mufor', '1974-08-15', 'SANTA', '990086751234', '', '1984-04-14', 'santa', '2024-04-04 21:57:52'),
(862502968, 'MIKE', '+237 672796256', '', NULL, 883343742, 'BELMOND', '2004-04-01', 'BAMENDA', '14234545444', 'francis mufor', '1974-08-15', 'SANTA', '1234565432', '', '1984-04-14', 'santa', '2024-04-04 21:58:21'),
(902314861, 'MIKE', '+237 672796256', '', NULL, 872060002, 'BELMOND', '2004-04-01', 'BAMENDA', '98765676543245', 'francis mufor', '1974-08-15', 'SANTA', '3232434342322', '', '1984-04-14', 'santa', '2024-04-04 21:59:18'),
(918522107, 'MUFOR', 'BELMOND', '', NULL, 650208665, 'MARK', '2024-03-24', 'BAMENDA', 'KITT228', 'francis mufor', '1974-08-15', 'SANTA', 'kitt609', '', '1984-04-14', 'santa', '2024-03-31 21:28:58'),
(987674042, 'MUFOR', 'BELMOND', 'verified', NULL, 106376200, 'MARK-FORTUNE', '2024-03-24', 'BAMENDA', 'KITT221', 'francis mufor', '1974-08-15', 'SANTA', 'kitt675', '', '1984-04-14', 'santa', '2024-03-31 21:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `birthcerticate`
--

CREATE TABLE `birthcerticate` (
  `birthcertificate_number` int(11) NOT NULL,
  `application_number` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `mother_id` varchar(255) NOT NULL,
  `father_id` varchar(255) NOT NULL,
  `location_id` int(11) NOT NULL,
  `registrar` varchar(111) NOT NULL,
  `midwife_id` int(11) NOT NULL,
  `status` varchar(11) NOT NULL,
  `date_of_issue` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `birthcerticate`
--

INSERT INTO `birthcerticate` (`birthcertificate_number`, `application_number`, `child_id`, `mother_id`, `father_id`, `location_id`, `registrar`, `midwife_id`, `status`, `date_of_issue`) VALUES
(249144407, 791095543, 827887889, '990086751234', '1367823123', 32, 'KIT12', 576729755, 'verified', '2024-04-05 19:11:39'),
(404721180, 359488853, 102240351, '99008675', '1367823', 31, 'KIT114', 763553015, 'verified', '2024-04-05 13:51:44'),
(441690202, 987674042, 106376200, 'kitt675', 'KITT221', 29, 'KIT12', 944294839, 'verified', '2024-04-04 17:32:58'),
(555220105, 193125778, 966249666, '234342345453211', '0878653211', 34, 'KIT114', 402915856, 'verified', '2024-04-05 13:02:37'),
(632244033, 193125778, 966249666, '234342345453211', '0878653211', 34, 'KIT12', 402915856, 'verified', '2024-04-05 14:07:34'),
(798806906, 918522107, 650208665, 'kitt609', 'KITT228', 30, 'KIT114', 598458035, 'verified', '2024-04-04 11:40:54'),
(891190753, 987674042, 106376200, 'kitt675', 'KITT221', 29, 'KIT12', 944294839, 'verified', '2024-04-05 19:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `child_info`
--

CREATE TABLE `child_info` (
  `child_id` int(100) NOT NULL,
  `application_number` int(111) NOT NULL,
  `child_fname` varchar(255) NOT NULL,
  `child_lname` varchar(255) NOT NULL,
  `child_dob` date NOT NULL,
  `child_gender` varchar(255) NOT NULL,
  `child_placeofbirth` varchar(255) NOT NULL,
  `child_wieght` int(11) NOT NULL,
  `child_hieght` int(11) NOT NULL,
  `father_id` varchar(30) NOT NULL,
  `mother_id` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `child_info`
--

INSERT INTO `child_info` (`child_id`, `application_number`, `child_fname`, `child_lname`, `child_dob`, `child_gender`, `child_placeofbirth`, `child_wieght`, `child_hieght`, `father_id`, `mother_id`, `created_at`) VALUES
(102240351, 359488853, 'MUFOR', 'BELMOND', '2004-04-01', 'male', 'BAMENDA', 1, 1, '1367823', '99008675', '2024-04-04 21:56:54'),
(106376200, 987674042, 'MUFOR ', 'MARK-FORTUNE', '2024-03-24', 'male', 'BAMENDA', 1, 1, 'KITT221', 'kitt675', '2024-03-31 21:11:10'),
(256953741, 834050227, 'MUFOR', 'BELMOND', '0004-03-12', 'male', 'BAMENDA', 1, 1, 'KITT221', 'kitt675', '2024-04-05 18:55:52'),
(408448929, 687300341, 'MUFOR', 'BELMOND', '0004-03-12', 'male', 'BAMENDA', 1, 1, 'KITT221', 'kitt675', '2024-04-05 19:00:23'),
(650208665, 918522107, 'MUFOR ', 'MARK', '2024-03-24', 'male', 'BAMENDA', 1, 1, 'KITT228', 'kitt609', '2024-03-31 21:28:58'),
(827887889, 791095543, 'MUFOR', 'BELMOND', '2004-04-01', 'male', 'BAMENDA', 1, 1, '1367823123', '990086751234', '2024-04-04 21:57:51'),
(872060002, 902314861, 'MUFOR', 'BELMOND', '2004-04-01', 'male', 'BAMENDA', 1, 1, '98765676543245', '3232434342322', '2024-04-04 21:59:17'),
(883343742, 862502968, 'MUFOR', 'BELMOND', '2004-04-01', 'male', 'BAMENDA', 1, 1, '14234545444', '1234565432', '2024-04-04 21:58:20'),
(966249666, 193125778, 'MUFOR', 'BELMOND', '2004-04-01', 'male', 'BAMENDA', 1, 1, '0878653211', '234342345453211', '2024-04-04 21:58:44');

-- --------------------------------------------------------

--
-- Table structure for table `fathers_info`
--

CREATE TABLE `fathers_info` (
  `father_id` varchar(11) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `father_address` varchar(255) NOT NULL,
  `father_place_of_birth` varchar(255) NOT NULL,
  `father_subdivision` varchar(255) NOT NULL,
  `father_dob` date NOT NULL,
  `father_occupation` varchar(255) NOT NULL,
  `father_phone` varchar(11) NOT NULL,
  `father_email` varchar(255) NOT NULL,
  `mother_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fathers_info`
--

INSERT INTO `fathers_info` (`father_id`, `father_name`, `father_address`, `father_place_of_birth`, `father_subdivision`, `father_dob`, `father_occupation`, `father_phone`, `father_email`, `mother_id`, `created_at`) VALUES
('0878653211', 'francis mufor', 'Yaounde', 'SANTA', 'santa', '1974-08-15', 'deconte', '672796256', 'muforbelmond20@gmail.com', '234342345453211', '2024-04-04 21:58:44'),
('1367823', 'francis mufor', 'Yaounde', 'SANTA', 'santa', '1974-08-15', 'deconte', '672796256', 'muforbelmond20@gmail.com', '99008675', '2024-04-04 21:56:54'),
('1367823123', 'francis mufor', 'Yaounde', 'SANTA', 'santa', '1974-08-15', 'deconte', '672796256', 'muforbelmond20@gmail.com', '990086751234', '2024-04-04 21:57:52'),
('14234545444', 'francis mufor', 'Yaounde', 'SANTA', 'santa', '1974-08-15', 'deconte', '672796256', 'muforbelmond20@gmail.com', '1234565432', '2024-04-04 21:58:20'),
('98765676543', 'francis mufor', 'Yaounde', 'SANTA', 'santa', '1974-08-15', 'deconte', '672796256', 'muforbelmond20@gmail.com', '3232434342322', '2024-04-04 21:59:17'),
('KITT221', 'francis mufor', 'BAMENDA', 'SANTA', 'santa', '1974-08-15', 'deconte', '677889946', 'francismufor@omail.ai', 'kitt675', '2024-03-31 21:11:10'),
('KITT228', 'francis mufor', 'BAMENDA', 'SANTA', 'santa', '1974-08-15', 'deconte', '677889946', 'francismufor@omail.ai', 'kitt609', '2024-03-31 21:28:58');

-- --------------------------------------------------------

--
-- Table structure for table `issue_authority`
--

CREATE TABLE `issue_authority` (
  `issue_id` varchar(111) NOT NULL,
  `authority_name` varchar(111) NOT NULL,
  `authority_address` varchar(255) NOT NULL,
  `contact` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issue_authority`
--

INSERT INTO `issue_authority` (`issue_id`, `authority_name`, `authority_address`, `contact`, `created_at`) VALUES
('KIT114', 'MUFOR BELMOND', 'Mankon', '0000-00-00', '2024-04-03 19:09:07'),
('KIT12', 'Emily', 'Mankon', '0000-00-00', '2024-04-04 13:07:04'),
('KIT406', 'MIKE', 'Mankon', '0000-00-00', '2024-04-03 19:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `application_number` int(11) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `healthcare_name` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `town` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `application_number`, `nationality`, `healthcare_name`, `region`, `town`, `created_at`) VALUES
(29, 987674042, 'cameroonian', 'Mbingo', 'NORTH WES', 'bamenda', '2024-03-31 21:11:10'),
(30, 918522107, 'cameroonian', 'Mbingo', 'NORTH WES', 'bamenda', '2024-03-31 21:28:58'),
(31, 359488853, 'cameroonian', 'Mbingo', 'NORTH WES', 'Yaounde', '2024-04-04 21:56:54'),
(32, 791095543, 'cameroonian', 'Mbingo', 'NORTH WES', 'Yaounde', '2024-04-04 21:57:52'),
(33, 862502968, 'cameroonian', 'Mbingo', 'NORTH WES', 'Yaounde', '2024-04-04 21:58:20'),
(34, 193125778, 'cameroonian', 'Mbingo', 'NORTH WES', 'Yaounde', '2024-04-04 21:58:44'),
(35, 902314861, 'cameroonian', 'Mbingo', 'NORTH WES', 'Yaounde', '2024-04-04 21:59:18'),
(36, 687300341, 'cameroonian', 'Mbingo', 'CENTRE', 'Yaounde', '2024-04-05 19:00:23');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageid` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(250) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageid`, `fname`, `lname`, `email`, `message`, `status`) VALUES
(5, 'MUFOR', 'BELMOND', 'muforbelmond20@gmail.com', 'GOOD day sir i have been having difficulties submitting applications', 'read'),
(6, 'mike', 'willi', 'milli@gmail.com', 'pls i cant submit and application', 'read'),
(7, 'MUFOR', 'BELMOND', 'name@gmail.com', 'pls have my application been recieved?', 'read'),
(8, 'MUFOR', 'LAMANGO ', 'muforlamango@gmail.com', 'this is a great website', 'read'),
(9, 'MUFOR', 'BELMOND', 'muforbelmond20@gmail.com', 'hello boss ', 'read');

-- --------------------------------------------------------

--
-- Table structure for table `midwife`
--

CREATE TABLE `midwife` (
  `midwife_id` int(11) NOT NULL,
  `application_number` int(11) NOT NULL,
  `idcard_number` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `midwife_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `midwife`
--

INSERT INTO `midwife` (`midwife_id`, `application_number`, `idcard_number`, `nationality`, `midwife_name`, `phone`, `created_at`) VALUES
(148882100, 687300341, 'kit1114', 'cameroon', 'MARK', '672796256', '2024-04-05 19:00:23'),
(158194229, 862502968, 'KIT777', 'cameroon', 'MARK', '672796256', '2024-04-04 21:58:20'),
(402915856, 193125778, 'KIT777', 'cameroon', 'MARK', '672796256', '2024-04-04 21:58:44'),
(496630978, 902314861, 'KIT777', 'cameroon', 'MARK', '672796256', '2024-04-04 21:59:18'),
(576729755, 791095543, 'KIT777', 'cameroon', 'MARK', '672796256', '2024-04-04 21:57:52'),
(598458035, 918522107, 'kit1114', 'cameroon', 'MARK', '672796256', '2024-03-31 21:28:58'),
(763553015, 359488853, 'KIT777', 'cameroon', 'MARK', '672796256', '2024-04-04 21:56:54'),
(944294839, 987674042, 'kit1114', 'cameroon', 'MARK', '672796256', '2024-03-31 21:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `mothers_info`
--

CREATE TABLE `mothers_info` (
  `mother_id` varchar(30) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `mother_address` varchar(255) NOT NULL,
  `mother_place_of_birth` varchar(255) NOT NULL,
  `mother_subdivision` varchar(255) NOT NULL,
  `mother_dob` date NOT NULL,
  `mother_occupation` varchar(255) NOT NULL,
  `mother_phone` varchar(255) NOT NULL,
  `mother_email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mothers_info`
--

INSERT INTO `mothers_info` (`mother_id`, `mother_name`, `mother_address`, `mother_place_of_birth`, `mother_subdivision`, `mother_dob`, `mother_occupation`, `mother_phone`, `mother_email`, `created_at`) VALUES
('1234565432', 'lizzete njewseh', 'Yaounde', 'santa', 'santa', '1984-04-14', 'business', '672796256', 'muforbelmond20@gmail.com', '2024-04-04 21:58:20'),
('234342345453211', 'lizzete njewseh', 'Yaounde', 'santa', 'santa', '1984-04-14', 'business', '672796256', 'muforbelmond20@gmail.com', '2024-04-04 21:58:44'),
('3232434342322', 'lizzete njewseh', 'Yaounde', 'santa', 'santa', '1984-04-14', 'business', '672796256', 'muforbelmond20@gmail.com', '2024-04-04 21:59:18'),
('99008675', 'lizzete njewseh', 'Yaounde', 'santa', 'santa', '1984-04-14', 'business', '672796256', 'muforbelmond20@gmail.com', '2024-04-04 21:56:54'),
('990086751234', 'lizzete njewseh', 'Yaounde', 'santa', 'santa', '1984-04-14', 'business', '672796256', 'muforbelmond20@gmail.com', '2024-04-04 21:57:52'),
('kitt609', 'lizzete njewseh', 'bamenda', 'santa', 'santa', '1984-04-14', 'business', '675858221', 'lizzetenjewseh@omail.ai', '2024-03-31 21:28:58'),
('kitt675', 'lizzete njewseh', 'bamenda', 'santa', 'santa', '1984-04-14', 'business', '675858221', 'lizzetenjewseh@omail.ai', '2024-03-31 21:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `idcard` varchar(255) NOT NULL,
  `gender` text NOT NULL,
  `level` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `email`, `phone`, `idcard`, `gender`, `level`, `created_at`) VALUES
(11, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin@bcg.com', 'admin', 'admin', 'male', 1, '2024-04-05 19:16:45'),
(12, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin@bcg', 'admin', 'admin', 'male', 1, '2024-04-05 19:31:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`application_number`);

--
-- Indexes for table `birthcerticate`
--
ALTER TABLE `birthcerticate`
  ADD PRIMARY KEY (`birthcertificate_number`);

--
-- Indexes for table `child_info`
--
ALTER TABLE `child_info`
  ADD PRIMARY KEY (`child_id`);

--
-- Indexes for table `fathers_info`
--
ALTER TABLE `fathers_info`
  ADD PRIMARY KEY (`father_id`);

--
-- Indexes for table `issue_authority`
--
ALTER TABLE `issue_authority`
  ADD PRIMARY KEY (`issue_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageid`);

--
-- Indexes for table `midwife`
--
ALTER TABLE `midwife`
  ADD PRIMARY KEY (`midwife_id`);

--
-- Indexes for table `mothers_info`
--
ALTER TABLE `mothers_info`
  ADD PRIMARY KEY (`mother_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
