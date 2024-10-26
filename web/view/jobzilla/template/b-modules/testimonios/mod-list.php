<!-- Blog Classic Blocks -->
<form id="paginator" method="get">
  <input type="hidden" id="page" name="page" value="1" />
</form>
<div class="container g-pt-70 g-pb-20">
  <div class="row justify-content-center">
    <div class="col-lg-10 g-mb-80">
      <div class="masonry-grid g-mb-70">          
        <?php
        if (isset($data['testimonios'])):
          foreach ($data['testimonios']['items'] as $item) :
            $url_image = URL_GAL . 'testimonios/images/IM_' . $item['Imagen'];
            $url = URL_WEB . 'testimonio/' . $item['ID'];
            ?>
            <div class="masonry-grid-item g-mb-30">
              <!-- Blog Classic Blocks -->
              <article class="u-shadow-v11 row">
                <div class="g-bg-white g-pa-30 col-md-12">
                  <div class="row mb-3">
                    <div class="col-md-8 col-xs-6">
                      <h2 class="h5 g-color-black g-font-weight-600">
                        <a class="u-link-v5 g-color-black g-color-primary--hover 
                           g-cursor-pointer" href="<?php echo $url; ?>"><?php echo $item['Nombre']; ?></a>
                      </h2>
                    </div>
                    <div class="col-md-4 col-xs-6 text-md-right text-xs-center">
                      <span class="g-color-gray-dark-v4 g-font-weight-600 g-font-size-12 
                            text-uppercase"><?php echo $item['Cargo']; ?></span>                      
                    </div>
                  </div>
                  <div class="g-color-gray-dark-v4 g-line-height-1_8 text-justify">
                    <?php if (!empty($url_image)) : ?>
                      <a href="<?php echo $url; ?>">
                        <img class="image-test-list" src="<?php echo $url_image; ?>" alt="<?php echo $item['Nombre']; ?>">
                      </a>
                    <?php endif; ?>
                    <div class="box-comentario">
                      <?php echo $item['Comentario']; ?>
                    </div>
                    <div class="box-button-plus">
                      <a href="<?php echo $url; ?>" class="g-ml-15 btn btn-info">Ver Completo</a>
                    </div>
                  </div>
                </div>
              </article>
              <!-- End Blog Classic Blocks -->
            </div>
            <?php
          endforeach;
          ?>
        </div>
        <!-- Pagination -->
        <nav id="stickyblock-end" class="text-center">
          <ul class="list-inline">
            <?php echo $data['testimonios']['links']; ?>
          </ul>
        </nav>
        <?php
      endif;
      ?>
      <!-- End Pagination -->
    </div>
  </div>
</div>
<!-- End Blog Classic Blocks -->