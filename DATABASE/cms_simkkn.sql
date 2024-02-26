-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 01, 2023 at 07:23 AM
-- Server version: 10.11.2-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_simkkn`
--

-- --------------------------------------------------------

--
-- Table structure for table `bcms_artikel`
--

CREATE TABLE `bcms_artikel` (
  `artikel_id` int(11) NOT NULL,
  `type` enum('slider','artikel') DEFAULT NULL,
  `title` char(225) NOT NULL,
  `description` text NOT NULL,
  `banner_nm` text NOT NULL,
  `thumbnail_nm` text NOT NULL,
  `status_cd` enum('normal','nullified') NOT NULL DEFAULT 'normal',
  `created_dttm` datetime NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_dttm` datetime NOT NULL,
  `updated_user` int(11) NOT NULL,
  `nullified_dttm` datetime NOT NULL,
  `nullified_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bcms_company`
--

CREATE TABLE `bcms_company` (
  `company_id` int(11) NOT NULL,
  `company_nm` char(225) NOT NULL,
  `email` char(225) NOT NULL,
  `cellphone_informasi` char(225) NOT NULL,
  `cellphone_marketing` char(225) NOT NULL,
  `cellphone_sms_online` char(225) NOT NULL,
  `addr_txt` text NOT NULL,
  `link_website` char(225) NOT NULL,
  `facebook` char(225) NOT NULL,
  `instagram` char(225) NOT NULL,
  `company_logo` text NOT NULL,
  `created_user` int(11) NOT NULL,
  `created_dttm` datetime NOT NULL,
  `updated_user` int(11) NOT NULL,
  `updated_dttm` datetime NOT NULL,
  `nullified_user` int(11) NOT NULL,
  `nullified_dttm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bcms_company`
--

INSERT INTO `bcms_company` (`company_id`, `company_nm`, `email`, `cellphone_informasi`, `cellphone_marketing`, `cellphone_sms_online`, `addr_txt`, `link_website`, `facebook`, `instagram`, `company_logo`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, 'UNIVERSITAS MUHAMMADYAH PALEMBANG', 'redhorivai@gmail.com', '(0711) 513022', '(0711) 513022', '(0711) 513022', 'Alamat: Jl. Jendral A. Yani, Kel. 13 Ulu, Kec. Seberang Ulu II, Palembang, Kode Pos 30263', 'https://simkkn-muhammadyah.com', '@redho.rivai', '@binarykid', '1687056044_beb2d413963f508516e2.jpg', 0, '0000-00-00 00:00:00', 1, '2023-06-30 21:11:39', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bcms_pengaduan`
--

CREATE TABLE `bcms_pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `nama_pengirim` char(225) NOT NULL,
  `email` int(11) NOT NULL,
  `no_telp` char(225) NOT NULL,
  `catatan` text NOT NULL,
  `created_dttm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bcms_pengaduan`
--

INSERT INTO `bcms_pengaduan` (`id_pengaduan`, `nama_pengirim`, `email`, `no_telp`, `catatan`, `created_dttm`) VALUES
(1, 'Meriam Belina', 0, '082282676924', 'hahaha ', '2020-11-13 00:00:00'),
(2, 'Meriam Belina', 0, '082282676924', 'hahaha\n', '2020-11-13 00:00:00'),
(3, 'Okta ler', 0, '0818612672', 'hahaha yang tidak ', '2020-11-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bcms_periode`
--

CREATE TABLE `bcms_periode` (
  `id_periode` int(11) NOT NULL,
  `nm_periode` varchar(30) NOT NULL,
  `semester` enum('genap','ganjil') NOT NULL,
  `buka_pendaftaran` datetime NOT NULL,
  `tutup_pendaftaran` datetime NOT NULL,
  `status_cd` enum('normal','nullified') NOT NULL,
  `status_acc` enum('active','deactive') NOT NULL,
  `created_user` int(11) NOT NULL,
  `created_dttm` datetime NOT NULL,
  `updated_user` int(11) NOT NULL,
  `updated_dttm` datetime NOT NULL,
  `nullified_user` int(11) NOT NULL,
  `nullified_dttm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bcms_periode`
--

INSERT INTO `bcms_periode` (`id_periode`, `nm_periode`, `semester`, `buka_pendaftaran`, `tutup_pendaftaran`, `status_cd`, `status_acc`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, 'Tahun Ajaran 2023', 'genap', '2023-06-20 00:00:01', '2023-06-30 23:59:59', 'normal', 'active', 1, '2023-06-20 04:54:35', 0, '2023-06-20 04:54:35', 0, '2023-06-20 04:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `bcms_users`
--

CREATE TABLE `bcms_users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `gender` enum('L','P') NOT NULL,
  `email` varchar(182) NOT NULL,
  `phone` char(50) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` char(30) DEFAULT NULL,
  `avatar` text NOT NULL,
  `created_user` int(11) DEFAULT NULL,
  `created_dttm` datetime NOT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `updated_dttm` datetime NOT NULL,
  `nullified_user` int(11) DEFAULT NULL,
  `nullified_dttm` datetime NOT NULL,
  `status_acc` enum('active','deactive') DEFAULT 'active',
  `status_cd` enum('normal','nullified') DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bcms_users`
--

INSERT INTO `bcms_users` (`user_id`, `name`, `username`, `gender`, `email`, `phone`, `address`, `password`, `level`, `avatar`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`, `status_acc`, `status_cd`) VALUES
(1, 'redhorivai', 'redhorivai', 'L', 'redhorivai@gmail.com', '085273083460', 'Jl. Segaran 15 ilir', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Super User', '', 1, '2020-11-22 19:33:01', 1, '2020-12-05 22:02:55', 1, '2020-11-28 21:57:56', 'active', 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `periode_nm` varchar(255) DEFAULT NULL,
  `semester_cd` enum('ganjil','genap') NOT NULL,
  `tanggal_buka` date DEFAULT NULL,
  `tanggal_tutup` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `periode_nm`, `semester_cd`, `tanggal_buka`, `tanggal_tutup`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Tahun Ajaran 2011', 'genap', '2023-06-25', '2030-07-11', 1, '2023-06-25 12:35:50', '2023-06-30 02:10:24', 1, 1, '0000-00-00 00:00:00', 0),
(2, 'Tahun Ajaran 2022', 'genap', '2023-06-26', '2023-07-03', 1, '2023-06-25 13:26:53', '2023-06-25 18:09:20', 1, 1, NULL, NULL),
(3, 'Tahun Ajaran 2023', 'ganjil', '2023-06-25', '2023-07-02', 1, '2023-06-25 13:27:37', '2023-06-25 13:27:37', 1, NULL, NULL, NULL),
(4, 'Tahun Ajaran 2029', 'ganjil', '2023-06-28', '2023-06-29', 1, '2023-06-25 17:56:59', '2023-06-25 18:07:01', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_id` varchar(20) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `nama`, `no_id`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `prodi_id`, `foto`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Ahmad Redho Rivai,S.Kom', '13142033', 'L', 'Palembang', '1995-04-30', 'Jln. Segaran Lrg Kuningan No.137 RT 03 RW.01', 1, NULL, '2023-06-30 02:50:16', '2023-07-01 07:15:58', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `fakultas_cd` enum('ekonomi','hukum','pertanian','kedokteran','guru','teknik','agama') NOT NULL,
  `prodi_nm` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `fakultas_cd`, `prodi_nm`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'kedokteran', 'Dokter Umum', '2023-06-25 11:15:57', '0000-00-00 00:00:00', 1, NULL, NULL, NULL),
(2, 'hukum', 'Pidana', '2023-06-25 11:46:12', '2023-06-25 12:24:28', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` enum('admin','dosen','mahasiswa') DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `person_id`, `username`, `email`, `no_hp`, `password`, `level`, `is_active`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'redhorivai', 'redhorivai@gmail.com', '085273083460', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 1, '2023-06-30 02:47:53', '0000-00-00 00:00:00', 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bcms_artikel`
--
ALTER TABLE `bcms_artikel`
  ADD PRIMARY KEY (`artikel_id`);

--
-- Indexes for table `bcms_company`
--
ALTER TABLE `bcms_company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `bcms_pengaduan`
--
ALTER TABLE `bcms_pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`);

--
-- Indexes for table `bcms_periode`
--
ALTER TABLE `bcms_periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `bcms_users`
--
ALTER TABLE `bcms_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bcms_artikel`
--
ALTER TABLE `bcms_artikel`
  MODIFY `artikel_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bcms_company`
--
ALTER TABLE `bcms_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bcms_pengaduan`
--
ALTER TABLE `bcms_pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bcms_periode`
--
ALTER TABLE `bcms_periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bcms_users`
--
ALTER TABLE `bcms_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `person_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
