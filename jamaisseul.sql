-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 07 juin 2024 à 12:35
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
-- Structure de la table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `id_author` int NOT NULL AUTO_INCREMENT,
  `name_author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `desc_picture` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pinterest` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desc_author` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_author`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `author`
--

INSERT INTO `author` (`id_author`, `name_author`, `picture`, `desc_picture`, `facebook`, `twitter`, `pinterest`, `desc_author`) VALUES
(7, 'Exemple nom et prénom', 'upload/65521c21ee298.png', 'Capture d&#039;écran 2023-07-05 135619.png', 'https://fr-fr.facebook.com/', 'https://fr-fr.facebook.com/', 'https://fr-fr.facebook.com/', 'Description de l&#039;auteur. à é è &quot; &quot;');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id_job` int NOT NULL AUTO_INCREMENT,
  `title_job` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desc_job` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `picture_job` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desc_picture_job` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `chief_job` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nd_chief_job` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` datetime NOT NULL,
  `date_started` datetime NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_job`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jobs`
--

INSERT INTO `jobs` (`id_job`, `title_job`, `desc_job`, `picture_job`, `desc_picture_job`, `chief_job`, `nd_chief_job`, `date_created`, `date_started`, `category`) VALUES
(59, 'Assistant(e) social(e) - Pôle médico-social et logement adapté', 'L&#039;association &quot;Jamais Seul à Reims&quot; recherche un(e) assistant(e) social(e) pour rejoindre notre équipe travaillant sur le pôle médico-social et logement adapté. Le/la candidat(e) retenu(e) travaillera en étroite collaboration avec les membres de l&#039;équipe pour fournir des solutions de logement adapté aux personnes ayant des besoins médico-sociaux spécifiques.', 'upload/6569bf811fdbd.png', 'wixrm7ejmrua4su7agha.png', 'HOUBERDON', 'Marie', '2023-11-30 12:11:00', '2023-12-01 12:11:00', 'medico-social'),
(76, 'Offre Pôle Hébergement', 'Description de l&#039;offre d&#039;emploi', 'upload/6571ad8b66e93.png', 'wixrm7ejmrua4su7agha.png', 'Nom', 'Prénom', '2023-12-06 12:33:00', '2023-12-07 12:33:00', 'hébergement'),
(77, 'Offre Pôle Asile', 'Description de l&#039;offre d&#039;emploi', 'upload/6571adc35fd35.png', 'wixrm7ejmrua4su7agha.png', 'Nom', 'Prénom', '2023-12-06 12:34:00', '2023-12-08 12:34:00', 'asile');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_token`
--

DROP TABLE IF EXISTS `password_reset_token`;
CREATE TABLE IF NOT EXISTS `password_reset_token` (
  `id_reset_pass` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_reset_pass`),
  UNIQUE KEY `password_reset_token_users_AK` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `places`
--

DROP TABLE IF EXISTS `places`;
CREATE TABLE IF NOT EXISTS `places` (
  `id_place` int NOT NULL AUTO_INCREMENT,
  `name_place` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `insee_place` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_place`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `places`
--

INSERT INTO `places` (`id_place`, `name_place`, `insee_place`) VALUES
(1, 'Reims', ''),
(2, 'Troyes', ''),
(3, 'AMBERIEUX EN DOMBES', '01005'),
(4, 'AMBLEON', '01006'),
(5, 'ARMIX 01510', '01019'),
(6, 'BEAUPONT 01270', '01029'),
(7, 'L ABERGEMENT CLEMENCIAT 01400', '01001'),
(8, 'L ABERGEMENT DE VAREY 01640', '01002'),
(9, 'BOGNY SUR MEUSE 08120', '08081'),
(10, 'AMBERIEU EN BUGEY 01500', '01004'),
(11, 'BRESSOLLES 01360', '01062'),
(12, 'BRION 01460', '01063'),
(13, 'CHARLEVILLE MEZIERES 08000', '08105'),
(14, 'CHANOZ CHATENAY 01400', '01084'),
(15, 'LA CHAPELLE DU CHATELARD 01240', '01085'),
(16, 'CHARIX 01130', '01087'),
(17, 'TROYES 10000', '10387'),
(18, 'REIMS 51100', '51454'),
(19, 'VALROMEY SUR SERAN 01260', '01036'),
(20, 'LA BURBANCHE 01510', '01066'),
(21, 'BANEINS 01990', '01028');

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

--
-- Déchargement des données de la table `poss_places`
--

INSERT INTO `poss_places` (`id_job`, `id_place`) VALUES
(76, 8),
(76, 10),
(59, 17),
(59, 18),
(77, 19),
(77, 20);

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

--
-- Déchargement des données de la table `poss_qualif`
--

INSERT INTO `poss_qualif` (`id_qualifications`, `id_job`) VALUES
(3, 59),
(4, 59),
(40, 59),
(1, 76),
(2, 76),
(3, 76),
(4, 76),
(40, 76),
(1, 77),
(2, 77),
(3, 77),
(4, 77),
(40, 77);

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

--
-- Déchargement des données de la table `poss_resp`
--

INSERT INTO `poss_resp` (`id_job`, `id_responsabilities`) VALUES
(59, 1),
(76, 1),
(77, 1),
(59, 2),
(76, 2),
(77, 2),
(59, 3),
(76, 3),
(77, 3),
(59, 4),
(76, 4),
(77, 4);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `title_post` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_post` datetime NOT NULL,
  `picture_post` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desc_picture_post` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `content_post` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_author` int DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `posts_author_FK` (`id_author`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id_post`, `title_post`, `date_post`, `picture_post`, `desc_picture_post`, `content_post`, `id_author`) VALUES
