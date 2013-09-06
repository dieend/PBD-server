-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2013 at 02:21 PM
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
