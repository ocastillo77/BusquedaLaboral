<?php
$config = $data['config'];

if (empty($config)) {
  die();
}
$nombre_sitio = $config['Nombre'];

if (isset($data['meta']) && is_array($data['meta']) && count($data['meta']) > 0) {
  $info = $data['meta'];
  $titulo = $info['Titulo'] . ' - ' . $nombre_sitio;
  $descripcion = $info['Descripcion'] . ' - ' . $nombre_sitio;
} else {
  $titulo = $config['Titulo'];
  $descripcion = $config['Descripcion'] . ' - ' . $nombre_sitio;
}

if (isset($data['post']['Titulo'])) {
  $titulo = $descripcion = $data['post']['Titulo'] . ' - ' . $nombre_sitio;
}

$urlImage = !empty($data['post']['Imagen']) ? URL_GAL . 'posts/images/IM_'
  . $data['post']['Imagen'] : URL_IMG . 'no-image.jpg';

$protocol = isset($_SERVER['HTTPS']) ? 'https' : 'http';
$urlShare = $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<title><?php echo $titulo; ?></title>
<meta name="description" content="<?php echo $descripcion; ?>, Mendoza Argentina">
<meta name="author" content="<?php echo $nombre_sitio; ?>">
<!-- BEGIN COMPARTIR EN FACEBOOK -->  
<meta property="og:type" content="article">
<meta property="og:title" content="<?php echo $titulo; ?>">
<meta property="og:description" content="<?php echo $descripcion; ?>">
<meta property="og:url" content="<?php echo $urlShare; ?>" />
<?php if (!empty($urlImage)) : ?>
  <meta property="og:image" content="<?php echo $urlImage; ?>">
<?php endif; ?>
<!-- END COMPARTIR EN FACEBOOK -->