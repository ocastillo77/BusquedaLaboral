<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * MenuTop.php
 * -------------------------------------
 */

class MenuLeft {

  const table = 'sys_menu_left';

  private $_registry;
  protected $_db;

  public function __construct() {
    $this->_registry = Registry::getInstance();
    $this->_db = $this->_registry->_db;
  }

  public function getMenuTop() {
    $tabla = DB_PREF . self::table;
    $menu = $this->_db->query("SELECT * FROM " . $tabla . " WHERE Publico='1' ORDER BY Posicion");
    return $menu->fetchAll();
  }

  public function getOpenItem() {
    $tabla = DB_PREF . self::table;
    $menu = $this->_db->query("SELECT PadreID FROM " . $tabla . " WHERE Tabla='" . Controller::getItem() . "'");
    $result = $menu ? $menu->fetch() : false;
    $padreId = $result ? $result['PadreID'] : false;

    return $padreId;
  }

  public function getItemsMenu() {
    $menu = [
      'items' => [],
      'parents' => []
    ];

    $items = $this->getMenuTop();

    foreach ($items as $item) {
      $menu['items'][$item['ID']] = $item;
      $menu['parents'][$item['PadreID']][] = $item['ID'];
    }
    return $menu;
  }

  public function recursiveMenu($parent, $menu, $name = 'main-menu', $style = '') {
    $html = '';

    if (isset($menu['parents'][$parent])) {
      $html .= '<ul class="' . $name . '" ' . $style . '>' . "\n";

      foreach ($menu['parents'][$parent] as $itemID) {
        $itemsMenu = $menu['items'][$itemID];

        if (!isset($menu['parents'][$itemID])) {
          if (!empty($itemsMenu['Url'])) {
            if (!empty($itemsMenu['Tabla'])) {
              $url = URL_CMS . $itemsMenu['Tabla'] . '/' . $itemsMenu['Url'];
            } else {
              $url = URL_CMS . $itemsMenu['Url'];
            }
          } else {
            $url = URL_CMS;
          }

          $icon = (!empty($itemsMenu['Icono'])) ? $itemsMenu['Icono'] : 'dot-circle-o';
          $roles = explode(',', $itemsMenu['RolID']);

          if (in_array(Session::get('level'), $roles)) {
            $html .= '<li>'
              . '<a href="' . $url . '">'
              . '<i class="fa-fw fa fa-' . $icon . '"></i>'
              . '<span class="text">' . $itemsMenu['Titulo'] . '</span>'
              . '</a>' .
              '</li>';
          }
        }

        if (isset($menu['parents'][$itemID])) {
          $active = $this->getOpenItem() == $itemID ? 'class="active"' : '';
          $style = $this->getOpenItem() == $itemID ? 'style="display: block;"' : '';
          $roles = explode(',', $itemsMenu['RolID']);

          if (in_array(Session::get('level'), $roles)) {
            $html .= '<li ' . $active . '>'
              . '<a href="#" class="js-sub-menu-toggle">'
              . '<i class="fa-fw fa fa-' . $itemsMenu['Icono'] . '"></i>'
              . '<span class="text">' . $itemsMenu['Titulo'] . '</span>'
              . '<i class="toggle-icon fa fa-angle-left"></i>'
              . '</a>';
            $html .= $this->recursiveMenu($itemID, $menu, 'sub-menu', $style);
            $html .= '</li>';
          }
        }
      }
      $html .= '</ul>' . "\n";
    }
    return $html;
  }

  public function render() {
    $menu = $this->getItemsMenu();
    return $this->recursiveMenu(0, $menu);
  }

}