(34, 'Titre de l\'article modifié', '2023-10-19 13:55:00', 'upload/65311933ba63e.png', 'wixrm7ejmrua4su7agha.png', '<h2>Vous pouvez ici écrire votre article.</h2><p><br>&nbsp;</p><h3>Ajouter du texte, des listes, des images, et bien d\'autres grâce à cet éditeur de texte.</h3><p>Exprimez-vous librement et contribuez à rendre le site encore plus intéressant !</p><p>Ajoutez des images et autres !&nbsp;</p><figure class=\"image\"><img src=\"http://localhost/upload/ckedit/static-assets-upload16471341026410219637.png\"></figure>', 7);

-- --------------------------------------------------------

--
-- Structure de la table `qualifications`
--

DROP TABLE IF EXISTS `qualifications`;
CREATE TABLE IF NOT EXISTS `qualifications` (
  `id_qualifications` int NOT NULL AUTO_INCREMENT,
  `name_qualifications` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_qualifications`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `qualifications`
--

INSERT INTO `qualifications` (`id_qualifications`, `name_qualifications`) VALUES
(1, 'Diplôme en travail social, psychologie ou dans un domaine connexe'),
(2, 'Expérience de travail avec des personnes ayant des besoins médico-sociaux spécifiques, de préférence dans le domaine du logement adapté!'),
(3, 'Capacité à travailler en équipe et à collaborer avec des professionnels de différents horizons'),
(4, 'Excellentes compétences en communication et en organisation'),
(40, 'Capacité en communication visant à trouver une solution qui soit satisfaisante pour toutes les parties');

-- --------------------------------------------------------

--
-- Structure de la table `responsabilities`
--

DROP TABLE IF EXISTS `responsabilities`;
CREATE TABLE IF NOT EXISTS `responsabilities` (
  `id_responsabilities` int NOT NULL AUTO_INCREMENT,
  `name_responsabilities` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_responsabilities`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `responsabilities`
--

INSERT INTO `responsabilities` (`id_responsabilities`, `name_responsabilities`) VALUES
(1, 'Évaluer les besoins des bénéficiaires en matière de logement adapté et de services médico-sociaux'),
(2, 'Mettre en place des plans d\'intervention pour aider les bénéficiaires à accéder à un logement adapté et à des services médico-sociaux appropriés'),
(3, 'Travailler en collaboration avec les professionnels de la santé et les fournisseurs de services pour aider les bénéficiaires à surmonter leurs obstacles médico-sociaux'),
(4, 'Suivre et évaluer les plans d\'intervention pour assurer que les bénéficiaires reçoivent les services appropriés et sont sur la bonne voie pour atteindre leurs objectifs');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desc_picture_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `picture_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `desc_picture_user`, `picture_user`) VALUES
(1, 'temporaire.admin', 'temporaire.admin@gmail.com', '$2y$10$XV9FKkjx3bN02mJzP7w.W.C9g0purcgO5BxdpVYY6NU8Pj3A0K5/.', '2ede95a197b21defb6d90818e37d50a3782573ad.png', 'upload/6662fe22819e8.png');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `password_reset_token`
--
ALTER TABLE `password_reset_token`
  ADD CONSTRAINT `password_reset_token_users_FK` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `poss_places`
--
ALTER TABLE `poss_places`
  ADD CONSTRAINT `poss_places_jobs_FK` FOREIGN KEY (`id_job`) REFERENCES `jobs` (`id_job`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `poss_places_places0_FK` FOREIGN KEY (`id_place`) REFERENCES `places` (`id_place`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `poss_qualif`
--
ALTER TABLE `poss_qualif`
  ADD CONSTRAINT `poss_qualif_jobs0_FK` FOREIGN KEY (`id_job`) REFERENCES `jobs` (`id_job`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `poss_qualif_qualifications_FK` FOREIGN KEY (`id_qualifications`) REFERENCES `qualifications` (`id_qualifications`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `poss_resp`
--
ALTER TABLE `poss_resp`
  ADD CONSTRAINT `poss_resp_jobs_FK` FOREIGN KEY (`id_job`) REFERENCES `jobs` (`id_job`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `poss_resp_responsabilities0_FK` FOREIGN KEY (`id_responsabilities`) REFERENCES `responsabilities` (`id_responsabilities`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_author_FK` FOREIGN KEY (`id_author`) REFERENCES `author` (`id_author`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
