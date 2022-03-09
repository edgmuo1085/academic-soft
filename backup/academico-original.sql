--
-- DROP DATABASE academico;
-- CREATE DATABASE academico;
-- USE academico;
--
--
-- CREAR TABLA instinstitucion_educativa
-- DROP TABLE IF EXISTS institucion_educativa;
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
--
-- CREAR TABLA roles
-- DROP TABLE IF EXISTS roles;
--
CREATE TABLE roles (
    id INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL,
    valor CHAR(3) NOT NULL
);
--
--
-- CREAR TABLA usuario
-- DROP TABLE IF EXISTS usuario;
--
CREATE TABLE usuario (
    id INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    identificacion varchar(10) NOT NULL UNIQUE,
    nombres varchar(50) NOT NULL,
    apellidos varchar(50) NOT NULL,
    telefono varchar(10) NULL,
    email varchar(50) NOT NULL,
    direccion varchar(30) DEFAULT NULL,
    clave varchar(40) DEFAULT NULL,
    rol_id INT(4) NOT NULL,
    estado bit(1) NOT NULL,
    INDEX (rol_id),
    FOREIGN KEY usuario(rol_id) REFERENCES roles(id) ON DELETE RESTRICT ON UPDATE CASCADE
);
--
--
-- CREAR TABLA anio_escolar
-- DROP TABLE IF EXISTS anio_escolar;
--
CREATE TABLE anio_escolar (
    id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    inicio DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    fin DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    institucion_id INT(4) NOT NULL,
    FOREIGN KEY anio_escolar(institucion_id) REFERENCES institucion_educativa(id) ON DELETE RESTRICT ON UPDATE CASCADE
);
--
--
-- CREAR TABLA periodo_academico
-- DROP TABLE IF EXISTS periodo_academico;
--
CREATE TABLE periodo_academico (
    id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    inicio_periodo DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    finalizacion_periodo DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    anio_escolar_id INT(4) NOT NULL,
    FOREIGN KEY periodo_academico(anio_escolar_id) REFERENCES anio_escolar(id) ON DELETE RESTRICT ON UPDATE CASCADE
);
--
--
-- CREAR TABLA grado
-- DROP TABLE IF EXISTS grado;
--
CREATE TABLE grado (
    id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_grado varchar(30) NOT NULL,
    institucion_id INT(4) NOT NULL,
    FOREIGN KEY grado(institucion_id) REFERENCES institucion_educativa(id) ON DELETE RESTRICT ON UPDATE CASCADE
);
--
--
-- CREAR TABLA grupo
-- DROP TABLE IF EXISTS grupo;
--
CREATE TABLE grupo (
    id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_grupo varchar(30) NOT NULL,
    grado_id INT(4) NOT NULL,
    FOREIGN KEY grupo(grado_id) REFERENCES grado(id) ON DELETE RESTRICT ON UPDATE CASCADE
);
--
--
-- CREAR TABLA asignatura
-- DROP TABLE IF EXISTS asignatura;
--
CREATE TABLE asignatura(
    id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_asignatura varchar(30) NOT NULL
);
--
--
-- CREAR TABLA menu
-- DROP TABLE IF EXISTS menu;
--
CREATE TABLE menu (
    id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(60) NOT NULL,
    ruta VARCHAR(200) NULL,
    tipo INT(2) NOT NULL,
    es_hijo INT(4) NULL,
    posicion INT(4) NOT NULL,
    INDEX (es_hijo),
    FOREIGN KEY (es_hijo) REFERENCES menu(id)
);
--
--
-- CREAR TABLA permisos
-- DROP TABLE IF EXISTS permisos;
--
CREATE TABLE permisos (
    id INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_rol INT(4) NOT NULL,
    id_menu INT(4) NOT NULL,
    estado bit(1) NOT NULL,
    INDEX (id_rol, id_menu),
    FOREIGN KEY (id_rol) REFERENCES roles(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (id_menu) REFERENCES menu(id) ON DELETE RESTRICT ON UPDATE CASCADE
);
--
--
--
--
--/*************************************************************************************************/
--
--
--
-- LLENADO DE DATOS PARA LAS TABLAS
--
--
--
-- TABLA institucion_educativa
INSERT INTO institucion_educativa (
        nombre,
        direccion,
        telefono,
        email,
        nombre_directora,
        pagina_web
    )
VALUES (
        'Institucion Educativa Departamental',
        'Cll. 10 # 3 - 0',
        '1234567',
        'institucion@gmail.com',
        'Ana Vasquez',
        'http://www.institucion.com'
    );
--
--
-- TABLA roles
INSERT INTO roles (nombre, valor)
VALUES ('Secretaria', 'S');
INSERT INTO roles (nombre, valor)
VALUES ('Docente', 'D');
INSERT INTO roles (nombre, valor)
VALUES ('Acudiente', 'A');
INSERT INTO roles (nombre, valor)
VALUES ('Estudiante', 'E');
INSERT INTO roles (nombre, valor)
VALUES ('Desconocido', 'N');
INSERT INTO roles (nombre, valor)
VALUES ('Root', 'R');
--
--
--
-- TABLA usuario
INSERT INTO usuario (
        identificacion,
        nombres,
        apellidos,
        telefono,
        email,
        direccion,
        clave,
        rol_id,
        estado
    )
VALUES (
        '100100',
        'Pedro',
        'Cifuentes',
        '12344321',
        'test@gmail.com',
        'Cll. 19 # 3 - 1',
        '202cb962ac59075b964b07152d234b70',
        1,
        true
    );
INSERT INTO usuario(
        identificacion,
        nombres,
        apellidos,
        telefono,
        email,
        direccion,
        clave,
        rol_id,
        estado
    )
VALUES (
        '100101',
        'Pedro',
        'Cifuentes',
        '12344321',
        'test@gmail.com',
        'Cll. 19 # 3 - 1',
        '202cb962ac59075b964b07152d234b70',
        2,
        true
    );
INSERT INTO usuario(
        identificacion,
        nombres,
        apellidos,
        telefono,
        email,
        direccion,
        clave,
        rol_id,
        estado
    )
VALUES (
        '100102',
        'Pedro',
        'Cifuentes',
        '12344321',
        'test@gmail.com',
        'Cll. 19 # 3 - 1',
        '202cb962ac59075b964b07152d234b70',
        3,
        true
    );
INSERT INTO usuario(
        identificacion,
        nombres,
        apellidos,
        telefono,
        email,
        direccion,
        clave,
        rol_id,
        estado
    )
VALUES (
        '100103',
        'Pedro',
        'Cifuentes',
        '12344321',
        'test@gmail.com',
        'Cll. 19 # 3 - 1',
        '202cb962ac59075b964b07152d234b70',
        4,
        true
    );
INSERT INTO usuario(
        identificacion,
        nombres,
        apellidos,
        telefono,
        email,
        direccion,
        clave,
        rol_id,
        estado
    )
VALUES (
        '100104',
        'Desconocido',
        'Desconocido',
        '12344321',
        'test@gmail.com',
        'Cll. 19 # 3 - 1',
        '202cb962ac59075b964b07152d234b70',
        5,
        true
    );
INSERT INTO usuario(
        identificacion,
        nombres,
        apellidos,
        telefono,
        email,
        direccion,
        clave,
        rol_id,
        estado
    )
VALUES (
        '100105',
        'Super',
        'Admin',
        '12344321',
        'test@gmail.com',
        'Cll. 19 # 3 - 1',
        '202cb962ac59075b964b07152d234b70',
        6,
        true
    );
--
--
--
-- TABLA anio_escolar
INSERT INTO anio_escolar (inicio, fin, institucion_id)
VALUES ('2020-09-09', '2020-09-09', 1);
--
--
--
-- TABLA periodo_academico
INSERT INTO periodo_academico (inicio_periodo, finalizacion_periodo)
VALUES (
        '2022-02-05 23:59:59',
        '2022-02-05 23:59:59',
        1
    );
--
--
--
-- TABLA grado
INSERT INTO grado (nombre_grado, institucion_id)
VALUES ('Primero', 1);
INSERT INTO grado (nombre_grado, institucion_id)
VALUES ('Segundo', 1);
INSERT INTO grado (nombre_grado, institucion_id)
VALUES ('Tercero', 1);
--
--
--
-- TABLA grupo
INSERT INTO grupo (nombre_grupo, grado_id)
VALUES ('A', 1);
INSERT INTO grupo (nombre_grupo, grado_id)
VALUES ('B', 1);
INSERT INTO grupo (nombre_grupo, grado_id)
VALUES ('A', 2);
INSERT INTO grupo (nombre_grupo, grado_id)
VALUES ('B', 2);
--
--
--
-- TABLA asignatura
INSERT INTO asignatura (nombre_asignatura)
VALUES ('Matematicas');
INSERT INTO asignatura (nombre_asignatura)
VALUES ('Sociales');
INSERT INTO asignatura (nombre_asignatura)
VALUES ('Castellano');
INSERT INTO asignatura (nombre_asignatura)
VALUES ('Inglés');
--
--
--
-- TABLA menu
/*
 -- (tipo) = > 1: Padre, 2: Hijo,
 -- es_hijo: id del padre a quien pertenece el submenu
 --*/
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Inicio',
        'principal.php?CONTENIDO=layout/inicio.php',
        1,
        null,
        1
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Institución',
        '#',
        1,
        null,
        2
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Año escolar',
        'principal.php?CONTENIDO=layout/components/lista-anio.php',
        2,
        2,
        3
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Asignatura',
        'principal.php?CONTENIDO=layout/components/lista-asignatura.php',
        1,
        null,
        7
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Periodo Academico',
        'principal.php?CONTENIDO=layout/components/lista-periodo.php',
        2,
        2,
        4
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Grados',
        'principal.php?CONTENIDO=layout/components/lista-grado.php',
        2,
        2,
        5
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Grupos',
        'principal.php?CONTENIDO=layout/components/lista-grupo.php',
        2,
        2,
        6
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Asignatura',
        'principal.php?CONTENIDO=layout/components/lista-asignatura.php',
        1,
        null,
        7
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Perfil',
        '#',
        1,
        null,
        8
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Cerrar sesión',
        'index.php',
        2,
        8,
        9
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Docentes',
        '#',
        1,
        null,
        10
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Estudiantes',
        '#',
        1,
        null,
        11
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Notas',
        '#',
        1,
        null,
        12
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Consultar Notas',
        '#',
        2,
        12,
        13
    );
--
--
--
-- TABLA permisos
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 1, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (2, 1, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (3, 1, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (4, 1, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (5, 1, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 1, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 2, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 3, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 4, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 5, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 6, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 7, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 7, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 8, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 8, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 2, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 3, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 4, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (5, 5, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 6, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 21, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 24, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 25, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 26, true);
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 27, true);
--
--
--
--
--
--
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
--Consultar indices de la base de datos
select index_schema,
    index_name,
    group_concat(
        column_name
        order by seq_in_index
    ) as index_columns,
    index_type,
    case
        non_unique
        when 1 then 'not unique'
        else 'unique'
    end as is_unique,
    table_name
from information_schema.statistics
where table_schema not in (
        'information_schema',
        'mysql',
        'performance_schema',
        'sys'
    )
    and index_schema = 'academico'
group by index_schema,
    index_name,
    index_type,
    non_unique,
    table_name
order by index_schema,
    index_name;
--
--
---CREATE INDEX id_index ON usuario (id);