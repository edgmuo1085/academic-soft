<?php

class Docente
{
    protected $id;
    protected $identificacion;
    protected $nombres;
    protected $apellidos;
    protected $telefono;
    protected $id_asignatura;
    protected $id_grado;
    protected $email;
    protected $direccion;
    protected $estado;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, identificacion, nombres, apellidos, telefono, id_asignatura, id_grado, email, direccion, estado from docente where $campo=$valor";
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->identificacion = $campo['identificacion'];
            $this->nombres = $campo['nombres'];
            $this->apellidos = $campo['apellidos'];
            $this->telefono = $campo['telefono'];
            $this->email = $campo['email'];
            $this->id_asignatura = $campo['id_asignatura'];
            $this->id_grado = $campo['id_grado'];
            $this->direccion = $campo['direccion'];
            $this->estado = $campo['estado'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    public function getNombres()
    {
        return $this->nombres;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getId_asignatura()
    {
        return $this->id_asignatura;
    }

    public function getId_grado()
    {
        return $this->id_grado;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setIdentificacion($identificacion): void
    {
        $this->identificacion = $identificacion;
    }

    public function setNombres($nombres): void
    {
        $this->nombres = $nombres;
    }

    public function setApellidos($apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    public function setTelefono($telefono): void
    {
        $this->telefono = $telefono;
    }

    public function setId_asignatura($id_asignatura): void
    {
        $this->id_asignatura = $id_asignatura;
    }

    public function setId_grado($id_grado): void
    {
        $this->id_grado = $id_grado;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setDireccion($direccion): void
    {
        $this->direccion = $direccion;
    }

    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }

    public function __toString()
    {
        return $this->nombres;
    }

    public function guardar()
    {
        $cadenaSQL = "INSERT INTO docente (identificacion, nombres, apellidos, telefono, id_asignatura, id_grado, email, direccion, estado ) values ('$this->identificacion','$this->nombres','$this->apellidos','$this->telefono','$this->id_asignatura','$this->id_grado','$this->email','$this->direccion','$this->estado'))";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function modificar($ID)
    {
        $cadenaSQL = "UPDATE docente SET identificacion='{$this->identificacion}', nombres='{$this->nombres}', apellidos='{$this->apellidos}', telefono='{$this->telefono}', id_asignatura='{$this->id_asignatura}', id_grado='{$this->id_grado}', email='{$this->email}', direccion='{$this->direccion}', estado='{$this->estado}' WHERE id='{$ID}'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "DELETE FROM docente WHERE id='{$this->id}'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = " WHERE $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = " ORDER BY $orden";
        $cadenaSQL = "SELECT id, identificacion, nombres, apellidos, telefono, id_asignatura, id_grado, email, direccion, estado FROM docente $filtro $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = Docente::getLista($filtro, $orden);
        $lista = array();
        foreach ($resultado as $key) {
            $docente = new Docente($key, null);
            array_push($lista, $docente);
        }
        return $lista;
    }
}
