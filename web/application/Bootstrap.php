<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * Bootstrap.php
 * -------------------------------------
 */

class Bootstrap {

  public static function route(Request $request) {
    $controller = ucfirst($request->getController()) . 'Controller';
    $method = $request->getMethod();
    $args = $request->getArgs();

    $controllerFile = ROOT . 'controller' . DS . $controller . '.php';

    if (is_readable($controllerFile)) {
      require_once $controllerFile;

      $ctrl = $controller;
      $method = (is_callable(array(new $ctrl, $method))) ? $method : 'index';

      if (isset($args)) {
        call_user_func_array(array(new $ctrl, $method), $args);
      } else {
        call_user_func(array(new $ctrl, $method));
      }
    } else {
      Helper::showError('Error: Controlador ' . $controllerFile . ' no encontrado!');
    }
  }

}
