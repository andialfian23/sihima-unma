-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2023 at 12:53 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sihima`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_absen`
--

CREATE TABLE `t_absen` (
  `id` int(11) NOT NULL,
  `no_kegiatan` int(11) NOT NULL,
  `mhs_unma` tinyint(1) NOT NULL,
  `no_id` varchar(15) NOT NULL,
  `status` enum('Hadir','Sakit','Izin','Tanpa Keterangan','Belum Hadir') NOT NULL,
  `sebagai` varchar(100) NOT NULL,
  `waktu_absen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `token_presensi` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_absen`
--

INSERT INTO `t_absen` (`id`, `no_kegiatan`, `mhs_unma`, `no_id`, `status`, `sebagai`, `waktu_absen`, `token_presensi`, `signature`) VALUES
(1, 1, 1, '18.14.1.0003', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(3, 1, 1, '18.14.1.0001', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(4, 1, 1, '18.14.1.0014', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(5, 1, 1, '18.14.1.0021', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(6, 1, 1, '18.14.1.0007', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(7, 1, 1, '18.14.1.0012', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(9, 1, 1, '18.14.1.0034', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(11, 1, 1, '18.14.1.0046', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(12, 1, 1, '18.14.1.0040', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(30, 1, 1, '18.14.1.0047', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(43, 1, 1, '18.14.1.0060', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(44, 30, 1, '18.14.1.0001', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(47, 30, 1, '18.14.1.0007', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(48, 30, 1, '18.14.1.0012', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(49, 30, 1, '18.14.1.0014', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(50, 30, 1, '18.14.1.0021', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(51, 30, 1, '18.14.1.0027', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(52, 30, 1, '18.14.1.0028', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(53, 30, 1, '18.14.1.0033', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(54, 30, 1, '18.14.1.0034', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(55, 30, 1, '18.14.1.0040', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(56, 30, 1, '18.14.1.0045', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(57, 30, 1, '18.14.1.0046', 'Hadir', 'Penanggung Jawab', '2022-10-27 15:50:03', NULL, NULL),
(58, 30, 1, '18.14.1.0047', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(60, 30, 1, '19.14.1.0001', 'Hadir', 'Ketua Pelaksana', '2022-10-27 15:51:00', NULL, NULL),
(61, 30, 1, '19.14.1.0005', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(62, 30, 1, '19.14.1.0009', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(63, 30, 1, '19.14.1.0011', 'Izin', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(64, 30, 1, '19.14.1.0012', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(65, 30, 1, '19.14.1.0019', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(66, 30, 1, '19.14.1.0022', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(67, 30, 1, '19.14.1.0029', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(68, 30, 1, '19.14.1.0031', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(69, 30, 1, '19.14.1.0034', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(70, 30, 1, '19.14.1.0038', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(71, 30, 1, '19.14.1.0039', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(72, 4, 1, '18.14.1.0001', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(73, 4, 1, '18.14.1.0003', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(74, 4, 1, '18.14.1.0004', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(75, 4, 1, '18.14.1.0007', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(76, 4, 1, '18.14.1.0012', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(77, 4, 1, '18.14.1.0014', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(78, 4, 1, '18.14.1.0021', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(79, 4, 1, '18.14.1.0027', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(80, 4, 1, '18.14.1.0028', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(81, 4, 1, '18.14.1.0033', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(82, 4, 1, '18.14.1.0034', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(83, 4, 1, '18.14.1.0040', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(84, 4, 1, '18.14.1.0045', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(85, 4, 1, '18.14.1.0046', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(86, 4, 1, '18.14.1.0047', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(87, 4, 1, '18.14.1.0060', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(88, 4, 1, '19.14.1.0001', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(89, 4, 1, '19.14.1.0005', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(90, 4, 1, '19.14.1.0009', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(91, 4, 1, '19.14.1.0011', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(92, 4, 1, '19.14.1.0012', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(93, 4, 1, '19.14.1.0019', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(94, 4, 1, '19.14.1.0022', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(95, 4, 1, '19.14.1.0029', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(96, 4, 1, '19.14.1.0031', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(97, 4, 1, '19.14.1.0034', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(98, 4, 1, '19.14.1.0038', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(99, 4, 1, '19.14.1.0039', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(113, 25, 1, '18.14.1.0001', 'Hadir', 'Sie. Acara', '2022-12-20 11:26:44', NULL, NULL),
(114, 25, 1, '18.14.1.0003', 'Hadir', 'Sie. Logistik', '2022-12-20 11:27:07', NULL, NULL),
(115, 25, 1, '18.14.1.0004', 'Hadir', 'Sie. Humas', '2022-12-20 11:32:31', NULL, NULL),
(116, 25, 1, '18.14.1.0007', 'Hadir', 'Ketua Pelaksana', '2022-12-20 11:27:22', NULL, NULL),
(117, 25, 1, '18.14.1.0012', 'Hadir', 'Bendahara', '2022-12-20 11:28:28', NULL, NULL),
(118, 25, 1, '18.14.1.0014', 'Hadir', 'Sie. Konsumsi', '2022-12-20 11:31:02', NULL, NULL),
(119, 25, 1, '18.14.1.0021', 'Hadir', 'Sie. Acara', '2022-12-20 11:28:49', NULL, NULL),
(120, 25, 1, '18.14.1.0027', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(121, 25, 1, '18.14.1.0028', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(122, 25, 1, '18.14.1.0033', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(123, 25, 1, '18.14.1.0034', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(124, 25, 1, '18.14.1.0040', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(126, 25, 1, '18.14.1.0046', 'Hadir', 'Penanggung Jawab', '2022-12-20 11:27:42', NULL, NULL),
(127, 25, 1, '18.14.1.0047', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(129, 25, 1, '19.14.1.0001', 'Hadir', 'Sie. Konsumsi', '2022-12-20 11:31:41', NULL, NULL),
(130, 25, 1, '19.14.1.0005', 'Hadir', 'Sie. Humas', '2022-12-20 11:32:56', NULL, NULL),
(131, 25, 1, '19.14.1.0009', 'Hadir', 'Sie. Humas', '2022-12-20 11:33:53', NULL, NULL),
(132, 25, 1, '19.14.1.0011', 'Hadir', 'Sie. Konsumsi', '2022-12-20 11:32:04', NULL, NULL),
(133, 25, 1, '19.14.1.0012', 'Hadir', 'Sie. Humas', '2022-12-20 11:33:37', NULL, NULL),
(134, 25, 1, '19.14.1.0019', 'Hadir', 'Sie. Konsumsi', '2022-12-20 11:33:17', NULL, NULL),
(135, 25, 1, '19.14.1.0022', 'Hadir', 'Sie. Humas', '2022-12-20 11:34:10', NULL, NULL),
(136, 25, 1, '19.14.1.0029', 'Hadir', 'Sie. Acara', '2022-12-20 11:30:27', NULL, NULL),
(137, 25, 1, '19.14.1.0031', 'Hadir', 'Sekretaris', '2022-12-20 11:28:09', NULL, NULL),
(138, 25, 1, '19.14.1.0034', 'Hadir', 'Sie. Acara', '2022-12-20 11:30:42', NULL, NULL),
(139, 25, 1, '19.14.1.0038', 'Hadir', 'Sie. Acara', '2022-12-20 11:30:12', NULL, NULL),
(141, 30, 1, '18.14.1.0003', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(174, 18, 1, '18.14.1.0001', 'Hadir', 'Ketua Pelaksana', '2022-10-06 05:11:59', NULL, NULL),
(175, 18, 1, '18.14.1.0003', 'Hadir', 'Sie. Logistik', '2022-10-06 05:33:51', NULL, NULL),
(176, 18, 1, '18.14.1.0004', 'Hadir', 'Sie. Logistik', '2022-10-06 06:16:01', NULL, NULL),
(177, 18, 1, '18.14.1.0007', 'Hadir', 'Sie. Acara', '2022-10-06 06:16:29', NULL, NULL),
(178, 18, 1, '18.14.1.0012', 'Hadir', 'Sie. Humas', '2022-10-06 06:16:55', NULL, NULL),
(179, 18, 1, '18.14.1.0014', 'Hadir', 'Sie. Acara', '2022-10-06 06:20:56', NULL, NULL),
(180, 18, 1, '18.14.1.0021', 'Hadir', 'Sie. Konsumsi', '2022-10-06 06:20:05', NULL, NULL),
(181, 18, 1, '18.14.1.0027', 'Hadir', 'Sie. Humas', '2022-10-06 06:18:29', NULL, NULL),
(182, 18, 1, '18.14.1.0028', 'Hadir', 'Sie. Dokumentasi', '2022-10-06 06:17:51', NULL, NULL),
(183, 18, 1, '18.14.1.0033', 'Hadir', 'Sie. Logistik', '2022-10-06 06:17:27', NULL, NULL),
(184, 18, 1, '18.14.1.0034', 'Hadir', 'Sie. Acara', '2022-10-06 06:22:38', NULL, NULL),
(185, 18, 1, '18.14.1.0040', 'Hadir', 'Sie. Dokumentasi', '2022-10-06 06:22:17', NULL, NULL),
(186, 18, 1, '18.14.1.0045', 'Hadir', 'Sie. Dokumentasi', '2022-10-06 06:21:57', NULL, NULL),
(187, 18, 1, '18.14.1.0046', 'Hadir', 'Penanggung Jawab', '2022-10-06 06:21:37', NULL, NULL),
(188, 18, 1, '18.14.1.0047', 'Hadir', 'Sie. Konsumsi', '2022-10-06 06:21:15', NULL, NULL),
(190, 18, 1, '19.14.1.0001', 'Hadir', 'Sie. Konsumsi', '2022-10-06 06:24:53', NULL, NULL),
(191, 18, 1, '19.14.1.0005', 'Hadir', 'Sie. Logistik', '2022-10-06 06:24:35', NULL, NULL),
(192, 18, 1, '19.14.1.0009', 'Hadir', 'Bendahara', '2022-10-06 06:24:15', NULL, NULL),
(193, 18, 1, '19.14.1.0011', 'Hadir', 'Sie. Logistik', '2022-10-06 06:23:36', NULL, NULL),
(194, 18, 1, '19.14.1.0012', 'Hadir', 'Sie. Konsumsi', '2022-10-06 06:26:38', NULL, NULL),
(195, 18, 1, '19.14.1.0019', 'Hadir', 'Sie. Humas', '2022-10-06 06:27:55', NULL, NULL),
(196, 18, 1, '19.14.1.0022', 'Hadir', 'Sie. Acara', '2022-10-06 06:27:33', NULL, NULL),
(197, 18, 1, '19.14.1.0029', 'Hadir', 'Sekretaris', '2022-10-06 06:27:15', NULL, NULL),
(198, 18, 1, '19.14.1.0031', 'Hadir', 'Sie. Humas', '2022-10-06 06:26:56', NULL, NULL),
(199, 18, 1, '19.14.1.0034', 'Hadir', 'Sie. Acara', '2022-10-06 06:28:20', NULL, NULL),
(200, 18, 1, '19.14.1.0038', 'Hadir', 'Sie. Acara', '2022-10-06 06:28:40', NULL, NULL),
(201, 18, 1, '19.14.1.0039', 'Hadir', 'Sie. Dokumentasi', '2022-10-06 06:29:00', NULL, NULL),
(203, 30, 1, '18.14.1.0060', 'Hadir', 'Peserta', '2022-10-27 15:48:12', NULL, NULL),
(204, 25, 1, '19.14.1.0039', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(325, 5, 1, '18.14.1.0001', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(326, 5, 1, '18.14.1.0003', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(327, 5, 1, '18.14.1.0004', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(328, 5, 1, '18.14.1.0007', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(329, 5, 1, '18.14.1.0012', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(330, 5, 1, '18.14.1.0014', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(331, 5, 1, '18.14.1.0021', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(332, 5, 1, '18.14.1.0027', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(333, 5, 1, '18.14.1.0028', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(334, 5, 1, '18.14.1.0033', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(335, 5, 1, '18.14.1.0034', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(336, 5, 1, '18.14.1.0040', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(337, 5, 1, '18.14.1.0045', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(338, 5, 1, '18.14.1.0046', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(339, 5, 1, '18.14.1.0047', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(340, 5, 1, '18.14.1.0060', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(341, 5, 1, '19.14.1.0001', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(342, 5, 1, '19.14.1.0005', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(343, 5, 1, '19.14.1.0009', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(344, 5, 1, '19.14.1.0011', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(345, 5, 1, '19.14.1.0012', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(346, 5, 1, '19.14.1.0019', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(347, 5, 1, '19.14.1.0022', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(348, 5, 1, '19.14.1.0029', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(349, 5, 1, '19.14.1.0031', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(350, 5, 1, '19.14.1.0034', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(351, 5, 1, '19.14.1.0038', 'Izin', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(352, 5, 1, '19.14.1.0039', 'Hadir', 'Peserta', '2022-07-31 10:14:18', NULL, NULL),
(353, 7, 1, '18.14.1.0001', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(354, 7, 1, '18.14.1.0003', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(355, 7, 1, '18.14.1.0004', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(356, 7, 1, '18.14.1.0007', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(357, 7, 1, '18.14.1.0012', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(358, 7, 1, '18.14.1.0014', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(359, 7, 1, '18.14.1.0021', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(360, 7, 1, '18.14.1.0027', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(361, 7, 1, '18.14.1.0028', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(362, 7, 1, '18.14.1.0033', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(363, 7, 1, '18.14.1.0034', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(364, 7, 1, '18.14.1.0040', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(365, 7, 1, '18.14.1.0045', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(366, 7, 1, '18.14.1.0046', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(367, 7, 1, '18.14.1.0047', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(368, 7, 1, '18.14.1.0060', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(369, 7, 1, '19.14.1.0001', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(370, 7, 1, '19.14.1.0005', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(371, 7, 1, '19.14.1.0009', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(372, 7, 1, '19.14.1.0011', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(373, 7, 1, '19.14.1.0012', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(374, 7, 1, '19.14.1.0019', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(375, 7, 1, '19.14.1.0022', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(376, 7, 1, '19.14.1.0029', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(377, 7, 1, '19.14.1.0031', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(378, 7, 1, '19.14.1.0034', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(379, 7, 1, '19.14.1.0038', 'Izin', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(380, 7, 1, '19.14.1.0039', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(381, 3, 1, '18.14.1.0001', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(382, 3, 1, '18.14.1.0003', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(383, 3, 1, '18.14.1.0004', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(384, 3, 1, '18.14.1.0007', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(385, 3, 1, '18.14.1.0012', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(386, 3, 1, '18.14.1.0014', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(387, 3, 1, '18.14.1.0021', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(388, 3, 1, '18.14.1.0027', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(389, 3, 1, '18.14.1.0028', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(390, 3, 1, '18.14.1.0033', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(391, 3, 1, '18.14.1.0034', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(392, 3, 1, '18.14.1.0040', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(393, 3, 1, '18.14.1.0045', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(394, 3, 1, '18.14.1.0046', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(395, 3, 1, '18.14.1.0047', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(396, 3, 1, '18.14.1.0060', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(397, 3, 1, '19.14.1.0001', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(398, 3, 1, '19.14.1.0005', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(399, 3, 1, '19.14.1.0009', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(400, 3, 1, '19.14.1.0011', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(401, 3, 1, '19.14.1.0012', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(402, 3, 1, '19.14.1.0019', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(403, 3, 1, '19.14.1.0022', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(404, 3, 1, '19.14.1.0029', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(405, 3, 1, '19.14.1.0031', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(406, 3, 1, '19.14.1.0034', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(407, 3, 1, '19.14.1.0038', 'Izin', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(408, 3, 1, '19.14.1.0039', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(409, 8, 1, '18.14.1.0001', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(410, 8, 1, '18.14.1.0003', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(411, 8, 1, '18.14.1.0004', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(412, 8, 1, '18.14.1.0007', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(413, 8, 1, '18.14.1.0012', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(414, 8, 1, '18.14.1.0014', 'Sakit', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(415, 8, 1, '18.14.1.0021', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(416, 8, 1, '18.14.1.0027', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(417, 8, 1, '18.14.1.0028', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(418, 8, 1, '18.14.1.0033', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(419, 8, 1, '18.14.1.0034', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(420, 8, 1, '18.14.1.0040', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(421, 8, 1, '18.14.1.0045', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(422, 8, 1, '18.14.1.0046', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(423, 8, 1, '18.14.1.0047', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(424, 8, 1, '18.14.1.0060', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(425, 8, 1, '19.14.1.0001', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(426, 8, 1, '19.14.1.0005', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(427, 8, 1, '19.14.1.0009', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(428, 8, 1, '19.14.1.0011', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(429, 8, 1, '19.14.1.0012', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(430, 8, 1, '19.14.1.0019', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(431, 8, 1, '19.14.1.0022', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(432, 8, 1, '19.14.1.0029', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(433, 8, 1, '19.14.1.0031', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(434, 8, 1, '19.14.1.0034', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(435, 8, 1, '19.14.1.0038', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(436, 8, 1, '19.14.1.0039', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(466, 28, 1, '18.14.1.0003', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(467, 28, 1, '18.14.1.0004', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(468, 28, 1, '18.14.1.0007', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(469, 28, 1, '18.14.1.0012', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(470, 28, 1, '18.14.1.0014', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(471, 28, 1, '18.14.1.0021', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(472, 28, 1, '18.14.1.0027', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(473, 28, 1, '18.14.1.0028', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(474, 28, 1, '18.14.1.0033', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(475, 28, 1, '18.14.1.0034', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(476, 28, 1, '18.14.1.0040', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(477, 28, 1, '18.14.1.0045', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(478, 28, 1, '18.14.1.0046', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(479, 28, 1, '18.14.1.0047', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(480, 28, 1, '18.14.1.0060', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(481, 28, 1, '19.14.1.0001', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(482, 28, 1, '19.14.1.0005', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(483, 28, 1, '19.14.1.0009', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(484, 28, 1, '19.14.1.0011', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(485, 28, 1, '19.14.1.0012', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(486, 28, 1, '19.14.1.0019', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(487, 28, 1, '19.14.1.0022', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(488, 28, 1, '19.14.1.0029', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(489, 28, 1, '19.14.1.0031', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(490, 28, 1, '19.14.1.0034', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(491, 28, 1, '19.14.1.0038', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(492, 28, 1, '19.14.1.0039', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(493, 28, 1, '18.14.1.0001', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(494, 21, 1, '18.14.1.0001', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(495, 21, 1, '18.14.1.0003', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(496, 21, 1, '18.14.1.0004', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(497, 21, 1, '18.14.1.0007', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(498, 21, 1, '18.14.1.0012', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(499, 21, 1, '18.14.1.0014', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(500, 21, 1, '18.14.1.0021', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(501, 21, 1, '18.14.1.0027', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(502, 21, 1, '18.14.1.0028', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(503, 21, 1, '18.14.1.0033', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(504, 21, 1, '18.14.1.0034', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(505, 21, 1, '18.14.1.0040', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(507, 21, 1, '18.14.1.0046', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(508, 21, 1, '18.14.1.0047', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(510, 21, 1, '19.14.1.0001', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(511, 21, 1, '19.14.1.0005', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(512, 21, 1, '19.14.1.0009', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(513, 21, 1, '19.14.1.0011', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(514, 21, 1, '19.14.1.0012', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(515, 21, 1, '19.14.1.0019', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(516, 21, 1, '19.14.1.0022', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(517, 21, 1, '19.14.1.0029', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(518, 21, 1, '19.14.1.0031', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(519, 21, 1, '19.14.1.0034', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(520, 21, 1, '19.14.1.0038', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(521, 21, 1, '19.14.1.0039', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
(566, 18, 1, '19.14.1.0011', 'Hadir', 'Peserta', '2022-12-05 04:22:05', NULL, NULL),
(567, 73, 0, 'PS.22.12.17', 'Hadir', 'Peserta', '2022-12-28 03:36:07', 'FE6yNCjmuRIz25PW8UlgHiXSKQhrfx0pqT1ZA4oYdDsLJw7eb9', 'images/ttd/63abb9a7d5d8a.png'),
(568, 68, 1, '19.17.1.0004', 'Hadir', 'Panitia', '2022-12-12 04:40:00', NULL, NULL),
(569, 73, 0, 'PS.22.12.18', 'Belum Hadir', 'Peserta', '2022-12-16 12:42:25', 'dnhRpG2zJONKc5VD7YLHUjM04W38FevgrPqxsZkilmCQo69aTb', NULL),
(580, 30, 1, '18.14.1.0004', 'Hadir', 'Panitia', '2023-03-13 10:35:29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_biaya_kegiatan`
--

CREATE TABLE `t_biaya_kegiatan` (
  `id_biaya` int(11) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `no_kg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_biaya_kegiatan`
--

INSERT INTO `t_biaya_kegiatan` (`id_biaya`, `jenis`, `nama_item`, `harga`, `volume`, `unit`, `jumlah`, `no_kg`) VALUES
(5, 'pengeluaran', 'Kertas Sertifikat', 0, 0, '', 24600, 18),
(6, 'pengeluaran', 'Print Sertifikat', 1000, 49, 'lembar', 49000, 18),
(7, 'pengeluaran', 'Amplop', 1000, 3, 'pcs', 3000, 18),
(8, 'pengeluaran', 'Copy &amp; Jilid', 0, 0, '', 8000, 18),
(9, 'pengeluaran', 'Konsumsi', 0, 0, '', 54000, 18),
(10, 'pemasukan', 'Pendaftaran peserta E-Sport', 0, 0, '', 1551000, 21),
(11, 'pemasukan', 'Kas HMIF', 0, 0, '', 100000, 21),
(13, 'pengeluaran', 'Pengadaan Proposal', 15000, 1, '', 15000, 21),
(14, 'pengeluaran', 'Pengadaan LPJ', 50000, 1, '', 50000, 21),
(15, 'pengeluaran', 'Sertifikat', 2500, 6, 'lembar', 15000, 21),
(16, 'pengeluaran', 'Map', 1000, 12, 'pcs', 12000, 21),
(17, 'pengeluaran', 'Hadiah Lomba Desain', 0, 3, '', 250000, 21),
(18, 'pengeluaran', 'Hadiah Lomba Vlog', 0, 1, '', 150000, 21),
(19, 'pengeluaran', 'Hadiah E-sport Mobile Legend', 0, 3, '', 600000, 21),
(20, 'pengeluaran', 'Hadiah Hadiah E-Sport PUBG', 0, 3, '', 500000, 21),
(21, 'pengeluaran', 'Banner', 60000, 1, '', 60000, 21),
(22, 'pengeluaran', 'UC PUBG Mobile', 100000, 1, '', 100000, 21);

-- --------------------------------------------------------

--
-- Table structure for table `t_cash_rule`
--

CREATE TABLE `t_cash_rule` (
  `id_cr` int(11) NOT NULL,
  `cash_rule` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_hima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_cash_rule`
--

INSERT INTO `t_cash_rule` (`id_cr`, `cash_rule`, `created_at`, `updated_at`, `id_hima`) VALUES
(1, 'Uang Kas Rp. 10.000 per bulan', '2021-09-17 06:20:45', '2022-07-10 12:30:59', 14),
(2, 'Telat bayar akan di denda Rp 5.000', '2021-09-17 06:21:05', '2021-09-16 23:21:05', 14),
(3, 'Tidak bayar Kas akan ditagih sampai akhir jabatan', '2021-09-17 06:21:17', '2021-09-16 23:21:17', 14),
(4, 'Tidak mengikuti rapat formal tanpa keterangan, akan di denda Rp 20.000', '2021-09-17 06:21:27', '2021-09-16 23:21:27', 14);

-- --------------------------------------------------------

--
-- Table structure for table `t_contact_person`
--

CREATE TABLE `t_contact_person` (
  `id_cp` int(11) NOT NULL,
  `id_hima` int(11) NOT NULL,
  `nama_contact` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_contact_person`
--

INSERT INTO `t_contact_person` (`id_cp`, `id_hima`, `nama_contact`, `no_telp`) VALUES
(1, 14, 'Aditya', '085724553050'),
(2, 14, 'Mita', '085659071287'),
(4, 1, 'IFAN TRI', '083829243548'),
(5, 17, 'RIZKI A18', '089668044635'),
(6, 20, 'DeYud', '083133977231'),
(8, 1, 'Asep M. Junaedi', '081310128361'),
(9, 11, 'AA Rendy', '0895346644437'),
(10, 18, 'Lia', '083162487994'),
(11, 24, 'Anisa', '08889470336'),
(12, 22, 'Pina', '083815174545'),
(13, 23, 'Andre', '085657044377'),
(14, 17, 'Regi', '081214506665');

-- --------------------------------------------------------

--
-- Table structure for table `t_controller`
--

CREATE TABLE `t_controller` (
  `id_ctr` int(11) NOT NULL,
  `nama_controller` varchar(50) NOT NULL,
  `fitur` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_controller`
--

INSERT INTO `t_controller` (`id_ctr`, `nama_controller`, `fitur`) VALUES
(1, 'Admin', 'Menambahkan & Menghapus Admin'),
(2, 'Himpunan', 'Mengedit Informasi Himpunan, \r\nMenambah dan Menghapus nomor kontak Yang dapat dihubungi (contact person).'),
(3, 'Jabatan', 'Pengelolaan data jabatan.'),
(4, 'Anggota', 'Pengelolaan data anggota pengurus.'),
(5, 'Kegiatan', 'Pengelolaan informasi kegiatan.'),
(6, 'Kategori', '(index) kategori postingan (Input, Update, Delete)'),
(7, 'Post', 'Pengelolaan data postingan himpunan.'),
(8, 'Keuangan', 'Pengelolaan Rincian Anggaran Biaya, data Pemasukan, dan data Pengeluaran kas himpunan.'),
(9, 'Pengurus', '(index) anggota pengurus,'),
(10, 'Dashboard', 'Read Doang'),
(11, 'Kprodi', 'Mengaktifkan Masa Jabatan.'),
(12, 'Absen', 'Pengelolaan data absensi dan scan QR-code.'),
(13, 'Report', 'Membuat file PDF laporan kegiatan, absensi, rincian anggaran biaya, pemasukan dan pengeluaran keuangan.'),
(14, 'Tagihan', 'Manajemen Tagihan dan Pembayaran'),
(15, 'Biaya_kegiatan', 'insert pemasukan, insert pengeluaran, & delete item pemasukan/pengeluaran.'),
(16, 'Dokumentasi', 'menambah dan menghapus dokumentasi kegiatan.'),
(17, 'Pembayaran', 'input data bayar, dan hapus data'),
(18, 'Tagihan_anggota', 'detail_tagihan, input_tagihan_pengurus, i_tagihan_anggota_lainnya, delete_tagihan_anggota'),
(19, 'Cash_rule', 'Insert - Update - Delete');

-- --------------------------------------------------------

--
-- Table structure for table `t_dokumentasi`
--

CREATE TABLE `t_dokumentasi` (
  `id_dk` int(11) NOT NULL,
  `no_kg` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `caption` varchar(50) NOT NULL,
  `id_mahasiswa_pt` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_dokumentasi`
--

INSERT INTO `t_dokumentasi` (`id_dk`, `no_kg`, `image`, `caption`, `id_mahasiswa_pt`) VALUES
(6, 18, 'IMG-20210206-WA0009.jpg', 'Panitia', '18.14.1.0001'),
(8, 18, 'c205a3ad8d415010c63dd122490c5922.jpg', 'Peserta pesona', '18.14.1.0001'),
(9, 18, '740f767556e52bbbf5598bc619b043f6.jpg', 'Panitia sekaligus peserta', '18.14.1.0003');

-- --------------------------------------------------------

--
-- Table structure for table `t_hima`
--

CREATE TABLE `t_hima` (
  `id_hima` int(11) NOT NULL,
  `kode_prodi` varchar(5) NOT NULL,
  `kode_fak` varchar(2) NOT NULL,
  `nama_hima` varchar(100) NOT NULL,
  `singkatan` varchar(50) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `tempat_sekre` varchar(100) DEFAULT NULL,
  `status_hima` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_hima`
--

INSERT INTO `t_hima` (`id_hima`, `kode_prodi`, `kode_fak`, `nama_hima`, `singkatan`, `logo`, `tempat_sekre`, `status_hima`) VALUES
(1, '01', '1', 'Himpunan Mahasiswa Program Studi Administrasi Publik', 'HMPS AP', '1.png', 'Gedung FISIP Lantai 3', '1'),
(3, '03', '2', 'Himpunan Mahasiswa Bahasa Indonesia', 'HIMABSI', '7.jpg', 'Kampus 2 UNMA, Gedung FKIP 3, Lantai 2', '1'),
(4, '04', '2', 'Himpunan Mahasiswa PJKR', 'HIMA PJKR', '8.jpg', '', '1'),
(5, '05', '3', 'Himpunan Mahasiswa Manajemen', 'HIMAMEN', 'maajemen.PNG', 'Gedung FEB UNMA', '1'),
(6, '06', '3', 'Himpunan Mahasiswa Akuntansi', 'HIMAKU', 'akuntansi.JPG', 'Gedung FEB UNMA', '1'),
(7, '07', '4', 'Himpunan Mahasiswa Agroteknologi', 'HIMAGROTEK', '6.jpg', '', '1'),
(8, '08', '4', 'Himpunan Mahasiswa Agribisnis', 'HIMAGRI', '71.jpg', '', '0'),
(9, '09', '4', 'Himpunan Mahasiswa Peternakan', 'HIMMAPET', '8.png', '', '0'),
(10, '10', '5', 'Himpunan Mahasiswa Pendidikan Agama Islam', 'HIMA PAI', '19.jpg', 'Gedung FAI, Lantai 2', '1'),
(11, '11', '3', 'Himpunan Mahasiswa Ekonomi Syariah', 'HIMA EKSYAR', '15.png', 'Gedung FAI, Lantai 2', '1'),
(12, '12', '5', 'Himpunan Mahasiswa PIAUD', 'HIMA PIAUD', '11.png', '', '0'),
(14, '14', '6', 'Himpunan Mahasiswa Informatika', 'HMIF', 'HMIF.png', 'Gedung Fakultas Teknik Lantai 3', '0'),
(15, '15', '6', 'Himpunan Mahasiswa Sipil', 'HMS', 'sipil.png', 'Gedung Fakultas Teknik Lantai 3', '1'),
(16, '16', '6', 'Himpunan Mahasiswa Mesin', 'HMM', 'mesin1.png', 'Gedung Fakultas Teknik Lantai 3', '1'),
(17, '17', '6', 'Himpunan Mahasiswa Teknik Industri', 'HMTI', 'industri.jpg', 'Gedung Fakultas Teknik Lantai 3', '1'),
(18, '18', '1', 'Himpunan Mahasiswa Program Studi Ilmu Komunikasi', 'HMPS ILKOM', '16.png', 'Gedung FISIP Lantai 3', '0'),
(20, '20', '2', 'Himpunan Mahasiswa Pendidikan Bahasa Inggris', 'HIMASI', 'Untitled.png', '', '0'),
(21, '21', '7', 'Himpunan Mahasiswa Hukum', 'HIMAKUM', NULL, '', '0'),
(22, '22', '2', 'Himpunan Mahasiswa Program Studi PGSD', 'HMPS-PGSD', '191.jpg', 'Kampus 2 UNMA, Gedung FKIP 3, Lantai 2', '0'),
(23, '23', '2', 'Himpunan Mahasiswa Pendidikan Matematika', 'HIMAPTIKA', '11.jpg', 'Kampus 2 UNMA, Gedung FKIP 3, Lantai 2', '1'),
(24, '24', '2', 'Himpunan Mahasiswa Pendidikan Biologi', 'HIMABIO', '12.jpg', 'Kampus 2 UNMA, Gedung FKIP 3, Lantai 2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `t_jabatan`
--

CREATE TABLE `t_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_jabatan`
--

INSERT INTO `t_jabatan` (`id_jabatan`, `jabatan`, `level`) VALUES
(2, 'Ketua Himpunan', 3),
(3, 'Wakil Ketua', 3),
(4, 'Sekretaris 1', 4),
(5, 'Sekretaris 2', 4),
(6, 'Bendahara 1', 5),
(7, 'Bendahara 2', 5),
(8, 'Koordinator Ristek', 6),
(9, 'Koordinator PSDM', 6),
(10, 'Koordinator SKM', 6),
(11, 'Koordinator Kwu', 6),
(12, 'Koordinator Kominfo', 6),
(13, 'Anggota Divisi Ristek', 6),
(14, 'Anggota Divisi PSDM', 6),
(15, 'Anggota Divisi SKM', 6),
(16, 'Anggota Divisi Kwu', 6),
(17, 'Anggota Divisi Kominfo', 6),
(21, 'Advokat', 6),
(22, 'Koordinator Dep. LitBang', 6),
(23, 'Anggota Dep. LitBang', 6),
(24, 'Koordinator Dep. Eksternal', 6),
(25, 'Anggota Dep. Eksternal', 6),
(26, 'Koordinator Dep. Danus', 6),
(27, 'Anggota Dep. Danus', 6);

-- --------------------------------------------------------

--
-- Table structure for table `t_kaprodi`
--

CREATE TABLE `t_kaprodi` (
  `id` int(11) NOT NULL,
  `id_dosen` varchar(5) NOT NULL,
  `nama_kaprodi` varchar(50) NOT NULL,
  `kode_prodi` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kaprodi`
--

INSERT INTO `t_kaprodi` (`id`, `id_dosen`, `nama_kaprodi`, `kode_prodi`) VALUES
(1, '201', 'ADE BASTIAN', '14');

-- --------------------------------------------------------

--
-- Table structure for table `t_kategori`
--

CREATE TABLE `t_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kategori`
--

INSERT INTO `t_kategori` (`id_kategori`, `nama_kategori`, `slug`) VALUES
(1, 'Kunjungan', 'kunjungan'),
(2, 'Perlombaan ', 'perlombaan'),
(3, 'Pelatihan', 'pelatihan'),
(4, 'Sosialisasi', 'sosialisasi'),
(5, 'Seminar', 'seminar'),
(6, 'Laporan', 'laporan'),
(7, 'Artikel', 'artikel'),
(8, 'Berita', 'berita'),
(9, 'Lainnya', 'lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `t_kegiatan`
--

CREATE TABLE `t_kegiatan` (
  `no_kegiatan` int(11) NOT NULL,
  `tgl_kegiatan` date DEFAULT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `sifat_kegiatan` enum('Langsung','Online','Hybrid','') NOT NULL,
  `lingkup` enum('Pengurus','Program Studi','Fakultas','Universitas Majalengka','Umum') NOT NULL,
  `mulai` datetime DEFAULT NULL,
  `selesai` datetime DEFAULT NULL,
  `mulai_absensi` datetime DEFAULT NULL,
  `selesai_absensi` datetime DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `id_mj` int(11) NOT NULL,
  `pengesahan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kegiatan`
--

INSERT INTO `t_kegiatan` (`no_kegiatan`, `tgl_kegiatan`, `nama_kegiatan`, `tempat`, `sifat_kegiatan`, `lingkup`, `mulai`, `selesai`, `mulai_absensi`, `selesai_absensi`, `deskripsi`, `id_mj`, `pengesahan`) VALUES
(1, '2020-09-30', 'Rapat Internal Pembagian Koordinator dan Pembahasan Rundown perekrutan anggota pengurus baru', 'Sekretariat HIMA FT', 'Langsung', 'Pengurus', NULL, NULL, NULL, NULL, '', 1, NULL),
(3, '2020-10-17', 'SKM : BanSos Banjir Garut Selatan', 'Majalengka', 'Langsung', 'Pengurus', NULL, NULL, NULL, NULL, '', 1, NULL),
(4, '2020-10-10', 'Wawancara Calon Pengurus Himatif Periode 2020/2021', 'Sekretariat HIMA FT', 'Langsung', 'Program Studi', NULL, NULL, NULL, NULL, '<div>.</div>', 1, NULL),
(5, '2020-10-13', 'Interview Calon Pengurus HMIF Periode 2020/2021 dan Rapat pembahasan penyambutan mahasiswa baru', 'Sekretariat HIMA FT', 'Langsung', 'Pengurus', NULL, NULL, NULL, NULL, '', 1, NULL),
(7, '2020-10-14', 'Penyambutan Mahasiswa Baru', 'Fakultas Teknik', 'Langsung', 'Pengurus', NULL, NULL, NULL, NULL, '', 1, NULL),
(8, '2020-11-13', 'Rakor dan Rapat Kepanitiaan Pesona HMIF', 'Ruang 314 Gedung FT', 'Langsung', 'Pengurus', NULL, NULL, NULL, NULL, '', 1, NULL),
(18, '2021-02-06', 'PESONA HMIF 2020', 'Zoom', 'Online', 'Program Studi', '2021-02-06 08:00:00', '2021-02-06 14:00:00', '2021-02-06 11:45:00', '2021-02-06 12:00:00', '<div><strong>LATAR BELAKANG<br></strong><br>Untuk menciptakan rasa kekeluargaan dan kebersamaan sesama mahasiswa, khususnya mahasiswa Informatika yang berada di Universitas Majalengka, maka dibutuhkan suatu wadah yang mampu untuk mewujudkannya. HMIF (Himpunan Mahasiswa Informatika) di sini merupakan suatu wadah / organisasi yang mampu dan mempunyai program kerja untuk mewujudkan dan melaksanakan hal tersebut. Kegiatan Pesona HMIF ini merupakan suatu perkenalan sesama orang Informatika Universitas Majalengka, mendekatkan diri dan mengenalkan organisasi Himpunan Mahasiswa Informatika. Dalam kegiatan ini suasana budaya Informatika dan keakraban sesama mahasiswa dari Informatika dapat merasakannya, terlebih mahasiswa angkatan baru. Dengan kegiatan ini, mahasiswa Informatika diharapkan akan memiliki citacita, jiwa dan semangat belajar yang tinggi dengan tetap mengingat jati dirinya sebagai putra-putri generasi penerus Informatika. Semakin majunya Iptek diharapkan tidak membuat generasi-generasi Informatika lupa akan Tuhan Yang Maha Esa dan kebudayaan leluhur Majalengka sehingga terciptalah mahasiswa Informatika yang tinggi ilmu, tinggi budaya, dan tinggi iman.<br><br><strong>MAKSUD DAN TUJUAN<br></strong>&nbsp;<br>1. Terjalinnya rasa kebersamaan, kekeluargaan dan keakraban antar sesama mahasiswa Informatika. <br>2. Meningkatkan rasa kebersamaan, kekeluargaan dan keakraban antar sesama mahasiswa Informatika. <br>3. Mengenal Himpunan Mahasiswa Informatika yang selanjutnya <br>4. Menjadi wadah untuk berkumpul, belajar dan berbudaya.<br><br><strong>NAMA KEGIATAN<br></strong>&nbsp;<br>”Pengenalan Studi dan Organisasi Himpunan Mahasiswa Informatika (PESONA HMIF) 2020”.<br><br><strong>TEMA KEGIATAN<br></strong><br><em>”Menciptakan Rasa Kekeluargaan Antar sesama Mahasiswa Informatika</em>”.<br><br><strong>SASARAN</strong>&nbsp;<br><br>Mahasiswa semester 1 dan mahasiswa yang belum pernah ikut serta dalam kegiatan PESONA HMIF.<br><br></div>', 1, '969949f7f1b6af77947a152e2a480f3b.pdf'),
(21, '2021-04-29', 'HMIF CUP - DIES NATALIS HMIF yang ke-10', 'Zoom', 'Langsung', 'Umum', '2021-04-29 10:00:00', '2021-05-01 16:30:00', NULL, NULL, '<div><strong>LATAR BELAKANG<br></strong><br>Peringatan hari lahir (Dies Natalis) dalam sejumlah besar budaya dianggap sebagai peristiwa penting yang menandai awal perjalanan kehidupan, karena itu, biasanya peringatan tersebut dirayakan dengan penuh syukur dan kebahagiaan. Bertambahnya usia selalu dibarengi dengan pengharapan akan makin bertambahnya kedewasaan. Tidak hanya bagi manusia, pertambahan usia bagi organisasi pun selalu dikaitkan dengan tingkat kedewasaan. Apalagi bagi sebuah perguruan tinggi yang punya fungsi utama melahirkan para ilmuwan akademisi yang berkualitas. <br>Bagi Himpunan Mahasiswa Informatika Universitas Majalengka (HMIF UNMA), Dies Natalis mempunyai makna penting bukan hanya sebagai penanda bertambahnya usia, tapi juga penanda tingkat kedewasaan dalam berkarya. Keberadaan HMIF UNMA yang sudah menginjak Usia 10 tahun, menjadi bukti bahwa HMIF UNMA mempunyai daya tarik sehingga mampu bertahan sampai sekarang. <br>Dies natalis HMIF UNMA seharusnya menjadi momentum untuk menguatkan komitmen akan perubahan demi kemajuan .Perlu ada penegasan tentang upayaupaya yang harus dilakukan sebagai bagian dari resolusi ulang tahun. Tidak ada salahnya merayakan Dies Natalis dengan kegiatan HMIF CUP sebagai perayaan dan rasa syukur kepada Allah SWT yang mana atas pencapaian yang telah diraih. Bentuk kegiatan HMIF CUP ini adalah sebuah perlombaan yang terdiri dari perlombaan desain grafis dan membuat video berupa vlog yang berisi ucapan ulang tahun HMIF UNMA yang ke-10 serta lomba E-sport berupa game mobile yaitu Mobile Legend (ML), dan PUBG.<br>Dengan adanya kegiatan perlombaan tersebut diharapkan dapat meningkatkan bakat, kreatifitas dan produktifitas serta dapat menjadi ajang perkenalan kampus kepada para peserta, sebagai daya tarik para peserta untuk berkuliah di Universitas Majalengka, Fakultas Teknik terkhusus Prodi Informatika.<br><br> <strong>MAKSUD DAN TUJUAN<br><br></strong>Dengan adanya kegiatan tersebut diharapkan dapat mencapai tujuan : <br>1. Salah satu program kerja Himpuan Mahasiswa Informatika; <br>2. Bukti Rasa syukur atas hari jadi HMIF UNMA yang ke-10; <br>3. Untuk meningkatkan bakat, kreatifitas dan produktifitas para peserta; <br>4. Untuk Menarik minat para peserta ke Informatikaan;<br><br><strong>NAMA KEGIATAN<br></strong><br>”HMIF CUP”<br><br><strong>TEMA KEGIATAN<br><br></strong><em>”Dies Natalis HMIF yang ke-10</em>”<br><br><strong>SASARAN</strong>&nbsp;<br><br>Kegiatan HMIF CUP ini, sasaran nya untuk pelajar dan umum. Bagi pelajar untuk sewilayah Kab.Majalengka dan untuk umum mencakup luar wilayah Kab.Majalengka.<br><br></div>', 1, NULL),
(23, '2021-05-08', 'HMIF Peduli', 'Majalengka', 'Langsung', 'Pengurus', NULL, NULL, NULL, NULL, '<div>.</div>', 1, NULL),
(25, '2021-03-27', 'PROGRESSMA 2021', 'Auditorium', 'Langsung', 'Program Studi', '2021-03-27 07:30:00', '2021-03-27 14:30:00', '2021-03-27 07:30:00', '2021-03-27 14:30:00', '<div style=\"text-align: justify;\">Untuk melaksanakan dan menunjang kegiatan Kunjungan Industri, Program Studi Informatika FT-UNMA, akan mengadakan kegiatan ilmiah berupa meningkatkan kompetensi mahasiswa dengan nama acara &#8220;PROGRAM MENINGKATKAN KOMPETENSI MAHASISWA INFORMATIKA 2021&#8221; atau bisa di singkat &#8220;PROGRESMA&#8221;.</div>\r\n<div style=\"text-align: justify;\">\r\n<p>&#160;</p>\r\n<p><strong>MAKSUD DAN TUJUAN</strong></p>\r\n<p>Dengan adanya kegiatan diluar kampus dengan bidang industri dan instansi pendidikan tinggi ini, maka kegiatan PROGRESMA 2021 diharapkan akan dapat mencapai tujuan :</p>\r\n<p>1. Menjalin hubungan dan kerjasama yang erat antara Fakultas Teknik Program Studi Informatika dengan pihak industri yang dituju.</p>\r\n<p>2. Menjadi media pembelajaran bagi mahasiswa Informatika untuk mengetahui fakta dan aplikasi teknologi sistem informasi di dunia industri, yang sinergis dengan ilmu pengetahuan dan teknologi yang didapatkan di bangku kuliah.</p>\r\n</div>', 1, NULL),
(26, '2021-08-28', 'Presentasi Peserta PROGRESMA 2021', 'Ruang 303 Gedung FT', 'Langsung', 'Program Studi', NULL, NULL, NULL, NULL, '<div>.</div>', 1, NULL),
(28, '2021-09-24', 'PKKMB 2021/2022', 'Fakultas Teknik', 'Langsung', 'Pengurus', NULL, NULL, NULL, NULL, '', 1, NULL),
(30, '2021-10-23', 'MUSHMIF yang Ke-6', 'Ruang 301-302 Gedung FT', 'Langsung', 'Program Studi', NULL, NULL, NULL, NULL, '<div>.</div>', 1, NULL),
(55, '2022-07-26', 'MAKRAB', 'Ruang 301-302', 'Langsung', 'Fakultas', '2022-07-26 19:00:00', '2022-07-26 20:00:00', NULL, NULL, '<div>.</div>', 33, NULL),
(68, '2022-09-23', 'SEMINAR INDUSTRI 5.0', 'Auditorium', 'Langsung', 'Umum', '2022-09-23 08:00:00', '2022-09-23 12:00:00', '2022-09-23 08:00:00', '2022-09-23 12:00:00', '<p>deskripsi kegiatan</p>', 33, NULL),
(69, '2022-08-23', 'LOMBA DESAIN PERHOTELAN', 'Gedung Fakultas Teknik Ruang 305', 'Hybrid', 'Umum', '2022-08-22 08:00:00', '2022-08-22 14:00:00', '2022-08-22 08:00:00', '2022-08-22 14:00:00', '<p>deskripsi kegiatan</p>', 31, NULL),
(73, '2022-12-29', 'Seminar Industri 6.0', 'Auditorium', 'Hybrid', 'Umum', '2022-12-28 08:00:00', '2022-12-28 14:00:00', '2022-12-28 08:00:00', '2022-12-28 12:00:00', '.......', 33, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_mahasiswa`
--

CREATE TABLE `t_mahasiswa` (
  `id` int(11) NOT NULL,
  `id_mhs` varchar(10) DEFAULT NULL,
  `id_mahasiswa_pt` varchar(20) NOT NULL,
  `nama_mhs` varchar(50) DEFAULT NULL,
  `kode_prodi` varchar(2) NOT NULL,
  `is_admin` int(1) NOT NULL DEFAULT 0,
  `no_hp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_mahasiswa`
--

INSERT INTO `t_mahasiswa` (`id`, `id_mhs`, `id_mahasiswa_pt`, `nama_mhs`, `kode_prodi`, `is_admin`, `no_hp`) VALUES
(1, '180137', '18.14.1.0001', 'ANDI ALFIAN', '14', 1, '082320516254'),
(2, '180321', '18.14.1.0007', 'AFIF SURYA RAMADHAN', '14', 0, NULL),
(3, '180069', '18.14.1.0003', 'MUHAMAD HIKAYAT', '14', 0, NULL),
(4, '180369', '18.14.1.0012', 'DEDE RISKA AMALIA', '14', 0, NULL),
(5, '180297', '18.14.1.0014', 'IRNA SRI NULINGGA', '14', 0, NULL),
(6, '180309', '18.14.1.0021', 'SANDRA MARLIANTI MULYANA', '14', 0, NULL),
(7, '180653', '18.14.1.0034', 'FAUZAN FATURAHMAN AZKIA', '14', 0, NULL),
(8, '180818', '18.14.1.0040', 'MOCHAMMAD BAGASNANDA FIRMANSYAH', '14', 0, NULL),
(9, '180742', '18.14.1.0046', 'FIRMAN ABDUL ZAELANI', '14', 0, NULL),
(10, '181242', '18.14.1.0047', 'MEGA BERLIANI', '14', 0, NULL),
(11, '180364', '18.14.1.0060', 'RAIHAN WIDIYANSYAH NUR', '14', 0, NULL),
(12, '180099', '18.14.1.0004', 'RIZKI ALAM RAMDHANI', '14', 0, NULL),
(13, '180652', '18.14.1.0027', 'DEA JUWITA SUWARDI', '14', 0, NULL),
(14, '180741', '18.14.1.0033', 'DELIA PUTRI RAHAYU', '14', 0, NULL),
(15, '181048', '18.14.1.0045', 'AULA NUR RIZAL ARDIYANTORO', '14', 0, NULL),
(16, '190118', '19.14.1.0001', 'AA HERDI PRAYOGA', '14', 0, NULL),
(17, '190253', '19.14.1.0002', 'RIDWAN KURNIAWARDANA', '14', 0, NULL),
(18, '190312', '19.14.1.0005', '	ALAN AGUS NAWAN', '14', 0, NULL),
(19, '190480', '19.14.1.0009', 'MITA KARMILA', '14', 0, NULL),
(20, '190404', '19.14.1.0011', 'NINDI SEPTIANI', '14', 0, NULL),
(21, '190638', '19.14.1.0012', 'RIFA NURFALAH', '14', 0, NULL),
(22, '190779', '19.14.1.0019', 'MITHA MAR\'ATUL QIBTIYAH', '14', 0, NULL),
(23, '191135', '19.14.1.0022', 'CHIKA ANISA HIDAYATI', '14', 0, NULL),
(24, '191177', '19.14.1.0029', 'INDAH LATIFATUN NISSA', '14', 0, NULL),
(25, '191309', '19.14.1.0031', 'DEDE DIDIN', '14', 0, NULL),
(26, '191144', '19.14.1.0034', 'ADITYA NURSAIDILLAH', '14', 0, NULL),
(27, '190828', '19.14.1.0038', 'DENI PRIYADI', '14', 0, NULL),
(28, '191412', '19.14.1.0039', 'IID MUIZ AWALUDIN', '14', 0, NULL),
(38, '180979', '18.14.1.0028', 'ABDULLAH TAUFIK', '14', 0, NULL),
(47, '180176', '18.14.1.0002', 'HARIS SAKURUDIN', '14', 0, NULL),
(50, '180507', '18.14.1.0011', 'CECEP MAUDA', '14', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_masa_jabatan`
--

CREATE TABLE `t_masa_jabatan` (
  `id_mj` int(11) NOT NULL,
  `id_hima` int(11) NOT NULL,
  `periode1` int(11) NOT NULL,
  `periode2` int(11) NOT NULL,
  `sk` varchar(255) DEFAULT NULL,
  `tgl_awal` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `status_mj` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_masa_jabatan`
--

INSERT INTO `t_masa_jabatan` (`id_mj`, `id_hima`, `periode1`, `periode2`, `sk`, `tgl_awal`, `tgl_akhir`, `status_mj`) VALUES
(1, 14, 2020, 2021, 'SK_HMIF-1.pdf', '2021-01-20', '2021-10-23', 1),
(2, 14, 2019, 2020, NULL, '0000-00-00', '0000-00-00', 0),
(8, 14, 2018, 2019, NULL, '0000-00-00', '0000-00-00', 0),
(10, 14, 2017, 2018, '', '0000-00-00', '0000-00-00', 0),
(30, 14, 2021, 2022, '', '0000-00-00', '0000-00-00', 0),
(31, 15, 2020, 2021, '', '0000-00-00', '0000-00-00', 1),
(32, 17, 2020, 2021, '', '0000-00-00', '0000-00-00', 0),
(33, 17, 2021, 2022, '', '0000-00-00', '0000-00-00', 0),
(34, 1, 2022, 2023, '', '2022-10-31', '2023-08-31', 1),
(35, 11, 2022, 2023, '', '2022-10-31', '2023-08-31', 1),
(36, 18, 2022, 2023, '', '2022-10-31', '2023-08-31', 1),
(37, 24, 2022, 2023, '', '2022-10-31', '2023-08-31', 1),
(38, 22, 2022, 2023, '', '2022-10-31', '2023-08-31', 1),
(39, 23, 2022, 2023, '', '2022-10-31', '2023-08-31', 1),
(40, 17, 2022, 2023, '', '2022-10-31', '2023-08-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_menu_access`
--

CREATE TABLE `t_menu_access` (
  `id` int(11) NOT NULL,
  `level` int(1) NOT NULL,
  `id_ctr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_menu_access`
--

INSERT INTO `t_menu_access` (`id`, `level`, `id_ctr`) VALUES
(1, 1, 1),
(18, 3, 2),
(23, 3, 3),
(24, 3, 4),
(25, 3, 5),
(28, 4, 5),
(30, 5, 8),
(33, 1, 10),
(34, 3, 10),
(35, 4, 7),
(36, 4, 10),
(37, 5, 10),
(38, 6, 10),
(39, 7, 10),
(40, 8, 10),
(42, 6, 9),
(46, 1, 9),
(49, 3, 9),
(52, 6, 7),
(53, 7, 9),
(54, 5, 9),
(55, 5, 7),
(56, 4, 9),
(57, 1, 3),
(58, 2, 11),
(59, 2, 10),
(60, 2, 3),
(61, 2, 4),
(62, 1, 4),
(63, 1, 5),
(64, 1, 8),
(65, 1, 7),
(66, 1, 2),
(67, 1, 12),
(68, 3, 12),
(69, 4, 12),
(70, 1, 11),
(71, 1, 13),
(72, 2, 13),
(73, 3, 13),
(74, 4, 13),
(75, 5, 13),
(76, 6, 13),
(77, 7, 13),
(78, 8, 13),
(79, 1, 14),
(80, 5, 14),
(81, 4, 15),
(82, 3, 15),
(83, 6, 16),
(85, 5, 15),
(86, 5, 16),
(87, 4, 16),
(88, 3, 16),
(89, 1, 17),
(90, 5, 17),
(91, 5, 18),
(92, 5, 19),
(93, 1, 20),
(100, 1, 16),
(101, 1, 18),
(102, 1, 15),
(103, 1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `t_pemasukan`
--

CREATE TABLE `t_pemasukan` (
  `no_pm` int(11) NOT NULL,
  `tgl_pm` date NOT NULL,
  `nama_pemasukan` varchar(100) NOT NULL,
  `sumber` varchar(100) NOT NULL,
  `jml_pm` int(11) NOT NULL,
  `id_mj` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pemasukan`
--

INSERT INTO `t_pemasukan` (`no_pm`, `tgl_pm`, `nama_pemasukan`, `sumber`, `jml_pm`, `id_mj`) VALUES
(3, '2020-10-13', 'UANG PKKMB', 'PAK DONA', 25000, 1),
(4, '2020-10-17', 'DANA AWAL', 'HMIF PERIODE 2019/2020', 500000, 1),
(5, '2021-03-27', 'DANA SAVING', 'SENAT FAKULTAS TEKNIK', 1000000, 1),
(6, '2021-06-20', 'SISA UANG HMIF PEDULI', 'TAMU UNDANGAN', 130500, 1),
(7, '2021-06-20', 'SISA UANG HIMA GATHERING', 'PESERTA KEGIATAN', 43500, 1),
(8, '2021-08-16', 'SISA UANG PROGRESSMA', 'REGISTRASI PESERTA', 1182000, 1),
(9, '2021-10-21', 'UANG SISA KEMEJA (KWU)', 'Mahasiswa IF', 225000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_pembayaran`
--

CREATE TABLE `t_pembayaran` (
  `no_pb` int(11) NOT NULL,
  `no_ta` varchar(11) DEFAULT NULL,
  `nominal_bayar` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembayaran`
--

INSERT INTO `t_pembayaran` (`no_pb`, `no_ta`, `nominal_bayar`, `tgl_bayar`) VALUES
(1, '3', 10000, '2020-11-29'),
(2, '1', 10000, '2020-11-29'),
(3, '2', 10000, '2020-11-29'),
(4, '6', 10000, '2020-11-29'),
(5, '8', 10000, '2020-11-29'),
(6, '4', 10000, '2020-11-29'),
(7, '5', 10000, '2020-11-29'),
(8, '9', 10000, '2020-11-29'),
(9, '14', 10000, '2020-11-29'),
(10, '11', 10000, '2020-11-29'),
(11, '10', 10000, '2020-11-29'),
(12, '13', 10000, '2020-11-29'),
(13, '15', 10000, '2020-11-29'),
(14, '12', 10000, '2020-11-29'),
(15, '16', 10000, '2020-11-29'),
(16, '7', 10000, '2020-11-29'),
(17, '17', 10000, '2020-11-29'),
(18, '19', 10000, '2020-11-29'),
(19, '21', 10000, '2020-11-29'),
(20, '20', 10000, '2020-11-29'),
(21, '22', 10000, '2020-11-29'),
(22, '23', 10000, '2020-11-29'),
(23, '25', 10000, '2020-11-29'),
(24, '27', 10000, '2020-11-29'),
(25, '28', 10000, '2020-11-29'),
(26, '26', 10000, '2020-11-29'),
(27, '24', 10000, '2020-11-29'),
(29, '30', 10000, '2020-12-30'),
(30, '31', 10000, '2020-12-30'),
(31, '32', 10000, '2020-12-30'),
(32, '33', 10000, '2020-12-30'),
(33, '34', 10000, '2020-12-30'),
(34, '35', 10000, '2020-12-30'),
(35, '36', 10000, '2020-12-30'),
(36, '37', 10000, '2020-12-30'),
(37, '38', 10000, '2020-12-30'),
(38, '39', 10000, '2020-12-30'),
(39, '40', 10000, '2020-12-30'),
(40, '41', 10000, '2020-12-30'),
(41, '43', 10000, '2020-12-30'),
(42, '44', 10000, '2020-12-30'),
(43, '46', 10000, '2020-12-30'),
(44, '47', 10000, '2020-12-30'),
(45, '48', 10000, '2020-12-30'),
(46, '49', 10000, '2020-12-30'),
(47, '50', 10000, '2020-12-30'),
(48, '51', 10000, '2020-12-30'),
(49, '52', 10000, '2020-12-30'),
(50, '53', 10000, '2020-12-30'),
(51, '54', 10000, '2020-12-30'),
(52, '55', 10000, '2020-12-30'),
(53, '56', 10000, '2020-12-30'),
(54, '57', 10000, '2020-12-30'),
(55, '58', 10000, '2021-01-31'),
(56, '59', 10000, '2021-01-31'),
(57, '60', 10000, '2021-01-31'),
(58, '61', 10000, '2021-01-31'),
(59, '62', 10000, '2021-01-31'),
(60, '63', 10000, '2021-01-31'),
(61, '64', 10000, '2021-01-31'),
(62, '65', 10000, '2021-01-31'),
(63, '66', 10000, '2021-01-31'),
(64, '67', 10000, '2021-01-31'),
(65, '68', 10000, '2021-01-31'),
(66, '69', 10000, '2021-01-31'),
(67, '71', 10000, '2021-01-31'),
(68, '72', 10000, '2021-01-31'),
(69, '74', 10000, '2021-01-31'),
(70, '75', 10000, '2021-01-31'),
(71, '76', 10000, '2021-01-31'),
(72, '77', 10000, '2021-01-31'),
(73, '78', 10000, '2021-01-31'),
(74, '79', 10000, '2021-01-31'),
(75, '80', 10000, '2021-01-31'),
(76, '81', 10000, '2021-01-31'),
(77, '82', 10000, '2021-01-31'),
(78, '83', 10000, '2021-01-31'),
(79, '84', 10000, '2021-01-31'),
(80, '85', 10000, '2021-01-31'),
(81, '86', 10000, '2021-02-24'),
(82, '87', 10000, '2021-02-24'),
(83, '88', 10000, '2021-02-24'),
(84, '89', 10000, '2021-02-24'),
(85, '90', 10000, '2021-02-24'),
(86, '91', 10000, '2021-02-24'),
(87, '92', 10000, '2021-02-24'),
(88, '93', 10000, '2021-02-24'),
(89, '94', 10000, '2021-02-24'),
(90, '95', 10000, '2021-02-24'),
(91, '96', 10000, '2021-02-24'),
(92, '97', 10000, '2021-02-24'),
(93, '99', 10000, '2021-02-24'),
(94, '100', 10000, '2021-02-24'),
(95, '102', 10000, '2021-02-24'),
(96, '103', 10000, '2021-02-24'),
(97, '104', 10000, '2021-02-24'),
(98, '105', 10000, '2021-02-24'),
(99, '106', 10000, '2021-02-24'),
(100, '107', 10000, '2021-02-24'),
(101, '108', 10000, '2021-02-24'),
(102, '109', 10000, '2021-02-24'),
(103, '110', 10000, '2021-02-24'),
(104, '111', 10000, '2021-02-24'),
(105, '112', 10000, '2021-02-24'),
(106, '113', 10000, '2021-02-24'),
(109, '116', 10000, '2021-03-26'),
(110, '117', 10000, '2021-03-26'),
(111, '118', 10000, '2021-03-26'),
(112, '119', 10000, '2021-03-26'),
(113, '120', 10000, '2021-03-27'),
(114, '142', 10000, '2021-04-30'),
(115, '121', 10000, '2021-03-05'),
(116, '122', 10000, '2021-03-05'),
(117, '123', 10000, '2021-03-05'),
(118, '124', 10000, '2021-03-05'),
(119, '125', 10000, '2021-03-05'),
(120, '130', 10000, '2021-03-05'),
(121, '127', 10000, '2021-03-05'),
(122, '128', 10000, '2021-03-05'),
(123, '131', 10000, '2021-03-05'),
(124, '132', 10000, '2021-03-05'),
(125, '133', 10000, '2021-03-05'),
(126, '134', 10000, '2021-03-05'),
(127, '135', 10000, '2021-03-05'),
(128, '137', 10000, '2021-03-05'),
(129, '136', 10000, '2021-03-05'),
(130, '138', 10000, '2021-03-05'),
(131, '139', 10000, '2021-03-05'),
(132, '140', 10000, '2021-03-05'),
(133, '141', 10000, '2021-03-05'),
(134, '277', 10000, '2021-07-08'),
(136, '169', 10000, '2021-05-15'),
(137, '143', 10000, '2021-04-12'),
(138, '144', 10000, '2021-04-12'),
(139, '145', 10000, '2021-04-12'),
(140, '146', 10000, '2021-04-12'),
(141, '147', 10000, '2021-04-12'),
(143, '171', 10000, '2021-05-12'),
(144, '148', 10000, '2021-04-12'),
(145, '149', 10000, '2021-04-12'),
(146, '150', 10000, '2021-04-12'),
(147, '151', 10000, '2021-04-12'),
(148, '152', 10000, '2021-04-12'),
(149, '153', 10000, '2021-04-12'),
(150, '197', 10000, '2021-06-12'),
(153, '114', 10000, '2021-03-22'),
(154, '115', 10000, '2021-03-22'),
(155, '154', 10000, '2021-04-22'),
(156, '155', 10000, '2021-04-22'),
(157, '157', 10000, '2021-04-22'),
(158, '158', 10000, '2021-04-22'),
(159, '159', 10000, '2021-04-22'),
(160, '160', 10000, '2021-04-22'),
(161, '161', 10000, '2021-04-22'),
(162, '162', 10000, '2021-04-22'),
(163, '163', 10000, '2021-04-22'),
(164, '164', 10000, '2021-04-22'),
(165, '165', 10000, '2021-04-22'),
(166, '166', 10000, '2021-04-22'),
(167, '167', 10000, '2021-04-22'),
(168, '168', 10000, '2021-04-22'),
(169, '170', 10000, '2021-05-08'),
(170, '172', 10000, '2021-05-08'),
(171, '173', 10000, '2021-05-22'),
(172, '174', 10000, '2021-05-22'),
(173, '175', 10000, '2021-05-22'),
(174, '176', 10000, '2021-05-22'),
(175, '177', 10000, '2021-05-22'),
(176, '178', 10000, '2021-05-22'),
(177, '179', 10000, '2021-05-22'),
(178, '180', 10000, '2021-05-22'),
(179, '182', 10000, '2021-05-22'),
(180, '183', 10000, '2021-05-22'),
(181, '185', 10000, '2021-05-22'),
(182, '186', 10000, '2021-05-22'),
(184, '188', 10000, '2021-05-22'),
(185, '189', 10000, '2021-05-22'),
(186, '190', 10000, '2021-05-22'),
(187, '191', 10000, '2021-05-22'),
(188, '192', 10000, '2021-05-22'),
(189, '193', 10000, '2021-05-22'),
(190, '194', 10000, '2021-05-22'),
(191, '195', 10000, '2021-05-22'),
(192, '196', 10000, '2021-05-22'),
(193, '198', 10000, '2021-06-22'),
(194, '199', 10000, '2021-06-22'),
(195, '200', 10000, '2021-06-22'),
(196, '201', 10000, '2021-06-22'),
(197, '202', 10000, '2021-06-22'),
(198, '277', 10000, '2021-07-22'),
(199, '203', 10000, '2021-06-22'),
(201, '204', 10000, '2021-07-22'),
(202, '280', 10000, '2021-07-22'),
(203, '205', 10000, '2021-06-22'),
(204, '276', 10000, '2021-07-22'),
(205, '206', 10000, '2021-06-22'),
(206, '273', 10000, '2021-07-22'),
(207, '207', 10000, '2021-06-22'),
(208, '275', 10000, '2021-07-22'),
(209, '208', 10000, '2021-06-22'),
(210, '283', 10000, '2021-07-22'),
(212, '286', 10000, '2021-07-22'),
(213, '210', 10000, '2021-06-22'),
(214, '294', 10000, '2021-07-22'),
(215, '281', 10000, '2021-07-22'),
(216, '271', 10000, '2021-07-22'),
(217, '211', 10000, '2021-06-22'),
(218, '290', 10000, '2021-07-22'),
(219, '213', 10000, '2021-06-22'),
(220, '284', 10000, '2021-07-22'),
(221, '214', 10000, '2021-06-22'),
(222, '285', 10000, '2021-07-22'),
(223, '215', 10000, '2021-06-22'),
(224, '274', 10000, '2021-07-22'),
(225, '216', 10000, '2021-06-22'),
(226, '291', 10000, '2021-07-22'),
(227, '217', 10000, '2021-06-22'),
(228, '272', 10000, '2021-07-22'),
(229, '218', 10000, '2021-06-22'),
(230, '292', 10000, '2021-07-22'),
(231, '219', 10000, '2021-06-22'),
(232, '293', 10000, '2021-07-22'),
(233, '220', 10000, '2021-06-22'),
(234, '287', 10000, '2021-07-22'),
(235, '221', 10000, '2021-06-22'),
(236, '282', 10000, '2021-07-22'),
(237, '222', 10000, '2021-06-22'),
(238, '288', 10000, '2021-07-22'),
(239, '223', 10000, '2021-06-22'),
(240, '289', 10000, '2021-07-22'),
(241, '224', 10000, '2021-06-22'),
(243, '270', 10000, '2021-07-23'),
(244, '279', 10000, '2021-07-23'),
(245, '296', 10000, '2021-07-23'),
(246, '304', 10000, '2021-08-23'),
(247, '305', 10000, '2021-08-23'),
(248, '307', 10000, '2021-08-23'),
(249, '303', 10000, '2021-08-23'),
(250, '300', 10000, '2021-08-23'),
(251, '302', 10000, '2021-08-23'),
(252, '310', 10000, '2021-08-23'),
(253, '313', 10000, '2021-08-23'),
(254, '321', 10000, '2021-08-23'),
(255, '308', 10000, '2021-08-23'),
(256, '297', 10000, '2021-08-08'),
(257, '306', 10000, '2021-08-23'),
(258, '298', 10000, '2021-08-23'),
(259, '317', 10000, '2021-08-23'),
(260, '311', 10000, '2021-08-23'),
(261, '312', 10000, '2021-08-23'),
(262, '301', 10000, '2021-08-23'),
(263, '318', 10000, '2021-08-23'),
(264, '299', 10000, '2021-08-23'),
(265, '319', 10000, '2021-08-23'),
(266, '320', 10000, '2021-08-23'),
(267, '314', 10000, '2021-08-23'),
(268, '309', 10000, '2021-08-23'),
(269, '315', 10000, '2021-08-23'),
(270, '316', 10000, '2021-08-23'),
(271, '322', 10000, '2021-08-23'),
(273, '29', 10000, '2020-11-14'),
(274, '187', 10000, '2021-05-14'),
(275, '295', 10000, '2021-07-14');

-- --------------------------------------------------------

--
-- Table structure for table `t_pengeluaran`
--

CREATE TABLE `t_pengeluaran` (
  `no_pk` int(11) NOT NULL,
  `id_mj` int(11) NOT NULL,
  `tgl_pk` date NOT NULL,
  `nama_pengeluaran` varchar(50) NOT NULL,
  `jml_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pengeluaran`
--

INSERT INTO `t_pengeluaran` (`no_pk`, `id_mj`, `tgl_pk`, `nama_pengeluaran`, `jml_pk`) VALUES
(3, 1, '2021-02-06', 'KEGIATAN PESONA HMIF 2020', 138600),
(8, 1, '2021-05-05', 'KEGIATAN HMIF CUP', 248000),
(11, 1, '2021-02-27', 'UANG PEJAMUAN KORDA TIMUR LAUT', 226200),
(12, 1, '2021-04-30', 'REGISTRASI MUSWIL V JABAR', 50000),
(13, 1, '2021-06-18', 'KEGIATAN HMIF PEDULI', 8000),
(14, 1, '2021-06-19', 'KEGIATAN HIMA GATHERING', 126000),
(15, 1, '2021-06-26', 'JAMUAN KORDA TIMUR LAUT', 125000),
(16, 1, '2021-06-27', 'FOTO STUDIO HMIF', 270000),
(17, 1, '2021-08-24', 'ANGGARAN AKOMODASI GATHERING PERMI', 30000),
(18, 1, '2021-08-25', 'PEMBUATAN PIN HMIF (4000x40)', 160000),
(19, 1, '2021-08-17', 'KEGIATAN PROGRESMA', 88000),
(20, 1, '2021-09-23', 'SPANDUK HMIF', 100000),
(21, 1, '2021-09-25', 'JAMUAN POLINDRA', 89000),
(22, 1, '2021-09-25', 'PEMBELIAN TINTA', 180000),
(23, 1, '2021-10-03', 'RAKERWIL', 150000),
(24, 1, '2021-10-05', 'JAMUAN PELITA BANGSA', 196000),
(27, 1, '2021-02-27', 'PEMBELIAN ALAT TULIS KANTOR', 196000);

-- --------------------------------------------------------

--
-- Table structure for table `t_pengurus`
--

CREATE TABLE `t_pengurus` (
  `id_pengurus` int(11) NOT NULL,
  `id_mj` int(11) NOT NULL,
  `id_mahasiswa_pt` varchar(15) NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pengurus`
--

INSERT INTO `t_pengurus` (`id_pengurus`, `id_mj`, `id_mahasiswa_pt`, `id_jabatan`) VALUES
(1, 1, '18.14.1.0001', 9),
(2, 1, '18.14.1.0003', 11),
(3, 1, '18.14.1.0007', 8),
(4, 1, '18.14.1.0046', 2),
(5, 1, '18.14.1.0012', 7),
(6, 1, '18.14.1.0014', 10),
(7, 1, '18.14.1.0021', 13),
(8, 1, '18.14.1.0034', 3),
(9, 1, '18.14.1.0040', 12),
(10, 1, '18.14.1.0047', 16),
(11, 1, '18.14.1.0004', 15),
(12, 1, '18.14.1.0027', 14),
(13, 1, '18.14.1.0033', 15),
(15, 1, '19.14.1.0001', 13),
(17, 1, '19.14.1.0005', 13),
(18, 1, '19.14.1.0009', 6),
(19, 1, '19.14.1.0011', 16),
(20, 1, '19.14.1.0012', 4),
(21, 1, '19.14.1.0019', 16),
(22, 1, '19.14.1.0022', 16),
(23, 1, '19.14.1.0029', 14),
(24, 1, '19.14.1.0031', 15),
(25, 1, '19.14.1.0034', 14),
(26, 1, '19.14.1.0038', 14),
(27, 1, '19.14.1.0039', 17),
(29, 2, '18.14.1.0001', 14),
(30, 2, '18.14.1.0003', 16),
(31, 2, '18.14.1.0007', 13),
(32, 2, '18.14.1.0012', 13),
(33, 2, '18.14.1.0014', 4),
(34, 2, '18.14.1.0021', 6),
(35, 2, '18.14.1.0034', 14),
(36, 2, '18.14.1.0040', 17),
(37, 2, '18.14.1.0046', 14),
(38, 2, '18.14.1.0047', 16),
(39, 2, '18.14.1.0060', 15),
(40, 1, '18.14.1.0060', 5),
(48, 1, '18.14.1.0028', 17),
(58, 2, '17.14.1.0066', 2),
(59, 8, '16.14.1.0075', 2),
(60, 8, '17.14.1.0066', 15),
(61, 9, '19.14.1.0034', 2),
(62, 10, '16.14.1.0001', 2),
(67, 30, '19.14.1.0034', 2),
(68, 31, '18.15.1.0029', 2),
(69, 32, '18.17.1.0005', 2),
(70, 33, '19.17.1.0004', 2),
(71, 30, '19.14.1.0001', 3),
(72, 30, '19.14.1.0005', 23),
(73, 30, '19.14.1.0038', 22),
(74, 30, '19.14.1.0012', 5),
(75, 30, '19.14.1.0009', 7),
(76, 30, '19.14.1.0029', 26),
(77, 30, '19.14.1.0011', 27),
(78, 30, '19.14.1.0031', 24),
(79, 34, '20.01.1.0016', 2),
(80, 35, '22.11.1.0001', 2),
(81, 36, '21.18.1.0010', 2),
(82, 37, '21.24.1.0005', 2),
(83, 38, '21.22.1.0068', 2),
(84, 39, '20.23.1.0004', 2),
(85, 40, '20.17.1.0013', 2);

-- --------------------------------------------------------

--
-- Table structure for table `t_peserta`
--

CREATE TABLE `t_peserta` (
  `id` int(11) NOT NULL,
  `id_peserta` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `asal_sekolah` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_peserta`
--

INSERT INTO `t_peserta` (`id`, `id_peserta`, `nama`, `asal_sekolah`, `alamat`, `telp`, `email`, `token`) VALUES
(13, 'PS.22.08.13', 'ANDI ALFIAN', 'SMKN 1 Majalengka', 'Blok Rabu Desa Sindang', '082320516254', 'andialfi90@gmail.com', '5LOdlWU13Ft8cQEwKDIyiAqPMh26xa'),
(15, 'PS.22.09.15', 'SRI RAHAYU', 'SMAN 1 Majalengka', 'Blok Rabu Desa Sindang', '082320516254', 'sriputih231099@gmail.com', 'lc6nsDQU0VwSdq1oZBzRAyWkb9i8YuErtfGa2PCMLIO7FjgmNv'),
(18, 'PS.22.12.18', 'AA', 'aaaa', 'aaa', '098923432', 'a@unma.ac.id', 'P9z43buKMfUNYIXQnqdHE1G8eBmk2pslA6iO5aDWFxTjyrctRZ'),
(19, 'PS.22.12.19', 'BB', 'bb', 'bb', '08237437', 'BB@gmail.com', 'CbvmRP6itH3h7ay9x8oAlVjkwfYq5UNKSnGEZ40IMdLzWJTeDc'),
(20, 'PS.23.02.20', 'CECE MAUDA', 'SMKN 1 LIGUNG', 'LIGUNG', '0893433121', 'cc@gmail.com', 'hrqmkZG5I3nMf4oNQcAWKOETL8HsxzDvbY27XtV1FwgUiJPldB');

-- --------------------------------------------------------

--
-- Table structure for table `t_post`
--

CREATE TABLE `t_post` (
  `id_post` int(11) NOT NULL,
  `id_mj` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_mahasiswa_pt` varchar(15) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `is_published` int(1) NOT NULL,
  `dilihat` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_post`
--

INSERT INTO `t_post` (`id_post`, `id_mj`, `id_kategori`, `id_mahasiswa_pt`, `judul`, `slug`, `cover`, `body`, `is_published`, `dilihat`, `created_at`, `updated_at`) VALUES
(2, 1, 9, '18.14.1.0045', 'PESONA HMIF 2020', '73d14d45d714f3fb4db0963e69f4f2bd', 'IMG-20210208-WA0015.jpg', '<p><strong>Nama Program Kerja :</strong> PESONA HMIF 2020</p>\r\n<p><strong>Sasaran :</strong> Mahasiswa Informatika UNMA Semester 1&nbsp; dan yang belum mengikuti.</p>\r\n<p><strong>Metode Pelaksanaan :</strong> Pengenalan Studi Organisasi Himpunan Mahasiswa Informatika</p>\r\n<p><strong>Alokasi Waktu :</strong> 3 Jam</p>', 1, 9, '2021-12-06 14:37:04', '2021-12-06 07:37:04'),
(3, 1, 2, '18.14.1.0028', 'HMIF CUP', 'a34518b8a7ae4d4c57435a2124d9e25e', 'IMG_20210505_142056.jpg', '<p><strong>Program Kerja</strong> : HMIF CUP</p>\r\n<p><strong>Ketua Pelaksanan</strong> : Dea Juwita Suwardi</p>\r\n<p><strong>Perlombaan</strong> : Lomba desain poster, vlog, Mobile Legend dan PUBG Mobile</p>\r\n<p><strong>Pelaksaan</strong> : Online</p>', 1, 7, '2021-12-07 20:56:24', '2021-12-07 13:56:24'),
(4, 1, 9, '19.14.1.0039', 'HMIF Peduli', '45e530b47cde58576255dab0eb5d8f8a', 'IMG-20210626-WA0014.jpg', '<p><strong>Program Kerja</strong> : HMIF Peduli</p>\r\n<p><strong>Ketua Pelaksana</strong> : Dede Didin</p>\r\n<p><strong>Rundown Acara</strong> : Pembagian takjil, bantuan sosial ke anak yatim, dan buka bersama bareng demisioner serta alumni Informatika.</p>', 1, 9, '2021-12-07 21:09:03', '2021-12-07 14:09:03'),
(5, 1, 3, '18.14.1.0040', 'PROGRESMA 2021', '4d502815ea1ffa48f60d8450d5de09e4', 'progresma.jpg', '<p><strong>Program Kerja </strong>: PROGRESMA 2021</p>\r\n<p><strong>Ketua Pelaksana</strong> : Afif Surya Ramadhan</p>\r\n<p><strong>Rundown Acara</strong> : Diberi materi lalu di presentasi kan di lain hari.</p>', 1, 27, '2021-12-07 21:21:09', '2021-12-07 14:21:09'),
(6, 1, 9, '19.14.1.0001', 'MUSHMIF-UNMA yang ke-6', 'mushmif-unma-yang-ke-6', 'Untitled-1.jpg', '<p><strong>Ketua Pelaksana</strong> : AA Herdi Prayoga</p>\r\n<p><strong>Waktu </strong>: Pagi - malam</p>\r\n<p><strong>Hari/Tanggal </strong>: Sabtu, 23 Oktober 2021</p>\r\n<p><strong>Tempat </strong>: Ruang 301-302 Gedung Fakultas Teknik</p>\r\n<p>&nbsp;</p>', 0, 1, '2021-12-07 21:55:36', '2021-12-07 14:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `t_qrcode`
--

CREATE TABLE `t_qrcode` (
  `id` int(11) NOT NULL,
  `qrcode` varchar(255) NOT NULL,
  `nilai` varchar(100) NOT NULL,
  `expired` varchar(50) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_role`
--

CREATE TABLE `t_role` (
  `level` int(1) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_role`
--

INSERT INTO `t_role` (`level`, `role`) VALUES
(1, 'Admin'),
(2, 'Ketua Program Studi'),
(3, 'Ketua / Wakil Ketua Himpunan'),
(4, 'Bag. Sekretaris'),
(5, 'Bag. Keuangan'),
(6, 'Anggota Pengurus'),
(7, 'Demisioner'),
(8, 'Anggota');

-- --------------------------------------------------------

--
-- Table structure for table `t_tagihan`
--

CREATE TABLE `t_tagihan` (
  `no_tg` int(11) NOT NULL,
  `id_mj` int(11) NOT NULL,
  `nama_tagihan` varchar(255) NOT NULL,
  `jml_tagihan` int(11) NOT NULL,
  `id_hima` int(11) NOT NULL,
  `jenis` enum('Pengurus','Lainnya') NOT NULL,
  `created_at` date NOT NULL,
  `expired_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_tagihan`
--

INSERT INTO `t_tagihan` (`no_tg`, `id_mj`, `nama_tagihan`, `jml_tagihan`, `id_hima`, `jenis`, `created_at`, `expired_at`) VALUES
(1, 1, 'Kas November 2020', 10000, 14, 'Pengurus', '2020-11-01', '2020-11-30'),
(2, 1, 'Kas Desember 2020', 10000, 14, 'Pengurus', '2020-12-01', '2020-12-31'),
(3, 1, 'Kas Januari 2021', 10000, 14, 'Pengurus', '2021-01-01', '2021-01-31'),
(4, 1, 'Kas Februari 2021', 10000, 14, 'Pengurus', '2021-02-01', '2021-02-28'),
(5, 1, 'Kas Maret 2021', 10000, 14, 'Pengurus', '2021-03-01', '2021-03-30'),
(6, 1, 'Kas April 2021', 10000, 14, 'Pengurus', '2021-04-01', '2021-04-30'),
(7, 1, 'Kas Mei 2021', 10000, 14, 'Pengurus', '2021-05-01', '2021-05-30'),
(8, 1, 'Kas Juni 2021', 10000, 14, 'Pengurus', '2021-06-01', '2021-06-30'),
(10, 1, 'Kas Juli 2021', 10000, 14, 'Pengurus', '2021-07-01', '2021-07-30'),
(13, 1, 'Kas Agustus 2021', 10000, 14, 'Pengurus', '2021-08-01', '2021-08-29');

-- --------------------------------------------------------

--
-- Table structure for table `t_tagihan_anggota`
--

CREATE TABLE `t_tagihan_anggota` (
  `no_ta` int(11) NOT NULL,
  `no_tg` int(11) NOT NULL,
  `id_mahasiswa_pt` varchar(15) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_tagihan_anggota`
--

INSERT INTO `t_tagihan_anggota` (`no_ta`, `no_tg`, `id_mahasiswa_pt`, `created_at`) VALUES
(1, 1, '18.14.1.0003', NULL),
(2, 1, '18.14.1.0004', NULL),
(3, 1, '18.14.1.0001', NULL),
(4, 1, '18.14.1.0014', NULL),
(5, 1, '18.14.1.0021', NULL),
(6, 1, '18.14.1.0007', NULL),
(7, 1, '18.14.1.0060', NULL),
(8, 1, '18.14.1.0012', NULL),
(9, 1, '18.14.1.0027', NULL),
(10, 1, '18.14.1.0034', NULL),
(11, 1, '18.14.1.0033', NULL),
(12, 1, '18.14.1.0046', NULL),
(13, 1, '18.14.1.0040', NULL),
(14, 1, '18.14.1.0028', NULL),
(15, 1, '18.14.1.0045', NULL),
(16, 1, '18.14.1.0047', NULL),
(17, 1, '19.14.1.0001', NULL),
(19, 1, '19.14.1.0005', NULL),
(20, 1, '19.14.1.0011', NULL),
(21, 1, '19.14.1.0009', NULL),
(22, 1, '19.14.1.0012', NULL),
(23, 1, '19.14.1.0019', NULL),
(24, 1, '19.14.1.0038', NULL),
(25, 1, '19.14.1.0022', NULL),
(26, 1, '19.14.1.0034', NULL),
(27, 1, '19.14.1.0029', NULL),
(28, 1, '19.14.1.0031', NULL),
(29, 1, '19.14.1.0039', NULL),
(30, 2, '18.14.1.0001', NULL),
(31, 2, '18.14.1.0003', NULL),
(32, 2, '18.14.1.0004', NULL),
(33, 2, '18.14.1.0007', NULL),
(34, 2, '18.14.1.0012', NULL),
(35, 2, '18.14.1.0014', NULL),
(36, 2, '18.14.1.0021', NULL),
(37, 2, '18.14.1.0027', NULL),
(38, 2, '18.14.1.0028', NULL),
(39, 2, '18.14.1.0033', NULL),
(40, 2, '18.14.1.0034', NULL),
(41, 2, '18.14.1.0040', NULL),
(43, 2, '18.14.1.0046', NULL),
(44, 2, '18.14.1.0047', NULL),
(45, 2, '18.14.1.0060', NULL),
(46, 2, '19.14.1.0001', NULL),
(47, 2, '19.14.1.0005', NULL),
(48, 2, '19.14.1.0009', NULL),
(49, 2, '19.14.1.0011', NULL),
(50, 2, '19.14.1.0012', NULL),
(51, 2, '19.14.1.0019', NULL),
(52, 2, '19.14.1.0022', NULL),
(53, 2, '19.14.1.0029', NULL),
(54, 2, '19.14.1.0031', NULL),
(55, 2, '19.14.1.0034', NULL),
(56, 2, '19.14.1.0038', NULL),
(57, 2, '19.14.1.0039', NULL),
(58, 3, '18.14.1.0001', NULL),
(59, 3, '18.14.1.0003', NULL),
(60, 3, '18.14.1.0004', NULL),
(61, 3, '18.14.1.0007', NULL),
(62, 3, '18.14.1.0012', NULL),
(63, 3, '18.14.1.0014', NULL),
(64, 3, '18.14.1.0021', NULL),
(65, 3, '18.14.1.0027', NULL),
(66, 3, '18.14.1.0028', NULL),
(67, 3, '18.14.1.0033', NULL),
(68, 3, '18.14.1.0034', NULL),
(69, 3, '18.14.1.0040', NULL),
(71, 3, '18.14.1.0046', NULL),
(72, 3, '18.14.1.0047', NULL),
(73, 3, '18.14.1.0060', NULL),
(74, 3, '19.14.1.0001', NULL),
(75, 3, '19.14.1.0005', NULL),
(76, 3, '19.14.1.0009', NULL),
(77, 3, '19.14.1.0011', NULL),
(78, 3, '19.14.1.0012', NULL),
(79, 3, '19.14.1.0019', NULL),
(80, 3, '19.14.1.0022', NULL),
(81, 3, '19.14.1.0029', NULL),
(82, 3, '19.14.1.0031', NULL),
(83, 3, '19.14.1.0034', NULL),
(84, 3, '19.14.1.0038', NULL),
(85, 3, '19.14.1.0039', NULL),
(86, 4, '18.14.1.0001', NULL),
(87, 4, '18.14.1.0003', NULL),
(88, 4, '18.14.1.0004', NULL),
(89, 4, '18.14.1.0007', NULL),
(90, 4, '18.14.1.0012', NULL),
(91, 4, '18.14.1.0014', NULL),
(92, 4, '18.14.1.0021', NULL),
(93, 4, '18.14.1.0027', NULL),
(94, 4, '18.14.1.0028', NULL),
(95, 4, '18.14.1.0033', NULL),
(96, 4, '18.14.1.0034', NULL),
(97, 4, '18.14.1.0040', NULL),
(98, 4, '18.14.1.0045', NULL),
(99, 4, '18.14.1.0046', NULL),
(100, 4, '18.14.1.0047', NULL),
(102, 4, '19.14.1.0001', NULL),
(103, 4, '19.14.1.0005', NULL),
(104, 4, '19.14.1.0009', NULL),
(105, 4, '19.14.1.0011', NULL),
(106, 4, '19.14.1.0012', NULL),
(107, 4, '19.14.1.0019', NULL),
(108, 4, '19.14.1.0022', NULL),
(109, 4, '19.14.1.0029', NULL),
(110, 4, '19.14.1.0031', NULL),
(111, 4, '19.14.1.0034', NULL),
(112, 4, '19.14.1.0038', NULL),
(113, 4, '19.14.1.0039', NULL),
(114, 5, '18.14.1.0001', NULL),
(115, 5, '18.14.1.0003', NULL),
(116, 5, '18.14.1.0004', NULL),
(117, 5, '18.14.1.0007', NULL),
(118, 5, '18.14.1.0012', NULL),
(119, 5, '18.14.1.0014', NULL),
(120, 5, '18.14.1.0021', NULL),
(121, 5, '18.14.1.0027', NULL),
(122, 5, '18.14.1.0028', NULL),
(123, 5, '18.14.1.0033', NULL),
(124, 5, '18.14.1.0034', NULL),
(125, 5, '18.14.1.0040', NULL),
(126, 5, '18.14.1.0045', NULL),
(127, 5, '18.14.1.0046', NULL),
(128, 5, '18.14.1.0047', NULL),
(130, 5, '19.14.1.0001', NULL),
(131, 5, '19.14.1.0005', NULL),
(132, 5, '19.14.1.0009', NULL),
(133, 5, '19.14.1.0011', NULL),
(134, 5, '19.14.1.0012', NULL),
(135, 5, '19.14.1.0019', NULL),
(136, 5, '19.14.1.0022', NULL),
(137, 5, '19.14.1.0029', NULL),
(138, 5, '19.14.1.0031', NULL),
(139, 5, '19.14.1.0034', NULL),
(140, 5, '19.14.1.0038', NULL),
(141, 5, '19.14.1.0039', NULL),
(142, 6, '18.14.1.0001', NULL),
(143, 6, '18.14.1.0003', NULL),
(144, 6, '18.14.1.0004', NULL),
(145, 6, '18.14.1.0007', NULL),
(146, 6, '18.14.1.0012', NULL),
(147, 6, '18.14.1.0014', NULL),
(148, 6, '18.14.1.0021', NULL),
(149, 6, '18.14.1.0027', NULL),
(150, 6, '18.14.1.0028', NULL),
(151, 6, '18.14.1.0033', NULL),
(152, 6, '18.14.1.0034', NULL),
(153, 6, '18.14.1.0040', NULL),
(154, 6, '18.14.1.0046', NULL),
(155, 6, '18.14.1.0047', NULL),
(157, 6, '19.14.1.0001', NULL),
(158, 6, '19.14.1.0005', NULL),
(159, 6, '19.14.1.0009', NULL),
(160, 6, '19.14.1.0011', NULL),
(161, 6, '19.14.1.0012', NULL),
(162, 6, '19.14.1.0019', NULL),
(163, 6, '19.14.1.0022', NULL),
(164, 6, '19.14.1.0029', NULL),
(165, 6, '19.14.1.0031', NULL),
(166, 6, '19.14.1.0034', NULL),
(167, 6, '19.14.1.0038', NULL),
(168, 6, '19.14.1.0039', NULL),
(169, 7, '18.14.1.0001', NULL),
(170, 7, '18.14.1.0003', NULL),
(171, 7, '18.14.1.0004', NULL),
(172, 7, '18.14.1.0007', NULL),
(173, 7, '18.14.1.0012', NULL),
(174, 7, '18.14.1.0014', NULL),
(175, 7, '18.14.1.0021', NULL),
(176, 7, '18.14.1.0027', NULL),
(177, 7, '18.14.1.0028', NULL),
(178, 7, '18.14.1.0033', NULL),
(179, 7, '18.14.1.0034', NULL),
(180, 7, '18.14.1.0040', NULL),
(182, 7, '18.14.1.0046', NULL),
(183, 7, '18.14.1.0047', NULL),
(185, 7, '19.14.1.0001', NULL),
(186, 7, '19.14.1.0005', NULL),
(187, 7, '19.14.1.0009', NULL),
(188, 7, '19.14.1.0011', NULL),
(189, 7, '19.14.1.0012', NULL),
(190, 7, '19.14.1.0019', NULL),
(191, 7, '19.14.1.0022', NULL),
(192, 7, '19.14.1.0029', NULL),
(193, 7, '19.14.1.0031', NULL),
(194, 7, '19.14.1.0034', NULL),
(195, 7, '19.14.1.0038', NULL),
(196, 7, '19.14.1.0039', NULL),
(197, 8, '18.14.1.0001', NULL),
(198, 8, '18.14.1.0003', NULL),
(199, 8, '18.14.1.0004', NULL),
(200, 8, '18.14.1.0007', NULL),
(201, 8, '18.14.1.0012', NULL),
(202, 8, '18.14.1.0014', NULL),
(203, 8, '18.14.1.0021', NULL),
(204, 8, '18.14.1.0027', NULL),
(205, 8, '18.14.1.0028', NULL),
(206, 8, '18.14.1.0033', NULL),
(207, 8, '18.14.1.0034', NULL),
(208, 8, '18.14.1.0040', NULL),
(210, 8, '18.14.1.0046', NULL),
(211, 8, '18.14.1.0047', NULL),
(213, 8, '19.14.1.0001', NULL),
(214, 8, '19.14.1.0005', NULL),
(215, 8, '19.14.1.0009', NULL),
(216, 8, '19.14.1.0011', NULL),
(217, 8, '19.14.1.0012', NULL),
(218, 8, '19.14.1.0019', NULL),
(219, 8, '19.14.1.0022', NULL),
(220, 8, '19.14.1.0029', NULL),
(221, 8, '19.14.1.0031', NULL),
(222, 8, '19.14.1.0034', NULL),
(223, 8, '19.14.1.0038', NULL),
(224, 8, '19.14.1.0039', NULL),
(270, 10, '18.14.1.0034', NULL),
(271, 10, '18.14.1.0046', NULL),
(272, 10, '19.14.1.0012', NULL),
(273, 10, '18.14.1.0012', NULL),
(274, 10, '19.14.1.0009', NULL),
(275, 10, '18.14.1.0014', NULL),
(276, 10, '18.14.1.0007', NULL),
(277, 10, '18.14.1.0001', NULL),
(279, 10, '18.14.1.0040', NULL),
(280, 10, '18.14.1.0004', NULL),
(281, 10, '18.14.1.0033', NULL),
(282, 10, '19.14.1.0031', NULL),
(283, 10, '18.14.1.0021', NULL),
(284, 10, '19.14.1.0001', NULL),
(285, 10, '19.14.1.0005', NULL),
(286, 10, '18.14.1.0027', NULL),
(287, 10, '19.14.1.0029', NULL),
(288, 10, '19.14.1.0034', NULL),
(289, 10, '19.14.1.0038', NULL),
(290, 10, '18.14.1.0047', NULL),
(291, 10, '19.14.1.0011', NULL),
(292, 10, '19.14.1.0019', NULL),
(293, 10, '19.14.1.0022', NULL),
(294, 10, '18.14.1.0028', NULL),
(295, 10, '19.14.1.0039', NULL),
(296, 10, '18.14.1.0003', NULL),
(297, 13, '18.14.1.0034', NULL),
(298, 13, '18.14.1.0046', NULL),
(299, 13, '19.14.1.0012', NULL),
(300, 13, '18.14.1.0012', NULL),
(301, 13, '19.14.1.0009', NULL),
(302, 13, '18.14.1.0014', NULL),
(303, 13, '18.14.1.0007', NULL),
(304, 13, '18.14.1.0001', NULL),
(305, 13, '18.14.1.0003', NULL),
(306, 13, '18.14.1.0040', NULL),
(307, 13, '18.14.1.0004', NULL),
(308, 13, '18.14.1.0033', NULL),
(309, 13, '19.14.1.0031', NULL),
(310, 13, '18.14.1.0021', NULL),
(311, 13, '19.14.1.0001', NULL),
(312, 13, '19.14.1.0005', NULL),
(313, 13, '18.14.1.0027', NULL),
(314, 13, '19.14.1.0029', NULL),
(315, 13, '19.14.1.0034', NULL),
(316, 13, '19.14.1.0038', NULL),
(317, 13, '18.14.1.0047', NULL),
(318, 13, '19.14.1.0011', NULL),
(319, 13, '19.14.1.0019', NULL),
(320, 13, '19.14.1.0022', NULL),
(321, 13, '18.14.1.0028', NULL),
(322, 13, '19.14.1.0039', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_token`
--

CREATE TABLE `t_token` (
  `id_token` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id` int(11) NOT NULL,
  `id_mhs` varchar(15) NOT NULL,
  `id_mahasiswa_pt` varchar(15) DEFAULT NULL,
  `is_admin` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id`, `id_mhs`, `id_mahasiswa_pt`, `is_admin`) VALUES
(1, '180137', '18.14.1.0001', 1),
(2, '180321', '18.14.1.0007', 0),
(3, '180069', '18.14.1.0003', 0),
(4, '180369', '18.14.1.0012', 0),
(5, '180297', '18.14.1.0014', 0),
(6, '180309', '18.14.1.0021', 0),
(7, '180653', '18.14.1.0034', 0),
(8, '180818', '18.14.1.0040', 0),
(9, '180742', '18.14.1.0046', 0),
(10, '181242', '18.14.1.0047', 0),
(11, '180364', '18.14.1.0060', 0),
(12, '180099', '18.14.1.0004', 0),
(13, '180652', '18.14.1.0027', 0),
(14, '180741', '18.14.1.0033', 0),
(15, '181048', '18.14.1.0045', 0),
(16, '190118', '', 0),
(17, '190253', '', 0),
(18, '190312', '', 0),
(19, '190480', '', 0),
(20, '190404', '', 0),
(21, '190638', '', 0),
(22, '190779', '', 0),
(23, '191135', '', 0),
(24, '191177', '', 0),
(25, '191309', '', 0),
(26, '191144', '', 0),
(27, '190828', '', 0),
(28, '191412', '', 0),
(38, '180979', '18.14.1.0028', 0),
(47, '180176', '18.14.1.0002', 0),
(48, '180373', '18.14.1.0010', 0),
(49, '', '20.03.1.0002', 0),
(50, '180507', '18.14.1.0011', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_absen`
--
ALTER TABLE `t_absen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_biaya_kegiatan`
--
ALTER TABLE `t_biaya_kegiatan`
  ADD PRIMARY KEY (`id_biaya`),
  ADD KEY `no_kg` (`no_kg`);

--
-- Indexes for table `t_cash_rule`
--
ALTER TABLE `t_cash_rule`
  ADD PRIMARY KEY (`id_cr`);

--
-- Indexes for table `t_contact_person`
--
ALTER TABLE `t_contact_person`
  ADD PRIMARY KEY (`id_cp`);

--
-- Indexes for table `t_controller`
--
ALTER TABLE `t_controller`
  ADD PRIMARY KEY (`id_ctr`);

--
-- Indexes for table `t_dokumentasi`
--
ALTER TABLE `t_dokumentasi`
  ADD PRIMARY KEY (`id_dk`),
  ADD KEY `no_kg` (`no_kg`);

--
-- Indexes for table `t_hima`
--
ALTER TABLE `t_hima`
  ADD PRIMARY KEY (`id_hima`);

--
-- Indexes for table `t_jabatan`
--
ALTER TABLE `t_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `t_kaprodi`
--
ALTER TABLE `t_kaprodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_kategori`
--
ALTER TABLE `t_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `t_kegiatan`
--
ALTER TABLE `t_kegiatan`
  ADD PRIMARY KEY (`no_kegiatan`);

--
-- Indexes for table `t_mahasiswa`
--
ALTER TABLE `t_mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_masa_jabatan`
--
ALTER TABLE `t_masa_jabatan`
  ADD PRIMARY KEY (`id_mj`);

--
-- Indexes for table `t_menu_access`
--
ALTER TABLE `t_menu_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_pemasukan`
--
ALTER TABLE `t_pemasukan`
  ADD PRIMARY KEY (`no_pm`);

--
-- Indexes for table `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  ADD PRIMARY KEY (`no_pb`),
  ADD KEY `no_ta` (`no_ta`);

--
-- Indexes for table `t_pengeluaran`
--
ALTER TABLE `t_pengeluaran`
  ADD PRIMARY KEY (`no_pk`);

--
-- Indexes for table `t_pengurus`
--
ALTER TABLE `t_pengurus`
  ADD PRIMARY KEY (`id_pengurus`);

--
-- Indexes for table `t_peserta`
--
ALTER TABLE `t_peserta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_post`
--
ALTER TABLE `t_post`
  ADD PRIMARY KEY (`id_post`);

--
-- Indexes for table `t_qrcode`
--
ALTER TABLE `t_qrcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_role`
--
ALTER TABLE `t_role`
  ADD PRIMARY KEY (`level`);

--
-- Indexes for table `t_tagihan`
--
ALTER TABLE `t_tagihan`
  ADD PRIMARY KEY (`no_tg`),
  ADD KEY `id_mj` (`id_mj`),
  ADD KEY `id_hima` (`id_hima`);

--
-- Indexes for table `t_tagihan_anggota`
--
ALTER TABLE `t_tagihan_anggota`
  ADD PRIMARY KEY (`no_ta`),
  ADD KEY `no_tg` (`no_tg`);

--
-- Indexes for table `t_token`
--
ALTER TABLE `t_token`
  ADD PRIMARY KEY (`id_token`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_absen`
--
ALTER TABLE `t_absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=581;

--
-- AUTO_INCREMENT for table `t_biaya_kegiatan`
--
ALTER TABLE `t_biaya_kegiatan`
  MODIFY `id_biaya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `t_cash_rule`
--
ALTER TABLE `t_cash_rule`
  MODIFY `id_cr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_contact_person`
--
ALTER TABLE `t_contact_person`
  MODIFY `id_cp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `t_controller`
--
ALTER TABLE `t_controller`
  MODIFY `id_ctr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `t_dokumentasi`
--
ALTER TABLE `t_dokumentasi`
  MODIFY `id_dk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_hima`
--
ALTER TABLE `t_hima`
  MODIFY `id_hima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `t_jabatan`
--
ALTER TABLE `t_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `t_kaprodi`
--
ALTER TABLE `t_kaprodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_kategori`
--
ALTER TABLE `t_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_kegiatan`
--
ALTER TABLE `t_kegiatan`
  MODIFY `no_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `t_mahasiswa`
--
ALTER TABLE `t_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `t_masa_jabatan`
--
ALTER TABLE `t_masa_jabatan`
  MODIFY `id_mj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `t_menu_access`
--
ALTER TABLE `t_menu_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `t_pemasukan`
--
ALTER TABLE `t_pemasukan`
  MODIFY `no_pm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  MODIFY `no_pb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT for table `t_pengeluaran`
--
ALTER TABLE `t_pengeluaran`
  MODIFY `no_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `t_pengurus`
--
ALTER TABLE `t_pengurus`
  MODIFY `id_pengurus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `t_peserta`
--
ALTER TABLE `t_peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `t_post`
--
ALTER TABLE `t_post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `t_qrcode`
--
ALTER TABLE `t_qrcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `t_tagihan`
--
ALTER TABLE `t_tagihan`
  MODIFY `no_tg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `t_tagihan_anggota`
--
ALTER TABLE `t_tagihan_anggota`
  MODIFY `no_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=405;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
