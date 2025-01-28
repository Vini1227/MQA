CREATE DATABASE crud_login;
USE crud_login;

CREATE TABLE cadastro
(
    id int unsigned not null auto_increment,
    email varchar(100) not null,
    usuario varchar(100) not null,
    senha varchar(20) not null,
    descricao varchar(200) not null,
    PRIMARY KEY (id)
);
alter table cadastro
add confir_senha varchar(20) not null;

select * from cadastro