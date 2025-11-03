-- Criação do banco de dados
DROP DATABASE IF EXISTS smartrain;
CREATE DATABASE smartrain;
USE smartrain;

-- Tabela usuario
CREATE TABLE usuario(
    pk_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome_usuario VARCHAR(50),
    email_usuario VARCHAR(50),
    senha_usuario VARCHAR(250),
    genero VARCHAR(50)
);

-- Tabela rota
CREATE TABLE rota(
    pk_rota INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome_rota VARCHAR(50) NOT NULL,
    origem_rota VARCHAR(50) NOT NULL,
    destino_rota VARCHAR(50) NOT NULL,
    distancia_rota DECIMAL(6,2) NOT NULL
);

-- Tabela trem
CREATE TABLE trem(
    pk_trem INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    modelo_trem VARCHAR(50) NOT NULL,
    condicao_trem VARCHAR(50) NOT NULL,
    maquinista_trem INT,
    rota_atual_trem INT
);

-- Tabela maquinista
CREATE TABLE maquinista(
    pk_maquinista INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome_maquinista VARCHAR(50) NOT NULL,
    trem_maquinado INT
);

-- Tabela rotas_trem
CREATE TABLE rotas_trem(
    pk_trem INT,
    pk_rota INT,
    data_hora_rota DATETIME NOT NULL,
    PRIMARY KEY (pk_trem, pk_rota)
);

-- Tabela sensores
CREATE TABLE sensores (
    id_sensor INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome_sensor VARCHAR(100) NOT NULL,
    tipo_sensor VARCHAR(50) NOT NULL,
    localizacao_trem VARCHAR(100) NOT NULL
);

-- Tabela alerta
CREATE TABLE alerta(
    pk_alerta INT PRIMARY KEY AUTO_INCREMENT,
    tipo_alerta VARCHAR(50) NOT NULL,
    view_alerta BOOLEAN NOT NULL,
    descricao_alerta VARCHAR(250) NOT NULL,
    data_hora_alerta DATETIME NOT NULL,
    pk_trem INT
);

-- Adicionando foreign keys

ALTER TABLE trem
    ADD CONSTRAINT fk_trem_maquinista FOREIGN KEY (maquinista_trem) REFERENCES maquinista(pk_maquinista);

ALTER TABLE trem
    ADD CONSTRAINT fk_trem_rota FOREIGN KEY (rota_atual_trem) REFERENCES rota(pk_rota);

ALTER TABLE maquinista
    ADD CONSTRAINT fk_maquinista_trem FOREIGN KEY (trem_maquinado) REFERENCES trem(pk_trem);

ALTER TABLE rotas_trem
    ADD CONSTRAINT fk_rotas_trem_trem FOREIGN KEY (pk_trem) REFERENCES trem(pk_trem);

ALTER TABLE rotas_trem
    ADD CONSTRAINT fk_rotas_trem_rota FOREIGN KEY (pk_rota) REFERENCES rota(pk_rota);

ALTER TABLE alerta
    ADD CONSTRAINT fk_alerta_trem FOREIGN KEY (pk_trem) REFERENCES trem(pk_trem);

-- Inserts usuario
INSERT INTO usuario (nome_usuario, email_usuario, senha_usuario, genero) VALUES
('Caio Alves','caio.alves@smartraimail.com','$2y$10$HAuHoaoqfXIIWVTqkIfYRegMYNjJc80BpcJ0iUbb0oRiS7RZjacPe','masc');

-- Inserts sensores
INSERT INTO sensores (nome_sensor, tipo_sensor, localizacao_trem) VALUES
('Sensor de Temperatura', 'Temperatura', 'Trem 001'),
('Sensor de Umidade', 'Umidade', 'Trem 002'),
('Sensor de Pressão', 'Pressão', 'Trem 003'),
('Sensor de Proximidade', 'Proximidade', 'Trem 004');

-- Inserts rota
INSERT INTO rota (nome_rota, origem_rota, destino_rota, distancia_rota) VALUES
('Ida_porto', 'Joinville', 'Jaragua do Sul', 17),
('Volta_porta', 'Joinville', 'Estação Rio Vermelho', 29);

-- Inserts trem
INSERT INTO trem (modelo_trem, condicao_trem, maquinista_trem, rota_atual_trem) VALUES
('00Y4-G586', 'Operacional', NULL, 1),
('37P9-JF85', 'Danificado', NULL, NULL),
('823X-KLP9', 'Danificado', NULL, NULL);

-- Inserts rotas_trem
INSERT INTO rotas_trem (pk_trem, pk_rota, data_hora_rota) VALUES
(1, 1, '2025-11-11 15:00:00');

-- Inserts alerta
INSERT INTO alerta (tipo_alerta, view_alerta, descricao_alerta, data_hora_alerta, pk_trem) VALUES 
('Manutenção', FALSE , 'O trem precisa de manutenção urgente.', '2024-06-15 14:30:00', 2);