-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2019 at 06:21 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini`
--

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `m_id` int(11) NOT NULL,
  `manufacturer_name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`m_id`, `manufacturer_name`, `created_at`) VALUES
(1, 'Tata', '2019-04-21 15:23:01'),
(2, 'hyundai', '2019-04-21 15:42:25'),
(3, 'ford', '2019-04-21 15:58:05'),
(4, 'BMW', '2019-04-21 16:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `model_id` int(11) NOT NULL,
  `model_name` varchar(200) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `manufacturing_year` int(4) NOT NULL,
  `color` varchar(20) NOT NULL,
  `registration_no` bigint(20) NOT NULL,
  `note` text NOT NULL,
  `car_images` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1:sold;0:unsold',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`model_id`, `model_name`, `manufacturer_id`, `manufacturing_year`, `color`, `registration_no`, `note`, `car_images`, `status`, `created_at`) VALUES
(3, 'Harrier', 1, 2018, 'orange', 123456789, 'Tata Harrier Price (GST Rates) in India starts at ? 12.71 Lakhs. Check out Tata ... Colours shown are indicative and may vary slightly from actual car colours.', 'YToyOntpOjA7czo0MToiMjAxOS8zN2ExOTk4OGNhYzQ4NzI0ODI2NzIyNjU3MzEwNTU5Mi5qcGciO2k6MTtzOjQxOiIyMDE5LzhjMWFmYmJjOTg4MzcwZGFlMzE4YTNmNDI1ZjRhMzkwLmpwZyI7fQ==', '0', '2019-04-21 15:41:39'),
(4, 'i10', 2, 2010, 'red', 7777777777, 'The Hyundai Motor Company, commonly known as Hyundai Motors, is a South Korean multinational automotive manufacturer headquartered in Seoul.', 'YToyOntpOjA7czo0MToiMjAxOS9kYmRlZTQ4MTFlMmI4Y2Y4YzYyZjU0MjEwNWJmOWQyMS5qcGciO2k6MTtzOjQxOiIyMDE5L2E3ZjFiMWYxZjc1ZjQwNzM2NGE3NTZlNmY1YjMyZmZmLnBuZyI7fQ==', '0', '2019-04-21 15:44:16'),
(5, 'Harrier', 1, 2018, 'white', 6666666666, 'That\'s a Tata?\' - our team exclaimed when we first saw the Concept H5X at the 2018 Auto Expo. That feeling lingers on as we soak in what the Harrier', 'YToyOntpOjA7czo0MToiMjAxOS81YmU4N2VjMGViZmZiMTNlMzE1YzljYjAwZDFkYzcwZC5qcGciO2k6MTtzOjQxOiIyMDE5L2JjMTk3M2RlZTU2OGMyNWYyYzYxZTJjMGYxNWI2M2M0LmpwZyI7fQ==', '0', '2019-04-21 15:45:45'),
(6, 'BMW old', 4, 1999, 'red', 122343214, 'testing', 'YToxOntpOjA7czo0MToiMjAxOS8yNDM1ODU2MTEyODNkN2Q4YjcxMmUwYjQ5MzgyNmFiNi5qcGciO30=', '1', '2019-04-21 16:09:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`model_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
