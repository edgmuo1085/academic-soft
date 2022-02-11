<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Persona
 *
 * @author 
 */
class InstitucionEducativa {
    protected $id;
    protected $nombre;
    protected $direccion;
    protected $telefono;
    protected $email;
    protected $nombreDirectora;
    protected $paginaWeb;
    
    
    public function __construct($campo, $valor) {
        if ($campo != null){
            if (!is_array($campo)) {
                $cadenaSQL="select id, nombre, direccion, telefono, email, nombreDirectora, paginaWeb from InstitucionEducativa where $campo=$valor";
                //echo $cadenaSQL.'<P>';
                $campo= ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }   
            $this->id=$campo['id']; 
            $this->nombre=$campo['nombre']; 
            $this->direccion=$campo['direccion']; 
            $this->telefono=$campo['telefono'];
            $this->email=$campo['email'];
            $this->nombreDirectora=$campo['nombreDirectora'];
            $this->paginaWeb=$campo['paginaWeb'];
             
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getNombreDirectora() {
        return $this->nombreDirectora;
    }

    public function getPaginaWeb() {
        return $this->paginaWeb;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setDireccion($direccion): void {
        $this->direccion = $direccion;
    }

    public function setTelefono($telefono): void {
        $this->telefono = $telefono;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setNombreDirectora($nombreDirectora): void {
        $this->nombreDirectora = $nombreDirectora;
    }

    public function setPaginaWeb($paginaWeb): void {
        $this->paginaWeb = $paginaWeb;
    }
        
    public function getTipoEnObjeto() {
        return new TipoPersona($this->tipo); 
    }

    public function __toString() {
        return $this->nombres . ' ' . $this->apellidos;
    }
    public function guardar() {
        $cadenaSQL="insert into InstitucionEducativa (nombre, direccion, telefono, email, nombreDirectora, paginaWeb) values ('$this->nombre','$this->direccion','$this->telefono','$this->email', '$this->nombreDirectora', '$this->paginaWeb'))";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public function modificar(){
        $cadenaSQL="update InstitucionEducativa set id='{$this->id}', nombre='{$this->nombre}', direccion='{$this->direccion}', telefono='{$this->telefono}', email='{$this->email}', nombreDirectora='{$this->nombreDirectora}', paginaWeb='{$this->paginaWeb}')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public function eliminar() {
       $cadenaSQL="delete from InstitucionEducativa where id='$this->id'";
       ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public static function getLista($filtro,$orden) {
        if ($filtro==null || $filtro=='') $filtro='';
        else $filtro=" where $filtro";
        if ($orden==null || $orden=='') $orden='';
        else $orden=" order by $orden";
        $cadenaSQL="select id, nombre, direccion, telefono, email, nombreDirectora, paginaWeb from inasistencia $filtro $orden";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public static function getListaEnObjetos($filtro, $orden) {
        $resultado= Persona::getLista($filtro, $orden);
        $lista= array();
        for ($i = 0; $i < count($resultado); $i++) {
           $persona=new Persona($resultado[$i],null);
           $lista[$i]=$persona;
        }
        return $lista;
    }
 }


