-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 12, 2019 at 06:18 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `car-rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `locacar_admin`
--

CREATE TABLE `locacar_admin` (
  `id` int(11) NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_employee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locacar_admin`
--

INSERT INTO `locacar_admin` (`id`, `email`, `password`, `id_employee`) VALUES
(3, 'sonia@locacars.com', '$2y$10$WU/l8ex3TLz3FskDo6KKU.31zjL1omnprORedZEmY8IpMIOCTtjiO', 4);

-- --------------------------------------------------------

--
-- Table structure for table `locacar_conducteur`
--

CREATE TABLE `locacar_conducteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `codepostal` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locacar_conducteur`
--

INSERT INTO `locacar_conducteur` (`id`, `nom`, `prenom`, `age`, `codepostal`, `ville`, `pays`) VALUES
(1, 'Chapeau', 'Caroline', 27, '71000', 'Mâcon', 'France'),
(2, 'Yonce', 'Haikouhi', 30, '69009', 'Lyon', 'France'),
(3, 'Barthan', 'Charles', 42, '75010', 'Paris', 'France'),
(4, 'Place', 'Jean', 67, '75001', 'Paris', 'France'),
(5, 'Perrier', 'Sonia', 21, '13400', 'Aubagne', 'France'),
(6, 'Martin', 'Vincent', 53, '13010', 'Marseille', 'France'),
(7, 'Guerin', 'Thomas', 31, '69007', 'Lyon', 'France'),
(8, 'Bourchy', 'Gwladys', 25, '42000', 'Saint Etienne', 'France'),
(9, 'Courdet', 'Nicolas', 41, '89000', 'Sens', 'France'),
(10, 'Garnier', 'Vail', 44, 'H1W3V9', 'Montréal', 'Canada'),
(11, 'Leblanc', 'Paige', 28, 'H2M1T1', 'Montréal', 'Canada'),
(12, 'Francoeur', 'Michel', 67, 'G1C 0A5', 'Quebec', 'Canada'),
(13, 'McEntire', 'John', 34, 'V5M2T2', 'Vancouver', 'Canada'),
(14, 'Green', 'Lewis', 24, 'V6P2R9', 'Vancouver', 'Canada'),
(15, 'Baldwin', 'Luis', 41, 'M6E3A3', 'Toronto', 'Canada'),
(16, 'Ward', 'David', 39, 'M4C5E4', 'Toronto', 'Canada');

-- --------------------------------------------------------

--
-- Table structure for table `locacar_employee`
--

