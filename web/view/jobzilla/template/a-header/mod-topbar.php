<?php

if (empty($config)) {
  die();
}

$telefono = $config['Movil'];
$whatsapp = $config['Whatsapp'];
?>
<div class="topbar-pc">
  <div class="navbar-top clearfix">
    <div class="container">
      <div class="pull-left d-none d-md-block">
        <ul class="navbar-top-nav clearfix">
          <li>
            <a href="tel:<?php echo $telefono; ?>">
              <i class="fas fa-phone-alt"></i> <?php echo $telefono; ?>
            </a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="https://wa.me/<?php echo $whatsapp; ?>">
              <i class="fab fa-whatsapp"></i> <?php echo $whatsapp; ?>
            </a>
          </li>
        </ul>
      </div><!-- End .pull-right -->
      <div class="menu-user">
        <?php
        if (Session::get('wb_active') == 1) :
          ?>
          <ul class="navbar-top-nav clearfix">
            <li>
              <a href="<?php echo URL_WEB . 'account'; ?>">
                <i class="fa fa-user"></i> Mi Cuenta
              </a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="<?php echo URL_WEB . 'logout'; ?>">
                <i class="fa fa-power-off"></i> Cerrar Sesión
              </a>
            </li>
          </ul>
          <?php
        else :
          ?>
          <ul class="navbar-top-nav clearfix">
            <li><a href="<?php echo URL_WEB . 'register'; ?>">Registrarse</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo URL_WEB . 'login'; ?>">Iniciar Sesión</a></li>
          </ul>
        <?php
        endif;
        ?>
      </div><!-- End .pull-right -->
    </div><!-- End .container-fluid -->
  </div><!-- End .navbar-top -->
</div>
