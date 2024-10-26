<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * Select.php
 * -------------------------------------
 */

class SelectMenu {

  const table = 'sys_menu_left';

  private $_registry;
  protected $_db;
  protected $_parent_id;

  public function __construct($parent_id = 0) {
    $this->_registry = Registry::getInstance();
    $this->_db = $this->_registry->_db;
    $this->_parent_id = $parent_id;
  }

  public function getMenuLeft() {
    $tabla = DB_PREF . self::table;
    $select = $this->_db->query("SELECT ID,Titulo,PadreID FROM " . $tabla . " WHERE Publico='1'");
    return $select->fetchall();
  }

  public function getItemSelect() {
    $select = array(
        'items' => array(),
        'parents' => array()
    );

    $items = $this->getMenuLeft();

    foreach ($items as $item) {
      $select['items'][$item['ID']] = $item;
      $select['parents'][$item['PadreID']][] = $item['ID'];
    }
    return $select;
  }

  public function recursiveSelect($parent, $select, $depth = 0) {
    $html = '';
    if (isset($select['parents'][$parent])) {
      foreach ($select['parents'][$parent] as $itemID) {
        if (!isset($select['parents'][$itemID])) {
          $selected = ($this->_parent_id == $select['items'][$itemID]['ID']) ? 'selected' : '';
          $html .= '<option value="' . $select['items'][$itemID]['ID'] . '" ' . $selected . '>';
          $html .= str_repeat('&nbsp;', $depth * 5);
          $html .= $select['items'][$itemID]['Titulo'] . '</option>' . PHP_EOL;
        }
        if (isset($select['parents'][$itemID])) {
          $selected = ($this->_parent_id == $select['items'][$itemID]['ID']) ? 'selected' : '';
          $html .= '<option style="font-weight:bold;text-transform:uppercase;" 
											value="' . $select['items'][$itemID]['ID'] . '" ' . $selected . '>';
          $html .= $select['items'][$itemID]['Titulo'] . '</option>' . PHP_EOL;
          $html .= $this->recursiveSelect($itemID, $select, $depth + 1);
        }
      }
    }
    return $html;
  }

  public function render() {
    $select = $this->getItemSelect();
    return $this->recursiveSelect(0, $select);
  }

}
