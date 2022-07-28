-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jul 2022 pada 18.25
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test4`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `RFIDP` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `suhu` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `RFIDP`, `tanggal`, `jam`, `suhu`) VALUES
(3, '90A6361A', '2022-05-28', '15:13:34', 36),
(4, 'B17BC726', '2022-05-28', '15:13:38', 36),
(16, '90A6361A', '2022-06-03', '15:18:45', 38),
(17, '90A6361A', '2022-06-03', '15:19:42', 33),
(18, 'B17BC726', '2022-06-04', '16:55:00', 36),
(19, '90A6361A', '2022-06-04', '17:32:43', 36),
(20, '90A6361A', '2022-06-04', '17:32:44', 36),
(21, '90A6361A', '2022-06-04', '17:50:39', 36),
(22, '90A6361A', '2022-06-04', '17:50:54', 36),
(29, '90A6361A', '2022-06-04', '17:51:15', 36),
(30, '90A6361A', '2022-06-04', '17:51:15', 36),
(31, '90A6361A', '2022-06-04', '17:51:19', 36),
(32, '90A6361A', '2022-06-04', '17:51:21', 36),
(33, '90A6361A', '2022-06-04', '17:51:24', 36),
(34, '90A6361A', '2022-06-05', '07:31:15', 29),
(35, '90A6361A', '2022-06-05', '07:31:28', 29),
(36, 'B17BC726', '2022-06-05', '07:31:36', 29),
(37, 'B17BC726', '2022-06-05', '07:31:41', 29),
(38, 'B17BC726', '2022-06-05', '07:31:51', 36),
(39, 'B17BC726', '2022-06-05', '07:32:03', 36),
(40, 'B17BC726', '2022-06-05', '07:32:19', 33),
(41, 'B17BC726', '2022-06-05', '07:55:35', 30),
(42, 'B17BC726', '2022-06-05', '08:03:10', 29),
(43, 'B17BC726', '2022-06-05', '08:08:19', 31),
(44, 'B17BC726', '2022-06-05', '08:26:38', 30),
(45, 'B17BC726', '2022-06-05', '08:36:31', 30),
(46, 'B17BC726', '2022-05-10', '08:36:55', 30),
(47, 'B17BC726', '2022-06-05', '08:44:10', 30),
(48, 'B17BC726', '2022-06-05', '10:50:40', 31),
(49, 'B17BC726', '2022-06-05', '10:52:01', 32),
(50, 'B17BC726', '2022-06-05', '10:52:21', 32),
(51, 'B17BC726', '2022-06-05', '10:52:39', 32),
(52, 'B17BC726', '2022-06-05', '10:53:33', 32),
(53, 'B17BC726', '2022-06-05', '10:59:39', 32),
(54, 'B17BC726', '2022-06-05', '11:00:29', 32),
(55, '90A6361A', '2022-06-05', '11:00:52', 32),
(56, '90A6361A', '2022-06-05', '11:38:51', 34),
(57, '90A6361A', '2022-06-05', '11:38:54', 34),
(58, '90A6361A', '2022-06-05', '11:38:57', 34),
(59, '90A6361A', '2022-06-05', '11:39:07', 37),
(60, '90A6361A', '2022-06-05', '11:41:21', 33.69),
(61, '90A6361A', '2022-06-05', '11:41:50', 37.31),
(62, '90A6361A', '2022-06-05', '11:42:23', 36.75),
(63, '90A6361A', '2022-06-05', '13:45:58', 33.95),
(72, 'B17BC726', '2022-07-11', '02:40:57', 34),
(73, 'B17BC726', '2022-07-11', '02:42:01', 31.53),
(74, 'B17BC726', '2022-07-11', '02:42:17', 30.35),
(75, 'B17BC726', '2022-07-11', '02:42:33', 35.21),
(77, 'B17BC726', '2022-07-11', '03:31:01', 30.53),
(78, 'B17BC726', '2022-07-11', '03:31:41', 0),
(79, 'B17BC726', '2022-07-11', '03:31:41', 4),
(81, '90A6361A', '2022-07-14', '19:22:24', 31.75),
(82, '90A6361A', '2022-07-14', '19:22:39', 37.29),
(83, '90A6361A', '2022-07-14', '19:22:52', 35.95),
(84, '90A6361A', '2022-07-14', '19:23:00', 33.51),
(85, '90A6361A', '2022-07-14', '19:23:08', 35.77),
(86, '90A6361A', '2022-07-14', '19:23:16', 36.89),
(87, '90A6361A', '2022-07-14', '19:27:44', 32.41),
(88, '90A6361A', '2022-07-14', '19:27:57', 35.55),
(89, '90A6361A', '2022-07-14', '19:28:17', 33.87),
(90, '90A6361A', '2022-07-14', '19:28:27', 33.05),
(91, '90A6361A', '2022-07-14', '19:28:38', 33.97),
(92, '90A6361A', '2022-07-14', '19:28:46', 33.39),
(93, '90A6361A', '2022-07-14', '19:29:20', 44.41),
(94, '90A6361A', '2022-07-14', '19:29:25', 44.39),
(95, '90A6361A', '2022-07-14', '19:29:47', 46.31),
(96, '90A6361A', '2022-07-14', '19:30:12', 47.43),
(97, '90A6361A', '2022-07-14', '19:30:33', 49.95),
(98, '90A6361A', '2022-07-14', '19:30:49', 50.85),
(99, '90A6361A', '2022-07-14', '19:33:10', 60.03),
(100, '90A6361A', '2022-07-14', '19:33:18', 60.39),
(101, '90A6361A', '2022-07-14', '19:33:29', 61.27),
(102, '90A6361A', '2022-07-14', '19:33:44', 57.71),
(103, '90A6361A', '2022-07-14', '19:33:47', 57.79),
(104, '90A6361A', '2022-07-14', '19:33:53', 61.07),
(105, '90A6361A', '2022-07-14', '19:34:03', 61.87),
(106, '90A6361A', '2022-07-14', '19:34:08', 62.29),
(107, '90A6361A', '2022-07-14', '19:34:19', 38.81),
(108, '90A6361A', '2022-07-14', '19:34:22', 38.67),
(109, '90A6361A', '2022-07-15', '07:23:22', 30.35),
(110, '90A6361A', '2022-07-15', '07:23:27', 32.13),
(113, '90A6361A', '2022-07-15', '07:55:11', 30.53),
(114, '90A6361A', '2022-07-15', '07:56:25', 30.55),
(115, '90A6361A', '2022-07-15', '07:57:16', 30.39),
(116, '90A6361A', '2022-07-15', '08:00:24', 30.61),
(117, '90A6361A', '2022-07-15', '08:01:24', 30.61),
(128, '90A6361A', '2022-07-15', '08:04:18', 30.61),
(133, '90A6361A', '2022-07-15', '08:07:23', 30.87),
(134, '90A6361A', '2022-07-15', '08:07:40', 30.39),
(135, '90A6361A', '2022-07-15', '08:08:01', 30.81),
(137, '90A6361A', '2022-07-15', '09:52:18', 33.25),
(138, 'B17BC726', '2022-07-15', '09:53:18', 33.89),
(139, 'B17BC726', '2022-07-15', '09:53:38', 33.37),
(140, 'B17BC726', '2022-07-15', '09:54:08', 33.25),
(141, '90A6361A', '2022-07-15', '10:07:52', 33.53),
(142, '90A6361A', '2022-07-15', '10:11:17', 33.19),
(143, 'B17BC726', '2022-07-15', '10:14:16', 34.89),
(144, 'B17BC726', '2022-07-15', '10:15:38', 35.61),
(145, 'B17BC726', '2022-07-15', '10:23:54', 33.73),
(146, 'B17BC726', '2022-07-15', '10:26:25', 33.41),
(147, 'B17BC726', '2022-07-15', '10:28:37', 33.51),
(148, '90A6361A', '2022-07-15', '10:30:58', 33.47),
(149, 'B17BC726', '2022-07-15', '10:32:40', 33.53),
(150, '90A6361A', '2022-07-15', '10:32:48', 33.39),
(151, 'B17BC726', '2022-07-15', '10:33:51', 33.33),
(152, '90A6361A', '2022-07-15', '10:36:54', 33.53),
(153, '90A6361A', '2022-07-15', '10:38:19', 33.47),
(154, 'B17BC726', '2022-07-15', '10:38:24', 33.55),
(155, 'B17BC726', '2022-07-15', '10:46:33', 33.83),
(156, 'B17BC726', '2022-07-15', '10:49:34', 33.59),
(157, 'B17BC726', '2022-07-15', '10:50:42', 33.61),
(158, '90A6361A', '2022-07-15', '10:50:46', 33.89),
(159, '90A6361A', '2022-07-15', '11:03:37', 34.53),
(160, '90A6361A', '2022-07-15', '11:04:09', 34.39),
(161, 'B17BC726', '2022-07-15', '11:04:19', 34.59),
(162, 'B17BC726', '2022-07-15', '11:05:03', 34.39),
(163, 'B17BC726', '2022-07-15', '11:05:25', 34.37),
(164, '90A6361A', '2022-07-15', '11:06:39', 34.53),
(165, 'B17BC726', '2022-07-15', '11:08:31', 34.31),
(166, '90A6361A', '2022-07-15', '11:09:53', 33.95),
(167, '90A6361A', '2022-07-15', '11:27:43', 33.89),
(168, 'B17BC726', '2022-07-15', '11:37:19', 34.29),
(169, 'B17BC726', '2022-07-15', '11:40:17', 34.29),
(170, 'B17BC726', '2022-07-15', '11:40:20', 34.33),
(171, 'B17BC726', '2022-07-15', '11:40:41', 34.45),
(172, '90A6361A', '2022-07-15', '11:50:49', 34.47),
(173, 'B17BC726', '2022-07-15', '11:53:05', 34.19),
(174, '90A6361A', '2022-07-15', '12:00:08', 33.79),
(175, '90A6361A', '2022-07-15', '12:01:04', 33.91),
(176, '90A6361A', '2022-07-15', '12:01:11', 34.03),
(177, 'B17BC726', '2022-07-15', '12:01:23', 34.03),
(179, 'B17BC726', '2022-07-15', '12:43:34', 34.55),
(180, 'B17BC726', '2022-07-15', '12:50:21', 34.81),
(183, 'B17BC726', '2022-07-15', '12:54:12', 34.67),
(185, 'B17BC726', '2022-07-15', '12:59:15', 35.19),
(187, '90A6361A', '2022-07-15', '13:10:25', 35.47),
(188, 'B17BC726', '2022-07-15', '13:13:27', 35.33),
(189, '90A6361A', '2022-07-15', '13:15:52', 35.49),
(191, '90A6361A', '2022-07-15', '13:22:22', 34.73),
(192, '90A6361A', '2022-07-16', '10:23:43', 32.09),
(193, 'B17BC726', '2022-07-16', '10:23:53', 31.93),
(194, 'B17BC726', '2022-07-16', '10:25:57', 32.43),
(195, 'B17BC726', '2022-07-16', '10:26:08', 32.61),
(196, 'B17BC726', '2022-07-16', '10:27:27', 32.41),
(197, 'B17BC726', '2022-07-16', '10:27:33', 32.03);

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `RFIDP` varchar(10) NOT NULL,
  `namaAnggota` text NOT NULL,
  `kelas` varchar(11) NOT NULL,
  `email` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`RFIDP`, `namaAnggota`, `kelas`, `email`) VALUES
('6091CB1A', 'Ridho', 'XII TKJ 5', '223210011@student.unaki.ac.id'),
('9091EB1A', 'J. Fla', 'XII TKJ 3', '223210011@student.unaki.ac.id'),
('90A6361A', 'Shafira', 'XII TKJ 1', '223210011@student.unaki.ac.id'),
('B17BC726', 'Rizal Faizin Firdaus', 'XII TKJ 2', 'rizalfaizinfirdaus@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `RFIDB` varchar(50) NOT NULL,
  `idBuku` varchar(4) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`RFIDB`, `idBuku`, `status`) VALUES
('0CC5A4EE', 'B002', 1),
('0CE5A4EE', 'B001', 0),
('4C159EEE', 'B001', 1),
('4CDCA2EE', 'B012', 1),
('6091CB1A', 'B012', 1),
('6CA9A2EE', 'B002', 1),
('6CB3A2EE', 'B002', 1),
('9091EB1A', 'B012', 1),
('AC0F9CEE', 'B001', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `idBuku` varchar(4) NOT NULL,
  `namaBuku` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`idBuku`, `namaBuku`) VALUES
('B001', 'MATEMATIKA'),
('B002', 'BAHASA INDONESIA'),
('B012', 'FISIKA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `kodePinjam` int(11) NOT NULL,
  `RFIDP` varchar(20) NOT NULL,
  `RFIDB` varchar(20) NOT NULL,
  `tanggalPinjam` date NOT NULL,
  `tanggalKembali` date NOT NULL,
  `warning` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`kodePinjam`, `RFIDP`, `RFIDB`, `tanggalPinjam`, `tanggalKembali`, `warning`) VALUES
(89, 'B17BC726', '4C159EEE', '2022-05-02', '2022-06-05', 1),
(90, 'B17BC726', '4CDCA2EE', '2022-05-02', '2022-06-05', 1),
(91, 'B17BC726', '4C159EEE', '2022-05-02', '2022-06-05', 1),
(92, 'B17BC726', '4CDCA2EE', '2022-05-02', '2022-06-05', 1),
(93, 'B17BC726', '0CC5A4EE', '2022-05-02', '2022-06-05', 1),
(95, '90A6361A', '4CDCA2EE', '2022-05-02', '0000-00-00', 1),
(96, 'B17BC726', '4CDCA2EE', '2022-05-02', '2022-07-11', 1),
(97, 'B17BC726', '4C159EEE', '2022-05-02', '2022-07-11', 1),
(98, '6091CB1A', '0CE5A4EE', '2022-05-02', '0000-00-00', 1),
(99, '6091CB1A', '0CE5A4EE', '2022-05-02', '0000-00-00', 1),
(100, '6091CB1A', '0CE5A4EE', '2022-05-02', '2022-07-13', 0),
(101, '6091CB1A', '0CE5A4EE', '2022-05-02', '2022-07-19', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'rizal', '$2y$10$eZDaYYaZy8/DbyRD9QpXferToxQ7lgx0jdi6trMLVP9sig1IvY4ia'),
(3, 'admin', '$2y$10$TgW/Ltn3w6qTbwLpl9DMYOCJaYVddVpXHOXPeY2GLZ45jrQvF1A/i'),
(4, 'rizal_faizin_firdaus', '$2y$10$LtlSr0zHMi8RQvipcVwFMeeTjTkBf/jene09usr.ssQWCSuibyfmW');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `RFIDP` (`RFIDP`);

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`RFIDP`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`RFIDB`),
  ADD KEY `idBuku` (`idBuku`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`idBuku`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`kodePinjam`),
  ADD KEY `RFIDP` (`RFIDP`),
  ADD KEY `RFIDB` (`RFIDB`),
  ADD KEY `RFIDP_2` (`RFIDP`,`RFIDB`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `kodePinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`RFIDP`) REFERENCES `anggota` (`RFIDP`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`idBuku`) REFERENCES `mapel` (`idBuku`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`RFIDB`) REFERENCES `buku` (`RFIDB`) ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`RFIDP`) REFERENCES `anggota` (`RFIDP`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
