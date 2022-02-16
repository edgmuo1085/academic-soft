<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado'); //linea para que no se pueda acceder en otro navegador copiando la direccin de la barra
//$eventos = Evento::getListaEnObjetos("now() between inicio and fin", null);
?>

<h3>BIENVENIDO</h3>