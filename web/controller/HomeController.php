<?php

require_once ROOT . 'controller/UserController.php';
require_once ROOT . 'controller/CompanyController.php';

class HomeController extends Controller
{

  protected $config;
  protected $model;
  protected $userController;
  protected $companyController;

  public function __construct()
  {
    parent::__construct();

    $this->initialize();
    $this->model = Load::model('home');
    $this->config = $this->model->getConfig();
    //
    $this->userController = new UserController;
    $this->companyController = new CompanyController;
  }

  public function index()
  {
    $this->userController->index();
  }

  public function empresa()
  {
    $this->companyController->index();
  }

  public function busqueda()
  {
    $this->userController->busqueda();
  }

  public function addcart($planId = null)
  {
    $this->userController->addcart($planId);
  }

  public function addcartCompany($planId = null)
  {
    $this->companyController->addcartCompany($planId);
  }

  public function register()
  {
    $this->userController->register();
  }

  public function registerSubmit()
  {
    $this->userController->registerSubmit();
  }

  public function sendEmailSuccess($emailEncrypt)
  {
    $this->userController->sendEmailSuccess($emailEncrypt);
  }

  public function confirmation($tokenMail = null)
  {
    $this->userController->confirmation($tokenMail);
  }

  public function confirmationCompany($tokenMail = null)
  {
    $this->companyController->confirmationCompany($tokenMail);
  }

  public function sendEmailCompanySuccess($emailEncrypt)
  {
    $this->companyController->sendEmailCompanySuccess($emailEncrypt);
  }

  public function registerCompany()
  {
    $this->companyController->registerCompany();
  }

  public function registerCompanySubmit()
  {
    $this->companyController->registerCompanySubmit();
  }

  public function login($checkout = null)
  {
    $this->userController->login($checkout);
  }

  public function loginCompany($checkout = null)
  {
    $this->companyController->loginCompany($checkout);
  }

  public function logout()
  {
    $this->userController->logout();
  }

  public function logoutCompany()
  {
    $this->companyController->logoutCompany();
  }

  public function recover()
  {
    $this->userController->recover();
  }

  public function recoverSubmit()
  {
    $this->userController->recoverSubmit();
  }

  public function recoverSuccess($emailEncrypt)
  {
    $this->userController->recoverSuccess($emailEncrypt);
  }

  public function recoverCompany()
  {
    $this->companyController->recoverCompany();
  }

  public function recoverCompanySubmit()
  {
    $this->companyController->recoverCompanySubmit();
  }

  public function recoverCompanySuccess($emailEncrypt)
  {
    $this->companyController->recoverCompanySuccess($emailEncrypt);
  }

  public function profile($userId = null)
  {
    $this->userController->profile($userId);
  }

  public function profileCompany($companyId = null)
  {
    $this->companyController->profileCompany($companyId);
  }

  public function account($url = null, $testId = 0)
  {
    $this->userController->account($url, $testId);
  }

  public function accountCompany($url = 'home')
  {
    $this->companyController->accountCompany($url);
  }

  public function saveBloque($num = null)
  {
    $this->userController->saveBloque($num);
  }

  public function saveBloqueTest($num = null)
  {
    $this->userController->saveBloqueTest($num);
  }

  public function candidate($id, $url = null)
  {
    $this->companyController->candidate($id, $url);
  }

  public function saveProfile($bloque1 = 0)
  {
    $this->userController->saveProfile($bloque1);
  }

  public function saveProfileCompany()
  {
    $this->companyController->saveProfileCompany();
  }

  public function checkout($planId = null)
  {
    $this->userController->checkout($planId);
  }

  public function checkoutCompany($planId = null)
  {
    $this->companyController->checkoutCompany($planId);
  }

  public function billing()
  {
    $this->userController->billing();
  }

  public function billingCompany()
  {
    $this->companyController->billingCompany();
  }

  public function payment()
  {
    $this->userController->payment();
  }

  public function paymentCompany()
  {
    $this->companyController->paymentCompany();
  }

  public function createPreference()
  {
    $this->userController->createPreference();
  }

  public function createPreferenceCompany()
  {
    $this->companyController->createPreferenceCompany();
  }

  public function getPreference()
  {
    $this->userController->getPreference();
  }

  public function getPreferenceCompany()
  {
    $this->companyController->getPreferenceCompany();
  }

  public function process()
  {
    $this->userController->process();
  }

  public function processCompany()
  {
    $this->companyController->processCompany();
  }

  public function success()
  {
    $this->userController->success();
  }

  public function successCompany()
  {
    $this->companyController->successCompany();
  }

  public function sendorder($orderId = null)
  {
    $this->userController->sendorder($orderId);
  }

  public function sendorderCompany($orderId = null)
  {
    $this->companyController->sendorderCompany($orderId);
  }

  public function download($orderId = null)
  {
    $this->userController->download($orderId);
  }

  public function downloadCompany($orderId = null)
  {
    $this->companyController->downloadCompany($orderId);
  }

