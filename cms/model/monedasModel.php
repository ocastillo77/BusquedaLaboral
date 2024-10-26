<?php

class monedasModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'monedas';
  }
  
  public function getConfigTabla() {
    $query = [
        'table' => 'sys_tables',
        'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getMoneda($id) {
    $query = [
        'table' => $this->tabla,
        'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function updateMoneda($fields) {
    return $this->save($this->tabla, $fields);
  }

  public function deleteMonedas($ids) {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function updateMonedas($publico, $ids) {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

}
