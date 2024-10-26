<?php

class banner_topController extends Controller
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
    $headers['Titulo'] = ['title' => 'Nombre', 'sort' => 'sisort', 'align' => 'left'];
    $headers['Descripcion'] = ['title' => 'Descripción', 'sort' => 'nosort', 'align' => 'left'];
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
      $opt == 4 ? $this->model->deleteBanners($ids) : $this->model->updateBanners($opt, $ids);
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

    $num = ($this->model->countBanners() > 0) ? ($this->model->countBanners() + 1) : 1;

    if (Validate::integer('actualizar', true) == 1) {
      $fields = $data[$this->tabla] = $_POST[$this->tabla];
      $fields['Titulo'] = !empty($fields['Titulo']) ? $fields['Titulo'] : 'Slider ' . $num;
      $fields['Posicion'] = $num;
      $this->model->updateBanner($fields);
      Url::redirect($this->baseUrl . 'listar');
    }

    $data[$this->tabla]['Titulo'] = 'Slider ' . $num;
    $data['selectpos'] = $this->model->getSelectPos();

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
      $fields['Titulo'] = !empty($fields['Titulo']) ? $fields['Titulo'] : 'Slider ' . $id;
      $fields['ID'] = $id;
      $this->model->updateBanner($fields);

      Url::redirect($this->baseUrl . 'listar');
    }

    $data[$this->tabla] = $this->model->getBanner($id);
    $data['selectpos'] = $this->model->getSelectPos();
    $this->view->assign('data', $data);
    $this->view->render();
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
    $row = '';

    switch ($key) {
      case 'version':
        $row = $value == '0' ? '-' : $value;
        break;
      case 'ID':
        $row = Helper::input(['type' => 'checkbox', 'value' => $value, 'name' => 'selected[]']);
        break;
      case 'Imagen':
        if (!empty($value)) {
          $filename = GAL_PATH . $this->tabla . DS . 'thumbs' . DS . 'TH_' . $value;

          if (file_exists($filename)) {
            $url_thumb = URL_GAL . $this->tabla . '/thumbs/TH_' . $value;
            $url_image = URL_GAL . $this->tabla . '/images/IM_' . $value;

            $thumb = Helper::tag('img', [
                'src' => $url_thumb,
                'height' => 70,
            ]);

            $row = Helper::tag2('a', $thumb, [
                'href' => $url_image,
                'rel' => 'gallery',
                'class' => 'fancybox',
                'title' => $value
            ]);
          } else {
            $row = $value;
          }
        }
        break;
      case 'Descripcion':
        $row = strip_tags($value);
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

  public function sortable()
  {
    $ids = $_POST['sortable'];
    $this->model->updatePosiciones($ids);
    echo 'Las posiciones se ordenaron correctamente!';
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
