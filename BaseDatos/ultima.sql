-- MySQL dump 10.13  Distrib 5.6.28, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: futbol2
-- ------------------------------------------------------
-- Server version	5.6.28-0ubuntu0.15.04.1

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
-- Table structure for table `Colabora`
--

DROP TABLE IF EXISTS `Colabora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Colabora` (
  `idEntrenador` int(10) unsigned NOT NULL,
  `idEquipo` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idEntrenador`,`idEquipo`),
  KEY `fk_Colabora_2_idx` (`idEquipo`),
  CONSTRAINT `fk_Colabora_1` FOREIGN KEY (`idEntrenador`) REFERENCES `ENTRENADOR` (`idEntrenador`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Colabora_2` FOREIGN KEY (`idEquipo`) REFERENCES `EQUIPO` (`idEquipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Colabora`
--

LOCK TABLES `Colabora` WRITE;
/*!40000 ALTER TABLE `Colabora` DISABLE KEYS */;
INSERT INTO `Colabora` VALUES (13,7);
/*!40000 ALTER TABLE `Colabora` ENABLE KEYS */;
UNLOCK TABLES;

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
  `nombreUsu` varchar(50) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idEntrenador`),
  UNIQUE KEY `nombreUsu_UNIQUE` (`nombreUsu`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ENTRENADOR`
--

LOCK TABLES `ENTRENADOR` WRITE;
/*!40000 ALTER TABLE `ENTRENADOR` DISABLE KEYS */;
INSERT INTO `ENTRENADOR` VALUES (6,'Juan Francisco','Sánchez Gordo','juanfransanc@hotmail.com','juanvisanc','e563a605fedcff7dda51e123adc4ddc7','admin'),(13,'Pedro Antonio','Silva Pérez','pedrito@hotmail.com','pedrito','14c9d9645bf3170f8f6252523f124cce','colaborador');
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EQUIPO`
--

LOCK TABLES `EQUIPO` WRITE;
/*!40000 ALTER TABLE `EQUIPO` DISABLE KEYS */;
INSERT INTO `EQUIPO` VALUES (1,'Ronquillo C.F.','El Ronquillo'),(2,'Castillo C.F.','El Castillo de las Guardas'),(3,'Torre Reina C.D.','Torre de la Reina'),(4,'C.D. Burguillos','Burguillos'),(5,'Guillena C.F.','Guillena'),(6,'Brenes Balompié','Brenes'),(7,'Atco. Algabeño','La Algaba'),(8,'Alcalá del Río C.F.','Alcalá del Río'),(9,'Cazallla Sierra','Cazalla de la Sierra'),(10,'Cantillana C.D.','Cantillana'),(11,'C.D. Aznalcollar','Aznalcollar'),(12,'Constantina C.D.','Constantina'),(13,'U.D. Santiponce','Santiponce'),(14,'Camas C.F.','Camas');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Entrena`
--

LOCK TABLES `Entrena` WRITE;
/*!40000 ALTER TABLE `Entrena` DISABLE KEYS */;
INSERT INTO `Entrena` VALUES (6,1);
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
  `altura` decimal(10,2) unsigned DEFAULT NULL,
  `peso` tinyint(3) unsigned DEFAULT NULL,
  `numero` tinyint(3) unsigned DEFAULT NULL,
  `edad` tinyint(3) unsigned DEFAULT NULL,
  `idEquipo` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idJugador`),
  KEY `fk_Jugador_1_idx` (`idEquipo`),
  CONSTRAINT `fk_Jugador_1` FOREIGN KEY (`idEquipo`) REFERENCES `EQUIPO` (`idEquipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `JUGADOR`
--

LOCK TABLES `JUGADOR` WRITE;
/*!40000 ALTER TABLE `JUGADOR` DISABLE KEYS */;
INSERT INTO `JUGADOR` VALUES (1,'Óscar','Trillo Martín','Osquitar','portero',1.80,80,1,30,1),(2,'Carlos','Marín Ros','Negro','Defensa',1.72,75,2,25,1),(3,'Jairo ','Macero Bernardino','Jairo','Defensa',1.77,78,3,27,1),(5,'José Manuel','Sánchez Gordo','Jose','delantero',1.74,78,5,34,1),(6,'Benito','Martín Martín','Beni','Medio',1.81,79,6,36,1),(7,'Juan Antonio','Domínguez Vargas','Porreto','Medio',1.78,76,8,28,1),(8,'Julián','Rodríguez Melchor','Juli','Medio',1.74,65,7,26,1),(9,'Pedro','Hernández García','Pedro','Defensa',1.75,73,12,18,1),(11,'Luis Miguel ','Romero García','Luismi','Delantero',1.78,68,9,26,1),(13,'Jose María','Marín Rubio','Josemari','Portero',1.81,93,13,28,1),(15,'Pedro José','Silva Pérez','Piter','Portero',1.79,80,1,32,2),(20,'Antonio','Noguera Suarez','Toni','Defensa',1.78,76,2,19,2),(21,'Miguel Ángel ','Silva Ruiz','Migue','Defensa',1.83,80,3,26,2),(22,'José Luis','Martín Villar','Selu','Defensa',1.86,81,4,29,2),(23,'José Manuel','Sánchez Ros','Sánchez','Defensa',1.76,76,5,21,2),(24,'Juan Antonio','Ramos Ojeda','Juanan','Medio',1.81,79,6,31,2),(25,'Rafael','Mena González','Rafa','Medio',1.76,72,7,26,2),(26,'Rafael','Ruiz Alonso','Alonso','Medio',1.69,65,8,21,2),(27,'Santiago','Gines Ramos','Santi','Medio',1.70,66,9,29,2),(28,'Cristobal','Ortega Salas','Tobal','Delantero',1.81,79,10,36,2),(29,'Manuel','Campos Martínez','Manolo','Delantero',1.76,80,11,26,2),(31,'Juan Felipe','Romero Gómez','Lipe','Medio',1.79,73,2,26,3),(32,'Francisco Manuel','Gómez Murillo','Manu','Defensa',1.86,79,3,31,3),(34,'José Juan','Vázquez Sánchez','Puche','Defensa',1.83,80,5,29,3),(35,'Luis','Cartel Pérez','Luis','Defensa',1.69,72,6,30,3),(39,'José Carlos','Acosta Lepe','Jose','Medio',1.90,83,10,32,3),(40,'Juan','Miranda Enamorado','Miranda','Delantero',1.87,90,11,29,3),(41,'José','Ramos Vela','Ramos','Delantero',1.76,75,12,35,3),(42,'Sergio','Guzmán Roldán','Sergi','Portero',1.81,80,13,24,3),(43,'Adrián','Valderas Rodríguez','Adri','Portero',1.78,76,1,19,4),(44,'Alejandro','López Rojas','Alex','Defensa',1.84,81,2,26,4),(45,'Carlos','Franco Murillo','Carlitos','Defensa',1.79,73,3,17,4),(46,'Daniel','García Fuentes','Dani','Defensa',1.78,76,4,29,4),(47,'Emilio','López Cid','Emilio','Defensa',1.81,75,5,30,4),(48,'Jesús','López Gelo','Jesuli','Medio',1.76,70,6,27,4),(49,'Ismael','Vázquez Herrera','Isma','Medio',1.81,79,7,19,4),(50,'Tomás','Bejarano Gutiérrez','Guti','Medio',1.78,81,8,26,4),(51,'Santiago','López Gil','Santi','Medio',1.81,79,9,19,4),(52,'Óscar','Herencia López','Óscar','Delantero',1.76,72,10,25,4),(54,'Álvaro','Díaz Jurado','Álvaro','Portero',1.79,80,1,29,5),(55,'Álvaro','López Ruiz','López','Defensa',1.82,79,2,28,5),(57,'Iván','García Fernández','Iván','Defensa',1.78,72,4,19,5),(58,'Jesús','Pernía Fernández','Jesús','Defensa',1.75,78,5,19,5),(59,'José Luis','Ruiz Farfán','Selu','Defensa',1.85,74,6,25,5),(60,'Moisés','Mallén Pendón','Moy','Medio',1.76,78,7,20,5),(61,'Pablo','Martín Caballero','Pablito','Medio',1.78,70,8,17,5),(62,'Serafín','Núñez Chozas','Serafín','Medio',1.71,69,9,21,5),(63,'Rodrigo','González Acosta','Rodri','Medio',1.74,74,10,22,5),(64,'Ramón','Alonso Pérez','Alonso','Delentero',1.78,80,11,23,5),(65,'Juan Manuel','Díaz Cárdenas','Juanma','Delantero',1.78,78,12,21,5),(66,'Alberto','Pérez Jiménez','Jiménez','Portero',1.90,88,1,24,6),(67,'Isaac','Barrul Gómez','Barrul','Medio',2.00,81,2,25,6),(68,'Miguel Ángel','Ramírez Sánchez','Migue','Defensa',1.82,74,3,29,6),(71,'David','Lara Cruz','David','Medio',1.71,74,6,31,6),(72,'Alfonso','Ort Baena','Alfonso','Medio',1.80,75,7,25,6),(74,'Alberto','Pérez Montes','Alberto','Delantero',1.97,83,9,22,6),(76,'Juan','Bernal Jiménez','Chino','Delantero',1.98,89,11,26,6),(78,'Diego','Manas Sánchez','Diego','Portero',1.92,83,1,31,7),(79,'Álvaro','Morilla Dávalos','Álvaro','Defensa',1.76,79,2,26,7),(80,'Lorenzo','Sánchez Aragón','Loren','Defensa',1.79,79,3,29,7),(82,'Julio','Delgado Huertas','Juli','Defensa',1.82,80,5,26,7),(83,'Carlos','Díaz Serrano','Carlos','Medio',1.72,72,6,19,7),(84,'Jairo','Rodríguez Jiménez','Jairo','Medio',1.80,76,7,26,7),(85,'Iván','Gaviño López','Iván','Medio',1.76,76,8,23,7),(86,'Ezequiel','García García','Ezequiel','Medio',1.80,79,9,29,7),(87,'Álvaro','Madroñal Ruiz','Álvaro','Delantero',1.75,76,10,23,7),(88,'Luis','Vargas Lara','Vargas','Delantero',2.00,89,11,30,7),(90,'Aarón','Aguilar Pérez','Aarón','Portero',1.87,87,1,23,8),(91,'Jorge','Jiménez Díaz','Jorge','Defensa',1.81,75,2,22,8),(92,'Sergio','Osuna Bravo','Sergio','Defensa',1.75,74,3,22,8),(93,'José Carlos','Lorca López','Jose','Defensa',1.72,72,4,26,8),(94,'Samuel','García Álvarez','Samu','Defensa',1.79,74,5,29,8),(95,'Alberto','Ledesma Milán','Ledes','Medio',1.80,79,6,31,8),(96,'José','Pino Morata','Pino','Medio',1.75,71,7,23,8),(97,'Manuel','Randón Palop','Palop','Medio',1.80,78,8,29,8),(98,'Rafael','Torres Gemelo','Torres','Medio',1.75,71,9,30,8),(99,'Francisco','Campos Leal','Fran','Delantero',1.84,78,10,34,8),(100,'Joaquín','Blanco Calero','Juaqui','Delantero',1.79,74,11,29,8),(101,'José Miguel','Fernández Gordo','Josemi','Delantero',1.76,74,12,26,8),(102,'Daniel','Medián Gallardo','Gallardo','Portero',1.80,79,1,23,9),(103,'Pablo','Cabrera Montenegro','Pablo','Defensa',1.79,75,2,26,9),(104,'Borja','Suárez García','Borja','Defensa',1.81,79,3,29,9),(105,'Guillermo','Barcena López','Guille','Defensa',1.78,79,4,36,9),(106,'Manuel','Garoña García','Manu','Defensa',1.75,78,5,25,9),(107,'Sergio','Pelayo Fernández','Sergio','Defensa',1.80,78,6,30,9),(108,'Manuel','Marín Segurola','Marín','Medio',1.78,75,7,23,9),(109,'Miguel Ángel','Segurola Ramos','Migue','Medio',1.75,78,8,29,9),(111,'Javier','Rosado Cortés','Javi','Delantero',1.75,79,10,21,9),(112,'Ramón','Benítez Álvarez','Ramoni','Delantero',1.74,74,11,20,9),(113,'David','Bravo Ramírez','David','Delantero',1.90,82,12,32,9),(114,'Lázaro','Damas Cruz','Lázaro','Portero',1.81,78,1,20,10),(115,'Mariano','García Linero','Mariano','Defensa',1.71,68,2,23,10),(116,'José María','Soria Morón','Josemari','Defensa',1.75,70,3,21,10),(117,'Francisco','Ruiz García','Paco','Defensa',1.78,74,4,26,10),(118,'Juan','Sánchez Franco','Juan','Defensa',1.81,74,5,31,10),(119,'Antonio Ramón','Holgado Huertas','Ramón','Medio',1.79,76,6,34,10),(121,'Cristobal','García Pelayo','Cristobal','Medio',1.69,65,8,19,10),(123,'Agustín','García Remón','Agustín','Delantero',1.87,82,10,29,10),(124,'Álvaro','Cortés Sanvicente','Álvaro','Delantero',1.74,71,11,25,10),(125,'Iván','Sánchez Prieto','Iván','Portero',1.81,78,12,26,10),(126,'Javier','García Molina','Javi','Portero',1.71,68,1,29,11),(127,'Jesús','Manzano Daza','Jesuli','Defensa',1.75,68,2,34,11),(128,'Pablo','Franco Marín','Franco','Defensa',1.75,70,3,21,11),(129,'Rubén','Cortés Solís','Rubén','Defensa',1.79,74,4,26,11),(130,'Eloy','Jiménez Duque','Eloy','Defensa',1.84,80,5,30,11),(131,'Eugenio','Sainz Loza','Eugenio','Medio',1.71,65,6,21,11),(132,'Jorge','Nieto Macero','Jorge','Medio',1.75,74,7,29,11),(133,'Miguel','Chillón Pino','Miguel','Medio',1.79,74,8,31,11),(134,'Sergio','García Carillo','Sergio','Medio',1.74,74,9,24,11),(135,'Manuel','Soto Ossorio','Manu','Delantero',1.74,70,10,34,11),(136,'José Luis','Moris Vega','Vega','Delantero',1.81,79,11,30,11),(137,'Juan','Montero Garcés','Juan','Delantero',1.78,75,12,20,11),(139,'David','Ortiz Orillán','David','Portero',1.78,76,1,24,12),(140,'Francisco','Casáñez Martínez','Fran','Defensa',1.81,76,2,29,12),(141,'Adrián','Zambrano Gómez','Zambrano','Defensa',1.78,71,3,19,12),(142,'Sergio','Limia Durán','Sergio','Defensa',1.74,68,4,21,12),(143,'Guillermo','Senso Pizarro','Guille','Defensa',1.79,75,5,29,12),(145,'Fernando','Guisado Llaga','Fernand','Medio',1.75,71,7,30,12),(146,'Nicolás','Tovar Adorna','Tovar','Medio',1.73,71,8,19,12),(147,'Manuel','Merino Romero','Manolo','Medio',1.72,68,9,29,12),(148,'Sergio','Castejón Bomba','Bomba','Delantero',1.90,85,10,31,12),(149,'Jesús','Muñoz Canela','Jesús','Delantero',1.84,80,11,25,12),(150,'Borja','Morán Aranda','Aranda','Portero',1.80,74,1,29,13),(151,'Jesús','Barroso Merino','Barroso','Defensa',1.75,70,2,26,13),(153,'Luis','Raudona Carretero','Luis','Defensa',1.79,76,4,31,13),(154,'Pablo','Arroyo Piñero','Pablo','Defensa',1.81,74,5,21,13),(155,'Luis','Campo Romero','Campos','Medio',1.73,65,6,20,13),(156,'Juan Luis','Delgado Viveros','Juanlu','Medio',1.80,79,7,26,13),(157,'Juan','Puntas Pardo','Juan','Medio',1.76,70,8,29,13),(158,'Antonio José','Moya Rico','Moya','Medio',1.76,74,9,31,13),(159,'Alberto Juan','Delgado Delgado','Alberto','Delantero',1.96,89,10,19,13),(160,'Manuel','Dunn Polo','Polo','Delantero',1.87,81,11,23,13),(161,'Carlos','Rodríguez Rodríguez','Carli','Delantero',1.74,73,12,25,13),(162,'Miguel','Castro Reyes','Miguel','Portero',1.80,76,1,29,14),(163,'Sergio','Dueñas Ruiz','Dueñas','Defensa',1.76,74,2,32,14),(164,'Ignacio','Fernández Losada','Nacho','Defensa',1.78,73,3,30,14),(165,'Guillermo','Pavón Díaz','Guillermo','Defensa',1.73,69,4,21,14),(166,'Ezequiel','Lamarca Gómez','Ezequiel','Defensa',1.81,75,5,29,14),(167,'José Francisco','Castro Bermudo','Josefran','Medio',1.75,70,6,34,14),(168,'Juan Francisco','Lazo Romero','Juanfran','Medio',1.79,75,7,30,14),(169,'Luis Mariano','Pérez Poyato','Luisma','Medio',1.76,71,8,26,14),(170,'Carlos','Úbeda Arroyo','Carlos','Medio',1.80,78,9,34,14),(171,'Fermín','Sánchez García','Fermín','Delantero',1.78,76,10,30,14),(172,'Juan Antonio','Pozo Marín','Pozo','Delantero',1.96,89,11,30,14),(174,'Juan Carlos','Benítez Berrufo','Juancar','Portero',1.79,73,13,30,14),(175,'José Luis','Gómez Gutiérrez','Guti','Medio',2.01,92,18,26,3),(176,'Juan Diego','Pérez Gómez','Juandi','Medio',1.81,79,22,31,6),(177,'Adrián','Casado Pérez','Adri','Medio',1.73,54,25,30,3);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Juego`
--

LOCK TABLES `Juego` WRITE;
/*!40000 ALTER TABLE `Juego` DISABLE KEYS */;
INSERT INTO `Juego` VALUES (8,1,1,1,0),(35,2,2,0,0),(46,2,1,1,0),(61,3,2,0,0),(62,3,2,0,1),(86,4,2,1,0),(99,4,2,0,0),(112,5,1,0,0),(113,5,2,0,0),(134,6,2,0,0),(135,6,2,0,0),(148,6,2,1,0),(160,7,3,0,0),(168,7,1,0,0),(169,7,3,1,0);
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
  `jornada` int(11) NOT NULL,
  PRIMARY KEY (`idPartido`),
  KEY `fk_PARTIDO_1_idx` (`idEquipoL`),
  KEY `fk_PARTIDO_2_idx` (`idEquipoV`),
  CONSTRAINT `fk_PARTIDO_1` FOREIGN KEY (`idEquipoL`) REFERENCES `EQUIPO` (`idEquipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_PARTIDO_2` FOREIGN KEY (`idEquipoV`) REFERENCES `EQUIPO` (`idEquipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PARTIDO`
--

LOCK TABLES `PARTIDO` WRITE;
/*!40000 ALTER TABLE `PARTIDO` DISABLE KEYS */;
INSERT INTO `PARTIDO` VALUES (1,1,2,3,0,'2016-01-12','El Ronquillo',0),(2,3,4,2,1,'2016-01-12','Torre la Reina',0),(3,5,6,4,3,'2016-01-12','Guillena',0),(4,7,8,2,2,'2016-01-12','La Algaba',0),(5,9,10,3,0,'2016-01-12','Cazalla de la Sierra',0),(6,11,12,4,2,'2016-01-12','Aznalcollar',0),(7,13,14,3,4,'2016-01-12','Santiponce',0);
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

-- Dump completed on 2016-02-10 10:06:49
