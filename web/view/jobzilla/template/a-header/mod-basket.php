<?php
if (isset($data['listProducts']) && is_array($data['listProducts']) && count($data['listProducts']) > 0) :
  $count = count($data['listProducts']);
  ?>
  <button type="button" class="navbar-btn btn-icon dropdown-toggle"
          data-toggle="dropdown">
    <i class="material-icons-outlined text-size-22">shopping_basket</i>
    <span id="count-cart" class="badge"><?php echo $count; ?></span>
  </button>
  <div class="dropdown-menu cart-dropdown-menu">
    <p class="cart-dropdown-desc text-center">
      Usted tiene <?php echo $count; ?> producto(s) en el carrito:
    </p>
    <hr>
    <div class="content-cart">
      <div id="cart-content">
        <?php
        $total = 0;
        foreach ($data['listProducts'] as $item) :
          $thumb = URL_GAL . 'productos/thumbs/TH_' . $item['image'];
          $url = URL_WEB . 'producto/' . $item['id'] . '/' . $item['url'];
          $subtotal = $item['price'] * $item['quantity'];
          $total += $subtotal;
          ?>
          <div class="product clearfix">
            <a href="javascript:removeCart(<?php echo $item['id']; ?>);" class="btn-custom-delete btn btn-danger btn-xs" title="Eliminar">Borrar</a>
            <figure>
              <a href="<?php echo $url; ?>" title="<?php echo $item['name']; ?>">
                <img class="img-responsive" src="<?php echo $thumb; ?>" alt="<?php echo $item['name']; ?>">
              </a>
            </figure>
            <div class="product-meta">
              <h4 class="product-name">
                <a href="<?php echo $url; ?>"><?php echo $item['name']; ?></a>
              </h4>
              <div class="product-quantity">x <?php echo $item['quantity']; ?> unidad(es)</div>
              <div class="product-price-container">
                = <span class="product-price">$ <?php echo Helper::moneyFormat($subtotal); ?></span>
              </div><!-- End .product-price-container -->
            </div><!-- End .product-meta -->
          </div><!-- End .product -->
          <?php
        endforeach;
        ?>
      </div>
      <hr>
      <div class="cart-action">
        <div class="pull-left cart-action-total">
          <span>Total:</span> $ <?php echo Helper::moneyFormat($total); ?>
        </div><!-- End .pull-left -->
        <div class="pull-right">
          <a href="<?php echo URL_WEB . 'shoppingcart'; ?>" class="btn btn-custom ">Ver Carrito</a>
        </div>
      </div><!-- End .cart-action -->
    </div>
  </div><!-- End .dropdown-menu -->
  <?php
else :
  ?>
  <button type="button" class="navbar-btn btn-icon dropdown-toggle"
          data-toggle="dropdown">
    <i class="material-icons-outlined text-size-22">shopping_basket</i>
    <span class="badge">0</span>
  </button>
  <div class="dropdown-menu cart-dropdown-menu">
    <p class="cart-dropdown-desc text-center">No tiene productos en el carrito!</p>
  </div>
<?php
endif;
