-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Mar 05, 2016 alle 00:10
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `facebook` varchar(128) DEFAULT NULL,
  `twitter` varchar(128) DEFAULT NULL,
  `instagram` varchar(128) DEFAULT NULL,
  `ruolo` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_incarichi_id` (`tipo_incarichi_id`),
  KEY `tipo_attivita_id` (`tipo_attivita_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `Aziende_Servizi`
--

CREATE TABLE IF NOT EXISTS `Aziende_Servizi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_aziende` bigint(20) unsigned DEFAULT NULL,
  `id_servizi` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_aziende` (`id_aziende`),
  KEY `id_servizi` (`id_servizi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `Incarichi`
--

CREATE TABLE IF NOT EXISTS `Incarichi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `Segnalazioni`
--

CREATE TABLE IF NOT EXISTS `Segnalazioni` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_recensioni` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_recensioni` (`id_recensioni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `Servizi`
--

CREATE TABLE IF NOT EXISTS `Servizi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `Statistiche`
--

CREATE TABLE IF NOT EXISTS `Statistiche` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_aziende` bigint(20) unsigned DEFAULT NULL,
  `visualizzazioni` int(11) DEFAULT NULL,
  `media_voto` float DEFAULT NULL,
  `rapporto_qualita_prezzo` float DEFAULT NULL,
  `numero_preferenze` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_aziende` (`id_aziende`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
