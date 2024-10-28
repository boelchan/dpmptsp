/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) unsigned DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) unsigned DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `alumnis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `foto` varchar(250) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `domisili` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(12) DEFAULT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `jurusan` enum('ipa','ips','bahasa') NOT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `approved` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `authentication_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `authenticatable_type` varchar(255) NOT NULL,
  `authenticatable_id` bigint(20) unsigned NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `login_at` timestamp NULL DEFAULT NULL,
  `login_successful` tinyint(1) NOT NULL DEFAULT 0,
  `logout_at` timestamp NULL DEFAULT NULL,
  `cleared_by_user` tinyint(1) NOT NULL DEFAULT 0,
  `location` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`location`)),
  PRIMARY KEY (`id`),
  KEY `authentication_log_authenticatable_type_authenticatable_id_index` (`authenticatable_type`,`authenticatable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_primary` int(11) NOT NULL DEFAULT 0,
  `add_to_header_menu` enum('ya','tidak') NOT NULL DEFAULT 'tidak',
  `add_to_footer_menu` enum('ya','tidak') NOT NULL DEFAULT 'tidak',
  `add_to_sidebar_menu` enum('ya','tidak') NOT NULL DEFAULT 'tidak',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `identities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `tipe` varchar(255) NOT NULL DEFAULT 'identitas',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `instansi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `konten` text DEFAULT NULL,
  `active` varchar(5) NOT NULL DEFAULT 'ya',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `instansi_layanan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `instansi_id` bigint(20) unsigned NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `tipe` varchar(255) NOT NULL DEFAULT 'offline',
  `alur` text DEFAULT NULL,
  `syarat` text DEFAULT NULL,
  `publish` varchar(5) NOT NULL DEFAULT 'ya',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `instansi_layanan_instansi_id_foreign` (`instansi_id`),
  CONSTRAINT `instansi_layanan_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `kategori_id` bigint(20) unsigned NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `konten` text DEFAULT NULL,
  `tampil_banner` varchar(5) NOT NULL DEFAULT 'tidak',
  `add_to_submenu` enum('ya','tidak') NOT NULL DEFAULT 'tidak',
  `publish` varchar(5) NOT NULL DEFAULT 'ya',
  `publish_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_kategori_id_foreign` (`kategori_id`),
  CONSTRAINT `posts_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta` varchar(255) DEFAULT NULL,
  `konten` varchar(15000) DEFAULT NULL,
  `publish` varchar(5) NOT NULL DEFAULT 'ya',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `konten` text DEFAULT NULL,
  `publish` varchar(5) NOT NULL DEFAULT 'ya',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `teams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `konten` text DEFAULT NULL,
  `publish` varchar(5) NOT NULL DEFAULT 'ya',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `topics` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'created', 'App\\Models\\User', 'created', 1, NULL, NULL, '{\"attributes\":{\"id\":1,\"uuid\":\"9de7570c-8474-4e7a-ba2f-64ab51290b00\",\"name\":\"Annamae\",\"email\":\"superadmin@app.com\",\"email_verified_at\":\"2023-10-17T12:34:58.000000Z\",\"password\":\"$2y$10$sLmhYfFYHe2QSt6JBa4b6O3R9NDayBuSanHu5dlAiapMuFkloHHkO\",\"remember_token\":null,\"banned_at\":null,\"created_at\":\"2023-10-17T12:35:00.000000Z\",\"updated_at\":\"2023-10-17T12:35:00.000000Z\"}}', NULL, '2023-10-17 19:35:01', '2023-10-17 19:35:01');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(2, 'default', 'created', 'App\\Models\\User', 'created', 2, NULL, NULL, '{\"attributes\":{\"id\":2,\"uuid\":\"bcaa2a01-5d78-4ed3-ba27-125f2d67cce1\",\"name\":\"Jocelyn\",\"email\":\"booking@app.com\",\"email_verified_at\":\"2023-10-17T12:35:01.000000Z\",\"password\":\"$2y$10$JgDf8Lgl.zIV0Cf88LdypuKkiaJE4352brb4NJ6HTG2LdZtnTLc3i\",\"remember_token\":null,\"banned_at\":null,\"created_at\":\"2023-10-17T12:35:01.000000Z\",\"updated_at\":\"2023-10-17T12:35:01.000000Z\"}}', NULL, '2023-10-17 19:35:01', '2023-10-17 19:35:01');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(3, 'default', 'created', 'App\\Models\\User', 'created', 3, NULL, NULL, '{\"attributes\":{\"id\":3,\"uuid\":\"232e7dbd-bf29-4ec4-ae4a-2c295cf80fac\",\"name\":\"Mozell\",\"email\":\"blog@app.com\",\"email_verified_at\":\"2023-10-17T12:35:01.000000Z\",\"password\":\"$2y$10$.yNFc6pfTccfx.U3tGEutOgKa.CBwRNupDtQBsha1NStCdOlsaAEK\",\"remember_token\":null,\"banned_at\":null,\"created_at\":\"2023-10-17T12:35:01.000000Z\",\"updated_at\":\"2023-10-17T12:35:01.000000Z\"}}', NULL, '2023-10-17 19:35:01', '2023-10-17 19:35:01');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(4, 'default', 'created', 'App\\Models\\User', 'created', 4, NULL, NULL, '{\"attributes\":{\"id\":4,\"uuid\":\"637195f9-927a-4fb6-8fa7-a6addc4a2bd1\",\"name\":\"Polly\",\"email\":\"dokter@app.com\",\"email_verified_at\":\"2023-10-17T12:35:01.000000Z\",\"password\":\"$2y$10$LON3HGqeO8SdQGZAN3HueuYA15iN1fIXTriiNsCdHqxbvaQfQeq2G\",\"remember_token\":null,\"banned_at\":null,\"created_at\":\"2023-10-17T12:35:01.000000Z\",\"updated_at\":\"2023-10-17T12:35:01.000000Z\"}}', NULL, '2023-10-17 19:35:01', '2023-10-17 19:35:01');



INSERT INTO `authentication_log` (`id`, `authenticatable_type`, `authenticatable_id`, `ip_address`, `user_agent`, `login_at`, `login_successful`, `logout_at`, `cleared_by_user`, `location`) VALUES
(1, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/119.0', '2023-10-17 19:37:59', 1, NULL, 0, NULL);


INSERT INTO `categories` (`id`, `nama`, `slug`, `is_primary`, `add_to_header_menu`, `add_to_footer_menu`, `add_to_sidebar_menu`, `created_at`, `updated_at`) VALUES
(1, 'Banner', 'banner', 1, 'tidak', 'tidak', 'tidak', NULL, NULL);
INSERT INTO `categories` (`id`, `nama`, `slug`, `is_primary`, `add_to_header_menu`, `add_to_footer_menu`, `add_to_sidebar_menu`, `created_at`, `updated_at`) VALUES
(2, 'Pamflet', 'pamflet', 2, 'tidak', 'tidak', 'tidak', NULL, NULL);
INSERT INTO `categories` (`id`, `nama`, `slug`, `is_primary`, `add_to_header_menu`, `add_to_footer_menu`, `add_to_sidebar_menu`, `created_at`, `updated_at`) VALUES
(3, 'Profil', 'profil', 0, 'ya', 'ya', 'tidak', '2023-10-17 19:47:16', '2023-10-17 19:47:16');
INSERT INTO `categories` (`id`, `nama`, `slug`, `is_primary`, `add_to_header_menu`, `add_to_footer_menu`, `add_to_sidebar_menu`, `created_at`, `updated_at`) VALUES
(4, 'Agenda', 'agenda', 0, 'tidak', 'tidak', 'ya', '2023-10-17 20:11:12', '2023-10-17 20:11:12');



INSERT INTO `identities` (`id`, `nama`, `slug`, `value`, `tipe`, `created_at`, `updated_at`) VALUES
(1, 'Logo', 'logo', 'logo-0.20842800 1697546391.png', 'website', NULL, '2023-10-17 19:39:51');
INSERT INTO `identities` (`id`, `nama`, `slug`, `value`, `tipe`, `created_at`, `updated_at`) VALUES
(2, 'Gambar Breadcrumb ', 'breadcrumb', 'breadcrumb-0.96503700 1697547484.jpg', 'website', NULL, '2023-10-17 19:58:04');
INSERT INTO `identities` (`id`, `nama`, `slug`, `value`, `tipe`, `created_at`, `updated_at`) VALUES
(3, 'Gambar Footer', 'footer', 'footer-0.04348200 1697547475.jpg', 'website', NULL, '2023-10-17 19:57:55');
INSERT INTO `identities` (`id`, `nama`, `slug`, `value`, `tipe`, `created_at`, `updated_at`) VALUES
(4, 'Gambar Menu Samping', 'sidebar', 'sidebar-0.53811300 1680224891.jpg', 'website', NULL, NULL),
(5, 'Nama Perusahaan', 'nama', 'Mall Pelayanan Publik', 'identitas', NULL, '2023-10-17 19:38:50'),
(6, 'Alamat', 'alamat', 'Jl. Dr. Soetomo, Lingkungan Delama, Pajagalan, Kec. Kota Sumenep, Kabupaten Sumenep, Jawa Timur 69416', 'identitas', NULL, '2023-10-17 19:39:10'),
(7, 'Telepon', 'telepon', '0987654311', 'identitas', NULL, NULL),
(8, 'Whatsapp', 'whatsapp', NULL, 'identitas', NULL, '2023-10-17 19:39:19'),
(9, 'Email', 'email', 'sekolah@gmail.com', 'identitas', NULL, NULL),
(10, 'Youtube', 'youtube', 'yoyubr.com/asdasd', 'sosmed', NULL, NULL),
(11, 'Instagram', 'instagram', 'instagram.com/asdas', 'sosmed', NULL, NULL),
(12, 'Facebook', 'facebook', 'facbeook.com/asdas', 'sosmed', NULL, NULL),
(13, 'Tiktok', 'tiktok', NULL, 'sosmed', NULL, '2023-10-17 19:39:37');

INSERT INTO `instansi` (`id`, `uuid`, `nama`, `slug`, `meta_keywords`, `meta_description`, `icon`, `konten`, `active`, `created_at`, `updated_at`) VALUES
(1, '', 'DPMPTSP', 'dpmptsp', NULL, NULL, NULL, NULL, 'ya', NULL, NULL);
INSERT INTO `instansi` (`id`, `uuid`, `nama`, `slug`, `meta_keywords`, `meta_description`, `icon`, `konten`, `active`, `created_at`, `updated_at`) VALUES
(2, '', 'Disdukcapil', 'disdukcapil', NULL, NULL, NULL, NULL, 'ya', NULL, NULL);
INSERT INTO `instansi` (`id`, `uuid`, `nama`, `slug`, `meta_keywords`, `meta_description`, `icon`, `konten`, `active`, `created_at`, `updated_at`) VALUES
(3, '', 'PU PRKP dan Cipta Karya', 'pupr', NULL, NULL, NULL, NULL, 'ya', NULL, NULL);
INSERT INTO `instansi` (`id`, `uuid`, `nama`, `slug`, `meta_keywords`, `meta_description`, `icon`, `konten`, `active`, `created_at`, `updated_at`) VALUES
(4, '', 'PU Sumber Daya Air ', 'sda', NULL, NULL, NULL, NULL, 'ya', NULL, NULL),
(5, '', 'PU Bina Marga', 'marga', NULL, NULL, NULL, NULL, 'ya', NULL, NULL),
(6, '', 'Dinas Lingkungan Hidup', 'dlh', NULL, NULL, NULL, NULL, 'ya', NULL, NULL),
(7, '', 'Dinas Kesehatan', 'dinkes', NULL, NULL, NULL, NULL, 'ya', NULL, NULL),
(8, '', 'BPPKAD', 'bppkad', NULL, NULL, NULL, NULL, 'ya', NULL, NULL),
(9, '', 'PDAM', 'pdam', NULL, NULL, NULL, NULL, 'ya', NULL, NULL),
(10, '', 'BPJS Kesehatan', 'bpjs', NULL, NULL, NULL, NULL, 'ya', NULL, NULL);

INSERT INTO `instansi_layanan` (`id`, `instansi_id`, `nama`, `slug`, `meta_keywords`, `meta_description`, `tipe`, `alur`, `syarat`, `publish`, `created_at`, `updated_at`) VALUES
(1, 1, 'layanan 1', 'layanan 1', NULL, NULL, 'offline', NULL, NULL, 'ya', NULL, NULL);
INSERT INTO `instansi_layanan` (`id`, `instansi_id`, `nama`, `slug`, `meta_keywords`, `meta_description`, `tipe`, `alur`, `syarat`, `publish`, `created_at`, `updated_at`) VALUES
(2, 1, 'layanan 2', 'layanan 1', NULL, NULL, 'offline', NULL, NULL, 'ya', NULL, NULL);
INSERT INTO `instansi_layanan` (`id`, `instansi_id`, `nama`, `slug`, `meta_keywords`, `meta_description`, `tipe`, `alur`, `syarat`, `publish`, `created_at`, `updated_at`) VALUES
(3, 1, 'layanan 3', 'layanan 1', NULL, NULL, 'offline', NULL, NULL, 'ya', NULL, NULL);
INSERT INTO `instansi_layanan` (`id`, `instansi_id`, `nama`, `slug`, `meta_keywords`, `meta_description`, `tipe`, `alur`, `syarat`, `publish`, `created_at`, `updated_at`) VALUES
(4, 1, 'layanan 4', 'layanan 1', NULL, NULL, 'offline', NULL, NULL, 'ya', NULL, NULL);

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_09_21_144811_add_uuid_column_to_user_table', 1),
(7, '2022_09_23_144849_add_banned_at_to_users_table', 1),
(8, '2023_02_05_021823_create_topics_table', 1),
(9, '2023_02_05_023016_create_categories_table', 1),
(10, '2023_02_05_025026_create_posts_table', 1),
(11, '2023_02_06_131703_create_teams_table', 1),
(12, '2023_02_06_133605_create_profiles_table', 1),
(13, '2023_02_13_200711_create_identities_table', 1),
(14, '2023_02_13_201122_create_services_table', 1),
(15, '2023_06_19_181033_create_alumnis_table', 1),
(16, '2023_07_22_143938_update_table_categories', 1),
(17, '2023_07_22_150745_update_table_post', 1),
(18, '2023_08_16_041151_create_authentication_log_table', 1),
(19, '2023_08_16_042158_create_permission_tables', 1),
(20, '2023_08_16_044317_create_activity_log_table', 1),
(21, '2023_08_16_044318_add_event_column_to_activity_log_table', 1),
(22, '2023_08_16_044319_add_batch_uuid_column_to_activity_log_table', 1),
(23, '2023_10_17_201804_create_instansis_table', 2),
(24, '2023_10_17_202100_create_instansi_layanans_table', 2);



INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 3);
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3, 'App\\Models\\User', 2);
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(4, 'App\\Models\\User', 4);





INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'index', 'web', '2023-10-17 19:34:56', '2023-10-17 19:34:56');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'create', 'web', '2023-10-17 19:34:56', '2023-10-17 19:34:56');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(3, 'read', 'web', '2023-10-17 19:34:56', '2023-10-17 19:34:56');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(4, 'update', 'web', '2023-10-17 19:34:56', '2023-10-17 19:34:56'),
(5, 'delete', 'web', '2023-10-17 19:34:56', '2023-10-17 19:34:56');



INSERT INTO `posts` (`id`, `uuid`, `kategori_id`, `judul`, `slug`, `meta_keywords`, `meta_description`, `gambar`, `konten`, `tampil_banner`, `add_to_submenu`, `publish`, `publish_at`, `created_at`, `updated_at`) VALUES
(1, '52983760-8b87-3005-bae0-d69b73253790', 1, 'banner', 'banner', NULL, NULL, '0.72515300 1697547682.jpg', 'Qui consequuntur est aliquam perspiciatis. Alias ea saepe voluptates ab esse. Maiores eius totam quasi molestias aliquam ipsa rerum. Nostrum reprehenderit similique est qui. Error est tempore maiores rerum reprehenderit aut a dolorum. Pariatur tempore omnis sint eum aliquam quisquam voluptate. Sint qui ut impedit rerum rerum inventore molestias quas. Unde nam modi et sit. Sed molestias laudantium dolore ratione. Ea officia aliquam nihil dolores magni nulla aut voluptatem. Et voluptas est aut sed. Delectus et rerum voluptatem eum ratione assumenda fuga. Quidem est impedit qui. Consequatur reprehenderit id nihil quasi nam voluptatem. Voluptate omnis voluptas facere qui. Molestiae pariatur atque et laudantium inventore sit sed. Facilis omnis quae non ipsa. Et inventore dicta laudantium tempora facere. Dolores excepturi exercitationem dolor qui qui est autem. Esse enim voluptas et culpa rerum unde qui. Asperiores in autem dolores ullam quos. Libero qui possimus voluptatem ipsam deserunt. Nam voluptatem tenetur maiores autem. Vitae quisquam minima deserunt quia. Omnis esse quis repudiandae quia. Occaecati est recusandae est quia qui. Molestias optio nulla id molestias aliquam. Vitae odit recusandae laborum ipsa fugit. Consequatur omnis sunt sint porro pariatur. Quia cumque ipsa dolor aspernatur. Praesentium laudantium rem exercitationem commodi esse dolore ducimus. Qui et nihil repellendus harum ut quis voluptas. Porro dolor saepe nihil eum dolores dolorum. Sunt velit voluptatem et aut. Placeat aut eos ut qui voluptatem. Impedit necessitatibus ex veritatis et. Cum facere totam rerum commodi et. In fugiat perferendis incidunt nostrum aliquid porro cumque. Exercitationem delectus ipsam sapiente iusto. Nemo et nobis rerum labore. Aut et distinctio odio accusamus excepturi. Aut quia quae inventore praesentium deserunt earum. Exercitationem voluptatibus velit inventore molestiae. Accusantium eaque sed labore non libero. Deleniti quo aut architecto nulla est sint omnis. Vel eos hic suscipit modi fuga enim. Occaecati ut ut sed. Incidunt ipsam est voluptas nisi eligendi officia. Id et blanditiis vitae ratione. Odit sit exercitationem quos tempore aut ipsa. Saepe commodi commodi repellendus voluptate et. Corporis voluptatem delectus accusamus possimus adipisci porro. Consequatur voluptatem hic minima voluptatum. Qui sint nostrum qui quasi aut. Minima quae itaque velit qui reiciendis temporibus exercitationem nulla. Ut explicabo voluptatem dolores in reiciendis. Nam dolore illum consectetur. Magni corrupti sapiente molestias atque ut ut. Consequatur omnis eveniet dolorum soluta eligendi. Enim praesentium non maiores eum fuga. Perferendis repellendus autem veritatis odio omnis id.', 'tidak', 'tidak', 'ya', '2023-10-17 19:35:02', NULL, '2023-10-17 20:01:22');
INSERT INTO `posts` (`id`, `uuid`, `kategori_id`, `judul`, `slug`, `meta_keywords`, `meta_description`, `gambar`, `konten`, `tampil_banner`, `add_to_submenu`, `publish`, `publish_at`, `created_at`, `updated_at`) VALUES
(2, 'd9c7edff-cddb-3be0-a76d-09eaa775b93d', 2, 'pamflet', 'pamflet', NULL, NULL, '0.50111600 1697548034.jpg', 'A qui qui autem distinctio sed. Quia nesciunt enim voluptate sint doloremque. Aut id enim dolorum laudantium ipsam non et. Velit eum modi aut et omnis quis. Asperiores aspernatur omnis veritatis tenetur. Neque consequuntur porro veritatis consequuntur est voluptatem enim. Doloribus doloribus sequi quod enim. Animi et dolorem nihil vero tempore. Temporibus non commodi iste omnis non veniam molestias. Consequatur perferendis autem molestiae aut quis vitae deserunt consequatur. Omnis sit inventore ut. Eligendi cupiditate et aut dolorem enim. Dolorem voluptatibus error fugiat adipisci vel fugit rem labore. Eum fuga sint exercitationem dolor. Numquam quae doloribus voluptas accusantium dolorem voluptate. Facilis asperiores repellendus dicta perspiciatis modi quod iste voluptatem. Reiciendis ea eius voluptatem voluptatem repudiandae at. Optio magnam inventore qui qui libero. Sit et debitis aut neque magni sed. Numquam ea quis deleniti ad omnis voluptate rerum. Porro ut et ad aut voluptatem. Error id provident ipsum assumenda quas et aut. Iusto ullam ut aut veniam numquam blanditiis quasi vero. Nesciunt earum occaecati iusto soluta libero quo aut. Maiores veniam velit pariatur enim aut sequi ut. Inventore sint quam excepturi. Et molestiae dicta veniam atque qui possimus. Atque sit laborum asperiores autem et sint. In et accusantium ut explicabo facilis. Non et ea exercitationem minima quasi omnis autem debitis. Quia magni ipsum ad aut libero. Reprehenderit necessitatibus sapiente accusantium. Cupiditate rem laboriosam et sint doloremque. Sunt similique sed autem consequatur. Harum et amet dolorem totam quam sit.', 'tidak', 'tidak', 'ya', '2023-10-17 19:35:02', NULL, '2023-10-17 20:07:14');
INSERT INTO `posts` (`id`, `uuid`, `kategori_id`, `judul`, `slug`, `meta_keywords`, `meta_description`, `gambar`, `konten`, `tampil_banner`, `add_to_submenu`, `publish`, `publish_at`, `created_at`, `updated_at`) VALUES
(3, 'd9c7edff-cddb-3be0-a76d-09eaa775b93d', 3, 'Tentang Kami', 'tentang-kami', NULL, NULL, '0.50111600 1697548034.jpg', 'A qui qui autem distinctio sed. Quia nesciunt enim voluptate sint doloremque. Aut id enim dolorum laudantium ipsam non et. Velit eum modi aut et omnis quis. Asperiores aspernatur omnis veritatis tenetur. Neque consequuntur porro veritatis consequuntur est voluptatem enim. Doloribus doloribus sequi quod enim. Animi et dolorem nihil vero tempore. Temporibus non commodi iste omnis non veniam molestias. Consequatur perferendis autem molestiae aut quis vitae deserunt consequatur. Omnis sit inventore ut. Eligendi cupiditate et aut dolorem enim. Dolorem voluptatibus error fugiat adipisci vel fugit rem labore. Eum fuga sint exercitationem dolor. Numquam quae doloribus voluptas accusantium dolorem voluptate. Facilis asperiores repellendus dicta perspiciatis modi quod iste voluptatem. Reiciendis ea eius voluptatem voluptatem repudiandae at. Optio magnam inventore qui qui libero. Sit et debitis aut neque magni sed. Numquam ea quis deleniti ad omnis voluptate rerum. Porro ut et ad aut voluptatem. Error id provident ipsum assumenda quas et aut. Iusto ullam ut aut veniam numquam blanditiis quasi vero. Nesciunt earum occaecati iusto soluta libero quo aut. Maiores veniam velit pariatur enim aut sequi ut. Inventore sint quam excepturi. Et molestiae dicta veniam atque qui possimus. Atque sit laborum asperiores autem et sint. In et accusantium ut explicabo facilis. Non et ea exercitationem minima quasi omnis autem debitis. Quia magni ipsum ad aut libero. Reprehenderit necessitatibus sapiente accusantium. Cupiditate rem laboriosam et sint doloremque. Sunt similique sed autem consequatur. Harum et amet dolorem totam quam sit.', 'ya', 'ya', 'ya', '2023-10-17 19:35:02', NULL, '2023-10-17 20:09:46');
INSERT INTO `posts` (`id`, `uuid`, `kategori_id`, `judul`, `slug`, `meta_keywords`, `meta_description`, `gambar`, `konten`, `tampil_banner`, `add_to_submenu`, `publish`, `publish_at`, `created_at`, `updated_at`) VALUES
(4, 'd9c7edff-cddb-3be0-a76d-09eaa775b93d', 3, 'pamflet', 'pamflet', NULL, NULL, '0.50111600 1697548034.jpg', 'A qui qui autem distinctio sed. Quia nesciunt enim voluptate sint doloremque. Aut id enim dolorum laudantium ipsam non et. Velit eum modi aut et omnis quis. Asperiores aspernatur omnis veritatis tenetur. Neque consequuntur porro veritatis consequuntur est voluptatem enim. Doloribus doloribus sequi quod enim. Animi et dolorem nihil vero tempore. Temporibus non commodi iste omnis non veniam molestias. Consequatur perferendis autem molestiae aut quis vitae deserunt consequatur. Omnis sit inventore ut. Eligendi cupiditate et aut dolorem enim. Dolorem voluptatibus error fugiat adipisci vel fugit rem labore. Eum fuga sint exercitationem dolor. Numquam quae doloribus voluptas accusantium dolorem voluptate. Facilis asperiores repellendus dicta perspiciatis modi quod iste voluptatem. Reiciendis ea eius voluptatem voluptatem repudiandae at. Optio magnam inventore qui qui libero. Sit et debitis aut neque magni sed. Numquam ea quis deleniti ad omnis voluptate rerum. Porro ut et ad aut voluptatem. Error id provident ipsum assumenda quas et aut. Iusto ullam ut aut veniam numquam blanditiis quasi vero. Nesciunt earum occaecati iusto soluta libero quo aut. Maiores veniam velit pariatur enim aut sequi ut. Inventore sint quam excepturi. Et molestiae dicta veniam atque qui possimus. Atque sit laborum asperiores autem et sint. In et accusantium ut explicabo facilis. Non et ea exercitationem minima quasi omnis autem debitis. Quia magni ipsum ad aut libero. Reprehenderit necessitatibus sapiente accusantium. Cupiditate rem laboriosam et sint doloremque. Sunt similique sed autem consequatur. Harum et amet dolorem totam quam sit.', 'tidak', 'tidak', 'ya', '2023-10-17 19:35:02', NULL, '2023-10-17 20:07:14'),
(5, 'd9c7edff-cddb-3be0-a76d-09eaa775b93d', 2, 'pamflet', 'pamflet', NULL, NULL, '0.50111600 1697548034.jpg', 'A qui qui autem distinctio sed. Quia nesciunt enim voluptate sint doloremque. Aut id enim dolorum laudantium ipsam non et. Velit eum modi aut et omnis quis. Asperiores aspernatur omnis veritatis tenetur. Neque consequuntur porro veritatis consequuntur est voluptatem enim. Doloribus doloribus sequi quod enim. Animi et dolorem nihil vero tempore. Temporibus non commodi iste omnis non veniam molestias. Consequatur perferendis autem molestiae aut quis vitae deserunt consequatur. Omnis sit inventore ut. Eligendi cupiditate et aut dolorem enim. Dolorem voluptatibus error fugiat adipisci vel fugit rem labore. Eum fuga sint exercitationem dolor. Numquam quae doloribus voluptas accusantium dolorem voluptate. Facilis asperiores repellendus dicta perspiciatis modi quod iste voluptatem. Reiciendis ea eius voluptatem voluptatem repudiandae at. Optio magnam inventore qui qui libero. Sit et debitis aut neque magni sed. Numquam ea quis deleniti ad omnis voluptate rerum. Porro ut et ad aut voluptatem. Error id provident ipsum assumenda quas et aut. Iusto ullam ut aut veniam numquam blanditiis quasi vero. Nesciunt earum occaecati iusto soluta libero quo aut. Maiores veniam velit pariatur enim aut sequi ut. Inventore sint quam excepturi. Et molestiae dicta veniam atque qui possimus. Atque sit laborum asperiores autem et sint. In et accusantium ut explicabo facilis. Non et ea exercitationem minima quasi omnis autem debitis. Quia magni ipsum ad aut libero. Reprehenderit necessitatibus sapiente accusantium. Cupiditate rem laboriosam et sint doloremque. Sunt similique sed autem consequatur. Harum et amet dolorem totam quam sit.', 'tidak', 'tidak', 'ya', '2023-10-17 19:35:02', NULL, '2023-10-17 20:07:14'),
(6, 'd9c7edff-cddb-3be0-a76d-09eaa775b93d', 2, 'pamflet', 'pamflet', NULL, NULL, '0.50111600 1697548034.jpg', 'A qui qui autem distinctio sed. Quia nesciunt enim voluptate sint doloremque. Aut id enim dolorum laudantium ipsam non et. Velit eum modi aut et omnis quis. Asperiores aspernatur omnis veritatis tenetur. Neque consequuntur porro veritatis consequuntur est voluptatem enim. Doloribus doloribus sequi quod enim. Animi et dolorem nihil vero tempore. Temporibus non commodi iste omnis non veniam molestias. Consequatur perferendis autem molestiae aut quis vitae deserunt consequatur. Omnis sit inventore ut. Eligendi cupiditate et aut dolorem enim. Dolorem voluptatibus error fugiat adipisci vel fugit rem labore. Eum fuga sint exercitationem dolor. Numquam quae doloribus voluptas accusantium dolorem voluptate. Facilis asperiores repellendus dicta perspiciatis modi quod iste voluptatem. Reiciendis ea eius voluptatem voluptatem repudiandae at. Optio magnam inventore qui qui libero. Sit et debitis aut neque magni sed. Numquam ea quis deleniti ad omnis voluptate rerum. Porro ut et ad aut voluptatem. Error id provident ipsum assumenda quas et aut. Iusto ullam ut aut veniam numquam blanditiis quasi vero. Nesciunt earum occaecati iusto soluta libero quo aut. Maiores veniam velit pariatur enim aut sequi ut. Inventore sint quam excepturi. Et molestiae dicta veniam atque qui possimus. Atque sit laborum asperiores autem et sint. In et accusantium ut explicabo facilis. Non et ea exercitationem minima quasi omnis autem debitis. Quia magni ipsum ad aut libero. Reprehenderit necessitatibus sapiente accusantium. Cupiditate rem laboriosam et sint doloremque. Sunt similique sed autem consequatur. Harum et amet dolorem totam quam sit.', 'tidak', 'tidak', 'ya', '2023-10-17 19:35:02', NULL, '2023-10-17 20:07:14'),
(7, 'd9c7edff-cddb-3be0-a76d-09eaa775b93d', 4, 'HUT ke 78 Republik Indonesia', 'agenda', NULL, NULL, '0.50111600 1697548034.jpg', 'A qui qui autem distinctio sed. Quia nesciunt enim voluptate sint doloremque. Aut id enim dolorum laudantium ipsam non et. Velit eum modi aut et omnis quis. Asperiores aspernatur omnis veritatis tenetur. Neque consequuntur porro veritatis consequuntur est voluptatem enim. Doloribus doloribus sequi quod enim. Animi et dolorem nihil vero tempore. Temporibus non commodi iste omnis non veniam molestias. Consequatur perferendis autem molestiae aut quis vitae deserunt consequatur. Omnis sit inventore ut. Eligendi cupiditate et aut dolorem enim. Dolorem voluptatibus error fugiat adipisci vel fugit rem labore. Eum fuga sint exercitationem dolor. Numquam quae doloribus voluptas accusantium dolorem voluptate. Facilis asperiores repellendus dicta perspiciatis modi quod iste voluptatem. Reiciendis ea eius voluptatem voluptatem repudiandae at. Optio magnam inventore qui qui libero. Sit et debitis aut neque magni sed. Numquam ea quis deleniti ad omnis voluptate rerum. Porro ut et ad aut voluptatem. Error id provident ipsum assumenda quas et aut. Iusto ullam ut aut veniam numquam blanditiis quasi vero. Nesciunt earum occaecati iusto soluta libero quo aut. Maiores veniam velit pariatur enim aut sequi ut. Inventore sint quam excepturi. Et molestiae dicta veniam atque qui possimus. Atque sit laborum asperiores autem et sint. In et accusantium ut explicabo facilis. Non et ea exercitationem minima quasi omnis autem debitis. Quia magni ipsum ad aut libero. Reprehenderit necessitatibus sapiente accusantium. Cupiditate rem laboriosam et sint doloremque. Sunt similique sed autem consequatur. Harum et amet dolorem totam quam sit.', 'tidak', 'tidak', 'ya', '2023-10-17 19:35:02', NULL, '2023-10-17 20:07:14');



INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1);
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2);
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 3);
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 4),
(1, 5),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5);

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2023-10-17 19:34:56', '2023-10-17 19:34:56');
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'admin-blog', 'web', '2023-10-17 19:34:56', '2023-10-17 19:34:56');
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(3, 'operator-booking', 'web', '2023-10-17 19:34:56', '2023-10-17 19:34:56');
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(4, 'dokter', 'web', '2023-10-17 19:34:56', '2023-10-17 19:34:56'),
(5, 'pasien', 'web', '2023-10-17 19:34:56', '2023-10-17 19:34:56');





INSERT INTO `topics` (`id`, `nama`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Kesehatan', 'kesehatan', NULL, NULL);
INSERT INTO `topics` (`id`, `nama`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Ibu & Anak', 'ibu-anak', NULL, NULL);


INSERT INTO `users` (`id`, `uuid`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `banned_at`, `created_at`, `updated_at`) VALUES
(1, '9de7570c-8474-4e7a-ba2f-64ab51290b00', 'Annamae', 'superadmin@app.com', '2023-10-17 19:34:58', '$2y$10$sLmhYfFYHe2QSt6JBa4b6O3R9NDayBuSanHu5dlAiapMuFkloHHkO', NULL, NULL, '2023-10-17 19:35:00', '2023-10-17 19:35:00');
INSERT INTO `users` (`id`, `uuid`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `banned_at`, `created_at`, `updated_at`) VALUES
(2, 'bcaa2a01-5d78-4ed3-ba27-125f2d67cce1', 'Jocelyn', 'booking@app.com', '2023-10-17 19:35:01', '$2y$10$JgDf8Lgl.zIV0Cf88LdypuKkiaJE4352brb4NJ6HTG2LdZtnTLc3i', NULL, NULL, '2023-10-17 19:35:01', '2023-10-17 19:35:01');
INSERT INTO `users` (`id`, `uuid`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `banned_at`, `created_at`, `updated_at`) VALUES
(3, '232e7dbd-bf29-4ec4-ae4a-2c295cf80fac', 'Mozell', 'blog@app.com', '2023-10-17 19:35:01', '$2y$10$.yNFc6pfTccfx.U3tGEutOgKa.CBwRNupDtQBsha1NStCdOlsaAEK', NULL, NULL, '2023-10-17 19:35:01', '2023-10-17 19:35:01');
INSERT INTO `users` (`id`, `uuid`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `banned_at`, `created_at`, `updated_at`) VALUES
(4, '637195f9-927a-4fb6-8fa7-a6addc4a2bd1', 'Polly', 'dokter@app.com', '2023-10-17 19:35:01', '$2y$10$LON3HGqeO8SdQGZAN3HueuYA15iN1fIXTriiNsCdHqxbvaQfQeq2G', NULL, NULL, '2023-10-17 19:35:01', '2023-10-17 19:35:01');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;