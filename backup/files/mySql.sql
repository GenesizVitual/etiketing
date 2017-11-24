-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 22, 2017 at 07:59 PM
-- Server version: 5.5.56
-- PHP Version: 5.6.31

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

--
-- Dumping data for table `beli_tiket`
--

INSERT INTO `beli_tiket` (`id_bt`, `id_klien`, `tgl_beli`, `id_jt`, `qty`, `jumlah_total`, `status`, `id_user`) VALUES
(1, 1, '2017-11-17 09:16:16', 1, 4, 12000, 1, 3),
(2, 2, '2017-11-18 02:16:14', 1, 6, 18000, 1, 3),
(3, 2, '2017-11-18 02:16:25', 4, 1, 2500, 1, 3),
(4, 1, '2017-11-18 02:27:20', 1, 5, 15000, 1, 3),
(5, 1, '2017-11-18 02:27:27', 4, 1, 2500, 1, 3),
(6, 2, '2017-11-22 02:31:32', 1, 1, 3000, 1, 1);

--
-- Triggers `beli_tiket`
--
DELIMITER $$
CREATE TRIGGER `update_total_deposit_berdasarkat_status` AFTER UPDATE ON `beli_tiket` FOR EACH ROW BEGIN

DECLARE sisa_deposits BIGINT unsigned DEFAULT 0;
DECLARE total_sisa BIGINT unsigned DEFAULT 0;
if(new.status=1) then
    set sisa_deposits = (select total_deposit.total_deposit FROM total_deposit where id_klien=old.id_klien);

    set total_sisa = (sisa_deposits - old.jumlah_total);

    update total_deposit set total_deposit = total_sisa where id_klien= old.id_klien;
end if;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_total_deposit_from_beli_tiket` AFTER INSERT ON `beli_tiket` FOR EACH ROW BEGIN

DECLARE tarif INT unsigned DEFAULT 0;
DECLARE deposit INT unsigned DEFAULT 0;


end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_total_depost_setelah_hapus` AFTER DELETE ON `beli_tiket` FOR EACH ROW BEGIN

DECLARE sisa_deposits BIGINT unsigned DEFAULT 0;
DECLARE total_sisa BIGINT unsigned DEFAULT 0;
if(old.status=1) then
    set sisa_deposits = (select total_deposit.total_deposit FROM total_deposit where id_klien=old.id_klien);

    set total_sisa = (sisa_deposits + old.jumlah_total);

    update total_deposit set total_deposit = total_sisa where id_klien= old.id_klien;
end if;
end
$$
DELIMITER ;

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

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`id`, `tgl_depos`, `id_klien`, `jumlah_depos`, `id_user`) VALUES
(32, '2017-11-17 09:08:03', 1, 200000, 2),
(34, '2017-11-18 02:15:24', 2, 400000, 2),
(35, '2017-11-22 03:03:54', 4, 500000, 1);

--
-- Triggers `deposit`
--
DELIMITER $$
CREATE TRIGGER `Update` AFTER UPDATE ON `deposit` FOR EACH ROW UPDATE total_deposit set total_deposit= (select sum(jumlah_depos) from deposit where id_klien=OLD.id_klien) where total_deposit.id_klien = OLD.id_klien
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_total_deposit_from_deposit` AFTER INSERT ON `deposit` FOR EACH ROW BEGIN
DECLARE total_dep int DEFAULT 0;
set total_dep = (SELECT total_deposit.total_deposit from total_deposit where id_klien = new.id_klien);

	UPDATE total_deposit set total_deposit= (total_dep+new.jumlah_depos) where total_deposit.id_klien = new.id_klien;
   
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_total_deposit_pada_saat_dihapus` AFTER DELETE ON `deposit` FOR EACH ROW BEGIN
DECLARE countIDcline int DEFAULT 0;
DECLARE deposit_yg_dihapus BIGINT DEFAULT 0;
DECLARE total_deposit_yg_sebelumnya BIGINT DEFAULT 0;

