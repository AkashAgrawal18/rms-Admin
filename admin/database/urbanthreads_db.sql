-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2023 at 02:10 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `urbanthreads_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_settings`
--

CREATE TABLE `application_settings` (
  `m_app_id` int(11) NOT NULL,
  `m_app_name` varchar(200) NOT NULL,
  `m_app_title` varchar(200) NOT NULL,
  `m_app_icon` varchar(200) NOT NULL,
  `m_app_logo` varchar(200) NOT NULL,
  `m_app_white_logo` varchar(200) NOT NULL,
  `m_app_black_logo` varchar(200) NOT NULL,
  `m_app_banner` varchar(200) NOT NULL,
  `m_app_email` varchar(200) NOT NULL,
  `m_app_mobile` varchar(20) NOT NULL,
  `m_app_alt_mobile` varchar(20) NOT NULL,
  `m_app_keywords` text NOT NULL,
  `m_app_description` text NOT NULL,
  `m_app_fb` varchar(200) NOT NULL DEFAULT '#',
  `m_app_insta` varchar(200) NOT NULL DEFAULT '#',
  `m_app_youtube` varchar(200) NOT NULL DEFAULT '#',
  `m_app_linkedin` varchar(200) NOT NULL DEFAULT '#',
  `m_app_twitter` varchar(200) NOT NULL,
  `m_app_whatsapp` varchar(200) DEFAULT NULL,
  `m_app_status` double NOT NULL,
  `m_app_country` varchar(200) NOT NULL,
  `m_app_version` double NOT NULL,
  `m_agent_app_version` double NOT NULL,
  `m_app_website` varchar(200) NOT NULL,
  `m_app_address` text NOT NULL,
  `m_app_timezone` varchar(200) NOT NULL,
  `m_app_date_format` varchar(200) NOT NULL,
  `m_app_time_format` varchar(200) NOT NULL,
  `m_app_language` varchar(200) NOT NULL,
  `m_app_currency` varchar(200) NOT NULL,
  `paid_listing_added_amt` double NOT NULL,
  `agent_daily_milestone` double NOT NULL,
  `daily_milestone_amount` double NOT NULL,
  `agent_order_commision` double NOT NULL,
  `agent_referral_perc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `application_settings`
--

INSERT INTO `application_settings` (`m_app_id`, `m_app_name`, `m_app_title`, `m_app_icon`, `m_app_logo`, `m_app_white_logo`, `m_app_black_logo`, `m_app_banner`, `m_app_email`, `m_app_mobile`, `m_app_alt_mobile`, `m_app_keywords`, `m_app_description`, `m_app_fb`, `m_app_insta`, `m_app_youtube`, `m_app_linkedin`, `m_app_twitter`, `m_app_whatsapp`, `m_app_status`, `m_app_country`, `m_app_version`, `m_agent_app_version`, `m_app_website`, `m_app_address`, `m_app_timezone`, `m_app_date_format`, `m_app_time_format`, `m_app_language`, `m_app_currency`, `paid_listing_added_amt`, `agent_daily_milestone`, `daily_milestone_amount`, `agent_order_commision`, `agent_referral_perc`) VALUES
(1, 'Lead Helper', 'Lead Helper', 'rocket1.png', 'lead-01.png', 'lead-02.png', 'lead-012.png', 'logo-main3.jpg', 'enquiry@leadhelper.in', '+91 9343228104', '+91 7879122070', 'PolyBond', 'Durg', 'https://www.facebook.com/', 'https://instagram.com/leadhelper_crm?igshid=OGQ5ZDc2ODk2ZA==', 'https://www.youtube.com/', 'https://in.linkedin.comm/', 'https://twitter.com/i/flow/login/', 'https://web.whatsapp.com/', 0, 'India', 5, 1, '', 'Head Office:\r\nPlot No 3, Maitri Kunj, Risali, Bhilai, Chhattisgarh (490006)', 'Asia/Kolkata', 'DD/MM/YY', '24 Hours', '', '', 0, 0, 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `data` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_admin_tbl`
--

CREATE TABLE `master_admin_tbl` (
  `m_admin_id` int(11) NOT NULL,
  `m_admin_login_id` tinytext DEFAULT NULL,
  `m_admin_pass` tinytext DEFAULT NULL,
  `m_admin_name` tinytext DEFAULT NULL,
  `m_admin_email` tinytext DEFAULT NULL,
  `m_admin_contact` varchar(200) DEFAULT NULL,
  `m_admin_img` tinytext DEFAULT NULL,
  `m_admin_address` text NOT NULL,
  `m_admin_state` varchar(100) NOT NULL,
  `m_admin_city` varchar(100) NOT NULL,
  `m_admin_pincode` varchar(10) NOT NULL,
  `m_admin_status` tinyint(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_admin_tbl`
--

INSERT INTO `master_admin_tbl` (`m_admin_id`, `m_admin_login_id`, `m_admin_pass`, `m_admin_name`, `m_admin_email`, `m_admin_contact`, `m_admin_img`, `m_admin_address`, `m_admin_state`, `m_admin_city`, `m_admin_pincode`, `m_admin_status`) VALUES
(1, 'admin', '12345', 'Admin', 'admin@gmail.com', '1234567890', 'h-icon1.png', 'Durg', 'chhattisgarh', 'Durg', '491881', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_users_tbl`
--

CREATE TABLE `master_users_tbl` (
  `m_user_id` bigint(20) NOT NULL,
  `m_user_name` varchar(200) NOT NULL,
  `m_user_mobile` varchar(200) NOT NULL,
  `m_user_type` tinyint(1) NOT NULL COMMENT '1-admin, 2-User , 3- customer , 4-supplier',
  `m_user_image` text NOT NULL,
  `m_user_email` varchar(200) NOT NULL,
  `m_user_parent_id` bigint(20) NOT NULL COMMENT 'master_users_tbl se',
  `m_user_parent_name` varchar(50) NOT NULL,
  `m_user_gst_no` varchar(50) NOT NULL,
  `m_user_design` int(11) NOT NULL COMMENT 'master_designation_tbl se',
  `m_user_state` bigint(20) NOT NULL,
  `m_user_city` bigint(20) NOT NULL,
  `m_user_address` text NOT NULL,
  `m_user_loginid` varchar(50) NOT NULL,
  `m_user_password` varchar(50) NOT NULL,
  `m_user_added_by` bigint(20) NOT NULL COMMENT 'master_user_tbl se',
  `m_user_updated_by` bigint(20) NOT NULL COMMENT 'master_user_tbl se',
  `m_user_updated_on` datetime NOT NULL,
  `m_user_login_allow` tinyint(1) NOT NULL COMMENT '1- yes , 2- no',
  `m_user_added_on` datetime NOT NULL,
  `m_user_status` int(11) NOT NULL COMMENT ' 1 = Enabled, 2 = Disabled',
  `m_user_text_num` varchar(100) NOT NULL,
  `m_user_open_balance` float NOT NULL,
  `m_user_credit_period` float NOT NULL,
  `m_user_credit_limit` float NOT NULL,
  `m_user_saddress` text NOT NULL,
  `m_user_department` varchar(50) NOT NULL,
  `m_user_hodName` varchar(100) NOT NULL,
  `m_user_hodContact` bigint(20) NOT NULL,
  `m_user_hiName` varchar(100) NOT NULL,
  `m_user_hiContact` bigint(20) NOT NULL,
  `m_user_companyName` varchar(100) NOT NULL,
  `m_user_contractPerd` varchar(50) NOT NULL,
  `m_user_siContact` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_users_tbl`
--

INSERT INTO `master_users_tbl` (`m_user_id`, `m_user_name`, `m_user_mobile`, `m_user_type`, `m_user_image`, `m_user_email`, `m_user_parent_id`, `m_user_parent_name`, `m_user_gst_no`, `m_user_design`, `m_user_state`, `m_user_city`, `m_user_address`, `m_user_loginid`, `m_user_password`, `m_user_added_by`, `m_user_updated_by`, `m_user_updated_on`, `m_user_login_allow`, `m_user_added_on`, `m_user_status`, `m_user_text_num`, `m_user_open_balance`, `m_user_credit_period`, `m_user_credit_limit`, `m_user_saddress`, `m_user_department`, `m_user_hodName`, `m_user_hodContact`, `m_user_hiName`, `m_user_hiContact`, `m_user_companyName`, `m_user_contractPerd`, `m_user_siContact`) VALUES
(1, 'Admin', '9608451051', 1, 'user2.png', 'admin@gmail.com', 0, 'admin', '', 1, 0, 0, 'Bhilai', 'admin@gmail.com', '12345', 1, 1, '2023-03-16 15:58:18', 1, '2023-03-16 15:49:19', 1, '', 0, 0, 0, '', '', '', 0, '', 0, '', '', 0),
(3, 'saman rajak1', '5345312345', 4, '2.jpg', 'sman1@gmail.com', 0, '', '', 4, 0, 0, 'raipur', 'sman1@gmail.com', '12345', 0, 0, '2023-12-01 03:51:01', 1, '2023-12-01 03:44:57', 1, '12', 100, 10, 0, '  raipur', '', '', 0, '', 0, '', '', 0),
(4, 'daman rajak', '3243242343', 3, '21.jpg', 'daman@gmail.com', 0, '', '', 3, 0, 0, 'raipur', 'daman@gmail.com', '12345', 0, 0, '0000-00-00 00:00:00', 1, '2023-12-01 03:55:47', 1, '12', 100, 10, 100, 'raipur', '', '', 0, '', 0, '', '', 0),
(6, 'akash', '1234567892', 4, '', 'adj@gmail.com', 0, '', '', 0, 0, 0, 'hdjhvbhsbnjvks', '', '', 1, 0, '0000-00-00 00:00:00', 1, '2023-12-01 18:14:51', 1, '', 0, 0, 0, '', '', '', 0, '', 0, '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application_settings`
--
ALTER TABLE `application_settings`
  ADD PRIMARY KEY (`m_app_id`);

--
-- Indexes for table `master_admin_tbl`
--
ALTER TABLE `master_admin_tbl`
  ADD PRIMARY KEY (`m_admin_id`);

--
-- Indexes for table `master_users_tbl`
--
ALTER TABLE `master_users_tbl`
  ADD PRIMARY KEY (`m_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application_settings`
--
ALTER TABLE `application_settings`
  MODIFY `m_app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_admin_tbl`
--
ALTER TABLE `master_admin_tbl`
  MODIFY `m_admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_users_tbl`
--
ALTER TABLE `master_users_tbl`
  MODIFY `m_user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
