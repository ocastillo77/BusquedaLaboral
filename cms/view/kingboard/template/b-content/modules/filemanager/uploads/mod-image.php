<li id="item-<?php echo $data['num']; ?>">
  <div id="galeria_<?php echo $data['num']; ?>" class="gal-item">
    <div class="gal-image">
      <a id="gale_<?php echo $data['num']; ?>" href="<?php echo $data['image']; ?>" data-fancybox-group="gallery" class="fancybox">
        <img class="list-group-image" id="img-galeria_<?php echo $data['num']; ?>" src="<?php echo $data['thumb']; ?>" />
        <input type="hidden" name="gallery[<?php echo $data['num']; ?>][ID]" value="0" />
        <input type="hidden" name="gallery[<?php echo $data['num']; ?>][Imagen]" value="<?php echo $data['name']; ?>" />        
        <input class="posicion" type="hidden" name="gallery[<?php echo $data['num']; ?>][Posicion]" value="<?php echo $data['num']; ?>" />        
      </a>
    </div>
    <div class="gal-caption">
      <h3 class="inner list-group-item-heading"><?php echo $data['name']; ?></h3>
    </div>
    <div class="action-buttons">
      <a href="javascript:deleteGallery('galeria_<?php echo $data['num']; ?>', 0)" class="btn btn-danger btn-xs">
        <i class="fa fa-trash-o"></i> Eliminar
      </a>
    </div>
  </div>
</li>
