<?php
$config = $data['config'];
$sitename = $config['Nombre'];
$email = $config['Email'];
$url_logo = !empty($config['Imagen']) ? URL_GAL . 'config/images/IM_' . $config['Imagen'] : URL_IMG . 'logo.png';
$url_web = $config['Website'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancelación de Subscripción</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            background-color: #FFC600;
            padding: 30px;
            margin: 0 auto;
        }

        .content {
            padding: 20px;
        }

        .content h1 {
            margin-top: 20px;
            margin-bottom: 30px;
            font-size: 22px;
            letter-spacing: 1px;
            text-align: center;
        }

        .content h2 {
            color: #333333;
            font-size: 20px;
            margin-top: 0;
        }

        .content p {
            color: #555555;
            font-size: 16px;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f7f7f7;
            font-size: 14px;
            color: #888888;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="<?php echo $url_logo; ?>" alt="<?php echo $sitename; ?>" data-default="placeholder" border="0">
        </div>
        <div class="content">
            <h1>Tu subscripción ha sido cancelada</h1>
            <p>¡Hola [NAME],</p>
            <p>La subscripción a tu plan en <strong><?php echo $sitename; ?></strong> ha sido cancelado. Recuerda que podes acceder a nuestra plataforma hasta el <?php echo date('t/m/Y'); ?>.</p>
            <p>Saludos,</p>
            <p><strong>Equipo <?php echo $sitename; ?></strong></p>
        </div>
        <div class="footer">
            <p>&copy; 2024 <?php echo $sitename; ?>. Todos los derechos reservados.</p>
        </div>
    </div>

</body>

</html>