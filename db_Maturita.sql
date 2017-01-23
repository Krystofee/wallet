-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Pon 23. led 2017, 19:20
-- Verze serveru: 5.6.14
-- Verze PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `Maturita`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `userID_walletID`
--

CREATE TABLE IF NOT EXISTS `userID_walletID` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `sum` int(15) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `time` (`time`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET latin1 NOT NULL,
  `password` varchar(40) CHARACTER SET latin1 NOT NULL COMMENT '40 chars podle SHA1',
  `email` varchar(30) CHARACTER SET latin1 NOT NULL,
  `birth` date NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=6 ;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `birth`, `created`, `last_login`) VALUES
(1, 'krystofee', '5ae35f9815d13f44b14fb96de9241108db126a63', 'krystofee@gmail.com', '1998-06-29', '2017-01-02 16:35:57', NULL),
(4, 'admin', '5ae35f9815d13f44b14fb96de9241108db126a63', 'krystofee@gmail.comf', '2001-11-18', '2017-01-02 16:45:54', NULL),
(5, 'testuser', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test@mail.com', '2001-11-19', '2017-01-19 13:21:28', NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `wallet`
--

CREATE TABLE IF NOT EXISTS `wallet` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `owner_id` int(30) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