set countIDcline = (select count(id_klien) from deposit where id_klien=OLD.id_klien);

set deposit_yg_dihapus = (select jumlah_depos from deposit where id=OLD.id);

set total_deposit_yg_sebelumnya = (select total_deposit from total_deposit where id_klien=OLD.id_klien);

    if countIDcline =0 then
    	DELETE from total_deposit where id_klien = old.id_klien;
    else 
    	update total_deposit set total_deposit.total_deposit = total_deposit_yg_sebelumnya-OLD.jumlah_depos where id_klien = old.id_klien;
    end if;	
end
$$
DELIMITER ;

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

--
-- Dumping data for table `jenis_kapal`
--

INSERT INTO `jenis_kapal` (`id`, `nama_kapal`, `kapasitas_penumpang`, `thn_pembuatan`) VALUES
(1, 'Kapal 1', 400, 2015),
(2, 'Kapal 2', 200, 2012),
(4, 'Kapal Katinting', 25, 2012);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_retribusi`
--

CREATE TABLE `jenis_retribusi` (
  `id` int(11) NOT NULL,
  `jenis_retribusi` varchar(300) NOT NULL,
  `singkatan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_retribusi`
--

INSERT INTO `jenis_retribusi` (`id`, `jenis_retribusi`, `singkatan`) VALUES
(1, 'Jasa Tanda Masuk Pelabuhan', 'JTMP'),
(2, 'Jasa Pemeliharaan Dermaga Bagi Kendaaan Yang Menyebrang', 'JPDK'),
(3, 'Jasa Timbangan Kendaraan Bermotor', 'JTKB'),
(4, 'Jasa Penumpukan Barang', 'JPB'),
(5, 'Tarif Sewa Tanah Dan Bangunan/Ruangan', 'TSTB'),
(6, 'Tarif Sewa Pemberitahuan Muatan Kapal', 'SPMK');

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

--
-- Dumping data for table `jenis_tarif`
--

INSERT INTO `jenis_tarif` (`id`, `id_jt`, `jenis_tarif`, `satuan`, `harga`) VALUES
(1, 1, 'Penumpang/Pengantar/Penjemput', 'Per Orang', 3000),
(2, 1, 'Pas Bulanan/Orang/Karyawan', 'Per Orang', 25000),
(3, 1, 'Pas Bulanan Kendaraan Roda Empat', 'Per Unit/Bukan', 30000),
(4, 1, 'Pas Masuk Kendaraan/Sekali Lewat Kendaraa Gol. I', 'Per Masuk', 2500);

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id` int(11) NOT NULL,
  `nama_kabupaten` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id`, `nama_kabupaten`) VALUES
(1, 'Kota Bau Bau'),
(2, 'Kota Kendari');

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read_message` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=belum proses, 1=lagi proses'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klien`
--

