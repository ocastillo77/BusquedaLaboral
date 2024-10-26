<?php
$info = !empty($data['subsecciones']) ? $data['subsecciones'] : [];
?>
<!-- Figure -->
<section class="section-pc container g-pt-50 g-pb-40">
  <div class="row">
    <?php
    if (!empty($info['subsecciones'])) :
      foreach ($info['subsecciones'] as $item) :
        $url = !empty($item['URL']) ? URL_WEB . 'secciones/' . $item['URL'] : '';
        ?>
        <div class="col-md-4">
          <h3><?php echo $item['URL']; ?></h3>
          <a href="<?php echo $url; ?>">Ver más</a>
        </div>
        <?php
      endforeach;
    endif;
    ?>
  </div>
  <div class="row">
    <div class="col-md-12">
      <!-- Go to www.addthis.com/dashboard to customize your tools -->
      <p class="text-center"><strong>Comparte esta información:</strong></p>
      <div class="addthis_inline_share_toolbox text-center"></div>
    </div>
  </div>
</section>
<!-- End Figure -->
