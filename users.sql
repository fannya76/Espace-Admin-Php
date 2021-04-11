-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 11 avr. 2021 à 09:57
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `td7_gestion_users`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `unique_email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'John', 'Dou', 'dou@gmail.com', '$2y$10$GPmbnaxH9fSIT5bBrsTO9e6Mnrhc5m8SFSgEaFAPZw4fOoGE/2W9i'),
(2, 'marie', 'mad', 'mady@me.com', '$2y$10$o9G9a09iqJ1yvGBHnCi2Qefa1w8cBFbzY0YvuLhK/5QDhf9u0i06G'),
(3, 'marx', 'man', 'moon@me.com', '$2y$10$QTYKfrXnPqpaoKviZbh.5Oc.Sal1G3epbPdlF25w9sQ/bAqPfevgW'),
(4, 'alec', 'bin', 'bin@me.com', '$2y$10$nECK5TyEyJ8RlZuazFRjH.qZYIPiV7iNB0H.0ynLcdu3qakEotOGu'),
(8, 'jackie', 'maxi', 'mix@me.com', '$2y$10$u3LzHcWwf5uYE12Wwmrctu8p/Bdit02uZUlaD8RTioblbFGEzwPgK'),
(14, 'Fan', 'AND', 'fanny.andreo@gmail.com', '$2y$10$lMOaWZVDASQF.ioZcJf45.OnioyHZXwSbgieX.ioKoOwlofdU4GFO');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
