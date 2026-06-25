-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jun 2026 pada 17.39
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marastar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `nama_kategori`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Boxy 20s', 'boxy-20s', '2026-06-20 05:55:19', '2026-06-20 05:55:19'),
(3, 'Fitted tee', 'fitted-tee', '2026-06-20 06:02:11', '2026-06-20 06:02:23'),
(4, 'Oversize 20s', 'oversize-20s', '2026-06-20 06:02:38', '2026-06-20 06:02:38'),
(6, 'Hoodie', 'hoodie', '2026-06-25 06:41:06', '2026-06-25 06:41:06'),
(7, 'Hoodie Boxy', 'hoodie-boxy', '2026-06-25 06:41:23', '2026-06-25 06:41:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

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
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_20_120834_create_categories_table', 2),
(5, '2026_06_20_121120_create_products_table', 2),
(6, '2026_06_20_121209_create_product_images_table', 2),
(7, '2026_06_20_121244_create_sizes_table', 2),
(8, '2026_06_20_122014_create_product_sizes_table', 2),
(9, '2026_06_20_132015_create_personal_access_tokens_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(12,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `category_id`, `nama_produk`, `slug`, `deskripsi`, `harga`, `status`, `created_at`, `updated_at`) VALUES
(8, 1, 'Boxy Fit Black 20s', 'boxy-fit-20s', 'Cotton Combed 20s', 119000.00, 1, '2026-06-23 06:48:50', '2026-06-23 06:48:50'),
(9, 3, 'Fitted Tee Black 20s', 'fitted-tee-20s', 'Cotton Combed 20s', 89000.00, 1, '2026-06-23 06:50:11', '2026-06-23 06:50:11'),
(10, 4, 'Oversize Boxy Grey 20s', 'oversize-boxy-20s', 'Cotton Combed 20s', 145999.00, 1, '2026-06-23 06:52:31', '2026-06-23 06:52:31'),
(11, 4, 'Oversize Boxy Blue 20s', 'oversize-boxy-blue', 'Cotton Combed 20s', 120000.00, 1, '2026-06-23 08:46:15', '2026-06-23 08:46:15'),
(12, 3, 'Fitted Tee Red 20s', 'fitted-tee-red', 'Cotton Combed 20s', 99000.00, 1, '2026-06-23 08:47:20', '2026-06-23 08:47:20'),
(13, 1, 'Boxy Fit Green 20s', 'boxy-fit-green', 'Cotton Combed 20s', 111000.00, 1, '2026-06-23 08:49:51', '2026-06-23 08:49:51'),
(14, 1, 'Boxy Fit White 20s', 'boxy-fit-white', 'Cotton Combed 20s', 111000.00, 1, '2026-06-23 08:51:22', '2026-06-23 08:51:22'),
(15, 1, 'Boxy Fit Cream 20s', 'boxy-fit-cream', 'Cotton Combed 20s', 105000.00, 1, '2026-06-23 08:52:28', '2026-06-23 08:52:28'),
(16, 1, 'Boxy Fit Soft Blue 20s', 'boxy-fit-soft-blue', 'Cotton Combed 20s', 111000.00, 1, '2026-06-23 08:53:20', '2026-06-23 08:53:20'),
(17, 4, 'Oversize Boxy Purple 20s', 'oversize-purple-20s', 'Cotton Combed 20s', 120000.00, 1, '2026-06-23 08:55:06', '2026-06-23 08:55:06'),
(19, 4, 'Oversize Boxy Soft Blue 20s', 'oversize-boxy-soft-blue', 'Cotton Combed 20s', 109000.00, 1, '2026-06-23 09:00:07', '2026-06-23 09:00:07'),
(20, 3, 'Fitted Tee White 20s', 'fitted-tee-white', 'Cotton Combed 20s', 99000.00, 1, '2026-06-23 09:01:42', '2026-06-23 09:01:42'),
(21, 3, 'Fitted Tee Light Gray 20s', 'fitted-tee-light-gray', 'Cotten Combed 20s', 100000.00, 1, '2026-06-23 09:02:59', '2026-06-23 09:02:59'),
(22, 7, 'Hoodie Boxy Black', 'hoodie-boxy-black', '300 Gsm', 179000.00, 1, '2026-06-25 06:42:48', '2026-06-25 06:42:48'),
(23, 7, 'Hoodie Boxy Pink', 'hoodie-boxy-pink', '300 Gsm', 179000.00, 1, '2026-06-25 06:43:45', '2026-06-25 06:43:45'),
(24, 7, 'Hoodie Boxy Denim', 'hoodie-boxy-denim', '300 Gsm', 179000.00, 1, '2026-06-25 06:44:44', '2026-06-25 06:44:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_url`, `created_at`, `updated_at`) VALUES
(9, 8, 'products/2Ifbe19hetCrf0cW7Zsj51OchJDnmH516QI9LPDO.webp', '2026-06-23 06:48:51', '2026-06-23 06:48:51'),
(10, 9, 'products/tgrEfLAuPfIywD75o21MXbmtxJB4C699OXQ2SJXF.webp', '2026-06-23 06:50:11', '2026-06-23 06:50:11'),
(11, 10, 'products/qVt0tS4bkyJT9W9yU9bSxDrcYBdQEJ0Xg7aWDcYe.webp', '2026-06-23 06:52:31', '2026-06-23 06:52:31'),
(12, 12, 'products/IGeKZyJ4hLLJYb4Q5nd7ZELksRBOJR0yUHF5hGSB.webp', '2026-06-23 08:47:20', '2026-06-23 08:47:20'),
(13, 11, 'products/YOHrm9qWCjaqxWJyWILx1YoPDWdQp3MnzOkYsFhY.webp', '2026-06-23 08:47:48', '2026-06-23 08:47:48'),
(14, 13, 'products/DxRBdJAvIXtvx9gqOV1OCgbGmlTtmQh45LEok4uV.webp', '2026-06-23 08:49:51', '2026-06-23 08:49:51'),
(15, 14, 'products/eVQY2VHUbdxL86VkG0qUrJHs5XeXRToz3xcCLnuV.webp', '2026-06-23 08:51:22', '2026-06-23 08:51:22'),
(16, 15, 'products/oHhoxrab28IKMmVjrNDM3ZlpI4o5lYjsOzCQhNdw.webp', '2026-06-23 08:52:28', '2026-06-23 08:52:28'),
(17, 16, 'products/tJxoi089ceNk47jvpVEGj4KpqpGKoGZbLOS4T2QR.webp', '2026-06-23 08:53:20', '2026-06-23 08:53:20'),
(18, 17, 'products/fLfLB4LbQJYVeN0Y90ccQon5wvqY8jlSWsXwHsop.webp', '2026-06-23 08:55:06', '2026-06-23 08:55:06'),
(20, 19, 'products/DwofYHW1q4fbOE98TTmGDwc2jQfLPXzYt7nU5fbm.webp', '2026-06-23 09:00:07', '2026-06-23 09:00:07'),
(21, 20, 'products/DkEmTECxjuXRjvCJgZRmbneDAnJZcJu10oIDoC6k.webp', '2026-06-23 09:01:42', '2026-06-23 09:01:42'),
(22, 21, 'products/1gxpBlYMS4fodgmKK0f5diWw6hdYCgZpXZLcApTd.webp', '2026-06-23 09:02:59', '2026-06-23 09:02:59'),
(23, 22, 'products/cYqWb4c6hwTtiWO82RuNqbTltUptuV8K2lXSwlKn.webp', '2026-06-25 06:42:49', '2026-06-25 06:42:49'),
(24, 23, 'products/qMTIExKsPg4yGvNNdQL4hADolzDUwm28yDjt42DF.webp', '2026-06-25 06:43:46', '2026-06-25 06:43:46'),
(25, 24, 'products/vQBFfOg9aswZsNvQb3oE5KrTsqQSXOlrw0qTfTe3.webp', '2026-06-25 06:44:44', '2026-06-25 06:44:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size_id`, `stok`, `created_at`, `updated_at`) VALUES
(13, 8, 1, 39, '2026-06-23 06:48:51', '2026-06-23 06:48:51'),
(14, 8, 2, 25, '2026-06-23 06:48:51', '2026-06-23 06:48:51'),
(15, 8, 3, 45, '2026-06-23 06:48:51', '2026-06-23 06:48:51'),
(16, 9, 1, 11, '2026-06-23 06:50:11', '2026-06-23 06:50:11'),
(17, 9, 2, 43, '2026-06-23 06:50:11', '2026-06-23 06:50:11'),
(18, 9, 3, 54, '2026-06-23 06:50:11', '2026-06-23 06:50:11'),
(19, 10, 1, 7, '2026-06-23 06:52:31', '2026-06-23 06:52:31'),
(20, 10, 2, 14, '2026-06-23 06:52:31', '2026-06-23 06:52:31'),
(21, 10, 3, 3, '2026-06-23 06:52:31', '2026-06-23 06:52:31'),
(22, 11, 1, 78, '2026-06-23 08:46:15', '2026-06-23 08:47:48'),
(23, 11, 2, 45, '2026-06-23 08:46:15', '2026-06-23 08:47:48'),
(24, 11, 3, 65, '2026-06-23 08:46:15', '2026-06-23 08:47:48'),
(25, 12, 1, 87, '2026-06-23 08:47:20', '2026-06-23 08:47:20'),
(26, 12, 2, 21, '2026-06-23 08:47:20', '2026-06-23 08:47:20'),
(27, 12, 3, 32, '2026-06-23 08:47:20', '2026-06-23 08:47:20'),
(28, 13, 1, 9, '2026-06-23 08:49:51', '2026-06-23 08:49:51'),
(29, 13, 2, 12, '2026-06-23 08:49:51', '2026-06-23 08:49:51'),
(30, 13, 3, 54, '2026-06-23 08:49:51', '2026-06-23 08:49:51'),
(31, 14, 1, 2, '2026-06-23 08:51:22', '2026-06-23 08:51:22'),
(32, 14, 2, 32, '2026-06-23 08:51:22', '2026-06-23 08:51:22'),
(33, 14, 3, 13, '2026-06-23 08:51:22', '2026-06-23 08:51:22'),
(34, 15, 1, 24, '2026-06-23 08:52:28', '2026-06-23 08:52:28'),
(35, 15, 2, 44, '2026-06-23 08:52:28', '2026-06-23 08:52:28'),
(36, 15, 3, 62, '2026-06-23 08:52:28', '2026-06-23 08:52:28'),
(37, 16, 1, 32, '2026-06-23 08:53:20', '2026-06-23 08:53:20'),
(38, 16, 2, 10, '2026-06-23 08:53:20', '2026-06-23 08:53:20'),
(39, 16, 3, 28, '2026-06-23 08:53:20', '2026-06-23 08:53:20'),
(40, 17, 1, 89, '2026-06-23 08:55:06', '2026-06-23 08:55:06'),
(41, 17, 2, 54, '2026-06-23 08:55:06', '2026-06-23 08:55:06'),
(42, 17, 3, 9, '2026-06-23 08:55:06', '2026-06-23 08:55:06'),
(46, 19, 1, 89, '2026-06-23 09:00:07', '2026-06-23 09:00:07'),
(47, 19, 2, 4, '2026-06-23 09:00:07', '2026-06-23 09:00:07'),
(48, 19, 3, 32, '2026-06-23 09:00:07', '2026-06-23 09:00:07'),
(49, 20, 1, 78, '2026-06-23 09:01:42', '2026-06-23 09:01:42'),
(50, 20, 2, 45, '2026-06-23 09:01:42', '2026-06-23 09:01:42'),
(51, 20, 3, 55, '2026-06-23 09:01:42', '2026-06-23 09:01:42'),
(52, 21, 1, 34, '2026-06-23 09:02:59', '2026-06-24 05:26:41'),
(53, 21, 2, 17, '2026-06-23 09:02:59', '2026-06-24 05:26:41'),
(55, 22, 1, 21, '2026-06-25 06:42:49', '2026-06-25 06:42:49'),
(56, 22, 2, 43, '2026-06-25 06:42:49', '2026-06-25 06:42:49'),
(57, 22, 3, 21, '2026-06-25 06:42:49', '2026-06-25 06:42:49'),
(58, 23, 1, 2, '2026-06-25 06:43:46', '2026-06-25 06:43:46'),
(59, 23, 2, 32, '2026-06-25 06:43:46', '2026-06-25 06:43:46'),
(60, 23, 3, 20, '2026-06-25 06:43:46', '2026-06-25 06:43:46'),
(61, 24, 1, 23, '2026-06-25 06:44:44', '2026-06-25 06:44:44'),
(62, 24, 2, 12, '2026-06-25 06:44:44', '2026-06-25 06:44:44'),
(63, 24, 3, 3, '2026-06-25 06:44:44', '2026-06-25 06:44:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('v88Cdmi1spHHVzgZw4JBybzzDcOwUkfgTCQlJYaG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWDhuUkhzOVRvaVRPaXlZaG9PaWVGak5VY3ZOTVpmcUNGWVBLbHNBSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7czo1OiJyb3V0ZSI7czoxNDoicHJvZHVjdHMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1782395384);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_ukuran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sizes`
--

INSERT INTO `sizes` (`id`, `nama_ukuran`, `created_at`, `updated_at`) VALUES
(1, 'M', '2026-06-20 05:54:27', '2026-06-20 05:54:27'),
(2, 'L', '2026-06-20 05:54:49', '2026-06-20 05:54:49'),
(3, 'XL', '2026-06-20 05:54:58', '2026-06-20 05:54:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_sizes_product_id_foreign` (`product_id`),
  ADD KEY `product_sizes_size_id_foreign` (`size_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_sizes_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
