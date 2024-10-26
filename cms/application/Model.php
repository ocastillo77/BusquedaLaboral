<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * Model.php
 * -------------------------------------
 */

class Model {

  private $_registry;
  protected $_db;

  public function __construct() {
    $this->_registry = Registry::getInstance();
    $this->_db = $this->_registry->_db;
  }

  public function create($info = []) {
    if (!empty($info['table'])) {
      $field = !empty($info['field']) ? $info['field'] : '*';
      $where = !empty($info['where']) ? "WHERE " . $info['where'] . " " : '';
      $order = !empty($info['order']) ? "ORDER BY " . $info['order'] . " " : '';
      $limit = !empty($info['limit']) ? "LIMIT " . $info['limit'] : '';
      $group = !empty($info['group']) ? "GROUP BY " . $info['group'] . " " : '';

      $table = DB_PREF . $info['table'];
      $query = "SELECT " . $field . " FROM " . $table . ' ' . $where . $group . $order . $limit;

      return $query;
    }
  }

  public function field($table, $field, $where) {
    $query = [
      'table' => $table,
      'field' => $field,
      'where' => $where
    ];

    return $this->where($query, true);
  }

  public function find($table, $id) {
    $query = [
      'table' => $table,
      'where' => 'ID=' . $id
    ];

    return $this->where($query);
  }

  public function where($info = [], $one = false) {
    $query = $this->create($info);

    try {
      $result = $this->_db->prepare($query);
      $result->execute();
      $row = $result->fetch(PDO::FETCH_ASSOC);
      return $one ? $row[$info['field']] : $row;
    } catch (PDOException $e) {
      Helper::showError('<b>Consulta:</b> ' . $query);
      throw new Exception($e->getMessage());
    }
  }

  public function all($info = array('table' => '', 'field' => '', 'where' => '', 'order' => '', 'limit' => '')) {
    $query = $this->create($info);

    try {
      $result = $this->_db->prepare($query);
      $result->execute();
      return $result ? $result->fetchAll(PDO::FETCH_ASSOC) : false;
    } catch (PDOException $e) {
      Helper::showError('<b>Consulta:</b> ' . $query);
      throw new Exception($e->getMessage());
    }
  }

  public function save($table, $attr = [], $id_name = 'ID') {
    $attributes = $this->matchColumns($table, $attr);

    if (isset($attributes[$id_name])) {
      $query = $this->getUpdate($table, $attributes, $id_name);
    } else {
      $query = $this->getInsert($table, $attributes);
    }

    try {
      $sth = $this->_db->prepare($query);
      $sth->execute($attributes);
      return $this->_db->lastInsertId();
    } catch (PDOException $e) {
      Helper::showError('<b>Consulta:</b> ' . $query);
      throw new Exception($e->getMessage());
    }
  }

  private function getInsert($table, $attributes = array()) {
    $keys = array_keys($attributes);
    $table = DB_PREF . $table;

    return "INSERT INTO " . $table .
      "(" . implode(",", $keys) . ")" .
      " VALUES(:" . implode(",:", $keys) . ")";
  }

  private function getUpdate($table, $attributes, $id_name) {
    $updates = '';
    foreach ($attributes as $key => $value) {
      $updates .= $key . '=:' . $key . ',';
    }

    $updates = rtrim($updates, ",");
    $table = DB_PREF . $table;

    return "UPDATE " . $table .
      " SET " . $updates .
      " WHERE " . $id_name . "=:" . $id_name;
  }

  public function update($table, $sets, $where) {
    $updates = '';
    foreach ($sets as $key => $value) {
      $updates .= $key . "='" . $value . "',";
    }

    $fields = rtrim($updates, ",");

    $table = DB_PREF . $table;
    $query = "UPDATE " . $table . " SET " . $fields . " WHERE " . $where;

    try {
      $sth = $this->_db->prepare($query);
      $sth->execute();
    } catch (PDOException $e) {
      Helper::showError('<b>Consulta:</b> ' . $query);
      throw new Exception($e->getMessage());
    }
  }

