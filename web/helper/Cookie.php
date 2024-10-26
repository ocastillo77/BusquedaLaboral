<?php

class Cookie
{

  protected $_cookie_name = 'bs_cookie';
  protected $_cookie_path = '';
  protected $_cookie_expire = 7200;
  protected $_cookie_secure = FALSE;
  protected $_cookie_http = FALSE;
  protected $_serlized = FALSE;

  public function __construct()
  {

  }

  public function set($name, $data)
  {
    if (!empty($name)) {
      $this->_cookie_name = $name;
    }

    if (is_array($data)) {
      $data = serialize($data);
      $this->_serlized = TRUE;
    }
    return setcookie($this->_cookie_name, $data, $this->_cookie_expire);
  }

  public function get($name = NULL)
  {
    if (!empty($name)) {
      $this->_cookie_name = $name;
    }

    if ($this->_serlized === TRUE) {
      if (isset($_COOKIE[$this->_cookie_name])) {
        return unserialize($_COOKIE[$this->_cookie_name]);
      } else {
        return FALSE;
      }
    }

    return $_COOKIE[$this->_cookie_name];
  }

  public function clean($name = NULL)
  {
    if (!empty($name)) {
      $this->_cookie_name = $name;
    }

    if (isset($_COOKIE[$this->_cookie_name])) {
      unset($_COOKIE[$this->_coookie_name]);
      return TRUE;
    }

    return FALSE;
  }

  public function flush()
  {
    return $_COOKIE;
  }

  public function destroy()
  {
    $_COOKIE = array();
  }

}
