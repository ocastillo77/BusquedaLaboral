<?php

class banner_boxController extends Controller
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
    $headers['CategoriaID'] = ['title' => 'Categoría', 'sort' => 'nosort', 'align' => 'center'];
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
      $opt == 4 ? $this->model->deletePublicidades($ids) : $this->model->updatePublicidades($opt, $ids);
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

    $num = ($this->model->countPublicidades() > 0) ? ($this->model->countPublicidades() + 1) : 1;

    if (Validate::integer('actualizar', true) == 1) {
      $fields = $data[$this->tabla] = $_POST[$this->tabla];
      $titulo = Sanitize::string($fields['Titulo']);

      if (empty($titulo)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar el Título');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['Posicion'] = $num;
      $fields['Codigo'] = !empty($fields['Codigo']) ? htmlentities(stripslashes($fields['Codigo'])) : '';
      $this->model->updatePublicidad($fields);
      Url::redirect($this->baseUrl . 'listar');
    }

    $data[$this->tabla]['Titulo'] = 'Publicidad ' . $num;
    $data['categorias'] = $this->model->getCategorias();
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
      $titulo = Sanitize::string($fields['Titulo']);

      if (empty($titulo)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar el Título');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['ID'] = $id;
      $fields['Codigo'] = !empty($fields['Codigo']) ? htmlentities(stripslashes($fields['Codigo'])) : '';
      $this->model->updatePublicidad($fields);

      Url::redirect($this->baseUrl . 'listar');
    }

    $item = $data[$this->tabla] = $this->model->getPublicidad($id);
    $data['categorias'] = $this->model->getCategorias();
    $data['selectpos'] = $this->model->getSelectPos($item['CategoriaID']);

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function filter()
  {
    $info['table'] = [
      't1' => $this->tabla,
      't2' => 'catbanner'
    ];

    $info['columns'] = [
      't1.ID' => '',
      't1.Imagen' => '',
      't1.Titulo' => '',
      't2.Nombre' => 'Categoria',
      't1.Publico' => ''
    ];

    $info['joins'] = [
      ['LEFT', 't1.CategoriaID = t2.ID']
    ];

    $info['where'] = '';
    $info['order'] = 't1.Posicion';

    $grid = new DataTablesJoin($info, [$this, 'setRowsExtra'], [$this, 'addActions']);
    echo $grid->render();
  }

  public function setRowsExtra($key = '', $value = null)
  {
    $row = '';

    switch ($key) {
      case 'version':
        $row = $value == "0" ? '-' : $value;
        break;
      case 'ID':
        $row = Helper::input(array('type' => 'checkbox', 'value' => $value, 'name' => 'selected[]'));
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
                'data-fancybox-group' => 'gallery',
                'class' => 'fancybox',
                'title' => $value
            ]);
          } else {
            $row = $value;
          }
        }

        break;
      case 'Categoria':
        $row = !empty($value) ? $value : 'No Asignada';
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

  public function select($id = '')
  {
    if (!empty($id)) {
      $count = 1;
      $selectPos = [];
      $categoriaId = $_POST['categoria'];
      $rows = $this->model->getSelectPosAct($id, $categoriaId);

      if ($rows) {
        $count = count($rows) + 1;
        $selectPos = $rows;
      }

      $item = $this->model->updateParentPos($id, $categoriaId, $count);
      $selectPos[] = $data[$this->tabla] = $item;

      $data['tabla'] = $this->tabla;
      $data['base_url'] = $this->baseUrl;
      $data['selectpos'] = $selectPos;

      echo Load::view('b-content' . DS . 'modules' . DS . $this->baseRoot . 'editar' . DS . 'mod-posicion', $data);
    } else {
      Helper::showError('Error: No se envió el ID');
    }
  }

  public function sortable()
  {
    $ids = $_POST['sortable'];
    $this->model->updatePosiciones($ids);
    echo 'Las posiciones se ordenaron correctamente!';
  }

  public function upload()
  {
    $result = false;
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;

    if ($categoria) {
      $data = $this->model->getCategoria($categoria);

      if ($data) {
        $ptancho = round($data['Width'] / 2);
        $ptalto = round($data['Height'] / 2);
        $result = $this->uploadImage($_FILES['userfile'], $data['Width'], $data['Height'], $ptancho, $ptalto);
      }
    }

    echo $result;
  }

  public function jcrop2($code = '', $file = '', $ext = '')
  {
    if (isset($_POST['img'])) {
      $this->cropImage($this->config['PTAncho'], $this->config['PTAlto']);
    } else {
      $imagen = $file . '.' . $ext;
      $this->displayCrop($code, $imagen, $this->config['PIAncho'], $this->config['PIAlto']);
    }
  }

  public function jcrop($code = '', $file = '', $ext = '', $categoria = false)
  {
    if (isset($_POST['img'])) {
      $categoria = isset($_POST['category']) ? $_POST['category'] : false;

      if ($categoria) {
        $data = $this->model->getCategoria($categoria);
        $ptancho = round($data['Width'] / 2);
        $ptalto = round($data['Height'] / 2);
        $this->cropImage($ptancho, $ptalto);
      }
    } else {
      $imagen = $file . '.' . $ext;

      if ($categoria) {
        $data = $this->model->getCategoria($categoria);
        $this->displayCrop($code, $imagen, $data['Width'], $data['Height'], $categoria);
      }
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
