CREATE DATABASE MQA;
USE MQA;

CREATE TABLE usuario
(
    id INT unsigned NOT NULL auto_increment,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    imagem VARCHAR (255) DEFAULT NULL,
    CONSTRAINT pk_id PRIMARY KEY (id)
);

CREATE TABLE itens 
(
    id INT unsigned NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    tipo VARCHAR(255) NOT NULL,
    descricao VARCHAR(255),
    ong_id INT unsigned NOT NULL,
    CONSTRAINT pk_item_ong_id PRIMARY KEY (id),
    CONSTRAINT fk_ong_id FOREIGN KEY (ong_id) REFERENCES ongs(id) ON DELETE CASCADE
);

CREATE TABLE ongs
(
    id INT unsigned NOT NULL auto_increment,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    descricao VARCHAR(255),
    cnpj VARCHAR(14) NOT NULL,
    CONSTRAINT pk_id PRIMARY KEY (id)
);
