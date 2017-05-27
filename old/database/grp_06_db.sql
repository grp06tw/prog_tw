-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Creato il: Mag 27, 2017 alle 16:16
-- Versione del server: 10.1.19-MariaDB
-- Versione PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grp_06_db`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `acl`
--

CREATE TABLE `acl` (
  `ID_acl` int(1) NOT NULL,
  `classe` varchar(15) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `azienda`
--

CREATE TABLE `azienda` (
  `ID_Azienda` int(10) NOT NULL,
  `ragione_sociale` varchar(30) COLLATE utf8_bin NOT NULL,
  `nome` varchar(30) COLLATE utf8_bin NOT NULL,
  `logo` varchar(100) COLLATE utf8_bin DEFAULT 'default.jpg',
  `indirizzo` varchar(100) COLLATE utf8_bin NOT NULL,
  `localizzazione` text COLLATE utf8_bin,
  `descrizione` text COLLATE utf8_bin NOT NULL,
  `ID_Utente` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `azienda`
--

INSERT INTO `azienda` (`ID_Azienda`, `ragione_sociale`, `nome`, `logo`, `indirizzo`, `localizzazione`, `descrizione`, `ID_Utente`) VALUES
(1, 'ragionesociale', 'nomeAzienda', 'default.jpg', 'indirizzo', NULL, 'descrizione', NULL),
(2, 'ragioneAzienda2', 'nomeAzienda"', 'default.jpg', 'indirizzo2', NULL, 'descrizione seconda azienda', NULL),
(3, 'ragione sociale', 'azienda3ciaociao', 'default.jpg', 'indrizzoazienda3', 'civnhdoisfcmdjvnugfjmò,kfh', 'decsrizione azienda 3 che non fa niente  ma m serve per riempi', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `ID_Categoria` int(10) NOT NULL,
  `nome` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`ID_Categoria`, `nome`) VALUES
(1, 'Elettronica'),
(2, 'Abbigliamento'),
(3, 'Giardinaggio');

-- --------------------------------------------------------

--
-- Struttura della tabella `combo`
--

CREATE TABLE `combo` (
  `ID_Combo` int(10) NOT NULL,
  `sconto` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `cupon`
--

CREATE TABLE `cupon` (
  `ID_Cupon` int(10) NOT NULL,
  `ID_Utente` int(10) NOT NULL,
  `ID_Promozione` int(10) DEFAULT NULL,
  `ID_Combo` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `faq`
--

CREATE TABLE `faq` (
  `ID_Faq` int(10) NOT NULL,
  `domanda` text COLLATE utf8_bin NOT NULL,
  `risposta` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `promozione`
--

CREATE TABLE `promozione` (
  `ID_Promozione` int(11) NOT NULL,
  `titolo` varchar(30) COLLATE utf8_bin NOT NULL,
  `prezzo` float NOT NULL,
  `sconto` int(2) NOT NULL,
  `inizio` date NOT NULL,
  `fine` date NOT NULL,
  `descrizione` text COLLATE utf8_bin NOT NULL,
  `immagine` varchar(100) COLLATE utf8_bin DEFAULT 'default.jpg',
  `ID_Categoria` int(10) NOT NULL,
  `ID_Azienda` int(10) NOT NULL,
  `ID_Combo` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `promozione`
--

INSERT INTO `promozione` (`ID_Promozione`, `titolo`, `prezzo`, `sconto`, `inizio`, `fine`, `descrizione`, `immagine`, `ID_Categoria`, `ID_Azienda`, `ID_Combo`) VALUES
(1, 'promozione1', 10000, 10, '2017-05-09', '2018-05-31', 'pomozione per l''acquisto di un bel niente scontato', 'default.jpg', 1, 2, NULL),
(2, 'promo2', 222, 10, '2017-05-15', '2017-12-24', 'fgrtjykuhhgyjthrgjkkht', 'default.jpg', 2, 2, NULL),
(3, 'promo3', 45, 7, '2017-05-16', '2017-12-24', 'm,iokjbhgvrederftgyhujikiytrc', 'default.jpg', 3, 1, NULL),
(4, 'promo4', 222, 50, '2017-05-15', '2017-12-24', 'fgrtjykuhhgyjthrgjkkht', 'default.jpg', 2, 2, NULL),
(5, 'promo5', 45, 3, '2017-05-16', '2017-12-24', 'm,iokjbhgvrederftgyhujikiytrc', 'default.jpg', 3, 1, NULL),
(6, 'nuovaprov', 5483, 60, '0000-00-00', '0000-00-00', 'pronsjifbblfsjhiljnks', NULL, 2, 3, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `ID_Utente` int(10) NOT NULL,
  `Username` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(30) COLLATE utf8_bin NOT NULL,
  `nome` varchar(30) COLLATE utf8_bin NOT NULL,
  `cognome` varchar(30) COLLATE utf8_bin NOT NULL,
  `genere` varchar(1) COLLATE utf8_bin NOT NULL,
  `eta` int(3) NOT NULL,
  `telefono` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `indirizzo` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `role` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`ID_Utente`, `Username`, `password`, `nome`, `cognome`, `genere`, `eta`, `telefono`, `email`, `indirizzo`, `role`) VALUES
(1, 'admin', 'admin', 'ammministratore', 'di prova', 'm', 20, NULL, 'mail', NULL, 'admin'),
(2, 'staff', 'staff', 'staff', 'di prova', 'f', 20, NULL, 'mailstaff', NULL, 'staff'),
(3, 'user', 'user', 'mario', 'rossi', 'm', 30, '0349', 'maiil', 'indirizzo', 'role');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `acl`
--
ALTER TABLE `acl`
  ADD PRIMARY KEY (`ID_acl`);

--
-- Indici per le tabelle `azienda`
--
ALTER TABLE `azienda`
  ADD PRIMARY KEY (`ID_Azienda`),
  ADD KEY `ID_Utente` (`ID_Utente`);

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_Categoria`);

