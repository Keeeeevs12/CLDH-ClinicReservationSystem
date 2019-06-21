-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2019 at 04:45 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cldhappointment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_accnt`
--

CREATE TABLE `admin_accnt` (
  `admin_id` int(3) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `contact_num` int(14) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_accnt`
--

INSERT INTO `admin_accnt` (`admin_id`, `full_name`, `contact_num`, `password`) VALUES
(1, 'Administrator', 1234567890, '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `app_id` int(7) NOT NULL,
  `patients_id` int(7) NOT NULL,
  `sec_id` int(7) NOT NULL,
  `sched_id` int(7) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`app_id`, `patients_id`, `sec_id`, `sched_id`, `status`) VALUES
(22, 17, 51, 598, 0),
(23, 17, 51, 598, 0);

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `clinic_id` int(3) NOT NULL,
  `clinic_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`clinic_id`, `clinic_name`) VALUES
(1, 'Pediatrics'),
(2, 'Obstetrics and Gynecology'),
(3, 'Infertility & Gynecologic Endoscopy'),
(4, 'Ophthalmology'),
(5, 'Ophthalmology - Vitreo Retina Specialist'),
(6, 'Ear, Nose, Throat, Head and Neck Surgery'),
(7, 'Family Medicine'),
(8, 'Geriatic Medicine'),
(9, 'Surgery'),
(10, 'Neurosurgery '),
(11, 'Orthopedic Surgery'),
(12, 'Urology'),
(13, 'Plastic, Reconstructive and Cromer Surgery'),
(14, 'Medical Acupuncture / Pain Clinic'),
(15, 'Internal Medicine'),
(16, 'Cardiology'),
(17, 'Pulmonary Medicine'),
(18, 'Medical Oncology'),
(19, 'Rheumatology'),
(20, 'Nephrology \r\n'),
(21, 'Gastroenterology'),
(22, 'Endocrinology'),
(23, 'Neurology and Psychiatry'),
(24, 'Medical / Dental');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `sched_id` int(3) NOT NULL,
  `sec_id` int(3) NOT NULL,
  `day` varchar(12) NOT NULL,
  `start_time` varchar(250) NOT NULL,
  `end_time` varchar(250) NOT NULL,
  `room` varchar(12) NOT NULL,
  `status` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`sched_id`, `sec_id`, `day`, `start_time`, `end_time`, `room`, `status`) VALUES
(598, 51, 'Monday', '4:45 pm', '4:30 pm', '322', 0),
(600, 53, 'Wednesday', '4:30 pm', '4:45 pm', '222', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sec_accnts`
--

CREATE TABLE `sec_accnts` (
  `sec_id` int(3) NOT NULL,
  `clinic_id` int(3) NOT NULL,
  `sec_name` varchar(250) NOT NULL,
  `doc_name` varchar(250) NOT NULL,
  `contact_num` varchar(24) NOT NULL,
  `email_add` varchar(250) NOT NULL,
  `password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sec_accnts`
--

INSERT INTO `sec_accnts` (`sec_id`, `clinic_id`, `sec_name`, `doc_name`, `contact_num`, `email_add`, `password`) VALUES
(51, 3, 'Test1', 'Test', '01', 'test@email.com', '5ebe2294ecd0e0f08eab7690d2a6ee69'),
(53, 1, 'Test', 'Test', '0101', 'example@email.com', '5ebe2294ecd0e0f08eab7690d2a6ee69');

-- --------------------------------------------------------

--
-- Table structure for table `transacs`
--

CREATE TABLE `transacs` (
  `transac_id` int(7) NOT NULL,
  `transac_datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `transac_mes` varchar(244) NOT NULL,
  `transac_user` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transacs`
--

INSERT INTO `transacs` (`transac_id`, `transac_datetime`, `transac_mes`, `transac_user`) VALUES
(128, '2019-06-19 13:32:49', 'TEst2 has edited his/her informations.', 'TEst2'),
(129, '2019-06-19 13:33:26', 'Test1 has edited his/her informations.', 'Test1'),
(130, '2019-06-19 13:34:26', 'Test has edited his/her informations.', 'Test'),
(131, '2019-06-19 13:34:44', 'Test1 has edited his/her informations.', 'Test1'),
(132, '2019-06-19 13:36:05', 'Test1 has edited his/her informations.', 'Test1'),
(133, '2019-06-19 14:12:56', 'Kevin Jansen Guzman made an appointment with Dr. Test.', 'Kevin Jansen Guzman'),
(134, '2019-06-19 14:14:51', 'Kevin Jansen Guzman made an appointment with Dr. Test.', 'Kevin Jansen Guzman'),
(135, '2019-06-19 14:18:09', 'Kevin Jansen Guzman has edited his/her informations.', 'Kevin Jansen Guzman'),
(136, '2019-06-19 14:19:55', 'Kevin Jansen has edited his/her informations.', 'Kevin Jansen'),
(137, '2019-06-19 14:23:04', 'Admin has added Dr. Test with his/her secretary Test.', 'Administrator'),
(138, '2019-06-19 14:23:51', 'Test has added schedule to clinic Pediatrics.', 'Test'),
(139, '2019-06-19 14:24:21', 'Kevin Jansen made an appointment with Dr. Test.', 'Kevin Jansen'),
(140, '2019-06-19 14:24:42', 'Test has confirmed Kevin Jansen appointment.', 'Test'),
(141, '2019-06-19 14:24:50', 'Test has ended Kevin Jansen appointment.', 'Test'),
(142, '2019-06-20 12:24:42', 'Kei has registered as a Patient.', 'Kei'),
(143, '2019-06-20 12:40:56', 'Kei has registered as a Patient.', 'Kei');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `patients_id` int(3) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `bday` varchar(250) NOT NULL,
  `email_add` varchar(250) DEFAULT NULL,
  `contact_num` text NOT NULL,
  `user_type` varchar(250) NOT NULL,
  `password` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`patients_id`, `full_name`, `address`, `bday`, `email_add`, `contact_num`, `user_type`, `password`, `status`) VALUES
(16, 'Erandy Magdaleno', 'Concepcion, Tarlac', '06/16/2019', 'example@email.com', '09888888888', 'Patient', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1),
(17, 'Kevin Jansen', 'Concepcion, Tarlac', '06/16/2019', 'keeeeevs12@gmail.com', '09071323373', 'Patient', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1),
(19, 'Kei', 'Kyoto, Japan', '06/03/2019', 'example@email.com.jp', '00000000000', 'Patient', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1);

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `patients_id` int(3) NOT NULL,
  `ver_code` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`patients_id`, `ver_code`) VALUES
(17, 'asd'),
(19, 'c74FnE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accnt`
--
ALTER TABLE `admin_accnt`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`clinic_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`sched_id`);

--
-- Indexes for table `sec_accnts`
--
ALTER TABLE `sec_accnts`
  ADD PRIMARY KEY (`sec_id`);

--
-- Indexes for table `transacs`
--
ALTER TABLE `transacs`
  ADD PRIMARY KEY (`transac_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`patients_id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`patients_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_accnt`
--
ALTER TABLE `admin_accnt`
  MODIFY `admin_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `app_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `clinic_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `sched_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=601;

--
-- AUTO_INCREMENT for table `sec_accnts`
--
ALTER TABLE `sec_accnts`
  MODIFY `sec_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `transacs`
--
ALTER TABLE `transacs`
  MODIFY `transac_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `patients_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `verification`
--
ALTER TABLE `verification`
  MODIFY `patients_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
