<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$lista = '';
$count = 1;
$selectMenuAsignatura = '';
$selectMenuGrado = '';
$bandera = false;
$banderaAsignacion = false;
$consulta = '';
$consultaAsignacion = '';
$arrayAsignatura = Asignatura::getListaEnObjetos(null, 'nombre_asignatura');
$arrayGrado = Grado::getListaEnObjetos(null, 'id');
$listaAsignacionesDocente = array();
$listaAsignacionesDocente = AsignacionDocente::getListaEnObjetos('', 'id_usuario_docente, id_grado, id_asignatura');
$listaAsignacionesDocenteTem = array();

if (isset($_REQUEST['identificacion']) || isset($_REQUEST['nombres']) || isset($_REQUEST['id_grado']) || isset($_REQUEST['id_asignatura'])) {
    $listaAsignacionesDocente = '';
    if (!empty($_REQUEST['identificacion'])) {
        $consulta .= " AND identificacion LIKE '%{$_REQUEST['identificacion']}%'";
        $bandera = true;
    }

    if (!empty($_REQUEST['nombres'])) {
        $consulta .= " AND nombres LIKE '%{$_REQUEST['nombres']}%'";
        $bandera = true;
    }

    if (!empty($_REQUEST['id_grado'])) {
        $consultaAsignacion .= $bandera ? " AND id_grado={$_REQUEST['id_grado']}" : " id_grado={$_REQUEST['id_grado']}";
        $banderaAsignacion = true;
    }

    if (!empty($_REQUEST['id_asignatura'])) {
        $consultaAsignacion .= $bandera ? " AND id_asignatura={$_REQUEST['id_asignatura']}" : " id_asignatura={$_REQUEST['id_asignatura']}";
        $banderaAsignacion = true;
    }

    if ($bandera) {
        $listaUsuarios = Usuario::getListaEnObjetos("rol_id=2" . $consulta, '');
        foreach ($listaUsuarios as $param) {
            $listaAsignacionesDocente = AsignacionDocente::getListaEnObjetos("id_usuario_docente={$param->getId()}" . $consultaAsignacion, 'id_usuario_docente, id_grado, id_asignatura');
        }
    }

    if (!$bandera) {
        $listaAsignacionesDocente = AsignacionDocente::getListaEnObjetos("{$consultaAsignacion}", 'id_usuario_docente, id_grado, id_asignatura');
    }
}

foreach ($arrayAsignatura as $paramA) {
    $selectMenuAsignatura .= '<option value="' . $paramA->getId() . '">' . $paramA->getNombreAsignatura() . '</option>';
}
foreach ($arrayGrado as $paramG) {
    $selectMenuGrado .= '<option value="' . $paramG->getId() . '">' . $paramG->getNombreGrado() . '</option>';
}

foreach ($listaAsignacionesDocente as $item) {
    $lista .= "<tr>";
    $lista .= '<th scope="row">' . $count . '</th>';
    $lista .= "<td><a href='principal.php?CONTENIDO=layout/components/docente/form-docente.php&accion=Modificar&id={$item->getIdUsuarioDocente()}'>{$item->getNombreDocente()}</a></td>";
    $lista .= "<td>{$item->getNombreGrado()}</td>";
    $lista .= "<td>{$item->getNombreAsignatura()}</td>";
    $lista .= "<td> <a href='{$item->getLinkClaseVirtual()}' target='blank'> Enlace </a></td>";
    $lista .= "<td>{$item->getIntensidadHoraria()}</td>";
    $lista .= "<td class='as-text-center'>";
    $lista .= "<a class='as-edit' href='principal.php?CONTENIDO=layout/components/docente/form-asignacion-docente-edit.php&accion=Modificar&id={$item->getId()}'>" . Generalidades::getTooltip(1, '') . "</a>";
    $lista .= "<span class='as-trash' onClick='eliminar({$item->getId()})'>" . Generalidades::getTooltip(2, '') . "</span>";
    $lista .= "<a class='as-add' href='principal.php?CONTENIDO=layout/components/docente/form-asignacion-docente-create.php&accion=crear&id={$item->getIdUsuarioDocente()}'>" . Generalidades::getTooltip(3, 'Asignación docente') . "</a>";
    $lista .= "</td>";
    $lista .= "</tr>";
    $count++;
}
?>
<div class="as-tab-content">
    <div class="as-tab-header" id="as-tab-header-click">
        <i class='fas fa-search'></i> Buscar docente
    </div>
    <div class="as-tab-content-form">
        <div class="as-form-content">
            <form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/docente/lista-asignacion-docente.php" autocomplete="off">
                <div class="as-form-margin">
                    <div class="as-form-fields">
                        <div class="as-form-input">
                            <label class="hide-label" for="identificacion">Identificación</label>
                            <input type="number" name="identificacion" id="identificacion" placeholder="Identificación">
                        </div>
                    </div>
                    <div class="as-form-fields">
                        <div class="as-form-input">
                            <label class="hide-label" for="nombres">Nombres</label>
                            <input type="text" name="nombres" id="nombres" placeholder="Nombres">
                        </div>
                    </div>
                    <div class="as-form-fields">
                        <div class="as-form-input">
                            <label class="hide-label" for="id_grado">Grados</label>
                            <select class="as-form-select" name="id_grado" id="id_grado">
                                <option value='0'>Grados...</option>
                                <?php
                                echo $selectMenuGrado;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="as-form-fields">
                        <div class="as-form-input">
                            <label class="hide-label" for="id_asignatura">Asignaturas</label>
                            <select class="as-form-select" name="id_asignatura" id="id_asignatura">
                                <option value='0'>Asignaturas...</option>
                                <?php
                                echo $selectMenuAsignatura;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="as-form-button">
                        <button class="as-color-btn-green" type="submit">
                            Buscar
                        </button>
                        <a class="as-color-btn-red" href="principal.php?CONTENIDO=layout/components/docente/lista-asignacion-docente.php">
                            Limpiar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="as-layout-table">
    <div>
        <h3 class="as-title-table">LISTA DE ASIGNACIONES</h3>
    </div>
    <div class="as-table-responsive">
        <table class="as-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Docente</th>
                    <th scope="col">Grado</th>
                    <th scope="col">Asignatura</th>
                    <th scope="col">Clase virtual</th>
                    <th scope="col">Intensidad horaria</th>
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
        if (respuesta) location = "principal.php?CONTENIDO=layout/components/docente/form-asignacion-docente-action.php&accion=Eliminar&id=" + id;
    }

    const clickTabShowHidden = document.querySelector("#as-tab-header-click");
    clickTabShowHidden.addEventListener("click", () => {
        const contentTab = clickTabShowHidden.nextElementSibling;

        if (contentTab.classList.contains("as-tab-content-form-show")) {
            contentTab.classList.remove("as-tab-content-form-show");
        } else {
            contentTab.classList.add("as-tab-content-form-show");
        }
    });
</script>