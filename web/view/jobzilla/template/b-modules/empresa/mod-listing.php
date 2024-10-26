<!-- PRODUCT TAB SECTION START -->
<?php if (isset($data['productos']) && count($data['productos']) > 0) : ?>
  <div class="product-tab-section section-bg-tb pt-60 pb-55">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-title text-left mb-40">
            <h2 class="uppercase">Lista de Productos</h2>
          </div>
        </div>
      </div>
      <div class="product-tab">
        <div class="row">
          <?php
          foreach ($data['productos']['items'] as $item) :
            $image = URL_GAL . 'productos/images/IM_' . $item['Imagen'];
            $url = URL_WEB . 'producto/' . $item['ID'] . '/' . $item['URL'];
            ?>
            <!-- product-item start -->
            <div class="col-md-3 col-sm-4 col-xs-12">
              <div class="product-item product-item-2">
                <div class="product-img">
                  <a href="<?php echo $url; ?>">
                    <img src="<?php echo $image; ?>" alt="<?php echo $item['Nombre']; ?>"/>
                  </a>
                </div>
                <div class="product-info">
                  <h6 class="product-title">
                    <a href="<?php echo $url; ?>"><?php echo $item['Nombre']; ?></a>
                  </h6>
                  <h6 class="brand-name"><?php echo $item['Marca']; ?></h6>
                  <h3 class="pro-price">$ <?php echo $item['Precio']; ?></h3>
                </div>
              </div>
            </div>
            <!-- product-item end -->
            <?php
          endforeach;
          ?>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<!-- PRODUCT TAB SECTION END -->