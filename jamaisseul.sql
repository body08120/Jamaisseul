-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 08 juil. 2023 à 11:41
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jamaisseul`
--

-- --------------------------------------------------------

--
-- Structure de la table `chiefs`
--

DROP TABLE IF EXISTS `chiefs`;
CREATE TABLE IF NOT EXISTS `chiefs` (
  `id_chief` int NOT NULL AUTO_INCREMENT,
  `name_chief` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_chief`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id_job` int NOT NULL AUTO_INCREMENT,
  `title_job` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `desc_job` text COLLATE utf8mb4_general_ci NOT NULL,
  `picture_job` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `desc_picture_job` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  PRIMARY KEY (`id_job`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `places`
--

DROP TABLE IF EXISTS `places`;
CREATE TABLE IF NOT EXISTS `places` (
  `id_place` int NOT NULL AUTO_INCREMENT,
  `name_place` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_place`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `poss_chiefs`
--

DROP TABLE IF EXISTS `poss_chiefs`;
CREATE TABLE IF NOT EXISTS `poss_chiefs` (
  `id_chief` int NOT NULL,
  `id_job` int NOT NULL,
  PRIMARY KEY (`id_chief`,`id_job`),
  KEY `poss_chiefs_jobs0_FK` (`id_job`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `poss_places`
--

DROP TABLE IF EXISTS `poss_places`;
CREATE TABLE IF NOT EXISTS `poss_places` (
  `id_job` int NOT NULL,
  `id_place` int NOT NULL,
  PRIMARY KEY (`id_job`,`id_place`),
  KEY `poss_places_places0_FK` (`id_place`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `poss_qualif`
--

DROP TABLE IF EXISTS `poss_qualif`;
CREATE TABLE IF NOT EXISTS `poss_qualif` (
  `id_qualifications` int NOT NULL,
  `id_job` int NOT NULL,
  PRIMARY KEY (`id_qualifications`,`id_job`),
  KEY `poss_qualif_jobs0_FK` (`id_job`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `poss_resp`
--

DROP TABLE IF EXISTS `poss_resp`;
CREATE TABLE IF NOT EXISTS `poss_resp` (
  `id_job` int NOT NULL,
  `id_responsabilities` int NOT NULL,
  PRIMARY KEY (`id_job`,`id_responsabilities`),
  KEY `poss_resp_responsabilities0_FK` (`id_responsabilities`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `title_post` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_post` datetime NOT NULL,
  `picture_post` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `desc_picture_post` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `content_post` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id_post`, `title_post`, `date_post`, `picture_post`, `desc_picture_post`, `content_post`) VALUES
(8, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2023-06-07 00:00:00', 'upload/64998c040f838.png', 'Capture d\'écran 2023-04-05 083830.png', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(11, 'ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '2023-06-07 00:00:00', 'upload/64998e0177e55.png', 'Capture d\'écran 2023-04-15 201427.png', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd'),
(12, 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '2023-06-26 00:00:00', 'upload/64998e28c0df9.png', 'Capture d\'écran 2023-04-28 155148.png', 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee'),
(23, 'gros test sa mère', '2023-07-03 00:00:00', 'upload/64a2b6d9d19e1.png', 'Capture d\'écran 2023-06-15 105015.png', '<p>aertyukl</p><h2>hgdfhft</h2><p>&nbsp;</p><p>&nbsp;</p>'),
(25, 'Modification', '2023-07-03 00:00:00', 'upload/64a2d768d01f8.png', 'Capture d\'écran 2023-06-13 143200.png', '<figure class=\"image\"><img src=\"../../../assets/img/revision-history-demo.png\"></figure><h2>PUBLISHING AGREEMENT</h2><h3>Introduction</h3><p>This publishing contract, the “contract”, is entered into as of 1st June 2020 by and between The Lower Shelf, the “Publisher”, and John Smith, the “Author”.</p><h3>Grant of Rights</h3><p>The Author grants the Publisher full right and title to the following, in perpetuity:</p><ul><li>To publish, sell, and profit from the listed works in all languages and formats in existence today and at any point in the future.</li><li>To create or devise modified, abridged, or derivative works based on the works listed.</li><li>To allow others to use the listed works at their discretion, without providing additional compensation to the Author.</li></ul><p>These rights are granted by the Author on behalf of him and their successors, heirs, executors, and any other party who may attempt to lay claim to these rights at any point now or in the future.</p><p>Any rights not granted to the Publisher above remain with the Author.</p><p>The rights granted to the Publisher by the Author shall not be constrained by geographic territories and are considered global in nature.</p><p>&nbsp;</p>'),
(29, 'test', '2023-07-05 00:00:00', 'upload/64a5157719618.png', 'Capture d\'écran 2023-06-15 105015.png', '<figure class=\"image\"><img></figure>'),
(30, 'test', '2023-07-05 00:00:00', 'upload/64a519126bcc3.png', 'Capture d\'écran 2023-04-05 084121.png', '<figure class=\"image\"><img src=\"http://localhost/Jamaisseul/img/Capture d\'écran 2023-04-05 084121.png\"></figure>'),
(31, 'test miniature', '2023-07-03 00:00:00', 'upload/64a6807ccf212.png', 'Capture d\'écran 2023-04-05 084121.png', '<h2>Tets modif minia</h2>'),
(32, 'Test de modification', '2023-07-05 00:00:00', 'upload/64a67f850f8e5.png', 'Capture d\'écran 2023-04-05 084121.png', '<figure class=\"image\"><img src=\"http://localhost/Jamaisseul/img/Capture d\'écran 2023-04-05 084121_2.png\"></figure><h2>On modifie sans modifier la miniature !</h2>'),
(37, 'test', '2023-07-08 00:00:00', 'upload/64a94a8ec898a.png', 'Capture d\'écran 2023-04-05 084121.png', '<p><br>&nbsp;</p><figure class=\"image\"><img src=\"http://localhost/Jamaisseul/img/Capture d\'écran 2023-04-05 084121_21.png\"></figure><p>&nbsp;</p><h2>Qu\'est-ce que le Lorem Ipsum?</h2><p>Le <strong>Lorem Ipsum</strong> est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.</p><p>&nbsp;</p><figure class=\"image\"><img src=\"http://localhost/Jamaisseul/img/Capture d\'écran 2023-07-03 154228.png\"></figure><h2>Pourquoi l\'utiliser?</h2><p>On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L\'avantage du Lorem Ipsum sur un texte générique comme \'Du texte. Du texte. Du texte.\' est qu\'il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour \'Lorem Ipsum\' vous conduira vers de nombreux sites qui n\'en sont encore qu\'à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d\'y rajouter de petits clins d\'oeil, voire des phrases embarassantes).</p><p><br>&nbsp;</p><h2>Pourquoi l\'utiliser?</h2><p>On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L\'avantage du Lorem Ipsum sur un texte générique comme \'Du texte. Du texte. Du texte.\' est qu\'il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour \'Lorem Ipsum\' vous conduira vers de nombreux sites qui n\'en sont encore qu\'à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d\'y rajouter de petits clins d\'oeil, voire des phrases embarassantes).</p><p><br>&nbsp;</p>'),
(38, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2023-07-08 00:00:00', 'upload/64a94b0346293.png', 'Capture d\'écran 2023-04-05 084121.png', '<h2>Pourquoi l\'utiliser?</h2><p>On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L\'avantage du Lorem Ipsum sur un texte générique comme \'Du texte. Du texte. Du texte.\' est qu\'il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour \'Lorem Ipsum\' vous conduira vers de nombreux sites qui n\'en sont encore qu\'à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d\'y rajouter de petits clins d\'oeil, voire des phrases embarassantes).</p><p><br>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Structure de la table `qualifications`
--

DROP TABLE IF EXISTS `qualifications`;
CREATE TABLE IF NOT EXISTS `qualifications` (
  `id_qualifications` int NOT NULL AUTO_INCREMENT,
  `name_qualifications` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_qualifications`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `responsabilities`
--

DROP TABLE IF EXISTS `responsabilities`;
CREATE TABLE IF NOT EXISTS `responsabilities` (
  `id_responsabilities` int NOT NULL AUTO_INCREMENT,
  `name_responsabilities` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_responsabilities`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `desc_picture_user` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `picture_user` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `desc_picture_user`, `picture_user`) VALUES
(1, 'temporaire.admin', 'temporaire.admin@gmail.com', '$2y$10$mBp2axo2V10VHo36/W87eO.kT0aU3xioZNUZs/Zdw/WPmzPkJtkPG', 'static-assets-upload16471341026410219637.png', 'upload/64a949fbcc4cf.png'),
(2, 'secours', 'secours@se.cours', '$2y$10$BFIWmTZ/32PRjy.ScsMJSuJpLtUkAFnY7E8Xe1HBD77fQVV7lmVzW', 'Capture d\'écran 2023-07-05 135619.png', 'upload/64a55a7237273.png');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `poss_chiefs`
--
ALTER TABLE `poss_chiefs`
  ADD CONSTRAINT `poss_chiefs_chiefs_FK` FOREIGN KEY (`id_chief`) REFERENCES `chiefs` (`id_chief`),
  ADD CONSTRAINT `poss_chiefs_jobs0_FK` FOREIGN KEY (`id_job`) REFERENCES `jobs` (`id_job`);

--
-- Contraintes pour la table `poss_places`
--
ALTER TABLE `poss_places`
  ADD CONSTRAINT `poss_places_jobs_FK` FOREIGN KEY (`id_job`) REFERENCES `jobs` (`id_job`),
  ADD CONSTRAINT `poss_places_places0_FK` FOREIGN KEY (`id_place`) REFERENCES `places` (`id_place`);

--
-- Contraintes pour la table `poss_qualif`
--
ALTER TABLE `poss_qualif`
  ADD CONSTRAINT `poss_qualif_jobs0_FK` FOREIGN KEY (`id_job`) REFERENCES `jobs` (`id_job`),
  ADD CONSTRAINT `poss_qualif_qualifications_FK` FOREIGN KEY (`id_qualifications`) REFERENCES `qualifications` (`id_qualifications`);

--
-- Contraintes pour la table `poss_resp`
--
ALTER TABLE `poss_resp`
  ADD CONSTRAINT `poss_resp_jobs_FK` FOREIGN KEY (`id_job`) REFERENCES `jobs` (`id_job`),
  ADD CONSTRAINT `poss_resp_responsabilities0_FK` FOREIGN KEY (`id_responsabilities`) REFERENCES `responsabilities` (`id_responsabilities`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
