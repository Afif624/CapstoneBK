-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2024 at 09:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poli`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_poli`
--

CREATE TABLE `daftar_poli` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pasien` int(11) UNSIGNED NOT NULL,
  `id_jadwal` int(11) UNSIGNED NOT NULL,
  `keluhan` text NOT NULL,
  `no_antrian` int(10) UNSIGNED NOT NULL,
  `pemeriksaan` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_poli`
--

INSERT INTO `daftar_poli` (`id`, `id_pasien`, `id_jadwal`, `keluhan`, `no_antrian`, `pemeriksaan`) VALUES
(4, 1, 7, 'Sakit Gigi', 1, '1'),
(5, 9, 7, 'Patah Hati', 2, '1'),
(6, 10, 7, 'Sakit Kepala', 3, '1'),
(7, 11, 7, 'Sakit Telinga', 4, '1'),
(8, 13, 5, 'Sakit Telinga', 1, '0'),
(11, 13, 7, 'Sakit Punggung', 5, '0'),
(16, 15, 6, 'Patah Hati Parah', 1, '0'),
(18, 10, 12, 'Diare', 1, '1'),
(19, 16, 12, 'Mata Minus', 2, '0'),
(20, 1, 11, 'Sakit Gigi 2', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `detail_periksa`
--

CREATE TABLE `detail_periksa` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_periksa` int(11) UNSIGNED NOT NULL,
  `id_obat` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_periksa`
--

INSERT INTO `detail_periksa` (`id`, `id_periksa`, `id_obat`) VALUES
(19, 12, 6),
(20, 12, 4),
(21, 14, 3),
(22, 14, 5),
(23, 15, 6),
(24, 15, 5),
(25, 15, 7),
(26, 16, 3),
(27, 16, 6),
(28, 16, 4),
(29, 16, 5),
(30, 17, 6),
(31, 17, 4),
(32, 18, 5),
(33, 18, 7);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `id_poli` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `nama`, `username`, `password`, `alamat`, `no_hp`, `id_poli`) VALUES
(16, 'Afif Pristantio', 'dokfif', '12345', 'Blora', '0823-5358-0751', 5),
(17, 'Reza Arwana', 'dokrez', '12345', 'Purwodadi', '0823-5358-0750', 1),
(19, 'Galuh Ardana', 'dokluh', '12345', 'Surabaya', '0823-5358-0754', 4);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_periksa`
--

CREATE TABLE `jadwal_periksa` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_dokter` int(11) UNSIGNED NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `aktivasi` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_periksa`
--

INSERT INTO `jadwal_periksa` (`id`, `id_dokter`, `hari`, `jam_mulai`, `jam_selesai`, `aktivasi`) VALUES
(2, 16, 'Kamis', '08:20:00', '11:20:00', '1'),
(3, 17, 'Sabtu', '10:00:00', '11:00:00', '0'),
(4, 17, 'Jumat', '08:00:00', '12:00:00', '0'),
(5, 17, 'Rabu', '14:00:00', '16:00:00', '0'),
(6, 16, 'Senin', '08:40:00', '10:40:00', '1'),
(7, 16, 'Selasa', '13:00:00', '15:00:00', '1'),
(11, 16, 'Sabtu', '18:00:00', '20:00:00', '0'),
(12, 19, 'Kamis', '18:00:00', '20:00:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_obat` varchar(100) NOT NULL,
  `kemasan` varchar(50) NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `kemasan`, `harga`) VALUES
