<?php

class productosController extends Controller
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
    $headers['Nombre'] = ['title' => 'Nombre', 'sort' => 'sisort', 'align' => 'left'];
    $headers['CategoriaID'] = ['title' => 'Categoría', 'sort' => 'sisort', 'align' => 'center'];
    $headers['Moneda'] = ['title' => 'Moneda', 'sort' => 'sisort', 'align' => 'center', 'width' => 50];
    $headers['Precio'] = ['title' => 'Precio', 'sort' => 'sisort', 'align' => 'center'];
    $headers['Descuento'] = ['title' => 'Descuento', 'sort' => 'sisort', 'align' => 'center'];
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

    $data['type'] = !empty($_POST['filtro']) ? $_POST['filtro'] : '-';
    $data['categoria'] = !empty($_POST['categoria']) ? $_POST['categoria'] : '-';
    $data['marca'] = !empty($_POST['marca']) ? $_POST['marca'] : '-';

    if (Validate::integer('listar', true) == 1) {
      $opt = Sanitize::integer('accion', true);
      $ids = $_POST['selected'];

      if ($opt == 4) {
        $this->model->deleteProductos($ids);
      }
      if ($opt == 8) {
        $this->duplicar($ids);
      }
    }

    $data['categorias'] = $this->model->getCategorias();
    $data['marcas'] = $this->model->getMarcas();
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
      $nombre = Sanitize::string($fields['Nombre']);

      $data['meta'] = isset($_POST['meta']) ? $_POST['meta'] : [];
      $data['galeria'] = isset($_POST['gallery']) ? $_POST['gallery'] : [];

      if (empty($nombre)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar el Nombre');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['PubliFace'] = isset($fields['PubliFace']) ? $fields['PubliFace'] : 0;
      $fields['PubliInst'] = isset($fields['PubliInst']) ? $fields['PubliInst'] : 0;
      $fields['Destacado'] = !empty($fields['Destacado']) ? $fields['Destacado'] : 0;
      $fields['Precio'] = !empty($fields['Precio']) ? $fields['Precio'] : 0;
      $fields['UsuarioID'] = Session::get('user_id');

      $id = $this->model->updateProducto($fields);
      $this->model->updateMeta($data['meta'], $id);
      $this->model->updateGaleria($data['galeria'], $id);

      if ($fields['PubliFace'] == 1) {
        $this->publishFacebook($id, $fields['Titulo'], $fields['Descripcion'], $fields['URL'], $data['galeria']);
      }

      if ($fields['PubliInst'] == 1) {
        $this->publishInstagram($id, $fields['Titulo'], $fields['Descripcion'], $fields['URL'], $data['galeria']);
      }

      Url::redirect($this->baseUrl . 'listar');
    }

    $data['categorias'] = $this->model->getCategorias();
    $data['disponibilidad'] = $this->model->getDisponibilidad();
    $data['generos'] = $this->model->getGeneros();
    $data['marcas'] = $this->model->getMarcas();
    $data['monedas'] = $this->model->getMonedas();
    $data['filiales'] = $this->model->getFiliales();
    $data['condiciones'] = $this->model->getCondiciones();
    $data['grupoetario'] = $this->model->getGrupoEtario();

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
      $nombre = Sanitize::string($fields['Nombre']);

      $data['meta'] = isset($_POST['meta']) ? $_POST['meta'] : [];
      $data['galeria'] = isset($_POST['gallery']) ? $_POST['gallery'] : [];

      if (empty($nombre)) {
        $data['alert'] = Helper::alertMessage('danger', 'Debe ingresar el Nombre');
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $fields['ID'] = $id;
      $fields['PubliFace'] = isset($fields['PubliFace']) ? $fields['PubliFace'] : 0;
      $fields['PubliInst'] = isset($fields['PubliInst']) ? $fields['PubliInst'] : 0;
      $fields['Destacado'] = isset($fields['Destacado']) ? $fields['Destacado'] : 0;
      $fields['UsuarioID'] = Session::get('user_id');
      //
      $this->model->updateProducto($fields);
      $this->model->updateMeta($data['meta'], $id);
      $this->model->updateGaleria($data['galeria'], $id);

      if ($fields['PubliFace'] == 1) {
        $this->publishFacebook($id, $fields['Nombre'], $fields['Descripcion'], $fields['URL'], $data['galeria']);
      }

      if ($fields['PubliInst'] == 1) {
        $this->publishInstagram($id, $fields['Nombre'], $fields['Descripcion'], $fields['URL'], $data['galeria']);
      }

      Url::redirect($this->baseUrl . 'listar');
    }

    $data[$this->tabla] = $this->model->getProducto($id);
    $data['categorias'] = $this->model->getCategorias();
    $data['monedas'] = $this->model->getMonedas();
    $data['marcas'] = $this->model->getMarcas();
    $data['meta'] = $this->model->getMeta($id);
    $data['galeria'] = $this->model->getGaleria($id);
    $data['filiales'] = $this->model->getFiliales();
    $data['disponibilidad'] = $this->model->getDisponibilidad();
    $data['generos'] = $this->model->getGeneros();
    $data['condiciones'] = $this->model->getCondiciones();
    $data['grupoetario'] = $this->model->getGrupoEtario();

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function filter($publico = '', $categoria = '', $marca = '')
  {
    $aWhere = [];

    $info['table'] = [
      't1' => $this->tabla,
      't2' => 'cateprod',
      't3' => 'monedas'
    ];

    $info['columns'] = [
      't1.ID' => '',
      't1.Imagen' => '',
      't1.Nombre' => '',
      't2.Nombre' => 'Categoria',
      't3.Codigo' => 'Moneda',
      't1.Precio' => '',
      't1.Descuento' => '',
      't1.Publico' => ''
    ];

    $info['joins'] = [
      ['LEFT', 't1.CategoriaID = t2.ID'],
      ['LEFT', 't1.MonedaID = t3.ID']
    ];

    if (!empty($publico) && $publico != '-') {
      $aWhere[] = $publico == 1 ? 't1.Publico=1' : 't1.Publico=0';
    }
    if (!empty($categoria) && $categoria != '-') {
      $aWhere[] = 't1.CategoriaID=' . $categoria;
    }
    if (!empty($marca) && $marca != '-') {
      $aWhere[] = 't1.MarcaID=' . $marca;
    }

    $info['where'] = count($aWhere) > 0 ? implode(' AND ', $aWhere) : '';
    $info['order'] = 't1.TimeUpdate DESC';

    $grid = new DataTablesJoin($info, [$this, 'setRowsExtra'], [$this, 'addActions']);
    echo $grid->render();
  }

  public function setRowsExtra($key = '', $value = null)
  {
    $row = '';

    switch ($key) {
      case 'version':
        $row = ($value == "0") ? '-' : $value;
        break;
      case 'ID':
        $row = Helper::input(array('type' => 'checkbox', 'value' => $value, 'name' => 'selected[]'));
        break;
      case 'Nombre':
        $row = utf8_encode($value);
        break;
      case 'Descuento':
        $row = !empty($value) ? $value . '%' : '-';
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

  public function addActions($row)
  {
    $urlProd = $this->model->getURLProducto($row['ID']);
    $urlEdit = URL_CMS . $this->tabla . '/editar/' . $row['ID'];
    $urlShow = URL_WEB . 'producto/' . $row['ID'] . '/' . $urlProd;

    $icon1 = Helper::tag2('i', '', ['class' => 'fa fa-external-link']);
    $link1 = Helper::tag2('a', $icon1 . ' Ver', ['class' => 'btn btn-success btn-sm', 'href' => $urlShow, 'target' => '_blank']);
    $icon2 = Helper::tag2('i', '', ['class' => 'fa fa-edit']);
    $link2 = Helper::tag2('a', $icon2 . ' Editar', ['class' => 'btn btn-info btn-sm', 'href' => $urlEdit]);

    return $link1 . ' ' . $link2;
  }

  public function duplicar($ids)
  {
    $propId = $ids[0];
    $newId = $this->model->duplicateProducto($propId);

    if ($newId) {
      $this->model->duplicateGaleria($newId, $propId);
      $this->model->duplicateMeta($newId, $propId);

      Url::redirect($this->baseUrl . 'editar/' . $newId);
    } else {
      die('Error al duplicar producto');
    }
  }

  public function publishFacebook($propId, $title, $description = '', $urlPost = '', $photos = [])
  {
    $config = $this->model->getConfig(1);

    if (!$config) {
      die('Error: No se cargó correctamente la configuración del sitio!');
    }

    //DATOS DE CONFIGURACIÓN DEL MODULO
    define('APP_ID', $config['FAppID']);
    define('APP_SECRET', $config['FAppSecret']);
    define('USER_ID', $config['FUserID']);
    define('ACCESS_TOKEN', $config['FAccessToken']);

    //Load::library('Facebook/lib/config');
    Load::library('Facebook/vendor/autoload');
    Load::library('Facebook/lib/FacebookGallery');

    $photoPath = [];
    $url_base = URL_WEB;
    $urlImages = URL_GAL . 'productos/images/';
    $dirImages = GAL_PATH . DS . 'productos' . DS . 'images' . DS;

    if (count($photos) > 0) {
      foreach ($photos as $item) {
        if (file_exists($dirImages . 'IM_' . $item['Imagen'])) {
          $photoPath[] = $urlImages . 'IM_' . $item['Imagen'];
        }
      }
    }

    $caption = $title . "\n\n";
    $caption .= $description . "\n\n";
    $caption .= 'Enlace: ' . $url_base . 'producto/' . $propId . '/' . $urlPost . "\n\n";
    $caption1 = preg_replace("/<[^>]*>/i", "", $caption);
    $caption2 = Helper::cleaningString($caption1);
//    echo $caption . '<br><br>';

    $fb = new FacebookGallery();
    $aPhotosId = $fb->uploadPhoto($photoPath);
    $fb->publishMultiPhotoStory($caption2, $aPhotosId);
  }

  public function publishInstagram($propId, $title, $description = '', $urlPost = '', $photos = [])
  {
    $config = $this->model->getConfig(1);

    if (!$config) {
      die('Error: No se cargó correctamente la configuración del sitio!');
    }

    //DATOS DE CONFIGURACIÓN DEL MODULO
    define('IUSER', $config['IUser']);
    define('IPASS', $config['IPass']);

    //Load::library('Instagram/lib/config');
    Load::library('Instagram/vendor/autoload');
    Load::library('Instagram/lib/InstagramGallery');

    $photoPath = [];
    $url_base = URL_WEB;
    $urlImages = GAL_PATH . 'productos' . DS . 'images' . DS;

    if (count($photos) > 0) {
      foreach ($photos as $item) {
        if (file_exists($urlImages . 'IM_' . $item['Imagen'])) {
          $media = [
            'type' => 'photo',
            'file' => $urlImages . 'IM_' . $item['Imagen']
          ];

          $photoPath[] = $media;
        }
      }
    }

    $caption = $title . " ______ \n\n";
    $caption .= $description . "\n\n";
    $caption .= ' ______ Enlace: ' . $url_base . "\n\n";
    $caption = preg_replace("/<[^>]*>/i", "", $caption);
    $caption = Helper::cleaningString($caption);
//    echo $caption . '<br><br>';

    $ig = new InstagramGallery();
    $ig->publishMultiPhotoStory($caption, $photoPath);
  }

  public function upload()
  {
    echo $this->uploadImage($_FILES['userfile'], $this->config['PIAncho'], $this->config['PIAlto'], $this->config['PTAncho'], $this->config['PTAlto'], false);
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

    echo $id;
  }

}
