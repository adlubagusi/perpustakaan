-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 11, 2017 at 11:55 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE IF NOT EXISTS `buku` (
  `kd_buku` char(5) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `isbn` varchar(40) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `halaman` int(4) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `th_terbit` varchar(4) NOT NULL,
  `sinopsis` text NOT NULL,
  `kd_penerbit` char(3) NOT NULL,
  `kd_kategori` char(3) NOT NULL,
  PRIMARY KEY (`kd_buku`),
  KEY `kd_kategori` (`kd_kategori`),
  KEY `kd_penerbit` (`kd_penerbit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`kd_buku`, `judul`, `isbn`, `pengarang`, `halaman`, `jumlah`, `th_terbit`, `sinopsis`, `kd_penerbit`, `kd_kategori`) VALUES
('B0001', 'Basis Data', '111111111111', 'Fathansyah', 123, 10, '2014', '', 'P05', 'K14'),
('B0002', 'komunikasi data', '10101010101', 'hartanto', 79, 2, '2015', '', 'P02', 'K15'),
('B0003', 'JavaScript', '9781119028727', 'Nazruddin Safaat H', 900, 12, '2015', 'dfasdfa', 'P04', 'K15');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `kd_kategori` char(3) NOT NULL,
  `nm_kategori` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_kategori`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kd_kategori`, `nm_kategori`) VALUES
('K01', 'Agama Islam'),
('K02', 'Matematika'),
('K03', 'Bahasa Indonesia'),
('K04', 'Bahasa Inggris'),
('K05', 'Ekonomi'),
('K06', 'Fisika'),
('K07', 'Sosiologi'),
('K08', 'Sejarah'),
('K09', 'Biologi'),
('K10', 'Geografi'),
('K11', 'Kimia'),
('K12', 'Pemograman Android'),
('K13', 'Pemograman Web'),
('K14', 'Pemograman Desktop'),
('K15', 'Komputer'),
('K16', 'Jaringan Komputer'),
('K17', 'Rekayasa Perangkat Lunak');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE IF NOT EXISTS `modul` (
  `id_modul` int(3) NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(30) NOT NULL,
  `link` varchar(30) NOT NULL,
  `urutan` int(3) NOT NULL,
  `status` enum('admin','user') NOT NULL DEFAULT 'admin',
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_modul`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`, `link`, `urutan`, `status`, `aktif`) VALUES
(2, 'User', '?module=user', 1, 'user', 'Y'),
(3, 'Modul', '?module=modul', 2, 'admin', 'Y'),
(5, 'Kategori', '?module=kategori', 3, 'user', 'Y'),
(26, 'Identitas Web', '?module=identitas', 11, 'admin', 'N'),
(25, 'Laporan', '?module=laporan', 10, 'admin', 'N'),
(24, 'Data Peminjaman', '?module=datapinjam', 9, 'user', 'Y'),
(23, 'Peminjaman', '?module=peminjaman', 8, 'user', 'Y'),
(22, 'Pengadaan', '?module=pengadaan', 7, 'admin', 'Y'),
(21, 'Siswa', '?module=siswa', 6, 'admin', 'Y'),
(20, 'Buku', '?module=buku', 5, 'user', 'Y'),
(19, 'Penerbit', '?module=penerbit', 4, 'user', 'Y'),
(27, 'Pengembalian', '?module=pengembalian', 12, 'admin', 'Y'),
(28, 'Laporan Per Siswa', '?module=lap_persiswa', 13, 'admin', 'Y'),
(29, 'Laporan Bulan', '?module=lap_bulan', 14, 'admin', 'Y'),
(30, 'Grafik', '?module=grafik', 15, 'admin', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE IF NOT EXISTS `peminjaman` (
  `no_pinjam` char(6) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `status` enum('Pinjam','Kembali') NOT NULL DEFAULT 'Pinjam',
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`no_pinjam`),
  KEY `kd_siswa` (`nisn`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`no_pinjam`, `tgl_pinjam`, `tgl_kembali`, `nisn`, `status`, `username`) VALUES
('PJ0001', '2017-07-23', '2017-07-29', '161710313', 'Pinjam', 'admin'),
('PJ0002', '2017-07-23', '2017-07-26', '161710314', 'Kembali', 'admin'),
('PJ0003', '2017-07-23', '2017-07-26', '161710315', 'Kembali', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_detil`
--

CREATE TABLE IF NOT EXISTS `peminjaman_detil` (
  `no_pinjam` char(6) NOT NULL,
  `kd_buku` char(5) NOT NULL,
  KEY `no_pinjam` (`no_pinjam`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman_detil`
--

INSERT INTO `peminjaman_detil` (`no_pinjam`, `kd_buku`) VALUES
('PJ0003', 'B0003'),
('PJ0003', 'B0001'),
('PJ0002', 'B0003'),
('PJ0002', 'B0001'),
('PJ0001', 'B0002'),
('PJ0001', 'B0002'),
('PJ0001', 'B0001');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE IF NOT EXISTS `penerbit` (
  `kd_penerbit` char(3) NOT NULL,
  `nm_penerbit` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_penerbit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`kd_penerbit`, `nm_penerbit`) VALUES
('P01', 'Erlangga'),
('P02', 'Kanisius'),
('P03', 'Intan Pariwara'),
('P04', 'Elex Media Komputindo'),
('P05', 'Andi Offset'),
('P06', 'PPDPN'),
('P08', 'Penerbit Andie');

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan`
--

CREATE TABLE IF NOT EXISTS `pengadaan` (
  `no_pengadaan` char(5) NOT NULL,
  `tgl_pengadaan` date NOT NULL,
  `kd_buku` char(5) NOT NULL,
  `asal_buku` varchar(100) NOT NULL,
  `jumlah` int(2) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`no_pengadaan`),
  KEY `kd_buku` (`kd_buku`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengadaan`
--

INSERT INTO `pengadaan` (`no_pengadaan`, `tgl_pengadaan`, `kd_buku`, `asal_buku`, `jumlah`, `keterangan`) VALUES
('PG002', '2017-07-01', 'B0002', 'amik', 10, 'buku rpl'),
('PG003', '2017-06-29', 'B0004', 'bantuan pemda bekasi', 100, 'baru');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `nisn` varchar(20) NOT NULL,
  `nm_siswa` varchar(32) NOT NULL,
  `kelamin` varchar(32) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  PRIMARY KEY (`nisn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nm_siswa`, `kelamin`, `kelas`, `tempat_lahir`) VALUES
('161710348', 'YOGI AJI PANGESTU  ', 'L', 'X RPL 1', 'Jakarta'),
('161710347', 'TOHIR ROHILI', 'L', 'X RPL 1', 'Depok'),
('161710346', 'SYIHAN AL KHAIRI MUSYAFFA', 'L', 'X RPL 1', 'Ciamis'),
('161710345', 'SITI RAHMI ANGGI SANI', 'P', 'X RPL 1', 'Bogor'),
('161710344', 'SITI KHOLIFAH', 'P', 'X RPL 1', 'Bekasi '),
('161710343', 'SHINTA EKA APRILIA', 'P', 'X RPL 1', 'Jakarta'),
('161710342', 'PUTRI ATIKA CHAIRULIA', 'P', 'X RPL 1', 'Depok'),
('161710341', 'PUTRI ARISA SARI', 'P', 'X RPL 1', 'Ciamis'),
('161710340', 'PUTRI ANDAYANI', 'P', 'X RPL 1', 'Bogor'),
('161710339', 'PIETA TUFFAHATY SAFIRA', 'P', 'X RPL 1', 'Bekasi '),
('161710338', 'NUR AZIZAH', 'P', 'X RPL 1', 'Jakarta'),
('161710337', 'NEVI DWI APRILIA', 'P', 'X RPL 1', 'Depok'),
('161710336', 'Nadia Nurharisa', 'P', 'X RPL 1', 'Ciamis'),
('161710335', 'MUHAMMAD RAIHAN AL AMEER', 'L', 'X RPL 1', 'Bogor'),
('161710334', 'MUHAMMAD AFANDI AZIZ', 'L', 'X RPL 1', 'Bekasi '),
('161710333', 'MUHAMMAD ADI KURNIAWAN', 'L', 'X RPL 1', 'Jakarta'),
('161710332', 'MUHAMAD RIZKY ARDIANSYAH  ', 'L', 'X RPL 1', 'Depok'),
('161710330', 'MITA AYUNI PUTRI', 'P', 'X RPL 1', 'Ciamis'),
('161710329', 'KARTIKA BATISTUTI TEFNAY', 'P', 'X RPL 1', 'Bogor'),
('161710328', 'JULLIAN RAMADHAN', 'L', 'X RPL 1', 'Bekasi '),
('161710327', 'INTANIYA', 'P', 'X RPL 1', 'Jakarta'),
('161710326', 'INE ANGGRAENY', 'P', 'X RPL 1', 'Depok'),
('161710325', 'INDRIYANI', 'P', 'X RPL 1', 'Ciamis'),
('161710324', 'HERDA RAVITANIA', 'P', 'X RPL 1', 'Bogor'),
('161710323', 'ERWIN HASIBUAN', 'L', 'X RPL 1', 'Bekasi '),
('161710322', 'ERFIEANI', 'P', 'X RPL 1', 'Jakarta'),
('161710321', 'ELITA LESTARI', 'P', 'X RPL 1', 'Depok'),
('161710320', 'DHIMAS BAGUS ARYO UTOMO', 'L', 'X RPL 1', 'Ciamis'),
('161710319', 'DESI NURNELA', 'P', 'X RPL 1', 'Bogor'),
('161710318', 'DERRYL AIME ULLAYA', 'P', 'X RPL 1', 'Bekasi '),
('161710317', 'CERAH NAINGGOLAN PARHUSIP', 'P', 'X RPL 1', 'Jakarta'),
('161710316', 'BINTANG WISNU WARDHANA PRIYANTO', 'L', 'X RPL 1', 'Depok'),
('161710315', 'ARYOSENA FITRANDY RAHARJO', 'L', 'X RPL 1', 'Ciamis'),
('161710314', 'ARIF HILMI HAKIM', 'P', 'X RPL 1', 'Bogor'),
('161710313', 'ADIKA JULIANTARA SAPUTRA', 'L', 'X RPL 1', 'Bekasi '),
('9090909', 'HERRY PRASETYO GANTENG', 'L', 'X RPL 0', 'Rhasia');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_pinjam`
--

CREATE TABLE IF NOT EXISTS `tmp_pinjam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kd_buku` char(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `tmp_pinjam`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `level` enum('admin','user') NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_session` varchar(100) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `email`, `level`, `blokir`, `id_session`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@gmail.com', 'admin', 'N', 'vdc57ib93tjfir9e5npft77ni7'),
('dwiari@smkn2kotabeka', '81dc9bdb52d04dc20036dbd8313ed055', 'dwi ari wibowo', 'deathnote3012@gmail.com', 'user', 'N', ''),
('hery', '202cb962ac59075b964b07152d234b70', 'Herry Prasetyo', 'herry_prasetyo@hotmail.com', 'user', 'N', 'j1erb39aoibqkk7g8bpnmerdb2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
