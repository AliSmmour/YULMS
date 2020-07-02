-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2020 at 06:24 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yulms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(5) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `admin_phone_num` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_phone_num`) VALUES
(1, 'Adm1', 'admin1@gmail.com', '0000', '0789211315'),
(2, 'Adm2', 'admin2@gmail.com', '0000', '0782767196');

-- --------------------------------------------------------

--
-- Table structure for table `course_table`
--

CREATE TABLE `course_table` (
  `course_id` int(10) NOT NULL,
  `course_name` varchar(20) NOT NULL,
  `course_description` varchar(3000) NOT NULL,
  `semester` varchar(15) NOT NULL,
  `course_date` date NOT NULL,
  `course_time` time NOT NULL,
  `material_link` varchar(3000) NOT NULL,
  `course_status` char(1) NOT NULL,
  `admin_id` int(5) NOT NULL,
  `staff_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_table`
--

INSERT INTO `course_table` (`course_id`, `course_name`, `course_description`, `semester`, `course_date`, `course_time`, `material_link`, `course_status`, `admin_id`, `staff_id`) VALUES
(1, 'PHP', '  Learn PHP   ', '2020', '2020-03-31', '10:00:00', '    ', '1', 1, 1),
(2, 'HTML and CSS', '        to create a simple web site        ', '2020FIRST', '2020-03-31', '00:00:00', '                ', '2', 1, 2),
(3, 'DW', '        learn Basic Data warehousing techniques         ', '2020', '2020-04-01', '08:00:00', '                ', '3', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_table`
--

CREATE TABLE `faculty_table` (
  `f_id` int(10) NOT NULL,
  `bld_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_table`
--

INSERT INTO `faculty_table` (`f_id`, `bld_name`) VALUES
(0, ''),
(5, 'Arts'),
(3, 'Economie'),
(7, 'Education'),
(4, 'Engineering'),
(1, 'IT'),
(6, 'Medicine'),
(2, 'Sciences');

-- --------------------------------------------------------

--
-- Table structure for table `location_table`
--

CREATE TABLE `location_table` (
  `room_id` int(3) NOT NULL,
  `floor` int(2) NOT NULL,
  `capacity` int(3) NOT NULL,
  `f_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location_table`
--

INSERT INTO `location_table` (`room_id`, `floor`, `capacity`, `f_id`) VALUES
(1, 1, 100, 2),
(311, 3, 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `message_table`
--

CREATE TABLE `message_table` (
  `msg_id` int(50) NOT NULL,
  `msg_text` varchar(3000) NOT NULL,
  `msg_link` varchar(3000) NOT NULL,
  `admin_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staff_table`
--

CREATE TABLE `staff_table` (
  `staff_id` int(10) NOT NULL,
  `staff_name` varchar(50) NOT NULL,
  `staff_email` varchar(50) NOT NULL,
  `staff_password` varchar(50) NOT NULL,
  `staff_address` varchar(10) NOT NULL,
  `staff_gender` char(1) NOT NULL,
  `staff_phone_num` varchar(10) NOT NULL,
  `f_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_table`
--

INSERT INTO `staff_table` (`staff_id`, `staff_name`, `staff_email`, `staff_password`, `staff_address`, `staff_gender`, `staff_phone_num`, `f_id`) VALUES
(1, 'Ali Smmour', 'alismmour@gmail.com', '12345678', 'Irbid', 'M', '0782767196', 1),
(2, 'Mosab Mograbi', 'mosabm@gmail.com', '12345678', 'Irbid', 'M', '078123478', 1),
(3, 'Mosab Jmzawi', 'mosabjmc@gmail.com', '12345678', 'Irbid', 'M', '0781452369', 1);

-- --------------------------------------------------------

--
-- Table structure for table `take_relation`
--

CREATE TABLE `take_relation` (
  `staff_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `take_relation`
--

INSERT INTO `take_relation` (`staff_id`, `course_id`) VALUES
(1, 2),
(2, 3),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teach_in_relation`
--

CREATE TABLE `teach_in_relation` (
  `course_id` int(10) NOT NULL,
  `room_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teach_in_relation`
--

INSERT INTO `teach_in_relation` (`course_id`, `room_id`) VALUES
(1, 311),
(2, 1),
(3, 311);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`),
  ADD KEY `admin_name` (`admin_name`,`admin_email`);

--
-- Indexes for table `course_table`
--
ALTER TABLE `course_table`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `course_name` (`course_name`);

--
-- Indexes for table `faculty_table`
--
ALTER TABLE `faculty_table`
  ADD PRIMARY KEY (`f_id`),
  ADD UNIQUE KEY `bld_name` (`bld_name`);

--
-- Indexes for table `location_table`
--
ALTER TABLE `location_table`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `f_id` (`f_id`);

--
-- Indexes for table `message_table`
--
ALTER TABLE `message_table`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `staff_table`
--
ALTER TABLE `staff_table`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `staff_email` (`staff_email`),
  ADD KEY `f_id` (`f_id`),
  ADD KEY `staff_name` (`staff_name`,`staff_email`);

--
-- Indexes for table `take_relation`
--
ALTER TABLE `take_relation`
  ADD PRIMARY KEY (`staff_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `teach_in_relation`
--
ALTER TABLE `teach_in_relation`
  ADD PRIMARY KEY (`course_id`,`room_id`),
  ADD KEY `room_id` (`room_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_table`
--
ALTER TABLE `course_table`
  MODIFY `course_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `message_table`
--
ALTER TABLE `message_table`
  MODIFY `msg_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_table`
--
ALTER TABLE `staff_table`
  MODIFY `staff_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_table`
--
ALTER TABLE `course_table`
  ADD CONSTRAINT `course_table_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin_table` (`admin_id`),
  ADD CONSTRAINT `course_table_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`);

--
-- Constraints for table `location_table`
--
ALTER TABLE `location_table`
  ADD CONSTRAINT `location_table_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `faculty_table` (`f_id`);

--
-- Constraints for table `message_table`
--
ALTER TABLE `message_table`
  ADD CONSTRAINT `message_table_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin_table` (`admin_id`);

--
-- Constraints for table `staff_table`
--
ALTER TABLE `staff_table`
  ADD CONSTRAINT `staff_table_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `faculty_table` (`f_id`);

--
-- Constraints for table `take_relation`
--
ALTER TABLE `take_relation`
  ADD CONSTRAINT `take_relation_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`),
  ADD CONSTRAINT `take_relation_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course_table` (`course_id`);

--
-- Constraints for table `teach_in_relation`
--
ALTER TABLE `teach_in_relation`
  ADD CONSTRAINT `teach_in_relation_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course_table` (`course_id`),
  ADD CONSTRAINT `teach_in_relation_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `location_table` (`room_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
