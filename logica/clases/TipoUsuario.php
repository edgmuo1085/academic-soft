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
        $menu.="<a id='v' href=principal.php?CONTENIDO=layout/inicio.php><img src='layout/imagenes/inicio.png'>Inicio</a>" .
                "<a id='v' href=principal.php?CONTENIDO=layout/cambiarClave.php><img src='layout/imagenes/claveC.png'>Cambiar Clave</a>".
                "<a id='v' href=principal.php?CONTENIDO=layout/cambiarClave.php><img src='layout/imagenes/claveC.png'>Consultar Notas</a>";
        
        switch ($this->codigo){
            case 'D': 
                $menu.="<a id='v' href=principal.php?CONTENIDO=layout/configuracion/eventos.php><img src='layout/imagenes/eventos.png'>Notas</a>".
                    "<a id='v' href=principal.php?CONTENIDO=layout/configuracion/eventos.php><img src='layout/imagenes/eventos.png'>Inasistencias</a>"  ;
                break;
            case 'S':
                $menu.="<a id='v' href=principal.php?CONTENIDO=layout/reportes/eventos.php><img src='layout/imagenes/certi1.png'>Asignación Docente</a>".
                    "<a id='v' href=principal.php?CONTENIDO=layout/reportes/eventos.php><img src='layout/imagenes/certi1.png'>Año Escolar</a>".
                    "<a id='v' href=principal.php?CONTENIDO=layout/reportes/eventos.php><img src='layout/imagenes/certi1.png'>Asignación Docente</a>".
                    "<a id='v' href=principal.php?CONTENIDO=layout/reportes/eventos.php><img src='layout/imagenes/certi1.png'>Personal Docente</a>".
                    "<a id='v' href=principal.php?CONTENIDO=layout/reportes/eventos.php><img src='layout/imagenes/certi1.png'>Grado</a>".
                    "<a id='v' href=principal.php?CONTENIDO=layout/reportes/eventos.php><img src='layout/imagenes/certi1.png'>Grupo</a>".
                    "<a id='v' href=principal.php?CONTENIDO=layout/reportes/eventos.php><img src='layout/imagenes/certi1.png'>Asignación Docente</a>";
                break;
        }
        $menu.="<a id='v' href=index.php><img src='layout/imagenes/salir.png'>Salir</a>";
        $menu.="</ul>";
        return $menu;
    }
    
    public function getMenuV1() {
        $menu="<ul>";
        $menu.="<a id='v' href=layout/inicio.php><i class='fas fa-home icon'></i>Inicio</a>" . "<a id='v' href=layout/cambiarClave.php><img src='layout/imagenes/claveC.png'>Cambiar Clave</a>";
        
        switch ($this->codigo){
            case 'A': 
                $menu.="<a id='v' href=layout/configuracion/eventos.php><i class='fas fa-chart-pie icon'></i><img src='layout/imagenes/eventos.png'>Eventos</a>";
                break;
            case 'V':
                $menu.="<a id='v' href=layout/configuracion/eventos.php><i class='fab fa-wpforms icon'></i><img src='layout/imagenes/certi1.png'>Certificacion</a>";
                break;
        }
        
        $menu.="<a id='v' href=index.php><img src='layout/imagenes/candidatos.png'>Candidatos</a>";
        $menu.="<a id='v' href=index.php><img src='layout/imagenes/salir.png'>Salir</a>";
        $menu.="</ul>";
        return $menu;
    }
}

