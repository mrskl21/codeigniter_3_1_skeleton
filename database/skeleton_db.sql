-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 23, 2023 at 02:13 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skeleton_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `title`, `description`) VALUES
(1, 'auth-users', ''),
(2, 'auth-roles', ''),
(3, 'auth-permissions', '');

-- --------------------------------------------------------

--
-- Table structure for table `auth_roles`
--

CREATE TABLE `auth_roles` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_roles`
--

INSERT INTO `auth_roles` (`id`, `title`, `description`) VALUES
(1, 'Root', 'Root'),
(2, 'Admin', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `auth_roles_has_permissions`
--

CREATE TABLE `auth_roles_has_permissions` (
  `id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `permissions_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_roles_has_permissions`
--

INSERT INTO `auth_roles_has_permissions` (`id`, `roles_id`, `permissions_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `auth_users`
--

CREATE TABLE `auth_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_users`
--

INSERT INTO `auth_users` (`id`, `username`, `password`, `roles_id`, `email`, `fullname`, `photo`, `status`, `created_at`) VALUES
(1, 'root', '63a9f0ea7bb98050796b649e85481845', 1, 'root@mail.com', 'Root', NULL, 1, 1614948257),
(2, 'ylasahido', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 'ylasahido@gmail.com', 'Yanto Lasahido', NULL, 1, 1614948257),
(3, 'bayu_skl', '63a9f0ea7bb98050796b649e85481845', 1, 'bayulasahido@gmail.com', 'Bayu Lasahido', NULL, 1, 1614948257),
(4, 'sittiutari', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 'sittiutari@gmail.com', 'Sitti Utari', NULL, 1, 1616314068);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_roles`
--
ALTER TABLE `auth_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_roles_has_permissions`
--
ALTER TABLE `auth_roles_has_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_users`
--
ALTER TABLE `auth_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_roles`
--
ALTER TABLE `auth_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_roles_has_permissions`
--
ALTER TABLE `auth_roles_has_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_users`
--
ALTER TABLE `auth_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
