/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80020
 Source Host           : localhost:3306
 Source Schema         : aktivitas_pegawai

 Target Server Type    : MySQL
 Target Server Version : 80020
 File Encoding         : 65001

 Date: 14/03/2025 19:21:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activities
-- ----------------------------
DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NULL DEFAULT NULL,
  `skp_id` bigint UNSIGNED NOT NULL,
  `nip_atasan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `activity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `is_deleted` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `activities_created_by_foreign`(`created_by`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of activities
-- ----------------------------
INSERT INTO `activities` VALUES (2, 2, 4, NULL, 'Aktivitas Saya edit', 'Deskripsiii coba akhir', 12244, 'Tiara Hartati', '08:00:00', '17:00:00', '2025-03-06 18:00:52', '2025-03-12 03:06:50', NULL, NULL);
INSERT INTO `activities` VALUES (3, 2, 8, '', 'Aktivitas Saya', 'Deskripsi saya', 12244, 'Tiara Hartati', '08:00:00', '17:00:00', '2025-03-06 18:06:46', '2025-03-12 03:02:42', 1, NULL);
INSERT INTO `activities` VALUES (4, 2, 7, '13728', 'Aktivitas Saya', 'Deskripsi saya', 12244, 'Tiara Hartati', '08:00:00', '17:00:00', '2026-02-06 18:08:32', '2025-03-12 03:02:08', NULL, NULL);
INSERT INTO `activities` VALUES (5, 4, 6, '12244', 'aktivitas 25', 'halo 2', 12967, 'Zulfa Prastuti', '08:00:00', '17:00:00', '2025-03-10 16:56:47', '2025-03-11 23:38:10', 1, NULL);
INSERT INTO `activities` VALUES (6, 2, 4, '13728', 'aktivitas 12', 'aktivitas tanggal 12', 12244, 'Tiara Hartati', '08:00:00', '12:00:00', '2025-03-12 02:55:05', '2025-03-12 03:05:46', NULL, 1);
INSERT INTO `activities` VALUES (7, 2, 4, '13728', 'sdfasdf', 'asdfasdf', 12244, 'Tiara Hartati', '08:00:00', '12:00:00', '2025-03-12 03:05:35', '2025-03-12 03:05:35', NULL, NULL);

-- ----------------------------
-- Table structure for atasan_bawahan
-- ----------------------------
DROP TABLE IF EXISTS `atasan_bawahan`;
CREATE TABLE `atasan_bawahan`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `activity_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `master_approver_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_atasan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_atasan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of atasan_bawahan
-- ----------------------------

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `nip` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `region` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` int NULL DEFAULT NULL,
  `nip_atasan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_atasan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `employees_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employees
-- ----------------------------
INSERT INTO `employees` VALUES (1, 1, '11534', 'Perangkat Desa', 'Gasti Laksmiwati', 'Yogyakarta', NULL, '1975-05-08 23:29:29', '2025-03-12 15:57:20', 1, '', '');
INSERT INTO `employees` VALUES (2, NULL, '12244', 'Tukang Kayu', 'Tiara Hartati', 'Pasuruan', 'Perwakilan BPKP Provinsi DKI Jakarta', '1987-02-12 03:43:43', NULL, NULL, '13728', '');
INSERT INTO `employees` VALUES (3, NULL, '12677', 'Pilot', 'Halima Ifa Nuraini', 'Yogyakarta', NULL, '1992-06-01 08:16:18', '2025-03-13 02:51:46', 1, '', '');
INSERT INTO `employees` VALUES (4, NULL, '12967', 'Peternak', 'Samsul Simanjuntak S.H.', 'Parepare', 'Perwakilan BPKP Provinsi DKI Jakarta', '2017-03-19 12:03:05', '2025-03-13 02:51:57', 1, '12244', 'Tiara Hartati');
INSERT INTO `employees` VALUES (5, NULL, '122456', 'Karyawan Honorer', 'Indah Ami Rahimah S.IP', 'Administrasi Jakarta Timur', 'Perwakilan BPKP Provinsi DKI Jakarta', '2025-03-12 15:24:29', '2025-03-12 15:24:29', NULL, '777788', 'Hidayat');
INSERT INTO `employees` VALUES (9, 5, '7777889', 'Auditor Ahli', 'Hidayat', NULL, 'Perwakilan BPKP Provinsi Jawa Barat', '2025-03-12 15:43:55', '2025-03-12 15:43:55', NULL, '12244', 'Tiara Hartati');
INSERT INTO `employees` VALUES (10, NULL, '5454566', 'Auditor', 'Ridwan', NULL, 'Perwakilan BPKP Provinsi Riau', '2025-03-12 14:39:12', '2025-03-12 14:39:12', NULL, '777788', 'Hidayat');
INSERT INTO `employees` VALUES (11, 7, '7899546', 'Auditor', 'Nur', NULL, 'Perwakilan BPKP Provinsi Sulawesi Selatan', '2025-03-12 15:50:32', '2025-03-12 15:50:32', NULL, '7777889', 'Hidayat');
INSERT INTO `employees` VALUES (12, 13, '00000000', 'asdfasdf', 'ridwan n', NULL, 'Perwakilan BPKP Provinsi DKI Jakarta', '2025-03-13 09:13:19', '2025-03-13 09:13:19', NULL, '12244', 'Tiara Hartati');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancelled_at` int NULL DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED NULL DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for master_approver
-- ----------------------------
DROP TABLE IF EXISTS `master_approver`;
CREATE TABLE `master_approver`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_atasan_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_atasan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_atasan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position_atasan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int NOT NULL DEFAULT 1,
  `is_deleted` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_approver
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2025_02_26_035918_create_activities_table', 1);
INSERT INTO `migrations` VALUES (5, '2025_02_26_040400_create_work_regions_table', 1);
INSERT INTO `migrations` VALUES (6, '2025_02_26_072439_create_roles_table', 1);
INSERT INTO `migrations` VALUES (7, '2025_02_26_160725_create_employees_table', 1);
INSERT INTO `migrations` VALUES (8, '2025_02_26_163830_create_skp_table', 1);
INSERT INTO `migrations` VALUES (9, '2025_02_27_034022_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (10, '2025_03_02_053529_create_atasan_bawahan_table', 2);
INSERT INTO `migrations` VALUES (11, '2025_03_02_142140_create_master_approver_table', 3);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\User', 1);
INSERT INTO `model_has_roles` VALUES (3, 'App\\Models\\User', 2);
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\User', 3);
INSERT INTO `model_has_roles` VALUES (3, 'App\\Models\\User', 5);
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\User', 6);
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\User', 7);
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\User', 9);
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\User', 10);
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\User', 11);
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\User', 12);
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\User', 13);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name`, `guard_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'create user', 'web', '2025-03-02 05:12:38', '2025-03-02 05:12:38');
INSERT INTO `permissions` VALUES (2, 'export report', 'web', '2025-03-02 05:12:38', '2025-03-02 05:12:38');
INSERT INTO `permissions` VALUES (3, 'assign region', 'web', '2025-03-02 05:12:38', '2025-03-02 05:12:38');
INSERT INTO `permissions` VALUES (4, 'assign skp', 'web', '2025-03-02 05:12:38', '2025-03-02 05:12:38');
INSERT INTO `permissions` VALUES (5, 'create activity', 'web', '2025-03-02 05:12:38', '2025-03-02 05:12:38');
INSERT INTO `permissions` VALUES (6, 'create skp', 'web', '2025-03-02 05:12:38', '2025-03-02 05:12:38');
INSERT INTO `permissions` VALUES (7, 'update profile', 'web', '2025-03-02 05:12:38', '2025-03-02 05:12:38');
INSERT INTO `permissions` VALUES (8, 'approve', 'web', '2025-03-02 05:12:38', '2025-03-02 05:12:38');
INSERT INTO `permissions` VALUES (9, 'manage password', 'web', '2025-03-02 05:12:38', '2025-03-02 05:12:38');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (1, 1);
INSERT INTO `role_has_permissions` VALUES (2, 1);
INSERT INTO `role_has_permissions` VALUES (3, 1);
INSERT INTO `role_has_permissions` VALUES (4, 1);
INSERT INTO `role_has_permissions` VALUES (5, 1);
INSERT INTO `role_has_permissions` VALUES (6, 1);
INSERT INTO `role_has_permissions` VALUES (7, 1);
INSERT INTO `role_has_permissions` VALUES (8, 1);
INSERT INTO `role_has_permissions` VALUES (9, 1);
INSERT INTO `role_has_permissions` VALUES (5, 2);
INSERT INTO `role_has_permissions` VALUES (6, 2);
INSERT INTO `role_has_permissions` VALUES (7, 2);
INSERT INTO `role_has_permissions` VALUES (9, 2);
INSERT INTO `role_has_permissions` VALUES (7, 3);
INSERT INTO `role_has_permissions` VALUES (8, 3);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name`, `guard_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'admin', 'web', '2025-03-02 05:12:38', '2025-03-02 05:12:38');
INSERT INTO `roles` VALUES (2, 'pegawai', 'web', '2025-03-02 05:12:38', '2025-03-02 05:12:38');
INSERT INTO `roles` VALUES (3, 'atasan', 'web', '2025-03-02 05:12:38', '2025-03-02 05:12:38');

-- ----------------------------
-- Table structure for roles_backup
-- ----------------------------
DROP TABLE IF EXISTS `roles_backup`;
CREATE TABLE `roles_backup`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles_backup
-- ----------------------------

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id`) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('Ik8QsJr4pLh9BRW2eOgmMLsDKs5oYml2VbVaOGwZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRWx3UzVCSFlPN2tJaGFrV2FTSjZvRnR3aXZtSnVJYmhmM3BrMTNadyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vZW1wbG95ZWUtYWN0aXZpdHkuZGV2L2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1741849502);
INSERT INTO `sessions` VALUES ('L3TYhSriKFFCutkJp8zt8KkS8K1ycAfQVAyfK0oU', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS0NhV0FxRzhTdlJkazhGWXVuUnlOMTlLOVJQbFNPd3k3b0hKWUF5QiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHBzOi8vZW1wbG95ZWUtYWN0aXZpdHkuZGV2L2FkbWluL3BlZ2F3YWkiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1741857201);
INSERT INTO `sessions` VALUES ('pugcrKluRti8mZKFDLMuLMyHH2Siyll0KH7L4kdq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY2RTMXRjaG42RWxPZVFNNmtrTm0wQmMxV2hJb1dKaGhSZ2V2OXFPMyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MzoiaHR0cHM6Ly9lbXBsb3llZS1hY3Rpdml0eS5kZXYvYWRtaW4vcGVnYXdhaSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQzOiJodHRwczovL2VtcGxveWVlLWFjdGl2aXR5LmRldi9hZG1pbi9wZWdhd2FpIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1741849502);

-- ----------------------------
-- Table structure for skp
-- ----------------------------
DROP TABLE IF EXISTS `skp`;
CREATE TABLE `skp`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `name_skp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` smallint NOT NULL,
  `year` smallint NOT NULL,
  `total_working_day` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` int NULL DEFAULT NULL,
  `created_by` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `skp_employee_id_foreign`(`employee_id`) USING BTREE,
  CONSTRAINT `skp_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of skp
-- ----------------------------
INSERT INTO `skp` VALUES (1, 3, 'SKP Penilaian 4', 1, 2026, NULL, '2025-03-05 17:47:25', '2025-03-10 15:27:03', 1, '12967');
INSERT INTO `skp` VALUES (2, 3, 'SKP Penilaian 20', 2, 2025, NULL, '2025-03-05 17:53:47', '2025-03-10 16:55:02', NULL, '12967');
INSERT INTO `skp` VALUES (3, 3, 'SKP Penilaian 33', 1, 2026, NULL, '2025-03-05 17:59:24', '2025-03-10 16:30:51', NULL, '12967');
INSERT INTO `skp` VALUES (4, 2, 'SKP atasan 1', 2, 2027, NULL, '2025-03-06 06:45:52', '2025-03-06 16:54:16', NULL, '12244');
INSERT INTO `skp` VALUES (6, 2, 'Skp atasan 3', 4, 2026, NULL, '2025-03-06 06:54:53', '2025-03-06 06:54:53', NULL, '12244');
INSERT INTO `skp` VALUES (7, 2, 'SSKP', 2, 2025, NULL, '2026-03-06 06:58:22', '2025-03-07 04:25:01', 1, '12244');
INSERT INTO `skp` VALUES (8, 2, 'SSKP 2', 3, 2025, NULL, '2024-03-06 06:59:12', '2025-03-06 06:59:12', NULL, '12244');
INSERT INTO `skp` VALUES (9, 2, 'sdfsd', 1, 2025, NULL, '2025-03-06 16:47:36', '2025-03-06 16:47:36', NULL, '12244');
INSERT INTO `skp` VALUES (10, 4, 'halo skp', 2, 2026, NULL, '2025-03-10 16:40:24', '2025-03-10 16:40:24', NULL, '12967');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` bigint NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_atasan` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username`) USING BTREE,
  UNIQUE INDEX `users_nip_unique`(`nip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, NULL, 'Gasti Laksmiwati', '11534', '$2y$12$qqz0/h39t.qYaJpmdj7druBBgfpkbojmC6de.qT.M.lu7DfWypq7y', 1, '2025-03-02 05:17:52', '2025-03-13 06:14:29', NULL);
INSERT INTO `users` VALUES (2, NULL, 'Tiara Hartati', '12244', '$2y$12$7wWE/h8Ekr6UEx2IcxlvpediyxAByqVBRMJJ7oVU7WSoe1Q0pgOga', 1, '2025-03-02 14:00:13', '2025-03-02 14:00:13', 1);
INSERT INTO `users` VALUES (3, NULL, 'Zulfa Prastuti', '12967', '$2y$12$qmnZDTmLZUSNEJ27thL2Ee8JhhT4/4qo.OClUDViFLvA5Z2Nz069i', 1, '2025-03-05 07:40:58', '2025-03-05 07:40:58', NULL);
INSERT INTO `users` VALUES (5, NULL, 'Hidayat', '7777889', '$2y$12$Tw41qgOFgKG72mpHCsAFk.kF/uSLZkpazquchH33s.yN4HXhESHCO', 1, '2025-03-12 14:38:21', '2025-03-13 05:06:47', 1);
INSERT INTO `users` VALUES (6, NULL, 'Ridwan', '5454566', '$2y$12$Y0c3NfNo9BM2txJnpxXW/.B8ToPX.0665NzVPVjOXgX6TLh7VEjI6', 1, '2025-03-12 14:39:12', '2025-03-12 14:39:12', NULL);
INSERT INTO `users` VALUES (7, NULL, 'Nur', '7899546', '$2y$12$dMtce2uY1NMynT685vZbWe7024wswHTZqyuaN4/H5upKILD59NX4.', 1, '2025-03-12 15:50:01', '2025-03-12 15:50:32', NULL);
INSERT INTO `users` VALUES (13, NULL, 'ridwan n', '00000000', '$2y$12$VniP7Aat1XoISel/Yisyu.UUlpMmhLBocLm4vxsYiaji7RIoTC0Cy', 1, '2025-03-13 09:12:19', '2025-03-13 09:12:19', NULL);

-- ----------------------------
-- Table structure for work_regions
-- ----------------------------
DROP TABLE IF EXISTS `work_regions`;
CREATE TABLE `work_regions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of work_regions
-- ----------------------------
INSERT INTO `work_regions` VALUES (1, 'Perwakilan BPKP Provinsi Aceh', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (2, 'Perwakilan BPKP Provinsi Sumatera Utara', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (3, 'Perwakilan BPKP Provinsi Sumatera Barat', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (4, 'Perwakilan BPKP Provinsi Riau', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (5, 'Perwakilan BPKP Provinsi Kepulauan Riau', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (6, 'Perwakilan BPKP Provinsi Jambi', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (7, 'Perwakilan BPKP Provinsi Sumatera Selatan', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (8, 'Perwakilan BPKP Provinsi Bangka Belitung', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (9, 'Perwakilan BPKP Provinsi Bengkulu', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (10, 'Perwakilan BPKP Provinsi Lampung', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (11, 'Perwakilan BPKP Provinsi DKI Jakarta', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (12, 'Perwakilan BPKP Provinsi Jawa Barat', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (13, 'Perwakilan BPKP Provinsi Banten', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (14, 'Perwakilan BPKP Provinsi Jawa Tengah', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (15, 'Perwakilan BPKP Provinsi Daerah Istimewa Yogyakarta', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (16, 'Perwakilan BPKP Provinsi Jawa Timur', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (17, 'Perwakilan BPKP Provinsi Bali', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (18, 'Perwakilan BPKP Provinsi Nusa Tenggara Barat', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (19, 'Perwakilan BPKP Provinsi Nusa Tenggara Timur', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (20, 'Perwakilan BPKP Provinsi Kalimantan Barat', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (21, 'Perwakilan BPKP Provinsi Kalimantan Tengah', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (22, 'Perwakilan BPKP Provinsi Kalimantan Selatan', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (23, 'Perwakilan BPKP Provinsi Kalimantan Timur', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (24, 'Perwakilan BPKP Provinsi Kalimantan Utara', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (25, 'Perwakilan BPKP Provinsi Sulawesi Utara', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (26, 'Perwakilan BPKP Provinsi Gorontalo', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (27, 'Perwakilan BPKP Provinsi Sulawesi Tengah', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (28, 'Perwakilan BPKP Provinsi Sulawesi Barat', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (29, 'Perwakilan BPKP Provinsi Sulawesi Selatan', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (30, 'Perwakilan BPKP Provinsi Sulawesi Tenggara', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (31, 'Perwakilan BPKP Provinsi Maluku', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (32, 'Perwakilan BPKP Provinsi Maluku Utara', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (33, 'Perwakilan BPKP Provinsi Papua', '2025-03-12 20:20:49', NULL);
INSERT INTO `work_regions` VALUES (34, 'Perwakilan BPKP Provinsi Papua Barat', '2025-03-12 20:20:49', NULL);

SET FOREIGN_KEY_CHECKS = 1;
