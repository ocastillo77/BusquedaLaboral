<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * View.php
 * -------------------------------------
 */

class View {

  private $_vars;

  public function assign($name, $value = null) {
    if (is_array($name)) {
      $this->_vars = $name + $this->_vars;
    } else {
      $this->_vars[$name] = $value;
    }
  }

  public function render($view = '', $route = []) {
    $this->assign('view', $view);

    extract($this->_vars);

    $_rutaFiles = [
        'header' => ROOT . 'view' . DS . CMS_THEME . DS . 'template' . DS . 'a-header' . DS,
        'content' => ROOT . 'view' . DS . CMS_THEME . DS . 'template' . DS . 'b-content' . DS,
        'footer' => ROOT . 'view' . DS . CMS_THEME . DS . 'template' . DS . 'c-footer' . DS
    ];

    if (Session::get('authorized')) {
      $fileView = $_rutaFiles['content'] . 'modules' . DS . $route['controller'] . DS . $route['method'] . '.php';

      if (is_readable($fileView)) {
        require_once $_rutaFiles['header'] . 'index.php';
        require_once $_rutaFiles['content'] . 'sidebar' . DS . 'index.php';
        require_once $_rutaFiles['content'] . 'modules' . DS . 'header.php';
        require_once $fileView;
        require_once $_rutaFiles['content'] . 'modules' . DS . 'footer.php';
        require_once $_rutaFiles['footer'] . 'index.php';
      } else {
        Helper::showError('Error: Vista ' . $fileView . ' no encontrada!');
      }
    } else {
      require_once $_rutaFiles['header'] . 'index.php';
      require_once $_rutaFiles['content'] . $route['controller'] . DS . 'index.php';
      require_once $_rutaFiles['footer'] . 'index.php';
    }
  }

}
