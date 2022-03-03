<?php

class PeriodoAcademico
{
    private $id;
    private $inicioPeriodo;
    private $finalizacionPeriodo;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "SELECT id, inicio-periodo, finalizacion_periodo FROM periodo_academico WHERE $campo=$valor";
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }

            $this->id = $campo['id'];
            $this->inicioPeriodo = $campo['inicio_periodo'];
            $this->finalizacionPeriodo = $campo['finalizacion_periodo'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getInicioPeriodo() {
        return $this->inicioPeriodo;
    }

    public function getFinalizacionPeriodo() {
        return $this->finalizacionPeriodo;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }
    
    public function setInicioPeriodo($inicioPeriodo): void 
    {
        $this->inicioPeriodo = $inicioPeriodo;
    }

    public function setFinalizacionPeriodo($finalizacionPeriodo): void 
    {
        $this->finalizacionPeriodo = $finalizacionPeriodo;
    }

    public function __toString()
    {
        return $this->inicioPeriodo;
    }

    public function guardar()
    {
        $cadenaSQL = "INSERT INTO periodo_academico (inicio_periodo, finalizacion_periodo) values ('$this->inicioPeriodo', '$this->finalizacionPeriodo')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function modificar($ID)
    {
        $cadenaSQL = "UPDATE periodo_academico SET inicio_periodo='{$this->inicioPeriodo}', finalizacion_periodo='{$this->finalizacionPeriodo}' WHERE id={$ID}";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "DELETE FROM periodo_academico WHERE id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = " WHERE $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = " ORDER BY $orden";
        $cadenaSQL = "SELECT id, inicio_periodo, finalizacion_periodo FROM periodo_academico $filtro $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = PeriodoAcademico::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $periodo = new PeriodoAcademico($resultado[$i], null);
            $lista[$i] = $periodo;
        }
        return $lista;
    }
}
