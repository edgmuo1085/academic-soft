<?php

class Asignatura
{
    private $id;
    private $nombreAsignatura;
    
    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "SELECT id, nombre_asignatura from asignatura where $campo=$valor";
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }

            $this->id = $campo['id'];
            $this->nombreAsignatura = $campo['nombre_asignatura'];
           
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombreAsignatura() 
    {
        return $this->nombreAsignatura;
    }

        
    public function setId($id): void
    {
        $this->id = $id;
    }
    
    public function setNombreAsignatura($nombreAsignatura): void 
    {
        $this->nombreAsignatura = $nombreAsignatura;
    }

    
    public function __toString()
    {
        return $this->nombreAsignatura;
    }

    public function guardar()
    {
        $cadenaSQL = "INSERT INTO asignatura (nombre_asignatura) values ('$this->nombreAsignatura'))";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function modificar($ID)
    {
        $cadenaSQL = "UPDATE asignatura set id='{$this->id}', nombre_asignatura='{$this->nombreAsignatura}')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "DELETE from asignatura where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = " WHERE $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = " ORDER BY $orden";
        $cadenaSQL = "SELECT id, nombre_asignatura from asignatura $filtro $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = Asignatura::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $asignatura = new Asignatura($resultado[$i], null);
            $lista[$i] = $asignatura;
        }
        return $lista;
    }
}
