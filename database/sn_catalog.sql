-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 03, 2021 at 02:54 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sn_catalog`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `date` date NOT NULL,
  `start` time DEFAULT NULL,
  `finish` time DEFAULT NULL,
  `branch_id` int(5) NOT NULL,
  `working_hours` time DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `attendance_info_id` int(5) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `date`, `start`, `finish`, `branch_id`, `working_hours`, `images`, `attendance_info_id`, `updated_at`, `created_at`) VALUES
(3, 1, '2021-11-10', '08:28:27', '20:29:04', 2, '12:00:37', NULL, 2, '2021-11-10 20:29:04', '2021-11-10 08:28:27'),
(4, 1, '2021-11-11', '13:30:23', '21:31:01', 2, '08:00:38', NULL, 3, '2021-11-11 21:31:01', '2021-11-11 13:30:23'),
(5, 1, '2021-11-12', '14:32:10', '21:32:40', 1, '07:00:30', NULL, 4, '2021-11-12 21:32:40', '2021-11-12 14:32:10'),
(6, 1, '2021-11-13', '07:34:32', '16:35:59', 2, '09:01:27', NULL, 2, '2021-11-13 16:35:59', '2021-11-13 07:34:32'),
(7, 1, '2021-11-14', '06:35:07', '16:35:28', 4, '10:00:21', NULL, 1, '2021-11-14 16:35:28', '2021-11-14 06:35:07'),
(8, 2, '2021-11-16', '00:55:35', '08:56:23', 2, '08:00:48', NULL, 1, '2021-11-16 08:56:23', '2021-11-16 00:55:35'),
(9, 1, '2021-11-29', '11:28:21', '11:28:50', 4, '00:00:29', NULL, 2, '2021-11-29 11:28:50', '2021-11-29 11:28:21'),
(10, 1, '2021-11-30', '12:36:22', '22:51:54', 1, '10:15:32', NULL, 3, '2021-11-30 22:51:54', '2021-11-30 12:36:22');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_info`
--

CREATE TABLE `attendance_info` (
  `id` int(5) NOT NULL,
  `desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance_info`
--

INSERT INTO `attendance_info` (`id`, `desc`) VALUES
(1, 'Pagi - Tepat Waktu'),
(2, 'Pagi - Terlambat'),
(3, 'Sore - Tepat Waktu'),
(4, 'Sore - Terlambat');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(5) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `alamat`) VALUES
(1, 'SN - Berawa', 'Jl. Pantai Berawa'),
(2, 'SN - Kerobokan', 'Br. Anyar'),
(3, 'SN - Muding', 'Jl. Raya Muding\n'),
(4, 'SN - Padang Bali', 'Jl. Padang Bali'),
(5, 'SN - Surya Bhuana', 'Jl. Surya Bhuana');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(5) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `ProsentaseSales` double(5,2) DEFAULT NULL,
  `UpHargaPokok` double(5,2) DEFAULT NULL,
  `UpHargaJual` double(5,2) DEFAULT NULL,
  `Nourut` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `ProsentaseSales`, `UpHargaPokok`, `UpHargaJual`, `Nourut`) VALUES
