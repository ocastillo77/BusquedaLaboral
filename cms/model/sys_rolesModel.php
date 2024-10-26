<?php

class sys_rolesModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'sys_roles';
  }
  
  public function getConfigTabla() {
    $query = [
        'table' => 'sys_tables',
        'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getGrupo($id) {
    $query = [
        'table' => $this->tabla,
        'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function updateGrupo($fields) {
    return $this->save($this->tabla, $fields);
  }

  public function deleteGrupos($ids) {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function updateGrupos($publico, $ids) {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

}
