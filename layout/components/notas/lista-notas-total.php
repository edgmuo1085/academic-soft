<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$editar = $USUARIO->getRolId();
$lista = '';
$count = 1;
$consulta = '';
$bandera = false;
$selectMenuPeriodoAcademico = '';
$selectMenuGrado = '';
/*
$arrayPeriodoAcademico = PeriodoAcademico::getListaEnObjetos(null, 'id');
$listaNotas = Notas::getListaEnObjetos('', 'n.id_periodo_academico, n.id_usuario_estudiante, n.id_asignatura, n.id_tipo_actividad');

foreach ($listaNotas as $item) {
    $lista .= "<tr>";
    $lista .= '<th scope="row">' . $count . '</th>';
    $lista .= "<td>{$item->getPeriodoAcademico()}</td>";
    $lista .= "<td>{$item->getNombreGrado()}</td>";
    $lista .= "<td>{$item->getNombreGrupo()}</td>";
    $lista .= $editar == 1 || $editar == 6 ? "<td class='as-text-uppercase as-text-left'><a href='principal.php?CONTENIDO=layout/components/estudiante/form-estudiante.php&accion=Modificar&id={$item->getIdUsuarioEstudiante()}'>{$item->getNombreEstudiante()}</a></td>" : "<td class='as-text-uppercase as-text-left'>{$item->getNombreEstudiante()}</td>";
    $lista .= "<td class='as-text-uppercase as-text-left'>{$item->getNombreAsignatura()}</td>";
    $lista .= "<td>{$item->getNombreTipoActividad()}</td>";
    $lista .= "<td>{$item->getNota()}</td>";
    if ($editar != 4) {
        $lista .= "<td class='as-text-center'>";
        $lista .= "<a class='as-edit' href='principal.php?CONTENIDO=layout/components/notas/form-notas-edit.php&accion=Modificar&id={$item->getId()}'>" . Generalidades::getTooltip(1, '') . "</a>";
        $lista .= "<a class='as-add' href='principal.php?CONTENIDO=layout/components/notas/form-notas-create-array.php&accion=Crear&id={$item->getIdUsuarioEstudiante()}'>" . Generalidades::getTooltip(3, 'Agregar notas') . "</a>";
        $lista .= "<span class='as-trash' onClick='eliminar({$item->getId()})'>" . Generalidades::getTooltip(2, '') . "</span>";
        $lista .= "</td>";
    }
    $lista .= "</tr>";
    $count++;
} */

?>


<div class="as-layout-table">
    <div>
        <h3 class="as-title-table">LISTA DE CALIFICACIONES</h3>
    </div>
    <div class="as-content-data">
        <h4>Periodo Académico 1</h4>
        <h4>Grado Quinto</h4>
        

    </div>
</div>