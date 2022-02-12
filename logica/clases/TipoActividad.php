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
class TipoActividad{
    private $id;
    private $nombre;
    
    public function __construct() {
        if ($campo!=null){
            if (!is_array($campo)){
                $cadenaSQL="select id, nombre from TipoActividad where $campo=$valor";
                $campo= ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id=$campo['id'];
            $this->nombre=$campo['nombre'];           
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

        
    public function __toString() {
        
    }
   
    public function guardar() {
        $cadenaSQL="insert into TipoActividad (nombre) values "
                . "('$this->nombre')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update TipoActividad set id='$this->id', nombre='$this->nombre')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar() {
        $cadenaSQL="delete from TipoActividad where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden) {
        if($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden= "order by $orden";
        $cadenaSQL="select id, nombre from TipoActividad $filtro $orden";
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

