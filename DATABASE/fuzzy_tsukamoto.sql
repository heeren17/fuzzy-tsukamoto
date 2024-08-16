-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2023 at 03:27 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuzzy_tsukamoto`
--

-- --------------------------------------------------------

--
-- Table structure for table `dataset`
--

CREATE TABLE `dataset` (
  `id_dataset` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `permintaan` int(11) NOT NULL,
  `produksi` int(11) NOT NULL,
  `penjualan` int(11) NOT NULL,
  `persediaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_hitung_rules_fuzzy`
--

CREATE TABLE `data_hitung_rules_fuzzy` (
  `id_hitung` int(11) NOT NULL,
  `id_uji` int(11) NOT NULL,
  `id_rules` int(11) NOT NULL,
  `hitung_permintaan` float NOT NULL,
  `hitung_produk` float NOT NULL,
  `hitung_penjualan` float NOT NULL,
  `minn` float NOT NULL,
  `hitung_persediaan` float NOT NULL,
  `prediksi` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_nilai_keanggotaan`
--

CREATE TABLE `data_nilai_keanggotaan` (
  `id_nilai` int(11) NOT NULL,
  `id_uji` int(11) NOT NULL,
  `keanggotaan` varchar(50) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_uji`
--

CREATE TABLE `data_uji` (
  `id_uji` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `permintaan_uji` int(11) NOT NULL,
  `produksi_uji` int(11) NOT NULL,
  `penjualan_uji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usernname` varchar(50) NOT NULL,
  `passsword` varchar(50) NOT NULL,
  `status` enum('ADMIN','USER') NOT NULL DEFAULT 'ADMIN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_user`, `nama_user`, `email`, `usernname`, `passsword`, `status`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', 'admin', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_fuzzy_tsukamoto`
--

CREATE TABLE `hasil_fuzzy_tsukamoto` (
  `id_fuzzy` int(11) NOT NULL,
  `id_uji` int(11) NOT NULL,
  `hasil_fuzzy` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rule_fuzzy`
--

CREATE TABLE `rule_fuzzy` (
  `id_rule` int(11) NOT NULL,
  `rules` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rule_fuzzy`
--

INSERT INTO `rule_fuzzy` (`id_rule`, `rules`) VALUES
(1, 'IF Permintaan TURUN And Produksi SEDIKIT And Penjualan RENDAH THEN Persediaan BERKURANG'),
(2, 'IF Permintaan TURUN And Produksi SEDIKIT And Penjualan RENDAH THEN Persediaan BERTAMBAH'),
(3, 'IF Permintaan TURUN And Produksi SEDIKIT And Penjualan TINGGI THEN Persediaan BERKURANG'),
(4, 'IF Permintaan TURUN And Produksi SEDIKIT And Penjualan TINGGI THEN Persediaan BERTAMBAH '),
(5, 'IF Permintaan TURUN And Produksi BANYAK And Penjualan RENDAH THEN Persediaan BERKURANG'),
(6, 'IF Permintaan TURUN And Produksi BANYAK And Penjualan RENDAH THEN Persediaan BERTAMBAH'),
(7, 'IF Permintaan TURUN And Persediaan BANYAK And Penjualan TINGGI THEN Produksi BERKURANG'),
(8, 'IF Permintaan TURUN And Produksi BANYAK And Penjualan TINGGI THEN Persediaan BERTAMBAH '),
(9, 'IF Permintaan NAIK And Persediaan SEDIKIT And Penjualan RENDAH THEN Produksi BERKURANG'),
(10, 'IF Permintaan NAIK And Produksi SEDIKIT And Penjualan RENDAH THEN Persediaan BERTAMBAH'),
(11, 'IF Permintaan NAIK And Produksi SEDIKIT And Penjualan TINGGI THEN Persediaan BERKURANG'),
(12, 'IF Permintaan NAIK And Produksi SEDIKIT And Penjualan TINGGI THEN Persediaan BERTAMBAH'),
(13, 'IF Permintaan NAIK And Persediaan BANYAK And Penjualan RENDAH THEN Produksi BERKURANG'),
(14, 'IF Permintaan NAIK And Produksi BANYAK And Penjualan RENDAH THEN Persediaan BERTAMBAH'),
(15, 'IF Permintaan NAIK And Produksi BANYAK And Penjualan TINGGI THEN Persediaan BERKURANG'),
(16, 'IF Permintaan NAIK And Produksi BANYAK And Penjualan TINGGI THEN Persediaan BERTAMBAH');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dataset`
--
ALTER TABLE `dataset`
  ADD PRIMARY KEY (`id_dataset`) USING BTREE,
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `data_hitung_rules_fuzzy`
--
ALTER TABLE `data_hitung_rules_fuzzy`
  ADD PRIMARY KEY (`id_hitung`) USING BTREE,
  ADD KEY `id_uji` (`id_uji`),
  ADD KEY `id_rules` (`id_rules`);

--
-- Indexes for table `data_nilai_keanggotaan`
--
ALTER TABLE `data_nilai_keanggotaan`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_uji` (`id_uji`);

--
-- Indexes for table `data_uji`
--
ALTER TABLE `data_uji`
  ADD PRIMARY KEY (`id_uji`) USING BTREE,
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `hasil_fuzzy_tsukamoto`
--
ALTER TABLE `hasil_fuzzy_tsukamoto`
  ADD PRIMARY KEY (`id_fuzzy`),
  ADD KEY `id_uji` (`id_uji`);

--
-- Indexes for table `rule_fuzzy`
--
ALTER TABLE `rule_fuzzy`
  ADD PRIMARY KEY (`id_rule`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dataset`
--
ALTER TABLE `dataset`
  MODIFY `id_dataset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `data_hitung_rules_fuzzy`
--
ALTER TABLE `data_hitung_rules_fuzzy`
  MODIFY `id_hitung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `data_nilai_keanggotaan`
--
ALTER TABLE `data_nilai_keanggotaan`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `data_uji`
--
ALTER TABLE `data_uji`
  MODIFY `id_uji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hasil_fuzzy_tsukamoto`
--
ALTER TABLE `hasil_fuzzy_tsukamoto`
  MODIFY `id_fuzzy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dataset`
--
ALTER TABLE `dataset`
  ADD CONSTRAINT `FK_dataset_data_user` FOREIGN KEY (`id_user`) REFERENCES `data_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `data_hitung_rules_fuzzy`
--
ALTER TABLE `data_hitung_rules_fuzzy`
  ADD CONSTRAINT `FK_data_hitung_rules_fuzzy_data_uji` FOREIGN KEY (`id_uji`) REFERENCES `data_uji` (`id_uji`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_data_hitung_rules_fuzzy_rule_fuzzy` FOREIGN KEY (`id_rules`) REFERENCES `rule_fuzzy` (`id_rule`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `data_nilai_keanggotaan`
--
ALTER TABLE `data_nilai_keanggotaan`
  ADD CONSTRAINT `FK_data_nilai_keanggotaan_data_uji` FOREIGN KEY (`id_uji`) REFERENCES `data_uji` (`id_uji`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `data_uji`
--
ALTER TABLE `data_uji`
  ADD CONSTRAINT `FK_data_uji_data_user` FOREIGN KEY (`id_user`) REFERENCES `data_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `hasil_fuzzy_tsukamoto`
--
ALTER TABLE `hasil_fuzzy_tsukamoto`
  ADD CONSTRAINT `FK_hasil_fuzzy_tsukamoto_data_uji` FOREIGN KEY (`id_uji`) REFERENCES `data_uji` (`id_uji`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
