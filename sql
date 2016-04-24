-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: votandovoy
-- ------------------------------------------------------
-- Server version	5.5.47-0+deb8u1

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
-- Table structure for table `asignacion_verificacion`
--

DROP TABLE IF EXISTS `asignacion_verificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asignacion_verificacion` (
  `usuario` int(11) NOT NULL DEFAULT '0',
  `administrador` int(11) NOT NULL DEFAULT '0',
  `asignado` datetime DEFAULT NULL,
  PRIMARY KEY (`usuario`,`administrador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` smallint(11) unsigned NOT NULL AUTO_INCREMENT,
  `ncorto` char(50) DEFAULT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `descripcion` text,
  `orden` smallint(5) unsigned DEFAULT '100',
  `nivel` tinyint(3) unsigned DEFAULT '0',
  `borrado` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `colaboradores`
--

DROP TABLE IF EXISTS `colaboradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colaboradores` (
  `id` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(250) DEFAULT NULL,
  `apellidos` varchar(250) DEFAULT NULL,
  `ocupacion` varchar(250) DEFAULT NULL,
  `movil` varchar(250) DEFAULT NULL,
  `ciudad` int(11) DEFAULT '1',
  `territorio` char(50) DEFAULT NULL,
  `mailing` int(11) DEFAULT '1',
  `moviling` int(11) DEFAULT '1',
  `borrado` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor` int(11) NOT NULL,
  `modulo` char(15) NOT NULL,
  `elemento` int(11) NOT NULL,
  `padre` int(11) NOT NULL,
  `puntos` int(11) NOT NULL DEFAULT '1',
  `fecha` datetime DEFAULT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `texto` text,
  `ip` char(35) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comisiones`
--

DROP TABLE IF EXISTS `comisiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comisiones` (
  `id` smallint(11) unsigned NOT NULL AUTO_INCREMENT,
  `ncorto` char(50) DEFAULT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `descripcion` text,
  `orden` smallint(5) unsigned DEFAULT '100',
  `borrado` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `entradausuario`
--

DROP TABLE IF EXISTS `entradausuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entradausuario` (
  `usuario` int(11) NOT NULL DEFAULT '0',
  `fecha` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`fecha`,`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `firmas`
--

DROP TABLE IF EXISTS `firmas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firmas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  `apellidos` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `ocupacion` varchar(250) DEFAULT NULL,
  `movil` varchar(250) DEFAULT NULL,
  `ciudad` int(11) DEFAULT '1',
  `territorio` char(50) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `ip` char(20) DEFAULT NULL,
  `visible` int(11) DEFAULT '1',
  `mailing` int(11) DEFAULT '1',
  `borrado` int(11) DEFAULT '0',
  `moviling` int(11) DEFAULT '1',
  `confirmado` int(11) DEFAULT '1',
  `manual` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `herramientas`
--

DROP TABLE IF EXISTS `herramientas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `herramientas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creador` int(11) NOT NULL DEFAULT '0',
  `tipo` char(50) NOT NULL DEFAULT '',
  `titulo` varchar(250) DEFAULT NULL,
  `txt` text,
  `modulo` char(50) NOT NULL DEFAULT '',
  `elemento` int(11) NOT NULL DEFAULT '0',
  `proceso` int(11) unsigned DEFAULT '0',
  `comision` int(11) unsigned DEFAULT '0',
  `verificado` tinyint(1) DEFAULT NULL,
  `creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inicio` timestamp NULL DEFAULT NULL,
  `fin` timestamp NULL DEFAULT NULL,
  `datos` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inscripciones`
--

DROP TABLE IF EXISTS `inscripciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscripciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` text,
  `fecha` datetime DEFAULT NULL,
  `votacion` int(11) DEFAULT NULL,
  `valido` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `intereses`
--

DROP TABLE IF EXISTS `intereses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `intereses` (
  `usuario` int(11) NOT NULL,
  `interes` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`usuario`,`interes`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `intereses_firmas`
--

DROP TABLE IF EXISTS `intereses_firmas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `intereses_firmas` (
  `firmante` int(11) NOT NULL,
  `interes` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`firmante`,`interes`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modulo` char(20) NOT NULL DEFAULT '',
  `modid` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `modulo` (`modulo`),
  KEY `modid` (`modid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mesas`
--

DROP TABLE IF EXISTS `mesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mesas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `votacion` int(11) DEFAULT NULL,
  `nombre` char(30) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `nulos` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `opciones`
--

DROP TABLE IF EXISTS `opciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inscripcion` int(11) DEFAULT NULL,
  `codigo` char(30) DEFAULT NULL,
  `votacion` int(11) DEFAULT NULL,
  `tipo` char(10) DEFAULT NULL,
  `nombre` char(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `usuario` int(11) NOT NULL DEFAULT '0',
  `modulo` char(50) NOT NULL DEFAULT '',
  `elemento` int(11) NOT NULL DEFAULT '0',
  `nivel` int(11) DEFAULT NULL,
  PRIMARY KEY (`usuario`,`modulo`,`elemento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `propuesta`
--

DROP TABLE IF EXISTS `propuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propuesta` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `autor` int(11) unsigned NOT NULL,
  `titular` varchar(250) DEFAULT NULL,
  `texto` text,
  `categoria` smallint(5) unsigned DEFAULT '0',
  `votosok` int(11) unsigned DEFAULT '0',
  `votosko` int(11) unsigned DEFAULT '0',
  `valor` int(11) unsigned DEFAULT '0',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `propuesta_colaborador`
--

DROP TABLE IF EXISTS `propuesta_colaborador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propuesta_colaborador` (
  `usuario` int(11) unsigned NOT NULL DEFAULT '0',
  `propuesta` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`usuario`,`propuesta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `propuesta_voto`
--

DROP TABLE IF EXISTS `propuesta_voto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propuesta_voto` (
  `usuario` int(11) unsigned NOT NULL DEFAULT '0',
  `propuesta` int(11) unsigned NOT NULL DEFAULT '0',
  `voto` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`usuario`,`propuesta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `registro`
--

DROP TABLE IF EXISTS `registro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registro` (
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario` int(11) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `proxy` varchar(60) DEFAULT NULL,
  `txt` varchar(250) DEFAULT NULL,
  `extra` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(250) NOT NULL DEFAULT '',
  `email` varchar(250) NOT NULL DEFAULT '',
  `pwd` char(50) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `karma` int(11) DEFAULT '3',
  `ultimoacceso` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios_peticiones`
--

DROP TABLE IF EXISTS `usuarios_peticiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_peticiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(250) NOT NULL DEFAULT '',
  `email` varchar(250) NOT NULL DEFAULT '',
  `fecha` datetime DEFAULT NULL,
  `pwd` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `verificaciones`
--

DROP TABLE IF EXISTS `verificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `verificaciones` (
  `usuario` int(11) NOT NULL DEFAULT '0',
  `tipo` char(20) DEFAULT NULL,
  `documento` char(50) DEFAULT NULL,
  `solicitada` datetime DEFAULT NULL,
  `aceptada` datetime DEFAULT NULL,
  `administrador` int(11) DEFAULT NULL,
  `verificado` int(11) DEFAULT '0',
  `data` text,
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `votaciones`
--

DROP TABLE IF EXISTS `votaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inicio` datetime DEFAULT NULL,
  `preinscripcion` datetime DEFAULT NULL,
  `votacion` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  `titulo` char(250) DEFAULT NULL,
  `tipo` char(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `votante`
--

DROP TABLE IF EXISTS `votante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votante` (
  `votacion` int(11) NOT NULL DEFAULT '0',
  `usuario` int(11) NOT NULL DEFAULT '0',
  `documento` char(50) NOT NULL DEFAULT '',
  `mesa` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `votos`
--

DROP TABLE IF EXISTS `votos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votos` (
  `codigo` char(30) DEFAULT NULL,
  `votacion` int(11) DEFAULT NULL,
  `mesa` int(11) DEFAULT NULL,
  `voto` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `votos_tmp`
--

DROP TABLE IF EXISTS `votos_tmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votos_tmp` (
  `usuario` int(11) NOT NULL DEFAULT '0',
  `votacion` int(11) NOT NULL DEFAULT '0',
  `voto` text,
  PRIMARY KEY (`usuario`,`votacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-24 16:05:26
