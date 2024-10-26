<?php

class homeModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'sys_tracking';
  }

  public function getTotalVisitas() {
    return $this->rowCount($this->tabla);
  }

  public function getVisitasSemana() {
    /*
     * CONSULTA SEMANA
     * ---------------
     * SELECT Fecha, COUNT(IP) as Cantidad 
     * FROM aws_sys_tracking 
     * WHERE Fecha BETWEEN SUBDATE(NOW(),WEEKDAY(NOW())) AND ADDDATE(NOW(),6-WEEKDAY(NOW())) 
     * GROUP BY Fecha
     */

    $query = [
        'table' => $this->tabla,
        'field' => 'DAY(Fecha) as Dia, '
        . 'MONTH(Fecha) as Mes, YEAR(Fecha) as Anio, COUNT(IP) as Cantidad',
        'where' => 'Fecha BETWEEN SUBDATE(NOW(),WEEKDAY(NOW())) AND ADDDATE(NOW(),6-WEEKDAY(NOW()))',
        'group' => 'Fecha'
    ];
    return null;//$this->all($query);
  }

  public function getVisitasMes() {
    /*
     * CONSULTA MES
     * ---------------
     * SELECT Fecha, COUNT(IP) as Cantidad 
     * FROM aws_sys_tracking 
     * WHERE Fecha BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01') AND LAST_DAY(CURDATE())
     * GROUP BY Fecha
     */

    $query = [
        'table' => $this->tabla,
        'field' => 'DAY(Fecha) as Dia, '
        . 'MONTH(Fecha) as Mes, YEAR(Fecha) as Anio, COUNT(IP) as Cantidad',
        'where' => "Fecha BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01') AND LAST_DAY(CURDATE())",
        'group' => 'Fecha'
    ];
    return null;//$this->all($query);
  }

  public function getVisitasAnio() {
    /*
     * CONSULTA MES
     * ---------------
     * SELECT Fecha, COUNT(IP) as Cantidad 
     * FROM aws_sys_tracking 
     * WHERE Fecha BETWEEN DATE_FORMAT(CURDATE(), '%Y-01-01') AND DATE_FORMAT(CURDATE(), '%Y-12-31')
     * GROUP BY MONTH(Fecha)
     */

    $query = [
        'table' => $this->tabla,
        'field' => '1 as Dia, '
        . 'MONTH(Fecha) as Mes, YEAR(Fecha) as Anio, COUNT(IP) as Cantidad',
        'where' => "Fecha BETWEEN DATE_FORMAT(CURDATE(), '%Y-01-01') AND DATE_FORMAT(CURDATE(), '%Y-12-31')",
        'group' => 'MONTH(Fecha)'
    ];
    return null;//$this->all($query);
  }

  public function getTotalUsuarios() {
    return null;//$this->rowCount('usuarios');
  }

  public function getTotalEmpresas() {
    return null;//$this->rowCount('empresas');
  }

}
