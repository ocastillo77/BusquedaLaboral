<?php

use Mpdf\Tag\Em;

class Helper
{

  public static function calculateDiscount($amountPrev, $amount)
  {
    $percentage = (($amountPrev - $amount) / $amountPrev) * 100;
    return round($percentage, 2);
  }

  public static function validatePassword($password)
  {
    $errors = [];
    if (strlen($password) < 8) {
      $errors[] = 1;
    }

    if (!preg_match('/[A-Z]/', $password)) {
      $errors[] = 1;
    }

    if (!preg_match('/[a-z]/', $password)) {
      $errors[] = 1;
    }

    if (!preg_match('/[0-9]/', $password)) {
      $errors[] = 1;
    }

    if (!empty($errors)) {
      return 'La contraseña debe tener al menos 8 caracteres, contener letras mayúsculas, minúsculas y números.';
    } else {
      return false;
    }
  }

  public static function simpleEncrypt($data, $key)
  {
    $cipher = "AES-128-CBC";
    $iv = substr(hash('sha256', $key), 0, 16);
    $encrypted = openssl_encrypt($data, $cipher, $key, 0, $iv);
    return rtrim(strtr(base64_encode($encrypted), '+/', '-_'), '=');
  }

  public static function simpleDecrypt($encrypted_data, $key)
  {
    $cipher = "AES-128-CBC";
    $iv = substr(hash('sha256', $key), 0, 16);
    $encrypted_data = base64_decode(strtr($encrypted_data, '-_', '+/'));
    $decrypted = openssl_decrypt($encrypted_data, $cipher, $key, 0, $iv);
    return $decrypted;
  }

  public static function generateSlug($texto)
  {
    $texto = strtolower($texto);
    $acentos = [
      'á' => 'a',
      'é' => 'e',
      'í' => 'i',
      'ó' => 'o',
      'ú' => 'u',
      'ñ' => 'n',
      'ä' => 'a',
      'ë' => 'e',
      'ï' => 'i',
      'ö' => 'o',
      'ü' => 'u',
      'Á' => 'a',
      'É' => 'e',
      'Í' => 'i',
      'Ó' => 'o',
      'Ú' => 'u',
      'Ñ' => 'n',
      'Ä' => 'a',
      'Ë' => 'e',
      'Ï' => 'i',
      'Ö' => 'o',
      'Ü' => 'u'
    ];
    $texto = strtr($texto, $acentos);
    $texto = preg_replace('/[^a-z0-9\s-]/', '', $texto);
    $texto = preg_replace('/[\s-]+/', '-', trim($texto));
    return $texto;
  }

  public static function getFirstLastName($name)
  {
    $partes = explode(' ', trim($name));
    if (count($partes) < 2) {
      return $name;
    }

    $nombre = $partes[0];
    $ultimoApellido = end($partes);
    $inicialApellido = strtoupper(substr($ultimoApellido, 0, 1));

    return $nombre . ' ' . $inicialApellido . '.';
  }

  public static function dump($var, $die = true)
  {
    echo '<pre>';
    print_r($var);
    print '</pre>';

    if ($die) {
      die();
    }
  }

  public static function verifyCompleteArrays($array1, $array2, $array3, $sizeArray1, $sizeArray2, $sizeArray3)
  {
    $array1 = self::removeWhitespace($array1);
    if (count($array1) < $sizeArray1 || in_array("", $array1, true)) {
      return false;
    }

    $array2 = self::removeWhitespace($array2);
    if (count($array2) < $sizeArray2 || in_array("", $array2, true)) {
      return false;
    }

    $array3 = self::removeWhitespace($array3);
    if (count($array3) < $sizeArray3 || in_array("", $array3, true)) {
      return false;
    }

    return true;
  }

  public static function removeWhitespace($array)
  {
    if (empty($array)) {
      return [];
    }

    return array_map(function ($value) {
      return trim($value);
    }, $array);
  }

  public static function convertArrayUnicodeToUTF8($jsonInput)
  {
    $jsonInput = str_replace(["\n", "\r"], '[br]', $jsonInput);
    $jsonInput = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($matches) {
      return mb_convert_encoding(pack('H*', $matches[1]), 'UTF-8', 'UCS-2BE');
    }, $jsonInput);

