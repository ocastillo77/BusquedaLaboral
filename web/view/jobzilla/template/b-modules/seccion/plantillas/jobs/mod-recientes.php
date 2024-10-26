<?php if (isset($data['recientes'])) : ?>
  <div class="widget">    
    <h3>Productos Recientes</h3>   
    <div class="single-slider slick-single">
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
            <span class="product-price">$ <?php echo $item['Precio']; ?></span>
          </div><!-- End .product-price-container -->
          <a href="#" class="btn btn-custom add-to-cart">Comprar</a>
        </div><!-- End .product -->
        <?php
      endforeach;
      ?>
    </div>
  </div><!-- End .widget -->
<?php endif; ?>