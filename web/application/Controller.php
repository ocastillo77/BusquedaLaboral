<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * Controller.php
 * -------------------------------------
 */

abstract class Controller
{

  protected $registry;
  protected $view;
  protected $route;
  protected $baseUrl;
  protected $dirRoot;
  protected $dirTemp;
  protected $dirImage;
  private static $_item;

  abstract public function index();

  public function __construct()
  {
    $this->registry = Registry::getInstance();
    $request = $this->registry->_request;

    $this->route['controller'] = self::$_item = $request->getController();
    $this->route['method'] = $request->getMethod();
    $this->route['params'] = $request->getArgs();

    $this->view = new View;
    $this->view->assign('route', $this->route);
  }

  protected function initialize()
  {
    $menuTop = new MenuTop();
    $this->view->assign('menu_top', $menuTop->render());

    $this->dirRoot = $this->route['controller'] . DS;
    $this->dirTemp = ROOT . 'view' . DS . 'temp' . DS;
  }

  public function detectMobile()
  {
    $detect = new MobileDetect();
    return $detect->isMobile() || $detect->isTablet();
  }

  public static function getItem()
  {
    return self::$_item;
  }

  public function createImage($file, $folder, $new_name, $new_w, $new_h, $crop_x = -1, $crop_y = -1)
  {
    list($lwidth, $lheight, $ltype, $lattr) = getimagesize($file);
    $thumb_w = $new_w;
    $thumb_h = $new_h;

    switch ($ltype) {
      case IMAGETYPE_GIF:
        $src_img = imagecreatefromgif($file);
        break;
      case IMAGETYPE_JPEG:
        $src_img = imagecreatefromjpeg($file);
        break;
      case IMAGETYPE_PNG:
        $src_img = imagecreatefrompng($file);
        break;
    }

    $old_x = imageSX($src_img);
    $old_y = imageSY($src_img);

    if ($crop_x == -1 && $crop_y == -1) {
      if (($old_x > $old_y) || ($old_x < $old_y)) {
        $thumb_w = $new_w;
        $percent = ($new_w * 100) / $old_x;
        $thumb_h = ceil(($percent * $old_y) / 100);
      }
      if ($thumb_h < $new_h) {
        $percent = ($new_h * 100) / $old_y;
        $thumb_w = ceil(($percent * $old_x) / 100);
        $thumb_h = $new_h;
      }
      if ($old_x == $old_y) {
        $thumb_w = $new_w;
        $thumb_h = $new_h;
      }
    }

    $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);

    if ($ltype == IMAGETYPE_GIF || $ltype == IMAGETYPE_PNG) {
      $trans_index = imagecolortransparent($src_img);

      if ($trans_index >= 0) {
        $trans_color = imagecolorsforindex($src_img, $trans_index);
        $trans_index = imagecolorallocate($dst_img, $trans_color['red'], $trans_color['green'], $trans_color['blue']);
        imagefill($dst_img, 0, 0, $trans_index);
        imagecolortransparent($dst_img, $trans_index);
      } elseif ($ltype == IMAGETYPE_PNG) {
        imagealphablending($dst_img, false);
        $color = imagecolorallocatealpha($dst_img, 0, 0, 0, 127);
        imagefill($dst_img, 0, 0, $color);
        imagesavealpha($dst_img, true);
      }
    }

