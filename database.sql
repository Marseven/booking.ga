-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  jeu. 13 fév. 2020 à 11:18
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `booking`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creer` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifier` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `libelle`, `id_user`, `creer`, `modifier`) VALUES
(1, 'Express', 1, '2020-02-13 11:10:40', NULL),
(2, 'Omnibus', 1, '2020-02-13 11:10:40', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creer` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifier` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `classes`
--

INSERT INTO `classes` (`id`, `libelle`, `id_user`, `creer`, `modifier`) VALUES
(1, 'VIP', 1, '2020-02-13 11:12:17', NULL),
(2, 'Classe 1', 1, '2020-02-13 11:12:17', NULL),
(3, 'Classe 2', 1, '2020-02-13 11:12:17', NULL);

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
-- Structure de la table `paiements`
--

CREATE TABLE `paiements` (
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

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `GoDate` date DEFAULT NULL,
  `BackDate` date DEFAULT NULL,
  `FromPlace` int(11) DEFAULT NULL,
  `ToPlace` int(11) DEFAULT NULL,
  `NombrePlace` int(11) NOT NULL,
  `Tarif` double DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Payment` varchar(50) DEFAULT NULL,
  `id_train` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ExpireDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `semaines`
--

CREATE TABLE `semaines` (
  `id` int(11) NOT NULL,
  `jour` varchar(100) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_ville` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creer` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifier` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `semaines`
--

INSERT INTO `semaines` (`id`, `jour`, `id_categorie`, `id_ville`, `id_user`, `creer`, `modifier`) VALUES
(1, 'Lundi', 1, 1, 1, '2020-02-13 11:29:55', NULL),
(2, 'Lundi', 2, 2, 1, '2020-02-13 11:29:55', NULL),
(3, 'Mardi', 2, 1, 1, '2020-02-13 11:29:55', NULL),
(4, 'Mardi', 1, 2, 1, '2020-02-13 11:29:55', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tarifs`
--

CREATE TABLE `tarifs` (
  `id` int(11) NOT NULL,
  `depart` int(11) NOT NULL,
  `arrive` int(11) NOT NULL,
  `classe` int(11) NOT NULL,
  `categorie` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `creer` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifier` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Structure de la table `trains`
--

CREATE TABLE `trains` (
  `id` int(11) NOT NULL,
  `Title` varchar(150) DEFAULT NULL,
  `NombrePlace` int(11) DEFAULT NULL,
  `NombreVagon` int(11) NOT NULL,
  `Nombre_reel` int(11) DEFAULT NULL,
  `Timage1` varchar(255) DEFAULT NULL,
  `Timage2` varchar(255) DEFAULT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_semaine` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Richard', 'Mebodo', 'mebodoaristide@yahoo.fr', '$2y$10$t1jVt.HiXEjoC2z9iH5zKu0p4yiLQ5XRgQiZwgMNyKNF7DEJOpjgW', '074228306', '1996-08-19', NULL, NULL, NULL, NULL, NULL, 'admin', '2020-02-11 17:06:44', '2020-02-11 17:10:49', NULL, NULL, '2020-02-11 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

CREATE TABLE `villes` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creer` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifier` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `villes`
--

INSERT INTO `villes` (`id`, `libelle`, `province`, `id_user`, `creer`, `modifier`) VALUES
(1, 'Owendo', 'Estuaire', 1, '2020-02-13 11:36:16', NULL),
(2, 'Franceville', 'Haut-Ogoué', 1, '2020-02-13 11:36:16', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `semaines`
--
ALTER TABLE `semaines`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tarifs`
--
ALTER TABLE `tarifs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `temoignages`
--
ALTER TABLE `temoignages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `trains`
--
ALTER TABLE `trains`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `villes`
--
ALTER TABLE `villes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `semaines`
--
ALTER TABLE `semaines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tarifs`
--
ALTER TABLE `tarifs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `temoignages`
--
ALTER TABLE `temoignages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `trains`
--
ALTER TABLE `trains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `villes`
--
ALTER TABLE `villes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
