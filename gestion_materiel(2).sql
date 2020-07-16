-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 16, 2020 at 01:35 PM
-- Server version: 10.3.15-MariaDB-1
-- PHP Version: 7.3.4-2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_materiel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bon_entrant`
--

CREATE TABLE `bon_entrant` (
  `id` int(11) NOT NULL,
  `materiel_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `pack` int(11) NOT NULL,
  `fournisseur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bon_entrant`
--

INSERT INTO `bon_entrant` (`id`, `materiel_id`, `quantite`, `created_at`, `pack`, `fournisseur_id`) VALUES
(5, 4, 10, '2020-09-08 10:28:38', 2, 2),
(7, 2, 75, '2020-07-10 22:42:57', 4, 3),
(8, 2, 3, '2020-07-10 22:43:50', 5, 4),
(9, 4, 74, '2020-07-10 22:43:50', 5, 4),
(11, 2, 7, '2020-07-10 22:44:49', 7, 2),
(12, 4, 54, '2020-07-10 22:44:49', 7, 2),
(14, 4, 7, '2020-07-11 14:02:42', 8, 5),
(15, 7, 21, '2020-07-11 14:02:42', 8, 5),
(16, 2, 45, '2020-07-11 14:30:36', 9, 4),
(18, 4, 12, '2020-07-11 23:46:53', 10, 2),
(19, 2, 4, '2020-07-11 23:46:53', 10, 2),
(20, 4, 78, '2020-07-11 23:47:42', 11, 7),
(21, 6, 54, '2020-07-11 23:47:42', 11, 7),
(22, 2, 58, '2020-07-12 11:33:01', 12, 2),
(23, 4, 75, '2020-07-15 15:10:02', 13, 4),
(24, 5, 78, '2020-07-15 15:10:02', 13, 4),
(25, 7, 78, '2020-07-15 15:10:02', 13, 4),
(26, 4, 54, '2020-07-15 23:01:00', 14, 2),
(27, 5, 45, '2020-07-15 23:02:30', 15, 2),
(28, 2, 45, '2020-07-15 23:03:17', 16, 4),
(29, 5, 78, '2020-07-15 23:04:01', 17, 2),
(30, 2, 45, '2020-07-15 23:07:44', 18, 2),
(31, 6, 22, '2020-07-15 23:10:43', 19, 3);

-- --------------------------------------------------------

--
-- Table structure for table `bon_sortant`
--

