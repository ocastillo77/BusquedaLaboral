<?php

class Sanitize
{

  public static function email($var, $isPost = false)
  {
    $var = !$isPost ? $var : (isset($_POST[$var]) ? $_POST[$var] : '');
    $email = preg_replace('((?:\n|\r|\t|%0A|%0D|%08|%09)+)i', '', $var);
    $var = (string) filter_var($email, FILTER_SANITIZE_EMAIL);

    return $var;
  }

  public static function url($var, $isPost = false)
  {
    $var = !$isPost ? $var : (isset($_POST[$var]) ? $_POST[$var] : '');
    $var = (string) filter_var($var, FILTER_SANITIZE_URL);

    return $var;
  }

  public static function integer($var, $isPost = false)
  {
    $var = !$isPost ? $var : (isset($_POST[$var]) ? $_POST[$var] : '');
    $var = (int) filter_var($var, FILTER_SANITIZE_NUMBER_INT);

    return $var;
  }

  public static function string($var, $isPost = false)
  {
    $var = !$isPost ? $var : (isset($_POST[$var]) ? $_POST[$var] : '');
    $var = (string) filter_var($var, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    return $var;
  }

  public static function sql($var, $isPost = false)
  {
    $var = !$isPost ? $var : (isset($_POST[$var]) ? $_POST[$var] : '');
    $var = strip_tags($var);
    $var = stripslashes($var);
    
    return trim($var);
  }

  public static function html($var, $isPost = false)
  {
    $var = !$isPost ? $var : (isset($_POST[$var]) ? $_POST[$var] : '');
    $var = htmlspecialchars($var, ENT_QUOTES);

    return $var;
  }

}
