-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 02:20 PM
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
-- Database: `db_administrasi`
--
CREATE DATABASE IF NOT EXISTS `db_administrasi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_administrasi`;

-- --------------------------------------------------------

--
-- Table structure for table `db_absensi`
--

DROP TABLE IF EXISTS `db_absensi`;
CREATE TABLE `db_absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `NIDN` varchar(255) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `id_kelas` varchar(255) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `tanggal_absensi` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_kelas`
--

DROP TABLE IF EXISTS `db_kelas`;
CREATE TABLE `db_kelas` (
  `id` varchar(100) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `id_wali` varchar(100) NOT NULL,
  `Nama_wali` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `db_kelas`
--

INSERT INTO `db_kelas` (`id`, `nama_kelas`, `id_wali`, `Nama_wali`, `created_at`, `updated_at`) VALUES
('2A', '2A', '30987921879123', 'ketut', NULL, NULL),
('7B', '7B', '2', 'Gede', NULL, NULL),
('9B', '9B', '2', 'Gede', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `db_kelassiswa`
--

DROP TABLE IF EXISTS `db_kelassiswa`;
CREATE TABLE `db_kelassiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_kelas` varchar(100) NOT NULL,
  `NIDN` varchar(255) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `db_kelassiswa`
--

INSERT INTO `db_kelassiswa` (`id`, `kode_kelas`, `NIDN`, `nama_siswa`, `created_at`, `updated_at`) VALUES
(9, '2A', '510092233124233', 'arya', '2024-04-16 20:14:10', '2024-04-16 20:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `db_siswa_baru`
--

DROP TABLE IF EXISTS `db_siswa_baru`;
CREATE TABLE `db_siswa_baru` (
  `NIDN` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tg_tl` varchar(255) NOT NULL,
  `jeniskelamin` enum('Laki-Laki','Perempuan') NOT NULL DEFAULT 'Laki-Laki',
  `asal_sekolah` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `seleksi` varchar(255) NOT NULL,
  `nama_orangtua` varchar(255) NOT NULL,
  `pekerjaan_orangtua` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `db_siswa_baru`
--

INSERT INTO `db_siswa_baru` (`NIDN`, `email`, `nama`, `tg_tl`, `jeniskelamin`, `asal_sekolah`, `alamat`, `seleksi`, `nama_orangtua`, `pekerjaan_orangtua`, `created_at`, `updated_at`) VALUES
('510092233124233', 'aryapratamaputra888@gmail.com', 'arya', '2024-04-03', 'Laki-Laki', 'SMP Dewata', 'dawaas', 'Mandiri', 'Ketut', 'Kartel', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_04_01_140433_create_db_kelas', 2),
(6, '2024_04_01_140551_create_db_siswa_baru', 3),
(7, '2024_04_01_142829_create_db_kelassiswa', 3),
(8, '2024_04_01_144154_create_db_absensi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Guru','Admin','Murid') NOT NULL DEFAULT 'Guru',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Wayan', 'wayanAdmin@gmail.com', NULL, '$2y$10$v4KUekDQ1SZwzwh.8gFuyO9115HqDDnqfgotrkOCygtLOliy0mGlG', 'Admin', NULL, '2024-03-31 09:24:57', '2024-03-31 09:24:57'),
(2, 'Gede', 'gedeGuru@gmail.com', NULL, '$2y$10$wZIO4LoMiy2v8arqTTEjGeUzA8sJ8D4.2JAGpm32Pl8PehqhjF9Pu', 'Guru', NULL, '2024-03-31 09:24:57', '2024-03-31 09:24:57'),
(510092233124233, 'arya', 'aryapratamaputra888@gmail.com', NULL, '$2y$10$ixb2aHZE030rPdWVmiqGhuLZCDnf0wG5ZfNE3G5dsiycRLQfVM0Tu', 'Murid', NULL, '2024-04-16 20:13:16', '2024-04-16 20:13:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_absensi`
--
ALTER TABLE `db_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_kelas`
--
ALTER TABLE `db_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_kelassiswa`
--
ALTER TABLE `db_kelassiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_siswa_baru`
--
ALTER TABLE `db_siswa_baru`
  ADD PRIMARY KEY (`NIDN`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_absensi`
--
ALTER TABLE `db_absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_kelassiswa`
--
ALTER TABLE `db_kelassiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51009211231223346;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
