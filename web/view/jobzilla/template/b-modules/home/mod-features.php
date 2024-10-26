<?php if (isset($data['recientes']) && count($data['recientes']) > 0) : ?>
  <div class="container">
    <h2 class="title-underblock dark mb50 text-center">Productos Recientes</h2>
    <div class="owl-carousel shop-latest-carousel-sm center-nav center-nav-animate gray-nav no-radius">
      <?php
      foreach ($data['recientes'] as $item) :
        $image = URL_GAL . 'productos/images/IM_' . $item['Imagen'];
        $url = URL_WEB . 'producto/' . $item['ID'] . '/' . $item['URL'];
        ?>
        <div class="product text-center">
          <div class="product-top">
            <span class="product-box new-box new-box-border">Nuevo</span>
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
            <span class="product-price">$ <?php echo $item['Precio']; ?></span>
          </div><!-- End .product-price-container -->

          <a href="#" class="btn btn-custom add-to-cart">Comprar</a>
        </div><!-- End .product -->
        <?php
      endforeach;
      ?>
    </div><!-- End .owl-carousel -->
  </div><!-- End .container -->
<?php endif; ?>
