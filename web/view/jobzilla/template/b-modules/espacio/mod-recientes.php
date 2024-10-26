<div class="recientes widget">
  <h3>Productos Recientes</h3>
  <div class="owl-carousel mbigger-posts list-products">
    <?php
    foreach ($data['recientes'] as $item) :
      $image = URL_GAL . 'productos/images/IM_' . $item['Imagen'];
      $url = URL_WEB . 'producto/' . $item['ID'] . '/' . $item['URL'];
      $checkDate = false;

      if (!empty($item['FechaIniD']) && !empty($item['FechaFinD'])) {
        $checkDate = Helper::checkDateInRange($item['FechaIniD'], $item['FechaFinD'], date('Y-m-d'));
      }

      if ($item['Descuento'] > 0 && $checkDate) {
        $precio_old = $item['Precio'];
        $precio_desc = $item['Precio'] - ($item['Precio'] * ($item['Descuento'] / 100));
      } else {
        $precio_old = '';
        $precio_desc = $item['Precio'];
      }
      ?>
      <div class="product text-center">
        <form name="form-product" method="post">
          <input type="hidden" name="productId" value="<?php echo $item['ID']; ?>">
          <input type="hidden" name="productName" value="<?php echo $item['Nombre']; ?>">
          <input type="hidden" name="productPrice" value="<?php echo $precio_desc; ?>">
          <input type="hidden" name="productImage" value="<?php echo $item['Imagen']; ?>">
          <input type="hidden" name="productURL" value="<?php echo $item['URL']; ?>">
        </form>
        <div class="product-top">
          <?php if (!empty($precio_old)) : ?>
            <span class="product-box discount-box discount-box-border">-<?php echo $item['Descuento']; ?>%</span>
          <?php else : ?>
            <span class="product-box new-box new-box-border">Nuevo</span>
          <?php endif; ?>
          <figure>
            <a href="<?php echo $url; ?>" title="<?php echo $item['Nombre']; ?>">
              <img src="<?php echo $image; ?>" alt="<?php echo $item['Nombre']; ?>" class="product-image">
              <img src="<?php echo $image; ?>" alt="<?php echo $item['Nombre']; ?>" class="product-image-hover">
            </a>
          </figure>
          <div class="product-action-container product-action-animate">
            <a href="#" class="btn btn-dark add-to-favorite" title="Agregar a Favoritos"><i class="fa fa-heart"></i></a>
            <a href="#" class="btn btn-dark add-to-wishlist" title="Agregar Lista de Deseos"><i class="fa fa-gift"></i></a>
            <a href="#" class="btn btn-dark quick-view" title="Vista Previa"><i class="fa fa-search-plus"></i></a>
          </div><!-- end .product-action-container -->
        </div><!-- End .product-top -->
        <h4 class="product-title">
          <a href="<?php echo $url; ?>" title="<?php echo $item['Nombre']; ?>"><?php echo $item['Nombre']; ?></a>
        </h4>
        <div class="product-price-container">
          <h6 class="brand-name"><?php echo $item['Marca']; ?></h6>
          <?php if (!empty($precio_old)) : ?>
            <span class="product-old-price">$ <?php echo Helper::moneyFormat($precio_old); ?></span>
          <?php endif; ?>
          <span class="product-price">$ <?php echo Helper::moneyFormat($precio_desc); ?></span>
        </div><!-- End .product-price-container -->
        <a href="javascript:;" class="btn btn-custom add-to-cart">Comprar</a>
      </div><!-- End .product -->
      <?php
    endforeach;
    ?>
  </div>
</div><!-- End .widget -->