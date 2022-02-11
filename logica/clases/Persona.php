<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Persona
 *
 * @author LEIDY CORDOBA
 */
class Persona
{
    protected $identificacion;
    protected $nombres;
    protected $apellidos;
    protected $telefono;
    protected $email;
    protected $direccion;
    protected $clave;
    protected $tipo;
    protected $estado;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select identificacion, nombres, apellidos, tlefono, email, direccion, clave, tipo, estado clave from persona where $campo=$valor";
                //echo $cadenaSQL.'<P>';
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->identificacion = $campo['identificacion'];
            $this->nombres = $campo['nombres'];
            $this->apellidos = $campo['apellidos'];
            $this->apellidos = $campo['telefono'];
            $this->apellidos = $campo['email'];
            $this->apellidos = $campo['direccion'];
            $this->clave = $campo['clave'];
            $this->tipo = $campo['tipo'];
            $this->clave = $campo['estado'];
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

    public function getNombres()
    {
        return $this->nombres;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getClave()
    {
        return $this->clave;
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

    public function setTipo($tipo): void
    {
        $this->tipo = $tipo;
    }
    public function getTipoEnObjeto()
    {
        return new TipoPersona($this->tipo);
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
        $cadenaSQL = "insert into usuario (identificacion, nombres, apellidos, telefono, email, direccion, clave, tipo, estado ) values ('$this->identificacion','$this->nombres','$this->apellidos','$this->telefono','$this->email','$this->direccion',md5('$this->clave','$this->tipo','$this->estado'))";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public function modificar($identificacionAnterior)
    {
        if (strlen($this->clave) < 32) $clave = md5($this->clave); //$clave="md5($clave)";
        $cadenaSQL = "update persona set identificacion='{$this->identificacion}', nombres='{$this->nombres}', apellidos='{$this->apellidos}', telefono='{$this->telefono}', email='{$this->email}', direccion='{$this->direccion}', clave='{$this->clave}', tipo='{$this->tipo}', estado='{$this->estado}' where identificacion='{$identificacionAnterior}'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public function eliminar()
    {
        $cadenaSQL = "delete from persona where identificacion='{$this->identificacion}'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = " where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = " order by $orden";
        $cadenaSQL = "select identificacion, nombres, apellidos, telefono, email, direccion, clave, tipo, estado from persona $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = Persona::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $persona = new Persona($resultado[$i], null);
            $lista[$i] = $persona;
        }
        return $lista;
    }
    public static function validar($usuario, $clave)
    {
        $resultado = Persona::getListaEnObjetos("identificacion='$usuario' and contrasenia=md5('$clave')", null);
        $usuario = null;
        if (count($resultado) > 0)  $usuario = $resultado[0];
        return $usuario;
    }
}
