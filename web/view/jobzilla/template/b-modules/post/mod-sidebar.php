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