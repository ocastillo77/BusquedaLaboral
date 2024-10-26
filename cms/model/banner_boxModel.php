<?php

class banner_boxModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'banner_box';
  }

  public function getConfigTabla() {
    $query = [
        'table' => 'sys_tables',
        'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getPublicidad($id) {
    $query = [
        'table' => $this->tabla,
        'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function getCategoria($id) {
    $query = [
        'table' => 'catbanner',
        'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function updatePublicidad($fields) {
    return $this->save($this->tabla, $fields);
  }

  public function deletePublicidades($ids) {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function updatePublicidades($publico, $ids) {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

  public function deleteItemGaleria($id) {
    return $this->delete('archivos', 'ID=' . $id);
  }

  public function countPublicidades() {
    return $this->rowCount($this->tabla);
  }

  public function getCategorias() {
    $query = [
        'table' => 'catbanner',
        'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function getSelectPos($categoriaId = false) {
    $where = $categoriaId ? ' AND CategoriaID=' . $categoriaId : '';
    $query = [
        'table' => $this->tabla,
        'field' => 'ID,Titulo,Posicion',
        'where' => 'Publico=1' . $where,
        'order' => 'Posicion'
    ];
    return $this->all($query);
  }

  public function getSelectPosAct($id, $categoriaId) {
    $result = false;
    $query = [
        'table' => $this->tabla,
        'field' => 'ID,Titulo,Posicion',
        'where' => 'Publico=1 AND CategoriaID=' . $categoriaId,
        'order' => 'Posicion'
    ];
    $rows = $this->all($query);

    if ($rows) {
      foreach ($rows as $item) {
        if ($item['ID'] != $id) {
          $result[] = $item;
        }
      }
    }

    return $result;
  }

  public function updateParentPos($id, $categoriaId, $count) {
    $this->save($this->tabla, ['ID' => $id, 'CategoriaID' => $categoriaId, 'Posicion' => $count]);

    $query = [
        'table' => $this->tabla,
        'field' => 'ID,Titulo,CategoriaID,Posicion',
        'where' => 'ID=' . $id
    ];

    return $this->where($query);
  }

  public function updatePosiciones($ids) {
    $pos = 1;
    foreach ($ids as $id) {
      if ($id != 0) {
        $this->save($this->tabla, ['ID' => $id, 'Posicion' => $pos]);
      }
      $pos++;
    }
  }

}
