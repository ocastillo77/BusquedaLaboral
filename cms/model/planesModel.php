<?php

class planesModel extends Model
{

  private $tabla;

  public function __construct()
  {
    parent::__construct();

    $this->tabla = 'planes';
  }

  public function getConfigTabla()
  {
    $query = [
      'table' => 'sys_tables',
      'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getRegistro($id)
  {
    $query = [
      'table' => $this->tabla,
      'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function getCategorias()
  {
    $query = [
      'table' => 'categorias',
      'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function updateRegistro($fields)
  {
    return $this->save($this->tabla, $fields);
  }

  public function deleteRegistros($ids)
  {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function updateRegistros($publico, $ids)
  {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }
}
