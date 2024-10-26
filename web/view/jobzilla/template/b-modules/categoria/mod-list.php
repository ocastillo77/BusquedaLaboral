<!-- Blog Classic Blocks -->
<form id="paginator" method="get">
  <input type="hidden" id="page" name="page" value="1" />
</form>
<div class="container g-pt-70 g-pb-20">
  <div class="row justify-content-between">
    <div class="col-lg-9 g-mb-80">
      <div class="g-pr-20--lg">
        <div class="masonry-grid row g-mb-70">          
          <?php
          if (isset($data['posts'])):
            foreach ($data['posts']['items'] as $item) :
              $image = URL_GAL . 'posts/images/IM_' . $item['Imagen'];
              $url = URL_WEB . 'post/' . $item['ID'] . '/' . $item['URL'];
              $fecha = Helper::formatDateLarge($item['Fecha']);
              ?>
              <div class="masonry-grid-item col-sm-6 g-mb-30">
                <!-- Blog Classic Blocks -->
                <article class="u-shadow-v11">
                  <?php if (!empty($item['images'])) : ?>
                    <div class="js-carousel" data-infinite="true" data-autoplay="true" data-slides-show="1">
                      <?php
                      foreach ($item['images'] as $value) :
                        $urlth = !empty($value['Imagen']) ? URL_GAL . 'posts/thumbs/TH_' . $value['Imagen'] : '';
                        $urlim = !empty($value['Imagen']) ? URL_GAL . 'posts/images/IM_' . $value['Imagen'] : '';
                        ?>
                        <div class="js-slide u-block-hover">
                          <a href="<?php echo $urlim; ?>" data-fancybox="gallery">
                            <img class="mx-auto g-cursor-pointer" height="240" src="<?php echo $urlth; ?>" alt="<?php echo $value['Titulo']; ?>">
                          </a>
                        </div>
                        <?php
                      endforeach;
                      ?>
                    </div>
                  <?php else : ?>
                    <a class="link-image g-cursor-pointer" href="<?php echo $url; ?>">
                      <img class="img-fluid w-100" src="<?php echo $image; ?>" alt="<?php echo $item['Titulo']; ?>">
                    </a>
                  <?php endif; ?>
                  <div class="g-bg-white g-pa-30">
                    <span class="d-block g-color-gray-dark-v4 g-font-weight-600 g-font-size-12 text-uppercase mb-2"><?php echo $fecha; ?></span>
                    <h2 class="h5 g-color-black g-font-weight-600 mb-3">
                      <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer" href="<?php echo $url; ?>"><?php echo $item['Titulo']; ?></a>
                    </h2>
                    <div class="g-color-gray-dark-v4 g-line-height-1_8 text-justify">
                      <?php echo $item['Sumario']; ?>
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
              <?php echo $data['posts']['links']; ?>
            </ul>
          </nav>
          <?php
        endif;
        ?>
        <!-- End Pagination -->
      </div>
    </div>

    <div class="col-lg-3 g-brd-left--lg g-brd-gray-light-v4 g-mb-80">
      <div class="g-pl-20--lg">
        <!-- Links -->
        <div class="g-mb-50">
          <h3 class="h5 g-color-black g-font-weight-600 mb-4">Categorías</h3>
          <?php if (isset($data['categorias'])) : ?>
            <ul class="list-unstyled g-font-size-13 mb-0">
              <?php
              foreach ($data['categorias'] as $item) :
                $urlcat = URL_WEB . 'categoria/' . $item['ID'] . '/' . $item['URL'];
                ?>
                <li>
                  <a class="d-block u-link-v5 g-color-gray-dark-v4 rounded g-px-20 g-py-8" href="<?php echo $urlcat; ?>">
                    <i class="mr-2 fa fa-angle-right"></i> <?php echo $item['Nombre']; ?>
                  </a>
                </li>
                <?php
              endforeach;
              ?>
            </ul>
          <?php endif; ?>
        </div>
        <!-- End Links -->

        <div id="stickyblock-start">
          <div class="js-sticky-block g-sticky-block--lg" data-responsive="true" data-start-point="#stickyblock-start" data-end-point="#stickyblock-end">
            <!-- Publications -->
            <div class="g-mb-50">
              <h3 class="h6 g-color-black g-font-weight-600 text-uppercase mb-4">Recomendado</h3>
              <?php if (isset($data['destacados'])) : ?>
                <ul class="list-unstyled g-brd-y g-brd-gray-light-v3 g-font-size-13 py-4">
                  <?php
                  foreach ($data['destacados'] as $item) :
                    $image = URL_GAL . 'posts/images/IM_' . $item['Imagen'];
                    $url = URL_WEB . 'post/' . $item['ID'] . '/' . $item['URL'];
                    $fecha = Helper::formatDateLarge($item['Fecha']);
                    ?>
                    <li>
                      <article class="media mb-3">
                        <img class="d-flex align-self-center g-width-40 g-height-40 rounded-circle mr-3" 
                             src="<?php echo $image; ?>" alt="<?php echo $item['Titulo']; ?>">
                        <div class="media-body align-self-center">
                          <span class="g-color-gray-dark-v5 g-font-size-9 text-uppercase"><?php echo $fecha; ?></span>
                          <h4 class="g-color-black g-font-weight-600 g-font-size-12 mb-0">
                            <a class="u-link-v5 g-color-black g-color-primary--hover" href="<?php echo $url; ?>"><?php echo $item['Titulo']; ?></a>
                          </h4>
                        </div>
                      </article>
                    </li>
                    <?php
                  endforeach;
                  ?>
                </ul>
              <?php endif; ?>
            </div>
            <!-- End Publications -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Blog Classic Blocks -->