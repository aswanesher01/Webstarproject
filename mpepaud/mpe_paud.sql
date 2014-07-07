/*
MySQL Data Transfer
Source Host: localhost
Source Database: mpe_paud
Target Host: localhost
Target Database: mpe_paud
Date: 5/27/2014 5:56:18 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for angkot
-- ----------------------------
DROP TABLE IF EXISTS `angkot`;
CREATE TABLE `angkot` (
  `Kode_ang` int(20) NOT NULL,
  `asal` text NOT NULL,
  `Tiba` text NOT NULL,
  `Rute` text NOT NULL,
  PRIMARY KEY  (`Kode_ang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for data_paud
-- ----------------------------
DROP TABLE IF EXISTS `data_paud`;
CREATE TABLE `data_paud` (
  `id_paud` int(20) NOT NULL auto_increment,
  `nama_paud` text NOT NULL,
  `Alamat_Paud` text NOT NULL,
  `Telepon` varchar(20) NOT NULL,
  `Uang_Pangkal` int(11) NOT NULL,
  `Spp` int(11) NOT NULL,
  `Latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `jenis_sekolah` char(5) default NULL,
  `jml_fas` int(11) default NULL,
  `jml_sma` int(11) default NULL,
  `jml_d3` int(11) default NULL,
  `jml_s1` int(11) default NULL,
  `jarak` varchar(10) default NULL,
  PRIMARY KEY  (`id_paud`)
) ENGINE=MyISAM AUTO_INCREMENT=8578 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for fasilitas
-- ----------------------------
DROP TABLE IF EXISTS `fasilitas`;
CREATE TABLE `fasilitas` (
  `Id_Fas` varchar(20) NOT NULL,
  `Nama_fas` text NOT NULL,
  `id_paud` int(11) default NULL,
  PRIMARY KEY  (`Id_Fas`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for pend_guru
-- ----------------------------
DROP TABLE IF EXISTS `pend_guru`;
CREATE TABLE `pend_guru` (
  `Id_guru` varchar(20) NOT NULL,
  `Nama_Guru` text NOT NULL,
  `Pendidikan` varchar(15) NOT NULL,
  `id_paud` int(11) default NULL,
  PRIMARY KEY  (`Id_guru`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for t_nilai_paud
-- ----------------------------
DROP TABLE IF EXISTS `t_nilai_paud`;
CREATE TABLE `t_nilai_paud` (
  `id_paud` int(11) NOT NULL default '0',
  `nilai_jarak` varchar(5) default NULL,
  `nilai_spp` varchar(5) default NULL,
  `nilai_uang_pangkal` varchar(5) default NULL,
  `nilai_fas` varchar(5) default NULL,
  `nilai_gur` varchar(5) default NULL,
  `nilai_total` varchar(5) default NULL,
  PRIMARY KEY  (`id_paud`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for t_user
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(30) default NULL,
  `password` varchar(100) default NULL,
  `id_paud` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `angkot` VALUES ('3297', 'Cimahi', 'Cibeber', 'Terminal Pasar Antri - Cimahi Mall - Pojok - Gang Asem - Jl. Jend Amir Machmud (tagog) - Gatot Subroto - Baros - Leuwigajah - Cibeber');
INSERT INTO `angkot` VALUES ('2251', 'Cimahi', 'Cimindi', 'Terminal Pasar Antri - cimahi Mall - Pojok - Gang Asem - Jl. jend Amir machmud (Tagog) - gatot Subroto - Baros - Leuwigajah - Cimindi');
INSERT INTO `angkot` VALUES ('6155', 'Cimahi', 'Soreang', 'Terminal Pasar Antri - Stasiun Cimahi - Baros - Leuwigajah - Nanjung - Lagadar - Margaasih - cipatik - Soreang');
INSERT INTO `angkot` VALUES ('5643', 'Cimahi', 'St. Hall ', 'Terminal Pasar Antri - Gatot Subroto - Tagog - Cibabat - Cimaindi - Cibeureum - Rajawali - Ciroyom - Pajajaran - Cicendo - Stasiun Bandung');
INSERT INTO `angkot` VALUES ('8877', 'Cimahi', 'Leuwipanjang', 'Terminal Pasar Antri - gatot Subroto - Tagog - Cibabat - Cimindi - Cibeureum - Rajawali - Soekarno-Hatta - Pasar Caringin - Perempatan Kopo - Leuwipanjang');
INSERT INTO `data_paud` VALUES ('4480', 'RA Al-Ikhlas Cimindi', 'Jl. Raya Cimindi Rt. 03/05 Gg. RH. Jejeng No. 109', '022-6071533', '1500000', '150000', '-6.8920616', '107.5579448', 'RA', '0', '0', '0', '2', '1.73053177');
INSERT INTO `data_paud` VALUES ('6435', 'RA An Nur', 'Jl. Rancabentang Rt.03/026 Kel, Cibeureum ', '0226026551', '1200000', '50000', '-6.9077296', '107.557731', 'RA', '0', '1', '0', '1', '1.73191221');
INSERT INTO `data_paud` VALUES ('7513', 'An-Nida', 'Jl Baktimas III no.188 RT07/03 Leuwigajah', '02270412597', '1000000', '25000', '-6.902016', '107.522524', 'RA', '0', '0', '1', '0', '0.79678645');
INSERT INTO `data_paud` VALUES ('2446', 'Istiqomah', 'Jl. Melong Raya Blok 4 Gg. Perkutut No. 180A RT 003/10 Kelurahan Melong', '08122450412', '750000', '50000', '-6.9226794', '107.5629242', 'RA', '0', '0', '1', '0', '2.55511423');
INSERT INTO `data_paud` VALUES ('6402', 'Al-Karomah', 'JLN. Rancabentang No 152 Rt 05/14 Kel. Cibeureum Cimahi Selatan', '085222457455', '1300000', '45000', '-6.906089', '107.559651', 'RA', '0', '0', '0', '1', '1.82554397');
INSERT INTO `data_paud` VALUES ('4154', 'TK KEMALA BHAYANGKARI 16', 'JL. RAYA CIBABAT NO.333  ', '022123123', '1500000', '60000', '-6.8836243', '107.5527382', 'TK', '6', '2', '3', '3', '1.69854085');
INSERT INTO `data_paud` VALUES ('5636', 'TK TERATAI ', 'JL. RH. ABD HALIM NO. 24', '0221234125', '900000', '45000', '-6.8886836', '107.5510651', 'TK', '4', '1', '2', '2', '1.39797924');
INSERT INTO `data_paud` VALUES ('1847', 'TK BPK PENABUR ', 'Jl. BABAKAN NO. 23', '02245352', '1400000', '70000', '-6.8723636', '107.544491', 'TK', '5', '3', '3', '2', '2.01429369');
INSERT INTO `data_paud` VALUES ('7175', 'TK TUNAS BHAKTI PERTIWI', 'JL. KOLONEL MASTURI NO.3 B', '022-312312', '1200000', '35000', '-6.8659188', '107.5399896', 'TK', '5', '3', '0', '2', '2.36083256');
INSERT INTO `data_paud` VALUES ('6445', 'TK SEKOLAH HARMONI INDONESIA', 'Jl Cisangkan Hilir No 108/4', '022-3213123', '1500000', '45000', '-6.87131', '107.534474', 'TK', null, '0', '0', '0', null);
INSERT INTO `data_paud` VALUES ('8577', 'TK ISLAM NUR AL RAHMAN ', 'Jl. CIHANJUANG NO. 77 A', '022 6634472', '800000', '50000', '-6.876571', '107.550284', 'TK', '6', '2', '3', '2', '1.94604300');
INSERT INTO `fasilitas` VALUES ('7461', 'Ruang Belajar dan Ruang Bermain', '4154');
INSERT INTO `fasilitas` VALUES ('4865', 'Rekreasi', '4154');
INSERT INTO `fasilitas` VALUES ('6211', 'Mushola', '4154');
INSERT INTO `fasilitas` VALUES ('3455', 'Pemeriksaan Kesehatan Anak ', '4154');
INSERT INTO `fasilitas` VALUES ('4122', 'Arena Bermain Luar dan Dalam Ruangan', '4154');
INSERT INTO `fasilitas` VALUES ('9706', 'Lingkungan Nyaman dan Aman', '4154');
INSERT INTO `fasilitas` VALUES ('6457', 'Arena bermain', '5636');
INSERT INTO `fasilitas` VALUES ('321', 'Pemeriksaan kesehatan', '5636');
INSERT INTO `fasilitas` VALUES ('8679', 'Ruang belajar', '5636');
INSERT INTO `fasilitas` VALUES ('2059', 'Mushola', '5636');
INSERT INTO `fasilitas` VALUES ('8562', 'Arena bermain', '1847');
INSERT INTO `fasilitas` VALUES ('5150', 'Ruang belajar', '1847');
INSERT INTO `fasilitas` VALUES ('2619', 'Gereja', '1847');
INSERT INTO `fasilitas` VALUES ('6519', 'Buku pelajaran', '1847');
INSERT INTO `fasilitas` VALUES ('1626', 'Rekreasi', '1847');
INSERT INTO `fasilitas` VALUES ('2854', 'Ruang belajar', '7175');
INSERT INTO `fasilitas` VALUES ('801', 'Arena bermain', '7175');
INSERT INTO `fasilitas` VALUES ('8000', 'Rekreasi', '7175');
INSERT INTO `fasilitas` VALUES ('3346', 'Mushola', '7175');
INSERT INTO `fasilitas` VALUES ('4665', 'Buku pelajaran', '7175');
INSERT INTO `fasilitas` VALUES ('5406', 'Ruang belajar', '8577');
INSERT INTO `fasilitas` VALUES ('9484', 'Mushola', '8577');
INSERT INTO `fasilitas` VALUES ('9086', 'Buku pelajaran', '8577');
INSERT INTO `fasilitas` VALUES ('2961', 'Arena bermain', '8577');
INSERT INTO `fasilitas` VALUES ('4125', 'Rekreasi', '8577');
INSERT INTO `fasilitas` VALUES ('9160', 'Al-Quran', '8577');
INSERT INTO `pend_guru` VALUES ('902', 'Hj.Cucum Suminar, S.Pd', 'S1', '4480');
INSERT INTO `pend_guru` VALUES ('3330', 'Yusrabuana', 'SMA', '6435');
INSERT INTO `pend_guru` VALUES ('5964', 'RINI SURTINI', 'S1', '4154');
INSERT INTO `pend_guru` VALUES ('4758', 'ONENG ROSANAH', 'S1', '4154');
INSERT INTO `pend_guru` VALUES ('3453', 'T. KURNIASIH', 'D3', '4154');
INSERT INTO `pend_guru` VALUES ('3224', 'LIA HERMAWATI', 'D3', '4154');
INSERT INTO `pend_guru` VALUES ('9378', 'Siti R', 'S1', '4480');
INSERT INTO `pend_guru` VALUES ('9765', 'Susan M', 'S1', '6435');
INSERT INTO `pend_guru` VALUES ('5588', 'Rodiyah', 'D3', '7513');
INSERT INTO `pend_guru` VALUES ('3099', 'Kartika Susi', 'S1', '6402');
INSERT INTO `pend_guru` VALUES ('879', 'Mutia K', 'D3', '2446');
INSERT INTO `pend_guru` VALUES ('5510', 'HALIMAH', 'S1', '4154');
INSERT INTO `pend_guru` VALUES ('9018', 'RATNA WIDIA HENDAYANI', 'D3', '4154');
INSERT INTO `pend_guru` VALUES ('6781', 'YUYUN SUNIANGSIH', 'D3', '5636');
INSERT INTO `pend_guru` VALUES ('3913', 'NURJANAH', 'D3', '5636');
INSERT INTO `pend_guru` VALUES ('1342', 'NETY SYLVIANINGSIH', 'S1', '5636');
INSERT INTO `pend_guru` VALUES ('3353', 'MIMIN HAYATI', 'S1', '5636');
INSERT INTO `pend_guru` VALUES ('4279', 'ELLY WIDYA', 'SMA', '5636');
INSERT INTO `pend_guru` VALUES ('4265', 'SITI NUR FAJRIAH', 'SMA', '4154');
INSERT INTO `pend_guru` VALUES ('6300', 'ARUM SAPTA NINGRUM', 'SMA', '4154');
INSERT INTO `pend_guru` VALUES ('5078', 'YOHANA BAAN', 'D3', '1847');
INSERT INTO `pend_guru` VALUES ('8866', 'SILVIA CAROLINA', 'D3', '1847');
INSERT INTO `pend_guru` VALUES ('272', 'YAYUK PARTINI', 'D3', '1847');
INSERT INTO `pend_guru` VALUES ('5930', 'TRI YUWANI', 'S1', '1847');
INSERT INTO `pend_guru` VALUES ('1069', 'UMI WIDAYANTI', 'S1', '1847');
INSERT INTO `pend_guru` VALUES ('8464', 'YAYAH', 'SMA', '1847');
INSERT INTO `pend_guru` VALUES ('2357', 'MELIANA TATANG', 'SMA', '1847');
INSERT INTO `pend_guru` VALUES ('8392', 'ROKAYAH', 'SMA', '1847');
INSERT INTO `pend_guru` VALUES ('9989', 'VISKA SUASANA ARUM', 'S1', '7175');
INSERT INTO `pend_guru` VALUES ('2610', 'SITI NURJANAH', 'S1', '7175');
INSERT INTO `pend_guru` VALUES ('5105', 'YANTI LISTIANTI', 'SMA', '7175');
INSERT INTO `pend_guru` VALUES ('8613', 'AGUS SUMITRA', 'SMA', '7175');
INSERT INTO `pend_guru` VALUES ('9727', 'KOMARUDIN MUSLIH', 'SMA', '7175');
INSERT INTO `pend_guru` VALUES ('5378', 'NURSYAMSIAH', 'D3', '8577');
INSERT INTO `pend_guru` VALUES ('2642', 'RIDA RUBIANTI KARTINI', 'D3', '8577');
INSERT INTO `pend_guru` VALUES ('3500', 'SRI HANDAYANI', 'D3', '8577');
INSERT INTO `pend_guru` VALUES ('1249', 'BAETUL RIDWAN', 'S1', '8577');
INSERT INTO `pend_guru` VALUES ('8290', 'ANDI SISWANTO', 'S1', '8577');
INSERT INTO `pend_guru` VALUES ('9755', 'MELY AMELIA PERMATASARI', 'SMA', '8577');
INSERT INTO `pend_guru` VALUES ('5582', 'AEP SAEPUL', 'SMA', '8577');
INSERT INTO `t_nilai_paud` VALUES ('4480', '4', '1.8', '1.8', '', '0.8', '8.4');
INSERT INTO `t_nilai_paud` VALUES ('6435', '4', '2.4', '1.8', '', '0.8', '9');
INSERT INTO `t_nilai_paud` VALUES ('7513', '4', '2.4', '1.8', '', '0.7', '8.9');
INSERT INTO `t_nilai_paud` VALUES ('2446', '2.5', '2.4', '2.4', '', '0.7', '8');
INSERT INTO `t_nilai_paud` VALUES ('6402', '4', '2.4', '1.8', '', '0.8', '9');
INSERT INTO `t_nilai_paud` VALUES ('4154', '4', '2.4', '1.8', '0.6', '0.8', '9.6');
INSERT INTO `t_nilai_paud` VALUES ('5636', '4', '2.4', '2.4', '0.6', '0.8', '10.2');
INSERT INTO `t_nilai_paud` VALUES ('1847', '2.5', '2.4', '1.8', '0.6', '0.8', '8.1');
INSERT INTO `t_nilai_paud` VALUES ('7175', '2.5', '2.4', '1.8', '0.6', '0.8', '8.1');
INSERT INTO `t_nilai_paud` VALUES ('6445', '', '2.4', '1.8', '', '0', '4.2');
INSERT INTO `t_nilai_paud` VALUES ('8577', '4', '2.4', '2.4', '0.6', '0.8', '10.2');
INSERT INTO `t_user` VALUES ('3', 'admin', '400fb4f0c52e7290305e00ab9e3df759', '3');
INSERT INTO `t_user` VALUES ('4', 'aswanesher', 'ac43724f16e9241d990427ab7c8f4228', '4');
