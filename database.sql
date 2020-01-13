-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  lun. 13 jan. 2020 à 14:50
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `booking`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ebilling`
--

CREATE TABLE `ebilling` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount_order` float NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `external_reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paymentsystem` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `etat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billingid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transactionid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ebilling`
--

INSERT INTO `ebilling` (`id`, `email`, `phone`, `amount_order`, `description`, `date`, `external_reference`, `first_name`, `last_name`, `address`, `city`, `paymentsystem`, `amount`, `etat`, `billingid`, `transactionid`) VALUES
(4, 'richard.mebodo@jobs-conseil.com', '04228306', 142000, 'Réservation chez Les Transports Citadins', '2018-04-30 13:04:20', 'taK8f5', 'Mebodo', 'Richard', 'Angondjé', 'Akanda', NULL, NULL, 'En Cours', NULL, NULL),
(5, 'mebodoaristide@yahoo.fr', '02020011', 240000, 'Réservation chez Les Transports Citadins', '2018-06-06 08:06:51', 'wmnqmF', 'Mebodo', 'Aristide', 'I.A.I', 'Libreville', NULL, NULL, 'En Cours', NULL, NULL),
(6, 'mebodoaristide@gmail.com', '04228306', 250000, 'Réservation chez Les Transports Citadins', '2018-06-06 08:06:52', 'icZUpt', 'Richard', 'Mebodo', 'Angondjé', 'Akanda', NULL, NULL, 'En Cours', NULL, NULL),
(7, 'mebodoaristide@gmail.com', '04228306', 250000, 'Réservation chez Les Transports Citadins', '2018-06-06 09:06:11', 'flTR0h', 'Richard', 'Mebodo', 'Angondjé', 'Akanda', NULL, NULL, 'En Cours', NULL, NULL),
(8, 'mebodoaristide@gmail.com', '04228306', 250000, 'Réservation chez Les Transports Citadins', '2018-06-06 09:06:05', 'CgDPXS', 'Richard', 'Mebodo', 'Angondjé', 'Akanda', NULL, NULL, 'En Cours', NULL, NULL),
(9, 'mebodoaristide@gmail.com', '04228306', 250000, 'Réservation chez Les Transports Citadins', '2018-06-06 09:06:18', 'Tb6Jqd', 'Richard', 'Mebodo', 'Angondjé', 'Akanda', NULL, NULL, 'En Cours', NULL, NULL),
(10, 'mebodoaristide@gmail.com', '04228306', 250000, 'Réservation chez Les Transports Citadins', '2018-06-06 09:06:00', 'UyK8Au', 'Richard', 'Mebodo', 'Angondjé', 'Akanda', NULL, NULL, 'En Cours', NULL, NULL),
(11, 'mebodoaristide@gmail.com', '02020011', 142000, 'Réservation chez Les Transports Citadins', '2018-06-07 15:06:47', '2DS9uF', 'Mebodo', 'Aristide', 'I.A.I', 'Libreville', NULL, NULL, 'En Cours', NULL, NULL),
(12, 'mebodoaristide@gmail.com', '02020011', 32000, 'Réservation chez Les Transports Citadins', '2018-06-07 15:06:02', 'SEmA52', 'Mebodo', 'Aristide', 'I.A.I', 'Libreville', NULL, NULL, 'En Cours', NULL, NULL),
(13, 'mebodoaristide@gmail.com', '02020011', 142000, 'Réservation chez Les Transports Citadins', '2018-06-07 15:06:50', 'c88eeO', 'Mebodo', 'Aristide', 'I.A.I', 'Libreville', NULL, NULL, 'En Cours', NULL, NULL),
(14, 'mebodoaristide@gmail.com', '04228306', 142000, 'Réservation chez Les Transports Citadins', '2018-06-07 15:06:56', 'QqiDPH', 'Richard', 'Mebodo', 'Angondjé', 'Akanda', 'Airtel Money', 142000, 'Payée', '5502586398', 'AM00125'),
(15, 'mebodoaristide@gmail.com', '04228306', 71000, 'Réservation chez Les Transports Citadins', '2018-06-08 14:06:29', '2WT045', 'Richard', 'Mebodo', 'Angondjé', 'Akanda', 'airtelmoney', 71000, 'Payée', '5550025995', 'AM00185'),
(16, 'richard.mebodo@jobs-conseil.com', '04228306', 250000, 'Réservation chez Les Transports Citadins', '2018-06-22 10:06:40', 'kqMvca', 'Mebodo', 'Richard', 'Montagne-sanite', 'Libreville', 'airtelmoney', 250000, 'Payée', '5550026118', 'AM00170');

