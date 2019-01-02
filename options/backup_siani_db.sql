DROP TABLE guru;

CREATE TABLE `guru` (
  `id_guru` int(10) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`id_guru`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO guru VALUES("444444","lourna fitaloka","0987654345678","lourna@gmail.com");
INSERT INTO guru VALUES("555555","ibrahim","0987658745949","ibrahim@gmail.com");



DROP TABLE hasil_nilai;

CREATE TABLE `hasil_nilai` (
  `id_hasilnilai` int(10) NOT NULL AUTO_INCREMENT,
  `nis` int(10) NOT NULL,
  `nilai` double NOT NULL,
  `kd_mapel` varchar(10) NOT NULL,
  `id_guru` int(10) NOT NULL,
  `id_thn_akad` int(10) NOT NULL,
  `spiritual` text NOT NULL,
  `sosial` text NOT NULL,
  `pengetahuan` text NOT NULL,
  `keterampilan` text NOT NULL,
  PRIMARY KEY (`id_hasilnilai`),
  KEY `nis` (`nis`),
  KEY `nilai` (`nilai`),
  KEY `kd_mapel` (`kd_mapel`),
  KEY `id_guru` (`id_guru`),
  KEY `id_thn_akad` (`id_thn_akad`),
  CONSTRAINT `hasil_nilai_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `hasil_nilai_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `hasil_nilai_ibfk_3` FOREIGN KEY (`id_thn_akad`) REFERENCES `thn_akad` (`id_thn_akad`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `hasil_nilai_ibfk_5` FOREIGN KEY (`kd_mapel`) REFERENCES `mapel` (`kd_mapel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;




DROP TABLE jurusan;

CREATE TABLE `jurusan` (
  `id_jurusan` tinyint(2) NOT NULL,
  `jurusan` varchar(20) NOT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO jurusan VALUES("1","IPA");
INSERT INTO jurusan VALUES("2","IPS");
INSERT INTO jurusan VALUES("3","AGAMA");



DROP TABLE kelas;

CREATE TABLE `kelas` (
  `kd_kelas` varchar(10) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `golongan` varchar(4) NOT NULL,
  `id_jurusan` tinyint(2) NOT NULL,
  PRIMARY KEY (`kd_kelas`),
  KEY `kd_mapel` (`id_jurusan`),
  KEY `id_jurusan` (`id_jurusan`),
  CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO kelas VALUES("X1","X","1","1");
INSERT INTO kelas VALUES("X2","X","2","1");
INSERT INTO kelas VALUES("XA3","X","3","2");
INSERT INTO kelas VALUES("XA4","X","4","1");
INSERT INTO kelas VALUES("XA44","XII","4","3");
INSERT INTO kelas VALUES("XI1","XI","1","3");
INSERT INTO kelas VALUES("XI2","XI","2","2");
INSERT INTO kelas VALUES("XIA3","XI","3","1");



DROP TABLE mapel;

CREATE TABLE `mapel` (
  `kd_mapel` varchar(10) NOT NULL,
  `mapel` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_mapel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO mapel VALUES("MP1","MATEMATIKA");
INSERT INTO mapel VALUES("MP2","BAHASA INDONESIA");
INSERT INTO mapel VALUES("MP3","Biologi");
INSERT INTO mapel VALUES("MP4","bahasa inggris");



DROP TABLE nilai_kompetensi;

CREATE TABLE `nilai_kompetensi` (
  `kd_kompetensi` int(10) NOT NULL AUTO_INCREMENT,
  `id_hasilnilai` int(10) NOT NULL,
  `spiritual` text NOT NULL,
  `sosial` text NOT NULL,
  `pengetahuan` text NOT NULL,
  `keterampilan` text NOT NULL,
  PRIMARY KEY (`kd_kompetensi`),
  KEY `id_hasilnilai` (`id_hasilnilai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE siswa;

CREATE TABLE `siswa` (
  `nis` int(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `wali_murid` varchar(50) NOT NULL,
  `hp_wali` varchar(15) NOT NULL,
  `kd_kelas` varchar(10) NOT NULL,
  PRIMARY KEY (`nis`),
  KEY `hp_wali` (`hp_wali`),
  KEY `kd_kelas` (`kd_kelas`),
  CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`kd_kelas`) REFERENCES `kelas` (`kd_kelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO siswa VALUES("111111","edwin","ramdani","2009-12-31","sumbersari, jember","0987658745678","sungkono","098654678909","XI2");
INSERT INTO siswa VALUES("222222","fellia","nurohmah","2000-02-23","tulungagung","08888899999","sumarno","098654678909","XI2");
INSERT INTO siswa VALUES("333333","m","firdausillah","1998-02-22","banyuwangi","0987654345678","sumarni","098654678909","XI2");



DROP TABLE thn_akad;

CREATE TABLE `thn_akad` (
  `id_thn_akad` int(10) NOT NULL,
  `thn_akad` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  PRIMARY KEY (`id_thn_akad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO thn_akad VALUES("1","2016-2017","1");
INSERT INTO thn_akad VALUES("2","2016-2017","2");
INSERT INTO thn_akad VALUES("3","2017-2018","3");
INSERT INTO thn_akad VALUES("4","2017-2018","4");
INSERT INTO thn_akad VALUES("5","2018-2019","5");



DROP TABLE users;

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` enum('Admin','Guru','Siswa') NOT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

INSERT INTO users VALUES("19","admin","admin","Admin","Aktif");
INSERT INTO users VALUES("29","111111","111111","Siswa","Aktif");
INSERT INTO users VALUES("30","222222","222222","Siswa","Aktif");
INSERT INTO users VALUES("31","333333","333333","Siswa","Aktif");
INSERT INTO users VALUES("32","444444","444444","Guru","Aktif");
INSERT INTO users VALUES("33","555555","555555","Guru","Aktif");



