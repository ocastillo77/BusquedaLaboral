<!-- Testimonials -->
<?php
if (isset($data['p1920x1080'])) :
  $item = $data['p1920x1080'];
  $urlImage = !empty($item['Imagen']) ? URL_GAL . 'banner_box/images/IM_' . $item['Imagen'] : '';
  ?>
  <section class="dzsparallaxer auto-init height-is-based-on-content use-loading g-bg-cover g-bg-bluegray-opacity-0_5--after">
    <div class="divimage dzsparallaxer--target w-100"
         style="background-image: url(<?php echo $urlImage; ?>);"></div>
    <div class="container g-z-index-1 g-py-120">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <!-- Testimonials -->
          <div class="p-descripcion g-color-white
               text-center g-z-index-1 g-pa-30">
            <?php echo $item['Descripcion']; ?>
          </div>
          <!-- End Testimonials -->
        </div>
      </div>
    </div>
  </section>
  <?php
endif;
?>
<!-- End Testimonials -->