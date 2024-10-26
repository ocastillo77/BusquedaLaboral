<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * DataTablesJoin.php
 * -------------------------------------
 */

class DataTablesJoin {

  protected $db;
  private $aTables;
  private $aColumns;
  private $aColAlias;
  private $aJoinIds;
  private $sIColumn;
  protected $sWhere;
  protected $sOrder;
  protected $callRow;
  protected $callAction;

  public function __construct($info = [], $callRow = null, $callAction = null) {
    $this->sIColumn = 'ID';
    $this->aTables = $info['table'];
    $this->aColumns = array_keys($info['columns']);
    $this->aColAlias = array_values($info['columns']);
    $this->aJoinIds = $info['joins'];
    $this->sWhere = $info['where'];
    $this->sOrder = $info['order'];
    $this->callRow = $callRow;
    $this->callAction = $callAction;
    $this->db = new Model;
  }

  public function getLimit() {
    $sLimit = '';

    if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
      $max_length = intval($_GET['iDisplayLength']);
      $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " . $max_length;
    }

    return $sLimit;
  }

  public function getOrder() {
    $sOrder = '';
    $aOrder = [];

    if (isset($_GET['iSortCol_0'])) {
      for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
        if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
          $aOrder[] = $this->aColumns[intval($_GET['iSortCol_' . $i])] .
            ($_GET['sSortDir_' . $i] === 'asc' ? ' ASC' : ' DESC');
        }
      }
    }

    if (!empty($this->sOrder)) {
      $aOrder[] = $this->sOrder;
    }

    if (count($aOrder) > 0) {
      $sOrder = "ORDER BY " . implode(', ', $aOrder);
    }

    return $sOrder;
  }

  public function getFiltering() {
    $sLikes = '';

    if (isset($_GET['sSearch']) && $_GET['sSearch'] != '') {
      $aLikes = [];

      for ($i = 0; $i < count($this->aColumns); $i++) {
        if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
          $aLikes[] = $this->aColumns[$i] . " LIKE '%" . $_GET['sSearch'] . "%'";
        }
      }

      $sLikes .= count($aLikes) > 0 ? '(' . implode(' OR ', $aLikes) . ')' : '';
    }

    $sWhere = '';

    if (!empty($this->sWhere)) {
      $sWhere = 'WHERE ' . $this->sWhere;
      $sWhere .= (!empty($sLikes)) ? ' AND ' . $sLikes : '';
    } else {
      $sWhere = (!empty($sLikes)) ? 'WHERE ' . $sLikes : '';
    }

    return $sWhere;
  }

  public function getInnerJoins() {
    $strJoins = '';
    $i = 0;
    foreach ($this->aTables as $key => $value) {
      if ($i > 0) {
        $value = DB_PREF . $value;
        $strJoins .= $this->aJoinIds[$i - 1][0] . " JOIN " . $value . " " . $key . " ON "
          . $this->aJoinIds[$i - 1][1] . " ";
      }
      $i++;
    }
    return $strJoins;
  }

  public function getColumnsJoin() {
    $aColumnsAlias = [];

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

  public function getDataDisplay() {
    $output = [];
    $rResult = $this->getAllQuery();

    if ($rResult) {
      foreach ($rResult as $aRow) {
        $row = [];
        $i = 0;
        foreach ($this->aColumns as $aColumn) {
          if ($this->aColAlias[$i] == '') {
            $aColJoin = explode('.', $aColumn);
            $sColJoin = $aColJoin[1];
          } else {
            $sColJoin = $this->aColAlias[$i];
          }

          if ($this->callRow) {
            $field = call_user_func($this->callRow, $sColJoin, $aRow[$sColJoin]);

            if (!is_null($field)) {
              $row[] = $field;
            }
          }
          $i++;
        }

        if ($this->callAction) {
          $row[] = call_user_func($this->callAction, $aRow);
        }

        $output[] = $row;
      }
    }

    return $output;
  }

  public function getAllQuery($developer = false) {
    $table = $this->aTables['t1'];
    $table = DB_PREF . $table;

    $sQuery = "SELECT SQL_CALC_FOUND_ROWS "
      . str_replace(" , ", " ", $this->getColumnsJoin()) . " FROM "
      . $table . ' t1 '
      . $this->getInnerJoins() . ' '
      . $this->getFiltering() . ' '
      . $this->getOrder() . ' '
      . $this->getLimit();
    echo $developer ? $sQuery : '';
    return $this->db->sql($sQuery);
  }

  public function totalDisplayRecords() {
    $where = $this->getInnerJoins() . ' ' . $this->getFiltering();
    return $this->db->countTable($this->aTables['t1'] . ' t1', $where);
  }

  public function totalRecords() {
    return $this->db->countTable($this->aTables['t1']);
  }

  public function render() {
    $data = $this->getDataDisplay();

    $output = [
      'sEcho' => isset($_GET['sEcho']) ? intval($_GET['sEcho']) : 0,
      'iTotalRecords' => $this->totalRecords(),
      'iTotalDisplayRecords' => $this->totalDisplayRecords(),
      'aaData' => $data
    ];

    return json_encode($output);
  }

}
