<?php

class seccionesController extends Controller
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

  public function listar()
  {
    $data['title'] = $this->title . ': Lista de Registros';
    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;

    if (Validate::integer('listar', true) == 1) {
      $opt = Sanitize::integer('accion', true);
      $ids = $_POST['selected'];
      $opt == 4 ? $this->model->deleteSecciones($ids) : $this->model->updateSecciones($opt, $ids);
    }

    $tree = new TreeTable($this->baseUrl);
    $data['tree_table'] = $tree->render();

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

      $id = $this->model->updateSeccion($fields);
      $this->model->updateMeta($data['meta'], $id);
      $this->model->updateParrafos($data['parrafo'], $id);
      $this->model->updateGaleria($data['galeria'], $id);

      Url::redirect($this->baseUrl . 'listar');
    }

    $select = new Select();
    $data['selectsec'] = $select->render();
    $data['selectpos'] = $this->model->getSelectPos();
    $data['selplantilla'] = $this->model->selectPlantillas();
    $data['tablas'] = $this->model->getTables();

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

      $this->model->updateMeta($data['meta'], $id);
      $this->model->updateParrafos($data['parrafo'], $id);
      $this->model->updateGaleria($data['galeria'], $id);

      $fields['ID'] = $id;
      $this->model->updateSeccion($fields);

      Url::redirect($this->baseUrl . 'listar');
    }

    $item = $data[$this->tabla] = $this->model->getSeccion($id);
    $data['meta'] = $this->model->getMeta($id);
    $data['parrafo'] = $this->model->getParrafos($id);
    $data['galeria'] = $this->model->getGaleria($id);

    $select = new Select($id, $item['PadreID']);
    $data['selectsec'] = $select->render();
    $data['selectpos'] = $this->model->getSelectPos($id, $item['PadreID']);
    $data['selplantilla'] = $this->model->selectPlantillas();
    $data['tablas'] = $this->model->getTables();

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function select($id = false)
  {
    $parentId = $_POST['parent'];
    $parentAnt = $_POST['prev'];
    $itemsParent = $this->model->getItemsParent($parentId);
    $count = $itemsParent ? count($itemsParent) + 1 : 1;

    if ($id != 0) {
      $this->model->reorderParentPrev($id, $parentAnt);
      $this->model->updateParentPos($id, $parentId, $count);
      $itemActual = $itemsParent[] = $this->model->getSeccionById($id);
      $data[$this->tabla] = $itemActual;
    }

    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;
    $data['selectpos'] = $itemsParent;

    echo Load::view('b-content' . DS . 'modules' . DS . $this->baseRoot . 'editar' . DS . 'mod-posicion', $data);
  }

  public function sortable($id = false)
  {
    if ($id && isset($_POST['sortable'])) {
      $ids = $_POST['sortable'];
      $this->model->updatePosiciones($ids);
      echo 'Las posiciones se ordenaron correctamente!';
    }
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
