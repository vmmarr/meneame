------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios (
    id bigserial PRIMARY KEY,
    nombre varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    email varchar(255) NOT NULL
);

DROP TABLE IF EXISTS categorias CASCADE;

CREATE TABLE categorias (
    id bigserial PRIMARY KEY,
    nombre varchar(255) NOT NULL UNIQUE
);

DROP TABLE IF EXISTS noticias CASCADE;

CREATE TABLE noticias (
    id bigserial PRIMARY KEY,
    titulo varchar(255) NOT NULL UNIQUE,
    noticia varchar(255) NOT NULL,
    categoria_id bigint NOT NULL REFERENCES categorias (id) 
                        ON DELETE NO ACTION ON UPDATE CASCADE,
    usuario_id bigint NOT NULL REFERENCES usuarios (id) 
                        ON DELETE NO ACTION ON UPDATE CASCADE
);

INSERT INTO usuarios (LOGIN, PASSWORD, email)
    VALUES ('usuario', 'usuario', 'usuario@gmail.com');

INSERT INTO categorias (nombre)
    VALUES ('Cultura'), ('Arte');

INSERT INTO noticias (titulo, noticia, categoria_id, usuario_id)
    VALUES ('La Crisis economica', 'Esta muy mal', 1, 1),
            ('La pobreza', 'Va mejor', 2, 1);