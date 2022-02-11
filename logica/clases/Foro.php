<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Voto
 *
 * @author 
 */
class Foro{
    private $id;
    private $tema;
    private $identificacionDocente;
    private $identificacionEstudiante;
    private $idforo;
    
    public function __construct() {
        if ($campo!=null){
            if (!is_array($campo)){
                $cadenaSQL="select id, tema, identificacionDocente, identificacionEstudiante, idforo from Foro where $campo=$valor";
                $campo= ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id=$campo['id'];
            $this->tema=$campo['tema'];
            $this->identificionEstudiante=$campo['identificacionDocente'];
            $this->identificionEstudiante=$campo['identificacionEstudiante'];
            $this->idforo=$campo['idforo'];
                
           
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getTema() {
        return $this->tema;
    }

    public function getIdentificacionDocente() {
        return $this->identificacionDocente;
    }

    public function getIdentificacionEstudiante() {
        return $this->identificacionEstudiante;
    }

    public function getIdforo() {
        return $this->idforo;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setTema($tema): void {
        $this->tema = $tema;
    }

    public function setIdentificacionDocente($identificacionDocente): void {
        $this->identificacionDocente = $identificacionDocente;
    }

    public function setIdentificacionEstudiante($identificacionEstudiante): void {
        $this->identificacionEstudiante = $identificacionEstudiante;
    }

    public function setIdforo($idforo): void {
        $this->idforo = $idforo;
    }

    public function __toString() {
        
    }
   
    public function guardar() {
        $cadenaSQL="insert into Foro (tema, identificacionDocente, identificacionEstudiante, idforo) values "
                . "('$this->tema','$this->identificacionDocente','$this->identificacionEstudiante','$this->idforo')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update Foro set id='$this->id', tema='$this->tema', "
                . "identificacionDocente='$this->identificacionDocente',identificacionEstudiante='$this->identificacionEstudiante','idforo='$this->idforo')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar() {
        $cadenaSQL="delete from Foro where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden) {
        if($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden= "order by $orden";
        $cadenaSQL="select id, tema, identificacionDocente, identificacionEstudiante, idforo from Foro $filtro $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= Voto::getLista($filtro, $orden);
        for ($i = 0; $i < count($resultado); $i++) {
            $voto=new Voto($resultado[$i], null);
            $lista[$i]=$voto;
        }
        return $lista;
    }
}

