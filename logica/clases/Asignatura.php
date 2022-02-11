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
class Asignatura{
    private $id;
    private $nombreAsignatura;
    
    public function __construct() {
        if ($campo!=null){
            if (!is_array($campo)){
                $cadenaSQL="select id, nombreAsignatura from Asignatura where $campo=$valor";
                $campo= ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id=$campo['id'];
            $this->nombreAsignatura=$campo['nombreAsignatura'];           
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNombreAsignatura() {
        return $this->nombreAsignatura;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombreAsignatura($nombreAsignatura): void {
        $this->nombreAsignatura = $nombreAsignatura;
    }

        
    public function __toString() {
        
    }
   
    public function guardar() {
        $cadenaSQL="insert into Asignatura (nombreAsignatura) values "
                . "('$this->nombreAsignatura')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update Asignatura set id='$this->id', nombreAsignatura='$this->nombreAsignatura')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar() {
        $cadenaSQL="delete from Asignatura where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden) {
        if($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden= "order by $orden";
        $cadenaSQL="select id, nombreAsignatura from Asignatura $filtro $orden";
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

