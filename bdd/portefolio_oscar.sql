-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 31 août 2025 à 14:49
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `portefolio_oscar`
--
CREATE DATABASE IF NOT EXISTS `portefolio_oscar` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `portefolio_oscar`;

-- --------------------------------------------------------

--
-- Structure de la table `link_tw`
--

DROP TABLE IF EXISTS `link_tw`;
CREATE TABLE IF NOT EXISTS `link_tw` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_work` int UNSIGNED NOT NULL,
  `tec1` int UNSIGNED DEFAULT NULL,
  `tec2` int UNSIGNED DEFAULT NULL,
  `tec3` int UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `linkwork` (`id_work`),
  KEY `linktec1` (`tec1`),
  KEY `linktec2` (`tec2`),
  KEY `linktec3` (`tec3`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `link_tw`
--

INSERT INTO `link_tw` (`id`, `id_work`, `tec1`, `tec2`, `tec3`) VALUES
(1, 1, 1, 6, 5),
(2, 1, 1, 6, 5),
(3, 2, 8, 1, 2),
(4, 3, 8, 1, 2),
(5, 4, 8, 1, NULL),
(6, 5, 8, 1, 2),
(7, 6, 7, 8, 2);

-- --------------------------------------------------------

--
-- Structure de la table `tec`
--

DROP TABLE IF EXISTS `tec`;
CREATE TABLE IF NOT EXISTS `tec` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tec`
--

INSERT INTO `tec` (`id`, `nom`, `img`) VALUES
(1, 'html', 'html.png'),
(2, 'css', 'css.png'),
(5, 'figma', 'figma.png'),
(6, 'sass', 'sass.png'),
(7, 'php', 'php.png'),
(8, 'js', 'js.png');

-- --------------------------------------------------------

--
-- Structure de la table `work`
--

DROP TABLE IF EXISTS `work`;
CREATE TABLE IF NOT EXISTS `work` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `descr` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `github` varchar(255) NOT NULL,
  `figma` varchar(255) DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `work`
--

INSERT INTO `work` (`id`, `nom`, `date`, `descr`, `github`, `figma`, `link`, `images`) VALUES
(1, 'Aninights', '2025-06-26', 'Aninignts est un festival nocturne centré sur l\'animation japonaise. Il se déroule à Ath du 18 au 20 juillet 2025.', 'https://github.com/MausO-git/aninights.git', 'https://www.figma.com/design/gTAFMuiCtPqnuqW9Psge64/TFA-webdev-1?node-id=0-1&t=Qfd0R7IU0gsPSErn-1', 'https://aninights.mausosc.com/', 'aninights.png'),
(2, 'Memory', '2025-07-16', 'Simple jeu de memory en ligne. Idéal pour faire passer le temps tout en faisant travailler les méninges. Jouez gratuitement en ligne.', 'https://github.com/MausO-git/memory.git', NULL, 'https://memory.mausosc.com/', 'memory.png'),
(3, 'Tic Tac Toe', '2025-07-16', 'Simple jeu du morpion en ligne. Jouez gratuitement contre un ami.', 'https://github.com/MausO-git/morpion.git', NULL, 'https://tictactoe.mausosc.com/', 'tictactoe.png'),
(4, 'Pictures Editor', '2025-07-24', 'Simple site permettant d\'apporter des modifications de positions, de tailles, et de rotation à une image.', 'https://github.com/MausO-git/PicEdit.git', NULL, 'https://picedit.mausosc.com/', 'picedit.png'),
(5, 'Taquin', '2025-08-08', 'Simple jeu de taquin en ligne. Idéal pour faire passer le temps tout en faisant travailler les méninges. Jouez gratuitement en ligne.', 'https://github.com/MausO-git/taquin.git', NULL, 'https://taquin.mausosc.com/', 'taquin.png'),
(6, 'SimuLotto', '2025-08-17', 'Site permettant de simuler un jeu de loterie sans risquer d\'y perdre toutes ses économies. Le site permet aussi d\'observer l\'évolution des dépenses et des gains au fil des parties.', 'https://github.com/MausO-git/simuLotto.git', NULL, 'https://simulotto.mausosc.com/', 'simulotto.png');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `link_tw`
--
ALTER TABLE `link_tw`
  ADD CONSTRAINT `linktec1` FOREIGN KEY (`tec1`) REFERENCES `tec` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `linktec2` FOREIGN KEY (`tec2`) REFERENCES `tec` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `linktec3` FOREIGN KEY (`tec3`) REFERENCES `tec` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `linkwork` FOREIGN KEY (`id_work`) REFERENCES `work` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
