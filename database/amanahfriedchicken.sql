-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Agu 2023 pada 10.31
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amanahfriedchicken`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahanbaku`
--

CREATE TABLE `bahanbaku` (
  `idbahanbaku` int(11) NOT NULL,
  `namabahanbaku` varchar(255) NOT NULL,
  `stok` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bahanbaku`
--

INSERT INTO `bahanbaku` (`idbahanbaku`, `namabahanbaku`, `stok`) VALUES
(10, 'Ayam', '651'),
(11, 'Tepung', '75'),
(12, 'Minyak', '34'),
(13, 'Masako', '13'),
(14, 'Sasa', '16'),
(15, 'Garam', '12'),
(16, 'Bawang Putih', '6'),
(17, 'Lada Bubuk', '15'),
(18, 'Ketumbar Bubuk', '16'),
(19, 'Beras', '33'),
(20, 'Cabe', '17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahanbakupembelian`
--

CREATE TABLE `bahanbakupembelian` (
  `idbahanbakupembelian` int(11) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `idbahanbaku` int(11) NOT NULL,
  `jumlah` varchar(10) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `grandtotal` varchar(255) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bahanbakupembelian`
--

INSERT INTO `bahanbakupembelian` (`idbahanbakupembelian`, `kode`, `idbahanbaku`, `jumlah`, `harga`, `total`, `grandtotal`, `tanggal`) VALUES
(4, '030723111955', 11, '10', '5000', '50000', '50000', '2023-07-03'),
(5, '190723041856', 10, '700', '7000', '4900000', '7710000', '2023-07-19'),
(6, '190723041856', 11, '75', '10000', '750000', '7710000', '2023-07-19'),
(7, '190723041856', 12, '40', '10000', '400000', '7710000', '2023-07-19'),
(8, '190723041856', 13, '20', '500', '10000', '7710000', '2023-07-19'),
(9, '190723041856', 14, '20', '500', '10000', '7710000', '2023-07-19'),
(10, '190723041856', 15, '15', '1000', '15000', '7710000', '2023-07-19'),
(11, '190723041856', 16, '7', '35000', '245000', '7710000', '2023-07-19'),
(12, '190723041856', 17, '20', '500', '10000', '7710000', '2023-07-19'),
(13, '190723041856', 18, '20', '500', '10000', '7710000', '2023-07-19'),
(14, '190723041856', 19, '40', '9000', '360000', '7710000', '2023-07-19'),
(15, '190723041856', 20, '25', '40000', '1000000', '7710000', '2023-07-19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahanbakupenggunaan`
--

CREATE TABLE `bahanbakupenggunaan` (
  `idbahanbakupenggunaan` int(11) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `idbahanbaku` int(11) NOT NULL,
  `jumlah` varchar(10) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bahanbakupenggunaan`
--

INSERT INTO `bahanbakupenggunaan` (`idbahanbakupenggunaan`, `kode`, `idbahanbaku`, `jumlah`, `tanggal`) VALUES
(1, '030723111941', 11, '1', '2023-07-03'),
(2, '190723042049', 10, '50', '2023-07-19'),
(3, '190723042049', 11, '10', '2023-07-19'),
(4, '190723042049', 12, '6', '2023-07-19'),
(5, '190723042049', 13, '7', '2023-07-19'),
(6, '190723042049', 14, '4', '2023-07-19'),
(7, '190723042049', 15, '3', '2023-07-19'),
(8, '190723042049', 16, '1', '2023-07-19'),
(9, '190723042049', 17, '5', '2023-07-19'),
(10, '190723042049', 18, '4', '2023-07-19'),
(11, '190723042049', 19, '7', '2023-07-19'),
(12, '190723042049', 20, '8', '2023-07-19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(4, 'Paha', '2023-05-19 14:31:46', '2023-05-19 14:31:46'),
(5, 'Dada', '2023-05-19 14:31:50', '2023-05-19 14:31:50'),
(6, 'Sayap', '2023-05-19 14:31:53', '2023-05-19 14:31:53'),
(7, 'Nasi', '2023-06-19 15:22:48', '2023-06-19 15:22:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-05-16-075112', 'App\\Database\\Migrations\\Kategori', 'default', 'App', 1684290163, 1),
(2, '2023-05-16-144438', 'App\\Database\\Migrations\\Produk', 'default', 'App', 1684290163, 1),
(4, '2023-05-22-115400', 'App\\Database\\Migrations\\Pengguna', 'default', 'App', 1684756681, 2),
(7, '2023-05-30-070829', 'App\\Database\\Migrations\\Pembelian', 'default', 'App', 1685672493, 3),
(8, '2023-05-30-070852', 'App\\Database\\Migrations\\PembelianProduk', 'default', 'App', 1685672493, 3),
(9, '2023-05-30-070904', 'App\\Database\\Migrations\\Pembayaran', 'default', 'App', 1685672493, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) UNSIGNED NOT NULL,
  `idbeli` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggaltransfer` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `idbeli`, `nama`, `tanggaltransfer`, `tanggal`, `bukti`, `created_at`, `updated_at`) VALUES
(2, 2, 'jaya', '2023-07-19', '2023-07-19 00:00:00', '20230719041510_jaya', '2023-07-19 04:15:10', '2023-07-19 04:15:10'),
(3, 3, 'Sugeng', '2023-07-19', '2023-07-19 00:00:00', '20230719042218_Sugeng', '2023-07-19 04:22:18', '2023-07-19 04:22:18'),
(4, 4, 'jaya', '2023-07-19', '2023-07-19 00:00:00', '20230719094040_jaya', '2023-07-19 09:40:40', '2023-07-19 09:40:40'),
(5, 5, 'Sugeng', '2023-07-19', '2023-07-19 00:00:00', '20230719132825_Sugeng', '2023-07-19 13:28:25', '2023-07-19 13:28:25'),
(6, 6, 'Sugeng', '2023-07-19', '2023-07-19 00:00:00', '20230719134525_Sugeng', '2023-07-19 13:45:25', '2023-07-19 13:45:25'),
(7, 7, 'Sugeng', '2023-07-19', '2023-07-19 00:00:00', '20230719134813_Sugeng', '2023-07-19 13:48:13', '2023-07-19 13:48:13'),
(8, 8, 'Sugeng', '2023-07-19', '2023-07-19 00:00:00', '20230719135438_Sugeng', '2023-07-19 13:54:38', '2023-07-19 13:54:38'),
(9, 9, 'jaya', '2023-07-20', '2023-07-20 00:00:00', '20230720053016_jaya', '2023-07-20 05:30:16', '2023-07-20 05:30:16'),
(10, 10, 'Sugeng', '2023-07-20', '2023-07-20 00:00:00', '20230720104652_Sugeng', '2023-07-20 10:46:52', '2023-07-20 10:46:52'),
(11, 11, 'jaya', '2023-07-20', '2023-07-20 00:00:00', '20230720104940_jaya', '2023-07-20 10:49:40', '2023-07-20 10:49:40'),
(12, 12, 'Ilham', '2023-07-20', '2023-07-20 00:00:00', '20230720111626_Ilham', '2023-07-20 11:16:26', '2023-07-20 11:16:26'),
(13, 13, 'Ilham', '2023-07-20', '2023-07-20 00:00:00', '20230720143116_Ilham', '2023-07-20 14:31:16', '2023-07-20 14:31:16'),
(14, 14, 'Ilham', '2023-07-21', '2023-07-21 00:00:00', '20230721005109_Ilham', '2023-07-21 00:51:09', '2023-07-21 00:51:09'),
(15, 15, 'udin', '2023-07-21', '2023-07-21 00:00:00', '20230721035045_udin', '2023-07-21 03:50:45', '2023-07-21 03:50:45'),
(16, 16, 'Sugeng', '2023-07-24', '2023-07-24 00:00:00', '20230724072603_Sugeng', '2023-07-24 07:26:03', '2023-07-24 07:26:03'),
(17, 17, 'Sugeng', '2023-07-24', '2023-07-24 00:00:00', '20230724124255_Sugeng', '2023-07-24 12:42:55', '2023-07-24 12:42:55'),
(18, 18, 'udin', '2023-08-04', '2023-08-04 00:00:00', '20230804015138_udin', '2023-08-04 01:51:38', '2023-08-04 01:51:38'),
(19, 19, 'udin', '2023-08-18', '2023-08-18 00:00:00', '20230818085010_udin', '2023-08-18 08:50:10', '2023-08-18 08:50:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `idbeli` int(11) UNSIGNED NOT NULL,
  `notransaksi` varchar(255) NOT NULL,
  `id` int(11) UNSIGNED NOT NULL,
  `tanggalbeli` date NOT NULL,
  `totalbeli` varchar(255) NOT NULL,
  `alamatpengiriman` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `ongkir` varchar(255) NOT NULL,
  `jenispengiriman` text NOT NULL,
  `statusbeli` varchar(255) NOT NULL,
  `resipengiriman` varchar(255) NOT NULL,
  `waktu` datetime NOT NULL,
  `bukti_makanan` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`idbeli`, `notransaksi`, `id`, `tanggalbeli`, `totalbeli`, `alamatpengiriman`, `kota`, `ongkir`, `jenispengiriman`, `statusbeli`, `resipengiriman`, `waktu`, `bukti_makanan`, `created_at`, `updated_at`) VALUES
(2, '#TP20230719041451', 8, '2023-07-19', '14000', 'Bekasi', 'Bekasi', '10000', 'Kurir', 'Selesai', '222222', '2023-07-19 04:14:51', '', '2023-07-19 04:14:51', '2023-07-19 04:24:28'),
(3, '#TP20230719042203', 7, '2023-07-19', '28000', 'Bekasi', 'Bekasi', '10000', 'Kurir', 'Selesai', '', '2023-07-19 04:22:03', '', '2023-07-19 04:22:03', '2023-07-19 04:24:54'),
(4, '#TP20230719094005', 8, '2023-07-19', '26000', 'Bekasi', 'Bekasi', '10000', 'Kurir', 'Selesai', '22322', '2023-07-19 09:40:05', '', '2023-07-19 09:40:05', '2023-07-19 09:43:12'),
(5, '#TP20230719012809', 7, '2023-07-19', '12000', 'Bekasi', 'Bekasi', '10000', 'Kurir', 'Selesai', '766689', '2023-07-19 13:28:09', '', '2023-07-19 13:28:09', '2023-07-19 13:54:22'),
(6, '#TP20230719014509', 7, '2023-07-19', '14000', 'Bekasi', 'Bekasi', '10000', 'Kurir', 'Selesai', '', '2023-07-19 13:45:09', '', '2023-07-19 13:45:09', '2023-07-19 13:54:16'),
(7, '#TP20230719014758', 7, '2023-07-19', '12000', 'Jakarta', 'Jakarta', '15000', 'Kurir', 'Selesai', '', '2023-07-19 13:47:58', '', '2023-07-19 13:47:58', '2023-07-19 13:54:11'),
(8, '#TP20230719015406', 7, '2023-07-19', '12000', 'Bekasi', 'Bekasi', '0', 'Ambil Sendiri', 'Selesai', '', '2023-07-19 13:54:06', '', '2023-07-19 13:54:06', '2023-07-19 13:57:30'),
(9, '#TP20230720052941', 8, '2023-07-20', '12000', 'Bekasi', 'Bekasi', '10000', 'Kurir', 'Selesai', '12345678', '2023-07-20 05:29:41', '', '2023-07-20 05:29:41', '2023-07-20 05:38:33'),
(10, '#TP20230720104638', 7, '2023-07-20', '12000', 'Bekasi', 'Bekasi', '10000', 'Kurir', 'Selesai', '', '2023-07-20 10:46:38', '', '2023-07-20 10:46:38', '2023-07-20 10:48:35'),
(11, '#TP20230720104926', 8, '2023-07-20', '14000', 'Jalan raya pangeran jayakarta', 'Bekasi', '10000', 'Kurir', 'Selesai', '', '2023-07-20 10:49:26', '', '2023-07-20 10:49:26', '2023-07-20 10:50:43'),
(12, '#TP20230720111610', 9, '2023-07-20', '14000', 'Kampung Kandang Rt01 Rw16 No17', 'Bekasi', '10000', 'Kurir', 'Selesai', '', '2023-07-20 11:16:10', '', '2023-07-20 11:16:10', '2023-07-20 11:17:43'),
(13, '#TP20230720023035', 9, '2023-07-20', '24000', 'Bekasi', 'Bekasi', '10000', 'Kurir', 'Selesai', '34455566', '2023-07-20 14:30:35', '', '2023-07-20 14:30:35', '2023-07-20 14:38:40'),
(14, '#TP20230721125049', 9, '2023-07-21', '14000', 'Bekasi', 'Bekasi', '10000', 'Kurir', 'Selesai', '527282939', '2023-07-21 00:50:49', '', '2023-07-21 00:50:49', '2023-07-21 00:59:33'),
(15, '#TP20230721034951', 10, '2023-07-21', '36000', 'Bekasi Utara no12 rt12 rw14', 'Jakarta', '15000', 'Kurir', 'Selesai', '', '2023-07-21 03:49:51', '20230804005644_udin', '2023-07-21 03:49:51', '2023-08-04 01:00:33'),
(16, '#TP20230724070844', 7, '2023-07-24', '14000', 'sadas', 'Jakarta', '15000', 'Kurir', 'Selesai', '', '2023-07-24 07:08:44', '20230724123934_Sugeng', '2023-07-24 07:08:44', '2023-08-04 00:55:44'),
(17, '#TP20230724124242', 7, '2023-07-24', '12000', 'dawea', 'Jakarta', '15000', 'Kurir', 'Selesai', '', '2023-07-24 12:42:42', '20230724124807_Sugeng', '2023-07-24 12:42:42', '2023-07-24 12:48:51'),
(18, '#TP20230804015122', 10, '2023-08-04', '24000', 'Bekasi', 'Bekasi', '10000', 'Kurir', 'Selesai', '', '2023-08-04 01:51:22', '20230804033101_udin', '2023-08-04 01:51:22', '2023-08-04 03:32:09'),
(19, '#TP20230818084942', 10, '2023-08-18', '12000', 'Bekasi', 'Bekasi', '10000', 'Kurir', 'Sudah Upload Bukti Pembayaran', '', '2023-08-18 08:49:42', '', '2023-08-18 08:49:42', '2023-08-18 08:50:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelianproduk`
--

CREATE TABLE `pembelianproduk` (
  `idbeli_produk` int(11) UNSIGNED NOT NULL,
  `idbeli` int(11) UNSIGNED NOT NULL,
  `id_produk` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `subharga` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pembelianproduk`
--

INSERT INTO `pembelianproduk` (`idbeli_produk`, `idbeli`, `id_produk`, `nama`, `harga`, `subharga`, `jumlah`, `created_at`, `updated_at`) VALUES
(2, 2, 16, 'Geprek Dada', '14000', '14000', '1', '2023-07-19 04:14:51', '2023-07-19 04:14:51'),
(3, 3, 13, 'Geprek Paha Atas', '14000', '28000', '2', '2023-07-19 04:22:03', '2023-07-19 04:22:03'),
(4, 4, 6, 'Paha Atas', '12000', '12000', '1', '2023-07-19 09:40:05', '2023-07-19 09:40:05'),
(5, 4, 13, 'Geprek Paha Atas', '14000', '14000', '1', '2023-07-19 09:40:05', '2023-07-19 09:40:05'),
(6, 5, 6, 'Paha Atas', '12000', '12000', '1', '2023-07-19 13:28:09', '2023-07-19 13:28:09'),
(7, 6, 13, 'Geprek Paha Atas', '14000', '14000', '1', '2023-07-19 13:45:09', '2023-07-19 13:45:09'),
(8, 7, 6, 'Paha Atas', '12000', '12000', '1', '2023-07-19 13:47:58', '2023-07-19 13:47:58'),
(9, 8, 6, 'Paha Atas', '12000', '12000', '1', '2023-07-19 13:54:06', '2023-07-19 13:54:06'),
(10, 9, 6, 'Paha Atas', '12000', '12000', '1', '2023-07-20 05:29:41', '2023-07-20 05:29:41'),
(11, 10, 6, 'Paha Atas', '12000', '12000', '1', '2023-07-20 10:46:38', '2023-07-20 10:46:38'),
(12, 11, 14, 'Geprek Paha Bawah', '14000', '14000', '1', '2023-07-20 10:49:26', '2023-07-20 10:49:26'),
(13, 12, 13, 'Geprek Paha Atas', '14000', '14000', '1', '2023-07-20 11:16:10', '2023-07-20 11:16:10'),
(14, 13, 6, 'Paha Atas', '12000', '24000', '2', '2023-07-20 14:30:35', '2023-07-20 14:30:35'),
(15, 14, 13, 'Geprek Paha Atas', '14000', '14000', '1', '2023-07-21 00:50:49', '2023-07-21 00:50:49'),
(16, 15, 6, 'Paha Atas', '12000', '12000', '1', '2023-07-21 03:49:52', '2023-07-21 03:49:52'),
(17, 15, 7, 'Paha Bawah', '12000', '24000', '2', '2023-07-21 03:49:52', '2023-07-21 03:49:52'),
(18, 16, 14, 'Geprek Paha Bawah', '14000', '14000', '1', '2023-07-24 07:08:44', '2023-07-24 07:08:44'),
(19, 17, 6, 'Paha Atas', '12000', '12000', '1', '2023-07-24 12:42:42', '2023-07-24 12:42:42'),
(20, 18, 6, 'Paha Atas', '12000', '24000', '2', '2023-08-04 01:51:22', '2023-08-04 01:51:22'),
(21, 19, 7, 'Paha Bawah', '12000', '12000', '1', '2023-08-18 08:49:42', '2023-08-18 08:49:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `idpengguna` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nohp` varchar(255) NOT NULL,
  `level` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`idpengguna`, `nama`, `email`, `password`, `nohp`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', 'admin', '0892313141', 'Super Admin', '2023-05-22 13:00:38', '2023-07-03 11:25:19'),
(4, 'Hasbi', 'owner@gmail.com', 'owner', '085921859125', 'Pemilik Toko', '2023-06-16 14:00:41', '2023-07-03 11:25:32'),
(5, 'husen', 'pegawai@gmail.com', 'pegawai', '085928195125', 'Pegawai', '2023-06-16 14:00:59', '2023-06-16 14:00:59'),
(7, 'Sugeng', 'sugeng@gmail.com', 'sugeng', '08951829512', 'Pembeli', '2023-07-03 11:16:53', '2023-07-03 11:17:43'),
(8, 'jaya', 'jaya@gmail.com', 'jaya', '089922334455', 'Pembeli', '2023-07-19 04:14:09', '2023-07-19 04:14:09'),
(9, 'Ilham', 'ilham@gmail.com', 'ilham', '08993355667788', 'Pembeli', '2023-07-20 11:15:11', '2023-07-20 11:15:11'),
(10, 'udin', 'udin@gmail.com', 'udin', '088999789', 'Pembeli', '2023-07-21 03:45:24', '2023-07-21 03:45:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) UNSIGNED NOT NULL,
  `id_kategori` int(11) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` varchar(255) NOT NULL,
  `stok_produk` varchar(255) NOT NULL,
  `deskripsi_produk` varchar(255) NOT NULL,
  `foto_produk` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `stok_produk`, `deskripsi_produk`, `foto_produk`, `created_at`, `updated_at`) VALUES
(6, 4, 'Paha Atas', '12000', '99', 'Fried Chicken Paha Atas', '1687187886_d8391310b79a26cdef95.png', '2023-05-19 14:34:37', '2023-06-19 15:18:06'),
(7, 4, 'Paha Bawah', '12000', '100', 'Fried Chicken Paha Bawah', '1687187915_a539caf94432e6fdba3c.png', '2023-05-19 14:35:44', '2023-06-19 15:18:35'),
(8, 6, 'Sayap', '1200', '100', 'Fried Chicken Sayap', '1687187956_9d75d1ba3ec69e1452e0.png', '2023-05-19 14:36:07', '2023-06-19 15:19:16'),
(9, 5, 'Dada', '12000', '100', 'Fried Chicken Dada', '1687187990_f3f281009c666c8821c7.png', '2023-05-22 05:12:55', '2023-06-19 15:19:50'),
(13, 4, 'Geprek Paha Atas', '14000', '73', 'Ayam Geprek Paha Atas', '1687188042_846fd5d001331f1d42ac.png', '2023-06-19 15:20:42', '2023-06-19 15:20:42'),
(14, 4, 'Geprek Paha Bawah', '14000', '74', 'Ayam Geprek Paha Bawah', '1687188083_07cc490fad466da70566.png', '2023-06-19 15:21:23', '2023-06-19 15:21:23'),
(15, 6, 'Geprek Sayap', '14000', '75', 'Ayam Geprek Sayap', '1687188121_af427383dae96cd14710.png', '2023-06-19 15:22:01', '2023-06-19 15:22:01'),
(16, 5, 'Geprek Dada', '14000', '75', 'Ayam Geprek Dada', '1687188154_c669a4cec0bb2f056975.png', '2023-06-19 15:22:34', '2023-06-19 15:22:34'),
(17, 7, 'Nasi', '3000', '300', 'Nasi Putih', '1687188205_4140b163a0ddadabf128.png', '2023-06-19 15:23:25', '2023-06-19 15:23:25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahanbaku`
--
ALTER TABLE `bahanbaku`
  ADD PRIMARY KEY (`idbahanbaku`);

--
-- Indeks untuk tabel `bahanbakupembelian`
--
ALTER TABLE `bahanbakupembelian`
  ADD PRIMARY KEY (`idbahanbakupembelian`),
  ADD KEY `idbahanbaku` (`idbahanbaku`);

--
-- Indeks untuk tabel `bahanbakupenggunaan`
--
ALTER TABLE `bahanbakupenggunaan`
  ADD PRIMARY KEY (`idbahanbakupenggunaan`),
  ADD KEY `idbahanbaku` (`idbahanbaku`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `idbeli` (`idbeli`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`idbeli`);

--
-- Indeks untuk tabel `pembelianproduk`
--
ALTER TABLE `pembelianproduk`
  ADD PRIMARY KEY (`idbeli_produk`),
  ADD KEY `idbeli` (`idbeli`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`idpengguna`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `produk_id_kategori_foreign` (`id_kategori`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bahanbaku`
--
ALTER TABLE `bahanbaku`
  MODIFY `idbahanbaku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `bahanbakupembelian`
--
ALTER TABLE `bahanbakupembelian`
  MODIFY `idbahanbakupembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `bahanbakupenggunaan`
--
ALTER TABLE `bahanbakupenggunaan`
  MODIFY `idbahanbakupenggunaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `idbeli` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `pembelianproduk`
--
ALTER TABLE `pembelianproduk`
  MODIFY `idbeli_produk` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `idpengguna` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bahanbakupembelian`
--
ALTER TABLE `bahanbakupembelian`
  ADD CONSTRAINT `bahanbakupembelian_ibfk_1` FOREIGN KEY (`idbahanbaku`) REFERENCES `bahanbaku` (`idbahanbaku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bahanbakupenggunaan`
--
ALTER TABLE `bahanbakupenggunaan`
  ADD CONSTRAINT `bahanbakupenggunaan_ibfk_1` FOREIGN KEY (`idbahanbaku`) REFERENCES `bahanbaku` (`idbahanbaku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`idbeli`) REFERENCES `pembelian` (`idbeli`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembelianproduk`
--
ALTER TABLE `pembelianproduk`
  ADD CONSTRAINT `pembelianproduk_ibfk_1` FOREIGN KEY (`idbeli`) REFERENCES `pembelian` (`idbeli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelianproduk_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
