-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2019 at 05:22 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `siani`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `data_kelas`()
    NO SQL
begin
SELECT * FROM kelas INNER JOIN jurusan ON kelas.id_jurusan=jurusan.id_jurusan;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `data_siswa`()
begin
SELECT siswa.nis, first_name, last_name, tgl_lahir, alamat, no_hp, wali_murid, hp_wali, kelas, jurusan, golongan FROM siswa LEFT JOIN kelas ON siswa.kd_kelas=kelas.kd_kelas LEFT JOIN jurusan ON kelas.id_jurusan=jurusan.id_jurusan;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_data_siswa`(IN nis int (10))
begin
DELETE FROM siswa WHERE siswa.nis=(nis);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_guru`(IN `id_guru` INT(10))
begin
DELETE FROM guru WHERE guru.id_guru=(id_guru);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `filter_data_siswa`(IN `kode_kelas` VARCHAR(9))
begin
SELECT siswa.nis, first_name, last_name, tgl_lahir, alamat, no_hp, wali_murid, hp_wali, kelas, jurusan, golongan FROM siswa LEFT JOIN kelas ON siswa.kd_kelas=kelas.kd_kelas LEFT JOIN jurusan ON kelas.id_jurusan=jurusan.id_jurusan where siswa.kd_kelas=(kode_kelas);
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `id_guru` int(10) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nama_guru`, `no_hp`, `email`) VALUES
(444444, 'lourna fitaloka', '0987654345678', 'lourna@gmail.com'),
(555555, 'ibrahim', '0987658745949', 'ibrahim@gmail.com');

--
-- Triggers `guru`
--
DELIMITER //
CREATE TRIGGER `create_user_guru` AFTER INSERT ON `guru`
 FOR EACH ROW begin
insert into users (id_user, user_name, password, level, status) values (NULL, new.id_guru, new.id_guru, 'Guru', 'Aktif');
end
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `delete_user_guru` AFTER DELETE ON `guru`
 FOR EACH ROW begin 
delete from users where user_name = old.id_guru;
end
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `update_user_guru` AFTER UPDATE ON `guru`
 FOR EACH ROW begin
if old.id_guru<>new.id_guru then
update users set user_name=new.id_guru, password=new.id_guru where user_name=old.id_guru;
end if;
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_nilai`
--

CREATE TABLE IF NOT EXISTS `hasil_nilai` (
`id_hasilnilai` int(10) NOT NULL,
  `nis` int(10) NOT NULL,
  `nilai` double NOT NULL,
  `kd_mapel` varchar(10) NOT NULL,
  `id_guru` int(10) NOT NULL,
  `id_thn_akad` int(10) NOT NULL,
  `spiritual` text NOT NULL,
  `sosial` text NOT NULL,
  `pengetahuan` text NOT NULL,
  `keterampilan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `id_jurusan` tinyint(2) NOT NULL,
  `jurusan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `jurusan`) VALUES
(1, 'IPA'),
(2, 'IPS'),
(3, 'AGAMA');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `kd_kelas` varchar(10) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `golongan` varchar(4) NOT NULL,
  `id_jurusan` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kd_kelas`, `kelas`, `golongan`, `id_jurusan`) VALUES
('XA1', 'X', '1', 1),
('XA3', 'X', '3', 2),
('XAG3', 'X', '3', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE IF NOT EXISTS `mapel` (
  `kd_mapel` varchar(10) NOT NULL,
  `mapel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`kd_mapel`, `mapel`) VALUES
('MP1', 'MATEMATIKA'),
('MP2', 'BAHASA INDONESIA'),
('MP3', 'Biologi');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_kompetensi`
--

CREATE TABLE IF NOT EXISTS `nilai_kompetensi` (
`kd_kompetensi` int(10) NOT NULL,
  `id_hasilnilai` int(10) NOT NULL,
  `spiritual` text NOT NULL,
  `sosial` text NOT NULL,
  `pengetahuan` text NOT NULL,
  `keterampilan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` int(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `wali_murid` varchar(50) NOT NULL,
  `hp_wali` varchar(15) NOT NULL,
  `kd_kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `first_name`, `last_name`, `tgl_lahir`, `alamat`, `no_hp`, `wali_murid`, `hp_wali`, `kd_kelas`) VALUES
