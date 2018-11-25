-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 17 Octobre 2018 à 13:54
-- Version du serveur :  5.7.23-0ubuntu0.16.04.1
-- Version de PHP :  7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `restauranttct`
--

-- --------------------------------------------------------

--
-- Structure de la table `advices`
--

CREATE TABLE `advices` (
  `id` int(10) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `titleAdvice` varchar(64) NOT NULL,
  `advice` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `advices`
--

INSERT INTO `advices` (`id`, `firstName`, `titleAdvice`, `advice`) VALUES
(10, 'Élodie', 'Excellent !', 'La salade César est divine , la sauce est exquise , service sympathique bien qu’il y ai beaucoup de monde À recommander'),
(11, 'Marc du 83', 'Il faut toujours dire merci à ceux qui vous donnent du plaisir', 'Superbe accueil malgré que nous n\'avions pas réservé, une solution a été trouvée. Le risotto est simplement merveilleux, nous n\'avions jamais vu cela ailleurs. Merci.'),
(12, 'ROLLAND6', 'Constance accueil et cuisine', 'L accueil est toujours très attentionné deux ans après, gage de professionnalisme et les plats renouvelés sont qualitatifs et copieux.');

-- --------------------------------------------------------

--
-- Structure de la table `booking_rooms`
--

CREATE TABLE `booking_rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `roomId` int(10) UNSIGNED NOT NULL,
  `eventRoom` text NOT NULL,
  `roomDate` date NOT NULL,
  `roomHour` time NOT NULL,
  `numberSeatRoom` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `booking_tables`
--

CREATE TABLE `booking_tables` (
  `id` int(10) UNSIGNED NOT NULL,
  `tableId` int(10) UNSIGNED DEFAULT NULL,
  `tableDate` date NOT NULL,
  `tableHour` time NOT NULL,
  `numberSeatTable` int(2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `homes`
--

CREATE TABLE `homes` (
  `id` int(10) NOT NULL,
  `title` varchar(70) NOT NULL,
  `textHome` text NOT NULL,
  `pop` varchar(76) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `homes`
--

INSERT INTO `homes` (`id`, `title`, `textHome`, `pop`) VALUES
(1, 'Information de la semaine !', 'Restaurant "LE 3 SET "\r\n\r\nFormule Midi : Plat du jour, dessert, café : 14 euros\r\n\r\nPlat du jour seul: 10.50 €', 'Connectez-vous et réserver votre salle pour un repas d\'affaire ou une soirée');

-- --------------------------------------------------------

--
-- Structure de la table `logins`
--

CREATE TABLE `logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `mealsId` int(10) UNSIGNED DEFAULT NULL,
  `bookingRoomsId` int(10) UNSIGNED DEFAULT NULL,
  `bookingTablesId` int(10) UNSIGNED DEFAULT NULL,
  `adviceId` int(10) UNSIGNED DEFAULT NULL,
  `homeId` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `logins`
--

INSERT INTO `logins` (`id`, `firstName`, `lastName`, `email`, `password`, `mealsId`, `bookingRoomsId`, `bookingTablesId`, `adviceId`, `homeId`) VALUES
(1, 'Administrateur', 'TCT', 'martinezyoann83@gmail.com', '1165637b88cd010c22a038ecb212d050', NULL, NULL, NULL, NULL, NULL),
(3, 'élodie', 'cantin', 'yoannmartinez@yahoo.fr', '7cc03e6875c0fe70605bb08e84017fee', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `mealsId` int(10) NOT NULL,
  `titleProduct` varchar(64) NOT NULL,
  `priceSingle` double NOT NULL,
  `priceTotal` double DEFAULT NULL,
  `description` varchar(512) NOT NULL,
  `picture` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `mealsId`, `titleProduct`, `priceSingle`, `priceTotal`, `description`, `picture`) VALUES
(1, 0, 'Crepes-sarrasin', 8.2, NULL, 'Dégustez de délicieuses galettes de sarrasin faites maison !', 'crepes-sarrasin.jpg'),
(2, 0, 'Spaghettis à la bolognaise', 7.5, NULL, 'Les spaghetti à la Bolognaise, tout le monde adore ça !', 'spaghettis_bolognaise.jpg'),
(3, 0, 'Ratatouille', 7, NULL, 'Nôtre ratatouille est une spécialité culinaire traditionnelle des provençaux, occitane et méditerranéenne.', 'Ratatouille.jpg'),
(4, 0, 'Gâteau à la vanille', 4.2, NULL, 'Idéal pour le goûter, en dessert et terrible bon !', 'gateau-vanille.jpg'),
(5, 0, 'Creme dessert au chocolat', 3.99, NULL, 'Irrésistiblement onctueuse, la crème dessert fait partie des desserts préférés des petits comme des grands. Réaliser à la maison.', 'creme-desser.jpg'),
(6, 0, 'Glaces', 7.5, NULL, 'Comment résister à un bon dessert ? On vous propose une grande sélection de glaces gourmandes pour tous les goûts !', 'glaces.jpg'),
(7, 0, 'Cocktails', 9.2, NULL, 'Le 3 SET propose des cocktails sur nôtre terrasse sous le soleil du sud', 'cocktails.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `registers`
--

CREATE TABLE `registers` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(8) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adressLine1` varchar(128) DEFAULT NULL,
  `adressLine2` varchar(128) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `zipCode` char(5) DEFAULT NULL,
  `phoneNumber` char(10) DEFAULT NULL,
  `phoneNumber2` char(10) DEFAULT NULL,
  `newLetter` double UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `registers`
--

INSERT INTO `registers` (`id`, `title`, `firstName`, `lastName`, `email`, `password`, `adressLine1`, `adressLine2`, `city`, `zipCode`, `phoneNumber`, `phoneNumber2`, `newLetter`) VALUES
(1, 'Monsieur', 'Administrateur', 'TCT', 'martinezyoann83@gmail.com', '1165637b88cd010c22a038ecb212d050', '342, avenue Eole', '', 'La valette du var', '83160', '0494141290', '', 0),
(4, 'Madame', 'élodie', 'cantin', 'yoannmartinez@yahoo.fr', '7cc03e6875c0fe70605bb08e84017fee', '5 rue louis jouvet', 'Résidence la coupiane', 'La valette du var', '83160', '0487876878', '0648787878', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `advices`
--
ALTER TABLE `advices`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `booking_rooms`
--
ALTER TABLE `booking_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `booking_tables`
--
ALTER TABLE `booking_tables`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `homes`
--
ALTER TABLE `homes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logins_ibfk_1` (`mealsId`),
  ADD KEY `bookingRoomsId` (`bookingRoomsId`),
  ADD KEY `bookingTablesId` (`bookingTablesId`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `registers`
--
ALTER TABLE `registers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `advices`
--
ALTER TABLE `advices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `booking_rooms`
--
ALTER TABLE `booking_rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `booking_tables`
--
ALTER TABLE `booking_tables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `homes`
--
ALTER TABLE `homes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `registers`
--
ALTER TABLE `registers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
