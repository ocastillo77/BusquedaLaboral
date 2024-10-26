<?php

class donacionesModel extends Model
{

  private $tabla;

  public function __construct()
  {
    parent::__construct();

    $this->tabla = 'donaciones';
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

  public function updateRegistro($fields)
  {
    return $this->save('donaciones', $fields);
  }

  public function deleteRegistros($ids)
  {
    return $this->delete('donaciones', "ID IN (" . implode(',', $ids) . ")");
  }

  public function updateRegistros($publico, $ids)
  {
    return $this->update('donaciones', ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

  public function getDonadores()
  {
    $query = [
      'table' => 'usuarios',
      'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function getFormasPago()
  {
    $query = [
      'table' => 'forma_pago',
      'where' => 'Publico=1',
      'order' => 'Nombre'
    ];
    return $this->all($query);
  }

  public function getDepartamentos()
  {
    $query = [
      'table' => 'departamentos',
      'order' => 'Nombre'
    ];
    return $this->all($query);
  }

  public function getDepartamentosByID($provId)
  {
    $query = [
      'table' => 'departamentos',
      'field' => 'ID, Nombre',
      'where' => 'ProvinciaID=' . $provId,
      'order' => 'Nombre'
    ];

    return $this->all($query);
  }

}
