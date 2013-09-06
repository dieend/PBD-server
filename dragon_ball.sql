-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 06. September 2013 jam 13:58
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
-- Struktur dari tabel `ball`
--

CREATE TABLE IF NOT EXISTS `ball` (
  `id` varchar(32) NOT NULL,
  `bssid` varchar(32) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `validity` tinyint(1) NOT NULL,
  `wifi_signal` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ball`
--

INSERT INTO `ball` (`id`, `bssid`, `latitude`, `longitude`, `validity`, `wifi_signal`) VALUES
('1', 'amazing_race', 0, 0, 2, 0),
('10', 'amazing_race', 0, 0, 2, 0),
('11', 'amazing_race', 0, 0, 2, 0),
('12', 'amazing_race', 0, 0, 2, 0),
('13', 'amazing_race', 0, 0, 2, 0),
('14', 'amazing_race', 0, 0, 2, 0),
('15', 'amazing_race', 0, 0, 2, 0),
('16', 'amazing_race', 0, 0, 2, 0),
('17', 'amazing_race', 0, 0, 2, 0),
('18', 'amazing_race', 0, 0, 2, 0),
('19', 'amazing_race', 0, 0, 2, 0),
('2', 'amazing_race', 0, 0, 2, 0),
('20', 'amazing_race', 0, 0, 2, 0),
('21', 'amazing_race', 39.737755555556, 104.98928611111, 0, 0),
('296c91a3fe51ad54413124a99657144b', 'qwertb', -6.887796, 107.60855, 1, 0),
('2f6dbc1b5be83963f671a6220a2c57ab', 'qwertj', -6.887796, 107.60855, 1, 0),
('3', 'amazing_race', 0, 0, 2, 0),
('4', 'amazing_race', 0, 0, 2, 0),
('5', 'amazing_race', 0, 0, 2, 0),
('6', 'amazing_race', 0, 0, 2, 0),
('7', 'amazing_race', 0, 0, 2, 0),
('8', 'amazing_race', 0, 0, 2, 0),
('9', 'amazing_race', 0, 0, 2, 0),
('994f5f08564fe2935918936661535e69', 'qwertu', -6.887796, 107.60855, 1, 0),
('ae9ecddbd4dc36e9cd6101917031d3eb', 'qwertl', -6.887796, 107.60855, 1, 0),
('f08b939dccf3bf386dcb16f48b38a2f2', 'qwertn', -6.887796, 107.60855, 1, 0),
('f1660e6da6f6d46e17515ef0230a47ad', 'qwerte', -6.887796, 107.60855, 1, 0),
('f9e22bda3a98225286a227c35978c863', 'qwertp', -6.887796, 107.60855, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ball_info`
--

CREATE TABLE IF NOT EXISTS `ball_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bssid` varchar(32) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `wifi_signal` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data untuk tabel `ball_info`
--

INSERT INTO `ball_info` (`id`, `bssid`, `latitude`, `longitude`, `wifi_signal`) VALUES
(1, 'qwerta', -6.887796, 107.60855, 0),
(2, 'qwertb', -6.887796, 107.60855, 0),
(3, 'qwertc', -6.887796, 107.60855, 0),
(4, 'qwertd', -6.887796, 107.60855, 0),
(5, 'qwerte', -6.887796, 107.60855, 0),
(6, 'qwertf', -6.887796, 107.60855, 0),
(7, 'qwertg', -6.887796, 107.60855, 0),
(8, 'qwerth', -6.887796, 107.60855, 0),
(9, 'qwerti', -6.887796, 107.60855, 0),
(10, 'qwertj', -6.887796, 107.60855, 0),
(11, 'qwertk', -6.887796, 107.60855, 0),
(12, 'qwertl', -6.887796, 107.60855, 0),
(13, 'qwertm', -6.887796, 107.60855, 0),
(14, 'qwertn', -6.887796, 107.60855, 0),
(15, 'qwerto', -6.887796, 107.60855, 0),
(16, 'qwertp', -6.887796, 107.60855, 0),
(17, 'qwertq', -6.887796, 107.60855, 0),
(18, 'qwertr', -6.887796, 107.60855, 0),
(19, 'qwerts', -6.887796, 107.60855, 0),
(20, 'qwertt', -6.887796, 107.60855, 0),
(21, 'qwertu', -6.887796, 107.60855, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` varchar(32) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `achieved_ball_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `group`
--

INSERT INTO `group` (`id`, `group_name`, `achieved_ball_count`) VALUES
('df157f0e24dc4f0ce86781a85ef92056', 'samca', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `group_ball`
--

CREATE TABLE IF NOT EXISTS `group_ball` (
  `group_id` varchar(32) NOT NULL,
  `ball_id` varchar(32) NOT NULL,
  KEY `ball_id` (`ball_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `group_ball`
--

INSERT INTO `group_ball` (`group_id`, `ball_id`) VALUES
('df157f0e24dc4f0ce86781a85ef92056', '994f5f08564fe2935918936661535e69'),
('df157f0e24dc4f0ce86781a85ef92056', 'f1660e6da6f6d46e17515ef0230a47ad'),
('df157f0e24dc4f0ce86781a85ef92056', 'f08b939dccf3bf386dcb16f48b38a2f2'),
('df157f0e24dc4f0ce86781a85ef92056', 'f9e22bda3a98225286a227c35978c863'),
('df157f0e24dc4f0ce86781a85ef92056', '296c91a3fe51ad54413124a99657144b'),
('df157f0e24dc4f0ce86781a85ef92056', 'ae9ecddbd4dc36e9cd6101917031d3eb'),
('df157f0e24dc4f0ce86781a85ef92056', '2f6dbc1b5be83963f671a6220a2c57ab');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(10) NOT NULL,
  `param` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id`, `action`, `param`) VALUES
(8, 'create', '{"group_id":"110296384aae265d3649c7f64ef79005","group_name":"samca","chest_id":"62aa057580ef259f049959f4794a408d","latitude":"-6.8888713","longitude":"107.60965409"}'),
(9, 'number', '{"group_id":"110296384aae265d3649c7f64ef79005","group_name":"samca","chest_id":"62aa057580ef259f049959f4794a408d","latitude":"-6.8888713","longitude":"107.60965409"}'),
(10, 'number', '{"group_id":"110296384aae265d3649c7f64ef79005","group_name":"samca","chest_id":"62aa057580ef259f049959f4794a408d","latitude":"-6.8888713","longitude":"107.60965409"}'),
(11, 'acquire', '{"group_id":"110296384aae265d3649c7f64ef79005","group_name":"samca","chest_id":"62aa057580ef259f049959f4794a408d","latitude":"-6.8888713","longitude":"107.60965409"}'),
(12, 'acquire', '{"group_id":"110296384aae265d3649c7f64ef79005","group_name":"samca","chest_id":"296c91a3fe51ad54413124a99657144b","latitude":"-6.8888713","longitude":"107.60965409"}'),
(13, 'acquire', '{"group_id":"110296384aae265d3649c7f64ef79005","group_name":"samca","chest_id":"296c91a3fe51ad54413124a99657144b","latitude":"-6.8888713","longitude":"107.60965409"}'),
(14, 'acquire', '{"group_id":"110296384aae265d3649c7f64ef79005","group_name":"samca","chest_id":"21","latitude":"-6.8888713","longitude":"107.60965409"}'),
(15, 'acquire', '{"group_id":"110296384aae265d3649c7f64ef79005","group_name":"samca","chest_id":"21","latitude":"-6.8888713","longitude":"107.60965409"}'),
(16, 'acquire', '{"group_id":"110296384aae265d3649c7f64ef79005","group_name":"samca","chest_id":"21","latitude":"-6.8888713","longitude":"107.60965409"}'),
(17, 'acquire', '{"group_id":"110296384aae265d3649c7f64ef79005","group_name":"samca","chest_id":"21","latitude":"-6.8888713","longitude":"107.60965409"}'),
(18, 'acquire', '{"group_id":"110296384aae265d3649c7f64ef79005","group_name":"samca","chest_id":"21","latitude":"-6.8888713","longitude":"107.60965409"}'),
(19, 'acquire', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"-6.8888713","longitude":"107.60965409"}'),
(20, 'retrieve', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"-6.8888713","longitude":"107.60965409"}'),
(21, 'retrieve', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(22, 'retrieve', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(23, 'retrieve', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(24, 'retrieve', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(25, 'retrieve', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(26, 'number', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(27, 'number', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(28, 'number', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(29, 'number', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(30, 'number', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(31, 'number', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(32, 'number', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(33, 'number', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(34, 'acquire', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(35, 'acquire', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(36, 'acquire', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(37, 'acquire', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(38, 'acquire', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(39, 'acquire', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(40, 'acquire', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(41, 'acquire', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(42, 'reset', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","group_name":"samca","chest_id":"21","latitude":"0","longitude":"0"}'),
(43, 'number', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056"}'),
(44, 'retrieve', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","latitude":"-6.887796","longitude":"107.60855"}'),
(45, 'reset', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056"}'),
(46, 'reset', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056"}'),
(47, 'acquire', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","chest_id":"296c91a3fe51ad54413124a99657144b"}'),
(48, 'acquire', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","chest_id":"296c91a3fe51ad54413124a99657144b"}'),
(49, 'acquire', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","chest_id":"296c91a3fe51ad54413124a99657144b"}'),
(50, 'acquire', '{"group_id":"df157f0e24dc4f0ce86781a85ef92056","chest_id":"296c91a3fe51ad54413124a99657144b"}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
