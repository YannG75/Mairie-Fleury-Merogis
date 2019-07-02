-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 03 juil. 2019 à 01:14
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mairie`
--

-- --------------------------------------------------------

--
-- Structure de la table `bill`
--

DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bill_number` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `price` float NOT NULL,
  `date` date NOT NULL,
  `pdf` varchar(256) NOT NULL,
  `acquitted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `bill`
--

INSERT INTO `bill` (`id`, `user_id`, `bill_number`, `name`, `price`, `date`, `pdf`, `acquitted`) VALUES
(1, 2, '786464', 'Cantine Municipale', 46.08, '2019-07-01', 'facture_786464.pdf', 0),
(2, 2, '2015-32-549634', 'Cantine scolaire ', 53.22, '2019-06-01', 'facture_2015-32-549634.pdf', 1),
(3, 2, '2019-32-547854', 'Centre de loisirs', 46.08, '2019-07-01', '1235407165.pdf', 1);

-- --------------------------------------------------------

--
-- Structure de la table `city_info`
--

DROP TABLE IF EXISTS `city_info`;
CREATE TABLE IF NOT EXISTS `city_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_info` varchar(255) NOT NULL,
  `content_info` text NOT NULL,
  `image_info` varchar(256) NOT NULL,
  `orientation` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `city_info`
--

INSERT INTO `city_info` (`id`, `title_info`, `content_info`, `image_info`, `orientation`) VALUES
(1, 'Les origines du nom de la ville', 'Floriaco, Flory, Flury et enfin Fleury : au cours de son histoire, notre ville a été dotée de plusieurs noms. L’origine du nom de la ville a été étudiée par de nombreux historiens, archivistes et paléographes dont les études se contredisent parfois. Ce qui est sûr, c’est qu’on trouve trace pour la première fois du nom initial vers 1093 : le lieu était nommé « Floriacum ». De ce nom est issue l’appellation des habitants « Floriacumois ». En 1140, durant le règne du seigneur Robertus de Florico, un château fort aurait été construit puis fortifié sous les ordres de Louis VI afin d’asseoir la dynastie capétienne. Guillaume de Méraugis, seigneur de Fleury, en devient ensuite le propriétaire, donnant ainsi le nom définitif à la ville : Fleury-Mérogis.\r\n', 'p30-joncs-marins-au-choix.jpg', 'leftToRight'),
(2, 'La maison d\'arrêt', 'En 1961, le ministère de la Justice recherchait un domaine suffisamment vaste et grand pour construire un centre pénitentiaire. Les 180 hectares de la ferme de Plessis-le-Comte furent retenus et ainsi, la construction de la prison de Fleury-Mérogis fut ordonnée en 1962 par l’Administration française et le ministère de la Justice. Initialement, ce projet devait servir à désengorger les prisons de la région parisienne, jugées vétustes et surpeuplées. Réalisée par les architectes Guillaume Gillet, Pierre Vagne, Jacques Durand et René Boeuf, la première pierre du bâtiment fût posée par Jean Foyer, alors Garde des Sceaux, ministre de la Justice. Située à douze kilomètres de la préfecture d’Évry, elle est la plus importante d’Europe avec une capacité d’accueil d’environ 2 850 détenus. Elle possède trois centres de détention : une maison d’arrêt pour hommes, créée de 1964 à 1968 ; un centre pour jeunes adultes âgés de 18 à 21 ans, réalisé en 1972 et une maison d’arrêt pour femmes, finalisée en 1973.', 'p-20-vue-A13-1966.jpg', 'rightToLeft'),
(3, 'L’école d\'hier et sa classe unique', 'Auparavant, l’accès à l’instruction était limité aux enfants dont les parents étaient en mesure de la payer. Suite à la loi Guizot de 1833 obligeant chaque village à ouvrir une école, la première école de Fleury-Mérogis est inaugurée en 1834. C’était alors une grange couverte de chaume située face à l’église. Délabrée, elle ferma en 1862. Les années qui suivirent, les enfants devaient se rendre à Bondoufle mais la majorité d’entre eux étaient privés d’instruction. Le temps d’acquérir de nouveaux locaux, la classe fut donc installée provisoirement dans le salon d’une famille floriacumoise, les époux Bauër. Il faudra attendre 1863 pour que l’enseignement soit délivré à la « maison école-mairie », jusqu’en 1967.', 'p-24-Photo-de-classe-1929.jpg', 'leftToRight');

-- --------------------------------------------------------

--
-- Structure de la table `city_service`
--

DROP TABLE IF EXISTS `city_service`;
CREATE TABLE IF NOT EXISTS `city_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_title` varchar(256) NOT NULL,
  `service_content` text NOT NULL,
  `service_image` varchar(256) NOT NULL,
  `adress` text NOT NULL,
  `orientation` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `city_service`
--

INSERT INTO `city_service` (`id`, `service_title`, `service_content`, `service_image`, `adress`, `orientation`) VALUES
(1, 'ASSOCIATIONS SPORTIVES :\r\nPour toute question concernant les projets des associations sportives', 'Contacter : Sébastien BARBEAU.\r\nTél. : 01 69 46 72 10.\r\nMail : barbeau@mairie-fleury-merogis.fr\r\ncarnaval a fleury merogis\r\n', 'terrain_foot_fleury_merogis.jpg', '', 'rightToLeft'),
(2, 'LA MÉDIATHÈQUE ELSA-TRIOLET', 'Adresse : 59 rue André-Malraux - 9170 0 Fleury-Mérogis.\r\nTél. : 01 60 16 30 60.\r\nMail : mediatheque-fleury@coeuressonne.fr\r\nCENTRE TECHNIQUE MUNICIPAL\r\nAdresse : 2 rue Montcoquet - 91700 Fleury-Mérogis.\r\nTél. : 01 69 04 91 10.\r\n', 'mediatheque_elsa_triolet2.jpg', 'https://www.google.fr/maps/place/59+Rue+Andr%C3%A9+Malraux,+91700+Fleury-M%C3%A9rogis/@48.6373941,2.3615684,17z/data=!3m1!4b1!4m5!3m4!1s0x47e5dec6e229f249:0x85ce100c14e8551c!8m2!3d48.6373941!4d2.3637624', 'leftToRight'),
(3, 'LES ASSOCIATIONS', 'Adresse : 11 rue Roger-Clavier - 91700 Fleury-Mérogis.\r\nTél. : 01 69 46 72 09.\r\nMail : cvl@mairie-fleury-merogis.fr - sport-vie.associative@mairie-fleury-merogis.fr\r\n', 'city_stade_fleury_merogis.jpg', 'https://www.google.fr/maps/place/11+Rue+Roger+Clavier,+91700+Fleury-M%C3%A9rogis/@48.630456,2.3590841,17z/data=!3m1!4b1!4m5!3m4!1s0x47e5deb99ac5bb0b:0x293cdde01052d349!8m2!3d48.630456!4d2.3612781', 'rightToLeft'),
(4, 'PETITE ENFANCE\r\nMAISON DE LA PETITE ENFANCE :', 'Adresse : 60 rue André-Malraux - 91700 Fleury-Mérogis.\r\nCrèche collective : 01 69 46 67 11.\r\nCrèche familiale : 01 69 46 67 00.\r\nHalte-garderie : 01 69 46 67 15.\r\nMULTI-ACCUEIL “BRIN D’ÉVEIL” :\r\nAdresse : 77 rue de l’Ecoute-s’il-pleut - 91700 Fleury-Mérogis.\r\nTél. : 01 69 25 39 80.\r\n', 'IMG_3394modif_670.jpg', 'https://www.google.fr/maps/place/60+Rue+Andr%C3%A9+Malraux,+91700+Fleury-M%C3%A9rogis/@48.6371948,2.361451,17z/data=!3m1!4b1!4m5!3m4!1s0x47e5dec71d9430e9:0xe6e635f2c04d2aa!8m2!3d48.6371948!4d2.363645', 'leftToRight'),
(5, 'CENTRE MUSICAL ET ARTISTIQUE', 'Adresse : rue Salvador-Allende - 91700 Fleury-Mérogis.\r\nTél. : 01 60 16 84 29 - 06 33 54 92 20.\r\nMail : cma@mairie-fleury-merogis.fr\r\nSALLE ANDRÉ-MALRAUX\r\nAdresse : 57 rue André-Malraux - 91700 Fleury-Mérogis.\r\nTél. : 01 69 46 72 09.\r\n', 'musical_center.jpg', 'https://www.google.fr/maps/place/57+Rue+Andr%C3%A9+Malraux,+91700+Fleury-M%C3%A9rogis/@48.6373451,2.3636205,17z/data=!4m13!1m7!3m6!1s0x47e5dec6e35a1bf5:0xbd5acae307fd267b!2s57+Rue+Andr%C3%A9+Malraux,+91700+Fleury-M%C3%A9rogis!3b1!8m2!3d48.6375391!4d2.3634737!3m4!1s0x47e5dec6e35a1bf5:0xbd5acae307fd267b!8m2!3d48.6375391!4d2.3634737', 'rightToLeft'),
(6, 'STUDIO LE ONZE', 'Adresse : 11 rue Roger-Clavier - 91700 Fleury-Mérogis.\r\nTél. : 01 69 46 72 09.\r\nMail : driyej@mairie-fleury-merogis.fr - leonze@mairie-fleury-merogis.fr\r\n', 'cbk.jpg', 'https://www.google.fr/maps/place/11+Rue+Roger+Clavier,+91700+Fleury-M%C3%A9rogis/@48.6304797,2.3611491,17z/data=!4m13!1m7!3m6!1s0x47e5deb99ac5bb0b:0x293cdde01052d349!2s11+Rue+Roger+Clavier,+91700+Fleury-M%C3%A9rogis!3b1!8m2!3d48.630456!4d2.3612781!3m4!1s0x47e5deb99ac5bb0b:0x293cdde01052d349!8m2!3d48.630456!4d2.3612781', 'leftToRight');

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `published_at` date NOT NULL,
  `summary` text,
  `content` longtext,
  `image` varchar(255) DEFAULT NULL,
  `video` text,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `title`, `published_at`, `summary`, `content`, `image`, `video`, `is_published`) VALUES
(1, 'CANICULE : FERMETURE DES ECOLES ET DES CRECHES JEUDI ET VENDREDI !', '2019-06-25', 'La municipalité prend la décision de fermer les locaux des trois groupes scolaires les jeudi 27 et vendredi 28 juin 2019.', 'Compte tenu de l’épisode caniculaire annoncé et en accord avec les services de l\'Education nationale, la municipalité prend la décision de fermer les locaux des trois groupes scolaires les jeudi 27 et vendredi 28 juin 2019.\r\n\r\nLes crèches municipales sont également fermées les jeudi 27 et vendredi 28 juin.\r\n\r\nNous vous remercions pour votre compréhension dans cette situation très exceptionnelle.\r\n\r\nUne information spécifique sera mise en œuvre sur les supports de la ville et devant les structures municipales.', 'CANICULE.png', NULL, 1),
(2, 'UNE PREMIÈRE FLEUR POUR FLEURY ?', '2019-05-25', 'La ville participe cette année au concours des villes et villages fleuris, organisé par le Conseil départemental de l’Essonne par délégation du Conseil national des villes et villages fleuris.', 'Engagée dans un vaste plan d’amélioration de son cadre de vie, la ville participe cette année au concours des villes et villages fleuris, organisé par le Conseil départemental de l’Essonne par délégation du Conseil national des villes et villages fleuris. Une participation qui vise à décrocher une première fleur, à valoriser le patrimoine naturel et paysager de la ville et valoriser les agents du service des Espaces verts. Passage du jury le mardi 25 juin, verdict courant juillet !', '6988.jpg', NULL, 1),
(3, 'TRAVAUX DU TERRAIN SYNTHETIQUE : C’EST PARTI !', '2019-07-01', 'Les travaux de transformation du terrain de foot en herbe en terrain synthétique ont démarré ce lundi.', 'Présenté lors du débat d’orientation budgétaire et acté lors du vote du budget, le projet de transformation du terrain de foot en herbe en terrain synthétique a démarré lundi 1er juillet. Les travaux prévoient la transformation du terrain en herbe en synthétique, la création d’un éclairage et d’une tribune. Fin des travaux : mi-septembre (fin octobre pour l’éclairage).\r\n\r\nCe nouvel équipement, qui vise à développer la pratique sportive sur la ville, sera accessible à un plus grand nombre d\'usagers, aux écoles, collèges et lycées, mais aussi aux enfants du club de rugby.', 'IMG_9698.jpg', NULL, 1),
(4, 'SPIDER-MAN : FAR FROM HOME S\'OFFRE QUELQUES JOLIS POSTERS AUX COULEURS DE L\'EUROPE.', '2019-07-01', 'La chaîne de cinéma Regal,dédie à Spider-Man : Far From une petite série de posters', 'Les fréquentes sorties de films Marvel Studios sont souvent l\'occasion pour les fans de se procurer diverses affiches aux couleurs de leurs héros préférés. Les partenaires directs ou indirects de la marque aiment à contribuer à cet afflux de posters inédits, souvent utilisés pour marquer le coup dans le cas des projections Imax ou Dolby, ou de générer une petite plus-value artistique dans les réseaux de salles de par le monde.\r\n\r\nLa chaîne de cinéma Regal, implantée sur 550 salles aux Etats-Unis et dans les divers territoires d\'Outre Mer de la nation étoilée, dédie à Spider-Man : Far From une petite série de posters en hommage aux capitales d\'Europe traversées par le jeune Peter Parker et sa classe dans le grand voyage scolaire qui sert d\'argument géographique à cette nouvelle aventure.\r\n \r\nDes posters \"vintage\" bien sympathiques et unis par un thème commun, à ajouter aux superbes affiches proposées par Sony aux spectateurs de Chine, un marché très important pour le Tisseur et ses dérivés. \r\n \r\nSpider-Man : Far From Home est prévu pour ce mercredi 3 juillet par chez nous.', 'Spider-Man-FarFromHome-Bann-800x445.png', 'https://www.youtube.com/embed/h6GdOpjD3Oc', 1),
(35, 'ON VA SE BAIGNER ?', '2019-06-20', 'Le droit aux vacances, pour tous. C’est pour défendre cette idée que la ville de Fleury-Mérogis, en partenariat avec l’antenne locale du Secours populaire, vous propose deux journées à Fort-Mahon-Plage (dans la Somme), les dimanche 30 juin et samedi 17 août 2019.', 'Départ à 6h de l’école Joliot-Curie. Retour vers 20h.\r\n\r\nTransport pris en charge par la mairie.\r\n\r\nPrévoir son repas.\r\n\r\nInscription obligatoire, dans la limite des places disponibles, au local du Secours populaire, rue de l’Ecoute s’il pleut, les mercredis et jeudi de 9h à 11h30.\r\n\r\nTarifs : 3 euros par enfant (gratuit pour les moins de 3 ans), 6 euros par adulte.\r\n\r\nPour la journée du 30 juin : inscriptions jusqu’au 27 juin (165 places disponibles).\r\n\r\nPour la journée du 17 août : inscriptions jusqu’au 26 juillet (275 places disponibles).\r\n\r\nRenseignements au 01 69 04 63 01', '9343.jpg', NULL, 1),
(36, 'FÊTEZ LA MUSIQUE SAMEDI 22 JUIN !', '2019-05-22', 'Le festival \"Les pieds dans l\'herbe\" 2019 sera l\'occasion pour les habitants de découvrir sur scène des artistes locaux et amateurs.', 'Le festival \"Les pieds dans l\'herbe\" 2019 sera l\'occasion pour les habitants de découvrir sur scène des artistes locaux et amateurs. Si vous avez un incroyable talent, vous pouvez aussi monter sur la scène, ouverte au public de 15h à 19h. Rendez-vous samedi 22 juin, à partir de 15h à la Pointe Verte (rue Roger-Clavier).\r\n\r\nOuverture du festival à 15h\r\n\r\n15h-19h | Scène ouverte aux artistes en herbe de la ville\r\n\r\n19h | DJ DEZIL + balances\r\n\r\n20h30 | LEEL CHRIS (pop urbaine)\r\n\r\n21h | Mathieu RUBEN - Ragga Dub Force\r\n\r\n21h30 | DIGITAL POURPRE (divers)\r\n\r\n22h10 | KIEN (rap)\r\n\r\n22h30 | Lost Fucking Mind (rock-métal)\r\n\r\n23h10 | Mikeysem + TVMCXDI (électro-rap)\r\n\r\n23h40 | GLORY\'Z (afro urban)\r\n\r\nFermeture du festival vers minuit.', 'Festival.jpg', NULL, 1),
(37, 'SORTIR À FLEURY | 3 CLOWNS | SAMEDI 16 MARS', '2019-03-10', 'Le public est-il en avance ou les clowns sont-ils en retard ?', 'Le public est-il en avance ou les clowns sont-ils en retard ?\r\n\r\nToujours est-il que les trois compères n’ont pas l’air vraiment prêts. Dans la loge, ils se remémorent le passé…\r\nC’est qu’ils ont déjà bien roulé leur bosse : à eux trois, ils cumulent 166 années ! Malgré la fatigue et l’usure, la flamme est toujours là ! Ils continuent à faire leurs numéros dans le rond de lumière. Chaque soir, ils se donnent en pâture mais la musique, ils la connaissent ! Un spectacle drôle et touchant, proposé par la cie Les Bleus de travail, qui embarque les spectateurs dans la fabuleuse histoire des arts du cirque et rend hommage au répertoire des clowns.\r\n\r\nRDV le 16/3 salle André-Malraux à 17h\r\n\r\nTout public | 6 euros / 3 euros | Rens. : 01 69 46 72 09', 'TROIS-CLOWNS.jpg', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

DROP TABLE IF EXISTS `faq`;
CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `question` varchar(256) NOT NULL,
  `answer` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`id`, `category_id`, `question`, `answer`) VALUES
(2, 1, 'comment puis-je modifier mon mot-de-passe ?', 'Rendez vous sur la page \"signaler un problème\" et sélectionnez \"Autre\". Puis indiquez que vous souhaiter un nouveau mot de passe. Il vous sera envoyé par mail dès changement.'),
(3, 2, 'Où signaler un incident dans mon quartier ?', 'Tout signalement ce fait a la page \"signaler un problème\".\r\nVous  pourrez sélectionner le motif qui correspond et précisez le problème.'),
(8, 2, 'Les motifs ne correspondent pas a mon signalement que puis-je faire ?', 'Il vous suffit de s&eacute;lectionner \"Autre\" dans les motifs et de nous expliquer votre signalement dans le bloc d\'&eacute;criture pr&eacute;vus !');

-- --------------------------------------------------------

--
-- Structure de la table `faq_category`
--

DROP TABLE IF EXISTS `faq_category`;
CREATE TABLE IF NOT EXISTS `faq_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `faq_category`
--

