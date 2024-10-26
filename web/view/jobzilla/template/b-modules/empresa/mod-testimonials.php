<!-- Testimonials v3 -->
<?php if (isset($data['notas']) && count($data['notas']) > 0) : ?>
  <section class="g-bg-gray-light-v5 g-pt-100 g-pb-70">
    <div class="container">
      <!-- Heading -->
      <div class="row justify-content-center text-center g-mb-50">
        <div class="col-lg-9">
          <h2 class="h3 g-color-black g-font-weight-600 text-uppercase mb-2">Noticias en Redes</h2>
          <div class="d-inline-block g-width-35 g-height-2 g-bg-primary mb-2"></div>
        </div>
      </div>
      <!-- End Heading -->
      <div class="row">
        <?php
        foreach ($data['notas'] as $item) :
          ?>
          <div class="col-lg-6 g-mb-30">
            <div class="box-nota">
              <?php echo $item['Contenido']; ?>
            </div>            
          </div>
          <?php
        endforeach;
        ?>
      </div>
    </div>
  </section>
<?php endif; ?>
<!-- End Testimonials v3 -->