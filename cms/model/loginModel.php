<?php

class loginModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'sys_users';
  }

  public function verifyCookie() {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['key_cookie'])) {
      if ($_COOKIE['user_id'] != '' || $_COOKIE['key_cookie'] != '') {
        $query = [
            'table' => $this->tabla,
            'where' => "ID='" . $_COOKIE['user_id'] . "' AND KeyCookie='" . $_COOKIE['key_cookie']
            . "' AND KeyCookie!=''"
        ];
        return $this->where($query);
      }
    }
    return false;
  }

  public function getUser($usuario, $password) {
    $query = [
        'table' => $this->tabla,
        'where' => "Usuario='" . $usuario . "' AND Contrasenia='"
        . Hash::getHash('sha1', $password, HASH_KEY) . "'"
    ];
    return $this->where($query);
  }

  public function saveAccess($fields) {
    $this->save($this->tabla, $fields);
  }

}
