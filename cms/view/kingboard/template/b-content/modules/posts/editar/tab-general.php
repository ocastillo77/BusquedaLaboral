<?php $tabla = $data['tabla']; ?>
<input type="hidden" name="<?php echo $tabla; ?>[Publico]" id="publico" value="<?php if (isset($data[$tabla]['Publico'])) echo $data[$tabla]['Publico']; ?>">
<div class="col-md-8">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="titulo"><span class="obligatory">*</span> Título:</label>
        <div class="controls">
          <input type="text" class="form-control" id="titulo" name="<?php echo $tabla; ?>[Titulo]" value="<?php if (isset($data[$tabla]['Titulo'])) echo $data[$tabla]['Titulo']; ?>" />
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
        <label class="control-label" for="sumario">Sumario:</label>
        <div class="controls">
          <textarea id="sumario" maxlength="200" name="<?php echo $tabla; ?>[Sumario]" 
                    class="mini-editor form-control" rows="3"><?php if (isset($data[$tabla]['Sumario'])) echo $data[$tabla]['Sumario']; ?></textarea>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="detalle">Contenido:</label>
        <div class="controls">
          <textarea id="detalle" name="<?php echo $tabla; ?>[Detalle]" class="full-editor form-control" rows="4"><?php if (isset($data[$tabla]['Detalle'])) echo $data[$tabla]['Detalle']; ?></textarea>
          <p class="help-block"></p>
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
      <h3><i class="fa fa-cog"></i> Configuración</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label">Post Destacado:</label>
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
        <label class="control-label"><span class="obligatory">*</span> Fecha:</label>
        <div class="controls">
          <input type="text" class="form-control datepicker" id="fecha" name="<?php echo $tabla; ?>[Fecha]" 
                 value="<?php echo isset($data[$tabla]['Fecha']) ? $data[$tabla]['Fecha'] : date('Y-m-d'); ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label">Categorías:</label>
        <div class="controls">
          <select id="categoria" name="<?php echo $tabla; ?>[CategoriaID]" data-rel="chosen">
            <?php
            if (isset($data['categorias'])) :
              foreach ($data['categorias'] as $item) :
                $selected = $item['ID'] == $data[$tabla]['CategoriaID'] ? 'selected="selected"' : '';
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
        <label class="control-label">Imagen:</label>
        <div class="controls">
          <div class="content-image">
            <div class="border-overflow">
              <?php
              $thumb = (!empty($data[$tabla]['Imagen'])) ? URL_GAL . $data['tabla'] . '/thumbs/TH_' . $data[$tabla]['Imagen'] : CMS_IMG . 'no-foto-150x100.jpg';
              $imagen = (!empty($data[$tabla]['Imagen'])) ? URL_GAL . $data['tabla'] . '/images/IM_' . $data[$tabla]['Imagen'] : '#';
              $class = (!empty($data[$tabla]['Imagen'])) ? 'fancybox' : '';
              ?>
              <input type="hidden" name="<?php echo $tabla; ?>[Imagen]" id="imagen" value="<?php if (isset($data[$tabla]['Imagen'])) echo $data[$tabla]['Imagen']; ?>">
              <a id="gal-imagen" href="<?php echo $imagen; ?>" class="<?php echo $class; ?>">
                <img src="<?php echo $thumb; ?>" id="img-imagen" width="150">
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
          <div class="controls" style="margin-top:15px;">
            <label class="control-label">URL Imagen:</label>
            <div style="border:1px solid #ddd;padding: 5px 10px; background-color: #fff;">
              <span id="link-imagen" class="help-block"><?php echo $imagen; ?></span>
            </div>
          </div>          
        </div>
      </div>
      <div class="form-group">
        <label class="control-label">Mostrar Imagen:</label>
        <div class="controls">
          <?php
          $checked2 = isset($data[$tabla]['ShowImage']) && $data[$tabla]['ShowImage'] == 1 ? 'checked' : '';
          ?>
          <input class="checkvert" type="checkbox" id="showimage" name="<?php echo $tabla; ?>[ShowImage]" 
                 data-on="Si" data-off="No" data-toggle="toggle" data-width="80" 
                 data-onstyle="success" data-offstyle="warning" value="1" <?php echo $checked2; ?>>
        </div>        
      </div>
      <div class="form-group">
        <label class="control-label" for="video">Video Youtube:</label>
        <div class="controls">
          <div class="content-image">
            <div class="border-overflow">
              <?php
              $thumb = (!empty($data[$tabla]['Video'])) ? 'http://img.youtube.com/vi/' . $data[$tabla]['Video'] . '/0.jpg' :
                CMS_IMG . 'no-foto-150x100.jpg';
              $video = (!empty($data[$tabla]['Video'])) ? 'http://www.youtube.com/watch?v=' . $data[$tabla]['Video'] : '#';
              $class = (!empty($data[$tabla]['Video'])) ? 'fancybox-media' : '';
              ?>
              <input type="hidden" name="<?php echo $tabla; ?>[Video]" id="video" value="<?php if (isset($data[$tabla]['Video'])) echo $data[$tabla]['Video']; ?>">
              <a id="gal-video" href="<?php echo $video; ?>" class="<?php echo $class; ?>">
                <img src="<?php echo $thumb; ?>" id="img-video" width="150">
              </a>
            </div>
          </div>
          <div class="buttons-up">
            <a id="btn-video" href="#pop-video" class="fancybox btn btn-primary"><i class="icon icon-plus icon-white"></i> Cambiar</a>	
            <a id="del-video" onclick="deleteVideo('video')" class="btn btn-danger"><i class="icon icon-trash icon-white"></i> Eliminar</a>
            <div id="ldr-video" class="loader">
              <img src="<?php echo CMS_IMG . 'loader.gif'; ?>"> <span>cargando imagen...</span>
            </div>
          </div>
          <div class="margin-y-15">
            <label class="control-label">Descripci&oacute;n:</label>
            <textarea rows="1" class="form-control autogrow" name="<?php echo $tabla; ?>[TextVideo]"><?php if (isset($data[$tabla]['TextVideo'])) echo $data[$tabla]['TextVideo']; ?></textarea>
          </div>
        </div>
      </div>     
      <div class="form-group">
        <label class="control-label">Video Instagram:</label>
        <div class="controls">
          <input type="text" class="form-control" id="instagram" name="<?php echo $tabla; ?>[Instagram]" value="<?php if (isset($data[$tabla]['Instagram'])) echo $data[$tabla]['Instagram']; ?>" />
          <p class="help-block"></p>
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
      arrows: false,
      helpers: {
        media: {},
        buttons: {}
      }
    });

    $("#sumario").charCount({
      allowed: 200,
      warning: 15,
      counterText: 'Quedan: '
    });

    $('#titulo').keyup(function () {
      value = $(this).val();
      $('#meta-url').val(str2url(value));
      $('#meta-titulo').val(value);
      $('#meta-descripcion').val(value);
      updateFriendlyURL('meta-url', 'friendly-url');
    });

    $('#meta-url').keyup(function () {
      $(this).val(str2url($(this).val()));
      updateFriendlyURL('meta-url', 'friendly-url');
    });
  });

  function deleteImage(code) {
    delImage(code,
      "<?php echo CMS_IMG . 'no-foto-150x100.jpg'; ?>",
      "<?php echo URL_CMS . $data['base_url'] . 'delimage'; ?>");
  }

  function deleteVideo(code) {
    delVideo(code, "<?php echo CMS_IMG . 'no-foto-150x100.jpg'; ?>");
  }

  function deleteGallery(code, id) {
    delGallery(code, id,
      "<?php echo URL_CMS . $data['base_url'] . 'delimage'; ?>");
  }

  var checkExt = new RegExp(/^(jpg|jpeg|JPEG|JPG|png)$/);
  uploadImage('imagen', checkExt,
    "<?php echo URL_CMS . $data['base_url'] . 'upload'; ?>",
    "<?php echo URL_CMS . $data['base_url'] . 'jcrop'; ?>");

  setTimeout(function () {
    set_editor('detalle');
  }, 1000);
</script>