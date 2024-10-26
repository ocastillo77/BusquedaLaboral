<?php

class redesModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'redes';
  }
  
  public function getConfigTabla() {
    $query = [
        'table' => 'sys_tables',
        'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getRed($id) {
    $query = [
        'table' => $this->tabla,
        'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function updateRed($fields) {
    return $this->save($this->tabla, $fields);
  }

  public function deleteRedes($ids) {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function updateRedes($type, $ids) {
    return $this->update($this->tabla, ['Publico' => $type], "ID IN (" . implode(',', $ids) . ")");
  }

}
