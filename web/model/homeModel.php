<?php

class homeModel extends Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function getConfig()
  {
    $info['table'] = [
      't1' => 'config',
      't2' => 'provincias'
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Nombre' => 'Provincia'
    ];

    $info['joins'] = [
      ['LEFT', 't1.ProvinciaID=t2.ID']
    ];

    $data = new TableJoin($info);
    return $data->resultSet('single');
  }

  public function getUserByID($userId)
  {
    $query = [
      'table' => 'usuarios',
      'where' => "ID=" . $userId
    ];
    return $this->where($query);
  }

  public function getUserByEmail($email)
  {
    $query = [
      'table' => 'usuarios',
      'where' => "Email='" . $email . "'",
    ];
    return $this->where($query);
  }

  public function getUserConfirmation($email, $token)
  {
    $query = [
      'table' => 'usuarios',
      'where' => "Email='" . $email . "' AND Token='" . $token . "'",
    ];
    return $this->where($query);
  }

  public function getCompanyConfirmation($email, $token)
  {
    $query = [
      'table' => 'empresas',
      'where' => "Email='" . $email . "' AND Token='" . $token . "'",
    ];
    return $this->where($query);
  }

  public function getCompanyByEmail($email)
  {
    $query = [
      'table' => 'empresas',
      'where' => "Email='" . $email . "'",
    ];
    return $this->where($query);
  }

  public function getCompanyByCuit($cuit)
  {
    $cuit = str_replace('-', '', $cuit);
    $query = [
      'table' => 'empresas',
      'where' => "CUIT='" . $cuit . "'",
    ];
    return $this->where($query);
  }

  public function getCompanyByID($empresaId)
  {
    $query = [
      'table' => 'empresas',
      'where' => "ID=" . $empresaId
    ];
    return $this->where($query);
  }

  public function getSubscription($userId)
  {
    $query = [
      'table' => 'plan_usuario',
      'where' => "UsuarioID=" . $userId
    ];
    return $this->where($query);
  }

  public function getPlanByUsuario($userId)
  {
    $query = [
      'table' => 'plan_usuario',
      'where' => "UsuarioID=" . $userId
    ];
    $row = $this->where($query);
    return !empty($row) ? $row['PlanID'] : 0;
  }

  public function getPlanByEmpresa($userId)
  {
    $query = [
      'table' => 'plan_empresa',
      'where' => "EmpresaID=" . $userId
    ];
    $row = $this->where($query);
    return !empty($row) ? $row['PlanID'] : 0;
  }

  public function getSubscriptionCompany($empresaId)
  {
    $query = [
      'table' => 'plan_empresa',
      'where' => "EmpresaID=" . $empresaId
    ];
    return $this->where($query);
  }

  public function getPayments()
  {
    $query = [
      'table' => 'formas_pago',
      'where' => "Publico=1"
    ];

    return $this->all($query);
  }

  public function getUser($usuario, $password)
  {
    $query = [
      'table' => 'usuarios',
      'where' => "Email='" . $usuario . "' "
        . "AND Contrasenia='" . $password . "'"
    ];
    return $this->where($query);
  }

  public function getCompany($usuario, $password)
  {
    $query = [
      'table' => 'empresas',
      'where' => "Email='" . $usuario . "' "
        . "AND Contrasenia='" . $password . "'"
    ];
    return $this->where($query);
  }

  public function getOrden($ordenId)
  {
    $query = [
      'table' => 'ordenes',
      'where' => 'ID=' . $ordenId
    ];
    return $this->where($query);
  }

  public function getNotaPedido($ordenId, $userId)
  {
    $query = [
      'table' => 'ordenes',
      'where' => 'ID=' . $ordenId . ' AND UsuarioID=' . $userId
    ];
    $row = $this->where($query);
    return $row ? $row['Archivo'] : 'none';
  }

  public function getOrdenes($userId)
  {
    $info['table'] = [
      't1' => 'ordenes',
      't2' => 'comprobantes',
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Nombre' => 'Comprobante'
    ];

    $info['joins'] = [
      ['LEFT', 't1.ComprobanteID=t2.ID']
    ];

    $info['where'] = 'UsuarioID=' . $userId;
    $info['order'] = 't1.TimeCreate DESC';
    $data = new TableJoin($info);
    return $data->resultSet();
  }

  public function getOrdenDetalle($userId, $ordenId)
  {
    $info['table'] = [
      't1' => 'orden_detalle',
      't2' => 'planes',
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Nombre' => 'Plan'
    ];

    $info['joins'] = [
      ['LEFT', 't1.ProductoID=t2.ID']
    ];

    $info['where'] = 't1.UsuarioID=' . $userId . ' AND t1.OrdenID=' . $ordenId;
    $data = new TableJoin($info);
    return $data->resultSet('all');
  }

  public function getCandidato($id)
  {
    $info['table'] = [
      't1' => 'usuarios',
      't2' => 'provincias'
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Nombre' => 'Provincia'
    ];

    $info['joins'] = [
      ['LEFT', 't1.ProvinciaID=t2.ID']
    ];

    $info['where'] = 't1.Publico=1 AND t1.ID=' . $id;
    $data = new TableJoin($info);
    return $data->resultSet('single');
  }

  public function getPost($id)
  {
    $info['table'] = [
      't1' => 'posts',
      't2' => 'categorias'
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Nombre' => 'Categoria'
    ];

    $info['joins'] = [
      ['LEFT', 't1.CategoriaID=t2.ID']
    ];

    $info['where'] = 't1.ID=' . $id;
    $data = new TableJoin($info);

    return $data->resultSet('single');
  }

  public function getGaleriaPost($id)
  {
    $query = [
      'table' => 'archivos',
      'field' => 'Titulo,Imagen',
      'where' => "Tabla='posts' AND TablaID=" . $id
    ];
    return $this->all($query);
  }

  public function getBannerTop($limit = 10)
  {
    $query = [
      'table' => 'banner_top',
      'where' => "Publico=1 AND IsEmpresa=0",
      'order' => 'Posicion',
      'limit' => $limit
    ];

    return $this->all($query);
  }

  public function getBannerMobile($limit = 10)
  {
    $query = [
      'table' => 'banner_box',
      'where' => "Publico=1 AND IsEmpresa=0",
      'order' => 'Posicion',
      'limit' => $limit
    ];

    return $this->all($query);
  }

  public function getBannerMobileEmpresa($limit = 10)
  {
    $query = [
      'table' => 'banner_box',
      'where' => "Publico=1 AND IsEmpresa=1",
      'order' => 'Posicion',
      'limit' => $limit
    ];

    return $this->all($query);
  }

  public function getBannerTopEmpresa($limit = 10)
  {
    $query = [
      'table' => 'banner_top',
      'where' => "Publico=1 AND IsEmpresa=1",
      'order' => 'Posicion',
      'limit' => $limit
    ];

    return $this->all($query);
  }

  public function getCategorias()
  {
    $query = [
      'table' => 'categorias',
      'field' => 'ID,Nombre,URL',
      'where' => "Publico=1",
    ];
    return $this->all($query);
  }

  public function getSeccionByID($id)
  {
    $query = [
      'table' => 'secciones',
      'where' => 'ID=' . $id
    ];

    return $this->where($query);
  }

  public function getNameSeccionByID($id)
  {
    $query = [
      'table' => 'secciones',
      'where' => 'ID=' . $id
    ];

    $row = $this->where($query);
    return $row ? $row['Titulo'] : '';
  }

  public function getSeccion($url)
  {
    $info['table'] = [
      't1' => 'secciones',
      't2' => 'plantillas'
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Archivo' => '',
      't2.IsHeader' => ''
    ];

    $info['joins'] = [
      ['LEFT', 't1.PlantillaID=t2.ID']
    ];

    $info['where'] = "t1.URL='" . $url . "'";
    $data = new TableJoin($info);

    return $data->resultSet('single');
  }

  public function getSubsecciones($id)
  {
    $query = [
      'table' => 'secciones',
      'where' => "PadreID=" . $id
    ];

    return $this->all($query);
  }

  public function getMeta($tabla, $id)
  {
    $query = [
      'table' => 'meta',
      'where' => "Tabla='" . $tabla . "' AND TablaID=" . $id
    ];

    return $this->where($query);
  }

  public function getParrafos($tabla, $id)
  {
    $query = [
      'table' => 'parrafos',
      'where' => "Tabla='" . $tabla . "' AND TablaID=" . $id
    ];

    return $this->all($query);
  }

  public function getGaleria($tabla, $id)
  {
    $query = [
      'table' => 'archivos',
      'where' => "Tabla='" . $tabla . "' AND TablaID=" . $id
    ];

    return $this->all($query);
  }

  public function showLastPosts($limit = 6)
  {
    $info['table'] = [
      't1' => 'posts',
      't2' => 'categorias'
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Nombre' => 'Categoria'
    ];

    $info['joins'] = [
      ['LEFT', 't1.CategoriaID=t2.ID']
    ];

    $info['where'] = 't1.Publico=1';
    $info['order'] = 't1.Fecha DESC';
    $info['limit'] = $limit;

    $data = new TableJoin($info);
    return $data->resultSet('all');
  }

  public function showDestacados($limit = 3)
  {
    $info['table'] = [
      't1' => 'posts',
      't2' => 'categorias'
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Nombre' => 'Categoria'
    ];

    $info['joins'] = [
      ['LEFT', 't1.CategoriaID=t2.ID']
    ];

    $info['where'] = 't1.Destacado=1';
    $info['order'] = 't1.Fecha DESC';
    $info['limit'] = $limit;

    $data = new TableJoin($info);
    return $data->resultSet('all');
  }

  public function showPosts($page = 1, $categoriaId = false)
  {
    $where = '';
    $info['table'] = [
      't1' => 'posts',
      't2' => 'categorias'
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Nombre' => 'Categoria'
    ];

    $info['joins'] = [
      ['LEFT', 't1.CategoriaID=t2.ID']
    ];

    if ($categoriaId) {
      $where = ' AND t1.CategoriaID=' . $categoriaId;
    }

    $info['where'] = 't1.Publico=1' . $where;
    $info['order'] = 't1.Fecha DESC';

    $data = new TableJoin($info);
    $query = $data->strQuery();
    $paginator = new Paginator($page, $query);

    try {
      $rows = $paginator->paginate();
      $links = $paginator->getLinks();

      $list = [];
      if ($rows) {
        foreach ($rows as $item) {
          $list[$item['ID']] = $item;
          $list[$item['ID']]['images'] = $this->getGaleriaPost($item['ID']);
        }
      }
      $result['items'] = $list;
      $result['links'] = $links;

      return $result;
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function getMoneda($id = false)
  {
    $query = [
      'table' => 'monedas',
      'where' => 'ID=' . $id
    ];
    return $this->where($query);
  }

  public function getRedes()
  {
    $query = [
      'table' => 'redes',
      'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function getTracking($ip)
  {
    $query = [
      'table' => 'sys_tracking',
      'where' => "IP='" . $ip . "' AND TimeUpdate LIKE '%" . date('Y-m-d') . "%'",
      'limit' => 1
    ];
    $row = $this->where($query);
    return $row ? count($row) : 0;
  }

  public function getRespuestas($userId)
  {
    $query = [
      'table' => 'test_responses',
      'where' => 'UsuarioID=' . $userId
    ];
    return $this->where($query);
  }

  public function cancelPlanUsuario($planId, $userId)
  {
    $fields['Cancelado'] = 1;
    $fields['FechaBaja'] = date('Y-m-d H:i:s');
    $fields['FechaFinal'] = date('Y-m-t');
    return $this->update('plan_usuario', $fields, "PlanID=" . $planId . " AND UsuarioID=" . $userId);
  }

  public function cancelPlanEmpresa($planId, $companyId)
  {
    $fields['Cancelado'] = 1;
    $fields['FechaBaja'] = date('Y-m-d H:i:s');
    $fields['FechaFinal'] = date('Y-m-t');
    return $this->update('plan_empresa', $fields, "PlanID=" . $planId . " AND EmpresaID=" . $companyId);
  }

  public function saveProfile($fields, $id)
  {
    return $this->update('usuarios', $fields, "ID=" . $id);
  }

  public function saveProfileCompany($fields, $id)
  {
    return $this->update('empresas', $fields, "ID=" . $id);
  }

  public function saveUserPassword($password, $id)
  {
    $fields['Contrasenia'] = $password;
    return $this->update('usuarios', $fields, "ID=" . $id);
  }

  public function saveUserToken($token, $id)
  {
    $fields['Token'] = $token;
    return $this->update('usuarios', $fields, "ID=" . $id);
  }

  public function saveUserActive($id)
  {
    $fields['Publico'] = 1;
    $fields['Token'] = '';
    return $this->update('usuarios', $fields, "ID=" . $id);
  }

  public function saveCompanyActive($id)
  {
    $fields['Publico'] = 1;
    $fields['Token'] = '';
    return $this->update('empresas', $fields, "ID=" . $id);
  }

  public function saveCompanyPassword($password, $id)
  {
    $fields['Contrasenia'] = $password;
    return $this->update('empresas', $fields, "ID=" . $id);
  }

  public function saveCompanyToken($token, $id)
  {
    $fields['Token'] = $token;
    return $this->update('empresas', $fields, "ID=" . $id);
  }

  public function saveBloque($num, $json, $userId)
  {
    $row = $this->getRespuestas($userId);
    $fields['Bloque' . $num] = $json;

    if (!$row) {
      $fields['UsuarioID'] = $userId;
      $fields['TestID'] = 1;
      $fields['TimeCreate'] = $fields['TimeUpdate'] = date('Y-m-d H:i:s');
      $this->save('test_responses', $fields);
    } else {
      $fields['TimeUpdate'] = date('Y-m-d H:i:s');
      $this->update('test_responses', $fields, "UsuarioID=" . $userId);
    }
  }

  public function saveBloqueTest($bloque, $preguntaId, $respuesta, $userId)
  {
    $row = $this->getRespuestaBloque($bloque, $preguntaId, $userId);

    if (empty($row)) {
      $fields['UsuarioID'] = $userId;
      $fields['PreguntaID'] = $preguntaId;
      $fields['Texto'] = $respuesta;
      $fields['Bloque'] = $bloque;
      $fields['TimeCreate'] = $fields['TimeUpdate'] = date('Y-m-d H:i:s');
      $this->save('respuestas', $fields);
    } else {
      $fields['TimeUpdate'] = date('Y-m-d H:i:s');
      $this->update('respuestas', $fields, 'Bloque=' . $bloque . ' AND PreguntaID=' . $preguntaId . ' AND UsuarioID=' . $userId);
    }
  }

  public function getRespuestasTest($userId)
  {
    $result = [];
    $query = [
      'table' => 'respuestas',
      'where' => 'UsuarioID=' . $userId
    ];
    $rows = $this->all($query);

    if (!empty($rows)) {
      foreach ($rows as $item) {
        $result[$item['PreguntaID']] = $item['Texto'];
      }
    }
    return $result;
  }

  public function getRespuestaBloque($bloque, $preguntaId, $userId)
  {
    $query = [
      'table' => 'respuestas',
      'where' => 'Bloque=' . $bloque . ' AND PreguntaID=' . $preguntaId . ' AND UsuarioID=' . $userId
    ];
    return $this->where($query);
  }

  public function getProvincias()
  {
    $query = [
      'table' => 'provincias',
      'order' => 'Nombre'
    ];
    return $this->all($query);
  }

  public function getPlanUsuario($planId)
  {
    $query = [
      'table' => 'planes',
      'field' => 'ID,Nombre,Precio',
      'where' => 'CategoriaID=1 AND ID=' . $planId
    ];
    return $this->where($query);
  }

  public function getPlanEmpresa($planId)
  {
    $query = [
      'table' => 'planes_empresa',
      'field' => 'ID,Nombre,Precio',
      'where' => 'ID=' . $planId
    ];
    return $this->where($query);
  }

  public function getPlanesUsuario()
  {
    $query = [
      'table' => 'planes',
      'order' => 'ID ASC'
    ];
    return $this->all($query);
  }

  public function getPlanesEmpresa()
  {
    $query = [
      'table' => 'planes_empresa',
      'order' => 'ID ASC'
    ];
    return $this->all($query);
  }

  public function getAreasTrabajo()
  {
    $query = [
      'table' => 'areas_trabajos',
      'order' => 'Nombre'
    ];
    return $this->all($query);
  }

  public function getCandidatos($limit = 10)
  {
    $info['table'] = [
      't1' => 'usuarios',
      't2' => 'provincias',
      't3' => 'areas_trabajos',
      't4' => 'disponibilidad',
      't5' => 'nivel_educativo'
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Nombre' => 'Provincia',
      't4.Nombre' => 'TDisponibilidad',
      't5.Nombre' => 'TNivelEdu'
    ];

    $info['joins'] = [
      ['LEFT', 't1.ProvinciaID=t2.ID'],
      ['LEFT', 't1.AreaL=t3.ID'],
      ['LEFT', 't1.Disponibilidad=t4.ID'],
      ['LEFT', 't1.NivelEdu=t5.ID']
    ];

    $info['where'] = 't1.Publico=1 AND t1.FotoValida=1';
    $info['limit'] = $limit;
    $data = new TableJoin($info);
    return $data->resultSet('all');
  }

  public function getCandidatosEmpresa($limit = 100)
  {
    $info['table'] = [
      't1' => 'usuarios',
      't2' => 'provincias',
      't3' => 'areas_trabajos',
      't4' => 'disponibilidad',
      't5' => 'nivel_educativo'
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Nombre' => 'Provincia',
      't4.Nombre' => 'TDisponibilidad',
      't5.Nombre' => 'TNivelEdu'
    ];

    $info['joins'] = [
      ['LEFT', 't1.ProvinciaID=t2.ID'],
      ['LEFT', 't1.AreaL=t3.ID'],
      ['LEFT', 't1.Disponibilidad=t4.ID'],
      ['LEFT', 't1.NivelEdu=t5.ID']
    ];

    $info['where'] = 't1.Publico=1';
    $info['limit'] = $limit;
    $info['order'] = 't1.TimeCreate DESC';
    $data = new TableJoin($info);
    return $data->resultSet('all');
  }

  public function searchCandidatos($area = '', $province = [], $time = '', $date = '', $key = '', $page = 1, $order = '')
  {
    $aWhere[] = 't1.Publico=1 AND t1.FotoValida=1';

    if (!empty($area)) {
      $aWhere[] = 't1.AreaL=' . $area;
    }

    if (!empty($province)) {
      $aWhere[] = 't1.ProvinciaID IN (' . implode(',', $province) . ')';
    }

    if (!empty($time)) {
      $aWhere[] = 't1.Disponibilidad=' . $time;
    }

    if (!empty($date)) {
      $aWhere[] = 't1.TimeCreate >= NOW() - INTERVAL ' . $date . ' DAY';
    }

    if (!empty($area)) {
      $aWhere[] = 't1.AreaL=' . $area;
    }

    $info['table'] = [
      't1' => 'usuarios',
      't2' => 'provincias',
      't3' => 'areas_trabajos',
      't4' => 'disponibilidad',
      't5' => 'nivel_educativo'
    ];

    $info['columns'] = [
      't1.*' => '',
      't2.Nombre' => 'Provincia',
      't4.Nombre' => 'TDisponibilidad',
      't5.Nombre' => 'TNivelEdu'
    ];

    $info['joins'] = [
      ['LEFT', 't1.ProvinciaID=t2.ID'],
      ['LEFT', 't1.AreaL=t3.ID'],
      ['LEFT', 't1.Disponibilidad=t4.ID'],
      ['LEFT', 't1.NivelEdu=t5.ID']
    ];

    if (!empty($key)) {
      $aWhere[] = "(
      t1.Nombre LIKE '%" . $key . "%' OR 
      t1.Ocupacion LIKE '%" . $key . "%' OR
      t1.AreaO LIKE '%" . $key . "%' OR
      t1.AreaE LIKE '%" . $key . "%' OR
      t1.Puesto LIKE '%" . $key . "%' OR
      t3.Nombre LIKE '%" . $key . "%' OR
      t2.Nombre LIKE '%" . $key . "%'
      )";
    }

    $orderBy = 't1.TimeCreate DESC';
    if (!empty($order)) {
      if ($order == 'recent') {
        $orderBy = 't1.TimeCreate DESC';
      } else {
        $aWhere[] = "t1.Disponibilidad=" . $order;
      }
    }

    $info['where'] = implode(' AND ', $aWhere);
    $info['order'] = $orderBy;
    $data = new TableJoin($info);
    $query = $data->strQuery();
    //
    $paginator = new Paginator($page, $query);
    $result['items'] = $paginator->paginate();
    $result['links'] = $paginator->getLinks();

    return $result;
  }

  public function getProvincia($id)
  {
    $query = [
      'table' => 'provincias',
      'where' => 'ID=' . $id
    ];
    return $this->all($query);
  }

  public function getDepartamento($id)
  {
    $query = [
      'table' => 'departamentos',
      'where' => 'ID=' . $id
    ];
    return $this->all($query);
  }

  public function getPostulaciones()
  {
    $query = [
      'table' => 'postulaciones',
      'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function getDisponibilidad()
  {
    $query = [
      'table' => 'disponibilidad',
      'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function getCandidatosByEmpresa($empresaId)
  {
    $query = [
      'table' => 'candidatos_empresa',
      'where' => 'EmpresaID=' . $empresaId
    ];
    return $this->all($query);
  }

  public function getBusquedas($empresaId)
  {
    $query = [
      'table' => 'busquedas',
      'where' => 'EmpresaID=' . $empresaId
    ];
    return $this->all($query);
  }

  public function getTests($planId = 0)
  {
    $query = [
      'table' => 'tests',
      'where' => 'Publico=1 AND FIND_IN_SET(' . $planId . ',PlanID)'
    ];

    return $this->all($query);
  }

  public function getPreguntas($testId = 0)
  {
    $query = [
      'table' => 'preguntas',
      'where' => 'TestID=' . $testId
    ];
    return $this->all($query);
  }

  public function getTest($testId = 0)
  {
    $query = [
      'table' => 'tests',
      'where' => 'Publico=1 AND ID=' . $testId
    ];
    return $this->where($query);
  }

  public function getBolsaTrabajo()
  {
    $query = [
      'table' => 'ofertas',
      'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function getGrupoFamiliar()
  {
    $query = [
      'table' => 'grupo_familiar',
      'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function getNivelEducativo()
  {
    $query = [
      'table' => 'nivel_educativo',
      'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function getNivelInformatico()
  {
    $query = [
      'table' => 'nivel_informatico',
      'where' => 'Publico=1'
    ];
    return $this->all($query);
  }

  public function getDepartamentosByID($provId)
  {
    $query = [
      'table' => 'departamentos',
      'field' => 'ID, Nombre',
      'where' => 'ProvinciaID=' . $provId,
      'order' => 'Nombre'
    ];
    return $this->all($query);
  }

  public function getSubscribe($email)
  {
    $query = [
      'table' => 'news_email',
      'where' => "Email='" . $email . "'",
    ];
    return $this->where($query);
  }

  public function savePlanUsuario($planId, $userId)
  {
    $fields['PlanID'] = $planId;
    $fields['UsuarioID'] = $userId;
    return $this->save('plan_usuario', $fields);
  }

  public function savePlanEmpresa($planId, $userId)
  {
    $fields['PlanID'] = $planId;
    $fields['EmpresaID'] = $userId;
    return $this->save('plan_empresa', $fields);
  }

  public function saveTracking($fields)
  {
    return $this->save('sys_tracking', $fields);
  }

  public function saveRegister($fields)
  {
    $fields['Publico'] = 0;
    return $this->save('usuarios', $fields);
  }

  public function saveRegisterCompany($fields)
  {
    $fields['Publico'] = 0;
    return $this->save('empresas', $fields);
  }

  public function saveSubscribe($fields)
  {
    return $this->save('news_email', $fields);
  }

  public function saveDireccion($fields)
  {
    return $this->save('usuarios', $fields);
  }

  public function saveDireccionEmpresa($fields)
  {
    return $this->save('empresas', $fields);
  }

  public function saveDireccionEnvio($fields)
  {
    return $this->save('direcciones', $fields);
  }

  public function saveAccess($fields)
  {
    return $this->save('usuarios', $fields);
  }

  public function saveAccessCompany($fields)
  {
    return $this->save('empresas', $fields);
  }

  public function saveOrdenPedido($fields)
  {
    return $this->save('ordenes', $fields);
  }

  public function saveOrdenPedidoUsuario($ordenId, $filePDF)
  {
    $fields['ID'] = $ordenId;
    $fields['Archivo'] = $filePDF;
    $fields['Tabla'] = 'usuarios';
    return $this->save('ordenes', $fields);
  }

  public function saveOrdenPedidoEmpresa($ordenId, $filePDF)
  {
    $fields['ID'] = $ordenId;
    $fields['Archivo'] = $filePDF;
    $fields['Tabla'] = 'empresas';
    return $this->save('ordenes', $fields);
  }

  public function saveOrdenDetalle($details, $ordenId, $userId)
  {
    if (count($details) > 0) {
      foreach ($details as $item) {
        $item['OrdenID'] = $ordenId;
        $item['UsuarioID'] = $userId;
        $this->save('orden_detalle', $item);
      }
    }
  }

  public function saveSesion($fields)
  {
    return $this->save('sesiones', $fields);
  }

  public function saveUser($fields)
  {
    return $this->save('usuarios', $fields);
  }

  public function saveAreaLaboral($nombre)
  {
    $fields['Nombre'] = $nombre;
    return $this->save('areas_trabajos', $fields);
  }

  public function saveNivelEducativo($nombre)
  {
    $fields['Nombre'] = $nombre;
    return $this->save('nivel_educativo', $fields);
  }
}
