-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/06/2023 às 07:17
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pdsi2`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `acesso`
--

CREATE TABLE `acesso` (
  `id_acesso` int(11) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `senha` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `acesso`:
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `comentario` text DEFAULT NULL,
  `data` date DEFAULT NULL,
  `fk_usuario` varchar(11) NOT NULL,
  `fk_topico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `comentario`:
--   `fk_topico`
--       `topico` -> `id_topico`
--   `fk_usuario`
--       `usuario` -> `id_usuario`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `contato`
--

CREATE TABLE `contato` (
  `id_contato` int(11) NOT NULL,
  `email_pessoal` varchar(45) DEFAULT NULL,
  `email_ufu` varchar(45) DEFAULT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `rua` varchar(45) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cep` varchar(45) DEFAULT NULL,
  `complemento` varchar(45) DEFAULT NULL,
  `rede_social` varchar(200) DEFAULT NULL,
  `rede_social_url` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `contato`:
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `experiencia_concluida`
--

CREATE TABLE `experiencia_concluida` (
  `id_experiencia_concluida` int(11) NOT NULL,
  `formacao` varchar(45) DEFAULT NULL,
  `instituicao` varchar(45) DEFAULT NULL,
  `conclusao` date DEFAULT NULL,
  `titulo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `experiencia_concluida`:
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `experiencia_profissional`
--

CREATE TABLE `experiencia_profissional` (
  `id_experiencia_profissional` int(11) NOT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  `empresa` varchar(45) DEFAULT NULL,
  `area` varchar(45) DEFAULT NULL,
  `salario` float DEFAULT NULL,
  `local` varchar(45) DEFAULT NULL,
  `descricao` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `experiencia_profissional`:
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `topico`
--

CREATE TABLE `topico` (
  `id_topico` int(11) NOT NULL,
  `assunto` varchar(50) DEFAULT NULL,
  `conteudo` text DEFAULT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `fk_usuario` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `topico`:
--   `fk_usuario`
--       `usuario` -> `id_usuario`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` varchar(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `foto` longblob DEFAULT NULL,
  `resumo` varchar(500) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `fk_contato` int(11) NOT NULL,
  `fk_experiencia_concluida` int(11) NOT NULL,
  `fk_experiencia_profissional` int(11) NOT NULL,
  `fk_acesso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `usuario`:
--   `fk_acesso`
--       `acesso` -> `id_acesso`
--   `fk_contato`
--       `contato` -> `id_contato`
--   `fk_experiencia_concluida`
--       `experiencia_concluida` -> `id_experiencia_concluida`
--   `fk_experiencia_profissional`
--       `experiencia_profissional` -> `id_experiencia_profissional`
--

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `acesso`
--
ALTER TABLE `acesso`
  ADD PRIMARY KEY (`id_acesso`);

--
-- Índices de tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `fk_comentario_usuario1_idx` (`fk_usuario`),
  ADD KEY `fk_comentario_topico1_idx` (`fk_topico`);

--
-- Índices de tabela `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id_contato`);

--
-- Índices de tabela `experiencia_concluida`
--
ALTER TABLE `experiencia_concluida`
  ADD PRIMARY KEY (`id_experiencia_concluida`);

--
-- Índices de tabela `experiencia_profissional`
--
ALTER TABLE `experiencia_profissional`
  ADD PRIMARY KEY (`id_experiencia_profissional`);

--
-- Índices de tabela `topico`
--
ALTER TABLE `topico`
  ADD PRIMARY KEY (`id_topico`),
  ADD KEY `fk_topico_usuario1_idx` (`fk_usuario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuario_contato_idx` (`fk_contato`),
  ADD KEY `fk_usuario_experiencia_concluida1_idx` (`fk_experiencia_concluida`),
  ADD KEY `fk_usuario_experiencia_profissional1_idx` (`fk_experiencia_profissional`),
  ADD KEY `fk_usuario_acesso1_idx` (`fk_acesso`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acesso`
--
ALTER TABLE `acesso`
  MODIFY `id_acesso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contato`
--
ALTER TABLE `contato`
  MODIFY `id_contato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `experiencia_concluida`
--
ALTER TABLE `experiencia_concluida`
  MODIFY `id_experiencia_concluida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `experiencia_profissional`
--
ALTER TABLE `experiencia_profissional`
  MODIFY `id_experiencia_profissional` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `topico`
--
ALTER TABLE `topico`
  MODIFY `id_topico` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_comentario_topico1` FOREIGN KEY (`fk_topico`) REFERENCES `topico` (`id_topico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comentario_usuario1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `topico`
--
ALTER TABLE `topico`
  ADD CONSTRAINT `fk_topico_usuario1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_acesso1` FOREIGN KEY (`fk_acesso`) REFERENCES `acesso` (`id_acesso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_contato` FOREIGN KEY (`fk_contato`) REFERENCES `contato` (`id_contato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_experiencia_concluida1` FOREIGN KEY (`fk_experiencia_concluida`) REFERENCES `experiencia_concluida` (`id_experiencia_concluida`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_experiencia_profissional1` FOREIGN KEY (`fk_experiencia_profissional`) REFERENCES `experiencia_profissional` (`id_experiencia_profissional`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
