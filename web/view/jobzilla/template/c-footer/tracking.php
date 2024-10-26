<?php

$url_data = (!empty($data['tabla'])) ? '/' . $data['tabla'] : '';
$url_data .= (isset($data['tabla']) && !empty($data[$data['tabla']]['ID'])) ? 
        '/' . $data[$data['tabla']]['ID'] : '';

echo '<script src="' . URL_WEB . 'tracking' . $url_data . '" type="text/javascript"></script>';

if (isset($data['config'])) {
  echo html_entity_decode($data['config']['Analytics']);
}
