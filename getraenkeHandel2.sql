-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 04. Jan 2023 um 22:50
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Datenbank: `getraenkehandel2`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel`
--

CREATE TABLE `artikel` (
  `ArtikelID` int(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `artikelNummer` int(11) NOT NULL,
  `inhalt` float NOT NULL,
  `preis` float NOT NULL,
  `onStock` varchar(8) NOT NULL,
  `path` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `artikel`
--

INSERT INTO `artikel` (`ArtikelID`, `name`, `artikelNummer`, `inhalt`, `preis`, `onStock`, `path`) VALUES
(1, 'Coca Cola Original 1l', 1000, 1, 1.5, '0', '../images/coca_cola.png'),
(2, 'Fanta 1l', 1001, 1, 1.5, '10', '../images/fanta.png'),
(3, 'Sprite 1l', 1002, 1, 1.5, '20', '../images/sprite.png'),
(4, 'Mezzo Mix 1l', 1003, 1, 1.5, '14', '../images/mezzo_mix.png'),
(5, 'Red Bull', 1004, 0.25, 1.69, '48', '../images/red_bull.png'),
(6, 'Arizona White Tea', 1005, 0.5, 1.89, '24', '../images/arizona_white_tea.png'),
(7, 'Arizona Pomegranete', 1006, 0.5, 1.89, '18', '../images/arizona_pomegranete.png'),
(8, 'Arizona Fruit Punch', 1007, 0.5, 1.89, '30', '../images/arizona_fruit_punch.png'),
(9, 'Vio Medium 0.5l', 1008, 0.5, 1.09, '48', '../images/vio_mineralwasser.png'),
(10, 'Vio Still 0.5l', 1009, 0.5, 1.09, '48', '../images/vio_still.png');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellitem`
--

