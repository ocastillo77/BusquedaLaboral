<?php if (isset($data['destacados']) && count($data['destacados']) > 0) : ?>
  <div class="container home-relevant list-products">
    <h2 class="title-underblock dark mb50 text-center">Productos Destacados</h2>
    <div class="owl-carousel shop-latest-carousel-sm center-nav center-nav-animate gray-nav no-radius">
      <?php
      foreach ($data['destacados'] as $item) :
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
            <?php endif; ?>
            <figure>
              <a href="<?php echo $url; ?>" title="<?php echo $item['Nombre']; ?>">
                <img src="<?php echo $image; ?>" alt="<?php echo $item['Nombre']; ?>" class="product-image">
                <img src="<?php echo $image; ?>" alt="<?php echo $item['Nombre']; ?>" class="product-image-hover">
              </a>
            </figure>
            <div class="product-action-container each-btn-animate">
              <a href="#" class="btn btn-dark add-to-favorite" title="Add to favorite"><i class="fa fa-heart"></i></a>

              <a href="#" class="btn btn-dark add-to-wishlist" title="Add to wishlist"><i class="fa fa-gift"></i></a>

              <a href="#" class="btn btn-dark quick-view" title="Quick View"><i class="fa fa-search-plus"></i></a>
            </div><!-- end .product-action-container -->
          </div><!-- End .product-top -->
          <h3 class="product-title">
            <a href="<?php echo $url; ?>" title="<?php echo $item['Nombre']; ?>"><?php echo $item['Nombre']; ?></a>
          </h3>
          <div class="product-price-container">
            <span class="product-price"><?php echo $item['Marca']; ?></span>
          </div><!-- End .product-price-container -->
          <div class="product-price-container">
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
    </div><!-- End .owl-carousel -->
  </div><!-- End .container -->
<?php endif; ?>
