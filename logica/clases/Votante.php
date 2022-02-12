<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Votante
 *
 * @author LEIDY CORDOBA
 */
class Votante extends Persona{
    private $id;
    private $idEvento;
    
    public function __construct($campo, $valor) {
        if ($campo!=null){
            if (!is_array($campo)){
                $cadenaSQL="select persona.identificacion, nombres, apellidos, tipo, clave, id, idEvento"
                        . " from persona inner join votante on persona.identificacion=votante.identificacion where $campo=$valor";
                echo $cadenaSQL.'<p>';
                $campo= ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            parent::__construct($campo, null);
            $this->id=$campo['id'];
            $this->idEvento=$campo['idEvento'];           
        }
    }
    
    public function getId() {
        return $this->id;
    }
    public function getIdEvento() {
        return $this->idEvento;
    }
    public function getEvento() {
        return new Evento('id', $this->idEvento);
    }
    public function setId($id): void {
        $this->id = $id;
    }
    public function setIdEvento($idEvento): void {
        $this->idEvento = $idEvento;
    }
    public function guardar() {
        parent::guardar();
        $cadenaSQL="insert into votante (identificacion, idEvento) values "
                . "('{$this->identificacion}',{$this->idEvento})";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public function modificar($identificacionAnterior) {
        parent::modificar($identificacionAnterior);
        $cadenaSQL="update votante set identificacion='{$this->identificacion}', "
        . "idEvento={$this->idEvento} where id={$this->id}";
    echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar() {
        $cadenaSQL="delete from votante where id={$this->id}";
        ConectorBD::ejecutarQuery($cadenaSQL);
        parent::eliminar();
    }
    public static function getLista($filtro, $orden) {
        if($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden= "order by $orden";
        
        $cadenaSQL="select persona.identificacion, nombres, apellidos, tipo, clave, id,  idEvento"
                . " from persona inner join votante on persona.identificacion=votante.identificacion $filtro $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= Votante::getLista($filtro, $orden);
        $lista=Array();  
        for ($i = 0; $i < count($resultado); $i++) {
            $votante=new Votante($resultado[$i], null);
            $lista[$i]=$votante;
        }
        return $lista;
    }

}

