-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2018 at 02:00 PM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `actorCity`(IN ct varchar(30), IN lim int(4))
BEGIN
SELECT first_name, last_name, city FROM actor INNER JOIN film_actor ON actor.actor_id = film_actor.actor_id INNER JOIN film on film_actor.film_id = film.film_id INNER JOIN inventori ON film.film_id = inventori.film_id INNER JOIN store ON inventori.store_id = store.store_id INNER JOIN address  ON store.address_id = address.address_id INNER JOIN city ON address.city_id=city.city_id WHERE city = ct LIMIT lim;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getActorname`(IN name varchar (45))
BEGIN
SELECT first_name, last_name FROM Actor WHERE first_name LIKE CONCAT('%',name,'%') OR last_name LIKE CONCAT('%',name,'%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `siswa`()
begin
select*from siswa;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user`()
begin
select users.id_user, first_name, last_name, user_name, password, kelas, jurusan, level FROM users LEFT JOIN siswa ON users.id_user=siswa.id_user LEFT JOIN kelas ON siswa.kd_kelas=kelas.kd_kelas LEFT JOIN jurusan ON kelas.id_jurusan=jurusan.id_jurusan;  
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `users`()
begin
SELECT users.id_user, first_name, last_name, user_name, password, kelas, jurusan, level FROM users LEFT JOIN siswa ON users.id_user=siswa.id_user LEFT JOIN hasil_nilai ON siswa.nis=hasil_nilai.nis LEFT JOIN section ON hasil_nilai.id_section=section.id_section LEFT JOIN kelas ON section.kd_kelas=kelas.kd_kelas LEFT JOIN jurusan ON kelas.id_jurusan=jurusan.id_jurusan;
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
(1234, 'Amir', '0987658745678', 'amir@gmail.com'),
(1111222, 'edwinromdoni', '08888899999', 'firdausillah123@gmail.com');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_nilai`
--

INSERT INTO `hasil_nilai` (`id_hasilnilai`, `nis`, `nilai`, `kd_mapel`, `id_guru`, `id_thn_akad`, `spiritual`, `sosial`, `pengetahuan`, `keterampilan`) VALUES
(1, 111222, 80, 'MP1', 1234, 1, '', '', '', ''),
(2, 111222, 87, 'MP2', 1111222, 1, '', '', '', ''),
(3, 111222, 80, 'MP1', 1234, 1, '', '', '', ''),
(4, 111222, 87, 'MP2', 1111222, 1, '', '', '', ''),
(5, 111222, 80, 'MP1', 1234, 4, 'hkhkjhkjhkjhkj', 'hkjhkjhkjhjkh', 'kjhkjhkjhkjhkjhkj', 'hkjhkjhkjhkjh'),
(6, 111222, 80, 'MP1', 1234, 4, 'hkhkjhkjhkjhkj', 'hkjhkjhkjhjkh', 'kjhkjhkjhkjhkjhkj', 'hkjhkjhkjhkjh');

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
('X1', 'X', '1', 1),
('X2', 'X', '2', 1),
('XA3', 'X', '3', 2),
('XA4', 'X', '4', 1),
('XA44', 'XII', '4', 3),
('XI1', 'XI', '1', 3),
('XI2', 'XI', '2', 2),
('XIA3', 'XI', '3', 1);

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
('MP2', 'BAHASA INDONESIA');

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
(111222, 'firdaus', 'illah', '0000-00-00', '', '', '', '', 'X1');

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `user_name`, `password`, `level`, `status`) VALUES
(19, 'admin', 'admin', 'Admin', 'Aktif'),
(21, 'fellia', '01', 'Guru', 'Aktif'),
(22, '1111222', '1111222', 'Guru', 'Aktif'),
(26, '1234', '1234', 'Guru', 'Aktif'),
(27, 'a', 'a', 'Guru', 'Aktif'),
(28, 'b', 'b', 'Siswa', 'Aktif');

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
MODIFY `id_hasilnilai` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `nilai_kompetensi`
--
ALTER TABLE `nilai_kompetensi`
MODIFY `kd_kompetensi` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
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
