-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18 Jan 2020 pada 08.09
-- Versi Server: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `laundry`
--

CREATE TABLE `laundry` (
  `id_laundry` varchar(6) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `gram` int(4) NOT NULL,
  `total_harga` varchar(50) NOT NULL,
  `tanggal_masuk` varchar(50) NOT NULL,
  `jadwal_selesai` enum('Sehari','Dua Hari','Tiga Hari','Empat Hari','Lima Hari','Enam Hari','Tujuh Hari') NOT NULL,
  `status` enum('Belum','Selesai','Lunas') NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laundry`
--

INSERT INTO `laundry` (`id_laundry`, `nama_pelanggan`, `telepon`, `id_paket`, `berat`, `gram`, `total_harga`, `tanggal_masuk`, `jadwal_selesai`, `status`, `id_petugas`) VALUES
('PG0001', 'Muhammad Zikri', '085263307063', 3, 2, 0, '18000', '12 January, 2020 (Sunday)', 'Dua Hari', 'Lunas', 1),
('PG0002', 'Muhammad Ibra', '085263307063', 2, 3, 0, '10000', '12 January, 2020 (Sunday)', 'Tiga Hari', 'Lunas', 1),
('PG0003', 'Kelvin', '08456454543', 3, 2, 0, '19000', '13 January, 2020 (Monday)', 'Sehari', 'Lunas', 1),
('PG0004', 'Ronny', '4343', 2, 2, 0, '9000', '13 January, 2020 (Monday)', 'Sehari', 'Lunas', 1),
('PG0005', 'Muhammad Zikri', '555', 2, 33, 0, '102000', '14 January, 2020 (Tuesday)', 'Sehari', 'Lunas', 1),
('PG0006', 'Budi', '087456453', 3, 5, 0, '40000', '14 January, 2020 (Tuesday)', '', 'Selesai', 1),
('PG0007', 'Zikri', '084635243', 3, 1, 0, '9000', '14 January, 2020 (Tuesday)', 'Tiga Hari', 'Belum', 1),
('PG0008', 'Muhammad Zikri', '0967857643', 3, 1, 500, '12000', '14 January, 2020 (Tuesday)', '', 'Belum', 1),
('PG0009', 'rr', '66', 2, 1, 500, '4500', '14 January, 2020 (Tuesday)', '', 'Belum', 1),
('PG0010', 'hh', '77', 2, 1, 500, '4500', '14 January, 2020 (Tuesday)', '', 'Lunas', 1),
('PG0011', 'jj', '77', 2, 1, 100, '3300', '14 January, 2020 (Tuesday)', '', 'Belum', 1),
('PG0012', '55', '55', 2, 1, 750, '5250', '14 January, 2020 (Tuesday)', '', 'Belum', 2),
('PG0013', '8', '5', 2, 1, 650, '4950', '14 January, 2020 (Tuesday)', '', 'Selesai', 2),
('PG0014', '66', '666', 2, 1, 500, '7500', '14 January, 2020 (Tuesday)', 'Sehari', 'Belum', 2),
('PG0015', 'dssd', '666', 1, 1, 0, '12000', '17 January, 2020 (Friday)', 'Sehari', 'Belum', 1),
('PG0016', 'dfdfd', '65656', 3, 2, 350, '20800', '17 January, 2020 (Friday)', 'Lima Hari', 'Lunas', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` enum('admin','operator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'admin'),
(2, 'operator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `harga_paket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `harga_paket`) VALUES
(1, 'Cuci Saja', '6000'),
(2, 'Setrika Saja', '3000'),
(3, 'Cuci + Setrika', '8000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `jenis_kelamin`, `username`, `password`, `id_level`) VALUES
(1, 'Muhammad Zikri', 'laki-laki', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'Muhammad Ibra', 'laki-laki', 'operator', '4b583376b2767b923c3e1da60d10de59', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(6) NOT NULL,
  `id_laundry` varchar(6) NOT NULL,
  `uang` varchar(50) NOT NULL,
  `kembalian` varchar(50) NOT NULL,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_laundry`, `uang`, `kembalian`, `tanggal_transaksi`) VALUES
('TR0001', 'PG0001', '20000', '2000', '2020-01-13 00:21:20'),
('TR0002', 'PG0002', '20000', '10000', '2020-01-13 05:15:18'),
('TR0003', 'PG0003', '20000', '1000', '2020-01-13 06:42:27'),
('TR0004', 'PG0004', '10000', '1000', '2020-01-14 03:10:18'),
('TR0005', 'PG0005', '150000', '48000', '2020-01-14 03:28:32'),
('TR0006', 'PG0010', '5000', '500', '2020-01-14 14:19:42'),
('TR0007', 'PG0016', '21000', '200', '2020-01-17 02:27:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laundry`
--
ALTER TABLE `laundry`
  ADD PRIMARY KEY (`id_laundry`),
  ADD KEY `id_paket` (`id_paket`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `id_level` (`id_level`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_laundry` (`id_laundry`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
