<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * Controller.php
 * -------------------------------------
 */

class Load
{

  public static function view($fileLink, $data = [])
  {
    $viewFile = ROOT . 'view' . DS . URL_THEME . DS . 'template' . DS . $fileLink;

    if (is_readable($viewFile)) {
      require($viewFile);
    } else {
      Helper::showError('Error: Vista ' . $viewFile . ' no encontrada!');
    }
  }

  public static function model($name)
  {
    $model = $name . 'Model';
    $modelPath = ROOT . 'model' . DS . $model . '.php';

    if (is_readable($modelPath)) {
      require_once($modelPath);

      if (class_exists($model)) {
        $registry = Registry::getInstance();
        $registry->$name = new $model;
        return $registry->$name;
      }
    } else {
      Helper::showError('Error: Modelo ' . $modelPath . ' no encontrado');
    }
  }

  public static function library($name)
  {
    $libPath = ROOT . 'lib' . DS . $name . '.php';

    if (is_readable($libPath)) {
      require_once($libPath);
    } else {
      Helper::showError('Error: Libreria ' . $libPath . ' no encontrada');
    }
  }
}
