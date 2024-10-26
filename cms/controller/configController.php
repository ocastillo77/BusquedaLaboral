<?php

class configController extends Controller
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
        'sort' => 'nosort', 'align' => 'center', 'width' => 1
    ];
    $headers['Nombre'] = ['title' => 'Nombre', 'sort' => 'sisort', 'align' => 'left'];

    return $headers;
  }

  public function listar()
  {
    $data['title'] = $this->title . ': Lista de Registros';
    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;
    $data['heads'] = array_values($this->headers());
    $data['aligns'] = Helper::addClassAlign($data['heads']);
    $data['count'] = $this->model->countConfig();

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function insertar()
  {
    $data['title'] = 'Nuevo Registro';
    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;
    $data['width'] = $this->config['PIAncho'];
    $data['height'] = $this->config['PIAlto'];

    if (Validate::integer('actualizar', true) == 1) {
      $fields = $data[$this->tabla] = $_POST[$this->tabla];
      $nombre = Sanitize::string($fields['Nombre']);

      if (empty($nombre)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar el Nombre');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['Nombre'] = !empty($fields['Nombre']) ? Helper::htmlEntities($fields['Nombre']) : '';
      $fields['Analytics'] = !empty($fields['Analytics']) ? Helper::htmlEntities($fields['Analytics']) : '';

      $this->model->updateConfig($fields);
      Url::redirect($this->baseUrl . 'listar');
    }

    //$data['paises'] = $this->model->getPaises();
    $data['provincias'] = $this->model->getProvincias(10); //$paisId
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

    if (Validate::integer('actualizar', true) == 1) {
      $fields = $data[$this->tabla] = $_POST[$this->tabla];
      $nombre = Sanitize::string($fields['Nombre']);

      if (empty($nombre)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar el Nombre');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['Nombre'] = !empty($fields['Nombre']) ? Helper::htmlEntities($fields['Nombre']) : '';
      $fields['Analytics'] = !empty($fields['Analytics']) ? Helper::htmlEntities($fields['Analytics']) : '';

      $fields['ID'] = $id;
      $this->model->updateConfig($fields);

      Url::redirect($this->baseUrl . 'listar');
    }

    $item = $data[$this->tabla] = $this->model->getConfig($id);
    //$paisId = !empty($item['PaisID']) ? $item['PaisID'] : false;

    $data['paises'] = $this->model->getPaises();
    $data['provincias'] = $this->model->getProvincias(10); //$paisId

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function provincias($id = false)
  {
    if ($id) {
      $items = $this->model->getProvincias($id);

      if (count($items) > 0) {
        echo json_encode($items);
      }
    }
  }

  public function filter()
  {
    $info = [
        'table' => $this->tabla,
        'columns' => array_keys($this->headers()),
        'where' => '',
        'order' => ''
    ];

    $grid = new DataTables($info, [$this, 'setRowsExtra'], [$this, 'addActions']);
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

  public function uploadfav()
  {
    echo $this->uploadImage($_FILES['userfile'], 16, 16, 16, 16, true);
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

}
