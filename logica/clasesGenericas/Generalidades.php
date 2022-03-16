<?php


class Generalidades
{
    public static function getEstadoUsuario($idEstado)
    {
        $estadoString = $idEstado == 1 ? 'Activo' : 'Inactivo';

        return $estadoString;
    }


    public static function getTooltip($accion)
    {
        switch ($accion) {
            case 1:
                return "<span class='as-tooltip'><i class='fas fa-edit'></i> <span class='as-tooltiptext'>Editar</span> </span>";
                break;
            case 2:
                return "<span class='as-tooltip'><i class='fas fa-trash'></i> <span class='as-tooltiptext'>Eliminar</span> </span>";
                break;

            default:
                return "<span class='as-tooltip'><i class='fas fa-edit'></i> <span class='as-tooltiptext'>Otra</span> </span>";
                break;
        }
    }
}
