-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  Dim 10 fév. 2019 à 20:43
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `car-rental`
--

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `id_voiture` int(11) NOT NULL,
  `id_conducteur` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL,
  `ville` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut_location` datetime NOT NULL,
  `date_fin_location` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `location`
--

INSERT INTO `location` (`id`, `id_voiture`, `id_conducteur`, `id_employee`, `ville`, `date_debut_location`, `date_fin_location`) VALUES
(1, 2, 2, 3, 'Mâcon', '2019-02-01 00:00:00', '2019-02-06 00:00:00'),
(2, 3, 1, 2, 'Montréal', '2019-02-02 00:00:00', '2019-02-06 00:00:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
