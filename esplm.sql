-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2015 at 07:16 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esplm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `full_name`) VALUES
(1, '456', '250cf8b51c773f3f8dc8b4be867a9a02', 'Mohd Admin');

-- --------------------------------------------------------

--
-- Table structure for table `bandar`
--

CREATE TABLE IF NOT EXISTS `bandar` (
  `id` int(10) NOT NULL,
  `nama` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bandar`
--

INSERT INTO `bandar` (`id`, `nama`) VALUES
(1, 'City One'),
(2, 'City Two');

-- --------------------------------------------------------

--
-- Table structure for table `fakulti`
--

CREATE TABLE IF NOT EXISTS `fakulti` (
  `id` int(10) unsigned NOT NULL,
  `nama_panjang` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nama_pendek` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fakulti`
--

INSERT INTO `fakulti` (`id`, `nama_panjang`, `nama_pendek`) VALUES
(1, 'Faculty One', 'f-one'),
(2, 'Faculty Two', 'f-two');

-- --------------------------------------------------------

--
-- Table structure for table `negeri`
--

CREATE TABLE IF NOT EXISTS `negeri` (
  `id` int(10) NOT NULL,
  `nama` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `negeri`
--

INSERT INTO `negeri` (`id`, `nama`) VALUES
(1, 'State One'),
(2, 'State Two');

-- --------------------------------------------------------

--
-- Table structure for table `pelajar`
--

CREATE TABLE IF NOT EXISTS `pelajar` (
  `id` int(10) unsigned NOT NULL,
  `no_matrik` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kata_laluan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `program_major` tinyint(4) unsigned NOT NULL,
  `fakulti` tinyint(4) unsigned NOT NULL,
  `nama_penuh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jantina` enum('P','L') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'L',
  `tarikh_lahir` datetime NOT NULL,
  `bangsa` tinyint(3) unsigned NOT NULL,
  `tarikh_dibuat` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pelajar`
--

INSERT INTO `pelajar` (`id`, `no_matrik`, `kata_laluan`, `program_major`, `fakulti`, `nama_penuh`, `jantina`, `tarikh_lahir`, `bangsa`, `tarikh_dibuat`) VALUES
(5, 'd20092036960', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1, 'y', '', '0000-00-00 00:00:00', 0, '2015-08-03 03:53:50'),
(3, '123', '202cb962ac59075b964b07152d234b70', 2, 2, 'x', '', '0000-00-00 00:00:00', 0, '2015-07-18 01:21:10');

-- --------------------------------------------------------

--
-- Table structure for table `permohonan`
--

CREATE TABLE IF NOT EXISTS `permohonan` (
  `id` int(10) unsigned NOT NULL,
  `id_pelajar` int(10) unsigned NOT NULL,
  `id_sekolah` int(5) unsigned NOT NULL,
  `id_subjek` int(5) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `tarikh_dibuat` datetime NOT NULL,
  `tarikh_kemaskini` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program_major`
--

CREATE TABLE IF NOT EXISTS `program_major` (
  `id` int(10) unsigned NOT NULL,
  `nama_panjang` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nama_pendek` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `program_major`
--

INSERT INTO `program_major` (`id`, `nama_panjang`, `nama_pendek`) VALUES
(1, 'Programme One', 'p-one'),
(2, 'Programme Two', 'p-two');

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE IF NOT EXISTS `sekolah` (
  `id` int(10) unsigned NOT NULL,
  `nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_negeri` int(10) unsigned NOT NULL,
  `id_bandar` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`id`, `nama`, `id_negeri`, `id_bandar`) VALUES
(1, 'School One', 1, 1),
(2, 'School Two', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `status_permohonan`
--

CREATE TABLE IF NOT EXISTS `status_permohonan` (
  `id` int(10) unsigned NOT NULL,
  `nama` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `butiran` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status_permohonan`
--

INSERT INTO `status_permohonan` (`id`, `nama`, `butiran`) VALUES
(1, 'Pending Approval', ''),
(2, 'Approved', ''),
(3, 'Rejected', '');

-- --------------------------------------------------------

--
-- Table structure for table `subjek`
--

CREATE TABLE IF NOT EXISTS `subjek` (
  `id` int(10) unsigned NOT NULL,
  `nama` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subjek`
--

INSERT INTO `subjek` (`id`, `nama`) VALUES
(1, 'Subject One'),
(2, 'Subject Two');

-- --------------------------------------------------------

--
-- Table structure for table `subjek_sekolah`
--

CREATE TABLE IF NOT EXISTS `subjek_sekolah` (
  `id_sekolah` int(10) unsigned NOT NULL,
  `id_subjek` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subjek_sekolah`
--

INSERT INTO `subjek_sekolah` (`id_sekolah`, `id_subjek`) VALUES
(1, 1),
(2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bandar`
--
ALTER TABLE `bandar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fakulti`
--
ALTER TABLE `fakulti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `negeri`
--
ALTER TABLE `negeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelajar`
--
ALTER TABLE `pelajar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permohonan`
--
ALTER TABLE `permohonan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_major`
--
ALTER TABLE `program_major`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_permohonan`
--
ALTER TABLE `status_permohonan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjek`
--
ALTER TABLE `subjek`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bandar`
--
ALTER TABLE `bandar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fakulti`
--
ALTER TABLE `fakulti`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `negeri`
--
ALTER TABLE `negeri`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pelajar`
--
ALTER TABLE `pelajar`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `permohonan`
--
ALTER TABLE `permohonan`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `program_major`
--
ALTER TABLE `program_major`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `status_permohonan`
--
ALTER TABLE `status_permohonan`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subjek`
--
ALTER TABLE `subjek`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
