<?php
$config = $data['config'];
$sitename = $config['Nombre'];
$direccion = $config['Direccion'];
$localidad = $config['Localidad'];
$cpostal = $config['CPostal'];
$telefono = $config['Telefono'];
$url_logo = !empty($config['Imagen']) ? URL_GAL . 'config/images/IM_' . $config['Imagen'] : URL_IMG . 'logo.png';
$url_web = $config['Website'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Documento de Subscripción - <?php echo $sitename; ?></title>
  <style>
    .email-container {
      font-family: Helvetica, Arial, sans-serif;
      background-color: #f4f4f4;
      padding: 20px;
      max-width: 600px;
      margin: 0 auto;
      box-sizing: border-box;
    }

    .email-header {
      text-align: center;
      border-bottom: 1px solid #dddddd;
      padding-bottom: 20px;
    }

    .logo {
      text-align: center;
      background-color: #FFC600;
      padding: 30px;
    }

    .email-content h2 {
      color: #333333;
      font-size: 24px;
      margin-top: 20px;
      margin-bottom: 40px;
      text-align: center;
    }

    .email-content {
      padding: 20px;
      background-color: #ffffff;
      margin-top: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .email-content p {
      color: #555555;
      font-size: 16px;
      line-height: 1.5;
    }

    .email-content strong {
      color: #333333;
    }

    .email-footer {
      margin-top: 30px;
      text-align: left;
    }

    .email-footer p {
      color: #333333;
      font-size: 14px;
    }

    .email-footer a {
      color: #333333;
      text-decoration: none;
    }

    .disclaimer {
      font-size: 12px;
      color: #999999;
      margin-top: 20px;
      border-top: 1px solid #dddddd;
      padding-top: 10px;
    }
  </style>
</head>

<body>
  <div class="email-container">
    <div class="email-header">
      <div class="logo">
        <img src="<?php echo $url_logo; ?>" alt="<?php echo $sitename; ?>" data-default="placeholder" border="0">
      </div>
    </div>
    <div class="email-content">
      <h2>¡Gracias por su Subscripción!</h2>
      <p>Estimado/a [NAME],</p>
      <p>
        Le adjuntamos el documento PDF del Pago de su Subscripción en la Plataforma <strong><?php echo $sitename ?></strong>.<br>
        Este comprobante no es válido como factura. Una vez verificado el pago, se le enviará a este correo electrónico la factura de su compra.
      </p>
      <p>Saludos cordiales,</p>
      <p><strong>Equipo <?php echo $sitename ?></strong></p>
    </div>
    <div class="email-footer">
      <p>
        <?php echo $direccion; ?>,<br />
        <?php echo $localidad . ', CP. ' . $cpostal; ?><br />
        Telef: <?php echo $telefono; ?><br />
        <a href="<?php echo URL_WEB; ?>" target="_blank"><?php echo $url_web; ?></a>
      </p>
      <p class="disclaimer">
        Este mensaje fue originado desde una dirección de correo electrónico que no permite recibir mensajes. Por favor no responder.
      </p>
    </div>
  </div>
</body>

</html>