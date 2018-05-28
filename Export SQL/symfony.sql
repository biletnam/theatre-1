

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `theatreprojet`
--

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lieu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id`, `nom`, `lieu`, `date`) VALUES
(2, 'Le premier evenement', 'Limoges', '2015-04-07 04:05:00'),
(3, 'Deuxième evenement', 'Limoges', '2013-01-01 04:06:00'),
(4, 'Troisième évenement', 'Paris', '2019-05-06 08:08:00');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `user_id`, `team_domain`, `nom`, `prenom`, `user_name`) VALUES
(2, 2, 'Bachelor3IL2018', 'Roby', 'Fabien', 'faro'),
(3, 3, 'bachelor3il2018', 'Menieur', 'Dylan', 'Dyme'),
(5, 1, 'Bachelor3IL2018', 'FOUCARD', 'Maxime', 'foumax');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_evenement`
--

CREATE TABLE `utilisateur_evenement` (
  `id` int(11) NOT NULL,
  `disponibilite` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `souhait` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userId` int(11) NOT NULL,
  `eventId` int(11) NOT NULL,
  `commentaire` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `horaireDispo` datetime NOT NULL,
  `vehicule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `placeHebergement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `utilisateur_evenement`
--

INSERT INTO `utilisateur_evenement` (`id`, `disponibilite`, `souhait`, `userId`, `eventId`, `commentaire`, `horaireDispo`, `vehicule`, `placeHebergement`) VALUES
(6, 'Disponible', 'test souhaite', 5, 2, 'test commentaire', '1970-01-01 19:16:00', 'Oui', 1),
(7, 'Disponible', '1M', 5, 4, 'Aucun commantaire', '1970-01-01 15:00:00', 'Oui', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur_evenement`
--
ALTER TABLE `utilisateur_evenement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6B889D3264B64DCC` (`userId`),
  ADD KEY `IDX_6B889D322B2EBB6C` (`eventId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur_evenement`
--
ALTER TABLE `utilisateur_evenement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `utilisateur_evenement`
--
ALTER TABLE `utilisateur_evenement`
  ADD CONSTRAINT `FK_6B889D322B2EBB6C` FOREIGN KEY (`eventId`) REFERENCES `evenement` (`id`),
  ADD CONSTRAINT `FK_6B889D3264B64DCC` FOREIGN KEY (`userId`) REFERENCES `utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
