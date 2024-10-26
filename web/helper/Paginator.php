<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * Paginator.php
 * -------------------------------------
 */

class Paginator
{

  public $totalPages;
  public $recordsPerPage = '12';
  public $affected_rows;
  public $pageId;
  public $offset;
  private $query;
  public $result;
  public $linksCountLimit = 4;
  public $debug = false;
  private $groupBy = '';
  private $orderBy = '';
  private $_registry;
  private $_db;

  public function __construct($pageID = 1, $query = '')
  {
    $this->_registry = Registry::getInstance();
    $this->_db = $this->_registry->_db;
    $this->pageId = intval($pageID);
    $this->query = $query;
    $orderbyPos = stripos($this->query, 'ORDER BY');

    if ($orderbyPos !== FALSE) {
      $this->orderBy = " " . substr($this->query, $orderbyPos);
      $this->query = substr($this->query, 0, $orderbyPos);
    }

    $groupbyPos = stripos($this->query, 'GROUP BY');
    if ($groupbyPos !== FALSE) {
      $this->groupBy = " " . substr($this->query, $groupbyPos);
      $this->query = substr($this->query, 0, $groupbyPos);
    }
  }

  private function getAffectedRows()
  {
    $pageQ = $this->query . $this->groupBy . $this->orderBy;
    $result = $this->_db->query($pageQ);

    if (!$result) {
      echo 'Error: ' . $pageQ;
    }

    return $result->rowCount();
  }

  public function paginate()
  {
    $this->offset = $this->getOffest();
    $this->affected_rows = $this->getAffectedRows();
    $this->totalPages = $this->getTotalPages();
    $this->totalPages = $this->totalPages == 0 ? 1 : $this->totalPages;
    //
    $pageQ = $this->query . $this->groupBy . $this->orderBy . " LIMIT " . $this->offset . " , " . $this->recordsPerPage . ";";
    $this->result = $this->_db->query($pageQ);

    if (!$this->result) {
      echo 'Error: ' . $pageQ;
    }

    return $this->result->fetchAll(PDO::FETCH_ASSOC);
  }

  private function getOffest()
  {
    return ($this->pageId - 1) * $this->recordsPerPage;
  }

  public function getTotalPages()
  {
    return ceil($this->affected_rows / $this->recordsPerPage);
  }

  public function getLinks()
  {
    $output = '<ul class="clearfix">';

    // Botón anterior (prev)
    if ($this->pageId > 1) {
      $prev = $this->pageId - 1;
      $output .= '<li class="prev"><a href="javascript:paginate(' . $prev . ')"><span><i class="fa fa-angle-left"></i></span></a></li>';
    }

    // Páginas anteriores
    $count = 0;
    for ($i = $this->pageId - 1; $i >= 1; $i--) {
      if ($count >= $this->linksCountLimit) {
        break;
      }

      $output .= '<li><a href="javascript:paginate(' . $i . ')">' . $i . '</a></li>';
      $count++;
    }

    // Página activa
    $output .= '<li class="active"><a href="javascript:;">' . $this->pageId . '</a></li>';

    // Páginas siguientes
    $count = 0;
    for ($i = $this->pageId + 1; $i <= $this->totalPages; $i++) {
      if ($count >= $this->linksCountLimit) {
        break;
      }

      $output .= '<li><a href="javascript:paginate(' . $i . ')">' . $i . '</a></li>';
      $count++;
    }

    // Botón para ir al final si hay más páginas
    if ($this->pageId + $this->linksCountLimit < $this->totalPages) {
      $output .= '<li><a href="javascript:;"><i class="fa fa-ellipsis-h"></i></a></li>';
    }

    // Última página
    if ($this->totalPages > $this->pageId + $this->linksCountLimit) {
      $output .= '<li><a href="javascript:paginate(' . $this->totalPages . ')">' . $this->totalPages . '</a></li>';
    }

    // Botón siguiente (next)
    if ($this->pageId < $this->totalPages) {
      $next = $this->pageId + 1;
      $output .= '<li class="next"><a href="javascript:paginate(' . $next . ')"><span><i class="fa fa-angle-right"></i></span></a></li>';
    }

    $output .= '</ul>';
    return $output;
  }
}
