-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 26 mai 2023 à 00:37
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vaccination`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `nom`, `prenom`, `message`, `created_at`) VALUES
(1, 'Prince', 'Petyth', 'le site est nickel chrome.', '2022-11-13 05:08:52'),
(2, 'Prince', 'Petyth', 'le site est nickel chrome.', '2022-11-13 05:09:39'),
(3, 'Prince', 'Petyth', 'le site est nickel chrome.', '2022-11-13 05:11:21'),
(4, 'Prince', 'Petyth', 'le site est nickel chrome.', '2022-11-13 05:11:57'),
(5, 'ursule', 'DORIAN', 'super cool le site', '2022-11-13 05:13:14'),
(6, 'thomas', 'timothy', 'j\'adore le logo du site, site fuide', '2022-11-13 06:02:54'),
(7, 'georges', 'thomas', 'bon footer', '2022-11-13 06:04:29'),
(8, 'thomas', 'timothy', 'la jolie icone', '2022-11-13 06:05:56'),
(9, 'georges', 'thomas', 'le rire', '2022-11-13 06:06:43'),
(10, 'georges', 'thomas', 'le rire', '2022-11-13 06:07:28');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `email`, `message`, `created_at`) VALUES
(1, 'Prince', 'petythprincebelvy@gmail.com', 'la vie est belle.', '2022-11-11 12:37:35'),
(2, 'Prince', 'petythprincebelvy@gmail.com', 'la vie est belle.', '2022-11-11 12:38:18'),
(3, 'Prince', 'petythprincebelvy@gmail.com', 'la vie est belle.', '2022-11-11 12:38:38'),
(4, 'Prince', 'petythprincebelvy@gmail.com', 'la vie est belle.', '2022-11-11 12:39:29'),
(5, 'ursule', 'ursule@gmail.com', 'compléter les pages.', '2022-11-11 12:41:10');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `role` varchar(20) NOT NULL,
  `token` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `nom`, `prenom`, `password`, `modified_at`, `created_at`, `role`, `token`) VALUES
(1, 'petythprincebelvie@gmail.com', '', '', 'claude76', '0000-00-00 00:00:00', '2022-11-10 18:29:22', 'admin', 'JEqeAMKa6mk5ECt6G1b55pP91AqWcbjwnlIymIx0NnPAL6PJL5cI9UXRZ2FXoPdRlOCx467zy38amb7f'),
(2, 'ursule@gmail.com', '', '', '$2y$10$ncy1TuhiuW5X20GjMhXPIuE1ajevt3bRXAh9A8/peAqA4ZOGvlRqa', '0000-00-00 00:00:00', '2022-11-10 21:45:13', 'abonne', 'MJYNmdvRaoW4eXUaPfxi70VQXZSSAKtBhzhB4aA5dlIIEXh8u1LPVNHmmB75wGK9RdbJJ4u0xi3PELLx'),
(3, 'lucas@gmail.com', '', 'lucas', '$2y$10$IQlyKdV9SMqlGjuMDmo.Cu36lHqzfMEUFRK1kCAkNEbAHYaSo2Mi6', '0000-00-00 00:00:00', '2022-11-11 13:35:00', 'abonne', 'eK3zdR9YzBo6iO0AZ7naKAwSDj19r8oWqCBkue34bBYI8PTyNSLN1x9CzHSmU2xk5Iz01B9mfrcri7tm'),
(4, 'HUGO@GMAIL.com', '', 'hugo', '$2y$10$i/qL8Lv/Z1VTmaIr1szSduoZV/SlAhWcHqCtt0/VC4.m2t.G0DtNa', '0000-00-00 00:00:00', '2022-11-11 15:44:05', 'abonne', 'a4AQ5hLgIWTq5i4KG5QuehxLyIUqZ4aa2PPxq2PUUX8RIRgUsATUBGMJIaMECDHPtRM75CjOZqdPJnX4'),
(5, 'lourde@gmail.com', 'miakouikila', 'lourdee', '$2y$10$vEFZm8tc6r0lqphZuWtcmew3jRf8PP7Xjg83KcWR5KkJE1vt7etNG', '0000-00-00 00:00:00', '2022-11-12 12:59:18', 'abonne', 'tZcAYQbMa7seqjiC3ejSWZ7EF3VVvnfTDg312bnJ2eFTWbx80oN5zdwUodAv6vTcXIiYEba8rUTLtSPW'),
(6, 'GEORGES@gmail.com', '', 'GEORGES', '$2y$10$iO3/U5BPMml2V6zf3p.Mt.woiq2DHX4frTOQt8phJYCzbAxejPgBS', '0000-00-00 00:00:00', '2022-11-12 15:46:40', 'abonne', 'chgLRbPkPEeLzaeXfHlYHZFUJHXkeTSMAPV3dAwoPEshw1J0ucUkt7hq5lBG0yBddWuR6yqetGnCT2ht'),
(8, 'ACHILLE@gmail.com', '', 'ACHILLE', '$2y$10$19/P5vzlEgThjhppXBiqQeBkl9D9zzq/klthuelPymRJNoPaGrBPq', '0000-00-00 00:00:00', '2022-11-14 00:41:20', 'abonne', 'hZ3R9f01u6jpxLO0RjAqIF9quG4Zz9FITVSA0qZ9sdMuwa0NNfsswnDpcUUvqxLmLDkpv8sL2EC1MjFT'),
(9, 'ursula@gmail.com', 'ursula', 'ursule', '$2y$10$cV7J3WM30KH3GhigcTGUxezJhmvr873V1yEW/xa1SdkW/PR4I5ynK', '0000-00-00 00:00:00', '2022-11-14 00:53:44', 'admin', 'Ftz8Ez16Lh55zyJUQiLqCsr8JGbUSRMSVKJFlawutuzUWEmDCOToNuYVBc7hTujq5uzwRKh3B0RXgh76'),
(10, 'Claudyshow@gmail.com', '', 'Miakouikila', '$2y$10$H.Ej6GQt6ztZdkPydVcBV.P1iCpMKFfiUb0pE9hck3QoO5GUttZhS', '0000-00-00 00:00:00', '2023-05-25 23:51:51', 'abonne', 'HatMRCF9X0Tx6NcL8UlTyjn0nigsn1mNjsWmdg2fvXbmZuKLjm7QdIhhC6TvEE8OCBLbhdIFEO3F3Fxs'),
(11, 'miakouikilapro@gmail.com', '', 'claude', '$2y$10$fbE53UzhTVN1glLTerv4XesCAonzkXMCAFw7yil2Bqy.wwF/SsPBi', '0000-00-00 00:00:00', '2023-05-25 23:52:22', 'admin', 'nCzzRz68M2RFCEX51RdziLagJAJ2EcTyuGGAMtoXNcDGDnT5vGEDcPE0hCWyXg2KV1ZhTadW82LhmFIz'),
(12, 'miakouikila@gmail.com', 'Claude', 'Miakouikila', '$2y$10$qLdmCxc81uMwcfjfq1ITYe7J0gXEPRhHFWqvuwPkUJb5oIr/DUZsG', '0000-00-00 00:00:00', '2023-05-26 00:23:07', 'admin', 'UwJ6EF8vHP8SILvz2drvcbUID0T6Am4X1zqtOPWZGPbX2TlaGfqhMx6AGKcLbqF1r7BIPJX9wjS0u9Hf');

-- --------------------------------------------------------

--
-- Structure de la table `user-vaccin`
--

CREATE TABLE `user-vaccin` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_vaccin` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user-vaccin`
--

INSERT INTO `user-vaccin` (`id`, `id_user`, `id_vaccin`, `date`, `created_at`) VALUES
(1, 11, 9, '2023-05-27 00:00:00', '2023-05-26 00:05:06'),
(2, 11, 9, '2023-05-27 00:00:00', '2023-05-26 00:08:36'),
(3, 11, 1, '2023-05-27 00:00:00', '2023-05-26 00:08:39'),
(4, 11, 1, '2023-05-12 00:00:00', '2023-05-26 00:09:31'),
(5, 11, 6, '2023-05-12 00:00:00', '2023-05-26 00:10:04'),
(6, 11, 5, '2023-05-20 00:00:00', '2023-05-26 00:13:34'),
(7, 11, 10, '2023-05-05 00:00:00', '2023-05-26 00:14:16'),
(8, 11, 7, '2023-05-05 00:00:00', '2023-05-26 00:16:55');

-- --------------------------------------------------------

--
-- Structure de la table `vaccin`
--

CREATE TABLE `vaccin` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vaccin`
--

