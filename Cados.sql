-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 02 août 2017 à 22:21
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Cados`
--

-- --------------------------------------------------------

--
-- Structure de la table `Actions`
--

CREATE TABLE `Actions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Actions`
--

INSERT INTO `Actions` (`id`, `name`) VALUES
(2, 'access');

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE `adresse` (
  `id_adresse` smallint(6) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `ville` smallint(6) NOT NULL,
  `pays` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id_adresse`, `rue`, `ville`, `pays`) VALUES
(25, 'Rue du Poirier Fourrier', 21, 14),
(26, '54 rue du poirier fourrier, bat A', 21, 14),
(34, '54 rue du poirier fourrier, bat A', 21, 14),
(35, 'Avenue de stalingrad', 21, 14),
(36, '54 rue du poirier fourrier, bat A', 21, 14),
(37, '25 Rue Charles Lecoq', 21, 14),
(38, '54 rue du poirier fourrier, bat A', 21, 14),
(39, '54 rue du poirier fourrier, bat A', 21, 14),
(40, '54 rue du poirier fourrier, bat A', 21, 14),
(41, '54 rue du poirier fourrier, bat A', 21, 14),
(42, 'rue rue', 21, 14),
(43, '54 rue du poirier fourrier, bat A', 21, 14),
(44, '54 rue du poirier fourrier, bat A', 21, 14),
(45, 'rue camichel', 22, 14),
(46, 'rue camichel', 22, 14),
(47, 'rue camichel', 22, 14);

-- --------------------------------------------------------

--
-- Structure de la table `casier`
--

