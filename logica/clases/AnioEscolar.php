<?php

class AnioEscolar
{
    private $id;
    private $inicio;
    private $fin;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "SELECT id, inicio, fin FROM anio_escolar WHERE $campo=$valor";
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }

            $this->id = $campo['id'];
            $this->inicio = $campo['inicio'];
            $this->fin = $campo['fin'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getInicio()
    {
        return $this->inicio;
    }

    public function getFin()
    {
        return $this->fin;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setInicio($inicio): void
    {
        $this->inicio = $inicio;
    }

    public function setFin($fin): void
    {
        $this->fin = $fin;
    }

    public function __toString()
    {
        return $this->inicio;
    }

    public function guardar()
    {
        $cadenaSQL = "INSERT INTO anio_escolar (inicio, fin) values ('$this->inicio', '$this->fin')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function modificar($ID)
    {
        $cadenaSQL = "UPDATE anio_escolar SET inicio='{$this->inicio}', fin='{$this->fin}' WHERE id={$ID}";
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
            $anioEscolar = new AnioEscolar($resultado[$i], null);
            $lista[$i] = $anioEscolar;
        }
        return $lista;
    }
}
