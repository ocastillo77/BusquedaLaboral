<?php

class Validate {

  public static function email($var, $isPost = false) {
    $var = !$isPost ? $var : (isset($_POST[$var]) ? $_POST[$var] : '');

    if (filter_var($var, FILTER_VALIDATE_EMAIL) === FALSE) {
      return false;
    }

    return true;
  }

  public static function url($var, $isPost = false) {
    $var = !$isPost ? $var : (isset($_POST[$var]) ? $_POST[$var] : '');

    if (filter_var($var, FILTER_VALIDATE_URL) === FALSE) {
      return false;
    }

    return true;
  }

  public static function integer($var, $isPost = false) {
    $var = !$isPost ? $var : (isset($_POST[$var]) ? $_POST[$var] : '');

    if (filter_var($var, FILTER_VALIDATE_INT) === FALSE) {
      return false;
    }

    return true;
  }

  public static function string($var, $isPost = false) {
    $var = !$isPost ? $var : (isset($_POST[$var]) ? $_POST[$var] : '');

    if (!is_string($var)) {
      return false;
    }

    return true;
  }

  public static function float($var, $isPost = false) {
    $var = !$isPost ? $var : (isset($_POST[$var]) ? $_POST[$var] : '');

    if (filter_var($var, FILTER_VALIDATE_FLOAT) === false) {
      return false;
    }

    return true;
  }

  public static function boolean($var, $isPost = false) {
    $var = !$isPost ? $var : (isset($_POST[$var]) ? $_POST[$var] : '');

    if (filter_var($var, FILTER_VALIDATE_BOOLEAN) === false) {
      return false;
    }

    return true;
  }

  public static function alphaNumeric($var, $isPost = false) {
    $var = !$isPost ? $var : (isset($_POST[$var]) ? $_POST[$var] : '');

    if (!preg_match('/^[a-z\d_]{4,28}$/i', $var)) {
      return false;
    }

    return $var;
  }

}
