<?php

class sys_formsModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'sys_forms';
  }

  public function getForm($id) {
    $query = [
        'table' => $this->tabla,
        'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function updateForm($fields) {
    return $this->save($this->tabla, $fields);
  }

  public function deleteForms($ids) {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function updateForms($publico, $ids) {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

  public function getConfigTabla() {
    $query = [
        'table' => 'sys_tables',
        'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getTablas() {
    $query = [
        'table' => 'sys_tables',
        'field' => 'Nombre',
        'where' => "Publico=1"
    ];
    return $this->all($query);
  }

}
