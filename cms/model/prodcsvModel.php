<?php

class prodcsvModel extends Model
{

  private $tabla;

  public function __construct()
  {
    parent::__construct();

    $this->tabla = 'prodcsv';
  }

  public function getConfigTabla()
  {
    $query = [
      'table' => 'sys_tables',
      'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getProducto($id)
  {
    $query = [
      'table' => $this->tabla,
      'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function getDisponibilidad($name)
  {
    $result = '';
    $query = [
      'table' => 'disponibilidad',
      'where' => "Clave LIKE '%" . strtolower($name) . "%'"
    ];
    $row = $this->where($query);

    if ($row) {
      $result = $row['ID'];
    }
    return $result;
  }

  public function getCondicion($name)
  {
    $result = '';
    $query = [
      'table' => 'condiciones',
      'where' => "Clave LIKE '%" . strtolower($name) . "%'"
    ];
    $row = $this->where($query);

    if ($row) {
      $result = $row['ID'];
    }
    return $result;
  }

  public function getGenero($name)
  {
    $result = '';
    $query = [
      'table' => 'generos',
      'where' => "Clave LIKE '%" . strtolower($name) . "%'"
    ];
    $row = $this->where($query);

    if ($row) {
      $result = $row['ID'];
    }
    return $result;
  }

  public function getGrupoEtario($name)
  {
    $result = '';
    $query = [
      'table' => 'grupoetario',
      'where' => "Clave LIKE '%" . strtolower($name) . "%'"
    ];
    $row = $this->where($query);

    if ($row) {
      $result = $row['ID'];
    }
    return $result;
  }

  public function getCateProd($name)
  {
    $result = false;
    $query = [
      'table' => 'cateprod',
      'where' => "LOWER(Nombre) LIKE '%" . strtolower($name) . "%'"
    ];
    $row = $this->where($query);

    if ($row) {
      $result = $row['ID'];
    } else {
      $fields['Nombre'] = $name;
      $fields['URL'] = Helper::slug($name);
      $result = $this->save('cateprod', $fields);
    }
    return $result;
  }

  public function getMarca($name)
  {
    $result = false;
    $query = [
      'table' => 'marcas',
      'where' => "LOWER(Nombre) LIKE '%" . strtolower($name) . "%'"
    ];
    $row = $this->where($query);

    if ($row) {
      $result = $row['ID'];
    } else {
      $fields['Nombre'] = $name;
      $fields['URL'] = Helper::slug($name);
      $result = $this->save('marcas', $fields);
    }
    return $result;
  }

  public function getFilial($name)
  {
    $result = false;
    $query = [
      'table' => 'secciones',
      'where' => "LOWER(Titulo) LIKE '%" . strtolower($name) . "%'"
    ];
    $row = $this->where($query);

    if ($row) {
      $result = $row['ID'];
    } else {
      $fields['Titulo'] = $name;
      $fields['URL'] = Helper::slug($name);
      $result = $this->save('secciones', $fields);
    }
    return $result;
  }

  public function getMoneda($name)
  {
    $query = [
      'table' => 'monedas',
      'where' => "UPPER(Codigo) LIKE '%" . strtoupper($name) . "%'"
    ];
    return $this->where($query);
  }

  public function saveProducto($fields)
  {
    if (count($fields) > 0) {
      $this->save('productos', $fields);
    }
  }

  public function updateProducto($fields)
  {
    return $this->save($this->tabla, $fields);
  }

  public function deleteProductos($ids)
  {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function updateProductos($publico, $ids)
  {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

}
