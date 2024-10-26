<?php

class exportcsvController extends Controller
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
    $headers['Archivo'] = ['title' => 'Archivo', 'sort' => 'sisort', 'align' => 'center'];
    $headers['FilialID'] = ['title' => 'Filial', 'sort' => 'sisort', 'align' => 'center'];
    $headers['Usuario'] = ['title' => 'Usuario', 'sort' => 'sisort', 'align' => 'center'];

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

      if (!empty($fields['Nombre'])) {
        $this->exportCSV($fields);
      } else {
        $data['alert'] = Helper::alertMessage('danger', 'Por favor, ingrese el nombre!');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      Url::redirect($this->baseUrl . 'listar');
    }

    $data['filiales'] = $this->model->getFiliales();
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function exportCSV($row)
  {
    $fechaIni = $fechaFin = false;
    $urlfil = $this->model->getFilial($row['FilialID']);
    $rutaFile = UP_PATH . 'files' . DS . $urlfil . DS . $row['Archivo'];
    @unlink($rutaFile);

    $csv = fopen($rutaFile, 'x+');
    $first = [
      'id', 'title', 'description', 'availability', 'inventory', 'condition', 'price', 'link',
      'image_link', 'brand', 'google_product_category', 'sale_price', 'sale_price_effective_date',
      'item_group_id', 'gender', 'color', 'size', 'age_group', 'material', 'pattern', 'product_type',
      'shipping', 'shipping_weight'
    ];

    $todos = isset($row['Todos']) ? $row['Todos'] : 0;

    if (!$todos) {
      $fechaIni = $row['FechaIni'];
      $fechaFin = $row['FechaFin'];
    }

    fputcsv($csv, $first);
    $productos = $this->model->getProductosCSV($row['FilialID'], $fechaIni, $fechaFin);

    if ($productos) {
      foreach ($productos as $item) {
        $precio_dscto = !empty($item['Descuento']) ?
          $item['Precio'] - ($item['Precio'] * ($item['Descuento'] / 100)) . ' ' . $item['Moneda'] : '';
        $fields['ID'] = 'F' . $item['FilialID'] . 'C'
          . Helper::completeNumbers($item['CategoriaID'], 3) . 'M'
          . Helper::completeNumbers($item['MarcaID'], 3) . 'ID'
          . Helper::completeNumbers($item['ID'], 6);
        $fields['Title'] = trim(utf8_decode(ucwords(strtolower($item['Nombre']))));
        $string = strip_tags(utf8_decode(html_entity_decode($item['Descripcion'])));
        $string = preg_replace("/[\r\n|\n|\r]+/", " ", $string);
        $string = str_replace(',', '.', $string);
        $string = str_replace('"', '', $string);
        $fields['Description'] = !empty($string) ? trim($string) : $fields['Title'];
        //Availability: in stock, available for order, preorder, out of stock, discontinued
        $fields['Availability'] = !empty($item['Disponible']) ? $item['Disponible'] : 'in stock';
        $fields['Inventory'] = !empty($item['Stock']) ? $item['Stock'] : 10;
        //Condition: new, refurbished, used
        $fields['Condition'] = !empty($item['Condicion']) ? $item['Condicion'] : 'new';
        $fields['Price'] = $item['Precio'] . ' ' . $item['Moneda'];
        $fields['Link'] = URL_WEB . 'producto/' . $item['ID'] . '/' . $item['URL'];
        $fields['ImageLink'] = URL_GAL . 'productos/images/IM_' . $item['Imagen'];
        $fields['Brand'] = utf8_decode($item['Marca']);
        $fields['GoogleProductCategory'] = '';
        $fields['SalePrice'] = $precio_dscto;
        //formato: YYYY-MM-DDT23:59+00:00/YYYY-MM-DDT23:59+00:00
        $fechaDscto = !empty($item['FechaIniD']) && !empty($item['FechaFinD']) ?
          $item['FechaIniD'] . 'T23:59-03:00/' . $item['FechaFinD'] . 'T23:59-03:00' : '';
        $fields['SalePriceEffectiveDate'] = $fechaDscto;
        $fields['ItemGroupID'] = '';
        //valores: female, male, unisex
        $fields['Gender'] = !empty($item['Genero']) ? $item['Genero'] : '';
        $fields['Color'] = !empty($item['Color']) ? $item['Color'] : '';
        $fields['Size'] = !empty($item['Talla']) ? $item['Talla'] : '';
        //valores: adult, all ages, teen, kids, toddler, infant, newborn
        $fields['AgeGroup'] = !empty($item['GEtario']) ? $item['GEtario'] : '';
        $fields['Material'] = !empty($item['Material']) ? utf8_decode($item['Material']) : '';
        $fields['Pattern'] = !empty($item['Modelo']) ? utf8_decode($item['Modelo']) : '';
        $fields['ProductType'] = utf8_decode($item['Categoria']);
        $fields['Shipping'] = !empty($item['Envio']) ? $item['Envio'] : '';
        $fields['ShippingWeight'] = !empty($item['Peso']) ? $item['Peso'] : '';

        $posImage = strpos($item['Imagen'], '.');

        if (!empty($item['Imagen']) && $posImage) {
          fputcsv($csv, $fields);
        }
      }
    }
    fclose($csv);
  }

  public function filial($filialId = false)
  {
    if ($filialId) {
      echo $this->model->getFilial($filialId);
    }
  }

  public function filter()
  {
    $info['table'] = [
      't1' => 'exportcsv',
      't2' => 'secciones',
      't3' => 'sys_users'
    ];

    $info['columns'] = [
      't1.ID' => '',
      't1.Fecha' => '',
      't1.Nombre' => '',
      't1.Archivo' => '',
      't2.URL' => 'Filial',
      't3.Nombre' => 'Usuario',
    ];

    $info['joins'] = [
      ['LEFT', 't1.FilialID=t2.ID'],
      ['INNER', 't1.UsuarioID=t3.ID'],
    ];

    $info['where'] = '';
    $info['order'] = 't1.Fecha DESC';

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
      case 'Filial':
        $row = ucfirst($value);
        break;
      default :
        $row = $value;
    }

    return $row;
  }

  public function addActions($row)
  {
    $urlShow = URL_WEB . 'files/' . $row['Filial'] . '/' . $row['Archivo'];
    $urlEdit = URL_CMS . 'productos' . '/listar';

    $link1 = Helper::tag2('a', ' Descargar CSV', [
        'class' => 'btn btn-info btn-sm',
        'href' => $urlShow,
        'target' => '_blank']);

    return $link1;
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
