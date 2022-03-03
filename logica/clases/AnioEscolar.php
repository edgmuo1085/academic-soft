<?php

class AnioEscolar
{
    private $id;
    private $inicioAnio;
    private $finAnio;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "SELECT id, inicio, fin FROM anio_escolar WHERE $campo=$valor";
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }

            $this->id = $campo['id'];
            $this->inicioAnio = $campo['inicio'];
            $this->finAnio = $campo['fin'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getInicioAnio()
    {
        return $this->inicioAnio;
    }

    public function getFinAnio() 
    {
        return $this->finAnio;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }
    
    public function setInicioAnio($inicioAnio): void 
    {
        $this->inicioAnio = $inicioAnio;
    }

    public function setFinAnio($finAnio): void 
    {
        $this->finAnio = $finAnio;
    }
    
    public function __toString()
    {
        return $this->id;
    }

    public function guardar()
    {
        $cadenaSQL = "INSERT INTO anio_escolar (inicio, fin) values ('$this->inicioAnio', '$this->finAnio')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function modificar($ID)
    {
        $cadenaSQL = "UPDATE anio_escolar SET inicio='{$this->inicioAnio}', fin={$this->finAnio} WHERE id={$ID}";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "DELETE FROM anio_escolar WHERE id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = " WHERE $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = " ORDER BY $orden";
        $cadenaSQL = "SELECT id, inicio, fin FROM anio_escolar $filtro $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = AnioEscolar::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $anio = new AnioEscolar($resultado[$i], null);
            $lista[$i] = $anio;
        }
        return $lista;
    }
}
