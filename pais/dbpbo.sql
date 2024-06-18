-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 07:41 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpbo`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `no_anggota` varchar(10) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kelompok` varchar(30) NOT NULL,
  `no_telp` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`no_anggota`, `nama_anggota`, `alamat`, `kelompok`, `no_telp`, `foto`) VALUES
('A00001', 'Dede Ramadhan', 'Jatihurip', 'Dera Fish', '089504511336', 'download.png');

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `no_aset` varchar(10) NOT NULL,
  `aset_masuk` varchar(100) NOT NULL,
  `kondisi_aset` varchar(100) NOT NULL,
  `kategori_aset` varchar(100) NOT NULL,
  `status_aset` varchar(50) NOT NULL,
  `harga_beli` int(20) NOT NULL,
  `harga_jual` int(20) NOT NULL,
  `stok` int(20) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`no_aset`, `aset_masuk`, `kondisi_aset`, `kategori_aset`, `status_aset`, `harga_beli`, `harga_jual`, `stok`, `keterangan`) VALUES
('DA0001', 'Feeder', 'Baik', 'Mesin', 'Tersedia', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `aset_keluar`
--

CREATE TABLE `aset_keluar` (
  `no_aset_keluar` varchar(20) NOT NULL,
  `aset_masuk` varchar(100) NOT NULL,
  `kategori_aset` varchar(100) NOT NULL,
  `status_aset` varchar(100) NOT NULL,
  `tanggal_keluar` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aset_keluar`
--

INSERT INTO `aset_keluar` (`no_aset_keluar`, `aset_masuk`, `kategori_aset`, `status_aset`, `tanggal_keluar`, `keterangan`) VALUES
('AK0001', 'Pompa', 'Mesin', 'Diperbaiki', '', 'Bekas dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `aset_masuk`
--

CREATE TABLE `aset_masuk` (
  `no_aset_masuk` varchar(100) NOT NULL,
  `nama_aset` varchar(200) NOT NULL,
  `kategori_aset` varchar(100) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aset_masuk`
--

INSERT INTO `aset_masuk` (`no_aset_masuk`, `nama_aset`, `kategori_aset`, `tanggal_masuk`) VALUES
('AM001', 'Pompa', 'Mesin', '0000-00-00'),
('AM002', 'Feeder', 'Mesin', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `no_karyawan` varchar(10) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `password` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`no_karyawan`, `nama_karyawan`, `alamat`, `password`, `foto`) VALUES
('admin', 'Fasya Zahira Badeni', 'Dsn. Sukamulya, Ds. Jathirup, RT03/RW06, Kec. Sumedang utara, Kab. Sumedang', 'admin', 'fasya.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_aset`
--

CREATE TABLE `kategori_aset` (
  `no_kategori_aset` varchar(10) NOT NULL,
  `nama_kategori_aset` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_aset`
--

INSERT INTO `kategori_aset` (`no_kategori_aset`, `nama_kategori_aset`) VALUES
('KT001', 'Mesin'),
('KT002', 'Peralatan'),
('KT003', 'Perlengkapan');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi_aset`
--

CREATE TABLE `kondisi_aset` (
  `no_kondisi_aset` varchar(10) NOT NULL,
  `nama_kondisi_aset` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kondisi_aset`
--

INSERT INTO `kondisi_aset` (`no_kondisi_aset`, `nama_kondisi_aset`) VALUES
('KL00001', 'Baik'),
('KL00002', 'Kurang Baik'),
('KL00003', 'Cukup Buruk'),
('KL00004', 'Rusak'),
('KL00005', 'Perlu Diperbaiki');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `no_maintenance` varchar(20) NOT NULL,
  `aset_masuk` varchar(200) NOT NULL,
  `tanggal_mulai` varchar(100) NOT NULL,
  `tanggal_selesai` varchar(100) NOT NULL,
  `biaya` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `no_peminjaman` varchar(20) NOT NULL,
  `nama_peminjam` varchar(200) NOT NULL,
  `aset_masuk` varchar(100) NOT NULL,
  `jumlah` int(30) NOT NULL,
  `tanggal_pinjam` varchar(50) NOT NULL,
  `tanggal_kembali` varchar(50) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `status_aset`
--

CREATE TABLE `status_aset` (
  `no_status_aset` varchar(10) NOT NULL,
  `nama_status_aset` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_aset`
--

INSERT INTO `status_aset` (`no_status_aset`, `nama_status_aset`) VALUES
('UA00001', 'Tersedia'),
('UA00002', 'Tidak tersedia'),
('UA00003', 'Hilang'),
('UA00004', 'Diperbaiki'),
('UA00005', 'Diajukan'),
('UA00006', 'Dipinjam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`no_anggota`);

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`no_aset`);

--
-- Indexes for table `aset_keluar`
--
ALTER TABLE `aset_keluar`
  ADD PRIMARY KEY (`no_aset_keluar`);

--
-- Indexes for table `aset_masuk`
--
ALTER TABLE `aset_masuk`
  ADD PRIMARY KEY (`no_aset_masuk`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`no_karyawan`);

--
-- Indexes for table `kategori_aset`
--
ALTER TABLE `kategori_aset`
  ADD PRIMARY KEY (`no_kategori_aset`);

--
-- Indexes for table `kondisi_aset`
--
ALTER TABLE `kondisi_aset`
  ADD PRIMARY KEY (`no_kondisi_aset`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`no_maintenance`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`no_peminjaman`);

--
-- Indexes for table `status_aset`
--
ALTER TABLE `status_aset`
  ADD PRIMARY KEY (`no_status_aset`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
