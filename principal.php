<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
 require_once 'logica/clases/Persona.php';
 require_once 'logica/clasesGenericas/ConectorBD.php';
 require_once 'logica/clases/TipoPersona.php';
 require_once 'logica/clases/Evento.php';
 require_once 'logica/clasesGenericas/Fecha.php';
 require_once 'logica/clases/Candidato.php';
 require_once 'logica/clases/Votante.php';
 
 date_default_timezone_set('America/Bogota');

session_start();
if (!isset($_SESSION['usuario'])) header('location: index.php?mensaje=Acceso no autorizado');
$USUARIO= unserialize($_SESSION['usuario']);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bienvenido al software académico - <?=$USUARIO?> (<?= $USUARIO->getTipoEnObjeto() ?>)</title>
        <link rel="stylesheet" href="presentacion/css/style.css"/>
        <link rel="stylesheet" href="presentacion/css/estylos.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    
    </head>
    <body>
        <span class="nav-bar" id="btnMenu"><i class="fas fa-bars"></i>Menú</span>
        <nav class="main-nav">
            <ul class="menu" id="menu">
                <li class="menu__item"><a href="" class="menu__link">Inicio</a></li>
                <li class="menu__item"><a href="" class="menu__link">Institución</a></li>
                <li class="menu__item container-submenu">
                    <a href="#" class="menu__link submenu-btn">Notas<i class="fas fa-chevron-down"></i></a>
                    <ul class="submenu">
                       <li class="menu__item"><a href="" class="menu__link">Ingresar Notas</a>
                       </li>
                       <li class="menu__item"><a href="" class="menu__link">Corregir Notas</a>
                       </li>
                       <li class="menu__item"><a href="" class="menu__link">Consultar Notas Por Estudiante</a>
                       </li>
                       <li class="menu__item"><a href="" class="menu__link">Consultar Notas Por Curso</a>
                       </li>
                       <li class="menu__item"><a href="" class="menu__link">Imprimir Notas</a>
                       </li>
                    </ul> 
                </li>
                <li class="menu__item"><a href="" class="menu__link">Cambiar Clave</a></li>
                <li class="menu__item"><a href="" class="menu__link">Salir</a></li>
            </ul>
        </nav>
        <script src="menu.js">
            
        </script>
        </body>
</html>

