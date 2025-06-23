-- =====================================================
-- SISTEMA DE GERENCIAMENTO DE LOJA DE CARROS
-- Configurado para XAMPP (MySQL 8.0+)
-- =====================================================

-- Configurações iniciais
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Criação do banco de dados
DROP DATABASE IF EXISTS `loja_carros`;
CREATE DATABASE `loja_carros` 
DEFAULT CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `loja_carros`;

-- =====================================================
-- TABELA: carros
-- =====================================================
CREATE TABLE `carros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(100) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `ano_fabricacao` int(4) DEFAULT NULL,
  `ano_modelo` int(4) DEFAULT NULL,
  `cor` varchar(30) DEFAULT NULL,
  `placa` varchar(8) DEFAULT NULL,
  `chassi` varchar(17) DEFAULT NULL,
  `km` int(11) DEFAULT 0,
  `preco_compra` decimal(10,2) DEFAULT 0.00,
  `preco_venda` decimal(10,2) DEFAULT 0.00,
  `status` enum('disponivel','vendido','reservado','manutencao') DEFAULT 'disponivel',
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_atualizacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_marca` (`marca`),
  KEY `idx_status` (`status`),
  KEY `idx_ano_modelo` (`ano_modelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- DADOS DE EXEMPLO
-- =====================================================
INSERT INTO `carros` (`modelo`, `marca`, `ano_fabricacao`, `ano_modelo`, `cor`, `placa`, `chassi`, `km`, `preco_compra`, `preco_venda`, `status`) VALUES
-- Carros Disponíveis
('Civic', 'Honda', 2020, 2021, 'Prata Metálico', 'ABC-1234', '1HGBH41JXMN109186', 45000, 85000.00, 95000.00, 'disponivel'),
('Corolla', 'Toyota', 2019, 2020, 'Branco Perolado', 'DEF-5678', '1NXBR32E45Z123456', 38000, 78000.00, 88000.00, 'disponivel'),
('Onix', 'Chevrolet', 2022, 2023, 'Vermelho', 'JKL-3456', '9BWDE21J724123456', 15000, 65000.00, 75000.00, 'disponivel'),
('HB20', 'Hyundai', 2021, 2022, 'Preto', 'MNO-7890', 'KMHXX00XXXX123456', 28000, 68000.00, 78000.00, 'disponivel'),
('Sandero', 'Renault', 2021, 2022, 'Azul', 'PQR-1111', 'VF1KZ0A0001234567', 32000, 62000.00, 72000.00, 'disponivel'),
('Argo', 'Fiat', 2022, 2023, 'Branco', 'STU-2222', 'ZFA25000001234567', 18000, 58000.00, 68000.00, 'disponivel'),

-- Carros Vendidos
('Golf', 'Volkswagen', 2021, 2022, 'Azul Metálico', 'GHI-9012', '3VWLL7AJ5BM123456', 22000, 92000.00, 105000.00, 'vendido'),
('Cruze', 'Chevrolet', 2020, 2021, 'Cinza', 'VWX-3333', '1G1ZD5ST0LF123456', 35000, 82000.00, 92000.00, 'vendido'),

-- Carros Reservados
('Compass', 'Jeep', 2022, 2023, 'Verde', 'YZA-4444', '1C4PJLAB2NW123456', 12000, 95000.00, 110000.00, 'reservado'),
('Tracker', 'Chevrolet', 2021, 2022, 'Laranja', 'BCD-5555', '1GNSKBE00MR123456', 25000, 78000.00, 88000.00, 'reservado'),

-- Carros em Manutenção
('Focus', 'Ford', 2019, 2020, 'Prata', 'EFG-6666', '1FADP3F20FL123456', 55000, 72000.00, 82000.00, 'manutencao'),
('Sentra', 'Nissan', 2020, 2021, 'Branco', 'HIJ-7777', '3N1AB7AP0LY123456', 42000, 68000.00, 78000.00, 'manutencao');

-- =====================================================
-- TABELA: usuarios (para futuras implementações)
-- =====================================================
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `login` varchar(50) NOT NULL UNIQUE,
  `senha` varchar(255) NOT NULL,
  `nivel` enum('admin','vendedor','gerente') DEFAULT 'vendedor',
  `ativo` tinyint(1) DEFAULT 1,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_login` (`login`),
  KEY `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Usuário padrão (senha: 1234)
INSERT INTO `usuarios` (`nome`, `email`, `login`, `senha`, `nivel`) VALUES
('Administrador', 'admin@loja.com', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- =====================================================
-- TABELA: vendas (para futuras implementações)
-- =====================================================
CREATE TABLE `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carro_id` int(11) NOT NULL,
  `cliente_nome` varchar(100) NOT NULL,
  `cliente_cpf` varchar(14) DEFAULT NULL,
  `cliente_telefone` varchar(15) DEFAULT NULL,
  `valor_venda` decimal(10,2) NOT NULL,
  `data_venda` timestamp NOT NULL DEFAULT current_timestamp(),
  `vendedor_id` int(11) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_carro_id` (`carro_id`),
  KEY `idx_data_venda` (`data_venda`),
  FOREIGN KEY (`carro_id`) REFERENCES `carros`(`id`) ON DELETE RESTRICT,
  FOREIGN KEY (`vendedor_id`) REFERENCES `usuarios`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- VIEWS ÚTEIS
-- =====================================================

-- View para carros disponíveis
CREATE VIEW `vw_carros_disponiveis` AS
SELECT id, modelo, marca, ano_modelo, cor, placa, km, preco_venda
FROM carros 
WHERE status = 'disponivel'
ORDER BY marca, modelo;

-- View para resumo de estoque
CREATE VIEW `vw_resumo_estoque` AS
SELECT 
    status,
    COUNT(*) as quantidade,
    SUM(preco_venda) as valor_total
FROM carros 
GROUP BY status;

-- =====================================================
-- PROCEDURES ÚTEIS
-- =====================================================

-- Procedure para atualizar status do carro
DELIMITER //
CREATE PROCEDURE `sp_atualizar_status_carro`(
    IN p_carro_id INT,
    IN p_novo_status VARCHAR(20)
)
BEGIN
    UPDATE carros 
    SET status = p_novo_status,
        data_atualizacao = CURRENT_TIMESTAMP
    WHERE id = p_carro_id;
    
    SELECT ROW_COUNT() as linhas_afetadas;
END //
DELIMITER ;

-- Procedure para buscar carros por faixa de preço
DELIMITER //
CREATE PROCEDURE `sp_buscar_por_preco`(
    IN p_preco_min DECIMAL(10,2),
    IN p_preco_max DECIMAL(10,2)
)
BEGIN
    SELECT id, modelo, marca, ano_modelo, cor, preco_venda, status
    FROM carros 
    WHERE preco_venda BETWEEN p_preco_min AND p_preco_max
    AND status = 'disponivel'
    ORDER BY preco_venda;
END //
DELIMITER ;

-- =====================================================
-- TRIGGERS
-- =====================================================

-- Trigger para atualizar data_atualizacao automaticamente
DELIMITER //
CREATE TRIGGER `tr_carros_update` 
BEFORE UPDATE ON `carros`
FOR EACH ROW
BEGIN
    SET NEW.data_atualizacao = CURRENT_TIMESTAMP;
END //
DELIMITER ;

-- =====================================================
-- ÍNDICES ADICIONAIS PARA PERFORMANCE
-- =====================================================
CREATE INDEX `idx_preco_venda` ON `carros` (`preco_venda`);
CREATE INDEX `idx_data_cadastro` ON `carros` (`data_cadastro`);
CREATE INDEX `idx_marca_modelo` ON `carros` (`marca`, `modelo`);

-- =====================================================
-- FINALIZAÇÃO
-- =====================================================
COMMIT;

-- Mensagem de sucesso
SELECT 'Banco de dados loja_carros criado com sucesso!' as mensagem;
SELECT COUNT(*) as total_carros FROM carros;
SELECT COUNT(*) as total_usuarios FROM usuarios;

-- =====================================================
-- TABELA: clientes
-- =====================================================
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL UNIQUE,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_nome` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABELA: servicos
-- =====================================================
CREATE TABLE `servicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_nome` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABELA: ordens_servico
-- =====================================================
CREATE TABLE `ordens_servico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carro_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `servico_id` int(11) NOT NULL,
  `data_ordem` date NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `status` enum('aberta','em_andamento','finalizada','cancelada') DEFAULT 'aberta',
  `observacoes` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_carro_id` (`carro_id`),
  KEY `idx_cliente_id` (`cliente_id`),
  KEY `idx_servico_id` (`servico_id`),
  FOREIGN KEY (`carro_id`) REFERENCES `carros`(`id`) ON DELETE RESTRICT,
  FOREIGN KEY (`cliente_id`) REFERENCES `clientes`(`id`) ON DELETE RESTRICT,
  FOREIGN KEY (`servico_id`) REFERENCES `servicos`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Fim das novas tabelas para CRUDs adicionais 