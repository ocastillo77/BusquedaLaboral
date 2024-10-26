<?php

class UserController extends Controller
{

  const KEY_ENCRYPT = 'EncuentraTuPuesto';
  const IMG_WIDTH = 300;
  const IMG_HEIGHT = 600;

  private $model;
  private $config;
  private $userId;

  public function __construct()
  {
    parent::__construct();

    $this->initialize();
    $this->model = Load::model('home');
    $this->config = $this->model->getConfig();
    $this->userId = Session::get('wb_user_id');
  }

  public function index()
  {
    $data['title'] = 'Usuario';
    $data['banners'] = $this->model->getBannerTop();
    $data['bmobile'] = $this->model->getBannerMobile();
    $data['isMobile'] = $this->detectMobile();
    $data['candidatos'] = $this->model->getCandidatos();
    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function busqueda()
  {
    $data['title'] = 'Buscadores de Oportunidades';
    $area = $data['area'] = $_GET['area'] ?? '';
    $province = $data['province'] = $_GET['province'] ?? [];
    $time = $data['time'] = $_GET['time'] ?? '';
    $date = $data['date'] = $_GET['date'] ?? '';
    $order = $data['order'] = $_GET['order'] ?? '';
    $key = $data['key'] = $_GET['key'] ?? '';
    $page = $data['page'] = $_GET['page'] ?? 1;

    $data['candidatos'] = $this->model->searchCandidatos($area, $province, $time, $date, $key, $page, $order);
    $data['trabajos'] = $this->model->getAreasTrabajo();
    $data['provincias'] = $this->model->getProvincias();
    $data['disponibilidad'] = $this->model->getDisponibilidad();
    $data['niveles'] = $this->model->getDisponibilidad();

    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function profile($userId)
  {
    if (Validate::integer('update', true) != 1) {
      return;
    }

    if (empty($_POST['usuarios'])) {
      return;
    }

    $fields = $_POST['usuarios'];
    $errors = [
      'Nombre' => 'Por favor, ingrese su nombre',
      'Email' => 'Por favor, ingrese su correo electrónico',
      'Celular' => 'Por favor, ingrese su teléfono',
      'Contrasenia' => 'Por favor, ingrese su contraseña'
    ];

    foreach ($errors as $field => $message) {
      $$field = Sanitize::sql($fields[$field] ?? '');

      if (empty($$field)) {
        $this->showMessageError($message);
      }
    }

    $fields['ID'] = $userId;

    if ($this->model->saveUser($fields)) {
      Url::redirect('account/profile');
    }
  }

  private function showMessageError($message)
  {
    $data['error'] = [
      'message' => $message,
      'type' => 'danger'
    ];

    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
    exit;
  }

  public function account($url = '', $testId = 0)
  {
    if (Session::get('wb_active') == 0) {
      Url::redirect('login');
    }

    $tests = [];
    $userId = Session::get('wb_user_id');
    $user = $this->model->getUserByID($userId);
    $jobs = $this->model->getPostulaciones($userId);

    // Subscripción activa
    $subscripcion = $this->model->getSubscription($userId);

    if (!empty($subscripcion)) {
      $tests = $this->model->getTests($subscripcion['PlanID']);
    }

    $provincias = $this->model->getProvincias();
    $trabajos = $this->model->getAreasTrabajo();
    $grupos = $this->model->getGrupoFamiliar();
    $dispos = $this->model->getDisponibilidad();
    $niveles = $this->model->getNivelEducativo();
    $informatico = $this->model->getNivelInformatico();
    $planes = $this->model->getPlanesUsuario();

    // Respuestas del usuario
    $row = $this->model->getRespuestas($userId);
    $bloque2 = !empty($row['Bloque2']) ? Helper::convertArrayUnicodeToUTF8($row['Bloque2']) : [];
    $bloque3 = !empty($row['Bloque3']) ? Helper::convertArrayUnicodeToUTF8($row['Bloque3']) : [];
    $bloque4 = !empty($row['Bloque4']) ? Helper::convertArrayUnicodeToUTF8($row['Bloque4']) : [];
    $complete = $this->validateTestComplete($bloque2, $bloque3, $bloque4);

    $title = 'Mi Cuenta';
    $file = 'home';
    $testActual = $preguntas = $respuestas = [];

    if (!empty($url)) {
      switch ($url) {
        case 'profile':
          $title = 'Mi Perfil';
          $this->profile($userId);
          break;
        case 'jobs':
          $title = 'Mis Postulaciones';
          break;
        case 'alerts':
          $title = 'Bolsa de Trabajo';
          $alerts = $this->model->getBolsaTrabajo($userId);
          break;
        case 'tests':
          $title = 'Mis Tests';
          break;
        case 'test':
          if (!$subscripcion) {
            return Url::redirect('account/subscription');
          }

          $title = 'Mi Primer Test';         

          if ($testId == 1) {
            $url = 'test';
          } else {
            $testActual = $this->model->getTest($testId);
            $preguntas = $this->model->getPreguntas($testId);
            $respuestas = $this->model->getRespuestasTest($userId);
            $url = 'test2';
          }
          break;
        case 'subscription':
          $title = 'Mi Subscripción';
          break;
      }
    } else {
      $url = 'home';
    }

    $file = $url;
    $data = array_merge(
      $this->getModules(),
      compact(
        'title',
        'user',
        'jobs',
        'tests',
        'provincias',
        'trabajos',
        'grupos',
        'dispos',
        'niveles',
        'informatico',
        'bloque2',
        'bloque3',
        'bloque4',
        'complete',
        'subscripcion',
        'file',
        'planes',
        'preguntas',
        'respuestas',
        'testActual'
      )
    );

    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function validateTestComplete($bloque2, $bloque3, $bloque4)
  {
    $result = Helper::verifyCompleteArrays($bloque2, $bloque3, $bloque4, 6, 7, 7);

    if ($result) {
      $alert['type'] = 'success';
      $alert['message'] = 'El test se completó correctamente!';
      Session::set('alert-form', $alert);
      return 'SI';
    }
    return 'NO';
  }

  public function saveProfile($bloque1 = false)
  {
    $tabla = 'usuarios';
    $userId = Session::get('wb_user_id');

    if (!empty($_POST[$tabla])) {
      $fields = $_POST[$tabla];
      $this->model->saveProfile($fields, $userId);

      if ($bloque1) {
        Session::set('alert-form', [
          'type' => 'success',
          'message' => 'El Bloque 1 se guardó correctamente!'
        ]);
      }
    }

    $file = $bloque1 ? 'test/1/#bloque1' : '';
    Url::redirect('account/' . $file);
  }

  public function saveBloque($num = '')
  {
    $userId = Session::get('wb_user_id');
    $bloqueKey = 'bloque' . $num;

    if (!empty($_POST[$bloqueKey])) {
      $bloque = $_POST[$bloqueKey];
      $this->model->saveBloque($num, json_encode($bloque), $userId);

      Session::set('alert-form', [
        'type' => 'success',
        'message' => 'El Bloque ' . $num . ' se guardó correctamente!'
      ]);
    }

    Url::redirect('account/' . ($num ? 'test/1/#bloque' . $num : ''));
  }

  public function saveBloqueTest($num = '')
  {
    $userId = Session::get('wb_user_id');

    if (!empty($_POST['respuesta']) && !empty($_POST['bloque'])) {
      $respuestas = $_POST['respuesta'];
      $bloque = $_POST['bloque'];

      foreach ($respuestas as $preguntaId => $respuesta) {
        $this->model->saveBloqueTest($bloque, $preguntaId, $respuesta, $userId);
      }

      Session::set('alert-form', [
        'type' => 'success',
        'message' => 'El Bloque ' . $num . ' se guardó correctamente!'
      ]);
    }

    Url::redirect('account/' . ($num ? 'test2/2/#bloque' . $num : ''));
  }

  public function checkout($planId = null)
  {
    if (Session::get('wb_active') == 0) {
      Url::redirect('login');
    }

    if (!empty($planId)) {
      $this->addcart($planId);
    }

    $data = [
      'title' => 'Proceso de Pago',
      'step' => 2,
      'provincias' => $this->model->getProvincias()
    ];

    $user = $data['user'] = $this->model->getUserByID($this->userId);

    if (!empty($user['ProvinciaID'])) {
      $data['departamentos'] = $this->model->getDepartamentosByID($user['ProvinciaID']);
    }

    Session::set('wb_step', 'checkout');
    Session::set('wb_lasturl', 'checkout');

    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function billing()
  {
    if (Session::get('wb_active') == 0) {
      Url::redirect('login');
    }

    $data = [
      'title' => 'Por favor, complete sus datos!',
      'is_login' => false,
      'errors' => [],
      'provincias' => $this->model->getProvincias()
    ];

    if (Validate::integer('billing', true) == 1) {
      $fields = $_POST['usuarios'] ?? [];
      $celular = Sanitize::string($fields['Celular']);
      $cpostal = Sanitize::string($fields['CPostal']);
      $direccion = Sanitize::string($fields['Direccion']);
      $localidad = Sanitize::string($fields['Localidad']);
      $provinciaId = Sanitize::string($fields['ProvinciaID']);
      $departamentoId = Sanitize::string($fields['DepartamentoID']);
      $data['errors'] = $this->validateBillingFields(compact('celular', 'cpostal', 'direccion', 'localidad', 'provinciaId', 'departamentoId'));

      if (empty($data['errors'])) {
        $fields['ID'] = $this->userId;
        $this->model->saveDireccion($fields);
        Session::set('wb_step', 'billing');
        Session::set('sInfo', $fields);

        Url::redirect('payment');
      }
    }

    $user = $data['user'] = $this->model->getUserByID($this->userId);

    if (!empty($user['ProvinciaID'])) {
      $data['departamentos'] = $this->model->getDepartamentosByID($user['ProvinciaID']);
    }

    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  private function validateBillingFields($fields)
  {
    $errors = [];

    foreach ($fields as $field => $value) {
      if (empty($value)) {
        $errors[$field] = 'Por favor, ingrese su ' . strtolower($field);
      }
    }

    return $errors;
  }

  public function payment()
  {
    if (Session::get('wb_active') == 0) {
      Url::redirect('login');
    }

    $data = [
      'title' => 'Por favor, complete sus datos!',
      'is_login' => false,
      'errors' => [],
      'dirsend' => Session::get('wb_dirsend'),
      'info' => Session::get('sInfo') ?: false,
      'paymentId' => Session::get('wb_payment') ?: 1,
      'payments' => $this->model->getPayments(),
      'user' => $this->model->getUserByID($this->userId),
      'provincias' => $this->model->getProvincias()
    ];

    if (!empty($data['user']['ProvinciaID'])) {
      $data['departamentos'] = $this->model->getDepartamentosByID($data['user']['ProvinciaID']);
    }

    if (Validate::integer('payment', true) == 1) {
      $paymentId = $_POST['paymentid'] ?? null;

      if (empty($paymentId)) {
        $data['errors']['paymentid'] = 'Por favor, seleccione un método de pago!';
      }

      if (empty($data['errors'])) {
        Session::set('wb_step', 'payment');
        Session::set('wb_payment', $paymentId);
        $this->createPreference();
        Url::redirect('process');
      }
    }

    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function createPreference()
  {
    Load::library('MercadoPago/vendor/autoload');
    MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);

    $itemsPreference = [];
    $products = Session::get('wb_basket');
    $preference = new MercadoPago\Preference();

    if (!empty($products)) {
      foreach ($products as $product) {
        $item = new MercadoPago\Item();
        $item->title = $product['name'];
        $item->quantity = $product['quantity'];
        $item->unit_price = $product['price'];
        $itemsPreference[] = $item;
      }

      $preference->items = $itemsPreference;
    }

    $preference->back_urls = [
      "success" => URL_WEB . 'success',
      "failure" => URL_WEB . 'failure',
      "pending" => URL_WEB . 'pending',
    ];

    $preference->auto_return = "approved";
    $preference->save();

    Session::set('preferenceId', $preference->id);
  }

  public function getPreference()
  {
    if (Session::get('preferenceId') != null) {
      $response = [
        'publicKey' => MP_PUBLIC_KEY,
        'preferenceId' => Session::get('preferenceId')
      ];

      echo json_encode($response);
    }
  }

  public function process()
  {
    if (Session::get('wb_active') == 0) {
      Url::redirect('login');
    }

    $data = [
      'title' => 'Por favor, complete sus datos!',
      'is_login' => false,
      'errors' => [],
      'dirsend' => Session::get('wb_dirsend'),
      'info' => is_array(Session::get('sInfo')) ? Session::get('sInfo') : false,
      'paymentId' => Session::get('wb_payment') ?: 1,
      'payments' => $this->model->getPayments(),
      'user' => $this->model->getUserByID($this->userId),
      'provincias' => $this->model->getProvincias(),
    ];

    if (!empty($data['user']['ProvinciaID'])) {
      $data['s_departamentos'] = $this->model->getDepartamento($data['user']['DepartamentoID']);
      $data['s_provincias'] = $this->model->getProvincia($data['user']['ProvinciaID']);
      $data['departamentos'] = $data['dirsend'] == 1 ? $this->model->getDepartamentosByID($data['user']['ProvinciaID']) : [];
    }

    if (!empty($data['info']['ProvinciaID'])) {
      $data['p_departamentos'] = $this->model->getDepartamento($data['info']['DepartamentoID']);
      $data['p_provincias'] = $this->model->getProvincia($data['info']['ProvinciaID']);
    }

    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function success()
  {
    if (!empty($_GET['payment_id']) && !empty($_GET['status']) && !empty($_GET['merchant_order_id'])) {
      $mpStatus = $_GET['status'];
      $mpPaymentId = $_GET['payment_id'];
      $merchantOrderId = $_GET['merchant_order_id'];

      if ($mpStatus === 'approved') {
        $this->handleApprovedPayment($mpPaymentId, $merchantOrderId);
      }
    } else {
      Url::redirect('error/payment');
    }
  }

  private function handleApprovedPayment($mpPaymentId, $merchantOrderId)
  {
    Session::set('mp_status', 'approved');
    Session::set('mp_paymentId', $mpPaymentId);
    Session::set('mp_merchantOrderId', $merchantOrderId);

    $paymentId = Session::get('wb_payment') ?: 1;
    $products = Session::get('wb_basket');

    if (!empty($products)) {
      $orderId = $this->processOrder($products[0], $paymentId);
      $this->clearSessionData();

      Url::redirect('sendorder/' . $orderId);
    }
  }

  private function processOrder($item, $paymentId)
  {
    $planId = $item['id'];
    $total = $item['price'];

    $order = [
      'Nombre' => 'Orden de Subscripción - Fecha: ' . date('d/m/Y - H:i:s'),
      'UsuarioID' => $this->userId,
      'FPagoID' => $paymentId,
      'TotalVenta' => $total,
    ];

    $details = [
      [
        'ProductoID' => $planId,
        'Precio' => $total,
        'Cantidad' => 1
      ]
    ];

    $orderId = $this->model->saveOrdenPedido($order);
    $this->model->saveOrdenDetalle($details, $orderId, $this->userId);
    $this->saveShippingAndPlan($orderId, $planId);
    return $orderId;
  }

  private function saveShippingAndPlan($orderId, $planId)
  {
    $fields = [
      'OrdenID' => $orderId,
      'UsuarioID' => $this->userId
    ];
    $this->model->saveDireccionEnvio($fields);
    $this->model->savePlanUsuario($planId, $this->userId);
  }

  private function clearSessionData()
  {
    Session::pull('wb_step');
    Session::pull('wb_basket');
    Session::pull('wb_dirsend');
    Session::pull('sInfo');
  }

  public function failure()
  {
    Url::redirect('error/payment/failure');
  }

  public function pending()
  {
    Url::redirect('error/payment/pending');
  }

  public function sendorder($ordenId)
  {
    if (Session::get('wb_active') === 0) {
      Url::redirect('login');
    }

    $data['title'] = 'Pago Finalizado';
    $data['ordenId'] = $ordenId;
    $nombre = $data['nombre'] = Session::get('wb_name');
    $email = $data['email'] = Session::get('wb_user');

    $filePDF = $this->createMPDF($ordenId);
    $this->model->saveOrdenPedidoUsuario($ordenId, $filePDF);
    $this->sendEmail($nombre, $email, $filePDF);

    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  private function sendEmail($nombre, $email, $filePDF)
  {
    $urlAttached = DOC_PATH . $filePDF;
    $empresa = $this->config['Nombre'];
    $subject = 'Resumen de su Compra - ' . html_entity_decode($empresa);
    $body = file_get_contents(URL_WEB . 'mailing/checkout');
    $body = str_replace('{NAME}', $nombre, $body);

    $mailData = [
      'from_name' => html_entity_decode($empresa),
      'from_email' => EMAIL_NOREPLY,
      'to_email' => $email,
      'to_name' => $nombre,
      'subject' => $subject,
      'body' => $body,
      'addbcc_emails' => [
        EMAIL_WEBMASTER => 'Oscar Castillo'
      ],
      'url_attached' => $urlAttached,
      'filename' => $filePDF
    ];

    (new Mail())->sendSMTP($mailData, true);
  }

  public function createMPDF($ordenId)
  {
    if (Session::get('wb_active') == 0) {
      Url::redirect('login');
    }

    $filename = 'Comprobante_' . date('dmYHis') . '.pdf';
    $html = file_get_contents(URL_WEB . 'invoice/' . $ordenId . '/' . $this->userId);

    $pdf = new PDF();
    $pdf->createPDF($html, $filename);
    return $filename;
  }

  public function download($orderId = 0)
  {
    if (Session::get('wb_active') == 0) {
      Url::redirect('login');
    }

    if ($orderId > 0) {
      $filename = $this->model->getNotaPedido($orderId, $this->userId);

      $file = new File();
      $file->download($filename);
    }
  }

  public function addcart($planId = null)
  {
    if (!$planId) {
      return false;
    }

    $plan = $this->model->getPlanUsuario($planId);

    if ($plan) {
      Session::set('wb_basket', [[
        'id' => $plan['ID'],
        'name' => $plan['Nombre'],
        'price' => $plan['Precio'],
        'quantity' => 1
      ]]);
    }
  }

  public function register()
  {
    if (Session::get('wb_active') == 1) {
      Url::redirect('account');
    }

    $data['title'] = 'Por favor, complete sus datos!';
    $data['is_login'] = false;
    $data['tabla'] = 'usuarios';
    $data['captcha'] = Captcha::htmlFont();
    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function registerSubmit()
  {
    if (Validate::integer('register', true) != 1) {
      Url::response('No se envió el formulario');
      return;
    }

    $fields = $_POST['usuarios'];
    $nombre = Sanitize::sql($fields['Nombre']);
    $email = Sanitize::sql($fields['Email']);
    $contrasenia = Sanitize::sql($fields['Contrasenia']);
    $contrasenia2 = Sanitize::sql('contrasenia2', true);
    $captcha = Sanitize::sql('captcha', true);
    $policy = Sanitize::sql('policy', true);
    $subscribe = Sanitize::sql('subscribe', true);

    $this->validateInput($nombre, $email, $contrasenia, $contrasenia2, $policy, $captcha);

    if ($this->model->getUserByEmail($email)) {
      return $this->respondWithError('El correo electrónico ya se encuentra registrado en la plataforma!');
    }

    if ($error = Helper::validatePassword($contrasenia)) {
      return $this->respondWithError($error);
    }

    if ($subscribe == 1) {
      $this->subscribeUser($nombre, $email);
    }

    $telefono = !empty($fields['Celular']) ? $fields['Celular'] : '';
    $userId = $this->model->saveRegister($fields);
    $emailEncrypt = Helper::simpleEncrypt($email, self::KEY_ENCRYPT);
    $this->sendEmailConfirmation($userId, $nombre, $email, $telefono);

    $this->respondWithSuccess('Correo de Confirmación enviado correctamente!', 'sendEmailSuccess/' . $emailEncrypt);
  }

  public function confirmation($tokenMail = null)
  {
    if (empty($tokenMail)) {
      Url::redirect();
    }

    $parts = explode('--', $tokenMail);

    if (!is_array($parts)) {
      Url::redirect();
    }

    if (count($parts) < 2) {
      Url::redirect();
    }

    $token = $parts[0];
    $emailEncrypt = $parts[1];
    $email = Helper::simpleDecrypt($emailEncrypt, self::KEY_ENCRYPT);
    $user = $this->model->getUserConfirmation($email, $token);
    $data['title'] = 'Gracias por confirmar su cuenta';

    if (empty($user)) {
      Url::redirect();
    }

    if (!empty($user)) {
      $userId = $user['ID'];
      $this->model->saveUserActive($userId);
      $data['description'] = 'Su cuenta ha sido confirmada. Para acceder a nuestra plataforma por favor haz clic en el botón "<b>Iniciar Sesión</b>"';

      $data = array_merge($data, $this->getModules());
      $this->view->assign('data', $data);
      $this->view->render();
    }
  }

  private function validateInput($nombre, $email, $contrasenia, $contrasenia2, $policy, $captcha)
  {
    if (empty($nombre)) {
      $this->respondWithError('Por favor, ingrese su nombre');
    }

    if (empty($email)) {
      $this->respondWithError('Por favor, ingrese su correo electrónico');
    }

    if (empty($contrasenia)) {
      $this->respondWithError('Por favor, ingrese su contraseña');
    }

    if (empty($contrasenia2)) {
      $this->respondWithError('Por favor, repita su contraseña');
    }

    if ($contrasenia != $contrasenia2) {
      $this->respondWithError('Las contraseñas no coinciden!');
    }

    if (empty($policy)) {
      $this->respondWithError('Por favor, acepte las Políticas de Privacidad del Sitio!');
    }

    if (empty($captcha)) {
      $this->respondWithError('Por favor, ingrese el código captcha!');
    }

    if (!Captcha::verify($captcha)) {
      $this->respondWithError('El código captcha ingresado es incorrecto!');
    }
  }

  private function respondWithError($message)
  {
    Url::response($message);
    exit;
  }

  private function respondWithSuccess($message, $redirectUrl)
  {
    Url::response($message, $redirectUrl);
    exit;
  }

  private function subscribeUser($nombre, $email)
  {
    if (!$this->model->getSubscribe($email)) {
      $this->model->saveSubscribe([
        'Nombre' => $nombre,
        'Email' => $email,
        'GroupID' => 2
      ]);
    }
    Session::set('wb_news', 'subscribe');
  }

  public function sendEmailConfirmation($userId, $nombre, $email, $telefono)
  {
    if (empty($this->config['Email'])) {
      return;
    }

    $emailData = $this->prepareEmailData($userId, $nombre, $email);

    $mail = new Mail();
    $mail->sendSMTP($emailData, true);

    $nombreEmpresa = $this->config['Nombre'];
    $emailEmpresa = $this->config['Email'];
    $emailCopy = 'licmelisahorn@gmail.com';
    $emailBody = '
    Hola Administrador,<br><br>
    Hay un nuevo registro de usuario con los siguientes datos:<br><br>
    <b>Nombre:</b> ' . $nombre . '
    <b>Email:</b> ' . $email . '
    <b>Tel&eacute;fono:</b>' . $telefono .
      'Saludos,<br><br>
    Equipo ' . $nombreEmpresa;

    $copiaEmail = [
      'from_name' => utf8_decode($nombreEmpresa),
      'from_email' => $emailEmpresa,
      'to_email' => $emailCopy,
      'subject' => 'Nuevo Registro de Usuario',
      'body' => $emailBody
    ];
    $mail->sendSMTP($copiaEmail, true);
  }

  private function prepareEmailData($userId, $nombre, $email)
  {
    $nombreEmpresa = $this->config['Nombre'];
    $emailEmpresa = $this->config['Email'];
    $subject = html_entity_decode('Confirmación de Correo Electrónico - ' . $nombreEmpresa);
    $body = file_get_contents(URL_WEB . 'mailing/confirmation');
    $token = Helper::generateToken();
    $emailEncrypt = Helper::simpleEncrypt($email, self::KEY_ENCRYPT);
    $urlConfirmation = URL_WEB . "confirmation/" . $token . '--' . $emailEncrypt;

    $this->model->saveUserToken($token, $userId);

    $emailBody = str_replace(
      ['[NAME]', '[LINK_CONFIRMATION]'],
      [$nombre, $urlConfirmation],
      $body
    );

    return [
      'from_name' => utf8_decode($nombreEmpresa),
      'from_email' => $emailEmpresa,
      'to_email' => $email,
      'subject' => $subject,
      'body' => $emailBody
    ];
  }

  public function sendEmailSuccess($emailEncrypt)
  {
    $email = Helper::simpleDecrypt($emailEncrypt, self::KEY_ENCRYPT);
    $data['title'] = 'Se envío un mensaje a <b>' . $email . '</b> para confirmar su correo electrónico';
    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function recover()
  {
    $data['title'] = 'Por favor ingrese su correo electrónico';
    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function recoverSubmit()
  {
    if (Validate::integer('recover', true) == 1) {
      $data['info'] = $_POST;
      $email = Sanitize::string('email', true);

      if (empty($email)) {
        $message = 'Debe ingresar su correo electrónico';
        Url::response($message);
        exit;
      }

      $user = $this->model->getUserByEmail($email);

      if (!$user) {
        $message = 'El correo electrónico no se encuentra registrado';
        Url::response($message);
        exit;
      }

      if ($user['Publico'] != 1) {
        $message = 'Este usuario no esta habilitado';
        Url::response($message);
        exit;
      }

      $this->sendPasswordByEmail($user['ID'], $user['Nombre'], $email);
      $emailEncrypt = Helper::simpleEncrypt($email, self::KEY_ENCRYPT);
      $message = 'Recuperación de contraseña enviada correctamente!';
      Url::response($message, 'recoverSuccess/' . $emailEncrypt);
      exit;
    }

    Url::response('No se envió el formulario');
  }

  public function sendPasswordByEmail($userId, $nombre, $email)
  {
    if (!empty($this->config['Email'])) {
      $nombreEmpresa = $this->config['Nombre'];
      $emailEmpresa = $this->config['Email'];
      $subject = html_entity_decode('Recuperación de Contraseña - ' . $nombreEmpresa);
      $body = file_get_contents(URL_WEB . 'mailing/recovery');
      $password = Helper::generatePasswordBin2Hex();
      $this->model->saveUserPassword($password, $userId);

      $emailBody = str_replace(
        ['[NAME]', '[PASSWORD]', '[LINK_LOGIN]'],
        [$nombre, $password, URL_WEB . 'login'],
        $body
      );

      $send = [
        'from_name' => utf8_decode($nombreEmpresa),
        'from_email' => $emailEmpresa,
        'to_email' => $email,
        'subject' => $subject,
        'body' => $emailBody
      ];

      $mail = new Mail;
      $mail->sendSMTP($send, true);
    }
  }

  public function recoverSuccess($emailEncrypt)
  {
    $email = Helper::simpleDecrypt($emailEncrypt, self::KEY_ENCRYPT);
    $data['title'] = 'Revise su correo electrónico: <b>' . $email . '</b> donde se enviaron los pasos para la recuperación de la contraseña';
    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function unsubscribe($planId = null)
  {
    if (Session::get('wb_active') == 0) {
      Url::redirect('login');
    }

    if (empty($planId)) {
      return;
    }

    $data['title'] = 'Confirmar Baja de Subscripción Actual';
    $data['planId'] = $planId;
    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function unsubscribeSubmit()
  {
    if (Session::get('wb_active') == 0) {
      Url::redirect('login');
    }

    $data['title'] = 'Subscripción Cancelada';
    $user = $this->model->getUserByID($this->userId);
    $planId = $this->model->getPlanByUsuario($this->userId);

    if (!empty($planId)) {
      $this->model->cancelPlanUsuario($planId, $this->userId);
      $this->sendEmailUnsubscribe($user['Nombre'], $user['Email']);
      $data['description'] = 'Su plan fue cancelado correctamente. Podrás acceder a nuestra plataforma hasta el ' . date('t/m/Y');
    }

    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function sendEmailUnsubscribe($nombre, $email)
  {
    if (empty($this->config['Email'])) {
      return;
    }

    $emailData = $this->prepareEmailUnsubscribe($nombre, $email);
    $mail = new Mail();
    $mail->sendSMTP($emailData, true);
  }

  private function prepareEmailUnsubscribe($nombre, $email)
  {
    $nombreEmpresa = $this->config['Nombre'];
    $emailEmpresa = $this->config['Email'];
    $subject = html_entity_decode('Cancelación de Subscripción - ' . $nombreEmpresa);
    $body = file_get_contents(URL_WEB . 'mailing/unsubscribe');

    $emailBody = str_replace(
      ['[NAME]'],
      [$nombre],
      $body
    );

    return [
      'from_name' => utf8_decode($nombreEmpresa),
      'from_email' => $emailEmpresa,
      'to_email' => $email,
      'subject' => $subject,
      'body' => $emailBody
    ];
  }

  public function login()
  {
    if (Session::get('wb_active') == 1) {
      Url::redirect();
    }

    $data['title'] = 'Inicia sesión con tu correo electrónico y contraseña';
    $data['is_login'] = true;

    if (Validate::integer('login', true) == 1) {
      $data['info'] = $_POST;
      $postUser = Sanitize::string('wb_username', true);
      $postPass = Sanitize::sql('wb_password', true);

      if (empty($postUser)) {
        $data['error']['message'] = 'Debe ingresar su correo electrónico';
        $data['error']['type'] = 'danger';

        $data = array_merge($data, $this->getModules());
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      if (empty($postPass)) {
        $data['error']['message'] = 'Debe ingresar su contraseña';
        $data['error']['type'] = 'danger';

        $data = array_merge($data, $this->getModules());
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $user = $this->model->getUser($postUser, $postPass);

      if (!$user) {
        $data['error']['message'] = 'Usuario y/o contraseña incorrectos';
        $data['error']['type'] = 'danger';

        $data = array_merge($data, $this->getModules());
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      if ($user['Publico'] != 1) {
        $data['error']['message'] = 'Este usuario no esta habilitado';
        $data['error']['type'] = 'danger';

        $data = array_merge($data, $this->getModules());
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $this->initSession($user);
      Url::redirect('account');
    }

    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function initSession($user)
  {
    Session::set('wb_active', true);
    Session::set('wb_name', $user['Nombre']);
    Session::set('wb_access', $user['Acceso']);
    Session::set('wb_user', $user['Email']);
    Session::set('wb_user_id', $user['ID']);
    Session::set('wb_time', time());

    $fields['ID'] = $user['ID'];
    $fields['SessionID'] = Helper::generateSHA1(session_id());
    $this->model->saveAccess($fields);
  }

  public function logout()
  {
    $fields['ID'] = $this->userId;
    $fields['SessionID'] = '';
    $this->model->saveAccess($fields);

    Session::destroy();
    Url::redirect();
  }

  public function getModules()
  {
    $data['config'] = $this->config;
    $data['listProducts'] = Session::get('wb_basket');
    $data['planActivo'] = 0;

    if (!empty($this->userId)) {
      $subscripcion = $this->model->getSubscription($this->userId);
      $data['planActivo'] = !empty($subscripcion) && $subscripcion['PlanID'] > 1 ? 1 : 0;
    }

    return $data;
  }

  public function upload()
  {
    echo $this->uploadImage('usuarios', $_FILES['userfile'], self::IMG_WIDTH, self::IMG_HEIGHT, self::IMG_WIDTH, self::IMG_HEIGHT, true);
  }

  public function crop($code = '', $file = '', $ext = '')
  {
    if (isset($_POST['img'])) {
      $this->cropImage(self::IMG_WIDTH, self::IMG_HEIGHT);
    } else {
      $imagen = $file . '.' . $ext;
      $this->displayCrop($code, $imagen, self::IMG_WIDTH, self::IMG_HEIGHT);
    }
  }

  public function keepimage($code = '', $image = '')
  {
    if (!empty($code)) {
      echo $this->originalImage($code, $image, self::IMG_WIDTH, self::IMG_HEIGHT, self::IMG_WIDTH, self::IMG_HEIGHT);
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
