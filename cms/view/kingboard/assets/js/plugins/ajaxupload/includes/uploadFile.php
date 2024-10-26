<?php
//sleep(3); //activar solo para tests

// Definimos variables generales
define("maxUpload", 50000);
define("maxWidth", 500);
define("maxHeight", 500);
define("uploadURL", '../images/');
define("fileName", 'foto_');

$fileType = array('image/jpeg','image/pjpeg','image/png');
$pasaImgSize = false;
$respuestaFile = false;
$fileName = '';
$mensajeFile = '';

// Obtenemos los datos del archivo
$tamanio = $_FILES['userfile']['size'];
$tipo = $_FILES['userfile']['type'];
$archivo = $_FILES['userfile']['name'];

// Tamaño de la imagen
$imageSize = getimagesize($_FILES['userfile']['tmp_name']);				
// Verificamos la extensión del archivo independiente del tipo mime
$extension = explode('.',$_FILES['userfile']['name']);
$num = count($extension)-1;

// Creamos el nombre del archivo dependiendo la opción
$imgFile = fileName.time().'.'.$extension[$num];

// Verificamos el tamaño válido para los logotipos
if($imageSize[0] <= maxWidth && $imageSize[1] <= maxHeight)	$pasaImgSize = true;

// Verificamos el status de las dimensiones de la imagen a publicar
if($pasaImgSize == true) {
	// Verificamos Tamaño y extensiones
	if(in_array($tipo, $fileType) && $tamanio>0 && $tamanio <= maxUpload && ($extension[$num]=='jpg' || $extension[$num]=='png')) {
		if(is_uploaded_file($_FILES['userfile']['tmp_name'])) {
			if(move_uploaded_file($_FILES['userfile']['tmp_name'], uploadURL.$imgFile))	{
				$respuestaFile = 'done';
				$fileName = $imgFile;
				$mensajeFile = $imgFile;
			} else $mensajeFile = 'No se pudo subir el archivo';
		}	else $mensajeFile = 'No se pudo subir el archivo';
	}	else $mensajeFile = 'Verifique el tamaño y tipo de imagen';
} else $mensajeFile = 'Verifique las dimensiones de la Imagen';

$salidaJson = array('respuesta' => $respuestaFile,
										'mensaje' => $mensajeFile,
										'fileName' => $fileName);

echo json_encode($salidaJson);
?>