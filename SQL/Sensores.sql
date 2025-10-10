CREATE DATABASE Sensores;

USE Sensores;

CREATE TABLE itens (
    id_sensor INT NOT NULL PRIMARY KEY,
    nome_sensor VARCHAR(100) NOT NULL,
    tipo_sensor VARCHAR(50) NOT NULL,
    localizacao_trem VARCHAR(100) NOT NULL
);

INSERT INTO itens (id_sensor, nome_sensor, tipo_sensor, localizacao_trem) VALUES
(1, 'Sensor de Temperatura', 'Temperatura', 'Trem 001'),
(2, 'Sensor de Umidade', 'Umidade', 'Trem 002'),
(3, 'Sensor de Pressão', 'Pressão', 'Trem 003'),
(4, 'Sensor de Proximidade', 'Proximidade', 'Trem 004');
