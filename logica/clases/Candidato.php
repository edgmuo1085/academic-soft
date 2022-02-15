<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Candidato
 *
 * @author LEIDY CORDOBA
 */
class Candidato extends Usuario
{
    private $id;
    private $foto;
    private $propuesta;
    private $idEvento;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select persona.identificacion, nombres, apellidos, tipo, clave, id, foto, propuesta, idEvento"
                    . " from usuario inner join candidato on persona.identificacion=candidato.identificacion where $campo=$valor";
                //echo $cadenaSQL.'<P>';
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            parent::__construct($campo, null);
            $this->id = $campo['id'];
            $this->foto = $campo['foto'];
            $this->propuesta = $campo['propuesta'];
            $this->idEvento = $campo['idEvento'];
        }
    }
    public function getId()
    {
        return $this->id;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function getPropuesta()
    {
        return $this->propuesta;
    }

    public function getIdEvento()
    {
        return $this->idEvento;
    }
    public function getEvento()
    {
        return new Evento('id', $this->idEvento);
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setFoto($foto): void
    {
        $this->foto = $foto;
    }

    public function setPropuesta($propuesta): void
    {
        $this->propuesta = $propuesta;
    }

    public function setIdEvento($idEvento): void
    {
        $this->idEvento = $idEvento;
    }
    public function __toString()
    {
        return $this->nombres . ' ' . $this->apellidos;
    }

    public function guardar()
    {
        parent::guardar();
        $cadenaSQL = "insert into candidato (identificacion, foto, propuesta, idEvento) values ('{$this->identificacion}','{$this->foto}','{$this->propuesta}',{$this->idEvento})";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function modificar($identificacionAnterior)
    {
        parent::modificar($identificacionAnterior);
        $cadenaSQL = "update candidato set identificacion='{$this->identificacion}', foto='{$this->foto}', propuesta='{$this->propuesta}', idEvento={$this->idEvento} where id={$this->id}";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "delete from candidato where id={$this->id}";
        ConectorBD::ejecutarQuery($cadenaSQL);
        parent::eliminar();
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = " where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";

        $cadenaSQL = "select persona.identificacion, nombres, apellidos, tipo, clave, id, foto, propuesta, idEvento"
            . " from persona inner join candidato on persona.identificacion=candidato.identificacion $filtro $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = Candidato::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $candidato = new Candidato($resultado[$i], null);
            $lista[$i] = $candidato;
        }
        return $lista;
    }
}
