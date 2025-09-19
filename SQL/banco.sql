CREATE DATABASE smartrain;

USE smartrain;

CREATE TABLE usuario(
    pk_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome_usuario VARCHAR(50),
    email_usuario VARCHAR(50),
    senha_usuario VARCHAR(50)
);