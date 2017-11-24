-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2017 at 07:07 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_etiketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `beli_tiket`
--

CREATE TABLE `beli_tiket` (
  `id_bt` int(11) NOT NULL,
  `id_klien` int(11) NOT NULL,
  `tgl_beli` datetime NOT NULL,
  `id_jt` int(11) NOT NULL,
  `qty` int(20) NOT NULL,
  `jumlah_total` int(11) NOT NULL,
  `status` int(5) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `id` int(11) NOT NULL,
  `tgl_depos` datetime NOT NULL,
  `id_klien` int(11) NOT NULL,
  `jumlah_depos` int(50) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kapal`
--

CREATE TABLE `jenis_kapal` (
  `id` int(11) NOT NULL,
  `nama_kapal` varchar(200) NOT NULL,
  `kapasitas_penumpang` int(20) NOT NULL,
  `thn_pembuatan` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_retribusi`
--

CREATE TABLE `jenis_retribusi` (
  `id` int(11) NOT NULL,
  `jenis_retribusi` varchar(300) NOT NULL,
  `singkatan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_tarif`
--

CREATE TABLE `jenis_tarif` (
  `id` int(11) NOT NULL,
  `id_jt` smallint(11) NOT NULL,
  `jenis_tarif` varchar(100) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga` int(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id` int(11) NOT NULL,
  `nama_kabupaten` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `klien`
--

CREATE TABLE `klien` (
  `id_klien` int(11) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `nama_klien` varchar(200) NOT NULL,
  `kode_barcode` varchar(500) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kel` enum('Pria','Wanita') NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `rt` varchar(20) NOT NULL,
  `rw` varchar(20) NOT NULL,
  `desa` varchar(50) NOT NULL,
  `kec` varchar(50) NOT NULL,
  `kab` varchar(50) NOT NULL,
  `pekerjaan` varchar(200) NOT NULL,
  `warga_negara` enum('WNI','WNA') NOT NULL,
  `status` enum('kawin','belum kawin') NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read_message` tinyint(1) NOT NULL COMMENT '0=belum proses, 1=lagi proses'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelabuhan`
--

CREATE TABLE `pelabuhan` (
  `id` int(11) NOT NULL,
  `nama_pelabuhan` varchar(200) NOT NULL,
  `alamat_pel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registrasi_kartu`
--

CREATE TABLE `registrasi_kartu` (
  `id` int(11) NOT NULL,
  `tgl_reg` datetime NOT NULL,
  `id_klien` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_jt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `id` int(11) NOT NULL,
  `kapal_id` int(11) NOT NULL,
  `rute` varchar(200) NOT NULL,
  `jumlah_rute` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `total_deposit`
--

CREATE TABLE `total_deposit` (
  `id_tdepo` int(11) NOT NULL,
  `id_klien` int(11) NOT NULL,
  `total_deposit` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama_user` varchar(200) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` smallint(5) NOT NULL COMMENT '0= Super admin, 1=Depositor/Register, 2=Retributor, 3=Org Dishub'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beli_tiket`
--
ALTER TABLE `beli_tiket`
  ADD PRIMARY KEY (`id_bt`),
  ADD KEY `beli_tiket_ibfk_1` (`id_klien`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_klien` (`id_klien`);

--
-- Indexes for table `jenis_kapal`
--
ALTER TABLE `jenis_kapal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_retribusi`
--
ALTER TABLE `jenis_retribusi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_tarif`
--
ALTER TABLE `jenis_tarif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klien`
--
ALTER TABLE `klien`
  ADD PRIMARY KEY (`id_klien`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `user_id` (`id_user`);

--
-- Indexes for table `pelabuhan`
--
ALTER TABLE `pelabuhan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrasi_kartu`
--
ALTER TABLE `registrasi_kartu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_klien` (`id_klien`);

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `total_deposit`
--
ALTER TABLE `total_deposit`
  ADD PRIMARY KEY (`id_tdepo`),
  ADD KEY `id_klien` (`id_klien`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beli_tiket`
--
ALTER TABLE `beli_tiket`
  MODIFY `id_bt` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jenis_kapal`
--
ALTER TABLE `jenis_kapal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jenis_retribusi`
--
ALTER TABLE `jenis_retribusi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jenis_tarif`
--
ALTER TABLE `jenis_tarif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `klien`
--
ALTER TABLE `klien`
  MODIFY `id_klien` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pelabuhan`
--
ALTER TABLE `pelabuhan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `registrasi_kartu`
--
ALTER TABLE `registrasi_kartu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rute`
--
ALTER TABLE `rute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `total_deposit`
--
ALTER TABLE `total_deposit`
  MODIFY `id_tdepo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `beli_tiket`
--
ALTER TABLE `beli_tiket`
  ADD CONSTRAINT `beli_tiket_ibfk_1` FOREIGN KEY (`id_klien`) REFERENCES `klien` (`id_klien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `deposit`
--
ALTER TABLE `deposit`
  ADD CONSTRAINT `deposit_ibfk_1` FOREIGN KEY (`id_klien`) REFERENCES `klien` (`id_klien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registrasi_kartu`
--
ALTER TABLE `registrasi_kartu`
  ADD CONSTRAINT `registrasi_kartu_ibfk_1` FOREIGN KEY (`id_klien`) REFERENCES `klien` (`id_klien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `total_deposit`
--
ALTER TABLE `total_deposit`
  ADD CONSTRAINT `total_deposit_ibfk_1` FOREIGN KEY (`id_klien`) REFERENCES `klien` (`id_klien`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
