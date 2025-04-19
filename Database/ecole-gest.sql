-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 03 fév. 2025 à 14:58
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecole-gest`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE `absence` (
  `id_absence` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom_etudiant` varchar(100) NOT NULL,
  `prenom_etudiant` varchar(100) NOT NULL,
  `classe` varchar(100) NOT NULL,
  `matiere` varchar(100) NOT NULL,
  `dates` date NOT NULL,
  `justifier` varchar(100) NOT NULL,
  `nom_ecole` varchar(100) NOT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `absence`
--

INSERT INTO `absence` (`id_absence`, `nom`, `prenom`, `nom_etudiant`, `prenom_etudiant`, `classe`, `matiere`, `dates`, `justifier`, `nom_ecole`, `champ_visible`) VALUES
(1, 'CISSE', 'MIKAILOU', 'TEMBELY', 'CHEICKNA', 'Tseco', 'philosophie', '2025-01-27', 'oui', 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `absence_surveillant`
--

CREATE TABLE `absence_surveillant` (
  `id_absence` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `nom_etudiant` varchar(100) DEFAULT NULL,
  `prenom_etudiant` varchar(100) DEFAULT NULL,
  `classe` varchar(100) DEFAULT NULL,
  `matiere` varchar(100) DEFAULT NULL,
  `dates` date DEFAULT NULL,
  `justifier` varchar(100) DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `absence_surveillant`
--

INSERT INTO `absence_surveillant` (`id_absence`, `nom`, `prenom`, `nom_etudiant`, `prenom_etudiant`, `classe`, `matiere`, `dates`, `justifier`, `nom_ecole`, `champ_visible`) VALUES
(1, 'dounbia', 'ali', 'TEMBELY', 'CHEICKNA', 'tseco', 'Math', '2024-12-16', 'non', 'LWAKA', 1),
(2, 'TOURE', 'MOHAMED', 'ASSOU', 'COULIBALY', 'tss', 'php', '2025-01-27', 'oui', 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `annee_scolaire`
--

CREATE TABLE `annee_scolaire` (
  `id_annee` int(11) NOT NULL,
  `debut_annee` varchar(10) DEFAULT NULL,
  `fin_annee` varchar(10) DEFAULT NULL,
  `etat_annee` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `antenne`
--

CREATE TABLE `antenne` (
  `id_antenne` int(11) NOT NULL,
  `region` varchar(100) DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `quartier` varchar(100) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `arrivee_professeur`
--

CREATE TABLE `arrivee_professeur` (
  `id_professeur` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `classe` varchar(100) DEFAULT NULL,
  `heure_arrivee` time DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `attribution`
--

CREATE TABLE `attribution` (
  `id_attribution` int(11) NOT NULL,
  `jour` varchar(100) DEFAULT NULL,
  `heure_debut` time DEFAULT NULL,
  `heure_fin` time DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `id_professeur` int(11) DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1,
  `id_classe` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `attribution`
--

INSERT INTO `attribution` (`id_attribution`, `jour`, `heure_debut`, `heure_fin`, `volume`, `id_professeur`, `nom_ecole`, `champ_visible`, `id_classe`, `id_matiere`) VALUES
(1, 'Mardi', '08:00:00', '10:00:00', 35, 2, 'LWAKA', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `attribution_programme`
--

CREATE TABLE `attribution_programme` (
  `id_attribution` int(11) NOT NULL,
  `id_professeur` int(11) DEFAULT NULL,
  `id_classe` int(11) DEFAULT NULL,
  `id_matiere` int(11) DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `attribution_programme`
--

INSERT INTO `attribution_programme` (`id_attribution`, `id_professeur`, `id_classe`, `id_matiere`, `nom_ecole`, `champ_visible`) VALUES
(1, 2, 1, 1, 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `title` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `file_path` varchar(100) DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1,
  `nom_ecole` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id_classe` int(11) NOT NULL,
  `code_classe` varchar(100) DEFAULT NULL,
  `libelle_classe` varchar(100) DEFAULT NULL,
  `niveau` varchar(100) DEFAULT NULL,
  `id_filiere` int(11) DEFAULT NULL,
  `id_annee` int(11) DEFAULT NULL,
  `id_antenne` int(11) DEFAULT NULL,
  `nom_ecole` varchar(100) NOT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1,
  `annee_scolaire` varchar(100) NOT NULL,
  `nombre_table` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id_classe`, `code_classe`, `libelle_classe`, `niveau`, `id_filiere`, `id_annee`, `id_antenne`, `nom_ecole`, `champ_visible`, `annee_scolaire`, `nombre_table`) VALUES
(1, 'tseco', 'Terminale Science Economique', 'TSECO', NULL, NULL, NULL, 'LWAKA', 1, '2024-2025', 20),
(2, 'tss', 'Terminale Science Sociale', '12éme-TSS', NULL, NULL, NULL, 'LWAKA', 1, '2025-2026', 25);

-- --------------------------------------------------------

--
-- Structure de la table `coefficient`
--

CREATE TABLE `coefficient` (
  `classe` varchar(100) DEFAULT NULL,
  `matiere` varchar(100) DEFAULT NULL,
  `coefficient` int(11) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `nom_ecole` varchar(100) NOT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `coefficient`
--

INSERT INTO `coefficient` (`classe`, `matiere`, `coefficient`, `volume`, `nom_ecole`, `champ_visible`) VALUES
('tseco', 'Math', 2, 3, ' LWAKA', 1),
('tseco', 'Math', 2, 3, ' LWAKA', 1),
('tss', 'php', 3, 3, ' LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `nom_livre` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `classe` varchar(100) NOT NULL,
  `date_emprunt` date NOT NULL,
  `id_livre` int(11) NOT NULL,
  `nom_ecole` varchar(100) NOT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande_emprunt`
--

CREATE TABLE `commande_emprunt` (
  `id_commande` int(11) NOT NULL,
  `id_livre` int(11) DEFAULT NULL,
  `nom_emprunteur` varchar(100) DEFAULT NULL,
  `prenom_emprunteur` varchar(100) DEFAULT NULL,
  `date_emprunt` date DEFAULT NULL,
  `date_retour` date DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `crai`
--

CREATE TABLE `crai` (
  `qualite` varchar(100) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `crai`
--

INSERT INTO `crai` (`qualite`, `quantite`, `prix`, `nom_ecole`, `champ_visible`) VALUES
('blanche', 9, 1500, 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `devoirs_domicile`
--

CREATE TABLE `devoirs_domicile` (
  `id` int(11) NOT NULL,
  `nom_prof` varchar(100) DEFAULT NULL,
  `prenom_prof` varchar(100) DEFAULT NULL,
  `classe` varchar(100) DEFAULT NULL,
  `titre_devoir` varchar(100) DEFAULT NULL,
  `contenu` varchar(100) DEFAULT NULL,
  `date_limite` date DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `devoirs_domicile`
--

INSERT INTO `devoirs_domicile` (`id`, `nom_prof`, `prenom_prof`, `classe`, `titre_devoir`, `contenu`, `date_limite`, `nom_ecole`, `champ_visible`) VALUES
(6, 'CISSE', 'MIKAILOU', 'tss', 'azerty', 'azerty', '2025-01-26', 'LWAKA', 1),
(7, 'CISSE', 'MIKAILOU', 'tseco', 'azerty', 'zertyu', '2025-01-28', 'LWAKA', 1),
(8, 'CISSE', 'MIKAILOU', 'tseco', 'azerty', 'zertyu', '2025-01-28', 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ecole`
--

CREATE TABLE `ecole` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `academie` varchar(100) DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `logo_path` varchar(100) DEFAULT NULL,
  `lieu` varchar(100) DEFAULT NULL,
  `statut` int(1) DEFAULT NULL,
  `antenne` varchar(100) DEFAULT NULL,
  `date_licence` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ecole`
--

INSERT INTO `ecole` (`id`, `nom`, `prenom`, `academie`, `nom_ecole`, `logo_path`, `lieu`, `statut`, `antenne`, `date_licence`) VALUES
(1, 'DOUNBIA', 'ALOU', 'Rive Gauche', 'LWAKA', 'uploads/calendrier.png', 'Lafiabougou', 0, 'oui', '2024-12-18'),
(2, 'TEMBELY', 'CHEICKNA', 'Rive dROITE', 'TEMBELY-ACADEMIE', 'uploads/1.jpg', 'BADALABOUGOU', 0, 'NON', NULL),
(3, 'DIAKITE', 'DAVID', 'Rive Gauche', 'TECHNOLAB-ISTA', 'uploads/11428c9b-bc95-4cf2-a345-534086711641_20240305_143405_0000.png', 'ACI2000', 0, 'OUI', '2025-01-30');

-- --------------------------------------------------------

--
-- Structure de la table `eleves`
--

CREATE TABLE `eleves` (
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `classe` varchar(100) DEFAULT NULL,
  `annee_scolaire` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `eleves`
--

INSERT INTO `eleves` (`nom`, `prenom`, `photo`, `classe`, `annee_scolaire`) VALUES
('TEMBELY', 'CHEICKNA', 'photos/1.jpg', 'Tseco', '2024-2025');

-- --------------------------------------------------------

--
-- Structure de la table `emploi`
--

CREATE TABLE `emploi` (
  `id_emploi` int(11) NOT NULL,
  `jour` varchar(100) DEFAULT NULL,
  `heure_debut` time DEFAULT NULL,
  `heure_fin` time DEFAULT NULL,
  `annee_scolaire` varchar(100) DEFAULT NULL,
  `id_classe` int(11) DEFAULT NULL,
  `id_matiere` int(11) DEFAULT NULL,
  `id_professeur` int(11) DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `emploi`
--

INSERT INTO `emploi` (`id_emploi`, `jour`, `heure_debut`, `heure_fin`, `annee_scolaire`, `id_classe`, `id_matiere`, `id_professeur`, `nom_ecole`, `champ_visible`) VALUES
(1, 'Mercredi', '08:00:00', '10:00:00', '2024-2025', 1, 1, 2, 'LWAKA', 1),
(2, 'Mercredi', '08:00:00', '12:00:00', '2025-2026', 1, 3, 3, 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `emprunts`
--

CREATE TABLE `emprunts` (
  `id_livre` int(11) NOT NULL,
  `nom_emprunteur` varchar(100) DEFAULT NULL,
  `prenom_emprunteur` varchar(100) DEFAULT NULL,
  `date_emprunt` date DEFAULT NULL,
  `date_retour` date DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `emprunts`
--

INSERT INTO `emprunts` (`id_livre`, `nom_emprunteur`, `prenom_emprunteur`, `date_emprunt`, `date_retour`, `nom_ecole`, `champ_visible`) VALUES
(1, 'TEMBELY', 'CHEICKNA', '2025-01-27', '2025-01-30', 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `equipements`
--

CREATE TABLE `equipements` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `date_achat` date DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `equipements`
--

INSERT INTO `equipements` (`id`, `nom`, `description`, `date_achat`, `prix`, `nom_ecole`, `champ_visible`) VALUES
(1, 'Imprimante', 'Achat de mouveaux imprimante', '2025-01-27', 150, 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etudiant` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `telephone` varchar(100) DEFAULT NULL,
  `nom_tuteur` varchar(100) DEFAULT NULL,
  `prenom_tuteur` varchar(100) DEFAULT NULL,
  `telephone_tuteur` varchar(100) DEFAULT NULL,
  `classe` varchar(100) DEFAULT NULL,
  `sexe` varchar(100) DEFAULT NULL,
  `date_naiss` varchar(100) DEFAULT NULL,
  `statut` varchar(100) DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`, `nom`, `prenom`, `telephone`, `nom_tuteur`, `prenom_tuteur`, `telephone_tuteur`, `classe`, `sexe`, `date_naiss`, `statut`, `nom_ecole`, `champ_visible`) VALUES
(1, 'TEMBELY', 'CHEICKNA', '73677061', 'TEMBELY', 'Laya', '76763170', 'tseco', 'Garçon', '2001-06-20', 'Regulier', 'LWAKA', 1),
(2, 'DIARRA', 'FATOUMATA', '76763170', 'DIARRA', 'ALI', '73677061', 'CG', 'Fille', '2024-12-19', 'Candidat Libre', 'LWAKA', 1),
(3, 'COULIBALY ALOU', 'Kadidia', '69651474', 'ASSOU', 'COULIBALY', '69651477', 'Tseco', 'Fille', '2025-01-26', 'Regulier', 'LWAKA', 1),
(4, 'COULIBALY ', 'Kadi', '69651474', 'ASSOU', 'COULIBALY', '69651477', 'tss', 'Fille', '2025-01-26', 'Candidat Libre', 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `fiche_sequence`
--

CREATE TABLE `fiche_sequence` (
  `id_fiche` int(11) NOT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `activite` varchar(1000) DEFAULT NULL,
  `duree` varchar(100) DEFAULT NULL,
  `competence` varchar(1000) DEFAULT NULL,
  `domaine` varchar(100) DEFAULT NULL,
  `annee_scolaire` varchar(100) DEFAULT NULL,
  `id_classe` int(11) DEFAULT NULL,
  `id_matiere` int(11) DEFAULT NULL,
  `id_professeur` int(11) DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fiche_sequence`
--

INSERT INTO `fiche_sequence` (`id_fiche`, `titre`, `activite`, `duree`, `competence`, `domaine`, `annee_scolaire`, `id_classe`, `id_matiere`, `id_professeur`, `nom_ecole`, `champ_visible`) VALUES
(1, 'azerty', 'azerty', '3', 'azerty', 'azerty', '2025-2026', 2, 1, 2, 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `id_filiere` int(11) NOT NULL,
  `filiere` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1,
  `nom_ecole` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `id_livre` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `auteur` varchar(100) DEFAULT NULL,
  `annee` varchar(100) DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id_livre`, `nom`, `genre`, `auteur`, `annee`, `nom_ecole`, `champ_visible`) VALUES
(1, 'Base de php', 'formation', 'Cheickna Tembely', '2019', 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `maintenances`
--

CREATE TABLE `maintenances` (
  `nom_equipement` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `date_maintenance` date DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `maintenances`
--

INSERT INTO `maintenances` (`nom_equipement`, `description`, `date_maintenance`, `prix`, `nom_ecole`, `champ_visible`) VALUES
('Imprimante', 'maintemance', '2025-01-27', 150000, 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `id_matiere` int(11) NOT NULL,
  `libelle_matiere` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1,
  `nom_ecole` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id_matiere`, `libelle_matiere`, `champ_visible`, `nom_ecole`) VALUES
(1, 'Philisophie', 1, 'LWAKA'),
(2, 'Histoire-Geographie', 1, 'LWAKA'),
(3, 'php', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `nom_envoyeur` varchar(100) DEFAULT NULL,
  `prenom_envoyeur` varchar(100) DEFAULT NULL,
  `poste_envoyeur` varchar(100) DEFAULT NULL,
  `nom_destinateur` varchar(100) DEFAULT NULL,
  `prenom_destinateur` varchar(100) DEFAULT NULL,
  `poste_destinateur` varchar(100) DEFAULT NULL,
  `motif` varchar(100) DEFAULT NULL,
  `dates` datetime DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1,
  `nom_ecole` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `nom_envoyeur`, `prenom_envoyeur`, `poste_envoyeur`, `nom_destinateur`, `prenom_destinateur`, `poste_destinateur`, `motif`, `dates`, `champ_visible`, `nom_ecole`) VALUES
(1, 'DOUNBIA', 'ALOU', 'Administrateur Local', 'TEMBELY', 'CHEICKNA', 'test', 'test2', '2024-12-18 13:37:00', 1, 'LWAKA'),
(2, 'CISSE', 'MIKAILOU', 'Professeur', 'azerty', 'azerty', 'azerty', 'azerty', '2025-01-26 23:27:00', 1, 'LWAKA'),
(3, 'MAROKO', 'SALIM', 'Proviseur', 'azerty', 'azerty', 'azerty', 'azerty', '2025-01-27 00:12:00', 1, ''),
(4, 'MAROKO', 'SALIM', 'Proviseur', 'azerty', 'azerty', 'azerty', 'azerty', '2025-01-27 00:13:00', 1, ''),
(5, 'MAROKO', 'SALIM', 'Proviseur', 'azerty', 'azerty', 'azerty', 'azerty', '2025-01-27 00:19:00', 1, 'LWAKA');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `destinataire_id` int(11) NOT NULL,
  `envoyeur` varchar(100) DEFAULT NULL,
  `nom_destinataire` varchar(100) DEFAULT NULL,
  `prenom_destinataire` varchar(100) DEFAULT NULL,
  `poste_envoyeur` varchar(100) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1,
  `nom_ecole` varchar(100) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`destinataire_id`, `envoyeur`, `nom_destinataire`, `prenom_destinataire`, `poste_envoyeur`, `message`, `champ_visible`, `nom_ecole`, `date_creation`) VALUES
(1, 'Maroko Salim', 'TEMBELY', 'Laya', 'Proviseur', 'Votre fils ne vient pas a l\'ecole\r\n', 1, '', '2025-01-27 00:37:51'),
(2, 'azerty', 'DIARRA', 'ALI', 'Proviseur', 'zertyu', 1, '', '2025-01-27 00:41:49'),
(4, 'Maroko Salim', 'ASSOU', 'COULIBALY', 'Proviseur', 'Votre fils me vient pas a l\'ecole', 1, '', '2025-01-27 00:37:11');

-- --------------------------------------------------------

--
-- Structure de la table `message_grouper`
--

CREATE TABLE `message_grouper` (
  `id_message` int(11) NOT NULL,
  `nom_envoyeur` varchar(100) DEFAULT NULL,
  `prenom_envoyeur` varchar(100) DEFAULT NULL,
  `poste_envoyeur` varchar(100) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
  `id_niveau` int(11) NOT NULL,
  `niveau` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `niveau`
--

INSERT INTO `niveau` (`id_niveau`, `niveau`) VALUES
(1, 'Comptable'),
(2, 'Administrateur Local'),
(3, 'Bibliotheque'),
(4, 'Administrateur Principal'),
(5, 'Professeur'),
(6, 'Proviseur'),
(7, 'Surveillant'),
(8, 'Enqueteur'),
(9, 'Parent'),
(10, 'Secretaire'),
(11, 'Censeur');

-- --------------------------------------------------------

--
-- Structure de la table `niveau_enseignement`
--

CREATE TABLE `niveau_enseignement` (
  `id_niveau` int(11) NOT NULL,
  `nom_prof` varchar(100) DEFAULT NULL,
  `prenom_prof` varchar(100) DEFAULT NULL,
  `dates` date DEFAULT NULL,
  `contenu` varchar(1000) DEFAULT NULL,
  `matiere` varchar(100) DEFAULT NULL,
  `classe` varchar(100) DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `niveau_enseignement`
--

INSERT INTO `niveau_enseignement` (`id_niveau`, `nom_prof`, `prenom_prof`, `dates`, `contenu`, `matiere`, `classe`, `nom_ecole`, `champ_visible`) VALUES
(1, 'CISSE', 'MIKAILOU', '2025-01-26', 'azerty', 'philosophie', 'Tseco', 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id_classe` int(11) NOT NULL,
  `id_etudiant` int(11) DEFAULT NULL,
  `matiere` varchar(100) DEFAULT NULL,
  `interrogation1` varchar(100) DEFAULT NULL,
  `interrogation2` varchar(100) DEFAULT NULL,
  `devoir1` varchar(100) DEFAULT NULL,
  `devoir2` varchar(100) DEFAULT NULL,
  `total_devoirs` varchar(100) DEFAULT NULL,
  `mois` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1,
  `nom_ecole` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`id_classe`, `id_etudiant`, `matiere`, `interrogation1`, `interrogation2`, `devoir1`, `devoir2`, `total_devoirs`, `mois`, `champ_visible`, `nom_ecole`) VALUES
(1, 1, 'philisophie', '10', '8', '15', '10', '8.6', 'Janvier', 1, 'LWAKA');

-- --------------------------------------------------------

--
-- Structure de la table `note_examen`
--

CREATE TABLE `note_examen` (
  `id_etudiant` int(11) NOT NULL,
  `matiere` varchar(100) DEFAULT NULL,
  `total_devoir` varchar(100) DEFAULT NULL,
  `examen` varchar(100) DEFAULT NULL,
  `mois` varchar(100) DEFAULT NULL,
  `trimestre` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1,
  `nom_ecole` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `note_examen`
--

INSERT INTO `note_examen` (`id_etudiant`, `matiere`, `total_devoir`, `examen`, `mois`, `trimestre`, `champ_visible`, `nom_ecole`) VALUES
(1, 'philisophie', '16', '14', 'Mars', 'Trimestre 1', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `pointage`
--

CREATE TABLE `pointage` (
  `id_pointage` int(11) NOT NULL,
  `date_debut` datetime DEFAULT NULL,
  `date_fin` datetime DEFAULT NULL,
  `statut` varchar(100) DEFAULT NULL,
  `id_classe` int(11) DEFAULT NULL,
  `id_matiere` int(11) DEFAULT NULL,
  `id_professeur` int(11) DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pointage`
--

INSERT INTO `pointage` (`id_pointage`, `date_debut`, `date_fin`, `statut`, `id_classe`, `id_matiere`, `id_professeur`, `nom_ecole`, `champ_visible`) VALUES
(8, '2024-11-17 08:00:00', '2024-11-17 12:00:00', 'Payer', 1, 1, 2, 'LWAKA', 1),
(9, '2024-12-21 08:00:00', '2024-12-21 10:00:00', 'valider', 1, 1, 2, 'LWAKA', 1),
(10, '2024-12-27 08:00:00', '2024-12-27 10:46:00', 'valider', 2, 3, 2, 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `id_professeur` int(11) NOT NULL,
  `nom_professeur` varchar(100) DEFAULT NULL,
  `prenom_professeur` varchar(100) DEFAULT NULL,
  `telephone1` int(11) DEFAULT NULL,
  `telephone2` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `employeur` varchar(100) DEFAULT NULL,
  `nom_ecole` varchar(100) NOT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1,
  `dernier_diplome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`id_professeur`, `nom_professeur`, `prenom_professeur`, `telephone1`, `telephone2`, `email`, `ville`, `profession`, `employeur`, `nom_ecole`, `champ_visible`, `dernier_diplome`) VALUES
(2, 'cisse', 'Mikailou', 60645724, 78754673, 'mikaciss@gmail.com', 'ouezzindouogou', 'Professeur', 'Regulier', 'LWAKA', 1, 'Master'),
(3, 'TEMBELY', 'LAYA', 76763170, 66763170, 'tembelyc@gmail.com', 'BAMAKO', 'Professeur', 'Regulier', 'LWAKA', 1, 'Doctotat');

-- --------------------------------------------------------

--
-- Structure de la table `programme`
--

CREATE TABLE `programme` (
  `id_programme` int(11) NOT NULL,
  `contenu` varchar(100) DEFAULT NULL,
  `horaire_hebdomadaire` varchar(100) DEFAULT NULL,
  `coeficient` int(11) DEFAULT NULL,
  `annee_scolaire` varchar(100) DEFAULT NULL,
  `id_classe` int(11) DEFAULT NULL,
  `id_matiere` int(11) DEFAULT NULL,
  `competence` varchar(1000) DEFAULT NULL,
  `composante` varchar(1000) DEFAULT NULL,
  `manifestation` varchar(1000) DEFAULT NULL,
  `trimestre` varchar(100) DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `programme`
--

INSERT INTO `programme` (`id_programme`, `contenu`, `horaire_hebdomadaire`, `coeficient`, `annee_scolaire`, `id_classe`, `id_matiere`, `competence`, `composante`, `manifestation`, `trimestre`, `nom_ecole`, `champ_visible`) VALUES
(1, 'azerty', '3', 3, '2025-2026', 1, 1, 'azerty', 'azerty', 'azerty', '1', 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `scolarite`
--

CREATE TABLE `scolarite` (
  `id_scolairite` int(11) NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  `frais_inscription` int(11) DEFAULT NULL,
  `paiement_type` varchar(100) DEFAULT NULL,
  `mois_paye` int(11) DEFAULT NULL,
  `montant_annuel` varchar(100) DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `scolarite`
--

INSERT INTO `scolarite` (`id_scolairite`, `id_etudiant`, `frais_inscription`, `paiement_type`, `mois_paye`, `montant_annuel`, `nom_ecole`, `champ_visible`) VALUES
(3, 4, 100, 'tranche', 2, '', '1', 1),
(4, 4, 100, 'tranche', 2, '', '1', 1),
(5, 4, 100, 'tranche', 2, '', '1', 1),
(6, 4, 100, 'tranche', 2, '', '1', 1),
(7, 4, 100, 'tranche', 2, '', '1', 1),
(8, 4, 100, 'tranche', 2, '', '1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `sortie_craie`
--

CREATE TABLE `sortie_craie` (
  `qualite` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sortie_craie`
--

INSERT INTO `sortie_craie` (`qualite`, `quantite`, `nom`, `date`, `nom_ecole`, `champ_visible`) VALUES
(0, 1, 'CHEICKNA', '2025-01-27', 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

CREATE TABLE `specialite` (
  `id_specialite` int(11) NOT NULL,
  `specialite` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tenues_scolaires`
--

CREATE TABLE `tenues_scolaires` (
  `nom_tenu` varchar(100) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tenues_scolaires`
--

INSERT INTO `tenues_scolaires` (`nom_tenu`, `quantite`, `prix`, `nom_ecole`, `champ_visible`) VALUES
('Kakie', 96, 1500, 'LWAKA', 1),
('lagos', 1, 1000, 'LWAKA', 1),
('lagos', 9, 1000, 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tenues_vendues`
--

CREATE TABLE `tenues_vendues` (
  `nom_tenu` varchar(100) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prix_unitaire` int(11) DEFAULT NULL,
  `prix_total` int(11) DEFAULT NULL,
  `nom_eleve` varchar(100) DEFAULT NULL,
  `prenom_eleve` varchar(100) DEFAULT NULL,
  `classe_eleve` varchar(100) DEFAULT NULL,
  `nom_ecole` varchar(100) DEFAULT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tenues_vendues`
--

INSERT INTO `tenues_vendues` (`nom_tenu`, `quantite`, `prix_unitaire`, `prix_total`, `nom_eleve`, `prenom_eleve`, `classe_eleve`, `nom_ecole`, `champ_visible`) VALUES
('Kakie', 2, 1500, 3000, 'TEMBELY', 'CHEICKNA', 'Tseco', 'LWAKA', 1),
('kakie', 2, 1000, 2000, 'TEMBELY', 'CHEICKNA', 'Tseco', 'LWAKA', 1),
('lagos', 2, 1000, 2000, 'TEMBELY', 'CHEICKNA', 'Tseco', 'LWAKA', 1),
('lagos', 47, 1000, 47000, 'TEMBELY', 'CHEICKNA', 'Tseco', 'LWAKA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `transfert_ecole`
--

CREATE TABLE `transfert_ecole` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `ancienne_ecole` varchar(100) NOT NULL,
  `nouvelle_ecole` varchar(100) NOT NULL,
  `motif` varchar(100) NOT NULL,
  `statut` enum('Valider','Rejeter','','') NOT NULL,
  `nom_ecole` varchar(100) NOT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `transfert_ecole`
--

INSERT INTO `transfert_ecole` (`id`, `nom`, `prenom`, `ancienne_ecole`, `nouvelle_ecole`, `motif`, `statut`, `nom_ecole`, `champ_visible`) VALUES
(1, 'TEMBELY', 'CHEICKNA', 'LWaka', 'azerty', 'dememagement', 'Rejeter', '', 1),
(2, 'TEMBELY', 'CHEICKNA', 'LWaka', 'azerty', 'qsdfvbgn', 'Valider', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_user` int(11) NOT NULL,
  `nom_user` varchar(100) NOT NULL,
  `prenom_user` varchar(100) NOT NULL,
  `GENDER` varchar(100) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `statut` int(1) NOT NULL DEFAULT 0,
  `id_niveau` int(11) NOT NULL,
  `nom_ecole` varchar(100) NOT NULL,
  `champ_visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `nom_user`, `prenom_user`, `GENDER`, `email_user`, `login`, `PASSWORD`, `statut`, `id_niveau`, `nom_ecole`, `champ_visible`) VALUES
(2, 'cisse', 'mika', 'Masculin', 'mika@gmail.com', 'root', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0, 4, 'LWAKA', 1),
(13, 'DOUNBIA', 'ALOU', 'MASCULIN', 'dounbia@gmail.com', 'local', '939bb46a04c3640c8c427e92b1b557e882e2d2a0', 0, 2, 'LWAKA', 1),
(14, 'CISSE', 'MIKAILOU', 'Masculin', 'mikaciss@gmail.com', 'prof', 'd9f02d46be016f1b301f7c02a4b9c4ebe0dde7ef', 0, 5, 'LWAKA', 1),
(15, 'KEITA', 'ALIOU', 'MASCULIN', 'keita@gmail.com', 'cens', 'dfb7e7daf0da58e3fd0abfc9ba30666050e24556', 0, 11, 'LWAKA', 1),
(16, 'TRAORE', 'SEKOU', 'MASCULIN', 'traore@gmail.com', 'eco', 'f1a915d3cbdb67e6d1f3789c441b576a7c586c18', 0, 1, 'LWAKA', 1),
(17, 'MAROKO', 'SALIM', 'MASCULIN', 'mariko@gmail.com', 'provi', 'a8169f609ca02b3d43404eac260e6e103eb06740', 0, 6, 'LWAKA', 1),
(18, 'DIARRA', 'RAMATOU', 'FEMININ', 'diarra@gmail.com', 'bibli', '72e27d8e977d83032f06dcf5bb72c5cb0f15cc17', 0, 3, 'LWAKA', 1),
(19, 'TEMBELY', 'Laya', 'MASCULIN', 'tembelyc@gmail.com', 'par', 'e79113f506e4480c28e70a46987c30d2d90f2096', 0, 9, 'LWAKA', 1),
(21, 'TOURE', 'MOHAMED', 'MASCULIN', 'toure@gmail.com', 'surv', 'd0b7fc25a5f7aab484dc7809ce63336b059190ed', 0, 7, 'LWAKA', 1),
(22, 'TEMBELY', 'MAMOUDE', 'MASCULIN', 'tembelyc@gmail.com', 'enq', '0efd71018050174463aa91f3623b49ba95f3fc83', 0, 8, 'LWAKA', 1),
(23, 'TEMBELY', 'CHEICKNA', 'MASCULIN', 'tembelyc@gmail.com', 'local2', '611a8e33af775207bfad7b1b015ee46d25e9100d', 0, 2, '', 1),
(24, 'TEMBELY', 'MAMOU', 'FEMININ', 'tembelyc@gmail.com', 'secre', '01ae7be938bac51293b207361f204e8ae1974284', 0, 10, 'LWAKA', 1),
(27, 'DIAKITE', 'DAVID', 'MASCULIN', 'diakite@gmail.com', 'diakite', 'fddefe02dd2c6ef2da186819e5053c4b2bb926a4', 0, 2, '', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`id_absence`);

--
-- Index pour la table `absence_surveillant`
--
ALTER TABLE `absence_surveillant`
  ADD PRIMARY KEY (`id_absence`);

--
-- Index pour la table `annee_scolaire`
--
ALTER TABLE `annee_scolaire`
  ADD PRIMARY KEY (`id_annee`);

--
-- Index pour la table `antenne`
--
ALTER TABLE `antenne`
  ADD PRIMARY KEY (`id_antenne`);

--
-- Index pour la table `arrivee_professeur`
--
ALTER TABLE `arrivee_professeur`
  ADD PRIMARY KEY (`id_professeur`);

--
-- Index pour la table `attribution`
--
ALTER TABLE `attribution`
  ADD PRIMARY KEY (`id_attribution`),
  ADD KEY `id_professeur` (`id_professeur`),
  ADD KEY `id_classe` (`id_classe`),
  ADD KEY `id_matiere` (`id_matiere`);

--
-- Index pour la table `attribution_programme`
--
ALTER TABLE `attribution_programme`
  ADD PRIMARY KEY (`id_attribution`),
  ADD UNIQUE KEY `id_matiere` (`id_matiere`),
  ADD KEY `id_professeur` (`id_professeur`),
  ADD KEY `id_classe` (`id_classe`);

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id_classe`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_livre` (`id_livre`);

--
-- Index pour la table `commande_emprunt`
--
ALTER TABLE `commande_emprunt`
  ADD PRIMARY KEY (`id_commande`),
  ADD UNIQUE KEY `id_livre` (`id_livre`);

--
-- Index pour la table `devoirs_domicile`
--
ALTER TABLE `devoirs_domicile`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ecole`
--
ALTER TABLE `ecole`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `emploi`
--
ALTER TABLE `emploi`
  ADD PRIMARY KEY (`id_emploi`),
  ADD UNIQUE KEY `id_matiere` (`id_matiere`),
  ADD KEY `id_professeur` (`id_professeur`),
  ADD KEY `id_classe` (`id_classe`);

--
-- Index pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD PRIMARY KEY (`id_livre`);

--
-- Index pour la table `equipements`
--
ALTER TABLE `equipements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etudiant`);

--
-- Index pour la table `fiche_sequence`
--
ALTER TABLE `fiche_sequence`
  ADD PRIMARY KEY (`id_fiche`),
  ADD KEY `id_professeur` (`id_professeur`),
  ADD KEY `id_classe` (`id_classe`),
  ADD KEY `id_matiere` (`id_matiere`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id_filiere`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`id_livre`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id_matiere`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`destinataire_id`);

--
-- Index pour la table `message_grouper`
--
ALTER TABLE `message_grouper`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`id_niveau`);

--
-- Index pour la table `niveau_enseignement`
--
ALTER TABLE `niveau_enseignement`
  ADD PRIMARY KEY (`id_niveau`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id_classe`),
  ADD KEY `id_etudiant` (`id_etudiant`);

--
-- Index pour la table `note_examen`
--
ALTER TABLE `note_examen`
  ADD PRIMARY KEY (`id_etudiant`);

--
-- Index pour la table `pointage`
--
ALTER TABLE `pointage`
  ADD PRIMARY KEY (`id_pointage`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`id_professeur`);

--
-- Index pour la table `programme`
--
ALTER TABLE `programme`
  ADD PRIMARY KEY (`id_programme`);

--
-- Index pour la table `scolarite`
--
ALTER TABLE `scolarite`
  ADD PRIMARY KEY (`id_scolairite`),
  ADD KEY `id_etudiant` (`id_etudiant`);

--
-- Index pour la table `specialite`
--
ALTER TABLE `specialite`
  ADD PRIMARY KEY (`id_specialite`);

--
-- Index pour la table `transfert_ecole`
--
ALTER TABLE `transfert_ecole`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `absence`
--
ALTER TABLE `absence`
  MODIFY `id_absence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `absence_surveillant`
--
ALTER TABLE `absence_surveillant`
  MODIFY `id_absence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `annee_scolaire`
--
ALTER TABLE `annee_scolaire`
  MODIFY `id_annee` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `antenne`
--
ALTER TABLE `antenne`
  MODIFY `id_antenne` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `arrivee_professeur`
--
ALTER TABLE `arrivee_professeur`
  MODIFY `id_professeur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `attribution`
--
ALTER TABLE `attribution`
  MODIFY `id_attribution` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `attribution_programme`
--
ALTER TABLE `attribution_programme`
  MODIFY `id_attribution` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id_classe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commande_emprunt`
--
ALTER TABLE `commande_emprunt`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `devoirs_domicile`
--
ALTER TABLE `devoirs_domicile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `ecole`
--
ALTER TABLE `ecole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `emploi`
--
ALTER TABLE `emploi`
  MODIFY `id_emploi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `emprunts`
--
ALTER TABLE `emprunts`
  MODIFY `id_livre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `equipements`
--
ALTER TABLE `equipements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etudiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `fiche_sequence`
--
ALTER TABLE `fiche_sequence`
  MODIFY `id_fiche` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id_filiere` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `id_livre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id_matiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `destinataire_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `message_grouper`
--
ALTER TABLE `message_grouper`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `niveau`
--
ALTER TABLE `niveau`
  MODIFY `id_niveau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `niveau_enseignement`
--
ALTER TABLE `niveau_enseignement`
  MODIFY `id_niveau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id_classe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `note_examen`
--
ALTER TABLE `note_examen`
  MODIFY `id_etudiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `pointage`
--
ALTER TABLE `pointage`
  MODIFY `id_pointage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `professeur`
--
ALTER TABLE `professeur`
  MODIFY `id_professeur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `programme`
--
ALTER TABLE `programme`
  MODIFY `id_programme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `scolarite`
--
ALTER TABLE `scolarite`
  MODIFY `id_scolairite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `id_specialite` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transfert_ecole`
--
ALTER TABLE `transfert_ecole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
