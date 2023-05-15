-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Mar 2023 pada 10.32
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

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
-- Struktur dari tabel `t_absen`
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
-- Dumping data untuk tabel `t_absen`
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
(46, 30, 1, '18.14.1.0004', 'Hadir', 'Panitia', '2022-07-31 10:14:18', NULL, NULL),
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
(570, 73, 0, 'PS.22.12.19', 'Belum Hadir', 'Peserta', '2022-12-16 14:33:45', 'aVAGZNqhgnFx4TUMJiuEX1cpkKOeWrRdY7PSwDsy69zBfQ8Lbm', NULL),
(573, 75, 1, '19.14.1.0035', 'Hadir', 'Peserta', '2023-02-02 15:47:25', 'BVuxWOUfnEe7Lt302a5AKl9pZjbI1GioTDP4vFrMyzksRQcHCw', 'images/ttd/63dbdb0dcb0a8.png'),
(574, 75, 0, 'PS.23.02.20', 'Belum Hadir', 'Peserta', '2023-02-09 15:12:56', 'RSmLOXKAo39qpC2D4adTIlWZQPr0yGunve8b7J1EkB6xNtcjiH', 'images/ttd/63e4e74f716a0.png'),
(575, 75, 1, '18.14.1.0002', 'Hadir', 'Peserta', '2023-02-09 14:10:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_biaya_kegiatan`
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
-- Dumping data untuk tabel `t_biaya_kegiatan`
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
-- Struktur dari tabel `t_cash_rule`
--

CREATE TABLE `t_cash_rule` (
  `id_cr` int(11) NOT NULL,
  `cash_rule` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_hima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_cash_rule`
--

INSERT INTO `t_cash_rule` (`id_cr`, `cash_rule`, `created_at`, `updated_at`, `id_hima`) VALUES
(1, 'Uang Kas Rp. 10.000 per bulan', '2021-09-17 06:20:45', '2022-07-10 12:30:59', 14),
(2, 'Telat bayar akan di denda Rp 5.000', '2021-09-17 06:21:05', '2021-09-16 23:21:05', 14),
(3, 'Tidak bayar Kas akan ditagih sampai akhir jabatan', '2021-09-17 06:21:17', '2021-09-16 23:21:17', 14),
(4, 'Tidak mengikuti rapat formal tanpa keterangan, akan di denda Rp 20.000', '2021-09-17 06:21:27', '2021-09-16 23:21:27', 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_contact_person`
--

CREATE TABLE `t_contact_person` (
  `id_cp` int(11) NOT NULL,
  `id_hima` int(11) NOT NULL,
  `nama_contact` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_contact_person`
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
-- Struktur dari tabel `t_controller`
--

CREATE TABLE `t_controller` (
  `id_ctr` int(11) NOT NULL,
  `nama_controller` varchar(50) NOT NULL,
  `fitur` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_controller`
--

INSERT INTO `t_controller` (`id_ctr`, `nama_controller`, `fitur`) VALUES
(1, 'Admin', '(index) Dashboard,  Controller (CRUD), Role (CRUD), akses menu (Input, Delete),  Himpunan (Input, Delete), Jabatan (Update, Delete).'),
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
(17, 'Pembayaran', 'input data bayar, dan hapus data');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_dokumentasi`
--

CREATE TABLE `t_dokumentasi` (
  `id_dk` int(11) NOT NULL,
  `no_kg` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `caption` varchar(50) NOT NULL,
  `id_mahasiswa_pt` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_dokumentasi`
--

INSERT INTO `t_dokumentasi` (`id_dk`, `no_kg`, `image`, `caption`, `id_mahasiswa_pt`) VALUES
(6, 18, 'IMG-20210206-WA0009.jpg', 'Panitia', '18.14.1.0001'),
(8, 18, 'c205a3ad8d415010c63dd122490c5922.jpg', 'Peserta pesona', '18.14.1.0001'),
(9, 18, '740f767556e52bbbf5598bc619b043f6.jpg', 'Panitia sekaligus peserta', '18.14.1.0003');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_hima`
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
-- Dumping data untuk tabel `t_hima`
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
-- Struktur dari tabel `t_jabatan`
--

CREATE TABLE `t_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_jabatan`
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
-- Struktur dari tabel `t_kategori`
--

CREATE TABLE `t_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_kategori`
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
-- Struktur dari tabel `t_kegiatan`
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
-- Dumping data untuk tabel `t_kegiatan`
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
(73, '2022-12-29', 'Seminar Industri 6.0', 'Auditorium', 'Hybrid', 'Umum', '2022-12-28 08:00:00', '2022-12-28 14:00:00', '2022-12-28 08:00:00', '2022-12-28 12:00:00', '.......', 33, NULL),
(75, '2023-02-09', 'Seminar Nasional Teknologi 2022', 'Auditorium', 'Hybrid', 'Umum', '2023-02-09 01:47:00', '2023-02-09 22:44:00', '2023-02-09 01:47:00', '2023-02-09 23:44:00', '<p>sdcsdfdsf</p>', 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_masa_jabatan`
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
-- Dumping data untuk tabel `t_masa_jabatan`
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
-- Struktur dari tabel `t_menu_access`
--

CREATE TABLE `t_menu_access` (
  `id` int(11) NOT NULL,
  `level` int(1) NOT NULL,
  `id_ctr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_menu_access`
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
(90, 5, 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_nonton`
--

CREATE TABLE `t_nonton` (
  `id` int(11) NOT NULL,
  `kegiatan` varchar(50) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `judul` text NOT NULL,
  `tempat` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `mulai` varchar(5) NOT NULL,
  `selesai` varchar(5) NOT NULL,
  `jumlah_peserta` int(11) NOT NULL,
  `status` enum('Hadir','Tidak Hadir') NOT NULL,
  `id_mahasiswa_pt` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_nonton`
--

INSERT INTO `t_nonton` (`id`, `kegiatan`, `prodi`, `judul`, `tempat`, `tanggal`, `mulai`, `selesai`, `jumlah_peserta`, `status`, `id_mahasiswa_pt`) VALUES
(1, 'Seminar KP / PKL / PPL', 'Informatika', 'RANCANG BANGUN VIDEO TUTORIAL\r\nPENGGUNAAN APLIKASI PMB UNIVERSITAS\r\nMAJALENGKA MENGGUNAKAN MOTION\r\nGRAPHIC', 'Daring UNMAKU', '2021-03-20', '13:00', '15:00', 25, 'Hadir', '18.14.1.0001'),
(2, 'Seminar Draf Penelitian', 'Teknik Sipil', 'PENGEMBANGAN DAN PENATAAN MODERN PASAR MAJA SELATAN KECAMATAN MAJA, KABUPATEN MAJALENGKA', 'Ruang Sidang', '2021-11-11', '14:00', '16:00', 29, 'Hadir', '18.14.1.0001'),
(3, 'Seminar KP / PKL / PPL', 'Informatika', 'Sistem Informasi Payroll Berbasis Web\r\nMenggunakan Laravel di SMK Karya\r\nNasional', 'Ruang Sidang', '2022-01-05', '11:00', '12:00', 17, 'Hadir', '18.14.1.0001'),
(4, 'Seminar KP / PKL / PPL', 'Informatika', 'PEMBUATAN ANIMASI 2 DIMENSI \"WASPADA SMS PENIPUAN\" MENGGUNAKAN TEKNIK FRAME BY FRAME', 'Ruang Sidang', '2022-01-15', '11:00', '12:00', 22, 'Hadir', '18.14.1.0001'),
(5, 'Seminar KP / PKL / PPL', 'Informatika', 'Pengenalan Kondisi Tanah Dengan Raspberry Pi Pada Drone Penyemprot Tanaman', 'Ruang Sidang', '2022-02-05', '15:00', '17:00', 25, 'Hadir', '18.14.1.0001'),
(6, 'Seminar KP / PKL / PPL', 'Informatika', 'RANCANG BANGUN SISTEM INFORMASI ANGKRINGAN MAJALENGKA MENGGUNAKAN FRAMEWORK CODEIGNITER (studi Kasus : Angkringan\r\nWilayah Majalengka)', 'Daring UNMAKU', '2022-02-16', '19:00', '21:00', 27, 'Hadir', '18.14.1.0001'),
(7, 'Seminar KP / PKL / PPL', 'Informatika', 'APLIKASI LAPORAN KEUANGAN TOKO BERKAH AQUATIC BERBASIS WEB', 'Ruang Rapat', '2022-02-21', '12:00', '14:00', 8, 'Hadir', '18.14.1.0001'),
(8, 'Seminar KP / PKL / PPL', 'Informatika', 'MEDIA INFORMASI PENGAJIAN MAJLIS TAKLIM DI KECAMATAN KERTAJATI BERBASIS WEB', 'Ruang Sidang', '2022-02-22', '10:00', '12:00', 9, 'Hadir', '18.14.1.0001'),
(9, 'Seminar Draf Penelitian', 'Informatika', 'Rancang Bangun Sistem Informasi Absensi Menggunakan Global Positiong System Berbasis Website PT. Bandar Udara Internasional Jawa Barat', 'Ruang Sidang', '2022-05-30', '09:00', '11:00', 11, 'Hadir', '18.14.1.0001'),
(10, 'Seminar Draf Penelitian', 'Informatika', 'Analisis Kematangan Buah Kopi Berdasarkan Ekstraksi Ciri Warna Menggunakan Metode Naive Bayes Classier', 'Ruang Sidang', '2022-05-31', '09:00', '11:00', 21, 'Hadir', '18.14.1.0001'),
(11, 'Seminar Draf Penelitian', 'Informatika', 'Pengembangan Sistem Informasi Manajemen di Hippelti Fitness Center', 'R. Sidang/Hybrid', '2022-06-10', '10:00', '12:00', 15, 'Hadir', '18.14.1.0001'),
(12, 'Seminar Draf Penelitian', 'Informatika', 'Pengembangan Sistem Informasi Tanaman Hias di Kabupaten Majalengka Berbasis Web', 'R. Sidang/Hybrid', '2022-06-30', '15.30', '17.00', 9, 'Hadir', '18.14.1.0001'),
(13, 'Seminar KP / PKL / PPL', 'Informatika', 'RANCANG BANGUN SISTEM INFORMASI DATA PEGAWAI BERBASIS WEB MENGGUNAKAN FRAMEWORK BOOTSTRAP (STUDI KASUS DINAS PEMBERDAYAAN PEREMPUAN ANAK DAN KELUARGA BERENCANA MAJALENGKA)', 'hybrid/ruang sidang', '2022-12-19', '13:00', '15:00', 23, 'Hadir', '19.14.1.0031'),
(14, 'Seminar KP / PKL / PPL', 'Informatika', 'SISTEM APLIKASI SINAR DESA BERBASIS ANDROID (Studi Kasus : Desa Babatan Kecamatan Kadugede Kuningan)', 'R.Sidang', '2023-01-03', '14:00', '16:00', 51, 'Hadir', '19.14.1.0031'),
(15, 'Seminar KP / PKL / PPL', 'Informatika', 'Implementasi Load Balancing menggunakan Metode Per Connection Classier (PCC) dengan Failover pada Server Jaringan Mikrotik (Studi Kasus Universitas Majalengka)', 'Hybrid/R. Sidang', '2023-01-06', '13:00', '15:00', 33, 'Hadir', '19.14.1.0031'),
(16, 'Seminar KP / PKL / PPL', 'Informatika', 'PENGEMBANGAN DAN PERAWATAN SISTEM INFORMASI MANAJEMEN PERJALANAN DINAS (AMAN) KEMENTERIAN AGAMA BERBASIS WEB PT. INFORMATIKA MEDIA PRATAMA', 'Hybrid/R. Sidang', '2023-01-12', '13:00', '15:00', 38, 'Hadir', '19.14.1.0031'),
(17, 'Seminar KP / PKL / PPL', 'Teknik Sipil', 'Metode Pengecoran Lantai Partisi Di Saluran Induk Cipelang Pada Rentang Irrigation Modernization Project', 'Hybrid/R. Sidang', '2023-01-27', '14:00', '16:00', 15, 'Hadir', '19.14.1.0031'),
(18, 'Seminar KP / PKL / PPL', 'Informatika', 'RANCANG BANGUN SISTEM INFORMASI DATA PEGAWAI BERBASIS WEB MENGGUNAKAN FRAMEWORK BOOTSTRAP (STUDI KASUS DINAS PEMBERDAYAAN PEREMPUAN ANAK DAN KELUARGA BERENCANA MAJALENGKA)', 'hybrid/ruang sidang', '2022-12-19', '13:00', '15:00', 23, 'Tidak Hadir', '19.14.1.0035'),
(19, 'Seminar KP / PKL / PPL', 'Informatika', 'SISTEM APLIKASI SINAR DESA BERBASIS ANDROID (Studi Kasus : Desa Babatan Kecamatan Kadugede Kuningan)', 'R.Sidang', '2023-01-03', '14:00', '16:00', 51, 'Hadir', '19.14.1.0035'),
(20, 'Seminar KP / PKL / PPL', 'Informatika', 'Implementasi Load Balancing menggunakan Metode Per Connection Classier (PCC) dengan Failover pada Server Jaringan Mikrotik (Studi Kasus Universitas Majalengka)', 'Hybrid/R. Sidang', '2023-01-06', '13:00', '15:00', 33, 'Hadir', '19.14.1.0035'),
(21, 'Seminar KP / PKL / PPL', 'Teknik Sipil', 'METODE PELAKSANAAN PEKERJAAN LINING IN CAST BAWAH DI BENDUNGAN RENTANG JATITUJUH JAWA BARAT', 'Hybrid/R. Sidang', '2023-01-11', '13:00', '15:00', 26, 'Hadir', '19.14.1.0035'),
(22, 'Seminar KP / PKL / PPL', 'Ilmu Hukum', 'Tinjauan yuridis pelaksanaan dan pengelolaan wakaf tanah menurut undang-undang nomor 25 tahun 2018', 'ruang sidang fh', '2023-01-30', '13:00', '13:30', 2, 'Tidak Hadir', '19.14.1.0035'),
(23, 'Seminar KP / PKL / PPL', 'Teknik Industri', 'Perbaikan Kualitas Material yang Akan Digunakan pada Proyek Modernisasi Irigasi Cipelang Menggunakan PDCA', 'Hybrid/R. Sidang', '2023-01-30', '13:00', '15:00', 19, 'Hadir', '19.14.1.0035'),
(24, 'Seminar KP / PKL / PPL', 'Teknik Sipil', 'Produktivitas tenaga kerja pada pekerjaan aspal ac-wc di proyek pemeliharaan jalan TalagaSangiang', 'Hybrid/R. Sidang', '2023-01-30', '15:00', '17:00', 16, 'Hadir', '19.14.1.0035');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pemasukan`
--

CREATE TABLE `t_pemasukan` (
  `no_pm` int(11) NOT NULL,
  `tgl_pm` date NOT NULL,
  `nama_pemasukan` varchar(100) NOT NULL,
  `sumber` varchar(100) NOT NULL,
  `jml_pm` int(11) NOT NULL,
  `id_mj` int(11) NOT NULL,
  `kas_hima` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_pemasukan`
--

INSERT INTO `t_pemasukan` (`no_pm`, `tgl_pm`, `nama_pemasukan`, `sumber`, `jml_pm`, `id_mj`, `kas_hima`) VALUES
(1, '2020-10-10', 'KAS HMIF 2020/2021', 'Anggota Pengurus', 2632000, 1, 1),
(3, '2020-10-13', 'UANG PKKMB', 'PAK DONA', 25000, 1, 0),
(4, '2020-10-17', 'DANA AWAL', 'HMIF PERIODE 2019/2020', 500000, 1, 0),
(5, '2021-03-27', 'DANA SAVING', 'SENAT FAKULTAS TEKNIK', 1000000, 1, 0),
(6, '2021-06-20', 'SISA UANG HMIF PEDULI', 'TAMU UNDANGAN', 130500, 1, 0),
(7, '2021-06-20', 'SISA UANG HIMA GATHERING', 'PESERTA KEGIATAN', 43500, 1, 0),
(8, '2021-08-16', 'SISA UANG PROGRESSMA', 'REGISTRASI PESERTA', 1182000, 1, 0),
(9, '2021-10-21', 'UANG SISA KEMEJA (KWU)', 'Mahasiswa IF', 225000, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pembayaran`
--

CREATE TABLE `t_pembayaran` (
  `no_pb` int(11) NOT NULL,
  `no_tg` int(11) NOT NULL,
  `id_mahasiswa_pt` varchar(15) NOT NULL,
  `nominal_bayar` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_pembayaran`
--

INSERT INTO `t_pembayaran` (`no_pb`, `no_tg`, `id_mahasiswa_pt`, `nominal_bayar`, `tgl_bayar`) VALUES
(1, 1, '18.14.1.0001', 10000, '2020-11-29'),
(2, 1, '18.14.1.0003', 10000, '2020-11-29'),
(3, 1, '18.14.1.0004', 10000, '2020-11-29'),
(4, 1, '18.14.1.0007', 10000, '2020-11-29'),
(5, 1, '18.14.1.0012', 10000, '2020-11-29'),
(6, 1, '18.14.1.0014', 10000, '2020-11-29'),
(7, 1, '18.14.1.0021', 10000, '2020-11-29'),
(8, 1, '18.14.1.0027', 10000, '2020-11-29'),
(9, 1, '18.14.1.0028', 10000, '2020-11-29'),
(10, 1, '18.14.1.0033', 10000, '2020-11-29'),
(11, 1, '18.14.1.0034', 10000, '2020-11-29'),
(12, 1, '18.14.1.0040', 10000, '2020-11-29'),
(13, 1, '18.14.1.0045', 10000, '2020-11-29'),
(14, 1, '18.14.1.0046', 10000, '2020-11-29'),
(15, 1, '18.14.1.0047', 10000, '2020-11-29'),
(16, 1, '18.14.1.0060', 10000, '2020-11-29'),
(17, 1, '19.14.1.0001', 10000, '2020-11-29'),
(18, 1, '19.14.1.0005', 10000, '2020-11-29'),
(19, 1, '19.14.1.0009', 10000, '2020-11-29'),
(20, 1, '19.14.1.0011', 10000, '2020-11-29'),
(21, 1, '19.14.1.0012', 10000, '2020-11-29'),
(22, 1, '19.14.1.0019', 10000, '2020-11-29'),
(23, 1, '19.14.1.0022', 10000, '2020-11-29'),
(24, 1, '19.14.1.0029', 10000, '2020-11-29'),
(25, 1, '19.14.1.0031', 10000, '2020-11-29'),
(26, 1, '19.14.1.0034', 10000, '2020-11-29'),
(27, 1, '19.14.1.0038', 10000, '2020-11-29'),
(28, 1, '19.14.1.0039', 10000, '2020-11-29'),
(29, 2, '18.14.1.0001', 10000, '2020-12-30'),
(30, 2, '18.14.1.0003', 10000, '2020-12-30'),
(31, 2, '18.14.1.0004', 10000, '2020-12-30'),
(32, 2, '18.14.1.0007', 10000, '2020-12-30'),
(33, 2, '18.14.1.0012', 10000, '2020-12-30'),
(34, 2, '18.14.1.0014', 10000, '2020-12-30'),
(35, 2, '18.14.1.0021', 10000, '2020-12-30'),
(36, 2, '18.14.1.0027', 10000, '2020-12-30'),
(37, 2, '18.14.1.0028', 10000, '2020-12-30'),
(38, 2, '18.14.1.0033', 10000, '2020-12-30'),
(39, 2, '18.14.1.0034', 10000, '2020-12-30'),
(40, 2, '18.14.1.0040', 10000, '2020-12-30'),
(41, 2, '18.14.1.0046', 10000, '2020-12-30'),
(42, 2, '18.14.1.0047', 10000, '2020-12-30'),
(43, 2, '19.14.1.0001', 10000, '2020-12-30'),
(44, 2, '19.14.1.0005', 10000, '2020-12-30'),
(45, 2, '19.14.1.0009', 10000, '2020-12-30'),
(46, 2, '19.14.1.0011', 10000, '2020-12-30'),
(47, 2, '19.14.1.0012', 10000, '2020-12-30'),
(48, 2, '19.14.1.0019', 10000, '2020-12-30'),
(49, 2, '19.14.1.0022', 10000, '2020-12-30'),
(50, 2, '19.14.1.0029', 10000, '2020-12-30'),
(51, 2, '19.14.1.0031', 10000, '2020-12-30'),
(52, 2, '19.14.1.0034', 10000, '2020-12-30'),
(53, 2, '19.14.1.0038', 10000, '2020-12-30'),
(54, 2, '19.14.1.0039', 10000, '2020-12-30'),
(55, 3, '18.14.1.0001', 10000, '2021-01-31'),
(56, 3, '18.14.1.0003', 10000, '2021-01-31'),
(57, 3, '18.14.1.0004', 10000, '2021-01-31'),
(58, 3, '18.14.1.0007', 10000, '2021-01-31'),
(59, 3, '18.14.1.0012', 10000, '2021-01-31'),
(60, 3, '18.14.1.0014', 10000, '2021-01-31'),
(61, 3, '18.14.1.0021', 10000, '2021-01-31'),
(62, 3, '18.14.1.0027', 10000, '2021-01-31'),
(63, 3, '18.14.1.0028', 10000, '2021-01-31'),
(64, 3, '18.14.1.0033', 10000, '2021-01-31'),
(65, 3, '18.14.1.0034', 10000, '2021-01-31'),
(66, 3, '18.14.1.0040', 10000, '2021-01-31'),
(67, 3, '18.14.1.0046', 10000, '2021-01-31'),
(68, 3, '18.14.1.0047', 10000, '2021-01-31'),
(69, 3, '19.14.1.0001', 10000, '2021-01-31'),
(70, 3, '19.14.1.0005', 10000, '2021-01-31'),
(71, 3, '19.14.1.0009', 10000, '2021-01-31'),
(72, 3, '19.14.1.0011', 10000, '2021-01-31'),
(73, 3, '19.14.1.0012', 10000, '2021-01-31'),
(74, 3, '19.14.1.0019', 10000, '2021-01-31'),
(75, 3, '19.14.1.0022', 10000, '2021-01-31'),
(76, 3, '19.14.1.0029', 10000, '2021-01-31'),
(77, 3, '19.14.1.0031', 10000, '2021-01-31'),
(78, 3, '19.14.1.0034', 10000, '2021-01-31'),
(79, 3, '19.14.1.0038', 10000, '2021-01-31'),
(80, 3, '19.14.1.0039', 10000, '2021-01-31'),
(81, 4, '18.14.1.0001', 10000, '2021-02-24'),
(82, 4, '18.14.1.0003', 10000, '2021-02-24'),
(83, 4, '18.14.1.0004', 10000, '2021-02-24'),
(84, 4, '18.14.1.0007', 10000, '2021-02-24'),
(85, 4, '18.14.1.0012', 10000, '2021-02-24'),
(86, 4, '18.14.1.0014', 10000, '2021-02-24'),
(87, 4, '18.14.1.0021', 10000, '2021-02-24'),
(88, 4, '18.14.1.0027', 10000, '2021-02-24'),
(89, 4, '18.14.1.0028', 10000, '2021-02-24'),
(90, 4, '18.14.1.0033', 10000, '2021-02-24'),
(91, 4, '18.14.1.0034', 10000, '2021-02-24'),
(92, 4, '18.14.1.0040', 10000, '2021-02-24'),
(93, 4, '18.14.1.0046', 10000, '2021-02-24'),
(94, 4, '18.14.1.0047', 10000, '2021-02-24'),
(95, 4, '19.14.1.0001', 10000, '2021-02-24'),
(96, 4, '19.14.1.0005', 10000, '2021-02-24'),
(97, 4, '19.14.1.0009', 10000, '2021-02-24'),
(98, 4, '19.14.1.0011', 10000, '2021-02-24'),
(99, 4, '19.14.1.0012', 10000, '2021-02-24'),
(100, 4, '19.14.1.0019', 10000, '2021-02-24'),
(101, 4, '19.14.1.0022', 10000, '2021-02-24'),
(102, 4, '19.14.1.0029', 10000, '2021-02-24'),
(103, 4, '19.14.1.0031', 10000, '2021-02-24'),
(104, 4, '19.14.1.0034', 10000, '2021-02-24'),
(105, 4, '19.14.1.0038', 10000, '2021-02-24'),
(106, 4, '19.14.1.0039', 10000, '2021-02-24'),
(109, 5, '18.14.1.0004', 10000, '2021-03-26'),
(110, 5, '18.14.1.0007', 10000, '2021-03-26'),
(111, 5, '18.14.1.0012', 10000, '2021-03-26'),
(112, 5, '18.14.1.0014', 10000, '2021-03-26'),
(113, 5, '18.14.1.0021', 10000, '2021-03-27'),
(114, 6, '18.14.1.0001', 10000, '2021-04-30'),
(115, 5, '18.14.1.0027', 10000, '2021-03-05'),
(116, 5, '18.14.1.0028', 10000, '2021-03-05'),
(117, 5, '18.14.1.0033', 10000, '2021-03-05'),
(118, 5, '18.14.1.0034', 10000, '2021-03-05'),
(119, 5, '18.14.1.0040', 10000, '2021-03-05'),
(120, 5, '19.14.1.0001', 10000, '2021-03-05'),
(121, 5, '18.14.1.0046', 10000, '2021-03-05'),
(122, 5, '18.14.1.0047', 10000, '2021-03-05'),
(123, 5, '19.14.1.0005', 10000, '2021-03-05'),
(124, 5, '19.14.1.0009', 10000, '2021-03-05'),
(125, 5, '19.14.1.0011', 10000, '2021-03-05'),
(126, 5, '19.14.1.0012', 10000, '2021-03-05'),
(127, 5, '19.14.1.0019', 10000, '2021-03-05'),
(128, 5, '19.14.1.0029', 10000, '2021-03-05'),
(129, 5, '19.14.1.0022', 10000, '2021-03-05'),
(130, 5, '19.14.1.0031', 10000, '2021-03-05'),
(131, 5, '19.14.1.0034', 10000, '2021-03-05'),
(132, 5, '19.14.1.0038', 10000, '2021-03-05'),
(133, 5, '19.14.1.0039', 10000, '2021-03-05'),
(134, 10, '18.14.1.0001', 10000, '2021-07-08'),
(136, 7, '18.14.1.0001', 10000, '2021-05-15'),
(137, 6, '18.14.1.0003', 10000, '2021-04-12'),
(138, 6, '18.14.1.0004', 10000, '2021-04-12'),
(139, 6, '18.14.1.0007', 10000, '2021-04-12'),
(140, 6, '18.14.1.0012', 10000, '2021-04-12'),
(141, 6, '18.14.1.0014', 10000, '2021-04-12'),
(143, 7, '18.14.1.0004', 10000, '2021-05-12'),
(144, 6, '18.14.1.0021', 10000, '2021-04-12'),
(145, 6, '18.14.1.0027', 10000, '2021-04-12'),
(146, 6, '18.14.1.0028', 10000, '2021-04-12'),
(147, 6, '18.14.1.0033', 10000, '2021-04-12'),
(148, 6, '18.14.1.0034', 10000, '2021-04-12'),
(149, 6, '18.14.1.0040', 10000, '2021-04-12'),
(150, 8, '18.14.1.0001', 10000, '2021-06-12'),
(153, 5, '18.14.1.0001', 10000, '2021-03-22'),
(154, 5, '18.14.1.0003', 10000, '2021-03-22'),
(155, 6, '18.14.1.0046', 10000, '2021-04-22'),
(156, 6, '18.14.1.0047', 10000, '2021-04-22'),
(157, 6, '19.14.1.0001', 10000, '2021-04-22'),
(158, 6, '19.14.1.0005', 10000, '2021-04-22'),
(159, 6, '19.14.1.0009', 10000, '2021-04-22'),
(160, 6, '19.14.1.0011', 10000, '2021-04-22'),
(161, 6, '19.14.1.0012', 10000, '2021-04-22'),
(162, 6, '19.14.1.0019', 10000, '2021-04-22'),
(163, 6, '19.14.1.0022', 10000, '2021-04-22'),
(164, 6, '19.14.1.0029', 10000, '2021-04-22'),
(165, 6, '19.14.1.0031', 10000, '2021-04-22'),
(166, 6, '19.14.1.0034', 10000, '2021-04-22'),
(167, 6, '19.14.1.0038', 10000, '2021-04-22'),
(168, 6, '19.14.1.0039', 10000, '2021-04-22'),
(169, 7, '18.14.1.0003', 10000, '2021-05-08'),
(170, 7, '18.14.1.0007', 10000, '2021-05-08'),
(171, 7, '18.14.1.0012', 10000, '2021-05-22'),
(172, 7, '18.14.1.0014', 10000, '2021-05-22'),
(173, 7, '18.14.1.0021', 10000, '2021-05-22'),
(174, 7, '18.14.1.0027', 10000, '2021-05-22'),
(175, 7, '18.14.1.0028', 10000, '2021-05-22'),
(176, 7, '18.14.1.0033', 10000, '2021-05-22'),
(177, 7, '18.14.1.0034', 10000, '2021-05-22'),
(178, 7, '18.14.1.0040', 10000, '2021-05-22'),
(179, 7, '18.14.1.0046', 10000, '2021-05-22'),
(180, 7, '18.14.1.0047', 10000, '2021-05-22'),
(181, 7, '19.14.1.0001', 10000, '2021-05-22'),
(182, 7, '19.14.1.0005', 10000, '2021-05-22'),
(183, 7, '19.14.1.0009', 10000, '2022-05-22'),
(184, 7, '19.14.1.0011', 10000, '2021-05-22'),
(185, 7, '19.14.1.0012', 10000, '2021-05-22'),
(186, 7, '19.14.1.0019', 10000, '2021-05-22'),
(187, 7, '19.14.1.0022', 10000, '2021-05-22'),
(188, 7, '19.14.1.0029', 10000, '2021-05-22'),
(189, 7, '19.14.1.0031', 10000, '2021-05-22'),
(190, 7, '19.14.1.0034', 10000, '2021-05-22'),
(191, 7, '19.14.1.0038', 10000, '2021-05-22'),
(192, 7, '19.14.1.0039', 10000, '2021-05-22'),
(193, 8, '18.14.1.0003', 10000, '2021-06-22'),
(194, 8, '18.14.1.0004', 10000, '2021-06-22'),
(195, 8, '18.14.1.0007', 10000, '2021-06-22'),
(196, 8, '18.14.1.0012', 10000, '2021-06-22'),
(197, 8, '18.14.1.0014', 10000, '2021-06-22'),
(198, 10, '18.14.1.0001', 10000, '2021-07-22'),
(199, 8, '18.14.1.0021', 10000, '2021-06-22'),
(201, 8, '18.14.1.0027', 10000, '2021-07-22'),
(202, 10, '18.14.1.0004', 10000, '2021-07-22'),
(203, 8, '18.14.1.0028', 10000, '2021-06-22'),
(204, 10, '18.14.1.0007', 10000, '2021-07-22'),
(205, 8, '18.14.1.0033', 10000, '2021-06-22'),
(206, 10, '18.14.1.0012', 10000, '2021-07-22'),
(207, 8, '18.14.1.0034', 10000, '2021-06-22'),
(208, 10, '18.14.1.0014', 10000, '2021-07-22'),
(209, 8, '18.14.1.0040', 10000, '2021-06-22'),
(210, 10, '18.14.1.0021', 10000, '2021-07-22'),
(212, 10, '18.14.1.0027', 10000, '2021-07-22'),
(213, 8, '18.14.1.0046', 10000, '2021-06-22'),
(214, 10, '18.14.1.0028', 10000, '2021-07-22'),
(215, 10, '18.14.1.0033', 10000, '2021-07-22'),
(216, 10, '18.14.1.0046', 10000, '2021-07-22'),
(217, 8, '18.14.1.0047', 10000, '2021-06-22'),
(218, 10, '18.14.1.0047', 10000, '2021-07-22'),
(219, 8, '19.14.1.0001', 10000, '2021-06-22'),
(220, 10, '19.14.1.0001', 10000, '2021-07-22'),
(221, 8, '19.14.1.0005', 10000, '2021-06-22'),
(222, 10, '19.14.1.0005', 10000, '2021-07-22'),
(223, 8, '19.14.1.0009', 10000, '2021-06-22'),
(224, 10, '19.14.1.0009', 10000, '2021-07-22'),
(225, 8, '19.14.1.0011', 10000, '2021-06-22'),
(226, 10, '19.14.1.0011', 10000, '2021-07-22'),
(227, 8, '19.14.1.0012', 10000, '2021-06-22'),
(228, 10, '19.14.1.0012', 10000, '2021-07-22'),
(229, 8, '19.14.1.0019', 10000, '2021-06-22'),
(230, 10, '19.14.1.0019', 10000, '2021-07-22'),
(231, 8, '19.14.1.0022', 10000, '2021-06-22'),
(232, 10, '19.14.1.0022', 10000, '2021-07-22'),
(233, 8, '19.14.1.0029', 10000, '2021-06-22'),
(234, 10, '19.14.1.0029', 10000, '2021-07-22'),
(235, 8, '19.14.1.0031', 10000, '2021-06-22'),
(236, 10, '19.14.1.0031', 10000, '2021-07-22'),
(237, 8, '19.14.1.0034', 10000, '2021-06-22'),
(238, 10, '19.14.1.0034', 10000, '2021-07-22'),
(239, 8, '19.14.1.0038', 10000, '2021-06-22'),
(240, 10, '19.14.1.0038', 10000, '2021-07-22'),
(241, 8, '19.14.1.0039', 10000, '2021-06-22'),
(242, 10, '19.14.1.0039', 10000, '2022-07-22'),
(243, 10, '18.14.1.0034', 10000, '2021-07-23'),
(244, 10, '18.14.1.0040', 10000, '2021-07-23'),
(245, 10, '18.14.1.0003', 10000, '2021-07-23'),
(246, 13, '18.14.1.0001', 10000, '2021-08-23'),
(247, 13, '18.14.1.0003', 10000, '2021-08-23'),
(248, 13, '18.14.1.0004', 10000, '2021-08-23'),
(249, 13, '18.14.1.0007', 10000, '2021-08-23'),
(250, 13, '18.14.1.0012', 10000, '2021-08-23'),
(251, 13, '18.14.1.0014', 10000, '2021-08-23'),
(252, 13, '18.14.1.0021', 10000, '2021-08-23'),
(253, 13, '18.14.1.0027', 10000, '2021-08-23'),
(254, 13, '18.14.1.0028', 10000, '2021-08-23'),
(255, 13, '18.14.1.0033', 10000, '2021-08-23'),
(256, 13, '18.14.1.0034', 10000, '2021-08-08'),
(257, 13, '18.14.1.0040', 10000, '2021-08-23'),
(258, 13, '18.14.1.0046', 10000, '2021-08-23'),
(259, 13, '18.14.1.0047', 10000, '2021-08-23'),
(260, 13, '19.14.1.0001', 10000, '2021-08-23'),
(261, 13, '19.14.1.0005', 10000, '2021-08-23'),
(262, 13, '19.14.1.0009', 10000, '2021-08-23'),
(263, 13, '19.14.1.0011', 10000, '2021-08-23'),
(264, 13, '19.14.1.0012', 10000, '2021-08-23'),
(265, 13, '19.14.1.0019', 10000, '2021-08-23'),
(266, 13, '19.14.1.0022', 10000, '2021-08-23'),
(267, 13, '19.14.1.0029', 10000, '2021-08-23'),
(268, 13, '19.14.1.0031', 10000, '2021-08-23'),
(269, 13, '19.14.1.0034', 10000, '2021-08-23'),
(270, 13, '19.14.1.0038', 10000, '2021-08-23'),
(271, 13, '19.14.1.0039', 10000, '2021-08-23'),
(272, 14, '18.14.1.0001', 2000, '2023-03-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pengeluaran`
--

CREATE TABLE `t_pengeluaran` (
  `no_pk` int(11) NOT NULL,
  `id_mj` int(11) NOT NULL,
  `tgl_pk` date NOT NULL,
  `nama_pengeluaran` varchar(50) NOT NULL,
  `jml_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_pengeluaran`
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
-- Struktur dari tabel `t_pengurus`
--

CREATE TABLE `t_pengurus` (
  `id_pengurus` int(11) NOT NULL,
  `id_mj` int(11) NOT NULL,
  `id_mahasiswa_pt` varchar(15) NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_pengurus`
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
-- Struktur dari tabel `t_peserta`
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
-- Dumping data untuk tabel `t_peserta`
--

INSERT INTO `t_peserta` (`id`, `id_peserta`, `nama`, `asal_sekolah`, `alamat`, `telp`, `email`, `token`) VALUES
(13, 'PS.22.08.13', 'ANDI ALFIAN', 'SMKN 1 Majalengka', 'Blok Rabu Desa Sindang', '082320516254', 'andialfi90@gmail.com', '5LOdlWU13Ft8cQEwKDIyiAqPMh26xa'),
(15, 'PS.22.09.15', 'SRI RAHAYU', 'SMAN 1 Majalengka', 'Blok Rabu Desa Sindang', '082320516254', 'sriputih231099@gmail.com', 'lc6nsDQU0VwSdq1oZBzRAyWkb9i8YuErtfGa2PCMLIO7FjgmNv'),
(18, 'PS.22.12.18', 'AA', 'aaaa', 'aaa', '098923432', 'a@unma.ac.id', 'P9z43buKMfUNYIXQnqdHE1G8eBmk2pslA6iO5aDWFxTjyrctRZ'),
(19, 'PS.22.12.19', 'BB', 'bb', 'bb', '08237437', 'BB@gmail.com', 'CbvmRP6itH3h7ay9x8oAlVjkwfYq5UNKSnGEZ40IMdLzWJTeDc'),
(20, 'PS.23.02.20', 'CECE MAUDA', 'SMKN 1 LIGUNG', 'LIGUNG', '0893433121', 'cc@gmail.com', 'hrqmkZG5I3nMf4oNQcAWKOETL8HsxzDvbY27XtV1FwgUiJPldB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_post`
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
-- Dumping data untuk tabel `t_post`
--

INSERT INTO `t_post` (`id_post`, `id_mj`, `id_kategori`, `id_mahasiswa_pt`, `judul`, `slug`, `cover`, `body`, `is_published`, `dilihat`, `created_at`, `updated_at`) VALUES
(2, 1, 9, '18.14.1.0045', 'PESONA HMIF 2020', '73d14d45d714f3fb4db0963e69f4f2bd', 'IMG-20210208-WA0015.jpg', '<p><strong>Nama Program Kerja :</strong> PESONA HMIF 2020</p>\r\n<p><strong>Sasaran :</strong> Mahasiswa Informatika UNMA Semester 1&nbsp; dan yang belum mengikuti.</p>\r\n<p><strong>Metode Pelaksanaan :</strong> Pengenalan Studi Organisasi Himpunan Mahasiswa Informatika</p>\r\n<p><strong>Alokasi Waktu :</strong> 3 Jam</p>', 1, 8, '2021-12-06 14:37:04', '2021-12-06 07:37:04'),
(3, 1, 2, '18.14.1.0028', 'HMIF CUP', 'a34518b8a7ae4d4c57435a2124d9e25e', 'IMG_20210505_142056.jpg', '<p><strong>Program Kerja</strong> : HMIF CUP</p>\r\n<p><strong>Ketua Pelaksanan</strong> : Dea Juwita Suwardi</p>\r\n<p><strong>Perlombaan</strong> : Lomba desain poster, vlog, Mobile Legend dan PUBG Mobile</p>\r\n<p><strong>Pelaksaan</strong> : Online</p>', 1, 7, '2021-12-07 20:56:24', '2021-12-07 13:56:24'),
(4, 1, 9, '19.14.1.0039', 'HMIF Peduli', '45e530b47cde58576255dab0eb5d8f8a', 'IMG-20210626-WA0014.jpg', '<p><strong>Program Kerja</strong> : HMIF Peduli</p>\r\n<p><strong>Ketua Pelaksana</strong> : Dede Didin</p>\r\n<p><strong>Rundown Acara</strong> : Pembagian takjil, bantuan sosial ke anak yatim, dan buka bersama bareng demisioner serta alumni Informatika.</p>', 1, 9, '2021-12-07 21:09:03', '2021-12-07 14:09:03'),
(5, 1, 3, '18.14.1.0040', 'PROGRESMA 2021', '4d502815ea1ffa48f60d8450d5de09e4', 'progresma.jpg', '<p><strong>Program Kerja </strong>: PROGRESMA 2021</p>\r\n<p><strong>Ketua Pelaksana</strong> : Afif Surya Ramadhan</p>\r\n<p><strong>Rundown Acara</strong> : Diberi materi lalu di presentasi kan di lain hari.</p>', 1, 17, '2021-12-07 21:21:09', '2021-12-07 14:21:09'),
(6, 1, 9, '19.14.1.0001', 'MUSHMIF-UNMA yang ke-6', 'mushmif-unma-yang-ke-6', 'Untitled-1.jpg', '<p><strong>Ketua Pelaksana</strong> : AA Herdi Prayoga</p>\r\n<p><strong>Waktu </strong>: Pagi - malam</p>\r\n<p><strong>Hari/Tanggal </strong>: Sabtu, 23 Oktober 2021</p>\r\n<p><strong>Tempat </strong>: Ruang 301-302 Gedung Fakultas Teknik</p>\r\n<p>&nbsp;</p>', 0, 1, '2021-12-07 21:55:36', '2021-12-07 14:55:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_qrcode`
--

CREATE TABLE `t_qrcode` (
  `id` int(11) NOT NULL,
  `qrcode` varchar(255) NOT NULL,
  `nilai` varchar(100) NOT NULL,
  `expired` varchar(50) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_role`
--

CREATE TABLE `t_role` (
  `level` int(1) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_role`
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
-- Struktur dari tabel `t_tagihan`
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
-- Dumping data untuk tabel `t_tagihan`
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
(13, 1, 'Kas Agustus 2021', 10000, 14, 'Pengurus', '2021-08-01', '2021-08-29'),
(14, 1, 'KAS MARET', 2000, 14, 'Pengurus', '2023-03-04', '2023-03-31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_tagihan_anggota`
--

CREATE TABLE `t_tagihan_anggota` (
  `no_ta` int(11) NOT NULL,
  `id_mahasiswa_pt` varchar(15) NOT NULL,
  `no_tg` int(11) NOT NULL,
  `dibayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_tagihan_anggota`
--

INSERT INTO `t_tagihan_anggota` (`no_ta`, `id_mahasiswa_pt`, `no_tg`, `dibayar`) VALUES
(1, '18.14.1.0003', 1, 10000),
(2, '18.14.1.0004', 1, 10000),
(3, '18.14.1.0001', 1, 10000),
(4, '18.14.1.0014', 1, 10000),
(5, '18.14.1.0021', 1, 10000),
(6, '18.14.1.0007', 1, 10000),
(7, '18.14.1.0060', 1, 10000),
(8, '18.14.1.0012', 1, 10000),
(9, '18.14.1.0027', 1, 10000),
(10, '18.14.1.0034', 1, 10000),
(11, '18.14.1.0033', 1, 10000),
(12, '18.14.1.0046', 1, 10000),
(13, '18.14.1.0040', 1, 10000),
(14, '18.14.1.0028', 1, 10000),
(15, '18.14.1.0045', 1, 10000),
(16, '18.14.1.0047', 1, 10000),
(17, '19.14.1.0001', 1, 10000),
(19, '19.14.1.0005', 1, 10000),
(20, '19.14.1.0011', 1, 10000),
(21, '19.14.1.0009', 1, 10000),
(22, '19.14.1.0012', 1, 10000),
(23, '19.14.1.0019', 1, 10000),
(24, '19.14.1.0038', 1, 10000),
(25, '19.14.1.0022', 1, 10000),
(26, '19.14.1.0034', 1, 10000),
(27, '19.14.1.0029', 1, 10000),
(28, '19.14.1.0031', 1, 10000),
(29, '19.14.1.0039', 1, 10000),
(30, '18.14.1.0001', 2, 10000),
(31, '18.14.1.0003', 2, 10000),
(32, '18.14.1.0004', 2, 10000),
(33, '18.14.1.0007', 2, 10000),
(34, '18.14.1.0012', 2, 10000),
(35, '18.14.1.0014', 2, 10000),
(36, '18.14.1.0021', 2, 10000),
(37, '18.14.1.0027', 2, 10000),
(38, '18.14.1.0028', 2, 10000),
(39, '18.14.1.0033', 2, 10000),
(40, '18.14.1.0034', 2, 10000),
(41, '18.14.1.0040', 2, 10000),
(42, '18.14.1.0045', 2, 0),
(43, '18.14.1.0046', 2, 10000),
(44, '18.14.1.0047', 2, 10000),
(45, '18.14.1.0060', 2, 0),
(46, '19.14.1.0001', 2, 10000),
(47, '19.14.1.0005', 2, 10000),
(48, '19.14.1.0009', 2, 10000),
(49, '19.14.1.0011', 2, 10000),
(50, '19.14.1.0012', 2, 10000),
(51, '19.14.1.0019', 2, 10000),
(52, '19.14.1.0022', 2, 10000),
(53, '19.14.1.0029', 2, 10000),
(54, '19.14.1.0031', 2, 10000),
(55, '19.14.1.0034', 2, 10000),
(56, '19.14.1.0038', 2, 10000),
(57, '19.14.1.0039', 2, 10000),
(58, '18.14.1.0001', 3, 10000),
(59, '18.14.1.0003', 3, 10000),
(60, '18.14.1.0004', 3, 10000),
(61, '18.14.1.0007', 3, 10000),
(62, '18.14.1.0012', 3, 10000),
(63, '18.14.1.0014', 3, 10000),
(64, '18.14.1.0021', 3, 10000),
(65, '18.14.1.0027', 3, 10000),
(66, '18.14.1.0028', 3, 10000),
(67, '18.14.1.0033', 3, 10000),
(68, '18.14.1.0034', 3, 10000),
(69, '18.14.1.0040', 3, 10000),
(71, '18.14.1.0046', 3, 10000),
(72, '18.14.1.0047', 3, 10000),
(73, '18.14.1.0060', 3, 0),
(74, '19.14.1.0001', 3, 10000),
(75, '19.14.1.0005', 3, 10000),
(76, '19.14.1.0009', 3, 10000),
(77, '19.14.1.0011', 3, 10000),
(78, '19.14.1.0012', 3, 10000),
(79, '19.14.1.0019', 3, 10000),
(80, '19.14.1.0022', 3, 10000),
(81, '19.14.1.0029', 3, 10000),
(82, '19.14.1.0031', 3, 10000),
(83, '19.14.1.0034', 3, 10000),
(84, '19.14.1.0038', 3, 10000),
(85, '19.14.1.0039', 3, 10000),
(86, '18.14.1.0001', 4, 10000),
(87, '18.14.1.0003', 4, 10000),
(88, '18.14.1.0004', 4, 10000),
(89, '18.14.1.0007', 4, 10000),
(90, '18.14.1.0012', 4, 10000),
(91, '18.14.1.0014', 4, 10000),
(92, '18.14.1.0021', 4, 10000),
(93, '18.14.1.0027', 4, 10000),
(94, '18.14.1.0028', 4, 10000),
(95, '18.14.1.0033', 4, 10000),
(96, '18.14.1.0034', 4, 10000),
(97, '18.14.1.0040', 4, 10000),
(98, '18.14.1.0045', 4, 0),
(99, '18.14.1.0046', 4, 10000),
(100, '18.14.1.0047', 4, 10000),
(102, '19.14.1.0001', 4, 10000),
(103, '19.14.1.0005', 4, 10000),
(104, '19.14.1.0009', 4, 10000),
(105, '19.14.1.0011', 4, 10000),
(106, '19.14.1.0012', 4, 10000),
(107, '19.14.1.0019', 4, 10000),
(108, '19.14.1.0022', 4, 10000),
(109, '19.14.1.0029', 4, 10000),
(110, '19.14.1.0031', 4, 10000),
(111, '19.14.1.0034', 4, 10000),
(112, '19.14.1.0038', 4, 10000),
(113, '19.14.1.0039', 4, 10000),
(114, '18.14.1.0001', 5, 10000),
(115, '18.14.1.0003', 5, 10000),
(116, '18.14.1.0004', 5, 10000),
(117, '18.14.1.0007', 5, 10000),
(118, '18.14.1.0012', 5, 10000),
(119, '18.14.1.0014', 5, 10000),
(120, '18.14.1.0021', 5, 10000),
(121, '18.14.1.0027', 5, 10000),
(122, '18.14.1.0028', 5, 10000),
(123, '18.14.1.0033', 5, 10000),
(124, '18.14.1.0034', 5, 10000),
(125, '18.14.1.0040', 5, 10000),
(126, '18.14.1.0045', 5, 0),
(127, '18.14.1.0046', 5, 10000),
(128, '18.14.1.0047', 5, 10000),
(130, '19.14.1.0001', 5, 10000),
(131, '19.14.1.0005', 5, 10000),
(132, '19.14.1.0009', 5, 10000),
(133, '19.14.1.0011', 5, 10000),
(134, '19.14.1.0012', 5, 10000),
(135, '19.14.1.0019', 5, 10000),
(136, '19.14.1.0022', 5, 10000),
(137, '19.14.1.0029', 5, 10000),
(138, '19.14.1.0031', 5, 10000),
(139, '19.14.1.0034', 5, 10000),
(140, '19.14.1.0038', 5, 10000),
(141, '19.14.1.0039', 5, 10000),
(142, '18.14.1.0001', 6, 10000),
(143, '18.14.1.0003', 6, 10000),
(144, '18.14.1.0004', 6, 10000),
(145, '18.14.1.0007', 6, 10000),
(146, '18.14.1.0012', 6, 10000),
(147, '18.14.1.0014', 6, 10000),
(148, '18.14.1.0021', 6, 10000),
(149, '18.14.1.0027', 6, 10000),
(150, '18.14.1.0028', 6, 10000),
(151, '18.14.1.0033', 6, 10000),
(152, '18.14.1.0034', 6, 10000),
(153, '18.14.1.0040', 6, 10000),
(154, '18.14.1.0046', 6, 10000),
(155, '18.14.1.0047', 6, 10000),
(157, '19.14.1.0001', 6, 10000),
(158, '19.14.1.0005', 6, 10000),
(159, '19.14.1.0009', 6, 10000),
(160, '19.14.1.0011', 6, 10000),
(161, '19.14.1.0012', 6, 10000),
(162, '19.14.1.0019', 6, 10000),
(163, '19.14.1.0022', 6, 10000),
(164, '19.14.1.0029', 6, 10000),
(165, '19.14.1.0031', 6, 10000),
(166, '19.14.1.0034', 6, 10000),
(167, '19.14.1.0038', 6, 10000),
(168, '19.14.1.0039', 6, 10000),
(169, '18.14.1.0001', 7, 10000),
(170, '18.14.1.0003', 7, 10000),
(171, '18.14.1.0004', 7, 10000),
(172, '18.14.1.0007', 7, 10000),
(173, '18.14.1.0012', 7, 10000),
(174, '18.14.1.0014', 7, 10000),
(175, '18.14.1.0021', 7, 10000),
(176, '18.14.1.0027', 7, 10000),
(177, '18.14.1.0028', 7, 10000),
(178, '18.14.1.0033', 7, 10000),
(179, '18.14.1.0034', 7, 10000),
(180, '18.14.1.0040', 7, 10000),
(182, '18.14.1.0046', 7, 10000),
(183, '18.14.1.0047', 7, 10000),
(185, '19.14.1.0001', 7, 10000),
(186, '19.14.1.0005', 7, 10000),
(187, '19.14.1.0009', 7, 10000),
(188, '19.14.1.0011', 7, 10000),
(189, '19.14.1.0012', 7, 10000),
(190, '19.14.1.0019', 7, 10000),
(191, '19.14.1.0022', 7, 10000),
(192, '19.14.1.0029', 7, 10000),
(193, '19.14.1.0031', 7, 10000),
(194, '19.14.1.0034', 7, 10000),
(195, '19.14.1.0038', 7, 10000),
(196, '19.14.1.0039', 7, 10000),
(197, '18.14.1.0001', 8, 10000),
(198, '18.14.1.0003', 8, 10000),
(199, '18.14.1.0004', 8, 10000),
(200, '18.14.1.0007', 8, 10000),
(201, '18.14.1.0012', 8, 10000),
(202, '18.14.1.0014', 8, 10000),
(203, '18.14.1.0021', 8, 10000),
(204, '18.14.1.0027', 8, 10000),
(205, '18.14.1.0028', 8, 10000),
(206, '18.14.1.0033', 8, 10000),
(207, '18.14.1.0034', 8, 10000),
(208, '18.14.1.0040', 8, 10000),
(210, '18.14.1.0046', 8, 10000),
(211, '18.14.1.0047', 8, 10000),
(213, '19.14.1.0001', 8, 10000),
(214, '19.14.1.0005', 8, 10000),
(215, '19.14.1.0009', 8, 10000),
(216, '19.14.1.0011', 8, 10000),
(217, '19.14.1.0012', 8, 10000),
(218, '19.14.1.0019', 8, 10000),
(219, '19.14.1.0022', 8, 10000),
(220, '19.14.1.0029', 8, 10000),
(221, '19.14.1.0031', 8, 10000),
(222, '19.14.1.0034', 8, 10000),
(223, '19.14.1.0038', 8, 10000),
(224, '19.14.1.0039', 8, 10000),
(270, '18.14.1.0034', 10, 10000),
(271, '18.14.1.0046', 10, 10000),
(272, '19.14.1.0012', 10, 10000),
(273, '18.14.1.0012', 10, 10000),
(274, '19.14.1.0009', 10, 10000),
(275, '18.14.1.0014', 10, 10000),
(276, '18.14.1.0007', 10, 10000),
(277, '18.14.1.0001', 10, 10000),
(279, '18.14.1.0040', 10, 10000),
(280, '18.14.1.0004', 10, 10000),
(281, '18.14.1.0033', 10, 10000),
(282, '19.14.1.0031', 10, 10000),
(283, '18.14.1.0021', 10, 10000),
(284, '19.14.1.0001', 10, 10000),
(285, '19.14.1.0005', 10, 10000),
(286, '18.14.1.0027', 10, 10000),
(287, '19.14.1.0029', 10, 10000),
(288, '19.14.1.0034', 10, 10000),
(289, '19.14.1.0038', 10, 10000),
(290, '18.14.1.0047', 10, 10000),
(291, '19.14.1.0011', 10, 10000),
(292, '19.14.1.0019', 10, 10000),
(293, '19.14.1.0022', 10, 10000),
(294, '18.14.1.0028', 10, 10000),
(295, '19.14.1.0039', 10, 10000),
(296, '18.14.1.0003', 10, 10000),
(297, '18.14.1.0034', 13, 10000),
(298, '18.14.1.0046', 13, 10000),
(299, '19.14.1.0012', 13, 10000),
(300, '18.14.1.0012', 13, 10000),
(301, '19.14.1.0009', 13, 10000),
(302, '18.14.1.0014', 13, 10000),
(303, '18.14.1.0007', 13, 10000),
(304, '18.14.1.0001', 13, 10000),
(305, '18.14.1.0003', 13, 10000),
(306, '18.14.1.0040', 13, 10000),
(307, '18.14.1.0004', 13, 10000),
(308, '18.14.1.0033', 13, 10000),
(309, '19.14.1.0031', 13, 10000),
(310, '18.14.1.0021', 13, 10000),
(311, '19.14.1.0001', 13, 10000),
(312, '19.14.1.0005', 13, 10000),
(313, '18.14.1.0027', 13, 10000),
(314, '19.14.1.0029', 13, 10000),
(315, '19.14.1.0034', 13, 10000),
(316, '19.14.1.0038', 13, 10000),
(317, '18.14.1.0047', 13, 10000),
(318, '19.14.1.0011', 13, 10000),
(319, '19.14.1.0019', 13, 10000),
(320, '19.14.1.0022', 13, 10000),
(321, '18.14.1.0028', 13, 10000),
(322, '19.14.1.0039', 13, 10000),
(323, '18.14.1.0034', 14, 0),
(324, '18.14.1.0046', 14, 0),
(325, '18.14.1.0060', 14, 0),
(326, '19.14.1.0012', 14, 0),
(327, '18.14.1.0012', 14, 0),
(328, '19.14.1.0009', 14, 0),
(329, '18.14.1.0014', 14, 0),
(330, '18.14.1.0007', 14, 0),
(331, '18.14.1.0001', 14, 2000),
(332, '18.14.1.0003', 14, 0),
(333, '18.14.1.0040', 14, 0),
(334, '18.14.1.0004', 14, 0),
(335, '18.14.1.0033', 14, 0),
(336, '19.14.1.0031', 14, 0),
(337, '18.14.1.0021', 14, 0),
(338, '19.14.1.0001', 14, 0),
(339, '19.14.1.0005', 14, 0),
(340, '18.14.1.0027', 14, 0),
(341, '19.14.1.0029', 14, 0),
(342, '19.14.1.0034', 14, 0),
(343, '19.14.1.0038', 14, 0),
(344, '18.14.1.0047', 14, 0),
(345, '19.14.1.0011', 14, 0),
(346, '19.14.1.0019', 14, 0),
(347, '19.14.1.0022', 14, 0),
(348, '18.14.1.0028', 14, 0),
(349, '19.14.1.0039', 14, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_token`
--

CREATE TABLE `t_token` (
  `id_token` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE `t_user` (
  `id` int(11) NOT NULL,
  `id_mhs` varchar(15) NOT NULL,
  `id_mahasiswa_pt` varchar(15) DEFAULT NULL,
  `is_admin` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_user`
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
(49, '', '20.03.1.0002', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_absen`
--
ALTER TABLE `t_absen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_biaya_kegiatan`
--
ALTER TABLE `t_biaya_kegiatan`
  ADD PRIMARY KEY (`id_biaya`),
  ADD KEY `no_kg` (`no_kg`);

--
-- Indeks untuk tabel `t_cash_rule`
--
ALTER TABLE `t_cash_rule`
  ADD PRIMARY KEY (`id_cr`);

--
-- Indeks untuk tabel `t_contact_person`
--
ALTER TABLE `t_contact_person`
  ADD PRIMARY KEY (`id_cp`);

--
-- Indeks untuk tabel `t_controller`
--
ALTER TABLE `t_controller`
  ADD PRIMARY KEY (`id_ctr`);

--
-- Indeks untuk tabel `t_dokumentasi`
--
ALTER TABLE `t_dokumentasi`
  ADD PRIMARY KEY (`id_dk`),
  ADD KEY `no_kg` (`no_kg`);

--
-- Indeks untuk tabel `t_hima`
--
ALTER TABLE `t_hima`
  ADD PRIMARY KEY (`id_hima`);

--
-- Indeks untuk tabel `t_jabatan`
--
ALTER TABLE `t_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `t_kategori`
--
ALTER TABLE `t_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `t_kegiatan`
--
ALTER TABLE `t_kegiatan`
  ADD PRIMARY KEY (`no_kegiatan`);

--
-- Indeks untuk tabel `t_masa_jabatan`
--
ALTER TABLE `t_masa_jabatan`
  ADD PRIMARY KEY (`id_mj`);

--
-- Indeks untuk tabel `t_menu_access`
--
ALTER TABLE `t_menu_access`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_nonton`
--
ALTER TABLE `t_nonton`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_pemasukan`
--
ALTER TABLE `t_pemasukan`
  ADD PRIMARY KEY (`no_pm`);

--
-- Indeks untuk tabel `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  ADD PRIMARY KEY (`no_pb`);

--
-- Indeks untuk tabel `t_pengeluaran`
--
ALTER TABLE `t_pengeluaran`
  ADD PRIMARY KEY (`no_pk`);

--
-- Indeks untuk tabel `t_pengurus`
--
ALTER TABLE `t_pengurus`
  ADD PRIMARY KEY (`id_pengurus`);

--
-- Indeks untuk tabel `t_peserta`
--
ALTER TABLE `t_peserta`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_post`
--
ALTER TABLE `t_post`
  ADD PRIMARY KEY (`id_post`);

--
-- Indeks untuk tabel `t_qrcode`
--
ALTER TABLE `t_qrcode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_role`
--
ALTER TABLE `t_role`
  ADD PRIMARY KEY (`level`);

--
-- Indeks untuk tabel `t_tagihan`
--
ALTER TABLE `t_tagihan`
  ADD PRIMARY KEY (`no_tg`);

--
-- Indeks untuk tabel `t_tagihan_anggota`
--
ALTER TABLE `t_tagihan_anggota`
  ADD PRIMARY KEY (`no_ta`);

--
-- Indeks untuk tabel `t_token`
--
ALTER TABLE `t_token`
  ADD PRIMARY KEY (`id_token`);

--
-- Indeks untuk tabel `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_absen`
--
ALTER TABLE `t_absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=576;

--
-- AUTO_INCREMENT untuk tabel `t_biaya_kegiatan`
--
ALTER TABLE `t_biaya_kegiatan`
  MODIFY `id_biaya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `t_cash_rule`
--
ALTER TABLE `t_cash_rule`
  MODIFY `id_cr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `t_contact_person`
--
ALTER TABLE `t_contact_person`
  MODIFY `id_cp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `t_controller`
--
ALTER TABLE `t_controller`
  MODIFY `id_ctr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `t_dokumentasi`
--
ALTER TABLE `t_dokumentasi`
  MODIFY `id_dk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `t_hima`
--
ALTER TABLE `t_hima`
  MODIFY `id_hima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `t_jabatan`
--
ALTER TABLE `t_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `t_kategori`
--
ALTER TABLE `t_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `t_kegiatan`
--
ALTER TABLE `t_kegiatan`
  MODIFY `no_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `t_masa_jabatan`
--
ALTER TABLE `t_masa_jabatan`
  MODIFY `id_mj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `t_menu_access`
--
ALTER TABLE `t_menu_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT untuk tabel `t_nonton`
--
ALTER TABLE `t_nonton`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `t_pemasukan`
--
ALTER TABLE `t_pemasukan`
  MODIFY `no_pm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  MODIFY `no_pb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT untuk tabel `t_pengeluaran`
--
ALTER TABLE `t_pengeluaran`
  MODIFY `no_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `t_pengurus`
--
ALTER TABLE `t_pengurus`
  MODIFY `id_pengurus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT untuk tabel `t_peserta`
--
ALTER TABLE `t_peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `t_post`
--
ALTER TABLE `t_post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `t_qrcode`
--
ALTER TABLE `t_qrcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `t_tagihan`
--
ALTER TABLE `t_tagihan`
  MODIFY `no_tg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `t_tagihan_anggota`
--
ALTER TABLE `t_tagihan_anggota`
  MODIFY `no_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;

--
-- AUTO_INCREMENT untuk tabel `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
