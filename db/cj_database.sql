-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 31, 2021 at 03:07 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cj_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblappointment`
--

CREATE TABLE `tblappointment` (
  `appt_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `designation_id` varchar(11) NOT NULL,
  `start_appt` date NOT NULL,
  `end_appt` date NOT NULL,
  `chapter_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblchapter`
--

CREATE TABLE `tblchapter` (
  `chapter_id` int(11) NOT NULL,
  `chapter` varchar(100) NOT NULL,
  `chapter_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblchapter`
--

INSERT INTO `tblchapter` (`chapter_id`, `chapter`, `chapter_address`) VALUES
(1, 'Minanga Sur', 'Minanga Sur, Iguig, Cagayan'),
(2, 'Caggay', 'Dunkin Drive, Caggay, Tuguegarao City, Cagayan'),
(3, 'Fermeldy', 'Fermeldy, Isabela'),
(5, 'Catugay', 'Catugay, Baggao');

-- --------------------------------------------------------

--
-- Table structure for table `tbldesignation`
--

CREATE TABLE `tbldesignation` (
  `designation_id` int(11) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `shorthand` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbldesignation`
--

INSERT INTO `tbldesignation` (`designation_id`, `designation`, `shorthand`) VALUES
(3, 'Pastor', 'Ptr.'),
(4, 'Reverend', 'Rev.'),
(5, 'Deaconess', 'Dcns.'),
(6, 'Deacon', 'Dcn.');

-- --------------------------------------------------------

--
-- Table structure for table `tblelection`
--

CREATE TABLE `tblelection` (
  `elec_id` int(11) NOT NULL,
  `elec_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblmember`
--

CREATE TABLE `tblmember` (
  `member_id` int(11) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(50) NOT NULL,
  `m_address` varchar(300) NOT NULL,
  `citizenship` varchar(20) NOT NULL,
  `civil_stat` varchar(20) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `educ_attn` varchar(50) NOT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `baptizer` varchar(100) DEFAULT NULL,
  `date_baptized` date DEFAULT NULL,
  `place_baptized` varchar(100) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `mintitle_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `min_id` int(11) DEFAULT NULL,
  `photo` varchar(300) DEFAULT NULL,
  `esignature` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblmember`
--

INSERT INTO `tblmember` (`member_id`, `last_name`, `first_name`, `middle_name`, `birthdate`, `birthplace`, `m_address`, `citizenship`, `civil_stat`, `mother_name`, `father_name`, `educ_attn`, `occupation`, `baptizer`, `date_baptized`, `place_baptized`, `chapter_id`, `mintitle_id`, `designation_id`, `min_id`, `photo`, `esignature`) VALUES
(38, 'Doe', 'John', 'Diaz', '1989-01-01', 'USA', 'Iguig', 'Filipino', 'Single', 'Joana Doe', 'Johny Doe', 'College Graduate', 'None', 'Rev', '2013-01-31', 'Carig', 2, 4, 6, 8, '1612065534-Screen-Shot-2016-04-12-at-10.03.12-AM-e1460482220483-630x384.png', '1612065534-Screen-Shot-2016-04-12-at-10.03.12-AM-e1460482220483-630x384.png'),
(39, 'Diaz', 'Camilla', 'S', '1999-06-16', 'Iguig', 'Iguig', 'Filipino', 'Single', 'Joana Doe', 'Johny Doe', 'High School Graduate', 'None', 'Rev', '2021-01-27', 'Carig', 1, 5, 5, 9, '1612070967-img_avatar2.png', '1612070967-img_avatar2.png'),
(40, 'Depp', 'Johnny', 'Dee', '2021-01-20', 'Manila', 'Iguig', 'Filipino', 'Single', 'Cindy', 'Chanon', 'College Graduate', 'None', 'Rev', '2021-01-05', 'Carig', 2, 5, 6, 9, '1612074169-img_avatar.png', '1612074169-img_avatar.png'),
(41, 'Ramirez', 'Kenneth', 'Manuel', '1999-08-03', 'Ugac', 'Ajat, Iguig, Cagayan', 'Filipino', 'Married', 'Sonia Ramirez', 'Alex Ramirez', 'College Graduate', 'IT Manager', 'Rev. Reynaldo Cabangon', '1999-06-17', 'Tuguegarao', 2, 2, 3, 1, '1612079537-img_avatar2.png', '1612079537-img_avatar.png'),
(42, 'Ramirez', 'Kenneth', 'Manuel', '1999-08-03', 'Ugac', 'Ajat, Iguig, Cagayan', 'Filipino', 'Married', 'Sonia Ramirez', 'Alex Ramirez', 'College Graduate', 'IT Manager', 'Rev. Reynaldo Cabangon', '1999-06-17', 'Tuguegarao', 2, 2, 3, 1, '1612082647-img_avatar2.png', '1612082647-img_avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblmemberstat`
--

CREATE TABLE `tblmemberstat` (
  `memberstat_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `year` date NOT NULL,
  `chapter_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblministry`
--

CREATE TABLE `tblministry` (
  `min_id` int(11) NOT NULL,
  `ministry` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblministry`
--

INSERT INTO `tblministry` (`min_id`, `ministry`) VALUES
(1, 'Music'),
(5, 'Research and Study'),
(6, 'Arts and Design'),
(8, 'Teen-Age'),
(9, 'Evangelism');

-- --------------------------------------------------------

--
-- Table structure for table `tblministry_title`
--

CREATE TABLE `tblministry_title` (
  `mintitle_id` int(11) NOT NULL,
  `mintitle_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblministry_title`
--

INSERT INTO `tblministry_title` (`mintitle_id`, `mintitle_name`) VALUES
(1, 'National Head'),
(2, 'Regional Head'),
(4, 'Ministry Head'),
(5, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `tblvotes`
--

CREATE TABLE `tblvotes` (
  `vote_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `elec_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblappointment`
--
ALTER TABLE `tblappointment`
  ADD PRIMARY KEY (`appt_id`);

--
-- Indexes for table `tblchapter`
--
ALTER TABLE `tblchapter`
  ADD PRIMARY KEY (`chapter_id`);

--
-- Indexes for table `tbldesignation`
--
ALTER TABLE `tbldesignation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `tblelection`
--
ALTER TABLE `tblelection`
  ADD PRIMARY KEY (`elec_id`);

--
-- Indexes for table `tblmember`
--
ALTER TABLE `tblmember`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `tblmemberstat`
--
ALTER TABLE `tblmemberstat`
  ADD PRIMARY KEY (`memberstat_id`);

--
-- Indexes for table `tblministry`
--
ALTER TABLE `tblministry`
  ADD PRIMARY KEY (`min_id`);

--
-- Indexes for table `tblministry_title`
--
ALTER TABLE `tblministry_title`
  ADD PRIMARY KEY (`mintitle_id`);

--
-- Indexes for table `tblvotes`
--
ALTER TABLE `tblvotes`
  ADD PRIMARY KEY (`vote_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblappointment`
--
ALTER TABLE `tblappointment`
  MODIFY `appt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblchapter`
--
ALTER TABLE `tblchapter`
  MODIFY `chapter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbldesignation`
--
ALTER TABLE `tbldesignation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblmember`
--
ALTER TABLE `tblmember`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tblmemberstat`
--
ALTER TABLE `tblmemberstat`
  MODIFY `memberstat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblministry`
--
ALTER TABLE `tblministry`
  MODIFY `min_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblministry_title`
--
ALTER TABLE `tblministry_title`
  MODIFY `mintitle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
