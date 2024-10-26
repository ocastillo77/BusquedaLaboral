<?php

class CompanyController extends Controller
{

  const KEY_ENCRYPT = 'EncuentraTuPuesto';
  const IMG_WIDTH = 500;
  const IMG_HEIGHT = 500;

  private $model;
  private $config;
  private $companyId;

  public function __construct()
  {
    parent::__construct();

    $this->initialize();
    $this->model = Load::model('home');
    $this->config = $this->model->getConfig();
    $this->companyId = Session::get('em_user_id');
  }

  public function index()
  {
    $data['title'] = 'Empresa';
    $data['banners'] = $this->model->getBannerTopEmpresa();
    $data['bmobile'] = $this->model->getBannerMobileEmpresa();
    $data['isMobile'] = $this->detectMobile();
    $data['candidatos'] = $this->model->getCandidatos();
    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function profileCompany($userId)
  {
    if (Validate::integer('update', true) != 1) {
      return;
    }

    if (empty($_POST['usuarios'])) {
      return;
    }

    $fields = $_POST['usuarios'];
    $errores = [
      'CUIT' => 'Por favor, ingrese el CUIT de la empresa',
      'Nombre' => 'Por favor, ingrese su Razón Social',
      'Email' => 'Por favor, ingrese su correo electrónico',
      'Telefono' => 'Por favor, ingrese su teléfono',
      'Contrasenia' => 'Por favor, ingrese su contraseña'
    ];

    foreach ($errores as $field => $message) {
      $$field = Sanitize::sql($fields[$field] ?? '');

      if (empty($$field)) {
        $this->showMessageError($message);
        return;
      }
    }

    $fields['ID'] = $userId;

    if ($this->model->saveUser($fields)) {
      Url::redirect('accountCompany/profile');
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

  public function accountCompany($url = '')
  {
    if (Session::get('em_active') == 0) {
      Url::redirect('loginCompany');
    }

    $userId = Session::get('em_user_id');
    $data = [
      'title' => 'Mi Cuenta',
      'user' => $this->model->getCompanyByID($userId),
      'jobs' => $this->model->getBusquedas($userId),
      'candidatos' => $this->model->getCandidatosByEmpresa($userId),
      'provincias' => $this->model->getProvincias(),
      'subscripcion' => $this->model->getSubscriptionCompany($userId),
      'planes' => $this->model->getPlanesEmpresa()
    ];

    if ($data['subscripcion']) {
      $data['candidatos'] = $this->model->getCandidatosEmpresa();
    }

    $data['title'] = $this->getTitleCompany($url);
    if ($url === 'profile') {
      $this->profileCompany($userId);
    }

    $data['file'] = $url ?: 'home';
    $data = array_merge($data, $this->getModules());

    $this->view->assign('data', $data);
    $this->view->render();
  }

  private function getTitleCompany($url)
  {
    $titles = [
      'profile' => 'Mi Perfil',
      'jobs' => 'Mis Búsquedas',
      'candidates' => 'Candidatos',
      'subscription' => 'Mi Subscripción',
    ];

    return $titles[$url] ?? 'Mi Cuenta';
  }

  public function candidate($id, $url = '')
  {
    if (!Session::get('em_user_id')) {
      Url::redirect();
    }

    $respuestas = $this->model->getRespuestas($id);

    $data = [
      'title' => 'Perfil del Candidato',
      'tests' => $this->model->getTests($id),
      'bloque2' => $this->getBloqueData($respuestas, 2),
      'bloque3' => $this->getBloqueData($respuestas, 3),
      'bloque4' => $this->getBloqueData($respuestas, 4),
      'candidato' => $this->model->getCandidato($id),
      'encuesta' => $this->model->getRespuestas($id),
      'file' => $url,
    ];

    $data['title'] = $this->getTitleCandidate($url);
    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  private function getBloqueData($responses, $num)
  {
    return !empty($responses) && !empty($responses['Bloque' . $num]) ? Helper::convertArrayUnicodeToUTF8($responses['Bloque' . $num]) : [];
  }

  private function getTitleCandidate($url)
  {
    $titles = [
      'profile' => 'Perfil',
      'tests' => 'Tests',
      'test' => 'Primer Test',
    ];

    return $titles[$url] ?? 'Perfil del Candidato';
  }

  public function saveProfileCompany()
  {
    $tabla = 'empresas';
    $userId = Session::get('em_user_id');

    if (!empty($_POST[$tabla])) {
      $fields = $_POST[$tabla];
      $this->model->saveProfileCompany($fields, $userId);

      $alert['type'] = 'success';
      $alert['message'] = 'El Perfil se guardó correctamente!';
      Session::set('alert-form', $alert);
    }

    Url::redirect('accountCompany/profile');
  }

  public function checkoutCompany($planId = null)
  {
    if (Session::get('em_active') == 0) {
      Url::redirect('loginCompany');
    }

    if (!empty($planId)) {
      $this->addcartCompany($planId);
    }

    $data = [
      'title' => 'Proceso de Pago',
      'step' => 2,
      'provincias' => $this->model->getProvincias()
    ];

    $user = $data['user'] = $this->model->getCompanyByID($this->companyId);

    if (!empty($user['ProvinciaID'])) {
      $data['departamentos'] = $this->model->getDepartamentosByID($user['ProvinciaID']);
    }

    Session::set('em_step', 'checkoutCompany');
    Session::set('em_lasturl', 'checkoutCompany');

    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function billingCompany()
  {
    if (Session::get('em_active') == 0) {
      Url::redirect('loginCompany');
    }

    $data = [
      'title' => 'Por favor, complete sus datos!',
      'is_login' => false,
      'errors' => [],
      'provincias' => $this->model->getProvincias()
    ];

    if (Validate::integer('billing', true) == 1) {
      $data['info'] = $fields = $_POST['empresas'];

      $requiredFields = [
        'Telefono' => 'Por favor, ingrese su número de teléfono',
        'CPostal' => 'Por favor, ingrese su código postal',
        'Direccion' => 'Por favor, ingrese su direccion',
        'Localidad' => 'Por favor, ingrese su localidad',
        'ProvinciaID' => 'Por favor, elija su provincia',
        'DepartamentoID' => 'Por favor, elija su departamento!',
      ];

      foreach ($requiredFields as $field => $errorMessage) {
        $sanitizedValue = Sanitize::string($fields[$field]);

        if (empty($sanitizedValue)) {
          $data['errors'][$field] = $errorMessage;
        } else {
          $fields[$field] = $sanitizedValue;
        }
      }

      if (empty($data['errors'])) {
        $fields['ID'] = $this->companyId;
        $this->model->saveDireccionEmpresa($fields);
        Session::set('em_step', 'billing');
        Session::set('sInfo', $data['info']);

        Url::redirect('paymentCompany');
      }

      $data['dirsend'] = 1;
      Session::set('em_dirsend', 1);
    }

    $user = $data['user'] = $this->model->getCompanyByID($this->companyId);

    if (!empty($user['ProvinciaID'])) {
      $data['departamentos'] = $this->model->getDepartamentosByID($user['ProvinciaID']);
    }

    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function paymentCompany()
  {
    if (Session::get('em_active') == 0) {
      Url::redirect('loginCompany');
    }

    $data = [
      'title' => 'Por favor, complete sus datos!',
      'is_login' => false,
      'errors' => [],
      'dirsend' => Session::get('em_dirsend'),
      'info' => Session::get('sInfo') ?? false,
      'paymentId' => Session::get('em_payment') ?? 1,
      'payments' => $this->model->getPayments(),
      'user' => $this->model->getCompanyByID($this->companyId),
      'provincias' => $this->model->getProvincias()
    ];

    if (!empty($data['user']['ProvinciaID'])) {
      $data['departamentos'] = $this->model->getDepartamentosByID($data['user']['ProvinciaID']);
    }

    if (Validate::integer('payment', true) == 1) {
      $data['paymentId'] = $paymentId = $_POST['paymentid'] ?? null;

      if (!$paymentId) {
        $data['errors']['paymentid'] = 'Por favor, seleccione un método de pago!';
      }

      if (empty($data['errors'])) {
        Session::set('em_step', 'payment');
        Session::set('em_payment', $paymentId);
        $this->createPreferenceCompany();
        Url::redirect('processCompany');
      }
    }

    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function createPreferenceCompany()
  {
    Load::library('MercadoPago/vendor/autoload');
    MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);

    $itemsPreference = [];
    $products = Session::get('em_basket');
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
      "success" => URL_WEB . 'successCompany',
      "failure" => URL_WEB . 'failure',
      "pending" => URL_WEB . 'pending',
    ];

    $preference->auto_return = "approved";
    $preference->save();

    Session::set('preferenceId', $preference->id);
  }

  public function getPreferenceCompany()
  {
    if (Session::get('preferenceId') != null) {
      $response = [
        'publicKey' => MP_PUBLIC_KEY,
        'preferenceId' => Session::get('preferenceId')
      ];

      echo json_encode($response);
    }
  }

  public function processCompany()
  {
    if (Session::get('em_active') == 0) {
      Url::redirect('loginCompany');
    }

    $data = [
      'title' => 'Por favor, complete sus datos!',
      'is_login' => false,
      'errors' => [],
      'dirsend' => Session::get('em_dirsend'),
      'info' => Session::get('sInfo') ?? false,
      'paymentId' => Session::get('em_payment') ?? 1,
      'payments' => $this->model->getPayments(),
      'user' => $this->model->getCompanyByID($this->companyId),
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

  public function successCompany()
  {
    if (isset($_GET['payment_id'], $_GET['status'], $_GET['merchant_order_id'])) {
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

    $paymentId = Session::get('em_payment') ?? 1;
    $products = Session::get('em_basket') ?? [];

    if (!empty($products)) {
      $orderId = $this->processOrder($products[0], $paymentId);
      $this->clearSessionData();

      Url::redirect('sendorderCompany/' . $orderId);
    }
  }

  private function processOrder($item, $paymentId)
  {
    $planId = $item['id'];
    $total = $item['price'];

    $order = [
      'Nombre' => 'Orden de Subscripción - Fecha: ' . date('d/m/Y - H:i:s'),
      'UsuarioID' => $this->companyId,
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
    $this->model->saveOrdenDetalle($details, $orderId, $this->companyId);
    $this->saveShippingAndPlan($orderId, $planId);
    return $orderId;
  }

  private function saveShippingAndPlan($orderId, $planId)
  {
    $fields = [
      'OrdenID' => $orderId,
      'UsuarioID' => $this->companyId
    ];
    $this->model->saveDireccionEnvio($fields);
    $this->model->savePlanEmpresa($planId, $this->companyId);
  }

  private function clearSessionData()
  {
    Session::pull('em_step');
    Session::pull('em_basket');
    Session::pull('em_dirsend');
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

  public function sendorderCompany($ordenId)
  {
    if (Session::get('em_active') == 0) {
      Url::redirect('loginCompany');
    }

    $data['title'] = 'Pago Finalizado';
    $data['ordenId'] = $ordenId;
    $nombre = $data['nombre'] = Session::get('em_name');
    $email = $data['email'] = Session::get('em_user');

    $filePDF = $this->createMPDFCompany($ordenId);
    $this->model->saveOrdenPedidoEmpresa($ordenId, $filePDF);
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

  public function createMPDFCompany($ordenId)
  {
    if (Session::get('em_active') == 0) {
      Url::redirect('login');
    }

    $filename = 'Comprobante_' . date('dmYHis') . '.pdf';
    $html = file_get_contents(URL_WEB . 'invoice/' . $ordenId . '/' . $this->companyId);

    $pdf = new PDF();
    $pdf->createPDF($html, $filename);
    return $filename;
  }

  public function downloadCompany($orderId = 0)
  {
    if (Session::get('em_active') == 0) {
      Url::redirect('loginCompany');
    }

    if ($orderId > 0) {
      $filename = $this->model->getNotaPedido($orderId, $this->companyId);

      $file = new File();
      $file->download($filename);
    }
  }

  public function addcartCompany($planId = null)
  {
    if (!$planId) {
      return false;
    }

    $plan = $this->model->getPlanEmpresa($planId);

    if ($plan) {
      Session::set('em_basket', [[
        'id' => $plan['ID'],
        'name' => $plan['Nombre'],
        'price' => $plan['Precio'],
        'quantity' => 1
      ]]);
    }
  }

  public function registerCompany()
  {
    if (Session::get('em_active') == 1) {
      Url::redirect('accountCompany');
    }

    $data['title'] = 'Por favor, complete sus datos!';
    $data['is_login'] = false;
    $data['tabla'] = 'empresas';
    $data['captcha'] = Captcha::htmlFont();
    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function registerCompanySubmit()
  {
    if (Validate::integer('registerCompany', true) != 1) {
      Url::response('No se envió el formulario');
      return;
    }

    $fields = $_POST['empresas'];
    $cuit = Sanitize::string($fields['CUIT']);
    $nombre = Sanitize::sql($fields['Nombre']);
    $email = Sanitize::sql($fields['Email']);
    $contrasenia = Sanitize::sql($fields['Contrasenia']);
    $contrasenia2 = Sanitize::sql('contraseniaE2', true);
    $captcha = Sanitize::sql('captcha', true);
    $policy = Sanitize::sql('policyE', true);
    $subscribe = Sanitize::sql('subscribeE', true);

    $this->validateInput($cuit, $nombre, $email, $contrasenia, $contrasenia2, $policy, $captcha);

    if ($this->model->getCompanyByCuit($cuit)) {
      return $this->respondWithError('El CUIT ya se encuentra registrado en la plataforma!');
    }

    if ($this->model->getCompanyByEmail($email)) {
      return $this->respondWithError('El correo electrónico ya se encuentra registrado en la plataforma!');
    }

    if ($error = Helper::validatePassword($contrasenia)) {
      return $this->respondWithError($error);
    }

    if ($subscribe == 1) {
      $this->subscribeUser($nombre, $email);
    }

    $userId = $this->model->saveRegisterCompany($fields);
    $emailEncrypt = Helper::simpleEncrypt($email, self::KEY_ENCRYPT);
    $this->sendEmailCompanyConfirmation($userId, $nombre, $email);

    $this->respondWithSuccess('Correo de Confirmación enviado correctamente!', 'sendEmailCompanySuccess/' . $emailEncrypt);
  }

  public function confirmationCompany($tokenMail = null)
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
    $user = $this->model->getCompanyConfirmation($email, $token);
    $data['title'] = 'Gracias por confirmar su cuenta';

    if (empty($user)) {
      Url::redirect();
    }

    if (!empty($user)) {
      $userId = $user['ID'];
      $this->model->saveCompanyActive($userId);
      $data['description'] = 'Su cuenta ha sido confirmada. Para acceder a nuestra plataforma por favor haz clic en el botón "<b>Iniciar Sesión</b>"';

      $data = array_merge($data, $this->getModules());
      $this->view->assign('data', $data);
      $this->view->render();
    }
  }

  private function validateInput($cuit, $nombre, $email, $contrasenia, $contrasenia2, $policy, $captcha)
  {
    if (empty($cuit)) {
      $this->respondWithError('Por favor, ingrese su CUIT');
    }

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

    if ($contrasenia !== $contrasenia2) {
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

  public function sendEmailCompanyConfirmation($userId, $nombre, $email)
  {
    if (empty($this->config['Email'])) {
      return;
    }

    $emailData = $this->prepareEmailData($userId, $nombre, $email);

    $mail = new Mail();
    $mail->sendSMTP($emailData, true);
  }

  private function prepareEmailData($userId, $nombre, $email)
  {
    $nombreEmpresa = $this->config['Nombre'];
    $emailEmpresa = $this->config['Email'];
    $subject = html_entity_decode('Confirmación de Correo Electrónico - ' . $nombreEmpresa);
    $body = file_get_contents(URL_WEB . 'mailing/confirmation');
    $token = Helper::generateToken();
    $emailEncrypt = Helper::simpleEncrypt($email, self::KEY_ENCRYPT);
    $urlConfirmation = URL_WEB . "confirmationCompany/" . $token . '--' . $emailEncrypt;

    $this->model->saveCompanyToken($token, $userId);

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

  public function sendEmailCompanySuccess($emailEncrypt)
  {
    $email = Helper::simpleDecrypt($emailEncrypt, self::KEY_ENCRYPT);
    $data['title'] = 'Se envío un mensaje a <b>' . $email . '</b> para confirmar su correo electrónico';
    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function recoverCompany()
  {
    $data['title'] = 'Por favor ingrese su correo electrónico';
    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function recoverCompanySubmit()
  {
    if (Validate::integer('recovercompany', true) == 1) {
      $data['info'] = $_POST;
      $email = Sanitize::string('email', true);

      if (empty($email)) {
        $message = 'Debe ingresar su correo electrónico';
        Url::response($message);
        exit;
      }

      $user = $this->model->getCompanyByEmail($email);

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

      $this->sendPasswordByEmailCompany($user['ID'], $user['Nombre'], $email);
      $emailEncrypt = Helper::simpleEncrypt($email, self::KEY_ENCRYPT);
      $message = 'Recuperación de contraseña enviada correctamente!';
      Url::response($message, 'recoverCompanySuccess/' . $emailEncrypt);
      exit;
    }

    Url::response('No se envió el formulario');
  }

  public function sendPasswordByEmailCompany($userId, $nombre, $email)
  {
    if (!empty($this->config['Email'])) {
      $nombreEmpresa = $this->config['Nombre'];
      $emailEmpresa = $this->config['Email'];
      $subject = html_entity_decode('Recuperación de Contraseña - ' . $nombreEmpresa);
      $body = file_get_contents(URL_WEB . 'mailing/recovery');
      $password = Helper::generatePasswordBin2Hex();
      $this->model->saveCompanyPassword($password, $userId);

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

  public function recoverCompanySuccess($emailEncrypt)
  {
    $email = Helper::simpleDecrypt($emailEncrypt, self::KEY_ENCRYPT);
    $data['title'] = 'Revise su correo electrónico: <b>' . $email . '</b> donde se enviaron los pasos para la recuperación de la contraseña';
    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function unsubscribeCompany($planId = null)
  {
    if (Session::get('em_active') == 0) {
      Url::redirect('loginCompany');
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

  public function unsubscribeSubmitCompany()
  {
    if (Session::get('em_active') == 0) {
      Url::redirect('loginCompany');
    }

    $data['title'] = 'Subscripción Cancelada';
    $user = $this->model->getCompanyByID($this->companyId);
    $planId = $this->model->getPlanByEmpresa($this->companyId);

    if (!empty($planId)) {
      $this->model->cancelPlanEmpresa($planId, $this->companyId);
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

  public function loginCompany()
  {
    if (Session::get('em_active') == 1) {
      Url::redirect('accountCompany');
    }

    $data['title'] = 'Inicia sesión con tu correo electrónico y contraseña';
    $data['is_login'] = true;

    if (Validate::integer('loginCompany', true) == 1) {
      $data['info'] = $_POST;
      $postUser = Sanitize::string('em_username', true);
      $postPass = Sanitize::sql('em_password', true);

      if (empty($postUser)) {
        $data['error']['message'] = 'Debe ingresar la razón social de su empresa';
        $data['error']['type'] = 'danger';

        $data = array_merge($data, $this->getModules());
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      if (empty($postPass)) {
        $data['error']['message'] = 'Debe ingresar su contrase&ntilde;a';
        $data['error']['type'] = 'danger';

        $data = array_merge($data, $this->getModules());
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }

      $user = $this->model->getCompany($postUser, $postPass);

      if (!$user) {
        $data['error']['message'] = 'Usuario y/o contrase&ntilde;a incorrectos';
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

      $this->initSessionCompany($user);
      Url::redirect('accountCompany');
    }

    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function initSessionCompany($user)
  {
    Session::set('em_active', true);
    Session::set('em_name', $user['Nombre']);
    Session::set('em_access', $user['Acceso']);
    Session::set('em_user', $user['Email']);
    Session::set('em_user_id', $user['ID']);
    Session::set('em_time', time());

    $fields['ID'] = $user['ID'];
    $fields['SessionID'] = Helper::generateSHA1(session_id());
    $this->model->saveAccessCompany($fields);
  }

  public function logoutCompany()
  {
    $fields['ID'] = $this->companyId;
    $fields['SessionID'] = '';
    $this->model->saveAccessCompany($fields);

    Session::destroy();
    Url::redirect();
  }

  public function getModules()
  {
    $data['config'] = $this->config;
    $data['listCompany'] = Session::get('em_basket');
    $data['planActivo'] = 0;

    if (!empty($this->companyId)) {
      $subscripcion = $this->model->getSubscription($this->companyId);
      $data['planActivo'] = !empty($subscripcion) ? 1 : 0;
    }

    return $data;
  }

  public function uploadCompany()
  {
    echo $this->uploadImage('empresas', $_FILES['userfile'], self::IMG_WIDTH, self::IMG_HEIGHT, self::IMG_WIDTH, self::IMG_HEIGHT, true);
  }

  public function cropCompany($code = '', $file = '', $ext = '')
  {
    if (isset($_POST['img'])) {
      $this->cropImage(self::IMG_WIDTH, self::IMG_HEIGHT);
    } else {
      $imagen = $file . '.' . $ext;
      $this->displayCrop($code, $imagen, self::IMG_WIDTH, self::IMG_HEIGHT);
    }
  }

  public function keepimageCompany($code = '', $image = '')
  {
    if (!empty($code)) {
      echo $this->originalImage($code, $image, self::IMG_WIDTH, self::IMG_HEIGHT, self::IMG_WIDTH, self::IMG_HEIGHT);
    }
  }

  public function delimageCompany()
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
      $this->model->deleteItemGaleriaCompany($id);
    }

    echo 'true';
  }
}
