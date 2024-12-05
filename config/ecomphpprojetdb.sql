-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 05 déc. 2024 à 15:28
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecomphpprojetdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE `adresse` (
  `id_adresse` int(11) NOT NULL,
  `rue` varchar(100) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `code_postal` varchar(10) NOT NULL,
  `pays` varchar(50) DEFAULT 'Canada',
  `numero` varchar(10) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id_adresse`, `rue`, `ville`, `code_postal`, `pays`, `numero`, `province`) VALUES
(1, 'Trinitaire', 'Montreal', 'HE4 2R8', 'Canada', '100', 'Quebec'),
(2, 'Trinitaire', 'Montreal', 'HE4 2R8', 'Canada', '100', 'Quebec'),
(3, 'Trinitaire', 'Montreal', 'HE4 2R8', 'Canada', '100', 'Quebec'),
(4, 'Trinitaire', 'Dakar', 'H4E2R8', 'Canada', '100', 'Québec'),
(5, 'Trinitaire', 'Dakar', 'H4E2R8', 'Canada', '100', 'Québec'),
(6, 'Trinitaire', 'Dakar', 'H4E2R8', 'Canada', '100', 'Québec'),
(7, 'Trinitaire', 'Dakar', 'H4E2R8', 'Canada', '100', 'Québec'),
(8, 'Trinitaire', 'Dakar', 'H4E2R8', 'Canada', '101', 'Québec'),
(9, 'Maurice duplesis', 'Montreal', 'H2K22', 'Montreal', '6066', 'Quebc'),
(10, 'Mermoz', 'Dakar', 'KJ09V', 'Senegal', '20', '-'),
(11, 'Durocher', 'Manhattan', 'HHRY3', 'U.S.A', '20', 'NewYork'),
(12, 'Durocher', 'Manhattan', 'HHRY3', 'U.S.A', '20', 'NewYork');

-- --------------------------------------------------------

--
-- Structure de la table `adresse_utilisateur`
--

CREATE TABLE `adresse_utilisateur` (
  `id_adresse` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adresse_utilisateur`
--

INSERT INTO `adresse_utilisateur` (`id_adresse`, `id_utilisateur`) VALUES
(1, 33),
(10, 134),
(11, 135),
(12, 135);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(10) NOT NULL,
  `nom_categorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom_categorie`) VALUES
(1, 'Corporelle'),
(2, 'Capillaire');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `date_commande` datetime NOT NULL,
  `quantite_commande` int(11) NOT NULL,
  `prix_total` varchar(10) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `livree` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `date_commande`, `quantite_commande`, `prix_total`, `id_utilisateur`, `livree`) VALUES
(29, '2024-11-28 15:50:15', 2, '44', 33, 1),
(30, '2024-11-29 17:57:20', 1, '250', 33, 1),
(31, '2024-11-30 14:30:18', 1, '100', 33, 1),
(35, '2024-12-05 14:24:48', 1, '38', 33, 0);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id_image` int(11) NOT NULL,
  `chemin` text DEFAULT NULL,
  `id_produit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id_image`, `chemin`, `id_produit`) VALUES
(64, 'images-produit/champoimg-mani.jpg', 83),
(65, 'images-produit/creme-de-coco.avif', 84),
(66, 'images-produit/creme-de-peau.avif', 85),
(67, 'images-produit/gamme-cheveux.avif', 86),
(68, 'images-produit/gamme-de-corps-complet.jpg', 87),
(69, 'images-produit/lait-de-corpa-avif.avif', 88),
(70, 'images-produit/poudre.avif', 89),
(71, 'images-produit/savon-beauty.jpg', 90),
(77, 'images-produit/6748831b5fdae_c.axe.jpeg', 96);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id_panier` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prix_unitaire` varchar(10) NOT NULL,
  `description` text DEFAULT NULL,
  `courte_description` varchar(250) DEFAULT NULL,
  `quantite` int(11) DEFAULT 0,
  `id_categorie` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom`, `prix_unitaire`, `description`, `courte_description`, `quantite`, `id_categorie`) VALUES