CREATE TABLE `bestellitem` (
  `BestellItemID` int(64) NOT NULL,
  `BestellID` int(64) NOT NULL,
  `ArtikelID` int(64) NOT NULL,
  `Menge` int(64) NOT NULL,
  `PositionsPreis` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `bestellitem`
--

INSERT INTO `bestellitem` (`BestellItemID`, `BestellID`, `ArtikelID`, `Menge`, `PositionsPreis`) VALUES
(27, 7, 1, 25, 30),
(28, 7, 2, 25, 30),
(29, 7, 3, 1, 1.5),
(30, 7, 4, 4, 6),
(31, 8, 1, 25, 30),
(32, 8, 2, 45, 54),
(33, 8, 3, 1, 1.5),
(34, 8, 4, 4, 6),
(35, 9, 1, 25, 30),
(36, 9, 2, 45, 54),
(37, 9, 3, 1, 1.5),
(38, 9, 4, 4, 6),
(39, 10, 1, 25, 30),
(40, 10, 2, 45, 54),
(41, 10, 3, 1, 1.5),
(42, 10, 4, 4, 6),
(43, 11, 1, 25, 30),
(44, 11, 2, 45, 54),
(45, 11, 3, 1, 1.5),
(46, 11, 4, 4, 6),
(47, 12, 1, 25, 30),
(48, 12, 2, 45, 54),
(49, 12, 3, 1, 1.5),
(50, 12, 4, 4, 6),
(51, 13, 1, 25, 30),
(52, 13, 2, 45, 54),
(53, 13, 3, 1, 1.5),
(54, 13, 4, 4, 6),
(55, 14, 1, 25, 30),
(56, 14, 2, 45, 54),
(57, 14, 3, 1, 1.5),
(58, 14, 4, 4, 6),
(59, 15, 1, 25, 30),
(60, 15, 2, 45, 54),
(61, 15, 3, 1, 1.5),
(62, 15, 4, 4, 6),
(63, 16, 1, 25, 30),
(64, 16, 2, 45, 54),
(65, 16, 3, 1, 1.5),
(66, 16, 4, 4, 6),
(67, 17, 1, 1, 1.5),
(68, 18, 2, 6, 8.1),
(69, 18, 3, 4, 6),
(70, 19, 1, 10, 12),
(71, 20, 2, 25, 30),
(72, 21, 1, 15, 18),
(73, 22, 1, 25, 30);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung`
--

CREATE TABLE `bestellung` (
  `BestellID` int(64) NOT NULL,
  `UserID` int(64) NOT NULL,
  `Gesamtpreis` double NOT NULL,
  `Versandpreis` double NOT NULL,
  `Versandart` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `bestellung`
--

INSERT INTO `bestellung` (`BestellID`, `UserID`, `Gesamtpreis`, `Versandpreis`, `Versandart`) VALUES
(7, 5, 67.5, 0, ''),
(8, 5, 91.5, 0, ''),
(9, 5, 91.5, 0, ''),
(10, 5, 91.5, 0, ''),
(11, 5, 91.5, 0, ''),
(12, 5, 91.5, 0, ''),
(13, 5, 91.5, 0, ''),
(14, 5, 91.5, 0, ''),
(15, 5, 91.5, 0, ''),
(16, 5, 91.5, 0, ''),
(17, 5, 1.5, 0, ''),
(18, 5, 14.1, 48, 'DHL Express'),
(19, 5, 12, 6, 'DPD'),
(20, 5, 30, 6, 'DPD'),
(21, 5, 18, 6, 'DPD'),
(22, 5, 30, 6, 'DPD');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kunde`
--

CREATE TABLE `kunde` (
  `UserID` int(64) NOT NULL,
  `vorname` varchar(64) NOT NULL,
  `nachname` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastLogin` varchar(64) NOT NULL,
  `online` int(11) NOT NULL,
  `street` varchar(64) NOT NULL,
  `plz` varchar(16) NOT NULL,
  `city` varchar(64) NOT NULL,
  `land` varchar(16) NOT NULL,
  `hasNewPassword` varchar(1) NOT NULL,
  `secret` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `kunde`
--

INSERT INTO `kunde` (`UserID`, `vorname`, `nachname`, `email`, `password`, `lastLogin`, `online`, `street`, `plz`, `city`, `land`, `hasNewPassword`, `secret`) VALUES
(1, 'Marios', 'Tzialidis', 'test@test.de', 'c6ee9e33cf5c6715a1d148fd73f7318884b41adcb916021e2bc0e800a5c5dd97f5142178f6ae88c8fdd98e1afb0ce4c8d2c54b5f37b30b7da1997bb33b0b8a31', 'Wed, 14 Dec 2022 17:24:03 +0100', 0, 'Hausstrasse 12', '72072', 'Tübingen', 'Deutschland', '1', ''),
(2, 'Kevin', 'Koch', 'kevin@koch.de', 'c84dd703', 'Tue, 15 Nov 2022 13:04:34 +0100', 0, 'Hausstrasse 2', '72074', 'Tübingen', 'Deutschland', '0', ''),
(3, 'Kevin', 'Koch', 'Kevinkoch1997@yahoo.de', '353116a1', 'Tue, 20 Dec 2022 14:14:02 +0100', 0, 'Freudenstädterstraße 50', '72250', 'Freudenstadt', 'Deutschland', '0', 'IVPAR37HOKQYGBSJ'),
(4, 'Kevin', 'Koch', 'Kevinkoch1997@yahoo.de', '57d07d07', 'Tue, 20 Dec 2022 14:26:06 +0100', 0, 'Freudenstädterstr 50', '72250', 'FDS', 'Deutschland', '0', 'TH7MFWFMDYLRH5JY'),
(5, 'Kevin', 'Koch', 'Kevinkoch1997@gmail.com', '0044f4acc463f69d72f8632fc07751139ef0a37cfc67c772740aa32f3da4078cbc3275a81f155a6ff5305a7bcd736da6470491fedfdb718f1f969da3f5c58cdb', 'Tue, 03 Jan 2023 23:44:20 +0100', 0, 'fdsstr50', '72250', 'fds', 'Deutschland', '1', 'XBORGT7CQCLTLIYQ');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`, `time`) VALUES
(1, 'test@test.de', 'Wed, 14 Dec 2022 19:15:33 +0100');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `warenkorb`
--

CREATE TABLE `warenkorb` (
  `WarenkorbID` int(8) NOT NULL,
  `ArtikelID` int(8) NOT NULL,
  `UserID` int(8) NOT NULL,
  `Menge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`ArtikelID`),
  ADD UNIQUE KEY `artikelNummer` (`artikelNummer`);

--
-- Indizes für die Tabelle `bestellitem`
--
ALTER TABLE `bestellitem`
  ADD PRIMARY KEY (`BestellItemID`);

--
-- Indizes für die Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  ADD PRIMARY KEY (`BestellID`);

--
-- Indizes für die Tabelle `kunde`
--
ALTER TABLE `kunde`
  ADD PRIMARY KEY (`UserID`);

--
-- Indizes für die Tabelle `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indizes für die Tabelle `warenkorb`
--
ALTER TABLE `warenkorb`
  ADD PRIMARY KEY (`WarenkorbID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `artikel`
--
ALTER TABLE `artikel`
  MODIFY `ArtikelID` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `bestellitem`
--
ALTER TABLE `bestellitem`
  MODIFY `BestellItemID` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT für Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  MODIFY `BestellID` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT für Tabelle `kunde`
--
ALTER TABLE `kunde`
  MODIFY `UserID` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `warenkorb`
--
ALTER TABLE `warenkorb`
  MODIFY `WarenkorbID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;
