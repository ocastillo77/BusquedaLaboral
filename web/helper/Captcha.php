<?php

class Captcha
{
  public static function reset()
  {
    $_SESSION[SESSION_PREF . 'captcha'] = NULL;
  }

  public static function html($color = '#333', $bg = NULL)
  {
    self::reset();

    $bgcolor = '#ffffff';
    $_SESSION[SESSION_PREF . 'captcha'] = rand(10000, 99999);

    $_img = imagecreatetruecolor(80, 24);
    imagealphablending($_img, false);
    imagesavealpha($_img, true);

    if ($bg === NULL) {
      $bg = imagecolorallocatealpha($_img, 0, 0, 0, 127);
      imagecolortransparent($_img, $bg);
    } else {
      $bg = self::RGB($bgcolor);
      $bg = imagecolorallocatealpha($_img, $bg[0], $bg[1], $bg[2], 0);
    }
    imagefill($_img, 0, 0, $bg);

    $color = self::RGB($color);
    $color = imagecolorallocatealpha($_img, $color[0], $color[1], $color[2], 0);

    imagestring($_img, 5, 18, 3, $_SESSION[SESSION_PREF . 'captcha'], $color);
    ob_start();
    imagepng($_img);
    $img64 = base64_encode(ob_get_clean());
    return 'data:image/png;base64,' . $img64;
  }

  public static function htmlFont($color = '#333', $bg = NULL)
  {
    self::reset();

    $bgcolor = '#ffffff';
    $_SESSION[SESSION_PREF . 'captcha'] = rand(10000, 99999);

    $_img = imagecreatetruecolor(120, 40);
    imagealphablending($_img, false);
    imagesavealpha($_img, true);

    if ($bg === NULL) {
      $bg = imagecolorallocatealpha($_img, 0, 0, 0, 127);
      imagecolortransparent($_img, $bg);
    } else {
      $bg = self::RGB($bgcolor);
      $bg = imagecolorallocatealpha($_img, $bg[0], $bg[1], $bg[2], 0);
    }
    imagefill($_img, 0, 0, $bg);

    $color = self::RGB($color);
    $color = imagecolorallocatealpha($_img, $color[0], $color[1], $color[2], 0);

    $fontFile = ROOT . 'helper' . DS . 'fonts' . DS . 'courbd.ttf';
    $fontSize = 20;
    $x = 20;
    $y = 30;

    imagettftext($_img, $fontSize, 0, $x, $y, $color, $fontFile, $_SESSION[SESSION_PREF . 'captcha']);

    ob_start();
    imagepng($_img);
    $img64 = base64_encode(ob_get_clean());
    return 'data:image/png;base64,' . $img64;
  }

  public static function verify($str)
  {
    return !empty($_SESSION[SESSION_PREF . 'captcha']) && $str == $_SESSION[SESSION_PREF . 'captcha'];
  }

  public static function RGB($rgb)
  {
    if (is_string($rgb)) {
      $rgb = str_replace('#', '', $rgb); // #123 => 123

      if (strlen($rgb) === 3) // 123 => 112233
        $rgb = preg_replace('/^(.)(.)(.)$/', '\\1\\1\\2\\2\\3\\3', $rgb);

      $r = hexdec(substr($rgb, 0, 2));
      $g = hexdec(substr($rgb, 2, 2));
      $b = hexdec(substr($rgb, 4, 2));
    } else {
      list($r, $g, $b) = $rgb;
      if ($g == NULL || $b == NULL) {
        $r = $g = $b = $rgb;
      }
    }
    return array($r, $g, $b);
  }
}
