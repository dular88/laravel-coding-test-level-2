-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2023 at 11:05 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mindgraph`
--

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_03_06_140440_create_projects_table', 1),
(6, '2023_03_04_130803_create_tasks_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'LaravelTest', 'e992a5d3b73ee2083d209d3cf825af66821eb763f7fb324cebb9757d0312415e', '[\"*\"]', NULL, '2023-03-06 08:58:39', '2023-03-06 08:58:39'),
(2, 'App\\Models\\User', 1, 'LaravelTest', 'd5ff9440ab58d0e01b4f704e3a57c4afaf0adce9b394abc727df5088718db464', '[\"*\"]', '2023-03-06 09:02:26', '2023-03-06 09:02:07', '2023-03-06 09:02:26'),
(3, 'App\\Models\\User', 2, 'LaravelTest', 'fb61b0319e71ccb944cae709b337f2114d103c15b4a01d6a47f5b04f488d11cd', '[\"*\"]', NULL, '2023-03-06 09:02:26', '2023-03-06 09:02:26'),
(4, 'App\\Models\\User', 2, 'LaravelTest', '0e30f02d28abc50686ea23e5bd264282a19eba3a5336e31b9f73e6a0becc7df6', '[\"*\"]', '2023-03-06 09:04:29', '2023-03-06 09:02:52', '2023-03-06 09:04:29'),
(5, 'App\\Models\\User', 3, 'LaravelTest', 'b8c905984592e30907868a589720af4200f0d738b400b68e42b401441e6c5266', '[\"*\"]', NULL, '2023-03-06 09:04:55', '2023-03-06 09:04:55'),
(6, 'App\\Models\\User', 2, 'LaravelTest', '549861a50072252fb820c53ec4dbd4604db6a74a2e4ac71d13b7cfc1396ecaa4', '[\"*\"]', '2023-03-06 09:06:31', '2023-03-06 09:05:12', '2023-03-06 09:06:31'),
(7, 'App\\Models\\User', 3, 'LaravelTest', 'a104b1ee6e4d32316c7687d50b5468e90d81c3fec53d99d5cefc61eba692d00a', '[\"*\"]', '2023-03-06 09:38:23', '2023-03-06 09:06:55', '2023-03-06 09:38:23'),
(8, 'App\\Models\\User', 2, 'LaravelTest', '76ba106f85a7da7aa35612ba8f810482e804fc4caeeba6cd31964439a9217d16', '[\"*\"]', '2023-03-06 09:38:51', '2023-03-06 09:38:50', '2023-03-06 09:38:51'),
(9, 'App\\Models\\User', 4, 'LaravelTest', '4258f63962d57836c3320515c51c7ae530d858e239c426d1d8f19f173b9747ca', '[\"*\"]', NULL, '2023-03-06 09:39:26', '2023-03-06 09:39:26'),
(10, 'App\\Models\\User', 5, 'LaravelTest', '3ae4caba47dcea1fb5b2ca252a20becc862c56d5ac81fe44d73e367db726e477', '[\"*\"]', NULL, '2023-03-06 09:43:35', '2023-03-06 09:43:35'),
(11, 'App\\Models\\User', 2, 'LaravelTest', '212faf06f13070a092561380ded4a2104554b8ba134ea0b6f36dec063a240cbe', '[\"*\"]', '2023-03-06 09:44:39', '2023-03-06 09:43:46', '2023-03-06 09:44:39'),
(12, 'App\\Models\\User', 4, 'LaravelTest', '4d79bb582bf8c80e1c7d6307ad164feda7a0bf5449cd3cd9ff153f4d2a0e4919', '[\"*\"]', '2023-03-06 09:44:57', '2023-03-06 09:44:57', '2023-03-06 09:44:57'),
(13, 'App\\Models\\User', 5, 'LaravelTest', 'aa3bd5e369e61516573336cc29692859ed1a987462e8419d9111ea42867cbb72', '[\"*\"]', '2023-03-06 09:45:22', '2023-03-06 09:45:16', '2023-03-06 09:45:22'),
(14, 'App\\Models\\User', 4, 'LaravelTest', '5ddf009a5ab0a050d02b14bd57034313a853e4c3be70b2da52bc3a52c18c627b', '[\"*\"]', '2023-03-06 09:45:48', '2023-03-06 09:45:41', '2023-03-06 09:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Project1 upd', '2023-03-06 09:03:54', '2023-03-06 09:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('NOT_STARTED','IN_PROGRESS','READY_FOR_TEST','COMPLETED') DEFAULT 'NOT_STARTED',
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `status`, `project_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Title 1', 'Desc 1', 'IN_PROGRESS', 1, 3, '2023-03-06 09:05:41', '2023-03-06 09:22:14'),
(3, 'task2', 'task2 description', 'READY_FOR_TEST', 1, 4, '2023-03-06 09:44:13', '2023-03-06 09:45:47'),
(4, 'task3', 'task3 description', 'IN_PROGRESS', 1, 5, '2023-03-06 09:44:39', '2023-03-06 09:45:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` enum('ADMIN','PRODUCT_OWNER','TEAM_MEMBER') DEFAULT 'TEAM_MEMBER',
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'ADMIN', 'admin@gmail.com', NULL, '$2y$10$YwEHVoUw3Te28g5BEcGgOOcBeulwKYBraRTHhraOKIWM5XaOR/hPm', NULL, '2023-03-06 08:58:39', '2023-03-06 08:58:39'),
(2, 'pwner1', 'pwner1@gmail.com', 'PRODUCT_OWNER', 'pwner1@gmail.com', NULL, '$2y$10$ucr7PafPicyTsfnBtK3RYOitI5/Qd2qDIuR9Q0MWUkpOatm0UvYRq', NULL, '2023-03-06 09:02:26', '2023-03-06 09:02:26'),
(3, 'team1', 'team1@gmail.com', 'TEAM_MEMBER', 'team1@gmail.com', NULL, '$2y$10$vCrfkgQLIrqwwfn5NzmT9.H9QOX5ikVzSXGmfyQiYqA.SxJTfhEB2', NULL, '2023-03-06 09:04:55', '2023-03-06 09:04:55'),
(4, 'team2', 'team2@gmail.com', 'TEAM_MEMBER', 'team2@gmail.com', NULL, '$2y$10$3hZEpdfeaab9nogwKfFiquAFLC0zTMRPCjVhoIdzssq9wikmmsMOy', NULL, '2023-03-06 09:39:26', '2023-03-06 09:39:26'),
(5, 'team3', 'team3@gmail.com', 'TEAM_MEMBER', 'team3@gmail.com', NULL, '$2y$10$sPDYD13DrlJAmcLPDJeIy.FmFHNin2N4l9PwKbXhWNLj.4pUjxNTG', NULL, '2023-03-06 09:43:35', '2023-03-06 09:43:35');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_project_id_foreign` (`project_id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