    $jsonInput = preg_replace('/u([0-9a-fA-F]{4})/', '\\\\u$1', $jsonInput);
    $jsonInput = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($matches) {
      return mb_convert_encoding(pack('H*', $matches[1]), 'UTF-8', 'UCS-2BE');
    }, $jsonInput);

    $arrayInput = json_decode($jsonInput, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
      self::dump($jsonInput);
      throw new \Exception('Error al decodificar JSON: ' . json_last_error_msg());
    }

    if (empty($arrayInput)) {
      return [];
    }

    array_walk_recursive($arrayInput, function (&$item) {
      if (is_string($item)) {
        $item = str_replace('[br]', "\n", $item);
      }
    });

    return $arrayInput;
  }

  public static function calculateTotalArray($bloque = [])
  {
    $suma = 0;
    if (!empty($bloque)) {
      foreach ($bloque as $value) {
        if (!empty($value)) {
          $suma += 1;
        }
      }
    }
    return $suma;
  }

  public static function checkDateInRange($fecha_inicio, $fecha_fin, $fecha)
  {
    $fecha_inicio = strtotime($fecha_inicio);
    $fecha_fin = strtotime($fecha_fin);
    $fecha = strtotime($fecha);

    if (($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin)) {
      return true;
    } else {
      return false;
    }
  }

  public static function filePostContents($url, $params)
  {
    $content = http_build_query($params, '', '&');
    $header = array(
      "Content-Type: application/x-www-form-urlencoded",
      "Content-Length: " . strlen($content)
    );
    $options = array(
      'http' => array(
        'method' => 'POST',
        'content' => $content,
        'header' => implode("\r\n", $header)
      )
    );
    return file_get_contents($url, false, stream_context_create($options));
  }

  public static function calculateDate($date, $days, $sign = '+', $format = 'd/m/Y')
  {
    $mod_date = strtotime($date . $sign . ' ' . $days . " days");
    return date($format, $mod_date) . "\n";
  }

  public static function stateOrder($item)
  {
    $string = '';

    switch ($item) {
      case 1:
        $string = Helper::tag2('span', 'Generado', ['class' => 'label label-primary']);
        break;
      case 2:
        $string = Helper::tag2('span', 'En Proceso', ['class' => 'label label-warning']);
        break;
      case 3:
        $string = Helper::tag2('span', 'En Delivery', ['class' => 'label label-info']);
        break;
      case 4:
        $string = Helper::tag2('span', 'Entregado', ['class' => 'label label-success']);
        break;
    }

    return $string;
  }

  public static function generateNroPedido($number, $digits = 8)
  {
    return str_pad($number, $digits, "0", STR_PAD_LEFT);
  }

  public static function generateNumbers($start, $count, $digits = 8)
  {
    $result = array();
    for ($n = $start; $n < $start + $count; $n++) {
      $result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
    }
    return $result;
  }

  public static function dateTimeFormat($datetime, $format = 'd/m/y - H:i:s')
  {
    return date($format, strtotime($datetime));
  }

  public static function setLastUrl($local = false)
  {
    $link = $_SERVER['REQUEST_URI'];

    if ($local) {
      $aUrl = explode('/', $link);
      array_shift($aUrl);
      array_shift($aUrl);
      $link = implode('/', $aUrl);
    } else {
      $aUrl = explode('/', $link);
      array_shift($aUrl);
      $link = implode('/', $aUrl);
    }

    return htmlspecialchars($link, ENT_QUOTES, 'UTF-8');
  }

  public static function generateSHA1($sessionId)
  {
    return sha1('xzr4' . gethostbyaddr($_SERVER['REMOTE_ADDR']) . $sessionId . $_SERVER['HTTP_USER_AGENT'] . 'f8k2');
  }

  public static function httpGet($url)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //  curl_setopt($ch,CURLOPT_HEADER, false);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
  }

  public static function httpPost($url, $params)
  {
    $postData = '';
    //create name value pairs seperated by &
    foreach ($params as $k => $v) {
      $postData .= $k . '=' . $v . '&';
    }

    $postData1 = rtrim($postData, '&');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
  }

  public static function showError($text)
  {
    $styles = 'border: 1px solid #FF5E5E;'
      . 'padding: 5px 10px;'
      . 'margin: 10px;'
      . 'background: #FFE6E6;'
      . 'color: #9D0000;';
    echo '<p style="' . $styles . '">' . $text . '</p>';
  }

  public static function downloadFile($filename = '')
  {
    if (empty($filename)) {
      exit();
    }

    $baseurl = GAL_PATH . 'files' . DS;
    $file = basename($filename);
    $path = $baseurl . $file;
    $type = '';

    if (is_file($path)) {
      $size = filesize($path);

      if (function_exists('mime_content_type')) {
        $type = mime_content_type($path);
      } else if (function_exists('finfo_file')) {
        $info = finfo_open(FILEINFO_MIME);
        $type = finfo_file($info, $path);
        finfo_close($info);
      }

      if ($type == '') {
        $type = "application/force-download";
      }

      header("Content-Type: $type");
      header("Content-Disposition: attachment; filename=$file");
      header("Content-Transfer-Encoding: binary");
      header("Content-Length: " . $size);

      readfile($path);
    } else {
      echo "Error: El archivo no existe.";
    }
  }

  public static function recordSort($records, $field, $reverse = false)
  {
    $hash = [];

    foreach ($records as $record) {
      $hash[$record[$field]] = $record;
    }

    $reverse ? krsort($hash) : ksort($hash);
    $recordsOut = [];

    foreach ($hash as $record) {
      $recordsOut[] = $record;
    }

    return $recordsOut;
  }

  public static function createFolder($folder, $sep = '/')
  {
    $arrayDir = explode($sep, $folder);
    $string = '';

    $i = 0;
    foreach ($arrayDir as $dir) {
      $separ = ($i > 0) ? $sep : '';
      $string .= $separ . $dir;

      if (!@is_dir($string)) {
        @mkdir($string, 0755);
        $error = 'Importante: Directorio creado correctamente!';
      } else {
        $error = 'Error: Directorio ya existe!';
      }
      $i++;
    }

    return $error;
  }

  public static function generatePassword($length = 8)
  {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    for ($pass = '', $n = strlen($chars) - 1; strlen($pass) < $length;) {
      $x = rand(0, $n);
      $pass .= $chars[$x];
    }
    return $pass;
  }

  public static function generatePasswordBin2Hex()
  {
    return bin2hex(random_bytes(4));
  }

  public static function generateToken($length = 50)
  {
    return bin2hex(random_bytes($length / 2));
  }

  public static function generateCode($length = 10)
  {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    for ($pass = '', $n = strlen($chars) - 1; strlen($pass) < $length;) {
      $x = rand(0, $n);
      $pass .= $chars[$x];
    }
    return $pass;
  }

  public static function alertMessage($class = '', $message = '')
  {
    $alert_css = (isset($class)) ? $class : '';
    $alert_msg = (isset($message)) ? $message : '';

    if (!empty($alert_msg)) {
      return '
				<script>' .
        "alertMessage('" . $alert_css . "','" . $alert_msg . "');" .
        '</script>';
    } else {
      return '';
    }
  }

  public static function extractTag($tag, $string = false)
  {
    $ps = [];

    if ($string) {
      $count = preg_match_all('/<' . $tag . '[^>]*>(.*?)<\/' . $tag . '>/is', $string, $matches);

      for ($i = 0; $i < $count; ++$i) {
        $ps[] = $matches[0][$i];
      }
    }

    return $ps;
  }

  public static function setResponse($resp)
  {
    $list = ['No', 'Si'];

    if (!empty($resp) && isset($list[$resp])) {
      return $list[$resp];
    }

    return $list[0];
  }

  public static function selectTextArray($text = '')
  {
    if (empty($text)) {
      return FALSE;
    }

    $result = [];
    $aValores = explode(',', $text);

    foreach ($aValores as $item) {
      $aItems = explode('=', $item);
      $result[$aItems[0]] = $aItems[1];
    }

    return $result;
  }

  public static function formatSQL($info = [])
  {
    if (isset($info['table']) && !empty($info['table'])) {
      $field = (isset($info['field'])) ? $info['field'] : '*';
      $where = (isset($info['where'])) ? "WHERE " . $info['where'] . " " : '';
      $join = (isset($info['join'])) ? implode(' ', $info['join']) . " " : '';
      $group = (isset($info['group'])) ? "GROUP BY " . $info['group'] . " " : '';
      $order = (isset($info['order'])) ? "ORDER BY " . $info['order'] . " " : '';
      $limit = (isset($info['limit'])) ? "LIMIT " . $info['limit'] : '';

      $table = DB_PREF . $info['table'];
      return "SELECT " . $field . " FROM " . $table . ' ' . $join . $where . $group . $order . $limit;
    }
  }

  public static function getRemoteFileSize($url)
  {
    $info = get_headers($url, 1);

    if (is_array($info['Content-Length'])) {
      $info = end($info['Content-Length']);
    } else {
      $info = $info['Content-Length'];
    }

    return $info;
  }

  public static function formatDateLarge($fecha, $anio = true)
  {
    $date = strtotime($fecha);
    $days = ['Domingo', 'Lunes', 'Martes', 'Mi&eacute;rcoles', 'Jueves', 'Viernes', 'S&aacute;bado'];
    $months = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    $year = date('Y', $date);
    $month = date('n', $date);
    $day = date('j', $date);
    $week = date('w', $date);
    $text_year = ($anio) ? ' ' . $year : '';
    return $days[$week] . ', ' . $day . ' de ' . $months[$month] . ' de ' . $text_year;
  }

  public static function getYoutubeIdFromUrl($url)
  {
    $parts = parse_url($url);
    if (isset($parts['query'])) {
      parse_str($parts['query'], $qs);
      if (isset($qs['v'])) {
        return $qs['v'];
      } else if (isset($qs['vi'])) {
        return $qs['vi'];
      }
    }
    if (isset($parts['path'])) {
      $path = explode('/', trim($parts['path'], '/'));
      return $path[count($path) - 1];
    }
    return false;
  }

  public static function textLimit($string, $limit = 50, $break = ' ', $pad = '...')
  {
    if (strlen($string) <= $limit)
      return $string;
    $breakpoint = strpos($string, $break, $limit);
    if ($breakpoint !== false) {
      if ($breakpoint < (strlen($string) - 1)) {
        $string = substr($string, 0, $breakpoint) . $pad;
      }
    }
    return $string;
  }

  public static function seoUrl($string)
  {
    $string = strtolower($string);
    $string = utf8_decode($string);
    $string = str_replace(' ', '-', $string);
    $string = str_replace('?', '', $string);
    $string = str_replace('+', '', $string);
    $string = str_replace(':', '', $string);
    $string = str_replace('??', '', $string);
    $string = str_replace('`', '', $string);
    $string = str_replace('!', '', $string);
    $string = str_replace('¿', '', $string);
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ??';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $string = strtr($string, utf8_decode($originales), $modificadas);

    return $string;
  }

  public static function diffDateTime($dateTime)
  {
    $fecha1 = new DateTime($dateTime);
    $fecha2 = new DateTime('now');
    $fecha = $fecha1->diff($fecha2);

    if ($fecha->y > 0) {
      return $fecha->y . ' a&ntilde;os';
    }
    if ($fecha->m > 0) {
      return $fecha->m . ' meses';
    }
    if ($fecha->d > 0) {
      return $fecha->d . ' d&iacute;as';
    }
    if ($fecha->h > 0) {
      return $fecha->h . ' horas';
    }
    if ($fecha->i > 0) {
      return $fecha->i . ' minutos';
    }
    if ($fecha->s > 0) {
      return $fecha->s . ' segundos';
    }
  }

  public static function setAttr($attributes = [])
  {
    $content = '';
    foreach ($attributes as $attribute => $value) {
      if ($value != '')
        $content .= ($content != '' ? ' ' : '') . $attribute . '="' . preg_replace('/\"/', '&quot;', $value) . '"';
    }
    return $content;
  }

  public static function tag($tag, $attributes = [])
  {
    return '<' . $tag . ' ' . self::setAttr($attributes) . '/>';
  }

  public static function tag2($tag, $value, $attributes = [])
  {
    return '<' . $tag . ' ' . self::setAttr($attributes) . '>' . $value . '</' . $tag . '>';
  }

  public static function input($attributes = [])
  {
    return '<input ' . self::setAttr($attributes) . ' />';
  }

  public static function moneyFormat($floatcurr, $curr = 'ARS', $decimals = 0)
  {
    $currencies['ARS'] = array($decimals, ',', '.');          //  Argentine Peso
    $currencies['AMD'] = array(2, '.', ',');          //  Armenian Dram
    $currencies['AWG'] = array(2, '.', ',');          //  Aruban Guilder
    $currencies['AUD'] = array(2, '.', ' ');          //  Australian Dollar
    $currencies['BSD'] = array(2, '.', ',');          //  Bahamian Dollar
    $currencies['BHD'] = array(3, '.', ',');          //  Bahraini Dinar
    $currencies['BDT'] = array(2, '.', ',');          //  Bangladesh, Taka
    $currencies['BZD'] = array(2, '.', ',');          //  Belize Dollar
    $currencies['BMD'] = array(2, '.', ',');          //  Bermudian Dollar
    $currencies['BOB'] = array(2, '.', ',');          //  Bolivia, Boliviano
    $currencies['BAM'] = array(2, '.', ',');          //  Bosnia and Herzegovina, Convertible Marks
    $currencies['BWP'] = array(2, '.', ',');          //  Botswana, Pula
    $currencies['BRL'] = array(2, ',', '.');          //  Brazilian Real
    $currencies['BND'] = array(2, '.', ',');          //  Brunei Dollar
    $currencies['CAD'] = array(2, '.', ',');          //  Canadian Dollar
    $currencies['KYD'] = array(2, '.', ',');          //  Cayman Islands Dollar
    $currencies['CLP'] = array(0, '', '.');          //  Chilean Peso
    $currencies['CNY'] = array(2, '.', ',');          //  China Yuan Renminbi
    $currencies['COP'] = array(2, ',', '.');          //  Colombian Peso
    $currencies['CRC'] = array(2, ',', '.');          //  Costa Rican Colon
    $currencies['HRK'] = array(2, ',', '.');          //  Croatian Kuna
    $currencies['CUC'] = array(2, '.', ',');          //  Cuban Convertible Peso
    $currencies['CUP'] = array(2, '.', ',');          //  Cuban Peso
    $currencies['CYP'] = array(2, '.', ',');          //  Cyprus Pound
    $currencies['CZK'] = array(2, '.', ',');          //  Czech Koruna
    $currencies['DKK'] = array(2, ',', '.');          //  Danish Krone
    $currencies['DOP'] = array(2, '.', ',');          //  Dominican Peso
    $currencies['XCD'] = array(2, '.', ',');          //  East Caribbean Dollar
    $currencies['EGP'] = array(2, '.', ',');          //  Egyptian Pound
    $currencies['SVC'] = array(2, '.', ',');          //  El Salvador Colon
    $currencies['ATS'] = array(2, ',', '.');          //  Euro
    $currencies['BEF'] = array(2, ',', '.');          //  Euro
    $currencies['DEM'] = array(2, ',', '.');          //  Euro
    $currencies['EEK'] = array(2, ',', '.');          //  Euro
    $currencies['ESP'] = array(2, ',', '.');          //  Euro
    $currencies['EUR'] = array(2, ',', '.');          //  Euro
    $currencies['FIM'] = array(2, ',', '.');          //  Euro
    $currencies['FRF'] = array(2, ',', '.');          //  Euro
    $currencies['GRD'] = array(2, ',', '.');          //  Euro
    $currencies['IEP'] = array(2, ',', '.');          //  Euro
    $currencies['ITL'] = array(2, ',', '.');          //  Euro
    $currencies['LUF'] = array(2, ',', '.');          //  Euro
    $currencies['NLG'] = array(2, ',', '.');          //  Euro
    $currencies['PTE'] = array(2, ',', '.');          //  Euro
    $currencies['GHC'] = array(2, '.', ',');          //  Ghana, Cedi
    $currencies['GIP'] = array(2, '.', ',');          //  Gibraltar Pound
    $currencies['GTQ'] = array(2, '.', ',');          //  Guatemala, Quetzal
    $currencies['HNL'] = array(2, '.', ',');          //  Honduras, Lempira
    $currencies['HKD'] = array(2, '.', ',');          //  Hong Kong Dollar
    $currencies['HUF'] = array(0, '', '.');          //  Hungary, Forint
    $currencies['ISK'] = array(0, '', '.');          //  Iceland Krona
    $currencies['INR'] = array(2, '.', ',');          //  Indian Rupee
    $currencies['IDR'] = array(2, ',', '.');          //  Indonesia, Rupiah
    $currencies['IRR'] = array(2, '.', ',');          //  Iranian Rial
    $currencies['JMD'] = array(2, '.', ',');          //  Jamaican Dollar
    $currencies['JPY'] = array(0, '', ',');          //  Japan, Yen
    $currencies['JOD'] = array(3, '.', ',');          //  Jordanian Dinar
    $currencies['KES'] = array(2, '.', ',');          //  Kenyan Shilling
    $currencies['KWD'] = array(3, '.', ',');          //  Kuwaiti Dinar
    $currencies['LVL'] = array(2, '.', ',');          //  Latvian Lats
    $currencies['LBP'] = array(0, '', ' ');          //  Lebanese Pound
    $currencies['LTL'] = array(2, ',', ' ');          //  Lithuanian Litas
    $currencies['MKD'] = array(2, '.', ',');          //  Macedonia, Denar
    $currencies['MYR'] = array(2, '.', ',');          //  Malaysian Ringgit
    $currencies['MTL'] = array(2, '.', ',');          //  Maltese Lira
    $currencies['MUR'] = array(0, '', ',');          //  Mauritius Rupee
    $currencies['MXN'] = array(2, '.', ',');          //  Mexican Peso
    $currencies['MZM'] = array(2, ',', '.');          //  Mozambique Metical
    $currencies['NPR'] = array(2, '.', ',');          //  Nepalese Rupee
    $currencies['ANG'] = array(2, '.', ',');          //  Netherlands Antillian Guilder
    $currencies['ILS'] = array(2, '.', ',');          //  New Israeli Shekel
    $currencies['TRY'] = array(2, '.', ',');          //  New Turkish Lira
    $currencies['NZD'] = array(2, '.', ',');          //  New Zealand Dollar
    $currencies['NOK'] = array(2, ',', '.');          //  Norwegian Krone
    $currencies['PKR'] = array(2, '.', ',');          //  Pakistan Rupee
    $currencies['PEN'] = array(2, '.', ',');          //  Peru, Nuevo Sol
    $currencies['UYU'] = array(2, ',', '.');          //  Peso Uruguayo
    $currencies['PHP'] = array(2, '.', ',');          //  Philippine Peso
    $currencies['PLN'] = array(2, '.', ' ');          //  Poland, Zloty
    $currencies['GBP'] = array(2, '.', ',');          //  Pound Sterling
    $currencies['OMR'] = array(3, '.', ',');          //  Rial Omani
    $currencies['RON'] = array(2, ',', '.');          //  Romania, New Leu
    $currencies['ROL'] = array(2, ',', '.');          //  Romania, Old Leu
    $currencies['RUB'] = array(2, ',', '.');          //  Russian Ruble
    $currencies['SAR'] = array(2, '.', ',');          //  Saudi Riyal
    $currencies['SGD'] = array(2, '.', ',');          //  Singapore Dollar
    $currencies['SKK'] = array(2, ',', ' ');          //  Slovak Koruna
    $currencies['SIT'] = array(2, ',', '.');          //  Slovenia, Tolar
    $currencies['ZAR'] = array(2, '.', ' ');          //  South Africa, Rand
    $currencies['KRW'] = array(0, '', ',');          //  South Korea, Won
    $currencies['SZL'] = array(2, '.', ', ');         //  Swaziland, Lilangeni
    $currencies['SEK'] = array(2, ',', '.');          //  Swedish Krona
    $currencies['CHF'] = array(2, '.', '\'');         //  Swiss Franc
    $currencies['TZS'] = array(2, '.', ',');          //  Tanzanian Shilling
    $currencies['THB'] = array(2, '.', ',');          //  Thailand, Baht
    $currencies['TOP'] = array(2, '.', ',');          //  Tonga, Paanga
    $currencies['AED'] = array(2, '.', ',');          //  UAE Dirham
    $currencies['UAH'] = array(2, ',', ' ');          //  Ukraine, Hryvnia
    $currencies['USD'] = array(2, '.', ',');          //  US Dollar
    $currencies['VUV'] = array(0, '', ',');          //  Vanuatu, Vatu
    $currencies['VEF'] = array(2, ',', '.');          //  Venezuela Bolivares Fuertes
    $currencies['VEB'] = array(2, ',', '.');          //  Venezuela, Bolivar
    $currencies['VND'] = array(0, '', '.');          //  Viet Nam, Dong
    $currencies['ZWD'] = array(2, '.', ' ');          //  Zimbabwe Dollar

    return number_format($floatcurr, $currencies[$curr][0], $currencies[$curr][1], $currencies[$curr][2]);
  }
}
