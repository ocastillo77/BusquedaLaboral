<?php

class productosModel extends Model
{

  private $tabla;

  public function __construct()
  {
    parent::__construct();

    $this->tabla = 'productos';
  }

  public function getConfigTabla()
  {
    $query = [
      'table' => 'sys_tables',
      'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function duplicateProducto($id)
  {
    $nameTable = $this->tabla;
    $tabla = DB_PREF . $nameTable;
    $listColumns = $this->listColumns($nameTable);
    $query = "INSERT INTO " . $tabla . " SELECT " . implode(',', $listColumns)
      . " FROM " . $tabla . " WHERE ID=" . $id;
//    echo $query;
    $newId = $this->sql($query, 'insert');

    return $newId;
  }

  public function duplicateGaleria($propId, $id)
  {
    $nameTable = 'archivos';
    $tabla = DB_PREF . $nameTable;
    $listColumns = $this->listColumns($nameTable, 'TablaID', $propId);
    $query = "INSERT INTO " . $tabla . " SELECT " . implode(',', $listColumns) . " FROM " . $tabla . " "
      . "WHERE Tabla='" . $this->tabla . "' AND TablaID=" . $id;
    $newId = $this->sql($query, 'insert');

    return $newId;
  }

  public function duplicateMeta($propId, $id)
  {
    $nameTable = 'meta';
    $tabla = DB_PREF . $nameTable;
    $listColumns = $this->listColumns($nameTable, 'TablaID', $propId);
    $query = "INSERT INTO " . $tabla . " SELECT " . implode(',', $listColumns) . " FROM " . $tabla . " "
      . "WHERE Tabla=$this->tabla AND TablaID=" . $id;
    $newId = $this->sql($query, 'insert');

    return $newId;
  }

  public function getProducto($id)
  {
    $query = [
      'table' => $this->tabla,
      'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function getURLProducto($id)
  {
    return $this->field($this->tabla, 'URL', 'ID=' . $id);
  }

  public function getFiliales()
  {
    $query = [
      'table' => 'secciones',
      'field' => 'ID,Titulo',
      'where' => 'Publico=1 AND EsFilial=1'
    ];
    return $this->all($query);
  }

  public function getDisponibilidad()
  {
    $query = [
      'table' => 'disponibilidad',
      'field' => 'ID,Nombre',
      'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function getGeneros()
  {
    $query = [
      'table' => 'generos',
      'field' => 'ID,Nombre',
      'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function getCondiciones()
  {
    $query = [
      'table' => 'condiciones',
      'field' => 'ID,Nombre',
      'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function getGrupoEtario()
  {
    $query = [
      'table' => 'grupoetario',
      'field' => 'ID,Nombre',
      'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function getMonedas()
  {
    $query = [
      'table' => 'monedas',
      'field' => 'ID,Nombre',
      'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function getMeta($id)
  {
    $query = [
      'table' => 'meta',
      'where' => "Tabla='" . $this->tabla . "' AND TablaID=" . $id
    ];
    return $this->where($query);
  }

  public function getGaleria($id)
  {
    $query = [
      'table' => 'archivos',
      'where' => "Tabla='" . $this->tabla . "' AND TablaID=" . $id,
      'order' => 'Posicion'
    ];
    return $this->all($query);
  }

  public function updateProducto($fields)
  {
    return $this->save($this->tabla, $fields);
  }

  public function updateMeta($meta, $id)
  {
    if ($meta['ID'] == 0) {
      unset($meta['ID']);
    }
    $meta['Tabla'] = $this->tabla;
    $meta['TablaID'] = $id;
    $this->save('meta', $meta);
  }

  public function deleteProductos($ids)
  {
    $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
    $this->delete('archivos', "Tabla='" . $this->tabla . "' AND TablaID IN (" . implode(',', $ids) . ")");
    $this->delete('meta', "Tabla='" . $this->tabla . "' AND TablaID IN (" . implode(',', $ids) . ")");
  }

  public function updateProductos($publico, $ids)
  {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

  public function getCategorias()
  {
    $query = [
      'table' => 'cateprod',
      'field' => 'ID, Nombre',
      'where' => 'Publico=1',
      'order' => 'Nombre'
    ];

    return $this->all($query);
  }

  public function getMarcas()
  {
    $query = [
      'table' => 'marcas',
      'field' => 'ID, Nombre',
      'where' => 'Publico=1',
      'order' => 'Nombre'
    ];

    return $this->all($query);
  }

  public function updateGaleria($galeria, $tablaId)
  {
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

  public function deleteItemGaleria($id)
  {
    return $this->delete('archivos', 'ID=' . $id);
  }

  public function updatePosiciones($ids)
  {
    $pos = 1;
    foreach ($ids as $id) {
      if ($id != 0) {
        $this->save('archivos', ['ID' => $id, 'Posicion' => $pos]);
      }
      $pos++;
    }
  }

}
