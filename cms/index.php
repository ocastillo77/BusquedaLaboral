<?php

ini_set('display_errors', 1);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('UP_PATH', realpath('../') . DS);
define('APP_PATH', ROOT . 'application' . DS);
define('GAL_PATH', UP_PATH . 'galleries' . DS);

try {
  ob_start();
  require_once APP_PATH . 'Autoload.php';
  require_once UP_PATH . 'config.php';

  Session::init();

  $r = Registry::getInstance();
  $r->_request = new Request;
  $r->_db = Database::connect();

  Bootstrap::route($r->_request);
  ob_flush();
} catch (Exception $e) {
  echo $e->getMessage();
}
