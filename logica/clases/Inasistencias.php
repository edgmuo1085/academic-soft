<?php

class Inasistencias
{
    protected $id;
    protected $cantidad;
    protected $justificacion;
    protected $fecha_creacion;
    protected $fecha_modificacion;
    protected $id_usuario_estudiante;
    protected $id_asignatura;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "SELECT ";
                $cadenaSQL .= "i.id, i.cantidad, i.justificacion, i.fecha_creacion, i.fecha_modificacion, i.id_usuario_estudiante, i.id_asignatura, ";
                $cadenaSQL .= "a.nombre_asignatura, ";
                $cadenaSQL .= "u.identificacion, u.nombres, u.apellidos, u.estado ";
                $cadenaSQL .= "FROM inasistencias i  ";
                $cadenaSQL .= "JOIN asignatura a ON i.id_asignatura = a.id ";
                $cadenaSQL .= "JOIN usuario u ON i.id_usuario_estudiante = u.id WHERE $campo=$valor";
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->cantidad = $campo['cantidad'];
            $this->justificacion = $campo['justificacion'];
            $this->fecha_creacion = $campo['fecha_creacion'];
            $this->fecha_modificacion = $campo['fecha_modificacion'];
            $this->id_usuario_estudiante = $campo['id_usuario_estudiante'];
            $this->id_asignatura = $campo['id_asignatura'];
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

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getJustificacion()
    {
        return $this->justificacion;
    }

    public function getFechaCreacion()
    {
        return $this->fecha_creacion;
    }

    public function getFechaModificacion()
    {
        return $this->fecha_modificacion;
    }

    public function getIdAsignatura()
    {
        return $this->id_asignatura;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setCantidad($cantidad): void
    {
        $this->cantidad = $cantidad;
    }

    public function setJustificacion($justificacion): void
    {
        $this->justificacion = $justificacion;
    }

    public function setFechaCreacion($fecha_creacion): void
    {
        $this->fecha_creacion = $fecha_creacion;
    }

    public function setFechaModificacion($fecha_modificacion): void
    {
        $this->fecha_modificacion = $fecha_modificacion;
    }

    public function setIdUsuarioEstudiante($id_usuario_estudiante): void
    {
        $this->id_usuario_estudiante = $id_usuario_estudiante;
    }

    public function setIdAsignatura($id_asignatura): void
    {
        $this->id_asignatura = $id_asignatura;
    }

    public function __toString()
    {
        return $this->cantidad;
    }

    public function getNombreEstudiante()
    {
        return new Usuario('id', $this->id_usuario_estudiante);
    }

    public function getNombreAsignatura()
    {
        return new Asignatura('id', $this->id_asignatura);
    }

    public function guardar()
    {
        $cadenaSQL = "INSERT INTO inasistencias (cantidad, justificacion, id_usuario_estudiante, id_asignatura) values ('$this->cantidad','$this->justificacion', '$this->id_usuario_estudiante', '$this->id_asignatura')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function modificar($ID)
    {
        $cadenaSQL = "UPDATE inasistencias SET cantidad='{$this->cantidad}', justificacion='{$this->justificacion}', id_usuario_estudiante='{$this->id_usuario_estudiante}', id_asignatura='{$this->id_asignatura}' WHERE id='{$ID}'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "DELETE FROM inasistencias WHERE id='{$this->id}'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = " WHERE $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = " ORDER BY $orden";
        $cadenaSQL = "SELECT ";
        $cadenaSQL .= "i.id, i.cantidad, i.justificacion, i.fecha_creacion, i.fecha_modificacion, i.id_usuario_estudiante, i.id_asignatura, ";
        $cadenaSQL .= "a.nombre_asignatura, ";
        $cadenaSQL .= "u.identificacion, u.nombres, u.apellidos, u.estado ";
        $cadenaSQL .= "FROM inasistencias i  ";
        $cadenaSQL .= "JOIN asignatura a ON i.id_asignatura = a.id ";
        $cadenaSQL .= "JOIN usuario u ON i.id_usuario_estudiante = u.id $filtro $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = Inasistencias::getLista($filtro, $orden);
        $lista = array();
        foreach ($resultado as $key) {
            $inasistencia = new Inasistencias($key, null);
            array_push($lista, $inasistencia);
        }
        return $lista;
    }
}
