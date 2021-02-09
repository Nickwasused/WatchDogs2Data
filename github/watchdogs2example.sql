-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 09. Feb 2021 um 10:35
-- Server-Version: 10.4.17-MariaDB
-- PHP-Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `watchdogs2example`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `charactercategorys`
--

CREATE TABLE `charactercategorys` (
  `categoryid` int(11) NOT NULL,
  `categoryname` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `charactercategorys`
--

INSERT INTO `charactercategorys` (`categoryid`, `categoryname`) VALUES
(1, 'Generic'),
(2, 'Animals'),
(3, 'AFI'),
(4, 'Auntieshu'),
(5, 'Bodyguards'),
(6, 'Bratva'),
(7, 'CorruptCops'),
(8, 'Dedsec'),
(9, 'FBI'),
(10, 'GhostRidaz'),
(11, 'OPD'),
(12, 'SFPD'),
(13, 'Ragnarok'),
(14, 'Umeni'),
(15, 'Oakland'),
(16, 'SanFrancisco'),
(17, 'Ava'),
(18, 'Fla'),
(19, 'IOP'),
(20, 'Mis'),
(21, 'NPC'),
(22, 'POI'),
(23, 'NeiAlcatraz'),
(24, 'NeiBlume'),
(25, 'NeiCastro'),
(26, 'NeiChinatown'),
(27, 'NeiDocks'),
(28, 'NeiDowntown'),
(29, 'NeiDowntownWealthy'),
(30, 'NeiGalilei'),
(31, 'NeiGhetto'),
(32, 'NeiHaightashbury'),
(33, 'NeiIndustrial'),
(34, 'NeiInvite'),
(35, 'NeiMarina'),
(36, 'NeiMarin'),
(37, 'NeiMission'),
(38, 'NeiNatureBeach'),
(39, 'NeiNatureRecreational'),
(40, 'NeiNudle'),
(41, 'NeiSiliconValley'),
(42, 'NeiStanford'),
(43, 'NeiSwelterSkelter'),
(44, 'NeiTidis'),
(45, 'NeiWaterFront'),
(46, 'NeiWealthyOakland'),
(47, 'OCCDriver'),
(48, 'Marketing'),
(49, 'Debug'),
(50, 'categoryname');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `charactermodels`
--

CREATE TABLE `charactermodels` (
  `characterid` int(11) NOT NULL,
  `modelname` varchar(128) NOT NULL,
  `categoryid` int(4) NOT NULL,
  `image` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lmalayercategories`
--

CREATE TABLE `lmalayercategories` (
  `lmalayercategoryid` int(11) NOT NULL,
  `lmacategoryname` varchar(64) NOT NULL,
  `lmacategoryrealname` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `lmalayercategories`
--

INSERT INTO `lmalayercategories` (`lmalayercategoryid`, `lmacategoryname`, `lmacategoryrealname`) VALUES
(1, 'Generic', 'Generic'),
(2, 'Coop', 'Coop'),
(3, 'Drone Race', 'Drone Race'),
(4, 'IOP', 'IOP'),
(5, 'Oakwood', 'Oakwood (Town)'),
(6, 'San Francisco', 'San Francisco (Town)'),
(7, 'Silicon Valley', 'Silicon Valley'),
(8, 'Marin', 'Marin'),
(9, 'World Stories - Solo', 'Story'),
(10, 'World Stories - Light', 'L'),
(11, 'PL', 'PL'),
(12, 'Debug', 'Debug'),
(13, 'lmacategoryname', 'lmacategoryrealname');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lmalayers`
--

CREATE TABLE `lmalayers` (
  `lmalayerid` int(11) NOT NULL,
  `lmalayer` varchar(128) NOT NULL,
  `lmalocation` varchar(512) NOT NULL,
  `image` tinyint(1) NOT NULL,
  `lmalayercategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicleid` int(11) NOT NULL,
  `vehiclename` varchar(128) NOT NULL,
  `image` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `weather`
--

CREATE TABLE `weather` (
  `weatherid` int(11) NOT NULL,
  `weathername` varchar(128) NOT NULL,
  `weathervideo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `charactercategorys`
--
ALTER TABLE `charactercategorys`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indizes für die Tabelle `charactermodels`
--
ALTER TABLE `charactermodels`
  ADD PRIMARY KEY (`characterid`);

--
-- Indizes für die Tabelle `lmalayercategories`
--
ALTER TABLE `lmalayercategories`
  ADD PRIMARY KEY (`lmalayercategoryid`);

--
-- Indizes für die Tabelle `lmalayers`
--
ALTER TABLE `lmalayers`
  ADD PRIMARY KEY (`lmalayerid`),
  ADD UNIQUE KEY `lmacategoryid` (`lmalayerid`);

--
-- Indizes für die Tabelle `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicleid`);

--
-- Indizes für die Tabelle `weather`
--
ALTER TABLE `weather`
  ADD PRIMARY KEY (`weatherid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `charactercategorys`
--
ALTER TABLE `charactercategorys`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT für Tabelle `charactermodels`
--
ALTER TABLE `charactermodels`
  MODIFY `characterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7511;

--
-- AUTO_INCREMENT für Tabelle `lmalayercategories`
--
ALTER TABLE `lmalayercategories`
  MODIFY `lmalayercategoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `lmalayers`
--
ALTER TABLE `lmalayers`
  MODIFY `lmalayerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=625;

--
-- AUTO_INCREMENT für Tabelle `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT für Tabelle `weather`
--
ALTER TABLE `weather`
  MODIFY `weatherid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
