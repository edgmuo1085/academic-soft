<?php

class GrupoEstudiante
{
    protected $id;
    protected $id_usuario_estudiante;
    protected $id_grupo;
    protected $id_anio_escolar;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "SELECT id, id_usuario_estudiante, id_grupo, id_anio_escolar FROM grupo_estudiante WHERE $campo=$valor";
                $campo = ConectorBD::ejecutarQuery($cadenaSQL)[0];
            }

            $this->id = $campo['id'];
            $this->id_usuario_estudiante = $campo['id_usuario_estudiante'];
            $this->id_grupo = $campo['id_grupo'];
            $this->id_anio_escolar = $campo['id_anio_escolar'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdUsuarioEstudiante() 
    {
        return $this->id_usuario_estudiante;
    }
   
    public function getIdGrupo() 
    {
        return $this->id_grupo;
    }
    
    public function getIdAnioEscolar() 
    {
        return $this->id_anio_escolar;
    }

    public function getNombreUsuarioEstudiante()
    {
        return new Usuario('id', $this->id_usuario_estudiante);
    }
    
    public function getNombreGrupo()
    {
        return new Grupo('id', $this->id_grupo);
    }
    
    public function getNombreAnioEscolar()
    {
        return new AnioEscolar('id', $this->id_anio_escolar);
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setIdUsuarioEstudiante($id_usuario_estudiante): void 
    {
        $this->id_usuario_estudiante = $id_usuario_estudiante;
    }
    
    public function setIdGrupo($id_grupo): void 
    {
        $this->id_grupo = $id_grupo;
    }
    
    public function setIdAnioEscolar($id_anio_escolar): void 
    {
        $this->id_anio_escolar = $id_anio_escolar;
    }
    
    public function __toString()
    {
        return $this->id_usuario_estudiante;
    }

    public function guardar()
    {
        $cadenaSQL = "INSERT INTO grupo_estudiante (id_usuario_estudiante, id_grupo, id_anio_escolar) values ('$this->id_usuario_estudiante', '$this->id_grupo', '$this->id_anio_escolar')";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function modificar($ID)
    {
        $cadenaSQL = "UPDATE grupo_estudiante SET id_usuario_estudiante='{$this->id_usuario_estudiante}', id_grupo='{$this->id_grupo}', id_anio_escolar='{$this->id_anio_escolar}' WHERE id={$ID}";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "DELETE FROM grupo_estudiante WHERE id='$this->id'";
        ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = " WHERE $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = " ORDER BY $orden";
        $cadenaSQL = "SELECT id, id_usuario_estudiante, id_grupo, id_anio_escolar FROM grupo_estudiante $filtro $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL);
    }

    public static function getListaEnObjetos($filtro, $orden)
    {
        $resultado = GrupoEstudiante::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $grupo_estudiante = new GrupoEstudiante($resultado[$i], null);
            $lista[$i] = $grupo_estudiante;
        }
        return $lista;
    }
}
