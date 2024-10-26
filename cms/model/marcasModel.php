<?php

class marcasModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'marcas';
  }

  public function getConfigTabla() {
    $query = [
      'table' => 'sys_tables',
      'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getCategoria($id) {
    $query = [
      'table' => $this->tabla,
      'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function updateCategoria($fields) {
    return $this->save($this->tabla, $fields);
  }

  public function deleteCategorias($ids) {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function updateCategorias($publico, $ids) {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

  public function getSelectPos() {
    $query = [
      'table' => $this->tabla,
      'field' => 'ID,Nombre,Posicion',
      'where' => 'Publico=1',
      'order' => 'Posicion'
    ];
    return $this->all($query);
  }

  public function updatePositions($ids) {
    $pos = 1;
    foreach ($ids as $id) {
      if ($id != 0) {
        $this->save($this->tabla, ['ID' => $id, 'Posicion' => $pos]);
      }
      $pos++;
    }
  }

}
