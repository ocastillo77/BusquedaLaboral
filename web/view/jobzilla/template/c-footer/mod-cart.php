<?php
$count = 0;
if (isset($data['listProducts']) && is_array($data['listProducts']) && count($data['listProducts']) > 0) :
  $count = count($data['listProducts']);
endif;
?>
<!-- Bottom Nav Bar -->
<footer class="footer footer-mobile">
  <div id="buttonGroup" class="btn-group selectors" role="group" aria-label="Basic example">
    <div class="btn-box">
      <a href="<?php echo URL_WEB; ?>" class="btn btn-secondary button-active">
        <div class="selector-holder m-top-4">
          <i class="material-icons">home</i>
          <span>Home</span>
        </div>
      </a>
    </div>
    <div class="btn-box dropup">
      <a href="javascript:;" class="btn btn-secondary button-inactive dropdown-toggle" data-toggle="dropdown">
        <div class="selector-holder m-top-4">
          <i class="material-icons-outlined text-size-22">account_circle</i>
          <span>Mi Cuenta</span>
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-center">
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
    </div>
    <div class="btn-box">
      <a href="<?php echo URL_WEB . 'account/favorites'; ?>" class="btn btn-secondary button-inactive">
        <div class="selector-holder m-top-4">
          <i class="material-icons-outlined text-size-22">favorite_border</i>
          <span>Favoritos</span>
        </div>
      </a>
    </div>
    <div class="btn-box">
      <a href="<?php echo URL_WEB . 'shoppingcart'; ?>" class="btn-cart btn btn-secondary button-inactive">
        <div class="selector-holder cart-footer">
          <span id="count-cart-bottom" class="badge"><?php echo $count; ?></span>
          <i class="material-icons-outlined text-size-22">shopping_basket</i>
          <span>Mi Carrito</span>
        </div>
      </a>
    </div>
  </div>
</footer>
<!-- Bootstrap core JavaScript -->