<?php

/*
 * ---------------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * Config.php
 * ---------------------------------------------
 */

//CONFIGURACION TIMEZONE
date_default_timezone_set('America/Argentina/Buenos_Aires');

define('PROTOCOL', isset($_SERVER['HTTPS']) ? 'https' : 'http');
define('IS_LOCAL', true);

//DATOS DE CONFIGURACIÓN DEL WEBSITE
if (IS_LOCAL) {
  define('URL_WEB', PROTOCOL . '://' . $_SERVER["HTTP_HOST"] . '/puestoweb/');
} else {
  define('URL_WEB', PROTOCOL . '://' . $_SERVER["HTTP_HOST"] . '/');
}

define('URL_THEME', 'jobzilla');
define('URL_ASS', URL_WEB . 'web/view/' . URL_THEME . '/assets/');
define('URL_GAL', URL_WEB . 'galleries/');
define('URL_CSS', URL_WEB . 'web/view/' . URL_THEME . '/assets/css/');
define('URL_JS', URL_WEB . 'web/view/' . URL_THEME . '/assets/js/');
define('URL_IMG', URL_WEB . 'web/view/' . URL_THEME . '/assets/images/');
define('URL_PLUGINS', URL_WEB . 'web/view/' . URL_THEME . '/assets/plugins/');
define('URL_PDF', URL_WEB . 'documents/');

//DATOS DE CONFIGURACIÓN DE CMS
define('URL_CMS', URL_WEB . 'cms/');
define('CMS_THEME', 'kingboard');
define('CMS_FONTS', URL_CMS . 'view/' . CMS_THEME . '/assets/fonts/');
define('CMS_CSS', URL_CMS . 'view/' . CMS_THEME . '/assets/css/');
define('CMS_JS', URL_CMS . 'view/' . CMS_THEME . '/assets/js/');
define('CMS_IMG', URL_CMS . 'view/' . CMS_THEME . '/assets/img/');
define('CMS_TEMP', URL_CMS . 'view/temp/');

define('TPL_BASE', ROOT . 'view' . DS . URL_THEME . DS . 'template' . DS);
define('TPL_HEADER', TPL_BASE . 'a-header' . DS);
define('TPL_CONTENT', TPL_BASE . 'b-modules' . DS);
define('TPL_FOOTER', TPL_BASE . 'c-footer' . DS);

//CONFIGURACION DE SESION
define('SESSION_PREF', 'cds_');
define('SESSION_TIME', 60);
define('HASH_KEY', '4f6a6d832be79');

//DATOS DE CONFIGURACIÓN DE LA WEB
define('APP_NAME', 'Encuentra Tu Puesto');
define('APP_WEB', 'www.encuentratupuesto.com');
define('APP_AUTOR', 'Oscar Castillo');
define('APP_DESCRIPTION', 'Sistema de Búsqueda Laboral');

//DATOS DE LA BASE DE DATOS
if (IS_LOCAL) {
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'puestoweb');
} else {
  define('DB_HOST', 'localhost');
  define('DB_USER', 'c2271760_web');
  define('DB_PASS', 'faleneDE61');
  define('DB_NAME', 'c2271760_web');
}

define('DB_CHAR', 'latin1');
define('DB_PREF', '');
define('DB_DRIVER', 'mysql');

//CONFIGURACION SMTP
if (IS_LOCAL) {
  define('SMTP_HOST', '');
  define('SMTP_USER', '');
  define('SMTP_PASS', '');
} else {
  define('SMTP_HOST', 'c2240440.ferozo.com');
  define('SMTP_USER', 'no-reply@encuentratupuesto.com');
  define('SMTP_PASS', '');
}

define('SMTP_PORT', 465);
define('SMTP_SECURE', 'ssl');
define('SMTP_CHARSET', 'utf-8');

//CONFIGURACION MERCADO PAGO TESTING
define('MP_ACCESS_TOKEN_TEST', 'TEST-8993669515272100-090100-9a650ff4b594fc02a7371fa3da835884-251133813');
define('MP_PUBLIC_KEY_TEST', 'TEST-e72d13d8-d69d-4be3-9f6e-971a948d6e7e');

//CONFIGURATION MERCADO PAGO PRODUCCION
define('MP_PUBLIC_KEY', 'APP_USR-47ccbed7-b71f-4789-bdb4-0e58f49e3099');
define('MP_ACCESS_TOKEN', 'APP_USR-8239442204679073-090317-34f63e21418e63902c3d18db0caf1fce-399046938');

//EMAILS DE TESTEO
define('ACTIVE_EMAIL', true);
define('EMAIL_WEBMASTER', 'ocastillo1108@gmail.com');
define('EMAIL_TESTER', 'ocastillo77@outlook.com');
define('EMAIL_NOREPLY', 'no-reply@encuentratupuesto.com');
