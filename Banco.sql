CREATE DATABASE crud_login;
USE crud_login;

CREATE TABLE cadastro
(
    id INT unsigned NOT NULL auto_increment,
    usuario VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);
ALTER TABLE cadastro
ADD confir_senha VARCHAR(20) NOT NULL;

SELECT * FROM cadastro