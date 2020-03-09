-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 09 mars 2020 à 13:40
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `formationphp`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `bio` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`id`, `nom`, `prenom`, `bio`) VALUES
(1, 'Pratchett', 'Terry', '<p>\r\n<strong>Terry Pratchett</strong> est un écrivain britannique né le 28 avril 1948 à Beaconsfield (Buckinghamshire) et mort le 12 mars 20152 à Broad Chalke (Wiltshire). Il est principalement connu pour ses romans de fantasy humoristique prenant place dans l\'univers du Disque-monde, dans lequel il détourne les canons du genre pour se livrer à une satire de divers aspects de la société contemporaine.\r\n</p>\r\n<p>\r\nPratchett publie son premier roman en 1971, mais ce n\'est qu\'en 1983 qu\'il rencontre vraiment le succès avec le premier volume des Annales du Disque-monde. Il devient par la suite l\'un des auteurs de fantasy les plus prolifiques (les Annales comptent plus de trente tomes) et les plus appréciés (ses livres se sont vendus à plus de 65 millions d\'exemplaires). Pratchett est ainsi l\'auteur britannique le plus vendu des années 1990. Selon un sondage publié en 2006 dans le magazine littéraire britannique Book Magazine, Terry Pratchett est alors le second auteur vivant le plus apprécié de ses compatriotes, derrière J. K. Rowling.\r\n</p>\r\n<p>\r\nIl est anobli par la reine en 2008, et reçoit de nombreuses récompenses pour son ?uvre. Atteint d\'une forme rare de la maladie d\'Alzheimer, il milite pendant ses dernières années en faveur du droit au suicide assisté, notamment dans son documentaire Choosing to Die.\r\n</p>'),
(2, 'Williams', 'Tad', 'Auteur fantasy'),
(3, 'Gaiman', 'Neil', '<p>\r\n<strong>Neil Gaiman</strong>, né le 10 novembre 1960 à Portchester en Angleterre, est un auteur britannique de romans et de scénarios de bande dessinée vivant aux États-Unis. Auteur prolifique et polyvalent, il a percé sur la scène du fantastique anglo-saxon grâce à sa série Sandman publiée par DC comics dans les années 1990. \r\n</p>\r\n<p>\r\nNeil Gaiman naît le 10 novembre 1960 à Portchester, dans une famille juive originaire de la Pologne. Son arrière grand-père paternel a quitté Anvers pour émigrer au Royaume Uni avant 19143. Son grand-père s\'est installé à Portsmouth et a fondé une chaine d\'épiceries. Son père David Bernard Gaiman était promoteur immobilier, sa mère, née Sheila Goldman, était pharmacienne. Neil a deux jeunes s?urs, Claire et Lizzy. En 1965, sa famille a déménagé à East Grinstead, où ses parents ont étudié la dianétique au Centre de scientologie local. Son père est devenu une sommité dans le milieu scientologue ; une de ses s?urs travaille pour l\'église de scientologie à Los Angeles. Neil lui-même n\'est pas un scientologue tout en se disant solidaire de la religion de sa famille.\r\n</p>\r\n<p>\r\nDans sa jeunesse, il est très attiré par les comics. Après avoir vu certains de ses manuscrits refusés par plusieurs éditeurs, il commence en 1984 une carrière de journalisme qu\'il abandonnera trois ans plus tard. Il écrit alors son premier livre, la désormais très recherchée biographie du groupe Duran Duran (1984) ainsi que de nombreux articles pour Knave magazine. Il fait ses débuts littéraires en pastichant des auteurs qu\'il aime : la biographie de Douglas Adams dans le style de Douglas Adams (1988), la nouvelle We Can Get Them for You Wholesale dans le style de John Collier, A Study in Emerald dans le style de H.P. Lovecraft. Il trouve finalement son propre style à l\'âge de 26 ans en écrivant le roman graphique Violent Cases, illustré par Dave McKean, dont l\'histoire reprend un épisode de son enfance.\r\n</p>\r\n<p>\r\nSon intérêt pour les comics renaît lorsqu\'il découvre, en 1984, le Swamp Thing d\'Alan Moore, qui était alors en train de transformer le comic book en une ?uvre littéraire à dimension psychologique. Profitant de son statut de journaliste, il se met à fréquenter les congrès de fantasy. C\'est ainsi qu\'il rencontre Alan Moore, qui l\'initie à la technique du roman graphique. Gaiman rédige pour DC Comics la mini-série Orchidée noire, publiée en 1987. L\'année suivante, Karen Berger, rédactrice en chef de DC Comics l\'invite à créer sa propre version de Sandman, en réinventant un mensuel qui avait été populaire en 1974-76. Gaiman publiera 75 numéros de Sandman entre 1988 et 1996.\r\n</p>\r\n<p>\r\nIl collaborera avec Terry Pratchett sur De bons présages (Good Omens), à propos de l\'imminence de l\'apocalypse.\r\n</p>\r\n<p>\r\nIl écrit deux autres romans graphiques anglais avec son vieil ami et collaborateur favori Dave McKean : Signal / Bruit (1993), suivi par The Tragical Comedy or Comical Tragedy of Mr. Punch (1994).\r\n</p>\r\n<p>\r\nIl a eu trois enfants avec son ex-femme Mary McGrath. Dans les années 1990, il s\'installe avec elle dans une maison victorienne au Wisconsin, en pleine campagne. American Gods résulte du choc culturel qu\'il a alors éprouvé en quittant l\'Angleterre pour les États-Unis : il imagine que les immigrants apportent avec eux les divinités de leur pays d\'origine pour ensuite les abandonner au fil des ans.\r\n</p>\r\n<p>\r\nIl est marié à Amanda Palmer depuis le 2 janvier 2011.\r\n</p>\r\n<p>\r\nDepuis 2013, il attire l\'attention du public sur le problème des réfugiés et travaille à aider ces derniers. En février 2017, il est nommé Ambassadeur de bonne volonté du HCR par l\'Agence des Nations-Unies pour les réfugiés.\r\n</p>\r\n<p>\r\nDepuis ses débuts littéraires, Neil Gaiman a écrit et publié plusieurs centaines de textes, d\'essais et introductions. Parmi ceux-ci, il a écrit une magistrale défense des bibliothèques, des bibliothécaires et de la lecture lors d\'une conférence donnée le 14 octobre 2013 à l?invitation de la Reading Agency, au Barbican Centre de Londres. Acte militant pour dénoncer la fermeture de nombreuses bibliothèques en Angleterre. Le texte est librement téléchargeable sur le site de son éditeur français Au Diable Vauvert et s\'intitule : « Pourquoi notre futur dépend des bibliothèques, de la lecture et de l?imagination ». \r\n</p>'),
(4, 'Moore', 'Alan', 'Auteur de comics adultes.'),
(5, 'King', 'Stephen', 'Il a commencé jeune.<br />\r\nIl a écrit des dizaines de livres<br />\r\nIl n\'a toujours pas arrêté.'),
(6, 'Adams', 'Douglas', '<p>\r\n<strong>Douglas Noel Adams</strong>, né le 11 mars 1952 à Cambridge et mort le 11 mai 2001 (à 49 ans) à Santa Barbara, est un écrivain et scénariste britannique.\r\n</p>\r\n<p>\r\nIl est surtout connu pour son ?uvre Le Guide du voyageur galactique (The Hitchhiker\'s Guide to the Galaxy), une saga de science-fiction humoristique dont il scénarisa le feuilleton radio original puis écrivit la « trilogie en cinq volumes » de romans.\r\n</p>\r\n<p>\r\nDouglas Adams est né en 1952 à Cambridge. Il est le fils d\'un étudiant en théologie et d\'une infirmière. Après de nombreux petits boulots tels que portier dans un hôpital psychiatrique, nettoyeur d\'abris à poulets ou garde du corps, il entre à l\'université de Cambridge et tente d\'intégrer l\'équipe des Footlights, la troupe dont sont issus les Monty Python. De cette époque, il garde des liens solides avec Graham Chapman, avec qui il travaille deux ans, et Terry Jones. Il participe à l\'écriture de sketchs pour l\'émission Monty Python\'s Flying Circus et y fait parfois de la figuration.\r\n</p>\r\n<p>\r\nÀ 25 ans, Douglas propose à la BBC une série radio intitulée The Hitchhiker\'s Guide to the Galaxy, dont le premier des douze épisodes est diffusé le 8 avril 1978. Cette série devient rapidement culte. Parallèlement, il écrit son premier script pour la télévision pour la série Doctor Who avec l\'épisode « The Pirate Planet. » Le succès du Hitchhiker dope la carrière de Douglas Adams qui devient producteur sur BBC Radio 4 et « script editor » (métier consistant à planifier et superviser à des fins de cohérence les scénarios d\'une série, à la manière d\'une script girl qui assure pour sa part le seul raccord des scènes) sur Doctor Who et écrira le scénario de deux épisodes, « City of Death » et « Shada ». Il collabore aussi à la série animée Docteur Snuggles.\r\n</p>\r\n<p>\r\nEn 1979, Douglas Adams publie le premier tome du cycle H2G2, Le Guide du routard galactique dont le nom sera changé ultérieurement ? à la demande expresse des Éditions du Routard ? et deviendra Le Guide du voyageur galactique. La série comprendra en tout cinq volumes (le dernier a été publié en 1992). H2G2 est adapté sur scène (en pièce de théâtre, en comédie musicale), en série télévisée et en jeu vidéo, adaptations auxquelles Douglas Adams participe activement. H2G2 est aussi adapté en bande dessinée par DC Comics mais l\'auteur ne s\'intéresse guère à cette adaptation, ce qui lui vaut sans doute un succès moindre. Enfin, un film dont l\'écriture a été commencée par Douglas Adams lui-même est sorti le 29 avril 2005 aux États-Unis et le 17 août en France (sous le titre H2G2 : Le Guide du voyageur galactique).\r\n</p>\r\n<p>\r\nDans le domaine du jeu vidéo, Douglas Adams est l\'auteur d\'une adaptation de H2G2 (Infocom, 1984) et d\'un jeu original baptisé Bureaucracy (Infocom, 1987). Il revient aux jeux vidéo en 1999 avec Starship Titanic publié par sa propre compagnie The Digital Village. Un roman du même nom, associé à ce jeu, est écrit par Terry Jones. Douglas Adams était aussi un grand fan des jeux vidéo de vie artificielle Creatures.\r\n</p>\r\n<p>\r\nIl est également grand amateur de musique (ses goûts vont de Bach aux Beatles) et guitariste à ses heures (il dispose d\'ailleurs à la fin de sa vie d\'une jolie collection d\'une vingtaine de guitares pour gaucher). Profondément marqué par la culture rock, Douglas a voulu casser, avec H2G2, le moule de la comédie classique de la BBC en créant un feuilleton inspiré des innovations rock de l\'époque (l\'Album blanc des Beatles par exemple). Son amour pour la musique l\'a amené à se lier avec plusieurs musiciens (dont David Gilmour, guitariste de Pink Floyd). Pour ses 42 ans, Douglas a eu pour cadeau d\'anniversaire une invitation à jouer deux morceaux sur la célèbre scène du Earls Court à Londres avec Pink Floyd.\r\n</p>\r\n<p>\r\nDouglas Adams se définissait lui-même comme athée radical, et était aussi passionné par les conséquences de la découverte de Darwin que son ami Richard Dawkins, qui prononcera en 2001 son oraison funèbre.\r\nTombe au cimetière de Highgate.\r\n</p>\r\n<p>\r\nEn mai 2001, Douglas Adams meurt à 49 ans, d\'une crise cardiaque en Californie où il venait de s\'installer avec sa femme et sa fille pour collaborer à l\'adaptation cinématographique du Guide du voyageur galactique, dont il ne vit donc jamais le résultat. Depuis, tous les 25 mai, est célébré le Towel Day en hommage à l\'écrivain. Il est enterré à Londres, au cimetière de Highgate.\r\n</p>\r\n<p>\r\nLe 11 mars 2013, un Google Doodle est créé en hommage au soixante-et-unième anniversaire de sa naissance\r\n</p>'),
(7, 'Bordage', 'Pierre', '<p>\r\n<strong>Pierre Bordage</strong>, né le 29 janvier 1955 à La Réorthe, en Vendée, est un auteur de science-fiction français. C\'est avec sa trilogie Les Guerriers du silence, publiée aux éditions de l\'Atalante et vendue à 50 000 exemplaires, qu\'il rencontre le succès. Ce space opera ainsi que le cycle de Wang sont salués par la critique littéraire comme des ?uvres majeures du renouveau de la science-fiction française des années 1990, genre qui était alors dominé par les auteurs anglophones.\r\n<p>\r\n</p>\r\nAu fil de ses publications, Pierre Bordage acquiert la notoriété et une reconnaissance parmi les meilleurs romanciers populaires français. Auteur d\'une quarantaine d\'ouvrages ainsi que de nouvelles, publiés chez différents éditeurs (notamment Au diable vauvert) et de différents genres (fantasy historique avec L\'Enjomineur, science fantasy avec Les Fables de l\'Humpur, polar, etc.), il a aussi conçu des novélisations et réalisé quelques scénarios pour le cinéma, pour ensuite s\'essayer à l\'adaptation théâtrale, ainsi qu\'à celle de sa propre ?uvre en bande dessinée.\r\n</p>\r\n<p>\r\nLes ouvrages de Pierre Bordage ont une orientation humaniste, axée sur la découverte de la spiritualité, la lutte contre le fanatisme, ou encore le détournement du pouvoir politico-religieux au profit de quelques-uns. Bien qu\'issu de la science-fiction, il travaille davantage sur ses personnages que sur la science et les technologies qu\'il met en scène, et s\'inspire des épopées et des mythologies du monde entier.\r\n</p>\r\n<p>\r\nPierre Bordage a reçu de nombreux prix littéraires tels que le grand prix de l\'Imaginaire (1993) et le grand prix Paul-Féval de littérature populaire (2000). \r\n</p>');

