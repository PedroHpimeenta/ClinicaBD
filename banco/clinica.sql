-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 21-Jul-2023 às 21:40
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clinica`
--

DELIMITER $$
--
-- Procedimentos
--
DROP PROCEDURE IF EXISTS `sp_cadastrar_paciente`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cadastrar_paciente` (`p_nome` VARCHAR(100), `p_telefone` VARCHAR(15), `p_email` VARCHAR(100), `p_data_nascimento` DATE, `p_endereco` VARCHAR(200))   BEGIN
    INSERT INTO pacientes (nome, telefone, email, data_nascimento, endereco)
    VALUES (p_nome, p_telefone, p_email, p_data_nascimento, p_endereco);
END$$

DROP PROCEDURE IF EXISTS `sp_excluir_funcionario`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_excluir_funcionario` (`p_id_funcionario` INT)   BEGIN
    -- Inicia a transação
    START TRANSACTION;

    -- Realiza a exclusão do funcionário
    DELETE FROM usuarios WHERE id = p_id_funcionario AND nivel_acesso = 0;

    -- Finaliza a transação com sucesso
    COMMIT;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `consultas`
--

DROP TABLE IF EXISTS `consultas`;
CREATE TABLE IF NOT EXISTS `consultas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `paciente_id` int NOT NULL,
  `procedimento_id` int NOT NULL,
  `data_hora` datetime NOT NULL,
  `observacoes` text,
  `data_hora_termino` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `procedimento_id` (`procedimento_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `consultas`
--

INSERT INTO `consultas` (`id`, `paciente_id`, `procedimento_id`, `data_hora`, `observacoes`, `data_hora_termino`) VALUES
(1, 1, 3, '2023-07-18 10:00:00', 'Consulta de rotina', '0000-00-00 00:00:00'),
(2, 2, 2, '2023-07-19 14:30:00', 'Necessário realizar obturação', '0000-00-00 00:00:00'),
(3, 3, 1, '2023-07-20 16:45:00', 'Agendamento para limpeza', '0000-00-00 00:00:00'),
(4, 1, 4, '2023-07-21 11:15:00', 'Realizar canal em dente 25', '0000-00-00 00:00:00'),
(5, 4, 5, '2023-07-22 09:30:00', 'Consulta para avaliação de implante', '0000-00-00 00:00:00'),
(6, 5, 2, '2023-07-23 13:00:00', 'Obturação em dente 31', '0000-00-00 00:00:00'),
(7, 3, 3, '2023-07-24 12:30:00', 'Extração do dente 18', '0000-00-00 00:00:00'),
(8, 4, 1, '2023-07-25 15:00:00', 'Consulta de revisão', '0000-00-00 00:00:00'),
(9, 2, 4, '2023-07-26 17:30:00', 'Realizar canal em dente 37', '0000-00-00 00:00:00'),
(10, 5, 5, '2023-07-27 10:45:00', 'Implante dentário em 46', '0000-00-00 00:00:00'),
(11, 6, 1, '2023-07-19 08:50:00', 'Limpeza completa', '0000-00-00 00:00:00'),
(12, 1, 1, '2023-07-20 08:22:00', 'Limpeza completa', '2023-07-20 09:22:00'),
(13, 1, 1, '2023-07-20 08:38:00', 'Limpeza completa', '2023-07-20 09:38:00'),
(14, 3, 1, '2023-07-20 16:40:00', 'Limpeza completa', '0000-00-00 00:00:00'),
(15, 3, 1, '2023-07-20 16:40:00', 'Limpeza completa', '0000-00-00 00:00:00'),
(16, 1, 1, '2023-07-20 16:58:00', 'Limpeza completa', '0000-00-00 00:00:00'),
(17, 13, 2, '2023-08-20 12:00:00', 'Obturação', '0000-00-00 00:00:00'),
(18, 16, 4, '2023-07-22 08:00:00', 'Canal', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`id`, `nome`, `telefone`, `email`, `data_nascimento`, `endereco`) VALUES
(1, 'Maria Silva', '(11) 99999-1111', 'maria@email.com', '1985-02-15', 'Rua das Flores, 123'),
(2, 'João Santos', '(21) 88888-2222', 'joao@email.com', '1990-06-30', 'Avenida Principal, 456'),
(3, 'Ana Pereira', '(85) 77777-3333', 'ana@email.com', '1988-12-10', 'Praça da Liberdade, 789'),
(4, 'Pedro Alves', '(47) 66666-4444', 'pedro@email.com', '1979-08-22', 'Alameda das Árvores, 321'),
(5, 'Lucia Oliveira', '(19) 55555-5555', 'lucia@email.com', '1995-03-25', 'Beco das Sombras, 987'),
(6, 'Pedro Pimenta', '31313131131', 'pedro2@gmail.com', '1997-05-22', 'rua beco 123'),
(7, 'Luana', '43242342', 'luana@gmail.com', '1993-03-22', 'rua'),
(9, 'Pedro', '312313131', 'p@gmail.com', '2022-12-12', 'rua'),
(10, 'Pelé', '31231313', 'ppppp@gmail.com', '2000-03-22', 'rua'),
(11, 'KAKA', '5453534543', 'kaka@gmail.com', '2023-01-01', 'rua'),
(12, 'Lucas Gabriel', '89898989', 'lucaaa@gmail.com', '2022-02-01', 'rua'),
(13, 'Pimenta', '43243242', 'jp@gmail.com', '1998-08-22', 'rua 123'),
(14, 'Lucas Gabril', '12345678', 'lucas@gmail.com', '1997-07-22', 'rua beco'),
(16, 'atila', '342423432', 'atila123@gmail.com', '1995-09-01', 'rua');

-- --------------------------------------------------------

--
-- Estrutura da tabela `procedimentos`
--

DROP TABLE IF EXISTS `procedimentos`;
CREATE TABLE IF NOT EXISTS `procedimentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_procedimento` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `procedimentos`
--

INSERT INTO `procedimentos` (`id`, `nome_procedimento`, `preco`) VALUES
(1, 'Limpeza Dental', '100.00'),
(2, 'Obturação', '200.00'),
(3, 'Extração de Dente', '150.00'),
(4, 'Canal', '300.00'),
(5, 'Implante Dentário', '1000.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivel_acesso` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `nivel_acesso`) VALUES
(1, 'Pedro Pimenta', 'pedro@gmail.com', '123', 1),
(28, 'Manuela', 'manuela@gmail.com', '123', 0),
(29, 'athila', 'athila@gmail.com', '123', 0),
(7, 'Administrador 1', 'admin1@gmail.com', '123', 1),
(8, 'Administrador 2', 'admin2@gmail.com', '123', 1),
(9, 'Administrador 3', 'admin3@gmail.com', '123', 1),
(10, 'Administrador 4', 'admin4@gmail.com', '123', 1),
(11, 'Administrador 5', 'admin5@gmail.com', '123', 1),
(27, 'Pimenta', 'pimenta@gmail.com', '123', 0),
(24, 'Fernanda', 'fer@gmail.com', '123', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
