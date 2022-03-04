<?php

class MenuLista
{

    public static function getMenu($rol)
    {
        $listaMenu = '';
        $permisos = Permiso::getListaEnObjetos("id_rol={$rol}", null);

        foreach ($permisos as $permiso) {
            $menus = Menu::getListaEnObjetos("id={$permiso->getIdMenu()}", null);
            foreach ($menus as $menu) {
                if ($menu->getTipo() == 1) {
                    $listaMenu .= MenuLista::construirHijos($menu);
                }
            }
        }
        return $listaMenu;
    }

    public static function construirHijos($item)
    {
        $hijoUnico = '<li class="menu__item"><a href="' . $item->getRuta() . '" class="as-menu__link">' . $item->getNombre() . '</a></li>';
        $totalMenus = Menu::getListaEnObjetos(null, null);
        $tieneHijos = false;

        $listaHijos = '<li class="menu__item as-dropdown-submenu"><a href="' . $item->getRuta() . '" class="as-menu__link as-submenu-btn"> <span>' . $item->getNombre() . '</span> <i class="fas fa-chevron-down"></i></a><ul class="as-submenu">';

        foreach ($totalMenus as $menu) {
            if ($menu->getEsHijo() == $item->getId() && $menu->getTipo() == 2) {
                $listaHijos .= '<li class="menu__item"><a href="' . $menu->getRuta() . '" class="as-menu__link as-submenu-color">' . $menu->getNombre() . '</a></li>';
                $tieneHijos = true;
            }
        }

        $listaHijos .= '</ul> </li>';

        return $tieneHijos ? $listaHijos : $hijoUnico;
    }
}

/*          <li class="menu__item"><a href="principal.php?CONTENIDO=layout/inicio.php" class="as-menu__link">Inicio</a></li>
            <li class="menu__item as-dropdown-submenu">
                <a href="principal.php?CONTENIDO=layout/inicio.php" class="as-menu__link as-submenu-btn"> <span>Institución</span> <i class="fas fa-chevron-down"></i></a>
                <ul class="as-submenu">
                    <li class="menu__item">
                        <a href="principal.php?CONTENIDO=layout/components/lista-anio.php" class="as-menu__link as-submenu-color">Año escolar</a>
                    </li>
                    <li class="menu__item">
                        <a href="principal.php?CONTENIDO=layout/components/lista-periodo.php" class="as-menu__link as-submenu-color">Periodo Academico</a>
                    </li>
                    <li class="menu__item">
                        <a href="principal.php?CONTENIDO=layout/components/lista-grado.php" class="as-menu__link as-submenu-color">Grados</a>
                    </li>
                    <li class="menu__item">
                        <a href="principal.php?CONTENIDO=layout/components/lista-grupo.php" class="as-menu__link as-submenu-color">Grupos</a>
                    </li>
                </ul>
            </li>
            <li class="menu__item"><a href="principal.php?CONTENIDO=layout/components/lista-asignatura.php" class="as-menu__link">Asignaturas</a></li>
            <li class="menu__item as-dropdown-submenu">
                <a href="#" class="as-menu__link as-submenu-btn">Docentes <i class="fas fa-chevron-down"></i></a>
                <ul class="as-submenu">
                    <li class="menu__item">
                        <a href="#" class="as-menu__link as-submenu-color">Personal docente</a>
                    </li>
                    <li class="menu__item">
                        <a href="#" class="as-menu__link as-submenu-color">Asignación docente</a>
                    </li>
                </ul>
            </li>
            <li class="menu__item as-dropdown-submenu">
                <a href="#" class="as-menu__link as-submenu-btn">Estudiantes <i class="fas fa-chevron-down"></i></a>
                <ul class="as-submenu">
                    <li class="menu__item">
                        <a href="#" class="as-menu__link as-submenu-color">Listados</a>
                    </li>
                    <li class="menu__item">
                        <a href="#" class="as-menu__link as-submenu-color">Inasistencias</a>
                    </li>
                </ul>
            </li>
            <li class="menu__item as-dropdown-submenu">
                <a href="#" class="as-menu__link as-submenu-btn">Notas <i class="fas fa-chevron-down"></i></a>
                <ul class="as-submenu">
                    <li class="menu__item">
                        <a href="#" class="as-menu__link as-submenu-color">Consulta de notas</a>
                    </li>
                    <li class="menu__item">
                        <a href="#" class="as-menu__link as-submenu-color">Imprimir notas</a>
                    </li>
                </ul>
            </li>
            <li class="menu__item"><a href="#" class="as-menu__link">Foro</a></li>
            <li class="menu__item as-dropdown-submenu">
                <a href="#" class="as-menu__link as-submenu-btn">Perfi <i class="fas fa-chevron-down"></i></a>
                <ul class="as-submenu">
                    <li class="menu__item">
                        <a href="#" class="as-menu__link as-submenu-color">Cambiar contraseña</a>
                    </li>
                    <li class="menu__item">
                        <a href="index.php" class="as-menu__link as-submenu-color">Cerrar sesión</a>
                    </li>
                </ul>
            </li>
*/