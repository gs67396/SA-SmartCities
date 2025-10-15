CREATE DATABASE smartrain;

USE smartrain;

CREATE TABLE usuario(
    pk_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome_usuario VARCHAR(50),
    email_usuario VARCHAR(50),
    senha_usuario VARCHAR(250),
    genero VARCHAR(50)
);



CREATE TABLE rota(
    pk_rota INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome_rota VARCHAR(50) NOT NULL,
    origem_rota VARCHAR(50) NOT NULL,
    destino_rota VARCHAR(50) NOT NULL,
    distancia_rota DECIMAL(6,2) NOT NULL
);

CREATE TABLE trem(
    pk_trem INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    modelo_trem VARCHAR(50) NOT NULL,
    condicao_trem VARCHAR(50) NOT NULL,
    tipo_trem VARCHAR(50) NOT NULL,
    rota_atual_trem INT,
    FOREIGN KEY (rota_atual_trem) REFERENCES rota(pk_rota)
);

CREATE TABLE rotas_trem(
    pk_trem INT,
    pk_rota INT,
    data_hora_rota DATETIME NOT NULL,
    PRIMARY KEY (pk_trem, pk_rota),
    FOREIGN KEY (pk_trem) REFERENCES trem(pk_trem),
    FOREIGN KEY (pk_rota) REFERENCES rota(pk_rota)
);

CREATE TABLE alerta(
    pk_alerta INT PRIMARY KEY AUTO_INCREMENT,
    tipo_alerta VARCHAR(50) NOT NULL,
    descricao_alerta VARCHAR(250) NOT NULL,
    data_hora_alerta DATETIME NOT NULL,
    pk_trem INT,
    FOREIGN KEY (pk_trem) REFERENCES trem(pk_trem)
);

CREATE TABLE sensores (
    id_sensor INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome_sensor VARCHAR(100) NOT NULL,
    tipo_sensor VARCHAR(50) NOT NULL,
    localizacao_trem VARCHAR(100) NOT NULL
);