  public function unsubscribe($planId = null)
  {
    $this->userController->unsubscribe($planId);
  }

  public function unsubscribeSubmit()
  {
    $this->userController->unsubscribeSubmit();
  }

  public function unsubscribeCompany($planId = null)
  {
    $this->companyController->unsubscribeCompany($planId);
  }

  public function unsubscribeSubmitCompany()
  {
    $this->companyController->unsubscribeSubmitCompany();
  }

  public function failure()
  {
    $this->userController->failure();
  }

  public function pending()
  {
    $this->userController->pending();
  }

  public function error($method = 'default', $type = 'default')
  {
    $data['title'] = 'Error en la página';
    $data['view'] = $method;
    $data['type'] = $type;
    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function mailing($template)
  {
    $data['config'] = $this->model->getConfig();
    echo Load::view('b-modules' . DS . 'mailing' . DS . 'mod-' . $template . '.php', $data);
  }

  public function invoice($ordenId, $userId)
  {
    if ($ordenId) {
      $data['ordenId'] = $ordenId;
      $data['orden'] = $this->model->getOrden($ordenId);
      $data['detalle'] = $this->model->getOrdenDetalle($userId, $ordenId);
      $data['cliente'] = $this->model->getCliente($userId);
      $data['config'] = $this->model->getConfig();
      echo Load::view('b-modules' . DS . 'account' . DS . 'mod-document.php', $data);
    }
  }

  public function departamentos($id = 0)
  {
    if ($id > 0) {
      $list = $this->model->getDepartamentosByID($id);

      if (count($list) > 0) {
        echo '<option value="0">- Seleccione -</option>';
        foreach ($list as $item) {
          echo '<option value="' . $item['ID'] . '">' . $item['Nombre'] . '</option>';
        }
      }
    }
  }

  public function getModules()
  {
    $data['config'] = $this->config;
    $data['redes'] = $this->model->getRedes();
    $data['listProducts'] = Session::get('wb_basket');
    $data['listCompany'] = Session::get('em_basket');
    $data['captcha'] = Captcha::html();
    return $data;
  }

  public function changecaptcha()
  {
    Captcha::reset();
    echo Captcha::html();
  }

  public function subscribe()
  {
    $data['title'] = 'Por favor, complete sus datos!';
    $data['subscribe'] = '';
    Session::set('wb_news', '');

    if (Validate::integer('subscribe', true) == 1) {
      $data['info'] = $fields = $_POST['usuarios'];
      $nombre = Sanitize::sql($fields['Nombre']);
      $email = Sanitize::sql($fields['Email']);

      if (empty($nombre)) {
        $data['error']['message'] = 'Por favor, ingrese su nombre';
        $data['error']['type'] = 'danger';

        $data = array_merge($data, $this->getModules());
        $this->view->assign('data', $data);
        $this->view->render();
        die();
      }

      if (empty($email)) {
        $data['error']['message'] = 'Por favor, ingrese su correo electrónico';
        $data['error']['type'] = 'danger';

        $data = array_merge($data, $this->getModules());
        $this->view->assign('data', $data);
        $this->view->render();
        die();
      }

      $verify = $this->model->getSubscribe($email);

      if (!$verify) {
        $data['subscribe'] = 'Muchas gracias por suscribirse a nuestro Boletín de Noticias!';

        $fields['GroupID'] = 1;
        $this->model->saveSubscribe($fields);
      } else {
        $data['subscribe'] = 'Usted ya está suscrito a nuestro Boletín de Noticias!';
      }

      Session::set('wb_news', 'subscribe');
    }

    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function sendcontact()
  {
    $info['nombre'] = Sanitize::string('nombre', true);
    $info['email'] = Sanitize::string('email', true);
    $info['consulta'] = Sanitize::string('consulta', true);
    $email_valido = Validate::email('email', true);

    if (Validate::integer('enviar', true) == 1) {
      if (!$info['nombre']) {
        $output = json_encode(['type' => 'error', 'text' => 'Debe ingresar su Nombre!']);
        die($output);
      }
      if (strlen($info['nombre']) < 4) {
        $output = json_encode(['type' => 'error', 'text' => 'El Nombre ingresado es muy corto!']);
        die($output);
      }
      if (!$info['email']) {
        $output = json_encode(['type' => 'error', 'text' => 'Debe ingresar su Email!']);
        die($output);
      }
      if (!$email_valido) {
        $output = json_encode(['type' => 'error', 'text' => 'Debe ingresar un email v&aacute;lido!']);
        die($output);
      }
      if (!$info['consulta']) {
        $output = json_encode(['type' => 'error', 'text' => 'Debe ingresar su consulta!']);
        die($output);
      }

      $output = $this->formatContact($info);

      die($output);
    }
  }

  public function formatContact($item = [])
  {
    $empresa = $this->config['Nombre'];
    $nombre = $item['nombre'];
    $telefono = $item['telefono'];
    $email = $item['email'];
    $consulta = $item['consulta'];

    $subject = 'Formulario de Contacto - ' . html_entity_decode($empresa);
    $body = "<b><u>" . $subject . "</u></b><br><br>";
    $body .= "<b>Nombre y Apellidos:</b> " . utf8_encode($nombre) . "<br>";
    $body .= "<b>Tel&eacute;fono:</b> " . $telefono . "<br>";
    $body .= "<b>Email:</b> " . $email . "<br>";
    $body .= "<b>Consulta:</b> " . utf8_encode($consulta) . "<br>";

    if (!empty($this->config['Email'])) {
      $send1 = [
        'from_name' => utf8_decode($nombre),
        'from_email' => $email,
        'to_email' => $this->config['Email'],
        'subject' => ($subject),
        'body' => $body
      ];

      $mail = new Mail;
      $mail->sendSMTP($send1);
    }

    $body = "<b><u>" . $subject . "</u></b><br><br>";
    $body .= "Muchas gracias por enviarnos su consulta. En breve le estaremos respondiendo.<br><br>Saludos cordiales,<br><br>";
    $body .= 'Equipo ' . $empresa;
    $body .= '<br><br><br><p style="font-size:10px">Para desuscribirse a nuestras notificaciones haga click <a href="' . URL_WEB . 'unsubscribe/">aqu&iacute;</a>.</p>';

    $send2 = [
      'from_name' => utf8_decode(html_entity_decode($empresa)),
      'from_email' => EMAIL_WEBMASTER,
      'to_email' => $email,
      'subject' => utf8_decode($subject),
      'body' => $body
    ];

    $mail = new Mail;
    $response = $mail->sendSMTP($send2);

    if (ACTIVE_EMAIL) {
      if (!empty($response['status'])) {
        return json_encode(array('type' => 'error', 'text' => 'No se pudo enviar el correo. Por favor, int&eacute;ntelo m&aacute;s tarde!'));
      }
    }

    return json_encode(array('type' => 'message', 'text' => 'Gracias ' . $nombre . ', su consulta ha sido enviada correctamente!'));
  }

  public function seccion($url = '')
  {
    $data['tabla'] = 'secciones';
    $data['subscribe'] = '';

    if (!empty($url)) {
      $data[$data['tabla']] = $info = $this->model->getSeccion($url);
      $data['subsecciones'] = $this->model->getSubsecciones($info['ID']);

      if ($url == 'inicio') {
        Url::redirect();
      }

      switch ($info['Archivo']) {
        case 'empresas.php':
          Url::redirect('empresa');
          break;
        case 'blog.php':
          Url::redirect('posts');
          break;
        case 'candidatos.php':
          Url::redirect('busqueda');
          break;
      }

      if (!$info) {
        Url::redirect('error');
      }

      if (Session::get('wb_news') == 'subscribe') {
        $data['subscribe'] = 'Usted ya está suscrito a nuestro Boletín de Noticias!';
      }

      $data['title'] = $info['Titulo'];
      $data['meta'] = $this->model->getMeta($data['tabla'], $info['ID']);
      $data['parrafos'] = $this->model->getParrafos($data['tabla'], $info['ID']);
    } else {
      Url::redirect('error');
    }

    $data['url'] = $url;
    Session::set('wb_lasturl', 'seccion/' . $url);
    $data = array_merge($data, $this->getModules());
    $this->view->assign('data', $data);
    $this->view->render($data['tabla']);
  }

  public function tracking($tabla = '', $id = '')
  {
    $browser = new Browser;
    $navegador = ucfirst($browser->Name) . ' / ' . $browser->Version;
    $fields['IsHome'] = $tabla == 'seccion' && empty($id) ? 1 : 0;
    $fields['Tabla'] = $tabla;
    $fields['TablaID'] = $id;
    $fields['IP'] = $_SERVER['REMOTE_ADDR'];
    $fields['File'] = $_SERVER['SCRIPT_NAME'];
    $fields['URL'] = $_SERVER['HTTP_REFERER'];
    $fields['Host'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $fields['Browser'] = $navegador;
    $this->model->saveTracking($fields);
  }

  public function upload()
  {
    $this->userController->upload();
  }

  public function crop($code = '', $file = '', $ext = '')
  {
    $this->userController->crop($code, $file, $ext);
  }

  public function keepimage($code = '', $image = '')
  {
    $this->userController->keepimage($code, $image);
  }

  public function delimage()
  {
    $this->userController->delimage();
  }

  public function uploadCompany()
  {
    $this->companyController->uploadCompany();
  }

  public function cropCompany($code = '', $file = '', $ext = '')
  {
    $this->companyController->cropCompany($code, $file, $ext);
  }

  public function keepimageCompany($code = '', $image = '')
  {
    $this->companyController->keepimageCompany($code, $image);
  }

  public function delimageCompany()
  {
    $this->companyController->delimageCompany();
  }
}
