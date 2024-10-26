<?php

class sys_menu_leftController extends Controller {

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

  public function listar() {
    $data['title'] = $this->title . ': Lista de Registros';
    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;

    if (Validate::integer('listar', true) == 1) {
      $opt = Sanitize::integer('accion', true);
      $ids = $_POST['selected'];
      $opt == 4 ? $this->model->deleteMenus($ids) : $this->model->updateMenus($opt, $ids);
    }

    $tree = new TreeMenu($this->baseUrl);
    $data['tree_table'] = $tree->render();

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function insertar() {
    $data['title'] = $this->title . ': Nuevo Registro';
    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;

    if (Validate::integer('actualizar', true) == 1) {
      $fields = $data[$this->tabla] = $_POST[$this->tabla];
      $titulo = Sanitize::string($fields['Titulo']);

      if (empty($titulo)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar el título');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $this->model->updateMenu($fields);
      Url::redirect($this->baseUrl . 'listar');
    }

    $select = new SelectMenu();
    $data['selectsec'] = $select->render();
    $data['selectpos'] = Helper::recordSort($this->model->getSelectPos(), 'Posicion');
    $data['list_tables'] = $this->model->getTablas();
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

    if (Validate::integer('actualizar', true) == 1) {
      $fields = $data[$this->tabla] = $_POST[$this->tabla];
      $titulo = Sanitize::string($fields['Titulo']);

      if (empty($titulo)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar el título');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['ID'] = $id;
      $this->model->updateMenu($fields);
      Url::redirect($this->baseUrl . 'listar');
    }

    $item = $data[$this->tabla] = $this->model->getMenu($id);
    $select = new SelectMenu($item['PadreID']);
    $data['selectsec'] = $select->render();
    $data['selectpos'] = Helper::recordSort($this->model->getSelectPos($item), 'Posicion');
    $data['list_tables'] = $this->model->getTablas();
    $data['roles'] = $this->model->getRoles();

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function select($id = '') {
    $parent_id = $_POST['parent'];
    $parent_ant = $_POST['prev'];
    $select_pos = $this->model->getSelectPosAct($parent_id);
    $count = count($select_pos) + 1;

    if ($id != 0) {
      $this->model->reorderParentPrev($id, $parent_ant);
      $data[$this->tabla] = $this->model->updateParentPos($id, $parent_id, $count);
      $select_pos[] = $data[$this->tabla];
    } else {

      $data[$this->tabla] = [
          'ID' => $id,
          'Titulo' => 'Nuevo Item',
          'Posicion' => $count,
          'PadreID' => $parent_id
      ];

      $select_pos[] = is_array($select_pos) ? $data[$this->tabla] : [$data[$this->tabla]];
    }

    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;
    $data['selectpos'] = $select_pos;
    echo Load::view('b-content' . DS . 'modules' . DS . $this->baseRoot . 'editar' . DS . 'mod-posicion', $data);
  }

  public function sortable() {
    $ids = $_POST['sortable'];
    $this->model->updatePosiciones($ids);
    echo 'Las posiciones se ordenaron correctamente!';
  }

}
