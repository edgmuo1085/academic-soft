<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once 'logica/clases/Usuario.php';
require_once 'logica/clasesGenericas/ConectorBD.php';
require_once 'logica/clases/TipoUsuario.php';
require_once 'logica/clases/Evento.php';
require_once 'logica/clasesGenericas/Fecha.php';
require_once 'logica/clases/Candidato.php';
require_once 'logica/clases/Votante.php';

date_default_timezone_set('America/Bogota');
session_start();
if (!isset($_SESSION['usuario'])) header('location: index.php?mensaje=Acceso no autorizado');
$USUARIO = unserialize($_SESSION['usuario']);
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido al software académico - <?= $USUARIO ?> (<?= $USUARIO->getTipoEnObjeto() ?>)</title>
    <link rel="icon" type="image/png" href="layout/img/favicon.png" />
    <link rel="stylesheet" type="text/css" href="layout/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,700;1,100;1,400;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="as-nav-header">
            <div>
                <img class="as-logo" src="layout/img/logo-oficial.png" alt="logo" />
            </div>
            <div class="as-information">
                <h3 class="as-title">COLEGIO LOS ANDES NUESTRA SEÑORA DE LAS MERCEDES</h3>
                <p>Institución educativa con 35 años de trayectoria, basada en la educación integral
                    y personalizada. Contamos con altos estándares en educación, donde hacemos énfasis a
                    nuestro lema "NADA ES TAM IMPORTANTE COMO UN NIÑO".</p>
            </div>
        </nav>
    </header>

    <span class="as-nav-bar" id="as-menu-btn"><i class="fas fa-bars"></i> Menú</span>
    <nav class="as-main-nav">
        <ul class="as-menu" id="as-menu">
            <li class="menu__item"><a href="#" class="as-menu__link">Inicio</a></li>
            <li class="menu__item"><a href="#" class="as-menu__link">Nosotros</a></li>
            <li class="menu__item as-dropdown-submenu">
                <a href="#" class="as-menu__link as-submenu-btn">Servicios <i class="fas fa-chevron-down"></i></a>
                <ul class="as-submenu">
                    <li class="menu__item">
                        <a href="#" class="as-menu__link">Play</a>
                    </li>
                    <li class="menu__item">
                        <a href="#" class="as-menu__link">Platos</a>
                    </li>
                    <li class="menu__item">
                        <a href="#" class="as-menu__link">Restaurant</a>
                    </li>
                    <li class="menu__item">
                        <a href="#" class="as-menu__link">Ciudades</a>
                    </li>
                </ul>
            </li>
            <li class="menu__item"><a href="#" class="as-menu__link">Ayuda</a></li>
            <li class="menu__item as-dropdown-submenu">
                <a href="#" class="as-menu__link as-submenu-btn">Servicios <i class="fas fa-chevron-down"></i></a>
                <ul class="as-submenu">
                    <li class="menu__item">
                        <a href="#" class="as-menu__link">Play</a>
                    </li>
                    <li class="menu__item">
                        <a href="#" class="as-menu__link">Platos</a>
                    </li>
                    <li class="menu__item">
                        <a href="#" class="as-menu__link">Restaurant</a>
                    </li>
                    <li class="menu__item">
                        <a href="#" class="as-menu__link">Ciudades</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <main class="as-layout">
        <?= include $_REQUEST['CONTENIDO']; ?>
    </main>

    <footer class="as-footer">
        <p>Derechos Reservados</p>
        <p>
            <script>
                date = new Date().getFullYear();
                document.write(date);
            </script>
        </p>
        <p>&copy;</p>
    </footer>

    <script src="layout/js/main.js"></script>
</body>

</html>