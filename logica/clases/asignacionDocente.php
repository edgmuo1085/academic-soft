<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author 
 */
class asignacionDocente {
    protected $id;
    protected $identificacionDocente;
    protected $idAñoEscolar;
    protected $idAsignatura;
    protected $idGrado;
    protected $linkClasesVirtuales;
    
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)) {
                $cadenaSQL="select id, identificacionDocente, idAñoEscolar, idAsignatura, idGrado, linkClasesVirtuales from asignaciondocente where $campo=$valor";
                //echo $cadenaSQL.'<P>';
                $campo= ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }   
            $this->id=$campo['id']; 
            $this->identificacionDocente=$campo['identificacionDocente'];
            $this->idAñoEscolar=$campo['idAñoEscolar']; 
            $this->idAsignatura=$campo['idAsignatura']; 
            $this->idGrado=$campo['idGrado'];
            $this->linkClasesVirtuales=$campo['linkClasesVirtuales'];
             
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getIdentificacionDocente() {
        return $this->identificacionDocente;
    }

    public function getIdAñoEscolar() {
        return $this->idAñoEscolar;
    }

    public function getIdAsignatura() {
        return $this->idAsignatura;
    }

    public function getIdGrado() {
        return $this->idGrado;
    }

    public function getLinkClasesVirtuales() {
        return $this->linkClasesVirtuales;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdentificacionDocente($identificacionDocente): void {
        $this->identificacionDocente = $identificacionDocente;
    }

    public function setIdAñoEscolar($idAñoEscolar): void {
        $this->idAñoEscolar = $idAñoEscolar;
    }

    public function setIdAsignatura($idAsignatura): void {
        $this->idAsignatura = $idAsignatura;
    }

    public function setIdGrado($idGrado): void {
        $this->idGrado = $idGrado;
    }

    public function setLinkClasesVirtuales($linkClasesVirtuales): void {
        $this->linkClasesVirtuales = $linkClasesVirtuales;
    }
        
    public function getTipoEnObjeto() {
        return new TipoUsuario($this->tipo); 
    }

    public function __toString() {
        return $this->nombres . ' ' . $this->apellidos;
    }
    public function guardar() {
        $cadenaSQL="insert into inasistencia (cantidad, justificacion, fecha, identificacionEstudiante, idAsignatura ) values ('$this->cantidad','$this->justificacion','$this->fecha','$this->identificacionEstudiante','$this->idAsignatura'))";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public function modificar(){
        $cadenaSQL="update inasistencia set id='{$this->id}', cantidad='{$this->cantidad}', justificacion='{$this->justificacion}', fecha='{$this->fecha}', identificacionEstudiante='{$this->identificacionEstudiante}', idAsignatura='{$this->idAsignatura}')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public function eliminar() {
       $cadenaSQL="delete from inasistencia where iid='$this->id'";
       ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public static function getLista($filtro,$orden) {
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select id, cantidad, justificacion, fecha, identificacionEstudiante, idAsignatura from inasistencia $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= Usuario::getLista($filtro, $orden);
        $lista= array();
        for ($i = 0; $i < count($resultado); $i++) {
           $persona=new Usuario($resultado[$i],null);
           $lista[$i]=$persona;
        }
        return $lista;
    }
 }


