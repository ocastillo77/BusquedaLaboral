<!-- Icon Blocks -->
<?php if (isset($data['estadisticas']) && count($data['estadisticas']) > 0) : ?>
  <section class="text-center">
    <div class="row no-gutters">
      <?php
      foreach ($data['estadisticas'] as $item) :
        $urlImage = !empty($item['Imagen']) ? URL_GAL . 'estadisticas/images/IM_' . $item['Imagen'] : '';
        $urlLogo = !empty($item['Logo']) ? URL_GAL . 'estadisticas/images/IM_' . $item['Logo'] : '';
        ?>
        <!-- Icon Blocks -->
        <div class="col-lg-4 u-bg-overlay g-bg-img-hero <?php echo $item['Color']; ?> g-color-white text-center g-pa-60"
             style="background-image: url(<?php echo $urlImage; ?>);">
          <a href="<?php echo $item['URL']; ?>" target="_blank" class="g-color-white">
            <div class="u-bg-overlay__inner box-overlay">
              <img src="<?php echo $urlLogo; ?>" alt="<?php echo $item['Titulo']; ?>" width="250"/>
            </div>
          </a>
        </div>
        <!-- End Icon Blocks -->
        <?php
      endforeach;
      ?>
    </div>
  </section>
<?php endif; ?>
<!-- End Icon Blocks -->