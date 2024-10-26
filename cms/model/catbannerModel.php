<?php

class catbannerModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'catbanner';
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

  public function updateCategorias($type, $ids) {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }
  
  public function getConfigTabla() {
    $query = [
        'table' => 'sys_tables',
        'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

}
