-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2013 at 09:53 PM
-- Server version: 5.5.31
-- PHP Version: 5.3.10-1ubuntu3.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `PBD_server`
--

-- --------------------------------------------------------

--
-- Table structure for table `ball`
--

CREATE TABLE IF NOT EXISTS `ball` (
  `id` varchar(32) NOT NULL,
  `bssid` varchar(32) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `validity` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ball`
--

INSERT INTO `ball` (`id`, `bssid`, `latitude`, `longitude`, `validity`) VALUES
('1', 'amazing_race', 0, 0, 2),
('10', 'amazing_race', 0, 0, 2),
('11', 'amazing_race', 0, 0, 2),
('12', 'amazing_race', 0, 0, 2),
('13', 'amazing_race', 0, 0, 2),
('14', 'amazing_race', 0, 0, 2),
('15', 'amazing_race', 0, 0, 2),
('16', 'amazing_race', 0, 0, 2),
('17', 'amazing_race', 0, 0, 2),
('18', 'amazing_race', 0, 0, 2),
('19', 'amazing_race', 0, 0, 2),
('2', 'amazing_race', 0, 0, 2),
('20', 'amazing_race', 0, 0, 2),
('21', 'amazing_race', 0, 0, 2),
('3', 'amazing_race', 0, 0, 2),
('4', 'amazing_race', 0, 0, 2),
('5', 'amazing_race', 0, 0, 2),
('6', 'amazing_race', 0, 0, 2),
('7', 'amazing_race', 0, 0, 2),
('8', 'amazing_race', 0, 0, 2),
('9', 'amazing_race', 0, 0, 2);
('44a87aa8e7a80b29550b7c9b63751c44', 'qwertj', -6.887796, 107.60855, 1),
('5', 'amazing_race', 0, 0, 2),
('6', 'amazing_race', 0, 0, 2),
('619b0007268ec481f600b57da0bad456', 'qwerte', -6.887796, 107.60855, 1),
('7', 'amazing_race', 0, 0, 2),
('8', 'amazing_race', 0, 0, 2),
('89951feae513e7dd325dcbab8e687720', 'qwertl', -6.887796, 107.60855, 1),
('9', 'amazing_race', 0, 0, 2),
('a67afcbff5ec51fe6671d558038b8673', 'qwertr', -6.887796, 107.60855, 1),
('da7cba409de6224148f624ca49a0b95c', 'qwertd', -6.887796, 107.60855, 1),
('da9ff6ac031efdcd8d35821e77b48997', 'qwertj', -6.887796, 107.60855, 1),
('db30307ddafd40a22864fdebf39ba3a3', 'qwerti', -6.887796, 107.60855, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ball_info`
--

CREATE TABLE IF NOT EXISTS `ball_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bssid` varchar(32) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `ball_info`
--

INSERT INTO `ball_info` (`id`, `bssid`, `latitude`, `longitude`) VALUES
(1, 'qwerta', -6.887796, 107.60855),
(2, 'qwertb', -6.887796, 107.60855),
(3, 'qwertc', -6.887796, 107.60855),
(4, 'qwertd', -6.887796, 107.60855),
(5, 'qwerte', -6.887796, 107.60855),
(6, 'qwertf', -6.887796, 107.60855),
(7, 'qwertg', -6.887796, 107.60855),
(8, 'qwerth', -6.887796, 107.60855),
(9, 'qwerti', -6.887796, 107.60855),
(10, 'qwertj', -6.887796, 107.60855),
(11, 'qwertk', -6.887796, 107.60855),
(12, 'qwertl', -6.887796, 107.60855),
(13, 'qwertm', -6.887796, 107.60855),
(14, 'qwertn', -6.887796, 107.60855),
(15, 'qwerto', -6.887796, 107.60855),
(16, 'qwertp', -6.887796, 107.60855),
(17, 'qwertq', -6.887796, 107.60855),
(18, 'qwertr', -6.887796, 107.60855),
(19, 'qwerts', -6.887796, 107.60855),
(20, 'qwertt', -6.887796, 107.60855),
(21, 'qwertu', -6.887796, 107.60855);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` varchar(32) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `achieved_ball_count` int(11) NOT NULL DEFAULT '0',
  `group_key` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `group_name`, `achieved_ball_count`, `group_key`) VALUES
('f9cf0876055ebd0b831a68fa0a8cc61f', 'haha', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `group_ball`
--

CREATE TABLE IF NOT EXISTS `group_ball` (
  `group_id` varchar(32) NOT NULL,
  `ball_id` varchar(32) NOT NULL,
  KEY `ball_id` (`ball_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_ball`
--

INSERT INTO `group_ball` (`group_id`, `ball_id`) VALUES
('f9cf0876055ebd0b831a68fa0a8cc61f', 'db30307ddafd40a22864fdebf39ba3a3'),
('f9cf0876055ebd0b831a68fa0a8cc61f', 'da9ff6ac031efdcd8d35821e77b48997'),
('f9cf0876055ebd0b831a68fa0a8cc61f', 'da7cba409de6224148f624ca49a0b95c'),
('f9cf0876055ebd0b831a68fa0a8cc61f', 'a67afcbff5ec51fe6671d558038b8673'),
('f9cf0876055ebd0b831a68fa0a8cc61f', '89951feae513e7dd325dcbab8e687720'),
('f9cf0876055ebd0b831a68fa0a8cc61f', '44a87aa8e7a80b29550b7c9b63751c44'),
('f9cf0876055ebd0b831a68fa0a8cc61f', '619b0007268ec481f600b57da0bad456');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(10) NOT NULL,
  `param` text,
  `ip_address` varchar(50) NOT NULL,
  `ip_address_forwarded` varchar(50) DEFAULT NULL,
  `response` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
