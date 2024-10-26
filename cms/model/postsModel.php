<?php

class postsModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'posts';
  }

  public function getConfigTabla() {
    $query = [
        'table' => 'sys_tables',
        'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getPost($id) {
    $query = [
        'table' => $this->tabla,
        'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function getURLPost($id) {
    return $this->field($this->tabla, 'URL', 'ID=' . $id);
  }

  public function getMeta($id) {
    $query = [
        'table' => 'meta',
        'where' => "Tabla='" . $this->tabla . "' AND TablaID=" . $id
    ];
    return $this->where($query);
  }

  public function getImagenParrafo($id) {
    return $this->field('parrafos', 'Imagen', "ID='" . $id . "'");
  }

  public function getParrafos($id) {
    $query = [
        'table' => 'parrafos',
        'where' => "Tabla='" . $this->tabla . "' AND TablaID=" . $id,
        'order' => 'Posicion'
    ];
    return $this->all($query);
  }

  public function getGaleria($id) {
    $query = [
        'table' => 'archivos',
        'where' => "Tabla='" . $this->tabla . "' AND TablaID=" . $id,
        'order' => 'Posicion'
    ];
    return $this->all($query);
  }

  public function updatePost($fields) {
    return $this->save($this->tabla, $fields);
  }

  public function updateMeta($meta, $tablaId) {
    if ($meta['ID'] == 0) {
      unset($meta['ID']);
      $meta['Tabla'] = $this->tabla;
      $meta['TablaID'] = $tablaId;
    }
    $this->save('meta', $meta);
  }

  public function updateParrafos($parrafos, $tablaId) {
    $i = 1;
    foreach ($parrafos as $item) {
      if ($item['ID'] == 0) {
        unset($item['ID']);
        $item['Tabla'] = $this->tabla;
        $item['TablaID'] = $tablaId;
        $item['Posicion'] = $i;
      }
      $this->save('parrafos', $item);
      $i++;
    }
  }

  public function updateGaleria($galeria, $tablaId) {
    $i = 1;
    foreach ($galeria as $item) {
      if ($item['ID'] == 0) {
        unset($item['ID']);
        $item['Tabla'] = $this->tabla;
        $item['TablaID'] = $tablaId;
        $item['Posicion'] = $i;
      }
      $this->save('archivos', $item);
      $i++;
    }
  }

  public function deletePosts($ids) {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function deleteItemGaleria($id) {
    return $this->delete('archivos', 'ID=' . $id);
  }

  public function deleteParrafo($id) {
    return $this->delete('parrafos', 'ID=' . $id);
  }

  public function updatePosts($type, $ids) {
    return $this->update($this->tabla, ['Publico' => $type], "ID IN (" . implode(',', $ids) . ")");
  }

  public function getCategorias() {
    $query = [
        'table' => 'categorias',
        'where' => 'Publico=1',
        'order' => 'Nombre'
    ];
    return $this->all($query);
  }

}