  public function delete($table, $where) {
    $table = DB_PREF . $table;
    $query = "DELETE FROM " . $table . " WHERE " . $where;

    try {
      $sth = $this->_db->prepare($query);
      $sth->execute();
    } catch (PDOException $e) {
      Helper::showError('<b>Consulta:</b> ' . $query);
      throw new Exception($e->getMessage());
    }
  }

  public function matchColumns($table, $attributes) {
    $result = [];
    $table = DB_PREF . $table;
    $sth = $this->_db->query('DESCRIBE ' . $table);

    if ($sth) {
      foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
        if (isset($attributes[$row['Field']])) {
          $result[$row['Field']] = $attributes[$row['Field']];
        }
      }
    }

    return $result;
  }

  public function listColumns($table, $field = '', $value = '') {
    $columns = [];
    $table = DB_PREF . $table;
    $sth = $this->_db->query('DESCRIBE ' . $table);

    if ($sth) {
      foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
        if ($row['Field'] == 'ID') {
          $columns[] = 'NULL';
        } else if ($row['Field'] == $field) {
          $columns[] = "'" . $value . "'";
        } else {
          $columns[] = $row['Field'];
        }
      }
    }

    return $columns;
  }

  public function countTable($table, $where = '', $field = '*') {
    $sWhere = !empty($where) ? " " . $where : '';

    $table = DB_PREF . $table;
    $query = "SELECT COUNT(" . $field . ") FROM " . $table . $sWhere;

    try {
      $result = $this->_db->query($query);
      return $result ? $result->fetchColumn() : 0;
    } catch (PDOException $e) {
      Helper::showError('<b>Consulta:</b> ' . $query);
      throw new Exception($e->getMessage());
    }
  }

  public function rowCount($table, $where = '') {
    $sWhere = !empty($where) ? " " . $where : '';
    $table = DB_PREF . $table;
    $query = "SELECT * FROM " . $table . $sWhere;

    try {
      $result = $this->_db->query($query);
      return $result ? $result->rowCount() : 0;
    } catch (PDOException $e) {
      Helper::showError('<b>Consulta:</b> ' . $query);
      throw new Exception($e->getMessage());
    }
  }

  public function alterTable($tab = '', $query = '') {
    $table = DB_PREF . $tab;
    $query = "ALTER TABLE " . $table . " " . $query;

    try {
      $this->_db->beginTransaction();
      $this->_db->exec($query);
      $this->_db->commit();
    } catch (PDOException $e) {
      Helper::showError('<b>Consulta:</b> ' . $query);
      throw new Exception($e->getMessage());
    }
  }

  public function truncateTable($tab = '') {
    $table = DB_PREF . $tab;
    $query = "TRUNCATE TABLE " . $table;

    try {
      $this->_db->beginTransaction();
      $this->_db->exec($query);
      $this->_db->commit();
    } catch (PDOException $e) {
      Helper::showError('<b>Consulta:</b> ' . $query);
      throw new Exception($e->getMessage());
    }
  }

  public function sql($query = '', $type = '') {
    try {
      $result = $this->_db->prepare($query);
      $result->execute();

      switch ($type) {
        case 'single':
          $result = $result->fetch(PDO::FETCH_ASSOC);
          break;
        case 'all':
          $result = $result->fetchAll(PDO::FETCH_ASSOC);
          break;
        case 'insert':
          $result = $this->_db->lastInsertId();
          break;
        case 'update':
          $result = $this->_db->lastInsertId();
          break;
        default:
          break;
      }

      return $result;
    } catch (PDOException $e) {
      Helper::showError('<b>Consulta:</b> ' . $query);
      throw new Exception($e->getMessage());
    }
  }

  public function showTables($db = DB_NAME) {
    $query = "SELECT TABLE_NAME AS Tabla "
      . "FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = '" . $db . "'";
    return $this->sql($query);
  }

}
