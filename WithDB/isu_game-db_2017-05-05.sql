-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 05, 2017 at 01:19 AM
-- Server version: 5.5.39
-- PHP Version: 5.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `isu_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `gamedata`
--

CREATE TABLE `gamedata` (
`gamedata_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `level` varchar(33) NOT NULL,
  `location` varchar(33) NOT NULL,
  `equipment` varchar(1000) NOT NULL,
  `health` int(3) NOT NULL,
  `saveslot` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `gamedata`
--

INSERT INTO `gamedata` (`gamedata_id`, `user_id`, `level`, `location`, `equipment`, `health`, `saveslot`) VALUES
(87, 36, 'Introduction', 'beginning', '', 5, 0),
(74, 10, 'The City', 'east side marios', ' Flashlight', 0, 74),
(88, 35, 'The Island', 'the test, running, obstacle one', 'flashlight spear', 5, 53);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
`user_id` int(11) NOT NULL,
  `username` varchar(33) NOT NULL,
  `password` varchar(33) NOT NULL,
  `signupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(33) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `signupdate`, `email`, `active`) VALUES
(10, 'admin', 'j', '2015-01-02 06:41:12', 'admin@inauguration.ca', 1),
(36, 'a', 'a', '2015-01-15 20:56:07', 'a', 1),
(35, 'jacob', 'j', '2015-01-15 20:54:36', 'j', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gamedata`
--
ALTER TABLE `gamedata`
 ADD PRIMARY KEY (`gamedata_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gamedata`
--
ALTER TABLE `gamedata`
MODIFY `gamedata_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
