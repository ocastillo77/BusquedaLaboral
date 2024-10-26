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
    <title>Recuperación de Contraseña - <?php echo $sitename; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            background-color: #ffffff;
            padding: 20px;
            margin: 50px auto;
            width: 100%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }

        .logo {
            text-align: center;
            background-color: #FFC600;
            padding: 30px;
            margin: 30px auto;
        }

        .temporary-password {
            font-size: 18px;
            color: #055160;
            font-weight: bold;
            text-align: center;
            margin: 20px auto;
            border: 1px solid #b6effb;
            background-color: #cff4fc;
            border-radius: 5px;            
            padding: 10px 20px;
            width: 200px;
        }

        .btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #490E67;
            border-color: #490E67;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            text-transform: uppercase;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .footer {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            text-align: center;
            font-size: 11px;
            color: #777;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="logo">
            <img src="<?php echo $url_logo; ?>" alt="<?php echo $sitename; ?>" data-default="placeholder" border="0">
        </div>
        <h1>Recuperación de Contraseña</h1>
        <p>Hola [NAME],</p>
        <p>Te enviamos una <b>contraseña temporal</b> para que puedas acceder a tu cuenta. 
        Por favor, usa esta contraseña para iniciar sesión y después cámbiala desde tu perfil para mayor seguridad.</p>
        <div class="temporary-password">[PASSWORD]</div>
        <p>Para acceder a tu cuenta, haz clic en el siguiente botón:</p>
        <a href="[LINK_LOGIN]" class="btn" style="color: #fff;">Iniciar Sesión</a>
        <p>Una vez que hayas iniciado sesión, te recomendamos que cambies esta contraseña por una de tu preferencia desde tu perfil de usuario.</p>
        <p>Si tienes algún problema, por favor contáctanos a: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
        <div class="footer">
            <p>© 2024 <?php echo $sitename; ?>. Todos los derechos reservados.</p>
        </div>
    </div>
</body>

</html>