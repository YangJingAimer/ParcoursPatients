-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 05 Avril 2017 à 14:35
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25


CREATE DATABASE subway;
USE subway;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `subway`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

CREATE TABLE `activite` (
  `ID_ACTIVITE` bigint(11) NOT NULL,
  `TXT_NOM` varchar(255) DEFAULT NULL,
  `INT_DUREE` bigint(4) DEFAULT NULL,
  `TXT_COMMENTAIRE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `activite`
--

INSERT INTO `activite` (`ID_ACTIVITE`, `TXT_NOM`, `INT_DUREE`, `TXT_COMMENTAIRE`) VALUES
(0, 'Début', 0, NULL),
(1, 'RDV paramédical', 20, 'Consultation'),
(2, 'ECG', 15, NULL),
(3, 'Bilan biologique', 15, 'Prélèvement à jeun'),
(4, 'Echo hépatique', 15, 'A jeun'),
(5, 'Calorimétrie', 30, NULL),
(6, 'Entretien psy', 40, NULL),
(7, 'Entretien infirmier', 30, NULL),
(8, 'Entretien diet', 60, NULL),
(9, 'synthèse', 30, NULL),
(10, 'TOGD', 20, NULL),
(11, 'Bilan anthropométrique', 60, NULL),
(12, 'Fibroscan', 10, NULL),
(13, 'Scanner abdo', 20, NULL),
(14, 'Entretien hépato', 45, NULL),
(15, 'Traitement Rémicade', 120, NULL),
(16, 'Ponction Ascite', 180, NULL),
(17, 'Soins ponction', 135, NULL),
(18, 'Injection Ferinject', 60, NULL),
(19, 'Injection', 40, NULL),
(20, 'Scintigraphie myocardique', 30, NULL),
(21, 'Scanner des corronaires', 10, NULL),
(22, 'Echodoppler TSA et MI', 30, NULL),
(23, 'Rétinographie', 15, NULL),
(24, 'Pose Holter', 15, NULL),
(25, 'Scanner abdo', 30, NULL),
(26, 'Scanner TMD pied + radios', 40, NULL),
(27, 'Doppler des artères des MI', 30, NULL),
(28, 'Soin, pansement, mesures IPS', 40, NULL),
(29, 'RDV médical', 35, NULL),
(30, 'Prélèvement', 15, NULL),
(31, 'Collation', 10, NULL),
(32, 'Synthèse', 30, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `champ`
--

CREATE TABLE `champ` (
  `ID_CHAMP` bigint(11) NOT NULL,
  `ID_TYPECHAMP` bigint(11) NOT NULL,
  `TXT_NOM` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `champ`
--

INSERT INTO `champ` (`ID_CHAMP`, `ID_TYPECHAMP`, `TXT_NOM`) VALUES
(1, 1, 'Nom'),
(2, 3, 'Observation'),
(3, 2, 'Date d\'observation'),
(4, 1, 'Test'),
(5, 1, 'Tes'),
(6, 1, 'T'),
(7, 1, 'ty'),
(8, 3, 'f');

-- --------------------------------------------------------

--
-- Structure de la table `composer`
--

CREATE TABLE `composer` (
  `ID_PARCOURS` bigint(11) NOT NULL,
  `ID_ACTIVITE` bigint(11) NOT NULL,
  `ID_ACTIVITE_PRECEDENTE` bigint(11) NOT NULL,
  `INT_DELAIMIN` bigint(4) DEFAULT NULL,
  `INT_DELAIMAX` bigint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `composer`
--

INSERT INTO `composer` (`ID_PARCOURS`, `ID_ACTIVITE`, `ID_ACTIVITE_PRECEDENTE`, `INT_DELAIMIN`, `INT_DELAIMAX`) VALUES
(1, 1, 0, 0, 0),
(1, 2, 1, 5, 100),
(1, 3, 1, 10, 60),
(1, 4, 1, 20, 80),
(1, 5, 1, 10, 60),
(1, 6, 31, 0, 60),
(1, 7, 31, 5, 130),
(1, 8, 31, 5, 120),
(1, 9, 6, 0, 120),
(1, 9, 7, 10, 130),
(1, 9, 8, 5, 120),
(1, 31, 2, 0, 130),
(1, 31, 3, 0, 100),
(1, 31, 4, 5, 100),
(1, 31, 5, 0, 90);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `ID_COMPTE` bigint(11) NOT NULL,
  `TXT_LOGIN` varchar(255) DEFAULT NULL,
  `TXT_MOTDEPASSE` varchar(255) DEFAULT NULL,
  `ID_TYPECOMPTE` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `compte`
--

INSERT INTO `compte` (`ID_COMPTE`, `TXT_LOGIN`, `TXT_MOTDEPASSE`, `ID_TYPECOMPTE`) VALUES
(1, 'martin', '$2Cw51.ICu1Nw', 1),
(2, 'bernard', '$2Cw51.ICu1Nw', 1),
(3, 'dubois', '$2Cw51.ICu1Nw', 1),
(4, 'thomas', '$2Cw51.ICu1Nw', 1),
(5, 'robert', '$2Cw51.ICu1Nw', 1),
(6, 'richard', '$2Cw51.ICu1Nw', 1),
(7, 'petit', '$2Cw51.ICu1Nw', 1),
(8, 'durand', '$2Cw51.ICu1Nw', 1),
(9, 'leroy', '$2Cw51.ICu1Nw', 1),
(10, 'moreau', '$2Cw51.ICu1Nw', 1),
(11, 'cheniour', '$2Cw51.ICu1Nw', 2),
(12, 'verheyde', '$2Cw51.ICu1Nw', 2),
(13, 'attias', '$2Cw51.ICu1Nw', 2),
(14, 'cabinet', '$2Cw51.ICu1Nw', 2),
(15, 'pasquet', '$2Cw51.ICu1Nw', 2),
(16, 'viomesnil', '$2Cw51.ICu1Nw', 2),
(17, 'guerrero', '$2Cw51.ICu1Nw', 2),
(18, 'neuman', '$2Cw51.ICu1Nw', 2),
(19, 'teboul', '$2Cw51.ICu1Nw', 2),
(20, 'belhadj', '$2Cw51.ICu1Nw', 2),
(21, 'admin', '$2gCXDSrN2DHo', 4),
(22, 'roche', '123', 2),
(23, 'fontaine', '123', 2),
(24, 'marie', '123', 2),
(25, 'Simon', '123', 2),
(26, 'Delo', '123', 2),
(27, 'Ruit', '123', 2),
(28, 'Pochet', '$21N5YZFMHzG2', 1),
(29, 'pochet', '$22RmIkCCm0t2', 1),
(30, 'pochet', '$21N5YZFMHzG2', 1),
(31, 'pochet', '$21N5YZFMHzG2', 1),
(32, 'pochet', '$21N5YZFMHzG2', 1),
(33, 'pochet', '$21N5YZFMHzG2', 1),
(34, 'pochet', '$21N5YZFMHzG2', 1),
(35, 'pochet', '$21N5YZFMHzG2', 1),
(36, 'pochet', '$21N5YZFMHzG2', 1);

-- --------------------------------------------------------

--
-- Structure de la table `constituerdossier`
--

CREATE TABLE `constituerdossier` (
  `ID_CHAMP` bigint(11) NOT NULL,
  `ID_ONGLET` bigint(11) NOT NULL,
  `ID_DOSSIERPARCOURS` bigint(11) NOT NULL,
  `TXT_VALEUR` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `constituerdossier`
--

INSERT INTO `constituerdossier` (`ID_CHAMP`, `ID_ONGLET`, `ID_DOSSIERPARCOURS`, `TXT_VALEUR`) VALUES
(1, 2, 1, 'Nom prénom'),
(1, 2, 5, NULL),
(1, 2, 6, NULL),
(2, 1, 1, 'Observations'),
(2, 3, 1, '231'),
(2, 5, 1, 'entretien hépato !!! '),
(2, 1, 2, '212'),
(2, 5, 2, '252'),
(2, 7, 2, '272'),
(2, 1, 3, '213'),
(2, 5, 3, '253'),
(2, 7, 3, '273'),
(2, 1, 5, NULL),
(2, 3, 5, NULL),
(2, 5, 5, NULL),
(2, 1, 6, NULL),
(2, 3, 6, NULL),
(2, 5, 6, NULL),
(3, 1, 1, '2015/11/13 15:30'),
(3, 4, 1, '03/04/2015'),
(3, 2, 2, '03/02/2015'),
(3, 6, 2, '03/06/2015'),
(3, 2, 3, '03/02/2016'),
(3, 6, 3, '03/06/2016'),
(3, 4, 5, NULL),
(3, 4, 6, NULL),
(4, 1, 1, 'test'),
(5, 1, 1, ''),
(6, 1, 1, ''),
(7, 1, 1, '');

--
-- Déclencheurs `constituerdossier`
--
DELIMITER $$
CREATE TRIGGER `apres_modification_dossier` AFTER UPDATE ON `constituerdossier` FOR EACH ROW UPDATE dossierparcours set DATE_DERNIERE_MODIFICATION = NOW() where id_dossierparcours=NEW.id_dossierparcours
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `dossiergenerique`
--

CREATE TABLE `dossiergenerique` (
  `ID_CHAMP` bigint(11) NOT NULL,
  `ID_ONGLET` bigint(11) NOT NULL,
  `ID_PARCOURS` bigint(11) NOT NULL,
  `ID_ACTIVITE` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dossiergenerique`
--

INSERT INTO `dossiergenerique` (`ID_CHAMP`, `ID_ONGLET`, `ID_PARCOURS`, `ID_ACTIVITE`) VALUES
(1, 2, 1, 3),
(2, 1, 1, 1),
(2, 1, 2, 1),
(2, 3, 1, 4),
(2, 5, 1, 14),
(2, 5, 2, 14),
(2, 7, 2, 32),
(3, 2, 2, 3),
(3, 4, 1, 12),
(3, 6, 2, 15);

-- --------------------------------------------------------

--
-- Structure de la table `dossierparcours`
--

CREATE TABLE `dossierparcours` (
  `ID_DOSSIERPARCOURS` bigint(11) NOT NULL,
  `ID_PATIENT` bigint(11) NOT NULL,
  `ID_PARCOURS` bigint(11) NOT NULL,
  `DATE_CREATION_DOSSIER` date NOT NULL,
  `DATE_DERNIERE_MODIFICATION` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dossierparcours`
--

INSERT INTO `dossierparcours` (`ID_DOSSIERPARCOURS`, `ID_PATIENT`, `ID_PARCOURS`, `DATE_CREATION_DOSSIER`, `DATE_DERNIERE_MODIFICATION`) VALUES
(1, 1, 5, '2015-11-01', '2015-11-24'),
(2, 2, 6, '2015-10-28', NULL),
(3, 2, 6, '2015-10-28', NULL),
(4, 1, 5, '2015-11-11', NULL),
(5, 1, 1, '2015-11-11', NULL),
(6, 4, 1, '2017-04-06', '2017-04-06');

--
-- Déclencheurs `dossierparcours`
--
DELIMITER $$
CREATE TRIGGER `apres_creation_dossier_parcours` AFTER INSERT ON `dossierparcours` FOR EACH ROW INSERT INTO constituerdossier (ID_CHAMP, ID_ONGLET, ID_DOSSIERPARCOURS, TXT_VALEUR)
SELECT id_champ,id_onglet, NEW.id_dossierparcours, NULL
FROM dossiergenerique
WHERE id_parcours = NEW.id_parcours
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `etreindisponible`
--

CREATE TABLE `etreindisponible` (
  `ID_ETREINDISPONIBLE` bigint(11) NOT NULL,
  `ID_RESSOURCE` bigint(11) NOT NULL,
  `DATE_DEBUT` datetime NOT NULL,
  `DATE_FIN` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `end` datetime NOT NULL,
  `start` datetime NOT NULL,
  `ressourceId` bigint(11) NOT NULL,
  `patientId` bigint(11) NOT NULL,
  `parcoursId` bigint(11) NOT NULL,
  `activiteId` bigint(11) NOT NULL,
  `color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `evenement`
--

INSERT INTO `evenement` (`id`, `title`, `end`, `start`, `ressourceId`, `patientId`, `parcoursId`, `activiteId`, `color`) VALUES
(325, 'Martin Simon - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 10:20:00', '2017-04-06 10:00:00', 1, 1, 1, 1, '#FF1490'),
(326, 'Martin Simon - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 10:20:00', '2017-04-06 10:00:00', 23, 1, 1, 1, '#FF1490'),
(329, 'Martin Simon - ECG - Obésité sévère – diagnostique', '2017-04-06 10:40:00', '2017-04-06 10:25:00', 3, 1, 1, 2, '#FF1490'),
(330, 'Martin Simon - ECG - Obésité sévère – diagnostique', '2017-04-06 10:40:00', '2017-04-06 10:25:00', 17, 1, 1, 2, '#FF1490'),
(331, 'Martin Simon - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 11:15:00', '2017-04-06 11:00:00', 4, 1, 1, 3, '#FF1490'),
(332, 'Martin Simon - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 11:15:00', '2017-04-06 11:00:00', 19, 1, 1, 3, '#FF1490'),
(333, 'Martin Simon - Echo hépatique - Obésité sévère – diagnostique', '2017-04-06 11:00:00', '2017-04-06 10:45:00', 31, 1, 1, 4, '#FF1490'),
(334, 'Martin Simon - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 11:45:00', '2017-04-06 11:15:00', 2, 1, 1, 5, '#FF1490'),
(335, 'Martin Simon - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 11:45:00', '2017-04-06 11:15:00', 39, 1, 1, 5, '#FF1490'),
(336, 'Martin Simon - Collation - Obésité sévère – diagnostique', '2017-04-06 11:55:00', '2017-04-06 11:45:00', 3, 1, 1, 31, '#FF1490'),
(337, 'Martin Simon - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 12:35:00', '2017-04-06 11:55:00', 5, 1, 1, 6, '#FF1490'),
(338, 'Martin Simon - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 12:35:00', '2017-04-06 11:55:00', 25, 1, 1, 6, '#FF1490'),
(339, 'Martin Simon - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 14:05:00', '2017-04-06 13:35:00', 1, 1, 1, 7, '#FF1490'),
(340, 'Martin Simon - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 14:05:00', '2017-04-06 13:35:00', 23, 1, 1, 7, '#FF1490'),
(341, 'Martin Simon - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 13:35:00', '2017-04-06 12:35:00', 7, 1, 1, 8, '#FF1490'),
(342, 'Martin Simon - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 13:35:00', '2017-04-06 12:35:00', 24, 1, 1, 8, '#FF1490'),
(343, 'Martin Simon - synthèse - Obésité sévère – diagnostique', '2017-04-06 14:45:00', '2017-04-06 14:15:00', 9, 1, 1, 9, '#FF1490'),
(344, 'Martin Simon - synthèse - Obésité sévère – diagnostique', '2017-04-06 14:45:00', '2017-04-06 14:15:00', 23, 1, 1, 9, '#FF1490'),
(345, 'Bernard Laurent - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 09:10:00', '2017-04-06 08:50:00', 2, 2, 1, 1, '#90BC90'),
(346, 'Bernard Laurent - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 09:10:00', '2017-04-06 08:50:00', 23, 2, 1, 1, '#90BC90'),
(347, 'Bernard Laurent - ECG - Obésité sévère – diagnostique', '2017-04-06 09:30:00', '2017-04-06 09:15:00', 3, 2, 1, 2, '#90BC90'),
(348, 'Bernard Laurent - ECG - Obésité sévère – diagnostique', '2017-04-06 09:30:00', '2017-04-06 09:15:00', 17, 2, 1, 2, '#90BC90'),
(349, 'Bernard Laurent - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 09:45:00', '2017-04-06 09:30:00', 4, 2, 1, 3, '#90BC90'),
(350, 'Bernard Laurent - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 09:45:00', '2017-04-06 09:30:00', 19, 2, 1, 3, '#90BC90'),
(351, 'Bernard Laurent - Echo hépatique - Obésité sévère – diagnostique', '2017-04-06 10:00:00', '2017-04-06 09:45:00', 31, 2, 1, 4, '#90BC90'),
(352, 'Bernard Laurent - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 10:30:00', '2017-04-06 10:00:00', 37, 2, 1, 5, '#90BC90'),
(353, 'Bernard Laurent - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 10:30:00', '2017-04-06 10:00:00', 24, 2, 1, 5, '#90BC90'),
(354, 'Bernard Laurent - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 11:25:00', '2017-04-06 10:45:00', 5, 2, 1, 6, '#90BC90'),
(355, 'Bernard Laurent - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 11:25:00', '2017-04-06 10:45:00', 25, 2, 1, 6, '#90BC90'),
(356, 'Bernard Laurent - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 12:05:00', '2017-04-06 11:35:00', 1, 2, 1, 7, '#90BC90'),
(357, 'Bernard Laurent - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 12:05:00', '2017-04-06 11:35:00', 24, 2, 1, 7, '#90BC90'),
(364, 'Bernard Laurent - Collation - Obésité sévère – diagnostique', '2017-04-06 10:40:00', '2017-04-06 10:30:00', 6, 2, 1, 31, '#90BC90'),
(373, 'Bernard Laurent - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 13:05:00', '2017-04-06 12:05:00', 34, 2, 1, 8, '#90BC90'),
(374, 'Bernard Laurent - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 13:05:00', '2017-04-06 12:05:00', 23, 2, 1, 8, '#90BC90'),
(375, 'Bernard Laurent - synthèse - Obésité sévère – diagnostique', '2017-04-06 13:50:00', '2017-04-06 13:20:00', 10, 2, 1, 9, '#90BC90'),
(376, 'Bernard Laurent - synthèse - Obésité sévère – diagnostique', '2017-04-06 13:50:00', '2017-04-06 13:20:00', 39, 2, 1, 9, '#90BC90'),
(377, 'Robert Garcia - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 08:20:00', '2017-04-06 08:00:00', 1, 5, 1, 1, '#880088'),
(378, 'Robert Garcia - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 08:20:00', '2017-04-06 08:00:00', 23, 5, 1, 1, '#880088'),
(379, 'Robert Garcia - ECG - Obésité sévère – diagnostique', '2017-04-06 08:40:00', '2017-04-06 08:25:00', 3, 5, 1, 2, '#880088'),
(380, 'Robert Garcia - ECG - Obésité sévère – diagnostique', '2017-04-06 08:40:00', '2017-04-06 08:25:00', 17, 5, 1, 2, '#880088'),
(381, 'Robert Garcia - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 08:55:00', '2017-04-06 08:40:00', 4, 5, 1, 3, '#880088'),
(382, 'Robert Garcia - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 08:55:00', '2017-04-06 08:40:00', 19, 5, 1, 3, '#880088'),
(383, 'Robert Garcia - Echo hépatique - Obésité sévère – diagnostique', '2017-04-06 09:10:00', '2017-04-06 08:55:00', 31, 5, 1, 4, '#880088'),
(384, 'Leroy Vincent - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 09:20:00', '2017-04-06 09:00:00', 1, 9, 1, 1, '#FF8C00'),
(385, 'Leroy Vincent - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 09:20:00', '2017-04-06 09:00:00', 24, 9, 1, 1, '#FF8C00'),
(386, 'Leroy Vincent - ECG - Obésité sévère – diagnostique', '2017-04-06 09:40:00', '2017-04-06 09:25:00', 32, 9, 1, 2, '#FF8C00'),
(387, 'Leroy Vincent - ECG - Obésité sévère – diagnostique', '2017-04-06 09:40:00', '2017-04-06 09:25:00', 18, 9, 1, 2, '#FF8C00'),
(388, 'Leroy Vincent - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 09:55:00', '2017-04-06 09:40:00', 36, 9, 1, 3, '#FF8C00'),
(389, 'Leroy Vincent - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 09:55:00', '2017-04-06 09:40:00', 20, 9, 1, 3, '#FF8C00'),
(390, 'Leroy Vincent - Echo hépatique - Obésité sévère – diagnostique', '2017-04-06 10:10:00', '2017-04-06 09:55:00', 38, 9, 1, 4, '#FF8C00'),
(391, 'Leroy Vincent - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 11:35:00', '2017-04-06 10:55:00', 33, 9, 1, 6, '#FF8C00'),
(392, 'Leroy Vincent - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 11:35:00', '2017-04-06 10:55:00', 26, 9, 1, 6, '#FF8C00'),
(393, 'Leroy Vincent - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 10:45:00', '2017-04-06 10:15:00', 2, 9, 1, 5, '#FF8C00'),
(394, 'Leroy Vincent - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 10:45:00', '2017-04-06 10:15:00', 40, 9, 1, 5, '#FF8C00'),
(395, 'Leroy Vincent - Collation - Obésité sévère – diagnostique', '2017-04-06 10:55:00', '2017-04-06 10:45:00', 33, 9, 1, 31, '#FF8C00'),
(396, 'Leroy Vincent - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 12:10:00', '2017-04-06 11:40:00', 37, 9, 1, 7, '#FF8C00'),
(397, 'Leroy Vincent - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 12:10:00', '2017-04-06 11:40:00', 40, 9, 1, 7, '#FF8C00'),
(398, 'Leroy Vincent - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 13:10:00', '2017-04-06 12:10:00', 8, 9, 1, 8, '#FF8C00'),
(399, 'Leroy Vincent - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 13:10:00', '2017-04-06 12:10:00', 39, 9, 1, 8, '#FF8C00'),
(400, 'Leroy Vincent - synthèse - Obésité sévère – diagnostique', '2017-04-06 13:45:00', '2017-04-06 13:15:00', 9, 9, 1, 9, '#FF8C00'),
(401, 'Leroy Vincent - synthèse - Obésité sévère – diagnostique', '2017-04-06 13:45:00', '2017-04-06 13:15:00', 40, 9, 1, 9, '#FF8C00'),
(402, 'Robert Garcia - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 09:40:00', '2017-04-06 09:10:00', 37, 5, 1, 5, '#880088'),
(403, 'Robert Garcia - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 09:40:00', '2017-04-06 09:10:00', 39, 5, 1, 5, '#880088'),
(404, 'Robert Garcia - Collation - Obésité sévère – diagnostique', '2017-04-06 09:50:00', '2017-04-06 09:40:00', 35, 5, 1, 31, '#880088'),
(405, 'Robert Garcia - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 10:30:00', '2017-04-06 09:50:00', 5, 5, 1, 6, '#880088'),
(406, 'Robert Garcia - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 10:30:00', '2017-04-06 09:50:00', 25, 5, 1, 6, '#880088'),
(407, 'Robert Garcia - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 11:00:00', '2017-04-06 10:30:00', 1, 5, 1, 7, '#880088'),
(408, 'Robert Garcia - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 11:00:00', '2017-04-06 10:30:00', 39, 5, 1, 7, '#880088'),
(409, 'Robert Garcia - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 12:00:00', '2017-04-06 11:00:00', 7, 5, 1, 8, '#880088'),
(410, 'Robert Garcia - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 12:00:00', '2017-04-06 11:00:00', 23, 5, 1, 8, '#880088'),
(411, 'Robert Garcia - synthèse - Obésité sévère – diagnostique', '2017-04-06 12:35:00', '2017-04-06 12:05:00', 35, 5, 1, 9, '#880088'),
(412, 'Robert Garcia - synthèse - Obésité sévère – diagnostique', '2017-04-06 12:35:00', '2017-04-06 12:05:00', 24, 5, 1, 9, '#880088'),
(413, 'Dubois Lefebvre - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 14:50:00', '2017-04-06 14:30:00', 1, 3, 1, 1, '#008C90'),
(414, 'Dubois Lefebvre - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 14:50:00', '2017-04-06 14:30:00', 24, 3, 1, 1, '#008C90'),
(415, 'Dubois Lefebvre - ECG - Obésité sévère – diagnostique', '2017-04-06 15:35:00', '2017-04-06 15:20:00', 3, 3, 1, 2, '#008C90'),
(416, 'Dubois Lefebvre - ECG - Obésité sévère – diagnostique', '2017-04-06 15:35:00', '2017-04-06 15:20:00', 17, 3, 1, 2, '#008C90'),
(417, 'Dubois Lefebvre - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 15:15:00', '2017-04-06 15:00:00', 4, 3, 1, 3, '#008C90'),
(418, 'Dubois Lefebvre - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 15:15:00', '2017-04-06 15:00:00', 19, 3, 1, 3, '#008C90'),
(419, 'Dubois Lefebvre - Echo hépatique - Obésité sévère – diagnostique', '2017-04-06 16:20:00', '2017-04-06 16:05:00', 31, 3, 1, 4, '#008C90'),
(420, 'Dubois Lefebvre - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 16:05:00', '2017-04-06 15:35:00', 1, 3, 1, 5, '#008C90'),
(421, 'Dubois Lefebvre - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 16:05:00', '2017-04-06 15:35:00', 23, 3, 1, 5, '#008C90'),
(422, 'Dubois Lefebvre - Collation - Obésité sévère – diagnostique', '2017-04-06 16:40:00', '2017-04-06 16:30:00', 5, 3, 1, 31, '#008C90'),
(423, 'Dubois Lefebvre - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 17:55:00', '2017-04-06 17:15:00', 6, 3, 1, 6, '#008C90'),
(424, 'Dubois Lefebvre - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 17:55:00', '2017-04-06 17:15:00', 25, 3, 1, 6, '#008C90'),
(425, 'Dubois Lefebvre - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 17:15:00', '2017-04-06 16:45:00', 1, 3, 1, 7, '#008C90'),
(426, 'Dubois Lefebvre - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 17:15:00', '2017-04-06 16:45:00', 23, 3, 1, 7, '#008C90'),
(427, 'Dubois Lefebvre - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 18:55:00', '2017-04-06 17:55:00', 7, 3, 1, 8, '#008C90'),
(428, 'Dubois Lefebvre - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 18:55:00', '2017-04-06 17:55:00', 24, 3, 1, 8, '#008C90'),
(429, 'Dubois Lefebvre - synthèse - Obésité sévère – diagnostique', '2017-04-06 19:30:00', '2017-04-06 19:00:00', 9, 3, 1, 9, '#008C90'),
(430, 'Dubois Lefebvre - synthèse - Obésité sévère – diagnostique', '2017-04-06 19:30:00', '2017-04-06 19:00:00', 23, 3, 1, 9, '#008C90'),
(434, 'Moreau Fournier - RDV paramédical - Obésité sévère – diagnostique', '2017-03-29 08:20:00', '2017-03-29 08:00:00', 1, 10, 1, 1, '#9800D8'),
(435, 'Moreau Fournier - RDV paramédical - Obésité sévère – diagnostique', '2017-03-29 08:20:00', '2017-03-29 08:00:00', 23, 10, 1, 1, '#9800D8'),
(436, 'Moreau Fournier - ECG - Obésité sévère – diagnostique', '2017-03-29 08:40:00', '2017-03-29 08:25:00', 3, 10, 1, 2, '#9800D8'),
(437, 'Moreau Fournier - ECG - Obésité sévère – diagnostique', '2017-03-29 08:40:00', '2017-03-29 08:25:00', 17, 10, 1, 2, '#9800D8'),
(438, 'Moreau Fournier - Bilan biologique - Obésité sévère – diagnostique', '2017-03-29 08:55:00', '2017-03-29 08:40:00', 4, 10, 1, 3, '#9800D8'),
(439, 'Moreau Fournier - Bilan biologique - Obésité sévère – diagnostique', '2017-03-29 08:55:00', '2017-03-29 08:40:00', 19, 10, 1, 3, '#9800D8'),
(440, 'Moreau Fournier - Echo hépatique - Obésité sévère – diagnostique', '2017-03-29 09:10:00', '2017-03-29 08:55:00', 31, 10, 1, 4, '#9800D8'),
(441, 'Moreau Fournier - Calorimétrie - Obésité sévère – diagnostique', '2017-03-29 09:45:00', '2017-03-29 09:15:00', 1, 10, 1, 5, '#9800D8'),
(442, 'Moreau Fournier - Calorimétrie - Obésité sévère – diagnostique', '2017-03-29 09:45:00', '2017-03-29 09:15:00', 23, 10, 1, 5, '#9800D8'),
(443, 'Moreau Fournier - Collation - Obésité sévère – diagnostique', '2017-03-29 09:55:00', '2017-03-29 09:45:00', 37, 10, 1, 31, '#9800D8'),
(444, 'Moreau Fournier - Entretien psy - Obésité sévère – diagnostique', '2017-03-29 10:40:00', '2017-03-29 10:00:00', 5, 10, 1, 6, '#9800D8'),
(445, 'Moreau Fournier - Entretien psy - Obésité sévère – diagnostique', '2017-03-29 10:40:00', '2017-03-29 10:00:00', 25, 10, 1, 6, '#9800D8'),
(446, 'Moreau Fournier - Entretien infirmier - Obésité sévère – diagnostique', '2017-03-29 11:20:00', '2017-03-29 10:50:00', 1, 10, 1, 7, '#9800D8'),
(447, 'Moreau Fournier - Entretien infirmier - Obésité sévère – diagnostique', '2017-03-29 11:20:00', '2017-03-29 10:50:00', 23, 10, 1, 7, '#9800D8'),
(448, 'Moreau Fournier - Entretien diet - Obésité sévère – diagnostique', '2017-03-29 12:20:00', '2017-03-29 11:20:00', 7, 10, 1, 8, '#9800D8'),
(449, 'Moreau Fournier - Entretien diet - Obésité sévère – diagnostique', '2017-03-29 12:20:00', '2017-03-29 11:20:00', 24, 10, 1, 8, '#9800D8'),
(450, 'Moreau Fournier - synthèse - Obésité sévère – diagnostique', '2017-03-29 12:55:00', '2017-03-29 12:25:00', 9, 10, 1, 9, '#9800D8'),
(451, 'Moreau Fournier - synthèse - Obésité sévère – diagnostique', '2017-03-29 12:55:00', '2017-03-29 12:25:00', 23, 10, 1, 9, '#9800D8');

-- --------------------------------------------------------

--
-- Structure de la table `jour`
--

CREATE TABLE `jour` (
  `ID_JOUR` bigint(20) NOT NULL,
  `TXT_JOUR` varchar(20) NOT NULL,
  `INT_JOUR_SQL` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `jour`
--

INSERT INTO `jour` (`ID_JOUR`, `TXT_JOUR`, `INT_JOUR_SQL`) VALUES
(1, 'lundi', 0),
(2, 'mardi', 1),
(3, 'mercredi', 2),
(4, 'jeudi', 3),
(5, 'vendredi', 4),
(6, 'samedi', 5),
(7, 'dimanche', 6);

-- --------------------------------------------------------

--
-- Structure de la table `necessiter`
--

CREATE TABLE `necessiter` (
  `ID_ACTIVITE` bigint(11) NOT NULL,
  `ID_TYPERESSOURCE` bigint(11) NOT NULL,
  `QUANTITE` bigint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `necessiter`
--

INSERT INTO `necessiter` (`ID_ACTIVITE`, `ID_TYPERESSOURCE`, `QUANTITE`) VALUES
(1, 1, 1),
(1, 43, 1),
(2, 2, 1),
(2, 40, 1),
(3, 2, 1),
(3, 41, 1),
(4, 42, 1),
(5, 1, 1),
(5, 43, 1),
(6, 3, 1),
(6, 44, 1),
(7, 1, 1),
(7, 43, 1),
(8, 4, 1),
(8, 43, 1),
(9, 5, 1),
(9, 43, 1);

-- --------------------------------------------------------

--
-- Structure de la table `onglet`
--

CREATE TABLE `onglet` (
  `ID_ONGLET` bigint(11) NOT NULL,
  `TXT_NOM` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `onglet`
--

INSERT INTO `onglet` (`ID_ONGLET`, `TXT_NOM`) VALUES
(1, 'RDV paramédical'),
(2, 'Bilan biologique'),
(3, 'Echo hépatique'),
(4, 'Fibroscan'),
(5, 'Entretien hépato'),
(6, 'Traitement Rémicade'),
(7, 'Synthèse');

-- --------------------------------------------------------

--
-- Structure de la table `ordonnancer`
--

CREATE TABLE `ordonnancer` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `end` datetime NOT NULL,
  `start` datetime NOT NULL,
  `ressourceId` bigint(11) NOT NULL,
  `patientId` bigint(11) NOT NULL,
  `parcoursId` bigint(11) NOT NULL,
  `activiteId` bigint(11) NOT NULL,
  `color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ordonnancer`
--

INSERT INTO `ordonnancer` (`id`, `title`, `end`, `start`, `ressourceId`, `patientId`, `parcoursId`, `activiteId`, `color`) VALUES
(325, 'Martin Simon - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 10:20:00', '2017-04-06 10:00:00', 1, 1, 1, 1, '#FF1490'),
(326, 'Martin Simon - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 10:20:00', '2017-04-06 10:00:00', 23, 1, 1, 1, '#FF1490'),
(329, 'Martin Simon - ECG - Obésité sévère – diagnostique', '2017-04-06 10:40:00', '2017-04-06 10:25:00', 3, 1, 1, 2, '#FF1490'),
(330, 'Martin Simon - ECG - Obésité sévère – diagnostique', '2017-04-06 10:40:00', '2017-04-06 10:25:00', 17, 1, 1, 2, '#FF1490'),
(331, 'Martin Simon - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 11:15:00', '2017-04-06 11:00:00', 4, 1, 1, 3, '#FF1490'),
(332, 'Martin Simon - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 11:15:00', '2017-04-06 11:00:00', 19, 1, 1, 3, '#FF1490'),
(333, 'Martin Simon - Echo hépatique - Obésité sévère – diagnostique', '2017-04-06 11:00:00', '2017-04-06 10:45:00', 31, 1, 1, 4, '#FF1490'),
(334, 'Martin Simon - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 11:45:00', '2017-04-06 11:15:00', 2, 1, 1, 5, '#FF1490'),
(335, 'Martin Simon - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 11:45:00', '2017-04-06 11:15:00', 39, 1, 1, 5, '#FF1490'),
(336, 'Martin Simon - Collation - Obésité sévère – diagnostique', '2017-04-06 11:55:00', '2017-04-06 11:45:00', 3, 1, 1, 31, '#FF1490'),
(337, 'Martin Simon - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 12:35:00', '2017-04-06 11:55:00', 5, 1, 1, 6, '#FF1490'),
(338, 'Martin Simon - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 12:35:00', '2017-04-06 11:55:00', 25, 1, 1, 6, '#FF1490'),
(339, 'Martin Simon - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 14:05:00', '2017-04-06 13:35:00', 1, 1, 1, 7, '#FF1490'),
(340, 'Martin Simon - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 14:05:00', '2017-04-06 13:35:00', 23, 1, 1, 7, '#FF1490'),
(341, 'Martin Simon - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 13:35:00', '2017-04-06 12:35:00', 7, 1, 1, 8, '#FF1490'),
(342, 'Martin Simon - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 13:35:00', '2017-04-06 12:35:00', 24, 1, 1, 8, '#FF1490'),
(343, 'Martin Simon - synthèse - Obésité sévère – diagnostique', '2017-04-06 14:45:00', '2017-04-06 14:15:00', 9, 1, 1, 9, '#FF1490'),
(344, 'Martin Simon - synthèse - Obésité sévère – diagnostique', '2017-04-06 14:45:00', '2017-04-06 14:15:00', 23, 1, 1, 9, '#FF1490'),
(345, 'Bernard Laurent - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 09:10:00', '2017-04-06 08:50:00', 2, 2, 1, 1, '#90BC90'),
(346, 'Bernard Laurent - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 09:10:00', '2017-04-06 08:50:00', 23, 2, 1, 1, '#90BC90'),
(347, 'Bernard Laurent - ECG - Obésité sévère – diagnostique', '2017-04-06 09:30:00', '2017-04-06 09:15:00', 3, 2, 1, 2, '#90BC90'),
(348, 'Bernard Laurent - ECG - Obésité sévère – diagnostique', '2017-04-06 09:30:00', '2017-04-06 09:15:00', 17, 2, 1, 2, '#90BC90'),
(349, 'Bernard Laurent - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 09:45:00', '2017-04-06 09:30:00', 4, 2, 1, 3, '#90BC90'),
(350, 'Bernard Laurent - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 09:45:00', '2017-04-06 09:30:00', 19, 2, 1, 3, '#90BC90'),
(351, 'Bernard Laurent - Echo hépatique - Obésité sévère – diagnostique', '2017-04-06 10:00:00', '2017-04-06 09:45:00', 31, 2, 1, 4, '#90BC90'),
(352, 'Bernard Laurent - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 10:30:00', '2017-04-06 10:00:00', 37, 2, 1, 5, '#90BC90'),
(353, 'Bernard Laurent - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 10:30:00', '2017-04-06 10:00:00', 24, 2, 1, 5, '#90BC90'),
(354, 'Bernard Laurent - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 11:25:00', '2017-04-06 10:45:00', 5, 2, 1, 6, '#90BC90'),
(355, 'Bernard Laurent - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 11:25:00', '2017-04-06 10:45:00', 25, 2, 1, 6, '#90BC90'),
(356, 'Bernard Laurent - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 12:05:00', '2017-04-06 11:35:00', 1, 2, 1, 7, '#90BC90'),
(357, 'Bernard Laurent - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 12:05:00', '2017-04-06 11:35:00', 24, 2, 1, 7, '#90BC90'),
(364, 'Bernard Laurent - Collation - Obésité sévère – diagnostique', '2017-04-06 10:40:00', '2017-04-06 10:30:00', 6, 2, 1, 31, '#90BC90'),
(373, 'Bernard Laurent - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 13:05:00', '2017-04-06 12:05:00', 34, 2, 1, 8, '#90BC90'),
(374, 'Bernard Laurent - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 13:05:00', '2017-04-06 12:05:00', 23, 2, 1, 8, '#90BC90'),
(375, 'Bernard Laurent - synthèse - Obésité sévère – diagnostique', '2017-04-06 13:50:00', '2017-04-06 13:20:00', 10, 2, 1, 9, '#90BC90'),
(376, 'Bernard Laurent - synthèse - Obésité sévère – diagnostique', '2017-04-06 13:50:00', '2017-04-06 13:20:00', 39, 2, 1, 9, '#90BC90'),
(377, 'Robert Garcia - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 08:20:00', '2017-04-06 08:00:00', 1, 5, 1, 1, '#880088'),
(378, 'Robert Garcia - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 08:20:00', '2017-04-06 08:00:00', 23, 5, 1, 1, '#880088'),
(379, 'Robert Garcia - ECG - Obésité sévère – diagnostique', '2017-04-06 08:40:00', '2017-04-06 08:25:00', 3, 5, 1, 2, '#880088'),
(380, 'Robert Garcia - ECG - Obésité sévère – diagnostique', '2017-04-06 08:40:00', '2017-04-06 08:25:00', 17, 5, 1, 2, '#880088'),
(381, 'Robert Garcia - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 08:55:00', '2017-04-06 08:40:00', 4, 5, 1, 3, '#880088'),
(382, 'Robert Garcia - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 08:55:00', '2017-04-06 08:40:00', 19, 5, 1, 3, '#880088'),
(383, 'Robert Garcia - Echo hépatique - Obésité sévère – diagnostique', '2017-04-06 09:10:00', '2017-04-06 08:55:00', 31, 5, 1, 4, '#880088'),
(384, 'Leroy Vincent - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 09:20:00', '2017-04-06 09:00:00', 1, 9, 1, 1, '#FF8C00'),
(385, 'Leroy Vincent - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 09:20:00', '2017-04-06 09:00:00', 24, 9, 1, 1, '#FF8C00'),
(386, 'Leroy Vincent - ECG - Obésité sévère – diagnostique', '2017-04-06 09:40:00', '2017-04-06 09:25:00', 32, 9, 1, 2, '#FF8C00'),
(387, 'Leroy Vincent - ECG - Obésité sévère – diagnostique', '2017-04-06 09:40:00', '2017-04-06 09:25:00', 18, 9, 1, 2, '#FF8C00'),
(388, 'Leroy Vincent - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 09:55:00', '2017-04-06 09:40:00', 36, 9, 1, 3, '#FF8C00'),
(389, 'Leroy Vincent - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 09:55:00', '2017-04-06 09:40:00', 20, 9, 1, 3, '#FF8C00'),
(390, 'Leroy Vincent - Echo hépatique - Obésité sévère – diagnostique', '2017-04-06 10:10:00', '2017-04-06 09:55:00', 38, 9, 1, 4, '#FF8C00'),
(391, 'Leroy Vincent - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 11:35:00', '2017-04-06 10:55:00', 33, 9, 1, 6, '#FF8C00'),
(392, 'Leroy Vincent - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 11:35:00', '2017-04-06 10:55:00', 26, 9, 1, 6, '#FF8C00'),
(393, 'Leroy Vincent - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 10:45:00', '2017-04-06 10:15:00', 2, 9, 1, 5, '#FF8C00'),
(394, 'Leroy Vincent - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 10:45:00', '2017-04-06 10:15:00', 40, 9, 1, 5, '#FF8C00'),
(395, 'Leroy Vincent - Collation - Obésité sévère – diagnostique', '2017-04-06 10:55:00', '2017-04-06 10:45:00', 33, 9, 1, 31, '#FF8C00'),
(396, 'Leroy Vincent - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 12:10:00', '2017-04-06 11:40:00', 37, 9, 1, 7, '#FF8C00'),
(397, 'Leroy Vincent - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 12:10:00', '2017-04-06 11:40:00', 40, 9, 1, 7, '#FF8C00'),
(398, 'Leroy Vincent - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 13:10:00', '2017-04-06 12:10:00', 8, 9, 1, 8, '#FF8C00'),
(399, 'Leroy Vincent - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 13:10:00', '2017-04-06 12:10:00', 39, 9, 1, 8, '#FF8C00'),
(400, 'Leroy Vincent - synthèse - Obésité sévère – diagnostique', '2017-04-06 13:45:00', '2017-04-06 13:15:00', 9, 9, 1, 9, '#FF8C00'),
(401, 'Leroy Vincent - synthèse - Obésité sévère – diagnostique', '2017-04-06 13:45:00', '2017-04-06 13:15:00', 40, 9, 1, 9, '#FF8C00'),
(402, 'Robert Garcia - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 09:40:00', '2017-04-06 09:10:00', 37, 5, 1, 5, '#880088'),
(403, 'Robert Garcia - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 09:40:00', '2017-04-06 09:10:00', 39, 5, 1, 5, '#880088'),
(404, 'Robert Garcia - Collation - Obésité sévère – diagnostique', '2017-04-06 09:50:00', '2017-04-06 09:40:00', 35, 5, 1, 31, '#880088'),
(405, 'Robert Garcia - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 10:30:00', '2017-04-06 09:50:00', 5, 5, 1, 6, '#880088'),
(406, 'Robert Garcia - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 10:30:00', '2017-04-06 09:50:00', 25, 5, 1, 6, '#880088'),
(407, 'Robert Garcia - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 11:00:00', '2017-04-06 10:30:00', 1, 5, 1, 7, '#880088'),
(408, 'Robert Garcia - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 11:00:00', '2017-04-06 10:30:00', 39, 5, 1, 7, '#880088'),
(409, 'Robert Garcia - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 12:00:00', '2017-04-06 11:00:00', 7, 5, 1, 8, '#880088'),
(410, 'Robert Garcia - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 12:00:00', '2017-04-06 11:00:00', 23, 5, 1, 8, '#880088'),
(411, 'Robert Garcia - synthèse - Obésité sévère – diagnostique', '2017-04-06 12:35:00', '2017-04-06 12:05:00', 35, 5, 1, 9, '#880088'),
(412, 'Robert Garcia - synthèse - Obésité sévère – diagnostique', '2017-04-06 12:35:00', '2017-04-06 12:05:00', 24, 5, 1, 9, '#880088'),
(413, 'Dubois Lefebvre - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 14:50:00', '2017-04-06 14:30:00', 1, 3, 1, 1, '#008C90'),
(414, 'Dubois Lefebvre - RDV paramédical - Obésité sévère – diagnostique', '2017-04-06 14:50:00', '2017-04-06 14:30:00', 24, 3, 1, 1, '#008C90'),
(415, 'Dubois Lefebvre - ECG - Obésité sévère – diagnostique', '2017-04-06 15:35:00', '2017-04-06 15:20:00', 3, 3, 1, 2, '#008C90'),
(416, 'Dubois Lefebvre - ECG - Obésité sévère – diagnostique', '2017-04-06 15:35:00', '2017-04-06 15:20:00', 17, 3, 1, 2, '#008C90'),
(417, 'Dubois Lefebvre - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 15:15:00', '2017-04-06 15:00:00', 4, 3, 1, 3, '#008C90'),
(418, 'Dubois Lefebvre - Bilan biologique - Obésité sévère – diagnostique', '2017-04-06 15:15:00', '2017-04-06 15:00:00', 19, 3, 1, 3, '#008C90'),
(419, 'Dubois Lefebvre - Echo hépatique - Obésité sévère – diagnostique', '2017-04-06 16:20:00', '2017-04-06 16:05:00', 31, 3, 1, 4, '#008C90'),
(420, 'Dubois Lefebvre - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 16:05:00', '2017-04-06 15:35:00', 1, 3, 1, 5, '#008C90'),
(421, 'Dubois Lefebvre - Calorimétrie - Obésité sévère – diagnostique', '2017-04-06 16:05:00', '2017-04-06 15:35:00', 23, 3, 1, 5, '#008C90'),
(422, 'Dubois Lefebvre - Collation - Obésité sévère – diagnostique', '2017-04-06 16:40:00', '2017-04-06 16:30:00', 5, 3, 1, 31, '#008C90'),
(423, 'Dubois Lefebvre - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 17:55:00', '2017-04-06 17:15:00', 6, 3, 1, 6, '#008C90'),
(424, 'Dubois Lefebvre - Entretien psy - Obésité sévère – diagnostique', '2017-04-06 17:55:00', '2017-04-06 17:15:00', 25, 3, 1, 6, '#008C90'),
(425, 'Dubois Lefebvre - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 17:15:00', '2017-04-06 16:45:00', 1, 3, 1, 7, '#008C90'),
(426, 'Dubois Lefebvre - Entretien infirmier - Obésité sévère – diagnostique', '2017-04-06 17:15:00', '2017-04-06 16:45:00', 23, 3, 1, 7, '#008C90'),
(427, 'Dubois Lefebvre - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 18:55:00', '2017-04-06 17:55:00', 7, 3, 1, 8, '#008C90'),
(428, 'Dubois Lefebvre - Entretien diet - Obésité sévère – diagnostique', '2017-04-06 18:55:00', '2017-04-06 17:55:00', 24, 3, 1, 8, '#008C90'),
(429, 'Dubois Lefebvre - synthèse - Obésité sévère – diagnostique', '2017-04-06 19:30:00', '2017-04-06 19:00:00', 9, 3, 1, 9, '#008C90'),
(430, 'Dubois Lefebvre - synthèse - Obésité sévère – diagnostique', '2017-04-06 19:30:00', '2017-04-06 19:00:00', 23, 3, 1, 9, '#008C90'),
(434, 'Moreau Fournier - RDV paramédical - Obésité sévère – diagnostique', '2017-03-29 08:20:00', '2017-03-29 08:00:00', 1, 10, 1, 1, '#9800D8'),
(435, 'Moreau Fournier - RDV paramédical - Obésité sévère – diagnostique', '2017-03-29 08:20:00', '2017-03-29 08:00:00', 23, 10, 1, 1, '#9800D8'),
(436, 'Moreau Fournier - ECG - Obésité sévère – diagnostique', '2017-03-29 08:40:00', '2017-03-29 08:25:00', 3, 10, 1, 2, '#9800D8'),
(437, 'Moreau Fournier - ECG - Obésité sévère – diagnostique', '2017-03-29 08:40:00', '2017-03-29 08:25:00', 17, 10, 1, 2, '#9800D8'),
(438, 'Moreau Fournier - Bilan biologique - Obésité sévère – diagnostique', '2017-03-29 08:55:00', '2017-03-29 08:40:00', 4, 10, 1, 3, '#9800D8'),
(439, 'Moreau Fournier - Bilan biologique - Obésité sévère – diagnostique', '2017-03-29 08:55:00', '2017-03-29 08:40:00', 19, 10, 1, 3, '#9800D8'),
(440, 'Moreau Fournier - Echo hépatique - Obésité sévère – diagnostique', '2017-03-29 09:10:00', '2017-03-29 08:55:00', 31, 10, 1, 4, '#9800D8'),
(441, 'Moreau Fournier - Calorimétrie - Obésité sévère – diagnostique', '2017-03-29 09:45:00', '2017-03-29 09:15:00', 1, 10, 1, 5, '#9800D8'),
(442, 'Moreau Fournier - Calorimétrie - Obésité sévère – diagnostique', '2017-03-29 09:45:00', '2017-03-29 09:15:00', 23, 10, 1, 5, '#9800D8'),
(443, 'Moreau Fournier - Collation - Obésité sévère – diagnostique', '2017-03-29 09:55:00', '2017-03-29 09:45:00', 37, 10, 1, 31, '#9800D8'),
(444, 'Moreau Fournier - Entretien psy - Obésité sévère – diagnostique', '2017-03-29 10:40:00', '2017-03-29 10:00:00', 5, 10, 1, 6, '#9800D8'),
(445, 'Moreau Fournier - Entretien psy - Obésité sévère – diagnostique', '2017-03-29 10:40:00', '2017-03-29 10:00:00', 25, 10, 1, 6, '#9800D8'),
(446, 'Moreau Fournier - Entretien infirmier - Obésité sévère – diagnostique', '2017-03-29 11:20:00', '2017-03-29 10:50:00', 1, 10, 1, 7, '#9800D8'),
(447, 'Moreau Fournier - Entretien infirmier - Obésité sévère – diagnostique', '2017-03-29 11:20:00', '2017-03-29 10:50:00', 23, 10, 1, 7, '#9800D8'),
(448, 'Moreau Fournier - Entretien diet - Obésité sévère – diagnostique', '2017-03-29 12:20:00', '2017-03-29 11:20:00', 7, 10, 1, 8, '#9800D8'),
(449, 'Moreau Fournier - Entretien diet - Obésité sévère – diagnostique', '2017-03-29 12:20:00', '2017-03-29 11:20:00', 24, 10, 1, 8, '#9800D8'),
(450, 'Moreau Fournier - synthèse - Obésité sévère – diagnostique', '2017-03-29 12:55:00', '2017-03-29 12:25:00', 9, 10, 1, 9, '#9800D8'),
(451, 'Moreau Fournier - synthèse - Obésité sévère – diagnostique', '2017-03-29 12:55:00', '2017-03-29 12:25:00', 23, 10, 1, 9, '#9800D8');

-- --------------------------------------------------------

--
-- Structure de la table `parcours`
--

CREATE TABLE `parcours` (
  `ID_PARCOURS` bigint(11) NOT NULL,
  `TXT_NOM` varchar(255) DEFAULT NULL,
  `INT_OBJECTIF` int(11) DEFAULT NULL,
  `TXT_CODE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `parcours`
--

INSERT INTO `parcours` (`ID_PARCOURS`, `TXT_NOM`, `INT_OBJECTIF`, `TXT_CODE`) VALUES
(1, 'Obésité sévère – diagnostique', NULL, ''),
(2, 'Obésité sévère – Post-op', NULL, NULL),
(3, 'Obésité sévère – J+1an', NULL, NULL),
(4, 'Bilan nutritionnel hors obésité sévère', NULL, NULL),
(5, 'Dépistage des maladies du foie', 3, 'P5'),
(6, 'Biothérapies (dont MICI)', 3, 'P6'),
(7, 'Ponction ascite', NULL, NULL),
(8, 'Injection de fer', NULL, NULL),
(9, 'Bilan des complications du diabète', NULL, NULL),
(10, 'Bilan diagnostic étiologique et/ou décompensation d\'un diabète avec initiation de la prise en charge', NULL, NULL),
(11, 'Traitement du pied diabétique', NULL, NULL),
(12, 'ETP diabétique', NULL, NULL),
(13, 'HDJ nuit : Diagnostic nuit', NULL, NULL),
(14, 'HDJ Jour Diagnostic jour', NULL, NULL),
(15, 'HDJ jour : Thérapeutique', NULL, NULL),
(16, 'Chimio - Avec OK chimio', NULL, NULL),
(17, 'Chimio - sans OK chimio', NULL, NULL),
(18, 'Cardio – explorations de la maladie coronaire', NULL, NULL),
(19, 'Cardio – insuffisance cardiaque', NULL, NULL),
(20, 'Cardio – onco', NULL, NULL),
(21, 'AIT ', NULL, NULL),
(22, 'Bilan troubles cognitifs', NULL, NULL),
(23, 'Epilepsie', NULL, NULL),
(24, 'Céphalées sub-aigues', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `ID_PATIENT` bigint(11) NOT NULL,
  `ID_COMPTE` bigint(11) NOT NULL,
  `TXT_NOM` varchar(255) DEFAULT NULL,
  `TXT_PRENOM` varchar(255) DEFAULT NULL,
  `TXT_ADRESSENUM` varchar(255) DEFAULT NULL,
  `TXT_ADRESSERUE` varchar(255) DEFAULT NULL,
  `TXT_ADRESSECODEPOSTAL` varchar(255) DEFAULT NULL,
  `TXT_ADRESSEVILLE` varchar(255) DEFAULT NULL,
  `TXT_ADRESSEPAYS` varchar(255) DEFAULT NULL,
  `TXT_MAIL` varchar(255) DEFAULT NULL,
  `TXT_TELEPHONEFIXE` varchar(255) DEFAULT NULL,
  `TXT_TELEPHONEPORTABLE` varchar(255) DEFAULT NULL,
  `TXT_NUMSECU` varchar(255) DEFAULT NULL,
  `DATE_NAISSANCE` date DEFAULT NULL,
  `ID_PARCOURS_SUP` bigint(11) DEFAULT NULL,
  `DATE_DISPONIBLE_DEBUT` datetime DEFAULT NULL,
  `DATE_DISPONIBLE_FIN` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `patient`
--

INSERT INTO `patient` (`ID_PATIENT`, `ID_COMPTE`, `TXT_NOM`, `TXT_PRENOM`, `TXT_ADRESSENUM`, `TXT_ADRESSERUE`, `TXT_ADRESSECODEPOSTAL`, `TXT_ADRESSEVILLE`, `TXT_ADRESSEPAYS`, `TXT_MAIL`, `TXT_TELEPHONEFIXE`, `TXT_TELEPHONEPORTABLE`, `TXT_NUMSECU`, `DATE_NAISSANCE`, `ID_PARCOURS_SUP`, `DATE_DISPONIBLE_DEBUT`, `DATE_DISPONIBLE_FIN`) VALUES
(1, 1, 'Martin', 'Simon', '20', 'Saint-Martin', '75000', 'Paris', 'France', 'martin.simon@gmail.com', '245', '0753868034', '2545242', '2003-01-01', 1, '2017-04-06 10:00:00', '2017-04-06 18:00:00'),
(2, 2, 'Bernard', 'Laurent', '15', 'Arbre Sec', '75000', 'Paris', 'France', 'bernard.laurent@gmail.com', '454', '0753868024', '45856', '1990-09-12', 1, '2017-04-06 08:00:00', '2017-04-06 17:00:00'),
(3, 3, 'Dubois', 'Lefebvre', '6', 'Cambon', '75000', 'Paris', 'France', 'dubois.lefebvre@gmail.com', '144', '0753868029', '444', '1983-10-17', 1, '2017-04-06 10:00:00', '2017-04-06 20:00:00'),
(4, 4, 'Thomas', 'Michel', '31', 'Saint Honore', '75000', 'Paris', 'France', 'thomas.michel@gmail.com', '2522525', '0753482620', '25435343', '1972-11-05', 1, '2017-04-03 06:00:00', '2017-04-03 23:00:00'),
(5, 5, 'Robert', 'Garcia', '23', 'Temple', '75000', 'Paris', 'France', 'robert.garcia@gmail.com', '4511513', '0753864952', '3453463', '1984-11-24', 1, '2017-04-06 08:00:00', '2017-04-06 18:00:00'),
(7, 7, 'Petit', 'Bertrand', '7', 'Duphot', '37000', 'Tours', 'France', 'petit.bertrand@hotmail.com', '44', '0658426125', '533443', '1986-08-12', 1, '2017-02-16 00:00:00', '2017-02-16 00:00:00'),
(8, 8, 'Durand', 'Rous', '43', 'delperier', '37000', 'Tours', 'France', 'durand.rous@hotmail.com', '585', '0685469256', '785857887', '1995-05-06', 1, '2017-02-16 00:00:00', '2017-02-16 00:00:00'),
(9, 9, 'Leroy', 'Vincent', '91', 'etranger', '37300', 'Tours', 'France', 'leroy.vincent@gmail.com', '4541212', '0786452156', '543453422', '1983-07-16', 1, '2017-04-06 09:00:00', '2017-04-06 16:00:00'),
(10, 10, 'Moreau', 'Fournier', '23', 'grapiere', '86420', 'Lille', 'France', 'moreau.fournier@soho.com', NULL, '0753168529', '3654545', '1863-08-08', 1, '2017-03-29 08:00:00', '2017-03-29 17:00:00'),
(11, 30, 'pochet', 'guillaume', '53', 'avenue de montjoyeux', '37200', 'Tours', 'France', 'guillaume.pochet@gmail.com', '0636777546', '0636777546', '2545242', '1994-04-06', 1, '2017-04-06 08:00:00', '2017-04-06 16:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE `personnel` (
  `ID_PERSONNEL` bigint(11) NOT NULL,
  `ID_RESSOURCE` bigint(11) NOT NULL,
  `ID_COMPTE` bigint(11) NOT NULL,
  `TXT_NOM` char(255) DEFAULT NULL,
  `TXT_PRENOM` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personnel`
--

INSERT INTO `personnel` (`ID_PERSONNEL`, `ID_RESSOURCE`, `ID_COMPTE`, `TXT_NOM`, `TXT_PRENOM`) VALUES
(1, 1, 11, 'Cheniour', 'Soumaya'),
(2, 2, 12, 'Verheyde', 'Catherine'),
(3, 3, 13, 'Attias', 'Elie'),
(4, 4, 14, 'Cabinet', 'Selarl'),
(5, 5, 15, 'Pasquet', 'Jean-Pierre'),
(6, 6, 16, 'Viomesnil', 'Vanessa'),
(7, 7, 17, 'Guerrero', 'Jean-Marc'),
(8, 8, 18, 'Neuman', 'Caroline'),
(9, 9, 19, 'Teboul', 'Patrick'),
(10, 10, 20, 'Belhadj', 'Karim'),
(32, 32, 22, 'Jean', 'Roche'),
(33, 33, 23, 'Mélanie', 'Fontaine'),
(34, 34, 24, 'Pierre', 'Marie'),
(35, 35, 25, 'Jacques', 'Simon'),
(36, 36, 26, 'Delo', 'Marie'),
(37, 37, 27, 'Ruit', 'Pauine');

-- --------------------------------------------------------

--
-- Structure de la table `planparcours`
--

CREATE TABLE `planparcours` (
  `ID_PARCOURS` bigint(20) NOT NULL,
  `ID_JOUR` bigint(20) NOT NULL,
  `INT_NB_PATIENT` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='le nombre de patient qui exécutent ce parcours à ce jour';

--
-- Contenu de la table `planparcours`
--

INSERT INTO `planparcours` (`ID_PARCOURS`, `ID_JOUR`, `INT_NB_PATIENT`) VALUES
(1, 1, 1),
(1, 2, 4),
(1, 3, 4),
(1, 4, 4),
(1, 5, 4),
(2, 1, 9),
(2, 2, 2),
(2, 3, 4),
(2, 4, 1),
(2, 5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `ressource`
--

CREATE TABLE `ressource` (
  `ID_RESSOURCE` bigint(11) NOT NULL,
  `ID_TYPERESSOURCE` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ressource`
--

INSERT INTO `ressource` (`ID_RESSOURCE`, `ID_TYPERESSOURCE`) VALUES
(1, 1),
(2, 1),
(37, 1),
(3, 2),
(4, 2),
(32, 2),
(36, 2),
(5, 3),
(6, 3),
(33, 3),
(7, 4),
(8, 4),
(34, 4),
(9, 5),
(10, 5),
(35, 5),
(11, 6),
(12, 6),
(13, 7),
(14, 7),
(15, 8),
(16, 8),
(17, 40),
(18, 40),
(19, 41),
(20, 41),
(31, 42),
(38, 42),
(23, 43),
(24, 43),
(39, 43),
(40, 43),
(25, 44),
(26, 44),
(27, 45),
(28, 45),
(29, 46),
(30, 46);

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `ID_SALLE` bigint(11) NOT NULL,
  `ID_RESSOURCE` bigint(11) NOT NULL,
  `TXT_NOM` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `salle`
--

INSERT INTO `salle` (`ID_SALLE`, `ID_RESSOURCE`, `TXT_NOM`) VALUES
(1, 17, 'Box 1'),
(2, 18, 'Box 2'),
(3, 19, 'Box prélèvement 1'),
(4, 20, 'Box prélèvement 2'),
(5, 23, 'HDJ obésité 1'),
(6, 24, 'HDJ obésité 2'),
(7, 25, 'Bureau CS 1'),
(8, 26, 'Bureau CS 2'),
(9, 27, 'Box soin 1'),
(10, 28, 'Box soin 2'),
(11, 29, 'Salle pansement 1'),
(12, 30, 'Salle pansement 2'),
(13, 31, 'Hors HDJ 1'),
(38, 38, 'Hors HDJ 2'),
(39, 39, 'HDJ obésité 3'),
(40, 40, 'HDJ obésité 4');

-- --------------------------------------------------------

--
-- Structure de la table `typechamp`
--

CREATE TABLE `typechamp` (
  `ID_TYPECHAMP` bigint(11) NOT NULL,
  `TXT_LIBELLE` varchar(255) DEFAULT NULL,
  `TXT_VALEUR` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `typechamp`
--

INSERT INTO `typechamp` (`ID_TYPECHAMP`, `TXT_LIBELLE`, `TXT_VALEUR`) VALUES
(1, 'Texte', '<div class="form-group row champ-dossier">\r\n		              <label for="!!ID!!" class="col-md-2 control-label">!!NOM!!</label>\r\n		              <div class="col-md-10">\r\n		                <input type="text" class="form-control" id="!!ID!!" value="!!VALEUR!!">\r\n		              </div>\r\n		            </div>'),
(2, 'Date', '<div class="form-group row champ-dossier">\r\n		              <label for="!!ID!!" class="col-md-2 control-label">!!NOM!!</label>\r\n		              <div class="col-md-10">\r\n		                <input type="text" class="form-control" id="!!ID!!" value="!!VALEUR!!">\r\n		                <script type="text/javascript">\r\n		                $("body").delegate("#!!ID!!", "focusin", function(){\r\n							   $(this).datepicker();\r\n							});\r\n				        </script>\r\n		              </div>\r\n		            </div>\r\n'),
(3, 'Texte multiligne', '<div class="form-group row champ-dossier">\r\n		              <label for="!!ID!!" class="col-md-2 control-label">!!NOM!!</label>\r\n		              <div class="col-md-10">\r\n		                <textarea class="form-control" rows="3"  id="!!ID!!">!!VALEUR!!</textarea>\r\n		              </div>\r\n		            </div>'),
(4, 'Numérique', '<div class="form-group row champ-dossier">\r\n		              <label for="!!ID!!" class="col-md-2 control-label">!!NOM!!</label>\r\n		              <div class="col-md-10">\r\n		                <input type="number" class="form-control" id="!!ID!!" value="!!VALEUR!!">\r\n		              </div>\r\n		            </div>');

-- --------------------------------------------------------

--
-- Structure de la table `typecompte`
--

CREATE TABLE `typecompte` (
  `ID_TYPECOMPTE` bigint(11) NOT NULL,
  `TXT_NOM` varchar(16) NOT NULL,
  `INT_NIVEAU` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `typecompte`
--

INSERT INTO `typecompte` (`ID_TYPECOMPTE`, `TXT_NOM`, `INT_NIVEAU`) VALUES
(1, 'patient', 1),
(2, 'personnel', 2),
(3, 'coordination', 3),
(4, 'admin', 3);

-- --------------------------------------------------------

--
-- Structure de la table `typeressource`
--

CREATE TABLE `typeressource` (
  `ID_TYPERESSOURCE` bigint(11) NOT NULL,
  `TXT_NOM` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `typeressource`
--

INSERT INTO `typeressource` (`ID_TYPERESSOURCE`, `TXT_NOM`) VALUES
(1, 'IDE obésité'),
(2, 'IDE'),
(3, 'Psychologue'),
(4, 'Diététicien'),
(5, 'nutritioniste'),
(6, 'Interne obésité'),
(7, 'Médecin hépato'),
(8, 'externe'),
(9, 'IDE cardio'),
(10, 'cardiologue'),
(11, 'Orthoptiste'),
(12, 'Diabétologue'),
(13, 'Podologue'),
(14, 'Podologue'),
(15, 'IDE pansement'),
(16, 'médecin'),
(17, 'IDE pompe insuline'),
(18, 'IDE insulinothérapie'),
(19, 'Technicien (IDE)'),
(20, 'IDE sommeil'),
(21, 'aide-soignante'),
(22, 'Médecin du sommeil'),
(23, 'prestataire'),
(24, 'IDE chimio'),
(25, 'Généraliste'),
(40, 'Box'),
(41, 'Box prélèvement'),
(42, 'Hors HDJ'),
(43, 'HDJ obésité'),
(44, 'Bureau CS'),
(45, 'Box soin'),
(46, 'Salle pansement'),
(47, 'Chambre du patient'),
(48, 'Explorations fonctionnelles'),
(49, 'Pièce isolée avec fauteuil'),
(50, 'a'),
(51, 'f'),
(52, 'a'),
(53, 'a'),
(54, 'f');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `activite`
--
ALTER TABLE `activite`
  ADD PRIMARY KEY (`ID_ACTIVITE`);

--
-- Index pour la table `champ`
--
ALTER TABLE `champ`
  ADD PRIMARY KEY (`ID_CHAMP`),
  ADD KEY `I_FK_CHAMP_TYPECHAMP` (`ID_TYPECHAMP`);

--
-- Index pour la table `composer`
--
ALTER TABLE `composer`
  ADD PRIMARY KEY (`ID_PARCOURS`,`ID_ACTIVITE`,`ID_ACTIVITE_PRECEDENTE`),
  ADD KEY `I_FK_COMPOSER_PARCOURS` (`ID_PARCOURS`),
  ADD KEY `I_FK_COMPOSER_ACTIVITE` (`ID_ACTIVITE`),
  ADD KEY `I_FK_COMPOSER_ACTIVITE1` (`ID_ACTIVITE_PRECEDENTE`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`ID_COMPTE`),
  ADD KEY `compte_ibfk_1` (`ID_TYPECOMPTE`);

--
-- Index pour la table `constituerdossier`
--
ALTER TABLE `constituerdossier`
  ADD PRIMARY KEY (`ID_CHAMP`,`ID_DOSSIERPARCOURS`,`ID_ONGLET`),
  ADD KEY `I_FK_CONSTITUERDOSSIER_CHAMP` (`ID_CHAMP`),
  ADD KEY `I_FK_CONSTITUERDOSSIER_DOSSIERPARCOURS` (`ID_DOSSIERPARCOURS`),
  ADD KEY `I_FK_CONSTITUERDOSSIER_ONGLET` (`ID_ONGLET`);

--
-- Index pour la table `dossiergenerique`
--
ALTER TABLE `dossiergenerique`
  ADD PRIMARY KEY (`ID_CHAMP`,`ID_ONGLET`,`ID_PARCOURS`,`ID_ACTIVITE`),
  ADD KEY `I_FK_DOSSIERGENERIQUE_CHAMP` (`ID_CHAMP`),
  ADD KEY `I_FK_DOSSIERGENERIQUE_ONGLET` (`ID_ONGLET`),
  ADD KEY `I_FK_DOSSIERGENERIQUE_PARCOURS` (`ID_PARCOURS`),
  ADD KEY `I_FK_DOSSIERGENERIQUE_ACTIVITE` (`ID_ACTIVITE`);

--
-- Index pour la table `dossierparcours`
--
ALTER TABLE `dossierparcours`
  ADD PRIMARY KEY (`ID_DOSSIERPARCOURS`),
  ADD KEY `I_FK_DOSSIERPARCOURS_PATIENT` (`ID_PATIENT`),
  ADD KEY `I_FK_DOSSIERPARCOURS_PARCOURS` (`ID_PARCOURS`);

--
-- Index pour la table `etreindisponible`
--
ALTER TABLE `etreindisponible`
  ADD PRIMARY KEY (`ID_ETREINDISPONIBLE`),
  ADD KEY `I_FK_ETREINDISPONIBLE_RESSOURCE` (`ID_RESSOURCE`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `ressourceId` (`ressourceId`),
  ADD KEY `patientId` (`patientId`),
  ADD KEY `parcoursId` (`parcoursId`),
  ADD KEY `activiteId` (`activiteId`);

--
-- Index pour la table `jour`
--
ALTER TABLE `jour`
  ADD PRIMARY KEY (`ID_JOUR`);

--
-- Index pour la table `necessiter`
--
ALTER TABLE `necessiter`
  ADD PRIMARY KEY (`ID_ACTIVITE`,`ID_TYPERESSOURCE`),
  ADD KEY `I_FK_NECESSITER_ACTIVITE` (`ID_ACTIVITE`),
  ADD KEY `I_FK_NECESSITER_TYPERESSOURCE` (`ID_TYPERESSOURCE`);

--
-- Index pour la table `onglet`
--
ALTER TABLE `onglet`
  ADD PRIMARY KEY (`ID_ONGLET`);

--
-- Index pour la table `ordonnancer`
--
ALTER TABLE `ordonnancer`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `ressourceId` (`ressourceId`),
  ADD KEY `patientId` (`patientId`),
  ADD KEY `parcoursId` (`parcoursId`),
  ADD KEY `activiteId` (`activiteId`);

--
-- Index pour la table `parcours`
--
ALTER TABLE `parcours`
  ADD PRIMARY KEY (`ID_PARCOURS`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`ID_PATIENT`),
  ADD KEY `I_FK_PATIENT_COMPTE` (`ID_COMPTE`),
  ADD KEY `I_FK_PATIENT_PARCOURS` (`ID_PARCOURS_SUP`);

--
-- Index pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`ID_PERSONNEL`),
  ADD KEY `I_FK_PERSONNEL_RESSOURCE` (`ID_RESSOURCE`),
  ADD KEY `I_FK_PERSONNEL_COMPTE` (`ID_COMPTE`);

--
-- Index pour la table `planparcours`
--
ALTER TABLE `planparcours`
  ADD PRIMARY KEY (`ID_PARCOURS`,`ID_JOUR`),
  ADD KEY `planparcours_ibfk_2` (`ID_JOUR`);

--
-- Index pour la table `ressource`
--
ALTER TABLE `ressource`
  ADD PRIMARY KEY (`ID_RESSOURCE`),
  ADD KEY `I_FK_RESSOURCE_TYPERESSOURCE` (`ID_TYPERESSOURCE`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`ID_SALLE`),
  ADD KEY `I_FK_SALLE_RESSOURCE` (`ID_RESSOURCE`);

--
-- Index pour la table `typechamp`
--
ALTER TABLE `typechamp`
  ADD PRIMARY KEY (`ID_TYPECHAMP`);

--
-- Index pour la table `typecompte`
--
ALTER TABLE `typecompte`
  ADD PRIMARY KEY (`ID_TYPECOMPTE`);

--
-- Index pour la table `typeressource`
--
ALTER TABLE `typeressource`
  ADD PRIMARY KEY (`ID_TYPERESSOURCE`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=452;
--
-- AUTO_INCREMENT pour la table `ordonnancer`
--
ALTER TABLE `ordonnancer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=452;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `champ`
--
ALTER TABLE `champ`
  ADD CONSTRAINT `champ_ibfk_1` FOREIGN KEY (`ID_TYPECHAMP`) REFERENCES `typechamp` (`ID_TYPECHAMP`);

--
-- Contraintes pour la table `composer`
--
ALTER TABLE `composer`
  ADD CONSTRAINT `composer_ibfk_1` FOREIGN KEY (`ID_PARCOURS`) REFERENCES `parcours` (`ID_PARCOURS`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `composer_ibfk_2` FOREIGN KEY (`ID_ACTIVITE`) REFERENCES `activite` (`ID_ACTIVITE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `composer_ibfk_3` FOREIGN KEY (`ID_ACTIVITE_PRECEDENTE`) REFERENCES `activite` (`ID_ACTIVITE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `compte`
--
ALTER TABLE `compte`
  ADD CONSTRAINT `compte_ibfk_1` FOREIGN KEY (`ID_TYPECOMPTE`) REFERENCES `typecompte` (`ID_TYPECOMPTE`);

--
-- Contraintes pour la table `constituerdossier`
--
ALTER TABLE `constituerdossier`
  ADD CONSTRAINT `constituerdossier_ibfk_1` FOREIGN KEY (`ID_CHAMP`) REFERENCES `champ` (`ID_CHAMP`),
  ADD CONSTRAINT `constituerdossier_ibfk_2` FOREIGN KEY (`ID_DOSSIERPARCOURS`) REFERENCES `dossierparcours` (`ID_DOSSIERPARCOURS`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `constituerdossier_ibfk_3` FOREIGN KEY (`ID_ONGLET`) REFERENCES `onglet` (`ID_ONGLET`);

--
-- Contraintes pour la table `dossiergenerique`
--
ALTER TABLE `dossiergenerique`
  ADD CONSTRAINT `dossiergenerique_ibfk_1` FOREIGN KEY (`ID_CHAMP`) REFERENCES `champ` (`ID_CHAMP`),
  ADD CONSTRAINT `dossiergenerique_ibfk_2` FOREIGN KEY (`ID_ONGLET`) REFERENCES `onglet` (`ID_ONGLET`),
  ADD CONSTRAINT `dossiergenerique_ibfk_3` FOREIGN KEY (`ID_PARCOURS`) REFERENCES `parcours` (`ID_PARCOURS`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dossiergenerique_ibfk_4` FOREIGN KEY (`ID_ACTIVITE`) REFERENCES `activite` (`ID_ACTIVITE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `dossierparcours`
--
ALTER TABLE `dossierparcours`
  ADD CONSTRAINT `dossierparcours_ibfk_1` FOREIGN KEY (`ID_PATIENT`) REFERENCES `patient` (`ID_PATIENT`),
  ADD CONSTRAINT `dossierparcours_ibfk_2` FOREIGN KEY (`ID_PARCOURS`) REFERENCES `parcours` (`ID_PARCOURS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etreindisponible`
--
ALTER TABLE `etreindisponible`
  ADD CONSTRAINT `etreindisponible_ibfk_1` FOREIGN KEY (`ID_RESSOURCE`) REFERENCES `ressource` (`ID_RESSOURCE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`ressourceId`) REFERENCES `ressource` (`ID_RESSOURCE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evenement_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patient` (`ID_PATIENT`),
  ADD CONSTRAINT `evenement_ibfk_3` FOREIGN KEY (`parcoursId`) REFERENCES `parcours` (`ID_PARCOURS`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evenement_ibfk_4` FOREIGN KEY (`activiteId`) REFERENCES `activite` (`ID_ACTIVITE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `necessiter`
--
ALTER TABLE `necessiter`
  ADD CONSTRAINT `necessiter_ibfk_1` FOREIGN KEY (`ID_ACTIVITE`) REFERENCES `activite` (`ID_ACTIVITE`),
  ADD CONSTRAINT `necessiter_ibfk_2` FOREIGN KEY (`ID_TYPERESSOURCE`) REFERENCES `typeressource` (`ID_TYPERESSOURCE`);

--
-- Contraintes pour la table `ordonnancer`
--
ALTER TABLE `ordonnancer`
  ADD CONSTRAINT `ordonnancer_ibfk_1` FOREIGN KEY (`ressourceId`) REFERENCES `ressource` (`ID_RESSOURCE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordonnancer_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patient` (`ID_PATIENT`),
  ADD CONSTRAINT `ordonnancer_ibfk_3` FOREIGN KEY (`parcoursId`) REFERENCES `parcours` (`ID_PARCOURS`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordonnancer_ibfk_4` FOREIGN KEY (`activiteId`) REFERENCES `activite` (`ID_ACTIVITE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `personnel_ibfk_1` FOREIGN KEY (`ID_RESSOURCE`) REFERENCES `ressource` (`ID_RESSOURCE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `planparcours`
--
ALTER TABLE `planparcours`
  ADD CONSTRAINT `planparcours_ibfk_1` FOREIGN KEY (`ID_PARCOURS`) REFERENCES `parcours` (`ID_PARCOURS`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `planparcours_ibfk_2` FOREIGN KEY (`ID_JOUR`) REFERENCES `jour` (`ID_JOUR`);

--
-- Contraintes pour la table `salle`
--
ALTER TABLE `salle`
  ADD CONSTRAINT `salle_ibfk_1` FOREIGN KEY (`ID_RESSOURCE`) REFERENCES `ressource` (`ID_RESSOURCE`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