INSERT INTO `vaccin` (`id`, `title`, `description`) VALUES
(2, 'Jynneos', 'Variole du singe (Monkeypox)'),
(3, 'Menveo', 'Méningites et septicémies à méningocoques'),
(4, 'Pentavac', 'Tétanos'),
(5, 'Pentavac', 'Diphtérie'),
(6, 'Pentavac', 'Poliomyélite'),
(7, 'Rabipur', 'Rage'),
(8, 'Comirnaty', 'Covid19'),
(9, 'Pfizer', 'Covid19'),
(10, 'Moderna', 'Covid19'),
(11, 'Varivax', 'Varicelle'),
(12, 'Stamaril', 'Fièvre jaune'),
(13, 'Revaxis', 'Tétanos'),
(14, 'M-M-RVaxpro', 'Rougeole'),
(15, 'Avaxim', 'HépatiteA'),
(16, 'Rotarix', 'Gastro-entérite à rotavirus'),
(19, 'Tyavax', ' Fièvre typhoïde'),
(20, 'Typhim Vi', 'Fièvre typhoïde'),
(21, 'Ixiaro', 'Encéphalite japonaise'),
(22, 'Zostavax', 'Zona');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user-vaccin`
--
ALTER TABLE `user-vaccin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vaccin`
--
ALTER TABLE `vaccin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `user-vaccin`
--
ALTER TABLE `user-vaccin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `vaccin`
--
ALTER TABLE `vaccin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
