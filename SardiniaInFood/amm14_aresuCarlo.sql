-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Apr 03, 2016 alle 19:22
-- Versione del server: 5.5.35
-- Versione PHP: 5.4.6-1ubuntu1.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `amm14_aresuCarlo`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Abbonamenti`
--

CREATE TABLE IF NOT EXISTS `Abbonamenti` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_aziende` bigint(20) unsigned DEFAULT NULL,
  `data_pagamento` varchar(32) DEFAULT NULL,
  `interruttore` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_aziende` (`id_aziende`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `Attivita`
--

CREATE TABLE IF NOT EXISTS `Attivita` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dump dei dati per la tabella `Attivita`
--

INSERT INTO `Attivita` (`id`, `tipo`) VALUES
(1, 'Agriturismo'),
(2, 'American Bar'),
(3, 'Bar Caffè'),
(4, 'Birreria'),
(5, 'Bistrot'),
(6, 'Fast Food'),
(7, 'Gelateria'),
(8, 'Osteria'),
(9, 'Pasticceria'),
(10, 'Pizzeria'),
(11, 'Pub'),
(12, 'Ristorante'),
(13, 'Self Service'),
(14, 'Snack Bar'),
(15, 'Take Away'),
(16, 'Trattoria'),
(17, 'Altro');

-- --------------------------------------------------------

--
-- Struttura della tabella `Aziende`
--

CREATE TABLE IF NOT EXISTS `Aziende` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(128) DEFAULT NULL,
  `tipo_incarichi_id` bigint(20) unsigned DEFAULT NULL,
  `email_conferma` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `nome_azienda` varchar(128) DEFAULT NULL,
  `citta` varchar(128) DEFAULT NULL,
  `indirizzo` varchar(128) DEFAULT NULL,
  `tipo_attivita_id` bigint(20) unsigned DEFAULT NULL,
  `descrizione` varchar(200) DEFAULT NULL,
  `telefono` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `sito_web` varchar(128) DEFAULT NULL,
  `ruolo` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_incarichi_id` (`tipo_incarichi_id`),
  KEY `tipo_attivita_id` (`tipo_attivita_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `Aziende`
--

INSERT INTO `Aziende` (`id`, `nome_completo`, `tipo_incarichi_id`, `email_conferma`, `username`, `password`, `nome_azienda`, `citta`, `indirizzo`, `tipo_attivita_id`, `descrizione`, `telefono`, `email`, `sito_web`, `ruolo`) VALUES
(1, 'Gigi', 1, 'gigi@email.it', 'gigi', '111', 'pear', 'miami', 'ocean drive', 17, 'descrizione di pear', '000000000', 'pear@email.it', 'www.pear.it', 1),
(2, 'Franco', 1, 'franco@email.it', 'franco', '111', 'book', 'miami', '5th street', 17, 'descrizione book', '111111111', 'book@email.it', 'www.book.it', 1),
(3, 'Piera', 1, 'piera@email.it', 'piera', '111', 'table', 'miami', '10th street', 17, 'descrizione table', '22222222', 'table@email.it', 'www.table.it', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Aziende_Servizi`
--

CREATE TABLE IF NOT EXISTS `Aziende_Servizi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_aziende` bigint(20) unsigned DEFAULT NULL,
  `id_servizi` bigint(20) unsigned DEFAULT NULL,
  `valore` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_aziende` (`id_aziende`),
  KEY `id_servizi` (`id_servizi`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `Aziende_Servizi`
--

INSERT INTO `Aziende_Servizi` (`id`, `id_aziende`, `id_servizi`, `valore`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 3, 1, 0),
(4, 3, 2, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `Clienti`
--

CREATE TABLE IF NOT EXISTS `Clienti` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `email_conferma` varchar(128) DEFAULT NULL,
  `ruolo` int(1) DEFAULT NULL,
  `numero_richiami` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `Clienti`
--

INSERT INTO `Clienti` (`id`, `nome_completo`, `username`, `password`, `email_conferma`, `ruolo`, `numero_richiami`) VALUES
(2, 'gigi', 'gigi', '111', 'gigi@email.it', 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `Incarichi`
--

CREATE TABLE IF NOT EXISTS `Incarichi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `Incarichi`
--

INSERT INTO `Incarichi` (`id`, `tipo`) VALUES
(1, 'Proprietario'),
(2, 'Dirigente Generale'),
(3, 'Consulente'),
(4, 'Altro');

-- --------------------------------------------------------

--
-- Struttura della tabella `Preferiti`
--

CREATE TABLE IF NOT EXISTS `Preferiti` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_aziende` bigint(20) unsigned DEFAULT NULL,
  `id_clienti` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_aziende` (`id_aziende`),
  KEY `id_clienti` (`id_clienti`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `Preferiti`
--

INSERT INTO `Preferiti` (`id`, `id_aziende`, `id_clienti`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `Qualita_Prezzo`
--

CREATE TABLE IF NOT EXISTS `Qualita_Prezzo` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_aziende` bigint(20) unsigned DEFAULT NULL,
  `id_clienti` bigint(20) unsigned DEFAULT NULL,
  `voto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_aziende` (`id_aziende`),
  KEY `id_clienti` (`id_clienti`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `Recensioni`
--

CREATE TABLE IF NOT EXISTS `Recensioni` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_aziende` bigint(20) unsigned DEFAULT NULL,
  `id_clienti` bigint(20) unsigned DEFAULT NULL,
  `data` varchar(32) DEFAULT NULL,
  `recensione` varchar(200) DEFAULT NULL,
  `numero_segnalazioni` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_aziende` (`id_aziende`),
  KEY `id_clienti` (`id_clienti`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `Recensioni`
--

INSERT INTO `Recensioni` (`id`, `id_aziende`, `id_clienti`, `data`, `recensione`, `numero_segnalazioni`) VALUES
(1, 2, 2, '01/04/2016 - 17:32', 'lakjdfalkdjalkdjfalkjflakf', 0),
(2, 3, 2, '01/04/2016 - 17:54', 'questa recensione Ã¨ stata inserita correttamente', 0),
(3, 1, 2, '01/04/2016 - 19:17', 'test nuovo inserimento', 0),
(4, 3, 2, '02/04/2016 - 15:54', 'questo Ã¨ un altro test spero vada a buon fine', 1),
(5, 3, 2, '02/04/2016 - 17:59', 'test inserimento ulteriore commento', 0),
(6, 3, 2, '03/04/2016', 'questo Ã¨ un altro test sperando che tutto vada bene', 0),
(7, 3, 2, '03/04/2016', 'COMMENTO 5', 1),
(8, 3, 2, '03/04/2016', 'COMMENTO 6', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `Segnalazioni`
--

CREATE TABLE IF NOT EXISTS `Segnalazioni` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_recensioni` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_recensioni` (`id_recensioni`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dump dei dati per la tabella `Segnalazioni`
--

INSERT INTO `Segnalazioni` (`id`, `id_recensioni`) VALUES
(14, 4),
(11, 7),
(12, 8),
(13, 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `Servizi`
--

CREATE TABLE IF NOT EXISTS `Servizi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dump dei dati per la tabella `Servizi`
--

INSERT INTO `Servizi` (`id`, `tipo`) VALUES
(1, 'Accesso disabili'),
(2, 'Accetta carte di credito'),
(3, 'Accetta prenotazioni'),
(4, 'Bagno diponibile'),
(5, 'Bancomat'),
(6, 'Bevande alcoliche'),
(7, 'Catering'),
(8, 'Consegna a domicilio'),
(9, 'Da asporto'),
(10, 'Guardaroba disponibile'),
(11, 'Musica'),
(12, 'Parcheggio auto'),
(13, 'Parcheggio bici'),
(14, 'Per fumatori'),
(15, 'Posti a sedere all''aperto'),
(16, 'Stanza privata'),
(17, 'Tv'),
(18, 'Wi-Fi');

-- --------------------------------------------------------

--
-- Struttura della tabella `Statistiche`
--

CREATE TABLE IF NOT EXISTS `Statistiche` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_aziende` bigint(20) unsigned DEFAULT NULL,
  `visualizzazioni` int(11) DEFAULT NULL,
  `media_voto` float DEFAULT NULL,
  `numero_voti` int(11) NOT NULL,
  `media_rapporto_qualita_prezzo` float DEFAULT NULL,
  `numero_voti_qualita_prezzo` int(11) NOT NULL,
  `numero_preferenze` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_aziende` (`id_aziende`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `Statistiche`
--

INSERT INTO `Statistiche` (`id`, `id_aziende`, `visualizzazioni`, `media_voto`, `numero_voti`, `media_rapporto_qualita_prezzo`, `numero_voti_qualita_prezzo`, `numero_preferenze`) VALUES
(1, 1, 27, 5, 1, 0, 0, 1),
(2, 2, 14, 0, 0, 0, 0, 0),
(3, 3, 95, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `Voti`
--

CREATE TABLE IF NOT EXISTS `Voti` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_aziende` bigint(20) unsigned DEFAULT NULL,
  `id_clienti` bigint(20) unsigned DEFAULT NULL,
  `voto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_clienti` (`id_clienti`),
  KEY `id_aziende` (`id_aziende`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Abbonamenti`
--
ALTER TABLE `Abbonamenti`
  ADD CONSTRAINT `Abbonamenti_ibfk_1` FOREIGN KEY (`id_aziende`) REFERENCES `Aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Aziende`
--
ALTER TABLE `Aziende`
  ADD CONSTRAINT `Aziende_ibfk_1` FOREIGN KEY (`tipo_incarichi_id`) REFERENCES `Incarichi` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Aziende_ibfk_2` FOREIGN KEY (`tipo_attivita_id`) REFERENCES `Attivita` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Aziende_ibfk_3` FOREIGN KEY (`tipo_attivita_id`) REFERENCES `Attivita` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `Aziende_Servizi`
--
ALTER TABLE `Aziende_Servizi`
  ADD CONSTRAINT `Aziende_Servizi_ibfk_1` FOREIGN KEY (`id_aziende`) REFERENCES `Aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Aziende_Servizi_ibfk_2` FOREIGN KEY (`id_servizi`) REFERENCES `Servizi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Aziende_Servizi_ibfk_3` FOREIGN KEY (`id_servizi`) REFERENCES `Servizi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Preferiti`
--
ALTER TABLE `Preferiti`
  ADD CONSTRAINT `Preferiti_ibfk_1` FOREIGN KEY (`id_aziende`) REFERENCES `Aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Preferiti_ibfk_2` FOREIGN KEY (`id_clienti`) REFERENCES `Clienti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Preferiti_ibfk_3` FOREIGN KEY (`id_clienti`) REFERENCES `Clienti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Qualita_Prezzo`
--
ALTER TABLE `Qualita_Prezzo`
  ADD CONSTRAINT `Qualita_Prezzo_ibfk_1` FOREIGN KEY (`id_aziende`) REFERENCES `Aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Qualita_Prezzo_ibfk_2` FOREIGN KEY (`id_clienti`) REFERENCES `Clienti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Qualita_Prezzo_ibfk_3` FOREIGN KEY (`id_clienti`) REFERENCES `Clienti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Recensioni`
--
ALTER TABLE `Recensioni`
  ADD CONSTRAINT `Recensioni_ibfk_1` FOREIGN KEY (`id_aziende`) REFERENCES `Aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Recensioni_ibfk_2` FOREIGN KEY (`id_clienti`) REFERENCES `Clienti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Recensioni_ibfk_3` FOREIGN KEY (`id_clienti`) REFERENCES `Clienti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Segnalazioni`
--
ALTER TABLE `Segnalazioni`
  ADD CONSTRAINT `Segnalazioni_ibfk_1` FOREIGN KEY (`id_recensioni`) REFERENCES `Recensioni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Statistiche`
--
ALTER TABLE `Statistiche`
  ADD CONSTRAINT `Statistiche_ibfk_1` FOREIGN KEY (`id_aziende`) REFERENCES `Aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Voti`
--
ALTER TABLE `Voti`
  ADD CONSTRAINT `Voti_ibfk_1` FOREIGN KEY (`id_clienti`) REFERENCES `Clienti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Voti_ibfk_2` FOREIGN KEY (`id_aziende`) REFERENCES `Aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Voti_ibfk_3` FOREIGN KEY (`id_aziende`) REFERENCES `Aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
