

CREATE DATABASE loja;

USE loja;

CREATE TABLE produtos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL,
    imagem VARCHAR(255),
    PRIMARY KEY (id),
    UNIQUE KEY (nome)
);

CREATE TABLE jardim (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL,
    imagem VARCHAR(255),
    PRIMARY KEY (id),
    UNIQUE KEY (nome)
);

CREATE TABLE maracaju (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL,
    imagem VARCHAR(255),
    PRIMARY KEY (id),
    UNIQUE KEY (nome)
);

CREATE TABLE bonito (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL,
    imagem VARCHAR(255),
    PRIMARY KEY (id),
    UNIQUE KEY (nome)
);

CREATE TABLE sidrolandia (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL,
    imagem VARCHAR(255),
    PRIMARY KEY (id),
    UNIQUE KEY (nome)
);

CREATE TABLE belavista (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL,
    imagem VARCHAR(255),
    PRIMARY KEY (id),
    UNIQUE KEY (nome)
);

CREATE TABLE anastacio (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL,
    imagem VARCHAR(255),
    PRIMARY KEY (id),
    UNIQUE KEY (nome)
);

CREATE TABLE nioaque (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL,
    imagem VARCHAR(255),
    PRIMARY KEY (id),
    UNIQUE KEY (nome)
);

CREATE TABLE aquidauana (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL,
    imagem VARCHAR(255),
    PRIMARY KEY (id),
    UNIQUE KEY (nome)
);

CREATE TABLE campogrande (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL,
    imagem VARCHAR(255),
    PRIMARY KEY (id),
    UNIQUE KEY (nome)
);


