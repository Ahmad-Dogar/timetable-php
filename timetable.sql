-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2022 at 06:31 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timetable`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `backup_table`
--

CREATE TABLE `backup_table` (
  `id` int(100) NOT NULL,
  `professor_name` varchar(100) NOT NULL,
  `course_assigned` varchar(100) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_from` varchar(100) NOT NULL,
  `room_to` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL,
  `session_from` int(100) NOT NULL,
  `session_to` int(100) NOT NULL,
  `program` varchar(100) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `section` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_semester` varchar(100) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_code` varchar(100) NOT NULL,
  `credithour` int(11) NOT NULL,
  `course_type` varchar(100) NOT NULL,
  `program_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_semester`, `course_name`, `course_code`, `credithour`, `course_type`, `program_id`) VALUES
(24, '1st', 'C1', 'CS01', 3, 'theory', 69),
(25, '1st', 'C2', 'CS02', 3, 'theory', 69),
(26, '1st', 'C3', 'CS03', 2, 'theory', 69),
(27, '1st', 'C3 (lab)', 'CS03', 3, 'lab', 69);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `Name`) VALUES
(1, 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE `master` (
  `id` int(100) NOT NULL,
  `professor` varchar(100) NOT NULL,
  `course_assigned` varchar(100) NOT NULL,
  `session_from` varchar(100) NOT NULL,
  `session_to` varchar(100) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `program` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `section` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master`
--

INSERT INTO `master` (`id`, `professor`, `course_assigned`, `session_from`, `session_to`, `semester`, `program`, `department`, `section`) VALUES
(36, 'P1', 'C1', '2018', '2022', '1st', 'BS-CS', 'Computer Science', 'A'),
(37, 'P2', 'C2', '2018', '2022', '1st', 'BS-CS', 'Computer Science', 'A'),
(38, 'P1', 'C3 (lab)', '2018', '2022', '1st', 'BS-CS', 'Computer Science', 'A'),
(39, 'P1', 'C1', '2018', '2022', '1st', 'BS-CS', 'Computer Science', 'A'),
(40, 'P2', 'C2', '2018', '2022', '1st', 'BS-CS', 'Computer Science', 'A'),
(41, 'P3', 'C3', '2018', '2022', '1st', 'BS-CS', 'Computer Science', 'A'),
(42, 'P1', 'C3 (lab)', '2018', '2022', '1st', 'BS-CS', 'Computer Science', 'A'),
(43, 'P1', 'C1', '2018', '2022', '1st', 'BS-CS', 'Computer Science', 'A'),
(44, 'P2', 'C2', '2018', '2022', '1st', 'BS-CS', 'Computer Science', 'A'),
(45, 'P3', 'C3', '2018', '2022', '1st', 'BS-CS', 'Computer Science', 'A'),
(46, 'P1', 'C3 (lab)', '2018', '2022', '1st', 'BS-CS', 'Computer Science', 'A'),
(47, 'P1', 'C1', '2018', '2022', '1st', 'BS-CS', 'Computer Science', 'A'),
(48, 'P2', 'C2', '2018', '2022', '1st', 'BS-CS', 'Computer Science', 'A'),
(49, 'P3', 'C3', '2018', '2022', '1st', 'BS-CS', 'Computer Science', 'A'),
(50, 'P1', 'C3 (lab)', '2018', '2022', '1st', 'BS-CS', 'Computer Science', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `teachers` int(1) NOT NULL,
  `students` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `time_from` varchar(100) NOT NULL,
  `time_to` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL,
  `program_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`id`, `name`, `time_from`, `time_to`, `day`, `program_id`) VALUES
(32, 'P1', '8:00AM', '10:00AM', 'Monday', 0),
(33, 'P1', '10:00AM', '16:00PM', 'friday', 0),
(34, 'P2', '10:00AM', '11:00AM', 'Tuesday', 0),
(35, 'P2', '8:00AM', '16:00PM', 'Wednesday', 0),
(36, 'P3', '9:00AM', '16:00PM', 'Thursday', 0);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `section` varchar(100) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `name`, `section`, `department_id`) VALUES
(66, 'MS-CS', 'A', 1),
(69, 'BS-CS', 'B', 1),
(70, 'BS-CS', 'C', 1),
(72, 'M.Phill-CS', 'B', 1),
(73, 'BS-CS', 'A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `remaining_professors`
--

CREATE TABLE `remaining_professors` (
  `id` int(90) NOT NULL,
  `name` varchar(90) NOT NULL,
  `time_from` varchar(90) NOT NULL,
  `time_to` varchar(90) NOT NULL,
  `day` varchar(90) NOT NULL,
  `program_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `remaining_professors`
--

INSERT INTO `remaining_professors` (`id`, `name`, `time_from`, `time_to`, `day`, `program_id`) VALUES
(37, 'P1', '8:00', '9:00', 'Monday', 0),
(38, 'P1', '9:00', '10:00', 'Monday', 0),
(39, 'P1', '10:00', '11:00', 'friday', 0),
(40, 'P1', '11:00', '12:00', 'friday', 0),
(41, 'P1', '12:00', '13:00', 'friday', 0),
(42, 'P1', '13:00', '14:00', 'friday', 0),
(43, 'P1', '14:00', '15:00', 'friday', 0),
(44, 'P1', '15:00', '16:00', 'friday', 0),
(45, 'P2', '10:00', '11:00', 'Tuesday', 0),
(46, 'P2', '8:00', '9:00', 'Wednesday', 0),
(47, 'P2', '9:00', '10:00', 'Wednesday', 0),
(48, 'P2', '10:00', '11:00', 'Wednesday', 0),
(49, 'P2', '11:00', '12:00', 'Wednesday', 0),
(50, 'P2', '12:00', '13:00', 'Wednesday', 0),
(51, 'P2', '13:00', '14:00', 'Wednesday', 0),
(52, 'P2', '14:00', '15:00', 'Wednesday', 0),
(53, 'P2', '15:00', '16:00', 'Wednesday', 0),
(54, 'P3', '9:00', '10:00', 'Thursday', 0),
(55, 'P3', '10:00', '11:00', 'Thursday', 0),
(56, 'P3', '11:00', '12:00', 'Thursday', 0),
(57, 'P3', '12:00', '13:00', 'Thursday', 0),
(58, 'P3', '13:00', '14:00', 'Thursday', 0),
(59, 'P3', '14:00', '15:00', 'Thursday', 0),
(60, 'P3', '15:00', '16:00', 'Thursday', 0);

-- --------------------------------------------------------

--
-- Table structure for table `remaining_rooms`
--

CREATE TABLE `remaining_rooms` (
  `id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_from` varchar(100) NOT NULL,
  `room_to` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `remaining_rooms`
--

INSERT INTO `remaining_rooms` (`id`, `room_name`, `room_from`, `room_to`, `type`, `day`) VALUES
(209, 'R1', '9:00', '10:00', 'room', 'monday'),
(210, 'R1', '10:00', '11:00', 'room', 'monday'),
(211, 'R1', '11:00', '12:00', 'room', 'monday'),
(212, 'R2', '8:00', '9:00', 'room', 'tuesday'),
(213, 'R2', '9:00', '10:00', 'room', 'tuesday'),
(214, 'R2', '10:00', '11:00', 'room', 'tuesday'),
(215, 'R2', '11:00', '12:00', 'room', 'tuesday'),
(216, 'R2', '12:00', '13:00', 'room', 'tuesday'),
(217, 'R2', '13:00', '14:00', 'room', 'tuesday'),
(218, 'R3', '8:00', '9:00', 'room', 'monday'),
(219, 'R3', '9:00', '10:00', 'room', 'monday'),
(220, 'R3', '10:00', '11:00', 'room', 'monday'),
(221, 'R3', '11:00', '12:00', 'room', 'monday'),
(222, 'R3', '12:00', '13:00', 'room', 'monday'),
(223, 'R3', '13:00', '14:00', 'room', 'monday'),
(224, 'R3', '14:00', '15:00', 'room', 'monday'),
(225, 'R3', '15:00', '16:00', 'room', 'monday'),
(226, 'R3', '8:00', '9:00', 'room', 'tuesday'),
(227, 'R3', '9:00', '10:00', 'room', 'tuesday'),
(228, 'R3', '10:00', '11:00', 'room', 'tuesday'),
(229, 'R3', '11:00', '12:00', 'room', 'tuesday'),
(230, 'R3', '12:00', '13:00', 'room', 'tuesday'),
(231, 'R3', '13:00', '14:00', 'room', 'tuesday'),
(232, 'R3', '14:00', '15:00', 'room', 'tuesday'),
(233, 'R3', '15:00', '16:00', 'room', 'tuesday'),
(234, 'R3', '8:00', '9:00', 'room', 'wednesday'),
(235, 'R3', '9:00', '10:00', 'room', 'wednesday'),
(236, 'R3', '10:00', '11:00', 'room', 'wednesday'),
(237, 'R3', '11:00', '12:00', 'room', 'wednesday'),
(238, 'R3', '12:00', '13:00', 'room', 'wednesday'),
(239, 'R3', '13:00', '14:00', 'room', 'wednesday'),
(240, 'R3', '14:00', '15:00', 'room', 'wednesday'),
(241, 'R3', '15:00', '16:00', 'room', 'wednesday'),
(242, 'R3', '8:00', '9:00', 'room', 'thursday'),
(243, 'R3', '9:00', '10:00', 'room', 'thursday'),
(244, 'R3', '10:00', '11:00', 'room', 'thursday'),
(245, 'R3', '11:00', '12:00', 'room', 'thursday'),
(246, 'R3', '12:00', '13:00', 'room', 'thursday'),
(247, 'R3', '13:00', '14:00', 'room', 'thursday'),
(248, 'R3', '14:00', '15:00', 'room', 'thursday'),
(249, 'R3', '15:00', '16:00', 'room', 'thursday'),
(250, 'R3', '8:00', '9:00', 'room', 'friday'),
(251, 'R3', '9:00', '10:00', 'room', 'friday'),
(252, 'R3', '10:00', '11:00', 'room', 'friday'),
(253, 'R3', '11:00', '12:00', 'room', 'friday'),
(254, 'R3', '12:00', '13:00', 'room', 'friday'),
(255, 'R3', '13:00', '14:00', 'room', 'friday'),
(256, 'R3', '14:00', '15:00', 'room', 'friday'),
(257, 'R3', '15:00', '16:00', 'room', 'friday'),
(258, 'R1', '8:00', '9:00', 'room', 'thursday'),
(259, 'R1', '9:00', '10:00', 'room', 'thursday'),
(260, 'R1', '10:00', '11:00', 'room', 'thursday'),
(261, 'R1', '11:00', '12:00', 'room', 'thursday'),
(262, 'R1', '12:00', '13:00', 'room', 'thursday'),
(263, 'R1', '13:00', '14:00', 'room', 'thursday'),
(264, 'R1', '14:00', '15:00', 'room', 'thursday'),
(265, 'L1', '8:00', '9:00', 'lab', 'friday'),
(266, 'L1', '9:00', '10:00', 'lab', 'friday'),
(267, 'L1', '10:00', '11:00', 'lab', 'friday'),
(268, 'L1', '11:00', '12:00', 'lab', 'friday'),
(269, 'L1', '12:00', '13:00', 'lab', 'friday'),
(270, 'L1', '13:00', '14:00', 'lab', 'friday'),
(271, 'L1', '14:00', '15:00', 'lab', 'friday'),
(272, 'L1', '15:00', '16:00', 'lab', 'friday');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_name` text NOT NULL,
  `room_from` text NOT NULL,
  `room_to` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `day` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_name`, `room_from`, `room_to`, `type`, `day`) VALUES
(12, 'R1', '9:00AM', '12:00PM', 'room', 'monday'),
(13, 'R2', '8:00AM', '14:00PM', 'room', 'tuesday'),
(14, 'R3', '8:00AM', '16:00PM', 'room', ''),
(15, 'R1', '8:00AM', '15:00PM', 'room', 'thursday'),
(16, 'L1', '8:00AM', '16:00PM', 'lab', 'friday');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `Section_Name` int(11) NOT NULL,
  `Class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `Session_Year` int(11) NOT NULL,
  `Semester` int(11) NOT NULL,
  `Semester_Type (F/S)` int(11) NOT NULL,
  `Class_id` int(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `phone`, `course`) VALUES
(1, '11', '22', '33', '44'),
(3, 'ahmad', 'aaa', '12221', 'asmwq');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `Teachers_id` int(90) NOT NULL,
  `Subject` text NOT NULL,
  `Room_id` int(90) NOT NULL,
  `Session_id` int(90) NOT NULL,
  `Day` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `id` int(11) NOT NULL,
  `professor_name` varchar(128) NOT NULL,
  `course_assigned` varchar(128) NOT NULL,
  `room_name` varchar(128) NOT NULL,
  `room_from` varchar(128) NOT NULL,
  `room_to` varchar(128) NOT NULL,
  `day` varchar(100) NOT NULL,
  `session_from` int(128) NOT NULL,
  `session_to` int(128) NOT NULL,
  `program` varchar(128) NOT NULL,
  `semester` varchar(128) NOT NULL,
  `section` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`id`, `professor_name`, `course_assigned`, `room_name`, `room_from`, `room_to`, `day`, `session_from`, `session_to`, `program`, `semester`, `section`) VALUES
(29, 'P1', 'C1', 'R3', '8:00', '9:00', 'monday', 2018, 2022, 'BS-CS', '1st', 'A'),
(30, 'P1', 'C1', 'R1', '9:00', '10:00', 'monday', 2018, 2022, 'BS-CS', '1st', 'A'),
(31, 'P2', 'C2', 'R2', '10:00', '11:00', 'tuesday', 2018, 2022, 'BS-CS', '1st', 'A'),
(32, 'P2', 'C2', 'R3', '8:00', '9:00', 'wednesday', 2018, 2022, 'BS-CS', '1st', 'A'),
(33, 'P2', 'C2', 'R3', '9:00', '10:00', 'wednesday', 2018, 2022, 'BS-CS', '1st', 'A'),
(34, 'P3', 'C3', 'R3', '9:00', '10:00', 'thursday', 2018, 2022, 'BS-CS', '1st', 'A'),
(35, 'P3', 'C3', 'R3', '10:00', '11:00', 'thursday', 2018, 2022, 'BS-CS', '1st', 'A'),
(36, 'P1', 'C1', 'R3', '10:00', '11:00', 'friday', 2018, 2022, 'BS-CS', '1st', 'A'),
(37, 'P1', 'C3 (lab)', 'L1', '11:00', '12:00', 'friday', 2018, 2022, 'BS-CS', '1st', 'A'),
(38, 'P1', 'C3 (lab)', 'L1', '12:00', '13:00', 'friday', 2018, 2022, 'BS-CS', '1st', 'A'),
(39, 'P1', 'C3 (lab)', 'L1', '13:00', '14:00', 'friday', 2018, 2022, 'BS-CS', '1st', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backup_table`
--
ALTER TABLE `backup_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept id` (`department_id`);

--
-- Indexes for table `remaining_professors`
--
ALTER TABLE `remaining_professors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remaining_rooms`
--
ALTER TABLE `remaining_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class id` (`Class_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`Class_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id2` (`Room_id`),
  ADD KEY `session_id2` (`Session_id`),
  ADD KEY `teacher_id` (`Teachers_id`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `backup_table`
--
ALTER TABLE `backup_table`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `master`
--
ALTER TABLE `master`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `professors`
--
ALTER TABLE `professors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `remaining_professors`
--
ALTER TABLE `remaining_professors`
  MODIFY `id` int(90) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `remaining_rooms`
--
ALTER TABLE `remaining_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `class id` FOREIGN KEY (`Class_id`) REFERENCES `program` (`id`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_id` FOREIGN KEY (`Class_id`) REFERENCES `program` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `session_id2` FOREIGN KEY (`Session_id`) REFERENCES `session` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
