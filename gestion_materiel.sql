-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 11 juil. 2020 à 15:47
-- Version du serveur :  10.3.15-MariaDB-1
-- Version de PHP : 7.3.4-2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_materiel`
--

-- --------------------------------------------------------

--
-- Structure de la table `bon_entrant`
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
-- Déchargement des données de la table `bon_entrant`
--

INSERT INTO `bon_entrant` (`id`, `materiel_id`, `quantite`, `created_at`, `pack`, `fournisseur_id`) VALUES
(1, 2, 72, '2020-07-08 15:56:42', 1, 1),
(2, 3, 7, '2020-07-08 15:56:42', 1, 1),
(3, 6, 55, '2020-07-08 15:56:42', 1, 1),
(4, 3, 60, '2020-07-09 10:28:38', 2, 2),
(5, 4, 10, '2020-09-08 10:28:38', 2, 2),
(6, 1, 75, '2020-07-10 00:16:24', 3, 2),
(7, 2, 75, '2020-07-10 22:42:57', 4, 3),
(8, 2, 3, '2020-07-10 22:43:50', 5, 4),
(9, 4, 74, '2020-07-10 22:43:50', 5, 4),
(10, 3, 78, '2020-07-10 22:44:06', 6, 4),
(11, 2, 7, '2020-07-10 22:44:49', 7, 2),
(12, 4, 54, '2020-07-10 22:44:49', 7, 2),
(13, 1, 45, '2020-07-11 14:02:42', 8, 5),
(14, 4, 7, '2020-07-11 14:02:42', 8, 5),
(15, 7, 21, '2020-07-11 14:02:42', 8, 5),
(16, 2, 45, '2020-07-11 14:30:36', 9, 4),
(17, 2, 4, '2020-07-11 14:35:02', 10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `bon_sortant`
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
-- Déchargement des données de la table `bon_sortant`
--

INSERT INTO `bon_sortant` (`id`, `materiel_id`, `personnel_id`, `quantite`, `pack`, `created_at`) VALUES
(1, 2, 2, 45, 1, '2020-07-08 16:28:50'),
(2, 2, 2, 20, 2, '2020-07-09 10:37:31'),
(3, 4, 2, 9, 3, '2020-07-09 21:45:49'),
(4, 3, 2, 5, 4, '2020-07-10 00:14:07'),
(5, 3, 3, 4, 5, '2020-07-10 00:14:49'),
(6, 6, 2, 45, 6, '2020-07-10 00:15:38'),
(7, 3, 2, 20, 6, '2020-07-10 00:15:38'),
(8, 3, 4, 75, 7, '2020-07-11 12:22:23'),
(9, 6, 4, 7, 7, '2020-07-11 12:22:23'),
(10, 1, 2, 40, 8, '2020-07-11 14:05:46'),
(11, 7, 1, 20, 9, '2020-07-11 14:06:51');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id` int(11) NOT NULL,
  `pack` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `facture`
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
(10, 10, '2020-07-11 14:35:02', 'facture_F00010.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `fiche`
--

CREATE TABLE `fiche` (
  `id` int(11) NOT NULL,
  `pack` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fiche`
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
(9, 9, '2020-07-11 14:06:52', 'fiche_FI0009.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `fonction`
--

CREATE TABLE `fonction` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fonction`
--

INSERT INTO `fonction` (`id`, `libelle`) VALUES
(1, 'Adjoint'),
(2, 'Fonction 5'),
(3, 'Directeur'),
(4, 'Juyt'),
(5, 'Ty');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`, `contact`, `create_at`) VALUES
(1, 'TELMA', '24545454', '2020-07-08 15:55:15'),
(2, 'ORANGE', '457578', '2020-07-08 15:55:30'),
(3, 'AIRTEL', '80000', '2020-07-08 15:55:51'),
(4, 'BIP', '54545', '2020-07-09 11:25:45'),
(5, 'START', '454', '2020-07-11 14:01:48'),
(6, 'RISA', '5555', '2020-07-11 14:02:03');

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

CREATE TABLE `materiel` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`id`, `designation`, `quantite`, `prix_unitaire`, `created_at`) VALUES
(1, 'Ordi', 80, 780000, '2020-07-08 15:52:11'),
(2, 'Souris', 141, 450000, '2020-07-08 15:52:28'),
(3, 'Arduino', 41, 42000, '2020-07-08 15:52:39'),
(4, 'Clavier', 136, 784200, '2020-07-08 15:53:08'),
(5, 'Kut', 0, 42000, '2020-07-08 15:53:47'),
(6, 'juot', 3, 50000, '2020-07-08 15:53:59'),
(7, 'Goo', 1, 400000, '2020-07-08 15:54:13');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
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
-- Structure de la table `personnel`
--

CREATE TABLE `personnel` (
  `id` int(11) NOT NULL,
  `fonction_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id`, `fonction_id`, `nom`) VALUES
(1, 2, 'Alfimnae'),
(2, 3, 'Alfinace'),
(3, 2, 'gogo'),
(4, 1, 'ALFA');

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
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
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `roles`, `fullname`, `username`, `address`, `contact`) VALUES
(1, 'roddy@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$aPlDdSIUj9Rcsi7AvxUJlw$/uUVB5t7DfQPYhxpRtfqqbDpL2Ds+C0xKCOXEB5N+bY', '[\"ROLE_ADMIN\"]', 'roddy', 'roddy', 'Morondava', '4444'),
(2, 'admin@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$YaqnD9kFdyzGW8J9L4g6cA$c/4Eh+whKyQZe/q3G8ij9QfF9L9SUjwIu8WtcUF5j7U', '[\"ROLE_ADMIN\"]', 'admin', 'admin', 'manakara', '1001');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bon_entrant`
--
ALTER TABLE `bon_entrant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UNIQ_98630BDF16880AAF` (`materiel_id`) USING BTREE,
  ADD KEY `UNIQ_98630BDF670C757F` (`fournisseur_id`) USING BTREE;

--
-- Index pour la table `bon_sortant`
--
ALTER TABLE `bon_sortant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FD1ADBF216880AAF` (`materiel_id`),
  ADD KEY `IDX_FD1ADBF21C109075` (`personnel_id`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fiche`
--
ALTER TABLE `fiche`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fonction`
--
ALTER TABLE `fonction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A6BCF3DE57889920` (`fonction_id`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bon_entrant`
--
ALTER TABLE `bon_entrant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `bon_sortant`
--
ALTER TABLE `bon_sortant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `fiche`
--
ALTER TABLE `fiche`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `fonction`
--
ALTER TABLE `fonction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bon_entrant`
--
ALTER TABLE `bon_entrant`
  ADD CONSTRAINT `FK_98630BDF16880AAF` FOREIGN KEY (`materiel_id`) REFERENCES `materiel` (`id`),
  ADD CONSTRAINT `FK_98630BDF670C757F` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseur` (`id`);

--
-- Contraintes pour la table `bon_sortant`
--
ALTER TABLE `bon_sortant`
  ADD CONSTRAINT `FK_FD1ADBF216880AAF` FOREIGN KEY (`materiel_id`) REFERENCES `materiel` (`id`),
  ADD CONSTRAINT `FK_FD1ADBF21C109075` FOREIGN KEY (`personnel_id`) REFERENCES `personnel` (`id`);

--
-- Contraintes pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `FK_A6BCF3DE57889920` FOREIGN KEY (`fonction_id`) REFERENCES `fonction` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
