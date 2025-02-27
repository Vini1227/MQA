CREATE DATABASE MQA;
USE MQA;

CREATE TABLE usuario
(
    id INT unsigned NOT NULL auto_increment,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    CONSTRAINT pk_id PRIMARY KEY (id)
);
