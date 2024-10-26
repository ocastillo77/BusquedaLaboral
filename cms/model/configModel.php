<?php

class configModel extends Model
{

  private $tabla;

  public function __construct()
  {
    parent::__construct();

    $this->tabla = 'config';
  }

  public function getConfigTabla()
  {
    $query = [
      'table' => 'sys_tables',
      'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getConfig($id)
  {
    $query = [
      'table' => $this->tabla,
      'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function updateConfig($fields)
  {
    return $this->save($this->tabla, $fields);
  }

  public function countConfig()
  {
    return $this->rowCount($this->tabla);
  }

  public function getPaises()
  {
    $query = [
      'table' => 'paises',
      'field' => 'ID,Nombre',
      'where' => 'Publico=1',
      'order' => 'Nombre'
    ];
    return $this->all($query);
  }

  public function getProvincias($paisId = false)
  {
    $pid = $paisId ? $paisId : 10;

    $query = [
      'table' => 'provincias',
      'field' => 'ID,Nombre',
      'where' => 'PaisID=' . $pid,
      'order' => 'Nombre'
    ];
    return $this->all($query);
  }

}
