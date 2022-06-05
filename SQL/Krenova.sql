-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jun 2022 pada 09.43
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
(46, 'B17BC726', '2022-06-05', '08:36:55', 30),
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
(63, '90A6361A', '2022-06-05', '13:45:58', 33.95);

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
('90A6361A', 'Ahmad Dwiyanto', 'XII TKJ 1', 'pantatbabibersinar06@gmail.com'),
('B17BC726', 'Rizal Faizin Firdaus', 'XII TKJ 2', 'rizalfaizinfirdaus@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `RFIDB` varchar(50) NOT NULL,
  `idBuku` varchar(4) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`RFIDB`, `idBuku`, `status`) VALUES
('0CC5A4EE', 'B002', 1),
('0CE5A4EE', 'B001', 1),
('4C159EEE', 'B001', 1),
('4CDCA2EE', 'B002', 1),
('6CA9A2EE', 'B002', 1),
('6CB3A2EE', 'B002', 1),
('AC0F9CEE', 'B001', 1);

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
('B002', 'BAHASA INDONESIA');

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
(95, '90A6361A', '4CDCA2EE', '2022-05-02', '2022-06-05', 1);

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
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `kodePinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

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
