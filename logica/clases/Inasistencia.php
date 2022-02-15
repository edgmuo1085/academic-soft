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
class Inasistencia {
    protected $id;
    protected $cantidad;
    protected $justificacion;
    protected $fecha;
    protected $identificacionEstudiante;
    protected $idAsignatura;
    
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)) {
                $cadenaSQL="select id, cantidad, justificacion, fecha, identificacionEstudiante, idAsignatura from inasistencia where $campo=$valor";
                //echo $cadenaSQL.'<P>';
                $campo= ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }   
            $this->id=$campo['id']; 
            $this->cantidad=$campo['cantidad']; 
            $this->justificacion=$campo['justificacion']; 
            $this->fecha=$campo['fecha'];
            $this->identificacionEstudiante=$campo['identificacionEstudiante'];
            $this->idAsignatura=$campo['idAsignatura'];
             
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getJustificacion() {
        return $this->justificacion;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getIdentificacionEstudiante() {
        return $this->identificacionEstudiante;
    }

    public function getIdAsignatura() {
        return $this->idAsignatura;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setCantidad($cantidad): void {
        $this->cantidad = $cantidad;
    }

    public function setJustificacion($justificacion): void {
        $this->justificacion = $justificacion;
    }

    public function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    public function setIdentificacionEstudiante($identificacionEstudiante): void {
        $this->identificacionEstudiante = $identificacionEstudiante;
    }

    public function setIdAsignatura($idAsignatura): void {
        $this->idAsignatura = $idAsignatura;
    }

        
    public function getTipoEnObjeto() {
        return new TipoUsuario($this->tipo); 
    }

    public function __toString() {
        return $this->nombres . ' ' . $this->apellidos;
    }
    public function guardar() {
        $cadenaSQL="insert into inasistencia (cantidad, justificacion, fecha, identificacionEstudiante, idAsignatura ) values ('$this->cantidad','$this->justificacion','$this->fecha','$this->identificacionEstudiante' '$this->idAsignatura'))";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public function modificar(){
        $cadenaSQL="update inasistencia set id='{$this->id}', cantidad='{$this->cantidad}', justificacion='{$this->justificacion}', fecha='{$this->fecha}', identificacionEstudiante='{$this->identificacionEstudiante}', idAsignatura='{$this->idAsignatura}')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public function eliminar() {
       $cadenaSQL="delete from inasistencia where id='$this->id'";
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


