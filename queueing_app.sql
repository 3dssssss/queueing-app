-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2025 at 02:46 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `queueing_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('male','female','other') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `age`, `gender`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$6lfpJt0x0spE6iIaIzsd7eLXdmGwT5NmwUD27BlOK0SRa89HIpwa2', NULL, '2025-02-20 06:19:19', '2025-02-20 06:19:19', '09123456789', 20, 'other');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(37, '2014_10_12_000000_create_users_table', 1),
(38, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(39, '2019_08_19_000000_create_failed_jobs_table', 1),
(40, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(41, '2025_02_04_011129_create_tickets_table', 1),
(42, '2025_02_05_023344_create_admins_table', 1),
(43, '2025_02_07_053329_add_user_type_to_users_table', 1),
(44, '2025_02_11_011414_create_queue_create_table', 1),
(45, '2025_02_12_151141_create_queue_types_table', 1),
(46, '2025_02_12_160819_create_tickets_table', 2),
(47, '2025_02_13_084935_create_users_table', 2),
(48, '2025_02_13_090651_create_user_tickets_table', 2),
(49, '2025_02_13_100326_add_name_email_to_user_tickets_table', 2),
(50, '2025_02_13_113039_create_settings_table', 2),
(51, '2025_02_13_143613_add_counter_to_queue', 2),
(52, '2025_02_13_143704_add_counter_to_queue_create', 2),
(53, '2025_02_14_084431_add_phone_age_gender_to_users_table', 2),
(54, '2025_02_14_100029_add_phone_age_gender_to_user_tickets_table', 2),
(55, '2025_02_14_105134_rollback', 2),
(56, '2025_02_17_102013_add_status_to_user_tickets_table', 2),
(57, '2025_02_17_160912_add_expiry_to_user_tickets_table', 2),
(58, '2025_02_20_083531_create_notifications_table', 2),
(59, '2025_02_20_111504_add_notified_at_to_user_tickets', 2),
(60, '2025_02_20_111509_add_notified_at_to_user_tickets', 2),
(61, '2025_02_27_135518_add_status_to_queue_create', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qr_code`
--

CREATE TABLE `qr_code` (
  `qr_id` int(50) NOT NULL,
  `qr_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `qr_code`
--

INSERT INTO `qr_code` (`qr_id`, `qr_time`) VALUES
(0, '2025-01-31 01:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `queue_create`
--

CREATE TABLE `queue_create` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue_name` varchar(255) NOT NULL,
  `queue_type` enum('General','Priority','Appointment-based') NOT NULL,
  `queue_code` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL DEFAULT 'City Treasurers Office',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ticket_counter` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `queue_create`
--

INSERT INTO `queue_create` (`id`, `queue_name`, `queue_type`, `queue_code`, `department`, `created_at`, `updated_at`, `ticket_counter`, `status`) VALUES
(1, 'Assessment', 'General', 'CTOAMT', 'City Treasurer\'s Office', '2025-02-20 08:24:02', '2025-02-27 06:11:18', 'COUNTER #1', 'active'),
(2, 'Verification and Approval', 'Appointment-based', 'CTOVA', 'City Treasurer\'s Office', '2025-02-21 02:46:35', '2025-02-27 06:11:18', 'COUNTER #2', 'active'),
(3, 'Payment Processing', 'General', 'CTOPAY', 'City Treasurer\'s Office', '2025-02-21 02:47:01', '2025-02-27 06:11:18', 'COUNTER #3', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `queue_types`
--

CREATE TABLE `queue_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_expiration_minutes` int(11) NOT NULL DEFAULT 30,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_number` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `queue_code` varchar(255) NOT NULL,
  `ticket_number` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `userType` varchar(255) NOT NULL DEFAULT 'user',
  `phone` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `userType`, `phone`, `age`, `gender`) VALUES
(3, 'Danielle', 'danielle@gmail.com', NULL, '$2y$12$DRoyiDoyfwrTwGwl.Qqf1enjtmGzDYNPDxxagOIj1KTsPaU.5Pux6', NULL, '2025-02-20 06:09:07', '2025-02-20 07:44:57', 'user', '09052158340', 21, 'female'),
(5, 'dan', 'dan@gmail.com', NULL, '$2y$12$edj6psIwQH2BlsC1a0fqde8cHnEkjq7SljKbKsy32YjnvS2SHGRf.', NULL, '2025-02-20 06:57:40', '2025-02-20 07:48:52', 'user', '09001212112', 20, 'female');

