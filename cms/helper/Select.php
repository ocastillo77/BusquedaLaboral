<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * Select.php
 * -------------------------------------
 */

class Select
{

  const table = 'secciones';

  private $_registry;
  protected $_db;
  protected $seccionId;
  protected $parentId;

  public function __construct($seccionId = 0, $parentId = 0)
  {
    $this->_registry = Registry::getInstance();
    $this->_db = $this->_registry->_db;
    $this->parentId = $parentId;
    $this->seccionId = $seccionId;
  }

  public function getSecciones()
  {
    $tabla = DB_PREF . self::table;
    $select = $this->_db->query("SELECT ID,Titulo,PadreID,MenuTop FROM "
      . $tabla . " WHERE Publico='1' ORDER BY Posicion");
    return $select->fetchall();
  }

  public function getItemSelect()
  {
    $select = [];
    $items = $this->getSecciones();

    foreach ($items as $item) {
      $select['items'][$item['ID']] = $item;
      $select['parents'][$item['PadreID']][] = $item['ID'];
    }
    return $select;
  }

  public function recursiveSelect($parent, $select, $depth = 0)
  {
    $html = '';
    if (isset($select['parents'][$parent])) {
      foreach ($select['parents'][$parent] as $itemID) {
        if (!isset($select['parents'][$itemID])) {
          if ($this->seccionId == 0 || $parent != $this->seccionId) {
            if (trim($select['items'][$itemID]['MenuTop']) !== '') {
              $selected = $this->parentId == $select['items'][$itemID]['ID'] ? 'selected' : '';
              $html .= '<option value="' . $select['items'][$itemID]['ID'] . '" ' . $selected . '>';
              $html .= str_repeat('&nbsp;', $depth * 5);
              $html .= '&bull; ' . $select['items'][$itemID]['MenuTop'] . '</option>' . PHP_EOL;
            }
          }
        }
        if (isset($select['parents'][$itemID])) {
          if ($this->seccionId == 0 || $itemID != $this->seccionId) {
            if (trim($select['items'][$itemID]['MenuTop']) !== '') {
              $selected = ($this->parentId == $select['items'][$itemID]['ID']) ? 'selected' : '';
              $html .= '<option class="option-multi" 
											value="' . $select['items'][$itemID]['ID'] . '" ' . $selected . '>';
              $html .= str_repeat('&nbsp;', $depth * 5);
              $html .= $select['items'][$itemID]['MenuTop'] . '</option>' . PHP_EOL;
              $html .= $this->recursiveSelect($itemID, $select, $depth + 1);
            }
          }
        }
      }
    }
    return $html;
  }

  public function render()
  {
    $select = $this->getItemSelect();
    return $this->recursiveSelect(0, $select);
  }

}
