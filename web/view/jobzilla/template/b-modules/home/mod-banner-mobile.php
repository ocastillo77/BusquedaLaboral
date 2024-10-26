<?php
if (!empty($data['bmobile'])) :
?>
  <!--Banner Start-->
  <div id="banner-top" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <?php
      $i = 0;
      foreach ($data['bmobile'] as $item) :
        $active = $i == 0 ? 'active' : '';
      ?>
        <button type="button" data-bs-target="#banner-top" data-bs-slide-to="<?php echo $i; ?>" class="<?php echo $active; ?>"></button>
      <?php
        $i++;
      endforeach;
      ?>
    </div>
    <div class="carousel-inner">
      <?php
      $i = 1;
      foreach ($data['bmobile'] as $item) :
        $active = $i == 1 ? 'active' : '';
        $url = !empty($item['Imagen']) ? URL_GAL . 'banner_box/images/IM_' . $item['Imagen'] : '';
      ?>
        <div class="carousel-item <?php echo $active; ?>">
          <img src="<?php echo $url; ?>" class="d-block w-100" alt="<?php echo $item['Titulo']; ?>">
          <div class="carousel-caption">
            <div class="twm-bnr-right-section">
              <div class="twm-bnr-title-large text-center">
                <?php echo $item['Descripcion']; ?>
              </div>
            </div>
          </div>
        </div>
      <?php
        $i++;
      endforeach;
      ?>
    </div>
  </div>
  <!--Banner End-->
<?php
endif;
?>