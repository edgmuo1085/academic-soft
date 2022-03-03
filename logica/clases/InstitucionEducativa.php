<?php

class InstitucionEducativa
{
    protected $id;
    protected $nombre;
    protected $direccion;
    protected $telefono;
    protected $email;
    protected $nombreDirectora;
    protected $paginaWeb;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "SELECT id, nombre, direccion, telefono, email, nombre_directora, pagina_web FROM institucion_educativa WHERE $campo=$valor";
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->nombre = $campo['nombre'];
            $this->direccion = $campo['direccion'];
            $this->telefono = $campo['telefono'];
            $this->email = $campo['email'];
            $this->nombreDirectora = $campo['nombre_directora'];
            $this->paginaWeb = $campo['pagina_web'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getNombreDirectora()
    {
        return $this->nombreDirectora;
    }

    public function getPaginaWeb()
    {
        return $this->paginaWeb;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setDireccion($direccion): void
    {
        $this->direccion = $direccion;
    }

    public function setTelefono($telefono): void
    {
        $this->telefono = $telefono;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setNombreDirectora($nombreDirectora): void
    {
        $this->nombreDirectora = $nombreDirectora;
    }

    public function setPaginaWeb($paginaWeb): void
    {
        $this->paginaWeb = $paginaWeb;
    }

    public function __toString()
    {
        return $this->nombres;
    }

    public function guardar()
    {
        $cadenaSQL = "INSERT INTO institucion_educativa (nombre, direccion, telefono, email, nombre_directora, pagina_web) VALUES ('$this->nombre','$this->direccion','$this->telefono','$this->email', '$this->nombreDirectora', '$this->paginaWeb'))";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function modificar($ID)
    {
        $cadenaSQL = "UPDATE institucion_educativa SET nombre='{$this->nombre}', direccion='{$this->direccion}', telefono='{$this->telefono}', email='{$this->email}', nombre_directora='{$this->nombreDirectora}', pagina_web='{$this->paginaWeb}' WHERE id='{$ID}'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = " WHERE $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = " ORDER BY $orden";
        $cadenaSQL = "SELECT id, nombre, direccion, telefono, email, nombre_directora, pagina_web FROM institucion_educativa $filtro $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = InstitucionEducativa::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $institucion = new InstitucionEducativa($resultado[$i], null);
            $lista[$i] = $institucion;
        }
        return $lista;
    }
}
