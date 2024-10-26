<?php

class ordenesController extends Controller
{

  private $model;
  private $tabla;
  private $config;
  private $title;

  public function __construct()
  {
    parent::__construct();

    $this->initialize();
    $this->tabla = $this->route['controller'];
    $this->model = Load::model($this->tabla);
    $this->config = $this->model->getConfigTabla();
    $this->title = $this->config['Titulo'];
  }

  public function index()
  {
    $this->listar();
  }

  public function headers()
  {
    $headers['ID'] = [
      'title' => Helper::input(['type' => 'checkbox', 'id' => 'check_all', 'onclick' => 'checker(this)']),
      'sort' => 'nosort',
      'align' => 'center',
      'width' => 1
    ];
    $headers['Nombre'] = ['title' => 'Nombre', 'sort' => 'sisort', 'align' => 'left'];
    $headers['UsuarioID'] = ['title' => 'Cliente', 'sort' => 'sisort', 'align' => 'left'];
    $headers['Archivo'] = ['title' => 'Archivo', 'sort' => 'sisort', 'align' => 'center'];
    $headers['TotalVenta'] = ['title' => 'Total Venta', 'sort' => 'sisort', 'align' => 'center'];
    $headers['Publico'] = ['title' => 'Estado', 'sort' => 'sisort', 'align' => 'center', 'width' => 100];

    return $headers;
  }

  public function listar()
  {
    $data['title'] = $this->title . ': Lista de Registros';
    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;
    $data['heads'] = array_values($this->headers());
    $data['aligns'] = Helper::addClassAlign($data['heads']);

    if (Validate::integer('listar', true) == 1) {
      $opt = Sanitize::integer('accion', true);
      $ids = $_POST['selected'];
      $opt == 4 ? $this->model->deleteOrdenes($ids) : $this->model->updateOrdenes($opt, $ids);
    }

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function editar($id)
  {
    if (!Validate::integer($id)) {
      Url::redirect();
    }

    $data['title'] = $this->title . ': Editar Registro';
    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;

    if (Validate::integer('actualizar', true) == 1) {
      $fields = $data[$this->tabla] = $_POST[$this->tabla];

      $fields['ID'] = $id;
      $this->model->updateOrden($fields);

      $log['OrdenID'] = $id;
      $log['UsuarioID'] = Session::get('user_id');
      $log['Accion'] = 'CHANGE';
      $log['Estado'] = $fields['Publico'];
      $this->model->changeStatusOrder($log);

      Url::redirect($this->baseUrl . 'listar');
    }

    $data[$this->tabla] = $item = $this->model->getOrden($id);
    $data['detalle'] = $this->model->getOrdenDetalle($id);
    $data['comentarios'] = $this->model->getComentarios($id);
    $data['historial'] = $this->model->getHistorial($id);

    if ($item) {
      $data['cliente'] = $this->model->getCliente($item['UsuarioID']);
    }
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function filter()
  {
    $info['table'] = [
      't1' => $this->tabla,
      't2' => 'usuarios'
    ];

    $info['columns'] = [
      't1.ID' => '',
      't1.Nombre' => '',
      't2.Nombre' => 'Usuario',
      't1.Archivo' => '',
      't1.TotalVenta' => '',
      't1.Publico' => ''
    ];

    $info['joins'] = [
      ['LEFT', 't1.UsuarioID = t2.ID']
    ];

    $info['where'] = '';
    $info['order'] = 't1.TimeCreate DESC';

    $grid = new DataTablesJoin($info, [$this, 'setRowsExtra'], [$this, 'addActions']);
    echo $grid->render();
  }

  public function setRowsExtra($key = '', $value = null)
  {
    switch ($key) {
      case 'version':
        $row = ($value == "0") ? '-' : $value;
        break;
      case 'ID':
        $row = Helper::input(['type' => 'checkbox', 'value' => $value, 'name' => 'selected[]']);
        break;
      case 'TotalVenta':
        $row = !empty($value) ? '$ ' . Helper::moneyFormat($value) : '';
        break;
      case 'Publico':
        $row = Helper::stateOrder($value);
        break;
      default:
        $row = $value;
    }

    return $row;
  }

  public function addActions($row)
  {
    $urlEdit = URL_CMS . $this->tabla . '/editar/' . $row['ID'];
    $icon1 = Helper::tag2('i', '', ['class' => 'fa fa-edit']);
    $link1 = Helper::tag2('a', $icon1 . ' Mostrar', ['class' => 'btn btn-info btn-sm', 'href' => $urlEdit]);
    return $link1;
  }

  public function addcomment()
  {
    if ($_POST['ordenId']) {
      $ordenId = $_POST['ordenId'];
      $comment = $_POST['comment'];
      $userId = Session::get('user_id');

      $fields['OrdenID'] = $ordenId;
      $fields['UsuarioID'] = $userId;
      $fields['Comentario'] = $comment;
      $fields['TimeCreate'] = date('Y-m-d H:i:s');
      $this->model->saveComment($fields);

      $lastDate = $this->model->getLastDateComment($ordenId, $userId);
      $curDate = date('Y-m-d');

      if ($lastDate !== $curDate) {
        $data['Fecha'] = Helper::formatDateLarge($curDate);
      }

      $data['Usuario'] = Session::get('name');
      $data['Hora'] = Helper::dateTimeFormat($fields['TimeCreate'], 'H:i:s');
      $data['Comentario'] = $comment;

      echo Load::view('b-content' . DS . 'modules' . DS . $this->baseRoot . 'editar' . DS . 'mod-comment', $data);
    }
  }
}
