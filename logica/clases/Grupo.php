<?php

class Grupo
{
    private $id;
    private $nombreGrupo;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "SELECT id, nombre_grupo FROM grupo WHERE $campo=$valor";
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }

            $this->id = $campo['id'];
            $this->nombreGrupo = $campo['nombre_grupo'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombreGrupo() 
    {
        return $this->nombreGrupo;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setNombreGrupo($nombreGrupo): void 
    {
        $this->nombreGrupo = $nombreGrupo;
    }
    
    public function __toString()
    {
        return $this->nombreGrupo;
    }

    public function guardar()
    {
        $cadenaSQL = "INSERT INTO grupo (nombre_grupo) values ('$this->nombreGrupo')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function modificar($ID)
    {
        $cadenaSQL = "UPDATE grupo SET nombre_grupo='{$this->nombreGrupo}' WHERE id={$ID}";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "DELETE FROM grupo WHERE id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = " WHERE $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = " ORDER BY $orden";
        $cadenaSQL = "SELECT id, nombre_grupo FROM grupo $filtro $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = Grupo::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $grupo = new Grupo($resultado[$i], null);
            $lista[$i] = $grupo;
        }
        return $lista;
    }
}
