<!-- Services Blocks -->
<?php if (isset($data['servicios']) && count($data['servicios']) > 0) : ?>
  <section class="g-py-80">
    <div class="container">
      <div class="row no-gutters">
        <?php
        $i = 1;
        foreach ($data['servicios'] as $item) :
          $class1 = $i == 0 ? 'box-service-two' : 'box-service';
          $class2 = $i == 0 ? 'g-bg-white' : 'g-bg-primary';
          $class3 = $i == 0 ? 'g-color-primary' : 'g-color-white';
          ?>
          <div class="<?php echo $class1; ?> col-lg-4 g-px-40 g-mb-50 g-mb-0--lg">
            <!-- Icon Blocks -->
            <a href="<?php echo $item['URL']; ?>">
              <div class="text-center">
                <span class="service-circle d-inline-block u-icon-v3 u-icon-size--xl <?php echo $class2; ?> <?php echo $class3; ?> rounded-circle g-mb-30">
                  <i class="service-icon <?php echo $item['Icono']; ?> u-line-icon-pro"></i>
                </span>
                <h3 class="h5 g-color-gray-dark-v2 g-font-weight-600 
                    text-uppercase mb-3"><?php echo $item['Nombre']; ?></h3>
                    <div class="mb-0 odescription"><?php echo $item['Descripcion']; ?></div>
              </div>
            </a>
            <!-- End Icon Blocks -->
          </div>
          <?php
          $i++;
        endforeach;
        ?>
      </div>
    </div>
  </section>
<?php endif; ?>
<!-- End Icon Blocks -->