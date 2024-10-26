<?php
if (isset($data['galeria']) && count($data['galeria'])) :
  for ($i = 1; $i < (count($data['galeria']) + 1); $i++) :
    if (isset($data['galeria'][$i - 1]['Imagen']) && !empty($data['galeria'][$i - 1]['Imagen'])) :
      $thumb = URL_GAL . $data['tabla'] . '/thumbs/TH_' . $data['galeria'][$i - 1]['Imagen'];
      $image = URL_GAL . $data['tabla'] . '/images/IM_' . $data['galeria'][$i - 1]['Imagen'];
      $title = (!empty($data['galeria'][$i - 1]['Titulo'])) ? $data['galeria'][$i - 1]['Titulo'] : '';
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
            <ul class="list-unstyled">          
              <li class="list-desc"><?php echo $title; ?></li>
              <li class="list-edit">
                <textarea rows="2" name="gallery[<?php echo $i - 1; ?>][Titulo]" placeholder="Ingrese una descripci&oacute;n"><?php echo $title; ?></textarea>
              </li>
            </ul>
          </div>
          <div class="action-buttons">
            <a href="javascript:editGallery('galeria_<?php echo $i; ?>');" class="btn btn-primary btn-xs">
              <i class="fa fa-pencil"></i> <span class="bt-edit">Editar</span>
            </a>
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

