<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * Url.php
 * -------------------------------------
 */

class Url
{

  public static function redirect($url = null, $fullpath = false)
  {
    $urlFinal = $fullpath == false ? URL_WEB . $url : $url;
    header('location: ' . $urlFinal);
    exit;
  }

  public static function response($message, $url = false)
  {
    if (!empty($url)) {
      echo json_encode([
        'code' => 200,
        'message' => $message,
        'redirect' => URL_WEB . $url
      ]);
    } else {
      echo json_encode([
        'code' => 400,
        'message' => $message,
        'redirect' => false
      ]);
    }
  }
}
