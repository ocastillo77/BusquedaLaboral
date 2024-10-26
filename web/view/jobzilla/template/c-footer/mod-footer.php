<?php
$config = $data['config'];
$nombre_sitio = $config['Nombre'];
$direccion = $config['Direccion'];
$localidad = $config['Localidad'];
$provincia = $config['Provincia'];
$telefono = $config['Telefono'];
$celular = $config['Movil'];
$email = $config['Email'];
?>
<div id="footer-inner">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-6">
        <div class="widget">
          <div class="corporate-widget">
            <span class="footer-logo">
              <img src="<?php echo URL_IMG; ?>logo.png" alt="BFour" />
            </span><!-- End .footer-logo -->
            <address>                
              <strong>Dirección:</strong> <?php echo $direccion; ?><br>
              <?php echo $localidad . ' - ' . ucfirst(strtolower($provincia)); ?><br>
              <strong>Teléfono:</strong> <?php echo $telefono; ?><br>
              <strong>Celular:</strong> <?php echo $celular; ?><br>
              <strong>Email:</strong> <?php echo $email; ?><br>
            </address>
            <?php if (isset($data['redes'])) : ?>
              <div class="social-icons">
                <?php foreach ($data['redes'] as $item) : ?>
                  <a href="<?php echo $item['URL']; ?>" class="social-icon icon-<?php echo $item['Icono']; ?>" title="<?php echo $item['Titulo']; ?>">
                    <i class="fa fa-<?php echo $item['Icono']; ?>"></i>
                  </a>
                <?php endforeach; ?>
              </div><!-- End .social-icons -->
            <?php endif; ?>
          </div><!-- End corporate-widget -->
        </div><!-- End .widget -->
      </div><!-- End .col-md-3 -->
      <div class="col-md-3 col-sm-6">
        <div class="widget">
          <h4>Categorías</h4>
          <ul class="links">

            <li><a href="#"><i class="fa fa-angle-right"></i>Templates</a></li>

          </ul>
        </div><!-- End .widget -->
      </div><!-- End .col-md-3 -->

      <div class="clearfix visible-sm"></div><!-- End .clearfix -->

      <div class="col-md-3 col-sm-6">
        <div class="widget">
          <h4>Categorías</h4>
          <ul class="links">

            <li><a href="#"><i class="fa fa-angle-right"></i>Templates</a></li>

          </ul>
        </div><!-- End .widget -->
      </div><!-- End .col-md-3 -->

      <div class="col-md-3 col-sm-6">
        <div class="widget">
          <h4>Boletín de Noticias</h4>
          <div class="newsletter-widget">
            <p>Ingrese su correo electrónico:</p>
            <form action="#" id="newsletter-widget-form">
              <input type="email" class="form-control" placeholder="Correo Electrónico" required>
              <button type="submit" title="Join Now!" class="btn btn-custom"><i class="fa fa-envelope"></i></button>
            </form>
          </div><!-- End .newsletter-widget -->
        </div><!-- End .widget -->
      </div><!-- End .col-md-3 -->
    </div><!-- End .row -->
  </div><!-- End .container -->
</div><!-- End #footer-inner -->