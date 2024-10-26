<?php

class exportcsvModel extends Model
{

  private $tabla;

  public function __construct()
  {
    parent::__construct();

    $this->tabla = 'exportcsv';
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

  public function getProductosCSV($filialId, $fechaIni = false, $fechaFin = false)
  {
    $aWhere[] = 't1.Publico=1';

    $info['table'] = [
      't1' => 'productos',
      't2' => 'marcas',
      't3' => 'cateprod',
      't4' => 'monedas',
      't5' => 'disponibilidad',
      't6' => 'condiciones',
      't7' => 'generos',
      't8' => 'grupoetario',
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Nombre' => 'Marca',
      't3.Nombre' => 'Categoria',
      't4.Codigo' => 'Moneda',
      't5.Clave' => 'Disponible',
      't6.Clave' => 'Condicion',
      't7.Clave' => 'Genero',
      't8.Clave' => 'GEtario',
    ];

    $info['joins'] = [
      ['LEFT', 't1.MarcaID=t2.ID'],
      ['LEFT', 't1.CategoriaID=t3.ID'],
      ['LEFT', 't1.MonedaID=t4.ID'],
      ['LEFT', 't1.DisponibleID=t5.ID'],
      ['LEFT', 't1.CondicionID=t6.ID'],
      ['LEFT', 't1.GeneroID=t7.ID'],
      ['LEFT', 't1.GrupoID=t8.ID'],
    ];

    if ($filialId) {
      $aWhere[] = "t1.FilialID='" . $filialId . "'";
    }
    if ($fechaIni && $fechaFin) {
      $aWhere[] = "DATE_FORMAT(t1.TimeUpdate, '%Y-%m-%d') BETWEEN '" . $fechaIni . "' AND '" . $fechaFin . "'";
    }

    $info['where'] = implode(' AND ', $aWhere);
    $info['order'] = 't1.TimeCreate DESC';
    $data = new TableJoin($info);
    return $data->resultSet('all');
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

  public function getFilial($id)
  {
    $query = [
      'table' => 'secciones',
      'field' => 'URL',
      'where' => "ID=" . $id
    ];

    $row = $this->where($query);
    return $row ? $row['URL'] : '';
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

  public function getFiliales()
  {
    $query = [
      'table' => 'secciones',
      'field' => 'ID,Titulo',
      'where' => 'Publico=1 AND EsFilial=1',
      'order' => 'Titulo'
    ];
    return $this->all($query);
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
