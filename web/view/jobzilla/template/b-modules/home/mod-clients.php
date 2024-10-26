<!-- Clients -->
<?php if (isset($data['clientes']) && count($data['clientes']) > 0) : ?>
  <section class="g-bg-white g-pt-70 g-pb-70">
    <div class="container">
      <!-- Heading -->
      <div class="row justify-content-center text-center g-mb-50">
        <div class="col-lg-9">
          <h2 class="h3 g-color-black g-font-weight-600 text-uppercase mb-2">Colaboradores</h2>
          <div class="d-inline-block g-width-35 g-height-2 g-bg-primary mb-2"></div>
        </div>
      </div>
      <!-- End Heading -->

      <div class="row">
        <div class="col-md-12">
          <div class="js-carousel" data-infinite="true" data-autoplay="true" data-slides-show="4" data-responsive='[{
               "breakpoint": 1200,
               "settings": {
               "slidesToShow": 4
               }
               }, {
               "breakpoint": 992,
               "settings": {
               "slidesToShow": 4
               }
               }, {
               "breakpoint": 768,
               "settings": {
               "slidesToShow": 4
               }
               }, {
               "breakpoint": 576,
               "settings": {
               "slidesToShow": 2
               }
               }, {
               "breakpoint": 446,
               "settings": {
               "slidesToShow": 1
               }
               }]'>
                 <?php
                 foreach ($data['clientes'] as $item) :
                   $urlImage = !empty($item['Imagen']) ? URL_GAL . 'clientes/images/IM_' . $item['Imagen'] : '';
                   $urlClient = !empty($item['URL']) ? $item['URL'] : 'javascript:;';
                   $target = !empty($item['URL']) ? 'target="_blank"' : '';
                   ?>
              <div class="js-slide u-block-hover">
                <a href="<?php echo $urlClient; ?>" <?php echo $target; ?>>
                  <img class="mx-auto g-width-150 u-block-hover__main--grayscale g-opacity-0_5 g-opacity-1--hover 
                       g-cursor-pointer" src="<?php echo $urlImage; ?>" alt="<?php echo $item['Nombre']; ?>">
                </a>
              </div>
              <?php
            endforeach;
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
<!-- End Clients -->