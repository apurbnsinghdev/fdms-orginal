-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2018 at 10:56 AM
-- Server version: 5.7.14
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fdmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `subject` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(260) COLLATE utf8_unicode_ci NOT NULL,
  `is_designation_wise` tinyint(1) NOT NULL DEFAULT '0',
  `designations` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sms`
--

INSERT INTO `sms` (`id`, `subject`, `message`, `is_designation_wise`, `designations`, `action`, `status`) VALUES
(1, 'complain_received_confirmation_SMS_for_shop_owner', 'Dear valuable customer your complain <!--df_problem--> has received by polar service department and we will take an action shortly. Thanks Polar Ice-cream', 0, NULL, 'problemEntry', 'active'),
(2, 'new_complain_SMS_for_teamleader', 'A new complain is come from <!--outlet_name--> Address: <!--address--> Frezzer coad: <!--df_code--> Size: <!--df_size--> Mobile: : <!--mobile--> Problem: <!--df_problem-->  Thanks <!--sender-->, <!--depot-->.', 1, '["12"]', 'problemEntry', 'active'),
(3, 'complain_SMS_for_assigned_technician', 'Shop name:<!--outlet_name-->. Address:<!--address-->. Frezzer Code:<!--df_code-->. Size:<!--df_size-->. Mobile:<!--mobile--> Problem:<!--df_problem-->. Thanks <!--sender-->, <!--depot-->.', 0, NULL, 'assignTechnician', 'active'),
(4, 'complain_resolved_SMS_for_shop_owner', 'Dear valuable customer your complain <!--df_problem-->  has resolved by polar service department and further clarification please let us know. Thanks Polar Ice-cream.', 0, NULL, 'problemEntryEdit_1', 'active'),
(5, 'need_to_pull_sms_for_shop_owner', 'Dear valuable customer your complain <!--df_problem--> has not resolved on spot and need to pulled up into our workshop. Polar responsible person contact with you soon. Thanks Polar Ice-cream.', 0, NULL, 'problemEntryEdit_2', 'active'),
(6, 'requisition_final_approved_SMS_for_shop_owner', 'Dear valuable customer, your requisition for new DF has approved from polar mgt. and respected officer will contact with you shortly. Thanks Polar Ice-cream.', 0, NULL, 'requisition_approve', 'active'),
(7, 'requisition_final_approved_SMS_for_management', 'Your requisition for new DF has approved for the <!--outlet_name-->. Take your necessary steps.', 1, '["1","7"]', 'requisition_approve', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
