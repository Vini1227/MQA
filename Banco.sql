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

CREATE TABLE ongs
(
    id INT unsigned NOT NULL auto_increment,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    descricao VARCHAR(255),
    cnpj VARCHAR(14) NOT NULL,
    foto_perfil VARCHAR(255) NULL,
    banner VARCHAR(255) NULL,
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
    CONSTRAINT fk_ong_itens_id FOREIGN KEY (ong_id) REFERENCES ongs(id) ON DELETE CASCADE
);

CREATE TABLE cadastro_monetario
(
    id INT unsigned NOT NULL AUTO_INCREMENT,
    ong_id INT unsigned NOT NULL,
    pix VARCHAR(255),
    agencia VARCHAR(255),
    cnpj VARCHAR(14),
    codigo_conta VARCHAR(255),
    nome_banco VARCHAR(255),
    tipo_conta VARCHAR(50),
    CONSTRAINT pk_cadastro_monetario PRIMARY KEY (id),
    CONSTRAINT fk_ong_monetario_id FOREIGN KEY (ong_id) REFERENCES ongs(id) ON DELETE CASCADE
);