INSERT INTO `faq_category` (`id`, `category_name`) VALUES
(1, 'Compte'),
(2, 'Signalement');

-- --------------------------------------------------------

--
-- Structure de la table `image_galery`
--

DROP TABLE IF EXISTS `image_galery`;
CREATE TABLE IF NOT EXISTS `image_galery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `secondary_image` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `image_galery`
--

INSERT INTO `image_galery` (`id`, `event_id`, `secondary_image`) VALUES
(1, 4, 'D-FHr7sXUAAzjME.jpg'),
(2, 4, 'D-FHrlAXsAAE8YS.jpg'),
(3, 4, 'D-FHsLTXYAEUqcB.jpg'),
(4, 4, 'D-FHrNpXkAEN_UV.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `motif` int(11) NOT NULL,
  `motif_option` int(11) NOT NULL,
  `report_precision` text NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `report`
--

INSERT INTO `report` (`id`, `motif`, `motif_option`, `report_precision`, `email`) VALUES
(1, 3, 4, 'Le parc est cassé.', 'pp@caca.fr'),
(2, 1, 3, 'sa pu le caca', 'popol@p.se');

-- --------------------------------------------------------

--
-- Structure de la table `report_category`
--

DROP TABLE IF EXISTS `report_category`;
CREATE TABLE IF NOT EXISTS `report_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `motif` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `report_category`
--

