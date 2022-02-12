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
class GrupoEstudiante{
    private $id;
    private $idGrupo;
    private $identificacionEstudiante;
    private $idAñoEscolar;
    
    public function __construct() {
        if ($campo!=null){
            if (!is_array($campo)){
                $cadenaSQL="select id, idGrupo, identificacionEstudiante, idAñoEscolar from GrupoEstudiante where $campo=$valor";
                $campo= ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id=$campo['id'];
            $this->idGrupo=$campo['idGrupo'];
            $this->identificionEstudiante=$campo['identificacionEstudiante'];    
            $this->idAñoEscolar=$campo['idAñoEscolar'];
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getIdGrupo() {
        return $this->idGrupo;
    }

    public function getIdentificacionEstudiante() {
        return $this->identificacionEstudiante;
    }

    public function getIdAñoEscolar() {
        return $this->idAñoEscolar;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdGrupo($idGrupo): void {
        $this->idGrupo = $idGrupo;
    }

    public function setIdentificacionEstudiante($identificacionEstudiante): void {
        $this->identificacionEstudiante = $identificacionEstudiante;
    }

    public function setIdAñoEscolar($idAñoEscolar): void {
        $this->idAñoEscolar = $idAñoEscolar;
    }

    public function __toString() {
        
    }
   
    public function guardar() {
        $cadenaSQL="insert into GrupoEstudiante (idGrupo, identificacionEstudiante, idAñoEscolar) values "
                . "('$this->idGrupo','$this->identificacionEstudiante','$this->idAñoEscolar')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function modificar() {
        $cadenaSQL="update GrupoEstudiante set id='$this->id', idGrupo='$this->idGrupo', "
                . "identificacionEstudiante='$this->identificacionEstudiante','idAñoEscolar='$this->idAñoEscolar')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public function eliminar() {
        $cadenaSQL="delete from GrupoEstudiante where id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    
    public static function getLista($filtro, $orden) {
        if($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden= "order by $orden";
        $cadenaSQL="select id, idGrupo, identificacionEstudiante, idAñoEscolar from GrupoEstudiante $filtro $orden";
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