-- --------------------------------------------------------

--
-- Structure de la table `marques`
--

CREATE TABLE `marques` (
  `id` int(11) NOT NULL,
  `BrandName` varchar(120) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `marques`
--

INSERT INTO `marques` (`id`, `BrandName`, `CreationDate`, `UpdationDate`) VALUES
(14, 'Toyota', '2018-04-20 09:31:04', NULL),
(15, 'Renault', '2018-04-20 09:31:17', NULL),
(16, 'Nissan', '2018-04-20 09:32:02', NULL),
(17, 'Ssangyong', '2018-04-20 09:32:28', NULL),
(18, 'Hyundai', '2018-04-20 09:33:35', NULL),
(19, 'Mitsubishi', '2018-04-20 09:33:50', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL,
  `SubscriberEmail` varchar(120) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `userEmail` int(11) DEFAULT NULL,
  `VehicleId` int(11) DEFAULT NULL,
  `FromDate` varchar(20) DEFAULT NULL,
  `ToDate` varchar(20) DEFAULT NULL,
  `FromPlace` varchar(50) DEFAULT NULL,
  `ToPlace` varchar(50) DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Realiser` int(11) NOT NULL DEFAULT '0',
  `Payment` varchar(50) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `reference`, `userEmail`, `VehicleId`, `FromDate`, `ToDate`, `FromPlace`, `ToPlace`, `Price`, `Status`, `Realiser`, `Payment`, `PostingDate`) VALUES
(20, 'pruzuz', 55, 15, '2018-05-01T15:00', '2018-05-02T15:00', 'Hôtel Le Méridien RE-NDAMA', 'Hotel Le Cristal', 32000, 'Payé', 1, 'Arriver', '2018-04-30 13:35:45'),
(21, 'taK8f5', 55, 13, '2018-05-04T15:00', '2018-05-05T15:00', 'Hôtel Le Méridien RE-NDAMA', 'Hôtel Le Cristal', 142000, 'Confirmé', 1, 'Ebilling', '2018-04-30 13:49:08'),
(22, 'wgGWlH', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'En attente de paiement', 0, 'Arriver', '2018-05-08 17:35:45'),
(23, 'of0dug', 55, 13, '2018-05-16 19:18:23', '2018-05-17 19:18:27', 'test', 'test', 142000, 'Payé', 1, 'Arriver', '2018-05-08 18:19:28'),
(24, 'wmnqmF', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Payé', 0, 'Ebilling', '2018-06-06 08:46:59'),
(25, 'UyK8Au', 54, 8, '2018-06-14 10:08:00', '2018-06-15 10:08:00', 'Hôtel Le Méridien RE-NDAMA', 'Hôtel Le Cristal', 250000, 'Payé', 1, NULL, '2018-06-06 09:14:01'),
(26, '2DS9uF', 54, 13, '2018-06-14 17:32:48', '2018-06-15 17:33:10', 'Hôtel Le Méridien RE-NDAMA', 'Hôtel Le Méridien RE-NDAMA', 142000, 'Payée', 1, 'Ebilling', '2018-06-07 15:33:47'),
(27, 'SEmA52', 54, 15, '2018-06-14 17:40:20', '2018-06-15 17:40:27', 'Hôtel Le Méridien RE-NDAMA', 'Hôtel Le Méridien RE-NDAMA', 32000, 'Payée', 1, 'Ebilling', '2018-06-07 15:41:02'),
(28, 'c88eeO', 54, 12, '2018-06-14 17:45:00', '2018-06-15 17:45:05', 'Hôtel Le Méridien RE-NDAMA', 'Hôtel Le Méridien RE-NDAMA', 142000, 'Payée', 1, 'Ebilling', '2018-06-07 15:49:50'),
(29, 'QqiDPH', 54, 16, '2018-06-27 17:55:05', '2018-06-28 17:55:10', 'Hôtel Le Méridien RE-NDAMA', 'Hôtel Le Méridien RE-NDAMA', 142000, 'Payée', 1, 'Ebilling', '2018-06-07 15:55:56'),
(30, '2WT045', 54, 14, '2018-06-12 16:06:53', '2018-06-13 16:07:09', 'Hôtel Le Méridien RE-NDAMA', 'Hôtel Le Méridien RE-NDAMA', 71000, 'Payée', 1, 'Ebilling', '2018-06-08 14:08:29'),
(31, 'kqMvca', 55, 8, '2018-06-23 12:25:31', '2018-06-24 12:25:36', 'Hôtel Le Méridien RE-NDAMA', 'Hôtel Le Méridien RE-NDAMA', 250000, 'Payée', 0, 'Ebilling', '2018-06-22 10:28:40');

-- --------------------------------------------------------

--
-- Structure de la table `temoignages`
--

CREATE TABLE `temoignages` (
  `id` int(11) NOT NULL,
  `UserEmail` int(11) NOT NULL,
  `Testimonial` mediumtext NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `temoignages`
--

INSERT INTO `temoignages` (`id`, `UserEmail`, `Testimonial`, `PostingDate`, `status`) VALUES
(1, 55, 'La meilleure expérience de location de voiture que j\'ai eu.', '2018-04-30 13:03:06', 1),
(2, 55, 'j\'ai soif\r\n', '2018-06-22 10:15:37', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(120) DEFAULT NULL,
  `LastName` varchar(120) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL,
  `BornDate` date DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `ZipCode` varchar(50) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Province` varchar(50) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT 'membre',
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `confirmed_token` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `FirstName`, `LastName`, `Email`, `Password`, `ContactNo`, `BornDate`, `Address`, `ZipCode`, `City`, `Province`, `Country`, `role`, `RegDate`, `UpdationDate`, `confirmed_token`, `reset_token`, `confirmed_at`, `reset_at`) VALUES
(54, 'Richard', 'Mebodo', 'mebodoaristide@gmail.com', '$2y$10$qY1GsMMiTeFXKXku.Ndcve6.fqYHDtipiJvwzmuWL7jNYUapWFK1G', '04228306', '1996-08-19', 'Angondjé', '318', 'Akanda', 'Estuaire', 'Gabon', 'admin', '2018-04-19 15:46:37', '2018-06-07 15:55:56', NULL, 'd41d8cd98f00b204e9800998ecf8427e', '2018-04-20 00:00:00', '2018-05-03 14:05:59'),
(55, 'Mebodo', 'Richard', 'richard.mebodo@jobs-conseil.com', '$2y$10$qY1GsMMiTeFXKXku.Ndcve6.fqYHDtipiJvwzmuWL7jNYUapWFK1G', '04228306', '1985-08-18', 'Montagne-sanite', '318', 'Libreville', 'Estuaire', 'Cameroun', 'membre', '2018-04-19 15:46:37', '2018-06-22 10:28:40', NULL, 'd41d8cd98f00b204e9800998ecf8427e', '2018-04-20 00:00:00', '2018-05-03 13:05:11'),
(56, 'Mebodo', 'Aristide', 'mebodoaristide@yahoo.fr', NULL, NULL, '1996-08-18', 'I.A.I', '2263', 'Libreville', 'Estuaire', 'Gabon', 'membre', '2018-06-06 08:44:51', '2019-05-27 16:40:24', NULL, NULL, NULL, '2019-05-27 16:05:24');

-- --------------------------------------------------------

--
-- Structure de la table `vehicules`
--

CREATE TABLE `vehicules` (
  `id` int(11) NOT NULL,
  `VehiclesTitle` varchar(150) DEFAULT NULL,
  `VehiclesBrand` int(11) DEFAULT NULL,
  `VehiclesOverview` longtext,
  `PricePerHour` int(11) DEFAULT '0',
  `PricePerDay` int(11) DEFAULT '0',
  `FuelType` varchar(100) DEFAULT NULL,
  `Type` varchar(100) DEFAULT NULL,
  `SeatingCapacity` int(11) DEFAULT NULL,
  `Transmission` int(11) DEFAULT '1',
  `Puissance` int(11) NOT NULL,
  `Nombre` int(11) NOT NULL DEFAULT '1',
  `Nombre_reel` int(11) DEFAULT NULL,
  `Vimage1` varchar(120) DEFAULT NULL,
  `Vimage2` varchar(120) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vehicules`
--

INSERT INTO `vehicules` (`id`, `VehiclesTitle`, `VehiclesBrand`, `VehiclesOverview`, `PricePerHour`, `PricePerDay`, `FuelType`, `Type`, `SeatingCapacity`, `Transmission`, `Puissance`, `Nombre`, `Nombre_reel`, `Vimage1`, `Vimage2`, `RegDate`, `UpdationDate`) VALUES
(8, 'Coaster', 14, 'Spacieux et confortable, adapté pour le transport de masse', NULL, 250000, 'Diesel', 'Bus', 30, 0, 17, 1, 0, 'Bus COASTER Avant.jpg', 'Bus COASTER Coté.jpg', '2018-04-30 11:43:38', '2018-06-22 10:30:39'),
(9, 'Hiace', 14, 'Climatisé et confortable, il est idéal pour le transport du personnel, les sorties en groupe ou en famille', NULL, 155000, 'Diesel', 'Mini Bus', 16, 0, 11, 1, 1, 'Bus Hiace Face.jpg', 'Bus Hiace Latéral.jpg', '2018-04-30 12:13:15', NULL),
(10, 'Pajero', 19, 'Mitsubishi	Pajero	4X4 luxe	Automatique	9	6 à 7	Essence	Allier luxe et robustesse avec ce véhicule qui satisfait tous vos caprices en termes de confort et accessibilité. Le Pajero DI-D est un 4x4 de Luxe efficace en tout terrain, sécurisant et confortable sur la route. Il accepte les coups de volant brutaux, les freinages en courbe sans mesure de représailles.', 12000, 180000, 'Essence', '4x4 Luxe', 7, 1, 9, 1, 1, 'Mitsubishi Pajero Face.jpg', 'Mitsubishi Pajero Intérieur 1.jpg', '2018-04-30 12:20:05', '2018-05-07 16:13:46'),
(12, 'Teana', 16, 'Siège en cuir, fond boisé, la Teana n\'a rien a envier aux autres véhicules de sa catégorie. Elle allie beauté, confort et luxe.', 12000, 142000, 'Essence', 'Berline Luxe', 5, 1, 6, 1, 1, 'Nissan Teana.jpg', 'Nissan Teana Intérieur.jpg', '2018-04-30 12:23:43', '2018-06-07 16:03:27'),
(13, 'Prado TX', 14, 'Le Prado TX est un 4x4 polyvalent exceptionnel, il offre une élégance incomparable et un comportement exemplaire sur les terrains les plus difficiles. Son comportement de conduite d’une incroyable souplesse et son énorme potentiel sur terrain accidenté font du Toyota Prado TX un véhicule complet , idéal pour les excursions.', 10000, 142000, 'Diesel', '4x4 Standard', 10, 0, 11, 1, 1, 'Toyota Prado TX.jpg', 'Toyota Prado TX Intérieur.jpg', '2018-04-30 12:26:16', '2018-06-07 16:03:29'),
(14, 'Duster GD Luxe', 15, 'Voiture de ville, Le Renault Duster est 4x2 efficace et discret.', 6000, 71000, 'Essence', '4x4 Mini', 5, 0, 9, 1, 1, 'Renault Duster.jpg', 'Renault Duster Intérieur.jpg', '2018-04-30 12:30:58', '2018-07-12 14:34:17'),
(15, 'Logan Authentique', 15, 'Renault Logan Authentique vous entoure de ce qui se fait de mieux, inspire la tranquillité d’esprit et vous offre un espace inégalé pour les jambes, notamment pour les passagers installés à l’arrière du véhicule.', 5000, 32000, 'Essence', 'Berline Stardard', 5, 0, 8, 1, 1, 'Renault Logan.jpg', 'Renault Logan Intérieur 2.jpg', '2018-04-30 12:33:16', '2018-06-07 16:03:28'),
(16, 'Hilux', 14, 'Belle alliance entre la robustesse et le confort, le Toyota Hilux est un 4x4 idéal pour une immersion totale dans le Gabon profond.', 10000, 142000, 'Diesel', '4x4 Standard', 6, 0, 12, 1, 1, 'Toyota Hilux.jpg', 'Toyota Hilux Intérieur 1.jpg', '2018-04-30 12:34:59', '2018-06-07 16:03:31'),
(17, 'Sonata', 18, 'Intérieur cuir, la Sonata vous offre tout le confort et le luxe d\'une berline haut de gamme.', 12000, 142000, 'Essence', 'Berline Luxe', 5, 0, 0, 1, 1, 'Sonata.jpg', 'Sonata.jpg', '2018-04-30 12:36:37', '2018-05-10 10:55:13');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ebilling`
--
ALTER TABLE `ebilling`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `marques`
--
ALTER TABLE `marques`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `temoignages`
--
ALTER TABLE `temoignages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vehicules`
--
ALTER TABLE `vehicules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ebilling`
--
ALTER TABLE `ebilling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `marques`
--
ALTER TABLE `marques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `temoignages`
--
ALTER TABLE `temoignages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `vehicules`
--
ALTER TABLE `vehicules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
