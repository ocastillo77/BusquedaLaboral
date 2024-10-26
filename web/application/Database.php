<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * Database.php
 * -------------------------------------
 */

class Database {

  private static $db;
  private $dbh;

  private function __construct() {
    $params = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHAR];

    try {
      $this->dbh = new PDO(DB_DRIVER . ":dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASS, $params);
    } catch (PDOException $e) {
      Helper::showError('<b>Error de conexión:</b> ' . $e->getMessage());
      self::$db = null;
    }
  }

  public static function connect() {
    if (!self::$db) {
      self::$db = new Database;
    }
    return self::$db;
  }

  public static function changeDB($database) {
    self::instance()->exec('USE ' . $database);
  }

  public function __call($method, $args = []) {
    $output = null;

    if ($this->dbh) {
      $output = call_user_func_array([$this->dbh, $method], $args);
    }

    return $output;
  }

  public static function __callStatic($method, $args = []) {
    $output = null;

    if ($this->dbh) {
      $db = self::instance();
      $output = call_user_func_array([$db->dbh, $method], $args);
    }

    return $output;
  }

  private function __clone() {
    
  }

}
