-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/04/2026 às 02:12
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `petshop`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamentos`
--

DROP TABLE IF EXISTS `agendamentos`;
CREATE TABLE `agendamentos` (
  `id_agend` int(11) NOT NULL,
  `data_agend` date NOT NULL,
  `hora_agend_inicio` time NOT NULL,
  `hora_agend_fim` time NOT NULL,
  `data_criacao_agend` datetime NOT NULL,
  `status_agend` varchar(50) NOT NULL,
  `descricao_agend` varchar(255) DEFAULT NULL,
  `cliente_id_agend` int(11) NOT NULL,
  `pet_id_agend` int(11) NOT NULL,
  `responsavel_id_agend` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamentos_servicos`
--

DROP TABLE IF EXISTS `agendamentos_servicos`;
CREATE TABLE `agendamentos_servicos` (
  `id_agend_serv` int(11) NOT NULL,
  `orcamento` decimal(10,2) NOT NULL,
  `executado` varchar(3) NOT NULL DEFAULT 'nao',
  `id_agend_fk` int(11) NOT NULL,
  `id_serv_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `atendimentos`
--

DROP TABLE IF EXISTS `atendimentos`;
CREATE TABLE `atendimentos` (
  `id_atendimento` int(11) NOT NULL,
  `anamnese` varchar(255) NOT NULL,
  `diagnostico` varchar(255) NOT NULL,
  `tratamento` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `id_agend` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `veterinario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `especies`
--

DROP TABLE IF EXISTS `especies`;
CREATE TABLE `especies` (
  `id_especie` int(11) NOT NULL,
  `nome_especie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `estetica`
--

DROP TABLE IF EXISTS `estetica`;
CREATE TABLE `estetica` (
  `id_estetica` int(11) NOT NULL,
  `observacao` varchar(255) NOT NULL,
  `id_agend_fk` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pets`
--

DROP TABLE IF EXISTS `pets`;
CREATE TABLE `pets` (
  `id_pet` int(11) NOT NULL,
  `nome_pet` varchar(255) NOT NULL,
  `sexo_pet` varchar(5) NOT NULL,
  `cor_pet` varchar(100) NOT NULL,
  `peso_pet` decimal(10,2) NOT NULL,
  `cliente_id_fk` int(11) NOT NULL,
  `especie_id_fk` int(11) NOT NULL,
  `raca_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `racas`
--

DROP TABLE IF EXISTS `racas`;
CREATE TABLE `racas` (
  `id_raca` int(11) NOT NULL,
  `nome_raca` varchar(255) NOT NULL,
  `id_especie_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

DROP TABLE IF EXISTS `servicos`;
CREATE TABLE `servicos` (
  `id_servico` int(11) NOT NULL,
  `nome_servico` varchar(255) NOT NULL,
  `preco_servico` decimal(10,2) NOT NULL,
  `categoria_servico` varchar(8) NOT NULL,
  `duracao_minutos` int(11) NOT NULL,
  `descricao_servico` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `telefone` varchar(15) NOT NULL,
  `role` varchar(11) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `primeiro_acesso` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vacinacao`
--

DROP TABLE IF EXISTS `vacinacao`;
CREATE TABLE `vacinacao` (
  `id_vacinacao` int(11) NOT NULL,
  `data_aplicacao` date NOT NULL,
  `data_prox_dose` date NOT NULL,
  `created_at` datetime NOT NULL,
  `id_agend_vacinacao` int(11) NOT NULL,
  `id_cliente_vacinacao` int(11) NOT NULL,
  `id_pet_vacinacao` int(11) NOT NULL,
  `id_vet_vacinacao` int(11) NOT NULL,
  `id_vacina_servico` int(11) NOT NULL,
  `resolvido` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `veterinarios`
--

DROP TABLE IF EXISTS `veterinarios`;
CREATE TABLE `veterinarios` (
  `id_veterinario` int(11) NOT NULL,
  `crmv` varchar(50) NOT NULL,
  `especialidade` varchar(50) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id_agend`),
  ADD KEY `cliente_id_agend_fk` (`cliente_id_agend`),
  ADD KEY `pet_id_agend_fk` (`pet_id_agend`),
  ADD KEY `resp_id_agend_fk` (`responsavel_id_agend`);

--
-- Índices de tabela `agendamentos_servicos`
--
ALTER TABLE `agendamentos_servicos`
  ADD PRIMARY KEY (`id_agend_serv`),
  ADD KEY `id_agend_servicos_fk` (`id_agend_fk`),
  ADD KEY `id_agend_servivos_serv_fk` (`id_serv_fk`);

--
-- Índices de tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD PRIMARY KEY (`id_atendimento`),
  ADD KEY `cliente_id_atend_fk` (`cliente_id`),
  ADD KEY `agend_id_atend_fk` (`id_agend`),
  ADD KEY `pet_id_atend_fk` (`pet_id`),
  ADD KEY `vet_id_atend_fk` (`veterinario_id`);

--
-- Índices de tabela `especies`
--
ALTER TABLE `especies`
  ADD PRIMARY KEY (`id_especie`);

--
-- Índices de tabela `estetica`
--
ALTER TABLE `estetica`
  ADD PRIMARY KEY (`id_estetica`),
  ADD KEY `agend_id_estet_fk` (`id_agend_fk`);

--
-- Índices de tabela `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id_pet`),
  ADD KEY `cliente_id_pets_fk` (`cliente_id_fk`),
  ADD KEY `especie_id_pets_fk` (`especie_id_fk`),
  ADD KEY `raca_id_pets_fk` (`raca_id_fk`);

--
-- Índices de tabela `racas`
--
ALTER TABLE `racas`
  ADD PRIMARY KEY (`id_raca`),
  ADD KEY `especie_id_racas_fk` (`id_especie_fk`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id_servico`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vacinacao`
--
ALTER TABLE `vacinacao`
  ADD PRIMARY KEY (`id_vacinacao`),
  ADD KEY `agend_id_vac_fk` (`id_agend_vacinacao`),
  ADD KEY `cliente_id_vac_fk` (`id_cliente_vacinacao`),
  ADD KEY `pet_id_vac_fk` (`id_pet_vacinacao`),
  ADD KEY `servico_id_vac_fk` (`id_vacina_servico`),
  ADD KEY `vet_id_vac_fk` (`id_vet_vacinacao`);

--
-- Índices de tabela `veterinarios`
--
ALTER TABLE `veterinarios`
  ADD PRIMARY KEY (`id_veterinario`),
  ADD UNIQUE KEY `crmv` (`crmv`),
  ADD KEY `user_id_vet_fk` (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id_agend` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `agendamentos_servicos`
--
ALTER TABLE `agendamentos_servicos`
  MODIFY `id_agend_serv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  MODIFY `id_atendimento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `especies`
--
ALTER TABLE `especies`
  MODIFY `id_especie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `estetica`
--
ALTER TABLE `estetica`
  MODIFY `id_estetica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pets`
--
ALTER TABLE `pets`
  MODIFY `id_pet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `racas`
--
ALTER TABLE `racas`
  MODIFY `id_raca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id_servico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `vacinacao`
--
ALTER TABLE `vacinacao`
  MODIFY `id_vacinacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `veterinarios`
--
ALTER TABLE `veterinarios`
  MODIFY `id_veterinario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `cliente_id_agend_fk` FOREIGN KEY (`cliente_id_agend`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `pet_id_agend_fk` FOREIGN KEY (`pet_id_agend`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `resp_id_agend_fk` FOREIGN KEY (`responsavel_id_agend`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `agendamentos_servicos`
--
ALTER TABLE `agendamentos_servicos`
  ADD CONSTRAINT `id_agend_servicos_fk` FOREIGN KEY (`id_agend_fk`) REFERENCES `agendamentos` (`id_agend`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_agend_servivos_serv_fk` FOREIGN KEY (`id_serv_fk`) REFERENCES `servicos` (`id_servico`) ON DELETE CASCADE;

--
-- Restrições para tabelas `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD CONSTRAINT `agend_id_atend_fk` FOREIGN KEY (`id_agend`) REFERENCES `agendamentos` (`id_agend`) ON DELETE CASCADE,
  ADD CONSTRAINT `cliente_id_atend_fk` FOREIGN KEY (`cliente_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pet_id_atend_fk` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id_pet`) ON DELETE CASCADE,
  ADD CONSTRAINT `vet_id_atend_fk` FOREIGN KEY (`veterinario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `estetica`
--
ALTER TABLE `estetica`
  ADD CONSTRAINT `agend_id_estet_fk` FOREIGN KEY (`id_agend_fk`) REFERENCES `agendamentos` (`id_agend`);

--
-- Restrições para tabelas `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `cliente_id_pets_fk` FOREIGN KEY (`cliente_id_fk`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `especie_id_pets_fk` FOREIGN KEY (`especie_id_fk`) REFERENCES `especies` (`id_especie`),
  ADD CONSTRAINT `raca_id_pets_fk` FOREIGN KEY (`raca_id_fk`) REFERENCES `racas` (`id_raca`);

--
-- Restrições para tabelas `racas`
--
ALTER TABLE `racas`
  ADD CONSTRAINT `especie_id_racas_fk` FOREIGN KEY (`id_especie_fk`) REFERENCES `especies` (`id_especie`);

--
-- Restrições para tabelas `vacinacao`
--
ALTER TABLE `vacinacao`
  ADD CONSTRAINT `agend_id_vac_fk` FOREIGN KEY (`id_agend_vacinacao`) REFERENCES `agendamentos` (`id_agend`),
  ADD CONSTRAINT `cliente_id_vac_fk` FOREIGN KEY (`id_cliente_vacinacao`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `pet_id_vac_fk` FOREIGN KEY (`id_pet_vacinacao`) REFERENCES `pets` (`id_pet`),
  ADD CONSTRAINT `servico_id_vac_fk` FOREIGN KEY (`id_vacina_servico`) REFERENCES `servicos` (`id_servico`),
  ADD CONSTRAINT `vet_id_vac_fk` FOREIGN KEY (`id_vet_vacinacao`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `veterinarios`
--
ALTER TABLE `veterinarios`
  ADD CONSTRAINT `user_id_vet_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
