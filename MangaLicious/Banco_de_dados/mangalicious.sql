-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/11/2024 às 20:32
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

create database mangalicious;
use mangalicious;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mangalicious`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `idavaliacao` int(10) UNSIGNED NOT NULL,
  `idmanga` int(10) UNSIGNED NOT NULL,
  `idusuario` int(10) UNSIGNED NOT NULL,
  `estrela` int(11) DEFAULT NULL,
  `comentario` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `genero`
--

CREATE TABLE `genero` (
  `idgenero` int(10) UNSIGNED NOT NULL,
  `descritivo` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `genero`
--

INSERT INTO `genero` (`idgenero`, `descritivo`) VALUES
(1, 'Suspense'),
(2, 'Ação'),
(3, 'Romance'),
(4, 'Terror'),
(6, 'Fantasia');

-- --------------------------------------------------------

--
-- Estrutura para tabela `manga`
--

CREATE TABLE `manga` (
  `idmanga` int(10) UNSIGNED NOT NULL,
  `idmangaka` int(10) UNSIGNED NOT NULL,
  `idgenero` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `data_publicacao` date DEFAULT NULL,
  `sinopse` text DEFAULT NULL,
  `imagem` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `manga`
--

INSERT INTO `manga` (`idmanga`, `idmangaka`, `idgenero`, `titulo`, `data_publicacao`, `sinopse`, `imagem`) VALUES
(1, 3, 1, 'Museum – O Assassino ri na Chuva', '2024-12-24', 'O Sargento Sawamura se vê em uma situação desesperadora. Depois de cair na armadilha do assassino da máscara de sapo, ele precisa encontrar uma maneira de escapar para salvar sua esposa e seu filho. Mas será que ele conseguirá fazer isso a tempo?', '811JuJ6A8fL._SY466_.jpg'),
(2, 2, 4, 'Demon Slayer - Kimetsu no Yaiba Vol. 1', '2020-04-13', 'Estamos na Era Taishou. O dia-a-dia pacato de Tanjiro, um gentil garoto que vende carvão, se transforma radicalmente quando sua família é assassinada por um demônio. A única sobrevivente é Nezuko, sua irmã mais nova. Porém, agora, ela se transformou em um Oni. Diante dessa tragédia, os dois irmãos partem em uma jornada para derrotar o Oni que matou sua mãe e irmãozinhos. E assim tem início uma aventura sanguinolenta de espadachins!', '71kvGR47G1L._SY466_.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `mangaka`
--

CREATE TABLE `mangaka` (
  `idmangaka` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `nacionalidade` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mangaka`
--

INSERT INTO `mangaka` (`idmangaka`, `nome`, `nacionalidade`) VALUES
(1, 'Maria meio feia', 'brasileira'),
(2, 'Paulo Souza', 'Brasileira'),
(3, 'mangakona', 'hsgjahdajgsj'),
(4, 'Maria Bonita', 'Brasileira');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `perfil` enum('Administrador','Usuario') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `email`, `senha`, `perfil`) VALUES
(10, 'Josué Rodrigues', 'hayatorodrigues69@gmail.com', '$2y$10$OP3id2ZcUtN09Cos79WKduCjXJTNlrXqI1oGgEenf9Q1W3TNK99yK', 'Administrador');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`idavaliacao`),
  ADD KEY `avaliacao_FKIndex1` (`idusuario`),
  ADD KEY `avaliacao_FKIndex2` (`idmanga`);

--
-- Índices de tabela `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`idgenero`);

--
-- Índices de tabela `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`idmanga`),
  ADD KEY `manga_FKIndex1` (`idgenero`),
  ADD KEY `manga_FKIndex2` (`idmangaka`);

--
-- Índices de tabela `mangaka`
--
ALTER TABLE `mangaka`
  ADD PRIMARY KEY (`idmangaka`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `idavaliacao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `genero`
--
ALTER TABLE `genero`
  MODIFY `idgenero` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `manga`
--
ALTER TABLE `manga`
  MODIFY `idmanga` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `mangaka`
--
ALTER TABLE `mangaka`
  MODIFY `idmangaka` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `avaliacao_ibfk_2` FOREIGN KEY (`idmanga`) REFERENCES `manga` (`idmanga`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `manga`
--
ALTER TABLE `manga`
  ADD CONSTRAINT `manga_ibfk_1` FOREIGN KEY (`idgenero`) REFERENCES `genero` (`idgenero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `manga_ibfk_2` FOREIGN KEY (`idmangaka`) REFERENCES `mangaka` (`idmangaka`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
