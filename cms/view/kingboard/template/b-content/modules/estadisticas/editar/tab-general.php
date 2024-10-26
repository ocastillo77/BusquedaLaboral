<?php
$tabla = $data['tabla'];
?>
<input type="hidden" name="<?php echo $tabla; ?>[Publico]" id="publico" value="<?php if (isset($data[$tabla]['Publico'])) {
                                                                                  echo $data[$tabla]['Publico'];
                                                                                }
                                                                                ?>">
<div class="col-md-8">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="titulo"><span class="obligatory">*</span> Título:</label>
        <div class="controls">
          <input type="text" class="form-control" id="titulo" name="<?php echo $tabla; ?>[Titulo]" value="<?php if (isset($data[$tabla]['Titulo'])) {
                                                                                                            echo $data[$tabla]['Titulo'];
                                                                                                          }
                                                                                                          ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="url">URL:</label>
        <div class="controls">
          <input type="text" class="form-control" id="url" name="<?php echo $tabla; ?>[URL]" value="<?php if (isset($data[$tabla]['URL'])) {
                                                                                                      echo $data[$tabla]['URL'];
                                                                                                    }
                                                                                                    ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="color">Color:</label>
        <div class="controls">
          <input type="text" class="form-control" id="color" name="<?php echo $tabla; ?>[Color]" value="<?php if (isset($data[$tabla]['Color'])) {
                                                                                                          echo $data[$tabla]['Color'];
                                                                                                        }
                                                                                                        ?>" />
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
      <div class="form-group">
        <label class="control-label" for="imagen">Imagen Fondo:</label>
        <div class="controls">
          <div class="content-image">
            <div class="border-overflow">
              <?php
              $thumb = (!empty($data[$tabla]['Imagen'])) ? URL_GAL . $data['tabla'] . '/thumbs/TH_' . $data[$tabla]['Imagen'] : CMS_IMG . 'no-foto-150x100.jpg';
              $imagen = (!empty($data[$tabla]['Imagen'])) ? URL_GAL . $data['tabla'] . '/images/IM_' . $data[$tabla]['Imagen'] : '#';
              $class = (!empty($data[$tabla]['Imagen'])) ? 'fancybox' : '';
              ?>
              <input type="hidden" name="<?php echo $tabla; ?>[Imagen]" id="imagen" value="<?php if (isset($data[$tabla]['Imagen'])) {
                                                                                              echo $data[$tabla]['Imagen'];
                                                                                            }
                                                                                            ?>">
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
          <p class="help-block">Subir imagen de <?php echo $data['width'] . 'x' . $data['height'] . 'px o proporcional. '; ?></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="logo">Logo:</label>
        <div class="controls">
          <div class="content-image">
            <div class="border-overflow">
              <?php
              $thumb = (!empty($data[$tabla]['Logo'])) ? URL_GAL . $data['tabla'] . '/thumbs/TH_' . $data[$tabla]['Logo'] : CMS_IMG . 'no-foto-150x100.jpg';
              $imagen = (!empty($data[$tabla]['Logo'])) ? URL_GAL . $data['tabla'] . '/images/IM_' . $data[$tabla]['Logo'] : '#';
              $class = (!empty($data[$tabla]['Logo'])) ? 'fancybox' : '';
              ?>
              <input type="hidden" name="<?php echo $tabla; ?>[Logo]" id="logo" value="<?php if (isset($data[$tabla]['Logo'])) {
                                                                                              echo $data[$tabla]['Logo'];
                                                                                            }
                                                                                            ?>">
              <a id="gal-logo" href="<?php echo $imagen; ?>" class="<?php echo $class; ?>">
                <img src="<?php echo $thumb; ?>" id="img-logo" />
              </a>
            </div>
          </div>
          <div class="buttons-up">
            <a id="btn-logo" class="btn btn-primary"><i class="icon icon-plus icon-white"></i> Cambiar</a>
            <a id="del-logo" onclick="deleteImage('logo')" class="btn btn-danger"><i class="icon icon-trash icon-white"></i> Eliminar</a>
            <div id="ldr-logo" class="loader">
              <img src="<?php echo CMS_IMG . 'loader.gif'; ?>"> <span>cargando imagen...</span>
            </div>
          </div>
          <p class="help-block">Subir imagen de <?php echo $data['th_width'] . 'x' . $data['th_height'] . 'px o proporcional. '; ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function deleteImage(code) {
    delImage(code,
      "<?php echo CMS_IMG . 'no-foto-150x100.jpg'; ?>",
      "<?php echo URL_CMS . $data['base_url'] . 'delimage'; ?>");
  }

  var checkExt = new RegExp(/^(jpg|jpeg|JPEG|JPG|png|PNG)$/);
  uploadImage('imagen', checkExt,
    "<?php echo URL_CMS . $data['base_url'] . 'upload/'; ?>",
    "<?php echo URL_CMS . $data['base_url'] . 'jcrop'; ?>", 'categoria');

  uploadImage('logo', checkExt,
    "<?php echo URL_CMS . $data['base_url'] . 'uploadLogo/'; ?>",
    "<?php echo URL_CMS . $data['base_url'] . 'jcrop'; ?>", 'categoria');

  setTimeout(function() {
    set_minieditor('comentario');
  }, 1000);
</script>