-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 10 juin 2018 à 18:16
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tvshow`
--

-- --------------------------------------------------------

--
-- Structure de la table `show`
--

DROP TABLE IF EXISTS `show`;
CREATE TABLE IF NOT EXISTS `show` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `synopsis` text NOT NULL,
  `released_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `show`
--

INSERT INTO `show` (`id`, `title`, `category`, `cover`, `synopsis`, `released_at`) VALUES
(2, 'The Wire', 'policier', NULL, 'lorem ipsum', '2008-01-01'),
(3, 'Oz', 'drame', NULL, 'lorem ipsum', '1997-01-01'),
(4, 'Six Feet Under', 'drame', NULL, 'lorem ipsum', '2001-01-01'),
(5, 'Sons of Anarchy', 'drame', NULL, 'lorem ipsum', '2008-01-01'),
(6, 'The Shield', 'policier', NULL, 'lorem ipsum', '2002-01-01'),
(7, 'The Walking Dead', 'horreur', NULL, 'lorem ipsum', '2010-01-01'),
(8, 'Penny Dreadful', 'horreur', NULL, 'lorem ipsum', '2014-01-01'),
(9, 'The Office', 'humour', NULL, 'lorem ipsum', '2005-01-01'),
(10, 'Futurama', 'humour', NULL, 'lorem ipsum', '1999-01-01'),
(11, 'sdfsdf', 'Horreur', NULL, 'sdfsdfsdfd sdfsdfsdfsdfsdf', '2000-01-01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
