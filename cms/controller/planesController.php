<?php

class planesController extends Controller
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
    $this->title = 'Planes';
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
    $headers['PrecioAnt'] = ['title' => 'Precio S/D', 'sort' => 'sisort', 'align' => 'center'];
    $headers['Precio'] = ['title' => 'Precio', 'sort' => 'sisort', 'align' => 'center'];
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
    $data['categorias'] = $this->model->getCategorias();

    if (Validate::integer('actualizar', true) == 1) {
      $fields = $data[$this->tabla] = $_POST[$this->tabla];
      $nombre = Sanitize::string($fields['Nombre']);

      if (empty($nombre)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar el nombre');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

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
    $data['categorias'] = $this->model->getCategorias();

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
      't2' => 'categorias'
    ];

    $info['columns'] = [
      't1.ID' => '',
      't1.Nombre' => '',
      't1.PrecioAnt' => '',
      't1.Precio' => '',
      't2.Nombre' => 'Categoria',
      't1.Publico' => ''
    ];

    $info['joins'] = [
      ['LEFT', 't1.CategoriaID=t2.ID']
    ];

    $info['where'] = '';
    $info['order'] = 't1.ID ASC';

    $grid = new DataTablesJoin($info, [$this, 'setRowsExtra'], [$this, 'addActions']);
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
      case 'PrecioAnt':
      case 'Precio':
      case 'Categoria':
        $row = !empty($value) ? $value : 'No definido';
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
    $icon1 = Helper::tag2('i', '', ['class' => 'fa fa-edit']);
    $link1 = Helper::tag2('a', $icon1 . ' Editar', ['class' => 'btn btn-info btn-sm', 'href' => $urlEdit]);
    return $link1;
  }
}
