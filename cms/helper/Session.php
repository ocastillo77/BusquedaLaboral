<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * Session.php
 * -------------------------------------
 */

class Session {

  private static $_start = false;

  public static function init() {
    if (self::$_start == false) {
      session_start();
      self::$_start = true;
    }
  }

  public static function set($key, $value) {
    $_SESSION[SESSION_PREF . $key] = $value;
  }

  public static function pull($key) {
    $value = $_SESSION[SESSION_PREF . $key];
    unset($_SESSION[SESSION_PREF . $key]);

    return $value;
  }

  public static function get($key, $secondkey = false) {
    if ($secondkey == true) {
      if (isset($_SESSION[SESSION_PREF . $key][$secondkey])) {
        return $_SESSION[SESSION_PREF . $key][$secondkey];
      }
    } else {
      if (isset($_SESSION[SESSION_PREF . $key])) {
        return $_SESSION[SESSION_PREF . $key];
      }
    }
    return false;
  }

  public static function display() {
    return $_SESSION;
  }

  public static function destroy() {
    if (self::$_start == true) {
      session_unset();
      session_destroy();
    }
  }

  public static function generateToken() {
    $token = md5(uniqid(microtime(), true));
    Session::set('token', $token);
  }

  public static function timer() {
    if (!Session::get('time') || !defined('SESSION_TIME')) {
      throw new Exception('No se ha definido el tiempo de la Sesi�n');
    }

    if (SESSION_TIME == 0) {
      return;
    }

    if (time() - Session::get('time') > (SESSION_TIME * 60)) {
      Session::destroy();
      Url::redirect('error/access');
    } else {
      Session::set('time', time());
    }
  }

  public static function generateCookie($user_id, $days = 30) {
    mt_srand(time());
    $random = mt_rand(1000000, 999999999);
    setcookie('user_id', $user_id, time() + (60 * 60 * 24 * $days));
    setcookie('key_cookie', $random, time() + (60 * 60 * 24 * $days));

    return $random;
  }

  public static function destroyCookie() {
    unset($_COOKIE['user_id']);
    unset($_COOKIE['key_cookie']);

    setcookie('user_id', '', time() - 3600);
    setcookie('key_cookie', '', time() - 3600);
  }

}
