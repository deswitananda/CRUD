-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 26 Jan 2025 pada 01.17
-- Versi server: 8.0.30
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `belajar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_biaya`
--

CREATE TABLE `data_biaya` (
  `id` int NOT NULL,
  `nama_biaya` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `data_biaya`
--

INSERT INTO `data_biaya` (`id`, `nama_biaya`, `deskripsi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(15, 'makan', 'makan apa aja', '2025-01-18 13:23:48', '2025-01-21 02:35:21', 0),
(17, 'spp', 'bayar uang sekolah di awal', '2025-01-17 04:53:51', '2025-01-17 04:53:51', 0),
(18, 'spp reguler', 'bayar pendaftaran sekolah', '2025-01-17 03:34:03', '2025-01-17 03:34:03', 1737275949),
(19, 'Pendaftaran', 'uang sekolah', '2025-01-17 19:32:12', '2025-01-17 19:32:12', 0),
(22, 'minum', 'minum di rumah', '2025-01-19 08:03:21', '2025-01-20 07:44:49', 0),
(23, 'bakar', 'bakar-bakar sate', '2025-01-19 08:37:51', '2025-01-19 08:38:01', 1737279565),
(24, 'SPP REGULER', 'bayar spp sekolah ', '2025-01-19 21:18:35', '2025-01-19 21:18:35', 1737452538),
(25, 'pajak', 'bayar pajak kereta', '2025-01-20 07:44:29', '2025-01-20 07:44:29', 1737721234),
(26, 'Tanah', 'Tanah negara', '2025-01-20 08:17:20', '2025-01-20 08:17:20', 0),
(27, 'Pendaftaran', 'uang sekolah', '2025-01-21 07:57:48', '2025-01-21 07:58:07', 0),
(28, 'bakar', 'bakar sampah', '2025-01-21 09:22:08', '2025-01-21 09:22:08', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_harga_biaya`
--

CREATE TABLE `data_harga_biaya` (
  `id` int NOT NULL,
  `id_tahun_pelajaran` int NOT NULL,
  `id_biaya` int NOT NULL,
  `harga` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `data_harga_biaya`
--

INSERT INTO `data_harga_biaya` (`id`, `id_tahun_pelajaran`, `id_biaya`, `harga`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 1, 9, 200000, '2025-01-16 04:59:08', '2025-01-16 04:59:08', 1737037022),
(4, 1, 10, 200000, '2025-01-16 04:59:37', '2025-01-16 04:59:37', 1737037218),
(6, 1, 13, 200000, '2025-01-16 05:02:24', '2025-01-16 05:02:24', 1737037215),
(7, 1, 10, 300000, '2025-01-16 05:04:46', '2025-01-16 05:04:46', 1737037211),
(8, 2, 9, 300000, '2025-01-16 05:12:03', '2025-01-16 05:12:03', 1737023211),
(9, 1, 10, 300000, '2025-01-16 06:39:42', '2025-01-16 06:39:42', 1737023208),
(10, 1, 22, 300000, '2025-01-16 06:42:40', '2025-01-19 08:03:57', 1737721246),
(11, 2, 15, 200000, '2025-01-16 14:20:06', '2025-01-24 12:20:54', 0),
(13, 1, 18, 350000, '2025-01-17 03:24:25', '2025-01-19 08:38:52', 1737275939),
(18, 3, 19, 300000, '2025-01-17 19:32:47', '2025-01-19 09:57:51', 0),
(19, 3, 23, 500000, '2025-01-19 08:38:34', '2025-01-19 08:38:34', 1737279604),
(20, 8, 24, 2000000, '2025-01-19 21:19:01', '2025-01-19 21:19:01', 0),
(21, 9, 25, 5500000, '2025-01-20 07:45:50', '2025-01-20 07:45:50', 0),
(22, 10, 26, 200000000, '2025-01-20 08:18:02', '2025-01-20 08:18:18', 1737446297),
(23, 2, 28, 250000, '2025-01-21 09:39:30', '2025-01-21 09:39:30', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jurusan`
--

CREATE TABLE `data_jurusan` (
  `id` int NOT NULL,
  `id_tahun_pelajaran` int NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `data_jurusan`
--

INSERT INTO `data_jurusan` (`id`, `id_tahun_pelajaran`, `nama_jurusan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Teknik', '2025-01-21 02:26:58', '2025-01-21 02:26:58', 0),
(2, 9, 'TATA BOGA', '2025-01-21 02:27:25', '2025-01-21 02:27:25', 0),
(3, 1, 'RPL', '2025-01-15 11:35:02', '2025-01-15 11:35:02', 1736949065),
(4, 2, 'DKV', '2025-01-15 11:35:23', '2025-01-15 11:35:23', 0),
(5, 3, 'DKV', '2025-01-19 07:58:22', '2025-01-19 07:58:22', 1737273507),
(6, 3, 'TATA BOGA', '2025-01-21 02:28:09', '2025-01-21 02:28:09', 0),
(7, 3, 'Ilkom', '2025-01-19 09:38:54', '2025-01-19 09:38:54', 1737279539),
(8, 8, 'TKJ', '2025-01-19 21:15:10', '2025-01-19 21:15:10', 1737358782),
(9, 1, 'DKV', '2025-01-20 07:39:32', '2025-01-20 07:39:32', 0),
(10, 9, 'RPL', '2025-01-20 08:15:52', '2025-01-20 08:15:52', 1737721349),
(11, 10, 'ILKOM', '2025-01-20 08:15:35', '2025-01-20 08:15:35', 1737414339),
(12, 15, 'DKV', '2025-01-24 12:10:55', '2025-01-24 12:10:55', 1737720672);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kelas`
--

CREATE TABLE `data_kelas` (
  `id` int NOT NULL,
  `id_tahun_pelajaran` int NOT NULL,
  `id_jurusan` int NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `data_kelas`
--

INSERT INTO `data_kelas` (`id`, `id_tahun_pelajaran`, `id_jurusan`, `nama_kelas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 4, '5 DKV', '2025-01-15 04:37:12', '2025-01-15 04:37:12', '2025-01-19 14:15:31'),
(2, 0, 3, '10 RPL', '2025-01-15 04:37:26', '2025-01-15 04:37:26', '2025-01-19 14:15:57'),
(3, 0, 2, '10 TATA BOGA', '2025-01-15 04:36:34', '2025-01-15 04:36:34', '2025-01-19 14:16:00'),
(7, 1, 2, '10 rpl', '2025-01-19 02:36:54', '2025-01-19 02:36:54', '2025-01-20 00:43:16'),
(8, 3, 6, '15 tkj', '2025-01-19 02:37:52', '2025-01-19 02:37:52', '2025-01-19 02:37:57'),
(9, 0, 0, '2E TATA BOGA', '2025-01-20 20:13:45', '2025-01-20 20:13:45', '0000-00-00 00:00:00'),
(10, 3, 6, '2A TATA BOGA', '2025-01-25 07:12:10', '2025-01-25 07:12:10', '0000-00-00 00:00:00'),
(11, 9, 10, '5C TKJ', '2025-01-20 00:43:06', '2025-01-20 00:43:06', '0000-00-00 00:00:00'),
(12, 10, 11, '22B', '2025-01-20 01:16:32', '2025-01-20 01:16:32', '0000-00-00 00:00:00'),
(13, 9, 10, '3F RPL', '2025-01-21 02:41:59', '2025-01-21 02:41:59', '0000-00-00 00:00:00'),
(14, 3, 6, '10 TATA BOGA', '2025-01-24 05:22:51', '2025-01-24 05:22:51', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pendaftaran_awal`
--

CREATE TABLE `data_pendaftaran_awal` (
  `id` int NOT NULL,
  `id_jurusan` int NOT NULL,
  `id_tahun_pelajaran` int NOT NULL,
  `id_kelas` int NOT NULL,
  `no_pendaftaran` int NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_telepon_siswa` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `asal_sekolah` varchar(50) NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `no_telepon_ayah` varchar(20) NOT NULL,
  `no_telepon_ibu` varchar(20) NOT NULL,
  `pekerjaan_ayah` varchar(50) NOT NULL,
  `pekerjaan_ibu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_wali` varchar(50) NOT NULL,
  `no_telepon_wali` varchar(20) NOT NULL,
  `pekerjaan_wali` varchar(50) NOT NULL,
  `alamat_orang_tua` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sumber_informasi` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `data_pendaftaran_awal`
--

INSERT INTO `data_pendaftaran_awal` (`id`, `id_jurusan`, `id_tahun_pelajaran`, `id_kelas`, `no_pendaftaran`, `nama_kelas`, `nama_siswa`, `nik`, `agama`, `nisn`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `no_telepon_siswa`, `email`, `asal_sekolah`, `nama_ayah`, `nama_ibu`, `no_telepon_ayah`, `no_telepon_ibu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `nama_wali`, `no_telepon_wali`, `pekerjaan_wali`, `alamat_orang_tua`, `sumber_informasi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 10, 0, '', 'bayu', '1234567890987654', 'Katolik', '0987654321', 'L', 'gak tau', '2025-01-16', '098765432123', 'bayuyu@gmail.com', 'gak tau', 'pak bayu', 'mak bayu', '098765432123', '098765432123', 'entahlah', 'entahlah', '-', '09876543212', '-', 'jalan antah berantah', 'google', '2025-01-24 11:19:25', '2025-01-24 11:19:25', 1737723455),
(2, 1, 2, 10, 0, '', 'ani', '1234567890987654', 'Protestan', '0987654321', 'P', 'gak tau', '2020-07-07', '098765432123', 'bayuyu@gmail.com', 'gak tau', 'pak ani', 'buk ani', '098765432123', '098765432123', 'entahlah', 'entahlah', '', '', '', 'ntah', 'google', '2025-01-24 12:38:06', '2025-01-24 12:38:06', 1737723044),
(3, 6, 3, 14, 0, '', 'bayu', '1234567890987654', 'Katolik', '0987654321', 'L', 'gak tau', '2025-01-16', '098765432123', 'bayuyu@gmail.com', 'gak tau', 'pak bayu', 'mak bayu', '098765432123', '098765432123', 'entahlah', 'entahlah', '-', '09876543212', '-', 'jalan antah berantah', 'google', '2025-01-24 12:39:07', '2025-01-24 12:39:07', 1737723794),
(4, 1, 2, 10, 0, '', 'ani', '1234567890987654', 'Islam', '0987654321', 'P', 'jambi', '2025-01-24', '098765432123', 'aniii@gmail.com', 'jambi', 'pak ani', 'buk ani', '098765432123', '098765432123', 'petani', 'buruh', '', '', '', 'jalan jambi jambu', 'internet', '2025-01-24 12:59:19', '2025-01-24 12:59:19', 0),
(5, 1, 2, 10, 0, '', 'bayu', '1234567890987654', 'Katolik', '0987654321', 'L', 'gak tau', '2025-01-16', '098765432123', 'bayuyu@gmail.com', 'gak tau', 'pak bayu', 'mak bayu', '098765432123', '098765432123', 'entahlah', 'entahlah', '-', '-', '-', 'jalan antah berantah', 'google', '2025-01-24 13:02:48', '2025-01-24 13:02:48', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_seragam`
--

CREATE TABLE `data_seragam` (
  `id` int NOT NULL,
  `nama_seragam` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `data_seragam`
--

INSERT INTO `data_seragam` (`id`, `nama_seragam`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'baju jas hujan', '2025-01-18 02:41:38', '2025-01-20 07:47:55', 1737721268),
(7, 'baju abu-abu', '2025-01-15 18:01:09', '2025-01-19 08:06:29', 0),
(8, 'pdh', '2025-01-18 02:41:48', '2025-01-18 09:41:48', 1737279629),
(9, 'Olahraga', '2025-01-18 03:48:41', '2025-01-18 10:48:41', 1737276041),
(10, 'baju batik', '2025-01-19 21:19:18', '2025-01-19 21:19:18', 0),
(11, 'baju olahraga', '2025-01-20 07:46:11', '2025-01-21 09:20:20', 0),
(12, 'baju Jas ', '2025-01-20 08:18:52', '2025-01-24 12:21:25', 0),
(13, 'baju pramuka', '2025-01-21 09:10:16', '2025-01-21 09:10:16', 0),
(14, 'baju pramuka', '2025-01-21 09:27:39', '2025-01-21 09:27:39', 1737451669);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_stok`
--

CREATE TABLE `data_stok` (
  `id` int NOT NULL,
  `id_seragam` int NOT NULL,
  `id_tahun_pelajaran` int NOT NULL,
  `ukuran` varchar(50) NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `data_stok`
--

INSERT INTO `data_stok` (`id`, `id_seragam`, `id_tahun_pelajaran`, `ukuran`, `stok`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 7, 0, 'L', 50, '2025-01-16 07:21:39', '2025-01-16 07:21:39', 0),
(6, 6, 0, 'XL', 12, '2025-01-16 03:18:24', '2025-01-16 03:18:24', 0),
(7, 8, 0, 'S', 50, '2025-01-18 03:35:29', '2025-01-18 10:35:29', 0),
(8, 6, 0, 'L', 50, '2025-01-18 03:35:47', '2025-01-18 10:35:47', 0),
(9, 7, 0, 'L', 50, '2025-01-18 03:36:02', '2025-01-18 10:36:02', 1737171425),
(10, 9, 0, 'M', 15, '2025-01-18 03:49:05', '2025-01-18 10:49:05', 0),
(11, 7, 1, 'XL', 25, '2025-01-19 08:06:54', '2025-01-19 09:58:57', 0),
(12, 11, 1, 'M', 29, '2025-01-19 08:39:41', '2025-01-20 07:48:15', 0),
(13, 8, 2, 'M', 60, '2025-01-19 08:40:08', '2025-01-19 08:40:08', 1737276035),
(14, 8, 3, 'S', 15, '2025-01-19 09:40:59', '2025-01-19 09:40:59', 1737279662),
(15, 10, 1, 'L', 10, '2025-01-19 21:19:44', '2025-01-20 07:47:14', 0),
(16, 11, 9, 'XL', 10, '2025-01-20 07:46:38', '2025-01-20 07:46:38', 0),
(17, 12, 10, 'S', 22, '2025-01-20 08:19:22', '2025-01-20 08:19:22', 0),
(18, 13, 14, 'S', 15, '2025-01-21 09:13:12', '2025-01-21 09:13:12', 0),
(19, 12, 2, 'L', 15, '2025-01-24 12:21:59', '2025-01-24 12:21:59', 1737721326);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_tahun_pelajaran`
--

CREATE TABLE `data_tahun_pelajaran` (
  `id` int NOT NULL,
  `nama_tahun_pelajaran` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `status_tahun_pelajaran` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `data_tahun_pelajaran`
--

INSERT INTO `data_tahun_pelajaran` (`id`, `nama_tahun_pelajaran`, `tanggal_mulai`, `tanggal_akhir`, `status_tahun_pelajaran`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2020-2021', '2025-01-06', '2026-01-05', '0', '2025-01-15 02:58:50', '2025-01-21 01:52:33', 2025),
(2, '2027-2028', '2027-01-11', '2028-05-14', '1', '2025-01-15 03:00:01', '2025-01-21 01:55:49', 0),
(3, '2025-2027', '2025-01-20', '2027-05-10', '1', '2025-01-15 23:25:21', '2025-01-19 07:56:28', 0),
(7, '2024/2025', '0000-00-00', '0000-00-00', '1', '2025-01-19 09:43:33', '2025-01-19 09:43:33', 2025),
(8, '2025-2028', '2025-04-05', '2028-09-08', '1', '2025-01-19 21:14:27', '2025-01-19 21:14:27', 2025),
(9, '2029-2030', '2029-03-03', '2030-09-09', '0', '2025-01-20 07:41:26', '2025-01-24 13:51:20', 0),
(11, '2025-2026', '2025-01-06', '2026-01-05', '1', '0000-00-00 00:00:00', '2025-01-21 06:13:48', 1737414847),
(12, '2025-2026', '2025-01-06', '2026-01-05', '1', '0000-00-00 00:00:00', '2025-01-21 06:18:04', 2025),
(13, '2025-2026', '2025-01-06', '2026-01-05', '1', '0000-00-00 00:00:00', '2025-01-21 06:18:04', 1737415093),
(14, '2028-2030', '2028-02-02', '2030-03-03', '1', '2025-01-21 07:56:11', '2025-01-21 07:56:11', 0),
(16, '2029-2030', '2029-03-03', '2030-09-09', '0', '2025-01-24 13:50:59', '2025-01-24 13:50:59', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran_awal`
--

CREATE TABLE `pendaftaran_awal` (
  `id` int NOT NULL,
  `no_pendaftaran` varchar(50) NOT NULL,
  `id_tahun_pelajaran` int NOT NULL,
  `id_jurusan` int NOT NULL,
  `id_kelas` int NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `no_telepon_ayah` varchar(20) NOT NULL,
  `no_telepon_ibu` varchar(20) NOT NULL,
  `pekerjaan_ayah` varchar(50) NOT NULL,
  `pekerjaan_ibu` varchar(50) NOT NULL,
  `nama_wali` varchar(100) NOT NULL,
  `no_telepon_wali` varchar(20) NOT NULL,
  `pekerjaan_wali` varchar(50) NOT NULL,
  `alamat_wali` varchar(100) NOT NULL,
  `sumber_informasi` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pendaftaran_awal`
--

INSERT INTO `pendaftaran_awal` (`id`, `no_pendaftaran`, `id_tahun_pelajaran`, `id_jurusan`, `id_kelas`, `nama_siswa`, `nik`, `agama`, `nisn`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_telepon`, `email`, `asal_sekolah`, `nama_ayah`, `nama_ibu`, `no_telepon_ayah`, `no_telepon_ibu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `nama_wali`, `no_telepon_wali`, `pekerjaan_wali`, `alamat_wali`, `sumber_informasi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '0000-TATA BOGA-0001', 3, 6, 10, 'bayu', '1234567890987654', 'Islam', '0987654321', 'Laki-laki', 'jambi', '2025-01-14', 'jambi', '081234567890', 'bayuyu@gmail.com', 'jambi', 'pak bayu', 'mak bayu', '098765432123', '098765432123', 'petani', 'buruh', '-', '-', '-', 'entah', 'Spanduk', '2025-01-26 00:49:15', '2025-01-26 00:49:15', 0),
(2, '0000-TATA BOGA-0002', 3, 6, 14, 'Deswita Ananda', '1234567890987654', 'Islam', '1234567891', 'Perempuan', 'Medan', '2003-12-13', 'Medan', '081267385674', 'deswitaananda0322@gmail.com', 'Kamang Magek', 'Ayah', 'Ibu', '081234567890', '081234567890', 'petani', 'buruh', '-', '-', '-', 'Medan', 'Website', '2025-01-26 00:52:46', '2025-01-26 00:52:46', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `update_at`) VALUES
(10, 'DeswitaA', 'nanda', '2025-01-11 11:44:21'),
(16, 'banuya', '12345', '2025-01-11 15:37:50'),
(18, 'user12', '111', '2025-01-13 21:18:43');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_biaya`
--
ALTER TABLE `data_biaya`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_harga_biaya`
--
ALTER TABLE `data_harga_biaya`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_jurusan`
--
ALTER TABLE `data_jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_kelas`
--
ALTER TABLE `data_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_pendaftaran_awal`
--
ALTER TABLE `data_pendaftaran_awal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_seragam`
--
ALTER TABLE `data_seragam`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_stok`
--
ALTER TABLE `data_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_tahun_pelajaran`
--
ALTER TABLE `data_tahun_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pendaftaran_awal`
--
ALTER TABLE `pendaftaran_awal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_biaya`
--
ALTER TABLE `data_biaya`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `data_harga_biaya`
--
ALTER TABLE `data_harga_biaya`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `data_jurusan`
--
ALTER TABLE `data_jurusan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `data_kelas`
--
ALTER TABLE `data_kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `data_pendaftaran_awal`
--
ALTER TABLE `data_pendaftaran_awal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `data_seragam`
--
ALTER TABLE `data_seragam`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `data_stok`
--
ALTER TABLE `data_stok`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `data_tahun_pelajaran`
--
ALTER TABLE `data_tahun_pelajaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran_awal`
--
ALTER TABLE `pendaftaran_awal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
