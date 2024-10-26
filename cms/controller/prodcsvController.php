<?php

class prodcsvController extends Controller
{

  private $model;
  private $tabla;
  private $userId;

  public function __construct()
  {
    parent::__construct();

    $this->initialize();
    $this->tabla = $this->route['controller'];
    $this->model = Load::model($this->tabla);
    $this->config = $this->model->getConfigTabla();
    $this->title = $this->config['Titulo'];
    $this->userId = Session::get('user_id');
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
    $headers['Fecha'] = ['title' => 'Fecha', 'sort' => 'sisort', 'align' => 'center'];
    $headers['Nombre'] = ['title' => 'Nombre', 'sort' => 'sisort', 'align' => 'left'];
    $headers['Archivo'] = ['title' => 'Archivo', 'sort' => 'sisort', 'align' => 'left'];
    $headers['Usuario'] = ['title' => 'Usuario', 'sort' => 'sisort', 'align' => 'left'];
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
      $opt == 4 ? $this->model->deleteProductos($ids) : $this->model->updateProductos($opt, $ids);
    }

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function insertar()
  {
    $data['title'] = 'Agregar Productos CSV';
    $data['tabla'] = $this->tabla;
    $data['base_url'] = $this->baseUrl;

    if (Validate::integer('actualizar', true) == 1) {
      $data[$this->tabla] = $_POST[$this->tabla];
      $fields = $_POST[$this->tabla];
      $nombre = Sanitize::string($fields['Nombre']);

      if (empty($nombre)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar un nombre referencial');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['UsuarioID'] = $this->userId;
      $this->model->updateProducto($fields);

      if (!empty($fields['Archivo'])) {
        $this->importCSV($fields['Archivo']);
      } else {
        $data['alert'] = Helper::alertMessage('danger', 'Por favor, seleccione el archivo CSV!');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

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
    $data['title'] = 'Mostrar Carga de Productos CSV';
    $data['tabla'] = $this->tabla;

    $data[$this->tabla] = $this->model->getProductoJoin($id);
    $data['base_url'] = $this->baseUrl;
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function importCSV($filename)
  {
    $fields = [];
    $rutaFile = $this->rutaFile . 'files' . DS . $filename;
    $allLines = file($rutaFile);

    $i = 0;
    foreach ($allLines as $line) {
      ob_start();

      if ($i != 0) {
        $item = explode(';', $line);

        if (trim($item[0]) !== '') {
          $fields['Nombre'] = trim($item[0]);
        }
        if (trim($item[1]) !== '') {
          $fields['Descripcion'] = trim($item[1]);
        }
        if (trim($item[2]) !== '') {
          $disponible = $this->model->getDisponibilidad(trim($item[2]));
          $fields['DisponibleID'] = $disponible ? $disponible : '';
        }
        if (trim($item[3]) !== '') {
          $fields['Stock'] = trim($item[3]);
        }
        if (trim($item[4]) !== '') {
          $condicion = $this->model->getCondicion(trim($item[4]));
          $fields['CondicionID'] = $condicion ? $condicion : '';
        }
        if (trim($item[5]) !== '') {
          $moneda = $this->model->getMoneda(trim($item[5]));
          $fields['MonedaID'] = $moneda ? $moneda['ID'] : '';
        }
        if (trim($item[6]) !== '') {
          $fields['Precio'] = trim($item[6]);
        }
        if (trim($item[7]) !== '') {
          $fields['Imagen'] = trim($item[7]);
        }
        if (trim($item[8]) !== '') {
          $marca = $this->model->getMarca(trim($item[8]));
          $fields['MarcaID'] = $marca ? $marca : '';
        }
        if (trim($item[9]) !== '') {
          $fields['Descuento'] = trim($item[9]);
        }
        if (trim($item[10]) !== '') {
          $fields['FechaIniD'] = trim($item[10]);
        }
        if (trim($item[11]) !== '') {
          $fields['FechaFinD'] = trim($item[11]);
        }
        if (trim($item[12]) !== '') {
          $genero = $this->model->getGenero(trim($item[12]));
          $fields['GeneroID'] = $genero ? $genero : '';
        }
        if (trim($item[13]) !== '') {
          $fields['Color'] = trim($item[13]);
        }
        if (trim($item[14]) !== '') {
          $fields['Talle'] = trim($item[14]);
        }
        if (trim($item[15]) !== '') {
          $grupo = $this->model->getGrupoEtario(trim($item[15]));
          $fields['GrupoID'] = $grupo ? $grupo : '';
        }
        if (trim($item[16]) !== '') {
          $fields['Material'] = trim($item[16]);
        }
        if (trim($item[17]) !== '') {
          $cateprod = $this->model->getCateProd(trim($item[17]));
          $fields['CategoriaID'] = $cateprod ? $cateprod : '';
        }
        if (trim($item[18]) !== '') {
          $filial = $this->model->getFilial(trim($item[18]));
          $fields['FilialID'] = $filial ? $filial : '';
        }

        $this->model->saveProducto($fields);
      }

      ob_flush();
      $i++;
    }
  }

  public function filter()
  {
    $info['table'] = [
      't1' => 'prodcsv',
      't2' => 'sys_users'
    ];

    $info['columns'] = [
      't1.ID' => '',
      't1.Fecha' => '',
      't1.Nombre' => '',
      't1.Archivo' => '',
      't2.Nombre' => 'Usuario',
      't1.Publico' => ''
    ];

    $info['joins'] = [
      ['INNER', 't1.UsuarioID=t2.ID']
    ];

    $info['where'] = '';
    $info['order'] = 'Fecha DESC';

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

  public function addActions($row)
  {
    $urlShow = URL_GAL . 'prodcsv/files/' . $row['Archivo'];
    $urlEdit = URL_CMS . 'productos' . '/listar';

    $link1 = Helper::tag2('a', ' Descargar CSV', [
        'class' => 'btn btn-info btn-sm',
        'href' => $urlShow,
        'target' => '_blank']);

    $link2 = Helper::tag2('a', ' Ver Productos', [
        'class' => 'btn btn-success btn-sm',
        'href' => $urlEdit]);

    return $link1 . ' ' . $link2;
  }

  public function upload()
  {
    $info['success'] = 0;

    if (isset($_FILES['userfile'])) {
      $info = $this->uploadFile($_FILES['userfile'], false, false);

      if ($info['success'] == 1) {
        $fields['Nombre'] = $_FILES['userfile']['name'];
      }
    }

    echo json_encode($info);
  }

}
