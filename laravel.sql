-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 15, 2026 at 08:10 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bagi_hasil_log`
--

CREATE TABLE `bagi_hasil_log` (
  `id_log` bigint UNSIGNED NOT NULL,
  `id_investasi` bigint UNSIGNED NOT NULL,
  `tanggal_distribusi` timestamp NOT NULL,
  `nominal_diterima` decimal(15,2) NOT NULL,
  `bukti_transfer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investasi`
--

CREATE TABLE `investasi` (
  `id_investasi` bigint UNSIGNED NOT NULL,
  `id_pengguna` bigint UNSIGNED NOT NULL,
  `id_umkm` bigint UNSIGNED NOT NULL,
  `jumlah_modal` decimal(15,2) NOT NULL,
  `persentase_bagi_hasil` decimal(5,2) NOT NULL,
  `periode_pembagian` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `tanggal_investasi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas_admin`
--

CREATE TABLE `log_aktivitas_admin` (
  `id_log_admin` bigint UNSIGNED NOT NULL,
  `id_pengguna` bigint UNSIGNED NOT NULL,
  `aksi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_perubahan` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_14_000001_update_users_and_create_auth_tables', 2),
(5, '2026_10_15_000001_create_penyedia_ruko_table', 3),
(6, '2026_10_15_000002_create_ruko_table', 3),
(7, '2026_10_15_000003_create_umkm_table', 3),
(8, '2026_10_15_000004_create_investasi_table', 3),
(9, '2026_10_15_000005_create_bagi_hasil_log_table', 3),
(10, '2026_10_15_000006_create_transaksi_sewa_table', 3),
(11, '2026_10_15_000007_create_log_aktivitas_admin_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyedia_ruko`
--