INSERT INTO `klien` (`id_klien`, `nik`, `nama_klien`, `kode_barcode`, `tempat_lahir`, `tgl_lahir`, `jenis_kel`, `alamat`, `rt`, `rw`, `desa`, `kec`, `kab`, `pekerjaan`, `warga_negara`, `status`, `id_user`, `created_at`, `read_message`) VALUES
(1, '239238172348192', 'Masmuddin', 'PLU-20171113-7240', 'Kendari', '2017-11-13', 'Pria', 'Jln. UHO', '2333', '2333', 'asdfgh', 'asedfghjkgdsdfghjkjhgfdd', 'ddfs', 'Karyawan Swasta', 'WNI', 'kawin', 2, '2017-11-17 07:30:53', 0),
(2, '2354895482457849', 'Wa Ode Rina', 'PLU-20171115-6569', 'Kendari', '2017-11-15', 'Wanita', 'Jl. HEA Mokodompit', '534', '5673', 'Mataiwoi', 'Wau wau', 'Kendari', 'Karyawan Swasta', 'WNI', 'kawin', 2, '2017-11-18 02:14:15', 0),
(3, '123232424242', 'Anwar ', 'PLU-20101010-3358', 'Raha', '2010-10-10', 'Pria', 'Jl. La Korumba', '09', '09', 'Wanggu', 'Kadia', 'RAha', 'Nelayan', 'WNI', 'kawin', 1, '2017-11-21 08:53:03', 0),
(4, '2323323', 'La Rakuti', 'PLU-19901105-2162', 'Kendari', '1990-11-05', 'Pria', 'Jl. Sorumba', '09', '90', 'Rahandouna', 'Puwatu', 'Kendari', 'Dosen', 'WNI', 'kawin', 1, '2017-11-22 02:56:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pelabuhan`
--

CREATE TABLE `pelabuhan` (
  `id` int(11) NOT NULL,
  `nama_pelabuhan` varchar(200) NOT NULL,
  `alamat_pel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelabuhan`
--

INSERT INTO `pelabuhan` (`id`, `nama_pelabuhan`, `alamat_pel`) VALUES
(1, 'Pelabuhan Bau Bau', 'Jln .....'),
(2, 'Pelabuhan Kendari', 'Jln ......');

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

--
-- Dumping data for table `registrasi_kartu`
--

INSERT INTO `registrasi_kartu` (`id`, `tgl_reg`, `id_klien`, `id_user`, `id_jt`) VALUES
(1, '2017-11-17 07:33:41', 1, 2, 3),
(2, '2017-11-18 02:14:38', 2, 2, 3),
(3, '2017-11-21 09:00:10', 3, 1, 3),
(4, '2017-11-22 02:56:42', 4, 1, 3);

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

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`id`, `kapal_id`, `rute`, `jumlah_rute`) VALUES
(1, 1, 'Kendari - bau bau', 0),
(2, 1, 'Bau bau - Kendari', 0),
(3, 2, 'Kendari - Raha', 0);

-- --------------------------------------------------------

--
-- Table structure for table `total_deposit`
--

CREATE TABLE `total_deposit` (
  `id_tdepo` int(11) NOT NULL,
  `id_klien` int(11) NOT NULL,
  `total_deposit` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `total_deposit`
--

INSERT INTO `total_deposit` (`id_tdepo`, `id_klien`, `total_deposit`) VALUES
(15, 1, 170500),
(16, 2, 376500),
(17, 4, 500000);

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
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama_user`, `nip`, `username`, `password`, `level`) VALUES
(1, 'Fandi', '', 'admin', '1f32aa4c9a1d2ea010adcf2348166a04', 0),
(2, 'Deker', '', 'User 1', '1f32aa4c9a1d2ea010adcf2348166a04', 1),
(3, 'La Ode\r\n', '', 'User 2', '1f32aa4c9a1d2ea010adcf2348166a04', 2),
(4, 'Loka', '', 'Kias', '1f32aa4c9a1d2ea010adcf2348166a04', 3),
(5, 'La Ode', '199219928182773', 'Boka', '1f32aa4c9a1d2ea010adcf2348166a04', 4),
(6, 'Wa Ode', '1929239198238', 'Moana', '1f32aa4c9a1d2ea010adcf2348166a04', 5);

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
  MODIFY `id_bt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `jenis_kapal`
--
ALTER TABLE `jenis_kapal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jenis_retribusi`
--
ALTER TABLE `jenis_retribusi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jenis_tarif`
--
ALTER TABLE `jenis_tarif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `klien`
--
ALTER TABLE `klien`
  MODIFY `id_klien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pelabuhan`
--
ALTER TABLE `pelabuhan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `registrasi_kartu`
--
ALTER TABLE `registrasi_kartu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rute`
--
ALTER TABLE `rute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `total_deposit`
--
ALTER TABLE `total_deposit`
  MODIFY `id_tdepo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
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
