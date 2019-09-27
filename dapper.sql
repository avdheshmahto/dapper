-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 27, 2019 at 11:08 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dapper`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_mst`
--

CREATE TABLE `tbl_account_mst` (
  `account_id` int(11) NOT NULL,
  `account_name` varchar(200) DEFAULT NULL,
  `main_account_id` int(11) DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_account_mst`
--

INSERT INTO `tbl_account_mst` (`account_id`, `account_name`, `main_account_id`, `status`, `maker_id`, `author_id`, `maker_date`, `author_date`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(4, 'Buyer', 1, 'A', '21', '21', '2016-04-08', '2016-04-08', '1', '1', '1', '1'),
(5, 'Vendor', 1, 'A', '21', '21', '2016-04-08', '2016-04-08', '1', '1', '1', '1'),
(6, 'Employee', 1, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'consignee', 1, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assemble_fg`
--

CREATE TABLE `tbl_assemble_fg` (
  `id` int(11) NOT NULL,
  `lot_no` varchar(200) DEFAULT NULL,
  `job_order_no` varchar(200) DEFAULT NULL,
  `grn_no` varchar(200) DEFAULT NULL,
  `grn_date` varchar(200) DEFAULT NULL,
  `product_id` varchar(200) DEFAULT NULL,
  `fg_id` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_date` date NOT NULL,
  `author_id` varchar(200) NOT NULL,
  `author_date` date NOT NULL,
  `order_type` varchar(200) DEFAULT NULL,
  `module_name` varchar(200) DEFAULT NULL,
  `status` varchar(200) NOT NULL,
  `comp_id` varchar(200) NOT NULL,
  `zone_id` varchar(200) NOT NULL,
  `brnh_id` varchar(200) NOT NULL,
  `divn_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_assemble_fg`
--

INSERT INTO `tbl_assemble_fg` (`id`, `lot_no`, `job_order_no`, `grn_no`, `grn_date`, `product_id`, `fg_id`, `qty`, `maker_id`, `maker_date`, `author_id`, `author_date`, `order_type`, `module_name`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '001', '4', 'GRN001', '2019-06-25', '44', '56', '1', '', '2019-06-25', '', '2019-06-25', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(2, '001', '4', 'GRN001', '2019-06-25', '45', '56', '1', '', '2019-06-25', '', '2019-06-25', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(3, '001', '4', 'grn001', '2019-07-03', '44', '57', '2', '', '2019-07-03', '', '2019-07-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(4, '001', '4', 'grn001', '2019-07-03', '45', '57', '3', '', '2019-07-03', '', '2019-07-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(5, '001', '4', '354', '2019-08-17', '44', '57', '5', '', '2019-08-03', '', '2019-08-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(6, '001', '4', '354', '2019-08-17', '44', '57', '5', '', '2019-08-03', '', '2019-08-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(7, '001', '4', '354', '2019-08-17', '45', '57', '6', '', '2019-08-03', '', '2019-08-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(8, '001', '4', '354', '2019-08-17', '44', '57', '5', '', '2019-08-03', '', '2019-08-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(9, '001', '4', '354', '2019-08-17', '45', '57', '6', '', '2019-08-03', '', '2019-08-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(10, '001', '4', '354', '2019-08-17', '44', '57', '5', '', '2019-08-03', '', '2019-08-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(11, '001', '4', '354', '2019-08-17', '45', '57', '6', '', '2019-08-03', '', '2019-08-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(12, '001', '4', '354', '2019-08-17', '44', '57', '5', '', '2019-08-03', '', '2019-08-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(13, '001', '4', '354', '2019-08-17', '45', '57', '6', '', '2019-08-03', '', '2019-08-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(14, '001', '4', '354', '2019-08-17', '44', '57', '5', '', '2019-08-03', '', '2019-08-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(15, '001', '4', '354', '2019-08-17', '45', '57', '6', '', '2019-08-03', '', '2019-08-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(16, '001', '4', '354', '2019-08-17', '44', '57', '5', '', '2019-08-03', '', '2019-08-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(17, '001', '4', '354', '2019-08-17', '45', '57', '6', '', '2019-08-03', '', '2019-08-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(18, '001', '4', '354', '2019-08-17', '44', '57', '5', '', '2019-08-03', '', '2019-08-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(19, '001', '4', '354', '2019-08-17', '45', '57', '6', '', '2019-08-03', '', '2019-08-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(20, '001', '4', '354354', '2019-08-10', '44', '56', '88', '', '2019-08-03', '', '2019-08-03', 'Finish Order', 'Finish Order', '', '1', '1', '', ''),
(21, '001', '4', '354354', '2019-08-10', '45', '56', '7', '', '2019-08-03', '', '2019-08-03', 'Finish Order', 'Finish Order', '', '1', '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `grade` varchar(50) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `inside_cat` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `create_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `grade`, `type`, `inside_cat`, `status`, `create_on`) VALUES
(8, 'Brass Ingots', '', 13, 0, 1, '2018-10-16'),
(9, 'Cast Brass', '', 32, 0, 1, '2018-10-16'),
(10, 'Artisan', '', 33, 0, 1, '2018-10-16'),
(11, 'Velvet Bag', '', 35, 0, 1, '2018-10-16'),
(12, 'Velvet Box', '', 35, 0, 1, '2018-10-16'),
(13, 'Velvet Box S/6', '', 35, 0, 1, '2018-10-16'),
(14, 'Classic', '', 33, 0, 1, '2018-10-22'),
(15, 'Rose Keepsake', '', 33, 0, 1, '2018-10-22'),
(16, 'Sheet Brass', '', 32, 0, 1, '2018-10-22'),
(17, 'Cast Aluminium', '', 32, 0, 1, '2018-10-22'),
(18, 'Aluminium Ingots', '', 13, 0, 1, '2018-10-22'),
(19, 'Sheet Brass Circle', '', 13, 0, 1, '2018-10-22'),
(20, 'Thera', '', 33, 0, 1, '2019-07-09'),
(21, 'Apple Paper Weight', '', 33, 0, 1, '2019-07-15'),
(22, 'Casted Heart', '', 33, 0, 1, '2019-07-15'),
(23, 'Sheet Heart', '', 33, 0, 1, '2019-07-16'),
(24, 'Avalon Large', '', 33, 0, 1, '2019-07-25'),
(25, 'DomTop Petite', '', 33, 0, 1, '2019-07-25'),
(26, 'Songbird', '', 33, 0, 1, '2019-07-25'),
(27, 'Elite Keepsake', '', 33, 0, 1, '2019-07-25'),
(28, 'Grecian', '', 33, 0, 1, '2019-07-29'),
(29, 'Cat', '', 33, 0, 1, '2019-07-29'),
(30, 'Odyssey Small ', '', 33, 0, 1, '2019-07-29'),
(31, 'Satori Large', '', 33, 0, 1, '2019-07-29'),
(32, 'Legacy', '', 33, 0, 1, '2019-07-29'),
(33, 'Votive', '', 33, 0, 1, '2019-07-29'),
(34, 'Domtop Medium', '', 33, 0, 1, '2019-07-29'),
(35, 'Domtop Small', '', 33, 0, 1, '2019-07-29'),
(36, 'Domtop Ex. Small', '', 33, 0, 1, '2019-07-29'),
(37, 'Domtop Keepsake', '', 33, 0, 1, '2019-07-30'),
(38, 'Odyssey Petite', '', 33, 0, 1, '2019-07-30'),
(39, 'Mixture', '', 32, 0, 1, '2019-07-30'),
(40, 'Satori Keepsake', '', 33, 0, 1, '2019-07-30'),
(41, 'Classic Medium', '', 33, 0, 1, '2019-07-30'),
(42, 'Legacy Large', '', 33, 0, 1, '2019-07-31'),
(43, 'Legacy Keepsake', '', 33, 0, 1, '2019-07-31'),
(44, 'Legacy Votive', '', 33, 0, 1, '2019-07-31'),
(45, 'Aluminum Sheet Circle', '', 13, 0, 1, '2019-07-31'),
(46, 'Aluminium Pipe', '', 13, 0, 1, '2019-07-31'),
(47, 'Pipe Aluminium', '', 32, 0, 1, '2019-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_m`
--

CREATE TABLE `tbl_contact_m` (
  `contact_id` int(11) NOT NULL,
  `code` varchar(200) DEFAULT NULL,
  `addres_id` varchar(200) DEFAULT NULL,
  `first_name` varchar(200) DEFAULT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `vendor_type` varchar(200) DEFAULT NULL,
  `mappedConsignee` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `mobile` varchar(200) DEFAULT NULL,
  `address1` text DEFAULT NULL,
  `address3` text DEFAULT NULL,
  `finalDestination` varchar(300) DEFAULT NULL,
  `countryDestination` varchar(300) DEFAULT NULL,
  `portDischarge` varchar(300) DEFAULT NULL,
  `state_id` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `pincode` varchar(200) DEFAULT NULL,
  `opening_balance` varchar(255) DEFAULT NULL,
  `previous_balance` varchar(255) DEFAULT NULL,
  `transport` varchar(255) DEFAULT NULL,
  `station` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `IT_Pan` varchar(255) DEFAULT NULL,
  `gst` varchar(255) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contact_m`
--

INSERT INTO `tbl_contact_m` (`contact_id`, `code`, `addres_id`, `first_name`, `group_name`, `vendor_type`, `mappedConsignee`, `last_name`, `email`, `phone`, `mobile`, `address1`, `address3`, `finalDestination`, `countryDestination`, `portDischarge`, `state_id`, `city`, `pincode`, `opening_balance`, `previous_balance`, `transport`, `station`, `contact_person`, `IT_Pan`, `gst`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, 'CU01', '', 'Terrybear Inc.', '4', '', '2,3', '', '', '', '', '946 W. PIERCE BUTLER ROUTE,SUITE 101,\r\nDOCKS 1-3, ST.PAUL, MN 55104, [USA]\r\nTEL : 651-641-9579 FAX : 651-917-3560', ' ', '', '', '', '', 'Minneapolis', '', '', '', '', '', '', '', '', '1', '2018-10-08', '1', '2018-10-08', 'A', '1', '1', '1', '1'),
(2, 'CN01', '', 'Terrybear Inc.', '7', '', NULL, '', '', '', '', ' ', ' ', 'Saint Paul', 'USA', 'New York', '', 'Minneapolis', '', '', '', '', '', '', '', '', '1', '2018-10-08', '1', '2018-10-08', 'A', '1', '1', '1', '1'),
(3, 'CN02', '', 'American Funeral Services', '7', '', NULL, '', '', '', '', ' ', ' ', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2018-10-08', '1', '2018-10-08', 'A', '1', '1', '1', '1'),
(4, 'PD02', '', 'Nazim Hussain', '5', '', NULL, '', '', '', '', ' ', ' ', '', '', '', '09', 'Moradabad', '244001', '', '', '', '', '', '', '', '1', '2018-10-08', '1', '2018-10-08', 'A', '1', '1', '1', '1'),
(5, 'PD01', '', 'DE Casting Unit', '5', '', NULL, '', '', '', '', ' ', ' ', '', '', '', '09', 'Moradabad', '244001', '', '', '', '', '', '', '', '1', '2018-10-08', '1', '2018-10-08', 'A', '1', '1', '1', '1'),
(6, 'PD03', '', 'DE Sheet Unit', '5', '', NULL, '', '', '', '', ' ', ' ', '', '', '', '09', 'Moradabad', '244001', '', '', '', '', '', '', '', '1', '2018-10-08', '1', '2018-10-08', 'A', '1', '1', '1', '1'),
(7, 'SI01', '', 'Pervez', '5', '', NULL, '', '', '', '', ' ', ' ', '', '', '', '09', 'Moradabad', '244001', '', '', '', '', '', '', '', '1', '2018-10-08', '1', '2018-10-08', 'A', '1', '1', '1', '1'),
(8, 'SI10', '', 'Mallu Bhai', '5', '', NULL, '', '', '', '', ' ', ' ', '', '', '', '09', 'Moradabad', '244001', '', '', '', '', '', '', '', '1', '2018-10-08', '1', '2018-10-08', 'A', '1', '1', '1', '1'),
(9, 'SS06', '', 'Vallabh Bhairav', '5', '', NULL, '', '', '', '', ' ', ' ', '', '', '', '09', 'Moradabad', '244001', '', '', '', '', '', '', '', '1', '2018-10-08', '1', '2018-10-08', 'A', '1', '1', '1', '1'),
(10, 'KP01', '', 'Ghanshyam', '5', '', NULL, '', '', '', '', ' ', ' ', '', '', '', '', 'Moradabad', '', '', '', '', '', '', '', '', '1', '2018-10-08', '1', '2018-10-08', 'A', '1', '1', '1', '1'),
(11, 'KP02', '', 'Engraver 1', '5', '', NULL, '', '', '', '', ' ', ' ', '', '', '', '09', 'Moradabad', '', '', '', '', '', '', '', '', '1', '2018-10-08', '1', '2018-10-08', 'A', '1', '1', '1', '1'),
(12, 'FP01', '', 'Finisher Paint', '5', 'Raw Material', NULL, '', '', '', '', ' ', ' ', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2018-10-08', '1', '2018-10-08', 'A', '1', '1', '1', '1'),
(13, 'FP02', '', 'Finisher Plating', '5', 'Production', NULL, '', '', '', '', ' ', ' ', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2018-10-08', '1', '2018-10-08', 'A', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grn_return_dtl`
--

CREATE TABLE `tbl_grn_return_dtl` (
  `grndtl` int(11) NOT NULL,
  `po_no` varchar(200) DEFAULT NULL,
  `grnhdr` int(11) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `return_qty` varchar(200) DEFAULT NULL,
  `return_weight` varchar(200) DEFAULT NULL,
  `receive_qty` varchar(200) DEFAULT NULL,
  `receive_weight` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grn_return_dtl`
--

INSERT INTO `tbl_grn_return_dtl` (`grndtl`, `po_no`, `grnhdr`, `productid`, `return_qty`, `return_weight`, `receive_qty`, `receive_weight`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '3', 1, '2', '1', '1', '198.503', '25', '1', NULL, '2019-05-06', NULL, 'A', '1', '1', '1', NULL),
(2, '1', 2, '71', '1', '1', '270', '200', '1', NULL, '2019-05-06', NULL, 'A', '1', '1', '1', NULL),
(3, '1', 3, '71', '2', '2', '270', '200', '1', NULL, '2019-05-06', NULL, 'A', '1', '1', '1', NULL),
(4, '1', 4, '71', '3', '3', '270', '200', '1', NULL, '2019-05-06', NULL, 'A', '1', '1', '1', NULL),
(5, '1', 5, '71', '4', '4', '270', '200', '1', NULL, '2019-05-06', NULL, 'A', '1', '1', '1', NULL),
(6, '3', 6, '2', '4', '4', '198.503', '25', '1', NULL, '2019-05-06', NULL, 'A', '1', '1', '1', NULL),
(7, '3', 7, '2', '1', '1', '198.503', '25', '1', NULL, '2019-05-06', NULL, 'A', '1', '1', '1', NULL),
(8, '3', 8, '2', '1', '10', '198.503', '25', '1', NULL, '2019-05-07', NULL, 'A', '1', '1', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grn_return_hdr`
--

CREATE TABLE `tbl_grn_return_hdr` (
  `grnhdr` int(11) NOT NULL,
  `po_no` varchar(200) DEFAULT NULL,
  `return_date` varchar(200) DEFAULT NULL,
  `return_no` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grn_return_hdr`
--

INSERT INTO `tbl_grn_return_hdr` (`grnhdr`, `po_no`, `return_date`, `return_no`, `maker_id`, `maker_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '3', '', '', '1', '2019-05-06', 'A', '1', '1', '1', '1'),
(2, '1', '', '', '1', '2019-05-06', 'A', '1', '1', '1', '1'),
(3, '1', '', '', '1', '2019-05-06', 'A', '1', '1', '1', '1'),
(4, '1', '', '', '1', '2019-05-06', 'A', '1', '1', '1', '1'),
(5, '1', '', '', '1', '2019-05-06', 'A', '1', '1', '1', '1'),
(6, '3', '', '', '1', '2019-05-06', 'A', '1', '1', '1', '1'),
(7, '3', '', '', '1', '2019-05-06', 'A', '1', '1', '1', '1'),
(8, '3', '2019-05-07', 'rt001', '1', '2019-05-07', 'A', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inbound_dtl`
--

CREATE TABLE `tbl_inbound_dtl` (
  `inbound_dtl_id` int(11) NOT NULL,
  `inboundrhdr` int(11) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `receive_qty` varchar(200) DEFAULT NULL,
  `qn_pc` varchar(200) DEFAULT NULL,
  `remaining_qty` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_inbound_dtl`
--

INSERT INTO `tbl_inbound_dtl` (`inbound_dtl_id`, `inboundrhdr`, `productid`, `receive_qty`, `qn_pc`, `remaining_qty`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, 1, '71', '130', '100', '274', '1', NULL, '2019-03-07', NULL, 'A', '1', '1', '1', NULL),
(2, 2, '1', '230.854', '33', '500', '1', NULL, '2019-03-07', NULL, 'A', '1', '1', '1', NULL),
(3, 2, '69', '170.623', '22', '500', '1', NULL, '2019-03-07', NULL, 'A', '1', '1', '1', NULL),
(4, 3, '2', '198.503', '25', '200', '1', NULL, '2019-03-07', NULL, 'A', '1', '1', '1', NULL),
(5, 4, '71', '140', '100', '144', '1', NULL, '2019-03-13', NULL, 'A', '1', '1', '1', NULL),
(6, 5, '71', '136', '100', '137', '1', NULL, '2019-03-25', NULL, 'A', '1', '1', '1', NULL),
(7, 6, '71', '1', '1', '1', '1', NULL, '2019-05-06', NULL, 'A', '1', '1', '1', NULL),
(8, 7, '71', '1', '1', '1', '1', NULL, '2019-05-06', NULL, 'A', '1', '1', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inbound_hdr`
--

CREATE TABLE `tbl_inbound_hdr` (
  `inboundid` int(11) NOT NULL,
  `storage_location` varchar(200) DEFAULT NULL,
  `po_no` varchar(200) DEFAULT NULL,
  `grn_date` varchar(200) DEFAULT NULL,
  `grn_no` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_inbound_hdr`
--

INSERT INTO `tbl_inbound_hdr` (`inboundid`, `storage_location`, `po_no`, `grn_date`, `grn_no`, `date`, `maker_id`, `maker_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '0', '1', '2019-03-07', 'RG001', '', '1', '2019-03-07', 'A', '1', '1', '1', '1'),
(2, '0', '2', '2019-03-07', 'RG002', '', '1', '2019-03-07', 'A', '1', '1', '1', '1'),
(3, '0', '3', '2019-03-07', 'RG003', '', '1', '2019-03-07', 'A', '1', '1', '1', '1'),
(4, '0', '1', '2019-03-13', 'RG004', '', '1', '2019-03-13', 'A', '1', '1', '1', '1'),
(5, '0', '4', '2019-03-26', 'RG005', '', '1', '2019-03-25', 'A', '1', '1', '1', '1'),
(6, '0', '4', '2019-05-07', '2432432', '', '1', '2019-05-06', 'A', '1', '1', '1', '1'),
(7, '0', '4', '2019-05-07', '2432432', '', '1', '2019-05-06', 'A', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inbound_log`
--

CREATE TABLE `tbl_inbound_log` (
  `inbound_dtl_id` int(11) NOT NULL,
  `inboundrhdr` int(11) DEFAULT NULL,
  `po_no` varchar(200) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `grn_no` varchar(200) DEFAULT NULL,
  `grn_date` varchar(200) DEFAULT NULL,
  `receive_qty` varchar(200) DEFAULT NULL,
  `qn_pc` varchar(200) DEFAULT NULL,
  `outboundqty` int(11) DEFAULT NULL,
  `clear_status` tinyint(1) NOT NULL DEFAULT 0,
  `remaining_qty` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_inbound_log`
--

INSERT INTO `tbl_inbound_log` (`inbound_dtl_id`, `inboundrhdr`, `po_no`, `productid`, `grn_no`, `grn_date`, `receive_qty`, `qn_pc`, `outboundqty`, `clear_status`, `remaining_qty`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, 1, '1', '71', 'RG001', '2019-03-07', '130', '100', 0, 0, '274', '1', NULL, '2019-03-07', NULL, 'A', '1', '1', '1', NULL),
(2, 2, '2', '1', 'RG002', '2019-03-07', '230.854', '33', 0, 0, '500', '1', NULL, '2019-03-07', NULL, 'A', '1', '1', '1', NULL),
(3, 2, '2', '69', 'RG002', '2019-03-07', '170.623', '22', 0, 0, '500', '1', NULL, '2019-03-07', NULL, 'A', '1', '1', '1', NULL),
(4, 3, '3', '2', 'RG003', '2019-03-07', '198.503', '25', 0, 0, '200', '1', NULL, '2019-03-07', NULL, 'A', '1', '1', '1', NULL),
(5, 4, '1', '71', 'RG004', '2019-03-13', '140', '100', 0, 0, '144', '1', NULL, '2019-03-13', NULL, 'A', '1', '1', '1', NULL),
(6, 5, '4', '71', 'RG005', '2019-03-26', '136', '100', 0, 0, '137', '1', NULL, '2019-03-25', NULL, 'A', '1', '1', '1', NULL),
(7, 6, '4', '71', '2432432', '2019-05-07', '1', '1', 0, 0, '1', '1', NULL, '2019-05-06', NULL, 'A', '1', '1', '1', NULL),
(8, 7, '4', '71', '2432432', '2019-05-07', '1', '1', 0, 0, '1', '1', NULL, '2019-05-06', NULL, 'A', '1', '1', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_issuematrial_dtl`
--

CREATE TABLE `tbl_issuematrial_dtl` (
  `inbound_dtl_id` int(11) NOT NULL,
  `inboundrhdr` int(11) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `receive_qty` varchar(200) DEFAULT NULL,
  `order_qty` varchar(200) DEFAULT NULL,
  `rem_order_qty` varchar(200) DEFAULT NULL,
  `remaining_qty` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_issuematrial_dtl`
--

INSERT INTO `tbl_issuematrial_dtl` (`inbound_dtl_id`, `inboundrhdr`, `productid`, `receive_qty`, `order_qty`, `rem_order_qty`, `remaining_qty`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, 1, '71', '234.75', '150', '150', '234.75', '1', NULL, '2019-03-12', NULL, 'A', '1', '1', '1', NULL),
(2, 2, '71', '225.36', '144', '144', '224', '1', NULL, '2019-03-25', NULL, 'A', '1', '1', '1', NULL),
(3, 3, '1', '2.86', '22', '', '', '1', NULL, '2019-05-25', NULL, 'A', '1', '1', '1', NULL),
(4, 3, '2', '1.54', '22', '', '', '1', NULL, '2019-05-25', NULL, 'A', '1', '1', '1', NULL),
(5, 3, '69', '14.388', '22', '', '', '1', NULL, '2019-05-25', NULL, 'A', '1', '1', '1', NULL),
(6, 3, '71', '75.35', '22', '', '', '1', NULL, '2019-05-25', NULL, 'A', '1', '1', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_issuematrial_hdr`
--

CREATE TABLE `tbl_issuematrial_hdr` (
  `inboundid` int(11) NOT NULL,
  `storage_location` varchar(200) DEFAULT NULL,
  `po_no` varchar(200) DEFAULT NULL,
  `request_no` varchar(200) DEFAULT NULL,
  `grn_date` varchar(200) DEFAULT NULL,
  `grn_no` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `lot_no` varchar(200) DEFAULT NULL,
  `job_order_no` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'Open',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_issuematrial_hdr`
--

INSERT INTO `tbl_issuematrial_hdr` (`inboundid`, `storage_location`, `po_no`, `request_no`, `grn_date`, `grn_no`, `date`, `lot_no`, `job_order_no`, `maker_id`, `maker_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '', '1', 'req001', '', '', '2019-03-12', '001', 'JO-001', '1', '2019-03-12', '2', '1', '1', '1', '1'),
(2, '', '3', 'RMR-002', '', '', '2019-03-25', '001', 'JO-002', '1', '2019-03-25', '3', '1', '1', '1', '1'),
(3, '', '14', 'rm001', '', '', '2019-05-25', '002', 'JOB0098', '1', '2019-05-25', 'A', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_issue_raw_materail`
--

CREATE TABLE `tbl_issue_raw_materail` (
  `id` int(11) NOT NULL,
  `product_id` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_purchase_order_return`
--

CREATE TABLE `tbl_job_purchase_order_return` (
  `id` int(11) NOT NULL,
  `lot_no` varchar(200) DEFAULT NULL,
  `order_no` varchar(200) DEFAULT NULL,
  `job_order_id` varchar(200) DEFAULT NULL,
  `vendor_id` varchar(200) DEFAULT NULL,
  `production_id` varchar(200) DEFAULT NULL,
  `return_no` varchar(200) DEFAULT NULL,
  `return_date` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `part_id` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `order_type` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `comp_id` varchar(200) NOT NULL,
  `zone_id` varchar(200) NOT NULL,
  `brnh_id` varchar(200) NOT NULL,
  `divn_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_job_purchase_order_return`
--

INSERT INTO `tbl_job_purchase_order_return` (`id`, `lot_no`, `order_no`, `job_order_id`, `vendor_id`, `production_id`, `return_no`, `return_date`, `date`, `part_id`, `qty`, `maker_id`, `maker_date`, `author_id`, `author_date`, `order_type`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '002', 'pur001', '27', '4', '', 'return001', '2019-05-24', '', '25', '1', '1', '2019-05-24', '', '0000-00-00', '', 'A', '1', '1', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_rm_return`
--

CREATE TABLE `tbl_job_rm_return` (
  `id` int(11) NOT NULL,
  `lot_no` varchar(200) DEFAULT NULL,
  `order_no` varchar(200) DEFAULT NULL,
  `job_order_id` varchar(200) DEFAULT NULL,
  `vendor_id` varchar(200) DEFAULT NULL,
  `production_id` varchar(200) DEFAULT NULL,
  `return_no` varchar(200) DEFAULT NULL,
  `return_date` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `order_qty` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `order_type` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `comp_id` varchar(200) NOT NULL,
  `zone_id` varchar(200) NOT NULL,
  `brnh_id` varchar(200) NOT NULL,
  `divn_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_job_rm_return`
--

INSERT INTO `tbl_job_rm_return` (`id`, `lot_no`, `order_no`, `job_order_id`, `vendor_id`, `production_id`, `return_no`, `return_date`, `date`, `productid`, `order_qty`, `qty`, `maker_id`, `maker_date`, `author_id`, `author_date`, `order_type`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '002', 'JOB0098', '14', '4', '', 'rm001', '2019-05-27', '', '1', '1', '1', '1', '2019-05-27', '', '0000-00-00', '', '', '1', '1', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_work`
--

CREATE TABLE `tbl_job_work` (
  `id` int(11) NOT NULL,
  `lot_no` varchar(200) DEFAULT NULL,
  `job_order_no` varchar(200) DEFAULT NULL,
  `vendor_id` varchar(200) DEFAULT NULL,
  `production_id` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `shape_id` varchar(200) DEFAULT NULL,
  `part_id` varchar(200) DEFAULT NULL,
  `fg_id` varchar(200) DEFAULT NULL,
  `rm_id` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `weight` varchar(200) DEFAULT NULL,
  `rate` varchar(200) DEFAULT NULL,
  `total_weight` varchar(200) DEFAULT NULL,
  `total_rm_rate_rs` varchar(200) DEFAULT NULL,
  `labour_rate_co` varchar(200) DEFAULT NULL,
  `total_labour_rate` varchar(200) DEFAULT NULL,
  `total_cost` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `module_name` varchar(200) DEFAULT NULL,
  `process` varchar(200) DEFAULT NULL,
  `shape_qty` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `order_type` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `comp_id` varchar(200) NOT NULL,
  `zone_id` varchar(200) NOT NULL,
  `brnh_id` varchar(200) NOT NULL,
  `divn_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_job_work`
--

INSERT INTO `tbl_job_work` (`id`, `lot_no`, `job_order_no`, `vendor_id`, `production_id`, `date`, `shape_id`, `part_id`, `fg_id`, `rm_id`, `qty`, `weight`, `rate`, `total_weight`, `total_rm_rate_rs`, `labour_rate_co`, `total_labour_rate`, `total_cost`, `type`, `module_name`, `process`, `shape_qty`, `maker_id`, `maker_date`, `author_id`, `author_date`, `order_type`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '001', 'JO-001', '6', '1', '2019-02-11', '38', '44,45', '', '', '150,150', '', '', '', '', '', '', '', 'Shape', 'Job Order', '', '150', '', '2019-02-11', '', '2019-02-11', 'Job Order', '3', '1', '1', '', ''),
(2, '001', 'PO-001', '4', '1', '2019-02-11', '38', '44,45', '', '', ',144', '', '', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-02-11', '', '2019-02-11', 'Purchase Oder', '', '1', '1', '', ''),
(3, '001', 'JO-002', '5', '1', '2019-02-11', '38', '44,45', '', '', '144,', '', '', '', '', '', '', '', 'ShapePart', 'Job Order', '', '', '', '2019-02-11', '', '2019-02-11', 'Job Order', '', '1', '1', '', ''),
(4, '001', '001', '4', '001', '2019-03-26', '38', '44,45', '', '', '1,1', '', '', '', '', '', '', '', '', 'Kora', '43', '', '', '2019-03-26', '', '2019-03-26', 'Kora Order', '', '1', '1', '', ''),
(5, '001', 'KJ-002', '10', '001', '2019-04-02', '38', '44,45', '', '', '12,12', '', '', '', '', '', '', '', '', 'Kora', '45', '', '', '2019-04-02', '', '2019-04-02', 'Kora Order', '', '1', '1', '', ''),
(6, '001', 'KJ-002', '10', '001', '2019-04-02', '38', '44,45', '', '', ',12', '', '', '', '', '', '', '', '', 'Kora', '45', '', '', '2019-04-02', '', '2019-04-02', 'Kora Order', '', '1', '1', '', ''),
(8, '001', 'ord001', '4', '001', '2019-04-09', '38', '44,45', 'RU2801L,RU2801L', '', '1,1', '', '', '', '', '', '', '', '', 'Kora', '43', '', '', '2019-04-09', '', '2019-04-09', 'Finish Order', '', '1', '1', '', ''),
(9, '001', 'ord0098', '', '001', '2019-04-09', '', '56', '', '', '60', '', '', '', '', '', '', '', '', 'Inspection', '', '', '', '2019-04-09', '', '2019-04-09', 'Inspection', '', '1', '1', '', ''),
(10, '001', 'ord0098', '', '001', '2019-04-09', '', '57', '', '', '40', '', '', '', '', '', '', '', '', 'Inspection', '', '', '', '2019-04-09', '', '2019-04-09', 'Inspection', '', '1', '1', '', ''),
(11, '001', 'XX', '6', '1', '', '38', '44,45', '', '', '12,12', '', '', '', '', '', '', '', 'Shape', '', '', '12', '', '2019-04-30', '', '2019-04-30', 'Job Order', '', '1', '1', '', ''),
(14, '002', 'JOB0098', '4', '2', '2019-05-07', '24', '25,26,27,28', '', '', '1,4,7,10', '2,5,8,11', '3,6,9,12', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-05-07', '', '2019-05-07', 'Job Order', '3', '1', '1', '', ''),
(15, '002', 'JOB009876', '4', '2', '2019-05-10', '24', '25,26,27,28', '', '', '1', '5,5,5,5', '1,,,', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(16, '002', 'JOB98765', '4', '2', '2019-05-10', '24', '25,26,27,28', '', '', '1', '5,5,5,5', '2,,,', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(17, '002', 'JOB007', '4', '2', '2019-05-10', '24', '25,26,27,28', '', '', '1', '5,5,5,5', '5,,,', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(18, '002', 'JO009', '4', '2', '2019-05-10', '24', '25,26,27,28', '', '', '8', '5,5,5,5', '8,,,', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(19, '002', 'job0098', '4', '2', '2019-05-10', '24', '25,26,27,28', '', '', '1', '5,5,5,5', '1,,,', '', '500,,,', '12,,,', '6000,,,', '6500,,,', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '3', '1', '1', '', ''),
(20, '002', 'jobor00987', '4', '2', '2019-05-10', '24', '25,26,27,28', '', '', '1', '5,5,5,5', '', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(21, '002', 'job098765', '4', '2', '2019-05-10', '24', '25,26,27,28', '', '', '101,,,', '5,5,5,5', '1,,,', '505,,,', '505,,,', '1,,,', '505,,,', '1010,,,', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(22, '002', 'job98765', '4', '2', '2019-05-10', '24', '25,26,27,28', '', '', '50,,,', '5,5,5,5', '1,,,', '250,,,', '250,,,', '1,,,', '250,,,', '500,,,', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(23, '002', 'JOB009876', '4', '2', '2019-05-10', '24', '25,26,27,28', '', '', '100,,,', '5,5,5,5', '1,,,', '500,,,', '500,,,', '1,,,', '500,,,', '1000,,,', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(24, '002', 'JOBORD0012', '4', '2', '2019-05-10', '24', '25,26,27,28', '', '', '50,,,', '5,5,5,5', '1,,,', '250,,,', '250,,,', '1,,,', '250,,,', '500,,,', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(25, '002', 'job09876', '4', '2', '2019-05-10', '24', '25,26,27,28', '', '', '500,,,', '5,5,5,5', '10,,,', '2500,,,', '25000,,,', '12,,,', '30000,,,', '55000,,,', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(26, '002', '00988', '4', '2', '', '24', '25,26,27,28', '', '', '2,2,2,2', '5,5,5,5', ',,,', ',,,', ',,,', ',,,', ',,,', ',,,', 'Shape', '', '', '2', '', '2019-05-24', '', '2019-05-24', 'Job Order', '', '1', '1', '', ''),
(27, '002', 'pur001', '4', '2', '2019-05-24', '24', '25,26,27,28', '', '', '2,2,2,2', '5,5,5,5', ',,,', ',,,', ',,,', ',,,', ',,,', ',,,', 'ShapePart', '', '', '2', '', '2019-05-24', '', '2019-05-24', 'Purchase Oder', '', '1', '1', '', ''),
(28, '001', 'od009', '4', '001', '2019-06-14', '38', '44,45', 'RU2801L,RU2802L', '', '1,1', '', '', '', '', '', '', '', '', 'Kora', '44', '', '', '2019-06-14', '', '2019-06-14', 'Finish Order', '', '1', '1', '', ''),
(29, '003', '5435', '5', '5', '2019-07-31', '87', '84,85,86', '', '', '50,50,50', '0.160,0.660,1.220', '500,50,60', '8.000,33.000,61.000', '4000.000,1650.000,3660.000', '400,60,0987', '3200.000,1980.000,60207.000', '7200,3630,63867', 'Shape', '', '', '', '', '2019-07-31', '', '2019-07-31', 'Job Order', '', '1', '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_work_log`
--

CREATE TABLE `tbl_job_work_log` (
  `id` int(11) NOT NULL,
  `lot_no` varchar(200) DEFAULT NULL,
  `job_order_no` varchar(200) DEFAULT NULL,
  `vendor_id` varchar(200) DEFAULT NULL,
  `production_id` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `shape_id` varchar(200) DEFAULT NULL,
  `part_id` varchar(200) DEFAULT NULL,
  `fg_id` varchar(200) DEFAULT NULL,
  `rm_id` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `weight` varchar(200) DEFAULT NULL,
  `rate` varchar(200) DEFAULT NULL,
  `total_weight` varchar(200) DEFAULT NULL,
  `total_rm_rate_rs` varchar(200) DEFAULT NULL,
  `labour_rate_co` varchar(200) DEFAULT NULL,
  `total_labour_rate` varchar(200) DEFAULT NULL,
  `total_cost` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `module_name` varchar(200) DEFAULT NULL,
  `process` varchar(200) DEFAULT NULL,
  `shape_qty` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `order_type` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `comp_id` varchar(200) NOT NULL,
  `zone_id` varchar(200) NOT NULL,
  `brnh_id` varchar(200) NOT NULL,
  `divn_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_job_work_log`
--

INSERT INTO `tbl_job_work_log` (`id`, `lot_no`, `job_order_no`, `vendor_id`, `production_id`, `date`, `shape_id`, `part_id`, `fg_id`, `rm_id`, `qty`, `weight`, `rate`, `total_weight`, `total_rm_rate_rs`, `labour_rate_co`, `total_labour_rate`, `total_cost`, `type`, `module_name`, `process`, `shape_qty`, `maker_id`, `maker_date`, `author_id`, `author_date`, `order_type`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '001', 'JO-001', '6', '1', '2019-02-11', '38', '44', '', '', '150', '', '', '', '', '', '', '', 'Shape', 'Job Order', '', '150', '', '2019-02-11', '', '2019-02-11', 'Job Order', '', '1', '1', '', ''),
(2, '001', 'JO-001', '6', '1', '2019-02-11', '38', '45', '', '', '150', '', '', '', '', '', '', '', 'Shape', 'Job Order', '', '150', '', '2019-02-11', '', '2019-02-11', 'Job Order', '', '1', '1', '', ''),
(3, '001', 'PO-001', '4', '1', '2019-02-11', '38', '44', '', '', '', '', '', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-02-11', '', '2019-02-11', 'Purchase Oder', '', '1', '1', '', ''),
(4, '001', 'PO-001', '4', '1', '2019-02-11', '38', '45', '', '', '144', '', '', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-02-11', '', '2019-02-11', 'Purchase Oder', '', '1', '1', '', ''),
(5, '001', 'JO-002', '5', '1', '2019-02-11', '38', '44', '', '', '144', '', '', '', '', '', '', '', 'ShapePart', 'Job Order', '', '', '', '2019-02-11', '', '2019-02-11', 'Job Order', '', '1', '1', '', ''),
(6, '001', 'JO-002', '5', '1', '2019-02-11', '38', '45', '', '', '', '', '', '', '', '', '', '', 'ShapePart', 'Job Order', '', '', '', '2019-02-11', '', '2019-02-11', 'Job Order', '', '1', '1', '', ''),
(7, '001', '001', '4', '001', '2019-03-26', '38', '44', '', '', '1', '', '', '', '', '', '', '', '', 'Kora', '43', '', '', '2019-03-26', '', '2019-03-26', 'Kora Order', '', '1', '1', '', ''),
(8, '001', '001', '4', '001', '2019-03-26', '38', '45', '', '', '1', '', '', '', '', '', '', '', '', 'Kora', '43', '', '', '2019-03-26', '', '2019-03-26', 'Kora Order', '', '1', '1', '', ''),
(9, '001', 'KJ-002', '10', '001', '2019-04-02', '38', '44', '', '', '12', '', '', '', '', '', '', '', '', 'Kora', '45', '', '', '2019-04-02', '', '2019-04-02', 'Kora Order', '', '1', '1', '', ''),
(10, '001', 'KJ-002', '10', '001', '2019-04-02', '38', '45', '', '', '12', '', '', '', '', '', '', '', '', 'Kora', '45', '', '', '2019-04-02', '', '2019-04-02', 'Kora Order', '', '1', '1', '', ''),
(11, '001', 'KJ-002', '10', '001', '2019-04-02', '38', '44', '', '', '', '', '', '', '', '', '', '', '', 'Kora', '45', '', '', '2019-04-02', '', '2019-04-02', 'Kora Order', '', '1', '1', '', ''),
(12, '001', 'KJ-002', '10', '001', '2019-04-02', '38', '45', '', '', '12', '', '', '', '', '', '', '', '', 'Kora', '45', '', '', '2019-04-02', '', '2019-04-02', 'Kora Order', '', '1', '1', '', ''),
(15, '001', 'ord001', '4', '001', '2019-04-09', '38', '44', 'RU2801L', '', '1', '', '', '', '', '', '', '', '', 'Kora', '43', '', '', '2019-04-09', '', '2019-04-09', 'Finish Order', '', '1', '1', '', ''),
(16, '001', 'ord001', '4', '001', '2019-04-09', '38', '45', 'RU2801L', '', '1', '', '', '', '', '', '', '', '', 'Kora', '43', '', '', '2019-04-09', '', '2019-04-09', 'Finish Order', '', '1', '1', '', ''),
(17, '001', 'XX', '6', '1', '', '38', '44', '', '', '12', '', '', '', '', '', '', '', 'Shape', '', '', '12', '', '2019-04-30', '', '2019-04-30', 'Job Order', '', '1', '1', '', ''),
(18, '001', 'XX', '6', '1', '', '38', '45', '', '', '12', '', '', '', '', '', '', '', 'Shape', '', '', '12', '', '2019-04-30', '', '2019-04-30', 'Job Order', '', '1', '1', '', ''),
(19, '002', 'JOB0098', '4', '2', '2019-05-07', '24', '25', '', '', '1', '2', '3', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-05-07', '', '2019-05-07', 'Job Order', '', '1', '1', '', ''),
(20, '002', 'JOB0098', '4', '2', '2019-05-07', '24', '26', '', '', '4', '5', '6', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-05-07', '', '2019-05-07', 'Job Order', '', '1', '1', '', ''),
(21, '002', 'JOB0098', '4', '2', '2019-05-07', '24', '27', '', '', '7', '8', '9', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-05-07', '', '2019-05-07', 'Job Order', '', '1', '1', '', ''),
(22, '002', 'JOB0098', '4', '2', '2019-05-07', '24', '28', '', '', '10', '11', '12', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-05-07', '', '2019-05-07', 'Job Order', '', '1', '1', '', ''),
(23, '002', 'JOB009876', '4', '2', '2019-05-10', '24', '25', '', '', '1', '5', '1', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(24, '002', 'JOB98765', '4', '2', '2019-05-10', '24', '25', '', '', '1', '5', '2', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(25, '002', 'JOB009876', '4', '2', '2019-05-10', '24', '25', '', '', '100', '5', '1', '500', '500', '', '500', '1000', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(26, '002', 'JOBORD0012', '4', '2', '2019-05-10', '24', '25', '', '', '50', '5', '1', '250', '250', '', '250', '500', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(27, '002', 'job09876', '4', '2', '2019-05-10', '24', '25', '', '', '500', '5', '10', '2500', '25000', '12', '30000', '55000', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(28, '002', 'job09876', '4', '2', '2019-05-10', '24', '26', '', '', '', '5', '', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(29, '002', 'job09876', '4', '2', '2019-05-10', '24', '27', '', '', '', '5', '', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(30, '002', 'job09876', '4', '2', '2019-05-10', '24', '28', '', '', '', '5', '', '', '', '', '', '', 'ShapePart', '', '', '', '', '2019-05-10', '', '2019-05-10', 'Job Order', '', '1', '1', '', ''),
(31, '002', '00988', '4', '2', '', '24', '25', '', '', '2', '5', '', '', '', '', '', '', 'Shape', '', '', '2', '', '2019-05-24', '', '2019-05-24', 'Job Order', '', '1', '1', '', ''),
(32, '002', '00988', '4', '2', '', '24', '26', '', '', '2', '5', '', '', '', '', '', '', 'Shape', '', '', '2', '', '2019-05-24', '', '2019-05-24', 'Job Order', '', '1', '1', '', ''),
(33, '002', '00988', '4', '2', '', '24', '27', '', '', '2', '5', '', '', '', '', '', '', 'Shape', '', '', '2', '', '2019-05-24', '', '2019-05-24', 'Job Order', '', '1', '1', '', ''),
(34, '002', '00988', '4', '2', '', '24', '28', '', '', '2', '5', '', '', '', '', '', '', 'Shape', '', '', '2', '', '2019-05-24', '', '2019-05-24', 'Job Order', '', '1', '1', '', ''),
(35, '002', 'pur001', '4', '2', '2019-05-24', '24', '25', '', '', '2', '5', '', '', '', '', '', '', 'ShapePart', '', '', '2', '', '2019-05-24', '', '2019-05-24', 'Purchase Oder', '', '1', '1', '', ''),
(36, '002', 'pur001', '4', '2', '2019-05-24', '24', '26', '', '', '2', '5', '', '', '', '', '', '', 'ShapePart', '', '', '2', '', '2019-05-24', '', '2019-05-24', 'Purchase Oder', '', '1', '1', '', ''),
(37, '002', 'pur001', '4', '2', '2019-05-24', '24', '27', '', '', '2', '5', '', '', '', '', '', '', 'ShapePart', '', '', '2', '', '2019-05-24', '', '2019-05-24', 'Purchase Oder', '', '1', '1', '', ''),
(38, '002', 'pur001', '4', '2', '2019-05-24', '24', '28', '', '', '2', '5', '', '', '', '', '', '', 'ShapePart', '', '', '2', '', '2019-05-24', '', '2019-05-24', 'Purchase Oder', '', '1', '1', '', ''),
(39, '001', 'od009', '4', '001', '2019-06-14', '38', '44', 'RU2801L', '', '1', '', '', '', '', '', '', '', '', 'Kora', '44', '', '', '2019-06-14', '', '2019-06-14', 'Finish Order', '', '1', '1', '', ''),
(40, '001', 'od009', '4', '001', '2019-06-14', '38', '45', 'RU2802L', '', '1', '', '', '', '', '', '', '', '', 'Kora', '44', '', '', '2019-06-14', '', '2019-06-14', 'Finish Order', '', '1', '1', '', ''),
(41, '003', '5435', '5', '5', '2019-07-31', '87', '84', '', '', '50', '0.160', '500', '8.000', '4000.000', '400', '3200.000', '7200', 'Shape', '', '', '', '', '2019-07-31', '', '2019-07-31', 'Job Order', '', '1', '1', '', ''),
(42, '003', '5435', '5', '5', '2019-07-31', '87', '85', '', '', '50', '0.660', '50', '33.000', '1650.000', '60', '1980.000', '3630', 'Shape', '', '', '', '', '2019-07-31', '', '2019-07-31', 'Job Order', '', '1', '1', '', ''),
(43, '003', '5435', '5', '5', '2019-07-31', '87', '86', '', '', '50', '1.220', '60', '61.000', '3660.000', '0987', '60207.000', '63867', 'Shape', '', '', '', '', '2019-07-31', '', '2019-07-31', 'Job Order', '', '1', '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_work_scrap`
--

CREATE TABLE `tbl_job_work_scrap` (
  `id` int(11) NOT NULL,
  `lot_no` varchar(200) DEFAULT NULL,
  `order_no` varchar(200) DEFAULT NULL,
  `invoice_no` varchar(200) DEFAULT NULL,
  `grn_no` varchar(200) DEFAULT NULL,
  `grn_date` varchar(200) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `job_order_id` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `comp_id` varchar(200) NOT NULL,
  `zone_id` varchar(200) NOT NULL,
  `brnh_id` varchar(200) NOT NULL,
  `divn_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_job_work_scrap`
--

INSERT INTO `tbl_job_work_scrap` (`id`, `lot_no`, `order_no`, `invoice_no`, `grn_no`, `grn_date`, `productid`, `qty`, `job_order_id`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '002', 'JOB0098', '2019-05-07', 'grn001', '2019-06-13', '74', '0.02', '14', '1', '2019-06-13', '', '0000-00-00', '', '1', '1', '1', ''),
(2, '002', 'JOB0098', '2019-05-07', 'grn002', '2019-06-13', '74', '0.01', '14', '1', '2019-06-13', '', '0000-00-00', '', '1', '1', '1', ''),
(3, '002', 'JOB0098', '2019-05-07', 'grn0012', '2019-06-14', '74', '.01', '14', '1', '2019-06-14', '', '0000-00-00', '', '1', '1', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_machine`
--

CREATE TABLE `tbl_machine` (
  `id` int(11) NOT NULL,
  `code` varchar(200) DEFAULT NULL,
  `machine_name` varchar(200) DEFAULT NULL,
  `machine_des` text DEFAULT NULL,
  `capacity` varchar(225) DEFAULT NULL,
  `image_name` varchar(225) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'A',
  `maker_id` varchar(200) NOT NULL,
  `maker_date` date NOT NULL,
  `author_id` varchar(200) NOT NULL,
  `author_date` varchar(200) NOT NULL,
  `comp_id` varchar(200) NOT NULL,
  `zone_id` varchar(200) NOT NULL,
  `brnh_id` varchar(200) NOT NULL,
  `divn_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_machine`
--

INSERT INTO `tbl_machine` (`id`, `code`, `machine_name`, `machine_des`, `capacity`, `image_name`, `status`, `maker_id`, `maker_date`, `author_id`, `author_date`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '3', '9', '', '', '', 'A', '1', '2018-10-08', '', '2018-10-08', '1', '1', '1', '1'),
(2, '15', '10', '', '', '', 'A', '1', '2018-12-14', '', '2018-12-14', '1', '1', '1', '1'),
(15, '64', '42', '', '', '', 'A', '', '2019-01-08', '', '19-01-08', '1', '1', '1', '1'),
(62, '115', '113', '', '', '', 'A', '', '2019-07-25', '', '19-07-25', '1', '1', '1', '1'),
(175, '102', '101', '', '', '', 'A', '', '2019-08-08', '', '19-08-08', '1', '1', '1', '1'),
(180, '122', '121', '', '', '', 'A', '', '2019-08-08', '', '19-08-08', '1', '1', '1', '1'),
(193, '200', '197', '', '', '', 'A', '', '2019-08-08', '', '19-08-08', '1', '1', '1', '1'),
(196, '80', '79', '', '', '', 'A', '', '2019-08-08', '', '19-08-08', '1', '1', '1', '1'),
(199, '173', '172', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(200, '127', '126', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(201, '133', '132', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(202, '142', '140', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(203, '97', '96', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(204, '29', '24', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(205, '30', '24', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(206, '31', '24', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(207, '32', '24', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(208, '33', '24', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(209, '34', '24', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(210, '35', '24', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(211, '36', '24', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(212, '103', '101', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(213, '104', '101', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(215, '202', '198', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(216, '67', '43', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(217, '56', '38', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(218, '58', '39', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(219, '60', '40', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(220, '66', '43', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(221, '62', '41', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(222, '57', '38', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(223, '59', '39', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(224, '65', '42', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(225, '61', '40', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(226, '63', '41', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(227, '148', '147', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(228, '156', '154', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(229, '155', '153', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(230, '114', '113', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(231, '92', '91', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(232, '75', '87', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(233, '21', '15', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(234, '12', '3', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(235, '22', '15', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(236, '13', '3', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(238, '14', '3', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(239, '23', '15', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(240, '157', '128', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(241, '169', '167', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(242, '168', '166', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(243, '201', '198', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(244, '109', '108', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(245, '143', '141', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(246, '68', '43', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(247, '9', '3', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(248, '10', '3', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(249, '11', '3', '', '', '', 'A', '', '2019-09-10', '', '19-09-10', '1', '1', '1', '1'),
(250, '199', '196', '', '', '', 'A', '', '2019-09-11', '', '19-09-11', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_machine_spare_map`
--

CREATE TABLE `tbl_machine_spare_map` (
  `id` int(11) NOT NULL,
  `machine_id` varchar(200) DEFAULT NULL,
  `spare_id` varchar(200) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'A',
  `maker_id` varchar(200) NOT NULL,
  `maker_date` date NOT NULL,
  `author_id` varchar(200) NOT NULL,
  `author_date` varchar(200) NOT NULL,
  `comp_id` varchar(200) NOT NULL,
  `zone_id` varchar(200) NOT NULL,
  `brnh_id` varchar(200) NOT NULL,
  `divn_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_machine_spare_map`
--

INSERT INTO `tbl_machine_spare_map` (`id`, `machine_id`, `spare_id`, `status`, `maker_id`, `maker_date`, `author_id`, `author_date`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '2', '4', 'A', '1', '2018-08-28', '', '2018-08-28', '1', '1', '1', '1'),
(2, '2', '25', 'A', '1', '2018-08-28', '', '2018-08-28', '1', '1', '1', '1'),
(3, '1', '4', 'A', '1', '2018-08-28', '', '2018-08-28', '1', '1', '1', '1'),
(4, '1', '5', 'A', '1', '2018-08-28', '', '2018-08-28', '1', '1', '1', '1'),
(5, '3', '25', 'A', '1', '2018-09-01', '', '2018-09-01', '1', '1', '1', '1'),
(6, '3', '4', 'A', '1', '2018-09-03', '', '2018-09-03', '1', '1', '1', '1'),
(24, '4', '4', 'A', '1', '2018-09-04', '', '2018-09-04', '1', '1', '1', '1'),
(25, '4', '5', 'A', '1', '2018-09-04', '', '2018-09-04', '1', '1', '1', '1'),
(26, '4', '4', 'A', '1', '2018-10-05', '', '2018-10-05', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_data`
--

CREATE TABLE `tbl_master_data` (
  `serial_number` int(11) NOT NULL,
  `param_id` varchar(200) DEFAULT NULL,
  `key1` varchar(200) DEFAULT NULL,
  `key2` varchar(200) DEFAULT NULL,
  `keyvalue` varchar(200) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` datetime DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author_date` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_master_data`
--

INSERT INTO `tbl_master_data` (`serial_number`, `param_id`, `key1`, `key2`, `keyvalue`, `description`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(13, '17', NULL, NULL, 'Raw Material', '', '1', '2018-01-15 00:00:00', '1', '2018-01-15 00:00:00', 'A', '1', '1', '1', '1'),
(14, '17', NULL, NULL, 'Finish Goods', '', '1', '2018-01-15 00:00:00', '1', '2018-01-15 00:00:00', 'A', '1', '1', '1', '1'),
(18, '16', NULL, NULL, 'Kg.', '', '1', '2018-10-16 00:00:00', '1', '2018-10-16 00:00:00', 'A', '1', '1', '1', '1'),
(32, '17', NULL, NULL, 'Part Name', '', '1', '2018-06-22 00:00:00', '1', '2018-06-22 00:00:00', 'A', '1', '1', '1', '1'),
(33, '17', NULL, NULL, 'Shape', '', '1', '2018-06-22 00:00:00', '1', '2018-06-22 00:00:00', 'A', '1', '1', '1', '1'),
(34, '17', NULL, NULL, 'Packing Material', '', '1', '2018-08-22 00:00:00', '1', '2018-08-22 00:00:00', 'A', '1', '1', '1', '1'),
(35, '17', NULL, NULL, 'Accessories', '', '1', '2018-10-16 00:00:00', '1', '2018-10-16 00:00:00', 'A', '1', '1', '1', '1'),
(36, '19', NULL, NULL, 'High', '', '1', '2018-11-29 00:00:00', '1', '2018-11-29 00:00:00', 'A', '1', '0', '1', '0'),
(37, '19', NULL, NULL, 'Medium', '', '1', '2018-11-29 00:00:00', '1', '2018-11-29 00:00:00', 'A', '1', '0', '1', '0'),
(38, '19', NULL, NULL, 'Low', '', '1', '2018-11-29 00:00:00', '1', '2018-11-29 00:00:00', 'A', '1', '0', '1', '0'),
(41, '16', NULL, NULL, 'Set', '', '1', '2019-05-20 00:00:00', '1', '2019-05-20 00:00:00', 'A', '1', '1', '1', '1'),
(42, '16', NULL, NULL, 'Circle', '', '1', '2019-03-12 00:00:00', '1', '2019-03-12 00:00:00', 'A', '1', '1', '1', '1'),
(43, '20', NULL, NULL, 'Engraving', '', '1', '2019-03-26 00:00:00', '1', '2019-03-26 00:00:00', 'A', '1', '1', '1', '1'),
(44, '20', NULL, NULL, 'Acid Etching', '', '1', '2019-03-26 00:00:00', '1', '2019-03-26 00:00:00', 'A', '1', '1', '1', '1'),
(45, '20', NULL, NULL, 'Policing', '', '1', '2019-03-26 00:00:00', '1', '2019-03-26 00:00:00', 'A', '1', '1', '1', '1'),
(46, '21', NULL, NULL, 'Nhava Sheva Mumbai', '', '1', '2019-08-06 00:00:00', '1', '2019-08-06 00:00:00', 'A', '1', '1', '1', '1'),
(47, '21', NULL, NULL, 'Mundra (Gujrat)', '', '1', '2019-08-06 00:00:00', '1', '2019-08-06 00:00:00', 'A', '1', '1', '1', '1'),
(48, '22', NULL, NULL, 'Chicago', '', '1', '2019-08-06 00:00:00', '1', '2019-08-06 00:00:00', 'A', '1', '1', '1', '1'),
(49, '22', NULL, NULL, 'New York ', '', '1', '2019-08-06 00:00:00', '1', '2019-08-06 00:00:00', 'A', '1', '1', '1', '1'),
(50, '17', NULL, NULL, 'Scrap', '', '1', '2019-06-13 00:00:00', '1', '2019-06-13 00:00:00', 'A', '1', '1', '1', '1'),
(51, '16', NULL, NULL, 'Pcs', 'Pices', '1', '2019-08-08 00:00:00', '1', '2019-08-08 00:00:00', 'A', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_data_mst`
--

CREATE TABLE `tbl_master_data_mst` (
  `param_id` int(11) NOT NULL,
  `keyname` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` datetime DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author_date` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_master_data_mst`
--

INSERT INTO `tbl_master_data_mst` (`param_id`, `keyname`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(16, 'Usage Unit\r\n', NULL, NULL, NULL, NULL, 'A', '36', NULL, NULL, NULL),
(17, 'Product Type', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(18, 'Size', NULL, NULL, NULL, NULL, 'I', NULL, NULL, NULL, NULL),
(19, 'Set Priority', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(20, 'Process', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(21, 'Port Of loading', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(22, 'Port Of Discharge', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_module_function`
--

CREATE TABLE `tbl_module_function` (
  `func_id` int(11) NOT NULL,
  `function_url` varchar(200) NOT NULL,
  `function_name` varchar(200) DEFAULT NULL,
  `module_name` varchar(200) NOT NULL,
  `Order_id` varchar(200) NOT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `function_group` varchar(200) DEFAULT ' ',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL,
  `author_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_module_function`
--

INSERT INTO `tbl_module_function` (`func_id`, `function_url`, `function_name`, `module_name`, `Order_id`, `maker_id`, `maker_date`, `author_id`, `author`, `status`, `function_group`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`, `author_date`) VALUES
(4, 'manage_account', 'Manage Account', '10', '', NULL, NULL, NULL, NULL, 'A', 'Account', '', '', '', '', '0000-00-00'),
(5, 'send_mail', 'Send New Mail', '1', '', NULL, NULL, NULL, NULL, 'A', 'Mail', '', '', '', '', '0000-00-00'),
(89, 'Report/report_function', 'Reports', '25', '', NULL, NULL, NULL, NULL, 'A', '', '', '', '', '', '0000-00-00'),
(90, 'master/Item/logout', 'Logout ', '7', '', NULL, NULL, NULL, NULL, 'A', '', '', '', '', '', '0000-00-00'),
(91, 'admin/enterprise/add_enterprise', 'New Enterprise', '4', '', NULL, NULL, NULL, NULL, 'A', 'Enterprise', '', '', '', '', '0000-00-00'),
(93, 'admin/enterprise/manage_enterprise', 'Manage Enterprise', '4', '', NULL, NULL, NULL, NULL, 'A', 'Enterprise', '', '', '', '', '0000-00-00'),
(95, 'admin/region/add_region', 'New Region', '4', '', NULL, NULL, NULL, NULL, 'A', 'Region', '', '', '', '', '0000-00-00'),
(97, 'admin/region/manage_region', 'Manage Region', '4', '', NULL, NULL, NULL, NULL, 'A', 'Region', '', '', '', '', '0000-00-00'),
(99, 'admin/branch/add_branch', 'New Branch', '4', '', NULL, NULL, NULL, NULL, 'A', 'Branch', '', '', '', '', '0000-00-00'),
(101, 'admin/branch/manage_branch', 'Manage Branch', '4', '', NULL, NULL, NULL, NULL, 'A', 'Branch', '', '', '', '', '0000-00-00'),
(103, 'admin/wing/add_wing', 'New Wing/Department', '4', '', NULL, NULL, NULL, NULL, 'A', 'Wing/Department', '', '', '', '', '0000-00-00'),
(105, 'admin/wing/manage_Wing', 'Manage Wing/Department', '4', '', NULL, NULL, NULL, NULL, 'A', 'Wing/Department', '', '', '', '', '0000-00-00'),
(107, 'admin/role/add_role', 'New Role', '4', '', NULL, NULL, NULL, NULL, 'A', 'Role', '', '', '', '', '0000-00-00'),
(109, 'admin/role/manage_role', 'Manage Role', '4', '', NULL, NULL, NULL, NULL, 'A', 'Role', '', '', '', '', '0000-00-00'),
(111, 'admin/rolefunction/role_function_action', 'Role Function Action', '4', '', NULL, NULL, NULL, NULL, 'A', '', '', '', '', '', '0000-00-00'),
(113, 'admin/user/add_user', 'New User', '4', '', NULL, NULL, NULL, NULL, 'A', 'Users', '', '', '', '', '0000-00-00'),
(115, 'admin/user/manage_user', 'Manage Users', '4', '', NULL, NULL, NULL, NULL, 'A', 'Users', '', '', '', '', '0000-00-00'),
(117, 'admin/mapuser/map_user_role', 'Add User Role', '4', '', NULL, NULL, NULL, NULL, 'A', 'User Role', '', '', '', '', '0000-00-00'),
(166, 'admin/masterdata/add_master_data', 'Add Generic Param', '4', '', NULL, NULL, NULL, NULL, 'A', 'Master Data', NULL, NULL, NULL, NULL, NULL),
(167, 'admin/masterdata/manage_master_data', 'Manage Master Data', '4', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(189, 'admin/mapuser/mapped_user_role', 'Manage User Role', '4', '', NULL, NULL, NULL, NULL, 'A', 'User Role', NULL, NULL, NULL, NULL, NULL),
(209, 'master/Item/add_item', 'Add Product', '3', '', NULL, NULL, NULL, NULL, 'A', 'Product', NULL, NULL, NULL, NULL, NULL),
(215, 'master/ProductCategory/manage_itemctg', 'Manage Product Group', '3', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(221, 'master/Item/manage_item?p_type=13', 'Manage Raw Material', '3', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(224, 'master/ProductCategory/add_itemctg', 'Add Product Group', '3', '', NULL, NULL, NULL, NULL, 'A', 'Product Group', NULL, NULL, NULL, NULL, NULL),
(256, 'master/AccountGroup/add_account', 'Add Account Group', '3', '', NULL, NULL, NULL, NULL, 'A', 'Account Group', NULL, NULL, NULL, NULL, NULL),
(263, 'master/Account/add_contact', 'Add Contact', '3', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(294, 'salesorder/SalesOrder/manageSalesOrder', 'Manage Sales Order', '28', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(302, 'sreturn/manage_sales_order_return', 'Manage Sales Order Return', '28', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(311, 'NewPayment/payment_amount', 'Payment', '32', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(312, 'BalanceSheet/balanceSheetPay', 'Trial Balance', '32', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(313, 'salesorder/SalesOrder/salesOrderNew', 'Add Sales Order', '28', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(315, 'location/Location/manage_location', 'Manage Location', '33', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(316, 'PriceMapping/manage_price_mapping', 'Manage Price Mapping', '36', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(317, 'purchaseorder/manage_purchase_order', 'Manage RM Planning', '37', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(318, 'invoice/manage_invoice', 'Manage Invoice', '38', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(319, 'PaymentReceived/payment_amount', 'Payment Received', '32', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(320, 'template/manage_template', 'Manage Templte', '39', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(321, 'production/manage_production', 'Manage Production1', '39', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(323, 'packing/manage_packing', 'Manage Packing', '41', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(324, 'master/ProductSubCategory/manage_itemsubctg', 'Manage Product Sub Group', '3', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(325, 'proformaInvoice/manage_invoice', 'Proforma Invoice', '42', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(326, 'StockRefill/add_multiple_qty', 'Manual Stock Refill', '43', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(328, 'kora/manage_kora', 'Manage Kora', '45', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(329, 'finish/manage_finish', 'Manage Finish', '46', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(330, 'inspection/manage_inspection', 'Manage Inspection', '47', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(331, 'dispatch/manage_dispatch', 'Manage Dispatch', '49', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(332, 'inbound/manage_inbound', 'Manage GRN', '37', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(333, 'buyerorder/manage_purchase_order', 'Manage Lot', '39', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(334, 'purchaseorder/item_Stock', 'Item Stock', '37', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(338, 'addproduction/item_Stock', 'Stock Details', '39', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(339, 'issueMatiral/issueMatrial', 'Issue Material', '39', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(341, 'issueMaterialproduction/inbound/manage_inbound', 'Challan', '37', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(343, 'shapeMapping/manage_shape', 'Manage Shape Mapping', '3', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(344, 'master/Item/manage_item?p_type=32', 'Manage Product Parts', '3', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(345, 'master/Item/manage_item?p_type=33', 'Manage Product Shapes', '3', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(354, 'productionModule/manage_production', 'Production Order', '50', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(356, 'productionModule/manage_grn', 'Manage GRNS', '50', '', NULL, NULL, NULL, NULL, 'A', ' ', NULL, NULL, NULL, NULL, NULL),
(357, 'productionModule/view_Stock', 'View Stock', '50', '', NULL, NULL, NULL, NULL, 'A', ' ', NULL, NULL, NULL, NULL, NULL),
(358, 'master/Item/manage_item?p_type=14', 'Manage Finish Goods', '3', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(359, 'master/Item/manage_item?p_type=35', 'Manage Accessories', '3', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(360, 'master/Item/manage_item?p_type=34', 'Manage Packaging Material', '3', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(361, 'master/Account/manage_contact?con_type=6', 'Manage Employee', '3', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(362, 'master/Account/manage_contact?con_type=5', 'Manage Vendor', '3', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(363, 'master/Account/manage_contact?con_type=7', 'Manage Consignee', '3', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(364, 'master/Account/manage_contact?con_type=4', 'Manage Buyer', '3', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(365, 'kora/manage_stock', 'Manage Stock', '45', '', NULL, NULL, NULL, NULL, 'A', '', '', '', '', '', '0000-00-00'),
(368, 'finish/manage_stock', 'Manage Finish stock', '46', '', NULL, NULL, NULL, NULL, 'A', '', '', '', '', '', '0000-00-00'),
(369, 'inspection/manage_stock', 'Manage Inspection Stock', '47', '', NULL, NULL, NULL, NULL, 'A', '', '', '', '', '', '0000-00-00'),
(370, 'dispatch/manage_stock', 'Manage Dispatch Stock', '49', '', NULL, NULL, NULL, NULL, 'A', '', '', '', '', '', '0000-00-00'),
(371, 'productionModule/search_job_order', 'Search Job Order', '50', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(372, 'productionModule/raw_material_scrap', 'Scrap Module', '37', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(373, 'master/Item/manage_item?p_type=50', 'Manage Product Scrap', '3', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(374, 'finish/manage_test', 'Manage Test', '46', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL),
(375, 'finish/manage_assemble', 'Manage Assemble', '46', '', NULL, NULL, NULL, NULL, 'A', '', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_module_mst`
--

CREATE TABLE `tbl_module_mst` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(200) NOT NULL,
  `Order_id` int(11) DEFAULT 0,
  `status` varchar(200) DEFAULT 'A',
  `module_url` varchar(2000) DEFAULT '#',
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_module_mst`
--

INSERT INTO `tbl_module_mst` (`module_id`, `module_name`, `Order_id`, `status`, `module_url`, `maker_id`, `author_id`, `maker_date`, `author_date`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(3, 'Super Admin', 2, 'A', 'icon-flow-tree', '', '', '0000-00-00', '0000-00-00', '', '', '', ''),
(4, 'Admin Setup', 1, 'A', 'icon-doc-text', '', '', '0000-00-00', '0000-00-00', '', '', '', ''),
(7, 'Logout', 14, 'A', 'icon-logout', '', '', '0000-00-00', '0000-00-00', '', '', '', ''),
(25, 'Reports', 12, 'A', 'icon-location', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'Sales Order', 6, 'A', 'icon-window', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'Price Mapping', 3, 'A', 'icon-window', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Account', 9, 'A', 'icon-mail', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'Location', 5, 'A', 'icon-location', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'Raw Material', 4, 'A', 'icon-window', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'Invoice', 8, 'A', 'icon-window', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'Buyer Oder', 3, 'A', 'icon-window', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'Cutting', 4, 'A', 'icon-window', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'Packing', 10, 'A', 'icon-window', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'Proforma Invoice', 7, 'A', 'icon-window', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'Stock Refill', 9, 'A', 'icon-window', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'Kora', 7, 'A', 'icon-window', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'Finish', 8, 'A', 'icon-window', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'Inspection', 9, 'A', 'icon-window', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'Packaging\r\n', 0, 'A', 'icon-doc-text', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'Dispatch\r\n', 10, 'A', 'icon-doc-text', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'Production', 5, 'A', 'icon-doc-text', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_part_price_mapping`
--

CREATE TABLE `tbl_part_price_mapping` (
  `id` int(200) NOT NULL,
  `part_id` int(200) DEFAULT NULL,
  `machine_id` int(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `EPrice` varchar(200) DEFAULT NULL,
  `rowmatial` int(200) DEFAULT NULL,
  `unit` varchar(200) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_date` date NOT NULL,
  `author_id` varchar(200) NOT NULL,
  `author_date` date NOT NULL,
  `status` varchar(200) NOT NULL,
  `comp_id` varchar(200) NOT NULL,
  `zone_id` varchar(200) NOT NULL,
  `brnh_id` varchar(200) NOT NULL,
  `divn_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_part_price_mapping`
--

INSERT INTO `tbl_part_price_mapping` (`id`, `part_id`, `machine_id`, `qty`, `EPrice`, `rowmatial`, `unit`, `type`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(3, 4, 0, '0.030', '0.060', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(5, 6, 0, '0.040', '0.070', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(6, 55, 0, '0.130', '0.205', 69, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(7, 54, 0, '0.030', '0.048', 69, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(8, 45, 0, '1.120', '1.370', 71, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(9, 44, 0, '0.150', '0.195', 71, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(10, 47, 0, '0.960', '1.070', 71, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(11, 46, 0, '0.154', '0.180', 71, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(13, 53, 0, '0.320', '0.415', 71, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(15, 49, 0, '0.740', '0.825', 71, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(17, 51, 0, '0.460', '0.560', 71, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(18, 50, 0, '0.090', '0.120', 71, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(23, 20, 0, '0.290', '0.480', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(24, 16, 0, '0.275', '0.440', 69, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(25, 18, 0, '0.580', '0.900', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(26, 19, 0, '1.020', '1.200', 2, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(27, 17, 0, '0.80', '0.100', 2, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(30, 5, 0, '0.015', '.025', 69, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(31, 52, 0, '0.060', '0.075', 71, '42', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(32, 48, 0, '0.135', '0.180', 71, '42', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(33, 8, 0, '0.038', '0.060', 69, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(34, 7, 0, '0.050', '0.070', 2, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(79, 37, 0, '0.010', '0.016', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(93, 77, 0, '0.060', '0.090', 69, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(95, 83, 0, '0.060', '0.100', 69, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(96, 88, 0, '0.220', '0.340', 69, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(97, 89, 0, '0.700', '1.100', 69, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(99, 93, 0, '0.080', '0.120', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(100, 94, 0, '0.120', '0.185', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(101, 95, 0, '0.180', '0.275', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(102, 25, 0, '0.060', '0.090', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(103, 26, 0, '0.080', '0.090', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(104, 27, 0, '0.017', '0.020', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(105, 28, 0, '0.125', '0.130', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(109, 105, 0, '0.020', '0.035', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(110, 106, 0, '0.050', '0.065', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(111, 107, 0, '0.060', '0.080', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(114, 112, 0, '0.032', '0.060', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(115, 117, 0, '0.125', '0.200', 1, '18', '', '', '2019-07-29', '', '2019-07-29', '', '1', '1', '1', '1'),
(116, 116, 0, '0.125', '0.200', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(120, 118, 0, '0.020', '0.050', 1, '18', '', '', '2019-07-29', '', '2019-07-29', '', '1', '1', '1', '1'),
(121, 119, 0, '0.060', '0.070', 1, '18', '', '', '2019-07-29', '', '2019-07-29', '', '1', '1', '1', '1'),
(122, 120, 0, '0.080', '0.100', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(123, 123, 0, '0.180', '0.350', 1, '18', '', '', '2019-07-29', '', '2019-07-29', '', '1', '1', '1', '1'),
(124, 124, 0, '0.560', '0.650', 1, '18', '', '', '2019-07-29', '', '2019-07-29', '', '1', '1', '1', '1'),
(126, 125, 0, '0.660', '0.770', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(128, 130, 0, '0.300', '0.525', 1, '18', '', '', '2019-07-30', '', '2019-07-30', '', '1', '1', '1', '1'),
(129, 129, 0, '0.140', '0.270', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(130, 131, 0, '0.600', '0.850', 1, '18', '', '', '2019-07-30', '', '2019-07-30', '', '1', '1', '1', '1'),
(131, 134, 0, '0.080', '0.125', 1, '18', '', '', '2019-07-30', '', '2019-07-30', '', '1', '1', '1', '1'),
(132, 135, 0, '0.200', '0.360', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(133, 136, 0, '0.370', '0.600', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(134, 137, 0, '0.020', '0.030', 1, '18', '', '', '2019-07-30', '', '2019-07-30', '', '1', '1', '1', '1'),
(135, 138, 0, '0.040', '0.060', 1, '18', '', '', '2019-07-30', '', '2019-07-30', '', '1', '1', '1', '1'),
(136, 139, 0, '0.070', '0.085', 1, '18', '', '', '2019-07-30', '', '2019-07-30', '', '1', '1', '1', '1'),
(137, 144, 0, '0.685', '0.920', 1, '18', '', '', '2019-07-30', '', '2019-07-30', '', '1', '1', '1', '1'),
(138, 145, 0, '0.685', '0.920', 1, '18', '', '', '2019-07-30', '', '2019-07-30', '', '1', '1', '1', '1'),
(139, 146, 0, '0.080', '0.110', 1, '18', '', '', '2019-07-30', '', '2019-07-30', '', '1', '1', '1', '1'),
(140, 149, 0, '0.180', '0.370', 69, '18', '', '', '2019-07-30', '', '2019-07-30', '', '1', '1', '1', '1'),
(141, 150, 0, '0.980', '1.250', 69, '18', '', '', '2019-07-30', '', '2019-07-30', '', '1', '1', '1', '1'),
(142, 151, 0, '0.100', '0.220', 69, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(143, 152, 0, '0.410', '0.640', 69, '18', '', '', '2019-07-30', '', '2019-07-30', '', '1', '1', '1', '1'),
(147, 160, 0, '1.000', '1.300', 1, '18', '', '', '2019-07-30', '', '2019-07-30', '', '1', '1', '1', '1'),
(148, 161, 0, '1.090', '1.650', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(151, 164, 0, '0.050', '0.073', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(152, 162, 0, '0.022', '0.040', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(153, 163, 0, '0.035', '0.050', 1, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(154, 165, 0, '0.060', '0.117', 1, '18', '', '', '2019-07-30', '', '2019-07-30', '', '1', '1', '1', '1'),
(155, 159, 0, '0.310', '0.650', 69, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(158, 170, 0, '0.180', '0.234', 177, '42', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(159, 171, 0, '0.820', '1.185', 178, '42', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(160, 158, 0, '0.300', '0.375', 176, '42', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(161, 86, 0, '1.000', '1.220', 175, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(162, 84, 0, '0.120', '0.160', 175, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(163, 85, 0, '0.600', '0.660', 175, '18', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(164, 110, 0, '0.128', '0.198', 174, '42', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(165, 111, 0, '0.125', '0.200', 174, '42', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', ''),
(166, 186, 0, '0.180', '0.205', 179, '18', '', '', '2019-07-31', '', '2019-07-31', '', '1', '1', '1', '1'),
(167, 187, 0, '0.620', '0.680', 179, '18', '', '', '2019-07-31', '', '2019-07-31', '', '1', '1', '1', '1'),
(168, 188, 0, '0.900', '0.980', 179, '18', '', '', '2019-07-31', '', '2019-07-31', '', '1', '1', '1', '1'),
(169, 189, 0, '0.020', '0.025', 179, '18', '', '', '2019-07-31', '', '2019-07-31', '', '1', '1', '1', '1'),
(170, 190, 0, '0.020', '0.025', 179, '18', '', '', '2019-07-31', '', '2019-07-31', '', '1', '1', '1', '1'),
(171, 191, 0, '0.030', '0.050', 179, '18', '', '', '2019-07-31', '', '2019-07-31', '', '1', '1', '1', '1'),
(172, 192, 0, '0.050', '0.070', 179, '18', '', '', '2019-07-31', '', '2019-07-31', '', '1', '1', '1', '1'),
(173, 193, 0, '0.035', '0.035', 180, '42', '', '', '2019-07-31', '', '2019-07-31', '', '1', '1', '1', '1'),
(174, 194, 0, '0.260', '0.260', 182, '53', '', '', '2019-07-31', '', '2019-07-31', '', '1', '1', '1', '1'),
(175, 195, 0, '0.020', '0.020', 181, '42', '', '', '2019-07-31', '', '2019-07-31', '', '1', '1', '1', '1'),
(176, 78, 0, '0.500', '0.560', 69, '18', '', '', '2019-08-05', '', '2019-08-05', '', '1', '1', '1', '1'),
(177, 90, 0, '1.280', '1.750', 69, '18', '', '', '2019-08-05', '', '2019-08-05', '', '1', '1', '1', '1'),
(179, 99, 0, '0.200', '0.233', 69, '18', '', '', '2019-08-13', '', '2019-08-13', '', '1', '1', '1', '1'),
(180, 98, 0, '0.340', '0.386', 69, '18', '', '', '2019-08-13', '', '2019-08-13', '', '1', '1', '1', '1'),
(181, 100, 0, '0.028', '0.048', 69, '18', '', '', '2019-08-13', '', '2019-08-13', '', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_po_order`
--

CREATE TABLE `tbl_po_order` (
  `id` int(11) NOT NULL,
  `po_order_no` varchar(200) DEFAULT NULL,
  `vendor_id` varchar(200) DEFAULT NULL,
  `production_id` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `shape_id` varchar(200) DEFAULT NULL,
  `part_id` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `shape_qty` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_date` date NOT NULL,
  `author_id` varchar(200) NOT NULL,
  `author_date` date NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `comp_id` varchar(200) NOT NULL,
  `zone_id` varchar(200) NOT NULL,
  `brnh_id` varchar(200) NOT NULL,
  `divn_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_po_order`
--

INSERT INTO `tbl_po_order` (`id`, `po_order_no`, `vendor_id`, `production_id`, `date`, `shape_id`, `part_id`, `qty`, `type`, `shape_qty`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '001', '4', '1', '2019-01-15', '38', '44,45', '5,5', 'Shape', '5', '', '2019-01-15', '', '2019-01-15', 'A', '1', '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_po_order_log`
--

CREATE TABLE `tbl_po_order_log` (
  `id` int(11) NOT NULL,
  `po_order_no` varchar(200) DEFAULT NULL,
  `vendor_id` varchar(200) DEFAULT NULL,
  `production_id` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `shape_id` varchar(200) DEFAULT NULL,
  `part_id` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `shape_qty` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_date` date NOT NULL,
  `author_id` varchar(200) NOT NULL,
  `author_date` date NOT NULL,
  `status` varchar(200) NOT NULL,
  `comp_id` varchar(200) NOT NULL,
  `zone_id` varchar(200) NOT NULL,
  `brnh_id` varchar(200) NOT NULL,
  `divn_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_po_order_log`
--

INSERT INTO `tbl_po_order_log` (`id`, `po_order_no`, `vendor_id`, `production_id`, `date`, `shape_id`, `part_id`, `qty`, `type`, `shape_qty`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '001', '4', '1', '2019-01-15', '38', '44', '5', 'Shape', '5', '', '2019-01-15', '', '2019-01-15', '', '1', '1', '', ''),
(2, '001', '4', '1', '2019-01-15', '38', '45', '5', 'Shape', '5', '', '2019-01-15', '', '2019-01-15', '', '1', '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_production_available_order`
--

CREATE TABLE `tbl_production_available_order` (
  `id` int(11) NOT NULL,
  `vendor_id` varchar(200) DEFAULT NULL,
  `job_order_id` varchar(200) DEFAULT NULL,
  `lot_no` varchar(200) DEFAULT NULL,
  `order_no` varchar(200) DEFAULT NULL,
  `check_date` varchar(200) DEFAULT NULL,
  `check_no` varchar(200) DEFAULT NULL,
  `order_type` varchar(200) DEFAULT NULL,
  `grn_type` varchar(200) DEFAULT NULL,
  `module_name` varchar(200) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `transfer_qty` varchar(200) DEFAULT NULL,
  `repair_qty` varchar(200) DEFAULT NULL,
  `scrap_qty` varchar(200) DEFAULT NULL,
  `test_qty` varchar(200) DEFAULT NULL,
  `qty_weight` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `weight` varchar(200) DEFAULT NULL,
  `total_weight` varchar(200) DEFAULT NULL,
  `rate` varchar(200) DEFAULT NULL,
  `total_rm_rate` varchar(200) DEFAULT NULL,
  `total_labour_rate` varchar(200) DEFAULT NULL,
  `total_cost` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_production_available_order`
--

INSERT INTO `tbl_production_available_order` (`id`, `vendor_id`, `job_order_id`, `lot_no`, `order_no`, `check_date`, `check_no`, `order_type`, `grn_type`, `module_name`, `productid`, `date`, `transfer_qty`, `repair_qty`, `scrap_qty`, `test_qty`, `qty_weight`, `name`, `weight`, `total_weight`, `rate`, `total_rm_rate`, `total_labour_rate`, `total_cost`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '6', '1', '001', 'JO-001', '', '', '', '', '', '44', '', '75', '', '', '', '25', '', '', '', '', '', '', '', '1', NULL, '2019-03-25', NULL, 'A', '1', '1', '1', NULL),
(2, '6', '1', '001', 'JO-001', '', '', '', '', '', '45', '', '80', '', '', '', '100', '', '', '', '', '', '', '', '1', NULL, '2019-03-25', NULL, 'A', '1', '1', '1', NULL),
(3, '6', '1', '001', 'JO-001', '', '', '', '', '', '44', '', '75', '', '', '', '28', '', '', '', '', '', '', '', '1', NULL, '2019-03-25', NULL, 'A', '1', '1', '1', NULL),
(4, '6', '1', '001', 'JO-001', '', '', '', '', '', '45', '', '70', '', '', '', '93', '', '', '', '', '', '', '', '1', NULL, '2019-03-25', NULL, 'A', '1', '1', '1', NULL),
(5, '6', '1', '001', 'JO-001', '2019-03-25', 'CK-001', 'Job Order', '', '', '44', '', '25', '10', '2', '', '', 'CJ1', '', '', '', '', '', '', '1', NULL, '2019-03-25', NULL, 'A', '1', '1', '1', NULL),
(6, '6', '1', '001', 'JO-001', '2019-03-25', 'CK-001', 'Job Order', '', '', '45', '', '45', '18', '1', '', '', 'CJ2', '', '', '', '', '', '', '1', NULL, '2019-03-25', NULL, 'A', '1', '1', '1', NULL),
(7, '4', '4', '001', '001', '', '', '', '', '', '44', '', '1', '', '', '', '', '', '', '', '', '', '', '', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(8, '4', '4', '001', '001', '', '', '', '', '', '45', '', '1', '', '', '', '', '', '', '', '', '', '', '', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(9, '10', '5', '001', 'KJ-002', '', '', '', '', '', '44', '', '10', '', '', '', '', '', '', '', '', '', '', '', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(10, '10', '5', '001', 'KJ-002', '', '', '', '', '', '45', '', '10', '', '', '', '', '', '', '', '', '', '', '', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(11, '10', '5', '001', 'KJ-002', '', '', '', '', '', '45', '', '10', '', '', '', '', '', '', '', '', '', '', '', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(12, '10', '5', '001', 'KJ-002', '2019-04-02', 'CK-002', 'Kora Order', '', '', '44', '', '8', '1', '1', '', '', 'CJ1', '', '', '', '', '', '', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(13, '10', '5', '001', 'KJ-002', '2019-04-02', 'CK-002', 'Kora Order', '', '', '45', '', '8', '2', '', '', '', 'CJ2', '', '', '', '', '', '', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(14, '4', '8', '001', 'ord001', '', '', '', '', '', '44', '', '1', '', '', '', '', '', '', '', '', '', '', '', '1', NULL, '2019-04-09', NULL, 'A', '1', '1', '1', NULL),
(15, '4', '8', '001', 'ord001', '', '', '', '', '', '45', '', '1', '', '', '', '', '', '', '', '', '', '', '', '1', NULL, '2019-04-09', NULL, 'A', '1', '1', '1', NULL),
(16, '4', '8', '001', 'ord001', '2019-04-09', 'check0101', 'Finish Order', '', '', '44', '', '1', '', '', '89', '', '', '', '', '', '', '', '', '1', NULL, '2019-04-09', NULL, 'A', '1', '1', '1', NULL),
(17, '4', '8', '001', 'ord001', '2019-04-09', 'check0101', 'Finish Order', '', '', '45', '', '1', '', '', '8', '', '', '', '', '', '', '', '', '1', NULL, '2019-04-09', NULL, 'A', '1', '1', '1', NULL),
(18, '4', '14', '002', 'JOB0098', '', '', '', '', '', '25', '', '1', '', '', '', '', '', '5', '5', '1', '5', '5', '10', '1', NULL, '2019-05-14', NULL, 'A', '1', '1', '1', NULL),
(19, '10', '5', '001', 'KJ-002', '2019-05-23', 'nbvkv', 'Kora Order', '', '', '44', '', '3', '', '', '', '', 'gv', '', '', '', '', '', '', '1', NULL, '2019-05-23', NULL, 'A', '1', '1', '1', NULL),
(20, '4', '4', '001', '001', '2019-06-14', 'check005', 'Kora Order', '', '', '44', '', '1', '', '', '', '', '', '', '', '', '', '', '', '1', NULL, '2019-06-14', NULL, 'A', '1', '1', '1', NULL),
(21, '4', '4', '001', '001', '2019-06-14', 'check005', 'Kora Order', '', '', '45', '', '1', '', '', '', '', '', '', '', '', '', '', '', '1', NULL, '2019-06-14', NULL, 'A', '1', '1', '1', NULL),
(22, '4', '28', '001', 'od009', '', '', '', '', '', '44', '', '1', '', '', '', '', '', '', '', '', '', '', '', '1', NULL, '2019-06-14', NULL, 'A', '1', '1', '1', NULL),
(23, '4', '28', '001', 'od009', '', '', '', '', '', '45', '', '1', '', '', '', '', '', '', '', '', '', '', '', '1', NULL, '2019-06-14', NULL, 'A', '1', '1', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_production_dispatch`
--

CREATE TABLE `tbl_production_dispatch` (
  `id` int(11) NOT NULL,
  `vendor_id` varchar(200) DEFAULT NULL,
  `job_order_id` varchar(200) DEFAULT NULL,
  `lot_no` varchar(200) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `po_no` varchar(200) DEFAULT NULL,
  `po_date` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_production_dispatch`
--

INSERT INTO `tbl_production_dispatch` (`id`, `vendor_id`, `job_order_id`, `lot_no`, `productid`, `date`, `po_no`, `po_date`, `qty`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '1', '001', '001', '56', '2019-04-09', '001', '2019-04-09', '60', NULL, NULL, '2019-04-09', '2019-04-09', 'A', '1', '1', NULL, NULL),
(2, '1', '001', '001', '57', '2019-04-09', '001', '2019-04-09', '35', NULL, NULL, '2019-04-09', '2019-04-09', 'A', '1', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_production_grn_dtl`
--

CREATE TABLE `tbl_production_grn_dtl` (
  `inbound_dtl_id` int(11) NOT NULL,
  `inboundrhdr` int(11) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `receive_qty` varchar(200) DEFAULT NULL,
  `remaining_qty` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_production_grn_dtl`
--

INSERT INTO `tbl_production_grn_dtl` (`inbound_dtl_id`, `inboundrhdr`, `productid`, `receive_qty`, `remaining_qty`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, 1, '44', '4', '5', '1', NULL, '2019-01-18', NULL, 'A', '1', '1', '1', NULL),
(2, 2, '44', '1', '1', '1', NULL, '2019-01-18', NULL, 'A', '1', '1', '1', NULL),
(3, 2, '45', '4', '5', '1', NULL, '2019-01-18', NULL, 'A', '1', '1', '1', NULL),
(4, 3, '45', '1', '1', '1', NULL, '2019-01-18', NULL, 'A', '1', '1', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_production_grn_hdr`
--

CREATE TABLE `tbl_production_grn_hdr` (
  `inboundid` int(11) NOT NULL,
  `production_id` varchar(200) DEFAULT NULL,
  `storage_location` varchar(200) DEFAULT NULL,
  `po_no` varchar(200) DEFAULT NULL,
  `vendor_id` varchar(200) DEFAULT NULL,
  `grn_date` varchar(200) DEFAULT NULL,
  `grn_no` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_production_grn_hdr`
--

INSERT INTO `tbl_production_grn_hdr` (`inboundid`, `production_id`, `storage_location`, `po_no`, `vendor_id`, `grn_date`, `grn_no`, `date`, `maker_id`, `maker_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '1', '', '001', '4', '', '', '', '1', '2019-01-18', 'A', '1', '1', '1', '1'),
(2, '1', '', '001', '4', '', '', '', '1', '2019-01-18', 'A', '1', '1', '1', '1'),
(3, '1', '', '001', '4', '', '', '', '1', '2019-01-18', 'A', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_production_grn_log`
--

CREATE TABLE `tbl_production_grn_log` (
  `inbound_dtl_id` int(11) NOT NULL,
  `inboundrhdr` int(11) DEFAULT NULL,
  `po_no` varchar(200) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `grn_no` varchar(200) DEFAULT NULL,
  `grn_date` varchar(200) DEFAULT NULL,
  `receive_qty` varchar(200) DEFAULT NULL,
  `outboundqty` int(11) DEFAULT NULL,
  `clear_status` tinyint(1) NOT NULL DEFAULT 0,
  `remaining_qty` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_production_grn_log`
--

INSERT INTO `tbl_production_grn_log` (`inbound_dtl_id`, `inboundrhdr`, `po_no`, `productid`, `grn_no`, `grn_date`, `receive_qty`, `outboundqty`, `clear_status`, `remaining_qty`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, 1, '001', '44', '0', '0', '4', 0, 0, '5', '1', NULL, '2019-01-18', NULL, 'A', '1', '1', '1', NULL),
(2, 2, '001', '44', '0', '0', '1', 0, 0, '1', '1', NULL, '2019-01-18', NULL, 'A', '1', '1', '1', NULL),
(3, 2, '001', '45', '0', '0', '4', 0, 0, '5', '1', NULL, '2019-01-18', NULL, 'A', '1', '1', '1', NULL),
(4, 3, '001', '45', '0', '0', '1', 0, 0, '1', '1', NULL, '2019-01-18', NULL, 'A', '1', '1', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_production_order_check`
--

CREATE TABLE `tbl_production_order_check` (
  `id` int(11) NOT NULL,
  `vendor_id` varchar(200) DEFAULT NULL,
  `job_order_id` varchar(200) DEFAULT NULL,
  `lot_no` varchar(200) DEFAULT NULL,
  `order_no` varchar(200) DEFAULT NULL,
  `check_date` varchar(200) DEFAULT NULL,
  `check_no` varchar(200) DEFAULT NULL,
  `order_type` varchar(200) DEFAULT NULL,
  `grn_type` varchar(200) DEFAULT NULL,
  `module_name` varchar(200) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `fg_id` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `transfer_qty` varchar(200) DEFAULT NULL,
  `repair_qty` varchar(200) DEFAULT NULL,
  `scrap_qty` varchar(200) DEFAULT NULL,
  `test_qty` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_production_order_check`
--

INSERT INTO `tbl_production_order_check` (`id`, `vendor_id`, `job_order_id`, `lot_no`, `order_no`, `check_date`, `check_no`, `order_type`, `grn_type`, `module_name`, `productid`, `fg_id`, `date`, `transfer_qty`, `repair_qty`, `scrap_qty`, `test_qty`, `name`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '6', '1', '001', 'JO-001', '2019-03-25', 'CK-001', 'Job Order', '', '', '44', '', '', '25', '10', '2', '', 'CJ1', '1', NULL, '2019-03-25', NULL, 'A', '1', '1', '1', NULL),
(2, '6', '1', '001', 'JO-001', '2019-03-25', 'CK-001', 'Job Order', '', '', '45', '', '', '45', '18', '1', '', 'CJ2', '1', NULL, '2019-03-25', NULL, 'A', '1', '1', '1', NULL),
(3, '10', '5', '001', 'KJ-002', '2019-04-02', 'CK-002', 'Kora Order', '', '', '44', '', '', '8', '1', '1', '', 'CJ1', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(4, '10', '5', '001', 'KJ-002', '2019-04-02', 'CK-002', 'Kora Order', '', '', '45', '', '', '8', '2', '', '', 'CJ2', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(5, '4', '8', '001', 'ord001', '2019-04-09', 'check0101', 'Finish Order', '', '', '44', '', '', '1', '', '', '', '', '1', NULL, '2019-04-09', NULL, 'A', '1', '1', '1', NULL),
(6, '4', '8', '001', 'ord001', '2019-04-09', 'check0101', 'Finish Order', '', '', '45', '', '', '1', '', '', '', '', '1', NULL, '2019-04-09', NULL, 'A', '1', '1', '1', NULL),
(7, '', '9', '001', 'ord0098', '2019-04-09', 'check00101', 'Inspection', '', '', '56', '56', '', '60', '', '', '', '', '1', NULL, '2019-04-09', NULL, 'A', '1', '1', '1', NULL),
(8, '', '9', '001', 'ord0098', '2019-04-09', 'chk098', 'Inspection', '', '', '57', '57', '', '35', '', '', '', '', '1', NULL, '2019-04-09', NULL, 'A', '1', '1', '1', NULL),
(9, '10', '5', '001', 'KJ-002', '2019-05-23', 'nbvkv', 'Kora Order', '', '', '44', '', '', '3', '', '', '', 'gv', '1', NULL, '2019-05-23', NULL, 'A', '1', '1', '1', NULL),
(10, '4', '4', '001', '001', '2019-06-14', 'check005', 'Kora Order', '', '', '44', '', '', '1', '', '', '', '', '1', NULL, '2019-06-14', NULL, 'A', '1', '1', '1', NULL),
(11, '4', '4', '001', '001', '2019-06-14', 'check005', 'Kora Order', '', '', '45', '', '', '1', '', '', '', '', '1', NULL, '2019-06-14', NULL, 'A', '1', '1', '1', NULL),
(12, '4', '28', '001', 'od009', '2019-06-14', 'od0010', 'Finish Order', '', '', '44', '', '', '', '', '', '1', 'safi khan', '1', NULL, '2019-06-14', NULL, 'A', '1', '1', '1', NULL),
(13, '4', '28', '001', 'od009', '2019-06-14', 'od0010', 'Finish Order', '', '', '45', '', '', '', '', '', '1', 'safi khan', '1', NULL, '2019-06-14', NULL, 'A', '1', '1', '1', NULL),
(14, '4', '8', '001', 'ord001', '2019-06-17', 'chk001', 'Finish Order', '', '', '44', '', '', '', '', '', '1', 'safi khan', '1', NULL, '2019-06-17', NULL, 'A', '1', '1', '1', NULL),
(15, '4', '8', '001', 'ord001', '2019-06-17', 'chk001', 'Finish Order', '', '', '45', '', '', '', '', '', '1', 'safi khan', '1', NULL, '2019-06-17', NULL, 'A', '1', '1', '1', NULL),
(16, '4', '28', '001', 'od009', '2019-06-28', 'chkoo10', 'Finish Order', '', '', '44', '', '', '', '', '', '1', 'safi khan', '1', NULL, '2019-06-28', NULL, 'A', '1', '1', '1', NULL),
(17, '10', '5', '001', 'KJ-002', '2019-06-28', 'chk0090', 'Kora Order', '', '', '45', '', '', '', '', '5', '', '', '1', NULL, '2019-06-28', NULL, 'A', '1', '1', '1', NULL),
(18, '10', '5', '001', 'KJ-002', '2019-06-28', 'check0098', 'Kora Order', '', '', '45', '', '', '', '2', '', '', '', '1', NULL, '2019-06-28', NULL, 'A', '1', '1', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_production_order_log`
--

CREATE TABLE `tbl_production_order_log` (
  `id` int(11) NOT NULL,
  `rm_id` varchar(200) DEFAULT NULL,
  `vendor_id` varchar(200) DEFAULT NULL,
  `lot_no` varchar(200) DEFAULT NULL,
  `job_order_id` varchar(200) DEFAULT NULL,
  `order_no` varchar(200) DEFAULT NULL,
  `grn_date` varchar(200) DEFAULT NULL,
  `grn_no` varchar(200) DEFAULT NULL,
  `order_type` varchar(200) DEFAULT NULL,
  `grn_type` varchar(200) DEFAULT NULL,
  `module_name` varchar(200) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `weight` varchar(200) DEFAULT NULL,
  `total_weight` varchar(200) DEFAULT NULL,
  `rate` varchar(200) DEFAULT NULL,
  `total_rm_rate` varchar(200) DEFAULT NULL,
  `total_labour_rate` varchar(200) DEFAULT NULL,
  `total_cost` varchar(200) DEFAULT NULL,
  `process_ends` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_production_order_log`
--

INSERT INTO `tbl_production_order_log` (`id`, `rm_id`, `vendor_id`, `lot_no`, `job_order_id`, `order_no`, `grn_date`, `grn_no`, `order_type`, `grn_type`, `module_name`, `productid`, `date`, `qty`, `weight`, `total_weight`, `rate`, `total_rm_rate`, `total_labour_rate`, `total_cost`, `process_ends`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '', '6', '001', '1', 'JO-001', '2019-03-25', 'GRN-001', 'Job Order', 'Job Order', '', '44', '', '75', '', '', '', '', '', '', '1', '1', NULL, '2019-03-25', NULL, 'A', '1', '1', '1', NULL),
(2, '', '6', '001', '1', 'JO-001', '2019-03-25', 'GRN-001', 'Job Order', 'Job Order', '', '45', '', '80', '', '', '', '', '', '', '1', '1', NULL, '2019-03-25', NULL, 'A', '1', '1', '1', NULL),
(3, '', '6', '001', '1', 'JO-001', '2019-03-25', 'GRN-002', 'Job Order', 'Job Order', '', '44', '', '75', '', '', '', '', '', '', '1', '1', NULL, '2019-03-25', NULL, 'A', '1', '1', '1', NULL),
(4, '', '6', '001', '1', 'JO-001', '2019-03-25', 'GRN-002', 'Job Order', 'Job Order', '', '45', '', '70', '', '', '', '', '', '', '1', '1', NULL, '2019-03-25', NULL, 'A', '1', '1', '1', NULL),
(5, '', '4', '001', '4', '001', '2019-04-02', 'GRN-001', 'Kora Order', 'Kora Order', '', '44', '', '1', '', '', '', '', '', '', '0', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(6, '', '4', '001', '4', '001', '2019-04-02', 'GRN-001', 'Kora Order', 'Kora Order', '', '45', '', '1', '', '', '', '', '', '', '0', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(7, '', '10', '001', '5', 'KJ-002', '2019-04-02', 'GRN-002', 'Kora Order', 'Kora Order', '', '44', '', '10', '', '', '', '', '', '', '0', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(8, '', '10', '001', '5', 'KJ-002', '2019-04-02', 'GRN-002', 'Kora Order', 'Kora Order', '', '45', '', '10', '', '', '', '', '', '', '0', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(9, '', '10', '001', '5', 'KJ-002', '2019-04-02', 'GRN-002', 'Kora Order', 'Kora Order', '', '45', '', '10', '', '', '', '', '', '', '0', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(10, '', '4', '001', '8', 'ord001', '2019-04-09', 'grn0010', 'Finish Order', 'Finish Order', '', '44', '', '1', '', '', '', '', '', '', '1', '1', NULL, '2019-04-09', NULL, 'A', '1', '1', '1', NULL),
(11, '', '4', '001', '8', 'ord001', '2019-04-09', 'grn0010', 'Finish Order', 'Finish Order', '', '45', '', '1', '', '', '', '', '', '', '1', '1', NULL, '2019-04-09', NULL, 'A', '1', '1', '1', NULL),
(12, '', '4', '002', '14', 'JOB0098', '2019-05-14', 'grn001', 'Job Order', 'Job Order', '', '25', '', '1', '5', '5', '1', '5', '5', '10', '1', '1', NULL, '2019-05-14', NULL, 'A', '1', '1', '1', NULL),
(13, '', '4', '001', '28', 'od009', '2019-06-14', 'od001', 'Finish Order', 'Finish Order', '', '44', '', '1', '', '', '', '', '', '', '1', '1', NULL, '2019-06-14', NULL, 'A', '1', '1', '1', NULL),
(14, '', '4', '001', '28', 'od009', '2019-06-14', 'od001', 'Finish Order', 'Finish Order', '', '45', '', '1', '', '', '', '', '', '', '1', '1', NULL, '2019-06-14', NULL, 'A', '1', '1', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_production_order_repair`
--

CREATE TABLE `tbl_production_order_repair` (
  `id` int(11) NOT NULL,
  `vendor_id` varchar(200) DEFAULT NULL,
  `job_order_id` varchar(200) DEFAULT NULL,
  `lot_no` varchar(200) DEFAULT NULL,
  `order_no` varchar(200) DEFAULT NULL,
  `repair_date` varchar(200) DEFAULT NULL,
  `repair_no` varchar(200) DEFAULT NULL,
  `order_type` varchar(200) DEFAULT NULL,
  `grn_type` varchar(200) DEFAULT NULL,
  `module_name` varchar(200) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_production_order_repair`
--

INSERT INTO `tbl_production_order_repair` (`id`, `vendor_id`, `job_order_id`, `lot_no`, `order_no`, `repair_date`, `repair_no`, `order_type`, `grn_type`, `module_name`, `productid`, `date`, `qty`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '10', '5', '001', 'KJ-002', '2019-04-02', 'rp001', '', '', '', '44', '', '1', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(2, '10', '5', '001', 'KJ-002', '2019-04-02', 'rp001', '', '', '', '45', '', '1', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_production_order_transfer_another_module`
--

CREATE TABLE `tbl_production_order_transfer_another_module` (
  `id` int(11) NOT NULL,
  `vendor_id` varchar(200) DEFAULT NULL,
  `job_order_id` varchar(200) DEFAULT NULL,
  `jo_no` varchar(200) DEFAULT NULL,
  `lot_no` varchar(200) DEFAULT NULL,
  `order_no` varchar(200) DEFAULT NULL,
  `transfer_date` varchar(200) DEFAULT NULL,
  `transfer_no` varchar(200) DEFAULT NULL,
  `order_type` varchar(200) DEFAULT NULL,
  `grn_type` varchar(200) DEFAULT NULL,
  `module_name` varchar(200) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_production_order_transfer_another_module`
--

INSERT INTO `tbl_production_order_transfer_another_module` (`id`, `vendor_id`, `job_order_id`, `jo_no`, `lot_no`, `order_no`, `transfer_date`, `transfer_no`, `order_type`, `grn_type`, `module_name`, `productid`, `date`, `qty`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '6', '1', '', '001', '001', '2019-03-26', 'trans001', '', '', 'Kora', '44', '', '1', '1', NULL, '2019-03-26', NULL, 'A', '1', '1', '1', NULL),
(2, '6', '1', '', '001', '001', '2019-03-26', 'trans001', '', '', 'Kora', '45', '', '1', '1', NULL, '2019-03-26', NULL, 'A', '1', '1', '1', NULL),
(3, '6', '1', '', '001', '001', '2019-04-02', 'TRA002', '', '', 'Kora', '44', '', '24', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(4, '6', '1', '', '001', '001', '2019-04-02', 'TRA002', '', '', 'Kora', '45', '', '24', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(5, '6', '1', '', '001', '001', '2019-04-02', 'tra', '', '', 'Finish', '44', '', '1', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(6, '6', '1', '', '001', '001', '2019-04-02', 'tra', '', '', 'Finish', '45', '', '1', '1', NULL, '2019-04-02', NULL, 'A', '1', '1', '1', NULL),
(7, '6', '1', '', '001', '001', '2019-04-09', 'trans001', '', '', 'Inspection', '56', '', '60', '1', NULL, '2019-04-09', NULL, 'A', '1', '1', '1', NULL),
(8, '6', '1', '', '001', '001', '2019-04-09', 'trans001', '', '', 'Inspection', '57', '', '40', '1', NULL, '2019-04-09', NULL, 'A', '1', '1', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_inspection`
--

CREATE TABLE `tbl_product_inspection` (
  `id` int(11) NOT NULL,
  `lot_no` varchar(200) DEFAULT NULL,
  `order_no` varchar(200) DEFAULT NULL,
  `product_id` varchar(200) DEFAULT NULL,
  `check_point` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_date` date NOT NULL,
  `author_id` varchar(200) NOT NULL,
  `author_date` date NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `comp_id` varchar(200) NOT NULL,
  `zone_id` varchar(200) NOT NULL,
  `brnh_id` varchar(200) NOT NULL,
  `divn_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_inspection`
--

INSERT INTO `tbl_product_inspection` (`id`, `lot_no`, `order_no`, `product_id`, `check_point`, `qty`, `description`, `type`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '001', 'od009', '44', 'Pass', '1', 'hi', '', '', '2019-06-26', '', '2019-06-26', 'A', '1', '1', '', ''),
(2, '001', 'od009', '45', 'Pass', '1', 'hi', '', '', '2019-06-26', '', '2019-06-26', 'A', '1', '1', '', ''),
(3, '001', 'ord001', '44', 'Fail', '1', 'hii', '', '', '2019-06-26', '', '2019-06-26', 'A', '1', '1', '', ''),
(5, '001', '', '56', 'Pass', '1', 'aa', 'Inspection', '', '2019-07-01', '', '2019-07-01', 'A', '1', '1', '', ''),
(6, '001', '', '57', 'Pass', '5', 'pass', 'Inspection', '', '2019-07-03', '', '2019-07-03', 'A', '1', '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_packing`
--

CREATE TABLE `tbl_product_packing` (
  `id` int(11) NOT NULL,
  `lot_no` varchar(200) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `set_of` varchar(200) DEFAULT NULL,
  `case_qty` varchar(200) DEFAULT NULL,
  `case_pack` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `packing_qty` varchar(200) DEFAULT NULL,
  `loose_qty` varchar(200) DEFAULT NULL,
  `grn_no` varchar(200) DEFAULT NULL,
  `grn_date` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_date` date NOT NULL,
  `author_id` varchar(200) NOT NULL,
  `author_date` date NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `comp_id` varchar(200) NOT NULL,
  `zone_id` varchar(200) NOT NULL,
  `brnh_id` varchar(200) NOT NULL,
  `divn_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_packing`
--

INSERT INTO `tbl_product_packing` (`id`, `lot_no`, `productid`, `set_of`, `case_qty`, `case_pack`, `qty`, `packing_qty`, `loose_qty`, `grn_no`, `grn_date`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '001', '57', '6', '20', '120', '500', '4', '17', 'gn', '2019-07-09', '1', '2019-07-09', '', '0000-00-00', 'A', '1', '1', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_serial`
--

CREATE TABLE `tbl_product_serial` (
  `serial_number` int(11) NOT NULL,
  `product_id` varchar(200) DEFAULT NULL,
  `quantity` varchar(200) DEFAULT '0',
  `qn_pc` varchar(200) DEFAULT '0',
  `location_id` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author_date` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_serial`
--

INSERT INTO `tbl_product_serial` (`serial_number`, `product_id`, `quantity`, `qn_pc`, `location_id`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '71', '53.75', '7', '1', NULL, '19-03-07', NULL, '2019-03-07 00:00:00', 'A', '1', '1', '1', '1'),
(2, '1', '230.854', '33', '1', NULL, '19-03-07', NULL, '2019-03-07 00:00:00', 'A', '1', '1', '1', '1'),
(3, '69', '170.623', '22', '1', NULL, '19-03-07', NULL, '2019-03-07 00:00:00', 'A', '1', '1', '1', '1'),
(4, '2', '198.503', '25', '1', NULL, '19-03-07', NULL, '2019-03-07 00:00:00', 'A', '1', '1', '1', '1'),
(5, '44', '163', '', '1', NULL, '19-03-25', NULL, '2019-03-25 00:00:00', 'A', '1', '1', '1', '1'),
(6, '45', '173', '', '1', NULL, '19-03-25', NULL, '2019-03-25 00:00:00', 'A', '1', '1', '1', '1'),
(7, '25', '1', '', '1', NULL, '19-05-14', NULL, '2019-05-14 00:00:00', 'A', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_serial_log`
--

CREATE TABLE `tbl_product_serial_log` (
  `serial_number` int(11) NOT NULL,
  `product_id` varchar(200) DEFAULT NULL,
  `quantity` varchar(200) DEFAULT '0',
  `qn_pc` varchar(200) DEFAULT NULL,
  `location_id` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author_date` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_serial_log`
--

INSERT INTO `tbl_product_serial_log` (`serial_number`, `product_id`, `quantity`, `qn_pc`, `location_id`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '10', '100', '', '1', NULL, '18-12-14', NULL, '2018-12-14 00:00:00', 'A', '1', '1', '1', '1'),
(2, '1', '100', '', '1', NULL, '18-12-22', NULL, '2018-12-22 00:00:00', 'A', '', '', '2', ''),
(3, '69', '100', '', '1', NULL, '18-12-22', NULL, '2018-12-22 00:00:00', 'A', '', '', '2', ''),
(4, '4', '10', '', '1', NULL, '18-12-27', NULL, '2018-12-27 00:00:00', 'A', '1', '1', '1', '1'),
(5, '5', '7', '', '1', NULL, '18-12-27', NULL, '2018-12-27 00:00:00', 'A', '1', '1', '1', '1'),
(6, '1', '50', '', '1', NULL, '19-01-10', NULL, '2019-01-10 00:00:00', 'A', '1', '1', '1', '1'),
(7, '69', '100', '', '1', NULL, '19-01-10', NULL, '2019-01-10 00:00:00', 'A', '1', '1', '1', '1'),
(8, '56', '100', '', '1', NULL, '19-01-11', NULL, '2019-01-11 00:00:00', 'A', '1', '1', '1', '1'),
(9, '57', '100', '', '1', NULL, '19-01-11', NULL, '2019-01-11 00:00:00', 'A', '1', '1', '1', '1'),
(10, '44', '4', '', '1', NULL, '19-01-18', NULL, '2019-01-18 00:00:00', 'A', '1', '1', '1', '1'),
(11, '45', '4', '', '1', NULL, '19-01-18', NULL, '2019-01-18 00:00:00', 'A', '1', '1', '1', '1'),
(12, '71', '300', '', '1', NULL, '19-02-08', NULL, '2019-02-08 00:00:00', 'A', '1', '1', '1', '1'),
(13, '2', '450', '', '1', NULL, '19-02-08', NULL, '2019-02-08 00:00:00', 'A', '1', '1', '1', '1'),
(14, '71', '130', '', '1', NULL, '19-03-07', NULL, '2019-03-07 00:00:00', 'A', '1', '1', '1', '1'),
(15, '1', '230.854', '3', '1', NULL, '19-03-07', NULL, '2019-03-07 00:00:00', 'A', '1', '1', '1', '1'),
(16, '69', '170.623', '2', '1', NULL, '19-03-07', NULL, '2019-03-07 00:00:00', 'A', '1', '1', '1', '1'),
(17, '2', '198.503', '2', '1', NULL, '19-03-07', NULL, '2019-03-07 00:00:00', 'A', '1', '1', '1', '1'),
(18, '44', '75', '', '1', NULL, '19-03-25', NULL, '2019-03-25 00:00:00', 'A', '1', '1', '1', '1'),
(19, '45', '80', '', '1', NULL, '19-03-25', NULL, '2019-03-25 00:00:00', 'A', '1', '1', '1', '1'),
(20, '25', '1', '', '1', NULL, '19-05-14', NULL, '2019-05-14 00:00:00', 'A', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_stock`
--

CREATE TABLE `tbl_product_stock` (
  `Product_id` int(11) NOT NULL,
  `scrap_id` varchar(200) DEFAULT NULL,
  `sku_no` varchar(200) DEFAULT NULL,
  `quantity` varchar(200) DEFAULT '0',
  `qty_box` varchar(200) DEFAULT NULL,
  `qty_set` varchar(200) DEFAULT NULL,
  `circle_weight` varchar(200) DEFAULT NULL,
  `productname` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `category` varchar(200) DEFAULT NULL,
  `unitprice_purchase` varchar(200) DEFAULT NULL,
  `unitprice_sale` varchar(200) DEFAULT NULL,
  `usageunit` varchar(255) DEFAULT NULL,
  `mrp` varchar(255) DEFAULT NULL,
  `product_image` varchar(225) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `ctn_lenght` varchar(200) DEFAULT NULL,
  `ctn_width` varchar(200) DEFAULT NULL,
  `ctn_height` varchar(200) DEFAULT NULL,
  `mst` varchar(200) DEFAULT NULL,
  `cbm` varchar(200) DEFAULT NULL,
  `volume_weight` varchar(200) DEFAULT NULL,
  `weight` varchar(200) DEFAULT NULL,
  `net_weight` varchar(200) DEFAULT NULL,
  `cast_weight` varchar(200) DEFAULT NULL,
  `percentage` varchar(200) DEFAULT NULL,
  `tolerance_percentage` varchar(200) DEFAULT NULL,
  `packing` varchar(200) DEFAULT NULL,
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_stock`
--

INSERT INTO `tbl_product_stock` (`Product_id`, `scrap_id`, `sku_no`, `quantity`, `qty_box`, `qty_set`, `circle_weight`, `productname`, `category`, `unitprice_purchase`, `unitprice_sale`, `usageunit`, `mrp`, `product_image`, `maker_id`, `maker_date`, `author_id`, `author_date`, `type`, `ctn_lenght`, `ctn_width`, `ctn_height`, `mst`, `cbm`, `volume_weight`, `weight`, `net_weight`, `cast_weight`, `percentage`, `tolerance_percentage`, `packing`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`, `status`) VALUES
(1, '', 'BI02G', '', '', '', '', 'Brass Ingot Grade 2', '8', '', '', '18', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '13', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(2, '74', 'AI00G', '', '', '', '', 'Aluminium Ingot Grade Local', '18', '', '', '18', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '13', '', '', '', '', '', '', '', '5', '', '2', '5', '', '1', '1', '1', '1', 'A'),
(3, '', 'ART-K', '0', '', '', '', 'Artisan Keepsake', '10', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '33', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(4, '', 'ART-K-LD', '0', '', '', '', 'Artisan Keepsake Lid', '9', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(5, '', 'ART-K-NR', '', '', '', '', 'Artisan Keepsake Neck Ring', '9', '', '', '', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(6, '', 'ART-K-UB', '0', '', '', '', 'Artisan Keepsake Upper Body', '9', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(7, '', 'ART-K-LB', '', '', '', '', 'Artisan Keepsake Lower Body', '17', '', '', '', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(8, '', 'ART-K-BS', '', '', '', '', 'Artisan Keepsake Base', '9', '', '', '', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(9, '0', 'Z4610K', '144', '1', '', '', 'Artisan Keepsake Indigo', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '', '', '', '', '', '', '', '5', '', '', '0', '48', '1', '1', '1', '1', 'A'),
(10, '0', 'Z4611K', '144', '1', '', '', 'Artisan Keepsake Auburn', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '', '', '', '', '0.000', '0.000', '', '5', '', '', '0', '48', '1', '1', '1', '1', 'A'),
(11, '0', 'Z4612K', '432', '1', '', '', 'Artisan Keepsake Pearl', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '', '', '', '', '', '', '', '5', '', '', '0', '48', '1', '1', '1', '1', 'A'),
(12, '0', 'RU4610T', '', '6', '', '', 'Artisan Keepsake Indigo S/6', '0', '', '', '41', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '', '', '', '', '', '', '', '5', '', '', '0', '10', '1', '1', '1', '1', 'A'),
(13, '0', 'RU4611T', '30', '6', '', '', 'Artisan Keepsake Auburn S/6', '0', '', '', '41', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '', '', '', '', '', '', '', '5', '', '', '0', '10', '1', '1', '1', '1', 'A'),
(14, '0', 'RU4612T', '30', '6', '', '', 'Artisan Keepsake Pearl S/6', '0', '', '', '41', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '', '', '', '', '', '', '', '5', '', '', '0', '10', '1', '1', '1', '1', 'A'),
(15, '', 'ART-L', '0', '', '', '', 'Artisan Large', '10', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '33', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(16, '', 'ART-L-LD', '0', '', '', '', 'Artisan Large Lid', '9', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(17, '', 'ART-L-NR', '0', '', '', '', 'Artisan Large Neck ring', '17', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(18, '', 'ART-L-UB', '0', '', '', '', 'Artisan Large Upper Body', '9', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(19, '', 'ART-L-LB', '0', '', '', '', 'Artisan Large Lower Body', '17', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(20, '', 'ART-L-BS', '0', '', '', '', 'Artisan Large Base', '9', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(21, '0', 'RU4610L', '72', '1', '', '', 'Artisan Large Indigo', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '', '', '', '', '', '', '', '5', '', '', '0', '', '1', '1', '1', '1', 'A'),
(22, '0', 'RU4611L', '108', '1', '', '', 'Artisan Large Auburn', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '', '', '', '', '', '', '', '5', '', '', '0', '', '1', '1', '1', '1', 'A'),
(23, '0', 'RU4612L', '144', '1', '', '', 'Artisan Large Pearl', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '', '', '', '', '', '', '', '5', '', '', '0', '8', '1', '1', '1', '1', 'A'),
(24, '0', 'RKS-CB-0', '', '', '', '', 'Rose Keepsake', '15', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(25, '0', 'RKS-CB-0-BD', '', '', '', '', 'Rose Keepsake Bud', '9', '', '', '', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(26, '0', 'RKS-CB-0-PT', '', '', '', '', 'Rose Keepsake Petal', '9', '', '', '', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(27, '0', 'RKS-CB-0-LF', '', '', '', '', 'Rose Keepsake Leaf', '9', '', '', '', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(28, '0', 'RKS-CB-0-ST', '', '', '', '', 'Rose Keepsake Stem', '9', '', '', '', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(29, '0', 'RU2750', '8171', '1', '', '', 'Rose Keepsake Bronze', '0', '', '11', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '57', '40', '41', '16', '0.093', '18.696', '12.000', '', '', '', '0', '16', '1', '1', '1', '1', 'A'),
(30, '0', 'RU2751', '', '1', '', '', 'Rose Keepsake Pewter', '0', '', '11', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '57', '40', '41', '16', '0.09348', '', '12.000', '', '', '', '0', '16', '1', '1', '1', '1', 'A'),
(31, '0', 'RU2752', '223', '1', '', '', 'Rose Keepsake Crimson', '0', '', '11', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '57', '40', '41', '16', '0.09348', '', '12.000', '', '', '', '0', '16', '1', '1', '1', '1', 'A'),
(32, '0', 'RU2753', '', '1', '', '', 'Rose Keepsake Yellow', '0', '', '11', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '57', '40', '41', '16', '0.09348', '', '12.000', '', '', '', '0', '16', '1', '1', '1', '1', 'A'),
(33, '0', 'RU2754', '', '1', '', '', 'Rose Keepsake Pink', '0', '', '11', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '57', '40', '41', '16', '0.09348', '', '12.000', '', '', '', '0', '16', '1', '1', '1', '1', 'A'),
(34, '0', 'RU2755', '', '1', '', '', 'Rose Keepsake White', '0', '', '11', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '57', '40', '41', '16', '0.09348', '', '12.000', '', '', '', '0', '16', '1', '1', '1', '1', 'A'),
(35, '0', 'RU2756', '', '1', '', '', 'Rose Keepsake Pewter Crimson', '0', '', '11', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '57', '40', '41', '16', '0.09348', '', '12.000', '', '', '', '0', '16', '1', '1', '1', '1', 'A'),
(36, '0', 'RU2757', '', '1', '', '', 'Rose Keepsake Lavender', '0', '', '11', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '57', '40', '41', '16', '0.09348', '', '12.000', '', '', '', '0', '16', '1', '1', '1', '1', 'A'),
(37, '0', 'RKS-0-PL', '', '', '', '', 'Rose Keepsake Plug', '9', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(38, '', 'CLS-L', '0', '', '', '', 'Classic Large (Sheet)', '14', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '33', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(39, '', 'CLS-M', '', '', '', '', 'Classic Medium (Sheet)', '14', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '33', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(40, '', 'CLS-S', '', '', '', '', 'Classic Small (Sheet)', '14', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '33', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(41, '', 'CLS-X', '', '', '', '', 'Classic Extra Small (Sheet)', '14', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '33', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(42, '', 'CLS-P', '', '', '', '', 'Classic Petite (Sheet)', '14', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '33', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(43, '', 'CLS-K', '0', '', '', '', 'Classic Keepsake (Cast)', '14', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '33', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(44, '', 'CLS-L-LD', '0', '', '', '', 'Classic Large Lid (Sheet)', '16', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(45, '', 'CLS-L-BD', '0', '', '', '', 'Classic Large Body (Sheet)', '16', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(46, '', 'CLS-M-LD', '0', '', '', '', 'Classic Medium Lid (Sheet)', '16', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(47, '', 'CLS-M-BD', '0', '', '', '', 'Classic Medium Body (Sheet)', '16', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(48, '', 'CLS-S-LD', '', '', '', '', 'Classic Small Lid (Sheet)', '16', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(49, '', 'CLS-S-BD', '0', '', '', '', 'Classic Small Body (Sheet)', '16', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(50, '', 'CLS-X-LD', '0', '', '', '', 'Classic Extra Small Lid (Sheet)', '16', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(51, '', 'CLS-X-BD', '0', '', '', '', 'Classic Extra Small Body (Sheet)', '16', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(52, '', 'CLS-P-LD', '', '', '', '', 'Classic Petite Lid (Sheet)', '16', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(53, '', 'CLS-P-BD', '0', '', '', '', 'Classic Petite Body (Sheet)', '16', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(54, '', 'CLS-K-LD', '0', '', '', '', 'Classic Keepsake Lid (Cast)', '9', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(55, '', 'CLS-K-BD', '0', '', '', '', 'Classic Keepsake Body (Cast)', '9', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '32', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(56, '0', 'RU2801L', '', '1', '', '', 'Classic Bronze Large', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '54', '42', '42', '', '0.095256', '', '', '5', '', '', '0', '8', '1', '1', '1', '1', 'A'),
(57, '0', 'RU2802L', '0', '1', '', '', 'Claasic Pewter Large', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '', '', '', '', '', '', '', '5', '', '', '0', '', '1', '1', '1', '1', 'A'),
(58, '0', 'RU2801M', '', '1', '', '', 'Classic Bronze Medium', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '50', '49.5', '49.5', '', '0.1225125', '', '', '5', '', '', '0', '12', '1', '1', '1', '1', 'A'),
(59, '0', 'RU2802M', '36', '1', '', '', 'Classic Pewter Medium', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '', '', '', '', '', '', '', '5', '', '', '0', '', '1', '1', '1', '1', 'A'),
(60, '0', 'RU2801S', '', '1', '', '', 'Classic Bronze Small', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '62', '42', '42', '', '0.109368', '', '', '5', '', '', '0', '18', '1', '1', '1', '1', 'A'),
(61, '0', 'RU2802S', '72', '1', '', '', 'Classic Pewter Small ', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '', '', '', '', '', '', '', '5', '', '', '0', '', '1', '1', '1', '1', 'A'),
(62, '0', 'RU2801XS', '144', '1', '', '', 'Classic Bronze Extra Small', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '', '', '', '', '', '', '', '5', '', '', '0', '', '1', '1', '1', '1', 'A'),
(63, '0', 'RU2802XS', '360', '1', '', '', 'Classic Pewter Extra Small', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '', '', '', '', '', '', '', '5', '', '', '0', '', '1', '1', '1', '1', 'A'),
(64, '', 'RU2801P', '144', '', '', '', 'Classic Bronze Petite', '', '', '', '12', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(65, '0', 'RU2802P', '108', '1', '', '', 'Classic Pewter Petite', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '', '', '', '', '', '', '', '5', '', '', '0', '', '1', '1', '1', '1', 'A'),
(66, '0', 'RU2801T', '30', '6', '', '', 'Classic Bronze Keepsake S/6', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '', '', '', '', '', '', '', '5', '', '', '0', '', '1', '1', '1', '1', 'A'),
(67, '0', 'RU2801K', '', '1', '', '', 'Classic Bronze Keepsake in Velvet Box', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '40', '37', '35', '', '0.0518', '', '', '5', '', '', '0', '48', '1', '1', '1', '1', 'A'),
(68, '0', 'Z2801K', '144', '1', '', '', 'Classic Bronze Keepsake in Velvet Bag', '0', '', '', '51', '', NULL, NULL, '2018-07-06', NULL, '2018-07-06', '14', '2', '3', '4', '5', '6', '', '1', '5', '', '', '0', '48', '1', '1', '1', '1', 'A'),
(69, '74', 'BI01G', '', '', '', '', 'Brass Ingots Grade 1', '8', '', '', '18', '', NULL, NULL, '2018-10-16', NULL, '2018-10-16', '13', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(70, '', 'V-BG-K1', '0', '', '', '', 'Velvet Bag Keepsake', '11', '', '', '12', '', NULL, NULL, '2018-10-16', NULL, '2018-10-16', '35', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(71, '', 'BS01G', '', '', '', '1.370', 'Brass Circle Grade 1', '19', '', '', '42', '', NULL, NULL, '2018-10-22', NULL, '2018-10-22', '13', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(72, '', 'V-BX-K1', '0', '', '', '', 'Velvet Box Keepsake', '12', '', '', '12', '', NULL, NULL, '2019-01-08', NULL, '2019-01-08', '35', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(73, '', 'V-BX-S6', '0', '', '', '', 'Velvet Box Set/6', '13', '', '', '12', '', NULL, NULL, '2019-01-08', NULL, '2019-01-08', '35', '', '', '', '', '', '', '', '5', '', '', '5', '', '1', '1', '1', '1', 'A'),
(74, '', 'scrap001', '0.01', '', '', '', 'scrapName', '', '', '', '18', '', NULL, NULL, '2019-06-13', NULL, '2019-06-13', '50', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(75, '0', 'RU2964L', '7630', '1', '', '', 'Thera Bright Blue Urn', '0', '', '24.50', '51', '', NULL, NULL, '2019-07-09', NULL, '2019-07-09', '14', '62', '43', '34.5', '6', '0.092', '18.395', '15.500', '1.720', '2.040', '', '0', '6', '1', '1', '1', '1', 'A'),
(77, '0', 'APW-CB-0-LF', '', '', '', '', 'Apple Paper Weight Top Leaf', '9', '', '', '', '', NULL, NULL, '2019-07-15', NULL, '2019-07-15', '32', '', '', '', '', '', '', '0', '0.060', '0.090', '', '', '', '1', '1', '1', '1', 'A'),
(78, '0', 'APW-CB-0-BD', '', '', '', '', 'Apple Paper Weight Body', '9', '', '', '51', '', NULL, NULL, '2019-07-15', NULL, '2019-07-15', '32', '0', '0', '0', '', '0', '', '0', '0.500', '0.560', '0', '', '0', '1', '1', '1', '1', 'A'),
(79, '0', 'APW-CB-0', '', '', '', '', 'Apple Paper Weight Screw Bottom', '21', '', '', '51', '', NULL, NULL, '2019-07-15', NULL, '2019-07-15', '33', '', '', '', '', '', '', '0', '0.620', '0.750', '', '', '', '1', '1', '1', '1', 'A'),
(80, '0', '5075-SB', '7360', '1', '', '', 'Apple Paper Weight Screw Bottom', '', '', '7.00', '51', '', NULL, NULL, '2019-07-15', NULL, '2019-07-15', '14', '38', '36', '34', '20', '0.047', '9.302', '26.500', '', '', '', '0', '20', '1', '1', '1', '1', 'A'),
(81, '0', 'CLS-H', '', '', '', '', 'Classic Heart', '22', '', '', '51', '', NULL, NULL, '2019-07-16', NULL, '2019-07-16', '33', '', '', '', '', '', '', '0', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(82, '0', 'BCH-0', '', '', '', '', 'Silver Heart', '22', '', '', '51', '', NULL, NULL, '2019-07-16', NULL, '2019-07-16', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(83, '0', 'APW-CB-0-PL', '', '', '', '', 'Apple Paper Weight Screw Base', '9', '', '', '', '', NULL, NULL, '2019-07-16', NULL, '2019-07-16', '32', '', '', '', '', '', '', '', '0.060', '0.100', '', '', '', '1', '1', '1', '1', 'A'),
(84, '0', 'THR-CA-L-LD', '', '', '', '', 'Thera Large Lid', '17', '', '', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(85, '0', 'THR-CA-L-UB', '', '', '', '', 'Thera Large Upper Body', '17', '', '', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(86, '0', 'THR-CA-L-LB', '', '', '', '', 'Thera Large Lower Body', '17', '', '', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(87, '0', 'THR-CA-L', '', '', '', '', 'Thera Large', '20', '', '', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(88, '0', 'AVL-CB-L-LD', '', '', '', '', 'Avalon Large Lid', '9', '', '', '', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(89, '0', 'AVL-CB-L-UB', '', '', '', '', 'Avalon Large Upper Body', '9', '', '', '', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(90, '0', 'AVL-CB-L-LB', '', '', '', '', 'Avalon Large Lower Body', '9', '', '', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '0', '0', '0', '', '0', '', '', '', '', '0', '', '0', '1', '1', '1', '1', 'A'),
(91, '0', 'AVL-CB-0', '', '', '', '', 'Avalon Large ', '24', '', '', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(92, '0', 'RU2956L', '1920', '1', '', '', 'Silver Vase', '0', '', '28.00', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '14', '62', '43', '34.5', '6', '0.092', '18.395', '18.000', '', '', '', '0', '6', '1', '1', '1', '1', 'A'),
(93, '0', 'DTP-CB-P-LD', '', '', '', '', 'Dome Top Petite Lid', '9', '', '', '', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(94, '0', 'DTP-CB-P-UB', '', '', '', '', 'Dome Top Petite Upper Body', '9', '', '', '', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(95, '0', 'DTP-CB-P-LB', '', '', '', '', 'Dome Top Petite Lower Body', '9', '', '', '', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(96, '0', 'DTP-CB-P', '', '', '', '', 'Dome Top Petite', '25', '', '', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(97, '0', 'RU2660P', '2880', '1', '', '', 'Teddy Bear Pink', '0', '', '6', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '14', '51', '27', '50', '24', '0.069', '13.770', '14.000', '', '', '', '0', '24', '1', '1', '1', '1', 'A'),
(98, '0', 'BRD-CB-0-UB', '', '', '', '', 'Songbird Upper Body', '9', '', '', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '0', '0', '0', '', '0', '0', '0', '', '', '0', '', '0', '1', '1', '1', '1', 'A'),
(99, '0', 'BRD-CB-0-LB', '', '', '', '', 'Songbird Lower Body', '9', '', '', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '0', '0', '0', '', '0', '0', '0', '', '', '0', '', '0', '1', '1', '1', '1', 'A'),
(100, '0', 'BRD-CB-0-PL', '', '', '', '', 'Songbird Plug', '9', '', '', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '0', '0', '0', '', '0', '0', '0', '', '', '0', '', '0', '1', '1', '1', '1', 'A'),
(101, '0', 'BRD-CB-0', '', '', '', '', 'Songbird', '26', '', '', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(102, '0', 'RU2765', '6240', '1', '', '', 'Songbird Antique Bronze', '', '', '13', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '14', '50', '36', '40', '24', '0.072', '14.400', '18.500', '', '', '', '0', '24', '1', '1', '1', '1', 'A'),
(103, '0', 'RU2766', '', '1', '', '', 'Songbird Frost Blue', '0', '', '13', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '14', '50', '36', '40', '24', '0.072', '', '18.500', '', '', '', '0', '24', '1', '1', '1', '1', 'A'),
(104, '0', 'RU2767', '', '1', '', '', 'Songbird Pearl', '0', '', '13', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '14', '50', '36', '40', '24', '0.072', '', '18.500', '', '', '', '0', '24', '1', '1', '1', '1', 'A'),
(105, '0', 'ELT-CB-K-LD', '', '', '', '', 'Elite Keepsake Lid', '9', '', '', '', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(106, '0', 'ELT-CB-K-UB', '', '', '', '', 'Elite Keepsake Upper Body', '9', '', '', '', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(107, '0', 'ELT-CB-K-LB', '', '', '', '', 'Elite Keepsake Lower Body', '9', '', '', '', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(108, '0', 'ELT-CB-K', '', '', '', '', 'Elite Keepsake', '27', '', '', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(109, '0', 'RU6341K', '960', '1', '', '', 'Dove Mini Keepsake', '0', '', '3', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '14', '47', '40', '36', '48', '0.068', '13.536', '11.000', '', '', '', '0', '48', '1', '1', '1', '1', 'A'),
(110, '0', 'HRT-SB-K-UB', '', '', '', '', 'Heart Keepsake Upper Body', '16', '', '', '42', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(111, '0', 'HRT-SB-K-LB', '', '', '', '', 'Heart Keepsake Lower Body', '16', '', '', '42', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(112, '0', 'HRT-CB-K-PL', '', '', '', '', 'Heart Keepsake Plug', '9', '', '', '', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(113, '0', 'HRT-SB-K', '', '', '', '', 'Heart Keepsake', '22', '', '', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(114, '0', 'RU2956H', '3264', '1', '', '', 'Silver Heart', '0', '', '6', '51', '', NULL, NULL, '2019-07-25', NULL, '2019-07-25', '14', '47', '42', '36.5', '48', '0.072', '14.410', '24.000', '', '', '', '0', '48', '1', '1', '1', '1', 'A'),
(116, '0', 'HRT-CB-K-UB', '', '', '', '', 'Heart Keepsake Upper Body', '9', '', '', '51', '', NULL, NULL, '2019-07-29', NULL, '2019-07-29', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(117, '0', 'HRT-CB-K-LB', '', '', '', '', 'Heart Keepsake Lower Body', '9', '', '', '51', '', NULL, NULL, '2019-07-29', NULL, '2019-07-29', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(118, '0', 'GRC-CB-K-LD', '', '', '', '', 'Grecian Keepsake Lid', '9', '', '', '51', '', NULL, NULL, '2019-07-29', NULL, '2019-07-29', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(119, '0', 'GRC-CB-K-UB', '', '', '', '', 'Grecian Keepsake Upper Body', '9', '', '', '51', '', NULL, NULL, '2019-07-29', NULL, '2019-07-29', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(120, '0', 'GRC-CB-K-LB', '', '', '', '', 'Grecian Keepsake Lower Body', '9', '', '', '51', '', NULL, NULL, '2019-07-29', NULL, '2019-07-29', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(121, '0', 'GRC-CB-K', '', '', '', '', 'Grecian Keepsake', '28', '', '', '51', '', NULL, NULL, '2019-07-29', NULL, '2019-07-29', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(122, '0', 'QB497T', '1800', '6', '', '', 'Keepsake S/6 Grecian, Pewter w/band', '', '', '15', '41', '', NULL, NULL, '2019-07-29', NULL, '2019-07-29', '14', '21', '41', '41', '10', '0.035', '7.060', '14.500', '', '', '', '0', '10', '1', '1', '1', '1', 'A'),
(123, '0', 'DTP-CB-M-LD', '', '', '', '', 'Domtop Medium Lid', '9', '', '', '51', '', NULL, NULL, '2019-07-29', NULL, '2019-07-29', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(124, '0', 'DTP-CB-M-UB', '', '', '', '', 'Domtop Medium Upper Body', '9', '', '', '51', '', NULL, NULL, '2019-07-29', NULL, '2019-07-29', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(125, '0', 'DTP-CB-M-LB', '', '', '', '', 'Domtop Medium Lower Body', '9', '', '', '', '', NULL, NULL, '2019-07-29', NULL, '2019-07-29', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(126, '0', 'DTP-CB-M', '', '', '', '', 'Domtop Medium', '34', '', '', '51', '', NULL, NULL, '2019-07-29', NULL, '2019-07-29', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(127, '0', 'RU2502M', '1224', '1', '', '', 'Urn Radiance Medium ', '0', '', '10', '51', '', NULL, NULL, '2019-07-29', NULL, '2019-07-29', '14', '52', '48', '48', '12', '0.120', '23.962', '22.000', '', '', '', '0', '12', '1', '1', '1', '1', 'A'),
(128, '0', 'HRT-CB-K', '', '', '', '', 'Heart Keepsake', '22', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(129, '0', 'DTP-CB-S-LD', '', '', '', '', 'Domtop Medium Lid', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(130, '0', 'DTP-CB-S-UB', '', '', '', '', 'Domtop Small Upper Body', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(131, '0', 'DTP-CB-S-LB', '', '', '', '', 'Domtop Small Lower Body', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(132, '0', 'DTP-CB-S', '', '', '', '', 'Domtop Small', '35', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(133, '0', 'RU2502S', '900', '1', '', '', 'Urn Radiance Small                  ', '0', '', '10', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '14', '48', '48', '46', '18', '0.106', '21.197', '24.500', '', '', '', '0', '18', '1', '1', '1', '1', 'A'),
(134, '0', 'DTP-CB-X-LD', '', '', '', '', 'Dome Top Ex Small Lid', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(135, '0', 'DTP-CB-X-UB', '', '', '', '', 'Dome Top Ex Small Upper Body', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(136, '0', 'DTP-CB-X-LB', '', '', '', '', 'Dome Top Ex Small Lower Body', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(137, '0', 'DTP-CB-K-LD', '', '', '', '', 'Dome Top Keepsake Lid', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(138, '0', 'DTP-CB-K-UB', '', '', '', '', 'Domtop Keepsake Upper Body', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(139, '0', 'DTP-CB-K-LB', '', '', '', '', 'Dometop Keepsake Lower Body', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(140, '0', 'DTP-CB-X', '', '', '', '', 'Dome Top Ex Small ', '36', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(141, '0', 'DTP-CB-K', '', '', '', '', 'Dometop Keepsake', '37', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(142, '0', 'RU2502XS', '1440', '1', '', '', 'Radiance Ex. Small ', '0', '', '6', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '14', '68', '38', '35', '24', '0.090', '18.088', '20.500', '', '', '', '0', '24', '1', '1', '1', '1', 'A'),
(143, '0', 'Z2502K', '2400', '1', '', '', 'Radiance Keepsake w/Velvet Bag', '0', '', '2', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '14', '32', '30', '28', '48', '0.027', '5.376', '12.000', '', '', '', '0', '48', '1', '1', '1', '1', 'A'),
(144, '0', 'CAT-CB-T-LB', '', '', '', '', 'Tall Cat Left Body', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(145, '0', 'CAT-CB-T-RB', '', '', '', '', 'Tall Cat Right Body', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(146, '0', 'CAT-CB-T-PL', '', '', '', '', 'Tall Cat Plug', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(147, '0', 'CAT-CB-T', '', '', '', '', 'Tall Cat', '29', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(148, '0', 'RU2883L', '5184', '1', '', '', 'Tall Cat Antq. Bronze', '0', '', '15', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '14', '40', '38', '36', '8', '0.055', '10.944', '16.500', '', '', '', '0', '8', '1', '1', '1', '1', 'A'),
(149, '0', 'ODY-CB-S-LD', '', '', '', '', 'Odyssey Small Lid', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(150, '0', 'ODY-CB-S-BD', '', '', '', '', 'Odyssey Small Body', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(151, '0', 'ODY-CB-P-LD', '', '', '', '', 'Odyssey Petite Lid', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(152, '0', 'ODY-CB-P-BD', '', '', '', '', 'Odyssey Petite Body', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(153, '0', 'ODY-CB-S', '', '', '', '', 'Odyssey Small', '30', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(154, '0', 'ODY-CB-P', '', '', '', '', 'Odyssey Petite ', '38', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(155, '0', 'RU2920-70', '2160', '1', '', '', 'Odyssey Crimson Small', '0', '', '15', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '14', '50', '36', '35', '12', '0.063', '12.600', '19.000', '', '', '', '0', '12', '1', '1', '1', '1', 'A'),
(156, '0', 'RU2920-25', '1920', '1', '', '', 'Odyssey Crimson Petite', '0', '', '9', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '14', '48', '42', '29', '24', '0.058', '11.693', '17.000', '', '', '', '0', '24', '1', '1', '1', '1', 'A'),
(157, '0', 'RU502H', '1512', '1', '', '', 'Crimson Heart', '0', '', '7', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '14', '36', '28', '38', '24', '0.038', '7.661', '13.000', '', '', '', '0', '24', '1', '1', '1', '1', 'A'),
(158, '0', 'SAT-MX-L-LD', '', '', '', '', 'Satori Large Lid', '39', '', '', '42', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(159, '0', 'SAT-MX-L-NK', '', '', '', '', 'Satori Large Neck', '39', '', '', '', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(160, '0', 'SAT-MX-L-UB', '', '', '', '', 'Satori Large Upper Body', '39', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(161, '0', 'SAT-MX-L-LB', '', '', '', '', 'Satori Large Lower Body', '39', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(162, '0', 'SAT-CB-K-LD', '', '', '', '', 'Satori Keepsake Lid', '9', '', '', '', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(163, '0', 'SAT-CB-K-NK', '', '', '', '', 'Satori Keepsake Neck', '9', '', '', '', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(164, '0', 'SAT-CB-K-UB', '', '', '', '', 'Satori Keepsake Upper Body', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(165, '0', 'SAT-CB-K-LB', '', '', '', '', 'Satori Keepsake Lower Body', '9', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(166, '0', 'SAT-MX-L', '', '', '', '', 'Satori Large', '31', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(167, '0', 'SAT-CB-K', '', '', '', '', 'Satori Keepsake', '40', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(168, '0', 'RU5260L', '3840', '1', '', '', 'Satori Ocean', '0', '', '20', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '14', '56', '42', '41', '6', '0.096', '19.286', '21.000', '', '', '', '0', '6', '1', '1', '1', '1', 'A'),
(169, '0', 'RU5260K', '2592', '1', '', '', 'Satori Ocean Keepsake', '0', '', '5', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '14', '48', '34', '44', '48', '0.072', '14.362', '14.500', '', '', '', '0', '48', '1', '1', '1', '1', 'A'),
(170, '0', 'CLS-SB-M-LD', '', '', '', '', 'Classic Medium Lid', '16', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(171, '0', 'CLS-SB-M-BD', '', '', '', '', 'Classic Medium Body', '16', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(172, '0', 'CLS-SB-M', '', '', '', '', 'Classic Medium', '14', '', '', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(173, '0', 'QB2830-125', '3072', '1', '', '', 'Urn Classic, Paw Print, Slate 125c', '0', '', '15', '51', '', NULL, NULL, '2019-07-30', NULL, '2019-07-30', '14', '64', '45', '42.5', '12', '0.122', '24.480', '17.000', '', '', '', '0', '12', '1', '1', '1', '1', 'A'),
(174, '', 'BS01G12G0400I', '', '', '', '0.360', 'Brass Circle Grade 1 12 Gauze 4 Inch Dia', '19', '', '', '42', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '13', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(175, '', 'AI02G', '', '', '', '', 'Aluminium Ingot Grade 2', '18', '', '', '18', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '13', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(176, '', 'BS01G16G0600I', '', '', '', '', 'Brass Circle Grade 1 16 Gauze 6 Inch Dia', '19', '', '', '42', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '13', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(177, '', 'BS01G14G0425I', '', '', '', '', 'Brass Circle Grade 1 14 Gauze 4.25 Inch Dia', '19', '', '', '42', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '13', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(178, '', 'BS01G16G1250I', '', '', '', '', 'Brass Circle Grade 1 16 Gauze 12.5 Inch Dia', '19', '', '', '42', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '13', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(179, '', 'AI03G', '', '', '', '', 'Aluminium Ingot Grade 3', '18', '', '', '18', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '13', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(180, '', 'AS00G18G0525I', '', '', '', '', 'Aluminium Sheet Standard Grade 18 Gauze 5.25 Inch Dia', '45', '', '', '42', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '13', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(181, '', 'AS00G14G0200I', '', '', '', '', 'Aluminium Sheet Standard Grade 14 Gauze 2 Inch Dia', '45', '', '', '42', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '13', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(182, '', 'AP00G10G0300I', '', '', '', '', 'Aluminium Pipe Standard Grade 10 Gauze 3 Inch Dia', '46', '', '', '53', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '13', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(186, '0', 'LGC-CA-L-LD', '', '', '', '', 'Legacy Large Lid', '17', '', '', '51', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(187, '0', 'LGC-CA-L-UB', '', '', '', '', 'Legacy Large Upper Body', '17', '', '', '51', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(188, '0', 'LGC-CA-L-LB', '', '', '', '', 'Legacy Large Lower Body', '17', '', '', '51', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(189, '0', 'LGC-CA-K-LD', '', '', '', '', 'Legacy Keepsake Lid', '17', '', '', '51', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(191, '0', 'LGC-CA-K-UB', '', '', '', '', 'Legacy Keepsake Upper Body', '17', '', '', '51', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(192, '0', 'LGC-CA-K-LB', '', '', '', '', 'Legacy Keepsake Lower Body', '17', '', '', '51', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(193, '0', 'VOT-PA-0-TP', '', '', '', '', 'Legacy Votive Top Part', '47', '', '', '42', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(194, '0', 'VOT-PA-0-BD', '', '', '', '', 'Legacy Votive Body', '47', '', '', '42', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(195, '0', 'VOT-PA-0-BS', '', '', '', '', 'Legacy Votive Base Part', '47', '', '', '42', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '32', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(196, '0', 'LGC-CA-L', '', '', '', '', 'Legacy Large', '32', '', '', '51', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(197, '0', 'LGC-CA-K', '', '', '', '', 'Legacy Keepsake', '32', '', '', '51', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(198, '0', 'VOT-PA-0', '', '', '', '', 'Votive Pipe Aluminium', '33', '', '', '51', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '33', '', '', '', '', '', '', '', '', '', '', '', '', '1', '1', '1', '1', 'A'),
(199, '0', 'RU5296L', '864', '1', '', '', 'Legacy Metallic Blue', '0', '', '20', '51', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '14', '56', '43', '40', '6', '0.096', '19.264', '15.500', '', '', '', '0', '6', '1', '1', '1', '1', 'A'),
(200, '0', 'RU5296T', '2000', '6', '', '', 'Legacy Metallic Blue Keepsake', '', '', '20', '41', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '14', '28', '38', '44', '10', '0.047', '9.363', '12.000', '', '', '', '0', '10', '1', '1', '1', '1', 'A'),
(201, '0', 'RU5296V', '3456', '1', '', '', 'Legacy Metallic Blue Votive Keepsake', '0', '', '7', '51', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '14', '55', '47.5', '46', '24', '0.120', '24.035', '12.500', '', '', '', '0', '24', '1', '1', '1', '1', 'A'),
(202, '0', 'RU2770', '6120', '1', '', '', 'Memory Light Keepsake Bronze', '0', '', '6', '51', '', NULL, NULL, '2019-07-31', NULL, '2019-07-31', '14', '54.50', '48', '46', '24', '0.119', '23.846', '12.500', '', '', '', '0', '24', '1', '1', '1', '1', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_transfer_to_packing`
--

CREATE TABLE `tbl_product_transfer_to_packing` (
  `id` int(11) NOT NULL,
  `lot_no` varchar(200) DEFAULT NULL,
  `to_fg` varchar(200) DEFAULT NULL,
  `frm_fg` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `grn_no` varchar(200) DEFAULT NULL,
  `grn_date` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) NOT NULL,
  `maker_date` date NOT NULL,
  `author_id` varchar(200) NOT NULL,
  `author_date` date NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `comp_id` varchar(200) NOT NULL,
  `zone_id` varchar(200) NOT NULL,
  `brnh_id` varchar(200) NOT NULL,
  `divn_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_transfer_to_packing`
--

INSERT INTO `tbl_product_transfer_to_packing` (`id`, `lot_no`, `to_fg`, `frm_fg`, `qty`, `grn_no`, `grn_date`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '001', '56', '57', '4', 'GRN005', '2019-07-05', '1', '2019-07-05', '', '0000-00-00', 'A', '1', '1', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_order_dtl`
--

CREATE TABLE `tbl_purchase_order_dtl` (
  `purchase_dtl_id` int(11) NOT NULL,
  `vat_rate_on_item` varchar(200) DEFAULT '0',
  `vat_on_item` varchar(200) DEFAULT '0',
  `service_rate_on_item` varchar(200) DEFAULT '0',
  `service_on_item` varchar(200) DEFAULT NULL,
  `discount_percent_on_item` varchar(200) DEFAULT '0',
  `purchaseid` varchar(200) DEFAULT NULL,
  `tempid` varchar(100) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `unit` varchar(200) DEFAULT NULL,
  `serial_code` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `qn_pc` varchar(200) DEFAULT NULL,
  `circle_weight` varchar(200) DEFAULT NULL,
  `list_price` varchar(200) DEFAULT NULL,
  `discount` varchar(200) DEFAULT NULL,
  `cgst` varchar(200) DEFAULT NULL,
  `sgst` varchar(200) DEFAULT NULL,
  `igst` varchar(200) DEFAULT NULL,
  `gstTotal` varchar(200) DEFAULT NULL,
  `net_price_after_discount` varchar(200) DEFAULT NULL,
  `discount_amount` varchar(200) DEFAULT NULL,
  `idvat_rate_on_total` varchar(200) DEFAULT '0',
  `idvat_total` varchar(200) DEFAULT '0',
  `ivat_rate_on_total` varchar(200) DEFAULT '0',
  `ivat_total` varchar(200) DEFAULT '0',
  `isales_rate_on_total` varchar(200) DEFAULT '0',
  `isales_total` varchar(200) DEFAULT '0',
  `iservice_rate_on_total` varchar(200) DEFAULT '0',
  `iservices_total` varchar(200) DEFAULT '0',
  `v_DISCOUNT` varchar(200) DEFAULT '0',
  `total_price` varchar(200) DEFAULT '0',
  `net_price` varchar(200) DEFAULT '0',
  `main_catg_id` varchar(200) DEFAULT NULL,
  `child_invoice_id` int(11) DEFAULT NULL,
  `total_tax` varchar(200) DEFAULT '0',
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchase_order_dtl`
--

INSERT INTO `tbl_purchase_order_dtl` (`purchase_dtl_id`, `vat_rate_on_item`, `vat_on_item`, `service_rate_on_item`, `service_on_item`, `discount_percent_on_item`, `purchaseid`, `tempid`, `productid`, `unit`, `serial_code`, `qty`, `type`, `qn_pc`, `circle_weight`, `list_price`, `discount`, `cgst`, `sgst`, `igst`, `gstTotal`, `net_price_after_discount`, `discount_amount`, `idvat_rate_on_total`, `idvat_total`, `ivat_rate_on_total`, `ivat_total`, `isales_rate_on_total`, `isales_total`, `iservice_rate_on_total`, `iservices_total`, `v_DISCOUNT`, `total_price`, `net_price`, `main_catg_id`, `child_invoice_id`, `total_tax`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(2, '0', '0', '0', NULL, '0', '1', NULL, '71', NULL, NULL, '274', '', '200', '1.370', '450', '', '', '', '', '0', NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '123300', '123300.00', NULL, NULL, '0', '1', NULL, '2019-03-07', NULL, 'A', '1', '1', '1', NULL),
(3, '0', '0', '0', NULL, '0', '2', NULL, '1', NULL, NULL, '500', '', '500', '', '360', '', '', '', '', '0', NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '180000', '180000.00', NULL, NULL, '0', '1', NULL, '2019-03-07', NULL, 'A', '1', '1', '1', NULL),
(4, '0', '0', '0', NULL, '0', '2', NULL, '69', NULL, NULL, '200', '', '200', '', '350', '', '', '', '', '0', NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '70000', '70000.00', NULL, NULL, '0', '1', NULL, '2019-03-07', NULL, 'A', '1', '1', '1', NULL),
(5, '0', '0', '0', NULL, '0', '3', NULL, '2', NULL, NULL, '200', '', '200', '', '160', '', '', '', '', '0', NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '32000', '32000.00', NULL, NULL, '0', '1', NULL, '2019-03-07', NULL, 'A', '1', '1', '1', NULL),
(6, '0', '0', '0', NULL, '0', '4', NULL, '71', NULL, NULL, '137.000', '', '100', '1.370', '440', '', '', '', '', '0', NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '60280', '60280.00', NULL, NULL, '0', '1', NULL, '2019-03-25', NULL, 'A', '1', '1', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_order_hdr`
--

CREATE TABLE `tbl_purchase_order_hdr` (
  `purchaseid` int(11) NOT NULL,
  `tax_retail` varchar(200) DEFAULT NULL,
  `vendor_id` varchar(200) DEFAULT NULL,
  `sub_total` varchar(200) DEFAULT NULL,
  `sales_id` varchar(200) DEFAULT NULL,
  `agent_id` varchar(200) DEFAULT NULL,
  `wff_date` varchar(200) DEFAULT NULL,
  `valid_till_date` varchar(200) DEFAULT NULL,
  `reference` varchar(200) DEFAULT NULL,
  `freight` varchar(200) DEFAULT NULL,
  `Place_of_Supply` varchar(200) DEFAULT NULL,
  `gr_no` varchar(200) DEFAULT NULL,
  `state_id` varchar(200) DEFAULT NULL,
  `company_id` varchar(200) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `customernumber` varchar(200) DEFAULT NULL,
  `contactid` varchar(200) DEFAULT NULL,
  `season` varchar(200) DEFAULT NULL,
  `assignedto` varchar(200) DEFAULT NULL,
  `purchaseorder` varchar(200) DEFAULT NULL,
  `sales_commission` varchar(200) DEFAULT NULL,
  `sales_ordernumber` varchar(200) DEFAULT NULL,
  `due_date` varchar(200) DEFAULT NULL,
  `organisation_id` varchar(200) DEFAULT NULL,
  `invoice_status` varchar(200) DEFAULT NULL,
  `excise_total` varchar(200) DEFAULT NULL,
  `vat_total` varchar(200) DEFAULT NULL,
  `sales_total` varchar(200) DEFAULT NULL,
  `services_total` varchar(200) DEFAULT NULL,
  `item_price_total` varchar(200) DEFAULT NULL,
  `discount` varchar(200) DEFAULT NULL,
  `shipping_charge` varchar(200) DEFAULT NULL,
  `installation_charge_per` varchar(200) DEFAULT NULL,
  `installation_charge` varchar(200) DEFAULT NULL,
  `total_cgst` varchar(200) DEFAULT NULL,
  `total_tax_cgst_amt` varchar(200) DEFAULT NULL,
  `total_sgst` varchar(200) DEFAULT NULL,
  `total_tax_sgst_amt` varchar(200) DEFAULT NULL,
  `total_igst` varchar(200) DEFAULT NULL,
  `total_tax_igst_amt` varchar(200) DEFAULT NULL,
  `total_gst_tax_amt` varchar(200) DEFAULT NULL,
  `total_dis` varchar(200) DEFAULT NULL,
  `total_dis_amt` varchar(200) DEFAULT NULL,
  `dvat_total` varchar(200) DEFAULT NULL,
  `dvat_on_a_per` varchar(200) DEFAULT NULL,
  `dvat_on_a` varchar(200) DEFAULT NULL,
  `pre_tax_total` varchar(200) DEFAULT NULL,
  `discount_rate_on_total` varchar(200) DEFAULT NULL,
  `direct_dicount_amt` varchar(200) DEFAULT NULL,
  `vat_rate_on_total` varchar(200) DEFAULT NULL,
  `sales_rate_on_total` varchar(200) DEFAULT NULL,
  `service_rate_on_total` varchar(200) DEFAULT NULL,
  `shipping_vat_rate_on_total` varchar(200) DEFAULT NULL,
  `shipping_sales_rate_on_total` varchar(200) DEFAULT NULL,
  `shipping_service_rate_on_total` varchar(200) DEFAULT NULL,
  `shipping_vat_total` varchar(200) DEFAULT NULL,
  `shipping_sales_total` varchar(200) DEFAULT NULL,
  `shipping_service_total` varchar(200) DEFAULT NULL,
  `shpping_total` varchar(200) DEFAULT NULL,
  `tax_total` varchar(200) DEFAULT NULL,
  `adjustment_type` varchar(200) DEFAULT NULL,
  `adjustment_total` varchar(200) DEFAULT NULL,
  `grand_total` varchar(200) DEFAULT NULL,
  `advance_total` varchar(200) DEFAULT NULL,
  `balance_total` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `reason` varchar(500) DEFAULT NULL,
  `force_close_status` varchar(10) NOT NULL DEFAULT '0',
  `fc_date` varchar(10) DEFAULT NULL,
  `purchase_no` varchar(200) DEFAULT NULL,
  `manufacturer_id` varchar(200) DEFAULT NULL,
  `c_name` varchar(200) DEFAULT NULL,
  `cust_phone` varchar(200) DEFAULT NULL,
  `cust_address` varchar(200) DEFAULT NULL,
  `brnch_id` varchar(200) DEFAULT NULL,
  `invoice_type` varchar(200) DEFAULT NULL,
  `fdate` varchar(200) DEFAULT NULL,
  `todate` varchar(200) DEFAULT NULL,
  `product_exp_date` varchar(200) DEFAULT NULL,
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL,
  `surcharge_tax` varchar(200) DEFAULT '0',
  `paymode` varchar(200) DEFAULT NULL,
  `generated_status` varchar(200) DEFAULT 'Direct',
  `serial_no` int(11) DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `referenceof` varchar(200) DEFAULT NULL,
  `deliverymode` varchar(200) DEFAULT NULL,
  `submit_amount` varchar(200) DEFAULT '0',
  `locationid` varchar(200) DEFAULT NULL,
  `terminalid` varchar(200) DEFAULT NULL,
  `contact_no` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchase_order_hdr`
--

INSERT INTO `tbl_purchase_order_hdr` (`purchaseid`, `tax_retail`, `vendor_id`, `sub_total`, `sales_id`, `agent_id`, `wff_date`, `valid_till_date`, `reference`, `freight`, `Place_of_Supply`, `gr_no`, `state_id`, `company_id`, `subject`, `invoice_date`, `customernumber`, `contactid`, `season`, `assignedto`, `purchaseorder`, `sales_commission`, `sales_ordernumber`, `due_date`, `organisation_id`, `invoice_status`, `excise_total`, `vat_total`, `sales_total`, `services_total`, `item_price_total`, `discount`, `shipping_charge`, `installation_charge_per`, `installation_charge`, `total_cgst`, `total_tax_cgst_amt`, `total_sgst`, `total_tax_sgst_amt`, `total_igst`, `total_tax_igst_amt`, `total_gst_tax_amt`, `total_dis`, `total_dis_amt`, `dvat_total`, `dvat_on_a_per`, `dvat_on_a`, `pre_tax_total`, `discount_rate_on_total`, `direct_dicount_amt`, `vat_rate_on_total`, `sales_rate_on_total`, `service_rate_on_total`, `shipping_vat_rate_on_total`, `shipping_sales_rate_on_total`, `shipping_service_rate_on_total`, `shipping_vat_total`, `shipping_sales_total`, `shipping_service_total`, `shpping_total`, `tax_total`, `adjustment_type`, `adjustment_total`, `grand_total`, `advance_total`, `balance_total`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `reason`, `force_close_status`, `fc_date`, `purchase_no`, `manufacturer_id`, `c_name`, `cust_phone`, `cust_address`, `brnch_id`, `invoice_type`, `fdate`, `todate`, `product_exp_date`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`, `surcharge_tax`, `paymode`, `generated_status`, `serial_no`, `delivery_date`, `referenceof`, `deliverymode`, `submit_amount`, `locationid`, `terminalid`, `contact_no`) VALUES
(1, '', '9', '123300.00', '0', '', '', '', '', '', '', '0', '', '', NULL, '2019-03-07', NULL, NULL, '', NULL, NULL, NULL, NULL, '', NULL, 'GST', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '0.00', '0', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123300.00', NULL, NULL, '1', '2019-03-07', NULL, NULL, 'A', '', '3', '', 'RM001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '0', NULL, 'Direct', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(2, '', '7', '250000.00', '0', '', '', '', '', '', '', '0', '', '', NULL, '2019-03-07', NULL, NULL, '', NULL, NULL, NULL, NULL, '', NULL, 'GST', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '0.00', '0', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '250000.00', NULL, NULL, '1', '2019-03-07', NULL, NULL, 'A', '', '3', '', 'RM002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '0', NULL, 'Direct', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(3, '', '8', '32000.00', '0', '', '', '', '', '', '', '0', '', '', NULL, '2019-03-07', NULL, NULL, '', NULL, NULL, NULL, NULL, '', NULL, 'GST', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '0.00', '0', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32000.00', NULL, NULL, '1', '2019-03-07', NULL, NULL, 'A', '', '3', '', 'RM003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '0', NULL, 'Direct', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL),
(4, '', '9', '60280.00', '0', '', '', '', '', '', '', '0', '', '', NULL, '2019-03-25', NULL, NULL, '', NULL, NULL, NULL, NULL, '', NULL, 'GST', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '0.00', '0', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60280.00', NULL, NULL, '1', '2019-03-25', NULL, NULL, 'A', '', '3', '', 'RM004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '0', NULL, 'Direct', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation_purchase_order_dtl`
--

CREATE TABLE `tbl_quotation_purchase_order_dtl` (
  `purchase_dtl_id` int(11) NOT NULL,
  `vat_rate_on_item` varchar(200) DEFAULT '0',
  `vat_on_item` varchar(200) DEFAULT '0',
  `service_rate_on_item` varchar(200) DEFAULT '0',
  `service_on_item` varchar(200) DEFAULT NULL,
  `discount_percent_on_item` varchar(200) DEFAULT '0',
  `purchaseid` varchar(200) DEFAULT NULL,
  `tempid` varchar(100) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `unit` varchar(200) DEFAULT NULL,
  `serial_code` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `ord_qty` varchar(200) DEFAULT NULL,
  `per_crt_qn` varchar(200) DEFAULT NULL,
  `list_price` varchar(200) DEFAULT NULL,
  `discount` varchar(200) DEFAULT NULL,
  `cgst` varchar(200) DEFAULT NULL,
  `sgst` varchar(200) DEFAULT NULL,
  `igst` varchar(200) DEFAULT NULL,
  `gstTotal` varchar(200) DEFAULT NULL,
  `net_price_after_discount` varchar(200) DEFAULT NULL,
  `discount_amount` varchar(200) DEFAULT NULL,
  `idvat_rate_on_total` varchar(200) DEFAULT '0',
  `idvat_total` varchar(200) DEFAULT '0',
  `ivat_rate_on_total` varchar(200) DEFAULT '0',
  `ivat_total` varchar(200) DEFAULT '0',
  `isales_rate_on_total` varchar(200) DEFAULT '0',
  `isales_total` varchar(200) DEFAULT '0',
  `iservice_rate_on_total` varchar(200) DEFAULT '0',
  `iservices_total` varchar(200) DEFAULT '0',
  `v_DISCOUNT` varchar(200) DEFAULT '0',
  `price` varchar(200) NOT NULL,
  `total_price` varchar(200) DEFAULT '0',
  `net_price` varchar(200) DEFAULT '0',
  `main_catg_id` varchar(200) DEFAULT NULL,
  `child_invoice_id` int(11) DEFAULT NULL,
  `total_tax` varchar(200) DEFAULT '0',
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_quotation_purchase_order_dtl`
--

INSERT INTO `tbl_quotation_purchase_order_dtl` (`purchase_dtl_id`, `vat_rate_on_item`, `vat_on_item`, `service_rate_on_item`, `service_on_item`, `discount_percent_on_item`, `purchaseid`, `tempid`, `productid`, `unit`, `serial_code`, `qty`, `ord_qty`, `per_crt_qn`, `list_price`, `discount`, `cgst`, `sgst`, `igst`, `gstTotal`, `net_price_after_discount`, `discount_amount`, `idvat_rate_on_total`, `idvat_total`, `ivat_rate_on_total`, `ivat_total`, `isales_rate_on_total`, `isales_total`, `iservice_rate_on_total`, `iservices_total`, `v_DISCOUNT`, `price`, `total_price`, `net_price`, `main_catg_id`, `child_invoice_id`, `total_tax`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(34, '0', '0', '0', NULL, '0', '3', NULL, '29', NULL, NULL, '100', '', '', '2', '', '', '', '', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '102', '0', NULL, NULL, '0', '1', NULL, '2019-05-04', NULL, 'A', '1', '1', '1', NULL),
(93, '0', '0', '0', NULL, '0', '2', NULL, '30', NULL, NULL, '96', '', '', '10', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '106', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(94, '0', '0', '0', NULL, '0', '2', NULL, '63', NULL, NULL, '96', '', '', '5', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '101', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(95, '0', '0', '0', NULL, '0', '2', NULL, '21', NULL, NULL, '24', '', '', '10', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '26', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(96, '0', '0', '0', NULL, '0', '2', NULL, '22', NULL, NULL, '36', '', '', '10', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '40', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(97, '0', '0', '0', NULL, '0', '2', NULL, '23', NULL, NULL, '48', '', '', '10', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '53', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(98, '0', '0', '0', NULL, '0', '2', NULL, '12', NULL, NULL, '10', '', '', '10', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '11', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(99, '0', '0', '0', NULL, '0', '2', NULL, '13', NULL, NULL, '10', '', '', '10', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '11', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(100, '0', '0', '0', NULL, '0', '2', NULL, '14', NULL, NULL, '10', '', '', '10', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '11', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(101, '0', '0', '0', NULL, '0', '2', NULL, '9', NULL, NULL, '48', '', '', '10', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '53', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(102, '0', '0', '0', NULL, '0', '2', NULL, '10', NULL, NULL, '48', '', '', '10', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '53', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(103, '0', '0', '0', NULL, '0', '2', NULL, '11', NULL, NULL, '144', '', '', '10', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '158', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(104, '0', '0', '0', NULL, '0', '2', NULL, '29', NULL, NULL, '24', '', '', '15', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '28', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(105, '0', '0', '0', NULL, '0', '2', NULL, '30', NULL, NULL, '96', '', '', '15', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '110', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(106, '0', '0', '0', NULL, '0', '2', NULL, '31', NULL, NULL, '144', '', '', '15', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '166', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(107, '0', '0', '0', NULL, '0', '2', NULL, '32', NULL, NULL, '48', '', '', '15', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '55', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(108, '0', '0', '0', NULL, '0', '2', NULL, '33', NULL, NULL, '24', '', '', '15', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '28', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(109, '0', '0', '0', NULL, '0', '2', NULL, '34', NULL, NULL, '48', '', '', '15', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '55', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(110, '0', '0', '0', NULL, '0', '2', NULL, '35', NULL, NULL, '24', '', '', '15', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '28', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(111, '0', '0', '0', NULL, '0', '2', NULL, '36', NULL, NULL, '48', '', '', '15', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '55', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(112, '0', '0', '0', NULL, '0', '2', NULL, '58', NULL, NULL, '24', '', '', '5', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '25', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(113, '0', '0', '0', NULL, '0', '2', NULL, '60', NULL, NULL, '36', '', '', '5', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '38', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(114, '0', '0', '0', NULL, '0', '2', NULL, '62', NULL, NULL, '48', '', '', '5', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '50', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(115, '0', '0', '0', NULL, '0', '2', NULL, '64', NULL, NULL, '48', '', '', '5', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '50', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(116, '0', '0', '0', NULL, '0', '2', NULL, '66', NULL, NULL, '10', '', '', '10', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '11', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(117, '0', '0', '0', NULL, '0', '2', NULL, '68', NULL, NULL, '48', '', '', '10', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '53', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(118, '0', '0', '0', NULL, '0', '2', NULL, '59', NULL, NULL, '12', '', '', '5', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '13', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(119, '0', '0', '0', NULL, '0', '2', NULL, '61', NULL, NULL, '24', '', '', '5', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '25', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(120, '0', '0', '0', NULL, '0', '2', NULL, '63', NULL, NULL, '24', '', '', '5', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '25', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(121, '0', '0', '0', NULL, '0', '2', NULL, '65', NULL, NULL, '36', '', '', '5', '', '', '', '18', '0', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '38', '0', NULL, NULL, '0', '1', NULL, '2019-05-18', NULL, 'A', '1', '1', '1', NULL),
(332, '0', '0', '0', NULL, '0', '1', NULL, '75', NULL, NULL, '233', '39', '6', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '24.50', '233', '5708.500', NULL, NULL, '0', '1', NULL, '2019-08-28', NULL, 'A', '1', '1', '1', NULL),
(333, '0', '0', '0', NULL, '0', '1', NULL, '29', NULL, NULL, '431', '27', '16', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '11', '431', '4741.000', NULL, NULL, '0', '1', NULL, '2019-08-28', NULL, 'A', '1', '1', '1', NULL),
(342, '0', '0', '0', NULL, '0', '4', NULL, '29', NULL, NULL, '2323', '387', '6', '2', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '100', '2369', '232300.000', NULL, NULL, '0', '1', NULL, '2019-08-28', NULL, 'A', '1', '1', '1', NULL),
(343, '0', '0', '0', NULL, '0', '4', NULL, '31', NULL, NULL, '223', '14', '16', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '11', '223', '2453.000', NULL, NULL, '0', '1', NULL, '2019-08-28', NULL, 'A', '1', '1', '1', NULL),
(363, '0', '0', '0', NULL, '0', '5', NULL, '114', NULL, NULL, '192', '4', '48', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '9', '192', '1728', NULL, NULL, '0', '1', NULL, '2019-09-03', NULL, 'A', '1', '1', '1', NULL),
(364, '0', '0', '0', NULL, '0', '5', NULL, '127', NULL, NULL, '72', '6', '12', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15.6', '72', '1123.2', NULL, NULL, '0', '1', NULL, '2019-09-03', NULL, 'A', '1', '1', '1', NULL),
(365, '0', '0', '0', NULL, '0', '5', NULL, '173', NULL, NULL, '192', '16', '12', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '12.97', '192', '2490.2400000000002', NULL, NULL, '0', '1', NULL, '2019-09-03', NULL, 'A', '1', '1', '1', NULL),
(366, '0', '0', '0', NULL, '0', '5', NULL, '202', NULL, NULL, '408', '17', '24', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '6.59', '408', '2688.72', NULL, NULL, '0', '1', NULL, '2019-09-03', NULL, 'A', '1', '1', '1', NULL),
(367, '0', '0', '0', NULL, '0', '5', NULL, '80', NULL, NULL, '580', '29', '20', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '5.2', '580', '3016.000', NULL, NULL, '0', '1', NULL, '2019-09-03', NULL, 'A', '1', '1', '1', NULL),
(368, '0', '0', '0', NULL, '0', '5', NULL, '148', NULL, NULL, '312', '39', '8', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '16', '312', '4992.000', NULL, NULL, '0', '1', NULL, '2019-09-03', NULL, 'A', '1', '1', '1', NULL),
(369, '0', '0', '0', NULL, '0', '5', NULL, '122', NULL, NULL, '120', '12', '10', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '120', '1800.000', NULL, NULL, '0', '1', NULL, '2019-09-03', NULL, 'A', '1', '1', '1', NULL),
(370, '0', '0', '0', NULL, '0', '5', NULL, '75', NULL, NULL, '498', '83', '6', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '24.50', '498', '12201.000', NULL, NULL, '0', '1', NULL, '2019-09-03', NULL, 'A', '1', '1', '1', NULL),
(396, '0', '0', '0', NULL, '0', '6', NULL, '97', NULL, NULL, '288', '12', '24', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '10.4', '288', '2995.2000000000003', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(397, '0', '0', '0', NULL, '0', '6', NULL, '102', NULL, NULL, '624', '26', '24', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '11.99', '624', '7481.76', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(398, '0', '0', '0', NULL, '0', '6', NULL, '109', NULL, NULL, '96', '2', '48', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '8.9', '96', '854.4000000000001', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(399, '0', '0', '0', NULL, '0', '6', NULL, '114', NULL, NULL, '192', '4', '48', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '9', '192', '1728', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(400, '0', '0', '0', NULL, '0', '6', NULL, '92', NULL, NULL, '192', '32', '6', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '12.93', '192', '2482.56', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(401, '0', '0', '0', NULL, '0', '6', NULL, '75', NULL, NULL, '498', '83', '6', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '21', '498', '10458', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(402, '0', '0', '0', NULL, '0', '6', NULL, '122', NULL, NULL, '120', '12', '10', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '12', '120', '1440', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(403, '0', '0', '0', NULL, '0', '6', NULL, '127', NULL, NULL, '72', '6', '12', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15.6', '72', '1123.2', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(404, '0', '0', '0', NULL, '0', '6', NULL, '133', NULL, NULL, '90', '5', '18', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '14.3', '90', '1287', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(405, '0', '0', '0', NULL, '0', '6', NULL, '142', NULL, NULL, '144', '6', '24', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '12.2', '144', '1756.8', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(406, '0', '0', '0', NULL, '0', '6', NULL, '143', NULL, NULL, '240', '5', '48', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '6.45', '240', '1548', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(407, '0', '0', '0', NULL, '0', '6', NULL, '148', NULL, NULL, '304', '38', '8', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '16', '304', '4864', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(408, '0', '0', '0', NULL, '0', '6', NULL, '155', NULL, NULL, '216', '18', '12', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '14', '216', '3024', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(409, '0', '0', '0', NULL, '0', '6', NULL, '156', NULL, NULL, '192', '8', '24', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '13', '192', '2496', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(410, '0', '0', '0', NULL, '0', '6', NULL, '168', NULL, NULL, '384', '64', '6', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '16', '384', '6144', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(411, '0', '0', '0', NULL, '0', '6', NULL, '169', NULL, NULL, '288', '6', '48', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '288', '4320', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(412, '0', '0', '0', NULL, '0', '6', NULL, '157', NULL, NULL, '168', '7', '24', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '8.56', '168', '1438.0800000000002', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(413, '0', '0', '0', NULL, '0', '6', NULL, '173', NULL, NULL, '192', '16', '12', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '12.97', '192', '2490.2400000000002', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(414, '0', '0', '0', NULL, '0', '6', NULL, '199', NULL, NULL, '96', '16', '6', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '22.6', '96', '2169.6000000000004', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(415, '0', '0', '0', NULL, '0', '6', NULL, '200', NULL, NULL, '200', '20', '10', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '7.85', '200', '1570', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(416, '0', '0', '0', NULL, '0', '6', NULL, '201', NULL, NULL, '384', '16', '24', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '6.8', '384', '2611.2', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(417, '0', '0', '0', NULL, '0', '6', NULL, '202', NULL, NULL, '408', '17', '24', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '6.89', '408', '2811.12', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(418, '0', '0', '0', NULL, '0', '6', NULL, '29', NULL, NULL, '576', '36', '16', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '6.37', '576', '3669.120', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL),
(419, '0', '0', '0', NULL, '0', '6', NULL, '80', NULL, NULL, '500', '25', '20', '', '', '', '', '', '', NULL, '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '7.00', '500', '3500.000', NULL, NULL, '0', '1', NULL, '2019-09-09', NULL, 'A', '1', '1', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation_purchase_order_hdr`
--

CREATE TABLE `tbl_quotation_purchase_order_hdr` (
  `purchaseid` int(11) NOT NULL,
  `lot_no` varchar(200) DEFAULT NULL,
  `edd` varchar(200) DEFAULT NULL,
  `tax_retail` varchar(200) DEFAULT NULL,
  `vendor_id` varchar(200) DEFAULT NULL,
  `proforma_no` varchar(200) DEFAULT NULL,
  `proforma_date` varchar(200) DEFAULT NULL,
  `buyer_order` varchar(200) DEFAULT NULL,
  `buyer_date` varchar(200) DEFAULT NULL,
  `ship_date` varchar(200) DEFAULT NULL,
  `payment_term` varchar(200) DEFAULT NULL,
  `dilivery_term` varchar(200) DEFAULT NULL,
  `port_loading` varchar(200) DEFAULT NULL,
  `port_of_discharge` varchar(200) DEFAULT NULL,
  `partshipment` varchar(200) DEFAULT NULL,
  `forwarder` varchar(200) DEFAULT NULL,
  `sub_total` varchar(200) DEFAULT NULL,
  `qty_total` int(11) DEFAULT NULL,
  `sales_id` varchar(200) DEFAULT NULL,
  `purchase_no` varchar(200) DEFAULT NULL,
  `agent_id` varchar(200) DEFAULT NULL,
  `wff_date` varchar(200) DEFAULT NULL,
  `valid_till_date` varchar(200) DEFAULT NULL,
  `reference` varchar(200) DEFAULT NULL,
  `freight` varchar(200) DEFAULT NULL,
  `Place_of_Supply` varchar(200) DEFAULT NULL,
  `gr_no` varchar(200) DEFAULT NULL,
  `state_id` varchar(200) DEFAULT NULL,
  `company_id` varchar(200) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `customernumber` varchar(200) DEFAULT NULL,
  `contactid` varchar(200) DEFAULT NULL,
  `season` varchar(200) DEFAULT NULL,
  `assignedto` varchar(200) DEFAULT NULL,
  `purchaseorder` varchar(200) DEFAULT NULL,
  `sales_commission` varchar(200) DEFAULT NULL,
  `sales_ordernumber` varchar(200) DEFAULT NULL,
  `due_date` varchar(200) DEFAULT NULL,
  `organisation_id` varchar(200) DEFAULT NULL,
  `invoice_status` varchar(200) DEFAULT NULL,
  `excise_total` varchar(200) DEFAULT NULL,
  `vat_total` varchar(200) DEFAULT NULL,
  `sales_total` varchar(200) DEFAULT NULL,
  `services_total` varchar(200) DEFAULT NULL,
  `item_price_total` varchar(200) DEFAULT NULL,
  `discount` varchar(200) DEFAULT NULL,
  `shipping_charge` varchar(200) DEFAULT NULL,
  `installation_charge_per` varchar(200) DEFAULT NULL,
  `installation_charge` varchar(200) DEFAULT NULL,
  `total_cgst` varchar(200) DEFAULT NULL,
  `total_tax_cgst_amt` varchar(200) DEFAULT NULL,
  `total_sgst` varchar(200) DEFAULT NULL,
  `total_tax_sgst_amt` varchar(200) DEFAULT NULL,
  `total_igst` varchar(200) DEFAULT NULL,
  `total_tax_igst_amt` varchar(200) DEFAULT NULL,
  `total_gst_tax_amt` varchar(200) DEFAULT NULL,
  `total_dis` varchar(200) DEFAULT NULL,
  `total_dis_amt` varchar(200) DEFAULT NULL,
  `dvat_total` varchar(200) DEFAULT NULL,
  `dvat_on_a_per` varchar(200) DEFAULT NULL,
  `dvat_on_a` varchar(200) DEFAULT NULL,
  `pre_tax_total` varchar(200) DEFAULT NULL,
  `discount_rate_on_total` varchar(200) DEFAULT NULL,
  `direct_dicount_amt` varchar(200) DEFAULT NULL,
  `vat_rate_on_total` varchar(200) DEFAULT NULL,
  `sales_rate_on_total` varchar(200) DEFAULT NULL,
  `service_rate_on_total` varchar(200) DEFAULT NULL,
  `shipping_vat_rate_on_total` varchar(200) DEFAULT NULL,
  `shipping_sales_rate_on_total` varchar(200) DEFAULT NULL,
  `shipping_service_rate_on_total` varchar(200) DEFAULT NULL,
  `shipping_vat_total` varchar(200) DEFAULT NULL,
  `shipping_sales_total` varchar(200) DEFAULT NULL,
  `shipping_service_total` varchar(200) DEFAULT NULL,
  `shpping_total` varchar(200) DEFAULT NULL,
  `tax_total` varchar(200) DEFAULT NULL,
  `adjustment_type` varchar(200) DEFAULT NULL,
  `adjustment_total` varchar(200) DEFAULT NULL,
  `grand_total` varchar(200) DEFAULT NULL,
  `advance_total` varchar(200) DEFAULT NULL,
  `balance_total` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `manufacturer_id` varchar(200) DEFAULT NULL,
  `c_name` varchar(200) DEFAULT NULL,
  `cust_phone` varchar(200) DEFAULT NULL,
  `cust_address` varchar(200) DEFAULT NULL,
  `contact_no` varchar(200) DEFAULT NULL,
  `brnch_id` varchar(200) DEFAULT NULL,
  `invoice_type` varchar(200) DEFAULT NULL,
  `fdate` varchar(200) DEFAULT NULL,
  `todate` varchar(200) DEFAULT NULL,
  `product_exp_date` varchar(200) DEFAULT NULL,
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL,
  `surcharge_tax` varchar(200) DEFAULT '0',
  `paymode` varchar(200) DEFAULT NULL,
  `generated_status` varchar(200) DEFAULT 'Direct',
  `serial_no` int(11) DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `referenceof` varchar(200) DEFAULT NULL,
  `deliverymode` varchar(200) DEFAULT NULL,
  `submit_amount` varchar(200) DEFAULT '0',
  `locationid` varchar(200) DEFAULT NULL,
  `terminalid` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_quotation_purchase_order_hdr`
--

INSERT INTO `tbl_quotation_purchase_order_hdr` (`purchaseid`, `lot_no`, `edd`, `tax_retail`, `vendor_id`, `proforma_no`, `proforma_date`, `buyer_order`, `buyer_date`, `ship_date`, `payment_term`, `dilivery_term`, `port_loading`, `port_of_discharge`, `partshipment`, `forwarder`, `sub_total`, `qty_total`, `sales_id`, `purchase_no`, `agent_id`, `wff_date`, `valid_till_date`, `reference`, `freight`, `Place_of_Supply`, `gr_no`, `state_id`, `company_id`, `subject`, `invoice_date`, `customernumber`, `contactid`, `season`, `assignedto`, `purchaseorder`, `sales_commission`, `sales_ordernumber`, `due_date`, `organisation_id`, `invoice_status`, `excise_total`, `vat_total`, `sales_total`, `services_total`, `item_price_total`, `discount`, `shipping_charge`, `installation_charge_per`, `installation_charge`, `total_cgst`, `total_tax_cgst_amt`, `total_sgst`, `total_tax_sgst_amt`, `total_igst`, `total_tax_igst_amt`, `total_gst_tax_amt`, `total_dis`, `total_dis_amt`, `dvat_total`, `dvat_on_a_per`, `dvat_on_a`, `pre_tax_total`, `discount_rate_on_total`, `direct_dicount_amt`, `vat_rate_on_total`, `sales_rate_on_total`, `service_rate_on_total`, `shipping_vat_rate_on_total`, `shipping_sales_rate_on_total`, `shipping_service_rate_on_total`, `shipping_vat_total`, `shipping_sales_total`, `shipping_service_total`, `shpping_total`, `tax_total`, `adjustment_type`, `adjustment_total`, `grand_total`, `advance_total`, `balance_total`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `manufacturer_id`, `c_name`, `cust_phone`, `cust_address`, `contact_no`, `brnch_id`, `invoice_type`, `fdate`, `todate`, `product_exp_date`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`, `surcharge_tax`, `paymode`, `generated_status`, `serial_no`, `delivery_date`, `referenceof`, `deliverymode`, `submit_amount`, `locationid`, `terminalid`) VALUES
(1, '001', '2019-08-28', '', '1', '332232', '2019-08-28', '112121', '2019-08-28', '2019-08-28', '121', '121', '46', '48', '121', '12121', '664', 280, '0', '1456', '', '', '', '', '', '2019-01-07', '0', '', '', NULL, '2019-01-07', NULL, '1', '', NULL, NULL, NULL, NULL, '36', NULL, 'GST', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0.00', '0', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13012.50', NULL, NULL, '1', '2019-08-28', NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '0', NULL, 'Direct', NULL, NULL, NULL, NULL, '0', NULL, NULL),
(2, '002', '2019-05-18', '', '1', '002', '2019-05-18', '001', '2019-05-18', '2019-05-18', '002', '002', '47', '48', '12', '33', '1476', 1336, '0', '1455', '', '', '', '', '', '2019-01-07', '0', '', '', NULL, '2019-01-07', NULL, '1', '', NULL, NULL, NULL, NULL, '36', NULL, 'GST', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '1', '2019-05-18', NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '0', NULL, 'Direct', NULL, NULL, NULL, NULL, '0', NULL, NULL),
(3, '32', '2019-05-04', '', '1', '', '', '', '', '', '', '', '', '', '', '', '102', 100, '0', '223', '', '', '', '', '', '2019-05-04', '0', '', '', NULL, '2019-05-04', NULL, '1', '', NULL, NULL, NULL, NULL, '37', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '1', '2019-05-04', NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '0', NULL, 'Direct', NULL, NULL, NULL, NULL, '0', NULL, NULL),
(4, '004', '2019-05-20', '', '', '001', '2019-05-20', '001', '2019-05-20', '2019-05-20', '001', '001', '46', '49', '12', '22', '2592', 600, '0', '004', '', '', '', '', '', '2019-05-20', '0', '', '', NULL, '2019-05-20', NULL, '1', '', NULL, NULL, NULL, NULL, '', NULL, 'GST', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0.00', '0', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '354753.00', NULL, NULL, '1', '2019-08-28', NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '0', NULL, 'Direct', NULL, NULL, NULL, NULL, '0', NULL, NULL),
(5, '040', '2019-10-31', '', '', '1500', '2019-08-09', '1550', '2019-08-09', '2019-10-31', 'DP', 'FOB MUMBAI', '46', '49', 'ALLOWED', 'CHR', '2374', 1002, '0', '', '', '', '', '', '', '2019-08-09', '0', '', '', NULL, '2019-08-09', NULL, '1', '', NULL, NULL, NULL, NULL, '37', NULL, 'GST', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0.00', '0', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49468.10', NULL, NULL, '1', '2019-09-03', NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '0', NULL, 'Direct', NULL, NULL, NULL, NULL, '0', NULL, NULL),
(6, '050', '2019-10-10', '', '', '0010', '2019-08-06', '00001580', '2019-08-05', '2019-10-20', 'DP', 'FOB', '46', '49', 'ALLOWED', 'CHR', '6464', 500, '0', '', '', '', '', '', '', '2019-08-06', '0', '', '', NULL, '2019-08-06', NULL, '1', '', NULL, NULL, NULL, NULL, '37', NULL, 'GST', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0.00', '0', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '88272.36', NULL, NULL, '1', '2019-09-09', NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '0', NULL, 'Direct', NULL, NULL, NULL, NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receivematrial_dtl`
--

CREATE TABLE `tbl_receivematrial_dtl` (
  `inbound_dtl_id` int(11) NOT NULL,
  `inboundrhdr` int(11) NOT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `receive_qty` varchar(200) DEFAULT NULL,
  `remaining_qty` varchar(200) NOT NULL DEFAULT '0',
  `order_qty` varchar(200) NOT NULL DEFAULT '0',
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_receivematrial_dtl`
--

INSERT INTO `tbl_receivematrial_dtl` (`inbound_dtl_id`, `inboundrhdr`, `productid`, `receive_qty`, `remaining_qty`, `order_qty`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, 1, '71', '130', '', '100', '1', NULL, '2019-03-12', NULL, 'A', '1', '1', '1', NULL),
(2, 2, '71', '104.75', '', '50', '1', NULL, '2019-03-13', NULL, 'A', '1', '1', '1', NULL),
(3, 3, '71', '224', '', '144', '1', NULL, '2019-03-25', NULL, 'A', '1', '1', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receive_matrial_grn_log`
--

CREATE TABLE `tbl_receive_matrial_grn_log` (
  `inbound_dtl_id` int(11) NOT NULL,
  `inboundrhdr` int(11) DEFAULT NULL,
  `po_no` varchar(200) DEFAULT NULL,
  `productid` varchar(200) DEFAULT NULL,
  `grn_no` varchar(200) DEFAULT NULL,
  `grn_date` varchar(200) DEFAULT NULL,
  `receive_qty` varchar(200) DEFAULT NULL,
  `outboundqty` int(11) NOT NULL DEFAULT 0,
  `clear_status` tinyint(1) NOT NULL DEFAULT 0,
  `remaining_qty` varchar(200) NOT NULL DEFAULT '0',
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receive_matrial_hdr`
--

CREATE TABLE `tbl_receive_matrial_hdr` (
  `inboundid` int(11) NOT NULL,
  `storage_location` varchar(200) DEFAULT NULL,
  `po_no` varchar(200) DEFAULT NULL,
  `request_no` varchar(200) DEFAULT NULL,
  `grn_date` varchar(200) DEFAULT NULL,
  `grn_no` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `challan_no` varchar(200) DEFAULT NULL,
  `challan_date` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_receive_matrial_hdr`
--

INSERT INTO `tbl_receive_matrial_hdr` (`inboundid`, `storage_location`, `po_no`, `request_no`, `grn_date`, `grn_no`, `date`, `challan_no`, `challan_date`, `maker_id`, `maker_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '', '1', 'req001', '', '', '19-03-12', '001', '', '1', '2019-03-12', 'A', '1', '1', '1', '1'),
(2, '', '1', 'req001', '', '', '19-03-13', '002', '', '1', '2019-03-13', 'A', '1', '1', '1', '1'),
(3, '', '3', 'RMR-002', '', '', '19-03-25', '003', '26.03.2019', '1', '2019-03-25', 'A', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_func_action`
--

CREATE TABLE `tbl_role_func_action` (
  `rol_func_act_id` int(11) NOT NULL,
  `role_id` varchar(200) NOT NULL,
  `module_id` varchar(200) DEFAULT NULL,
  `function_url` varchar(200) NOT NULL,
  `action_id` varchar(200) NOT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author_date` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role_func_action`
--

INSERT INTO `tbl_role_func_action` (`rol_func_act_id`, `role_id`, `module_id`, `function_url`, `action_id`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, '1', '4', '91', 'Inactive', '1', '2017-03-18', '1', '2017-03-18', 'A', '1', '1', '1', '1'),
(2, '1', '4', '111', 'Active', '1', '2017-03-18', '1', '2017-03-18', 'A', '1', '1', '1', '1'),
(3, '1', '4', '93', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(4, '1', '4', '95', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(5, '1', '4', '97', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(6, '1', '4', '99', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(7, '1', '4', '101', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(8, '1', '4', '103', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(9, '1', '4', '105', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(10, '1', '4', '107', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(11, '1', '4', '109', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(12, '1', '4', '113', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(13, '1', '4', '115', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(14, '1', '4', '117', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(15, '1', '4', '166', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(16, '1', '4', '167', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(17, '1', '4', '189', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(18, '1', '3', '209', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(19, '1', '3', '215', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(20, '1', '3', '221', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(21, '1', '3', '224', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(22, '1', '3', '256', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(23, '1', '3', '263', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(24, '1', '3', '264', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(25, '1', '3', '289', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(26, '1', '23', '306', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(27, '1', '30', '303', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(28, '1', '31', '305', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(29, '1', '28', '294', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(30, '1', '28', '302', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(31, '1', '27', '293', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(32, '1', '27', '304', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(33, '1', '27', '310', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(34, '1', '25', '89', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(35, '1', '7', '90', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(36, '1', '32', '311', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(37, '', '', '', '', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(38, '', '3', '209', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(39, '', '3', '215', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(40, '', '3', '221', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(41, '', '3', '224', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(42, '', '3', '256', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(43, '', '3', '263', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(44, '', '3', '264', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(45, '', '3', '289', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(46, '1', '28', '313', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(47, '1', '32', '312', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(48, '1', '3', '314', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(49, '1', '33', '315', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(50, '1', '34', '316', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(51, '1', '36', '316', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(52, '1', '37', '317', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(53, '1', '38', '318', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(54, '1', '32', '319', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(55, '1', '39', '320', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(56, '1', '39', '321', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(57, '1', '40', '322', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(58, '1', '41', '323', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(59, '1', '3', '324', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(60, '1', '42', '325', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(61, '1', '43', '326', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(62, '1', '44', '327', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(63, '1', '45', '328', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(64, '1', '46', '329', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(65, '1', '47', '330', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(66, '1', '49', '331', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(67, '1', '37', '332', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(68, '1', '39', '333', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(69, '1', '3', '343', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(70, '1', '3', '344', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(71, '1', '3', '345', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(72, '1', '3', '346', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(73, '1', '3', '348', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(74, '1', '3', '349', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(75, '1', '39', '338', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(76, '1', '39', '339', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(77, '1', '50', '354', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(78, '1', '50', '356', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(79, '1', '50', '357', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(80, '1', '3', '350', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(81, '1', '3', '351', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(82, '1', '3', '352', 'Inactive', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(83, '1', '3', '353', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(84, '1', '3', '358', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(85, '1', '3', '359', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(86, '1', '3', '360', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(87, '1', '3', '361', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(88, '1', '3', '362', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(89, '1', '3', '363', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(90, '1', '3', '364', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(91, '1', '45', '365', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(92, '1', '46', '368', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(93, '1', '37', '334', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(94, '1', '37', '341', 'Active', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_mst`
--

CREATE TABLE `tbl_role_mst` (
  `role_id` int(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `role_name` varchar(200) NOT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL,
  `action` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role_mst`
--

INSERT INTO `tbl_role_mst` (`role_id`, `code`, `role_name`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`, `action`) VALUES
(1, '945', 'admin_role', '1', '2017-05-08', '1', '2017-05-08', 'A', '1', '1', '1', '1', 'edit-view-delete-Add'),
(3, '0058', 'user', '1', '2017-06-30', '1', '2017-06-30', 'A', '1', '1', '1', '1', '---');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shape_part_mapping`
--

CREATE TABLE `tbl_shape_part_mapping` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `part_id` varchar(200) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `comp_id` varchar(100) NOT NULL,
  `divn_id` varchar(100) NOT NULL,
  `zone_id` varchar(100) NOT NULL,
  `brnh_id` varchar(100) NOT NULL,
  `maker_id` varchar(100) NOT NULL,
  `author_id` varchar(100) NOT NULL,
  `maker_date` date NOT NULL,
  `author_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_shape_part_mapping`
--

INSERT INTO `tbl_shape_part_mapping` (`id`, `product_id`, `part_id`, `status`, `comp_id`, `divn_id`, `zone_id`, `brnh_id`, `maker_id`, `author_id`, `maker_date`, `author_date`) VALUES
(1, 15, '4', 1, '1', '1', '1', '1', '', '', '2018-12-14', '2018-12-14'),
(7, 3, '4', 1, '', '', '', '', '', '', '0000-00-00', '0000-00-00'),
(8, 3, '5', 1, '', '', '', '', '', '', '0000-00-00', '0000-00-00'),
(9, 3, '6', 1, '', '', '', '', '', '', '0000-00-00', '0000-00-00'),
(10, 3, '7', 1, '', '', '', '', '', '', '0000-00-00', '0000-00-00'),
(11, 3, '8', 1, '', '', '', '', '', '', '0000-00-00', '0000-00-00'),
(12, 15, '4', 1, '1', '1', '1', '1', '', '', '2018-12-14', '2018-12-14'),
(13, 15, '5', 1, '1', '1', '1', '1', '', '', '2018-12-14', '2018-12-14'),
(14, 15, '4', 1, '1', '1', '1', '1', '', '', '2018-12-14', '2018-12-14'),
(15, 15, '4', 1, '1', '1', '1', '1', '', '', '2018-12-14', '2018-12-14'),
(16, 15, '5', 1, '1', '1', '1', '1', '', '', '2018-12-14', '2018-12-14'),
(17, 43, '54', 1, '1', '1', '1', '1', '', '', '2019-01-03', '2019-01-03'),
(18, 43, '55', 1, '1', '1', '1', '1', '', '', '2019-01-03', '2019-01-03'),
(19, 38, '44', 1, '1', '1', '1', '1', '', '', '2019-01-10', '2019-01-10'),
(20, 38, '45', 1, '1', '1', '1', '1', '', '', '2019-01-10', '2019-01-10'),
(21, 39, '46', 1, '1', '1', '1', '1', '', '', '2019-03-13', '2019-03-13'),
(22, 39, '47', 1, '1', '1', '1', '1', '', '', '2019-03-13', '2019-03-13'),
(23, 42, '52', 1, '1', '1', '1', '1', '', '', '2019-03-13', '2019-03-13'),
(24, 42, '53', 1, '1', '1', '1', '1', '', '', '2019-03-13', '2019-03-13'),
(25, 40, '48', 1, '1', '1', '1', '1', '', '', '2019-03-13', '2019-03-13'),
(26, 40, '49', 1, '1', '1', '1', '1', '', '', '2019-03-13', '2019-03-13'),
(27, 41, '50', 1, '1', '1', '1', '1', '', '', '2019-03-13', '2019-03-13'),
(28, 41, '51', 1, '1', '1', '1', '1', '', '', '2019-03-13', '2019-03-13'),
(129, 79, '77', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(130, 79, '78', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(131, 79, '83', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(132, 91, '88', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(133, 91, '89', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(134, 91, '90', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(135, 96, '93', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(136, 96, '94', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(137, 96, '95', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(138, 126, '123', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(139, 126, '124', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(140, 126, '125', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(141, 24, '25', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(142, 24, '26', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(143, 24, '27', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(144, 24, '28', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(145, 24, '37', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(146, 101, '98', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(147, 101, '99', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(148, 101, '100', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(149, 108, '105', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(150, 108, '106', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(151, 108, '107', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(152, 113, '110', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(153, 113, '111', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(154, 113, '112', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(155, 128, '116', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(156, 128, '117', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(157, 128, '112', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(158, 87, '84', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(159, 87, '85', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(160, 87, '86', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(161, 121, '118', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(162, 121, '119', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(163, 121, '120', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(164, 132, '129', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(165, 132, '130', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(166, 132, '131', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(167, 140, '134', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(168, 140, '135', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(169, 140, '136', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(170, 141, '137', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(171, 141, '138', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(172, 141, '139', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(173, 147, '144', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(174, 147, '145', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(175, 147, '146', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(180, 154, '151', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(181, 154, '152', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(182, 153, '149', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(183, 153, '150', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(184, 166, '158', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(185, 166, '159', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(186, 166, '160', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(187, 166, '161', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(188, 167, '162', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(189, 167, '163', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(190, 167, '164', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(191, 167, '165', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(194, 172, '170', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(195, 172, '171', 1, '1', '1', '1', '1', '', '', '2019-07-30', '2019-07-30'),
(196, 196, '186', 1, '1', '1', '1', '1', '', '', '2019-07-31', '2019-07-31'),
(197, 196, '187', 1, '1', '1', '1', '1', '', '', '2019-07-31', '2019-07-31'),
(198, 196, '188', 1, '1', '1', '1', '1', '', '', '2019-07-31', '2019-07-31'),
(199, 197, '189', 1, '1', '1', '1', '1', '', '', '2019-07-31', '2019-07-31'),
(200, 197, '191', 1, '1', '1', '1', '1', '', '', '2019-07-31', '2019-07-31'),
(201, 197, '192', 1, '1', '1', '1', '1', '', '', '2019-07-31', '2019-07-31'),
(202, 198, '193', 1, '1', '1', '1', '1', '', '', '2019-07-31', '2019-07-31'),
(203, 198, '194', 1, '1', '1', '1', '1', '', '', '2019-07-31', '2019-07-31'),
(204, 198, '195', 1, '1', '1', '1', '1', '', '', '2019-07-31', '2019-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_software_log`
--

CREATE TABLE `tbl_software_log` (
  `id` int(11) NOT NULL,
  `log_id` varchar(200) DEFAULT NULL,
  `contact_id` varchar(200) NOT NULL,
  `total` varchar(200) NOT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_software_log`
--

INSERT INTO `tbl_software_log` (`id`, `log_id`, `contact_id`, `total`, `maker_id`, `maker_date`, `author_id`, `author_date`, `type`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`, `status`) VALUES
(1, '1', '4', '0.00', '1', '2018-12-22', '11:12:25', NULL, 'Purchase Order added', '0', '0', '2', '0', 'A'),
(2, '4', '1', '0', '1', '2019-01-08', '16:34:09', NULL, 'Invoice Updated', '1', '1', '1', '1', 'A'),
(3, '1', '7', '196175.00', '1', '2019-01-10', '12:28:45', NULL, 'Purchase Order added', '1', '1', '1', '1', 'A'),
(4, '1', '7', '196175.00', '1', '2019-01-10', '12:38:48', NULL, 'Invoice Updated', '1', '1', '1', '1', 'A'),
(5, '2', '7', '65000.00', '1', '2019-01-10', '14:40:43', NULL, 'Purchase Order added', '1', '1', '1', '1', 'A'),
(6, '2', '7', '135000.00', '1', '2019-01-10', '14:42:05', NULL, 'Invoice Updated', '1', '1', '1', '1', 'A'),
(7, '3', '8', '48450.00', '1', '2019-01-10', '15:07:01', NULL, 'Purchase Order added', '1', '1', '1', '1', 'A'),
(8, '4', '9', '225000.00', '1', '2019-02-08', '17:36:45', NULL, 'Purchase Order added', '1', '1', '1', '1', 'A'),
(9, '5', '8', '94400.00', '1', '2019-02-08', '17:38:08', NULL, 'Purchase Order added', '1', '1', '1', '1', 'A'),
(10, '6', '9', '172250.00', '1', '2019-02-08', '18:13:53', NULL, 'Purchase Order added', '1', '1', '1', '1', 'A'),
(11, '7', '4', '137.00', '1', '2019-03-06', '17:57:47', NULL, 'Purchase Order added', '1', '1', '1', '1', 'A'),
(12, '1', '4', '1.18', '1', '2019-03-07', '15:46:41', NULL, 'Purchase Order added', '1', '1', '1', '1', 'A'),
(13, '1', '4', '1.00', '1', '2019-03-07', '16:00:53', NULL, 'Purchase Order added', '1', '1', '1', '1', 'A'),
(14, '1', '9', '123300.00', '1', '2019-03-07', '16:09:51', NULL, 'Purchase Order added', '1', '1', '1', '1', 'A'),
(15, '2', '7', '250000.00', '1', '2019-03-07', '16:31:53', NULL, 'Purchase Order added', '1', '1', '1', '1', 'A'),
(16, '3', '8', '32000.00', '1', '2019-03-07', '16:32:38', NULL, 'Purchase Order added', '1', '1', '1', '1', 'A'),
(17, '4', '9', '60280.00', '1', '2019-03-25', '11:30:44', NULL, 'Purchase Order added', '1', '1', '1', '1', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state_i`
--

CREATE TABLE `tbl_state_i` (
  `stateid` int(11) NOT NULL,
  `stateName` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_state_i`
--

INSERT INTO `tbl_state_i` (`stateid`, `stateName`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, 'Jammu & Kashmir', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(2, 'Himachal Pradesh', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(3, 'Punjab', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(4, 'Chandigarh', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(5, 'Uttarakhand', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(6, 'Haryana', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(7, 'Delhi', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(8, 'Rajasthan', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(9, 'Uttar Pradesh', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(10, 'Bihar', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(11, 'Sikkim', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(12, 'Arunachal Pradesh', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(13, 'Nagaland', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(14, 'Manipur', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(15, 'Mizoram', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(16, 'Tripura', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(17, 'Meghalaya', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(18, 'Assam', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(19, 'West Bengal', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(20, 'Jharkhand', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(21, 'Odisha', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(22, 'Chhattisgarh', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(23, 'Madhya Pradesh', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(24, 'Gujarat', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(25, 'Daman and Diu', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(26, 'Karnataka', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state_u`
--

CREATE TABLE `tbl_state_u` (
  `stateid` int(11) NOT NULL,
  `stateName` varchar(200) DEFAULT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `comp_id` varchar(200) DEFAULT NULL,
  `zone_id` varchar(200) DEFAULT NULL,
  `brnh_id` varchar(200) DEFAULT NULL,
  `divn_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_state_u`
--

INSERT INTO `tbl_state_u` (`stateid`, `stateName`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`) VALUES
(1, 'Alabama', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(2, 'Alaska', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(3, 'Arizona', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(4, 'Arkansas', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(5, 'California', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(6, 'Colorado', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(7, 'Connecticut', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(8, 'Delaware', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(9, 'Florida', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(10, 'Georgia', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(11, 'Hawaii', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(12, 'Idaho', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(13, 'IllinoisIndiana', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(14, 'Iowa', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(15, 'Kansas', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(16, 'Kentucky', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(17, 'Louisiana', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(18, 'Maine', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(19, 'Maryland', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(20, 'Massachusetts', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(21, 'Michigan', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(22, 'Minnesota', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(23, 'Mississippi', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(24, 'Missouri', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(25, 'MontanaNebraska', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(26, 'Nevada', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(27, 'New Hampshire', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(28, 'New Jersey', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(29, 'New Mexico', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(30, 'New York', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(31, 'North Carolina', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(32, 'North Dakota', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(33, 'Ohio', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(34, 'Oklahoma', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(35, 'Oregon', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(36, 'PennsylvaniaRhode Island', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(37, 'South Carolina', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(38, 'South Dakota', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(39, 'Tennessee', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(40, 'Texas', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(41, 'Utah', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(42, 'Vermont', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(43, 'Virginia', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(44, 'Washington', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(45, 'West Virginia', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(46, 'Wisconsin', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL),
(47, 'Wyoming', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_mst`
--

CREATE TABLE `tbl_user_mst` (
  `user_id` int(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `comp_id` varchar(200) NOT NULL,
  `zone_id` varchar(200) NOT NULL,
  `brnh_id` varchar(200) NOT NULL,
  `divn_id` varchar(200) NOT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A',
  `data_access` varchar(200) DEFAULT 'self',
  `Allrowaccess` int(3) DEFAULT 1,
  `brnha_id` varchar(200) DEFAULT NULL,
  `compa_id` varchar(200) DEFAULT NULL,
  `divna_id` varchar(200) DEFAULT NULL,
  `zonea_id` varchar(200) DEFAULT NULL,
  `user_type` varchar(200) NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `phone_no` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_mst`
--

INSERT INTO `tbl_user_mst` (`user_id`, `user_name`, `password`, `company_name`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`, `maker_id`, `maker_date`, `author_id`, `author_date`, `status`, `data_access`, `Allrowaccess`, `brnha_id`, `compa_id`, `divna_id`, `zonea_id`, `user_type`, `email_id`, `phone_no`) VALUES
(1, 'admin', 'admin', 'Techvyas', '1', '1', '1', '1', '1', '2017-03-18', '1', '2017-03-18', 'A', 'self', 1, '1', '1', '1', '1', 'User', 'anojk1996@gmail.com', '9582075068');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_role_mst`
--

CREATE TABLE `tbl_user_role_mst` (
  `user_role_id` int(200) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `role_id` varchar(200) NOT NULL,
  `comp_id` varchar(200) NOT NULL,
  `zone_id` varchar(200) NOT NULL,
  `brnh_id` varchar(200) NOT NULL,
  `divn_id` varchar(200) NOT NULL,
  `maker_id` varchar(200) DEFAULT NULL,
  `author_id` varchar(200) DEFAULT NULL,
  `maker_date` date DEFAULT NULL,
  `author_date` date DEFAULT NULL,
  `status` varchar(200) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_role_mst`
--

INSERT INTO `tbl_user_role_mst` (`user_role_id`, `user_id`, `role_id`, `comp_id`, `zone_id`, `brnh_id`, `divn_id`, `maker_id`, `author_id`, `maker_date`, `author_date`, `status`) VALUES
(1, '1', '1', '1', '1', '1', '1', '1', '1', '2017-03-18', '2017-03-18', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account_mst`
--
ALTER TABLE `tbl_account_mst`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `FK_main_id` (`main_account_id`),
  ADD KEY `main_account_id_2` (`main_account_id`),
  ADD KEY `main_account_id` (`main_account_id`);

--
-- Indexes for table `tbl_assemble_fg`
--
ALTER TABLE `tbl_assemble_fg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contact_m`
--
ALTER TABLE `tbl_contact_m`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `tbl_grn_return_dtl`
--
ALTER TABLE `tbl_grn_return_dtl`
  ADD PRIMARY KEY (`grndtl`);

--
-- Indexes for table `tbl_grn_return_hdr`
--
ALTER TABLE `tbl_grn_return_hdr`
  ADD PRIMARY KEY (`grnhdr`);

--
-- Indexes for table `tbl_inbound_dtl`
--
ALTER TABLE `tbl_inbound_dtl`
  ADD PRIMARY KEY (`inbound_dtl_id`);

--
-- Indexes for table `tbl_inbound_hdr`
--
ALTER TABLE `tbl_inbound_hdr`
  ADD PRIMARY KEY (`inboundid`);

--
-- Indexes for table `tbl_inbound_log`
--
ALTER TABLE `tbl_inbound_log`
  ADD PRIMARY KEY (`inbound_dtl_id`);

--
-- Indexes for table `tbl_issuematrial_dtl`
--
ALTER TABLE `tbl_issuematrial_dtl`
  ADD PRIMARY KEY (`inbound_dtl_id`);

--
-- Indexes for table `tbl_issuematrial_hdr`
--
ALTER TABLE `tbl_issuematrial_hdr`
  ADD PRIMARY KEY (`inboundid`);

--
-- Indexes for table `tbl_issue_raw_materail`
--
ALTER TABLE `tbl_issue_raw_materail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_job_purchase_order_return`
--
ALTER TABLE `tbl_job_purchase_order_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_job_rm_return`
--
ALTER TABLE `tbl_job_rm_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_job_work`
--
ALTER TABLE `tbl_job_work`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_job_work_log`
--
ALTER TABLE `tbl_job_work_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_job_work_scrap`
--
ALTER TABLE `tbl_job_work_scrap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_machine`
--
ALTER TABLE `tbl_machine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_machine_spare_map`
--
ALTER TABLE `tbl_machine_spare_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_master_data`
--
ALTER TABLE `tbl_master_data`
  ADD PRIMARY KEY (`serial_number`);

--
-- Indexes for table `tbl_master_data_mst`
--
ALTER TABLE `tbl_master_data_mst`
  ADD PRIMARY KEY (`param_id`);

--
-- Indexes for table `tbl_module_function`
--
ALTER TABLE `tbl_module_function`
  ADD PRIMARY KEY (`func_id`),
  ADD UNIQUE KEY `function_name` (`function_name`);

--
-- Indexes for table `tbl_module_mst`
--
ALTER TABLE `tbl_module_mst`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `tbl_part_price_mapping`
--
ALTER TABLE `tbl_part_price_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_po_order`
--
ALTER TABLE `tbl_po_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_po_order_log`
--
ALTER TABLE `tbl_po_order_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_production_available_order`
--
ALTER TABLE `tbl_production_available_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_production_dispatch`
--
ALTER TABLE `tbl_production_dispatch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_production_grn_dtl`
--
ALTER TABLE `tbl_production_grn_dtl`
  ADD PRIMARY KEY (`inbound_dtl_id`);

--
-- Indexes for table `tbl_production_grn_hdr`
--
ALTER TABLE `tbl_production_grn_hdr`
  ADD PRIMARY KEY (`inboundid`);

--
-- Indexes for table `tbl_production_grn_log`
--
ALTER TABLE `tbl_production_grn_log`
  ADD PRIMARY KEY (`inbound_dtl_id`);

--
-- Indexes for table `tbl_production_order_check`
--
ALTER TABLE `tbl_production_order_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_production_order_log`
--
ALTER TABLE `tbl_production_order_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_production_order_repair`
--
ALTER TABLE `tbl_production_order_repair`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_production_order_transfer_another_module`
--
ALTER TABLE `tbl_production_order_transfer_another_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product_inspection`
--
ALTER TABLE `tbl_product_inspection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product_packing`
--
ALTER TABLE `tbl_product_packing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product_serial`
--
ALTER TABLE `tbl_product_serial`
  ADD PRIMARY KEY (`serial_number`);

--
-- Indexes for table `tbl_product_serial_log`
--
ALTER TABLE `tbl_product_serial_log`
  ADD PRIMARY KEY (`serial_number`);

--
-- Indexes for table `tbl_product_stock`
--
ALTER TABLE `tbl_product_stock`
  ADD PRIMARY KEY (`Product_id`);

--
-- Indexes for table `tbl_product_transfer_to_packing`
--
ALTER TABLE `tbl_product_transfer_to_packing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_purchase_order_dtl`
--
ALTER TABLE `tbl_purchase_order_dtl`
  ADD PRIMARY KEY (`purchase_dtl_id`);

--
-- Indexes for table `tbl_purchase_order_hdr`
--
ALTER TABLE `tbl_purchase_order_hdr`
  ADD PRIMARY KEY (`purchaseid`);

--
-- Indexes for table `tbl_quotation_purchase_order_dtl`
--
ALTER TABLE `tbl_quotation_purchase_order_dtl`
  ADD PRIMARY KEY (`purchase_dtl_id`);

--
-- Indexes for table `tbl_quotation_purchase_order_hdr`
--
ALTER TABLE `tbl_quotation_purchase_order_hdr`
  ADD PRIMARY KEY (`purchaseid`);

--
-- Indexes for table `tbl_receivematrial_dtl`
--
ALTER TABLE `tbl_receivematrial_dtl`
  ADD PRIMARY KEY (`inbound_dtl_id`);

--
-- Indexes for table `tbl_receive_matrial_grn_log`
--
ALTER TABLE `tbl_receive_matrial_grn_log`
  ADD PRIMARY KEY (`inbound_dtl_id`);

--
-- Indexes for table `tbl_receive_matrial_hdr`
--
ALTER TABLE `tbl_receive_matrial_hdr`
  ADD PRIMARY KEY (`inboundid`);

--
-- Indexes for table `tbl_role_func_action`
--
ALTER TABLE `tbl_role_func_action`
  ADD PRIMARY KEY (`rol_func_act_id`);

--
-- Indexes for table `tbl_role_mst`
--
ALTER TABLE `tbl_role_mst`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_shape_part_mapping`
--
ALTER TABLE `tbl_shape_part_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_software_log`
--
ALTER TABLE `tbl_software_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_state_i`
--
ALTER TABLE `tbl_state_i`
  ADD UNIQUE KEY `stateid` (`stateid`);

--
-- Indexes for table `tbl_state_u`
--
ALTER TABLE `tbl_state_u`
  ADD UNIQUE KEY `stateid` (`stateid`);

--
-- Indexes for table `tbl_user_mst`
--
ALTER TABLE `tbl_user_mst`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_role_mst`
--
ALTER TABLE `tbl_user_role_mst`
  ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account_mst`
--
ALTER TABLE `tbl_account_mst`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_assemble_fg`
--
ALTER TABLE `tbl_assemble_fg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_contact_m`
--
ALTER TABLE `tbl_contact_m`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_grn_return_dtl`
--
ALTER TABLE `tbl_grn_return_dtl`
  MODIFY `grndtl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_grn_return_hdr`
--
ALTER TABLE `tbl_grn_return_hdr`
  MODIFY `grnhdr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_inbound_dtl`
--
ALTER TABLE `tbl_inbound_dtl`
  MODIFY `inbound_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_inbound_hdr`
--
ALTER TABLE `tbl_inbound_hdr`
  MODIFY `inboundid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_inbound_log`
--
ALTER TABLE `tbl_inbound_log`
  MODIFY `inbound_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_issuematrial_dtl`
--
ALTER TABLE `tbl_issuematrial_dtl`
  MODIFY `inbound_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_issuematrial_hdr`
--
ALTER TABLE `tbl_issuematrial_hdr`
  MODIFY `inboundid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_issue_raw_materail`
--
ALTER TABLE `tbl_issue_raw_materail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_job_purchase_order_return`
--
ALTER TABLE `tbl_job_purchase_order_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_job_rm_return`
--
ALTER TABLE `tbl_job_rm_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_job_work`
--
ALTER TABLE `tbl_job_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_job_work_log`
--
ALTER TABLE `tbl_job_work_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_job_work_scrap`
--
ALTER TABLE `tbl_job_work_scrap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_machine`
--
ALTER TABLE `tbl_machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `tbl_machine_spare_map`
--
ALTER TABLE `tbl_machine_spare_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_master_data`
--
ALTER TABLE `tbl_master_data`
  MODIFY `serial_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_master_data_mst`
--
ALTER TABLE `tbl_master_data_mst`
  MODIFY `param_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_module_function`
--
ALTER TABLE `tbl_module_function`
  MODIFY `func_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=376;

--
-- AUTO_INCREMENT for table `tbl_module_mst`
--
ALTER TABLE `tbl_module_mst`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_part_price_mapping`
--
ALTER TABLE `tbl_part_price_mapping`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `tbl_po_order`
--
ALTER TABLE `tbl_po_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_po_order_log`
--
ALTER TABLE `tbl_po_order_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_production_available_order`
--
ALTER TABLE `tbl_production_available_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_production_dispatch`
--
ALTER TABLE `tbl_production_dispatch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_production_grn_dtl`
--
ALTER TABLE `tbl_production_grn_dtl`
  MODIFY `inbound_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_production_grn_hdr`
--
ALTER TABLE `tbl_production_grn_hdr`
  MODIFY `inboundid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_production_grn_log`
--
ALTER TABLE `tbl_production_grn_log`
  MODIFY `inbound_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_production_order_check`
--
ALTER TABLE `tbl_production_order_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_production_order_log`
--
ALTER TABLE `tbl_production_order_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_production_order_repair`
--
ALTER TABLE `tbl_production_order_repair`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_production_order_transfer_another_module`
--
ALTER TABLE `tbl_production_order_transfer_another_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_product_inspection`
--
ALTER TABLE `tbl_product_inspection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_product_packing`
--
ALTER TABLE `tbl_product_packing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_product_serial`
--
ALTER TABLE `tbl_product_serial`
  MODIFY `serial_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_product_serial_log`
--
ALTER TABLE `tbl_product_serial_log`
  MODIFY `serial_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_product_stock`
--
ALTER TABLE `tbl_product_stock`
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `tbl_product_transfer_to_packing`
--
ALTER TABLE `tbl_product_transfer_to_packing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_purchase_order_dtl`
--
ALTER TABLE `tbl_purchase_order_dtl`
  MODIFY `purchase_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_purchase_order_hdr`
--
ALTER TABLE `tbl_purchase_order_hdr`
  MODIFY `purchaseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_quotation_purchase_order_dtl`
--
ALTER TABLE `tbl_quotation_purchase_order_dtl`
  MODIFY `purchase_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=420;

--
-- AUTO_INCREMENT for table `tbl_quotation_purchase_order_hdr`
--
ALTER TABLE `tbl_quotation_purchase_order_hdr`
  MODIFY `purchaseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_receivematrial_dtl`
--
ALTER TABLE `tbl_receivematrial_dtl`
  MODIFY `inbound_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_receive_matrial_grn_log`
--
ALTER TABLE `tbl_receive_matrial_grn_log`
  MODIFY `inbound_dtl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_receive_matrial_hdr`
--
ALTER TABLE `tbl_receive_matrial_hdr`
  MODIFY `inboundid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_role_func_action`
--
ALTER TABLE `tbl_role_func_action`
  MODIFY `rol_func_act_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `tbl_shape_part_mapping`
--
ALTER TABLE `tbl_shape_part_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `tbl_software_log`
--
ALTER TABLE `tbl_software_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