CREATE TABLE `penyedia_ruko` (
  `id_penyedia` bigint UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ruko`
--

CREATE TABLE `ruko` (
  `id_ruko` bigint UNSIGNED NOT NULL,
  `id_penyedia` bigint UNSIGNED NOT NULL,
  `nama_ruko` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_sewa_per_bulan` decimal(12,2) NOT NULL,
  `status_ketersediaan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1YiQbX7Qv4R6G4otdBru56n4DFmCsaBXsyhbWTmM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI1NWdraTFESlNUeGVsdzBFMjBnaFhoWVVDejhITjFpVm96OHQxQWpnIiwiZmlsYW1lbnQiOnsibm90aWZpY2F0aW9ucyI6eyJtYWlsYm94IjoiMjI4YzQzOGZiOGU3ZWQwYjI1ZTJkZGQ2NDI4NmEzZjA2MzIyOTIxYjViOTVkNzVhZGM4NTc5MjU5ODViN2QyNCJ9fSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hdXRoXC9nb29nbGUiLCJyb3V0ZSI6Imdvb2dsZS5yZWRpcmVjdCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sInN0YXRlIjoiTnhzeGhhZnZ1enFpaXNFZmdiUjBjWTJvUU1aakF3YURjbXdjRWZJYiJ9', 1792019465),
('3c1LUClhQ9YK3XWV16teFlUqgWLB2fyObpQ1Ghqk', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.141.0 Chrome/150.0.7871.250 Electron/43.7.7 Safari/537.36', 'eyJfdG9rZW4iOiJENjhQNkxuRklhd2ZTYzNUUGR3M1BiZVVEbW96RVp2QmlpZTUzOWpUIiwiZmlsYW1lbnQiOnsibm90aWZpY2F0aW9ucyI6eyJtYWlsYm94IjoiOTRiZWJiOGU5ODU5NzVhNjZiOWFkODYzMGFkMDk5Yzg3ZTllZDY1MDY1ZWJkZTVhZDIxODNiNTM1ZTlhYzBjOCJ9fSwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FkbWluIn0sIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYWRtaW5cL2xvZ2luIiwicm91dGUiOiJmaWxhbWVudC5hZG1pbi5hdXRoLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791996942),
('4T0BRolIAqKcebu4swwzsp8xtZIWBOTSYdQj8AIn', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI3SnRrYXVtTTZYelNwSk1XaFN0YkJsWlNnNDN6ZzNmUDRKUzlEYXBUIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJmaWxhbWVudCI6eyJub3RpZmljYXRpb25zIjp7Im1haWxib3giOiI0Mzk4MGUxZGIyNTA2ZWRkNjljMzY3OTU4OTlhYmU4ZGQ1MGZiYTIyODg5ZGUxNmE4YTY0ZWVhNmM1Zjg5Mjk0In19LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL3ZlcmlmeS1vdHAiLCJyb3V0ZSI6Im90cC52ZXJpZnkuc2hvdyJ9LCJvdHBfdXNlcl9pZCI6Mywib3RwX2VtYWlsIjoicmFyYWZhZGhpbGxhaDIyQGdtYWlsLmNvbSIsIm90cF9hY3Rpb24iOiJyZXNldF9wYXNzd29yZCIsInJlbWVtYmVyIjpmYWxzZX0=', 1791999953),
('ko2RGXOJjydmJVZ2C9DG0QxGokis7MoH3XYxecv3', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJKMjFINWJLT3dybXB3S1pyOVhhenljeVpiWWhhbHpuMG1vOUdNYVVmIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJmaWxhbWVudCI6eyJub3RpZmljYXRpb25zIjp7Im1haWxib3giOiJkZmIyNGMzNGY1MzBmY2NiNDJlMzgzMDZlZGE4N2RkZjA5NTBjZmVkYWZmYjJkZDVmY2QzMGUzMTEyYTU2NTU5In19LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2F1dGhcL2dvb2dsZSIsInJvdXRlIjoiZ29vZ2xlLnJlZGlyZWN0In0sInN0YXRlIjoiendYYlk5bFZEMlZQalNYVUJMdXMwUm12R2RuNG8zRGRMcUowYnlUVSJ9', 1792019732);

-- --------------------------------------------------------

--
-- Table structure for table `third_party_authentications`
--

CREATE TABLE `third_party_authentications` (
  `id_oauth` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `provider_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'google',
  `provider_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_url` text COLLATE utf8mb4_unicode_ci,
  `connected_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `third_party_authentications`
--

INSERT INTO `third_party_authentications` (`id_oauth`, `user_id`, `provider_name`, `provider_user_id`, `avatar_url`, `connected_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'google', '102176583713498941222', 'https://lh3.googleusercontent.com/a/ACg8ocKstTpA9eak3NUmFDahFatI2ZO0vCdlEaza9qfHd2EFyAm_UA=s96-c', '2026-10-14 10:00:45', '2026-10-14 10:00:45', '2026-10-14 10:00:45');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_sewa`
--

CREATE TABLE `transaksi_sewa` (
  `id_sewa` bigint UNSIGNED NOT NULL,
  `id_umkm` bigint UNSIGNED NOT NULL,
  `id_ruko` bigint UNSIGNED NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `status_pembayaran` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `umkm`
--

CREATE TABLE `umkm` (
  `id_umkm` bigint UNSIGNED NOT NULL,
  `nama_usaha` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_usaha` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemilik` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu_verifikasi',
  `avatar_url` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'investor',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `email_verified_at`, `phone_verified_at`, `status`, `avatar_url`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrator', 'admin@dayaumkm.id', NULL, '2026-10-14 09:50:45', NULL, 'aktif', NULL, '$2y$12$syQeBQnUOY6AFseL3xrSeemxiOFN2il7aWnTdaQbs5EBLkE8DjD9m', 'super_admin', NULL, '2026-10-14 09:50:45', '2026-10-14 09:50:45'),
(2, 'Ryan Alexander', 'ryanalexander2203@gmail.com', NULL, '2026-10-14 10:00:45', NULL, 'aktif', 'https://lh3.googleusercontent.com/a/ACg8ocKstTpA9eak3NUmFDahFatI2ZO0vCdlEaza9qfHd2EFyAm_UA=s96-c', NULL, 'investor', 'sMWRHVXggOtzP6Ko9hns9W6AtZsZXIdyjZJpP4jWUJVDhQoigjrpWxiXus5f', '2026-10-14 10:00:45', '2026-10-14 10:00:45'),
(3, 'Riszki Fadhillah', 'rarafadhillah22@gmail.com', '085864221437', '2026-10-14 15:49:42', NULL, 'aktif', NULL, '$2y$12$qlvUBVPALPmeCVHUw2Mhr.IHy.QGRO9xx0Tk2boPxijoZoQ8QG3Au', 'umkm', 'gAT7NrYyU9rp0OnrO4F7e8ZbaZGrNbllfnmPRcv2oQRXa1ET46DKdbk3Xzkp', '2026-10-14 10:02:23', '2026-10-14 15:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `verification_codes`
--

CREATE TABLE `verification_codes` (
  `id_verification` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `verification_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'otp_email',
  `secret_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_to` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT '0',
  `expires_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verification_codes`
