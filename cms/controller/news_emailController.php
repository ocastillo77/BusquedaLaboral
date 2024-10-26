<?php

class news_emailController extends Controller
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
    $headers['Nombre'] = ['title' => 'Nombre', 'sort' => 'sisort', 'align' => 'text-left'];
    $headers['Email'] = ['title' => 'Email', 'sort' => 'sisort', 'align' => 'text-center'];
    $headers['GroupID'] = ['title' => 'Categoría', 'sort' => 'nosort', 'align' => 'text-center'];
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
    $data['categorias'] = $this->model->getCategorias();

    if (Validate::integer('actualizar', true) == 1) {
      $fields = $data[$this->tabla] = $_POST[$this->tabla];
      $email = Sanitize::string($fields['Email']);

      if (empty($email)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe seleccionar el email');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['Publico'] = isset($fields['Publico']) ? $fields['Publico'] : 0;
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
    $data['categorias'] = $this->model->getCategorias();

    if (Validate::integer('actualizar', true) == 1) {
      $fields = $data[$this->tabla] = $_POST[$this->tabla];
      $email = Sanitize::string($fields['Email']);

      if (empty($email)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe seleccionar el email');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['ID'] = $id;
      $fields['Publico'] = isset($fields['Publico']) ? $fields['Publico'] : 0;
      $this->model->updateRegistro($fields);
      Url::redirect($this->baseUrl . 'listar');
    }

    $data[$this->tabla] = $this->model->getRegistro($id);

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function filter()
  {
    $info['table'] = [
      't1' => $this->tabla,
      't3' => 'news_group'
    ];

    $info['columns'] = [
      't1.ID' => '',
      't1.Nombre' => '',
      't1.Email' => '',
      't3.Nombre' => 'Categoria',
      't1.Publico' => ''
    ];

    $info['joins'] = [
      ['LEFT', 't1.GroupID = t3.ID']
    ];

    $info['where'] = 't1.Publico=1';
    $info['order'] = '';

    $grid = new DataTablesJoin($info, [$this, 'setRowsExtra'], [$this, 'addActions']);
    echo $grid->render();
  }

  public function setRowsExtra($key = '', $value = null)
  {
    $row = '';
    switch ($key) {
      case 'ID':
        $row = Helper::input(array('type' => 'checkbox', 'value' => $value, 'name' => 'selected[]'));
        break;
      case 'Usuario':
        $row = !empty($value) ? $value : '-';
        break;
      case 'Publico':
        $row = Helper::formatState($value);
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
