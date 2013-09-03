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

INSERT INTO `ball_info` (`bssid`,`latitude`,`longitude`) VALUES
("qwerty", -6.887902, 107.608593),
("abcdef", -6.8888813, 107.60965407),
("asdfgh", -6.89271202, 107.61026324),
("zxcvbn", -6.887902, 107.608593),
("cvbnmx", -6.8888713, 107.60965409),
("poiuyt", -6.8888813, 107.60965417),
("lkjhgf", -6.89271122, 107.61026224),
("dfghjk", -6.89271322, 107.61027024),
("123456", -6.89270122, 107.61024224),
("098765", -6.89261122, 107.61016224),
("1qw23e", -6.88790122, 107.60858913),
("0oi98u", -6.887552, 107.608589),
("azxsdc", -6.88790999, 107.608688),
("mkjnbh", -6.887870, 107.608623);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ball`
--

DROP TABLE IF EXISTS `ball`;
CREATE TABLE IF NOT EXISTS `ball` (
  `id` varchar(32) NOT NULL,
  `bssid` varchar(32) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `validity` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `group_ball`
--

DROP TABLE IF EXISTS `group_ball`;
CREATE TABLE IF NOT EXISTS `group_ball` (
  `group_id` varchar(32) NOT NULL,
  `ball_id` varchar(32) NOT NULL
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
