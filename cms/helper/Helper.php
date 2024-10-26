<?php

class Helper
{

  public static function completeNumbers($number, $digits = 8)
  {
    return str_pad($number, $digits, "0", STR_PAD_LEFT);
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

  public static function dateTimeFormat($datetime, $format = 'd/m/y - H:i:s')
  {
    return date($format, strtotime($datetime));
  }

  public static function stateOrder($item)
  {
    $string = '';

    switch ($item) {
      case 1:
        $string = Helper::tag2('span', 'Generado', ['class' => 'label label-black']);
        break;
      case 2:
        $string = Helper::tag2('span', 'En Proceso', ['class' => 'label label-warning']);
        break;
      case 3:
        $string = Helper::tag2('span', 'En Delivery', ['class' => 'label label-primary']);
        break;
      case 4:
        $string = Helper::tag2('span', 'Entregado', ['class' => 'label label-success']);
        break;
    }

    return $string;
  }

  public static function slug($string, $separator = '-')
  {
    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
    $special_cases = array('&' => 'and', "'" => '');
    $string = mb_strtolower(trim($string), 'UTF-8');
    $string = str_replace(array_keys($special_cases), array_values($special_cases), $string);
    $string = preg_replace($accents_regex, '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'));
    $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
    $string = preg_replace("/[$separator]+/u", "$separator", $string);
    return $string;
  }

  public static function post($var, $response = NULL)
  {
    return isset($_POST[$var]) ? $_POST[$var] : $response;
  }

  public static function addClassAlign($heads, $colfirst = false, $colend = true)
  {
    $aligns = '[';
    $aligns .= $colfirst ? '{sClass: "center"},' : '';

    foreach ($heads as $item) {
      $aligns .= '{sClass: "' . $item['align'] . '"},';
    }

    $aligns .= $colend ? '{sClass: "center"}' : '';
    $aligns .= ']';

    return $aligns;
  }

  public static function formatState($item)
  {
    $string = '';

    switch ($item) {
      case 1:
        $string = Helper::tag2('span', 'P&uacute;blico', ['class' => 'label label-success']);
        break;
      case 2:
        $string = Helper::tag2('span', 'Borrador', ['class' => 'label label-warning']);
        break;
      case 3:
        $string = Helper::tag2('span', 'Archivado', ['class' => 'label label-danger']);
        break;
    }

    return $string;
  }

  public static function formatTable($table)
  {
    $aTable = explode('_', $table);
    array_shift($aTable);
    return implode('_', $aTable);
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

  public static function sendMail($data = [])
  {
    $output = true;
    Load::library('phpmailer/class.phpmailer');
    $mail = new PHPMailer();

    $mail->From = $data['from_email'];
    $mail->FromName = $data['from_name'];
    $mail->Subject = $data['subject'];
    $mail->Body = $data['body'];
    $mail->AltBody = 'Su servidor de correo no soporta HTML';
    $mail->AddAddress($data['to_email']);

    if (!$mail->Send()) {
      $error = 'Error: ' . $mail->ErrorInfo;
      $output = false;
    }

    return $output;
  }

  public static function getMetadataImage($image)
  {
    $size = getimagesize($image, $info);
    $result = '';

    if (isset($info["APP13"])) {
      $iptc1 = iptcparse($info["APP13"]);

      if (is_array($iptc1)) {
        $result = isset($iptc1['2#025']) ? implode(', ', $iptc1['2#025']) : 'Mendoza';
      }
    }

    return $result;
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

  public static function showError($text)
  {
    $styles = 'border: 1px solid #FF5E5E;'
      . 'padding: 5px 10px;'
      . 'margin: 10px;'
      . 'background: #FFE6E6;'
      . 'color: #9D0000;';
    echo '<p style="' . $styles . '">' . $text . '</p>';
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

  public static function cleaningString($string = false)
  {
    if ($string) {
      $string = str_replace(array('&aacute;', '&Aacute;'), array('á', 'Á'), $string);
      $string = str_replace(array('&eacute;', '&Eacute;'), array('é', 'É'), $string);
      $string = str_replace(array('&iacute;', '&Iacute;'), array('í', 'Í'), $string);
      $string = str_replace(array('&oacute;', '&Oacute;'), array('ó', 'Ó'), $string);
      $string = str_replace(array('&uacute;', '&Uacute;'), array('ú', 'Ú'), $string);
      $string = str_replace(array('&ntilde;', '&Ntilde;'), array('ñ', 'Ñ'), $string);
      $string = str_replace('&nbsp;', ' ', $string);
    }

    return $string;
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

  public static function defaultValue($variable)
  {
    return isset($variable) ? $variable : 0;
  }

  public static function formatSQL($info = [])
  {
    if (isset($info['table']) && !empty($info['table'])) {
      $field = (isset($info['fields'])) ? implode(', ', $info['fields']) : '*';
      $where = (isset($info['where'])) ? "WHERE " . implode(' AND ', $info['where']) . " " : '';
      $join = (isset($info['join'])) ? implode(' ', $info['join']) . " " : '';
      $group = (isset($info['group'])) ? "GROUP BY " . $info['group'] . " " : '';
      $order = (isset($info['order'])) ? "ORDER BY " . $info['order'] . " " : '';
      $limit = (isset($info['limit'])) ? "LIMIT " . $info['limit'] : '';

      $table = $info['table'];
      $query = "SELECT " . $field . " FROM " . $table . ' ' . $join . $where . $group . $order . $limit;

      return $query;
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

  public static function imageYoutube($code, $num = 0)
  {
    return "http://img.youtube.com/vi/" . $code . "/" . $num . ".jpg";
  }

  public static function calculateDate($date, $days, $sign = '+', $format = 'd/m/Y')
  {
    $mod_date = strtotime($date . $sign . ' ' . $days . " days");
    return date($format, $mod_date) . "\n";
  }

  public static function formatDateLarge($datetime)
  {
    $anioHoy = date('Y');
    $fechaHoy = date('Y-m-d');
    $strYear = '';

    $date = strtotime($datetime);
    $days = array('Domingo', 'Lunes', 'Martes', 'Mi&eacute;rcoles', 'Jueves', 'Viernes', 'S&aacute;bado');
    $months = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    $year = date('Y', $date);
    $month = date('n', $date);
    $day = date('j', $date);
    $week = date('w', $date);

    if ($year !== $anioHoy) {
      $strYear = ' de ' . $year;
    }

    $newDate = $days[$week] . ', ' . $day . ' de ' . $months[$month] . $strYear;

    if ($fechaHoy == $datetime) {
      $newDate = 'Hoy';
    }

    $fechaAyer = Helper::calculateDate($fechaHoy, 1, '-', 'Y-m-d');

    if (trim($fechaAyer) == $datetime) {
      $newDate = 'Ayer';
    }

    return $newDate;
  }

  public static function textLimit($string, $limit, $break = ' ', $pad = '...')
  {
    if (strlen($string) <= $limit) {
      return $string;
    }

    $breakpoint = strpos($string, $break, $limit);

    if ($breakpoint !== false) {
      if ($breakpoint < (strlen($string) - 1)) {
        $string = substr($string, 0, $breakpoint) . $pad;
      }
    }

    return $string;
  }

  public static function replaceAccents($str)
  {
    $str = htmlentities($str, ENT_COMPAT, "UTF-8");
    $str = preg_replace('/&([a-zA-Z])(uml|acute|grave|circ|tilde);/', '$1', $str);
    return html_entity_decode($str);
  }

  public static function htmlEntities($str)
  {
    $str = htmlspecialchars(stripslashes($str));
    return $str;
  }
}
