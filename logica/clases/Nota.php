<?php

class Notas
{
    protected $id;
    protected $id_usuario_estudiante;
    protected $id_periodo_academico;
    protected $id_asignatura;
    protected $id_tipo_actividad;
    protected $fecha_creacion;
    protected $fecha_modificacion;
    protected $nota;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "SELECT id, id_usuario_estudiante, id_asignatura, id_periodo_academico, id_tipo_actividad, fecha_creacion, fecha_modificacion, nota FROM nota WHERE $campo=$valor";
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->id_usuario_estudiante = $campo['id_usuario_estudiante'];
            $this->id_asignatura = $campo['id_asignatura'];
            $this->id_periodo_academico = $campo['id_periodo_academico'];
            $this->id_tipo_actividad = $campo['id_tipo_actividad'];
            $this->nota = $campo['nota'];
            $this->fecha_creacion = $campo['fecha_creacion'];
            $this->fecha_modificacion = $campo['fecha_modificacion'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdUsuarioEstudiante()
    {
        return $this->id_usuario_estudiante;
    }

    public function getIdAsignatura()
    {
        return $this->id_asignatura;
    }

    public function getIdPeriodoAcademico()
    {
        return $this->id_periodo_academico;
    }

    public function getIdTipoActividad()
    {
        return $this->id_tipo_actividad;
    }

    public function getNota()
    {
        return $this->nota;
    }

    public function getFechaCreacion()
    {
        return $this->fecha_creacion;
    }

    public function getFechaModificacion()
    {
        return $this->fecha_modificacion;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setIdUsuarioEstudiante($id_usuario_estudiante): void
    {
        $this->id_usuario_estudiante = $id_usuario_estudiante;
    }

    public function setIdPeriodoAcademico($id_periodo_academico): void
    {
        $this->id_periodo_academico = $id_periodo_academico;
    }

    public function setIdAsignatura($id_asignatura): void
    {
        $this->id_asignatura = $id_asignatura;
    }

    public function setIdTipoActividad($id_tipo_actividad): void
    {
        $this->id_tipo_actividad = $id_tipo_actividad;
    }

    public function setNota($nota): void
    {
        $this->nota = $nota;
    }

    public function setFechaCreacion($fecha_creacion): void
    {
        $this->fecha_creacion = $fecha_creacion;
    }

    public function setFechaModificacion($fecha_modificacion): void
    {
        $this->fecha_modificacion = $fecha_modificacion;
    }

    public function getNombreEstudiante()
    {
        return new Usuario('id', $this->id_usuario_estudiante);
    }

    public function getPeriodoAcademico()
    {
        return new PeriodoAcademico('id', $this->id_periodo_academico);
    }

    public function getNombreTipoActividad()
    {
        return new TipoActividad('id', $this->id_tipo_actividad);
    }

    public function getNombreAsignatura()
    {
        return new Asignatura('id', $this->id_asignatura);
    }

    public function __toString()
    {
        return $this->id_tipo_actividad;
    }

    public function guardar()
    {
        $cadenaSQL = "INSERT INTO nota (id_usuario_estudiante, id_asignatura, id_periodo_academico, id_tipo_actividad, nota) VALUES ('$this->id_usuario_estudiante','$this->id_asignatura','$this->id_periodo_academico','$this->id_tipo_actividad','$this->nota')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function modificar($ID)
    {
        $cadenaSQL = "UPDATE nota SET id_usuario_estudiante='{$this->id_usuario_estudiante}', id_asignatura='{$this->id_asignatura}', id_periodo_academico='{$this->id_periodo_academico}', id_tipo_actividad='{$this->id_tipo_actividad}', nota ='{$this->nota}' WHERE id='{$ID}'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "DELETE FROM nota WHERE id='{$this->id}'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = " WHERE $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = " ORDER BY $orden";
        $cadenaSQL = "SELECT id, id_usuario_estudiante, id_asignatura, id_periodo_academico, id_tipo_actividad, fecha_creacion, fecha_modificacion, nota FROM nota $filtro $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = Notas::getLista($filtro, $orden);
        $lista = array();
        foreach ($resultado as $key) {
            $notas = new Notas($key, null);
            array_push($lista, $notas);
        }
        return $lista;
    }
}