INSERT INTO `report_category` (`id`, `motif`) VALUES
(1, 'Voirie'),
(2, 'signalisation'),
(3, 'Espace Vert'),
(4, 'propreté'),
(5, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `report_option`
--

DROP TABLE IF EXISTS `report_option`;
CREATE TABLE IF NOT EXISTS `report_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `motif_id` int(11) NOT NULL,
  `motif_option` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `report_option`
--

INSERT INTO `report_option` (`id`, `motif_id`, `motif_option`) VALUES
(1, 1, 'Mobiliers'),
(2, 1, 'Revêtements'),
(3, 1, 'signalisations au sol'),
(4, 3, 'Parcs'),
(5, 3, 'Squares'),
(6, 3, 'Aires de jeu'),
(7, 3, 'Espaces ornementaux'),
(8, 2, 'Feux tricolores'),
(9, 2, 'Panneaux directionnels'),
(10, 2, 'Panneaux sectorisations'),
(11, 4, 'Poubelles'),
(12, 4, 'Ramassages'),
(13, 4, 'Dégradations'),
(14, 4, 'propreté de la voirie');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `adress` varchar(256) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` int(12) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_confirmed` int(1) NOT NULL DEFAULT '0',
  `is_admin` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `birthdate`, `adress`, `email`, `phone_number`, `password`, `is_confirmed`, `is_admin`) VALUES
(1, 'admin', 'admin', NULL, 'rue de l\'admin', 'admin@hotmail.com', NULL, 'b53759f3ce692de7aff1b5779d3964da', 1, 1),
(2, 'Elie', 'Dahrouj', NULL, '5 rue de la réussite 75018 Paris', 'edarouj@hotmail.fr', NULL, 'ee11cbb19052e40b07aac0ca060c23ee', 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
