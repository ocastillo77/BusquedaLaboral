<?php

class sys_tablesModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'sys_tables';
  }

  public function getConfigTabla() {
    $query = [
        'table' => $this->tabla,
        'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getTable($id) {
    $query = [
        'table' => $this->tabla,
        'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function updateTable($fields) {
    return $this->save($this->tabla, $fields);
  }

  public function getAllTables($id = false) {
    $result = [];
    $query = [
        'table' => $this->tabla,
        'field' => 'Nombre',
        'where' => $id ? 'ID!=' . $id : ''
    ];

    $info = $this->all($query);

    if ($info) {
      foreach ($info as $item) {
        $result[] = $item['Nombre'];
      }
    }

    return $result;
  }

}
