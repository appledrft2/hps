-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2020 at 11:59 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hps`
--

-- --------------------------------------------------------

--
-- Table structure for table `cash_advance`
--

CREATE TABLE `cash_advance` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash_advance`
--

INSERT INTO `cash_advance` (`id`, `employee_id`, `amount`, `date`, `status`) VALUES
(1, 2, '100.00', '2019-11-29', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `deduction`
--

CREATE TABLE `deduction` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `salary_range` decimal(10,2) NOT NULL,
  `deduction` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deduction`
--

INSERT INTO `deduction` (`id`, `name`, `salary_range`, `deduction`) VALUES
(1, 'Phil Health', '500.00', '100.00'),
(3, 'SSS', '500.00', '100.00'),
(4, 'GSIS', '1000.00', '100.00'),
(5, 'PAG IBIG', '1000.00', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `gender` varchar(50) NOT NULL,
  `address` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `firstname`, `lastname`, `contact`, `gender`, `address`) VALUES
(1, 'Ragie', 'Doromal', '09232546761', 'Male', 'Escalante City'),
(2, 'Angelo', 'Doromal', '09232546761', 'Male', 'Escalante City');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `rate` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `name`, `rate`) VALUES
(1, 'Guna', '1000.00'),
(2, 'Pakyaw (1000) 2 employees', '500.00'),
(3, 'Fertilizer', '200.00'),
(4, 'Tapas', '320.00'),
(5, 'Hilamon', '150.00'),
(6, 'Planting', '180.00'),
(7, 'Pakyaw (3000) 10 employee', '300.00');

-- --------------------------------------------------------

--
-- Table structure for table `payslip`
--

CREATE TABLE `payslip` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `payslip_code` varchar(50) NOT NULL DEFAULT '',
  `date` date NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payslip`
--

INSERT INTO `payslip` (`id`, `employee_id`, `payslip_code`, `date`, `total`) VALUES
(30, 1, 'P10172', '2019-11-29', '900.00'),
(31, 2, 'P10474', '2019-11-29', '800.00'),
(32, 1, 'P10850', '2019-12-03', '700.00'),
(33, 2, 'P10394', '2019-12-03', '700.00');

-- --------------------------------------------------------

--
-- Table structure for table `payslip_cash_advance`
--

CREATE TABLE `payslip_cash_advance` (
  `id` int(10) UNSIGNED NOT NULL,
  `cash_advance_id` int(10) UNSIGNED NOT NULL,
  `payslip_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `payslip_cash_advance`
--

INSERT INTO `payslip_cash_advance` (`id`, `cash_advance_id`, `payslip_id`) VALUES
(1, 1, 31);

-- --------------------------------------------------------

--
-- Table structure for table `payslip_schedule`
--

CREATE TABLE `payslip_schedule` (
  `id` int(10) UNSIGNED NOT NULL,
  `schedule_id` int(10) UNSIGNED NOT NULL,
  `payslip_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payslip_schedule`
--

INSERT INTO `payslip_schedule` (`id`, `schedule_id`, `payslip_id`) VALUES
(2, 3, 30),
(3, 3, 31),
(4, 4, 32),
(5, 5, 32),
(6, 4, 33),
(7, 5, 33);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `job_id`, `date`) VALUES
(3, 1, '2019-11-29'),
(4, 7, '2019-12-03'),
(5, 2, '2019-12-04');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_employee`
--

CREATE TABLE `schedule_employee` (
  `id` int(10) UNSIGNED NOT NULL,
  `schedule_id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule_employee`
--

INSERT INTO `schedule_employee` (`id`, `schedule_id`, `employee_id`, `status`) VALUES
(6, 3, 1, 'Paid'),
(7, 3, 2, 'Paid'),
(8, 4, 1, 'Paid'),
(9, 4, 2, 'Paid'),
(10, 5, 1, 'Paid'),
(11, 5, 2, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cash_advance`
--
ALTER TABLE `cash_advance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `deduction`
--
ALTER TABLE `deduction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payslip`
--
ALTER TABLE `payslip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `payslip_cash_advance`
--
ALTER TABLE `payslip_cash_advance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_advance_id` (`cash_advance_id`),
  ADD KEY `payslip_id` (`payslip_id`);

--
-- Indexes for table `payslip_schedule`
--
ALTER TABLE `payslip_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_id` (`schedule_id`),
  ADD KEY `payslip_id` (`payslip_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `schedule_employee`
--
ALTER TABLE `schedule_employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_id` (`schedule_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cash_advance`
--
ALTER TABLE `cash_advance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deduction`
--
ALTER TABLE `deduction`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payslip`
--
ALTER TABLE `payslip`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `payslip_cash_advance`
--
ALTER TABLE `payslip_cash_advance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payslip_schedule`
--
ALTER TABLE `payslip_schedule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedule_employee`
--
ALTER TABLE `schedule_employee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
