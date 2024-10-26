<?php
$info = $data['testimonio'];
$url_image = !empty($info['Imagen']) ? URL_GAL . 'testimonios/images/IM_' . $info['Imagen'] : '';
$detalle = strip_tags($info['Comentario']);
?>
<!-- Figure -->
<!-- Breadcrumbs -->
<section class="g-bg-gray-light-v5 g-py-50">
  <div class="container">
    <div class="d-sm-flex text-center">
      <div class="align-self-center">
        <h2 class="h3 g-font-weight-500 w-100 g-mb-10 g-mb-0--md">Testimonio</h2>
      </div>

      <div class="align-self-center ml-auto">
        <ul class="u-list-inline">
          <li class="list-inline-item g-mr-5">
            <a class="u-link-v5 g-color-main g-color-primary--hover" href="<?php echo URL_WEB; ?>">Home</a>
            <i class="g-color-gray-light-v2 g-ml-5">/</i>
          </li>
          <li class="list-inline-item g-mr-5">
            <a class="u-link-v5 g-color-main g-color-primary--hover" href="<?php echo URL_WEB . 'testimonios'; ?>">Testimonios</a>
            <i class="g-color-gray-light-v2 g-ml-5">/</i>
          </li>
          <li class="list-inline-item g-color-primary">
            <span><?php echo $info['Nombre']; ?></span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- End Breadcrumbs -->
<section class="container g-pt-50 g-pb-40">  
  <div class="box-testimonio">
    <?php
    if (!empty($info['Nombre'])) :
      ?>
      <div class="row justify-content-center">
        <div class="col-md-10">
          <h2 class="h2 g-mb-30 g-color-black"><?php echo $info['Nombre']; ?></h2>
          <div class="description text-justify">
            <?php if (!empty($url_image)) : ?>
              <img class="image-test" src="<?php echo $url_image; ?>" alt="<?php echo $info['Nombre']; ?>">
                 <?php endif; ?>
                 <?php echo $info['Comentario']; ?>
          </div> 
        </div>
      </div>
      <?php
    endif;
    ?>
  </div>
</section>
<!-- End Figure -->
