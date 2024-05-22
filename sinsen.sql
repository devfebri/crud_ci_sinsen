-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 08:34 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sinsen`
--

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `kode_produk` varchar(10) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `status`, `kode_produk`, `foto`) VALUES
(283, 'BODY VARIO 125 ISS MATE BLACK', '250000', 0, 'PRD00201', 'digital_camera_photo-1080x675.jpg'),
(284, 'BODY VARIO 125 ISS MATE  RED', '260000', 1, 'PRD00202', 'digital_camera_photo-1080x6751.jpg'),
(285, 'BODY VARIO 160 ISS ABS', '300000', 1, 'PRD00203', 'images.png'),
(286, 'BODY VARIO 160 ISS CBS', '280000', 1, 'PRD00204', 'digital_camera_photo-1080x6752.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_detail` int(11) NOT NULL,
  `id_trx` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_detail`, `id_trx`, `id_produk`, `harga`, `qty`, `subtotal`) VALUES
(98, 27, 286, '280000', 2, '560000'),
(99, 27, 285, '300000', 2, '600000'),
(100, 26, 283, '250000', 1, '250000'),
(101, 26, 285, '300000', 2, '600000'),
(103, 24, 283, '250000', 2, '500000'),
(104, 24, 285, '300000', 30, '9000000'),
(105, 25, 284, '260000', 8, '2080000'),
(106, 25, 284, '260000', 3, '780000'),
(107, 25, 285, '300000', 1, '300000');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_header`
--

CREATE TABLE `transaksi_header` (
  `id_trx` int(11) NOT NULL,
  `kode_trx` varchar(100) DEFAULT NULL,
  `nama_consumen` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `tanggal_trx` date DEFAULT NULL,
  `total` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi_header`
--

INSERT INTO `transaksi_header` (`id_trx`, `kode_trx`, `nama_consumen`, `deskripsi`, `tanggal_trx`, `total`, `status`) VALUES
(24, 'TRX00001', 'Febri', 'baru', '2024-05-21', '9500000', '3'),
(25, 'TRX00002', 'Rian', 'test', '2024-05-21', '3160000', '2'),
(26, 'TRX00003', 'Leons', 'leon', '2024-05-22', '850000', '1'),
(27, 'TRX00004', 'Kamsul', 'test', '2024-05-22', '1160000', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `transaksi_header`
--
ALTER TABLE `transaksi_header`
  ADD PRIMARY KEY (`id_trx`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `transaksi_header`
--
ALTER TABLE `transaksi_header`
  MODIFY `id_trx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
