<!DOCTYPE html>
<html>
  <head>
    <title>Correo Electrónico</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      body {
        font-family: Arial, sans-serif;
        font-size: 14px;
        background: #fff;
        color: #6F7A7B;
      }
      a {
        text-decoration: none;
        color: #0066ff;
      }
      ul {
        list-style: square;
        margin-left: 30px;
      }
      li {
        margin-bottom: 5px;
        line-height: 1.3;
      }
      h2 {
        font-size: 18px;
        text-align: center;
      }
      p {
        margin-bottom: 10px;
        line-height: 1.3;
      }
      .main {
        max-width: 640px;
        margin: 10px auto;
      }
      .widget {
        background: #f1f1f1;
        border: 1px solid #ddd;
      }
      .widget-header,
      .widget-content,
      .widget-footer {
        padding: 15px 20px;
      }
      .widget-header,
      .widget-content {        
        border-bottom: 1px solid #ddd;
      }
      .widget-content {   
        background: #fff;
      }
      .small {
        font-size: 12px;
        margin-bottom: 0;
      }
      .background-dark {
        margin-bottom: 20px;
      }
    </style>
  </head>
  <body>
    <div class="main">
      <div class="widget">
        <div class="widget-header">
          <h2>Formulario de Contacto - Empresa ABC</h2>
        </div>      
        <div class="widget-content">
          <p>Hola Oscar Castillo,</p>
          <p>Se registró la siguiente consulta:</p>
          <div class="background-dark">
            <ul>
              <li><strong>Nombre y Apellidos:</strong> Pepe Perez</li>
              <li><strong>Correo Electrónico:</strong> ocastillo77@hotmail.com</li>
              <li><strong>Teléfono:</strong> 54 2615897325</li>
              <li>
                <strong>Consulta:</strong> 
                <p>Esta es la consulta que llegó a la página web.</p>
              </li>
            </ul>
          </div>
          <p>Saludos cordiales,</p>
          <p><strong>Equipo Empresa ABC</strong></p>
        </div>
        <div class="widget-footer">
          <p class="small">Para dejar de recibir notificaciones en su correo electrónico, haga clic <a href="">aquí</a></p>
        </div>
      </div>
    </div>
  </body>
</html>
