<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * MenuTop.php
 * -------------------------------------
 */

class MenuTop
{

  private $table;
  protected $db;

  public function __construct()
  {
    $this->db = new Model;
    $this->table = 'secciones';
  }

  public function getItemsMenu()
  {
    $menu = [];
    $query = [
      'table' => $this->table,
      'field' => 'ID,PadreID,URL,MenuTop as Titulo',
      'where' => "Publico=1 AND MenuTop!=''",
      'order' => 'Posicion'
    ];

    $items = $this->db->all($query);

    if ($items) {
      foreach ($items as $item) {
        $menu['items'][$item['ID']] = $item;
        $menu['parents'][$item['PadreID']][] = $item['ID'];
      }
    }

    return $menu;
  }

  public function recursiveMenu($parent, $menu, $attr = '', $parent_url = false)
  {
    $list = '';

    if ($parent == 0) {
      $link = Helper::tag2('a', 'Inicio', [
        'href' => URL_WEB,
        'class' => ''
      ]);
      $list .= Helper::tag2('li', $link, [
        'id' => 'menu0',
        'class' => ''
      ]);
    }

    if (isset($menu['parents'][$parent])) {
      foreach ($menu['parents'][$parent] as $itemID) {
        $parentItem = isset($menu['parents'][$itemID]) ? $menu['parents'][$itemID] : false;
        $item = $menu['items'][$itemID];

        if (!$parentItem) {
          $url = URL_WEB . 'seccion/' . (!empty($item['URL']) ? $item['URL'] : '');

          $link = Helper::tag2('a', $item['Titulo'], ['href' => $url, 'class' => '']);
          $list .= Helper::tag2('li', $link, [
            'id' => 'menu' . $itemID,
            'class' => ''
          ]);
        }

        if ($parentItem) {
          $link = Helper::tag2('a', $item['Titulo'], [
            'href' => 'javascript:;',
            'class' => ''
          ]);
          $recursive = $this->recursiveMenu($itemID, $menu, [
            'class' => ''
          ], true);
          $list .= Helper::tag2('li', $link . $recursive, [
            'id' => 'menu' . $itemID,
            'class' => ''
          ]);
        }
      }
    }

    return Helper::tag2('ul', $list, $attr);
  }

  public function render()
  {
    $attr = [
      'id' => 'main-menu',
      'class' => 'nav navbar-nav'
    ];

    $menu = $this->getItemsMenu();
    return $this->recursiveMenu(0, $menu, $attr);
  }
}
