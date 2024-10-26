<?php if (isset($data['p370x200'])) : ?>
  <div class="container banner-group">
    <div class="row">
      <?php
      foreach ($data['p370x200'] as $item) :
        $urlImage = !empty($item['Imagen']) ? URL_GAL . 'banner_box/images/IM_' . $item['Imagen'] : '';
        ?>
        <div class="col-sm-4 col-xs-6">
          <div class="banner">
            <a href="<?php echo $item['URL']; ?>" title="<?php echo $item['Titulo']; ?>">
              <img src="<?php echo $urlImage; ?>" alt="<?php echo $item['Titulo']; ?>">
            </a>
          </div><!-- End .banner -->
        </div><!-- End .col-sm-4 -->
        <?php
      endforeach;
      ?>
    </div><!-- End .row -->
  </div><!-- End .container -->
<?php endif; ?>
