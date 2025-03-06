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

CREATE TABLE itens 
(
    id INT unsigned NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    tipo VARCHAR(255) NOT NULL,
    descricao VARCHAR(255),
    usuario_id INT unsigned NOT NULL,
    CONSTRAINT pk_id_itens PRIMARY KEY (id),
    CONSTRAINT fk_usuario_id FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE
);