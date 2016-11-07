-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 07 nov 2016 kl 13:29
-- Serverversion: 10.1.16-MariaDB
-- PHP-version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `ymanager`
--
CREATE DATABASE IF NOT EXISTS `ymanager` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `ymanager`;

-- --------------------------------------------------------

--
-- Tabellstruktur `formdata`
--

CREATE TABLE `formdata` (
  `formID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `roles`
--

CREATE TABLE `roles` (
  `roleID` int(10) UNSIGNED NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `userID` int(10) UNSIGNED NOT NULL,
  `firstName` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profession` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roleID` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `formdata`
--
ALTER TABLE `formdata`
  ADD PRIMARY KEY (`formID`),
  ADD KEY `userID` (`userID`);

--
-- Index för tabell `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `roleID` (`roleID`);

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `formdata`
--
ALTER TABLE `formdata`
  ADD CONSTRAINT `formdata_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Restriktioner för tabell `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
