<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * Url.php
 * -------------------------------------
 */

class Url {

  public static function redirect($url = null, $fullpath = false) {
    $urlFinal = $fullpath == false ? URL_CMS . $url : $url;
    header('location: ' . $urlFinal);
    exit;
  }

}