CREATE TABLE `casier` (
  `id_bouton` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `etat` tinyint(1) NOT NULL,
  `id_utilisateur` smallint(6) NOT NULL,
  `start_location` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `casier`
--

INSERT INTO `casier` (`id_bouton`, `numero`, `etat`, `id_utilisateur`, `start_location`) VALUES
(1, 1, 1, 18, '2017-07-26 19:47:03'),
(2, 2, 0, 0, '2017-07-26 19:47:03'),
(3, 3, 0, 0, '2017-07-26 19:47:03'),
(4, 4, 0, 0, '2017-07-26 19:47:03'),
(5, 5, 0, 0, '2017-07-26 19:47:03'),
(6, 6, 0, 0, '2017-07-26 19:47:03'),
(7, 7, 0, 0, '2017-07-26 19:47:03'),
(8, 8, 0, 0, '2017-07-26 19:47:03'),
(9, 9, 0, 0, '2017-07-26 19:47:03'),
(10, 10, 0, 0, '2017-07-26 19:47:03'),
(11, 11, 0, 0, '2017-07-26 19:47:03'),
(12, 12, 0, 0, '2017-07-26 19:47:03'),
(13, 13, 0, 0, '2017-07-26 19:47:03'),
(14, 14, 0, 0, '2017-07-26 19:47:03'),
(15, 15, 0, 0, '2017-07-26 19:47:03'),
(16, 16, 0, 0, '2017-07-26 19:47:03'),
(17, 17, 0, 0, '2017-07-26 19:47:03'),
(18, 18, 0, 0, '2017-07-26 19:47:03'),
(19, 19, 0, 0, '2017-07-26 19:47:03'),
(20, 20, 0, 0, '2017-07-26 19:47:03'),
(21, 21, 0, 0, '2017-07-26 19:47:03'),
(22, 22, 0, 0, '2017-07-26 19:47:03'),
(23, 23, 0, 0, '2017-07-26 19:47:03'),
(24, 24, 0, 0, '2017-07-26 19:47:03');

-- --------------------------------------------------------

--
-- Structure de la table `ecole`
--

CREATE TABLE `ecole` (
  `id_ecole` smallint(6) NOT NULL,
  `nom` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `id_adresse` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `ecole`
--

INSERT INTO `ecole` (`id_ecole`, `nom`, `id_adresse`) VALUES
(1, 'Lycée Jean Jaurès', 37);

-- --------------------------------------------------------

--
-- Structure de la table `forfait`
--

CREATE TABLE `forfait` (
  `id_forfait` smallint(6) NOT NULL,
  `id_utilisateur` smallint(6) NOT NULL,
  `num_forfait` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Groups`
--

CREATE TABLE `Groups` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Groups`
--

INSERT INTO `Groups` (`id`, `name`) VALUES
(2, 'administrateur'),
(3, 'super administrateur'),
(4, 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `GroupsUsers`
--

CREATE TABLE `GroupsUsers` (
  `id` int(11) NOT NULL,
  `users_id` smallint(6) NOT NULL,
  `groups_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `GroupsUsers`
--

INSERT INTO `GroupsUsers` (`id`, `users_id`, `groups_id`) VALUES
(5, 17, 2),
(1, 18, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Items`
--

CREATE TABLE `Items` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Items`
--

INSERT INTO `Items` (`id`, `name`) VALUES
(1, 'default::index'),
(2, 'rightsManagerMulti::new'),
(3, 'rightsManagerMulti::index'),
(4, 'auth::logout'),
(5, 'utilisateur::delete'),
(6, 'utilisateur::list'),
(7, 'utilisateur::new'),
(8, 'utilisateur::show');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `id_pays` smallint(6) NOT NULL,
  `nom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id_pays`, `nom`) VALUES
(14, 'France'),
(16, 'France'),
(17, 'France'),
(18, 'France'),
(19, 'France'),
(20, 'France'),
(21, 'France'),
(22, 'France'),
(23, 'France'),
(24, 'France'),
(25, 'France'),
(26, 'France'),
(27, 'France'),
(28, 'France'),
(29, 'France'),
(30, 'France'),
(31, 'France'),
(32, 'France'),
(33, 'France'),
(34, 'France'),
(35, 'France'),
(36, 'France');

-- --------------------------------------------------------

--
-- Structure de la table `Permissions`
--

CREATE TABLE `Permissions` (
  `id` int(11) NOT NULL,
  `items_id` int(11) NOT NULL,
  `actions_id` int(11) NOT NULL,
  `groups_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Permissions`
--

INSERT INTO `Permissions` (`id`, `items_id`, `actions_id`, `groups_id`) VALUES
(6, 1, 2, 2),
(7, 3, 2, 2),
(8, 4, 2, 2),
(14, 5, 2, 2),
(16, 6, 2, 2),
(15, 8, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` smallint(6) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `date_de_naissance` date NOT NULL,
  `adresse` smallint(6) DEFAULT NULL,
  `numero` varchar(12) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `pseudo` varchar(20) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `Abonnement` int(11) NOT NULL DEFAULT '0',
  `id_bouton` smallint(6) DEFAULT '0',
  `connecte` tinyint(1) NOT NULL DEFAULT '0',
  `type_user` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `date_de_naissance`, `adresse`, `numero`, `email`, `pseudo`, `password`, `Abonnement`, `id_bouton`, `connecte`, `type_user`) VALUES
(17, 'Harrabi', 'Sofiane', '1994-12-30', NULL, '0102030405', 'sofianeharrabi@gmail.com', 'Toto', '233716a2e584a23f4ab7228d554592dd9c21baac', 0, 0, 0, 0),
(18, 'Admin', 'Admin', '1994-12-30', NULL, NULL, 'cados.development@gmail.com', NULL, '2759f9e2f1e39420305d27b3cc656a1b069b436b', 0, 0, 0, 0),
(19, 'Rohr', 'Anthony', '1994-12-30', NULL, NULL, 'anthony.rohr@rocketmail.com', NULL, '6d940893f70b4b6764c1fc620837d4574f7998be', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `id_ville` smallint(6) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `code_postal` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id_ville`, `nom`, `code_postal`) VALUES
(21, 'Argenteuil', 95100),
(22, 'Toulouse', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Actions`
--
ALTER TABLE `Actions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id_adresse`),
  ADD KEY `ville` (`ville`),
  ADD KEY `pays` (`pays`);

--
-- Index pour la table `casier`
--
ALTER TABLE `casier`
  ADD PRIMARY KEY (`id_bouton`);

--
-- Index pour la table `ecole`
--
ALTER TABLE `ecole`
  ADD PRIMARY KEY (`id_ecole`);

--
-- Index pour la table `forfait`
--
ALTER TABLE `forfait`
  ADD PRIMARY KEY (`id_forfait`);

--
-- Index pour la table `Groups`
--
ALTER TABLE `Groups`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `GroupsUsers`
--
ALTER TABLE `GroupsUsers`
  ADD PRIMARY KEY (`id`,`users_id`,`groups_id`) USING BTREE,
  ADD KEY `utilisateur_fk` (`users_id`),
  ADD KEY `groupes_fk` (`groups_id`);

--
-- Index pour la table `Items`
--
ALTER TABLE `Items`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id_pays`);

--
-- Index pour la table `Permissions`
--
ALTER TABLE `Permissions`
  ADD PRIMARY KEY (`id`,`items_id`,`actions_id`,`groups_id`) USING BTREE,
  ADD KEY `items_fk` (`items_id`),
  ADD KEY `action_fk` (`actions_id`),
  ADD KEY `groupe_fk` (`groups_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD KEY `adresse` (`adresse`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`id_ville`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Actions`
--
ALTER TABLE `Actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id_adresse` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT pour la table `casier`
--
ALTER TABLE `casier`
  MODIFY `id_bouton` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `ecole`
--
ALTER TABLE `ecole`
  MODIFY `id_ecole` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `forfait`
--
ALTER TABLE `forfait`
  MODIFY `id_forfait` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Groups`
--
ALTER TABLE `Groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `GroupsUsers`
--
ALTER TABLE `GroupsUsers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `Items`
--
ALTER TABLE `Items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `id_pays` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT pour la table `Permissions`
--
ALTER TABLE `Permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `id_ville` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`ville`) REFERENCES `ville` (`id_ville`),
  ADD CONSTRAINT `adresse_ibfk_2` FOREIGN KEY (`pays`) REFERENCES `pays` (`id_pays`);

--
-- Contraintes pour la table `GroupsUsers`
--
ALTER TABLE `GroupsUsers`
  ADD CONSTRAINT `groupes_fk` FOREIGN KEY (`groups_id`) REFERENCES `Groups` (`id`),
  ADD CONSTRAINT `utilisateur_fk` FOREIGN KEY (`users_id`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `Permissions`
--
ALTER TABLE `Permissions`
  ADD CONSTRAINT `action_fk` FOREIGN KEY (`actions_id`) REFERENCES `Actions` (`id`),
  ADD CONSTRAINT `groupe_fk` FOREIGN KEY (`groups_id`) REFERENCES `Groups` (`id`),
  ADD CONSTRAINT `items_fk` FOREIGN KEY (`items_id`) REFERENCES `Items` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`adresse`) REFERENCES `adresse` (`id_adresse`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
