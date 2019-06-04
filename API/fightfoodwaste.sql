-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 04 juin 2019 à 08:14
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fightfoodwaste`
--

-- --------------------------------------------------------

--
-- Structure de la table `adhesion`
--

DROP TABLE IF EXISTS `adhesion`;
CREATE TABLE IF NOT EXISTS `adhesion` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UsrID` int(11) NOT NULL,
  `DateAdhesion` date DEFAULT NULL,
  `Cb` char(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Code` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FKAdhesion28726` (`UsrID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ask`
--

DROP TABLE IF EXISTS `ask`;
CREATE TABLE IF NOT EXISTS `ask` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UsrMakeID` int(11) NOT NULL,
  `UsrAnswerID` int(11) DEFAULT NULL,
  `AskTypeID` int(11) NOT NULL,
  `Subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateStart` date DEFAULT NULL,
  `DateEnd` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FKAsk600256` (`UsrAnswerID`),
  KEY `FKAsk4558` (`AskTypeID`),
  KEY `FKAsk409592` (`UsrMakeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `asktype`
--

DROP TABLE IF EXISTS `asktype`;
CREATE TABLE IF NOT EXISTS `asktype` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `asktype`
--

INSERT INTO `asktype` (`ID`, `Name`) VALUES
(1, 'Test de nom de ask'),
(3, 'Ma demande'),
(4, 'Plombier'),
(5, 'Ma demande'),
(6, 'Ma demande'),
(7, 'Ma demande'),
(8, 'Ma demande'),
(9, 'Ma demande');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

DROP TABLE IF EXISTS `competence`;
CREATE TABLE IF NOT EXISTS `competence` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`ID`, `Name`) VALUES
(1, 'Ma demande'),
(4, 'Plombier'),
(5, 'Competence'),
(6, 'Competence');

-- --------------------------------------------------------

--
-- Structure de la table `content`
--

DROP TABLE IF EXISTS `content`;
CREATE TABLE IF NOT EXISTS `content` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryID` int(11) NOT NULL,
  `Title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FKContent371849` (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
CREATE TABLE IF NOT EXISTS `delivery` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TruckID` int(11) NOT NULL,
  `UsrID` int(11) NOT NULL,
  `DeliveryTypeID` int(11) NOT NULL,
  `DateStart` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateEnd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FKDelivery401435` (`DeliveryTypeID`),
  KEY `FKDelivery236924` (`UsrID`),
  KEY `FKDelivery930104` (`TruckID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `deliverytype`
--

DROP TABLE IF EXISTS `deliverytype`;
CREATE TABLE IF NOT EXISTS `deliverytype` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `deliverytype`
--

INSERT INTO `deliverytype` (`ID`, `Name`) VALUES
(1, 'Type1'),
(3, 'Type2'),
(4, 'TypeTestUpdtae'),
(5, 'Type2'),
(6, 'Type2'),
(7, 'Type2'),
(8, 'Type2'),
(9, 'Type2'),
(10, 'Type2');

-- --------------------------------------------------------

--
-- Structure de la table `depositery`
--

DROP TABLE IF EXISTS `depositery`;
CREATE TABLE IF NOT EXISTS `depositery` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SiteID` int(11) NOT NULL,
  `Numero` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `Rue` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `Postcode` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `Area` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `Capacity` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FKDepositery835002` (`SiteID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `depositery`
--

INSERT INTO `depositery` (`ID`, `SiteID`, `Numero`, `Rue`, `Postcode`, `Area`, `Capacity`) VALUES
(5, 8, '13', 'chaussee', '94160', 'MANDE', 300),
(6, 10, '4', 'boulevard de la liberation', '94300', 'VINCENNES', 200),
(7, 8, '4', 'boulevard de la liberation', '94300', 'VINCENNES', 200);

-- --------------------------------------------------------

--
-- Structure de la table `dishtype`
--

DROP TABLE IF EXISTS `dishtype`;
CREATE TABLE IF NOT EXISTS `dishtype` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RecipeeID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FKDishType680329` (`RecipeeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `justificatif`
--

DROP TABLE IF EXISTS `justificatif`;
CREATE TABLE IF NOT EXISTS `justificatif` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UsrID` int(11) NOT NULL,
  `CompetenceID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FKJustificat58096` (`UsrID`),
  KEY `FKJustificat404584` (`CompetenceID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DepositeryID` int(11) DEFAULT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Barcode` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `ValidDate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FKProduct633644` (`DepositeryID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`ID`, `DepositeryID`, `Name`, `Barcode`, `ValidDate`) VALUES
(3, NULL, 'St-Prino', '99278000858', '25-03-2019'),
(4, NULL, 'tRUC', '09927858', '25-03-2019'),
(16, 6, 'St-Pelegrino', '0080022', '22-03-2019'),
(17, 6, 'St-Pelegrino', '008002', '22-03-2019');

-- --------------------------------------------------------

--
-- Structure de la table `quantity`
--

DROP TABLE IF EXISTS `quantity`;
CREATE TABLE IF NOT EXISTS `quantity` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Quantity` int(11) NOT NULL,
  `RecipeeID` int(11) NOT NULL,
  `IngredientID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FKQuantity673414` (`RecipeeID`),
  KEY `FKQuantity785656` (`IngredientID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recipee`
--

DROP TABLE IF EXISTS `recipee`;
CREATE TABLE IF NOT EXISTS `recipee` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Content` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`ID`, `Name`) VALUES
(1, 'Service1'),
(3, 'Service1'),
(4, 'TypeTestUpdtae'),
(5, 'Service1'),
(6, 'Service1'),
(7, 'Service1'),
(8, 'Service1');

-- --------------------------------------------------------

--
-- Structure de la table `site`
--

DROP TABLE IF EXISTS `site`;
CREATE TABLE IF NOT EXISTS `site` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `Numero` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `Rue` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `Postcode` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `Area` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `site`
--

INSERT INTO `site` (`ID`, `Name`, `Numero`, `Rue`, `Postcode`, `Area`) VALUES
(8, 'Site1', '4', 'boulevard de la liberation', '94300', 'VINCENNES'),
(10, 'upName1', '13', 'chaussee', '94160', 'MANDE');

-- --------------------------------------------------------

--
-- Structure de la table `stop`
--

DROP TABLE IF EXISTS `stop`;
CREATE TABLE IF NOT EXISTS `stop` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DateHour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeliveryID` int(11) DEFAULT NULL,
  `UsrDonateID` int(11) NOT NULL,
  `UsrReceiveID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FKStop998604` (`DeliveryID`),
  KEY `FKStop421206` (`UsrReceiveID`),
  KEY `FKStop62007` (`UsrDonateID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `stop`
--

INSERT INTO `stop` (`ID`, `DateHour`, `DeliveryID`, `UsrDonateID`, `UsrReceiveID`) VALUES
(1, '8', NULL, 1, 4),
(2, '8', NULL, 1, 4),
(4, '8', NULL, 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `stop_product`
--

DROP TABLE IF EXISTS `stop_product`;
CREATE TABLE IF NOT EXISTS `stop_product` (
  `StopID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductID` int(11) NOT NULL,
  PRIMARY KEY (`StopID`,`ProductID`),
  KEY `FKStop_Produ160082` (`ProductID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `truck`
--

DROP TABLE IF EXISTS `truck`;
CREATE TABLE IF NOT EXISTS `truck` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SiteID` int(11) NOT NULL,
  `Plate` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `Capacity` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FKTruck557507` (`SiteID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `truck`
--

INSERT INTO `truck` (`ID`, `SiteID`, `Plate`, `Name`, `Capacity`) VALUES
(1, 8, 'AA000AA', 'VOITURE MODELE', 10),
(2, 8, 'AA000AA', 'VOITURE MODELE', 10),
(5, 8, 'AA123AA', 'chaussee', 15),
(6, 8, 'AA000AA', 'VOITURE MODELE', 10),
(7, 8, 'AA000AA', 'VOITURE MODELE', 10);

-- --------------------------------------------------------

--
-- Structure de la table `usr`
--

DROP TABLE IF EXISTS `usr`;
CREATE TABLE IF NOT EXISTS `usr` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SiteID` int(11) NOT NULL,
  `ServiceID` int(11) DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `Surname` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Numero` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `Rue` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `Postcode` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `Area` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `Eligibility` tinyint(1) NOT NULL,
  `Siret` char(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salary` float DEFAULT NULL,
  `Discriminator` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Email` (`Email`),
  KEY `FKUsr710495` (`ServiceID`),
  KEY `FKUsr559775` (`SiteID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `usr`
--

INSERT INTO `usr` (`ID`, `SiteID`, `ServiceID`, `Email`, `Name`, `Surname`, `Password`, `Numero`, `Rue`, `Postcode`, `Area`, `Eligibility`, `Siret`, `Salary`, `Discriminator`) VALUES
(1, 8, 3, 'sophie@gmail.com', 'pelluet', 'sophie', 'b71d44619996de12533f3dfc47fb84f151fdc72f253e344eab', '6b', '9 rue colmet lepinay', '91700', 'MONTREUIL', 0, NULL, 12.3, 'EMPLOYEE'),
(4, 8, NULL, 'sophie@free.fr', 'pelluet', 'sophie', '7e877ce5a9ed67b6dd4712f31449fe2231990d3c82b6179794', '6b', '9 rue colmet lepinay', '91700', 'MONTREUIL', 1, NULL, 12.3, 'EMPLOYEE'),
(6, 8, 3, 'spelluet@gmail.fr', 'pelluet', 'sophie', 'b05e2731ffb20092956703a84cee88ca10827b2e3083610631', '6b', '9 rue colmet lepinay', '91700', 'MONTREUIL', 0, NULL, 12.3, 'EMPLOYEE');

-- --------------------------------------------------------

--
-- Structure de la table `usr_ingredient`
--

DROP TABLE IF EXISTS `usr_ingredient`;
CREATE TABLE IF NOT EXISTS `usr_ingredient` (
  `UsrID` int(11) NOT NULL AUTO_INCREMENT,
  `IngredientID` int(11) NOT NULL,
  PRIMARY KEY (`UsrID`,`IngredientID`),
  KEY `FKUsr_Ingred883483` (`IngredientID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adhesion`
--
ALTER TABLE `adhesion`
  ADD CONSTRAINT `FKAdhesion28726` FOREIGN KEY (`UsrID`) REFERENCES `usr` (`ID`);

--
-- Contraintes pour la table `ask`
--
ALTER TABLE `ask`
  ADD CONSTRAINT `FKAsk409592` FOREIGN KEY (`UsrMakeID`) REFERENCES `usr` (`ID`),
  ADD CONSTRAINT `FKAsk4558` FOREIGN KEY (`AskTypeID`) REFERENCES `asktype` (`ID`),
  ADD CONSTRAINT `FKAsk600256` FOREIGN KEY (`UsrAnswerID`) REFERENCES `usr` (`ID`);

--
-- Contraintes pour la table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `FKContent371849` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`ID`);

--
-- Contraintes pour la table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `FKDelivery236924` FOREIGN KEY (`UsrID`) REFERENCES `usr` (`ID`),
  ADD CONSTRAINT `FKDelivery401435` FOREIGN KEY (`DeliveryTypeID`) REFERENCES `deliverytype` (`ID`),
  ADD CONSTRAINT `FKDelivery930104` FOREIGN KEY (`TruckID`) REFERENCES `truck` (`ID`);

--
-- Contraintes pour la table `depositery`
--
ALTER TABLE `depositery`
  ADD CONSTRAINT `FKDepositery835002` FOREIGN KEY (`SiteID`) REFERENCES `site` (`ID`);

--
-- Contraintes pour la table `dishtype`
--
ALTER TABLE `dishtype`
  ADD CONSTRAINT `FKDishType680329` FOREIGN KEY (`RecipeeID`) REFERENCES `recipee` (`ID`);

--
-- Contraintes pour la table `justificatif`
--
ALTER TABLE `justificatif`
  ADD CONSTRAINT `FKJustificat404584` FOREIGN KEY (`CompetenceID`) REFERENCES `competence` (`ID`),
  ADD CONSTRAINT `FKJustificat58096` FOREIGN KEY (`UsrID`) REFERENCES `usr` (`ID`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FKProduct633644` FOREIGN KEY (`DepositeryID`) REFERENCES `depositery` (`ID`);

--
-- Contraintes pour la table `quantity`
--
ALTER TABLE `quantity`
  ADD CONSTRAINT `FKQuantity673414` FOREIGN KEY (`RecipeeID`) REFERENCES `recipee` (`ID`),
  ADD CONSTRAINT `FKQuantity785656` FOREIGN KEY (`IngredientID`) REFERENCES `ingredient` (`ID`);

--
-- Contraintes pour la table `stop`
--
ALTER TABLE `stop`
  ADD CONSTRAINT `FKStop421206` FOREIGN KEY (`UsrReceiveID`) REFERENCES `usr` (`ID`),
  ADD CONSTRAINT `FKStop62007` FOREIGN KEY (`UsrDonateID`) REFERENCES `usr` (`ID`),
  ADD CONSTRAINT `FKStop998604` FOREIGN KEY (`DeliveryID`) REFERENCES `delivery` (`ID`);

--
-- Contraintes pour la table `stop_product`
--
ALTER TABLE `stop_product`
  ADD CONSTRAINT `FKStop_Produ160082` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ID`),
  ADD CONSTRAINT `FKStop_Produ196206` FOREIGN KEY (`StopID`) REFERENCES `stop` (`ID`);

--
-- Contraintes pour la table `truck`
--
ALTER TABLE `truck`
  ADD CONSTRAINT `FKTruck557507` FOREIGN KEY (`SiteID`) REFERENCES `site` (`ID`);

--
-- Contraintes pour la table `usr`
--
ALTER TABLE `usr`
  ADD CONSTRAINT `FKUsr559775` FOREIGN KEY (`SiteID`) REFERENCES `site` (`ID`),
  ADD CONSTRAINT `FKUsr710495` FOREIGN KEY (`ServiceID`) REFERENCES `service` (`ID`);

--
-- Contraintes pour la table `usr_ingredient`
--
ALTER TABLE `usr_ingredient`
  ADD CONSTRAINT `FKUsr_Ingred637434` FOREIGN KEY (`UsrID`) REFERENCES `usr` (`ID`),
  ADD CONSTRAINT `FKUsr_Ingred883483` FOREIGN KEY (`IngredientID`) REFERENCES `ingredient` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