-- --------------------------------------------------------

--
-- Structure de la table `auteur_livre`
--

DROP TABLE IF EXISTS `auteur_livre`;
CREATE TABLE IF NOT EXISTS `auteur_livre` (
  `idauteur` int(11) NOT NULL,
  `idlivre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `auteur_livre`
--

INSERT INTO `auteur_livre` (`idauteur`, `idlivre`) VALUES
(1, 3),
(3, 3),
(3, 17),
(1, 18),
(6, 1),
(6, 9),
(7, 2),
(10, 19),
(10, 20),
(11, 19),
(11, 20);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) DEFAULT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `resume` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `utilisateur_id`, `titre`, `date`, `resume`) VALUES
(1, 1, 'Le Guide du voyageur galactique ', '2020-03-03 11:50:00', '<p>\r\n<strong>Le Guide du voyageur galactique</strong> (titre original : The Hitchhiker\'s Guide to the Galaxy, abrégé notamment en H2G2) est une oeuvre de science-fiction humoristique multidisciplinaire imaginée par l\'écrivain britannique Douglas Adams. Son nom provient de l\'objet symbolique de la série : un livre électronique intitulé Le Guide du voyageur galactique. Née en 1978 sous forme de feuilleton radiophonique, l\'oeuvre a depuis été déclinée dans de nombreux médias au cours de différentes adaptations : romans, pièces de théâtre, série télévisée, jeux vidéo, bande dessinée, long métrage pour le cinéma.\r\n</p>'),
(2, NULL, 'Wang - Les portes d\'occident - Les aigles d\'orient', '2020-03-03 12:06:00', '<p>\r\n<strong>Les Portes d\'Occident</strong>\r\n</p>\r\n<p>\r\n<p>\r\nUnivers historique et politique<br />\r\nNous sommes en 2212. La Terre est partagée en quatre grands territoires politiques :\r\n</p>\r\n<ul>\r\n<li>l\'Occident, soit les États-Unis et l\'Europe occidentale, y compris la Grèce, plus Israël ;</li>\r\n<li>la République populaire sino-russe (RPSR), soit toute l\'Asie et l\'Europe orientale ;</li>\r\n<li>la Grande nation de l\'islam (GNI), soit l\'Afrique et le Moyen-Orient ;</li>\r\n<li>le territoire des Sudams, soit l\'Amérique latine.</li>\r\n</ul>\r\n<p>\r\nLes États-Unis n\'ont plus leur ascendance d\'antan, et la langue internationale est le français. Dans la RPSR, la lingua franca est le frenchy, une variante du français.<br />\r\nLes États-Unis n\'ont plus leur ascendance d\'antan, et la langue internationale est le français. Dans la RPSR, la lingua franca est le frenchy, une variante du français.\r\n</p>\r\n<p>\r\nHistoriquement, les Occidentaux, devant une invasion imminente de la Chine, ont édifié un immense rideau électromagnétique (le REM) absolument infranchissable. Ce rideau, invention d\'un Français, ferme toute la frontière de l\'Occident. Sa hauteur paraît infinie, et on dit qu\'il se rend assez loin en profondeur pour qu\'il soit impossible de traverser la limite par un tunnel. Les soldats chinois, arrêtés par le rideau, n\'ont pas été rapatriés par leur gouvernement et sont donc restés sur la frontière, notamment dans la province de Pologne et dans les autres provinces de l\'ancienne Europe occidentale. Le roman débute quelques générations après ces événements, et on retrouve donc en Europe orientale une population très mélangée. Par ailleurs, diverses manipulations des Occidentaux ont eu pour effet de priver la République sino-russe de toute technologie et de la plonger dans une misère extrême, où se loger et se nourrir relèvent de l\'exploit. Les deux autres territoires, avec quelques variantes, ont connu des sorts similaires. Il en résulte un monde où l\'Occident vit dans une grande opulence et profite d\'une technologie très avancée, tandis que le reste de la planète peine à survivre. Le REM empêche toujours toute invasion, et même toute immigration.\r\n</p>\r\n<p>\r\nIl existe cependant deux « portes » par lesquelles il est possible de s\'évader de la RPSR pour passer à l\'Occident. Ces portes s\'ouvrent chaque année pendant quelques heures seulement. Chaque fois, c\'est la cohue pour les franchir. Pourtant il se raconte des choses épouvantables sur le sort des Sino-Russes passés à l\'Occident, mais nul n\'est revenu pour les confirmer ou les infirmer.\r\n</p>\r\n<p>\r\nDe fait, l\'Occident se passionne de son côté pour les Jeux uchroniques, remettant en scène de grandes batailles de l\'Histoire (voir uchronie) en utilisant les immigrants comme « chair à canon ». Ces défis opposent de grands champions stratèges (challengeur contre défendeur) soutenus par les différents pays de l\'Organisation des nations occidentales (ONO). L\'influence de ces jeux empiète largement sur la sphère politique.\r\nUnivers technologique\r\n</p>\r\n<p>\r\nEn Occident, la télévision a depuis longtemps été remplacée par le « sensor ». Celui-ci a la forme d\'une cabine où le « sensoreur » s\'assoit nu et pose des capteurs à divers endroits sur son corps. Une fois la chose faite, il ne lui reste plus qu\'à choisir un canal qui lui fera non pas seulement voir, mais entendre et sentir des expériences externes, qu\'il s\'agisse de la façon dont se sent le tigre qui court, ou les sensations d\'un combattant. On peut aussi se brancher sur des satellites qui nous feront voir ce qui se passe n\'importe où sur la terre.\r\n</p>\r\n<p>\r\nLes Jeux uchroniques, qui ont lieu aux deux ans, sont ainsi retransmis dans tout l\'Occident, et chacun peut s\'installer dans son sensor et choisir tel ou tel canal pour vivre la bataille exactement comme s\'il y était, dans la peau d\'un commandant ou d\'un simple soldat. Le sensoreur ressentira les mêmes émotions (peur, exaltation) et les mêmes douleurs physiques que la personne sur laquelle il se branchera. Il s\'agit d\'un loisir extrêmement populaire, où se mêlent des enjeux politiques et autres; notamment, la mode vestimentaire change tous les deux ans pour imiter celle de l\'époque et de la culture du camp ayant remporté les Jeux.\r\n</p>\r\n<p>\r\nLes immigrants, quant à eux, se font implanter dans le front un genre de voyant lumineux qui est branché sur leur cerveau et par lequel les autorités occidentales peuvent leur donner la mort instantanément en cas d\'écart de conduite (ex. : comportement belliqueux ou agressif, ou infraction aux règles pendant les Jeux).\r\nIntrigue\r\n</p>\r\n<p>\r\nLa RPSR, dénuée d\'État digne de ce nom, vit sous la férule des néo-triades, genre de mafia sanguinaire. Ayant contracté une dette envers ces néo-triades, Wang quitte le Grand-Wroc?aw (province de Pologne) et passe en Occident pour échapper à un sort terrible. Malgré son jeune âge (17 ans), il sera engagé dans l\'armée du Français Frédric Alexandre pour combattre dans les JU face à l\'armée des Américains. C\'est le défendeur américain qui choisit le thème de JU : il a choisi de rejouer la guerre des Gaules, en se donnant le rôle des Romains. Les Français, dans le rôle des Gaulois, sont ainsi désavantagés, d\'autant plus que la préparation des Jeux connaît plusieurs ratés de leur côté.\r\n</p>\r\n<p>\r\n<strong>Les Aigles d\'Orient</strong><br />\r\nWang est devenu le chef de camp du défi français et la coqueluche des occidentaux. Avec l\'aide du réseau sensolibertaire, il tente d\'abattre le REM et de retourner chez lui accompagné de Lhassa, qu\'il a retrouvée. \r\n</p>'),
(3, 1, 'De bons présages', '2020-03-03 12:07:00', '<p>\r\n<strong>De bons présages</strong> (titre original : Good Omens, ou Good Omens: The Nice and Accurate Prophecies of Agnes Nutter, Witch) est un roman de fantasy écrit par Terry Pratchett et Neil Gaiman, et paru en 1990.\r\n</p>\r\n<p>\r\nCe roman peut ainsi être considéré comme une parodie du film La Malédiction (The Omen en version originale), écrit par David Seltzer en 1976 et d\'autres livres et films du même genre. Ce roman raconte la naissance du fils de Satan, l\'arrivée de la Fin des temps et les tentatives de l\'ange Aziraphale et du démon Rampa (Crowley dans la version originale) pour les empêcher, s\'étant habitués à leurs situations confortables sur Terre.\r\n</p>\r\n<p>\r\nUne intrigue secondaire concerne le rassemblement des quatre cavaliers de l\'Apocalypse Guerre, Famine, Pollution (Pestilence ayant pris sa retraite en 1936 après la découverte de la pénicilline), et Mort ce dernier étant caractérisé de la même manière que la personnification de la Mort dans la série du Disque-monde de Pratchett. \r\n</p>'),
(9, NULL, 'La vie, l\'univers et le reste.', '2020-03-03 14:28:37', 'Livre de Douglas Adams du guide du routard galactique. haha'),
(7, 1, 'De l\'autre côté du miroir', '2020-03-03 13:42:27', 'Alice retourne voir là-bas si j\'y suis.<br />C\'est le livre d\'après'),
(16, NULL, 'Le trône du dragon', '2020-03-06 14:47:00', NULL),
(17, NULL, 'Miroirs et fumées', '2020-03-06 14:49:00', '<p>\r\n<strong>Miroirs et fumée</strong> (titre original: Smoke and Mirrors) est un recueil qui regroupe différentes nouvelles de Neil Gaiman préalablement publiées dans des anthologies, des revues au autre. Parmi ces nouvelles se sont notamment fait remarquer Les Mystères du meurtre qui raconte les bouleversements qui ont lieu à la suite de la découverte du corps d\'un ange au Paradis, Chevalerie où une vieille dame achète sans le savoir le Saint-Graal dans une boutique d\'occasion et Galaad se montre à sa porte ou encore Neige, verre et pommes qui est une nouvelle version de Blanche-Neige pour public averti.\r\n</p>\r\n<p>\r\nUne des nouvelles se trouve cachée au sein de l\'introduction. \r\n</p>\r\n<p>\r\nContenu :\r\n</p>\r\n<ol>\r\n    <li>Lire les entrailles : un rondeau (Reading the Entrails : a Rondel)</li>\r\n    <li>Une introduction (Introduction)</li>\r\n    <li>Chevalerie (Chivalry)</li>\r\n    <li>Nicholas était... (Nicholas Was...)</li>\r\n    <li>Le Prix (The Price)</li>\r\n    <li>Le Troll sous le pont (Troll Bridge)</li>\r\n    <li>Ne demandez rien au Diable (Don\'t Ask Jack)</li>\r\n    <li>Le Bassin aux poissons et autres contes (The Goldfish Pool and Other Stories)</li>\r\n    <li>La Route blanche (The White Road)</li>\r\n    <li>La Reine d\'épées (Queen of Knives)</li>\r\n    <li>Changements (Changes)</li>\r\n    <li>La Fille des chouettes (The Daughter of Owls)</li>\r\n    <li>La Spéciale des Shoggoths à l\'ancienne (Shoggoth\'s Old Peculiar)</li>\r\n    <li>Virus (Virus)</li>\r\n    <li>Cherchez la fille (Looking for the Girl)</li>\r\n    <li>Une fin du monde de plus (Only the End of the World Again)</li>\r\n    <li>Alerte : animal à bout (Bay Wolf)</li>\r\n    <li>On peut vous les faire au prix de gros (We Can Get Them for you Wholesale)</li>\r\n    <li>Une vie, meublée en Moorcock première manière (One Life, Furnished in Early Moorcock)</li>\r\n    <li>Couleurs froides (Cold Colors)</li>\r\n    <li>Le Balayeur de rêves (The Sweeper of Dreams)</li>\r\n    <li>Corps étrangers (Foreign Parts)</li>\r\n    <li>Sizain vampire (Vampire Sestina)</li>\r\n    <li>La Souris (Mouse)</li>\r\n    <li>Le Changement de mer (The Sea Change)</li>\r\n    <li>Le Jour où nous sommes allés voir la fin du monde (When We Went to See the End of the World)</li>\r\n    <li>Vent du désert (Desert Wind)</li>\r\n    <li>Saveurs (Tastings)</li>\r\n    <li>Mignons à croquer (Babycakes)</li>\r\n    <li>Les Mystères du meurtre (Murder Mysteries)</li>\r\n    <li>Neige, verre et pommes (Snow, Glass, Apples)</li>\r\n</ol>'),
(18, 1, 'Au guet !', '2020-03-06 16:21:07', '<p>\r\n<strong>Au guet !</strong> est le huitième livre des Annales du Disque-monde de l\'écrivain anglais Terry Pratchett et publié en France en 1997. Traduit par Patrick Couton, il fut publié en France en 1997 chez L\'Atalante (ISBN 2-84172-045-4) et en 2000 chez Pocket (ISBN 2-266-09970-1). L\'?uvre originale fut publiée en 1989 sous le titre Guards! Guards!.\r\n</p>\r\n<p>\r\nUne adaptation en bande dessinée est à l\'heure actuelle en cours de production chez Atalante. \r\n</p>');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `motdepasse` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `pseudo`, `email`, `motdepasse`) VALUES
(1, 'Duflot', 'Nicolas', 'nikko', 'nduflot@jehann.fr', '21232f297a57a5a743894a0e4a801fc3');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
