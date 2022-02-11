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
class Grupo{
    private $id;
    private $nombreGrupo;
    private $idInstitucion;
    
    public function __construct() {
        if ($campo!=null){
            if (!is_array($campo)){
                $cadenaSQL="select id, nombreGrupo, idInstitucion from Grupo where $campo=$valor";
                $campo= ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id=$campo['id'];
            $this->nombreGrupo=$campo['nombreGrupo'];
            $this->idInstitucion=$campo['idInstitucion'];            
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNombreGrupo() {
        return $this->nombreGrupo;
    }

    public function getIdInstitucion() {
        return $this->idInstitucion;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombreGrupo($nombreGrupo): void {
        $this->nombreGrupo = $nombreGrupo;
    }

    public function setIdInstitucion($idInstitucion): void {
        $this->idInstitucion = $idInstitucion;
    }

    public function __toString() {
        
    }
   
    public function guardar() {
        $cadenaSQL="insert into Grupo (nombreGrupo, idInstitucion) values "
                . "('$this->nombreGrupo','$this->idInstitucion')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update Grupo set id='$this->id', nombreGrupo='$this->nombreGrupo', "
                . "idInstitucion='$this->idInstitucion')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar() {
        $cadenaSQL="delete from Grupo where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden) {
        if($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden= "order by $orden";
        $cadenaSQL="select id, nombreGrupo, idInstitucion from Grupo $filtro $orden";
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

