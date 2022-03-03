--
-- CREATE DATABASE academico
--
-- DROP TABLE IF EXISTS usuario;
--
CREATE TABLE usuario (
    identificacion varchar(10) NOT NULL PRIMARY KEY,
    nombres varchar(50) NOT NULL,
    apellidos varchar(50) NOT NULL,
    telefono varchar(10) NOT NULL,
    email varchar(50) NOT NULL,
    direccion varchar(30) DEFAULT NULL,
    clave varchar(40) DEFAULT NULL,
    tipo char(1) NOT NULL,
    estado bit(1) NOT NULL
);
--
INSERT INTO usuario
VALUES (
        '100100',
        'Pedro',
        'Cifuentes',
        '12344321',
        'test@gmail.com',
        'Cll. 19 # 3 - 1',
        '202cb962ac59075b964b07152d234b70',
        'A',
        true
    );
INSERT INTO usuario
VALUES (
        '100101',
        'Pedro',
        'Cifuentes',
        '12344321',
        'test@gmail.com',
        'Cll. 19 # 3 - 1',
        '202cb962ac59075b964b07152d234b70',
        'S',
        true
    );
INSERT INTO usuario
VALUES (
        '100102',
        'Pedro',
        'Cifuentes',
        '12344321',
        'test@gmail.com',
        'Cll. 19 # 3 - 1',
        '202cb962ac59075b964b07152d234b70',
        'D',
        true
    );
INSERT INTO usuario
VALUES (
        '100103',
        'Pedro',
        'Cifuentes',
        '12344321',
        'test@gmail.com',
        'Cll. 19 # 3 - 1',
        '202cb962ac59075b964b07152d234b70',
        'E',
        true
    );
--
--
--
CREATE TABLE institucion_educativa (
    id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(150) NOT NULL,
    direccion varchar(40) NULL,
    telefono varchar(10) DEFAULT NULL,
    email varchar(40) NOT NULL,
    nombre_directora varchar(60) NULL,
    pagina_web varchar(60) NULL
);
--
INSERT INTO institucion_educativa (
        nombre,
        direccion,
        telefono,
        email,
        nombre_directora,
        pagina_web
    )
VALUES (
        null,
        'Institucion Educativa Departamental',
        'Cll. 10 # 3 - 0',
        '1234567',
        'institucion@gmail.com',
        'Ana Vasquez',
        'http://www.institucion.com'
    );
--
CREATE TABLE asignatura(
    id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_asignatura varchar(30) NOT NULL
);
--
INSERT INTO asignatura (nombre_asignatura)
VALUES (null, 'Matematicas');
--
--
--
CREATE TABLE grado (
    id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_grado varchar(30) NOT NULL
);
--
INSERT INTO grado (nombre_grado)
VALUES (null, 'Quinto');
--
--
CREATE TABLE anio_escolar (
    id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    inicio DATETIME NULL DEFAULT NULL,
    fin DATETIME NULL DEFAULT NULL
);
--
INSERT INTO anio_escolar (inicio, fin)
VALUES ('2020-09-09', '2020-09-09');
--
--
--
CREATE TABLE grupo (
    id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_grupo varchar(30) NOT NULL
);
--
INSERT INTO grupo (nombre_grupo)
VALUES ('Capitanes');
--
--
--
CREATE TABLE periodo_academico (
    id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    inicio_periodo DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    finalizacion_periodo DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
--
INSERT INTO periodo_academico (inicio_periodo, finalizacion_periodo)
VALUES (
        '2022-02-05 23:59:59',
        '2022-02-05 23:59:59'
    );
--
--
--
CREATE TABLE name_table ();
--
INSERT INTO name_table ()
VALUES ();
--
--
--
CREATE TABLE name_table ();
--
INSERT INTO name_table ()
VALUES ();
--
--
--
CREATE TABLE name_table ();
--
INSERT INTO name_table ()
VALUES ();
--
--
--
CREATE TABLE name_table ();
--
INSERT INTO name_table ()
VALUES ();
--
--
--
CREATE TABLE name_table ();
--
INSERT INTO name_table ()
VALUES ();
--
--
--
CREATE TABLE name_table ();
--
INSERT INTO name_table ()
VALUES ();
--
--
--