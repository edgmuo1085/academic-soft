-- MariaDB dump 10.19  Distrib 10.5.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: academico
-- ------------------------------------------------------
-- Server version	10.5.12-MariaDB-0+deb11u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `anio_escolar`
--

DROP TABLE IF EXISTS `anio_escolar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anio_escolar` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `id_institucion` int(4) NOT NULL,
  `estado` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_institucion` (`id_institucion`),
  CONSTRAINT `anio_escolar_ibfk_1` FOREIGN KEY (`id_institucion`) REFERENCES `institucion_educativa` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anio_escolar`
--

LOCK TABLES `anio_escolar` WRITE;
/*!40000 ALTER TABLE `anio_escolar` DISABLE KEYS */;
INSERT INTO `anio_escolar` VALUES (1,'2023-01-01 00:00:00','2023-12-01 00:00:00',1,1);
/*!40000 ALTER TABLE `anio_escolar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asignacion_docente`
--

DROP TABLE IF EXISTS `asignacion_docente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asignacion_docente` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_usuario_docente` int(4) NOT NULL,
  `id_anio_escolar` int(4) NOT NULL,
  `id_asignatura` int(4) NOT NULL,
  `id_grupo` int(4) NOT NULL,
  `link_clase_virtual` text DEFAULT NULL,
  `intensidad_horaria` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario_docente` (`id_usuario_docente`),
  KEY `id_anio_escolar` (`id_anio_escolar`),
  KEY `id_asignatura` (`id_asignatura`),
  KEY `id_grupo` (`id_grupo`),
  CONSTRAINT `asignacion_docente_ibfk_1` FOREIGN KEY (`id_usuario_docente`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `asignacion_docente_ibfk_2` FOREIGN KEY (`id_anio_escolar`) REFERENCES `anio_escolar` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `asignacion_docente_ibfk_3` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `asignacion_docente_ibfk_4` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignacion_docente`
--

LOCK TABLES `asignacion_docente` WRITE;
/*!40000 ALTER TABLE `asignacion_docente` DISABLE KEYS */;
INSERT INTO `asignacion_docente` VALUES (1,9,1,9,11,'#',12),(2,9,1,2,11,'#',12),(3,9,1,7,11,'#',12),(4,9,1,6,11,'#',12),(5,9,1,5,11,'#',12),(6,9,1,1,11,'#',12),(7,9,1,4,11,'#',12),(8,9,1,3,11,'#',12),(9,9,1,8,11,'#',1),(10,7,1,9,21,'#',3),(11,7,1,2,21,'#',3),(12,7,1,7,21,'#',3),(13,7,1,6,21,'#',3),(14,7,1,5,21,'#',3),(15,7,1,1,21,'#',3),(16,7,1,4,21,'#',3),(17,7,1,8,21,'#',3),(18,7,1,3,21,'#',3),(19,2,1,9,16,'#',1),(20,2,1,2,16,'#',1),(21,2,1,7,16,'#',3),(22,2,1,9,23,'#',2),(23,2,1,2,23,'#',2),(24,2,1,7,23,'#',2),(25,2,1,6,23,'#',2);
/*!40000 ALTER TABLE `asignacion_docente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asignatura`
--

DROP TABLE IF EXISTS `asignatura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asignatura` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre_asignatura` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignatura`
--

LOCK TABLES `asignatura` WRITE;
/*!40000 ALTER TABLE `asignatura` DISABLE KEYS */;
INSERT INTO `asignatura` VALUES (1,'Matematicas'),(2,'Español'),(3,'Sociales'),(4,'Naturales'),(5,'Inglés'),(6,'Informática'),(7,'Etica y Valores'),(8,'Religion'),(9,'Educacion Fisica');
/*!40000 ALTER TABLE `asignatura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grado`
--

DROP TABLE IF EXISTS `grado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grado` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre_grado` varchar(30) NOT NULL,
  `id_institucion` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_institucion` (`id_institucion`),
  CONSTRAINT `grado_ibfk_1` FOREIGN KEY (`id_institucion`) REFERENCES `institucion_educativa` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grado`
--

LOCK TABLES `grado` WRITE;
/*!40000 ALTER TABLE `grado` DISABLE KEYS */;
INSERT INTO `grado` VALUES (1,'Párbulos',1),(2,'Primero',1),(3,'Segundo',1),(4,'Tercero',1),(5,'Cuarto',1),(6,'Quinto',1),(7,'Sexto',1),(8,'Séptimo',1),(9,'Octavo',1),(10,'Noveno',1),(11,'Décimo',1),(12,'Onceavo',1);
/*!40000 ALTER TABLE `grado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre_grupo` varchar(30) NOT NULL,
  `id_grado` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_grado` (`id_grado`),
  CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo`
--

LOCK TABLES `grupo` WRITE;
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` VALUES (1,'A',1),(2,'B',1),(3,'A',2),(4,'B',2),(5,'A',3),(6,'B',3),(7,'A',4),(8,'B',4),(9,'A',5),(10,'B',5),(11,'A',6),(12,'B',6),(13,'A',7),(14,'B',7),(15,'A',8),(16,'B',8),(17,'A',9),(18,'B',9),(19,'A',10),(20,'B',10),(21,'A',11),(22,'B',11),(23,'A',12),(24,'B',12),(25,'C',9);
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_estudiante`
--

DROP TABLE IF EXISTS `grupo_estudiante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_estudiante` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_usuario_estudiante` int(4) NOT NULL,
  `id_grupo` int(4) NOT NULL,
  `id_anio_escolar` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario_estudiante` (`id_usuario_estudiante`),
  KEY `id_grupo` (`id_grupo`),
  KEY `id_anio_escolar` (`id_anio_escolar`),
  CONSTRAINT `grupo_estudiante_ibfk_1` FOREIGN KEY (`id_usuario_estudiante`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `grupo_estudiante_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `grupo_estudiante_ibfk_3` FOREIGN KEY (`id_anio_escolar`) REFERENCES `anio_escolar` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_estudiante`
--

LOCK TABLES `grupo_estudiante` WRITE;
/*!40000 ALTER TABLE `grupo_estudiante` DISABLE KEYS */;
INSERT INTO `grupo_estudiante` VALUES (1,4,11,1),(2,13,21,1),(3,14,21,1),(4,15,16,1),(5,16,21,1),(6,17,16,1),(7,18,11,1),(8,19,23,1),(9,20,23,1),(10,24,16,1),(14,25,11,1);
/*!40000 ALTER TABLE `grupo_estudiante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inasistencias`
--

DROP TABLE IF EXISTS `inasistencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inasistencias` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `cantidad` int(4) NOT NULL,
  `justificacion` text DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_modificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_usuario_estudiante` int(4) NOT NULL,
  `id_asignatura` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario_estudiante` (`id_usuario_estudiante`),
  KEY `id_asignatura` (`id_asignatura`),
  CONSTRAINT `inasistencias_ibfk_1` FOREIGN KEY (`id_usuario_estudiante`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `inasistencias_ibfk_2` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inasistencias`
--

LOCK TABLES `inasistencias` WRITE;
/*!40000 ALTER TABLE `inasistencias` DISABLE KEYS */;
INSERT INTO `inasistencias` VALUES (2,1,'Tutorial de diagramas de casos de uso ( Guía con ejemplos ) Actualizado el: 15 January 2021. El diagrama de caso de uso es un tipo de diagrama UML de comportamiento y se usa frecuentemente para analizar varios sistemas. Permiten visualizar los diferentes tipos de roles en un sistema y cómo esos roles interactúan con el sistema.','2022-03-22 02:15:53','2022-03-25 02:48:31',24,2),(3,1,'Tutorial de diagramas de casos de uso ( Guía con ejemplos ) Actualizado el: 15 January 2021. El diagrama de caso de uso es un tipo de diagrama UML de comportamiento y se usa frecuentemente para analizar varios sistemas. Permiten visualizar los diferentes tipos de roles en un sistema y cómo esos roles interactúan con el sistema.','2022-03-21 02:31:21','2022-03-25 02:48:31',24,8),(4,2,'Tutorial de diagramas de casos de uso ( Guía con ejemplos ) Actualizado el: 15 January 2021. El diagrama de caso de uso es un tipo de diagrama UML de comportamiento y se usa frecuentemente para analizar varios sistemas. Permiten visualizar los diferentes tipos de roles en un sistema y cómo esos roles interactúan con el sistema.','2022-03-25 02:31:30','2022-03-25 02:31:30',24,5),(5,1,'Tutorial de diagramas de casos de uso ( Guía con ejemplos ) Actualizado el: 15 January 2021. El diagrama de caso de uso es un tipo de diagrama UML de comportamiento y se usa frecuentemente para analizar varios sistemas. Permiten visualizar los diferentes tipos de roles en un sistema y cómo esos roles interactúan con el sistema.','2022-03-25 02:31:37','2022-03-25 02:31:37',24,6),(6,1,'Tutorial de diagramas de casos de uso ( Guía con ejemplos ) Actualizado el: 15 January 2021. El diagrama de caso de uso es un tipo de diagrama UML de comportamiento y se usa frecuentemente para analizar varios sistemas. Permiten visualizar los diferentes tipos de roles en un sistema y cómo esos roles interactúan con el sistema.','2022-03-20 02:31:54','2022-03-25 02:48:31',16,9),(7,1,'Tutorial de diagramas de casos de uso ( Guía con ejemplos ) Actualizado el: 15 January 2021. El diagrama de caso de uso es un tipo de diagrama UML de comportamiento y se usa frecuentemente para analizar varios sistemas. Permiten visualizar los diferentes tipos de roles en un sistema y cómo esos roles interactúan con el sistema.','2022-02-01 02:32:06','2022-03-25 02:48:31',16,4),(8,1,'Tutorial de diagramas de casos de uso ( Guía con ejemplos ) Actualizado el: 15 January 2021. El diagrama de caso de uso es un tipo de diagrama UML de comportamiento y se usa frecuentemente para analizar varios sistemas. Permiten visualizar los diferentes tipos de roles en un sistema y cómo esos roles interactúan con el sistema.','2022-03-25 02:32:19','2022-03-25 02:32:19',19,7),(9,2,'Tutorial de diagramas de casos de uso ( Guía con ejemplos ) Actualizado el: 15 January 2021. El diagrama de caso de uso es un tipo de diagrama UML de comportamiento y se usa frecuentemente para analizar varios sistemas. Permiten visualizar los diferentes tipos de roles en un sistema y cómo esos roles interactúan con el sistema.','2022-03-25 02:32:28','2022-03-25 02:32:28',19,3);
/*!40000 ALTER TABLE `inasistencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `institucion_educativa`
--

DROP TABLE IF EXISTS `institucion_educativa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `institucion_educativa` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `direccion` varchar(40) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `nombre_directora` varchar(60) DEFAULT NULL,
  `pagina_web` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institucion_educativa`
--

LOCK TABLES `institucion_educativa` WRITE;
/*!40000 ALTER TABLE `institucion_educativa` DISABLE KEYS */;
INSERT INTO `institucion_educativa` VALUES (1,'Institucion Educativa Departamental','Cll. 10 # 3 - 0','1234567','institucion@gmail.com','Ana Vasquez','http://www.institucion.com');
/*!40000 ALTER TABLE `institucion_educativa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `ruta` varchar(200) DEFAULT NULL,
  `tipo` int(2) NOT NULL,
  `es_hijo` int(4) DEFAULT NULL,
  `posicion` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `es_hijo` (`es_hijo`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`es_hijo`) REFERENCES `menu` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Institución','#',1,NULL,1),(2,'Año escolar','principal.php?CONTENIDO=layout/components/anio-escolar/lista-anio.php',2,1,2),(3,'Periodo Academico','principal.php?CONTENIDO=layout/components/periodo-academico/lista-periodo.php',2,1,3),(4,'Grados','principal.php?CONTENIDO=layout/components/grado/lista-grado.php',2,1,4),(5,'Grupos','principal.php?CONTENIDO=layout/components/grupo/lista-grupo.php',2,1,5),(6,'Asignatura','principal.php?CONTENIDO=layout/components/asignatura/lista-asignatura.php',1,NULL,6),(7,'Docentes','#',1,NULL,7),(8,'Personal Docente','principal.php?CONTENIDO=layout/components/docente/lista-docente.php',2,7,8),(9,'Asignacion Docente','principal.php?CONTENIDO=layout/components/docente/lista-asignacion-docente.php',2,7,9),(10,'Estudiantes','#',1,NULL,10),(11,'Listado','principal.php?CONTENIDO=layout/components/estudiante/lista-estudiante.php',2,10,11),(12,'Listado de Grupos','principal.php?CONTENIDO=layout/components/estudiante/lista-estudiante-grupo.php',2,10,12),(13,'Inasistencias','principal.php?CONTENIDO=layout/components/inasistencias/lista-inasistencias.php',2,10,13),(14,'Notas','#',1,NULL,14),(15,'Consultar Notas','principal.php?CONTENIDO=layout/components/notas/lista-notas.php',2,14,15),(16,'Imprimir Notas','#',2,14,16),(17,'Tipo de Actividades','principal.php?CONTENIDO=layout/components/tipo-actividad/lista-tipo-actividad.php',2,14,17);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nota`
--

DROP TABLE IF EXISTS `nota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nota` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_usuario_estudiante` int(4) NOT NULL,
  `id_periodo_academico` int(4) NOT NULL,
  `id_asignatura` int(4) NOT NULL,
  `id_tipo_actividad` int(4) NOT NULL,
  `nota` double DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_modificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_usuario_estudiante` (`id_usuario_estudiante`),
  KEY `id_asignatura` (`id_asignatura`),
  KEY `id_periodo_academico` (`id_periodo_academico`),
  KEY `id_tipo_actividad` (`id_tipo_actividad`),
  CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`id_usuario_estudiante`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `nota_ibfk_3` FOREIGN KEY (`id_periodo_academico`) REFERENCES `periodo_academico` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `nota_ibfk_4` FOREIGN KEY (`id_tipo_actividad`) REFERENCES `tipo_actividad` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nota`
--

LOCK TABLES `nota` WRITE;
/*!40000 ALTER TABLE `nota` DISABLE KEYS */;
INSERT INTO `nota` VALUES (1,4,1,9,1,1,'2022-03-23 21:40:44','2022-03-23 21:40:44'),(2,4,1,9,2,2,'2022-03-23 21:40:58','2022-03-23 21:41:13'),(3,4,1,9,3,2,'2022-03-23 21:41:23','2022-03-23 21:41:23'),(4,4,1,9,4,3,'2022-03-23 21:41:30','2022-03-23 21:41:30'),(5,4,1,9,5,4,'2022-03-23 21:41:40','2022-03-23 21:41:40'),(8,4,1,9,6,5,'2022-03-26 00:25:50','2022-03-26 00:25:50'),(9,24,1,9,1,3.3,'2022-03-26 00:27:40','2022-03-26 00:27:40'),(10,24,1,9,2,3.2,'2022-03-26 00:27:40','2022-03-26 00:27:40'),(11,24,1,9,3,4,'2022-03-26 00:27:40','2022-03-26 00:27:40'),(12,24,1,9,4,5,'2022-03-26 00:27:40','2022-03-26 00:27:40'),(13,24,1,9,5,1,'2022-03-26 00:27:40','2022-03-26 00:27:40'),(14,24,1,9,6,4.5,'2022-03-26 00:27:40','2022-03-26 00:27:40'),(15,4,1,2,1,5,'2022-03-26 00:30:35','2022-03-26 00:30:35'),(16,4,1,2,2,4.5,'2022-03-26 00:30:35','2022-03-26 00:30:35'),(17,17,1,5,1,2.4,'2022-03-26 00:59:56','2022-03-26 00:59:56'),(18,17,1,5,3,5,'2022-03-26 00:59:56','2022-03-26 00:59:56'),(19,4,2,4,1,4,'2022-03-26 01:04:38','2022-03-26 01:04:38'),(20,4,2,4,2,4,'2022-03-26 01:04:38','2022-03-26 01:04:38'),(21,4,2,4,3,4,'2022-03-26 01:04:38','2022-03-26 01:04:38'),(22,4,2,4,4,3,'2022-03-26 01:04:38','2022-03-26 01:04:38'),(23,4,2,4,5,3,'2022-03-26 01:04:38','2022-03-26 01:04:38'),(24,4,2,4,6,4.3,'2022-03-26 01:04:38','2022-03-26 01:04:38');
/*!40000 ALTER TABLE `nota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodo_academico`
--

DROP TABLE IF EXISTS `periodo_academico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodo_academico` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `inicio_periodo` datetime NOT NULL,
  `finalizacion_periodo` datetime NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `id_anio_escolar` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_anio_escolar` (`id_anio_escolar`),
  CONSTRAINT `periodo_academico_ibfk_1` FOREIGN KEY (`id_anio_escolar`) REFERENCES `anio_escolar` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo_academico`
--

LOCK TABLES `periodo_academico` WRITE;
/*!40000 ALTER TABLE `periodo_academico` DISABLE KEYS */;
INSERT INTO `periodo_academico` VALUES (1,'2023-01-01 23:59:59','2023-03-30 00:00:00','Periodo 1',1),(2,'2023-04-01 23:59:59','2023-06-30 00:00:00','Periodo 2',1),(3,'2023-07-01 23:59:59','2023-09-30 00:00:00','Periodo 3',1),(4,'2023-10-01 23:59:59','2023-12-30 00:00:00','Periodo 4',1);
/*!40000 ALTER TABLE `periodo_academico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_rol` int(4) NOT NULL,
  `id_menu` int(4) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_rol` (`id_rol`,`id_menu`),
  KEY `id_menu` (`id_menu`),
  CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (1,6,1,1),(2,6,2,1),(3,6,3,1),(4,6,4,1),(5,6,5,1),(6,6,6,1),(7,6,7,1),(8,6,8,1),(9,6,9,1),(10,6,10,1),(11,6,11,1),(12,6,12,1),(13,6,13,1),(14,6,14,1),(15,6,15,1),(16,6,16,1),(17,6,17,1),(18,1,1,1),(19,1,2,1),(20,1,3,1),(21,1,4,1),(22,1,5,1),(23,1,6,1),(24,1,7,1),(25,1,8,1),(26,1,9,1),(27,1,10,1),(28,1,11,1),(29,1,12,1),(30,1,13,1),(31,1,14,1),(32,1,15,1),(33,1,16,1),(34,1,17,1),(35,2,7,1),(36,2,9,1),(37,2,10,1),(38,2,11,1),(39,2,12,1),(40,2,13,1),(41,4,7,1),(42,4,8,1),(43,4,10,1),(44,4,13,1),(45,4,14,1),(46,4,15,1),(47,2,14,1),(48,2,15,1);
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `valor` char(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Secretaria','S'),(2,'Docente','D'),(3,'Acudiente','A'),(4,'Estudiante','E'),(5,'Desconocido','N'),(6,'Root','R');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_actividad`
--

DROP TABLE IF EXISTS `tipo_actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_actividad` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre_actividad` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_actividad`
--

LOCK TABLES `tipo_actividad` WRITE;
/*!40000 ALTER TABLE `tipo_actividad` DISABLE KEYS */;
INSERT INTO `tipo_actividad` VALUES (1,'Taller 1'),(2,'Taller 2'),(3,'Taller 3'),(4,'Taller 4'),(5,'Taller 5'),(6,'Evalucion final');
/*!40000 ALTER TABLE `tipo_actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(15) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `direccion` varchar(30) DEFAULT NULL,
  `clave` varchar(40) DEFAULT NULL,
  `rol_id` int(4) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identificacion` (`identificacion`),
  KEY `rol_id` (`rol_id`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'100100','Martha','Ordoñez','12344321','test@gmail.com','Cll. 19 # 3 - 1','202cb962ac59075b964b07152d234b70',1,1),(2,'100101','Pedro','Cifuentes López','12344321','test@gmail.com','Cll. 19 # 3 - 1','202cb962ac59075b964b07152d234b70',2,1),(3,'100102','Tipo','Peralta','12344321','test@gmail.com','Cll. 19 # 3 - 1','202cb962ac59075b964b07152d234b70',3,1),(4,'100103','Carlos','Zambrano','12344321','test@gmail.com','Cll. 19 # 3 - 1','202cb962ac59075b964b07152d234b70',4,1),(5,'100104','Desconocido','Desconocido','12344321','test@gmail.com','Cll. 19 # 3 - 1','202cb962ac59075b964b07152d234b70',5,1),(6,'100105','Super','Admin','12344321','test@gmail.com','Cll. 19 # 3 - 1','202cb962ac59075b964b07152d234b70',6,1),(7,'1085100100','Edgar','Muñoz Quenan','318555','leo@gmail.com','Las cuadras','f5624ad58b6c22764fe9cde2e2b14c02',2,1),(8,'200200','carlos','arias','123123','123correo@gmail.com','Las quintas de san pedro','c0d29696fc1eea771df60ff95a4772ff',2,1),(9,'300300','pedro','rodriguez','456789','correo@gmail.com','Corazon de jesus','c1a41159a94ed9bf45e035f6a2a2ca79',2,1),(10,'400400','pablo','cazanoba','753159','corr@gmail.com','las cuadras','60993fbe03e405d2e8a3b5ff3a3da0ab',2,1),(11,'500500','andres','nuñez','159489','gma@gmail.com','centro','52d710e0dc1cff3d59fb94fff0499f88',2,1),(12,'600600','oswaldo','caicedo','35748623','lolo@gmail.com','centro','e1b77e134717fc53615328dffe1243b8',2,1),(13,'45638111','Juan','Rosales','143265465','soal@gmail.com','asdfas','60b1bed66e12b0f7fe2d3e5a16e88048',4,1),(14,'52687','pepito','perez','465465','sss@gmail.com','santa martha','53e2efef8b2c6ee3511b8a9d51289fb6',4,1),(15,'369852147','Gloria','Jurado','23423','plata@ga.com','la plata','cc86a50fb8f3c4840cb346a0829f64a2',4,1),(16,'58223344','Carla','giraldo','23988','carl@gmail.com','las torres','ebb984c332fbc769447492cbfdb1d61f',4,1),(17,'3123568','jose','salsedo','878787','jos@gmail.com','la loma','dc273205ea79d74742ea062071561602',4,1),(18,'19990187','lila','gutierrez','7867887','li@gmail.com','lota','b5500c01bbdcf184a2b80b6a06280618',4,1),(19,'776621299','Luis alfredo','Quenan','86567656','juan@gmail.com','buenaventura','a6a117efd765b3eec9ffca8720633e98',4,1),(20,'86989111','Luisa','Bermuedez','8967876','ber@gmail.com','cota','19fac0babbf2310caf6ec02b493d8e1a',4,1),(21,'234234234','juan','benitez','89','ven@gmai.com','las cuadras','61b80f94cdd6d632f7bc38fd9ed91d9c',2,1),(22,'5452356','martin','aguirre','87786','mar@gmail.com','las cuadras','093194bbc36a6e62d1332180aed49933',2,1),(23,'90092074608','jorge','diaz','86986789','dgq@gmail.com','las cuadras','31cf42cc53eee73ac6f776231169eed5',2,1),(24,'23851001100','David','Perez','8786','coel@gmail.com','sta rita','6884c345df7c65f87e82fcf1300977e6',4,1),(25,'6767333','tes','te','11111','aaa@comr.cm','dds ','d3813a7cae2e05d76ead84ad422a5921',4,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-26  4:19:46
