<?php

ini_set('display_errors', 1);

define('DS', DIRECTORY_SEPARATOR);
define('PATH', realpath(dirname(__FILE__)) . DS);
define('WEB_PATH', PATH . 'web' . DS);

require_once WEB_PATH . 'index.php';
