<?php

class news_emailModel extends Model
{

  private $tabla;

  public function __construct()
  {
    parent::__construct();

    $this->tabla = 'news_email';
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
    return $this->save('news_email', $fields);
  }

  public function deleteRegistros($ids)
  {
    return $this->delete('news_email', "ID IN (" . implode(',', $ids) . ")");
  }

  public function updateRegistros($publico, $ids)
  {
    return $this->update('news_email', ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

  public function getCategorias()
  {
    $query = [
      'table' => 'news_group',
      'where' => 'Publico=1',
      'order' => 'Nombre'
    ];
    return $this->all($query);
  }

}
