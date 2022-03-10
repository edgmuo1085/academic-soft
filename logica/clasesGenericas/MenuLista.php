<?php

class MenuLista
{
    public static function getMenu($rol)
    {
        $listaMenu = '';
        $totalMenus = Menu::getListaEnObjetos(null, 'posicion');

        foreach ($totalMenus as $menu) {
            if ($menu->getTipo() == 1) {
                $listaMenu .= MenuLista::construirHijos($menu, $rol);
            }
        }

        return $listaMenu;
    }

    public static function construirHijos($item, $rol)
    {
        $permiso = Permiso::getListaEnObjetos("id_rol={$rol} AND id_menu={$item->getId()}", null);
        $tieneHijos = false;
        $hijoUnico = '';

        foreach ($permiso as $key) {
            if ($key->getEstado() == 1) {
                $hijoUnico .= '<li class="menu__item"><a href="' . $item->getRuta() . '" class="as-menu__link">' . $item->getNombre() . '</a></li>';
                $totalMenus = Menu::getListaEnObjetos(null, 'posicion');
                $listaHijos = '<li class="menu__item as-dropdown-submenu"><a href="' . $item->getRuta() . '" class="as-menu__link as-submenu-btn"> <span>' . $item->getNombre() . '</span> <i class="fas fa-chevron-down"></i></a><ul class="as-submenu">';

                foreach ($totalMenus as $menu) {
                    if ($menu->getEsHijo() == $item->getId() && $menu->getTipo() == 2) {
                        $permiso = Permiso::getListaEnObjetos("id_rol={$rol} AND id_menu={$menu->getId()}", null);

                        foreach ($permiso as $key) {
                            if ($key->getEstado() == 1) {
                                $listaHijos .= '<li class="menu__item"><a href="' . $menu->getRuta() . '" class="as-menu__link as-submenu-color">' . $menu->getNombre() . '</a></li>';
                            }
                        }

                        $tieneHijos = true;
                    }
                }

                $listaHijos .= '</ul> </li>';
            }
        }

        return $tieneHijos ? $listaHijos : $hijoUnico;
    }
}
