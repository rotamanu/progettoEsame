-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Mag 29, 2022 alle 18:07
-- Versione del server: 5.7.36
-- Versione PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rotaspa`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti`
--

DROP TABLE IF EXISTS `prodotti`;
CREATE TABLE IF NOT EXISTS `prodotti` (
  `codice` varchar(255) NOT NULL,
  `codice_esterno` varchar(255) NOT NULL,
  `componente_a` varchar(255) NOT NULL,
  `componente_b` varchar(255) NOT NULL,
  `componente_c` varchar(255) NOT NULL,
  `componente_d` varchar(255) NOT NULL,
  `disegno` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `montato_su` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `anteriore` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `prodotti`
--

INSERT INTO `prodotti` (`codice`, `codice_esterno`, `componente_a`, `componente_b`, `componente_c`, `componente_d`, `disegno`, `foto`, `montato_su`, `marca`, `level`, `anteriore`) VALUES
('0000', '15468ab', '1', '2', '3', '4', '../../___disegni_tecnici_esame/disegno_1.jpg', '0', '5', 'Toyota', '5', '9'),
('0001', '15487bf', '1', '2', '3', '4', '../../___disegni_tecnici_esame/disegno_2.jpg', '0', '4', 'Ferrari', '4', '9'),
('0002', '15499cf', '1', '2', '3', '4', '../../___disegni_tecnici_esame/disegno_3.jpg', '0', '5', 'Porche', '5', '6'),
('0003', '65414we', '1', '2', '3', '4', '../../___disegni_tecnici_esame/disegno_4.jpg', '0', '6', 'Bmw', '9', '6'),
('0004', '51465aa', '1', '2', '3', '4', '../../___disegni_tecnici_esame/disegno_5.jpg', '0', '4', 'Bmw', '8', '8'),
('0005', '84198qq', '1', '2', '3', '4', '../../___disegni_tecnici_esame/disegno_6.jpg', '0', '7', 'Audi', '2', '5'),
('0006', '65141fz', '1', '2', '3', '4', '../../___disegni_tecnici_esame/disegno_7.jpg', '0', '8', 'Lancia', '3', '8'),
('0007', '74897ps', '1', '2', '3', '4', '../../___disegni_tecnici_esame/disegno_8.jpg', '0', '9', 'Fiat', '1', '7'),
('0008', '14981ld', '1', '2', '3', '4', '../../___disegni_tecnici_esame/disegno_9.jpg', '0', '8', 'Fiat', '4', '7'),
('0009', '74198br', '1', '2', '3', '4', '../../___disegni_tecnici_esame/disegno_10.jpg', '0', '7', 'generico', '4', '9'),
('0010', '74987hs', '1', '2', '3', '4', '../../___disegni_tecnici_esame/disegno_11.jpg', '0', '5', 'generico', '7', '3');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

DROP TABLE IF EXISTS `utenti`;
CREATE TABLE IF NOT EXISTS `utenti` (
  `matricola` tinyint(1) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `amministratore` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`matricola`, `username`, `password`, `amministratore`) VALUES
(0, 'Davide', '0123', 0),
(1, 'Manu', '0000', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
