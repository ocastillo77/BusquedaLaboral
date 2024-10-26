<?php

class cateprodModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'cateprod';
  }

  public function getConfigTabla() {
    $query = [
      'table' => 'sys_tables',
      'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getFiliales() {
    $query = [
      'table' => 'secciones',
      'field' => 'ID,Titulo',
      'where' => 'Publico=1 AND EsFilial=1',
      'order' => 'Titulo'
    ];
    return $this->all($query);
  }

  public function getCateProd($id) {
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

  public function updateCateProd($fields) {
    return $this->save($this->tabla, $fields);
  }

  public function deleteCateProds($ids) {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function updateCateProds($publico, $ids) {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

  public function getFilialesCat($filialId) {
    $result = [];
    $query = [
      'table' => 'secciones',
      'field' => 'Titulo',
      'where' => 'FIND_IN_SET(ID, "' . $filialId . '")',
      'order' => 'Titulo'
    ];
    $rows = $this->all($query);

    if ($rows) {
      foreach ($rows as $item) {
        $result[] = $item['Titulo'];
      }
    }
    return count($result) > 0 ? implode(',', $result) : 'No Asignada';
  }

  public function getSelectPos() {
    $query = [
      'table' => $this->tabla,
      'field' => 'ID,Nombre,Posicion',
      'where' => 'Publico=1',
      'order' => 'Posicion'
    ];
    return $this->all($query);
  }

  public function updatePositions($ids) {
    $pos = 1;
    foreach ($ids as $id) {
      if ($id != 0) {
        $this->save($this->tabla, ['ID' => $id, 'Posicion' => $pos]);
      }
      $pos++;
    }
  }

}
