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
('1111', '15468ab', '1', '1', '1', '1', '../../___disegni_tecnici_esame/disegno_1.jpg', '../../___disegni_tecnici_esame/disegno_12.jpg', 'SUV', 'Toyota', 'A', '1'),
('2222', '15487bf', '2', '2', '2', '2', '../../___disegni_tecnici_esame/disegno_2.jpg', '../../___disegni_tecnici_esame/disegno_13.jpg', 'CAR', 'Ferrari', 'A', '1'),
('3333', '15499cf', '3', '3', '3', '3', '../../___disegni_tecnici_esame/disegno_3.jpg', '../../___disegni_tecnici_esame/disegno_14.jpg', 'MONO', 'Porche', 'B', '0'),
('4444', '65414we', '4', '4', '4', '4', '../../___disegni_tecnici_esame/disegno_4.jpg', '../../___disegni_tecnici_esame/disegno_15.jpg', 'MOTO', 'Bmw', 'B', '0'),
('5555', '51465aa', '5', '5', '5', '5', '../../___disegni_tecnici_esame/disegno_5.jpg', '../../___disegni_tecnici_esame/disegno_16.jpg', 'AUTO', 'Bmw', 'B', '0'),
('6666', '84198qq', '6', '6', '6', '6', '../../___disegni_tecnici_esame/disegno_6.jpg', '../../___disegni_tecnici_esame/disegno_17.jpg', 'MOTO', 'Audi', 'N', '0'),
('7777', '65141fz', '7', '7', '7', '7', '../../___disegni_tecnici_esame/disegno_7.jpg', '../../___disegni_tecnici_esame/disegno_18.jpg', 'AUTO', 'Lancia', 'N', '1'),
('8888', '74897ps', '8', '8', '8', '8', '../../___disegni_tecnici_esame/disegno_8.jpg', '../../___disegni_tecnici_esame/disegno_19.jpg', 'MONO', 'Fiat', 'N', '1'),
('9999', '14981ld', '9', '9', '9', '9', '../../___disegni_tecnici_esame/disegno_9.jpg', '../../___disegni_tecnici_esame/disegno_20.jpg', 'PULL', 'Fiat', 'A', '1'),
('1010', '74198br', '10', '10', '10', '10', '../../___disegni_tecnici_esame/disegno_10.jpg', '../../___disegni_tecnici_esame/disegno_21.jpg', 'MOTO', 'generico', 'A', '0'),
('1110', '74987hs', '11', '11', '11', '11', '../../___disegni_tecnici_esame/disegno_11.jpg', '../../___disegni_tecnici_esame/disegno_22.jpg', 'MOTO', 'generico', 'A', '0');

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
