<?php

class filemanagerModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'filemanager';
  }

  public function getConfigTabla() {
    $query = [
      'table' => 'sys_tables',
      'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function configTableById($id) {
    $query = [
      'table' => 'sys_tables',
      'where' => "ID='" . $id . "'"
    ];
    return $this->where($query);
  }

  public function getCategoria($id) {
    $query = [
      'table' => $this->tabla,
      'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function getImageTableId($tabla, $image) {
    $query = [
      'table' => $tabla,
      'where' => "Imagen='" . $image . "'"
    ];
    $row = $this->where($query);
    return $row ? $row['ID'] : 0;
  }

  public function getGaleria($tabla) {
    $query = [
      'table' => 'archivos',
      'where' => "Tabla='" . $tabla . "'",
      'order' => 'Posicion'
    ];
    return $this->all($query);
  }

  public function saveImageGallery($fields) {
    return $this->save('archivos', $fields);
  }

  public function updateCategoria($fields) {
    return $this->save($this->tabla, $fields);
  }

  public function deleteCategorias($ids) {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function updateCategorias($publico, $ids) {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

  public function deleteItemGaleria($id) {
    return $this->delete('archivos', 'ID=' . $id);
  }

}
