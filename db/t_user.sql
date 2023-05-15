-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 26 Jan 2023 pada 22.36
-- Versi server: 10.5.17-MariaDB-cll-lve
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1637795_hima`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE `t_user` (
  `id` int(11) NOT NULL,
  `id_mhs` varchar(15) DEFAULT NULL,
  `id_mahasiswa_pt` varchar(15) DEFAULT NULL,
  `is_admin` int(1) NOT NULL DEFAULT 0
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
(12, '180099', '18.14.1.0004', 0),
(14, '180741', '18.14.1.0033', 0),
(15, '181048', '18.14.1.0045', 0),
(16, '190118', '19.14.1.0001', 0),
(18, '190312', '19.14.1.0005', 0),
(19, '190480', '19.14.1.0009', 0),
(25, '191309', '19.14.1.0031', 0),
(26, '191144', '19.14.1.0034', 0),
(47, NULL, '18.14.1.0027', 0),
(49, NULL, '18.14.1.0060', 0),
(50, NULL, '20.16.1.0008', 0),
(51, NULL, '18.07.1.0012', 0),
(52, NULL, '20.17.1.0013', 0),
(53, NULL, '20.23.1.0004', 0),
(54, NULL, '21.06.1.0007', 0),
(55, NULL, '18.01.1.0047', 0),
(56, NULL, '22.11.1.0001', 0),
(57, NULL, '21.18.1.0010', 0),
(58, NULL, '21.24.1.0005', 0),
(59, NULL, '21.22.1.0068', 0),
(60, NULL, '21.22.1.0032', 0),
(61, NULL, '20.01.1.0016', 0),
(62, NULL, '21.01.1.0022', 0),
(63, NULL, '21.01.1.0021', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
