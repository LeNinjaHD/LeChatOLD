-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 23. Okt 2020 um 12:35
-- Server-Version: 10.4.13-MariaDB
-- PHP-Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `chattemplate`
--
CREATE DATABASE IF NOT EXISTS `chattemplate` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `chattemplate`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `messages`
--

CREATE TABLE `messages` (
  `id` int(255) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_german2_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `msg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `settings`
--

CREATE TABLE `settings` (
  `userid` int(255) NOT NULL,
  `mode` varchar(255) NOT NULL,
  `lang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `passwort` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `messages`
--
ALTER TABLE `messages`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`userid`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT für Tabelle `settings`
--
ALTER TABLE `settings`
  MODIFY `userid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
