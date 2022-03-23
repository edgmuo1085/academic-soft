<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$lista = '';
$count = 1;
$listaNotas = Notas::getListaEnObjetos('', 'id_periodo_academico, id_usuario_estudiante, id_asignatura, id_tipo_actividad');
if (isset($_REQUEST['identificacion'])) {
    $listaUsuarios = Usuario::getListaEnObjetos("rol_id=4 AND identificacion={$_REQUEST['identificacion']}", '');
    foreach ($listaUsuarios as $param) {
        $listaNotas = Notas::getListaEnObjetos("id_usuario_estudiante={$param->getId()}", 'id_periodo_academico, id_usuario_estudiante, id_asignatura, id_tipo_actividad');
    }
}

foreach ($listaNotas as $item) {
    $lista .= "<tr>";
    $lista .= '<th scope="row">' . $count . '</th>';
    $lista .= "<td>{$item->getPeriodoAcademico()}</td>";
    $lista .= "<td><a href='principal.php?CONTENIDO=layout/components/estudiante/form-estudiante.php&accion=Modificar&id={$item->getIdUsuarioEstudiante()}'>{$item->getNombreEstudiante()}</a></td>";
    $lista .= "<td>{$item->getNombreAsignatura()}</td>";
    $lista .= "<td>{$item->getNombreTipoActividad()}</td>";
    $lista .= "<td>{$item->getNota()}</td>";
    $lista .= "<td class='as-text-center'>";
    $lista .= "<a class='as-edit' href='principal.php?CONTENIDO=layout/components/notas/form-notas-edit.php&accion=Modificar&id={$item->getId()}'>" . Generalidades::getTooltip(1, '') . "</a>";
    $lista .= "<a class='as-add' href='principal.php?CONTENIDO=layout/components/notas/form-notas-create.php&accion=Crear&id={$item->getIdUsuarioEstudiante()}'>" . Generalidades::getTooltip(3, 'Agregar notas') . "</a>";
    $lista .= "<span class='as-trash' onClick='eliminar({$item->getId()})'>" . Generalidades::getTooltip(2, '') . "</span>";
    $lista .= "</td>";
    $lista .= "</tr>";
    $count++;
}

?>
<div class="as-form-content">
    <form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/notas/lista-notas.php" autocomplete="off">
        <div class="as-form-margin">
            <h2>Buscar notas de un estudiante</h2>
            <div class="as-form-fields">
                <div class="as-form-input">
                    <label class="hide-label" for="identificacion">Identificación</label>
                    <input type="number" name="identificacion" id="identificacion" required placeholder="Identificación">
                </div>
            </div>
            <div class="as-form-button">
                <button class="as-color-btn-green" type="submit">
                    Buscar
                </button>
                <a class="as-color-btn-red" href="principal.php?CONTENIDO=layout/components/notas/lista-notas.php">
                    Limpiar
                </a>
            </div>
        </div>
    </form>
</div>

<div class="as-layout-table">
    <div>
        <h3 class="as-title-table">LISTA DE CALIFICACIONES</h3>
    </div>
    <div class="as-table-responsive">
        <table class="as-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Periodo académico</th>
                    <th scope="col">Estudiante</th>
                    <th scope="col">Asignatura</th>
                    <th scope="col">Tipo actividad</th>
                    <th scope="col">Nota</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php print_r($lista); ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    const eliminar = (id) => {
        let respuesta = confirm("Esta seguro de eliminar este registro?");
        if (respuesta) location = "principal.php?CONTENIDO=layout/components/notas/form-notas-action.php&accion=Eliminar&id=" + id;
    }
</script>