(3, 'Alprazolam', 'sachet', 70000),
(4, 'Mixagrip', 'sachet', 30000),
(5, 'Parachetamol', 'Botol 50ml', 40000),
(6, 'Bodrex', 'sachet', 60000),
(7, 'Tolak Angin', 'Botol 50ml', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_ktp` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `no_rm` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nama`, `username`, `password`, `alamat`, `no_ktp`, `no_hp`, `no_rm`) VALUES
(1, 'Reza', 'pasrez', '12345', 'Blora', '12-34-56-789000-0000', '0823-5358-0750', '202312-1'),
(9, 'Aznan', 'pasnan', '12345', 'Semarang', '12-34-56-789000-0007', '0823-5358-0751', '202312-9'),
(10, 'Afif', 'pasfif', '12345', 'Kudus', '12-34-56-789000-0002', '0823-5358-0754', '202312-10'),
(11, 'Shinta', 'pashin', '12345', 'Blora', '12-34-56-789000-0001', '082353580752', '202312-11'),
(13, 'Arga', 'pasga', '12345', 'Salatiga', '12-34-56-789000-0010', '0823-5358-0755', '202312-13'),
(15, 'Frizy', 'paszy', '12345', 'Blora', '12-34-56-789000-0058', '0823-5358-0758', '202312-15'),
(16, 'Rayyan', 'pasray', '12345', 'Pati', '12-34-56-789000-0111', '0823-5358-0751', '202401-16'),
(18, 'Aznan', 'pasnad', '12345', 'Semarang', '11-11-11-111111-1111', '0823-5358-0750', '202401-18');

-- --------------------------------------------------------

--
-- Table structure for table `periksa`
--

CREATE TABLE `periksa` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_daftar_poli` int(11) UNSIGNED NOT NULL,
  `tgl_periksa` datetime NOT NULL,
  `catatan` text NOT NULL,
  `biaya_periksa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periksa`
--

INSERT INTO `periksa` (`id`, `id_daftar_poli`, `tgl_periksa`, `catatan`, `biaya_periksa`) VALUES
(12, 5, '2023-12-24 00:00:00', 'Banyakin Tidur dan Jangan mudah Baper', 240000),
(14, 4, '2023-12-24 00:00:00', 'Jangan Makan Coklat', 260000),
(15, 6, '2023-12-24 00:00:00', 'Jangan banyak pikiran', 260000),
(16, 7, '2023-12-24 00:00:00', 'Seringlah dibersihkan Telinganya', 350000),
(17, 18, '2023-12-31 00:00:00', 'Makan Makanan Bergizi', 240000),
(18, 20, '2024-01-04 00:00:00', 'Jangan Makan Coklat 2', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_poli` varchar(25) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id`, `nama_poli`, `keterangan`) VALUES
(1, 'Poli Anak', 'Poliklinik untuk Anak usia diatas 7 hingga 12 Tahun'),
(4, 'Poli Mata', 'Poliklinik untuk kesehatan Mata'),
(5, 'Poli Gigi', 'Poliklinik untuk kesehatan Gigi'),
(7, 'Poli Kaki', 'Poliklinik untuk kesehatan Kaki');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_daftarpoli_jadwalperiksa` (`id_jadwal`),
  ADD KEY `fk_daftarpoli_pasien` (`id_pasien`);

--
-- Indexes for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_periksa_obat` (`id_obat`),
  ADD KEY `fk_detail_periksa_periksa` (`id_periksa`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dokter_poli` (`id_poli`);

--
-- Indexes for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jadwalperiksa_dokter` (`id_dokter`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_periksa_daftarpoli` (`id_daftar_poli`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `periksa`
--
ALTER TABLE `periksa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD CONSTRAINT `fk_daftarpoli_jadwalperiksa` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_periksa` (`id`),
  ADD CONSTRAINT `fk_daftarpoli_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`);

--
-- Constraints for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD CONSTRAINT `fk_detail_periksa_obat` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`),
  ADD CONSTRAINT `fk_detail_periksa_periksa` FOREIGN KEY (`id_periksa`) REFERENCES `periksa` (`id`);

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `fk_dokter_poli` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id`);

--
-- Constraints for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD CONSTRAINT `fk_jadwalperiksa_dokter` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id`);

--
-- Constraints for table `periksa`
--
ALTER TABLE `periksa`
  ADD CONSTRAINT `fk_periksa_daftarpoli` FOREIGN KEY (`id_daftar_poli`) REFERENCES `daftar_poli` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
