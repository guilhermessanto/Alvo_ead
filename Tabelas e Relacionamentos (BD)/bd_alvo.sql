-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Set-2022 às 13:25
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_alvo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `indicador` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `ctrAcesso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `descCategoria` varchar(50) NOT NULL,
  `indicador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `descCategoria`, `indicador`) VALUES
(1, 'Ouro', NULL),
(2, 'Prata', NULL),
(3, 'Bronze', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `controlecursos`
--

CREATE TABLE `controlecursos` (
  `id` int(11) NOT NULL,
  `descCtrCurso` varchar(100) NOT NULL,
  `aluno_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ctracessos`
--

CREATE TABLE `ctracessos` (
  `id` int(11) NOT NULL,
  `indicador` int(11) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `generico_id` int(11) NOT NULL,
  `nivel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ctracessos`
--

INSERT INTO `ctracessos` (`id`, `indicador`, `senha`, `generico_id`, `nivel_id`) VALUES
(1, 0, '$2y$10$MCwfKx81Qd8nEQAyk68PauikXKQba1ae0i7xojhCo//8I8/7vfxga', 1, 1),
(2, 0, '$2y$10$fhLvUqUBssjbSqKOFqLjgeq9FHzOmiPemMtwa6NQjtdeZlMDFfmsS', 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nomeCurso` varchar(200) NOT NULL,
  `descCurso` varchar(200) NOT NULL,
  `indicador` int(11) DEFAULT NULL,
  `imagem` varchar(200) DEFAULT NULL,
  `modalidade_id` int(11) NOT NULL,
  `instrutor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `genericos`
--

CREATE TABLE `genericos` (
  `id` int(11) NOT NULL,
  `tipoFavorecido` int(11) NOT NULL,
  `cnpjcpf` varchar(30) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `endereco` varchar(60) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(60) DEFAULT NULL,
  `cidade` varchar(60) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `codMunicipio` varchar(7) DEFAULT NULL,
  `ctrAcesso_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `genericos`
--

INSERT INTO `genericos` (`id`, `tipoFavorecido`, `cnpjcpf`, `nome`, `email`, `telefone`, `cep`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `codMunicipio`, `ctrAcesso_id`) VALUES
(1, 1, '99999999999999', 'Alvo EAD - Administrador', 'admin@alvoead.com.br', '(11) 99999-8877', '03639-000', 'Rua Francisco Coimbra', '403', 'Penha de França', 'Penha', 'São Paulo', 'SP', '3550308', 1),
(2, 1, '88888888888888', 'Alvo EAD - Instrutor', 'instrutor@alvoead.com.br', '', '03639-000', 'Rua Francisco Coimbra', '403', 'Penha de França', 'Penha de França', 'São Paulo', 'SP', '3550308', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `instrutores`
--

CREATE TABLE `instrutores` (
  `id` int(11) NOT NULL,
  `limiteCurso` int(11) NOT NULL,
  `indicador` int(11) DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  `ctrAcesso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `instrutores`
--

INSERT INTO `instrutores` (`id`, `limiteCurso`, `indicador`, `categoria_id`, `ctrAcesso_id`) VALUES
(1, 99, 0, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modalidades`
--

CREATE TABLE `modalidades` (
  `id` int(11) NOT NULL,
  `codModalidade` int(11) NOT NULL,
  `descModalidade` varchar(100) NOT NULL,
  `indicador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `modalidades`
--

INSERT INTO `modalidades` (`id`, `codModalidade`, `descModalidade`, `indicador`) VALUES
(1, 10, 'Informática', NULL),
(2, 20, 'Mecânica', NULL),
(3, 30, 'Culinária', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `niveis`
--

CREATE TABLE `niveis` (
  `id` int(11) NOT NULL,
  `codNivel` int(11) NOT NULL,
  `descNivel` varchar(50) NOT NULL,
  `indicador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `niveis`
--

INSERT INTO `niveis` (`id`, `codNivel`, `descNivel`, `indicador`) VALUES
(1, 1, 'Adminstrador', NULL),
(2, 3, 'Instrutor', NULL),
(3, 5, 'Aluno', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `nomeVideo` varchar(150) NOT NULL,
  `link` varchar(100) NOT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_alunos_ctrAcessos` (`ctrAcesso_id`),
  ADD KEY `fk_alunos_cursos` (`curso_id`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `controlecursos`
--
ALTER TABLE `controlecursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_controleCursos_alunos` (`aluno_id`);

--
-- Índices para tabela `ctracessos`
--
ALTER TABLE `ctracessos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ctrAcessos_genericos` (`generico_id`),
  ADD KEY `fk_ctrAcessos_niveis` (`nivel_id`);

--
-- Índices para tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cursos_modalidades` (`modalidade_id`),
  ADD KEY `fk_cursos_instrutores` (`instrutor_id`);

--
-- Índices para tabela `genericos`
--
ALTER TABLE `genericos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnpjcpf` (`cnpjcpf`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `instrutores`
--
ALTER TABLE `instrutores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_instrutores_categorias` (`categoria_id`),
  ADD KEY `fk_instrutores_ctrAcessos` (`ctrAcesso_id`);

--
-- Índices para tabela `modalidades`
--
ALTER TABLE `modalidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `niveis`
--
ALTER TABLE `niveis`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_videos_cursos` (`curso_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `controlecursos`
--
ALTER TABLE `controlecursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ctracessos`
--
ALTER TABLE `ctracessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `genericos`
--
ALTER TABLE `genericos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `instrutores`
--
ALTER TABLE `instrutores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `modalidades`
--
ALTER TABLE `modalidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `niveis`
--
ALTER TABLE `niveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `alunos`
--
ALTER TABLE `alunos`
  ADD CONSTRAINT `fk_alunos_ctrAcessos` FOREIGN KEY (`ctrAcesso_id`) REFERENCES `ctracessos` (`id`),
  ADD CONSTRAINT `fk_alunos_cursos` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);

--
-- Limitadores para a tabela `controlecursos`
--
ALTER TABLE `controlecursos`
  ADD CONSTRAINT `fk_controleCursos_alunos` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id`);

--
-- Limitadores para a tabela `ctracessos`
--
ALTER TABLE `ctracessos`
  ADD CONSTRAINT `fk_ctrAcessos_genericos` FOREIGN KEY (`generico_id`) REFERENCES `genericos` (`id`),
  ADD CONSTRAINT `fk_ctrAcessos_niveis` FOREIGN KEY (`nivel_id`) REFERENCES `niveis` (`id`);

--
-- Limitadores para a tabela `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `fk_cursos_instrutores` FOREIGN KEY (`instrutor_id`) REFERENCES `instrutores` (`id`),
  ADD CONSTRAINT `fk_cursos_modalidades` FOREIGN KEY (`modalidade_id`) REFERENCES `modalidades` (`id`);

--
-- Limitadores para a tabela `instrutores`
--
ALTER TABLE `instrutores`
  ADD CONSTRAINT `fk_instrutores_categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `fk_instrutores_ctrAcessos` FOREIGN KEY (`ctrAcesso_id`) REFERENCES `ctracessos` (`id`);

--
-- Limitadores para a tabela `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `fk_videos_cursos` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
