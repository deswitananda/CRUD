-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 19 Jan 2025 pada 10.48
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

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
(15, 'makan', 'mari makan', '2025-01-18 13:23:48', '2025-01-19 08:03:07', 0),
(17, 'spp', 'bayar uang sekolah di awal', '2025-01-17 04:53:51', '2025-01-17 04:53:51', 0),
(18, 'spp reguler', 'bayar pendaftaran sekolah', '2025-01-17 03:34:03', '2025-01-17 03:34:03', 1737275949),
(19, 'Pendaftaran', 'uang sekolah', '2025-01-17 19:32:12', '2025-01-17 19:32:12', 0),
(22, 'minum', 'minum-minum', '2025-01-19 08:03:21', '2025-01-19 08:03:21', 0),
(23, 'bakar', 'bakar-bakar sate', '2025-01-19 08:37:51', '2025-01-19 08:38:01', 1737279565);

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
(10, 1, 22, 300000, '2025-01-16 06:42:40', '2025-01-19 08:03:57', 0),
(11, 1, 15, 200000, '2025-01-16 14:20:06', '2025-01-16 14:20:06', 0),
(13, 1, 18, 350000, '2025-01-17 03:24:25', '2025-01-19 08:38:52', 1737275939),
(18, 3, 19, 300000, '2025-01-17 19:32:47', '2025-01-19 09:57:51', 0),
(19, 3, 23, 500000, '2025-01-19 08:38:34', '2025-01-19 08:38:34', 1737279604);

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
(1, 2, 'RPL', '2025-01-15 03:06:03', '2025-01-15 03:06:03', 0),
(2, 1, 'TATA BOGA', '2025-01-15 11:35:48', '2025-01-15 11:35:48', 0),
(3, 1, 'RPL', '2025-01-15 11:35:02', '2025-01-15 11:35:02', 1736949065),
(4, 2, 'DKV', '2025-01-15 11:35:23', '2025-01-15 11:35:23', 0),
(5, 3, 'DKV', '2025-01-19 07:58:22', '2025-01-19 07:58:22', 1737273507),
(6, 3, 'TKJ', '2025-01-19 07:57:55', '2025-01-19 07:57:55', 0),
(7, 3, 'Ilkom', '2025-01-19 09:38:54', '2025-01-19 09:38:54', 1737279539);

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
(1, 0, 4, '5 DKV', '2025-01-15 04:37:12', '2025-01-15 04:37:12', '0000-00-00 00:00:00'),
(2, 0, 3, '10 RPL', '2025-01-15 04:37:26', '2025-01-15 04:37:26', '0000-00-00 00:00:00'),
(3, 0, 2, '10 TATA BOGA', '2025-01-15 04:36:34', '2025-01-15 04:36:34', '0000-00-00 00:00:00'),
(7, 1, 2, '10 rpl', '2025-01-19 02:36:54', '2025-01-19 02:36:54', '0000-00-00 00:00:00'),
(8, 3, 6, '15 tkj', '2025-01-19 02:37:52', '2025-01-19 02:37:52', '2025-01-19 02:37:57');

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
(6, 'baju jas', '2025-01-18 02:41:38', '2025-01-19 08:06:15', 0),
(7, 'baju abu-abu', '2025-01-15 18:01:09', '2025-01-19 08:06:29', 0),
(8, 'pdh', '2025-01-18 02:41:48', '2025-01-18 09:41:48', 1737279629),
(9, 'Olahraga', '2025-01-18 03:48:41', '2025-01-18 10:48:41', 1737276041);

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
(12, 6, 1, 'XL', 25, '2025-01-19 08:39:41', '2025-01-19 08:40:21', 0),
(13, 8, 2, 'M', 60, '2025-01-19 08:40:08', '2025-01-19 08:40:08', 1737276035),
(14, 8, 3, 'S', 15, '2025-01-19 09:40:59', '2025-01-19 09:40:59', 1737279662);

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
(1, '2025-2026', '2025-01-06', '2026-01-05', '1', '2025-01-15 02:58:50', '2025-01-15 02:58:50', 0),
(2, '2027-2028', '2027-01-11', '2029-05-14', '1', '2025-01-15 03:00:01', '2025-01-15 03:00:01', 0),
(3, '2025-2027', '2025-01-20', '2027-05-10', '1', '2025-01-15 23:25:21', '2025-01-19 07:56:28', 0),
(7, '2024/2025', '0000-00-00', '0000-00-00', '1', '2025-01-19 09:43:33', '2025-01-19 09:43:33', 2025);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `data_harga_biaya`
--
ALTER TABLE `data_harga_biaya`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `data_jurusan`
--
ALTER TABLE `data_jurusan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `data_kelas`
--
ALTER TABLE `data_kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `data_seragam`
--
ALTER TABLE `data_seragam`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `data_stok`
--
ALTER TABLE `data_stok`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `data_tahun_pelajaran`
--
ALTER TABLE `data_tahun_pelajaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
