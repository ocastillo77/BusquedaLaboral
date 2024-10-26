<?php
$tabla = $data['tabla'];
?>
<input type="hidden" name="<?php echo $tabla; ?>[Publico]" id="publico" value="<?php if (isset($data[$tabla]['Publico'])) echo $data[$tabla]['Publico']; ?>">
<div class="col-md-8">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="nombre"><span class="obligatory">*</span> Nombre</label>
        <div class="controls">
          <input type="text" class="form-control" id="nombre" name="<?php echo $tabla; ?>[Nombre]" value="<?php if (isset($data[$tabla]['Nombre'])) echo $data[$tabla]['Nombre']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>	
      <div class="form-group">
        <label class="control-label" for="meta-url"><span class="obligatory">*</span> Enlace Permanente:</label>
        <div class="controls">
          <input type="text" class="form-control" id="meta-url" name="<?php echo $tabla; ?>[URL]" value="<?php if (isset($data[$tabla]['URL'])) echo $data[$tabla]['URL']; ?>" />
          <p class="help-block">Su enlace se verá en: <?php echo URL_WEB . $tabla . '/'; ?><strong id="friendly-url"><?php if (isset($data[$tabla]['URL'])) echo $data[$tabla]['URL']; ?></strong></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="descripcion">Descripci&oacute;n:</label>
        <div class="controls">
          <textarea id="descripcion" name="<?php echo $tabla; ?>[Descripcion]" class="full-editor form-control" rows="4"><?php if (isset($data[$tabla]['Descripcion'])) echo $data[$tabla]['Descripcion']; ?></textarea>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="nota">Nota Personal:</label>
        <div class="controls">
          <textarea id="nota" name="<?php echo $tabla; ?>[Nota]" class="full-editor form-control" rows="3"><?php if (isset($data[$tabla]['Nota'])) echo $data[$tabla]['Nota']; ?></textarea>
          <p class="help-block">Importante: Este campo no se muestra en el Sitio Web.</p>
        </div>
      </div>
      <div class="cont-hint">
        <span class="obligatory">*</span>
        <p class="help-block">Los campos son obligatorios</p>
      </div>
    </div>
  </div>
