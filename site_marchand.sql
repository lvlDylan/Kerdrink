-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2026 at 08:57 PM
-- Server version: 12.2.2-MariaDB
-- PHP Version: 8.5.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `site_marchand`
--

-- --------------------------------------------------------

--
-- Table structure for table `adresse`
--

CREATE TABLE `adresse` (
  `idAdresse` int(11) NOT NULL,
  `rue` varchar(32) NOT NULL,
  `codePostal` smallint(6) NOT NULL,
  `ville` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(11) NOT NULL,
  `libelleCategorie` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `libelleCategorie`) VALUES
(1, 'Bières Blondes'),
(2, 'Bières Blanches'),
(3, 'Bières Brunes'),
(4, 'Bières Ambrées'),
(5, 'Liqueurs de Fruits'),
(6, 'Liqueurs de Plantes'),
(7, 'Spiritueux Spéciaux');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `idClient` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `pseudo` varchar(32) NOT NULL,
  `mdp` varchar(32) NOT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`idClient`, `nom`, `prenom`, `pseudo`, `mdp`, `mail`, `telephone`) VALUES
(5, 'Thomas', 'Mael', 'JaimeMael', '1234', NULL, ''),
(6, 'Belbeoch', 'Nicolas', 'nicolas.sisr', 'abcde', NULL, ''),
(7, 'Mekfhi', 'Adam', 'adam.slam', 'abcde', 'adam.slam@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `noCommande` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `idStatut` char(3) NOT NULL,
  `dateCommande` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contenir`
--

CREATE TABLE `contenir` (
  `noCommande` int(11) NOT NULL,
  `numProduit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `habiter`
--

CREATE TABLE `habiter` (
  `idAdresse` int(11) NOT NULL,
  `idClient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `numProduit` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `nomProduit` varchar(32) NOT NULL,
  `descriptif` varchar(500) NOT NULL,
  `stock` int(11) NOT NULL,
  `prixUnitaire` decimal(8,2) DEFAULT NULL,
  `nomImage` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`numProduit`, `idCategorie`, `nomProduit`, `descriptif`, `stock`, `prixUnitaire`, `nomImage`) VALUES
(1, 2, 'Gwenn Avel', 'Bière blanche légère et rafraîchissante, aux arômes subtils de céréales et d\'agrumes. Sa saveur délicate, légèrement épicée, est accompagnée d\'une légère amertume qui en fait une bière parfaite pour les journées chaudes. Elle titre généralement autour de 5 % d\'alcool.', 50, 4.50, '/bouteilles/gwennavel.png'),
(2, 7, 'Gwenn Mor', 'Une vodka artisanale d\'une pureté exceptionnelle, distillée pour obtenir une texture soyeuse. Elle se distingue par de légères notes salines rappelant les embruns marins, offrant une expérience de dégustation vive et élégante, idéale frappée ou en cocktail.', 40, 32.00, '/bouteilles/gwennmor.png'),
(3, 1, 'Heol Aval', 'Bière blonde rafraîchissante, équilibrée entre douceur maltée et légère amertume. Elle offre des notes de céréales et de houblon, avec une texture légère et pétillante. Idéale pour les moments conviviaux, autour de 5 % d\'alcool.', 60, 4.20, '/bouteilles/heolaval.png'),
(4, 5, 'Ker Tropik', 'Liqueur fruitée à base de fruits tropicaux, offrant une saveur sucrée et exotique. Sa texture douce et son goût intense en font un choix parfait pour des cocktails. Elle titre généralement à 17 % d\'alcool.', 30, 14.90, '/bouteilles/kertropik.png'),
(5, 7, 'Koad Aval', 'Un whisky de caractère affiné avec des notes de pommes sélectionnées. Ce spiritueux offre un équilibre parfait entre la puissance du malt vieilli en fût et la douceur acidulée du fruit. Une boisson authentique et complexe pour les amateurs de saveurs du terroir.', 45, 45.00, '/bouteilles/koadaval.png'),
(6, 3, 'Koad Du', 'Bière brune artisanale aux saveurs riches et profondes. Elle offre un goût malté avec des notes de caramel, de chocolat et de café. Son corps robuste et sa texture crémeuse sont très appréciés. Elle titre généralement autour de 6 à 7 % d\'alcool.', 35, 5.00, '/bouteilles/koaddu.png'),
(7, 6, 'Tan Du', 'Une liqueur de plantes puissante et mystérieuse, élaborée à partir d\'un mélange secret d\'herbes infusées. Elle offre des notes herbacées intenses et une finale légèrement épicée qui réchauffe le palais. Idéale en digestif ou pour apporter une touche de caractère à vos cocktails.', 25, 18.50, '/bouteilles/tandu.png'),
(8, 5, 'Ti Aval', 'Liqueur à la pomme verte, douce et légèrement acidulée. Elle titre généralement autour de 15 % d’alcool et se déguste bien fraîche, pure, sur glace ou en cocktail, pour un moment rafraîchissant.', 20, 12.50, '/bouteilles/tiaval.png');

-- --------------------------------------------------------

--
-- Table structure for table `statut`
--

CREATE TABLE `statut` (
  `idStatut` char(3) NOT NULL,
  `libelleStatut` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statut`
--

INSERT INTO `statut` (`idStatut`, `libelleStatut`) VALUES
('ANN', 'Annulée'),
('ENC', 'En cours'),
('ENV', 'Envoyée'),
('LIV', 'Livrée'),
('PAN', 'Pannier'),
('PAY', 'Payée');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `codeUser` int(11) NOT NULL,
  `login` varchar(15) NOT NULL,
  `mdp` varchar(32) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `role` varchar(3) NOT NULL DEFAULT 'usr'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`codeUser`, `login`, `mdp`, `nom`, `prenom`, `role`) VALUES
(1, 'lav-d', '1234', 'Lavieille', 'Dylan', 'adm'),
(2, 'qui-g', '4321', 'Quiniou', 'Gurvan', 'usr');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`idAdresse`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idClient`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`noCommande`),
  ADD KEY `FK_ETRE` (`idStatut`),
  ADD KEY `FK_PASSER` (`idClient`);

--
-- Indexes for table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`noCommande`,`numProduit`),
  ADD KEY `FK_CONTENIR` (`numProduit`);

--
-- Indexes for table `habiter`
--
ALTER TABLE `habiter`
  ADD PRIMARY KEY (`idAdresse`,`idClient`),
  ADD KEY `FK_HABITER` (`idClient`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`numProduit`),
  ADD KEY `FK_APPARTENIR` (`idCategorie`);

--
-- Indexes for table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`idStatut`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`codeUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `idAdresse` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `noCommande` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `numProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `codeUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_ETRE` FOREIGN KEY (`idStatut`) REFERENCES `statut` (`idStatut`),
  ADD CONSTRAINT `FK_PASSER` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`);

--
-- Constraints for table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `FK_CONTENIR` FOREIGN KEY (`numProduit`) REFERENCES `produit` (`numProduit`),
  ADD CONSTRAINT `FK_CONTENIR2` FOREIGN KEY (`noCommande`) REFERENCES `commande` (`noCommande`);

--
-- Constraints for table `habiter`
--
ALTER TABLE `habiter`
  ADD CONSTRAINT `FK_HABITER` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`),
  ADD CONSTRAINT `FK_HABITER2` FOREIGN KEY (`idAdresse`) REFERENCES `adresse` (`idAdresse`);

--
-- Constraints for table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_APPARTENIR` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
