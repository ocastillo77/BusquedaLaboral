<?php

class sys_usersController extends Controller {

  private $model;
  private $tabla;
  private $config;
  private $title;

  public function __construct() {
    parent::__construct();

    $this->initialize();
    $this->tabla = $this->route['controller'];
    $this->model = Load::model($this->tabla);
    $this->config = $this->model->getConfigTabla();
    $this->title = $this->config['Titulo'];
  }

  public function index() {
    $this->listar();
  }

  public function headers() {
    $headers['ID'] = [
        'title' => Helper::input(['type' => 'checkbox', 'id' => 'check_all', 'onclick' => 'checker(this)']),
        'sort' => 'nosort', 'align' => 'center', 'width' => 1
    ];
    $headers['Nombre'] = ['title' => 'Nombre', 'sort' => 'sisort', 'align' => 'left'];
    $headers['Usuario'] = ['title' => 'Usuario', 'sort' => 'nosort', 'align' => 'center'];
    $headers['RolID'] = ['title' => 'Rol', 'sort' => 'nosort', 'align' => 'center'];
    $headers['Publico'] = ['title' => 'Estado', 'sort' => 'sisort', 'align' => 'center', 'width' => 100];

    return $headers;
  }

  public function listar() {
    $data['title'] = $this->title . ': Lista de Registros';
    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;
    $data['heads'] = array_values($this->headers());
    $data['aligns'] = Helper::addClassAlign($data['heads']);

    if (Validate::integer('listar', true) == 1) {
      $opt = Sanitize::integer('accion', true);
      $ids = $_POST['selected'];
      $opt == 4 ? $this->model->deleteUsuarios($ids) : $this->model->updateUsuarios($opt, $ids);
    }

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function insertar() {
    $data['title'] = $this->title . ': Nuevo Registro';
    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;
    $data['width'] = $this->config['PIAncho'];
    $data['height'] = $this->config['PIAlto'];

    if (Validate::integer('actualizar', true) == 1) {
      $fields = $data[$this->tabla] = $_POST[$this->tabla];
      $nombre = Sanitize::string($fields['Nombre']);
      $email = Sanitize::string($fields['Email']);
      $usuario = Sanitize::string($fields['Usuario']);
      $contrasenia = Sanitize::string($fields['Contrasenia']);

      if (empty($nombre)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar su nombre completo');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      if (empty($email)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar su email');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      if (empty($usuario)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar su nombre de usuario');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      if (empty($contrasenia)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar la contrase&ntilde;a!');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      $this->model->updateUser($fields);
      Url::redirect($this->baseUrl . 'listar');
    }

    $data['roles'] = $this->model->getRoles();
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function editar($id) {
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
      $email = Sanitize::string($fields['Email']);
      $usuario = Sanitize::string($fields['Usuario']);

      if (empty($nombre)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar su nombre completo');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      if (empty($email)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar su email');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      if (empty($usuario)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar su nombre de usuario');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['ID'] = $id;
      $this->model->updateUser($fields);
      Url::redirect($this->baseUrl . 'listar');
    }

    $data['roles'] = $this->model->getRoles();
    $data[$this->tabla] = $this->model->getUser($id);

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function perfil() {
    if (Session::get('authorized') == null) {
      Url::redirect('login/login');
    }

    $id = Session::get('user_id');

    $data['title'] = $this->title . ': Editar Registro';
    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;
    $data['width'] = $this->config['PIAncho'];
    $data['height'] = $this->config['PIAlto'];

    if (Validate::integer('actualizar', true) == 1) {
      $fields = $data[$this->tabla] = $_POST[$this->tabla];
      $nombre = Sanitize::string($fields['Nombre']);
      $email = Sanitize::string($fields['Email']);
      $usuario = Sanitize::string($fields['Usuario']);

      if (empty($nombre)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar el Nombre del Usuario');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      if (empty($email)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar su Email');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      if (empty($usuario)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar su nombre de usuario');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['ID'] = $id;
      $this->model->updateUser($fields);
      Url::redirect();
    }

    $data['roles'] = $this->model->getRoles();
    $data[$this->tabla] = $this->model->getUser($id);

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function filter() {
    $info['table'] = [
        't1' => $this->tabla,
        't2' => 'sys_roles'
    ];

    $info['columns'] = [
        't1.ID' => '',
        't1.Nombre' => '',
        't1.Usuario' => '',
        't2.Nombre' => 'Rol',
        't1.Publico' => ''
    ];

    $info['joins'] = [
        ['LEFT', 't1.RolID = t2.ID']
    ];

    $info['where'] = 't1.RolID!=0';
    $info['order'] = 't1.Nombre';

    $grid = new DataTablesJoin($info, [$this, 'setRowsExtra'], [$this, 'addActions']);
    echo $grid->render();
  }

  public function setRowsExtra($key = '', $value = null) {
    $row = '';

    switch ($key) {
      case 'version':
        $row = ($value == "0") ? '-' : $value;
        break;
      case 'ID':
        $row = Helper::input(['type' => 'checkbox', 'value' => $value, 'name' => 'selected[]']);
        break;
      case 'Rol':
        $row = !empty($value) ? $value : 'No Asignado';
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
    $urlEdit = URL_CMS . $this->tabla . '/editar/' . $row['ID'];
    $icon1 = Helper::tag2('i', '', ['class' => 'fa fa-edit']);
    $link1 = Helper::tag2('a', $icon1 . ' Editar', ['class' => 'btn btn-info btn-sm', 'href' => $urlEdit]);
    return $link1;
  }

  public function check_email() {
    $is_true = $this->model->checkEmail();
    echo ($is_true) ? 'true' : 'false';
  }

  public function check_user() {
    $is_true = $this->model->checkUser();
    echo ($is_true) ? 'true' : 'false';
  }

  public function upload() {
    echo $this->uploadImage($_FILES['userfile'], $this->config['PIAncho'], $this->config['PIAlto'], $this->config['PTAncho'], $this->config['PTAlto']);
  }

  public function jcrop($code = '', $file = '', $ext = '') {
    if (isset($_POST['img'])) {
      $this->cropImage($this->config['PTAncho'], $this->config['PTAlto']);
    } else {
      $imagen = $file . '.' . $ext;
      $this->displayCrop($code, $imagen, $this->config['PIAncho'], $this->config['PIAlto']);
    }
  }

  public function keepimage($code = '', $image = '') {
    if (!empty($code)) {
      echo $this->originalImage($code, $image, $this->config['PIAncho'], $this->config['PIAlto'], $this->config['PTAncho'], $this->config['PTAlto']);
    }
  }

  public function delimage() {
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