(111111, 'edwin', 'ramdani', '2017-12-31', 'sumbersari', '0987654345678', 'sumarni', '098654678909', 'XA1'),
(222222, 'fellia', 'nurohmah', '2016-07-29', 'tulungagung', '0987654345678', 'sumanto', '098654678909', 'XA3');

--
-- Triggers `siswa`
--
DELIMITER //
CREATE TRIGGER `create_user_siswa` AFTER INSERT ON `siswa`
 FOR EACH ROW begin
insert into users (id_user, user_name, password, level, status) values (NULL, new.nis, new.nis, 'Siswa', 'Aktif');
end
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `delete_user_siswa` AFTER DELETE ON `siswa`
 FOR EACH ROW begin 
delete from users where user_name = old.nis;
end
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `update_user_siswa` AFTER UPDATE ON `siswa`
 FOR EACH ROW begin
if old.nis<>new.nis then
update users set user_name=new.nis, password=new.nis where user_name=old.nis;
end if;
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `thn_akad`
--

CREATE TABLE IF NOT EXISTS `thn_akad` (
  `id_thn_akad` int(10) NOT NULL,
  `thn_akad` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thn_akad`
--

INSERT INTO `thn_akad` (`id_thn_akad`, `thn_akad`, `semester`) VALUES
(1, '2016-2017', '1'),
(2, '2016-2017', '2'),
(3, '2017-2018', '3'),
(4, '2017-2018', '4'),
(5, '2018-2019', '5');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id_user` int(10) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` enum('Admin','Guru','Siswa') NOT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `user_name`, `password`, `level`, `status`) VALUES
(19, 'admin', 'admin', 'Admin', 'Aktif'),
(29, '111111', '111111', 'Siswa', 'Aktif'),
(32, '444444', '444444', 'Guru', 'Aktif'),
(33, '555555', '555555', 'Guru', 'Aktif'),
(35, '2', '2', 'Admin', 'Aktif'),
(36, '2', '2', 'Admin', 'Aktif'),
(37, '222222', '222222', 'Siswa', 'Aktif'),
(38, '111111', '111111', 'Siswa', 'Aktif'),
(39, '222222', '222222', 'Siswa', 'Aktif'),
(40, '111111', '111111', 'Siswa', 'Aktif'),
(41, '222222', '222222', 'Siswa', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
 ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `hasil_nilai`
--
ALTER TABLE `hasil_nilai`
 ADD PRIMARY KEY (`id_hasilnilai`), ADD KEY `nis` (`nis`), ADD KEY `nilai` (`nilai`), ADD KEY `kd_mapel` (`kd_mapel`), ADD KEY `id_guru` (`id_guru`), ADD KEY `id_thn_akad` (`id_thn_akad`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
 ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
 ADD PRIMARY KEY (`kd_kelas`), ADD KEY `kd_mapel` (`id_jurusan`), ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
 ADD PRIMARY KEY (`kd_mapel`);

--
-- Indexes for table `nilai_kompetensi`
--
ALTER TABLE `nilai_kompetensi`
 ADD PRIMARY KEY (`kd_kompetensi`), ADD KEY `id_hasilnilai` (`id_hasilnilai`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
 ADD PRIMARY KEY (`nis`), ADD KEY `hp_wali` (`hp_wali`), ADD KEY `kd_kelas` (`kd_kelas`);

--
-- Indexes for table `thn_akad`
--
ALTER TABLE `thn_akad`
 ADD PRIMARY KEY (`id_thn_akad`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil_nilai`
--
ALTER TABLE `hasil_nilai`
MODIFY `id_hasilnilai` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nilai_kompetensi`
--
ALTER TABLE `nilai_kompetensi`
MODIFY `kd_kompetensi` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_nilai`
--
ALTER TABLE `hasil_nilai`
ADD CONSTRAINT `hasil_nilai_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `hasil_nilai_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `hasil_nilai_ibfk_3` FOREIGN KEY (`id_thn_akad`) REFERENCES `thn_akad` (`id_thn_akad`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `hasil_nilai_ibfk_5` FOREIGN KEY (`kd_mapel`) REFERENCES `mapel` (`kd_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`kd_kelas`) REFERENCES `kelas` (`kd_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