CREATE TABLE `locacar_employee` (
  `id` int(11) NOT NULL,
  `nom` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emploi` enum('Manager','Responsable','Stagiaire','Conseiller(e)') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_store` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locacar_employee`
--

INSERT INTO `locacar_employee` (`id`, `nom`, `prenom`, `emploi`, `id_store`) VALUES
(1, 'Delamaison', 'Thomas', 'Responsable', 1),
(2, 'Poulain', 'Gabrielle', 'Conseiller(e)', 4),
(3, 'Grandin', 'Joseph', 'Stagiaire', 1),
(4, 'Savard', 'Sonia', 'Responsable', 4),
(5, 'Demers', 'Estelle', 'Conseiller(e)', 3),
(6, 'Piedalu', 'Raymond', 'Responsable', 3),
(7, 'Chapin', 'Diane', 'Conseiller(e)', 3),
(8, 'LeBatelier', 'Marvin', 'Responsable', 2),
(9, 'Laforest', 'Henri', 'Conseiller(e)', 2),
(10, 'Beauchemin', 'Fanny', 'Conseiller(e)', 2),
(11, 'Fournier', 'Lynette', 'Stagiaire', 2),
(12, 'Powell', 'Bruce', 'Responsable', 5),
(13, 'Ayers', 'Jessica', 'Conseiller(e)', 5),
(14, 'Gordon', 'Teresa', 'Conseiller(e)', 5),
(15, 'Hickman', 'Gloria', 'Responsable', 6),
(16, 'Olson', 'Jeff', 'Conseiller(e)', 6),
(17, 'Michael', 'Douglas', 'Conseiller(e)', 6),
(18, 'Clark', 'Jocelyn', 'Conseiller(e)', 5);

-- --------------------------------------------------------

--
-- Table structure for table `locacar_location`
--

CREATE TABLE `locacar_location` (
  `id` int(11) NOT NULL,
  `id_voiture` int(11) NOT NULL,
  `id_conducteur` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL,
  `ville` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut_location` datetime NOT NULL,
  `date_fin_location` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locacar_location`
--

INSERT INTO `locacar_location` (`id`, `id_voiture`, `id_conducteur`, `id_employee`, `ville`, `date_debut_location`, `date_fin_location`) VALUES
(1, 1, 1, 1, 'Lyon', '2019-03-28 00:00:00', '2019-03-31 00:00:00'),
(2, 9, 13, 15, 'Toronto', '2019-05-22 00:00:00', '2019-05-26 00:00:00'),
(3, 6, 2, 3, 'Lyon', '2019-04-02 00:00:00', '2019-04-09 00:00:00'),
(4, 11, 15, 14, 'Vancouver', '2019-08-26 00:00:00', '2019-09-01 00:00:00'),
(5, 7, 9, 6, 'Paris', '2019-07-01 00:00:00', '2019-07-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `locacar_store`
--

CREATE TABLE `locacar_store` (
  `id` int(11) NOT NULL,
  `ville` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locacar_store`
--

INSERT INTO `locacar_store` (`id`, `ville`, `pays`) VALUES
(1, 'Lyon', 'France'),
(2, 'Montréal', 'Canada'),
(3, 'Paris', 'France'),
(4, 'Marseille', 'France'),
(5, 'Vancouver', 'Canada'),
(6, 'Toronto', 'Canada');

-- --------------------------------------------------------

--
-- Table structure for table `locacar_voiture`
--

CREATE TABLE `locacar_voiture` (
  `id` int(11) NOT NULL,
  `marque` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modele` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee_mise_location` datetime NOT NULL,
  `plaque_immat` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `couleur` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locacar_voiture`
--

INSERT INTO `locacar_voiture` (`id`, `marque`, `modele`, `annee_mise_location`, `plaque_immat`, `couleur`) VALUES
(1, 'Renault', 'Twingo', '2018-03-19 00:00:00', 'AV698EK', 'Vert'),
(2, 'Fiat', 'Tipo', '2019-01-01 00:00:00', 'EK215FW', 'Rouge'),
(3, 'Volvo', 'D40', '2018-05-01 00:00:00', 'KQ597JU', 'Gris'),
(4, 'Citroen', 'C4', '2018-02-19 00:00:00', 'KO123OK', 'Bleu'),
(5, 'Nissan', 'Qashqai', '2018-10-08 00:00:00', 'AW789WA', 'Blanc'),
(6, 'Mini', 'Countryman', '2018-03-01 00:00:00', 'PM741QA', 'Noir'),
(7, 'Volkswagen', 'Polo', '2018-02-02 00:00:00', 'OP963ZA', 'Noir'),
(8, 'Ford', 'Escape', '2018-06-12 00:00:00', 'J63NHY', 'Noir'),
(9, 'Ford', 'Focus', '2018-08-20 00:00:00', 'N74NAY', 'Rouge'),
(10, 'Toyota', 'Camry', '2019-01-14 00:00:00', 'B41NWA', 'Bleu'),
(11, 'Toyota', 'RAV4', '2018-09-03 00:00:00', 'J70CYQ', 'Gris'),
(12, 'Nissan', 'Sentra', '2019-01-01 00:00:00', 'UBV267', 'Rouge'),
(13, 'Nissan', 'Rogue', '2018-10-01 00:00:00', '918LHT', 'Bleu'),
(14, 'Nissan', 'Murano', '2018-08-01 00:00:00', '506MFH', 'Gris'),
(15, 'Nissan', 'Micra', '2018-05-01 00:00:00', '857LRP', 'Vert'),
(16, 'Ford', 'Taurus', '2018-10-01 00:00:00', '731ZXD', 'Blanc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locacar_admin`
--
ALTER TABLE `locacar_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locacar_conducteur`
--
ALTER TABLE `locacar_conducteur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locacar_employee`
--
ALTER TABLE `locacar_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locacar_location`
--
ALTER TABLE `locacar_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locacar_store`
--
ALTER TABLE `locacar_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locacar_voiture`
--
ALTER TABLE `locacar_voiture`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locacar_admin`
--
ALTER TABLE `locacar_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `locacar_conducteur`
--
ALTER TABLE `locacar_conducteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `locacar_employee`
--
ALTER TABLE `locacar_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `locacar_location`
--
ALTER TABLE `locacar_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `locacar_store`
--
ALTER TABLE `locacar_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `locacar_voiture`
--
ALTER TABLE `locacar_voiture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
