<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConectorBD
 *
 * @author LEIDY CORDOBA
 */
class ConectorBD {
    //put your code here
    private $servidor;
    private $puerto;
    private $baseDatos;
    private $controlador;
    private $usuario;
    private $clave;
    
    private $conexion;
    
    public function __construct(){
       $ruta = dirname(__FILE__) . '/../../configuracion.ini';//C:\xampp\htdocs\votacionesWeb\logica\clasesGenericas/../../configuracion.ini
       if (!file_exists($ruta)){
           echo 'Error: No existe el archivo de configuracion de conexion a la base de datos. Nombre del archivo: ' . $ruta;
           //return false;
           //die();//se detiene el procesamiento del codigo de este archivo
       }else{//si hay certeza de que el archivo existe
           $parametros= parse_ini_file($ruta);//lee el archivo de configuracion y los datos los introduce como parametros como una matriz de tipo asociativo
           if (!$parametros){ 
               echo 'Error: no se pudo procesar el archivo de configuracion. Nombre del archivo: ' . $ruta;
               //return false;
           }else{//si se pudo procesar el archivo
               //print_r($parametros);
               $this->servidor=$parametros['servidor'];//this.servidor/this->servidor
               $this->puerto=$parametros['puerto'];
               $this->baseDatos=$parametros['baseDatos'];
               $this->controlador=$parametros['controlador'];
               $this->usuario=$parametros['usuario'];
               $this->clave=$parametros['clave'];
               //return true;
           }
       }
    }
    public function conectar(){
            try {
                $this->conexion=new PDO("$this->controlador:host=$this->servidor;port=$this->puerto;dbname=$this->baseDatos", $this->usuario, $this->clave);
                //echo 'conectado a la base de datos';
                return true;
            } catch (Exception $exc) {
            //echo $exc->getTraceAsString();
            echo 'No se pudo conectar a la base de datos. ' . $exc->getMessage();
            return false;
            }
    }
    public function desconectar(){
        $this->conexion=null;
    }
    public static function ejecutarQuery($cadenaSQL){
        $conectorBD=new ConectorBD();
        if ($conectorBD->conectar()){
            $sentencia=$conectorBD->conexion->prepare($cadenaSQL);
                if (!$sentencia->execute()) $consulta=false;
                else{
                $consulta=$sentencia->fetchAll();//si se hace un select...devuelve los datos como una matriz asociaiva
                $sentencia->closeCursor();
                }
        }else  echo 'No se pudo conectar con la base de datos.';
        $conectorBD->desconectar();
        return $consulta;
    }
}
