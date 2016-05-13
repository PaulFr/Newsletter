-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2016 at 11:37 AM
-- Server version: 5.6.17-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `newsletter`
--

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE IF NOT EXISTS `lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE IF NOT EXISTS `newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `content` text,
  `category` varchar(255) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`users_id`),
  KEY `fk_newsletters_users_idx` (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `title`, `created`, `content`, `category`, `users_id`) VALUES
(1, 'test', '2016-03-03 11:05:02', '<p>Votre<b><u><strike> contenu</strike></u></b></p>', 'ok', 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters_lists`
--

CREATE TABLE IF NOT EXISTS `newsletters_lists` (
  `newsletters_id` int(11) NOT NULL,
  `newsletters_users_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  PRIMARY KEY (`newsletters_id`,`newsletters_users_id`,`list_id`),
  KEY `fk_newsletters_has_groups_groups1_idx` (`list_id`),
  KEY `fk_newsletters_has_groups_newsletters1_idx` (`newsletters_id`,`newsletters_users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `newsletters_subscribers`
--

CREATE TABLE IF NOT EXISTS `newsletters_subscribers` (
  `newsletters_id` int(11) NOT NULL,
  `newsletters_users_id` int(11) NOT NULL,
  `subscriber_id` int(11) NOT NULL,
  PRIMARY KEY (`newsletters_id`,`newsletters_users_id`,`subscriber_id`),
  KEY `fk_newsletters_has_clients_clients1_idx` (`subscriber_id`),
  KEY `fk_newsletters_has_clients_newsletters1_idx` (`newsletters_id`,`newsletters_users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `newsletter` tinyint(1) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `lastname`, `firstname`, `email`, `newsletter`, `created`) VALUES
(1, 'eude', '7444', 'kjjjk@jkj.fr', NULL, '2016-03-03 11:04:37'),
(3, 'keke', 'keke', 'keke@keke.com', NULL, '2016-03-03 11:18:44'),
(4, 'qsdfqsdf', 'qfqsdf', 'qsdfqsdf@sfsfd.fr', NULL, '2016-03-03 11:18:44'),
(8, 'fricnhaboy', 'paul', 'paul@paul.fr', NULL, '2016-03-03 11:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers_lists`
--

CREATE TABLE IF NOT EXISTS `subscribers_lists` (
  `list_id` int(11) NOT NULL,
  `subscriber_id` int(11) NOT NULL,
  PRIMARY KEY (`list_id`,`subscriber_id`),
  KEY `fk_groups_has_clients_clients1_idx` (`subscriber_id`),
  KEY `fk_groups_has_clients_groups1_idx` (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE IF NOT EXISTS `tracks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  `data` tinytext,
  `newsletter_id` int(11) NOT NULL,
  `subscriber_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`newsletter_id`,`subscriber_id`),
  KEY `fk_tracks_newsletters1_idx` (`newsletter_id`),
  KEY `fk_tracks_clients1_idx` (`subscriber_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `visited` datetime DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `email`, `password`, `created`, `visited`, `ip`, `group_id`) VALUES
(1, 'Frinchaboy', 'Paul', 'pfrinchaboy@gmail.com', 'b444ac06613fc8d63795be9ad0beaf55011936ac', '2016-01-22 00:00:00', '2016-01-22 16:52:16', '::1', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD CONSTRAINT `fk_newsletters_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `newsletters_lists`
--
ALTER TABLE `newsletters_lists`
  ADD CONSTRAINT `fk_newsletters_has_groups_groups1` FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_newsletters_has_groups_newsletters1` FOREIGN KEY (`newsletters_id`, `newsletters_users_id`) REFERENCES `newsletters` (`id`, `users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `newsletters_subscribers`
--
ALTER TABLE `newsletters_subscribers`
  ADD CONSTRAINT `fk_newsletters_has_clients_clients1` FOREIGN KEY (`subscriber_id`) REFERENCES `subscribers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_newsletters_has_clients_newsletters1` FOREIGN KEY (`newsletters_id`, `newsletters_users_id`) REFERENCES `newsletters` (`id`, `users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subscribers_lists`
--
ALTER TABLE `subscribers_lists`
  ADD CONSTRAINT `fk_groups_has_clients_clients1` FOREIGN KEY (`subscriber_id`) REFERENCES `subscribers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_groups_has_clients_groups1` FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tracks`
--
ALTER TABLE `tracks`
  ADD CONSTRAINT `fk_tracks_clients1` FOREIGN KEY (`subscriber_id`) REFERENCES `subscribers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tracks_newsletters1` FOREIGN KEY (`newsletter_id`) REFERENCES `newsletters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
