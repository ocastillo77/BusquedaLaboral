<?php

class plantillasModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'plantillas';
  }
  
  public function getConfigTabla() {
    $query = [
        'table' => 'sys_tables',
        'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getPlantilla($id) {
    $query = [
        'table' => $this->tabla,
        'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function updatePlantilla($fields) {
    return $this->save($this->tabla, $fields);
  }

  public function deletePlantillas($ids) {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function updatePlantillas($publico, $ids) {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

}
