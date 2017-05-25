-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Creato il: Mag 25, 2017 alle 16:06
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

--
-- Svuota la tabella prima dell'inserimento `acl`
--

TRUNCATE TABLE `acl`;
--
-- Dump dei dati per la tabella `acl`
--

INSERT INTO `acl` (`ID_acl`, `classe`) VALUES
(1, 'user'),
(2, 'staff'),
(3, 'admin');

--
-- Svuota la tabella prima dell'inserimento `azienda`
--

TRUNCATE TABLE `azienda`;
--
-- Dump dei dati per la tabella `azienda`
--

INSERT INTO `azienda` (`ID_Azienda`, `ragione_sociale`, `nome`, `logo`, `indirizzo`, `localizzazione`, `descrizione`, `ID_Utente`) VALUES
(1, 'ragionesociale', 'nomeAzienda', 'default.jpg', 'indirizzo', NULL, 'descrizione', NULL),
(2, 'ragioneAzienda2', 'nomeAzienda"', 'default.jpg', 'indirizzo2', NULL, 'descrizione seconda azienda', NULL),
(3, 'ragione sociale', 'azienda3ciaociao', 'default.jpg', 'indrizzoazienda3', 'civnhdoisfcmdjvnugfjmò,kfh', 'decsrizione azienda 3 che non fa niente  ma m serve per riempi', NULL);

--
-- Svuota la tabella prima dell'inserimento `categoria`
--

TRUNCATE TABLE `categoria`;
--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`ID_Categoria`, `nome`) VALUES
(1, 'Elettronica'),
(2, 'Abbigliamento'),
(3, 'Giardinaggio');

--
-- Svuota la tabella prima dell'inserimento `combo`
--

TRUNCATE TABLE `combo`;
--
-- Svuota la tabella prima dell'inserimento `cupon`
--

TRUNCATE TABLE `cupon`;
--
-- Svuota la tabella prima dell'inserimento `faq`
--

TRUNCATE TABLE `faq`;
--
-- Svuota la tabella prima dell'inserimento `promozione`
--

TRUNCATE TABLE `promozione`;
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

--
-- Svuota la tabella prima dell'inserimento `utente`
--

TRUNCATE TABLE `utente`;
--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`ID_Utente`, `Username`, `password`, `nome`, `cognome`, `genere`, `eta`, `telefono`, `email`, `indirizzo`, `ID_acl`) VALUES
(1, 'admin', 'admin', 'ammministratore', 'di prova', 'm', 20, NULL, 'mail', NULL, 3),
(2, 'staff', 'staff', 'staff', 'di prova', 'f', 20, NULL, 'mailstaff', NULL, 2),
(3, 'user', 'user', 'mario', 'rossi', 'm', 30, '0349', 'maiil', 'indirizzo', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
