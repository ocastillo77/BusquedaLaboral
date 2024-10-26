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

  public function render($view = 'index', $route = []) {
    $this->assign('view', $view);

    extract($this->_vars);

    $routes = [
      'header' => ROOT . 'view' . DS . URL_THEME . DS . 'template' . DS . 'a-header' . DS,
      'content' => ROOT . 'view' . DS . URL_THEME . DS . 'template' . DS . 'b-modules' . DS,
      'footer' => ROOT . 'view' . DS . URL_THEME . DS . 'template' . DS . 'c-footer' . DS,
      'common' => ROOT . 'view' . DS . URL_THEME . DS . 'template' . DS . 'b-modules' . DS . 'common' . DS,
      'publicidad' => ROOT . 'view' . DS . URL_THEME . DS . 'template' . DS . 'b-modules' . DS . 'publicidad' . DS,
    ];

    $fileView = $routes['content'] . $route['method'] . DS . 'index.php';

    if (is_readable($fileView)) {
      require_once $routes['header'] . 'index.php';
      require_once $fileView;
      require_once $routes['footer'] . 'index.php';
    } else {
      Helper::showError('Error: Vista ' . $fileView . ' no encontrada!');
      //Url::redirect('error');
    }
  }

}