--

INSERT INTO `verification_codes` (`id_verification`, `user_id`, `verification_type`, `secret_code`, `sent_to`, `is_used`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'otp_email', '522254', 'admin@dayaumkm.id', 0, '2026-10-14 10:00:21', '2026-10-14 09:55:21', '2026-10-14 09:55:21'),
(2, 3, 'otp_email', '664552', 'rarafadhillah22@gmail.com', 1, '2026-10-14 10:07:23', '2026-10-14 10:02:23', '2026-10-14 10:03:23'),
(3, 3, 'otp_email', '768650', 'rarafadhillah22@gmail.com', 1, '2026-10-14 10:08:23', '2026-10-14 10:03:23', '2026-10-14 10:09:57'),
(4, 3, 'otp_email', '550687', 'rarafadhillah22@gmail.com', 1, '2026-10-14 10:14:57', '2026-10-14 10:09:57', '2026-10-14 10:21:05'),
(5, 3, 'otp_email', '555459', 'rarafadhillah22@gmail.com', 1, '2026-10-14 10:26:05', '2026-10-14 10:21:05', '2026-10-14 10:28:29'),
(6, 3, 'otp_email', '601297', 'rarafadhillah22@gmail.com', 1, '2026-10-14 10:33:29', '2026-10-14 10:28:29', '2026-10-14 10:29:45'),
(7, 3, 'otp_email', '423495', 'rarafadhillah22@gmail.com', 1, '2026-10-14 10:34:45', '2026-10-14 10:29:45', '2026-10-14 10:34:26'),
(8, 3, 'otp_email', '637229', 'rarafadhillah22@gmail.com', 1, '2026-10-14 10:37:50', '2026-10-14 10:32:50', '2026-10-14 10:33:44'),
(9, 3, 'otp_email', '165830', 'rarafadhillah22@gmail.com', 1, '2026-10-14 10:39:26', '2026-10-14 10:34:26', '2026-10-14 10:35:44'),
(10, 3, 'otp_email', '530052', 'rarafadhillah22@gmail.com', 1, '2026-10-14 10:40:44', '2026-10-14 10:35:44', '2026-10-14 10:36:26'),
(11, 3, 'otp_email', '323005', 'rarafadhillah22@gmail.com', 1, '2026-10-14 10:41:27', '2026-10-14 10:36:27', '2026-10-14 10:37:49'),
(12, 3, 'otp_email', '978436', 'rarafadhillah22@gmail.com', 1, '2026-10-14 10:42:49', '2026-10-14 10:37:49', '2026-10-14 10:43:35'),
(13, 3, 'otp_email', '686093', 'rarafadhillah22@gmail.com', 1, '2026-10-14 10:48:35', '2026-10-14 10:43:35', '2026-10-14 10:45:21'),
(14, 3, 'otp_email', '985789', 'rarafadhillah22@gmail.com', 1, '2026-10-14 10:50:21', '2026-10-14 10:45:21', '2026-10-14 15:49:09'),
(15, 3, 'otp_email', '462301', 'rarafadhillah22@gmail.com', 1, '2026-10-14 15:54:09', '2026-10-14 15:49:09', '2026-10-14 15:49:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bagi_hasil_log`
--
ALTER TABLE `bagi_hasil_log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `bagi_hasil_log_id_investasi_index` (`id_investasi`),
  ADD KEY `bagi_hasil_log_tanggal_distribusi_index` (`tanggal_distribusi`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `investasi`
--
ALTER TABLE `investasi`
  ADD PRIMARY KEY (`id_investasi`),
  ADD KEY `investasi_id_pengguna_index` (`id_pengguna`),
  ADD KEY `investasi_id_umkm_index` (`id_umkm`),
  ADD KEY `investasi_status_index` (`status`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_aktivitas_admin`
--
ALTER TABLE `log_aktivitas_admin`
  ADD PRIMARY KEY (`id_log_admin`),
  ADD KEY `log_aktivitas_admin_id_pengguna_index` (`id_pengguna`),
  ADD KEY `log_aktivitas_admin_aksi_index` (`aksi`),
  ADD KEY `log_aktivitas_admin_created_at_index` (`created_at`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `penyedia_ruko`
--
ALTER TABLE `penyedia_ruko`
  ADD PRIMARY KEY (`id_penyedia`),
  ADD KEY `penyedia_ruko_nama_perusahaan_index` (`nama_perusahaan`);

--
-- Indexes for table `ruko`
--
ALTER TABLE `ruko`
  ADD PRIMARY KEY (`id_ruko`),
  ADD KEY `ruko_status_ketersediaan_index` (`status_ketersediaan`),
  ADD KEY `ruko_id_penyedia_index` (`id_penyedia`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `third_party_authentications`
--
ALTER TABLE `third_party_authentications`
  ADD PRIMARY KEY (`id_oauth`),
  ADD UNIQUE KEY `oauth_provider_uid_unique` (`provider_name`,`provider_user_id`),
  ADD KEY `third_party_authentications_user_id_foreign` (`user_id`);

--
-- Indexes for table `transaksi_sewa`
--
ALTER TABLE `transaksi_sewa`
  ADD PRIMARY KEY (`id_sewa`),
  ADD KEY `transaksi_sewa_id_umkm_index` (`id_umkm`),
  ADD KEY `transaksi_sewa_id_ruko_index` (`id_ruko`),
  ADD KEY `transaksi_sewa_status_pembayaran_index` (`status_pembayaran`),
  ADD KEY `transaksi_sewa_id_ruko_tanggal_mulai_tanggal_selesai_index` (`id_ruko`,`tanggal_mulai`,`tanggal_selesai`);

--
-- Indexes for table `umkm`
--
ALTER TABLE `umkm`
  ADD PRIMARY KEY (`id_umkm`),
  ADD KEY `umkm_jenis_usaha_index` (`jenis_usaha`),
  ADD KEY `umkm_nama_usaha_index` (`nama_usaha`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD PRIMARY KEY (`id_verification`),
  ADD KEY `verification_codes_user_id_foreign` (`user_id`),
  ADD KEY `verif_sent_type_idx` (`sent_to`,`verification_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bagi_hasil_log`
--
ALTER TABLE `bagi_hasil_log`
  MODIFY `id_log` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investasi`
--
ALTER TABLE `investasi`
  MODIFY `id_investasi` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_aktivitas_admin`
--
ALTER TABLE `log_aktivitas_admin`
  MODIFY `id_log_admin` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penyedia_ruko`
--
ALTER TABLE `penyedia_ruko`
  MODIFY `id_penyedia` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ruko`
--
ALTER TABLE `ruko`
  MODIFY `id_ruko` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `third_party_authentications`
--
ALTER TABLE `third_party_authentications`
  MODIFY `id_oauth` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi_sewa`
--
ALTER TABLE `transaksi_sewa`
  MODIFY `id_sewa` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `umkm`
--
ALTER TABLE `umkm`
  MODIFY `id_umkm` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id_verification` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bagi_hasil_log`
--
ALTER TABLE `bagi_hasil_log`
  ADD CONSTRAINT `bagi_hasil_log_id_investasi_foreign` FOREIGN KEY (`id_investasi`) REFERENCES `investasi` (`id_investasi`) ON DELETE CASCADE;

--
-- Constraints for table `investasi`
--
ALTER TABLE `investasi`
  ADD CONSTRAINT `investasi_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `investasi_id_umkm_foreign` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE RESTRICT;

--
-- Constraints for table `log_aktivitas_admin`
--
ALTER TABLE `log_aktivitas_admin`
  ADD CONSTRAINT `log_aktivitas_admin_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `ruko`
--
ALTER TABLE `ruko`
  ADD CONSTRAINT `ruko_id_penyedia_foreign` FOREIGN KEY (`id_penyedia`) REFERENCES `penyedia_ruko` (`id_penyedia`) ON DELETE RESTRICT;

--
-- Constraints for table `third_party_authentications`
--
ALTER TABLE `third_party_authentications`
  ADD CONSTRAINT `third_party_authentications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi_sewa`
--
ALTER TABLE `transaksi_sewa`
  ADD CONSTRAINT `transaksi_sewa_id_ruko_foreign` FOREIGN KEY (`id_ruko`) REFERENCES `ruko` (`id_ruko`) ON DELETE RESTRICT,
  ADD CONSTRAINT `transaksi_sewa_id_umkm_foreign` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE RESTRICT;

--
-- Constraints for table `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD CONSTRAINT `verification_codes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
