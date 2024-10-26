<?php
$tabla = $data['tabla'];
$css = !isset($data[$tabla]['IsVideo']) || (isset($data[$tabla]['IsVideo']) && $data[$tabla]['IsVideo'] == 0) ? '' : 'd-none';
?>
<input type="hidden" name="<?php echo $tabla; ?>[Publico]" id="publico" value="<?php if (isset($data[$tabla]['Publico'])) echo $data[$tabla]['Publico']; ?>">
<div class="col-md-8">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <div class="controls">
          <label class="control-label">Tipo:</label>
          <select name="<?php echo $tabla; ?>[IsVideo]" data-rel="chosen" onchange="changeTipo(this.value);">
            <?php
            $list = ['Imagen', 'Video'];
            foreach ($list as $key => $value):
              $selected = $data[$tabla]['IsVideo'] == $key ? 'selected="selected"' : '';
              ?>								
              <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="box-tipo <?php echo $css; ?>">
        <div class="form-group">
          <label class="control-label"><span class="obligatory">*</span> T&iacute;tulo:</label>
          <div class="controls">
            <input type="text" class="form-control" id="titulo" name="<?php echo $tabla; ?>[Titulo]" value="<?php echo (isset($data[$tabla]['Titulo'])) ? $data[$tabla]['Titulo'] : ''; ?>" />
            <p class="help-block"></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label">Descripci&oacute;n:</label>
          <div class="controls">
            <textarea id="descripcion" maxlength="300" name="<?php echo $tabla; ?>[Descripcion]" 
                      class="mini-editor form-control" rows="5"><?php if (isset($data[$tabla]['Descripcion'])) echo $data[$tabla]['Descripcion']; ?></textarea>
            <p class="help-block"></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label">Imagen:</label>
          <div class="controls box-lm">
            <div class="content-image">
              <div class="border-overflow">
                <?php
                $thumb = (!empty($data[$tabla]['Imagen'])) ? URL_GAL . $data['tabla'] . '/thumbs/TH_' . $data[$tabla]['Imagen'] : CMS_IMG . 'no-foto-480x173.jpg';
                $imagen = (!empty($data[$tabla]['Imagen'])) ? URL_GAL . $data['tabla'] . '/images/IM_' . $data[$tabla]['Imagen'] : '#';
                $class = (!empty($data[$tabla]['Imagen'])) ? 'fancybox' : '';
                ?>
                <input type="hidden" name="<?php echo $tabla; ?>[Imagen]" id="imagen" value="<?php if (isset($data[$tabla]['Imagen'])) echo $data[$tabla]['Imagen']; ?>">
                <a id="gal-imagen" href="<?php echo $imagen; ?>" class="<?php echo $class; ?>">
                  <img src="<?php echo $thumb; ?>" id="img-imagen" width="<?php echo $data['width']; ?>">
                </a>
              </div>
            </div>
            <div class="buttons-up">
              <a id="btn-imagen" class="btn btn-primary"><i class="icon icon-plus icon-white"></i> Cambiar</a>	
              <a id="del-imagen" onclick="deleteImage('imagen')" class="btn btn-danger"><i class="icon icon-trash icon-white"></i> Eliminar</a>
              <div id="ldr-imagen" class="loader">
                <img src="<?php echo CMS_IMG . 'loader.gif'; ?>"> 
                <span>cargando imagen...</span>
              </div>
            </div>
            <div class="clear"></div>				
            <p class="help-block">Subir imagen de <?php echo $data['width'] . 'x' . $data['height'] . 'px o proporcional. '; ?></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label">Texto del Enlace:</label>
          <div class="controls">
            <input type="text" class="form-control" id="textbutton" name="<?php echo $tabla; ?>[TextButton]" value="<?php echo (isset($data[$tabla]['TextButton'])) ? $data[$tabla]['TextButton'] : ''; ?>" />
            <p class="help-block"></p>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label">URL del Enlace:</label>
        <div class="controls">
          <input type="text" class="form-control" id="url" name="<?php echo $tabla; ?>[URL]" value="<?php echo (isset($data[$tabla]['URL'])) ? $data[$tabla]['URL'] : ''; ?>" />
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
      <h3><i class="fa fa-cog"></i> Configuraci&oacute;n</h3>
    </div>
    <div class="widget-content">
      <div class="box-tipo <?php echo $css; ?>">
        <div class="form-group">
          <div class="controls">
            <label class="control-label">Alineaci&oacute;n del Texto:</label>
            <select name="<?php echo $tabla; ?>[AlineaText]" data-rel="chosen">
              <?php
              $alinea = array('left' => 'Izquierda', 'right' => 'Derecha');
              foreach ($alinea as $key => $value):
                $selected = ($data[$tabla]['AlineaText'] == $key) ? 'selected="selected"' : '';
                ?>								
                <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="controls">
            <label class="control-label">Tipo de Enlace:</label>
            <select name="<?php echo $tabla; ?>[Target]" data-rel="chosen">
              <?php
              $targets = array('' => 'Enlace Interno', '_blank' => 'Enlace Externo');
              foreach ($targets as $key => $value):
                $selected = ($data[$tabla]['Target'] == $key) ? 'selected="selected"' : '';
                ?>								
                <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label">Posici&oacute;n:</label>
        <div id="content-pos" class="controls">
          <?php include('mod-posicion.php'); ?>
        </div>
        <div class="clear"></div>
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

    $("#descripcion").charCount({
      allowed: 300,
      warning: 15,
      counterText: 'Quedan: '
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
    set_minieditor('descripcion');
  }, 1000);
</script>