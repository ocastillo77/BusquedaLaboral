<?php
if (isset($data['galeria']) && count($data['galeria'])) :
  for ($i = 1; $i < (count($data['galeria']) + 1); $i++) :
    if (isset($data['galeria'][$i - 1]['Imagen']) && !empty($data['galeria'][$i - 1]['Imagen'])) :
      $thumb = URL_GAL . $data['tabla_sec'] . '/thumbs/TH_' . $data['galeria'][$i - 1]['Imagen'];
      $image = URL_GAL . $data['tabla_sec'] . '/images/IM_' . $data['galeria'][$i - 1]['Imagen'];
      ?>	
      <li id="item-<?php echo $i; ?>">
        <div id="galeria_<?php echo $i; ?>" class="gal-item">
          <div class="gal-image">
            <a id="gale_<?php echo $i; ?>" href="<?php echo $image; ?>" data-fancybox-group="gallery" class="fancybox">
              <img class="list-group-image" id="img-galeria_<?php echo $i; ?>" src="<?php echo $thumb; ?>" />
              <input type="hidden" value="<?php echo $data['galeria'][$i - 1]['ID']; ?>" name="gallery[<?php echo $i - 1; ?>][ID]">
              <input type="hidden" value="<?php echo $data['galeria'][$i - 1]['Imagen']; ?>" name="gallery[<?php echo $i - 1; ?>][Imagen]">
              <input class="posicion" type="hidden" value="<?php echo $data['galeria'][$i - 1]['Posicion']; ?>" name="gallery[<?php echo $i - 1; ?>][Posicion]">
            </a>
          </div>
          <div class="gal-caption">
            <h3 class="inner list-group-item-heading"><?php echo $data['galeria'][$i - 1]['Imagen']; ?></h3>
          </div>
          <div class="action-buttons">
            <a href="javascript:deleteGallery('galeria_<?php echo $i; ?>', '<?php echo $data['galeria'][$i - 1]['ID']; ?>')" class="btn btn-danger btn-xs">
              <i class="fa fa-trash-o"></i> Eliminar
            </a>
          </div>
        </div>
      </li>
      <?php
    endif;
  endfor;
else :
  ?>	
  <p class="center">Lo sentimos, no se encontr&oacute; ninguna imagen en la galeria!</p>
<?php
endif;

