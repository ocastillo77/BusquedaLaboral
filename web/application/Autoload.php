<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * Autoload.php
 * -------------------------------------
 */

function autoloadCore($class) {
  $file = APP_PATH . ucfirst(strtolower($class)) . '.php';

  if (file_exists($file)) {
    require_once $file;
  }
}

function autoloadHelper($class) {
  $file = ROOT . 'helper' . DS . ucfirst($class) . '.php';

  if (file_exists($file)) {
    require_once $file;
  }
}

spl_autoload_register('autoloadCore');
spl_autoload_register('autoloadHelper');