(1, 'ALAT TUKANG', 5.00, 10.00, 40.00, 1),
(2, 'BAHAN BANGUNAN', 1.00, 5.00, 20.00, 2),
(3, 'CAT', 1.00, 5.00, 20.00, 3),
(4, 'LISTRIK', 1.00, 5.00, 20.00, 4),
(5, 'MATERIAL', 1.00, 5.00, 20.00, 5),
(6, 'OBAT', 1.00, 5.00, 20.00, 6),
(7, 'PIPA', 1.00, 5.00, 20.00, 7),
(8, 'PLASTIK', 1.00, 5.00, 20.00, 8),
(9, 'SANITARI', 1.00, 5.00, 20.00, 9),
(10, 'PENGERAS SEMEN', 1.00, 1.00, 1.00, 1),
(11, 'AMPLAS', 1.00, 1.00, 1.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeBarang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NamaBarang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NamaCetak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdSatuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_10_17_150255_create_roles_table', 1),
(5, '2021_10_21_141636_create_barangs_table', 1),
(6, '2021_10_21_141915_create_categories_table', 1),
(7, '2021_10_21_142003_create_sub_categories_table', 1),
(8, '2021_10_21_150138_create_satuans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2021-11-02 21:14:22', '2021-11-03 05:14:24'),
(2, 'sales', '2021-11-03 05:14:33', '2021-11-03 05:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` int(5) NOT NULL,
  `desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `desc`) VALUES
(1, 'pagi'),
(2, 'sore'),
(3, 'nyambung');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(5) DEFAULT NULL,
  `category_id` int(5) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`) VALUES
(1, 1, 'ALAT TEMBAK'),
(2, 1, 'BAK CAT'),
(3, 1, 'BATU GOSOK'),
(4, 1, 'BATU POTONG'),
(6, 1, 'BENANG'),
(7, 1, 'BETEL'),
(9, 1, 'BOR'),
(10, 1, 'CABUTAN PAKU'),
(13, 1, 'CANGKUL'),
(15, 1, 'CAPIL'),
(16, 1, 'CETOK  IIT'),
(17, 1, 'CETOK GG KARET'),
(18, 1, 'CETOK GG KAYU'),
(19, 1, 'CUTTER '),
(20, 1, 'EMBER'),
(21, 1, 'FLISER'),
(22, 1, 'GAGANG'),
(23, 1, 'GERGAJI'),
(24, 1, 'GEROBAK'),
(28, 1, 'GUNTING'),
(29, 1, 'HELM 001'),
(30, 1, 'KACA 001'),
(33, 1, 'KAPAK '),
(34, 1, 'KAPI '),
(35, 1, 'KASUT '),
(37, 1, 'KEREK '),
(38, 1, 'KIKIR '),
(39, 1, 'KUAS '),
(40, 1, 'LAP '),
(41, 1, 'LINGGIS '),
(42, 1, 'LOT TUKANG'),
(43, 1, 'MASKER '),
(44, 1, 'MATA POTONG'),
(45, 1, 'METERAN '),
(46, 1, 'OBENG '),
(47, 1, 'OMP '),
(49, 1, 'PAHAT '),
(50, 1, 'PALU'),
(51, 1, 'PANYONG '),
(52, 1, 'PATIL '),
(53, 1, 'PENSIL '),
(54, 1, 'PISAU'),
(55, 1, 'RANTAI '),
(56, 1, 'RODA '),
(57, 1, 'SABIT '),
(61, 1, 'SAPU LIDI '),
(63, 1, 'SELERAN'),
(64, 1, 'SEMPROTAN AIR'),
(67, 1, 'SEPATU'),
(68, 1, 'SEROK '),
(69, 1, 'SERUT'),
(71, 1, 'SIDI'),
(73, 1, 'SIKAT'),
(74, 1, 'SIKU TUKANG'),
(77, 1, 'SKOP'),
(78, 1, 'SPIDOL '),
(79, 1, 'SPON'),
(80, 1, 'STANG GERGAJI'),
(81, 1, 'TABUNG'),
(82, 1, 'TALI KEREK'),
(84, 1, 'TALI RAFIA'),
(85, 1, 'TALI TAMPAR'),
(86, 1, 'TANG KAKAK TUA'),
(88, 1, 'TANG KOMBINASI'),
(90, 1, 'TANG LANCIP'),
(91, 1, 'TANG POTONG'),
(92, 1, 'TEMPAT SAMPAH'),
(93, 1, 'TIKUS'),
(94, 1, 'WATER PASS'),
(95, 2, 'AMPLAS'),
(97, 2, 'ASBES'),
(98, 2, 'ATAP PLASTIK'),
(99, 2, 'BAK SAMPAH DRUM'),
(100, 2, 'DINABOL'),
(102, 2, 'DOORSTOP'),
(103, 2, 'FISHER'),
(104, 2, 'GENTENG'),
(105, 2, 'GENTONG'),
(106, 2, 'GLASS BLOK'),
(107, 2, 'GYPSUM'),
(110, 2, 'HCL '),
(112, 2, 'KAIN'),
(113, 2, 'KALUNG'),
(115, 2, 'KAWAT '),
(116, 2, 'KAYU'),
(117, 2, 'KORNIS '),
(118, 2, 'LEM '),
(119, 2, 'LOSTER '),
(120, 2, 'MATERIAL'),
(122, 2, 'PAKU '),
(125, 2, 'SEKRUP'),
(126, 2, 'SEMEN'),
(127, 2, 'SIKU LUBANG'),
(129, 2, 'SIKU RAK'),
(130, 2, 'SN GROUT'),
(131, 2, 'SODA API'),
(132, 2, 'SPRITUS'),
(134, 2, 'TALANG'),
(135, 2, 'TIANG BETON'),
(138, 2, 'TINER'),
(139, 2, 'TOWER '),
(140, 2, 'VERNIS'),
(141, 2, 'WATER PROOFING'),
(142, 3, 'CAT GENTENG'),
(144, 3, 'CAT KAYU'),
(147, 3, 'CAT SENG '),
(149, 3, 'CAT TEMBOK '),
(150, 3, 'CATBESI/KAYU'),
(151, 3, 'DEMPUL'),
(152, 3, 'IMPRA'),
(155, 3, 'MENI BESI '),
(156, 3, 'MENI KAYU '),
(157, 3, 'PILOK '),
(159, 3, 'PLAMIR KAYU '),
(160, 3, 'PLAMIR TEMBOK '),
(161, 3, 'REMOVER '),
(162, 3, 'ULTRAN '),
(166, 4, 'ANTENA '),
(167, 4, 'BATERI '),
(168, 4, 'FITING '),
(169, 4, 'ISOLASI '),
(170, 4, 'KABEL'),
(172, 4, 'KARBON BRUSH'),
(174, 4, 'KLEM KABEL'),
(178, 4, 'LAMPU '),
(179, 4, 'MCB '),
(180, 4, 'REGULATOR '),
(181, 4, 'SAKLAR '),
(183, 4, 'SELANG GAS'),
(184, 4, 'STOP KONTAK'),
(185, 4, 'T DUS '),
(188, 5, 'BAMBU'),
(189, 5, 'BATU'),
(190, 5, 'BAUT '),
(191, 5, 'BESI'),
(193, 5, 'CLOSET '),
(194, 5, 'CORONG'),
(195, 6, 'ANTI LUMUT'),
(196, 6, 'ANTI RAYAP'),
(197, 6, 'ANTI SUMBAT'),
(198, 6, 'BIO'),
(199, 6, 'MINYAK'),
(200, 6, 'TIKUS'),
(202, 7, 'ALAT PIPA'),
(211, 7, 'KLEM PIPA'),
(213, 7, 'PIPA '),
(214, 8, 'BAK MANDI'),
(215, 8, 'JIRIGEN'),
(217, 8, 'KARPET PLASTIK'),
(218, 8, 'KERANJANG PLASTIK'),
(219, 8, 'KLEM SELANG'),
(222, 8, 'PLASTIK MIKA'),
(223, 8, 'POT BUNGA'),
(224, 8, 'SAMBUNGAN SELANG'),
(225, 8, 'SAPU '),
(226, 8, 'SELANG AIR'),
(227, 8, 'SERAT'),
(231, 8, 'SPRAYER '),
(232, 8, 'SUMPEL'),
(233, 8, 'TERPAL '),
(235, 9, 'BAK CUCI PIRING'),
(236, 9, 'BALL VALVE'),
(238, 9, 'CHEK  VALVE'),
(239, 9, 'ENGSEL'),
(242, 9, 'FOOT VALVE'),
(244, 9, 'GATE VALVE'),
(245, 9, 'GEMBOK'),
(246, 9, 'GRENDEL'),
(247, 9, 'HAK ANGIN '),
(248, 9, 'HAND SHOWER'),
(249, 9, 'HANDLE '),
(251, 9, 'KRAN '),
(252, 9, 'KUNCI '),
(253, 9, 'OVERVAL'),
(255, 9, 'REL  PINTU'),
(256, 9, 'REL LACI'),
(257, 9, 'SARINGAN GOT'),
(258, 9, 'SARINGAN TANGAN'),
(259, 9, 'SEAL TAPE '),
(260, 9, 'SELANG FLEXIBEL'),
(261, 9, 'SHOWER BIDET'),
(262, 9, 'SIFON'),
(263, 9, 'SPRING KNIFE'),
(264, 9, 'TARIKAN LACI'),
(265, 9, 'TEMPAT SABUN'),
(266, 1, 'TIMBANGAN'),
(267, 9, 'CLOSET'),
(268, 4, 'STIKER'),
(269, 2, 'TRIPLEK'),
(270, 1, 'KUNCI INGGRIS'),
(271, 9, 'AFUR'),
(272, 9, 'SPRINGKLE'),
(273, 5, 'PASIR'),
(274, 9, 'KALUNG ANJING'),
(276, 1, 'KALUNG ANJING'),
(277, 4, 'PELAMPUNG RADAR'),
(278, 8, 'TALANG KARET'),
(279, 2, 'BAUT'),
(280, 8, 'PINTU'),
(281, 8, 'KEMOCENG/SAPU BULU'),
(282, 4, 'PENANGKAL PETIR'),
(283, 1, 'TANGGA'),
(284, 9, 'PELAMPUNG'),
(285, 8, 'POT BUNGA'),
(286, 8, 'JAS HUJAN'),
(287, 8, 'PAYUNG'),
(288, 8, 'KESET'),
(289, 8, 'SIKAT'),
(290, 1, 'POMPA'),
(291, 1, 'SIKU TUKANG'),
(292, 10, 'ADDITON'),
(293, 10, 'ADDIBON'),
(294, 11, 'AMPLAS ROL'),
(295, 11, 'AMPLAS AIR'),
(296, 11, 'AMPLAS BESI'),
(297, 11, 'AMPLAS BULAT'),
(298, 11, 'AMPLAS SUSUN'),
(299, 8, 'PLASTIK SAMPAH'),
(300, 5, 'PAVING'),
(301, 5, 'BIS');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(5) UNSIGNED NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 1, 'admin@email.com', NULL, '$2y$10$B2jZXsmc3MSdtXHVTLzxheVYXzkpnR0YnQvO.tvKxJtxN6RXRObFe', NULL, '2021-11-02 21:21:35', '2021-11-02 21:21:35'),
(2, 'Buchik', 'Buchik', 2, 'buchikadhipratama@gmail.com', NULL, '$2y$10$WNDonfSiw/Dni/4wwlhXiOObb9fpdH/QeBbAoRaXfnrO7fmy4rLcu', NULL, '2021-11-15 16:55:02', '2021-11-15 16:55:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_info`
--
ALTER TABLE `attendance_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `attendance_info`
--
ALTER TABLE `attendance_info`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
