<?php

class Inasistencias
{
    protected $id;
    protected $cantidad;
    protected $justificacion;
    protected $fecha;
    protected $id_usuario_estudiante;
    protected $id_asignatura;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "SELECT id, cantidad, justificacion, fecha, id_usuario_estudiante, id_asignatura FROM inasistencias WHERE $campo=$valor";
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->cantidad = $campo['cantidad'];
            $this->justificacion = $campo['justificacion'];
            $this->fecha = $campo['fecha'];
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

    public function getFecha()
    {
        return $this->fecha;
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

    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
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

    public function guardar()
    {
        $cadenaSQL = "INSERT INTO inasistencias (cantidad, justificacion, fecha, id_usuario_estudiante, id_asignatura) values ('$this->cantidad','$this->justificacion', '$this->fecha', '$this->id_usuario_estudiante', '$this->id_asignatura')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function modificar($ID)
    {
        $cadenaSQL = "UPDATE inasistencias SET cantidad='{$this->cantidad}', justificacion='{$this->justificacion}', fecha='{$this->fecha}', id_usuario_estudiante='{$this->id_usuario_estudiante}', id_asignatura='{$this->id_asignatura}' WHERE id='{$ID}'";
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
        $cadenaSQL = "SELECT id, cantidad, justificacion, fecha, id_usuario_estudiante, id_asignatura FROM inasistencias $filtro $orden";
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
