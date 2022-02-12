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
class PeriodoAcademico {
    private $id;
    private $inicioPeriodo;
    private $finalizacionPeriodo;
    private $idAñoEscolar;
    
    public function __construct() {
        if ($campo!=null){
            if (!is_array($campo)){
                $cadenaSQL="select id, inicioPeriodo, finalizacionPeriodo, idAñoEscolar from PeriodoAcademico where $campo=$valor";
                $campo= ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id=$campo['id'];
            $this->inicioPeriodo=$campo['inicioPeriodo'];
            $this->finalizacionPeriodo=$campo['finalizacionPeriodo'];
            $this->idAñoEscolar=$campo['idAñoEscolar'];            
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getInicioPeriodo() {
        return $this->inicioPeriodo;
    }

    public function getFinalizacionPeriodo() {
        return $this->finalizacionPeriodo;
    }

    public function getIdAñoEscolar() {
        return $this->idAñoEscolar;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setInicioPeriodo($inicioPeriodo): void {
        $this->inicioPeriodo = $inicioPeriodo;
    }

    public function setFinalizacionPeriodo($finalizacionPeriodo): void {
        $this->finalizacionPeriodo = $finalizacionPeriodo;
    }

    public function setIdAñoEscolar($idAñoEscolar): void {
        $this->idAñoEscolar = $idAñoEscolar;
    }

    
    public function __toString() {
        
    }
   
    
    public function guardar() {
        $cadenaSQL="insert into PeriodoAcademico (inicioPeriodo, finalizacionPeriodo, idAñoEscolar) values "
                . "('$this->inicioPeriodo','$this->finalizacionPeriodo','$this->idAñoEscolar')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update PeriodoAcademico set id='$this->id', inicioPeriodo='$this->inicioPeriodo', "
                . "finalizacionPeriodo='$this->finalizacionPeriodo', idAñoEscolar='$this->idAñoEscolar')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar() {
        $cadenaSQL="delete from PeriodoAcademico where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden) {
        if($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden= "order by $orden";
        $cadenaSQL="select id, inicioPeriodo, finalizacionPeriodo, idAñoEscolar from PeriodoAcademico $filtro $orden";
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