CREATE TABLE `bon_sortant` (
  `id` int(11) NOT NULL,
  `materiel_id` int(11) NOT NULL,
  `personnel_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `pack` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bon_sortant`
--

INSERT INTO `bon_sortant` (`id`, `materiel_id`, `personnel_id`, `quantite`, `pack`, `created_at`) VALUES
(1, 2, 2, 45, 1, '2020-07-08 16:28:50'),
(2, 2, 2, 20, 2, '2020-07-09 10:37:31'),
(3, 4, 2, 9, 3, '2020-07-09 21:45:49'),
(6, 6, 2, 45, 6, '2020-07-10 00:15:38'),
(9, 6, 4, 7, 7, '2020-07-11 12:22:23'),
(12, 4, 2, 78, 8, '2020-07-11 23:22:52'),
(13, 4, 2, 54, 9, '2020-07-11 23:48:29'),
(14, 2, 3, 14, 10, '2020-07-11 23:49:50'),
(15, 2, 2, 77, 11, '2020-07-15 23:12:34'),
(16, 2, 2, 19, 12, '2020-07-15 23:24:43'),
(17, 4, 2, 7, 12, '2020-07-15 23:24:43'),
(18, 6, 2, 10, 12, '2020-07-15 23:24:43'),
(19, 4, 5, 12, 13, '2020-07-15 23:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

CREATE TABLE `facture` (
  `id` int(11) NOT NULL,
  `pack` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facture`
--

INSERT INTO `facture` (`id`, `pack`, `created_at`, `file`) VALUES
(1, 1, '2020-07-08 15:56:43', 'facture_F0001.pdf'),
(2, 2, '2020-07-09 10:28:38', 'facture_F0002.pdf'),
(3, 3, '2020-07-10 00:16:25', 'facture_F0003.pdf'),
(4, 4, '2020-07-10 22:42:57', 'facture_F0004.pdf'),
(5, 5, '2020-07-10 22:43:50', 'facture_F0005.pdf'),
(6, 6, '2020-07-10 22:44:06', 'facture_F0006.pdf'),
(7, 7, '2020-07-10 22:44:49', 'facture_F0007.pdf'),
(8, 8, '2020-07-11 14:02:43', 'facture_F0008.pdf'),
(9, 9, '2020-07-11 14:30:36', 'facture_F0009.pdf'),
(10, 10, '2020-07-11 14:35:02', 'facture_F00010.pdf'),
(11, 10, '2020-07-11 23:46:53', '0'),
(12, 11, '2020-07-11 23:47:42', 'facture_F00011.pdf'),
(13, 12, '2020-07-12 11:33:01', 'facture_F00012.pdf'),
(14, 13, '2020-07-15 14:56:00', 'facture_F00013.pdf'),
(15, 13, '2020-07-15 15:10:02', '0'),
(16, 14, '2020-07-15 23:01:01', 'facture_F00014.pdf'),
(17, 15, '2020-07-15 23:02:31', 'facture_F00015.pdf'),
(18, 16, '2020-07-15 23:03:17', 'facture_F00016.pdf'),
(19, 17, '2020-07-15 23:04:01', 'facture_F00017.pdf'),
(20, 18, '2020-07-15 23:07:44', 'facture_F00018.pdf'),
(21, 19, '2020-07-15 23:10:43', 'facture_F00019.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `fiche`
--

CREATE TABLE `fiche` (
  `id` int(11) NOT NULL,
  `pack` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fiche`
--

INSERT INTO `fiche` (`id`, `pack`, `created_at`, `file`) VALUES
(1, 1, '2020-07-08 16:28:50', 'fiche_FI0001.pdf'),
(2, 2, '2020-07-09 10:37:31', 'fiche_FI0002.pdf'),
(3, 3, '2020-07-09 21:45:49', 'fiche_FI0003.pdf'),
(4, 4, '2020-07-10 00:14:08', 'fiche_FI0004.pdf'),
(5, 5, '2020-07-10 00:14:49', 'fiche_FI0005.pdf'),
(6, 6, '2020-07-10 00:15:39', 'fiche_FI0006.pdf'),
(7, 7, '2020-07-11 12:22:23', 'fiche_FI0007.pdf'),
(8, 8, '2020-07-11 14:05:46', 'fiche_FI0008.pdf'),
(9, 9, '2020-07-11 14:06:52', 'fiche_FI0009.pdf'),
(10, 8, '2020-07-11 23:22:52', '0'),
(11, 9, '2020-07-11 23:48:29', '0'),
(12, 10, '2020-07-11 23:49:50', 'fiche_FI00010.pdf'),
(13, 11, '2020-07-15 23:12:34', 'fiche_FI00011.pdf'),
(14, 12, '2020-07-15 23:24:43', 'fiche_FI00012.pdf'),
(15, 13, '2020-07-15 23:25:26', 'fiche_FI00013.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `fonction`
--

CREATE TABLE `fonction` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fonction`
--

INSERT INTO `fonction` (`id`, `libelle`) VALUES
(1, 'Adjoint'),
(2, 'Fonction 5'),
(3, 'Directeur'),
(4, 'Juyt'),
(5, 'Ty'),
(6, 'Adjointr');

-- --------------------------------------------------------

--
-- Table structure for table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`, `contact`, `create_at`) VALUES
(2, 'ORANGE', '457578', '2020-07-08 15:55:30'),
(3, 'AIRTEL', '80000', '2020-07-08 15:55:51'),
(4, 'BIP', '54545', '2020-07-09 11:25:45'),
(5, 'START', '454', '2020-07-11 14:01:48'),
(6, 'RISA', '5555', '2020-07-11 14:02:03'),
(7, 'TELMA', '77', '2020-07-11 23:46:11');

--
-- Triggers `fournisseur`
--
DELIMITER $$
CREATE TRIGGER `deleteforu2` BEFORE DELETE ON `fournisseur` FOR EACH ROW DELETE FROM `bon_entrant` WHERE `bon_entrant`.`fournisseur_id` = Old.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `materiel`
--

CREATE TABLE `materiel` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materiel`
--

INSERT INTO `materiel` (`id`, `designation`, `quantite`, `prix_unitaire`, `created_at`) VALUES
(2, 'Souris', 183, 450000, '2020-07-08 15:52:28'),
(4, 'Clavier', 204, 784200, '2020-07-08 15:53:08'),
(5, 'Kut', 201, 42000, '2020-07-08 15:53:47'),
(6, 'juot', 69, 50000, '2020-07-08 15:53:59'),
(7, 'Goo', 79, 400000, '2020-07-08 15:54:13');

--
-- Triggers `materiel`
--
DELIMITER $$
CREATE TRIGGER `deletemater` BEFORE DELETE ON `materiel` FOR EACH ROW DELETE FROM `bon_sortant` WHERE `bon_sortant`.`materiel_id` = Old.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deletemater2` BEFORE DELETE ON `materiel` FOR EACH ROW DELETE FROM `bon_entrant` WHERE `bon_entrant`.`materiel_id` = Old.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200703161136', '2020-07-04 19:56:45'),
('20200703161610', '2020-07-04 19:56:45'),
('20200703164252', '2020-07-04 19:56:45'),
('20200703165121', '2020-07-04 19:56:45'),
('20200703171512', '2020-07-04 19:56:45'),
('20200704195458', '2020-07-04 19:56:45'),
('20200704195809', '2020-07-04 19:59:02'),
('20200704204532', '2020-07-04 20:45:50'),
('20200704204815', '2020-07-04 20:48:23'),
('20200706121033', '2020-07-06 15:53:30'),
('20200706155118', '2020-07-06 18:33:44'),
('20200706182945', '2020-07-06 18:34:21'),
('20200707194655', '2020-07-08 11:52:11'),
('20200708114658', '2020-07-08 12:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE `personnel` (
  `id` int(11) NOT NULL,
  `fonction_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`id`, `fonction_id`, `nom`) VALUES
(2, 3, 'Alfinace'),
(3, 2, 'gogo'),
(4, 1, 'ALFA'),
(5, 1, 'Lala');

--
-- Triggers `personnel`
--
DELIMITER $$
CREATE TRIGGER `deletepers` BEFORE DELETE ON `personnel` FOR EACH ROW DELETE FROM `bon_sortant` WHERE `bon_sortant`.`personnel_id` = Old.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `roles`, `fullname`, `username`, `address`, `contact`) VALUES
(1, 'roddy@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$q4wtMAkFXiBO8LnfPeFArg$B7osu222QowHPNC+WI/aafyR6MDIpO2IK4reklhpSb8', '[\"ROLE_ADMIN\"]', 'roddy', 'roddy', 'Morondava', '4444'),
(2, 'admin@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$YaqnD9kFdyzGW8J9L4g6cA$c/4Eh+whKyQZe/q3G8ij9QfF9L9SUjwIu8WtcUF5j7U', '[\"ROLE_ADMIN\"]', 'admin', 'admin', 'manakara', '1001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bon_entrant`
--
ALTER TABLE `bon_entrant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UNIQ_98630BDF16880AAF` (`materiel_id`) USING BTREE,
  ADD KEY `UNIQ_98630BDF670C757F` (`fournisseur_id`) USING BTREE;

--
-- Indexes for table `bon_sortant`
--
ALTER TABLE `bon_sortant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FD1ADBF216880AAF` (`materiel_id`),
  ADD KEY `IDX_FD1ADBF21C109075` (`personnel_id`);

--
-- Indexes for table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fiche`
--
ALTER TABLE `fiche`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fonction`
--
ALTER TABLE `fonction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materiel`
--
ALTER TABLE `materiel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A6BCF3DE57889920` (`fonction_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bon_entrant`
--
ALTER TABLE `bon_entrant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `bon_sortant`
--
ALTER TABLE `bon_sortant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `facture`
--
ALTER TABLE `facture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `fiche`
--
ALTER TABLE `fiche`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `fonction`
--
ALTER TABLE `fonction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bon_entrant`
--
ALTER TABLE `bon_entrant`
  ADD CONSTRAINT `FK_98630BDF16880AAF` FOREIGN KEY (`materiel_id`) REFERENCES `materiel` (`id`),
  ADD CONSTRAINT `FK_98630BDF670C757F` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseur` (`id`);

--
-- Constraints for table `bon_sortant`
--
ALTER TABLE `bon_sortant`
  ADD CONSTRAINT `FK_FD1ADBF216880AAF` FOREIGN KEY (`materiel_id`) REFERENCES `materiel` (`id`),
  ADD CONSTRAINT `FK_FD1ADBF21C109075` FOREIGN KEY (`personnel_id`) REFERENCES `personnel` (`id`);

--
-- Constraints for table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `FK_A6BCF3DE57889920` FOREIGN KEY (`fonction_id`) REFERENCES `fonction` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
