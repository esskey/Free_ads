-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 29 Mars 2015 à 21:25
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `free_ads`
--
CREATE DATABASE IF NOT EXISTS `free_ads` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `free_ads`;

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE IF NOT EXISTS `annonces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `categorie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prix` int(11) NOT NULL,
  `activate` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `annonces`
--

INSERT INTO `annonces` (`id`, `user_id`, `titre`, `description`, `categorie`, `prix`, `activate`, `created_at`, `updated_at`) VALUES
(1, 1, 'Audii-A3', 'Je vend une Audii A3 \r\nfonctionnalité: \r\n -gente allu\r\n -transmission automatique\r\n -Vitre teinte\r\n -Intérieur cuire\r\n \r\ncontactez moi par message pour plus d''infos ', 'vehicules', 15000, 1, '2015-03-29 16:40:48', '2015-03-29 16:40:48'),
(2, 2, 'Koala', 'Voici le koala que j''ai eu a mes 18 ans , je le vend ', 'vehicules', 115, 1, '2015-03-29 16:45:46', '2015-03-29 16:45:46'),
(3, 3, 'paysage', 'je vend ces paysage MDRRRR', 'vehicules', 15644, 1, '2015-03-29 16:51:48', '2015-03-29 16:51:48');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_sender` int(11) NOT NULL,
  `user_id_receiver` int(11) NOT NULL,
  `object` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activate_sender` int(11) NOT NULL DEFAULT '1',
  `activate_receiver` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `user_id_sender`, `user_id_receiver`, `object`, `content`, `activate_sender`, `activate_receiver`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Achat', 'je suis très interressé par ce produit ..comment pourrai-je vous contactez Samir ??? \r\nCordialement', 1, 1, '2015-03-29 16:43:40', '2015-03-29 16:43:40'),
(2, 3, 1, 'coup de coeur', 'J''adore cette voiture je la veux !!!!!! ', 1, 1, '2015-03-29 16:50:03', '2015-03-29 16:50:03'),
(3, 3, 2, 'incomprehension', 'Je ne comprend pas cette vente !! =O', 1, 1, '2015-03-29 16:51:07', '2015-03-29 16:51:07');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_03_23_100116_create_users_table', 1),
('2015_03_23_162749_create_annonces_table', 1),
('2015_03_24_113654_create_photos_table', 1),
('2015_03_27_081844_create_message_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `annonce_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activate` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Contenu de la table `photos`
--

INSERT INTO `photos` (`id`, `user_id`, `annonce_id`, `nom`, `activate`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Audi_A3_Sportback_TDI184_17.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 1, 'audii.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 1, 'essai-audi-a3-2.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 1, 'screenshot_ad88e-raw.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 2, 2, 'Koala.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 3, 3, 'Desert.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 3, 3, 'Lighthouse.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 3, 3, 'Tulips.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` datetime NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `activate` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `birthdate`, `email`, `remember_token`, `activate`, `created_at`, `updated_at`) VALUES
(1, 'samir', '$2y$10$W4QjMmKe7zy2BNAoFWrjM.QlnMHuh9lQh/Qv1fYvpB1UJYOGy7qPK', 'Samir', 'Azzouz', '1984-02-23 00:00:00', 'test@gmail.com', 'VGSHtpKh6Fmdup3sSvvE8ZQOv2dEFXEpzm3SLsJJziAqDSAJQ55T9AdxZ9dA', 1, '2015-03-29 16:18:21', '2015-03-29 16:54:01'),
(2, 'esskey', '$2y$10$kdA/SaB8cdRjOjz7bWHyRO0RnmM0t5W68LNpfshQoVob8lucVIE9y', 'Nair', 'Mouhoussoune', '1992-07-25 00:00:00', 'esskey@gmail.com', 'sUPFVebrrZ00Eg8FbwnjtIDJApGy0F8vt3AzuQmwoxQdnw3ahfBzY00rdr6a', 1, '2015-03-29 16:42:46', '2015-03-29 17:25:05'),
(3, 'polo33', '$2y$10$KjhQp9P4fH6M/Y.zkN1a1OU.LtzUVIeatm7I4bxsjLoZTxjHP2bDy', 'Marc', 'Pitalo', '2000-12-29 00:00:00', 'polo_dolo@gmail.com', 'LX4yFPEh9hvgMe1iOmnBxsle1Rn0OpLVBgOE8Qg2S3wyeHI8QuMA6PngygLc', 1, '2015-03-29 16:46:28', '2015-03-29 16:52:22');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
