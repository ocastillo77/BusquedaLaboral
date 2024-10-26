<?php

class seccionesModel extends Model
{

  private $tabla;

  public function __construct()
  {
    parent::__construct();

    $this->tabla = 'secciones';
  }

  public function getSeccion($id)
  {
    $query = [
      'table' => $this->tabla,
      'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function getConfigTabla()
  {
    $query = [
      'table' => 'sys_tables',
      'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getMeta($id)
  {
    $query = [
      'table' => 'meta',
      'where' => "Tabla='" . $this->tabla . "' AND TablaID=" . $id
    ];
    return $this->where($query);
  }

  public function getImagenParrafo($id)
  {
    return $this->field('parrafos', 'Imagen', "ID='" . $id . "'");
  }

  public function getParrafos($id)
  {
    $query = [
      'table' => 'parrafos',
      'where' => "Tabla='" . $this->tabla . "' AND TablaID=" . $id,
      'order' => 'Posicion'
    ];
    return $this->all($query);
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

  public function updateSeccion($fields)
  {
    return $this->save($this->tabla, $fields);
  }

  public function updateMeta($meta, $tablaId)
  {
    if ($meta['ID'] == 0) {
      unset($meta['ID']);
      $meta['Tabla'] = $this->tabla;
      $meta['TablaID'] = $tablaId;
    }
    $this->save('meta', $meta);
  }

  public function updateParrafos($parrafos, $tablaId)
  {
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

  public function deleteSecciones($ids)
  {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function deleteItemGaleria($id)
  {
    return $this->delete('archivos', 'ID=' . $id);
  }

  public function deleteParrafo($id)
  {
    return $this->delete('parrafos', 'ID=' . $id);
  }

  public function updateSecciones($type, $ids)
  {
    return $this->update($this->tabla, ['Publico' => $type], "ID IN (" . implode(',', $ids) . ")");
  }

  public function getNivelSeccion($publico, $parent)
  {
    $query = [
      'table' => $this->tabla,
      'where' => 'Publico=' . $publico . ' AND PadreID=' . $parent
    ];
    return $this->all($query);
  }

  public function getSelectPos($id = 0, $parentId = 0)
  {
    $query = [
      'table' => $this->tabla,
      'campo' => 'ID,Titulo,Posicion,PadreID',
      'where' => 'Publico=1 AND PadreID=' . $parentId,
      'order' => 'Posicion'
    ];

    return $this->all($query);
  }

  public function getSelectSec()
  {
    $query = [
      'table' => $this->tabla,
      'where' => 'Publico=1 AND PadreID=0',
      'order' => 'Posicion'
    ];
    return $this->all($query);
  }

  public function getTables()
  {
    $query = [
      'table' => 'sys_tables',
      'order' => 'Nombre'
    ];
    return $this->all($query);
  }

  public function selectPlantillas()
  {
    $query = [
      'table' => 'plantillas',
      'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function reorderParentPrev($id, $parentAnt)
  {
    $query = [
      'table' => $this->tabla,
      'field' => 'ID',
      'where' => 'Publico=1 AND ID!=' . $id . ' AND PadreID=' . $parentAnt,
      'order' => 'Posicion'
    ];
    $rows = $this->all($query);

    if ($rows) {
      $pos = 1;
      foreach ($rows as $item) {
        $fields['ID'] = $item['ID'];
        $fields['Posicion'] = $pos;

        $this->save($this->tabla, $fields);
        $pos++;
      }
    }
  }

  public function getItemsParent($parentId)
  {
    $query = [
      'table' => $this->tabla,
      'field' => 'ID,Titulo,Posicion,PadreID',
      'where' => 'Publico=1 AND PadreID=' . $parentId,
      'order' => 'Posicion'
    ];
    return $this->all($query);
  }

  public function updateParentPos($id, $parentId, $pos)
  {
    $fields['ID'] = $id;
    $fields['PadreID'] = $parentId;
    $fields['Posicion'] = $pos;
    $this->save($this->tabla, $fields);
  }

  public function getSeccionById($id)
  {
    $query = [
      'table' => $this->tabla,
      'field' => 'ID,Titulo,PadreID,Posicion',
      'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function updatePosiciones($ids)
  {
    $pos = 1;
    foreach ($ids as $id) {
      if ($id != 0) {
        $this->save($this->tabla, ['ID' => $id, 'Posicion' => $pos]);
      }
      $pos++;
    }
  }

}
