-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13-Abr-2022 às 00:16
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `fridas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pratos`
--

DROP TABLE IF EXISTS `tb_pratos`;
CREATE TABLE IF NOT EXISTS `tb_pratos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_prato` varchar(90) NOT NULL,
  `descricao_prato` varchar(255) NOT NULL,
  `preco_prato` double NOT NULL,
  `especial_mes` varchar(3) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `categoria_prato` varchar(255) NOT NULL,
  `restricao_alimentar` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_pratos`
--

INSERT INTO `tb_pratos` (`id`, `nome_prato`, `descricao_prato`, `preco_prato`, `especial_mes`, `imagem`, `categoria_prato`, `restricao_alimentar`) VALUES
(1, 'HAMBÚRGUER MEXICANO', 'HAMBÚRGUER MEXICANO 200GR, MOLHO 2 EM 1, MOLHO CHIPOTLE, MOLHO SOUR CREAM, PÃO BRIOCHE, QUEIJO CHEDDAR, QUEIJO MUZZARELA, TORTILLA', 34.99, 'Não', '89ddf1a26a5854b943fdfd71786c47d6.jpg', 'hamburguer', 'Sim'),
(6, 'BURRITO BARBACOA ENTRECOT 500G', 'SOUR CREAM NO POTINHO, BATATA FRITA, BARBACOA DE ENTRECOT, FATIAS DE AVOCADO', 35.99, 'Não', '4c1558cb8a4c2f65fe0cae1106f13dd9.jpg', 'burritos', 'Não');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

DROP TABLE IF EXISTS `tb_usuarios`;
CREATE TABLE IF NOT EXISTS `tb_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id`, `nome`, `usuario`, `senha`) VALUES
(1, 'guilherme', 'admin', '1234');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
