<?php

class Asignaturaporgrado
{
    protected $id;
    protected $id_grado;
    protected $id_Asignatura;
    protected $intensidadHoraria;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "SELECT id, id_grado, id_asignatura, intensidad_horaria FROM asignatura_por_grado WHERE $campo=$valor";
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->id_grado = $campo['id_grado'];
            $this->id_Asignatura = $campo['id_asignatura'];
            $this->intensidadHoraria = $campo['intesidad_horario'];
        }
    }

    public function getId() 
    {
        return $this->id;
    }

    public function getId_grado() 
    {
        return $this->id_grado;
    }

    public function getId_Asignatura() 
    {
        return $this->id_Asignatura;
    }

    public function getIntensidadHoraria() 
    {
        return $this->intensidadHoraria;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setId_grado($id_grado): void
    {
        $this->id_grado = $id_grado;
    }

    public function setId_Asignatura($id_Asignatura): void 
    {
        $this->id_Asignatura = $id_Asignatura;
    }

    public function setIntensidadHoraria($intensidadHoraria): void 
    {
        $this->intensidadHoraria = $intensidadHoraria;
    }

    
    public function __toString()
    {
        return $this->id_grado;
    }

    public function guardar()
    {
        $cadenaSQL = "INSERT INTO asignatura_por_grado (id_grado, id_asignatura, intesidad_horaria) values ('$this->nombre','$this->valor')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function modificar($ID)
    {
        $cadenaSQL = "UPDATE asignatura_por_grado SET id_grado='{$this->id_grado}', id_asignatura='{$this->id_Asignatura}', intensidad_horaria ='{$this->intensidadHoraria}' WHERE id='{$ID}'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "DELETE FROM asignatura_por_grado WHERE id='{$this->id}'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = " WHERE $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = " ORDER BY $orden";
        $cadenaSQL = "SELECT id, id_grado, id_asignatura, intesidad_horaria FROM permisos $filtro $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = Asignaturaporgrado::getLista($filtro, $orden);
        $lista = array();
        foreach ($resultado as $key) {
            $usuario = new Asignaturaporgrado($key, null);
            array_push($lista, $usuario);
        }
        return $lista;
    }
}
