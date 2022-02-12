/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/SQLTemplate.sql to edit this template
 */
/**
 * Author:  LRNeg
 * Created: 19 ene. 2022
 */
create table usuario(
    identificacion varchar(10) primary key,
    nombres  varchar(50) not null,
    apellidos  varchar(50) not null,
    telefono  varchar(10) not null,
    email  varchar(50) not null,
    direccion  varchar(30) null,
    contraseña  varchar(20) not null,
    tipo char(1) not null,
    estado bit not null
);
create table Nota(
    id int auto_increment primary key,
    idTipoDeActividad int not null references TipoActividad(id) on delete restrict on update cascade,
    digitarNota int not null,
    fecha datetime not null,
    nombreActividad varchar(800) not null,
    identificacionEstudiante varchar(10) not null,
    idPeriodoAcademico int not null references PeriodoAcademico(id) on delete restrict on update cascade
);

alter table Nota add foreign key(idTipoDeActividad) references TipoActividad(id) on delete restrict on update cascade;
alter table Nota add foreign key(idPeriodoAcademico) references PeriodoAcademico(id) on delete restrict on update cascade;

create table Inasistencia(
    id int auto_increment primary key,
    cantidad int null,
    justificacion varchar(100) null,
    fecha datetime null,
    identificacionEstudiante varchar(10) not null
    idAsignatura int not null references Inasistencia(id) on delete restrict on update cascade,
);
create table AsignacionDocente(
    id int auto_increment primary key,
    identificacionDocente varchar(10) not null,
    idAñoEscolar int not null references AñoEscolar(id) on delete restrict on update cascade,
    idAsignatura int not null references Asignatura(id) on delete restrict on update cascade,
    idGrado int not null references Grado(id) on delete restrict on update cascade,
    linkClasesVirtuales varchar(200) not null
);

alter table AsignacionDocente add foreign key(idAñoEscolar) references AñoEscolar(id) on delete restrict on update cascade;
alter table AsignacionDocente add foreign key(idAsignatura) references Asignatura(id) on delete restrict on update cascade;
alter table AsignacionDocente add foreign key(idGrado) references Grado(id) on delete restrict on update cascade;

create table InstitucionEducativa(
    id int auto_increment primary key,
    nombre varchar(40) NOT NULL,
    direccion varchar(30) NOT NULL,
    telefono varchar(10) NOT NULL,
    email varchar(30) NOT NULL,
    nombreDirectora varchar(40) NOT NULL,
    paginaWeb varchar(200) not null
);
create table PeriodoAcademico(
    id int auto_increment primary key,
    inicioPeriodo datetime not null,
    finalizacionPeriodo datetime not null,
    idAñoEscolar int not null references AñoEscolar(id) on delete restrict on update cascade
);

alter table PeriodoAcademico add foreign key(idAñoEscolar) references AñoEscolar(id) on delete restrict on update cascade;

create table AñoEscolar(
    id int auto_increment primary key,
    Inicio datetime not null,
    Fin datetime not null,
    idInstitucion int null references InstitucionEducativa(id) on delete restrict on update cascade
);

alter table AñoEscolar add foreign key(idInstitucion) references InstitucionEducativa(id) on delete restrict on update cascade;

create table Grado(
    id int auto_increment primary key,
    nombreGrado varchar(15) null,
    idInstitucion int not null null references InstitucionEducativa(id) on delete restrict on update cascade
);

alter table Grado add foreign key(idInstitucion) references InstitucionEducativa(id) on delete restrict on update cascade;

create table Grupo(
    id int auto_increment primary key,
    nombreGrupo varchar(15) null,
    idInstitucion int not null null references InstitucionEducativa(id) on delete restrict on update cascade
);

alter table Grupo add foreign key(idInstitucion) references InstitucionEducativa(id) on delete restrict on update cascade;

create table AsignaturaPorGrado(
    idGrado int not null null references Grado(id) on delete restrict on update cascade,
    idAsignatura int not null null references Asignatura(id) on delete restrict on update cascade,
    intensidadHoraria int not null
);

alter table AsignaturaPorGrado add foreign key(idGrado) references Grado(id) on delete restrict on update cascade;
alter table AsignaturaPorGrado add foreign key(idAsignatura) references Asignatura(id) on delete restrict on update cascade;

create table DirectorGrupo(
    id int auto_increment primary key,
    idGrupo int not null references Grupo(id) on delete restrict on update cascade,
    identificacionDocente varchar(10) not null,
    idAñoEscolar int not null references AñoEscolar(id) on delete restrict on update cascade
);

alter table DirectorGrupo add foreign key(idGrupo) references Grupo(id) on delete restrict on update cascade;
alter table DirectorGrupo add foreign key(idAñoEscolar) references AñoEscolar(id) on delete restrict on update cascade;

create table Asignatura(
    id int auto_increment primary key,
    nombreAsignatura varchar(30) not null
);
create table TipoActividad(
    id int auto_increment primary key,
    nombre varchar(100) not null
);
create table GrupoEstudiante(
    id int auto_increment primary key,
    identificacionEstudiante varchar(10) not null,
    idGrupo int not null references Grupo(id) on delete restrict on update cascade,
    idAñoEscolar int not null references AñoEscolar(id) on delete restrict on update cascade                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
);

alter table GrupoEstudiante add foreign key(idGrupo) references Grupo(id) on delete restrict on update cascade;
alter table GrupoEstudiante add foreign key(idAñoEscolar) references AñoEscolar(id) on delete restrict on update cascade;

create table Foro(
    id int auto_increment primary key,
    tema varchar(2000) not null,
    identificacionDocente varchar(10) not null,
    identificacionEstudiante varchar(10) not null,
    idforo int not null references Foro(id) on delete restrict on update cascade
);

alter table Foro add foreign key(idForo) references Foro(id) on delete restrict on update cascade;

create table logros(
    id int auto_increment primary key
);

