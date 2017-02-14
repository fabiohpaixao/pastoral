-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: db_gemp
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `acessos`
--

DROP TABLE IF EXISTS `acessos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acessos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acessos`
--

LOCK TABLES `acessos` WRITE;
/*!40000 ALTER TABLE `acessos` DISABLE KEYS */;
INSERT INTO `acessos` VALUES (23,8,1),(45,8,2),(46,8,3),(47,8,4),(48,8,5),(78,8,6),(79,8,7),(80,8,8),(81,8,9),(82,8,10),(83,8,11),(84,8,12),(85,8,13),(86,8,14),(88,8,15),(89,1,1),(90,1,2),(91,1,3),(92,1,4),(93,1,5),(94,1,6),(95,1,7),(96,1,8),(97,1,9),(98,1,10),(99,1,11),(100,1,12),(101,1,13),(102,1,14),(103,1,15),(104,1,16),(105,1,17),(106,1,18),(107,1,19),(108,1,20),(109,1,21),(110,1,22),(111,1,23),(112,1,24),(113,1,25),(114,1,26),(115,1,27),(116,1,28),(117,1,29),(118,1,30);
/*!40000 ALTER TABLE `acessos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) COLLATE utf8_bin NOT NULL,
  `chave` varchar(20) COLLATE utf8_bin NOT NULL,
  `ordem` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_areas_areas1_idx` (`area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (2,'Usuários','usuarios',1,4),(3,'Grupos','grupos',2,4),(4,'Segurança','lock',2,4),(5,'Configurações','cog',3,5),(6,'Áreas','areas',3,4),(7,'Geral','geral',1,7),(8,'Conteúdo','pencil',1,8),(9,'Posts','posts',1,5),(10,'Páginas','pages',4,5),(11,'Comentários','comentarios',2,5),(12,'Imagens','imagens',5,5),(13,'Categorias','categorias',3,5),(14,'Cadastros','th-list',1,14),(15,'Especialidade','especialidades',1,14),(16,'Clientes','clientes',2,14),(17,'Despesas','despesas',3,14),(18,'Distribuidores','distribuidores',4,14),(19,'Materiais','materiais',6,14),(20,'Módulos','th-large',0,20),(21,'Colaboradores','colaboradores',8,14),(22,'Orçamentos','orcamentos',1,20),(23,'Feriados','feriados',3,14),(24,'Boleto','boletos',9,14),(25,'Notas Fiscais','notasfiscais',2,20);
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `boletos`
--

DROP TABLE IF EXISTS `boletos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boletos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(45) DEFAULT NULL,
  `data_pgto` date DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `nota_fiscal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_boletos_notas_fiscais1_idx` (`nota_fiscal_id`),
  CONSTRAINT `fk_boletos_notas_fiscais1` FOREIGN KEY (`nota_fiscal_id`) REFERENCES `notas_fiscais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boletos`
--

LOCK TABLES `boletos` WRITE;
/*!40000 ALTER TABLE `boletos` DISABLE KEYS */;
/*!40000 ALTER TABLE `boletos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) COLLATE utf8_bin NOT NULL,
  `icone` varchar(10) COLLATE utf8_bin NOT NULL,
  `descricao` text COLLATE utf8_bin NOT NULL,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_categorias_categorias1_idx` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Notícias','file','',0),(2,'Dicas','tip','',0);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `fator` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Focus',20);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colaboradores`
--

DROP TABLE IF EXISTS `colaboradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colaboradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `valor_hora` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colaboradores`
--

LOCK TABLES `colaboradores` WRITE;
/*!40000 ALTER TABLE `colaboradores` DISABLE KEYS */;
INSERT INTO `colaboradores` VALUES (1,'Thiago Silva',200),(2,'Panettone',100);
/*!40000 ALTER TABLE `colaboradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracoes`
--

DROP TABLE IF EXISTS `configuracoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chave` varchar(50) COLLATE utf8_bin NOT NULL,
  `valor` varchar(200) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracoes`
--

LOCK TABLES `configuracoes` WRITE;
/*!40000 ALTER TABLE `configuracoes` DISABLE KEYS */;
INSERT INTO `configuracoes` VALUES (1,'titulo','GEMP - Gestão Empresarial'),(2,'slogan',''),(3,'email','fabioh.paixao@gmail.com');
/*!40000 ALTER TABLE `configuracoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `despesas`
--

DROP TABLE IF EXISTS `despesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despesas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despesas`
--

LOCK TABLES `despesas` WRITE;
/*!40000 ALTER TABLE `despesas` DISABLE KEYS */;
INSERT INTO `despesas` VALUES (1,'Transporte','Valor do transporte',200),(3,'Cafezinho','cafe',20);
/*!40000 ALTER TABLE `despesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distribuidores`
--

DROP TABLE IF EXISTS `distribuidores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distribuidores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distribuidores`
--

LOCK TABLES `distribuidores` WRITE;
/*!40000 ALTER TABLE `distribuidores` DISABLE KEYS */;
INSERT INTO `distribuidores` VALUES (1,'Panettoni\'s Enterpraise');
/*!40000 ALTER TABLE `distribuidores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidades`
--

DROP TABLE IF EXISTS `especialidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especialidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) COLLATE utf8_bin NOT NULL,
  `valor` float NOT NULL,
  `colaborador_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_specialties_colaboradores1_idx` (`colaborador_id`),
  CONSTRAINT `fk_specialties_colaboradores1` FOREIGN KEY (`colaborador_id`) REFERENCES `colaboradores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidades`
--

LOCK TABLES `especialidades` WRITE;
/*!40000 ALTER TABLE `especialidades` DISABLE KEYS */;
INSERT INTO `especialidades` VALUES (1,'Programação',200,1),(2,'Ajudantes',50,1);
/*!40000 ALTER TABLE `especialidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feriados`
--

DROP TABLE IF EXISTS `feriados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feriados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date DEFAULT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feriados`
--

LOCK TABLES `feriados` WRITE;
/*!40000 ALTER TABLE `feriados` DISABLE KEYS */;
INSERT INTO `feriados` VALUES (1,'2015-02-10','sdf'),(2,'2014-05-07','df');
/*!40000 ALTER TABLE `feriados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos`
--

LOCK TABLES `grupos` WRITE;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` VALUES (1,'Administrador'),(2,'Editor'),(3,'Analista'),(8,'Kadmin');
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiais`
--

DROP TABLE IF EXISTS `materiais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materiais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `fabricante` varchar(45) DEFAULT NULL,
  `imposto` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiais`
--

LOCK TABLES `materiais` WRITE;
/*!40000 ALTER TABLE `materiais` DISABLE KEYS */;
INSERT INTO `materiais` VALUES (6,'Canaleta','df','Rock',0);
/*!40000 ALTER TABLE `materiais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiais_distribuidores`
--

DROP TABLE IF EXISTS `materiais_distribuidores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materiais_distribuidores` (
  `material_id` int(11) NOT NULL,
  `distribuidor_id` int(11) NOT NULL,
  `valor` double DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`,`material_id`,`distribuidor_id`),
  KEY `fk_materiais_distribuidores_materiais1_idx` (`material_id`),
  KEY `fk_materiais_distribuidores_distribuidores1_idx` (`distribuidor_id`),
  CONSTRAINT `fk_materiais_distribuidores_distribuidores1` FOREIGN KEY (`distribuidor_id`) REFERENCES `distribuidores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_materiais_distribuidores_materiais1` FOREIGN KEY (`material_id`) REFERENCES `materiais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiais_distribuidores`
--

LOCK TABLES `materiais_distribuidores` WRITE;
/*!40000 ALTER TABLE `materiais_distribuidores` DISABLE KEYS */;
INSERT INTO `materiais_distribuidores` VALUES (6,1,100,3,'Canaletas - Pannetone');
/*!40000 ALTER TABLE `materiais_distribuidores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notas_fiscais`
--

DROP TABLE IF EXISTS `notas_fiscais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notas_fiscais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(5) unsigned zerofill NOT NULL,
  `fornecedor` varchar(50) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `transporte` tinyint(4) DEFAULT NULL,
  `nota_tranporte` varchar(45) DEFAULT NULL,
  `comprovante_pgto` varchar(45) DEFAULT NULL,
  `comprovante_transportadora` varchar(45) DEFAULT NULL,
  `jp_nf` tinyint(4) DEFAULT NULL,
  `jp_boleto` tinyint(4) DEFAULT NULL,
  `jp_comprovante` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero_UNIQUE` (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notas_fiscais`
--

LOCK TABLES `notas_fiscais` WRITE;
/*!40000 ALTER TABLE `notas_fiscais` DISABLE KEYS */;
/*!40000 ALTER TABLE `notas_fiscais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orcamentos`
--

DROP TABLE IF EXISTS `orcamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orcamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(45) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `qtd_horas_normais` float DEFAULT NULL,
  `qtd_horas_extra` float DEFAULT NULL,
  `qtd_horas_noturna` float DEFAULT NULL,
  `fator_retrabalho` float DEFAULT NULL,
  `imposto` float DEFAULT NULL,
  `valor` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orcamentos`
--

LOCK TABLES `orcamentos` WRITE;
/*!40000 ALTER TABLE `orcamentos` DISABLE KEYS */;
INSERT INTO `orcamentos` VALUES (10,'C001',1,200,10,5,5,8,3926650);
/*!40000 ALTER TABLE `orcamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orcamentos_clientes`
--

DROP TABLE IF EXISTS `orcamentos_clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orcamentos_clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orcamento_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orcamento_cliente_orcamentos1_idx` (`orcamento_id`),
  KEY `fk_orcamento_cliente_clientes1_idx` (`cliente_id`),
  CONSTRAINT `fk_orcamento_cliente_clientes1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orcamento_cliente_orcamentos1` FOREIGN KEY (`orcamento_id`) REFERENCES `orcamentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orcamentos_clientes`
--

LOCK TABLES `orcamentos_clientes` WRITE;
/*!40000 ALTER TABLE `orcamentos_clientes` DISABLE KEYS */;
INSERT INTO `orcamentos_clientes` VALUES (11,10,1);
/*!40000 ALTER TABLE `orcamentos_clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orcamentos_despesas`
--

DROP TABLE IF EXISTS `orcamentos_despesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orcamentos_despesas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orcamento_id` int(11) NOT NULL,
  `despesa_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orcamento_despesa_orcamentos1_idx` (`orcamento_id`),
  KEY `fk_orcamento_despesa_despesas1_idx` (`despesa_id`),
  CONSTRAINT `fk_orcamento_despesa_despesas1` FOREIGN KEY (`despesa_id`) REFERENCES `despesas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orcamento_despesa_orcamentos1` FOREIGN KEY (`orcamento_id`) REFERENCES `orcamentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orcamentos_despesas`
--

LOCK TABLES `orcamentos_despesas` WRITE;
/*!40000 ALTER TABLE `orcamentos_despesas` DISABLE KEYS */;
INSERT INTO `orcamentos_despesas` VALUES (18,10,1),(19,10,3);
/*!40000 ALTER TABLE `orcamentos_despesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orcamentos_especialidades`
--

DROP TABLE IF EXISTS `orcamentos_especialidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orcamentos_especialidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orcamento_id` int(11) NOT NULL,
  `especialidade_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orcamento_especialidade_orcamentos1_idx` (`orcamento_id`),
  KEY `fk_orcamento_especialidade_especialidades1_idx` (`especialidade_id`),
  CONSTRAINT `fk_orcamento_especialidade_especialidades1` FOREIGN KEY (`especialidade_id`) REFERENCES `especialidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orcamento_especialidade_orcamentos1` FOREIGN KEY (`orcamento_id`) REFERENCES `orcamentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orcamentos_especialidades`
--

LOCK TABLES `orcamentos_especialidades` WRITE;
/*!40000 ALTER TABLE `orcamentos_especialidades` DISABLE KEYS */;
INSERT INTO `orcamentos_especialidades` VALUES (13,10,1),(14,10,2);
/*!40000 ALTER TABLE `orcamentos_especialidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orcamentos_materiais_distribuidores`
--

DROP TABLE IF EXISTS `orcamentos_materiais_distribuidores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orcamentos_materiais_distribuidores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orcamento_id` int(11) NOT NULL,
  `material_distribuidor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orcamento_material_orcamentos1_idx` (`orcamento_id`),
  KEY `fk_orcamento_material_materiais_distribuidores1_idx` (`material_distribuidor_id`),
  CONSTRAINT `fk_orcamento_material_materiais_distribuidores1` FOREIGN KEY (`material_distribuidor_id`) REFERENCES `materiais_distribuidores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orcamento_material_orcamentos1` FOREIGN KEY (`orcamento_id`) REFERENCES `orcamentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orcamentos_materiais_distribuidores`
--

LOCK TABLES `orcamentos_materiais_distribuidores` WRITE;
/*!40000 ALTER TABLE `orcamentos_materiais_distribuidores` DISABLE KEYS */;
INSERT INTO `orcamentos_materiais_distribuidores` VALUES (6,10,3);
/*!40000 ALTER TABLE `orcamentos_materiais_distribuidores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `usuario` varchar(10) COLLATE utf8_bin NOT NULL,
  `senha` varchar(500) COLLATE utf8_bin NOT NULL,
  `telefone` varchar(14) COLLATE utf8_bin NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `modificado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `criado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `acesso` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `avatar` varchar(200) COLLATE utf8_bin NOT NULL,
  `token` varchar(40) COLLATE utf8_bin NOT NULL,
  `token_expira` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (66,'Analista Santos','13131232@123.com','analista','575145cb76d2952586135fb4c5824fcf82c9c462','(12)3131-3131',1,3,'2015-02-18 12:53:10','0000-00-00 00:00:00','0000-00-00 00:00:00','','','0000-00-00 00:00:00'),(67,'Kaynak Dev','me@luizotcarvalho.com.br','kaynak','575145cb76d2952586135fb4c5824fcf82c9c462','(12)3207-4077',1,1,'2015-02-26 16:21:44','0000-00-00 00:00:00','2015-02-26 04:21:44','img/uploads/67/photo.jpg','','2014-01-14 13:37:56'),(68,'Administrador','vavarl1@gmail.com','admin','575145cb76d2952586135fb4c5824fcf82c9c462','(19)0000-0000',1,1,'2015-03-02 18:41:56','2015-02-18 11:15:06','2015-03-02 06:41:56','uploads/photo.jpg','','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-02 17:15:36
