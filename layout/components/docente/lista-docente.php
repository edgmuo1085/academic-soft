<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$lista = '';
$count = 1;
$listaUsuarios = Usuario::getListaEnObjetos('rol_id=2', '');
if (isset($_REQUEST['identificacion'])) {
    $listaUsuarios = Usuario::getListaEnObjetos("rol_id=2 AND identificacion={$_REQUEST['identificacion']}", '');
}

foreach ($listaUsuarios as $item) {
    $lista .= "<tr>";
    $lista .= '<th scope="row">' . $count . '</th>';
    $lista .= "<td>{$item->getIdentificacion()}</td>";
    $lista .= "<td>{$item->getNombres()}</td>";
    $lista .= "<td>{$item->getApellidos()}</td>";
    $lista .= "<td>{$item->getTelefono()}</td>";
    $lista .= "<td>{$item->getEmail()}</td>";
    $lista .= "<td>{$item->getDireccion()}</td>";
    $lista .= "<td>" . Generalidades::getEstadoUsuario($item->getEstado()) . "</td>";
    $lista .= "<td class='as-text-center'>";
    $lista .= "<a class='as-edit' href='principal.php?CONTENIDO=layout/components/docente/form-docente.php&accion=Modificar&id={$item->getId()}'>" . Generalidades::getTooltip(1, '') . "</a>";
    $lista .= "<span class='as-trash' onClick='eliminar({$item->getId()})'>" . Generalidades::getTooltip(2, '') . "</span>";
    $lista .= $item->getEstado() == 1 ? "<a class='as-add' href='principal.php?CONTENIDO=layout/components/docente/form-asignacion-docente-create.php&accion=crear&id={$item->getId()}'>" . Generalidades::getTooltip(3, 'Asignación docente') . "</a>" : "";
    $lista .= "</td>";
    $lista .= "</tr>";
    $count++;
}

?>

<div class="as-form-content">
    <form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/docente/lista-docente.php" autocomplete="off">
        <div class="as-form-margin">
            <h2>Buscar docente</h2>
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
                <a class="as-color-btn-red" href="principal.php?CONTENIDO=layout/components/docente/lista-docente.php">
                    Limpiar
                </a>
            </div>
        </div>
    </form>
</div>

<div class="as-layout-table">
    <div>
        <h3 class="as-title-table">LISTADO DE DOCENTES</h3>
    </div>
    <div class="as-form-button-back">
        <a class="as-btn-back" href="principal.php?CONTENIDO=layout/components/docente/form-docente.php">Agregar docente</a>
    </div>
    <div class="as-table-responsive">
        <table class="as-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Identificación</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Email</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Estado</th>
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
        if (respuesta) location = "principal.php?CONTENIDO=layout/components/docente/form-docente-action.php&accion=Eliminar&id=" + id;
    }
</script>