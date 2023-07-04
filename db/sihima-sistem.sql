-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2023 at 03:37 PM
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
(17, 'Pembayaran', 'input data bayar, dan hapus data'),
(18, 'Tagihan_anggota', 'detail_tagihan, input_tagihan_pengurus, i_tagihan_anggota_lainnya, delete_tagihan_anggota'),
(19, 'Cash_rule', 'Insert - Update - Delete');

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
(92, 5, 19);

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

--
-- Dumping data for table `t_qrcode`
--

INSERT INTO `t_qrcode` (`id`, `qrcode`, `nilai`, `expired`) VALUES
(18, '9uB1XkD3IigjoSGfJLU7rNOZWPxeE5ywtmzK8CTq.png', '18.14.1.0034', '1688564175');

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
-- Table structure for table `t_token`
--

CREATE TABLE `t_token` (
  `id_token` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_controller`
--
ALTER TABLE `t_controller`
  ADD PRIMARY KEY (`id_ctr`);

--
-- Indexes for table `t_kategori`
--
ALTER TABLE `t_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `t_menu_access`
--
ALTER TABLE `t_menu_access`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `t_token`
--
ALTER TABLE `t_token`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_controller`
--
ALTER TABLE `t_controller`
  MODIFY `id_ctr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `t_kategori`
--
ALTER TABLE `t_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_menu_access`
--
ALTER TABLE `t_menu_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `t_qrcode`
--
ALTER TABLE `t_qrcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
