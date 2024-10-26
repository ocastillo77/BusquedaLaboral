<?php

class banner_topModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'banner_top';
  }

  public function getConfigTabla() {
    $query = [
        'table' => 'sys_tables',
        'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getBanner($id) {
    $query = [
        'table' => $this->tabla,
        'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function updateBanner($fields) {
    $id = $this->save($this->tabla, $fields);
    return ($id) ? $id : false;
  }

  public function deleteBanners($ids) {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function deleteItemGaleria($id) {
    return $this->delete('archivos', "ID='" . $id . "'");
  }

  public function updateBanners($publico, $ids) {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

  public function countBanners() {
    return $this->rowCount($this->tabla);
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
