<?php

class postsController extends Controller
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
    $headers['Imagen'] = ['title' => 'Imagen', 'sort' => 'nosort', 'align' => 'center'];
    $headers['Fecha'] = ['title' => 'Fecha', 'sort' => 'sisort', 'align' => 'center'];
    $headers['Titulo'] = ['title' => 'Título', 'sort' => 'sisort', 'align' => 'left'];
    $headers['CategoriaID'] = ['title' => 'Categoría', 'sort' => 'sisort', 'align' => 'center'];
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

      $opt == 4 ? $this->model->deletePosts($ids) : $this->model->updatePosts($opt, $ids);
    }

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
      $titulo = Sanitize::string($fields['Titulo']);

      $data['meta'] = isset($_POST['meta']) ? $_POST['meta'] : [];
      $data['parrafo'] = isset($_POST['paragraph']) ? $_POST['paragraph'] : [];
      $data['galeria'] = isset($_POST['gallery']) ? $_POST['gallery'] : [];

      if (empty($titulo)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar el Título');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['ShowImage'] = !empty($fields['ShowImage']) ? $fields['ShowImage'] : 0;
      $fields['Destacado'] = !empty($fields['Destacado']) ? $fields['Destacado'] : 0;
      $fields['UsuarioID'] = Session::get('user_id');

      $id = $this->model->updatePost($fields);
      $this->model->updateMeta($data['meta'], $id);
      $this->model->updateParrafos($data['parrafo'], $id);
      $this->model->updateGaleria($data['galeria'], $id);

      Url::redirect($this->baseUrl . 'listar');
    }

    $data['categorias'] = $this->model->getCategorias();
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
      $titulo = Sanitize::string($fields['Titulo']);

      $data['meta'] = isset($_POST['meta']) ? $_POST['meta'] : [];
      $data['parrafo'] = isset($_POST['paragraph']) ? $_POST['paragraph'] : [];
      $data['galeria'] = isset($_POST['gallery']) ? $_POST['gallery'] : [];

      if (empty($titulo)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar el Título');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['ShowImage'] = !empty($fields['ShowImage']) ? $fields['ShowImage'] : 0;
      $fields['Destacado'] = !empty($fields['Destacado']) ? $fields['Destacado'] : 0;
      $fields['UsuarioID'] = Session::get('user_id');

      $this->model->updateMeta($data['meta'], $id);
      $this->model->updateParrafos($data['parrafo'], $id);
      $this->model->updateGaleria($data['galeria'], $id);

      $fields['ID'] = $id;
      $this->model->updatePost($fields);

      Url::redirect($this->baseUrl . 'listar');
    }

    $data[$this->tabla] = $this->model->getPost($id);
    $data['meta'] = $this->model->getMeta($id);
    $data['parrafo'] = $this->model->getParrafos($id);
    $data['galeria'] = $this->model->getGaleria($id);
    $data['categorias'] = $this->model->getCategorias();

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function filter($publico = '', $categoria = '')
  {
    $aWhere = [];

    $info['table'] = [
      't1' => $this->tabla,
      't2' => 'categorias',
    ];

    $info['columns'] = [
      't1.ID' => '',
      't1.Imagen' => '',
      't1.Fecha' => '',
      't1.Titulo' => '',
      't2.Nombre' => 'Categoria',
      't1.Publico' => ''
    ];

    $info['joins'] = [
      ['LEFT', 't1.CategoriaID = t2.ID'],
    ];

    if (!empty($publico) && $publico != '-') {
      $aWhere[] = $publico == 1 ? 't1.Publico=1' : 't1.Publico=0';
    }
    if (!empty($categoria) && $categoria != '-') {
      $aWhere[] = 't1.CategoriaID=' . $categoria;
    }

    $info['where'] = count($aWhere) > 0 ? implode(' AND ', $aWhere) : '';
    $info['order'] = 't1.Fecha DESC';

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
      case 'Imagen':
        $row = !empty($value) ? Helper::tag('img', [
            'src' => URL_GAL . $this->tabla . '/thumbs/TH_' . $value,
            'width' => 100,
          ]) : 'Sin Imagen';
        break;
      case 'Categoria':
        $row = !empty($value) ? $value : 'No Asignado';
        break;
      case 'Publico':
        $row = Helper::formatState($value);
        break;
      case 'Fecha':
        $date = date_create($value);
        $row = date_format($date, 'd/m/Y');
        break;
      default :
        $row = $value;
    }

    return $row;
  }

  public function addActions($row)
  {
    $urlPost = $this->model->getURLPost($row['ID']);
    $urlEdit = URL_CMS . $this->tabla . '/editar/' . $row['ID'];
    $urlShow = URL_WEB . 'post/' . $row['ID'] . '/' . $urlPost;

    $icon1 = Helper::tag2('i', '', ['class' => 'fa fa-external-link']);
    $link1 = Helper::tag2('a', $icon1 . ' Ver', ['class' => 'btn btn-success btn-sm', 'href' => $urlShow, 'target' => '_blank']);
    $icon2 = Helper::tag2('i', '', ['class' => 'fa fa-edit']);
    $link2 = Helper::tag2('a', $icon2 . ' Editar', ['class' => 'btn btn-info btn-sm', 'href' => $urlEdit]);

    return $link1 . ' ' . $link2;
  }

  public function getimage()
  {
    if (isset($_POST['num'])) {
      $data['name'] = $_POST['name'];
      $data['thumb'] = $_POST['thumb'];
      $data['image'] = $_POST['image'];
      $data['num'] = (int) $_POST['num'];
      echo Load::view('b-content' . DS . 'modules' . DS . $this->baseRoot . 'editar' . DS . 'mod-image', $data);
    }
  }

  public function clonar($id)
  {
    $data['base_url'] = $this->baseUrl;
    $data['tabla'] = $this->tabla;
    $data['cur'] = $id;
    $data['route'] = $this->route;

    echo Load::view('b-content' . DS . 'modules' . DS . $this->baseRoot . 'editar' . DS . 'mod-parrafo', $data);
  }

  public function deltab()
  {
    $id = (isset($_POST['id'])) ? $_POST['id'] : false;
    $imagen = $this->model->getImagenParrafo($id);

    $dir_thumb = $this->dirImage . 'thumbs' . DS;
    $dir_image = $this->dirImage . 'images' . DS;

    @unlink($dir_image . 'IM_' . $imagen);
    @unlink($dir_thumb . 'TH_' . $imagen);

    if ($id) {
      $this->model->deleteParrafo($id);
    }

    echo 'El p&aacute;rrafo fue eliminado correctamente!';
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

  public function galeria()
  {
    if (isset($_FILES['Filedata'])) {
      echo $this->uploadImage($_FILES['Filedata'], $this->config['GIAncho'], $this->config['GIAlto'], $this->config['GTAncho'], $this->config['GTAlto'], true);
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
