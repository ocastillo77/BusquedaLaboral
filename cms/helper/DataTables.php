<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * DataTables.php
 * -------------------------------------
 */

class DataTables {

  protected $db;
  private $sTable;
  private $aColumns;
  private $sIColumn;
  protected $sWhere;
  protected $sOrder;
  protected $callRow;
  protected $callAction;

  public function __construct($info = [], $callRow = null, $callAction = null) {
    $this->sIColumn = 'ID';
    $this->sTable = $info['table'];
    $this->aColumns = $info['columns'];
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
    if (isset($_GET['iSortCol_0'])) {
      $sOrder = "ORDER BY  ";
      for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
        if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
          $sOrder .= "`" . $this->aColumns[intval($_GET['iSortCol_' . $i])] . "` " .
            ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
        }
      }
      $sOrder = substr_replace($sOrder, '', -2);

      if ($sOrder == "ORDER BY") {
        $sOrder = '';
      }
    }

    if ($this->sOrder) {
      $sOrder = "ORDER BY " . $this->sOrder;
    }

    return $sOrder;
  }

  public function getFiltering() {
    $sWhere = (!empty($this->sWhere)) ? 'WHERE ' . $this->sWhere : '';

    if (isset($_GET['sSearch']) && $_GET['sSearch'] != '') {
      $sWhere = (empty($sWhere)) ? 'WHERE ' : ' AND ';

      $sWhere .= "(";
      for ($i = 0; $i < count($this->aColumns); $i++) {
        if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
          $sWhere .= "`" . $this->aColumns[$i] . "` LIKE '%" . filter_input(INPUT_GET, 'sSearch', FILTER_SANITIZE_URL) . "%' OR ";
        }
      }
      $sWhere = substr_replace($sWhere, '', -3);
      $sWhere .= ')';
    }

    for ($i = 0; $i < count($this->aColumns); $i++) {
      if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
        if ($sWhere == '') {
          $sWhere = "WHERE ";
        } else {
          $sWhere .= " AND ";
        }
        $sWhere .= "`" . $this->aColumns[$i] . "` LIKE '%" . filter_input(INPUT_GET, 'sSearch_' . $i, FILTER_SANITIZE_URL) . "%' ";
      }
    }
    return $sWhere;
  }

  public function getDataDisplay() {
    $output = [];

    $sQuery = "SELECT SQL_CALC_FOUND_ROWS `" . str_replace(" , ", " ", implode("`, `", $this->aColumns)) . "`
      FROM " . DB_PREF . $this->sTable . ' ' . $this->getFiltering() . ' ' . $this->getOrder() . ' '
      . $this->getLimit();

    $rResult = $this->db->sql($sQuery);

    if ($rResult) {
      foreach ($rResult as $aRow) {
        $row = [];

        foreach ($this->aColumns as $aColumn) {
          if ($this->callRow) {
            $field = call_user_func($this->callRow, $aColumn, $aRow[$aColumn]);

            if (!is_null($field)) {
              $row[] = $field;
            }
          }
        }

        if ($this->callAction) {
          $row[] = call_user_func($this->callAction, $aRow);
        }

        $output[] = $row;
      }
    }

    return $output;
  }

  public function totalDisplayRecords() {
    $where = $this->getFiltering();
    return $this->db->countTable($this->sTable , $where);
  }

  public function totalRecords() {
    return $this->db->countTable($this->sTable);
  }

  public function render() {
    $data = $this->getDataDisplay();

    $output = [
      'sEcho' => intval($_GET['sEcho']),
      'iTotalRecords' => $this->totalRecords(),
      'iTotalDisplayRecords' => $this->totalDisplayRecords(),
      'aaData' => $data
    ];

    return json_encode($output);
  }

}
