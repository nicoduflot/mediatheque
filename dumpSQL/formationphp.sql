-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 09 mars 2020 à 10:08
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `formationphp`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `bio` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`id`, `nom`, `prenom`, `bio`) VALUES
(1, 'Prattchet', 'Terry', 'Dommage, il est décédé.<br />\r\nMais il a écrit plein de livres'),
(2, 'Williams', 'Tad', 'Auteur fantasy'),
(3, 'Gaiman', 'Neil', 'Multi-tâches'),
(4, 'Moore', 'Alan', 'Auteur de comics adultes.'),
(5, 'King', 'Stephen', 'Il a commencé jeune.<br />\r\nIl a écrit des dizaines de livres<br />\r\nIl n\'a toujours pas arrêté.'),
(6, 'Adams', 'Douglas', 'Il a commencé à la BBC<br />\r\nIl a ensuite écrit ses épisode radiophoniques sous forme de livre.<br />\r\nDernièrement il y a eu un film reprenant  le premier tome.');

-- --------------------------------------------------------

--
-- Structure de la table `auteur_livre`
--

DROP TABLE IF EXISTS `auteur_livre`;
CREATE TABLE IF NOT EXISTS `auteur_livre` (
  `idauteur` int(11) NOT NULL,
  `idlivre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `auteur_livre`
--

INSERT INTO `auteur_livre` (`idauteur`, `idlivre`) VALUES
(1, 3),
(3, 3),
(3, 17),
(1, 18),
(6, 1),
(6, 9);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) DEFAULT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `resume` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `utilisateur_id`, `titre`, `date`, `resume`) VALUES
(1, 1, 'Le guide du routard galactique', '2020-03-03 11:50:00', 'Le Guide du routard, parfois surnommé le GDR, est une collection française de guides touristiques fondée en avril 1973 par Michel Duval et Philippe Gloaguen, dans le sillage des back packers\' guides américains. Ces guides, au nombre de 135 en 20121, sont édités depuis 1975 chez Hachette Tourisme Livre. En 40 ans (de 1972 à 2012), environ 40 millions d\'exemplaires ont été vendus. Haha'),
(2, NULL, 'Les Portes d\'Occident', '2020-03-03 12:06:00', 'Nous sommes en 2212. La Terre est partagée en quatre grands territoires politiques :\r\n\r\n    l\'Occident, soit les États-Unis et l\'Europe occidentale, y compris la Grèce, plus Israël ;\r\n    la République populaire sino-russe (RPSR), soit toute l\'Asie et l\'Europe orientale ;\r\n    la Grande nation de l\'islam (GNI), soit l\'Afrique et le Moyen-Orient ;\r\n    le territoire des Sudams, soit l\'Amérique latine.\r\n\r\nLes États-Unis n\'ont plus leur ascendance d\'antan, et la langue internationale est le français. Dans la RPSR, la lingua franca est le frenchy, une variante du français. '),
(3, 1, 'De bons présages', '2020-03-03 12:07:00', 'De bons présages (titre original : Good Omens, ou Good Omens: The Nice and Accurate Prophecies of Agnes Nutter, Witch) est un roman de fantasy écrit par Terry Pratchett et Neil Gaiman, et paru en 1990.\r\n\r\nCe roman peut ainsi être considéré comme une parodie du film La Malédiction (The Omen en version originale), écrit par David Seltzer en 1976 et d\'autres livres et films du même genre. Ce roman raconte la naissance du fils de Satan, l\'arrivée de la Fin des temps et les tentatives de l\'ange Aziraphale et du démon Rampa (Crowley dans la version originale) pour les empêcher, s\'étant habitués à leurs situations confortables sur Terre.\r\n\r\nUne intrigue secondaire concerne le rassemblement des quatre cavaliers de l\'Apocalypse – Guerre, Famine, Pollution (Pestilence ayant pris sa retraite en 1936 après la découverte de la pénicilline), et Mort – ce dernier étant caractérisé de la même manière que la personnification de la Mort dans la série du Disque-monde de Pratchett. '),
(9, NULL, 'La vie, l\'univers et le reste.', '2020-03-03 14:28:37', 'Livre de Douglas Adams du guide du routard galactique. haha'),
(7, 1, 'De l\'autre côté du miroir', '2020-03-03 13:42:27', 'Alice retourne voir là-bas si j\'y suis.<br />C\'est le livre d\'après'),
(16, NULL, 'Le trône du dragon', '2020-03-06 14:47:00', NULL),
(17, NULL, 'Miroirs et fumées', '2020-03-06 14:49:00', NULL),
(18, 1, 'Au Guet', '2020-03-06 16:21:07', 'Le capitaine Vimaire du guet de nuit.<br />\r\n<br />\r\nBonne histoire.');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `motdepasse` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `pseudo`, `email`, `motdepasse`) VALUES
(1, 'Duflot', 'Nicolas', 'nikko', 'nduflot@jehann.fr', '21232f297a57a5a743894a0e4a801fc3');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
