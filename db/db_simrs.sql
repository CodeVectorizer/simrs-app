-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 11, 2022 at 07:14 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `created_at`, `updated_at`) VALUES
(1, 'asdfsdafsadfsdfasdf', '2021-12-08 08:13:16', '2021-12-08 08:13:16'),
(2, 'Test Category', '2021-12-24 22:19:12', '2021-12-24 22:19:12');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `speciality_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sunday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuesday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wednesday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thursday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `friday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saturday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `speciality_id`, `description`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'asdfsadfsadfsdfsadf', 2, 'sdfsdfasdfsadfasd', 'Lukman Afandi', 'Lukman Afandi', 'Lukman Afandi', 'Lukman Afandi', 'Lukman Afandi', 'Lukman Afandi', 'Lukman Afandi', '/img/doctor/avatar/1638976146.jpeg', '2021-12-08 08:09:06', '2021-12-23 05:28:53'),
(2, 'Lukman Afandi', 1, 'asdfklasjdflkasjdfl;jksd', '=', '-', '-', '-', '-', '-', '-', '/img/doctor/avatar/1640261803.jpg', '2021-12-23 05:16:43', '2021-12-23 05:16:43'),
(3, 'Dr. Lukman Afandi', 3, 'Suka Ngaji', '-', '-', '-', '-', '-', '-', '-', '/img/doctor/avatar/1640951020.png', '2021-12-31 04:43:40', '2021-12-31 09:00:14');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'sadfsdfsdfasdf', '/img/facility/image/1638976116sadfsdfsdfasdf.jpeg', '2021-12-08 08:08:36', '2021-12-08 08:08:36'),
(2, 'sdafasdfsdafsdfsadfasdfasd', '/img/facility/image/1640950697sdafasdfsdafsdfsadfasdfasd.png', '2021-12-31 04:38:17', '2021-12-31 04:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(2, 'asdfsdafsd', 'afsdafsdfsdf', '2021-12-23 22:24:39', '2021-12-23 22:24:39'),
(3, 'sadfasdfsadf', 'sadfasdfsadf', '2021-12-23 22:34:06', '2021-12-23 22:34:06'),
(4, 'sadfasdfasdf', 'asdfsadfasdf', '2021-12-23 22:34:09', '2021-12-23 22:34:09'),
(5, 'asdfasdfasd', 'fsdafasdfasdf', '2021-12-23 22:34:12', '2021-12-23 22:34:12'),
(6, 'Test Pertanyaan', 'Test Jawaban', '2021-12-23 22:43:43', '2021-12-23 22:43:43'),
(7, 'Coba Tambah Data', 'Coba Tambah Data  22222222222222222', '2021-12-24 20:13:46', '2021-12-24 20:13:46');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'sdfsdfasdfsa', '/img/gallery/image/1640302399sdfsdfasdfsa.jpeg', '2021-12-23 16:33:19', '2021-12-23 16:33:19'),
(2, 'sdfasdfas', '/img/gallery/image/1640306914sdfasdfas.jpeg', '2021-12-23 17:48:34', '2021-12-23 17:48:34'),
(3, 'asdfasdfasdfsadfasdf', '/img/gallery/image/1640950647asdfasdfasdfsadfasdf.png', '2021-12-31 04:37:27', '2021-12-31 04:37:27');

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bg_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `name`, `description`, `location`, `email`, `number_phone`, `address`, `bg_image`, `created_at`, `updated_at`) VALUES
(1, 'RS Soebandi', 'asfdasdfsadfasdf', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.317989934336!2d113.5007251!3d-7.7560592!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7022278787fc74af!2zN8KwNDUnMjEuOCJTIDExM8KwMzAnMDIuNiJF!5e0!3m2!1sen!2sid!4v1640411894774!5m2!1sen!2sid', 'asdffasdfasdfasd', 'sdffasdfasdfasdf', 'asdfasdfasdfsadfasdf', '/img/information/image/1641643476asfdasdfsadfasdf.jpeg', NULL, '2022-01-08 06:31:28');

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_11_25_173700_create_videos_table', 1),
(6, '2021_11_26_123053_create_facilities_table', 1),
(7, '2021_11_26_123201_create_mitras_table', 1),
(8, '2021_11_26_123219_create_specialities_table', 1),
(9, '2021_11_26_123250_create_galleries_table', 1),
(10, '2021_11_26_123425_create_patient_rights_table', 1),
(11, '2021_11_26_123502_create_patient_duties_table', 1),
(12, '2021_11_26_123518_create_doctors_table', 1),
(13, '2021_11_26_123910_create_categories_table', 1),
(14, '2021_11_26_125648_create_posts_table', 1),
(15, '2021_12_24_051504_create_faqs_table', 2),
(16, '2022_01_08_112426_create_information_table', 3),
(17, '2022_01_08_112441_create_testimonials_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mitras`
--

CREATE TABLE `mitras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mitras`
--

INSERT INTO `mitras` (`id`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'dsfdsafasd', '/img/mitra/image/1640301903dsfdsafasd.jpg', '2021-12-23 16:25:03', '2021-12-23 16:25:03');

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
-- Table structure for table `patient_duties`
--

CREATE TABLE `patient_duties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_duty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_rights`
--

CREATE TABLE `patient_rights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_right` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `title`, `content`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'sdafsadfasdfsadfsdafsadfasd', '<p><strong>sdafsadfasdfasdfasdfasdfasdASdfskdhfkasd</strong></p>\r\n<p><strong>asdfkhasdfjh</strong></p>', '/img/post/image/1638976423.jpeg', '2021-12-08 08:13:43', '2021-12-08 08:13:43'),
(2, 2, 'sdfasdfsdjkfhkjsdlfsdalkfjsdl;fjskldfjsladk; asdfkhsdjkfhsdjkfhasdjk asdkfhasdkjfhasdkjfhasdkljfhkasdjfhkasdfhasdjklfh', '<p>sdklfjsldfjkasdlkfjlksdjflksadhfwieyoriuqwyer892368423yi4h23khefjkasdhfhsdlkfjshadfhasdjkfasdflksjdhfkjasdhfkjashdkfjashdkjfhsadkjfh</p>', '/img/post/image/1640409585.jpg', '2021-12-24 22:19:45', '2021-12-24 22:19:45'),
(3, 1, 'sadfasdfasdfsadfsadfsadfasd', '<p>sadfsadfsdaf</p>', '/img/post/image/1640409882.jpg', '2021-12-24 22:24:42', '2021-12-24 22:24:42'),
(4, 1, 'Test Berita Ya guys Ya', '<p><strong>sdfjsldfkjsadflkjsdflk]</strong></p>\r\n<p><strong>asdfslkdfjlasdkfjlasdkjf</strong></p>\r\n<p><strong>asdfkjasdf</strong>asdklfjasdlfkjasdlfkjasdf</p>\r\n<p>sadlkfjasl;dkfjasldfjk</p>\r\n<p><em>asdfklsdfjklsadfklasdjf&nbsp;</em></p>', '/img/post/image/1640956952.jpg', '2021-12-31 06:18:43', '2021-12-31 06:22:32');

-- --------------------------------------------------------

--
-- Table structure for table `specialities`
--

CREATE TABLE `specialities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `speciality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specialities`
--

INSERT INTO `specialities` (`id`, `speciality`, `description`, `created_at`, `updated_at`) VALUES
(1, 'hfgffsfsdfasdfsd', 'sdakfjhadskjfhsadjklfh', '2021-12-08 08:08:25', '2021-12-15 11:36:56'),
(2, 'djfhhjdkashfjsadhgf', 'sdafjsahfjkhsadfaf', '2021-12-15 11:37:05', '2021-12-15 11:37:05'),
(3, 'Dokter Hewan', 'sdlkfjasld;fjsdl;kfjasl;djfasdlkjflas;dkfjlask;dfjl;asdjf', '2021-12-31 04:42:45', '2021-12-31 04:42:45'),
(4, 'fgsdfg', 'sdfgsdfgsdfg', '2022-01-04 07:06:30', '2022-01-04 07:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `testimonial`, `photo`, `job`, `created_at`, `updated_at`) VALUES
(1, 'Constance Snider123123123', 'Culpa temporibus et123123123', '/img/testimonial/photo/1641645005Culpa temporibus et123123123.png', 'Amity Riddle12312312', '2022-01-08 05:20:33', '2022-01-08 05:30:05'),
(2, 'Hall Vaughn', 'Quis debitis reprehe', NULL, 'Isadora Crane', '2022-01-08 05:20:42', '2022-01-08 05:20:42'),
(3, 'Jermaine Daniel', 'Est voluptate quod d', NULL, 'Donovan Livingston', '2022-01-08 05:21:27', '2022-01-08 05:21:27'),
(4, 'Ella Russo', 'Molestiae assumenda', '/img/testimonial/photo/1641644552Molestiae assumenda.png', 'Steel Dean', '2022-01-08 05:22:32', '2022-01-08 05:22:32'),
(5, 'Hannah Carver', 'Aut proident veniam', '/img/testimonial/photo/1641644661Aut proident veniam.png', 'Uma Burgess', '2022-01-08 05:24:21', '2022-01-08 05:24:21'),
(6, 'Ivor Stafford', 'Nulla nostrum dolore', NULL, 'Indira Bryan', '2022-01-08 05:43:43', '2022-01-08 05:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'zzvxzcvx!zcvzxcvZXC', 'sdfasdf@asdfsadf.com', NULL, '$2y$10$Yb9jqyqVPqu6fetjN9eX/.z2B8usuiWjK8sek/S4EQ6fLuUOckFpu', 'User', NULL, '/img/user/avatar/1639445716zzvxzcvx!zcvzxcvZXC.jpg', '2021-12-07 18:13:14', '2021-12-13 18:35:16'),
(2, 'Admin Lukman', 'admin@admin.com', NULL, '$2y$10$VUWX3oCoD.SAq5QHD.NK7eL87cAEaQIV6LEpLwQrEzdUS/ngIYrcq', 'User', NULL, NULL, '2021-12-22 06:54:02', '2021-12-22 06:54:02'),
(4, 'Admin', 'admin_@admin.com', NULL, '$2y$10$VUWX3oCoD.SAq5QHD.NK7eL87cAEaQIV6LEpLwQrEzdUS/ngIYrcq', 'Admin', NULL, NULL, '2021-12-22 06:54:02', '2021-12-22 06:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_speciality_id_foreign` (`speciality_id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mitras`
--
ALTER TABLE `mitras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `patient_duties`
--
ALTER TABLE `patient_duties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_rights`
--
ALTER TABLE `patient_rights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Indexes for table `specialities`
--
ALTER TABLE `specialities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mitras`
--
ALTER TABLE `mitras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient_duties`
--
ALTER TABLE `patient_duties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_rights`
--
ALTER TABLE `patient_rights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `specialities`
--
ALTER TABLE `specialities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_speciality_id_foreign` FOREIGN KEY (`speciality_id`) REFERENCES `specialities` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
