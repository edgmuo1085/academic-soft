<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fecha
 *
 * @author LEIDY CORDOBA
 */
class Fecha
{
    public static function calcularDiferenciaFechasEnSegundos($fecha1, $fecha2)
    {
        $inicio = strtotime($fecha1); //devuelve el numero de segundos que ha pasado desde el 1 de enero de 1970 hasta la fecha indicada
        $fin = strtotime($fecha2);
        $diferencia = $fin - $inicio;
        return $diferencia;
    }

    public static function calcularDiferenciaFechasEnDias($fecha1, $fecha2)
    {
        //devuelve la resta entre la fecha2 y la fecha1, la devolucion la hace en dias
        $fechaInicio = new DateTime($fecha1);
        $fechaFin = new DateTime($fecha2);
        $diferencia = $fechaFin->diff($fechaInicio);
        //print_r($diferencia);
        return $diferencia->days;
    }
}
