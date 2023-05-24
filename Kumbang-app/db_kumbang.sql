-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Bulan Mei 2023 pada 14.32
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kumbang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'user', 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 8),
(2, 7),
(2, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'root', NULL, '2023-05-20 08:29:36', 0),
(2, '::1', '087789298969', NULL, '2023-05-20 08:31:07', 0),
(3, '::1', '087789298969', NULL, '2023-05-20 08:31:33', 0),
(4, '::1', 'root', NULL, '2023-05-20 08:31:40', 0),
(5, '::1', 'root', NULL, '2023-05-20 08:31:44', 0),
(6, '::1', '087789298969', NULL, '2023-05-20 08:32:01', 0),
(7, '::1', '087789298969', NULL, '2023-05-20 08:34:23', 0),
(8, '::1', 'devel', NULL, '2023-05-20 08:34:26', 0),
(9, '::1', 'devel', NULL, '2023-05-20 08:34:31', 0),
(10, '::1', 'devel', NULL, '2023-05-20 08:35:52', 0),
(11, '::1', 'devel', NULL, '2023-05-20 08:36:37', 0),
(12, '::1', 'root', NULL, '2023-05-20 08:36:39', 0),
(13, '::1', 'hasanmarzaq87@gmail.com', 2, '2023-05-20 08:44:01', 1),
(14, '::1', 'hasanmarzaq87@gmail.com', 2, '2023-05-20 08:57:43', 1),
(15, '::1', '08778834328432', NULL, '2023-05-21 12:05:04', 0),
(16, '::1', '089506754061', NULL, '2023-05-24 12:21:28', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, '2023-05-06-130849', 'App\\Database\\Migrations\\Sarana', 'default', 'App', 1684127156, 1),
(2, '2023-05-07-063421', 'App\\Database\\Migrations\\Pengajuan', 'default', 'App', 1684127156, 1),
(3, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1684562034, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `penanggung_jawab` varchar(50) DEFAULT NULL,
  `orang_terlibat` varchar(255) NOT NULL,
  `hari_tanggal` date NOT NULL,
  `waktu_awal` time NOT NULL,
  `waktu_akhir` time NOT NULL,
  `Tempat_yang_dipakai` enum('Ruang Spare Room 1','Ruang Spare Room 2','Atrium SD','Kelas X.1','Kelas X.2','Kelas X.3','Kelas X.4','Kelas X.5','Kelas X.6','Kelas X.7','Kelas XI.1','Kelas XI.2','Kelas XI.3','Kelas XI.4','Kelas XI.5','Kelas XI.6','Kelas XI.7','Kelas XII.1','Kelas XII.2','Kelas XII.3','Kelas XII.4','Kelas XII.5','Kelas XII.6','Kelas XII.7','Teater','Ruang OSIS/Wakasis','Ruang Laboratorium','Laboratorium Kimia','Laboratorium Fisika','Laboratorium Komputer','Laboratorium Biologi','Laboratorium Bahasa','Ruang Tamu','IT, Multimedia & Marketing','Ruang UKS','Ruang Yayasan','Ruang Guru','Ruang Kepsek','Ruang Wakakur','Ruang Wakasar','Ruang Serbaguna SMA','Ruang Kuliner','Ruang Musik','Perpustakaan','Kantin','Lapangan Badminton','Lapangan Tenis Meja','Kolam Renang','Lapangan Basket','Lapangan Voli','Lapangan Tenis','Lapangan Senam','Lapangan Futsal') DEFAULT NULL,
  `peralatan` varchar(255) NOT NULL,
  `kegunaan` varchar(255) NOT NULL,
  `status` enum('Menunggu validasi','Telah disetujui','Dibatalkan','Ditolak') NOT NULL DEFAULT 'Menunggu validasi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pengajuan`
--

INSERT INTO `pengajuan` (`id_pengajuan`, `user_id`, `penanggung_jawab`, `orang_terlibat`, `hari_tanggal`, `waktu_awal`, `waktu_akhir`, `Tempat_yang_dipakai`, `peralatan`, `kegunaan`, `status`) VALUES
(1, NULL, 'sas', 'sasa', '2023-05-11', '12:18:00', '13:19:00', 'Ruang Spare Room 1', 'sasa', 'asas', 'Telah disetujui'),
(2, NULL, 'naufal', 'nopal,padil', '2023-05-12', '15:19:00', '16:19:00', 'Laboratorium Biologi', 'sasa', 'asas', 'Telah disetujui'),
(3, NULL, 'sas', 'sasa', '2023-05-01', '13:19:00', '13:19:00', 'Ruang Spare Room 1', 'sasa', 'asas', 'Telah disetujui'),
(4, NULL, 'sasas', 'sasas', '2023-05-10', '06:30:00', '12:30:00', 'Ruang Spare Room 1', 'sasa', 'sasas', 'Telah disetujui'),
(5, NULL, 'sas', 'sasa', '2023-05-22', '14:30:00', '16:00:00', 'Laboratorium Bahasa', 'sasa', 'asas', 'Telah disetujui'),
(6, NULL, 'sas', 'sasa', '2023-05-19', '07:00:00', '08:00:00', 'Ruang Spare Room 1', 'sasa', 'asas', 'Menunggu validasi'),
(7, NULL, 'testing', 'ksldfsdjfds', '2023-05-21', '06:00:00', '06:00:00', 'Ruang Spare Room 1', 'sdfsdf', 'fsdfds', 'Ditolak'),
(8, NULL, '', 'ksldfsdjfds', '2023-05-22', '06:00:00', '06:00:00', 'Ruang Spare Room 1', 'sdfsdf', 'fsdfds', 'Ditolak'),
(9, NULL, '', 'SAFSAFSA', '2023-05-12', '06:00:00', '06:00:00', 'Ruang Spare Room 1', 'FSAFS', 'FSAFSA', 'Ditolak'),
(10, 3, '', 'dgsdgds', '2023-05-20', '06:00:00', '06:00:00', 'Ruang Spare Room 1', 'fdsfds', 'fdsfds', 'Telah disetujui'),
(11, 7, 'User ', 'naufal ', '2023-05-18', '06:00:00', '06:30:00', 'Kelas XI.1', 'dsfds', 'fdsfds', 'Telah disetujui'),
(12, 9, 'User 2', 'testing tes', '2023-05-18', '08:00:00', '09:00:00', 'Ruang Spare Room 1', 'sdfsd', 'fdsfds', 'Menunggu validasi'),
(13, 9, 'User 2', 'testing 2', '2023-05-18', '08:00:00', '08:30:00', 'Kelas XI.1', 'fgfdg', 'gdfgfdgfd', 'Telah disetujui'),
(14, 7, 'User ', 'Lipi, Kelvin, Azril, Fadhil, Dody', '2023-05-26', '11:00:00', '13:00:00', 'Laboratorium Bahasa', 'Peralatan Lab', 'Pelajaran', 'Telah disetujui'),
(15, 7, 'User ', 'adasd', '2023-05-04', '06:00:00', '12:30:00', 'Atrium SD', 'sasa', 'sasas', 'Telah disetujui');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sarana`
--

CREATE TABLE `sarana` (
  `id_sarana` int(11) UNSIGNED NOT NULL,
  `nama_sarana` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `uuid` char(36) NOT NULL,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `fullname`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `uuid`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, NULL, 'user', '$2y$10$sw4lAxFGHxTLOgrqXW.WH.1NkJSrL4asq3Ix4IngfnbzHDZVFl2uW', 'User ', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ac931ce0-0c7f-5c13-9bc8-f33540d760df', 0, '2023-05-21 11:39:23', '2023-05-21 11:39:23', NULL),
(8, NULL, 'admin', '$2y$10$guyM1BFHRuuTjRYIS8Eh1O072pMejRkUVlPMJ7QSjVhydpbnMtDNW', 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, 1, '85cac8e3-7351-5b65-80ba-8965bfed9e3b', 0, '2023-05-21 11:39:37', '2023-05-21 11:39:37', NULL),
(9, NULL, 'user2', '$2y$10$KoMpib0vLzR83ZgqVH38NecsYk8KYwbf264xPgs1M2eFRnluq5hhG', 'User 2', NULL, NULL, NULL, NULL, NULL, NULL, 1, '50c6ec61-617a-5e6a-877b-f21b7e9c3aac', 0, '2023-05-21 12:07:30', '2023-05-21 12:07:30', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indeks untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indeks untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indeks untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indeks untuk tabel `sarana`
--
ALTER TABLE `sarana`
  ADD PRIMARY KEY (`id_sarana`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `sarana`
--
ALTER TABLE `sarana`
  MODIFY `id_sarana` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
