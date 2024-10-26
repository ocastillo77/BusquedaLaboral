<?php

class filemanagerController extends Controller {

  private $model;
  private $tabla;
  private $title;
  private $config;

  public function __construct() {
    parent::__construct();

    $this->initialize();
    $this->tabla = $this->route['controller'];
    $this->model = Load::model($this->tabla);
    $this->title = 'Administrador de Imágenes';
  }

  public function index() {
    $this->listar();
  }

  public function headers() {
    $headers['ID'] = [
      'title' => Helper::input(['type' => 'checkbox', 'id' => 'check_all', 'onclick' => 'checker(this)']),
      'sort' => 'nosort', 'align' => 'center', 'width' => 1
    ];
    $headers['Titulo'] = ['title' => 'Carpeta', 'sort' => 'sisort', 'align' => 'left'];
    $headers['Publico'] = ['title' => 'Estado', 'sort' => 'sisort', 'align' => 'center', 'width' => 100];

    return $headers;
  }

  public function listar() {
    $data['title'] = $this->title . ': Lista de Carpetas';
    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;
    $data['heads'] = array_values($this->headers());
    $data['aligns'] = Helper::addClassAlign($data['heads']);

    if (Validate::integer('listar', true) == 1) {
      $opt = Sanitize::integer('accion', true);
      $ids = $_POST['selected'];
      $opt == 4 ? $this->model->deleteCateAccesorios($ids) : $this->model->updateCateAccesorios($opt, $ids);
    }

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function uploads($id) {
    if (!Validate::integer($id)) {
      Url::redirect();
    }

    $data['title'] = $this->title . ': Subir Archivos';
    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;
    $this->config = $this->model->configTableById($id);
    $data['tabla_sec'] = $this->config['Nombre'];
    $data['galeria'] = $this->model->getGaleria($this->config['Nombre']);
    Session::set('config', $this->config);

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function filter() {
    $info = [
      'table' => 'sys_tables',
      'columns' => array_keys($this->headers()),
      'where' => '',
      'order' => ''
    ];
    $info['where'] = 'UseFileM=1';

    $grid = new DataTables($info, [$this, 'setRowsExtra'], [$this, 'addActions']);
    echo $grid->render();
  }

  public function setRowsExtra($key = '', $value = null) {
    switch ($key) {
      case 'version':
        $row = ($value == "0") ? '-' : $value;
        break;
      case 'ID':
        $row = Helper::input(['type' => 'checkbox', 'value' => $value, 'name' => 'selected[]']);
        break;
      case 'Publico':
        $row = Helper::formatState($value);
        break;
      default :
        $row = $value;
    }

    return $row;
  }

  public function addActions($row) {
    $urlEdit = URL_CMS . $this->tabla . '/uploads/' . $row['ID'];
    $link1 = Helper::tag2('a', ' Subir Imágenes', ['class' => 'btn btn-info btn-sm', 'href' => $urlEdit]);
    return $link1;
  }

  public function getimage() {
    if (isset($_POST['num'])) {
      $data['name'] = $_POST['name'];
      $data['thumb'] = $_POST['thumb'];
      $data['image'] = $_POST['image'];
      $data['num'] = (int) $_POST['num'];
      echo Load::view('b-content' . DS . 'modules' . DS . $this->baseRoot . 'uploads' . DS . 'mod-image', $data);
    }
  }

  public function galeria() {
    if (isset($_FILES['Filedata'])) {
      $this->config = Session::get('config');

      $result = $this->uploadFileManager($_FILES['Filedata'], $this->config['GIAncho'],
        $this->config['GIAlto'], $this->config['GTAncho'], $this->config['GTAlto'], true,
        $this->config['Nombre']);

      if ($result) {
        $fields['Tabla'] = $this->config['Nombre'];
        $fields['TablaID'] = $this->model->getImageTableId($this->config['Nombre'], $result['name']);
        $fields['Titulo'] = $result['title'];
        $fields['Imagen'] = $result['name'];

        $this->model->saveImageGallery($fields);
      }

      echo json_encode($result);
      ;
    }
  }

  public function delimage() {
    $id = isset($_POST['id']) ? $_POST['id'] : false;
    $imagen = isset($_POST['img']) ? $_POST['img'] : false;
    $dirImage = GAL_PATH . $this->config['Nombre'] . DS;

    $dThumb = $dirImage . 'thumbs' . DS;
    $dImage = $dirImage . 'images' . DS;

    if ($imagen) {
      @unlink($dImage . 'IM_' . $imagen);
      @unlink($dThumb . 'TH_' . $imagen);
    }

    if ($id) {
      $this->model->deleteItemGaleria($id);
    }

    echo 'true';
  }

}
