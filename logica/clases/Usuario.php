<?php

class Usuario
{
    protected $id;
    protected $identificacion;
    protected $nombres;
    protected $apellidos;
    protected $telefono;
    protected $email;
    protected $direccion;
    protected $clave;
    protected $rol_id;
    protected $estado;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, identificacion, nombres, apellidos, telefono, email, direccion, clave, rol_id, estado from usuario where $campo=$valor";
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->identificacion = $campo['identificacion'];
            $this->nombres = $campo['nombres'];
            $this->apellidos = $campo['apellidos'];
            $this->telefono = $campo['telefono'];
            $this->email = $campo['email'];
            $this->direccion = $campo['direccion'];
            $this->clave = $campo['clave'];
            $this->rol_id = $campo['rol_id'];
            $this->estado = $campo['estado'];
        }
    }

    public function getTelefono()
    {
        return $this->telefono;
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

    public function setTelefono($telefono): void
    {
        $this->telefono = $telefono;
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

    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombres()
    {
        return $this->nombres;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getRolId()
    {
        return $this->rol_id;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function setIdentificacion($identificacion): void
    {
        $this->identificacion = $identificacion;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setNombres($nombres): void
    {
        $this->nombres = $nombres;
    }

    public function setApellidos($apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    public function setRolId($rol_id): void
    {
        $this->rol_id = $rol_id;
    }

    public function getRolNombre()
    {
        return new Rol('id', $this->rol_id);
    }

    public function setClave($clave): void
    {
        $this->clave = $clave;
    }

    public function __toString()
    {
        return $this->nombres . ' ' . $this->apellidos;
    }

    public function guardar()
    {
        $clave = md5($this->identificacion);
        $cadenaSQL = "INSERT INTO usuario (identificacion, nombres, apellidos, telefono, email, direccion, clave, rol_id, estado ) values ('$this->identificacion', '$this->nombres', '$this->apellidos', '$this->telefono', '$this->email', '$this->direccion', '$clave', '$this->rol_id', '$this->estado')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function modificar($ID)
    {
        $clave = md5($this->clave);
        $cadenaSQL = $this->clave ? "UPDATE usuario SET identificacion='{$this->identificacion}', nombres='{$this->nombres}', apellidos='{$this->apellidos}', telefono='{$this->telefono}', email='{$this->email}', direccion='{$this->direccion}', clave='{$clave}', rol_id='{$this->rol_id}', estado='{$this->estado}' WHERE id='{$ID}'" :
            "UPDATE usuario SET identificacion='{$this->identificacion}', nombres='{$this->nombres}', apellidos='{$this->apellidos}', telefono='{$this->telefono}', email='{$this->email}', direccion='{$this->direccion}', rol_id='{$this->rol_id}', estado='{$this->estado}' WHERE id='{$ID}'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "DELETE FROM usuario WHERE id='{$this->id}'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = " WHERE $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = " ORDER BY $orden";
        $cadenaSQL = "SELECT id, identificacion, nombres, apellidos, telefono, email, direccion, clave, rol_id, estado FROM usuario $filtro $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = Usuario::getLista($filtro, $orden);
        $lista = array();
        foreach ($resultado as $key) {
            $usuario = new Usuario($key, null);
            array_push($lista, $usuario);
        }
        return $lista;
    }

    public static function validar($usuario, $clave)
    {
        $resultado = Usuario::getListaEnObjetos("identificacion='$usuario' and clave=md5('$clave')", null);
        $usuario = null;
        if (count($resultado) > 0) $usuario = $resultado[0];
        return $usuario;
    }
}
