-- MySQL dump 10.13  Distrib 5.6.27, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: futbol
-- ------------------------------------------------------
-- Server version	5.6.27-0ubuntu0.15.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ENTRENADOR`
--

DROP TABLE IF EXISTS `ENTRENADOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ENTRENADOR` (
  `idEntrenador` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `edad` tinyint(3) unsigned DEFAULT NULL,
  `nombreUsu` varchar(50) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idEntrenador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ENTRENADOR`
--

LOCK TABLES `ENTRENADOR` WRITE;
/*!40000 ALTER TABLE `ENTRENADOR` DISABLE KEYS */;
/*!40000 ALTER TABLE `ENTRENADOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EQUIPO`
--

DROP TABLE IF EXISTS `EQUIPO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EQUIPO` (
  `idEquipo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `localidad` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEquipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EQUIPO`
--

LOCK TABLES `EQUIPO` WRITE;
/*!40000 ALTER TABLE `EQUIPO` DISABLE KEYS */;
/*!40000 ALTER TABLE `EQUIPO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Entrena`
--

DROP TABLE IF EXISTS `Entrena`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Entrena` (
  `idEntrenador` int(10) unsigned NOT NULL,
  `idEquipo` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idEntrenador`,`idEquipo`),
  KEY `fk_Entrena_2_idx` (`idEquipo`),
  CONSTRAINT `fk_Entrena_1` FOREIGN KEY (`idEntrenador`) REFERENCES `ENTRENADOR` (`idEntrenador`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Entrena_2` FOREIGN KEY (`idEquipo`) REFERENCES `EQUIPO` (`idEquipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Entrena`
--

LOCK TABLES `Entrena` WRITE;
/*!40000 ALTER TABLE `Entrena` DISABLE KEYS */;
/*!40000 ALTER TABLE `Entrena` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `JUGADOR`
--

DROP TABLE IF EXISTS `JUGADOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `JUGADOR` (
  `idJugador` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `alias` varchar(45) NOT NULL,
  `posicion` varchar(45) DEFAULT NULL,
  `altura` decimal(10,0) unsigned DEFAULT NULL,
  `peso` tinyint(3) unsigned DEFAULT NULL,
  `numero` tinyint(3) unsigned DEFAULT NULL,
  `edad` tinyint(3) unsigned DEFAULT NULL,
  `idEquipo` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idJugador`),
  KEY `fk_Jugador_1_idx` (`idEquipo`),
  CONSTRAINT `fk_Jugador_1` FOREIGN KEY (`idEquipo`) REFERENCES `EQUIPO` (`idEquipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `JUGADOR`
--

LOCK TABLES `JUGADOR` WRITE;
/*!40000 ALTER TABLE `JUGADOR` DISABLE KEYS */;
/*!40000 ALTER TABLE `JUGADOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Juego`
--

DROP TABLE IF EXISTS `Juego`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Juego` (
  `idJugador` int(10) unsigned NOT NULL,
  `idPartido` int(10) unsigned NOT NULL,
  `goles` int(10) unsigned DEFAULT '0',
  `tarjetasA` int(10) unsigned DEFAULT '0',
  `tarjetasR` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idJugador`,`idPartido`),
  KEY `fk_Juego_2_idx` (`idPartido`),
  CONSTRAINT `fk_Juego_1` FOREIGN KEY (`idJugador`) REFERENCES `JUGADOR` (`idJugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Juego_2` FOREIGN KEY (`idPartido`) REFERENCES `PARTIDO` (`idPartido`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Juego`
--

LOCK TABLES `Juego` WRITE;
/*!40000 ALTER TABLE `Juego` DISABLE KEYS */;
/*!40000 ALTER TABLE `Juego` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PARTIDO`
--

DROP TABLE IF EXISTS `PARTIDO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PARTIDO` (
  `idPartido` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipoL` int(10) unsigned DEFAULT NULL,
  `idEquipoV` int(10) unsigned DEFAULT NULL,
  `golesL` int(10) unsigned DEFAULT '0',
  `golesV` int(10) unsigned DEFAULT '0',
  `fecha` date DEFAULT NULL,
  `localidad` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPartido`),
  KEY `fk_PARTIDO_1_idx` (`idEquipoL`),
  KEY `fk_PARTIDO_2_idx` (`idEquipoV`),
  CONSTRAINT `fk_PARTIDO_1` FOREIGN KEY (`idEquipoL`) REFERENCES `EQUIPO` (`idEquipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_PARTIDO_2` FOREIGN KEY (`idEquipoV`) REFERENCES `EQUIPO` (`idEquipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PARTIDO`
--

LOCK TABLES `PARTIDO` WRITE;
/*!40000 ALTER TABLE `PARTIDO` DISABLE KEYS */;
/*!40000 ALTER TABLE `PARTIDO` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-08 13:47:24
