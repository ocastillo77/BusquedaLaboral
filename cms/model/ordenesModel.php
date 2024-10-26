<?php

class ordenesModel extends Model {

  private $tabla;

  public function __construct() {
    parent::__construct();

    $this->tabla = 'ordenes';
  }

  public function getConfigTabla() {
    $query = [
      'table' => 'sys_tables',
      'where' => "Nombre='" . $this->tabla . "'"
    ];
    return $this->where($query);
  }

  public function getOrden($id) {
    $info['table'] = [
      't1' => $this->tabla,
      't2' => 'usuarios'
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Nombre' => 'Usuario'
    ];

    $info['joins'] = [
      ['LEFT', 't1.UsuarioID=t2.ID']
    ];

    $info['where'] = 't1.ID=' . $id;
    $data = new TableJoin($info);
    return $data->resultSet('single');
  }

  public function getOrdenDetalle($ordenId) {
    $info['table'] = [
      't1' => 'orden_detalle',
      't2' => 'productos',
      't3' => 'marcas',
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Nombre' => 'Producto',
      't2.Imagen' => '',
      't2.URL' => '',
      't3.Nombre' => 'Marca'
    ];

    $info['joins'] = [
      ['LEFT', 't1.ProductoID=t2.ID'],
      ['LEFT', 't2.MarcaID=t3.ID'],
    ];

    $info['where'] = 't1.OrdenID=' . $ordenId;
    $data = new TableJoin($info);
    return $data->resultSet('all');
  }

  public function getCliente($clienteId) {
    $info['table'] = [
      't1' => 'usuarios',
      't2' => 'provincias',
      't3' => 'departamentos'
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Nombre' => 'Provincia',
      't3.Nombre' => 'Departamento'
    ];

    $info['joins'] = [
      ['LEFT', 't1.ProvinciaID=t2.ID'],
      ['LEFT', 't1.DepartamentoID=t3.ID'],
    ];

    $info['where'] = 't1.ID=' . $clienteId;
    $data = new TableJoin($info);
    return $data->resultSet('single');
  }

  public function getComentarios($ordenId) {
    $info['table'] = [
      't1' => 'sys_comments',
      't2' => 'sys_users'
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Nombre' => 'Usuario'
    ];

    $info['joins'] = [
      ['LEFT', 't1.UsuarioID=t2.ID']
    ];

    $info['where'] = 't1.OrdenID=' . $ordenId;
    $data = new TableJoin($info);
    $rows = $data->resultSet('all');

    $result = [];
    if ($rows) {
      foreach ($rows as $item) {
        $datetime = explode(' ', $item['TimeCreate']);
        $result[$datetime[0]][] = $item;
      }
    }
    return $result;
  }

  public function getHistorial($ordenId) {
    $info['table'] = [
      't1' => 'sys_history',
      't2' => 'sys_users'
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Nombre' => 'Usuario'
    ];

    $info['joins'] = [
      ['LEFT', 't1.UsuarioID=t2.ID']
    ];

    $info['where'] = 't1.OrdenID=' . $ordenId;
    $data = new TableJoin($info);
    return $data->resultSet('all');
  }

  public function getHistorialUser($ordenId, $userId, $status) {
    $query = [
      'table' => 'sys_history',
      'where' => "OrdenID=" . $ordenId . " AND UsuarioID=" . $userId . " AND Estado=" . $status
    ];
    return $this->where($query);
  }

  public function getLastDateComment($ordenId, $userId) {
    $result = false;
    $query = [
      'table' => 'sys_comments',
      'field' => 'TimeCreate',
      'where' => "OrdenID=" . $ordenId . " AND UsuarioID=" . $userId,
      'order' => 'ID DESC'
    ];
    $row = $this->where($query);

    if ($row) {
      $fecha = Helper::dateTimeFormat($row['TimeCreate'], 'Y-m-d');
      $result = trim($fecha);
    }
    return $result;
  }

  public function updateOrden($fields) {
    return $this->save($this->tabla, $fields);
  }

  public function saveComment($fields) {
    return $this->save('sys_comments', $fields);
  }

  public function changeStatusOrder($fields) {
    $row = $this->getHistorialUser($fields['OrdenID'], $fields['UsuarioID'], $fields['Estado']);
    return !$row ? $this->save('sys_history', $fields) : '';
  }

  public function deleteOrdenes($ids) {
    return $this->delete($this->tabla, "ID IN (" . implode(',', $ids) . ")");
  }

  public function updateOrdenes($publico, $ids) {
    return $this->update($this->tabla, ['Publico' => $publico], "ID IN (" . implode(',', $ids) . ")");
  }

}
