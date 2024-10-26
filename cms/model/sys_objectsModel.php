<?php

class sys_objectsModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'sys_objects';
  }

  public function getElement($id) {
    $query = [
        'table' => $this->tabla,
        'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function updateElement($fields) {
    return $this->save($this->tabla, $fields);
  }

  public function deleteElements($ids) {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function updateElements($publico, $ids) {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

  public function getConfigTabla() {
    $query = [
        'table' => 'sys_tables',
        'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getTipos() {
    $query = [
        'table' => 'sys_typeob',
        'field' => 'ID,Nombre',
        'where' => "Publico=1"
    ];
    return $this->all($query);
  }

  public function getFormularios() {
    $query = [
        'table' => 'sys_forms',
        'field' => 'ID,Nombre',
        'where' => "Publico=1"
    ];
    return $this->all($query);
  }

  public function getPestanias() {
    $query = [
        'table' => 'sys_tabs',
        'field' => 'ID,Titulo',
        'where' => "Publico=1"
    ];
    return $this->all($query);
  }

  public function getSelectPos() {
    $query = [
        'table' => $this->tabla,
        'field' => 'ID,Titulo,Posicion',
        'where' => 'Publico=1',
        'order' => 'Posicion'
    ];

    return $this->all($query);
  }

}
