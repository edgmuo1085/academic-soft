<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoUsuario
 *
 * @author 
 */
class TipoUsuario {
    private $codigo;
    
    public function __construct($codigo) {
        $this->codigo = $codigo;
    }
    public function getNombre() {
        switch ($this->codigo){
            case 'S': $nombre='Secretaria';break;
            case 'D': $nombre='Docente';break;
            case 'A': $nombre='Acudiente';break;
            case 'E': $nombre='Estudiante';break;
            default :$nombre='Desconocido';break;
        }
        return $nombre;
    }
    public function __toString() {
        return $this->getNombre();
    }

    public function getMenu() {
        $menu="<ul>";
        $menu.="<a id='v' href=principal.php?CONTENIDO=presentacion/inicio.php><img src='presentacion/imagenes/inicio.png'>Inicio</a>" .
                "<a id='v' href=principal.php?CONTENIDO=presentacion/cambiarClave.php><img src='presentacion/imagenes/claveC.png'>Cambiar Clave</a>".
                "<a id='v' href=principal.php?CONTENIDO=presentacion/cambiarClave.php><img src='presentacion/imagenes/claveC.png'>Consultar Notas</a>";
        
        switch ($this->codigo){
            case 'D': 
                $menu.="<a id='v' href=principal.php?CONTENIDO=presentacion/configuracion/eventos.php><img src='presentacion/imagenes/eventos.png'>Notas</a>".
                    "<a id='v' href=principal.php?CONTENIDO=presentacion/configuracion/eventos.php><img src='presentacion/imagenes/eventos.png'>Inasistencias</a>"  ;
                break;
            case 'S':
                $menu.="<a id='v' href=principal.php?CONTENIDO=presentacion/reportes/eventos.php><img src='presentacion/imagenes/certi1.png'>Asignación Docente</a>".
                    "<a id='v' href=principal.php?CONTENIDO=presentacion/reportes/eventos.php><img src='presentacion/imagenes/certi1.png'>Año Escolar</a>".
                    "<a id='v' href=principal.php?CONTENIDO=presentacion/reportes/eventos.php><img src='presentacion/imagenes/certi1.png'>Asignación Docente</a>".
                    "<a id='v' href=principal.php?CONTENIDO=presentacion/reportes/eventos.php><img src='presentacion/imagenes/certi1.png'>Personal Docente</a>".
                    "<a id='v' href=principal.php?CONTENIDO=presentacion/reportes/eventos.php><img src='presentacion/imagenes/certi1.png'>Grado</a>".
                    "<a id='v' href=principal.php?CONTENIDO=presentacion/reportes/eventos.php><img src='presentacion/imagenes/certi1.png'>Grupo</a>".
                    "<a id='v' href=principal.php?CONTENIDO=presentacion/reportes/eventos.php><img src='presentacion/imagenes/certi1.png'>Asignación Docente</a>";
                break;
        }
        $menu.="<a id='v' href=index.php><img src='presentacion/imagenes/salir.png'>Salir</a>";
        $menu.="</ul>";
        return $menu;
    }
    
    public function getMenuV1() {
        $menu="<ul>";
        $menu.="<a id='v' href=presentacion/inicio.php><i class='fas fa-home icon'></i>Inicio</a>" . "<a id='v' href=presentacion/cambiarClave.php><img src='presentacion/imagenes/claveC.png'>Cambiar Clave</a>";
        
        switch ($this->codigo){
            case 'A': 
                $menu.="<a id='v' href=presentacion/configuracion/eventos.php><i class='fas fa-chart-pie icon'></i><img src='presentacion/imagenes/eventos.png'>Eventos</a>";
                break;
            case 'V':
                $menu.="<a id='v' href=presentacion/configuracion/eventos.php><i class='fab fa-wpforms icon'></i><img src='presentacion/imagenes/certi1.png'>Certificacion</a>";
                break;
        }
        
        $menu.="<a id='v' href=index.php><img src='presentacion/imagenes/candidatos.png'>Candidatos</a>";
        $menu.="<a id='v' href=index.php><img src='presentacion/imagenes/salir.png'>Salir</a>";
        $menu.="</ul>";
        return $menu;
    }
}

