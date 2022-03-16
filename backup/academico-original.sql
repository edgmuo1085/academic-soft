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
    estado INT(1) NOT NULL,
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
    id_institucion INT(4) NOT NULL,
    FOREIGN KEY anio_escolar(id_institucion) REFERENCES institucion_educativa(id) ON DELETE RESTRICT ON UPDATE CASCADE
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
    id_anio_escolar INT(4) NOT NULL,
    FOREIGN KEY periodo_academico(id_anio_escolar) REFERENCES anio_escolar(id) ON DELETE RESTRICT ON UPDATE CASCADE
);
--
--
-- CREAR TABLA grado
-- DROP TABLE IF EXISTS grado;
--
CREATE TABLE grado (
    id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_grado varchar(30) NOT NULL,
    id_institucion INT(4) NOT NULL,
    FOREIGN KEY grado(id_institucion) REFERENCES institucion_educativa(id) ON DELETE RESTRICT ON UPDATE CASCADE
);
--
--
-- CREAR TABLA grupo
-- DROP TABLE IF EXISTS grupo;
--
CREATE TABLE grupo (
    id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_grupo varchar(30) NOT NULL,
    id_grado INT(4) NOT NULL,
    FOREIGN KEY grupo(id_grado) REFERENCES grado(id) ON DELETE RESTRICT ON UPDATE CASCADE
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
-- CREAR TABLA grupo_estudiante
-- DROP TABLE IF EXISTS grupo_estudiante;
--
CREATE TABLE grupo_estudiante (
    id INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT(4) NOT NULL,
    id_grupo INT(4) NOT NULL,
    id_anio_escolar INT(4) NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (id_grupo) REFERENCES grupo(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (id_anio_escolar) REFERENCES anio_escolar(id) ON DELETE RESTRICT ON UPDATE CASCADE
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
    estado INT(1) NOT NULL,
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
        'Martha',
        'Ordoñez',
        '12344321',
        'test@gmail.com',
        'Cll. 19 # 3 - 1',
        '202cb962ac59075b964b07152d234b70',
        1,
        1
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
        1
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
        'Tipo',
        'Peralta',
        '12344321',
        'test@gmail.com',
        'Cll. 19 # 3 - 1',
        '202cb962ac59075b964b07152d234b70',
        3,
        1
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
        'Carlos',
        'Zambrano',
        '12344321',
        'test@gmail.com',
        'Cll. 19 # 3 - 1',
        '202cb962ac59075b964b07152d234b70',
        4,
        1
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
        1
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
        1
    );
--
--
--
-- TABLA anio_escolar
INSERT INTO anio_escolar (inicio, fin, id_institucion)
VALUES ('2022-01-01', '2022-12-01', 1);
--
--
--
-- TABLA periodo_academico
INSERT INTO periodo_academico (
        inicio_periodo,
        finalizacion_periodo,
        id_anio_escolar
    )
VALUES (
        '2022-02-05 23:59:59',
        '2022-02-05 23:59:59',
        1
    );
--
--
--
-- TABLA grado
INSERT INTO grado (nombre_grado, id_institucion)
VALUES ('Primero', 1);
INSERT INTO grado (nombre_grado, id_institucion)
VALUES ('Segundo', 1);
INSERT INTO grado (nombre_grado, id_institucion)
VALUES ('Tercero', 1);
--
--
--
-- TABLA grupo
INSERT INTO grupo (nombre_grupo, id_grado)
VALUES ('A', 1);
INSERT INTO grupo (nombre_grupo, id_grado)
VALUES ('B', 1);
INSERT INTO grupo (nombre_grupo, id_grado)
VALUES ('A', 2);
INSERT INTO grupo (nombre_grupo, id_grado)
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
-- TABLA grupo_estudiante
--INSERT INTO grupo_estudiante (id_usuario, id_grupo, id_anio_escolar)
--VALUES (1, 1, 1);
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
        'Institución',
        '#',
        1,
        null,
        1
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Año escolar',
        'principal.php?CONTENIDO=layout/components/anio-escolar/lista-anio.php',
        2,
        1,
        2
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Periodo Academico',
        'principal.php?CONTENIDO=layout/components/periodo-academico/lista-periodo.php',
        2,
        1,
        3
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Grados',
        'principal.php?CONTENIDO=layout/components/grado/lista-grado.php',
        2,
        1,
        4
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Grupos',
        'principal.php?CONTENIDO=layout/components/grupo/lista-grupo.php',
        2,
        1,
        5
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Asignatura',
        'principal.php?CONTENIDO=layout/components/asignatura/lista-asignatura.php',
        1,
        null,
        6
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Docentes',
        '#',
        1,
        null,
        7
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Personal Docente',
        'principal.php?CONTENIDO=layout/components/docente/lista-docente.php',
        2,
        7,
        8
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Asignación Docente',
        '#',
        2,
        7,
        9
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Estudiantes',
        '#',
        1,
        null,
        10
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Listado',
        'principal.php?CONTENIDO=layout/components/estudiante/lista-estudiante.php',
        2,
        10,
        11
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Inasistencias',
        'principal.php?CONTENIDO=layout/components/inasistencias/lista-inasistencias.php',
        2,
        10,
        12
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Notas',
        '#',
        1,
        null,
        13
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Consultar Notas',
        '#',
        2,
        13,
        14
    );
INSERT INTO menu (nombre, ruta, tipo, es_hijo, posicion)
VALUES (
        'Imprimir Notas',
        '#',
        2,
        13,
        15
    );
--
--
--
-- TABLA permisos
-- rol = 6 Super Admin
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 1, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 2, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 3, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 4, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 5, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 6, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 7, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 8, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 9, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 10, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 11, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 12, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 13, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 14, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 15, 1);
--
--rol=1 secretaria
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 1, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 2, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 3, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 4, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 5, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 6, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 7, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 8, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 9, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 10, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 11, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 12, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 13, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 14, 1);
--
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 15, 1);
--
--
--
--SOLO EJECUTAR HASTA AQUI LO DE ABAJO SOLO ES PARA SEGUIR CON LA CREACION DE LAS DEMAS TABLAS QUE HACEN FALTA
--
--
--
--
--
--
--
--
--
--
--
--
--
--
--
--
--
--
--
--
--
--
--
--
--
--
--
--
--
--
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