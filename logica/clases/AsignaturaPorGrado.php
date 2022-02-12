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
class AsignaturaPorGrado{
    private $idGrado;
    private $idAsignatura;
    private $intensidadHoraria;
    
    public function __construct() {
        if ($campo!=null){
            if (!is_array($campo)){
                $cadenaSQL="select idGrado, idAsignatura, intensidadHoraria from AsignaturaPorGrado where $campo=$valor";
                $campo= ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->idGrado=$campo['idGrado'];
            $this->idAsignatura=$campo['idAsignatura'];
            $this->intensidadHoraria=$campo['intensidadHoraria'];            
        }
    }
    
    public function getIdGrado() {
        return $this->idGrado;
    }

    public function getIdAsignatura() {
        return $this->idAsignatura;
    }

    public function getIntensidadHoraria() {
        return $this->intensidadHoraria;
    }

    public function setIdGrado($idGrado): void {
        $this->idGrado = $idGrado;
    }

    public function setIdAsignatura($idAsignatura): void {
        $this->idAsignatura = $idAsignatura;
    }

    public function setIntensidadHoraria($intensidadHoraria): void {
        $this->intensidadHoraria = $intensidadHoraria;
    }

        
    public function __toString() {
        
    }
   
    public function guardar() {
        $cadenaSQL="insert into Grado (nombreGrado, idInstitucion) values "
                . "('$this->nombreGrado','$this->idInstitucion')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update AsignaturaPorGrado set idGrado='$this->idGrado', idAsignatura='$this->idAsignatura', "
                . "intensidadHoraria='$this->intensidadHoraria')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar() {
        $cadenaSQL="delete from AsignaturaPorGrado where idGrado='$this->idGrado'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden) {
        if($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden= "order by $orden";
        $cadenaSQL="select idGrado, idAsignatura, intensidadHoraria from AsignaturaPorGrado $filtro $orden";
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