(83, 'Champoing Mani', '100', 'Une Révolution pour Votre Peau\r\n\r\nDécouvrez la crème hydratante ultime qui redéfinit les standards du soin de la peau. Formulée avec un mélange exclusif d\'ingrédients naturels et de technologies avancées, notre Crème Hydratante Éclat Suprême est bien plus qu’un simple hydratant – c’est une expérience sensorielle et un véritable élixir de jeunesse.', 'Entretient de cheveux', 97, 2),
(84, 'Huile de coco', '38', 'Une Révolution pour Votre Peau\r\n\r\nDécouvrez la crème hydratante ultime qui redéfinit les standards du soin de la peau. Formulée avec un mélange exclusif d\'ingrédients naturels et de technologies avancées, notre Crème Hydratante Éclat Suprême est bien plus qu’un simple hydratant – c’est une expérience sensorielle et un véritable élixir de jeunesse.', 'Augmente la brillance de vos cheuveux', 97, 2),
(85, 'Creme de peaux', '24', 'Une Révolution pour Votre Peau\r\n\r\nDécouvrez la crème hydratante ultime qui redéfinit les standards du soin de la peau. Formulée avec un mélange exclusif d\'ingrédients naturels et de technologies avancées, notre Crème Hydratante Éclat Suprême est bien plus qu’un simple hydratant – c’est une expérience sensorielle et un véritable élixir de jeunesse.', 'Evite les peaux secs', 0, 1),
(86, 'Gamme de cheveux', '300', 'Sa texture légère mais riche fond instantanément sur la peau, procurant une sensation de confort immédiat sans laisser de film gras. Parfumée délicatement avec des notes florales et apaisantes, elle offre un véritable moment de bien-être à chaque application.', 'Belle cheveulure garantie avec elle', 97, 2),
(87, 'Gamme de corps', '250', 'Au cœur de cette formule innovante se trouve l’acide hyaluronique à double poids moléculaire, qui pénètre les différentes couches de la peau pour offrir une hydratation immédiate et durable. Associé à des extraits de plantes riches en antioxydants, comme l’aloe vera bio et le thé vert, la crème aide à apaiser les irritations, réduire les rougeurs, et restaurer l’équilibre naturel de la peau.', 'Une peau parfaite en tout temps', 98, 1),
(88, 'Pantene Lait de corps', '24', 'Au cœur de cette formule innovante se trouve l’acide hyaluronique à double poids moléculaire, qui pénètre les différentes couches de la peau pour offrir une hydratation immédiate et durable. Associé à des extraits de plantes riches en antioxydants, comme l’aloe vera bio et le thé vert, la crème aide à apaiser les irritations, réduire les rougeurs, et restaurer l’équilibre naturel de la peau.', 'Une peau douce ', 98, 1),
(89, 'Poudre gold', '10', 'Au cœur de cette formule innovante se trouve l’acide hyaluronique à double poids moléculaire, qui pénètre les différentes couches de la peau pour offrir une hydratation immédiate et durable. Associé à des extraits de plantes riches en antioxydants, comme l’aloe vera bio et le thé vert, la crème aide à apaiser les irritations, réduire les rougeurs, et restaurer l’équilibre naturel de la peau.', 'Pour noel et pas pour Halloween !', 100, 1),
(90, 'Savon - violet', '16', 'Au cœur de cette formule innovante se trouve l’acide hyaluronique à double poids moléculaire, qui pénètre les différentes couches de la peau pour offrir une hydratation immédiate et durable. Associé à des extraits de plantes riches en antioxydants, comme l’aloe vera bio et le thé vert, la crème aide à apaiser les irritations, réduire les rougeurs, et restaurer l’équilibre naturel de la peau.', 'Parfum tres bon', 99, 1),
(96, 'Axe', '22', 'azertyui', 'zertyui', 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `produit_commande`
--

CREATE TABLE `produit_commande` (
  `id_produit` int(11) DEFAULT NULL,
  `id_commande` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit_commande`
--

INSERT INTO `produit_commande` (`id_produit`, `id_commande`, `quantite`) VALUES
(96, 29, 2),
(87, 30, 1),
(83, 31, 1),
(84, 35, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit_panier`
--

CREATE TABLE `produit_panier` (
  `id_panier` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `description`) VALUES
(1, 'client'),
(2, 'admin'),
(3, 'employer');

-- --------------------------------------------------------

--
-- Structure de la table `role_utilisateur`
--

CREATE TABLE `role_utilisateur` (
  `id_role` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role_utilisateur`
--

INSERT INTO `role_utilisateur` (`id_role`, `id_utilisateur`) VALUES
(2, 33),
(3, 123),
(1, 125),
(1, 134),
(3, 135);

-- --------------------------------------------------------

--
-- Structure de la table `tokens_reinitialisation`
--

CREATE TABLE `tokens_reinitialisation` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expire_at` datetime NOT NULL,
  `creer_a` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tokens_reinitialisation`
--

INSERT INTO `tokens_reinitialisation` (`id`, `email`, `token`, `expire_at`, `creer_a`) VALUES
(1, 'khadimaw@gmail.com', 'a64a27de3dcea981091c4f5f0908f6df5559c965cc99f70c6951b2859b32c5ac', '2024-12-04 02:34:05', '2024-12-04 00:34:05'),
(2, 'khadimaw@gmail.com', 'f74dbdbf8135ec3187de56b5876a4b1ba3377b23ac10f91e4fe1a7c8ca82ff0c', '2024-12-04 16:30:15', '2024-12-04 14:30:15'),
(3, 'khadimaw@gmail.com', '9f107e5bad341d77f465af419ddbfc51a551e6174e2527ea6b6e7651072a2416', '2024-12-04 16:30:17', '2024-12-04 14:30:17'),
(4, 'khadimaw2000@gmail.com', 'f695a1287d6211e004481615437fa033b27e4d6950e8267fba37145d22984183', '2024-12-04 22:11:37', '2024-12-04 21:06:37'),
(5, 'khadimaw@gmail.com', '72cacec7594642e4982dcd0d73938f793e3ca19282b2db816d76ce881b78dbbe', '2024-12-05 09:14:25', '2024-12-05 14:09:25'),
(6, 'khadimaw2000@gmail.com', '7031ba3923c236579cec6b544006908cd92d32205b60b4bb971d06139c6a2481', '2024-12-05 09:15:34', '2024-12-05 14:10:34');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `courriel` varchar(250) NOT NULL,
  `mot_de_passe` text NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `question_de_securite` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `date_naissance`, `courriel`, `mot_de_passe`, `telephone`, `question_de_securite`) VALUES
(33, 'AW\r\n', 'Khadim', '2000-08-28', 'khadimaw2000@gmail.com', '$2y$10$UK5ANEqQAKaJGZw6T7ZXPeLdprQYzsJLkZB37tkoLaWJksEkcqFaa', '+15148507615', 'Bintou'),
(103, 'TestGestion', 'TestGestion', '2024-08-16', 'test@gmail.com', '$2y$10$q0L49YWL8nR7jj/qVD7pR.4Frk0dnkWOUzlWEucuejha9M7BjrAry', '5148507615', 'Maman'),
(112, 'qwertyui', 'qwertyuio', '2024-08-02', 'test12@gmail.com', '$2y$10$0P7u1NBWZbOxne3D23JZwO362dchbUfIyTIuZ/zzeimTtcQs9FMsy', '5148507615', 'Bintou'),
(123, 'aw', 'khadim', '2024-11-24', 'khadimaw@gmail.com', '$2y$10$q4ayMs9badNx9Pr7EsUZ8uqVeZ0z3lpXpZvv6PCG.9OpLueyIOZGO', '5148507615', ''),
(125, 'aw', 'khadim', '2024-11-30', 'khadimaw210@gmail.com', '$2y$10$X3EzLHa6h7CkATm1.PsVwO0xImEe8D1JUSHNUwU.d6GXCM2Xb4nOC', '5148507615', ''),
(134, 'Client ', 'Client', '2000-06-23', 'client@gmail.com', '$2y$10$/gDcNKlWdmXG/sVsAYmYUuvA7UX348pWFSkfE8ZAJJGlPgVOp8g.2', '5148507615', ''),
(135, 'KEBE\r\n', 'Maimouna ', '1995-12-23', 'employer@gmail.com', '$2y$10$.0iUvTTKbZES6BmUhlmsquVLrdQ2Fv8XJJZeIk4JedGFh5IhCQULa', '5148507615', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id_adresse`);

--
-- Index pour la table `adresse_utilisateur`
--
ALTER TABLE `adresse_utilisateur`
  ADD KEY `fk_adresse_utilisateur` (`id_adresse`),
  ADD KEY `fk_utilisateur_adresse` (`id_utilisateur`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `fk_commande_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `fk_image_produit` (`id_produit`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id_panier`),
  ADD KEY `fk_id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- Index pour la table `produit_commande`
--
ALTER TABLE `produit_commande`
  ADD KEY `fk_produit_commande` (`id_produit`),
  ADD KEY `fk_commande_produit` (`id_commande`);

--
-- Index pour la table `produit_panier`
--
ALTER TABLE `produit_panier`
  ADD PRIMARY KEY (`id_panier`),
  ADD KEY `fkProd` (`id_produit`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `role_utilisateur`
--
ALTER TABLE `role_utilisateur`
  ADD KEY `fk_role_utilisateur` (`id_role`),
  ADD KEY `fk_utilisateur_role` (`id_utilisateur`);

--
-- Index pour la table `tokens_reinitialisation`
--
ALTER TABLE `tokens_reinitialisation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkMail` (`email`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `courriel` (`courriel`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id_adresse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id_panier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tokens_reinitialisation`
--
ALTER TABLE `tokens_reinitialisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse_utilisateur`
--
ALTER TABLE `adresse_utilisateur`
  ADD CONSTRAINT `fk_adresse_utilisateur` FOREIGN KEY (`id_adresse`) REFERENCES `adresse` (`id_adresse`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_utilisateur_adresse` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_commande_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_image_produit` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `fk_id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit_commande`
--
ALTER TABLE `produit_commande`
  ADD CONSTRAINT `fk_commande_produit` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_produit_commande` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit_panier`
--
ALTER TABLE `produit_panier`
  ADD CONSTRAINT `fkPan` FOREIGN KEY (`id_panier`) REFERENCES `panier` (`id_panier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkProd` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `role_utilisateur`
--
ALTER TABLE `role_utilisateur`
  ADD CONSTRAINT `fk_role_utilisateur` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_utilisateur_role` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tokens_reinitialisation`
--
ALTER TABLE `tokens_reinitialisation`
  ADD CONSTRAINT `fkMail` FOREIGN KEY (`email`) REFERENCES `utilisateur` (`courriel`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