</div>
<div class="col-md-4">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-cog"></i> Configuraci&oacute;n</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label">Compartir en Facebook:</label>
        <div class="controls">
          <?php
          $checkedf = '';
          ?>
          <input class="checkvert" type="checkbox" id="publired" name="<?php echo $tabla; ?>[PubliFace]" 
                 data-on="Si" data-off="No" data-toggle="toggle" data-width="80" 
                 data-onstyle="success" data-offstyle="warning" value="1" <?php echo $checkedf; ?>>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label">Compartir en Instagram:</label>
        <div class="controls">
          <?php
          $checkedi = '';
          ?>
          <input class="checkvert" type="checkbox" id="publired" name="<?php echo $tabla; ?>[PubliInst]" 
                 data-on="Si" data-off="No" data-toggle="toggle" data-width="80" 
                 data-onstyle="success" data-offstyle="warning" value="1" <?php echo $checkedi; ?>>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label">Accesorio Destacado:</label>
        <div class="controls">
          <?php
          $checked = isset($data[$tabla]['Destacado']) && $data[$tabla]['Destacado'] == 1 ? 'checked' : '';
          ?>
          <input class="checkvert" type="checkbox" id="destacado" name="<?php echo $tabla; ?>[Destacado]" 
                 data-on="Si" data-off="No" data-toggle="toggle" data-width="80" 
                 data-onstyle="success" data-offstyle="warning" value="1" <?php echo $checked; ?>>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="categorias">Categoría:</label>
        <div class="controls">
          <select id="categorias" name="<?php echo $tabla; ?>[CategoriaID]" data-rel="chosen">                							
            <option value="">- Seleccione -</option>            
            <?php
            if (isset($data['categorias'])) :
              foreach ($data['categorias'] as $item):
                $selected = ($data[$tabla]['CategoriaID'] == $item['ID']) ? 'selected="selected"' : '';
                ?>								
                <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                <?php
              endforeach;
            endif;
            ?>
          </select>  
        </div>
      </div>  
      <div class="form-group">
        <label class="control-label">Moneda:</label>
        <div class="controls">
          <select id="moneda" name="<?php echo $tabla; ?>[MonedaID]" data-rel="chosen">                							       
            <?php
            if (isset($data['monedas'])) :
              foreach ($data['monedas'] as $item):
                $selected = ($data[$tabla]['MonedaID'] == $item['ID']) ? 'selected="selected"' : '';
                ?>								
                <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                <?php
              endforeach;
            endif;
            ?>
          </select>  
        </div>
      </div>
      <div class="form-group">
        <label class="control-label">Precio:</label>
        <div class="controls">
          <input type="text" class="form-control" name="<?php echo $tabla; ?>[Precio]" value="<?php echo (isset($data[$tabla]['Precio'])) ? $data[$tabla]['Precio'] : ''; ?>" />
        </div>
      </div> 
      <div class="form-group">
        <label class="control-label" for="imagen">Imagen:</label>
        <div class="controls box-lm">
          <div class="content-image">
            <div class="border-overflow">
              <?php
              $thumb = (!empty($data[$tabla]['Imagen'])) ? URL_GAL . $data['tabla'] . '/thumbs/TH_' . $data[$tabla]['Imagen'] : CMS_IMG . 'no-foto-150x100.jpg';
              $imagen = (!empty($data[$tabla]['Imagen'])) ? URL_GAL . $data['tabla'] . '/images/IM_' . $data[$tabla]['Imagen'] : '#';
              $class = (!empty($data[$tabla]['Imagen'])) ? 'fancybox' : '';
              ?>
              <input type="hidden" name="<?php echo $tabla; ?>[Imagen]" id="imagen" value="<?php if (isset($data[$tabla]['Imagen'])) echo $data[$tabla]['Imagen']; ?>">
              <a id="gal-imagen" href="<?php echo $imagen; ?>" class="<?php echo $class; ?>">
                <img src="<?php echo $thumb; ?>" id="img-imagen" />
              </a>
            </div>
          </div>
          <div class="buttons-up">
            <a id="btn-imagen" class="btn btn-primary"><i class="icon icon-plus icon-white"></i> Cambiar</a>	
            <a id="del-imagen" onclick="deleteImage('imagen')" class="btn btn-danger"><i class="icon icon-trash icon-white"></i> Eliminar</a>
            <div id="ldr-imagen" class="loader">
              <img src="<?php echo CMS_IMG . 'loader.gif'; ?>"> <span>cargando imagen...</span>
            </div>
          </div>
          <p class="help-block">Imagen de <?php echo $data['width'] . 'x' . $data['height'] . 'px'; ?> o proporcional</p>	
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function () {
    $('.fancybox').fancybox();
    $('.fancybox-media').attr('rel', 'media-gallery').fancybox({
      openEffect: 'none',
      closeEffect: 'none',
      prevEffect: 'none',
      nextEffect: 'none',
      arrows: false
    });
  });

  function deleteImage(code) {
    delImage(code,
            "<?php echo CMS_IMG . 'no-foto-150x100.jpg'; ?>",
            "<?php echo URL_CMS . $data['base_url'] . 'delimage'; ?>");
  }

  var checkExt = new RegExp(/^(jpg|jpeg|JPEG|JPG|png)$/);
  uploadImage('imagen', checkExt,
          "<?php echo URL_CMS . $data['base_url'] . 'upload/'; ?>",
          "<?php echo URL_CMS . $data['base_url'] . 'jcrop'; ?>");

  setTimeout(function () {
    set_editor('descripcion');
  }, 1000);

  $('#nombre').keyup(function () {
    value = $(this).val();
    $('#meta-url').val(str2url(value));
    updateFriendlyURL('meta-url', 'friendly-url');
  });

  $('#meta-url').keyup(function () {
    $(this).val(str2url($(this).val()));
    updateFriendlyURL('meta-url', 'friendly-url');
  });
</script>