-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 21 Juin 2016 à 15:58
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `newsletter`
--

-- --------------------------------------------------------

--
-- Structure de la table `lists`
--

CREATE TABLE IF NOT EXISTS `lists` (
`id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lists`
--

INSERT INTO `lists` (`id`, `name`, `description`) VALUES
(1, 'Groupe du projet', 'La liste des membres du groupe du projet cochise '),
(2, 'Abonnés fidèleseee', 'liste des abonnés les plus fidèlesrrr'),
(3, 'Test', NULL),
(4, 'ma liste de batard', 'un liste de ouf magueule');

-- --------------------------------------------------------

--
-- Structure de la table `newsletters`
--

CREATE TABLE IF NOT EXISTS `newsletters` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `content` text,
  `category` varchar(255) DEFAULT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `newsletters`
--

INSERT INTO `newsletters` (`id`, `title`, `created`, `content`, `category`, `users_id`) VALUES
(1, 'test', '2016-03-03 11:05:02', '<p>Votre<b><u><strike> contenu</strike></u></b></p>', 'ok', 1),
(2, 'cacacacaca', '2016-06-10 11:21:55', '<p>Votre contenu</p>', 'qsdqsqsdqs', 1);

-- --------------------------------------------------------

--
-- Structure de la table `newsletters_lists`
--

CREATE TABLE IF NOT EXISTS `newsletters_lists` (
  `newsletters_id` int(11) NOT NULL,
  `newsletters_users_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `newsletters_subscribers`
--

CREATE TABLE IF NOT EXISTS `newsletters_subscribers` (
  `newsletters_id` int(11) NOT NULL,
  `newsletters_users_id` int(11) NOT NULL,
  `subscriber_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `subscribers`
--

CREATE TABLE IF NOT EXISTS `subscribers` (
`id` int(11) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `newsletter` tinyint(1) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `subscribers`
--

INSERT INTO `subscribers` (`id`, `lastname`, `firstname`, `email`, `newsletter`, `created`) VALUES
(3, 'keke', 'keke', 'keke@keke.com', NULL, '2016-03-03 11:18:44'),
(4, 'qsdfqsdf', 'qfqsdf', 'qsdfqsdf@sfsfd.fr', NULL, '2016-03-03 11:18:44'),
(8, 'fricnhaboy', 'paul', 'paul@paul.fr', NULL, '2016-03-03 11:20:34'),
(9, 'sanie', 'keryan', 'keryan.sanie@gmail.com', NULL, '2016-05-13 13:45:53'),
(10, NULL, NULL, 'gerard@caca.fr', NULL, '2016-06-10 10:15:28');

-- --------------------------------------------------------

--
-- Structure de la table `subscriber_lists`
--

CREATE TABLE IF NOT EXISTS `subscriber_lists` (
  `list_id` int(11) NOT NULL,
  `subscriber_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `subscriber_lists`
--

INSERT INTO `subscriber_lists` (`list_id`, `subscriber_id`) VALUES
(4, 3),
(4, 4),
(1, 8),
(2, 8),
(4, 8),
(1, 9),
(4, 9),
(4, 10);

-- --------------------------------------------------------

--
-- Structure de la table `tracks`
--

CREATE TABLE IF NOT EXISTS `tracks` (
`id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `data` tinytext,
  `newsletter_id` int(11) NOT NULL,
  `subscriber_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `visited` datetime DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `email`, `password`, `created`, `visited`, `ip`, `group_id`) VALUES
(1, 'Frinchaboy', 'Paul', 'pfrinchaboy@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2016-01-22 00:00:00', '2016-06-19 13:04:16', '::1', 1),
(3, 'sanie', 'keryan', 'keryan.sanie@gmail.com', 'aa368952d0ba4cb3de0d7426737c4ae9176c5cc4', '2016-06-10 15:31:11', NULL, NULL, NULL),
(5, 'Frinchaboy', 'Paul', 'pfrinchaboy@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2016-06-10 15:51:00', NULL, NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `lists`
--
ALTER TABLE `lists`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Index pour la table `newsletters`
--
ALTER TABLE `newsletters`
 ADD PRIMARY KEY (`id`,`users_id`), ADD KEY `fk_newsletters_users_idx` (`users_id`);

--
-- Index pour la table `newsletters_lists`
--
ALTER TABLE `newsletters_lists`
 ADD PRIMARY KEY (`newsletters_id`,`newsletters_users_id`,`list_id`), ADD KEY `fk_newsletters_has_groups_groups1_idx` (`list_id`), ADD KEY `fk_newsletters_has_groups_newsletters1_idx` (`newsletters_id`,`newsletters_users_id`);

--
-- Index pour la table `newsletters_subscribers`
--
ALTER TABLE `newsletters_subscribers`
 ADD PRIMARY KEY (`newsletters_id`,`newsletters_users_id`,`subscriber_id`), ADD KEY `fk_newsletters_has_clients_clients1_idx` (`subscriber_id`), ADD KEY `fk_newsletters_has_clients_newsletters1_idx` (`newsletters_id`,`newsletters_users_id`);

--
-- Index pour la table `subscribers`
--
ALTER TABLE `subscribers`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `subscriber_lists`
--
ALTER TABLE `subscriber_lists`
 ADD PRIMARY KEY (`list_id`,`subscriber_id`), ADD KEY `fk_groups_has_clients_clients1_idx` (`subscriber_id`), ADD KEY `fk_groups_has_clients_groups1_idx` (`list_id`);

--
-- Index pour la table `tracks`
--
ALTER TABLE `tracks`
 ADD PRIMARY KEY (`id`,`newsletter_id`,`subscriber_id`), ADD KEY `fk_tracks_newsletters1_idx` (`newsletter_id`), ADD KEY `fk_tracks_clients1_idx` (`subscriber_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `lists`
--
ALTER TABLE `lists`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `newsletters`
--
ALTER TABLE `newsletters`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `subscribers`
--
ALTER TABLE `subscribers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `tracks`
--
ALTER TABLE `tracks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `newsletters`
--
ALTER TABLE `newsletters`
ADD CONSTRAINT `fk_newsletters_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `newsletters_lists`
--
ALTER TABLE `newsletters_lists`
ADD CONSTRAINT `fk_newsletters_has_groups_groups1` FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_newsletters_has_groups_newsletters1` FOREIGN KEY (`newsletters_id`, `newsletters_users_id`) REFERENCES `newsletters` (`id`, `users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `newsletters_subscribers`
--
ALTER TABLE `newsletters_subscribers`
ADD CONSTRAINT `fk_newsletters_has_clients_clients1` FOREIGN KEY (`subscriber_id`) REFERENCES `subscribers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_newsletters_has_clients_newsletters1` FOREIGN KEY (`newsletters_id`, `newsletters_users_id`) REFERENCES `newsletters` (`id`, `users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `subscriber_lists`
--
ALTER TABLE `subscriber_lists`
ADD CONSTRAINT `fk_groups_has_clients_clients1` FOREIGN KEY (`subscriber_id`) REFERENCES `subscribers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_groups_has_clients_groups1` FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tracks`
--
ALTER TABLE `tracks`
ADD CONSTRAINT `fk_tracks_clients1` FOREIGN KEY (`subscriber_id`) REFERENCES `subscribers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tracks_newsletters1` FOREIGN KEY (`newsletter_id`) REFERENCES `newsletters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
