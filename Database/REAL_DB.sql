-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2020 at 06:49 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u869144629_test2`
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
(3, 'mosab Al mograbi', 'mosaabmograbe98@gmail.com', '0000', '0785520063'),
(4, 'Ali Smmour', 'ali.h.smmour@gmail.com', '0000', '0782767196'),
(5, 'mosab Al Jimzawi', 'mosab.jimzawi@gmail.com', '0000', '0787929442');

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
(11, 'Photoshop ', 'To Learn Basic Photoshop', '2020', '2020-07-01', '13:00:00', '-------', '1', 3, 25),
(12, 'First Aid ', 'To Learn How To be First Aid-err', '2020', '2020-07-01', '12:00:00', '-------', '1', 3, 29),
(13, 'communication skill', 'How to be good communicated person', '2020', '2020-09-16', '15:30:00', '-------', '1', 3, 11),
(14, ' drawing via compute', 'How To drew using computer application', '2020', '2020-07-16', '10:00:00', '--------', '2', 3, 17),
(18, 'Arabic Calligraphy', 'Arabic calligraphy basic technique', '2020', '2020-07-09', '11:00:00', '-----', '1', 3, 0),
(19, 'elearing system', 'How to use elearing sys', '2020', '2020-10-15', '12:00:00', '----------', '1', 3, 18),
(20, 'public Speking', 'How To Become a good Speaker', '2020', '2020-08-10', '13:00:00', '--------', '1', 3, 27),
(21, 'Planning and Organiz', 'How to Become a good Manager', '2020', '2020-08-17', '14:00:00', '------', '1', 3, 13),
(24, 'ICDL', 'To Learn Basic Computer Skills', '2019', '2019-11-14', '15:00:00', '----', '2', 3, 14),
(25, 'Body Language', 'How to interact  with body language', '2020', '2020-07-22', '11:00:00', '--------', '2', 3, 14),
(26, 'Scientific Research', 'To Learn Scientific research methods', '2020', '2020-08-01', '13:00:00', '------', '1', 3, 61),
(27, 'test', 'cccc', '2020', '2020-07-01', '09:00:00', 'vvvv', '1', 3, 14);

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
(101, 1, 50, 7),
(102, 1, 50, 7),
(201, 2, 70, 4),
(202, 2, 60, 4),
(211, 2, 30, 1),
(309, 3, 40, 3),
(310, 3, 40, 3),
(311, 3, 50, 1),
(401, 4, 100, 6),
(402, 4, 100, 6),
(427, 4, 40, 2),
(441, 4, 40, 2),
(444, 4, 5, 1);

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

--
-- Dumping data for table `message_table`
--

INSERT INTO `message_table` (`msg_id`, `msg_text`, `msg_link`, `admin_id`) VALUES
(37, 'New course about Body Language', 'RegisterCourses.php?c_name=\"Body Language\"', 3),
(39, 'New course about test', 'RegisterCourses.php?c_name=\"test\"', 3);

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
(0, 'Undefined', '-', '-', '-', '-', '-', 0),
(10, 'Eyad al aZzam', 'eyadh@yu.edu.jo', '123456789', 'Irbid', 'M', '0788888800', 1),
(11, 'Ahmad Saifan', 'ahmads@yu.edu.jo', '123456789', 'Irbid', 'M', '0788888800', 1),
(12, 'Emad ealsukhni', 'ealsukhni@yu.edu.jo', '123456789', 'Irbid', 'M', '0788888801', 1),
(13, 'anas alsobeh', 'anas.alsobeh@yu.edu.jo', '123456789', 'Amman', 'M', '0788888802', 1),
(14, 'Aws Magableh', 'aws.magableh@yu.edu.jo', '123456789', 'Amman', 'M', '0788888803', 1),
(15, 'Mohammad Ottom', 'ottom.ma@yu.edu.jo', '123456789', 'Irbid', 'M', '0788888805', 1),
(17, 'Rami malkawi', 'rmalkawi@yu.edu.jo', '123456789', 'Irbid', 'M', '0788888050', 1),
(18, 'rafat hammad', 'rafat.hammad@yu.edu.jo', '123456789', 'Amman', 'M', '0788770339', 1),
(19, 'Abrar', 'abrar.a@yu.edu.jo', '123456789', 'Irbid', 'F', '0789650339', 1),
(20, 'Shefa', 'shefa.bm@yu.edu.jo', '123456789', 'Irbid', 'F', '0788087210', 2),
(21, 'Ali fora', 'Fora@yu.edu.jo', '123456789', 'Al-Karak', 'M', '0786123456', 2),
(22, 'Huseinraba', 'huseinraba@yu.edu.jo', '123456789', 'Jerash', 'M', '0788055539', 3),
(23, 'Majed azzam', 'majedaz@yu.edujo', '123456789', 'Irbid', 'M', '0788952789', 3),
(24, 'Abd Alah Obidat', 'abdalah.o@yu.edu.jo', '123456789', 'Madaba', 'M', '0774586858', 5),
(25, 'Abdel Rhman', 'AbdelRahman@yu.edu.jo', '123456789', 'Az-Zarqa', 'M', '0797845624', 5),
(26, 'Ghazi.Rawaga', 'Ghazi.Rawagah@yu.edu.jo', '123456789', 'Al-Mafrak', 'M', '0788050355', 7),
(27, 'Amal.Khasawne', 'Amal.Khasawneh@yu.edu.jo', '123456789', 'Irbid', 'F', '0778945623', 7),
(28, 'Samir balas', 'samir.balas@yu.edu.jo', '123456789', 'Irbid', 'M', '0789875642', 6),
(29, 'Doaa ghorab', 'doaa.ghorab@yu.edu.jo', '123456789', 'Amman', 'F', '0788754235', 6),
(30, 'Wajeeh F. Qassem', 'qwajeeh@yu.edu.jo', '123456789', 'Irbid', 'M', '0788784000', 4),
(31, 'Ayman Jardat', 'ayman.j@yu.edu.jo', '123456789', 'Aqaba', 'M', '0788745200', 4),
(61, ' Ahmed Aleroud', 'Ahmed.aleroud@yu.edu.jo', '123456789', 'Irbid', 'M', '0788888800', 2),
(65, 'testyulms', 'testyulms@gmail.com', '123456', 'Az-Zarqa', 'M', '0788050589', 2);

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
(10, 21),
(10, 25),
(10, 26),
(11, 12),
(11, 25),
(12, 18),
(13, 26),
(14, 13),
(14, 14),
(15, 20),
(15, 26),
(17, 11),
(17, 12),
(17, 26),
(18, 11),
(18, 12),
(18, 20),
(19, 18),
(19, 20),
(19, 26),
(20, 19),
(20, 24),
(21, 13),
(22, 20),
(23, 21),
(24, 24),
(25, 13),
(26, 19),
(26, 24),
(27, 11),
(29, 24),
(30, 19),
(30, 24),
(31, 14),
(61, 11),
(61, 19);

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
(11, 310),
(12, 401),
(13, 201),
(14, 211),
(18, 101),
(19, 309),
(20, 102),
(21, 211),
(24, 311),
(25, 311),
(26, 444),
(27, 311);

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
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_table`
--
ALTER TABLE `course_table`
  MODIFY `course_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `message_table`
--
ALTER TABLE `message_table`
  MODIFY `msg_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `staff_table`
--
ALTER TABLE `staff_table`
  MODIFY `staff_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

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
