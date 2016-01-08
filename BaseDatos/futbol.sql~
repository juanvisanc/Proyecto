-- MySQL dump 10.13  Distrib 5.6.27, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: Futbol
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
  CONSTRAINT `fk_Entrena_1` FOREIGN KEY (`idEntrenador`) REFERENCES `Entrenador` (`idEntrenador`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Entrena_2` FOREIGN KEY (`idEquipo`) REFERENCES `Equipo` (`idEquipo`) ON DELETE CASCADE ON UPDATE CASCADE
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
-- Table structure for table `Entrenador`
--

DROP TABLE IF EXISTS `Entrenador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Entrenador` (
  `idEntrenador` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Apellidos` varchar(100) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Edad` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`idEntrenador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Entrenador`
--

LOCK TABLES `Entrenador` WRITE;
/*!40000 ALTER TABLE `Entrenador` DISABLE KEYS */;
/*!40000 ALTER TABLE `Entrenador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Equipo`
--

DROP TABLE IF EXISTS `Equipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Equipo` (
  `idEquipo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Localidad` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEquipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Equipo`
--

LOCK TABLES `Equipo` WRITE;
/*!40000 ALTER TABLE `Equipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `Equipo` ENABLE KEYS */;
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
  `Minuto` tinyint(3) unsigned NOT NULL,
  `Tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`idJugador`,`idPartido`,`Minuto`),
  KEY `fk_Juego_2_idx` (`idPartido`),
  CONSTRAINT `fk_Juego_1` FOREIGN KEY (`idJugador`) REFERENCES `Jugador` (`idJugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Juego_2` FOREIGN KEY (`idPartido`) REFERENCES `Partido` (`idPartido`) ON DELETE CASCADE ON UPDATE CASCADE
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
-- Table structure for table `Jugador`
--

DROP TABLE IF EXISTS `Jugador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Jugador` (
  `idJugador` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellidos` varchar(100) DEFAULT NULL,
  `Alias` varchar(45) NOT NULL,
  `Posicion` varchar(45) DEFAULT NULL,
  `Altura` decimal(10,0) unsigned DEFAULT NULL,
  `Peso` tinyint(3) unsigned DEFAULT NULL,
  `Numero` tinyint(3) unsigned DEFAULT NULL,
  `Edad` tinyint(3) unsigned DEFAULT NULL,
  `idEquipo` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idJugador`),
  KEY `fk_Jugador_1_idx` (`idEquipo`),
  CONSTRAINT `fk_Jugador_1` FOREIGN KEY (`idEquipo`) REFERENCES `Equipo` (`idEquipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Jugador`
--

LOCK TABLES `Jugador` WRITE;
/*!40000 ALTER TABLE `Jugador` DISABLE KEYS */;
/*!40000 ALTER TABLE `Jugador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Participan`
--

DROP TABLE IF EXISTS `Participan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Participan` (
  `idEquipo` int(10) unsigned NOT NULL,
  `idPartido` int(10) unsigned NOT NULL,
  `Local` bit(1) NOT NULL,
  PRIMARY KEY (`idEquipo`,`idPartido`,`Local`),
  KEY `fk_Participan_2_idx` (`idPartido`),
  CONSTRAINT `fk_Participan_1` FOREIGN KEY (`idEquipo`) REFERENCES `Equipo` (`idEquipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Participan_2` FOREIGN KEY (`idPartido`) REFERENCES `Partido` (`idPartido`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Participan`
--

LOCK TABLES `Participan` WRITE;
/*!40000 ALTER TABLE `Participan` DISABLE KEYS */;
/*!40000 ALTER TABLE `Participan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Partido`
--

DROP TABLE IF EXISTS `Partido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Partido` (
  `idPartido` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `GolesV` tinyint(4) DEFAULT NULL,
  `GolesL` tinyint(4) DEFAULT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`idPartido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Partido`
--

LOCK TABLES `Partido` WRITE;
/*!40000 ALTER TABLE `Partido` DISABLE KEYS */;
/*!40000 ALTER TABLE `Partido` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-29 13:14:52
