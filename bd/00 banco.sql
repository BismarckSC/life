CREATE DATABASE life;
USE life;
create user 'cliente'@'localhost';
SET PASSWORD FOR 'cliente'@'localhost' = PASSWORD('life2013');
create user 'admin'@'localhost';
SET PASSWORD FOR 'admin'@'localhost' = PASSWORD('2013life');

CREATE TABLE admin(
id INT NOT NULL AUTO_INCREMENT,
email VARCHAR(50) UNIQUE NOT NULL,
senha VARCHAR(32) NOT NULL,
PRIMARY KEY(id));

CREATE TABLE cliente(
id INT NOT NULL AUTO_INCREMENT,
nome VARCHAR(60) NOT NULL,
email VARCHAR(50) UNIQUE NOT NULL,
senha VARCHAR(32) NOT NULL,
evento VARCHAR(100) NOT NULL,
descricao VARCHAR(1000) NOT NULL,
acesso INT(1) NOT NULL DEFAULT 1,
data_cadastro DATE NOT NULL,
capa VARCHAR(120) INT NOT NULL,
PRIMARY KEY(id));

CREATE TABLE pasta(
id INT NOT NULL AUTO_INCREMENT,
nome VARCHAR(30) NOT NULL,
PRIMARY KEY (id));

CREATE TABLE fotos(
id INT NOT NULL AUTO_INCREMENT,
nome VARCHAR(50) NOT NULL,
selecionada INT(1) DEFAULT 0,
excluida INT(1) DEFAULT 0,
PRIMARY KEY(id));

CREATE TABLE cliente_pasta(
id_cliente INT NOT NULL,
id_pasta INT NOT NULL,
PRIMARY KEY(id_cliente, id_pasta),
FOREIGN KEY(id_cliente) REFERENCES cliente(id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY(id_pasta) REFERENCES pasta(id) ON DELETE CASCADE ON UPDATE CASCADE);

CREATE TABLE pasta_fotos(
id_pasta INT NOT NULL,
id_foto INT NOT NULL,
PRIMARY KEY(id_pasta, id_foto),
FOREIGN KEY(id_pasta) REFERENCES pasta(id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY(id_foto) REFERENCES fotos(id) ON DELETE CASCADE ON UPDATE CASCADE);

CREATE TABLE dias(
id INT NOT NULL,
d60 int,
d30 int,
d20 int,
d10 int,
d05 int,
d01 int,
d00 int,
PRIMARY KEY(id),
FOREIGN KEY(id) REFERENCES cliente(id) ON DELETE CASCADE ON UPDATE CASCADE);
