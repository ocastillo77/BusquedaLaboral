<?php

class usuariosController extends Controller
{

  const IMG_WIDTH = 490;
  const IMG_HEIGHT = 600;

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
    $this->title = 'Candidatos';
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
    $headers['Email'] = ['title' => 'Email', 'sort' => 'nosort', 'align' => 'center'];
    $headers['Celular'] = ['title' => 'Celular', 'sort' => 'nosort', 'align' => 'center'];
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
      $opt == 4 ? $this->model->deleteUsers($ids) : $this->model->updateUsers($opt, $ids);
    }

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function insertar()
  {
    $data['title'] = $this->title . ': Nuevo Registro';
    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;
    $data['width'] = self::IMG_WIDTH;
    $data['height'] = self::IMG_HEIGHT;

    if (Validate::integer('actualizar', true) == 1) {
      $fields = $data[$this->tabla] = $_POST[$this->tabla];
      $nombre = Sanitize::string($fields['Nombre']);

      if (empty($nombre)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar el nombre');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['Publico'] = isset($fields['Publico']) ? $fields['Publico'] : 0;
      $this->model->updateUser($fields);
      Url::redirect($this->baseUrl . 'listar');
    }

    $data['provincias'] = $this->model->getProvincias();
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
    $data['width'] = self::IMG_WIDTH;
    $data['height'] = self::IMG_HEIGHT;

    if (Validate::integer('actualizar', true) == 1) {
      $fields = $data[$this->tabla] = $_POST[$this->tabla];
      $nombre = Sanitize::string($fields['Nombre']);

      if (empty($nombre)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar el nombre');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['ID'] = $id;
      $fields['Publico'] = isset($fields['Publico']) ? $fields['Publico'] : 0;
      $fields['FotoValida'] = isset($fields['FotoValida']) ? $fields['FotoValida'] : 0;
      $this->model->updateUser($fields);
      Url::redirect($this->baseUrl . 'listar');
    }

    $item = $data[$this->tabla] = $this->model->getUser($id);
    $data['provincias'] = $this->model->getProvincias();

    if (!empty($item['ProvinciaID'])) {
      $data['departamentos'] = $this->model->getDepartamentosByID($item['ProvinciaID']);
    }

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
        $row = Helper::input(array('type' => 'checkbox', 'value' => $value, 'name' => 'selected[]'));
        break;
      case 'Publico':
        $row = Helper::formatState($value);
        break;
      default:
        $row = $value;
    }

    return $row;
  }

  public function addActions($row)
  {
    $urlEdit = URL_CMS . $this->tabla . '/editar/' . $row['ID'];
    $urlPerfil = URL_WEB . 'candidate/' . $row['ID'] . '/profile';

    $link1 = Helper::tag2('a', 'Editar', ['class' => 'btn btn-info btn-sm', 'href' => $urlEdit]);
    $link2 = Helper::tag2('a', 'Ver Perfil', ['class' => 'btn btn-success btn-sm', 'href' => $urlPerfil, 'target' => '_blank']);
    return $link2 . ' ' . $link1;
  }

  public function upload()
  {
    echo $this->uploadImage($_FILES['userfile'], self::IMG_WIDTH, self::IMG_HEIGHT, self::IMG_WIDTH, self::IMG_HEIGHT);
  }

  public function jcrop($code = '', $file = '', $ext = '')
  {
    if (isset($_POST['img'])) {
      $this->cropImage(self::IMG_WIDTH, self::IMG_HEIGHT);
    } else {
      $imagen = $file . '.' . $ext;
      $this->displayCrop($code, $imagen, self::IMG_WIDTH, self::IMG_HEIGHT);
    }
  }

  public function keepimage($code = '', $image = '')
  {
    if (!empty($code)) {
      echo $this->originalImage($code, $image, self::IMG_WIDTH, self::IMG_HEIGHT, self::IMG_WIDTH, self::IMG_HEIGHT);
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
