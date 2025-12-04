-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 08:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sklipci`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `user_id`, `nip`, `nama`, `prodi_id`, `no_hp`, `created_at`) VALUES
(4, 8, '410470105003', 'Suwinarno Nadjmudin, S.kom, M.kom', 1, '1234567890', '2025-12-01 16:52:34'),
(7, 13, '410470102011', 'Dendin Supriadi, S.Pd., M.T.', 1, '1234567890', '2025-12-03 17:30:33'),
(8, 14, '410470105014', 'Muhamad Fadli, S.T., M.Kom.', 1, '1234567890', '2025-12-03 17:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `jenis` enum('seminar','sidang') NOT NULL,
  `pengajuan_id` int(11) DEFAULT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `dosen_pembimbing_id` int(11) DEFAULT NULL,
  `dosen_penguji_id` int(11) DEFAULT NULL,
  `dosen_penguji_2_id` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time DEFAULT NULL,
  `ruangan` varchar(100) NOT NULL,
  `status` enum('dijadwalkan','dikonfirmasi','ditolak') NOT NULL DEFAULT 'dijadwalkan',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_akhir`
--

CREATE TABLE `laporan_akhir` (
  `id` int(11) NOT NULL,
  `pengajuan_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `status` enum('diajukan','diterima','ditolak') NOT NULL DEFAULT 'diajukan',
  `catatan_admin` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_bimbingan`
--

CREATE TABLE `log_bimbingan` (
  `id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `topik` varchar(255) NOT NULL,
  `catatan_mahasiswa` text DEFAULT NULL,
  `catatan_dosen` text DEFAULT NULL,
  `status` enum('diajukan','disetujui','direvisi') NOT NULL DEFAULT 'diajukan',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_pkl`
--

CREATE TABLE `log_pkl` (
  `id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kegiatan` text NOT NULL,
  `lokasi` varchar(150) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `output` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_pkl`
--

INSERT INTO `log_pkl` (`id`, `mahasiswa_id`, `tanggal`, `kegiatan`, `lokasi`, `jam_mulai`, `jam_selesai`, `output`, `created_at`) VALUES
(3, 3, '2025-12-27', 'menjalani PKL', '', '08:00:00', '15:34:00', '-', '2025-12-04 07:34:20');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nim` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `angkatan` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `user_id`, `nim`, `nama`, `prodi_id`, `no_hp`, `kelas`, `angkatan`, `created_at`) VALUES
(3, 12, '10521035', 'Rizki Maulana', 1, '089657908809', 'IF1', '2021', '2025-12-03 06:48:28');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `jenis` enum('pkl','skripsi','seminar','sidang') NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `status` enum('diajukan','diterima','ditolak') NOT NULL DEFAULT 'diajukan',
  `catatan_admin` text DEFAULT NULL,
  `pembimbing_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `tempat_pkl` varchar(255) DEFAULT NULL,
  `lama_pkl` varchar(100) DEFAULT NULL,
  `judul_2` text DEFAULT NULL,
  `judul_3` text DEFAULT NULL,
  `judul_4` text DEFAULT NULL,
  `judul_5` text DEFAULT NULL,
  `file_syarat` varchar(255) DEFAULT NULL,
  `skripsi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id`, `mahasiswa_id`, `jenis`, `judul`, `deskripsi`, `lampiran`, `status`, `catatan_admin`, `pembimbing_id`, `created_at`, `updated_at`, `tempat_pkl`, `lama_pkl`, `judul_2`, `judul_3`, `judul_4`, `judul_5`, `file_syarat`, `skripsi_id`) VALUES
(5, 3, 'pkl', 'Sistem informasi', '123', NULL, 'diterima', '', 4, '2025-12-03 18:20:41', '2025-12-03 18:27:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 3, 'pkl', 'PKL di abcdef', 'Tempat PKL : abcdef\nTanggal Mulai : 2025-12-12\nTanggal Selesai : 2026-01-11\n', NULL, 'diajukan', '', 7, '2025-12-04 07:22:21', '2025-12-04 07:25:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 3, 'skripsi', 'abc', 'Pengajuan judul skripsi.\n', NULL, 'ditolak', '', NULL, '2025-12-04 07:22:52', '2025-12-04 07:25:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 3, 'skripsi', 'abcd', 'Pengajuan judul skripsi.\n', NULL, 'diterima', '-', 4, '2025-12-04 07:22:52', '2025-12-04 07:32:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 3, 'skripsi', 'abcde', 'Pengajuan judul skripsi.\n', NULL, 'diajukan', NULL, NULL, '2025-12-04 07:22:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 3, 'skripsi', 'abcdef', 'Pengajuan judul skripsi.\n', NULL, 'diajukan', NULL, NULL, '2025-12-04 07:22:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 3, 'skripsi', 'abcdefg', 'Pengajuan judul skripsi.\n', NULL, 'diajukan', NULL, NULL, '2025-12-04 07:22:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 3, 'pkl', 'PKL di abcdef', 'Tempat PKL : abcdef\nTanggal Mulai : 2025-12-04\nTanggal Selesai : 2026-01-01\n\nKeterangan : -\n\nLampiran syarat : public/uploads/pengajuan/pengajuan_pkl_10521035_1764833430.pdf', 'public/uploads/pengajuan/pengajuan_pkl_10521035_1764833430.pdf', 'diajukan', NULL, NULL, '2025-12-04 07:30:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `kode_prodi` varchar(10) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `kode_prodi`, `nama_prodi`, `created_at`) VALUES
(1, 'IF', 'Informatika', '2025-11-29 16:30:34'),
(4, 'BIO', 'Biologi', '2025-12-03 17:21:25'),
(5, 'Fis', 'Fisika', '2025-12-03 17:21:49'),
(6, 'Kim', 'Kimia', '2025-12-03 17:22:11'),
(7, 'Mat', 'Matematika', '2025-12-03 17:22:22'),
(8, 'DI', 'Desain interior', '2025-12-03 17:22:37'),
(9, 'DKV', 'Desain Komunikasi Visual', '2025-12-03 17:22:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `role` enum('admin','mahasiswa','dosen') NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$mcC0bjKW1wwRgHA9OtHOMOwDjAZiY9eoJ5bWXQ.KKQmZBKCilODVS', 'Admin IWU', 'admin', 'aktif', '2025-11-29 15:46:41', '2025-12-03 20:19:30'),
(2, 'mahasiswa', '$2y$10$0E6De3Ih9JfHsbsyEYZU9ehp/.dla4N93mCk7BruZaoYX8jjcR06K', 'Mahasiswa Demo', 'mahasiswa', 'aktif', '2025-11-29 15:46:41', NULL),
(3, 'dosen', '$2y$10$8WS.DhKq48CL5bUexTlMYuWzvjDdK49iEz.oAhEX/NC2fL/G7ok7K', 'Dosen Demo', 'dosen', 'aktif', '2025-11-29 15:46:41', NULL),
(8, 'Kaprodi', '$2y$10$whDDkzw1DZD/XsX2OdD5Ae5o3kc.F74CfCGkLfN4aq/rGqegBeSEa', 'Suwinarno Nadjmudin, S.kom, M.kom', 'dosen', 'aktif', '2025-12-01 16:52:34', NULL),
(12, '1', '$2y$10$WweWtm0ur6SUYiG.j0Tquu9zh/vTM9QnI/dES3.p9yQPi0aPBr/6i', 'Rizki Maulana', 'mahasiswa', 'aktif', '2025-12-03 06:48:28', NULL),
(13, 'dosen1', '$2y$10$/VAO1Ms5OJ43pDQc3P8EUehoBaiNvGVRY07yBbmEKoIl7Ei4JaT1K', 'Dendin Supriadi, S.Pd., M.T.', 'dosen', 'aktif', '2025-12-03 17:30:33', NULL),
(14, 'dosen2', '$2y$10$VS/njGOKmT.QMKQkkAr8n.j550/r82BwponNG3rIW4yUbo3xQsq2e', 'Muhamad Fadli, S.T., M.Kom.', 'dosen', 'aktif', '2025-12-03 17:31:38', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `fk_dosen_user` (`user_id`),
  ADD KEY `fk_dosen_prodi` (`prodi_id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jadwal_pengajuan` (`pengajuan_id`),
  ADD KEY `fk_jadwal_mhs` (`mahasiswa_id`),
  ADD KEY `fk_jadwal_dosen_pemb` (`dosen_pembimbing_id`),
  ADD KEY `fk_jadwal_dosen_peng` (`dosen_penguji_id`);

--
-- Indexes for table `laporan_akhir`
--
ALTER TABLE `laporan_akhir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_laporan_pengajuan` (`pengajuan_id`),
  ADD KEY `fk_laporan_mhs` (`mahasiswa_id`);

--
-- Indexes for table `log_bimbingan`
--
ALTER TABLE `log_bimbingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_log_bimbingan_mhs` (`mahasiswa_id`),
  ADD KEY `fk_log_bimbingan_dosen` (`dosen_id`);

--
-- Indexes for table `log_pkl`
--
ALTER TABLE `log_pkl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_log_pkl_mhs` (`mahasiswa_id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD KEY `fk_mahasiswa_user` (`user_id`),
  ADD KEY `fk_mahasiswa_prodi` (`prodi_id`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pengajuan_mhs` (`mahasiswa_id`),
  ADD KEY `fk_pengajuan_dosen` (`pembimbing_id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_prodi` (`kode_prodi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `laporan_akhir`
--
ALTER TABLE `laporan_akhir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `log_bimbingan`
--
ALTER TABLE `log_bimbingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_pkl`
--
ALTER TABLE `log_pkl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `fk_dosen_prodi` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`),
  ADD CONSTRAINT `fk_dosen_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `fk_jadwal_dosen_pemb` FOREIGN KEY (`dosen_pembimbing_id`) REFERENCES `dosen` (`id`),
  ADD CONSTRAINT `fk_jadwal_dosen_peng` FOREIGN KEY (`dosen_penguji_id`) REFERENCES `dosen` (`id`),
  ADD CONSTRAINT `fk_jadwal_mhs` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`),
  ADD CONSTRAINT `fk_jadwal_pengajuan` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`);

--
-- Constraints for table `laporan_akhir`
--
ALTER TABLE `laporan_akhir`
  ADD CONSTRAINT `fk_laporan_mhs` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`),
  ADD CONSTRAINT `fk_laporan_pengajuan` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`);

--
-- Constraints for table `log_bimbingan`
--
ALTER TABLE `log_bimbingan`
  ADD CONSTRAINT `fk_log_bimbingan_dosen` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`),
  ADD CONSTRAINT `fk_log_bimbingan_mhs` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`);

--
-- Constraints for table `log_pkl`
--
ALTER TABLE `log_pkl`
  ADD CONSTRAINT `fk_log_pkl_mhs` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `fk_mahasiswa_prodi` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`),
  ADD CONSTRAINT `fk_mahasiswa_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `fk_pengajuan_dosen` FOREIGN KEY (`pembimbing_id`) REFERENCES `dosen` (`id`),
  ADD CONSTRAINT `fk_pengajuan_mhs` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