-- --------------------------------------------------------

--
-- Table structure for table `user_tickets`
--

CREATE TABLE `user_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `queue_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_number` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `status` enum('waiting','active','completed','expired') NOT NULL DEFAULT 'waiting',
  `expires_at` timestamp NULL DEFAULT NULL,
  `notified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_tickets`
--

INSERT INTO `user_tickets` (`id`, `user_id`, `queue_id`, `ticket_number`, `notes`, `created_at`, `updated_at`, `name`, `email`, `phone`, `age`, `gender`, `status`, `expires_at`, `notified_at`) VALUES
(1, 3, 1, 'CTOAMT-001', 'test', '2025-02-21 00:44:23', '2025-02-21 01:27:58', 'Danielle', 'danielle@gmail.com', '09052158340', 21, 'female', 'expired', '2025-02-21 01:14:23', NULL),
(2, 3, 1, 'CTOAMT-002', 'test display of status completed', '2025-02-21 01:25:05', '2025-02-21 02:09:12', 'Danielle', 'danielle@gmail.com', '09052158340', 21, 'female', 'expired', '2025-02-21 01:55:05', NULL),
(3, 3, 1, 'CTOAMT-003', 'expired status set automatically', '2025-02-21 02:20:47', '2025-02-21 02:23:01', 'Danielle', 'danielle@gmail.com', '09052158340', 21, 'female', 'expired', '2025-02-21 02:23:00', NULL),
(4, 3, 3, 'CTOPAY-001', 'counters check', '2025-02-21 02:53:25', '2025-02-21 03:24:01', 'Danielle', 'danielle@gmail.com', '09052158340', 21, 'female', 'expired', '2025-02-21 03:23:25', NULL),
(5, 3, 2, 'CTOVA-001', 'TEST', '2025-02-25 01:21:04', '2025-02-25 02:11:14', 'Danielle', 'danielle@gmail.com', '09052158340', 21, 'female', 'expired', '2025-02-25 01:37:04', NULL),
(6, 3, 3, 'CTOPAY-002', 'notif', '2025-02-25 02:20:10', '2025-02-25 02:56:56', 'Danielle', 'danielle@gmail.com', '09052158340', 21, 'female', 'expired', '2025-02-25 02:50:10', NULL),
(7, 3, 1, 'CTOAMT-004', 'counter', '2025-02-25 07:01:56', '2025-02-26 00:28:25', 'Danielle', 'danielle@gmail.com', '09052158340', 21, 'female', 'expired', '2025-02-25 08:21:56', NULL),
(8, 3, 1, 'CTOAMT-005', 'counter', '2025-02-26 01:26:08', '2025-02-27 03:28:44', 'Danielle', 'danielle@gmail.com', '09052158340', 21, 'female', 'expired', '2025-02-26 01:56:08', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `qr_code`
--
ALTER TABLE `qr_code`
  ADD PRIMARY KEY (`qr_id`);

--
-- Indexes for table `queue_create`
--
ALTER TABLE `queue_create`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `queue_create_queue_code_unique` (`queue_code`);

--
-- Indexes for table `queue_types`
--
ALTER TABLE `queue_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tickets_ticket_number_unique` (`ticket_number`),
  ADD KEY `tickets_user_id_foreign` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_ticket_number_unique` (`ticket_number`),
  ADD KEY `user_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_tickets`
--
ALTER TABLE `user_tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_tickets_ticket_number_unique` (`ticket_number`),
  ADD KEY `user_tickets_user_id_foreign` (`user_id`),
  ADD KEY `user_tickets_queue_id_foreign` (`queue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `queue_create`
--
ALTER TABLE `queue_create`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `queue_types`
--
ALTER TABLE `queue_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_tickets`
--
ALTER TABLE `user_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_tickets`
--
ALTER TABLE `user_tickets`
  ADD CONSTRAINT `user_tickets_queue_id_foreign` FOREIGN KEY (`queue_id`) REFERENCES `queue_create` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
