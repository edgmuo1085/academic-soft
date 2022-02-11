<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Evento
 *
 * @author LR
 */
class Evento
{
    private $id;
    private $idTipoDeActividad;
    private $digitarNota;
    private $fecha;
    private $nombreActividad;
    private $identificacionEstudiante;
    private $idPeriodoacademico;
    private $idAsignatura;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, idTipoDeActividad, digitarNota, fecha,  nombreActividad, identificacionEstudiante, idPeriodoacademico, idAsignatura from evento where $campo=$valor";
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->id = $campo['idTipoDeActividad'];
            $this->nombre = $campo['digitarNota'];
            $this->inicio = $campo['fecha'];
            $this->fin = $campo['nombreActividad'];
            $this->fin = $campo['identificacionEstudiante'];
            $this->fin = $campo['idPeriodoacademico'];
            $this->fin = $campo['idAsignatura'];
        }
    }

    public function getIdTipoDeActividad()
    {
        return $this->idTipoDeActividad;
    }

    public function getDigitarNota()
    {
        return $this->digitarNota;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getNombreActividad()
    {
        return $this->nombreActividad;
    }

    public function getIdentificacionEstudiante()
    {
        return $this->identificacionEstudiante;
    }

    public function getIdPeriodoacademico()
    {
        return $this->idPeriodoacademico;
    }

    public function getIdAsignatura()
    {
        return $this->idAsignatura;
    }

    public function setIdTipoDeActividad($idTipoDeActividad): void
    {
        $this->idTipoDeActividad = $idTipoDeActividad;
    }

    public function setDigitarNota($digitarNota): void
    {
        $this->digitarNota = $digitarNota;
    }

    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    public function setNombreActividad($nombreActividad): void
    {
        $this->nombreActividad = $nombreActividad;
    }

    public function setIdentificacionEstudiante($identificacionEstudiante): void
    {
        $this->identificacionEstudiante = $identificacionEstudiante;
    }

    public function setIdPeriodoacademico($idPeriodoacademico): void
    {
        $this->idPeriodoacademico = $idPeriodoacademico;
    }

    public function setIdAsignatura($idAsignatura): void
    {
        $this->idAsignatura = $idAsignatura;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getEstado()
    {
        $fechaActual = date('Y-m-d H:i:s'); //hoy es 23 y la fecha programada es 29 si es posiitivo por ejecutar
        //echo $fechaActual;        echo date_default_timezone_get();
        $diferenciaFechas = Fecha::calcularDiferenciaFechasEnSegundos($fechaActual, $this->inicio);
        if ($diferenciaFechas > 0) return 'Por ejecutar';
        else {
            $diferenciaFechas = Fecha::calcularDiferenciaFechasEnSegundos($fechaActual, $this->fin);
            if ($diferenciaFechas < 0) return 'Terminado';
            else return 'En ejecucion';
        }
    }
    public function __toString()
    {
        return $this->nombre;
    }
    public function guardar()
    {
        $cadenaSQL = "insert into evento (idTipoDeActividad, digitarNota, fecha, nombreActividad, identificacionEstudiante, idPeriodoacademico, idAsignatura) values ('{$this->idTipoDeActividad}','{$this->digitarNota}','{$this->fecha}','{$this->nombreActividad}','{$this->identificacionEstudiante}','{$this->idPeriodoacademico}','{$this->idAsignatura}')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function modificar()
    {
        $cadenaSQL = "update evento set idTipoDeActividad='{$this->idTipoDeActividad}', digitarNota='{$this->digitarNota}', fecha='{$this->fecha}', nombreActividad='{$this->nombreActividad}', identificacionEstudiante='{$this->identificacionEstudiante}', idPeriodoacademico='{$this->idPeriodoacademico}', idAsignatura='{$this->idAsignatura}' where id={$this->id}";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "delete from evento where id={$this->id}";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public function registrarVoto($idCandidato, $idVotante)
    {
        $cadenaSQL = "insert into voto(idVotante, idCandidato) values ($idVotante, $idCandidato)";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public function  consultarVoto($identificacionVotante)
    {
        $cadenaSQL = "select idCandidato from voto inner join votante on voto.idVotante=votante.id where identificacion='$identificacionVotante'";
        $resultado = ConectorBD::ejecutarQuery($cadenaSQL);
        if ($resultado == null) return 0;
        else return $resultado[0]['idCandidato'];
    }
    public static function consultarCodigoBarras($codigoB)
    {
        $cadenaSQL = "select idVotante from voto where id={$codigoB}";
        $resultado = ConectorBD::ejecutarQuery($cadenaSQL);
        if ($resultado == null) return 0;
        else return $resultado[0]['idVotante'];
    }
    public function  getIdVoto($identificacionVotante)
    {
        $cadenaSQL = "select voto.id from voto inner join votante on voto.idVotante=votante.id where identificacion='$identificacionVotante'";
        $resultado = ConectorBD::ejecutarQuery($cadenaSQL);
        if ($resultado == null) return 0;
        else return $resultado[0]['id'];
    }
    public function getResultados()
    {
        $cadenaSQL = "select foto, persona.identificacion, concat(nombres,' ',apellidos) as candidato, count(voto.idCandidato) as votos "
            . "from persona "
            . "inner join candidato on candidato.identificacion=persona.identificacion "
            . "inner join evento on candidato.idEvento=evento.id "
            . "left join voto on candidato.id=voto.idCandidato "
            . "where evento.id={$this->id} "
            . "group by foto, persona.identificacion, concat(nombres,' ',apellidos) "
            . "order by votos desc";
        //echo $cadenaSQL;
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }
    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = " where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select id, nombre, inicio, fin from evento $filtro $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = Evento::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $evento = new Evento($resultado[$i], null);
            $lista[$i] = $evento;
        }
        return $lista;
    }
}
