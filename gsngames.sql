-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2017 at 01:27 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gsngames`
--

-- --------------------------------------------------------

--
-- Table structure for table `cellinfo`
--

CREATE TABLE `cellinfo` (
  `cellid` int(11) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '0',
  `color` varchar(100) NOT NULL DEFAULT 'White'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cellinfo`
--

INSERT INTO `cellinfo` (`cellid`, `userid`, `color`) VALUES
(1, 0, '#ffffff'),
(2, 0, '#ffffff'),
(3, 0, '#ffffff'),
(4, 0, '#ffffff'),
(5, 0, '#ffffff'),
(6, 0, '#ffffff'),
(7, 1, '#ffffff'),
(8, 0, '#ffffff'),
(9, 0, '#ffffff'),
(10, 0, '#ffffff'),
(11, 0, '#ffffff'),
(12, 0, '#ffffff'),
(13, 1, '#ffffff'),
(14, 0, '#ffffff'),
(15, 0, '#ffffff'),
(16, 1, '#ff0000'),
(17, 0, '#ffffff'),
(18, 2, '#ffff00'),
(19, 0, '#ffffff'),
(20, 0, '#ffffff'),
(21, 0, '#ffffff'),
(22, 1, '#ff0000'),
(23, 2, '#ffffff'),
(24, 0, '#ffffff'),
(25, 2, '#ffff00'),
(26, 0, '#ffffff'),
(27, 2, '#ffff00'),
(28, 0, '#ffffff'),
(29, 0, '#ffffff'),
(30, 0, '#ffffff'),
(31, 1, '#ffffff'),
(32, 0, '#ffffff'),
(33, 0, '#ffffff'),
(34, 0, '#ffffff'),
(35, 0, '#ffffff'),
(36, 1, '#ffffff'),
(37, 0, '#ffffff'),
(38, 1, '#ffffff'),
(39, 0, '#ffffff'),
(40, 1, '#ff0000'),
(41, 2, '#ffffff'),
(42, 0, '#ffffff'),
(43, 1, '#ffffff'),
(44, 0, '#ffffff'),
(45, 1, '#ff0000'),
(46, 0, '#ffffff'),
(47, 2, '#ffffff'),
(48, 2, '#ffff00'),
(49, 0, '#ffffff'),
(50, 0, '#ffffff'),
(51, 0, '#ffffff'),
(52, 0, '#ffffff'),
(53, 0, '#ffffff'),
(54, 0, '#ffffff'),
(55, 0, '#ffffff'),
(56, 0, '#ffffff'),
(57, 1, '#ffffff'),
(58, 0, '#ffffff'),
(59, 0, '#ffffff'),
(60, 1, '#ffffff'),
(61, 0, '#ffffff'),
(62, 0, '#ffffff'),
(63, 0, '#ffffff'),
(64, 0, '#ffffff'),
(65, 0, '#ffffff'),
(66, 0, '#ffffff'),
(67, 0, '#ffffff'),
(68, 0, '#ffffff'),
(69, 0, '#ffffff'),
(70, 0, '#ffffff'),
(71, 0, '#ffffff'),
(72, 0, '#ffffff'),
(73, 0, '#ffffff'),
(74, 0, '#ffffff'),
(75, 0, '#ffffff'),
(76, 0, '#ffffff'),
(77, 0, '#ffffff'),
(78, 0, '#ffffff'),
(79, 0, '#ffffff'),
(80, 1, '#ffffff'),
(81, 0, '#ffffff'),
(82, 0, '#ffffff'),
(83, 0, '#ffffff'),
(84, 0, '#ffffff'),
(85, 0, '#ffffff'),
(86, 0, '#ffffff'),
(87, 0, '#ffffff'),
(88, 0, '#ffffff'),
(89, 0, '#ffffff'),
(90, 0, '#ffffff'),
(91, 0, '#ffffff'),
(92, 0, '#ffffff'),
(93, 0, '#ffffff'),
(94, 0, '#ffffff'),
(95, 0, '#ffffff'),
(96, 0, '#ffffff'),
(97, 0, '#ffffff'),
(98, 0, '#ffffff'),
(99, 0, '#ffffff'),
(100, 0, '#ffffff');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('6291a87cc44782f014fec36d15d8dfc1', '::1', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .N', 1374942912, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:2:{s:7:\"user_id\";s:1:\"1\";s:8:\"username\";s:6:\"jayesh\";}}'),
('4d5bf10fd23c0e591312359eeb9a843b', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:7.0.1) Gecko/20100101 Firefox/7.0.1', 1374945783, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:2:{s:7:\"user_id\";s:1:\"1\";s:8:\"username\";s:6:\"jayesh\";}}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `lock` tinyint(4) NOT NULL DEFAULT '0',
  `locktime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `lock`, `locktime`) VALUES
(1, 'jayesh', 'ed52efced6f7f5438c91fe8293eed992', 0, '2017-11-20 01:22:13'),
(2, 'nidheesh', 'ed52efced6f7f5438c91fe8293eed992', 0, '2017-11-20 01:22:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cellinfo`
--
ALTER TABLE `cellinfo`
  ADD PRIMARY KEY (`cellid`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cellinfo`
--
ALTER TABLE `cellinfo`
  MODIFY `cellid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
