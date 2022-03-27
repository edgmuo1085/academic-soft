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
    identificacion varchar(15) NOT NULL UNIQUE,
    nombres varchar(50) NOT NULL,
    apellidos varchar(50) NOT NULL,
    telefono varchar(10) NULL,
    email varchar(50) NOT NULL,
    direccion varchar(30) DEFAULT NULL,
    clave varchar(40) DEFAULT NULL,
    rol_id INT(4) NOT NULL,
    estado INT(1) NOT NULL,
    INDEX (rol_id),
    FOREIGN KEY (rol_id) REFERENCES roles(id) ON DELETE RESTRICT ON UPDATE CASCADE
);
--
--
-- CREAR TABLA anio_escolar
-- DROP TABLE IF EXISTS anio_escolar;
--
CREATE TABLE anio_escolar (
    id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    inicio DATETIME NOT NULL,
    fin DATETIME NOT NULL,
    id_institucion INT(4) NOT NULL,
    estado INT(4) NOT NULL,
    FOREIGN KEY (id_institucion) REFERENCES institucion_educativa(id) ON DELETE RESTRICT ON UPDATE CASCADE
);
--
--
-- CREAR TABLA periodo_academico
-- DROP TABLE IF EXISTS periodo_academico;
--
CREATE TABLE periodo_academico (
    id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    inicio_periodo DATETIME NOT NULL,
    finalizacion_periodo DATETIME NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    id_anio_escolar INT(4) NOT NULL,
    FOREIGN KEY (id_anio_escolar) REFERENCES anio_escolar(id) ON DELETE RESTRICT ON UPDATE CASCADE
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
    FOREIGN KEY (id_institucion) REFERENCES institucion_educativa(id) ON DELETE RESTRICT ON UPDATE CASCADE
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
    FOREIGN KEY (id_grado) REFERENCES grado(id) ON DELETE RESTRICT ON UPDATE CASCADE
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
    id_usuario_estudiante INT(4) NOT NULL,
    id_grupo INT(4) NOT NULL,
    id_anio_escolar INT(4) NOT NULL,
    FOREIGN KEY (id_usuario_estudiante) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (id_grupo) REFERENCES grupo(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (id_anio_escolar) REFERENCES anio_escolar(id) ON DELETE RESTRICT ON UPDATE CASCADE
);
--
--
-- CREAR TABLA asignacion_docente
-- DROP TABLE IF EXISTS asignacion_docente;
--
CREATE TABLE asignacion_docente (
    id INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_usuario_docente INT(4) NOT NULL,
    id_anio_escolar INT(4) NOT NULL,
    id_asignatura INT(4) NOT NULL,
    id_grupo INT(4) NOT NULL,
    link_clase_virtual TEXT NULL,
    intensidad_horaria DOUBLE NULL,
    FOREIGN KEY (id_usuario_docente) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (id_anio_escolar) REFERENCES anio_escolar(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (id_asignatura) REFERENCES asignatura(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (id_grupo) REFERENCES grupo(id) ON DELETE RESTRICT ON UPDATE CASCADE
);
--
--
-- CREAR TABLA inasistencias
-- DROP TABLE IF EXISTS inasistencias;
--
CREATE TABLE inasistencias (
    id INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cantidad INT(4) NOT NULL,
    justificacion TEXT NULL,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    id_asignatura INT(4) NOT NULL,
    registrado_a_estudiante INT(4) NOT NULL,
    creado_por_docente INT(4) NOT NULL,
    FOREIGN KEY (id_asignatura) REFERENCES asignatura(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (registrado_a_estudiante) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (creado_por_docente) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE
);
--
--
-- CREAR TABLA tipo_actividad
-- DROP TABLE IF EXISTS tipo_actividad;
--
CREATE TABLE tipo_actividad (
    id INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_actividad VARCHAR(200) NOT NULL
);
--
--
-- CREAR TABLA nota
-- DROP TABLE IF EXISTS nota;
--
CREATE TABLE nota (
    id INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_usuario_estudiante INT(4) NOT NULL,
    id_periodo_academico INT(4) NOT NULL,
    id_asignatura INT(4) NOT NULL,
    id_tipo_actividad INT(4) NOT NULL,
    nota DOUBLE NULL,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario_estudiante) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (id_asignatura) REFERENCES asignatura(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (id_periodo_academico) REFERENCES periodo_academico(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (id_tipo_actividad) REFERENCES tipo_actividad(id) ON DELETE RESTRICT ON UPDATE CASCADE
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
VALUES ('Secretaria', 'S'),
    ('Docente', 'D'),
    ('Acudiente', 'A'),
    ('Estudiante', 'E'),
    ('Desconocido', 'N'),
    ('Root', 'R');
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
    ),
    (
        '100101',
        'Pedro',
        'Cifuentes',
        '12344321',
        'test@gmail.com',
        'Cll. 19 # 3 - 1',
        '202cb962ac59075b964b07152d234b70',
        2,
        1
    ),
    (
        '100102',
        'Tipo',
        'Peralta',
        '12344321',
        'test@gmail.com',
        'Cll. 19 # 3 - 1',
        '202cb962ac59075b964b07152d234b70',
        3,
        1
    ),
    (
        '100103',
        'Carlos',
        'Zambrano',
        '12344321',
        'test@gmail.com',
        'Cll. 19 # 3 - 1',
        '202cb962ac59075b964b07152d234b70',
        4,
        1
    ),
    (
        '100104',
        'Desconocido',
        'Desconocido',
        '12344321',
        'test@gmail.com',
        'Cll. 19 # 3 - 1',
        '202cb962ac59075b964b07152d234b70',
        5,
        1
    ),
    (
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
INSERT INTO anio_escolar (inicio, fin, id_institucion, estado)
VALUES ('2023-01-01', '2023-12-01', 1, 1);
--
--
--
-- TABLA periodo_academico
INSERT INTO periodo_academico (
        nombre,
        inicio_periodo,
        finalizacion_periodo,
        id_anio_escolar
    )
VALUES (
        'Periodo 1',
        '2023-01-01 23:59:59',
        '2023-03-30 00:00:00',
        1
    ),
    (
        'Periodo 2',
        '2023-04-01 23:59:59',
        '2023-06-30 00:00:00',
        1
    ),
    (
        'Periodo 3',
        '2023-07-01 23:59:59',
        '2023-09-30 00:00:00',
        1
    ),
    (
        'Periodo 4',
        '2023-10-01 23:59:59',
        '2023-12-30 00:00:00',
        1
    );
--
--
--
-- TABLA grado
INSERT INTO grado (nombre_grado, id_institucion)
VALUES ('Párbulos', 1),
    ('Primero', 1),
    ('Segundo', 1),
    ('Tercero', 1),
    ('Cuarto', 1),
    ('Quinto', 1),
    ('Sexto', 1),
    ('Séptimo', 1),
    ('Octavo', 1),
    ('Noveno', 1),
    ('Décimo', 1),
    ('Onceavo', 1);
--
--
--
-- TABLA grupo
INSERT INTO grupo (nombre_grupo, id_grado)
VALUES ('A', 1),
    ('B', 1),
    ('A', 2),
    ('B', 2),
    ('A', 3),
    ('B', 3),
    ('A', 4),
    ('B', 4),
    ('A', 5),
    ('B', 5),
    ('A', 6),
    ('B', 6),
    ('A', 7),
    ('B', 7),
    ('A', 8),
    ('B', 8),
    ('A', 9),
    ('B', 9),
    ('A', 10),
    ('B', 10),
    ('A', 11),
    ('B', 11),
    ('A', 12),
    ('B', 12);
--
--
--
-- TABLA asignatura
INSERT INTO asignatura (nombre_asignatura)
VALUES ('Matematicas'),
    ('Español'),
    ('Sociales'),
    ('Naturales'),
    ('Inglés'),
    ('Informática'),
    ('Etica y Valores'),
    ('Religion'),
    ('Educacion Fisica');
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
    ),
    (
        'Año escolar',
        'principal.php?CONTENIDO=layout/components/anio-escolar/lista-anio.php',
        2,
        1,
        2
    ),
    (
        'Periodo Academico',
        'principal.php?CONTENIDO=layout/components/periodo-academico/lista-periodo.php',
        2,
        1,
        3
    ),
    (
        'Grados',
        'principal.php?CONTENIDO=layout/components/grado/lista-grado.php',
        2,
        1,
        4
    ),
    (
        'Grupos',
        'principal.php?CONTENIDO=layout/components/grupo/lista-grupo.php',
        2,
        1,
        5
    ),
    (
        'Asignatura',
        'principal.php?CONTENIDO=layout/components/asignatura/lista-asignatura.php',
        1,
        null,
        6
    ),
    (
        'Docentes',
        '#',
        1,
        null,
        7
    ),
    (
        'Personal Docente',
        'principal.php?CONTENIDO=layout/components/docente/lista-docente.php',
        2,
        7,
        8
    ),
    (
        'Asignacion Docente',
        'principal.php?CONTENIDO=layout/components/docente/lista-asignacion-docente.php',
        2,
        7,
        9
    ),
    (
        'Estudiantes',
        '#',
        1,
        null,
        10
    ),
    (
        'Listado',
        'principal.php?CONTENIDO=layout/components/estudiante/lista-estudiante.php',
        2,
        10,
        11
    ),
    (
        'Listado de Grupos',
        'principal.php?CONTENIDO=layout/components/estudiante/lista-estudiante-grupo.php',
        2,
        10,
        12
    ),
    (
        'Listar Inasistencias',
        'principal.php?CONTENIDO=layout/components/inasistencias/lista-inasistencias.php',
        2,
        10,
        13
    ),
    (
        'Gestionar Inasistencias',
        'principal.php?CONTENIDO=layout/components/inasistencias/lista-inasistencias-total.php',
        2,
        10,
        14
    ),
    (
        'Notas',
        '#',
        1,
        null,
        15
    ),
    (
        'Gestionar Notas',
        'principal.php?CONTENIDO=layout/components/notas/lista-notas.php',
        2,
        15,
        16
    ),
    (
        'Consultar Notas',
        'principal.php?CONTENIDO=layout/components/notas/lista-notas-total.php',
        2,
        15,
        17
    ),
    (
        'Imprimir Notas',
        '#',
        2,
        15,
        18
    ),
    (
        'Tipo de Actividades',
        'principal.php?CONTENIDO=layout/components/tipo-actividad/lista-tipo-actividad.php',
        2,
        15,
        19
    );
--
--
--
-- TABLA permisos
-- rol = 6 Super Admin
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (6, 1, 1),
    (6, 2, 1),
    (6, 3, 1),
    (6, 4, 1),
    (6, 5, 1),
    (6, 6, 1),
    (6, 7, 1),
    (6, 8, 1),
    (6, 9, 1),
    (6, 10, 1),
    (6, 11, 1),
    (6, 12, 1),
    (6, 13, 1),
    (6, 14, 1),
    (6, 15, 1),
    (6, 16, 1),
    (6, 17, 1),
    (6, 18, 1),
    (6, 19, 1);
--rol=1 secretaria
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (1, 1, 1),
    (1, 2, 1),
    (1, 3, 1),
    (1, 4, 1),
    (1, 5, 1),
    (1, 6, 1),
    (1, 7, 1),
    (1, 8, 1),
    (1, 9, 1),
    (1, 10, 1),
    (1, 11, 1),
    (1, 12, 1),
    (1, 13, 1),
    (1, 14, 1),
    (1, 15, 1),
    (1, 16, 1),
    (1, 17, 1),
    (1, 18, 1),
    (1, 19, 1);
--
--
/**permisos para un docente**/
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (2, 7, 1),
    (2, 9, 1),
    (2, 10, 1),
    (2, 11, 1),
    (2, 12, 1),
    (2, 13, 1),
    (2, 14, 1),
    (2, 15, 1),
    (2, 16, 1),
    (2, 17, 1);
SELECT *
FROM menu m;
/**permisos para un estudiante**/
INSERT INTO permisos (id_rol, id_menu, estado)
VALUES (4, 7, 1),
(4, 8, 1),
(4, 10, 1),
(4, 13, 1),
(4, 15, 1),
(4, 17, 1);
SELECT *
FROM menu m;
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
--SOLO EJECUTAR HASTA AQUI LO DE ABAJO SOLO ES PARA SEGUIR CON LA CREACION DE LAS DEMAS TABLAS QUE HACEN FALTA
--
--
--
SELECT grupo_estudiante.id,
    grupo_estudiante.id_usuario_estudiante,
    grupo_estudiante.id_grupo,
    grupo_estudiante.id_anio_escolar,
    usuario.identificacion,
    usuario.nombres,
    usuario.apellidos,
    grado.nombre_grado,
    grupo.nombre_grupo,
    grupo.id_grado
FROM grupo_estudiante
    JOIN usuario ON grupo_estudiante.id_usuario_estudiante = usuario.id
    JOIN grupo ON grupo_estudiante.id_grupo = grupo.id
    JOIN grado ON grupo.id_grado = grado.id;
---
SELECT a.id as id_a,
    gd.nombre_grado,
    gr.nombre_grupo,
    a.nombre_asignatura
FROM asignatura a
    JOIN asignacion_docente ad ON a.id = ad.id_asignatura
    JOIN grupo gr ON ad.id_grupo = gr.id
    JOIN grupo_estudiante ge ON gr.id = ge.id_grupo
    JOIN grado gd ON gr.id_grado = gd.id
ORDER BY gd.nombre_grado,
    gr.nombre_grupo,
    a.nombre_asignatura;
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
    table_name,
    index_name;
--
--
---CREATE INDEX id_index ON usuario (id);
---ALTER TABLE name_table AUTO_INCREMENT = 0;
---ALTER TABLE asignacion_docente DROP FOREIGN KEY asignacion_docente_ibfk_4;
---ALTER TABLE asignacion_docente RENAME COLUMN id_grado TO id_grupo;
---ALTER TABLE asignacion_docente ADD FOREIGN KEY(id_grupo) REFERENCES grupo(id) ON DELETE RESTRICT ON UPDATE CASCADE;
---ALTER TABLE academico.inasistencias ADD creado_por_docente int(4) NULL;
--
--