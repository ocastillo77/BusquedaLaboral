<?php

class cateaccesModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'cateacces';
  }

  public function getConfigTabla() {
    $query = [
        'table' => 'sys_tables',
        'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getCateAccesorio($id) {
    $query = [
        'table' => $this->tabla,
        'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function getCategorias($categoriaId = false) {
    $where = $categoriaId ? ' AND ID!=' . $categoriaId : '';
    $query = [
        'table' => $this->tabla,
        'where' => 'Publico=1' . $where
    ];
    return $this->all($query);
  }

  public function updateCateAccesorio($fields) {
    return $this->save($this->tabla, $fields);
  }

  public function deleteCateAccesorios($ids) {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function updateCateAccesorios($publico, $ids) {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

}
