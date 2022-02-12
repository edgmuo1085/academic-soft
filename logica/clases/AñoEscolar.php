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
class AñoEscolar {
    private $id;
    private $inicio;
    private $fin;
    private $idInstitucion;
    
    public function __construct() {
        if ($campo!=null){
            if (!is_array($campo)){
                $cadenaSQL="select id, inicio, fin, idInstitucion from AñoEscolar where $campo=$valor";
                $campo= ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id=$campo['id'];
            $this->inicio=$campo['inicio'];
            $this->fin=$campo['fin'];
            $this->idInstitucion=$campo['idInstitucion'];            
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getInicio() {
        return $this->inicio;
    }

    public function getFin() {
        return $this->fin;
    }

    public function getIdInstitucion() {
        return $this->idInstitucion;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setInicio($inicio): void {
        $this->inicio = $inicio;
    }

    public function setFin($fin): void {
        $this->fin = $fin;
    }

    public function setIdInstitucion($idInstitucion): void {
        $this->idInstitucion = $idInstitucion;
    }

        public function __toString() {
        
    }
   
    public function guardar() {
        $cadenaSQL="insert into AñoEscolar (inicio, fin, idInstitucion) values "
                . "('$this->inicio','$this->fin','$this->idInstitucion')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update AñoEscolar set id='$this->id', inicio='$this->inicio', "
                . "fin='$this->fin', idInstitucion='$this->idInstitucion')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar() {
        $cadenaSQL="delete from AñoEscolar where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden) {
        if($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden= "order by $orden";
        $cadenaSQL="select id, inicio, fin, idInstitucion from AñoEscolar $filtro $orden";
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

