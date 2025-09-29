CREATE DATABASE smartrain;

USE smartrain;

CREATE TABLE usuario(
    pk_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome_usuario VARCHAR(50),
    email_usuario VARCHAR(50),
    senha_usuario VARCHAR(250),
    genero VARCHAR(50)
);

CREATE TABLE trem(
    pk_trem INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    modelo_trem VARCHAR(50) NOT NULL,
    condicao_trem VARCHAR(50) NOT NULL,
    tipo_trem VARCHAR(50) NOT NULL,
    rota_atual_trem VARCHAR(50),
    fk_rota VARCHAR(50)
    REFERENCES rota(pk_rota)
);

CREATE TABLE rota(
    pk_rota INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome_rota VARCHAR(50) NOT NULL,
    origem_rota VARCHAR(50) NOT NULL,
    destino_rota VARCHAR(50) NOT NULL,
    distancia_rota DECIMAL(6,2) NOT NULL,
    fk_trem VARCHAR(50)
    REFERENCES trem(pk_trem)
);