    if ($crop_x == -1 && $crop_y == -1) {
      imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);
    } else {
      imagecopyresampled($dst_img, $src_img, 0, 0, $crop_x, $crop_y, $new_w, $new_h, $new_w, $new_h);
    }

    switch ($ltype) {
      case IMAGETYPE_GIF:
        $ext = '.gif';
        imagegif($dst_img, $folder . $new_name . $ext, 100); //soporta de 0 - 100
        break;
      case IMAGETYPE_JPEG:
        $ext = '.jpg';
        imagejpeg($dst_img, $folder . $new_name . $ext, 100); //soporta de 0 - 100
        break;
      case IMAGETYPE_PNG:
        $ext = '.png';
        imagepng($dst_img, $folder . $new_name . $ext, 9); //soporta de 0 - 9
        break;
    }

    imagedestroy($dst_img);
    imagedestroy($src_img);

    return file_exists($folder . $new_name . $ext) ? $new_name . $ext : false;
  }

  public function uploadFile($tabla, $source = null, $width = '', $height = '')
  {
    $json = array('success' => 0);

    if (isset($source['name'])) {
      $dir_file = GAL_PATH . $tabla . DS . 'files' . DS;
      Helper::createFolder($dir_file, DS);

      $temp = $source['tmp_name'];
      $new_name = mt_rand(1, 99999999);

      if (is_uploaded_file($temp)) {
        $info = pathinfo($source['name']);
        $ext = $info['extension'];

        $new_upload = 'FIL_' . $new_name . '.' . $ext;

        if (move_uploaded_file($temp, $dir_file . $new_upload)) {
          $json = array(
            'success' => 1,
            'code' => $new_name,
            'name' => $new_upload,
            'width' => $width,
            'height' => $height,
            'swf' => $new_upload,
            'url' => URL_CMS . $tabla . '/download/'
          );
        }
      }
    }

    return json_encode($json);
  }

  public function uploadImage($tabla, $source = null, $wimage = 0, $himage = 0, $wthumb = 0, $hthumb = 0, $auto = false)
  {
    $type = 0;
    $json = ['success' => $type];

    if (isset($source['name'])) {
      $dir_thumb = GAL_PATH . $tabla . DS . 'thumbs' . DS;
      $dir_image = GAL_PATH . $tabla . DS . 'images' . DS;
      $temp = $source['tmp_name'];
      $new_name = mt_rand(1, 99999999);
      $new_upload = $this->createImage($temp, $this->dirTemp, $new_name, $wimage, $himage);

      if ($new_upload) {
        list($lwidth, $lheight, $ltype, $lattr) = getimagesize($this->dirTemp . $new_upload);
        $new_w = $lwidth;
        $new_h = $lheight;

        if ($new_h > $himage) {
          $type = 2;
        } elseif ($new_w > $wimage) {
          $type = 2;
        } elseif (($new_h == $himage && $new_w == $wimage)) {
          $type = 1;
        }

        if ($type == 1 || $auto) {
          Helper::createFolder($dir_thumb, DS);
          Helper::createFolder($dir_image, DS);

          $this->createImage($this->dirTemp . $new_upload, $dir_image, 'IM_' . $new_name, $wimage, $himage);
          $this->createImage($this->dirTemp . $new_upload, $dir_thumb, 'TH_' . $new_name, $wthumb, $hthumb);
          unlink($this->dirTemp . $new_upload);
          $type = 1;
        }

        $json = array(
          'success' => $type,
          'code' => $new_name,
          'name' => $new_upload,
          'width' => $new_w,
          'height' => $new_h,
          'image' => $new_upload,
          'title' => $new_name,
          'url' => URL_GAL . $tabla . '/'
        );
      }
    }

    return json_encode($json);
  }

  public function cropImage($tabla, $width, $height)
  {
    $tabla = $this->route['controller'];
    $dir_thumb = GAL_PATH . $tabla . DS . 'thumbs' . DS;
    $dir_image = GAL_PATH . $tabla . DS . 'images' . DS;

    Helper::createFolder($dir_thumb, DS);
    Helper::createFolder($dir_image, DS);

    $code = $_POST['code'];
    $name = explode('.', $_POST['img']);
    $image = $_POST['img'];
    $new_name = $name[0];
    $new_image = $this->createImage($this->dirTemp . $image, $dir_image, 'IM_' . $new_name, $_POST['w'], $_POST['h'], $_POST['x'], $_POST['y']);

    if ($new_image) {
      unlink($this->dirTemp . $image);
      $new_thumb = $this->createImage($dir_image . $new_image, $dir_thumb, 'TH_' . $new_name, $width, $height);

      if ($new_thumb) {
        echo "<script>
				parent.setImage('" . $code . "','" . $image . "','" . URL_GAL . $tabla . '/' . "');
				parent.jQuery.fancybox.close();
				</script>";
      }
    } else {
      echo 'Error: No se pudo recortar la imagen!';
    }
  }

  public function originalImage($tabla, $code, $image, $wimage = 0, $himage = 0, $wthumb = 0, $hthumb = 0)
  {
    $dir_thumb = GAL_PATH . $tabla . DS . 'thumbs' . DS;
    $dir_image = GAL_PATH . $tabla . DS . 'images' . DS;
    $nameimg = explode('.', $image);

    Helper::createFolder($dir_thumb, DS);
    Helper::createFolder($dir_image, DS);

    $this->createImage($this->dirTemp . $image, $dir_image, 'IM_' . $nameimg[0], $wimage, $himage);
    $this->createImage($this->dirTemp . $image, $dir_thumb, 'TH_' . $nameimg[0], $wthumb, $hthumb);

    unlink($this->dirTemp . $image);

    return "<script>
				parent.setImage('" . $code . "','" . $image . "','" . URL_GAL . $tabla . '/' . "');
				parent.jQuery.fancybox.close();
				</script>";
  }

  public function displayCrop($code = '', $imagen = '', $width = 0, $height = 0)
  {
    list($lwidth, $lheight, $ltype, $lattr) = getimagesize($this->dirTemp . $imagen);

    $data['action'] = $this->baseUrl . 'crop';
    $data['code'] = $code;
    $data['image'] = $imagen;
    $data['new_w'] = $lwidth;
    $data['new_h'] = $lheight;
    $data['wimage'] = $width;
    $data['himage'] = $height;
    $data['tabla'] = $this->route['controller'];

    echo Load::view('jcrop' . DS . 'index.php', $data);
  }

  public static function formatSendComment($item = [], $articulo = false)
  {
  }

  public static function formatSendMail($item = [])
  {
  }

  public static function sendSimpleMail($data = array())
  {
    $mail = new PHPMailer();
    $mail->From = $data['from_email'];
    $mail->FromName = $data['from_name'];
    $mail->Subject = $data['subject'];
    $mail->Body = $data['body'];
    $mail->AltBody = 'Su servidor de correo no soporta HTML';
    $mail->AddAddress($data['to_email']);

    if (isset($data['file_temp'])) {
      $mail->AddAttachment($data['file_temp'], $data['file_name']);
    }

    return $mail->Send() ? true : false;
  }

  public static function sendMail1($data = [], $isHTML = false)
  {
    Load::library('PHPMailer/PHPMailerAutoload');

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USER;
    $mail->Password = SMTP_PASS;
    $mail->SMTPSecure = SMTP_SECURE;
    $mail->Port = SMTP_PORT;
    $mail->CharSet = SMTP_CHARSET;
    //
    $mail->From = $data['from_email'];
    $mail->FromName = $data['from_name'];
    $mail->Subject = $data['subject'];


    if ($isHTML) {
      $mail->MsgHTML($data['body']);
      $mail->IsHTML(true);
    } else {
      $mail->Body = $data['body'];
      $mail->AltBody = 'Su servidor de correo no soporta HTML';
    }
    //
    $to_name = isset($data['to_name']) ? $data['to_name'] : '';
    $mail->AddAddress($data['to_email'], $to_name);

    if (isset($data['addcc_emails'])) {
      foreach ($data['addcc_emails'] as $email => $name) {
        $mail->AddCC($email, $name);
      }
    }

    if (isset($data['addbcc_emails'])) {
      foreach ($data['addbcc_emails'] as $email => $name) {
        $mail->addBCC($email, $name);
      }
    }

    if (isset($data['url_attached'])) {
      $filename = isset($data['filename']) ? $data['filename'] : 'Documento PDF';
      $mail->AddAttachment($data['url_attached'], $filename);
    }

    if (!$mail->Send()) {
      $response = [
        'message' => "Error de envío: " . $mail->ErrorInfo,
        'status' => 0
      ];
    } else {
      $response = [
        'message' => "Mensaje envíado correctamente!",
        'status' => 1
      ];
    }

    return $response;
  }
}
