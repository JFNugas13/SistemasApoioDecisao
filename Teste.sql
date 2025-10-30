test-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- A despejar estrutura da base de dados para test
CREATE DATABASE IF NOT EXISTS `stand` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `stand`;

-- A despejar estrutura para tabela test.automoveis
CREATE TABLE IF NOT EXISTS `automoveis` (
  `id_carros` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) NOT NULL,
  `caixa` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `ano_lancamento` date NOT NULL,
  `tipo_compbustivel` varchar(50) NOT NULL,
  `condicao` varchar(50) NOT NULL,
  `preco` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `id_fornecedor` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_carros`),
  UNIQUE KEY `id_carros` (`id_carros`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `automoveis` (`id_carros`, `marca`, `caixa`, `modelo`, `ano_lancamento`, `tipo_compbustivel`, `condicao`, `preco`, `id_fornecedor`) VALUES
	(1, 'AUDI', 'MANUAL', 'R8', '2021-01-01', 'GASOLINA', 'USADO', 1800, 1);

-- A despejar estrutura para tabela test.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '',
  `morada` varchar(50) NOT NULL,
  `telefone` int(11) NOT NULL,
  `email` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;



-- A despejar estrutura para tabela test.colaboradores
CREATE TABLE IF NOT EXISTS `colaboradores` (
  `id_col` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL DEFAULT '*',
  `salario` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `morada` varchar(50) NOT NULL,
  `telefone` int(11) NOT NULL,
  PRIMARY KEY (`id_col`),
  UNIQUE KEY `id_col` (`id_col`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- A despejar dados para tabela test.colaboradores: ~1 rows (aproximadamente)
INSERT INTO `colaboradores` (`id_col`, `nome`, `email`, `password`, `salario`, `morada`, `telefone`) VALUES
	(1, 'cliente_1', 'adm@gmail.com', 'teste123', 0.000000, '', 915547895);

-- A despejar estrutura para tabela test.fornecedor
CREATE TABLE IF NOT EXISTS `fornecedor` (
  `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '',
  `contacto` varchar(50) NOT NULL DEFAULT '0',
  `preco_compra` decimal(20,6) NOT NULL DEFAULT 0.000000,
  PRIMARY KEY (`id_fornecedor`),
  UNIQUE KEY `id_fornecedor` (`id_fornecedor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- A despejar dados para tabela test.fornecedor: ~1 rows (aproximadamente)
INSERT INTO `fornecedor` (`id_fornecedor`, `nome`, `contacto`, `preco_compra`) VALUES
	(1, 'Ricardo', '9122547956', 0.000000);

-- A despejar estrutura para tabela test.venda_automoveis
CREATE TABLE IF NOT EXISTS `venda_automoveis` (
  `id_vendas` int(11) NOT NULL AUTO_INCREMENT,
  `id_carros` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_col` int(11) NOT NULL,
  `data_venda` date NOT NULL,
  PRIMARY KEY (`id_vendas`),
  UNIQUE KEY `id_vendas` (`id_vendas`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_carros` (`id_carros`),
  KEY `id_col` (`id_col`),
  CONSTRAINT `id_carros` FOREIGN KEY (`id_carros`) REFERENCES `automoveis` (`id_carros`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_col` FOREIGN KEY (`id_col`) REFERENCES `colaboradores` (`id_col`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;



/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
