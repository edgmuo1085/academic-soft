<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$lista = '';
$count = 1;
$txtResumido = 'as-texto-resumido';
$txtCompleto = 'as-texto-completo';
$listaInasistencias = Inasistencias::getListaEnObjetos(null, 'fecha_creacion DESC');
if (isset($_REQUEST['identificacion'])) {
    $listaUsuarios = Usuario::getListaEnObjetos("rol_id=4 AND identificacion={$_REQUEST['identificacion']}", '');
    foreach ($listaUsuarios as $param) {
        $listaInasistencias = Inasistencias::getListaEnObjetos("id_usuario_estudiante={$param->getId()}", 'fecha_creacion DESC');
    }
}

foreach ($listaInasistencias as $item) {
    $lista .= "<tr>";
    $lista .= '<th scope="row">' . $count . '</th>';
    $lista .= "<td><a href='principal.php?CONTENIDO=layout/components/estudiante/form-estudiante.php&accion=Modificar&id={$item->getIdUsuarioEstudiante()}'>{$item->getNombreEstudiante()}</a></td>";
    $lista .= "<td>{$item->getNombreAsignatura()}</td>";
    $lista .= "<td>" . Generalidades::convertDate($item->getFechaCreacion(), false) . "</td>";
    $lista .= "<td>{$item->getCantidad()}</td>";
    $lista .= "<td>";
    $lista .= "<div id='as-texto-resumido" . $count . "'>";
    $lista .= Generalidades::getReduceCharacters($item->getJustificacion()) . " ... <br>";
    $lista .= "<span class='as-leer-mas' onClick='leerMasHideShow(1, \"" . $txtResumido . $count . "\", \"" . $txtCompleto . $count . "\")'>Leer más</span>";
    $lista .= "</div>";
    $lista .= "<div id='as-texto-completo" . $count . "' class='as-block-hide'>";
    $lista .= $item->getJustificacion() . "<br>";
    $lista .= "<span class='as-leer-mas' onClick='leerMasHideShow(2, \"" . $txtResumido . $count . "\", \"" . $txtCompleto . $count . "\")'>Ocultar texto</span>";
    $lista .= "</div>";
    $lista .= "</td>";
    $lista .= "<td class='as-text-center'>";
    $lista .= "<a class='as-edit' href='principal.php?CONTENIDO=layout/components/inasistencias/form-inasistencias-edit.php&accion=Modificar&id={$item->getId()}'>" . Generalidades::getTooltip(1, '') . "</a>";
    $lista .= "<span class='as-trash' onClick='eliminar({$item->getId()})'>" . Generalidades::getTooltip(2, '') . "</span>";
    $lista .= "<a class='as-add' href='principal.php?CONTENIDO=layout/components/inasistencias/form-inasistencias-create.php&accion=crear&id={$item->getIdUsuarioEstudiante()}'>" . Generalidades::getTooltip(3, 'Registrar inasistencia') . "</a>";
    $lista .= "</td>";
    $lista .= "</tr>";
    $count++;
}

?>
<div class="as-form-content">
    <form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/inasistencias/lista-inasistencias.php" autocomplete="off">
        <div class="as-form-margin">
            <h2>Buscar inasistencias por estudiante</h2>
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
                <a class="as-color-btn-red" href="principal.php?CONTENIDO=layout/components/inasistencias/lista-inasistencias.php">
                    Limpiar
                </a>
            </div>
        </div>
    </form>
</div>

<div class="as-layout-table">
    <div>
        <h3 class="as-title-table">GESTIONAR INASISTENCIAS</h3>
    </div>
    <div class="as-table-responsive">
        <table class="as-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Estudiante</th>
                    <th scope="col">Asignatura</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Justificación</th>
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
        if (respuesta) location = "principal.php?CONTENIDO=layout/components/inasistencias/form-inasistencias-action.php&accion=Eliminar&id=" + id;
    }

    const leerMasHideShow = (parametro, idResumido, idCompleto) => {
        let elementResumido = document.getElementById(idResumido);
        let elementCompleto = document.getElementById(idCompleto);
        if (parametro == 1) {
            elementResumido.classList.add("as-block-hide");
            elementCompleto.classList.remove("as-block-hide");
        } else {
            elementResumido.classList.remove("as-block-hide");
            elementCompleto.classList.add("as-block-hide");
        }
    }
</script>