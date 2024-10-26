<?php

class donacionesController extends Controller
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
      'sort' => 'nosort', 'align' => 'text-center', 'width' => 1
    ];
    $headers['Fecha'] = ['title' => 'Fecha', 'sort' => 'sisort', 'align' => 'text-center'];
    $headers['Nombre'] = ['title' => 'Nombre', 'sort' => 'sisort', 'align' => 'text-left'];
    $headers['ClienteID'] = ['title' => 'Donante', 'sort' => 'nosort', 'align' => 'text-left'];
    $headers['FPago'] = ['title' => 'Forma Pago', 'sort' => 'nosort', 'align' => 'text-center'];
    $headers['Monto'] = ['title' => 'Monto', 'sort' => 'sisort', 'align' => 'text-center'];

    return $headers;
  }

  public function listar()
  {
    $data['title'] = $this->title . ': Lista de Registros';
    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;
    $data['heads'] = array_values($this->headers());
    $data['aligns'] = Helper::addClassAlign($data['heads']);
    $data['donadores'] = $this->model->getDonadores();
    $data['formaspago'] = $this->model->getFormasPago();

    $data['donante'] = !empty($_POST['filtro']) ? $_POST['filtro'] : '-';
    $data['formapago'] = !empty($_POST['formapago']) ? $_POST['formapago'] : '-';
    $data['mes'] = !empty($_POST['mes']) ? $_POST['mes'] : '-';
    $data['anio'] = !empty($_POST['anio']) ? $_POST['anio'] : '-';

    if (Validate::integer('listar', true) == 1) {
      $opt = Sanitize::integer('accion', true);
      $ids = $_POST['selected'];
      $opt == 4 ? $this->model->deleteRegistros($ids) : $this->model->updateRegistros($opt, $ids);
    }

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function insertar()
  {
    $data['title'] = $this->title . ': Nuevo Registro';
    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;
    $data['width'] = $this->config['PIAncho'];
    $data['height'] = $this->config['PIAlto'];
    $data['donadores'] = $this->model->getDonadores();
    $data['formaspago'] = $this->model->getFormasPago();

    if (Validate::integer('actualizar', true) == 1) {
      $fields = $data[$this->tabla] = $_POST[$this->tabla];
      $nombre = Sanitize::string($fields['Nombre']);
      $donante = Sanitize::string($fields['ClienteID']);
      $fecha = Sanitize::string($fields['Fecha']);
      $monto = Sanitize::string($fields['Monto']);

      if (empty($nombre)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe seleccionar el nombre');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      if (empty($donante)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe seleccionar el donante');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      if (empty($fecha)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar una fecha');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      if (empty($monto)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar un monto');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['Publico'] = isset($fields['Publico']) ? $fields['Publico'] : 0;
      $fields['UsuarioID'] = Session::get('user_id');
      $this->model->updateRegistro($fields);
      Url::redirect($this->baseUrl . 'listar');
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
    $data['width'] = $this->config['PIAncho'];
    $data['height'] = $this->config['PIAlto'];
    $data['donadores'] = $this->model->getDonadores();
    $data['formaspago'] = $this->model->getFormasPago();

    if (Validate::integer('actualizar', true) == 1) {
      $fields = $data[$this->tabla] = $_POST[$this->tabla];
      $nombre = Sanitize::string($fields['Nombre']);
      $donante = Sanitize::string($fields['ClienteID']);
      $fecha = Sanitize::string($fields['Fecha']);
      $monto = Sanitize::string($fields['Monto']);

      if (empty($nombre)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe seleccionar el nombre');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      if (empty($donante)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe seleccionar el donante');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      if (empty($fecha)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar una fecha');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      if (empty($monto)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar un monto');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['ID'] = $id;
      $fields['UsuarioID'] = Session::get('user_id');
      $fields['Publico'] = isset($fields['Publico']) ? $fields['Publico'] : 0;
      $this->model->updateRegistro($fields);
      Url::redirect($this->baseUrl . 'listar');
    }

    $data[$this->tabla] = $this->model->getRegistro($id);

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function departamentos($id = 0)
  {
    if ($id) {
      $items = $this->model->getDepartamentosByID($id);

      if (count($items) > 0) {
        echo json_encode($items);
      }
    }
  }

  public function filter($clienteId = '', $formapago = '', $mes = '', $anio = '')
  {
    $aWhere = [];

    $info['table'] = [
      't1' => $this->tabla,
      't2' => 'usuarios',
      't3' => 'forma_pago'
    ];

    $info['columns'] = [
      't1.ID' => '',
      't1.Fecha' => '',
      't1.Nombre' => '',
      't2.Nombre' => 'Usuario',
      't3.Nombre' => 'FPago',
      't1.Monto' => ''
    ];

    $info['joins'] = [
      ['LEFT', 't1.ClienteID = t2.ID'],
      ['LEFT', 't1.FormaPago = t3.ID']
    ];

    if (!empty($clienteId) && $clienteId != '-') {
      $aWhere[] = 't1.ClienteID=' . $clienteId;
    }
    if (!empty($formapago) && $formapago != '-') {
      $aWhere[] = 't1.FormaPago=' . $formapago;
    }
    if (!empty($mes) && $mes != '-') {
      $aWhere[] = 'MONTH(t1.Fecha)=' . $mes;
    }
    if (!empty($anio) && $anio != '-') {
      $aWhere[] = 'YEAR(t1.Fecha)=' . $anio;
    }

    $info['where'] = count($aWhere) > 0 ? implode(' AND ', $aWhere) : '';
    $info['order'] = 't1.Fecha DESC';

    $grid = new DataTablesJoin($info, [$this, 'setRowsExtra'], [$this, 'addActions']);
    echo $grid->render();
  }

  public function setRowsExtra($key = '', $value = null)
  {
    switch ($key) {
      case 'ID':
        $row = Helper::input(array('type' => 'checkbox', 'value' => $value, 'name' => 'selected[]'));
        break;
      case 'Fecha':
        $row = Helper::dateTimeFormat($value, 'd/m/Y');
        break;
      case 'Monto':
        $row = !empty($value) ? '$ ' . $value : '0.00';
        break;
      default :
        $row = $value;
    }

    return $row;
  }

  public function addActions($row)
  {
    $urlEdit = URL_CMS . $this->tabla . '/editar/' . $row['ID'];
    $icon1 = Helper::tag2('i', '', ['class' => 'fa fa-edit']);
    $link1 = Helper::tag2('a', $icon1 . ' Editar', ['class' => 'btn btn-info btn-sm', 'href' => $urlEdit]);
    return $link1;
  }

  public function upload_file()
  {
    if (isset($_FILES['userfile'])) {
      echo $this->uploadFile($_FILES['userfile']);
    }
  }

  public function upload()
  {
    echo $this->uploadImage($_FILES['userfile'], $this->config['PIAncho'], $this->config['PIAlto'], $this->config['PTAncho'], $this->config['PTAlto']);
  }

  public function jcrop($code = '', $file = '', $ext = '')
  {
    if (isset($_POST['img'])) {
      $this->cropImage($this->config['PTAncho'], $this->config['PTAlto']);
    } else {
      $imagen = $file . '.' . $ext;
      $this->displayCrop($code, $imagen, $this->config['PIAncho'], $this->config['PIAlto']);
    }
  }

  public function keepimage($code = '', $image = '')
  {
    if (!empty($code)) {
      echo $this->originalImage($code, $image, $this->config['PIAncho'], $this->config['PIAlto'], $this->config['PTAncho'], $this->config['PTAlto']);
    }
  }

  public function delimage()
  {
    $id = isset($_POST['id']) ? $_POST['id'] : false;
    $imagen = isset($_POST['img']) ? $_POST['img'] : false;

    $dir_thumb = $this->dirImage . 'thumbs' . DS;
    $dir_image = $this->dirImage . 'images' . DS;

    if ($imagen) {
      @unlink($dir_image . 'IM_' . $imagen);
      @unlink($dir_thumb . 'TH_' . $imagen);
    }

    if ($id) {
      $this->model->deleteItemGaleria($id);
    }

    echo 'true';
  }

}
