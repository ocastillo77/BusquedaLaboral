<?php

class sys_usersModel extends Model
{

  private $tabla;

  public function __construct()
  {
    parent::__construct();

    $this->tabla = 'sys_users';
  }

  public function getConfigTabla()
  {
    $query = [
      'table' => 'sys_tables',
      'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getUser($id)
  {
    $query = [
      'table' => $this->tabla,
      'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function getContrasenia($id)
  {
    $query = [
      'table' => $this->tabla,
      'field' => 'Contrasenia',
      'where' => 'ID=' . $id
    ];

    $result = $this->where($query);
    return $result ? $result['Contrasenia'] : '';
  }

  public function getRol($id)
  {
    $query = [
      'table' => 'sys_roles',
      'field' => 'Nombre',
      'where' => 'ID=' . $id
    ];

    $result = $this->where($query);
    return $result ? $result['Nombre'] : '';
  }

  public function getRoles()
  {
    $query = [
      'table' => 'sys_roles',
      'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function checkEmail()
  {
    $id = Session::get('user_id');
    $email = Session::get('email');

    $query = [
      'table' => $this->tabla,
      'where' => "ID!=" . $id . " AND Email='" . $email . "'"
    ];
    return $this->where($query);
  }

  public function checkUser()
  {
    $id = Session::get('user_id');
    $user = Session::get('user');

    $query = [
      'table' => $this->tabla,
      'where' => "ID!=" . $id . " AND Usuario='" . $user . "'"
    ];
    return $this->where($query);
  }

  public function updateUser($fields)
  {
    if (!empty($fields['Contrasenia'])) {
      $fields['Contrasenia'] = Hash::getHash('sha1', $fields['Contrasenia'], HASH_KEY);
    } else {
      unset($fields['Contrasenia']);
    }
    return $this->save($this->tabla, $fields);
  }
  
  public function deleteUsuarios($ids) {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function updateUsuarios($publico, $ids) {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

}
