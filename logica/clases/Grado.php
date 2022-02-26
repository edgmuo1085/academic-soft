<?php

class Grado
{
    private $id;
    private $nombreGrado;
    
    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "SELECT id, nombre_grado from grado where $campo=$valor";
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }

            $this->id=$campo['id'];
            $this->nombreGrado=$campo['nombre_grado'];
           
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombreGrado() 
    {
        return $this->nombreGrado;
    }

            
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setNombreGrado($nombreGrado): void 
    {
        $this->nombreGrado = $nombreGrado;
    }

    public function __toString()
    {
        return $this->nombreGrado;
    }

    public function guardar()
    {
        $cadenaSQL = "INSERT INTO grado (nombre_grado) values ('$this->nombreGrado'))";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function modificar($ID)
    {
        $cadenaSQL = "UPDATE grado set id='{$this->id}', nombre_grado='{$this->nombreGrado}')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "DELETE from grado where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = " WHERE $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = " ORDER BY $orden";
        $cadenaSQL = "SELECT id, nombre_grado from grado $filtro $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = Grado::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $grado = new Grado($resultado[$i], null);
            $lista[$i] = $grado;
        }
        return $lista;
    }
}
