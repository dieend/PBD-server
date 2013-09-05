-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 02. September 2013 jam 07:31
-- Versi Server: 5.5.16
-- Versi PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dragon_ball`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ball_info`
--

DROP TABLE IF EXISTS `ball_info`;
CREATE TABLE IF NOT EXISTS `ball_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bssid` varchar(32) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ball_info` (`bssid`, `latitude`, `longitude`) VALUES
("qwerta",-6.887796,107.60855), 
("qwertb",-6.887796,107.60855), 
("qwertc",-6.887796,107.60855), 
("qwertd",-6.887796,107.60855), 
("qwerte",-6.887796,107.60855), 
("qwertf",-6.887796,107.60855), 
("qwertg",-6.887796,107.60855), 
("qwerth",-6.887796,107.60855), 
("qwerti",-6.887796,107.60855), 
("qwertj",-6.887796,107.60855), 
("qwertk",-6.887796,107.60855), 
("qwertl",-6.887796,107.60855), 
("qwertm",-6.887796,107.60855), 
("qwertn",-6.887796,107.60855), 
("qwerto",-6.887796,107.60855), 
("qwertp",-6.887796,107.60855), 
("qwertq",-6.887796,107.60855), 
("qwertr",-6.887796,107.60855), 
("qwerts",-6.887796,107.60855), 
("qwertt",-6.887796,107.60855), 
("qwertu",-6.887796,107.60855); 

-- --------------------------------------------------------

--
-- Struktur dari tabel `ball`
--

DROP TABLE IF EXISTS `ball`;
DROP TABLE IF EXISTS `ball`;
CREATE TABLE IF NOT EXISTS `ball` (
  `id` varchar(32) NOT NULL,
  `bssid` varchar(32) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `validity` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ball` (`id`,`bssid`,`latitude`,`longitude`,`validity`) VALUES
("1","amazing_race",0,0,2),
("2","amazing_race",0,0,2),
("3","amazing_race",0,0,2),
("4","amazing_race",0,0,2),
("5","amazing_race",0,0,2),
("6","amazing_race",0,0,2),
("7","amazing_race",0,0,2),
("8","amazing_race",0,0,2),
("9","amazing_race",0,0,2),
("10","amazing_race",0,0,2),
("11","amazing_race",0,0,2),
("12","amazing_race",0,0,2),
("13","amazing_race",0,0,2),
("14","amazing_race",0,0,2),
("15","amazing_race",0,0,2),
("16","amazing_race",0,0,2),
("17","amazing_race",0,0,2),
("18","amazing_race",0,0,2),
("19","amazing_race",0,0,2),
("20","amazing_race",0,0,2),
("21","amazing_race",0,0,2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `group`
--

DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `id` varchar(32) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `achieved_ball_count` int NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `group_ball`
--

DROP TABLE IF EXISTS `group_ball`;
CREATE TABLE IF NOT EXISTS `group_ball` (
  `group_id` varchar(32) NOT NULL,
  `ball_id` varchar(32) NOT NULL,
  KEY `ball_id` (`ball_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(10) NOT NULL,
  `param` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
