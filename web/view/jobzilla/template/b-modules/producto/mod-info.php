<div class="row info-product">
  <div class="col-md-5">
    <?php
    if (isset($data['galeria'])) :
      $new = [
        'Titulo' => 'Imagen Principal',
        'Imagen' => $producto['Imagen']
      ];
      array_unshift($data['galeria'], $new);
      $image1 = URL_GAL . 'productos/images/IM_' . $data['galeria'][0]['Imagen'];
      $thumb1 = URL_GAL . 'productos/thumbs/TH_' . $data['galeria'][0]['Imagen'];
      $title1 = $data['galeria'][0]['Titulo'];
      $stock = !empty($img['Stock']) && $img['Stock'] > 0 ? $img['Stock'] : 1;
      $checkDate = false;

      if (!empty($producto['FechaIniD']) && !empty($producto['FechaFinD'])) {
        $checkDate = Helper::checkDateInRange($producto['FechaIniD'], $producto['FechaFinD'], date('Y-m-d'));
      }

      if ($producto['Descuento'] > 0 && $checkDate) {
        $precio_old = $producto['Precio'];
        $precio_desc = $producto['Precio'] - ($producto['Precio'] * ($producto['Descuento'] / 100));
      } else {
        $precio_old = '';
        $precio_desc = $producto['Precio'];
      }
      ?>
      <div class="product-gallery-container imgs-zoom-area">
        <?php if (!empty($precio_old)) : ?>
          <span class="product-box discount-box discount-box-border">-<?php echo $producto['Descuento']; ?>%</span>
        <?php endif; ?>
        <div class="product-top">
          <img id="product-zoom" src="<?php echo $image1; ?>" data-zoom-image="<?php echo $image1; ?>" alt="<?php echo $title1; ?>">
        </div><!-- End .product-top -->
        <div class="product-gallery-wrapper">
          <div class="owl-carousel product-gallery product-gallery-sm">
            <?php
            foreach ($data['galeria'] as $img) :
              $image = URL_GAL . 'productos/images/IM_' . $img['Imagen'];
              $thumb = URL_GAL . 'productos/thumbs/TH_' . $img['Imagen'];
              ?>
              <a href="#" data-image="<?php echo $image; ?>" data-zoom-image="<?php echo $image; ?>" class="product-gallery-item">
                <img class="zoom_03" src="<?php echo $thumb; ?>" alt="<?php echo $img['Titulo']; ?>">
              </a>
              <?php
            endforeach;
            ?>
          </div><!-- End .product-gallery -->
        </div><!-- End #product-gallery-wrapper -->
      </div><!-- End .product-gallery-container -->
      <?php
    endif;
    ?>
  </div><!-- End .col-md-5 -->

  <div class="col-md-7">
    <div class="product-details">
      <h2 class="product-title"><?php echo $producto['Nombre']; ?></h2>
      <h6><stron>Marca: </stron><?php echo $producto['Marca']; ?></h6>
      <div class="product-price-container product-info-custom">
        <p>
          <strong>PRECIO: </strong>
          <?php if (!empty($precio_old)) : ?>
            <span class="product-old-price">$ <?php echo Helper::moneyFormat($precio_old); ?></span>
          <?php endif; ?>
          <span class="product-price">$ <?php echo Helper::moneyFormat($precio_desc); ?></span>
        </p>
      </div><!-- End .product-price-container -->
      <h3 class="title-descripcion">Información</h3>
      <div id="description" class="product-description">
        <?php echo $producto['Descripcion']; ?>
      </div><!-- End .product-ratings-container -->
      <div class="product-quantity-wrapper">
        <form name="form-product" method="post">
          <input type="hidden" name="productId" value="<?php echo $producto['ID']; ?>">
          <input type="hidden" name="productName" value="<?php echo $producto['Nombre']; ?>">
          <input type="hidden" name="productPrice" value="<?php echo $precio_desc; ?>">
          <input type="hidden" name="productImage" value="<?php echo $producto['Imagen']; ?>">
          <input type="hidden" name="productURL" value="<?php echo $producto['URL']; ?>">
          <div class="product-quantity">
            <label class="input-desc">Cantidad:</label>
            <input type="number" name="productQty" value="1" min="1" max="1000" class="horizontal-spinner">
          </div><!-- End .product-quantity -->
        </form>
      </div><!-- End .product-quantity-wrapper -->
      <div class="product-action">
        <a href="javascript:;" class="btn btn-custom min-width no-radius add-to-cart">Agregar al Carrito</a>
        <a href="javascript:;" class="btn btn-dark min-width no-radius" title="Agregar a Favoritos">
          <i class="fa fa-heart"></i>Agregar a Favoritos</a>
      </div><!-- End .product-action -->
      <div class="share-container">
        <label class="input-desc">Compartir:</label>
        <div class="social-icons social-icons-bg social-icons-bg-hover social-icons-circle">
          <?php
          foreach ($data['redes'] as $item) :
            ?>
            <a href="<?php echo $item['URL']; ?>" class="social-icon icon-<?php echo $item['Icono']; ?>"
               title="<?php echo $item['Titulo']; ?>" target="_blank">
              <i class="fa fa-<?php echo $item['Icono']; ?>"></i>
            </a>
            <?php
          endforeach;
          ?>
        </div><!-- End .social-icons -->
      </div><!-- End .share-container -->

    </div><!-- End .product-details -->
  </div><!-- End .col-md-7 -->
</div><!-- End .row -->
<div class="mb50"></div><!-- space -->


