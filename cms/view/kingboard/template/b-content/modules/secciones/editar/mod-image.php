<div id="galeria_<?php echo $data['num']; ?>" class="gal-item">
  <div class="gal-image">
    <a id="gale_<?php echo $data['num']; ?>" href="<?php echo $data['image']; ?>" data-fancybox-group="gallery" class="fancybox">
      <img class="list-group-image" id="img-galeria_<?php echo $data['num']; ?>" src="<?php echo $data['thumb']; ?>" />
      <input type="hidden" name="gallery[<?php echo $data['num']; ?>][ID]" value="0" />
      <input type="hidden" name="gallery[<?php echo $data['num']; ?>][Imagen]" value="<?php echo $data['name']; ?>" />        
    </a>
  </div>
  <div class="gal-caption">
    <h3 class="inner list-group-item-heading"><?php echo $data['name']; ?></h3>
    <ul class="list-unstyled">          
      <li class="list-desc">Ingrese una descripci&oacute;n</li>
      <li class="list-edit">
        <textarea rows="2" name="gallery[<?php echo $data['num']; ?>][Titulo]"></textarea>
      </li>
    </ul>
  </div>
  <div class="action-buttons">
    <a href="javascript:editGallery('galeria_<?php echo $data['num']; ?>');" class="btn btn-primary btn-xs">
      <i class="fa fa-pencil"></i> <span class="bt-edit">Editar</span>
    </a>
    <a href="javascript:deleteGallery('galeria_<?php echo $data['num']; ?>', 0)" class="btn btn-danger btn-xs">
      <i class="fa fa-trash-o"></i> Eliminar
    </a>
  </div>
</div>
