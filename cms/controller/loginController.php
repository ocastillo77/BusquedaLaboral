<?php

class loginController extends Controller {

  private $model;

  public function __construct() {
    parent::__construct();
    $this->model = Load::model('login');
  }

  public function index() {
    $cookie = $this->model->verifyCookie();

    if ($cookie) {
      $this->initSession($cookie);
      Url::redirect();
    }

    if (Session::get('authorized')) {
      Url::redirect();
    }

    $data['title'] = 'Inicia sesi&oacute;n con tu nombre de usuario y contrase&ntilde;a.';

    if (Validate::integer('login', true) == 1) {
      $data['login'] = $_POST;
      $this->view->assign('data', $data);

      $post_user = Sanitize::string('username', true);
      $post_pass = Sanitize::sql('password', true);
      $nologout = Validate::integer('nologout', true);

      if (empty($post_user)) {
        $data['error']['message'] = 'Debe ingresar su nombre de usuario';
        $data['error']['type'] = 'danger';
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      if (empty($post_pass)) {
        $data['error']['message'] = 'Debe ingresar su contrase&ntilde;a';
        $data['error']['type'] = 'danger';
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      $user = $this->model->getUser($post_user, $post_pass);

      if (!$user) {
        $data['error']['message'] = 'Usuario y/o contrase&ntilde;a incorrectos';
        $data['error']['type'] = 'danger';
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      if ($user['Publico'] != 1) {
        $data['error']['message'] = 'Este usuario no esta habilitado';
        $data['error']['type'] = 'danger';
        $this->view->assign('data', $data);
        $this->view->render();
        exit;
      }
      $this->initSession($user, $nologout);

      Url::redirect();
    }
    $this->view->assign('data', $data);
    $this->view->render();
  }

  public function initSession($user, $nologout = 0) {
    Session::set('authorized', true);
    Session::set('level', $user['RolID']);
    Session::set('name', $user['Nombre']);
    Session::set('email', $user['Email']);
    Session::set('user', $user['Usuario']);
    Session::set('user_id', $user['ID']);
    Session::set('time', time());

    $fields['ID'] = $user['ID'];
    $fields['UltimaVez'] = date('Y-m-d H:i:s', time());

    Session::set('em_active', true);
    Session::set('em_name', 'Administrador ETP');
    Session::set('em_access', null);
    Session::set('em_user', 'licmelisahorn@gmail.com');
    Session::set('em_user_id', 3);

    if ($nologout == 1) {
      $fields['KeyCookie'] = Session::generateCookie($user['ID']);
    }
    $this->model->saveAccess($fields);
  }

  public function close() {
    Session::destroy();
    Session::destroyCookie();

    Url::redirect();
  }

}
