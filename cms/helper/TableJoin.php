<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * TableJoin.php
 * -------------------------------------
 */

class TableJoin {

  protected $db;
  private $aTables;
  private $aColAlias;
  private $aColumns;
  private $aJoinIds;
  private $where;
  private $group;
  private $order;
  private $limit;

  public function __construct($info = []) {
    $this->aTables = $info['table'];
    $this->aColumns = isset($info['columns']) ? array_keys($info['columns']) : [];
    $this->aColAlias = isset($info['columns']) ? array_values($info['columns']) : [];
    $this->aJoinIds = isset($info['joins']) ? $info['joins'] : [];
    $this->where = !empty($info['where']) ? $info['where'] : '';
    $this->group = !empty($info['group']) ? $info['group'] : '';
    $this->order = !empty($info['order']) ? $info['order'] : '';
    $this->limit = !empty($info['limit']) ? $info['limit'] : '';

    $this->db = new Model;
  }

  public function getWhere() {
    return $this->where ? " WHERE " . $this->where : '';
  }

  public function getGroup() {
    return $this->group ? " GROUP BY " . $this->group : '';
  }

  public function getOrder() {
    return $this->order ? " ORDER BY " . $this->order : '';
  }

  public function getLimit() {
    return $this->limit ? " LIMIT " . $this->limit : '';
  }

  public function getInnerJoins() {
    $strJoins = '';

    $i = 0;
    foreach ($this->aTables as $key => $value) {
      if ($i > 0) {
        $strJoins .= $this->aJoinIds[$i - 1][0] . " JOIN " . DB_PREF . $value . " " . $key . " ON "
                . $this->aJoinIds[$i - 1][1] . " ";
      }

      $i++;
    }

    return $strJoins;
  }

  public function getColumnsJoin() {
    $aColumnsAlias = array();

    if (count($this->aColAlias) > 0) {
      for ($i = 0; $i < sizeof($this->aColAlias); $i++) {
        if (!empty($this->aColAlias[$i])) {
          $aColumnsAlias[] = $this->aColumns[$i] . ' as ' . $this->aColAlias[$i];
        } else {
          $aColumnsAlias[] = $this->aColumns[$i];
        }
      }
    }

    return implode(", ", $aColumnsAlias);
  }

  public function strQuery() {
    return "SELECT " . str_replace(" , ", " ", $this->getColumnsJoin())
            . " FROM " . DB_PREF . $this->aTables['t1'] . ' t1 '
            . $this->getInnerJoins() . ' '
            . $this->getWhere() . ' '
            . $this->getGroup() . ' '
            . $this->getOrder() . ' '
            . $this->getLimit();
  }

  public function resultSet($type = 'all', $developer = false) {
    $query = $this->strQuery();

    if ($developer) {
      Helper::showError('<b>Consulta:</b> ' . $query);
    }
    return $this->db->sql($query, $type);
  }

}
