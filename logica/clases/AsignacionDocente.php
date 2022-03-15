<?php

class AsignacionDocente
{
    protected $id;
    protected $id_usuario_docente;
    protected $id_anio_escolar;
    protected $id_asignatura;
    protected $id_grado;
    protected $link_clase_virtual;
    protected $intensidad_horaria;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "SELECT id, id_usuario_docente, id_anio_escolar, id_asignatura, id_grado, link_clase_virtual, intensidad_horaria FROM asignacion_docente WHERE $campo=$valor";
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->id_usuario_docente = $campo['id_usuario_docente'];
            $this->id_anio_escolar = $campo['id_anio_escolar'];
            $this->id_asignatura = $campo['id_asignatura'];
            $this->id_grado = $campo['id_grado'];
            $this->link_clase_virtual = $campo['link_clase_virtual'];
            $this->intensidad_horaria = $campo['intensidad_horaria'];
        }
    }

    public function getId()
    {
        return $this->id;
    }
    public function getIdUsuarioDocente()
    {
        return $this->id_usuario_docente;
    }
    public function getIdAnioEscolar()
    {
        return $this->id_anio_escolar;
    }
    public function getIdAsignatura()
    {
        return $this->id_asignatura;
    }

    public function getIdGrado()
    {
        return $this->id_grado;
    }

    public function getLinkClaseVirtual()
    {
        return $this->link_clase_virtual;
    }

    public function getIntensidadHoraria()
    {
        return $this->intensidad_horaria;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setIdUsuarioDocente($id_usuario_docente): void
    {
        $this->id_usuario_docente = $id_usuario_docente;
    }

    public function setIdAnioEscolar($id_anio_escolar): void
    {
        $this->id_anio_escolar = $id_anio_escolar;
    }

    public function setIdAsignatura($id_asignatura): void
    {
        $this->id_asignatura = $id_asignatura;
    }

    public function setIdGrado($id_grado): void
    {
        $this->id_grado = $id_grado;
    }

    public function setLinkClaseVirtual($link_clase_virtual): void
    {
        $this->link_clase_virtual = $link_clase_virtual;
    }

    public function setIntensidadHoraria($intensidad_horaria): void
    {
        $this->intensidad_horaria = $intensidad_horaria;
    }

    public function __toString()
    {
        return $this->id_grado;
    }

    public function guardar()
    {
        $cadenaSQL = "INSERT INTO asignacion_docente (id, id_usuario_docente, id_anio_escolar, id_asignatura, id_grado, link_clase_virtual, intensidad_horaria) values ('$this->nombre','$this->valor')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function modificar($ID)
    {
        $cadenaSQL = "UPDATE asignacion_docente SET id_usuario_docente='{$this->id_usuario_docente}', id_anio_escolar='{$this->id_anio_escolar}', id_asignatura='{$this->id_asignatura}', id_grado='{$this->id_grado}', link_clase_virtual='{$this->link_clase_virtual}', intensidad_horaria ='{$this->intensidad_horaria}' WHERE id='{$ID}'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "DELETE FROM asignacion_docente WHERE id='{$this->id}'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = " WHERE $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = " ORDER BY $orden";
        $cadenaSQL = "SELECT id, id_usuario_docente, id_anio_escolar, id_asignatura, id_grado, link_clase_virtual, intensidad_horaria FROM asignacion_docente $filtro $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = AsignacionDocente::getLista($filtro, $orden);
        $lista = array();
        foreach ($resultado as $key) {
            $usuario = new AsignacionDocente($key, null);
            array_push($lista, $usuario);
        }
        return $lista;
    }
}
