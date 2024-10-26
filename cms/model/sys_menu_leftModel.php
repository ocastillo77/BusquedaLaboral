<?php

class sys_menu_leftModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'sys_menu_left';
  }

  public function getConfigTabla() {
    $query = [
        'table' => 'sys_tables',
        'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getMenu($id) {
    $query = [
        'table' => $this->tabla,
        'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function getTablas() {
    return $this->all(array('table' => 'sys_tables', 'where' => "Publico='1'"));
  }

  public function updateMenu($fields) {
    return $this->save($this->tabla, $fields);
  }

  public function deleteMenus($ids) {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function updateMenus($type, $ids) {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

  public function getNivelMenu($publico, $parent) {
    $query = [
        'table' => $this->tabla,
        'where' => 'Publico=' . $publico . ' AND PadreID=' . $parent
    ];
    return $this->all($query);
  }

  public function getSelectPos($menu = false) {
    $where = $menu ? "AND ID!=" . $menu['ID']
            . " AND PadreID=" . $menu['PadreID'] : "AND PadreID=0";

    $query = [
        'table' => $this->tabla,
        'field' => 'ID,Titulo,Posicion,PadreID',
        'where' => "Publico=1 " . $where,
        'order' => 'Posicion'
    ];

    $select = $this->all($query);

    if (is_array($menu)) {
      $select[] = [
          'ID' => $menu['ID'],
          'Titulo' => $menu['Titulo'],
          'Posicion' => $menu['Posicion'],
          'PadreID' => $menu['PadreID']
      ];
    }

    return $select;
  }

  public function getSelectMenu() {
    $query = [
        'table' => $this->tabla,
        'where' => 'Publico=1 AND PadreID=0',
        'order' => 'Posicion'
    ];
    return $this->all($query);
  }

  public function reorderParentPrev($id, $parentAnt) {
    $query = [
        'table' => $this->tabla,
        'field' => 'ID',
        'where' => "Publico=1 AND ID!=" . $id . " AND PadreID=" . $parentAnt,
        'order' => 'Posicion'
    ];

    $select = $this->all($query);

    $pos = 1;
    foreach ($select as $item) {
      $this->save($this->tabla, ['ID' => $item['ID'], 'Posicion' => $pos]);
      $pos++;
    }
  }

  public function getSelectPosAct($parentId) {
    $query = [
        'table' => $this->tabla,
        'field' => 'ID,Titulo,Posicion,PadreID',
        'where' => "Publico=1 AND PadreID=" . $parentId,
        'order' => 'Posicion'
    ];
    return $this->all($query);
  }

  public function updateParentPos($id, $parentId, $count) {
    $this->save($this->tabla, ['ID' => $id, 'PadreID' => $parentId, 'Posicion' => $count]);

    $query = [
        'table' => $this->tabla,
        'field' => 'ID,Titulo,PadreID,Posicion',
        'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function updatePosiciones($ids) {
    $pos = 1;
    foreach ($ids as $id) {
      if ($id != 0) {
        $this->save($this->tabla, ['ID' => $id, 'Posicion' => $pos]);
      }
      $pos++;
    }
  }

  public function getRoles() {
    $query = [
        'table' => 'sys_roles',
        'field' => 'ID,Nombre',
        'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

}
