<?php

class usuariosModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'usuarios';
  }

  public function getConfigTabla() {
    $query = [
      'table' => 'sys_tables',
      'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getUser($id) {
    $query = [
      'table' => $this->tabla,
      'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function updateUser($fields) {
    return $this->save('usuarios', $fields);
  }

  public function deleteUsers($ids) {
    return $this->delete('usuarios', "ID IN (" . implode(',', $ids) . ")");
  }

  public function updateUsers($publico, $ids) {
    return $this->update('usuarios', ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

  public function getPaises() {
    $query = [
      'table' => 'paises',
      'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function getProvincias() {
    $query = [
      'table' => 'provincias',
      'order' => 'Nombre'
    ];
    return $this->all($query);
  }

  public function getDepartamentos() {
    $query = [
      'table' => 'departamentos',
      'order' => 'Nombre'
    ];
    return $this->all($query);
  }

  public function getDepartamentosByID($provId) {
    $query = [
      'table' => 'departamentos',
      'field' => 'ID, Nombre',
      'where' => 'ProvinciaID=' . $provId,
      'order' => 'Nombre'
    ];

    return $this->all($query);
  }

}
