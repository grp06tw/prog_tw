-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Creato il: Giu 13, 2017 alle 11:43
-- Versione del server: 10.1.19-MariaDB
-- Versione PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `grp_06_db`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `azienda`
--

CREATE TABLE `azienda` (
  `ID_Azienda` int(10) NOT NULL,
  `ragione_sociale` varchar(30) COLLATE utf8_bin NOT NULL,
  `nome` varchar(30) COLLATE utf8_bin NOT NULL,
  `logo` varchar(100) COLLATE utf8_bin DEFAULT 'default.jpg',
  `citta` varchar(30) COLLATE utf8_bin NOT NULL,
  `indirizzo` varchar(100) COLLATE utf8_bin NOT NULL,
  `localizzazione` text COLLATE utf8_bin,
  `descrizione` text COLLATE utf8_bin NOT NULL,
  `ID_Utente` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `azienda`
--

INSERT INTO `azienda` (`ID_Azienda`, `ragione_sociale`, `nome`, `logo`, `citta`, `indirizzo`, `localizzazione`, `descrizione`, `ID_Utente`) VALUES
(1, 'Ariston Thermo Group', 'Ariston', 'Ariston_logo.jpg', '', 'Viale Aristide Merloni, 45\r\n60044 Fabriano (AN)', NULL, 'Ariston è un marchio di apparecchiature per il comfort termico per la casa (riscaldamento e climatizzazione) attivo dal 1960; oggi è di proprietà di Ariston Thermo Group per i prodotti per il riscaldamento acqua e domestico, e di Indesit Company per quelli elettrodomestici. Il nome Ariston deriva da quello del fondatore: Aristide Merloni.', NULL),
(2, 'Trony DPS Group ', 'Trony', 'Trony_logo.jpg', '', 'Milano, viale Cassala, 28', NULL, 'Trony è una catena italiana di negozi specializzati nella vendita di elettrodomestici, prodotti di elettronica di consumo, di informatica e telefonia. Trony è un gruppo formato da 18 soci, distribuiti su tutto il territorio nazionale, che comprende complessivamente 203 punti vendita.', NULL),
(3, 'H&M Hennes & Mauritz SRL', 'H&M', 'H&M_logo.jpg', '', 'Sede Legale: Largo Augusto n. 7 – 20122 Milano', NULL, 'H&M è un''azienda di abbigliamento svedese fondata a Vasteras in Svezia nel 1947 da Erling Persson.', NULL),
(4, 'Ducati Motor Holding SPA', 'Ducati', 'Ducati_logo.jpg', '', 'Via Cavalieri Ducati 3, 40132, Bologna', NULL, 'La Ducati Motor Holding S.p.A. è una casa motociclistica italiana. Ha la sua sede a Borgo Panigale, un quartiere di Bologna. L''azienda nacque nel 1926 per volontà dell''ingegnere Antonio Cavalieri Ducati.', NULL),
(5, 'Feltrinelli Editore SRL', 'Feltrinelli', 'Feltrinelli_logo.jpg', '', 'Via Tucidide 56, 20134, Milano', NULL, 'La Giangiacomo Feltrinelli Editore è una delle principali case editrici italiane.\r\nLa casa editrice nacque alla fine del 1954 a Milano. Ne è fondatore Giangiacomo Feltrinelli, che già nel 1949 aveva dato vita alla "Biblioteca G. Feltrinelli" per lo studio della storia contemporanea e i movimenti sociali, trasformata prima in istituto e successivamente nella Fondazione Giangiacomo Feltrinelli.', NULL),
(6, 'Coop Italia S.c.a.r.l.', 'Coop', 'Coop_logo.jpg', '', 'Via del Lavoro 6/8, 40033, Casalecchio di Reno (BO) ', NULL, 'Coop Italia, quale abbreviazione di Cooperativa di Consumatori, è un marchio che contraddistingue un sistema di cooperative italiane che gestisce una rete di superettes, supermercati ed ipermercati.', NULL),
(7, 'Decathlon Italia SRL', 'Decathlon', NULL, '', 'Sede legale Italia: Via G.Morone 4, 20121, Milano', NULL, 'Rivendita di articoli sportivi', NULL),
(8, 'GameStop Corporation SRL', 'GameStop ', 'GameStop_logo.jpg', '', 'Via dei Lavoratori 6,\r\n20092, Buccinasco (MI)', NULL, 'GameStop, è un''azienda statunitense con sede nella città di Grapevine (Texas). È il più grande rivenditore di videogiochi nuovi e usati nel mondo, ma si occupa anche della vendita di accessori per videogiochi, console ed altri apparecchi elettronici.', NULL),
(9, 'Kiko Milano SPA', 'Kiko Milano', 'Kiko_logo.jpg', '', 'Via Giorgio e Guido Paglia 1/D, 24122, Bergamo', NULL, 'KIKO Milano è una marca di cosmesi italiana che opera nel settore della cosmetica, ideata e fondata nel 1997 a Milano dal Gruppo Percassi, di proprietà di Antonio Percassi.', NULL);

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
(2, 'Abbigliamento'),
(3, 'Giardinaggio'),
(4, 'Elettrodomestici'),
(5, 'Motori'),
(6, 'Libri'),
(7, 'Alimentari'),
(8, 'Sport e Fitness'),
(9, 'Videogiochi'),
(10, 'Cosmetica'),
(13, 'prova');

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
-- Struttura della tabella `coupon`
--

CREATE TABLE `coupon` (
  `ID_Coupon` int(10) NOT NULL,
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

--
-- Dump dei dati per la tabella `faq`
--

INSERT INTO `faq` (`ID_Faq`, `domanda`, `risposta`) VALUES
(2, 'Come posso diventare partner?', 'Contattando l''amministratore il tuo utente potrà essere modificato e potrai inserire anche tu delle nuove promozioni per la tua azienda.'),
(3, 'Posso modificare le mie credenziali di accesso?', 'Sì, basta fare il login poi apparirà una sezione dove potrai modificare tutto il tuo profilo.'),
(4, 'Posso acquistare dei prodotti direttamente dal sito?', 'No, questo sito non è un e-commerce, puoi solo stampare un coupon per ottenere lo sconto che ti interessa per poi recarti nel negozio indicato per ritirare il prodotto.'),
(7, 'Come posso ottenere un nuovo coupon?', 'Cliccando su ottieni in una qualsiasi promozione, verrÃ  poi stampato il volantino che potrai portare direttamente in negozio.');

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
(1, 'Uno, nessuno e centomila', 7, 10, '2017-06-14', '2017-07-14', 'Promozione per l''acquisto del romanzo "Uno, nessuno e centomila" di Luigi Pirandello.', 'Uno_nes.jpg', 6, 5, NULL),
(3, 'Lavatrice AQUALTIS AQ83L  ', 550, 30, '2017-07-01', '2017-07-15', 'Tipo di carica: Caricamento frontale \r\nClasse efficienza energetica: A+++ \r\nCapacità cestello: 8kg\r\nVelocità di centrifuga massima: 1000 RPM', 'Lavat_ari.jpg', 4, 1, NULL),
(4, 'Sacco da boxe', 200, 10, '2017-06-15', '2017-07-24', 'Sacco autoportante per gli allenamenti piedi/pugni dei pugili di livello intermedio: boxe inglese, muay thai, kickboxing, cardio boxe. \r\nLa base da riempire d''acqua assicura una stabilità perfetta.', 'Boxe.jpg', 8, 7, NULL),
(5, 'Ducati Desmosedici RR', 60000, 5, '2017-07-16', '2017-07-23', 'Cilindrata: 989 cc\r\nPotenza: 200 cv\r\nTempi: 4\r\nCilindri: 4\r\nLunghezza: 2.100 mm\r\nPeso: 171 kg\r\nSella 830 mm', 'Des_16.jpg', 5, 4, NULL),
(6, 'Bermuda in cotone', 20, 5, '2017-06-09', '2017-06-19', 'COLORE: Cammello/fantasia\r\nTaglia: disponibile dalla 44 alla 60\r\nComposizione: 100% cotone', 'Pant_hm.jpg', 2, 3, NULL),
(7, 'Sconto Coca Cola', 3.58, 10, '2017-05-31', '2017-06-30', 'Marca: Coca-Cola\r\nBevanda Analcolica Pet Flash\r\nConfezione da: 2 Bottiglie da 1.5 Litri', 'Cola.jpg', 7, 6, NULL),
(8, 'Final Fantsy XV', 50, 15, '2017-06-15', '2017-06-30', 'Include il DLC ""Masume", una delle spade più amate della serie Final Fantasy.\r\nScenario Open world da esplorare al volante della tua auto o a piedi per scoprire il paesaggio.\r\nStringi amicizie indissolubili con i tuoi compagni e sferra attacchi coordinati in battaglia.\r\nPersonalizza le tue armi e sfrutta le abilità dei personaggi.', 'ffxv.jpg', 9, 8, NULL),
(9, 'Glitter metal nail acquer', 4.95, 20, '2017-06-11', '2017-06-17', 'Smalto per unghie con micro cristalli per un finish glitterato.', 'smalto.jpg', 10, 9, NULL),
(10, 'Condizionatore', 300, 15, '2017-06-01', '2017-06-30', 'Tipologia di condizionatore: Monosplit\r\nTipo di installazione: a parete\r\nClasse efficienza energetica: A++\r\n', 'air_c.jpg', 4, 2, NULL);

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
  `eta` int(4) NOT NULL,
  `telefono` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `indirizzo` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `role` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`ID_Utente`, `Username`, `password`, `nome`, `cognome`, `genere`, `eta`, `telefono`, `email`, `indirizzo`, `role`) VALUES
(1, 'admin', 'admin', 'amministratore', 'di prova', 'm', 1996, '', 'mailadmin@gmail.com', 'via loreto 6\r\n', 'admin'),
(2, 'staff', 'staff', 'staff', 'di prova', 'f', 1996, NULL, 'mailstaff@gmail.com', NULL, 'staff'),
(3, 'user', 'user', 'mario', 'rossi', 'm', 1987, '034958964', 'maiil@gmail.com', 'indirizzo', 'user'),
(4, 'giuseppeb', 'pass', 'Giuseppe', 'Bianchi', 'm', 1980, '12345', 'mail1@gmail.com', NULL, 'user'),
(5, 'mariar', 'pass', 'Maria', 'Russo', 'f', 1980, NULL, 'mail2@gmail.com', 'Roma, Via Portuense 39', 'user'),
(6, 'francescol', 'pass', 'Francesco', 'Ludovico', 'm', 1986, '223344', 'mail3@gmail.com', NULL, 'user'),
(7, 'lauram', 'pass', 'Laura', 'Morelli', 'f', 1968, NULL, 'mail4@gmail.com', NULL, 'user'),
(8, 'claudiab', 'pass', 'Claudia', 'Benedetti', 'f', 1976, '12344', 'mail5@gmail.com', 'Napoli, Via Brombeis 12', 'user'),
(9, 'giuliab', 'pass', 'Giulia', 'Biondini', 'f', 1996, '98765', 'mail9@gmail.com', 'Bologna, Via Zamboni 59', 'user'),
(10, 'federicoa', 'pass', 'Federico', 'Antenucci', 'm', 1975, NULL, 'mail10@gmail.com', NULL, 'user');

--
-- Indici per le tabelle scaricate
--

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
-- Indici per le tabelle `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`ID_Coupon`),
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
  ADD PRIMARY KEY (`ID_Utente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `azienda`
--
ALTER TABLE `azienda`
  MODIFY `ID_Azienda` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT per la tabella `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID_Categoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT per la tabella `combo`
--
ALTER TABLE `combo`
  MODIFY `ID_Combo` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `coupon`
--
ALTER TABLE `coupon`
  MODIFY `ID_Coupon` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `faq`
--
ALTER TABLE `faq`
  MODIFY `ID_Faq` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT per la tabella `promozione`
--
ALTER TABLE `promozione`
  MODIFY `ID_Promozione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID_Utente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `azienda`
--
ALTER TABLE `azienda`
  ADD CONSTRAINT `azienda_ibfk_1` FOREIGN KEY (`ID_Utente`) REFERENCES `utente` (`ID_Utente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `coupon_ibfk_1` FOREIGN KEY (`ID_Utente`) REFERENCES `utente` (`ID_Utente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coupon_ibfk_2` FOREIGN KEY (`ID_Combo`) REFERENCES `combo` (`ID_Combo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coupon_ibfk_3` FOREIGN KEY (`ID_Promozione`) REFERENCES `promozione` (`ID_Promozione`) ON DELETE CASCADE ON UPDATE CASCADE;

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
