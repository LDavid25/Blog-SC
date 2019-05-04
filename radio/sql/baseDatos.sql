CREATE DATABASE radio
DEFAULT CHARACTER SET utf8;

USE radio;

CREATE TABLE usuarios(
    id INT NOT NULL UNIQUE AUTO_INCREMENT,
    nombre VARCHAR(25) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_registro DATETIME NOT NULL,
    tipo INT NOT NULL,
    activo INT NOT NULL,
        PRIMARY KEY(id)
);

CREATE TABLE entradas(
    id INT NOT NULL UNIQUE AUTO_INCREMENT,
    autor_id INT NOT NULL,
    url VARCHAR(255) NOT NULL UNIQUE, 
    titulo VARCHAR(255) NOT NULL UNIQUE,
    texto TEXT CHARACTER SET utf8 NOT NULL,
    fecha DATETIME NOT NULL,
    activa INT NOT NULL,
        PRIMARY KEY(id),
        FOREIGN KEY(autor_id)
            REFERENCES usuarios(id)
                ON UPDATE CASCADE
                ON DELETE RESTRICT
);

CREATE TABLE likes(
    id INT NOT NULL UNIQUE AUTO_INCREMENT,
    autor_id INT NOT NULL,
    entrada_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY(autor_id)
        REFERENCES usuarios(id)
            ON UPDATE CASCADE
            ON DELETE RESTRICT,
    FOREIGN KEY(entrada_id)
        REFERENCES entradas(id)
            ON UPDATE CASCADE
            ON DELETE RESTRICT
);

CREATE TABLE comentarios (
    id INT NOT NULL UNIQUE AUTO_INCREMENT,
    autor_id INT NOT NULL,
    entrada_id INT NOT NULL,
    titulo VARCHAR(255),
    texto TEXT CHARACTER SET utf8 NOT NULL,
    fecha DATETIME NOT NULL,
        PRIMARY KEY(id),
        FOREIGN KEY(autor_id)
            REFERENCES usuarios(id)
            ON UPDATE CASCADE
            ON DELETE RESTRICT,
        FOREIGN KEY(entrada_id)
            REFERENCES entradas(id)
                ON UPDATE CASCADE
                ON DELETE RESTRICT
);

CREATE TABLE recuperacion_clave (
    id INT NOT NULL UNIQUE AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    url_secreta VARCHAR(255) NOT NULL,
    fecha DATETIME NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(usuario_id)
	REFERENCES usuarios(id)
            ON UPDATE CASCADE
            ON DELETE RESTRICT
);

CREATE TABLE carrusel(
    id INT NOT NULL,
    titulo VARCHAR(128),
    texto  VARCHAR(255),
    PRIMARY KEY (id)
);
