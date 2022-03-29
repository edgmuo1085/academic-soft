<?php
require_once '../logica/clasesGenericas/LibreriasImprimir.php';
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido al software académico - Imprimir</title>
    <link rel="icon" type="image/png" href="img/favicon.png" />
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,700;1,100;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <header>
        <nav class="as-nav-header">
            <div class="as-first-div">
                <img class="as-logo" src="img/logo-oficial.png" alt="logo" />
            </div>
            <div class="as-information">
                <h3 class="as-title">COLEGIO LOS ANDES NUESTRA SEÑORA DE LAS MERCEDES</h3>
                <p>Institución educativa con 35 años de trayectoria, basada en la educación integral
                    y personalizada. Contamos con altos estándares en educación, donde hacemos énfasis a
                    nuestro lema <span>&quot;NADA ES TAN IMPORTANTE COMO UN NIÑO&quot;</span>.</p>
            </div>
        </nav>
    </header>
    <main class="as-layout">
        <?php
        @session_start();
        if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
        $lista = '';
        $count = 1;
        $posision = 0;
        $promedio = 0;
        $contar = 0;
        $cantidadNotas = 0;
        $listaNotas = array();
        if (isset($_REQUEST['identificacion'])) {
            $listaNotas = NotasConsulta::getListaEnObjetos("WHERE u.identificacion = {$_REQUEST['identificacion']} GROUP BY n.id_periodo_academico, u.identificacion", false);

            foreach ($listaNotas as $key) {

                $lista .= '<div class="as-content-data">
                <div>
                    <h4>  #' . $count++ . ' - ' . $key->getPeriodoAcademico() . '</h4>
                </div>
                <div class="as-content-data-responsive">
                    <ul class="as-content-data-header">
                        <li><span class="as-content-data-title">Identificación: </span>' . $key->getIdentificacionEstudiante() . '</li>
                        <li><span class="as-content-data-title">Nombres: </span>' . $key->getNombreEstudiante() . '</li>
                        <li><span class="as-content-data-title">Grado: </span>' . $key->getNombreGrado() . ' ' . $key->getNombreGrupo() . '</li>
                    </ul>';

                $listaAsignaturas = NotasConsulta::getListaEnObjetos('GROUP BY n.id_periodo_academico, u.identificacion, n.id_asignatura', true);

                foreach ($listaAsignaturas as $asignatura) {

                    if ($asignatura->getIdPeriodoAcademico() == $key->getIdPeriodoAcademico() && $key->getIdUsuarioEstudiante() == $asignatura->getIdUsuarioEstudiante()) {

                        $lista .= '<div class="as-content-data-course">
                        <div class="as-content-data-course-title"><span>' . $asignatura->getNombreAsignatura(). '</span>';
                        $listaInasistencias = Inasistencias::getListaEnObjetos("i.id_asignatura = {$asignatura->getIdAsignatura()} AND i.registrado_a_estudiante = {$key->getIdUsuarioEstudiante()}", null, 'suma');
                        foreach ($listaInasistencias as $inasistencia) {
                            $cantidad = $inasistencia->getCantidad() ? $inasistencia->getCantidad() : '0';
                            $lista .= '<span> Inasistencias: ' . $cantidad . '</span>';
                        }
                        $lista .= '</div><div class="as-content-data-activity">';

                        $listaNotasAsignadas = NotasConsulta::getListaEnObjetos("", false);

                        $contar =  count($listaNotasAsignadas);
                        $posicion = 0;
                        $cantidadNotas = 0;
                        foreach ($listaNotasAsignadas as $item) {
                            $posicion++;
                            if (
                                $asignatura->getIdPeriodoAcademico() == $key->getIdPeriodoAcademico() &&
                                $asignatura->getIdentificacionEstudiante() == $item->getIdentificacionEstudiante() &&
                                $asignatura->getIdAsignatura() == $item->getIdAsignatura()
                            ) {
                                $lista .= '<p class="as-content-data-activity-item">
                                <span class="as-content-data-activity-title">' . $item->getNombreTipoActividad() . ':</span> ' . $item->getNota() . '
                            </p>';
                                $cantidadNotas++;
                            }

                            if ($contar == $posicion) {
                                $promedio = $asignatura->getNota() / $cantidadNotas;
                                $lista .= '<p class="as-content-data-activity-item"><span class="as-content-data-activity-title">Promedio :</span> ' . number_format($promedio, 2) . '</p>';
                            }
                        }

                        $lista .= '</div><!-- as-content-data-activity fin -->
                    </div><!-- as-content-data-course fin -->';
                    }
                }
                $lista .= '</div><!-- as-content-data-responsive fin -->
            </div><!-- as-content-data fin -->';
            }
        }
        ?>
        <div class="as-layout-table">
            <div>
                <h3 class="as-title-table">LISTA DE CALIFICACIONES</h3>
            </div>

            <?php
            if (count($listaNotas)) {
                echo '<div class="as-form-button-back">
                        <input type="button" value="Imprimir" class="as-btn-back printbutton">
                    </div>';
                printf($lista);
            } else {
                echo '<h3>No Existen Notas para imprimir</h3>';
            }
            ?>
        </div>
    </main>
    <footer class="as-footer">
        <p>Derechos Reservados</p>
        <p>
            <script>
                date = new Date().getFullYear();
                document.write(date);
                document.querySelectorAll('.printbutton').forEach(function(element) {
                    element.addEventListener('click', function() {
                        print();
                    });
                });
            </script>
        </p>
        <p>&copy;</p>
    </footer>
</body>

</html>