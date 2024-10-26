<div class="shopping-cart dropdown cart-dropdown pull-right">
  <?php include 'mod-basket.php'; ?>
</div><!-- End .cart-dropdown -->
<a href="<?php echo URL_WEB . 'account/favorites'; ?>" class="navbar-btn btn-icon pull-right">
  <i class="material-icons-outlined text-size-22">favorite_border</i>
</a>
<div class="social-icons pull-right">
  <div class="dropdown cart-dropdown pull-right">
    <div class="dropdown">
      <a class="dropdown-toggle" href="javascript:;" data-toggle="dropdown">
        <i class="material-icons-outlined text-size-22">account_circle</i>
      </a>
      <ul class="atencion dropdown-menu dropdown-menu-center">
        <?php
        if (Session::get('wb_active') == 1) :
          ?>
          <li>
            <a href="<?php echo URL_WEB . 'account/profile'; ?>">Mi Perfil</a>
          </li>
          <li>
            <a href="<?php echo URL_WEB . 'shoppingcart'; ?>">Carrito de Compras</a>
          </li>
          <li>
            <a href="<?php echo URL_WEB . 'account/orders'; ?>">Historial de Pedidos</a>
          </li>
          <li>
            <a href="<?php echo URL_WEB . 'logout'; ?>">Cerrar Sesión</a>
          </li>
          <?php
        else :
          ?>
          <li>
            <a href="<?php echo URL_WEB . 'login'; ?>">Iniciar Sesión</a>
          </li>
          <li>
            <a href="<?php echo URL_WEB . 'register'; ?>">Registrarse</a>
          </li>
        <?php
        endif;
        ?>
      </ul>
    </div><!-- End .currency-dropdown -->
  </div>
</div>
<button type="button" class="navbar-btn btn-icon pull-right" data-toggle="collapse" 
        data-target="#header-search-form">
  <i class="material-icons-outlined text-size-22">search</i>
</button>

