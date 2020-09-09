-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 09, 2020 at 03:57 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reserve`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses_role`
--

CREATE TABLE `akses_role` (
  `akses_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akses_role`
--

INSERT INTO `akses_role` (`akses_role`, `id_menu`, `id_role`) VALUES
(1, 9, 1),
(2, 11, 1),
(134, 1, 1),
(135, 10, 1),
(136, 22, 1),
(137, 46, 1),
(138, 47, 1),
(139, 49, 1),
(140, 50, 1),
(141, 51, 1),
(142, 52, 1),
(143, 53, 1);

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE `backup` (
  `id_backup` int(11) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `file` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_kamar` char(7) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `diskon` int(11) NOT NULL DEFAULT 0,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_transaksi`, `id_kamar`, `qty`, `diskon`, `total_harga`) VALUES
(4, 'KMR0001', 1, 0, 100000),
(4, 'KMR0002', 1, 5000, 195000),
(5, 'KMR0001', 1, 0, 100000),
(3, 'KMR0001', 1, 0, 100000),
(3, 'KMR0002', 2, 0, 400000),
(6, 'KMR0002', 5, 100000, 500000),
(7, 'KMR0002', 4, 60000, 560000),
(7, 'KMR0001', 2, 10000, 180000);

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id` int(11) NOT NULL,
  `id_kamar` char(7) NOT NULL,
  `nama_kamar` varchar(128) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id`, `id_kamar`, `nama_kamar`, `harga`, `keterangan`) VALUES
(3, 'KMR0001', 'Kamar 1', 100000, ''),
(4, 'KMR0002', 'Kamar 2', 200000, '');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `ada_submenu` int(11) NOT NULL,
  `submenu` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `icon`, `ada_submenu`, `submenu`, `url`, `urutan`) VALUES
(1, 'Dashboard', 'fa fa-dashboard', 0, 0, 'dashboard', 1),
(9, 'Petugas', 'fa fa-shield', 1, 0, 'petugas', 3),
(10, 'Data Petugas', '', 0, 9, 'petugas', 1),
(11, 'Akses Menu Petugas', '', 0, 9, 'petugas/akses', 2),
(22, 'Profil Saya', 'fa fa-user', 0, 0, 'profil', 7),
(46, 'Utilitas', 'fa fa-database', 1, 0, 'utilitas', 6),
(47, 'Backup Database', '', 0, 46, 'utilitas/backup', 1),
(49, 'Data Master', 'fa fa-archive', 1, 0, 'master', 2),
(50, 'Data Kamar', '', 0, 49, 'master/kamar', 1),
(51, 'Data Pengunjung', '', 0, 49, 'master/pengunjung', 2),
(52, 'Transaksi', 'fa fa-credit-card', 0, 0, 'transaksi', 4),
(53, 'Laporan', 'fa fa-book', 0, 0, 'laporan', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `logo` varchar(128) NOT NULL,
  `smtp_host` varchar(128) NOT NULL,
  `smtp_email` varchar(128) NOT NULL,
  `smtp_username` varchar(128) NOT NULL,
  `smtp_password` varchar(128) NOT NULL,
  `smtp_port` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `logo`, `smtp_host`, `smtp_email`, `smtp_username`, `smtp_password`, `smtp_port`) VALUES
(1, 'favicon.png', 'ssl://smtp.gmail.com', 'smtpemail@gmail.com', 'smtp username', 'password', 465);

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id_pengunjung` int(11) NOT NULL,
  `tgl_pengunjung` date NOT NULL,
  `nama_lembaga` varchar(128) DEFAULT NULL,
  `nama_pengunjung` varchar(128) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(30) DEFAULT NULL,
  `no_fax` varchar(30) DEFAULT NULL,
  `no_hp` varchar(30) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`id_pengunjung`, `tgl_pengunjung`, `nama_lembaga`, `nama_pengunjung`, `alamat`, `no_telp`, `no_fax`, `no_hp`, `email`, `status`) VALUES
(1, '2020-09-30', 'PT. Coca cola', 'Abdurrahman Shah', 'Bandung', '083822623170', '1231', '083xxx', 'abdu@gmail.com', 'Kunjungan'),
(3, '2020-09-09', 'PT. Google Indonesia', 'Muhammad Rivaldi', 'Bandung', '083822623170', '0822', '083xxx', 'rivaldi@gmail.com', 'Order'),
(4, '2004-03-09', 'Qui commodi est iste', 'Ipsum laudantium q', 'Non vero sapiente ne', 'Quis ea sed alias su', '+1 (766) 875-1412', 'Sit dignissimos vel', 'gefu@mailinator.com', 'Kunjungan'),
(5, '1994-02-27', 'Porro cum ipsum quam', 'Est amet possimus ', 'In possimus et do s', 'Provident culpa vit', '+1 (767) 122-2617', 'Excepturi eos eiusm', 'dezo@mailinator.com', 'Kunjungan');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` char(7) NOT NULL,
  `nama_petugas` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `telepon` char(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `alamat`, `jk`, `telepon`, `email`, `password`, `gambar`, `id_role`) VALUES
('PTS0001', 'Administrator', 'Jl. Soekarno', 'L', '083822623170', 'admin@admin.com', '$2y$10$sWlu3euo4kLhzznp5wyU5uzLo3BEa77k.5takRBv6O6Rm28mWzFxG', 'man1.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `token_petugas`
--

CREATE TABLE `token_petugas` (
  `id_token_petugas` int(11) NOT NULL,
  `id_petugas` char(7) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp(),
  `token` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `id_petugas` char(7) NOT NULL,
  `id_pengunjung` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `cash` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `tgl_transaksi`, `id_petugas`, `id_pengunjung`, `total_bayar`, `cash`, `keterangan`) VALUES
(3, '2020-09-09 01:22:00', 'PTS0001', 4, 500000, 500000, ''),
(4, '2020-09-09 01:25:00', 'PTS0001', 3, 295000, 300000, ''),
(5, '2020-09-09 02:38:00', 'PTS0001', 1, 100000, 500000, 'asd'),
(6, '2020-09-09 03:16:00', 'PTS0001', 1, 500000, 500000, ''),
(7, '1982-04-16 19:50:00', 'PTS0001', 1, 740000, 750000, 'Voluptate fugiat ul');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses_role`
--
ALTER TABLE `akses_role`
  ADD PRIMARY KEY (`akses_role`);

--
-- Indexes for table `backup`
--
ALTER TABLE `backup`
  ADD PRIMARY KEY (`id_backup`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id_pengunjung`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `token_petugas`
--
ALTER TABLE `token_petugas`
  ADD PRIMARY KEY (`id_token_petugas`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses_role`
--
ALTER TABLE `akses_role`
  MODIFY `akses_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `backup`
--
ALTER TABLE `backup`
  MODIFY `id_backup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id_pengunjung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `token_petugas`
--
ALTER TABLE `token_petugas`
  MODIFY `id_token_petugas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
