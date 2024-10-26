<?php
if (isset($data['tabla']) && isset($data[$data['tabla']])) :
  $info = $data[$data['tabla']];
  $plantilla = !empty($info['Archivo']) ? $info['Archivo'] : 'general.php';
  $filename = TPL_CONTENT . 'seccion' . DS . 'plantillas' . DS . $plantilla;

    if (file_exists($filename)) :
      include $filename;
    else :
      ?>
      <div class="section-full  p-t120 p-b90 bg-white">
        <div class="container">
          <!-- BLOG SECTION START -->
          <div class="section-content">
            <div class="alert alert-danger text-center tpl-not-found">No se encuentra la plantilla: <?php echo $plantilla; ?></div>
          </div>
        </div>
      </div>
    <?php
    endif;
    ?>
  </div>
  <!-- CONTENT END -->
  <?php
endif;
?>
