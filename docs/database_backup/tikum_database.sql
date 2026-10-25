-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 24, 2026 at 02:43 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umkm`
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
  `bukti_transfer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bagi_hasil_log`
--

INSERT INTO `bagi_hasil_log` (`id_log`, `id_investasi`, `tanggal_distribusi`, `nominal_diterima`, `bukti_transfer`, `created_at`, `updated_at`) VALUES
(1, 2, '2026-10-23 17:00:00', 100000.00, '/uploads/bukti_transfer/struk_1792844587_6adca32b68ff4.jpeg', '2026-10-24 05:23:07', '2026-10-24 05:23:07');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catatan_keuangan`
--

CREATE TABLE `catatan_keuangan` (
  `id_keuangan` bigint UNSIGNED NOT NULL,
  `id_umkm` bigint UNSIGNED NOT NULL,
  `bulan_tahun` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendapatan` decimal(15,2) NOT NULL DEFAULT '0.00',
  `hpp` decimal(15,2) NOT NULL DEFAULT '0.00',
  `beban_operasional` decimal(15,2) NOT NULL DEFAULT '0.00',
  `beban_lain` decimal(15,2) NOT NULL DEFAULT '0.00',
  `laba_bersih` decimal(15,2) NOT NULL DEFAULT '0.00',
  `margin_laba` decimal(6,2) NOT NULL DEFAULT '0.00',
  `status_laba` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'untung',
  `foto_bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catatan_keuangan`
--

INSERT INTO `catatan_keuangan` (`id_keuangan`, `id_umkm`, `bulan_tahun`, `pendapatan`, `hpp`, `beban_operasional`, `beban_lain`, `laba_bersih`, `margin_laba`, `status_laba`, `foto_bukti`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 5, 'October 2026', 30000000.00, 5000000.00, 10000000.00, 2000000.00, 13000000.00, 43.33, 'untung', NULL, NULL, '2026-10-15 05:06:12', '2026-10-15 05:06:12'),
(2, 5, 'October 2026', 999300.00, 0.00, 0.00, 0.00, 999300.00, 100.00, 'untung', 'keuangan/1u2IdtNfcjZSCRi0RLOfy9Dy2tpkiBMj63cKSZgw.xlsx', 'Foto Nota Penjualan (Terdeteksi Total Rp 335.000) | Nota Penjualan/Omzet (Screenshot 2026-10-15 200027.png) - Terdeteksi Total Rp 335.000 |  (Terdeteksi Otomatis dari Excel: Berhasil mendeteksi Pemasukan Rp 329.300 dan Pengeluaran Rp 0)', '2026-10-15 05:43:42', '2026-10-15 09:12:44');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `periode_pembagian` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `dibaca` tinyint(1) NOT NULL DEFAULT '0',
  `tanggal_investasi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investasi`
--

INSERT INTO `investasi` (`id_investasi`, `id_pengguna`, `id_umkm`, `jumlah_modal`, `persentase_bagi_hasil`, `periode_pembagian`, `status`, `catatan`, `dibaca`, `tanggal_investasi`, `created_at`, `updated_at`) VALUES
(1, 3, 5, 1000000.00, 15.00, 'Bulanan', 'pending', 'Saya sangat tertarik dengan proposal usaha Anda dan siap berdiskusi untuk menyalurkan modal pendanaan.', 1, '2026-10-15 04:35:03', '2026-10-15 04:35:03', '2026-10-15 04:35:43'),
(2, 3, 5, 1000000.00, 15.00, 'Bulanan', 'aktif', 'Saya sangat tertarik dengan proposal usaha Anda dan siap berdiskusi untuk menyalurkan modal pendanaan.', 1, '2026-10-15 09:20:05', '2026-10-15 09:20:05', '2026-10-18 07:54:47'),
(3, 3, 5, 1000000.00, 15.00, 'Bulanan', 'pending', 'Saya sangat tertarik dengan proposal usaha Anda dan siap berdiskusi untuk menyalurkan modal pendanaan.', 1, '2026-10-18 06:54:15', '2026-10-18 06:54:15', '2026-10-18 07:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `klarifikasi_dividen`
--

CREATE TABLE `klarifikasi_dividen` (
  `id_klarifikasi` bigint UNSIGNED NOT NULL,
  `id_investasi` bigint UNSIGNED NOT NULL,
  `id_umkm` bigint UNSIGNED NOT NULL,
  `bulan_periode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_kendala` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran_bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `komitmen_solusi` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu_tinjauan',
  `catatan_admin` text COLLATE utf8mb4_unicode_ci,
  `catatan_investor` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `klarifikasi_dividen`
--

INSERT INTO `klarifikasi_dividen` (`id_klarifikasi`, `id_investasi`, `id_umkm`, `bulan_periode`, `kategori_kendala`, `alasan`, `lampiran_bukti`, `komitmen_solusi`, `status`, `catatan_admin`, `catatan_investor`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 'Bulan Berjalan', 'omzet_menurun', 'kesusahan karna pemerintah hebat', '/uploads/klarifikasi_dividen/klarifikasi_1792847224_6adcad785191e.png', 'ini sedang diusahakan', 'diverifikasi_admin', 'Laporan kendala telah diverifikasi dan disetujui. Diberikan toleransi penyesuaian jadwal dividen hingga akhir bulan berikutnya dengan komitmen pemulihan omzet.', NULL, '2026-10-24 06:07:04', '2026-10-24 06:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas_admin`
--

CREATE TABLE `log_aktivitas_admin` (
  `id_log_admin` bigint UNSIGNED NOT NULL,
  `id_pengguna` bigint UNSIGNED NOT NULL,
  `aksi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_perubahan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_aktivitas_admin`
--

INSERT INTO `log_aktivitas_admin` (`id_log_admin`, `id_pengguna`, `aksi`, `detail_perubahan`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 2, 'Persetujuan Proposal UMKM', '{\"id_umkm\":5,\"nama_usaha\":\"Usaha ahmad\",\"pemilik\":\"ahmad\",\"status_sebelumnya\":\"menunggu_verifikasi\",\"status_baru\":\"terverifikasi\",\"catatan\":\"Proposal disetujui & tayang di katalog investor.\"}', '127.0.0.1', '2026-10-15 04:12:56', '2026-10-15 04:12:56'),
(2, 2, 'Ubah Status Akun: ditangguhkan', '{\"target_id\":4,\"target_email\":\"thezidans25@gmail.com\",\"status_lama\":\"aktif\",\"status_baru\":\"ditangguhkan\"}', '127.0.0.1', '2026-10-15 04:18:46', '2026-10-15 04:18:46'),
(3, 2, 'Persetujuan (ACC) Akun Investor', '{\"target_id\":7,\"target_name\":\"Baim\",\"target_email\":\"Baim@gmail.com\",\"role\":\"investor\",\"status_lama\":\"menunggu_verifikasi\",\"status_baru\":\"aktif\"}', '127.0.0.1', '2026-10-15 09:27:27', '2026-10-15 09:27:27'),
(4, 2, 'ACC & Terbitkan Ruko Baru', '{\"id_rekomendasi\":1,\"id_ruko_terbit\":5,\"nama_ruko\":\"ruko pulgeb\",\"lokasi\":\"jl pulgeb\",\"pengusul\":\"Publik \\/ Pemilik: \\u865a\\u7121 Thezidan\",\"harga_sewa\":\"5000000.00\"}', '127.0.0.1', '2026-10-18 22:31:30', '2026-10-18 22:31:30'),
(5, 2, 'ACC & Terbitkan Ruko Baru', '{\"id_rekomendasi\":2,\"id_ruko_terbit\":6,\"nama_ruko\":\"Ruko cakung\",\"lokasi\":\"jl cakung\",\"pengusul\":\"Pelaku UMKM: ahmad\",\"harga_sewa\":\"3500000.00\"}', '127.0.0.1', '2026-10-18 22:33:17', '2026-10-18 22:33:17'),
(6, 2, 'Update Ketersediaan Unit Ruko', '{\"id_ruko\":3,\"nama_ruko\":\"Ruko Tebet Promenade C5\",\"total_unit\":3,\"unit_terisi\":3,\"sisa_unit\":0,\"status\":\"tersewa\"}', '127.0.0.1', '2026-10-18 22:51:58', '2026-10-18 22:51:58'),
(7, 2, 'ACC & Terbitkan Ruko Baru', '{\"id_rekomendasi\":3,\"id_ruko_terbit\":7,\"nama_ruko\":\"ruko bekasi\",\"lokasi\":\"jl bekasi\",\"pengusul\":\"Mitra Investor: zidan\",\"harga_sewa\":\"1000000.00\"}', '127.0.0.1', '2026-10-24 03:55:06', '2026-10-24 03:55:06'),
(8, 2, 'Persetujuan Proposal UMKM', '{\"id_umkm\":6,\"nama_usaha\":\"Usaha agam\",\"pemilik\":\"agam\",\"status_sebelumnya\":\"menunggu_verifikasi\",\"status_baru\":\"terverifikasi\",\"catatan\":\"Proposal disetujui & tayang di katalog investor.\"}', '127.0.0.1', '2026-10-24 05:05:32', '2026-10-24 05:05:32'),
(9, 2, 'Menerbitkan SP-1 Dividen UMKM', '{\"id_investasi\":2,\"umkm\":\"Usaha ahmad\",\"tingkat_sp\":\"SP-1\",\"tenggat\":\"2026-10-27\"}', '127.0.0.1', '2026-10-24 05:55:50', '2026-10-24 05:55:50'),
(10, 2, 'Verifikasi Klarifikasi Dividen', '{\"id_klarifikasi\":1,\"status\":\"diverifikasi_admin\",\"catatan\":\"Laporan kendala telah diverifikasi dan disetujui. Diberikan toleransi penyesuaian jadwal dividen hingga akhir bulan berikutnya dengan komitmen pemulihan omzet.\"}', '127.0.0.1', '2026-10-24 06:07:29', '2026-10-24 06:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
(11, '2026_10_15_000007_create_log_aktivitas_admin_table', 3),
(12, '2026_10_15_000008_add_fields_to_users_and_umkm_tables', 4),
(13, '2026_10_15_000009_add_submission_fields_to_umkm_table', 4),
(14, '2026_10_15_111947_create_produk_table_and_update_investasi', 4),
(15, '2026_10_15_114754_create_catatan_keuangan_table', 4),
(16, '2026_10_18_204500_add_bank_account_to_users_table', 5),
(17, '2026_10_18_205000_create_rekomendasi_ruko_table', 6),
(18, '2026_10_18_205100_add_investor_id_to_transaksi_sewa_table', 6),
(19, '2026_10_18_215000_create_pesan_investasi_table', 7),
(20, '2026_10_18_222000_update_rekomendasi_ruko_for_public_submissions', 8),
(21, '2026_10_19_124000_add_unit_capacity_to_ruko_tables', 9),
(22, '2026_10_19_130000_create_ulasan_umkm_table', 10),
(23, '2026_10_24_200000_create_kepatuhan_dan_klarifikasi_dividen_tables', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyedia_ruko`
--

CREATE TABLE `penyedia_ruko` (
  `id_penyedia` bigint UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyedia_ruko`
--

INSERT INTO `penyedia_ruko` (`id_penyedia`, `nama_perusahaan`, `kontak`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'PT Sarana Properti Komersial Nusantara', '081299887766', 'Jl. Boulevard Raya No. 45, Jakarta', '2026-10-15 03:04:34', '2026-10-15 03:04:34'),
(2, 'Mitra Komunitas / Warga', '08137898792', 'jl pulgeb', '2026-10-18 22:31:29', '2026-10-18 22:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `pesan_investasi`
--

CREATE TABLE `pesan_investasi` (
  `id_pesan` bigint UNSIGNED NOT NULL,
  `id_investasi` bigint UNSIGNED NOT NULL,
  `id_pengirim` bigint UNSIGNED NOT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dibaca` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesan_investasi`
--

INSERT INTO `pesan_investasi` (`id_pesan`, `id_investasi`, `id_pengirim`, `pesan`, `lampiran`, `dibaca`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 'Saya sangat tertarik dengan proposal usaha Anda dan siap berdiskusi untuk menyalurkan modal pendanaan.', NULL, 0, '2026-10-18 07:54:05', '2026-10-18 07:54:05'),
(2, 2, 3, 'Saya sangat tertarik dengan proposal usaha Anda dan siap berdiskusi untuk menyalurkan modal pendanaan.', NULL, 0, '2026-10-18 07:54:19', '2026-10-18 07:54:19'),
(3, 1, 3, 'Saya sangat tertarik dengan proposal usaha Anda dan siap berdiskusi untuk menyalurkan modal pendanaan.', NULL, 0, '2026-10-18 07:55:01', '2026-10-18 07:55:01'),
(4, 2, 5, 'tes halo', NULL, 1, '2026-10-18 07:55:07', '2026-10-18 08:07:54'),
(5, 2, 3, 'Halo, bagaimana perkembangan penjualan dan stok usaha minggu ini?', NULL, 0, '2026-10-18 08:08:19', '2026-10-18 08:08:19'),
(6, 2, 2, '⚠️ [SURAT PERINGATAN RESMI TIM COMPLIANCE DAYA UMKM - SP-1]\n\nKepada Yth. Mitra Usaha ahmad,\n\nBerdasarkan rekapitulasi data sistem, bagi hasil dividen kemitraan periode berjalan belum tercatat disetorkan dan telah melewati masa tenggang. Mohon segera melakukan penyetoran dividen atau menyampaikan klarifikasi kendala usaha secara resmi melalui dashboard Anda selambat-lambatnya sebelum tenggat waktu yang ditentukan.\n\nTenggat batas penyelesaian: 27 October 2026.\nMohon segera lakukan penyetoran bagi hasil dividen atau ajukan klarifikasi resmi melalui menu dashboard kemitraan Anda.', NULL, 1, '2026-10-24 05:55:50', '2026-10-24 06:26:48'),
(7, 2, 5, '📢 [Pemberitahuan Resmi Penundaan Bagi Hasil - Bulan Berjalan]\nHalo zidan, kami mengajukan klarifikasi resmi penundaan bagi hasil dividen untuk periode Bulan Berjalan dikarenakan kendala: Penjualan / Omzet Menurun.\n\nDetail Kendala: kesusahan karna pemerintah hebat\n\nKomitmen & Rencana Pemulihan: ini sedang diusahakan\n\nStatus penundaan ini tercatat transparan di platform DAYA-UMKM untuk ditinjau bersama.', NULL, 1, '2026-10-24 06:07:04', '2026-10-24 06:26:48'),
(8, 2, 2, 'ℹ️ [UPDATE STATUS KLARIFIKASI DIVIDEN OLEH ADMIN]\n\nLaporan kendala usaha untuk periode Bulan Berjalan telah DISETUJUI & DIVERIFIKASI oleh Compliance Admin.\nCatatan Admin: Laporan kendala telah diverifikasi dan disetujui. Diberikan toleransi penyesuaian jadwal dividen hingga akhir bulan berikutnya dengan komitmen pemulihan omzet.', NULL, 1, '2026-10-24 06:07:29', '2026-10-24 06:26:48');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` bigint UNSIGNED NOT NULL,
  `id_umkm` bigint UNSIGNED NOT NULL,
  `nama_produk` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` decimal(15,2) NOT NULL DEFAULT '0.00',
  `stok` int NOT NULL DEFAULT '10',
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `terjual` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasi_ruko`
--

CREATE TABLE `rekomendasi_ruko` (
  `id_rekomendasi` bigint UNSIGNED NOT NULL,
  `id_pengguna` bigint UNSIGNED DEFAULT NULL,
  `nama_pengusul` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak_pengusul` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe_pengusul` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'investor',
  `nama_ruko` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_ruko` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_sewa_per_bulan` decimal(12,2) NOT NULL,
  `total_unit` int UNSIGNED NOT NULL DEFAULT '1',
  `potensi_usaha` text COLLATE utf8mb4_unicode_ci,
  `kontak_pemilik` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siap_danai` tinyint(1) NOT NULL DEFAULT '1',
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu_verifikasi',
  `catatan_admin` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekomendasi_ruko`
--

INSERT INTO `rekomendasi_ruko` (`id_rekomendasi`, `id_pengguna`, `nama_pengusul`, `kontak_pengusul`, `tipe_pengusul`, `nama_ruko`, `lokasi`, `foto_ruko`, `harga_sewa_per_bulan`, `total_unit`, `potensi_usaha`, `kontak_pemilik`, `siap_danai`, `status`, `catatan_admin`, `created_at`, `updated_at`) VALUES
(1, NULL, '虚無 Thezidan', '081335678992', 'publik', 'ruko pulgeb', 'jl pulgeb', '/uploads/ruko/ruko_public_1792387235_6ad5a8a313577.jpeg', 5000000.00, 1, 'tempatnya yang sangat strategis', '08137898792', 0, 'disetujui', 'Usulan ruko disetujui (ACC) oleh Admin dan telah resmi diterbitkan ke Katalog Ruko.', '2026-10-18 22:20:35', '2026-10-18 22:31:30'),
(2, 5, 'ahmad', '081386144893', 'umkm', 'Ruko cakung', 'jl cakung', '/uploads/ruko/ruko_1792387979_6ad5ab8b7763f.jpeg', 3500000.00, 1, 'saya mengusulkan ruko ini', '081386144893', 0, 'disetujui', 'Usulan ruko disetujui (ACC) oleh Admin dan telah resmi diterbitkan ke Katalog Ruko.', '2026-10-18 22:32:59', '2026-10-18 22:33:17'),
(3, 3, 'zidan', '08138614493', 'investor', 'ruko bekasi', 'jl bekasi', '/uploads/ruko/ruko_1792839287_6adc8e7720bd5.jpg', 1000000.00, 3, 'cocok untuk usaha', '08137898792', 1, 'disetujui', 'Usulan ruko disetujui (ACC) oleh Admin dan telah resmi diterbitkan ke Katalog Ruko.', '2026-10-24 03:54:47', '2026-10-24 03:55:06');

-- --------------------------------------------------------

--
-- Table structure for table `ruko`
--

CREATE TABLE `ruko` (
  `id_ruko` bigint UNSIGNED NOT NULL,
  `id_penyedia` bigint UNSIGNED NOT NULL,
  `nama_ruko` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_ruko` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_potensi` text COLLATE utf8mb4_unicode_ci,
  `kontak_pemilik` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_sewa_per_bulan` decimal(12,2) NOT NULL,
  `total_unit` int UNSIGNED NOT NULL DEFAULT '1',
  `unit_terisi` int UNSIGNED NOT NULL DEFAULT '0',
  `status_ketersediaan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ruko`
--

INSERT INTO `ruko` (`id_ruko`, `id_penyedia`, `nama_ruko`, `lokasi`, `foto_ruko`, `deskripsi_potensi`, `kontak_pemilik`, `harga_sewa_per_bulan`, `total_unit`, `unit_terisi`, `status_ketersediaan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ruko Pasar Rebo Hub A1', 'Jl. Raya Bogor No. 12, Pasar Rebo, Jakarta Timur', NULL, NULL, NULL, 3500000.00, 1, 0, 'tersedia', '2026-10-15 03:04:34', '2026-10-15 03:04:34'),
(2, 1, 'Ruko Cijantung Square B3', 'Jl. Pendidikan No. 8, Cijantung, Jakarta Timur', NULL, NULL, NULL, 4200000.00, 1, 0, 'tersedia', '2026-10-15 03:04:34', '2026-10-15 03:04:34'),
(3, 1, 'Ruko Tebet Promenade C5', 'Jl. Tebet Barat Dalam No. 20, Tebet, Jakarta Selatan', NULL, NULL, NULL, 5500000.00, 3, 3, 'tersewa', '2026-10-15 03:04:34', '2026-10-18 22:51:58'),
(4, 1, 'Ruko Margonda Point D2', 'Jl. Margonda Raya No. 110, Beji, Depok', NULL, NULL, NULL, 3800000.00, 2, 2, 'tersewa', '2026-10-15 03:04:34', '2026-10-18 22:49:54'),
(5, 2, 'ruko pulgeb', 'jl pulgeb', '/uploads/ruko/ruko_public_1792387235_6ad5a8a313577.jpeg', 'tempatnya yang sangat strategis', '08137898792', 5000000.00, 1, 0, 'tersedia', '2026-10-18 22:31:30', '2026-10-18 22:31:30'),
(6, 2, 'Ruko cakung', 'jl cakung', '/uploads/ruko/ruko_1792387979_6ad5ab8b7763f.jpeg', 'saya mengusulkan ruko ini', '081386144893', 3500000.00, 3, 1, 'tersedia', '2026-10-18 22:33:17', '2026-10-24 03:55:43'),
(7, 2, 'ruko bekasi', 'jl bekasi', '/uploads/ruko/ruko_1792839287_6adc8e7720bd5.jpg', 'cocok untuk usaha', '08137898792', 1000000.00, 3, 1, 'tersedia', '2026-10-24 03:55:06', '2026-10-24 03:56:11');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('C0QmUaO5vOU61eRzFAY9d2MkxAtSDA1DmvGp3STo', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJONzR0dlRYU2drR2RCeXFUVGVvVWxBeUI2Z1hZbG1Fcnhnbmd2MG1aIiwiZmlsYW1lbnQiOnsibm90aWZpY2F0aW9ucyI6eyJtYWlsYm94IjoiT3R4RWJOZEZidVZNMGVaTHlDMGtXcWN5dmp6RmRlWnpiV0JDTjg1RyJ9fSwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQ/dGFiPWthbGt1bGF0b3IiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjozLCJwYXNzd29yZF9oYXNoX3dlYiI6Ijc2ZWE2OWU1OGMyNWMxZjhhZDA5MThlZjA2NGM1Y2M1ZGJkNzhlZDJlOWZmMWQxZWE5MzI5YzU4MDU5YzkwYTIifQ==', 1792851804),
('e56Zu3XFKnK1VAGbG59Bhp36P8DyxzTTlqYhVWd9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI0ZlhIVVBwQXhyWkM0ZTlpaWNtYTh5OWZkYUVSekgxbHpYdG9wQ3hiIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJmaWxhbWVudCI6eyJub3RpZmljYXRpb25zIjp7Im1haWxib3giOiIxNGU4YzEzMzE2ZTNiMDAyNjU3ZDA4NTYzODg2MzdhNzNhYjM2OTMwODI5YmIyZmY1YmY2ZTJmMGM2NzhiMzIyIn19LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9LCJ1cmwiOnsiaW50ZW5kZWQiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvZGFzaGJvYXJkP3RhYj1iZXJhbmRhIn19', 1792848674),
('RO5u9tyBJLIhehHDgNExfmqDraMwneFvO7RcsZq8', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJzUUxZRG1tMDJhdXJDajEyUTZhUzB4OWt6dTFUSW9uRVVEbkY1TGZCIiwiZmlsYW1lbnQiOnsibm90aWZpY2F0aW9ucyI6eyJtYWlsYm94IjoiUTBXSmp4dkFoYVBDdHFuR2owWUVUNWxWQkJIdkVTQ2p1eEZiY29IRCJ9fSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjIsInBhc3N3b3JkX2hhc2hfd2ViIjoiY2U2ZWQ0MTY0NWY5ZWQ3NDM1NjUxZjM0Y2Y5YjA3NWRmODYzYmMwNWUyNTExZDE0MTRlOWQ1OWNhZjQ3ZTU3ZSJ9', 1792851999);

-- --------------------------------------------------------

--
-- Table structure for table `teguran_dividen_log`
--

CREATE TABLE `teguran_dividen_log` (
  `id_teguran` bigint UNSIGNED NOT NULL,
  `id_investasi` bigint UNSIGNED NOT NULL,
  `id_umkm` bigint UNSIGNED NOT NULL,
  `tingkat_sp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan_teguran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dikirim_oleh` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teguran_dividen_log`
--

INSERT INTO `teguran_dividen_log` (`id_teguran`, `id_investasi`, `id_umkm`, `tingkat_sp`, `pesan_teguran`, `dikirim_oleh`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 'SP-1', 'Berdasarkan rekapitulasi data sistem, bagi hasil dividen kemitraan periode berjalan belum tercatat disetorkan dan telah melewati masa tenggang. Mohon segera melakukan penyetoran dividen atau menyampaikan klarifikasi kendala usaha secara resmi melalui dashboard Anda selambat-lambatnya sebelum tenggat waktu yang ditentukan.', 2, '2026-10-24 05:55:50', '2026-10-24 05:55:50');

-- --------------------------------------------------------

--
-- Table structure for table `third_party_authentications`
--

CREATE TABLE `third_party_authentications` (
  `id_oauth` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `provider_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'google',
  `provider_user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `id_investor` bigint UNSIGNED DEFAULT NULL,
  `id_ruko` bigint UNSIGNED NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `status_pembayaran` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `catatan_sponsor` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_sewa`
--

INSERT INTO `transaksi_sewa` (`id_sewa`, `id_umkm`, `id_investor`, `id_ruko`, `tanggal_mulai`, `tanggal_selesai`, `total_harga`, `status_pembayaran`, `catatan_sponsor`, `created_at`, `updated_at`) VALUES
(1, 5, 3, 4, '2026-10-18', '2027-04-18', 22800000.00, 'menunggu_konfirmasi', 'Sponsor dana sewa ruko komersial dari mitra investor.', '2026-10-18 06:54:40', '2026-10-18 06:54:40'),
(2, 5, 3, 4, '2026-10-18', '2027-04-18', 22800000.00, 'menunggu_konfirmasi', 'Sponsor dana sewa ruko komersial dari mitra investor.', '2026-10-18 06:55:16', '2026-10-18 06:55:16'),
(3, 5, 3, 6, '2026-10-24', '2027-01-24', 10500000.00, 'menunggu_konfirmasi', 'Sponsor dana sewa ruko komersial dari mitra investor.', '2026-10-24 03:55:43', '2026-10-24 03:55:43'),
(4, 5, 3, 7, '2026-10-24', '2027-01-24', 3000000.00, 'menunggu_konfirmasi', 'Sponsor dana sewa ruko komersial dari mitra investor.', '2026-10-24 03:56:11', '2026-10-24 03:56:11');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan_umkm`
--

CREATE TABLE `ulasan_umkm` (
  `id_ulasan` bigint UNSIGNED NOT NULL,
  `id_umkm` bigint UNSIGNED NOT NULL,
  `id_investor` bigint UNSIGNED NOT NULL,
  `id_investasi` bigint UNSIGNED NOT NULL,
  `rating` tinyint UNSIGNED NOT NULL DEFAULT '5',
  `rating_transparansi` tinyint UNSIGNED NOT NULL DEFAULT '5',
  `rating_dividen` tinyint UNSIGNED NOT NULL DEFAULT '5',
  `ulasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `balasan_umkm` text COLLATE utf8mb4_unicode_ci,
  `tanggal_balasan` timestamp NULL DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tayang',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ulasan_umkm`
--

INSERT INTO `ulasan_umkm` (`id_ulasan`, `id_umkm`, `id_investor`, `id_investasi`, `rating`, `rating_transparansi`, `rating_dividen`, `ulasan`, `balasan_umkm`, `tanggal_balasan`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 3, 2, 5, 5, 5, 'Alhamdulillah kerja sama dengan mitra Usaha ahmad sangat transparan, laporan omzet rutin setiap awal bulan dan bagi hasil tepat waktu!', 'Terima kasih banyak atas kepercayaannya pak investor, kami akan terus menjaga amanah modal kerja ini.', '2026-10-18 23:10:06', 'tayang', '2026-10-18 23:09:35', '2026-10-18 23:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `umkm`
--

CREATE TABLE `umkm` (
  `id_umkm` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `nama_usaha` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_usaha` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemilik` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_penanggung_jawab` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_whatsapp` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi_kota` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `foto_produk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_proposal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_ruko_diminati` bigint UNSIGNED DEFAULT NULL,
  `status_pengajuan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draf',
  `status_kepatuhan_dividen` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'lancar',
  `jumlah_teguran_sp` int UNSIGNED NOT NULL DEFAULT '0',
  `teguran_sp_terakhir` timestamp NULL DEFAULT NULL,
  `catatan_pembekuan` text COLLATE utf8mb4_unicode_ci,
  `modal_dibutuhkan` decimal(15,2) DEFAULT NULL,
  `estimasi_bagi_hasil` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `umkm`
--

INSERT INTO `umkm` (`id_umkm`, `user_id`, `nama_usaha`, `jenis_usaha`, `pemilik`, `nik_penanggung_jawab`, `nomor_whatsapp`, `provinsi_kota`, `kecamatan`, `kelurahan`, `deskripsi`, `foto_produk`, `file_proposal`, `id_ruko_diminati`, `status_pengajuan`, `status_kepatuhan_dividen`, `jumlah_teguran_sp`, `teguran_sp_terakhir`, `catatan_pembekuan`, `modal_dibutuhkan`, `estimasi_bagi_hasil`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Kopi Selaras Nusantara', 'Makanan', 'Rian Hidayat', NULL, NULL, NULL, NULL, NULL, 'Kedai kopi kekinian menyajikan racikan biji kopi arabika lokal dan camilan tradisional.', NULL, NULL, NULL, 'draf', 'lancar', 0, NULL, NULL, NULL, NULL, '2026-10-15 03:04:34', '2026-10-15 03:04:34'),
(2, NULL, 'Klinik Sepatu & Laundry CleanPro', 'Jasa', 'Siti Nurhaliza', NULL, NULL, NULL, NULL, NULL, 'Jasa deep cleaning sepatu premium dan laundry ekspres higienis berstandar tinggi.', NULL, NULL, NULL, 'draf', 'lancar', 0, NULL, NULL, NULL, NULL, '2026-10-15 03:04:34', '2026-10-15 03:04:34'),
(3, NULL, 'Batik Tenun Cantik Mandiri', 'Fashion', 'Dewi Sartika', NULL, NULL, NULL, NULL, NULL, 'Produksi busana batik modern dan tenun lurik lokal dengan pasar nasional.', NULL, NULL, NULL, 'draf', 'lancar', 0, NULL, NULL, NULL, NULL, '2026-10-15 03:04:34', '2026-10-15 03:04:34'),
(4, NULL, 'Sayur Organik Hidroponik Makmur', 'Agribisnis', 'Ahmad Fauzi', NULL, NULL, NULL, NULL, NULL, 'Budidaya sayuran hidroponik segar tanpa pestisida untuk suplai pasar ritel modern.', NULL, NULL, NULL, 'draf', 'lancar', 0, NULL, NULL, NULL, NULL, '2026-10-15 03:04:34', '2026-10-15 03:04:34'),
(5, 5, 'Usaha ahmad', 'Fashion', 'ahmad', '12274848498749874984', '081386144893', 'jakarta', 'CAKUNG', 'PULO GEBANG', 'keren dh', 'umkm/produk/93qmVOI026uiBZUwjI6iQKoh1D3rybjwwPIEWt4p.png', 'umkm/proposal/ZMYILzDoLAfW2WvdzXfgQKygwygc04R1SnURTUsV.docx', 4, 'terverifikasi', 'lancar', 1, '2026-10-24 05:55:50', NULL, 1000000.00, '5% per bulan', '2026-10-15 03:48:44', '2026-10-24 05:55:50'),
(6, 8, 'Usaha agam', 'Kerajinan', 'agam', '12274848498749874984', '08138614403', 'Jakarta', 'CAKUNG', 'PULO GEBANG', NULL, 'umkm/produk/d2060nCoFLAuQd37lxZfA6HSX2eJm8VM3J24eHbd.jpg', 'umkm/proposal/tjatEXJLdcxiAYI1t6Y8ymYBFwGocD33uZEapw3u.docx', NULL, 'terverifikasi', 'lancar', 0, NULL, NULL, 30000000.00, '10% per bulan', '2026-10-24 04:01:54', '2026-10-24 05:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi_kota` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu_verifikasi',
  `avatar_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'investor',
  `kategori_diminati` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_rekening` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pemilik_rekening` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `provinsi_kota`, `kecamatan`, `kelurahan`, `email_verified_at`, `phone_verified_at`, `status`, `avatar_url`, `password`, `role`, `kategori_diminati`, `bank_name`, `nomor_rekening`, `nama_pemilik_rekening`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', NULL, NULL, NULL, NULL, '2026-10-14 20:25:44', NULL, 'menunggu_verifikasi', NULL, '$2y$12$P6C4sN1n4ntX2s/DsZuu/Oo/mYzMzlfmoMvJW1OrDaagyTcQJ18Ea', 'investor', NULL, NULL, NULL, NULL, 'tgxBcHknjJ', '2026-10-14 20:25:44', '2026-10-14 20:25:44'),
(2, 'Super Administrator', 'admin@dayaumkm.id', NULL, NULL, NULL, NULL, '2026-10-15 05:04:16', NULL, 'aktif', NULL, '$2y$12$9nqJieaA0y/YmEYtg8iYfuxMSYk6qaK/GpUTb9I1vgYDu2IAFzJNy', 'super_admin', NULL, NULL, NULL, NULL, 'MOkePQfaBHwB0eUbrecyRwKbKdxgczghiJSVx3ljboaEJmEUE80SxYzcEoYJ', '2026-10-14 20:30:29', '2026-10-15 05:04:16'),
(3, 'zidan', 'thezidan162@gmail.com', '08138614493', 'jakarta', 'cakung', '-', '2026-10-14 20:37:45', NULL, 'aktif', NULL, '$2y$12$r1ymhBkukAeuHrD/eb5u7OaJRjaDWZ0N6K2ySHNnz2GlxH736cFs.', 'investor', 'Semua', 'BCA', '1234689767989', 'zidan', NULL, '2026-10-14 20:35:44', '2026-10-18 07:26:30'),
(4, 'zidan', 'thezidans25@gmail.com', '081386144893', NULL, NULL, NULL, '2026-10-15 03:41:11', NULL, 'ditangguhkan', NULL, '$2y$12$SqZsmjtkbI4DCPTIuTzFE.XdUYDbL03wKc9sjVAs/8hrEp.BCqf3.', 'investor', NULL, NULL, NULL, NULL, NULL, '2026-10-15 03:40:07', '2026-10-15 04:18:46'),
(5, 'ahmad', 'thedanz@gmail.com', '081386144893', 'jakarta', 'CAKUNG', 'PULO GEBANG', '2026-10-15 03:49:54', NULL, 'aktif', NULL, '$2y$12$R7bnZ7wVty/hPlG1UgYE2.KzL3QbY6iao6z6w3vipkJMKQU1j.1UW', 'umkm', NULL, NULL, NULL, NULL, NULL, '2026-10-15 03:48:44', '2026-10-15 03:51:04'),
(6, 'Staf Admin Operasional', 'staf.admin@dayaumkm.id', '081234567891', NULL, NULL, NULL, '2026-10-15 05:04:16', NULL, 'aktif', NULL, '$2y$12$uw0Zg27hrYlC2KmP4SGR9esXrR2GXv/KF9s0VV5KHZt/GvvoP9r.i', 'admin', NULL, NULL, NULL, NULL, NULL, '2026-10-15 05:04:16', '2026-10-15 05:04:16'),
(7, 'Baim', 'Baim@gmail.com', '08138614403', 'jakarta', 'CAKUNG', 'PULO GEBANG', '2026-10-15 09:26:17', NULL, 'aktif', NULL, '$2y$12$UyV821eOQNwQ98OvMR2vTOdHK3nLtUxmJDiui7Dr2XcBi.AzKjaQy', 'investor', 'Semua', NULL, NULL, NULL, NULL, '2026-10-15 09:22:53', '2026-10-15 09:27:27'),
(8, 'agam', 'agam@gmail.com', '08138614403', 'Jakarta', 'CAKUNG', 'PULO GEBANG', '2026-10-24 04:02:59', NULL, 'aktif', NULL, '$2y$12$K7oUstuTBEPIiXY.LrsSMOkaip/fVNK0hRshDFUv/JmYsThRuAzNq', 'umkm', NULL, NULL, NULL, NULL, NULL, '2026-10-24 04:01:54', '2026-10-24 04:10:29'),
(9, 'Super Admin TIKUM', 'admin@tikum.id', '081234567890', 'Jakarta', 'Kudus', 'Kudus', '2026-10-25 00:00:00', NULL, 'aktif', NULL, '$2y$12$9nqJieaA0y/YmEYtg8iYfuxMSYk6qaK/GpUTb9I1vgYDu2IAFzJNy', 'super_admin', NULL, NULL, NULL, NULL, NULL, '2026-10-25 00:00:00', '2026-10-25 00:00:00'),
(10, 'Mitra Investor Demo', 'investor@tikum.id', '081298765432', 'Jakarta', 'Kudus', 'Kudus', '2026-10-25 00:00:00', NULL, 'aktif', NULL, '$2y$12$9nqJieaA0y/YmEYtg8iYfuxMSYk6qaK/GpUTb9I1vgYDu2IAFzJNy', 'investor', 'Semua', 'BCA', '1234567890', 'Mitra Investor', NULL, '2026-10-25 00:00:00', '2026-10-25 00:00:00'),
(11, 'Pelaku UMKM Demo', 'umkm@tikum.id', '081234567899', 'Jakarta', 'Kudus', 'Kudus', '2026-10-25 00:00:00', NULL, 'aktif', NULL, '$2y$12$9nqJieaA0y/YmEYtg8iYfuxMSYk6qaK/GpUTb9I1vgYDu2IAFzJNy', 'umkm', 'Makanan', NULL, NULL, NULL, NULL, '2026-10-25 00:00:00', '2026-10-25 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `verification_codes`
--

CREATE TABLE `verification_codes` (
  `id_verification` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `verification_type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'otp_email',
  `secret_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_to` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
(15, 3, 'otp_email', '462301', 'rarafadhillah22@gmail.com', 1, '2026-10-14 15:54:09', '2026-10-14 15:49:09', '2026-10-14 15:49:42'),
(16, 7, 'otp_email', '626774', 'Baim@gmail.com', 1, '2026-10-15 09:27:53', '2026-10-15 09:22:53', '2026-10-15 09:26:17'),
(17, 8, 'otp_email', '400572', 'agam@gmail.com', 1, '2026-10-24 04:06:54', '2026-10-24 04:01:54', '2026-10-24 04:02:59');

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
-- Indexes for table `catatan_keuangan`
--
ALTER TABLE `catatan_keuangan`
  ADD PRIMARY KEY (`id_keuangan`),
  ADD KEY `catatan_keuangan_id_umkm_index` (`id_umkm`);

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
-- Indexes for table `klarifikasi_dividen`
--
ALTER TABLE `klarifikasi_dividen`
  ADD PRIMARY KEY (`id_klarifikasi`),
  ADD KEY `klarifikasi_dividen_id_umkm_foreign` (`id_umkm`),
  ADD KEY `klarifikasi_dividen_id_investasi_bulan_periode_index` (`id_investasi`,`bulan_periode`);

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
-- Indexes for table `pesan_investasi`
--
ALTER TABLE `pesan_investasi`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `pesan_investasi_id_investasi_index` (`id_investasi`),
  ADD KEY `pesan_investasi_id_pengirim_index` (`id_pengirim`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `produk_id_umkm_index` (`id_umkm`);

--
-- Indexes for table `rekomendasi_ruko`
--
ALTER TABLE `rekomendasi_ruko`
  ADD PRIMARY KEY (`id_rekomendasi`),
  ADD KEY `rekomendasi_ruko_id_pengguna_index` (`id_pengguna`),
  ADD KEY `rekomendasi_ruko_status_index` (`status`);

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
-- Indexes for table `teguran_dividen_log`
--
ALTER TABLE `teguran_dividen_log`
  ADD PRIMARY KEY (`id_teguran`),
  ADD KEY `teguran_dividen_log_id_investasi_foreign` (`id_investasi`),
  ADD KEY `teguran_dividen_log_id_umkm_foreign` (`id_umkm`);

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
  ADD KEY `transaksi_sewa_id_ruko_tanggal_mulai_tanggal_selesai_index` (`id_ruko`,`tanggal_mulai`,`tanggal_selesai`),
  ADD KEY `transaksi_sewa_id_investor_index` (`id_investor`);

--
-- Indexes for table `ulasan_umkm`
--
ALTER TABLE `ulasan_umkm`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD UNIQUE KEY `ulasan_umkm_id_investasi_unique` (`id_investasi`),
  ADD KEY `ulasan_umkm_id_investor_foreign` (`id_investor`),
  ADD KEY `ulasan_umkm_id_umkm_status_index` (`id_umkm`,`status`);

--
-- Indexes for table `umkm`
--
ALTER TABLE `umkm`
  ADD PRIMARY KEY (`id_umkm`),
  ADD KEY `umkm_jenis_usaha_index` (`jenis_usaha`),
  ADD KEY `umkm_nama_usaha_index` (`nama_usaha`),
  ADD KEY `umkm_user_id_foreign` (`user_id`);

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
  MODIFY `id_log` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `catatan_keuangan`
--
ALTER TABLE `catatan_keuangan`
  MODIFY `id_keuangan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investasi`
--
ALTER TABLE `investasi`
  MODIFY `id_investasi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `klarifikasi_dividen`
--
ALTER TABLE `klarifikasi_dividen`
  MODIFY `id_klarifikasi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `log_aktivitas_admin`
--
ALTER TABLE `log_aktivitas_admin`
  MODIFY `id_log_admin` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `penyedia_ruko`
--
ALTER TABLE `penyedia_ruko`
  MODIFY `id_penyedia` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesan_investasi`
--
ALTER TABLE `pesan_investasi`
  MODIFY `id_pesan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekomendasi_ruko`
--
ALTER TABLE `rekomendasi_ruko`
  MODIFY `id_rekomendasi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ruko`
--
ALTER TABLE `ruko`
  MODIFY `id_ruko` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teguran_dividen_log`
--
ALTER TABLE `teguran_dividen_log`
  MODIFY `id_teguran` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `third_party_authentications`
--
ALTER TABLE `third_party_authentications`
  MODIFY `id_oauth` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi_sewa`
--
ALTER TABLE `transaksi_sewa`
  MODIFY `id_sewa` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ulasan_umkm`
--
ALTER TABLE `ulasan_umkm`
  MODIFY `id_ulasan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `umkm`
--
ALTER TABLE `umkm`
  MODIFY `id_umkm` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id_verification` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bagi_hasil_log`
--
ALTER TABLE `bagi_hasil_log`
  ADD CONSTRAINT `bagi_hasil_log_id_investasi_foreign` FOREIGN KEY (`id_investasi`) REFERENCES `investasi` (`id_investasi`) ON DELETE CASCADE;

--
-- Constraints for table `catatan_keuangan`
--
ALTER TABLE `catatan_keuangan`
  ADD CONSTRAINT `catatan_keuangan_id_umkm_foreign` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE CASCADE;

--
-- Constraints for table `investasi`
--
ALTER TABLE `investasi`
  ADD CONSTRAINT `investasi_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `investasi_id_umkm_foreign` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE RESTRICT;

--
-- Constraints for table `klarifikasi_dividen`
--
ALTER TABLE `klarifikasi_dividen`
  ADD CONSTRAINT `klarifikasi_dividen_id_investasi_foreign` FOREIGN KEY (`id_investasi`) REFERENCES `investasi` (`id_investasi`) ON DELETE CASCADE,
  ADD CONSTRAINT `klarifikasi_dividen_id_umkm_foreign` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE CASCADE;

--
-- Constraints for table `log_aktivitas_admin`
--
ALTER TABLE `log_aktivitas_admin`
  ADD CONSTRAINT `log_aktivitas_admin_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `pesan_investasi`
--
ALTER TABLE `pesan_investasi`
  ADD CONSTRAINT `pesan_investasi_id_investasi_foreign` FOREIGN KEY (`id_investasi`) REFERENCES `investasi` (`id_investasi`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesan_investasi_id_pengirim_foreign` FOREIGN KEY (`id_pengirim`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_id_umkm_foreign` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE CASCADE;

--
-- Constraints for table `rekomendasi_ruko`
--
ALTER TABLE `rekomendasi_ruko`
  ADD CONSTRAINT `rekomendasi_ruko_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ruko`
--
ALTER TABLE `ruko`
  ADD CONSTRAINT `ruko_id_penyedia_foreign` FOREIGN KEY (`id_penyedia`) REFERENCES `penyedia_ruko` (`id_penyedia`) ON DELETE RESTRICT;

--
-- Constraints for table `teguran_dividen_log`
--
ALTER TABLE `teguran_dividen_log`
  ADD CONSTRAINT `teguran_dividen_log_id_investasi_foreign` FOREIGN KEY (`id_investasi`) REFERENCES `investasi` (`id_investasi`) ON DELETE CASCADE,
  ADD CONSTRAINT `teguran_dividen_log_id_umkm_foreign` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE CASCADE;

--
-- Constraints for table `third_party_authentications`
--
ALTER TABLE `third_party_authentications`
  ADD CONSTRAINT `third_party_authentications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi_sewa`
--
ALTER TABLE `transaksi_sewa`
  ADD CONSTRAINT `transaksi_sewa_id_investor_foreign` FOREIGN KEY (`id_investor`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transaksi_sewa_id_ruko_foreign` FOREIGN KEY (`id_ruko`) REFERENCES `ruko` (`id_ruko`) ON DELETE RESTRICT,
  ADD CONSTRAINT `transaksi_sewa_id_umkm_foreign` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE RESTRICT;

--
-- Constraints for table `ulasan_umkm`
--
ALTER TABLE `ulasan_umkm`
  ADD CONSTRAINT `ulasan_umkm_id_investasi_foreign` FOREIGN KEY (`id_investasi`) REFERENCES `investasi` (`id_investasi`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasan_umkm_id_investor_foreign` FOREIGN KEY (`id_investor`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasan_umkm_id_umkm_foreign` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE CASCADE;

--
-- Constraints for table `umkm`
--
ALTER TABLE `umkm`
  ADD CONSTRAINT `umkm_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD CONSTRAINT `verification_codes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