--
-- Indici per le tabelle `combo`
--
ALTER TABLE `combo`
  ADD PRIMARY KEY (`ID_Combo`);

--
-- Indici per le tabelle `cupon`
--
ALTER TABLE `cupon`
  ADD PRIMARY KEY (`ID_Cupon`),
  ADD KEY `ID_Utente` (`ID_Utente`),
  ADD KEY `ID_Promozione` (`ID_Promozione`),
  ADD KEY `ID_Combo` (`ID_Combo`);

--
-- Indici per le tabelle `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`ID_Faq`);

--
-- Indici per le tabelle `promozione`
--
ALTER TABLE `promozione`
  ADD PRIMARY KEY (`ID_Promozione`),
  ADD KEY `ID_Categoria` (`ID_Categoria`),
  ADD KEY `ID_Azienda` (`ID_Azienda`),
  ADD KEY `ID_Combo` (`ID_Combo`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID_Utente`),
  ADD KEY `ID_acl` (`role`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `acl`
--
ALTER TABLE `acl`
  MODIFY `ID_acl` int(1) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `azienda`
--
ALTER TABLE `azienda`
  MODIFY `ID_Azienda` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT per la tabella `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID_Categoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT per la tabella `combo`
--
ALTER TABLE `combo`
  MODIFY `ID_Combo` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `cupon`
--
ALTER TABLE `cupon`
  MODIFY `ID_Cupon` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `faq`
--
ALTER TABLE `faq`
  MODIFY `ID_Faq` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `promozione`
--
ALTER TABLE `promozione`
  MODIFY `ID_Promozione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID_Utente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `azienda`
--
ALTER TABLE `azienda`
  ADD CONSTRAINT `azienda_ibfk_1` FOREIGN KEY (`ID_Utente`) REFERENCES `utente` (`ID_Utente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `cupon`
--
ALTER TABLE `cupon`
  ADD CONSTRAINT `cupon_ibfk_1` FOREIGN KEY (`ID_Utente`) REFERENCES `utente` (`ID_Utente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cupon_ibfk_2` FOREIGN KEY (`ID_Combo`) REFERENCES `combo` (`ID_Combo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cupon_ibfk_3` FOREIGN KEY (`ID_Promozione`) REFERENCES `promozione` (`ID_Promozione`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `promozione`
--
ALTER TABLE `promozione`
  ADD CONSTRAINT `promozione_ibfk_1` FOREIGN KEY (`ID_Combo`) REFERENCES `combo` (`ID_Combo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promozione_ibfk_2` FOREIGN KEY (`ID_Azienda`) REFERENCES `azienda` (`ID_Azienda`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promozione_ibfk_3` FOREIGN KEY (`ID_Categoria`) REFERENCES `categoria` (`ID_Categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
