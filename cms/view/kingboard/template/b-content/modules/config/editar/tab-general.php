<?php $tabla = $data['tabla']; ?>
<div class="col-md-8">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="nombre"><span class="obligatory">*</span> Nombre Sitio Web:</label>
        <div class="controls">
          <input type="text" class="form-control" id="nombre" name="<?php echo $tabla; ?>[Nombre]"
                 value="<?php if (isset($data[$tabla]['Nombre'])) echo $data[$tabla]['Nombre']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="url">Url Sitio Web:</label>
        <div class="controls">
          <input type="text" class="form-control" id="url" name="<?php echo $tabla; ?>[Website]" value="<?php if (isset($data[$tabla]['Website'])) echo $data[$tabla]['Website']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="email">Email de Contacto:</label>
        <div class="controls">
          <input type="text" class="form-control" id="email" name="<?php echo $tabla; ?>[Email]" value="<?php if (isset($data[$tabla]['Email'])) echo $data[$tabla]['Email']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="email">Email 2:</label>
        <div class="controls">
          <input type="text" class="form-control" id="email2" name="<?php echo $tabla; ?>[Email2]" value="<?php if (isset($data[$tabla]['Email2'])) echo $data[$tabla]['Email2']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="email">Email 3:</label>
        <div class="controls">
          <input type="text" class="form-control" id="email3" name="<?php echo $tabla; ?>[Email3]" value="<?php if (isset($data[$tabla]['Email3'])) echo $data[$tabla]['Email3']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="email">Email 4:</label>
        <div class="controls">
          <input type="text" class="form-control" id="email4" name="<?php echo $tabla; ?>[Email4]" value="<?php if (isset($data[$tabla]['Email4'])) echo $data[$tabla]['Email4']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="telefono">Tel&eacute;fono 1:</label>
        <div class="controls">
          <input type="text" class="form-control" id="telefono" name="<?php echo $tabla; ?>[Telefono]" value="<?php if (isset($data[$tabla]['Telefono'])) echo $data[$tabla]['Telefono']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="movil">Tel&eacute;fono 2:</label>
        <div class="controls">
          <input type="text" class="form-control" id="movil" name="<?php echo $tabla; ?>[Movil]" value="<?php if (isset($data[$tabla]['Movil'])) echo $data[$tabla]['Movil']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="whatsapp">WhatsApp:</label>
        <div class="controls">
          <input type="text" class="form-control" id="whatsapp" name="<?php echo $tabla; ?>[Whatsapp]" value="<?php if (isset($data[$tabla]['Whatsapp'])) echo $data[$tabla]['Whatsapp']; ?>" />
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
        <label class="control-label" for="imagen">Logo:</label>
        <div class="controls">
          <div class="content-image">
            <div class="border-overflow">
              <?php
              $thumb = !empty($data[$tabla]['Imagen']) ? URL_GAL . $data['tabla'] . '/thumbs/TH_' . $data[$tabla]['Imagen'] : CMS_IMG . 'no-foto-150x100.jpg';
              $imagen = !empty($data[$tabla]['Imagen']) ? URL_GAL . $data['tabla'] . '/images/IM_' . $data[$tabla]['Imagen'] : '#';
              $class = !empty($data[$tabla]['Imagen']) ? 'fancybox' : '';
              $info = !empty($data[$tabla]['Imagen']) ? pathinfo($data[$tabla]['Imagen']) : '';
              ?>
              <input type="hidden" name="<?php echo $tabla; ?>[Imagen]" id="imagen" value="<?php if (isset($data[$tabla]['Imagen'])) echo $data[$tabla]['Imagen']; ?>">
              <a id="gal-imagen" href="<?php echo $imagen; ?>" class="<?php echo $class; ?>">
                <img src="<?php echo $thumb; ?>" id="img-imagen" width="150" height="100">
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
          <p class="help-block">Subir imagen de <?php echo $data['width'] . 'x' . $data['height'] . 'px'; ?> o proporcional</p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="favicon">Favicon:</label>
        <div class="controls">
          <div class="content-image">
            <div class="border-overflow">
              <?php
              $thumbF = (!empty($data[$tabla]['Favicon'])) ? URL_GAL . $data['tabla'] . '/thumbs/TH_' . $data[$tabla]['Favicon'] : CMS_IMG . 'no-foto-150x100.jpg';
              $imagenF = (!empty($data[$tabla]['Favicon'])) ? URL_GAL . $data['tabla'] . '/images/IM_' . $data[$tabla]['Favicon'] : '#';
              $classF = (!empty($data[$tabla]['Favicon'])) ? 'fancybox' : '';
              ?>
              <input type="hidden" name="<?php echo $tabla; ?>[Favicon]" id="favicon" value="<?php if (isset($data[$tabla]['Favicon'])) echo $data[$tabla]['Favicon']; ?>">
              <a id="gal-favicon" href="<?php echo $imagenF; ?>" class="<?php echo $classF; ?>">
                <img src="<?php echo $thumbF; ?>" id="img-favicon">
              </a>
            </div>
          </div>
          <div class="buttons-up">
            <a id="btn-favicon" class="btn btn-primary"><i class="icon icon-plus icon-white"></i> Cambiar</a>
            <a id="del-favicon" onclick="deleteImage('favicon')" class="btn btn-danger"><i class="icon icon-trash icon-white"></i> Eliminar</a>
            <div id="ldr-favicon" class="loader">
              <img src="<?php echo CMS_IMG . 'loader.gif'; ?>"> <span>cargando imagen...</span>
            </div>
          </div>
          <p class="help-block">Subir imagen PNG de 16x16px o proporcional</p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label">CBU:</label>
        <div class="controls">
          <input type="text" class="form-control" id="cbu" name="<?php echo $tabla; ?>[CBU]" value="<?php if (isset($data[$tabla]['CBU'])) echo $data[$tabla]['CBU']; ?>" />
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
  });

  function deleteImage(code) {
    delImage(code,
            "<?php echo CMS_IMG . 'no-foto-150x100.jpg'; ?>",
            "<?php echo URL_CMS . $data['base_url'] . 'delimage'; ?>");
  }

  var checkExt = new RegExp(/^(jpg|JPG|JPEG|jpeg|png|svg)$/);
  uploadImage('imagen', checkExt,
          "<?php echo URL_CMS . $data['base_url'] . 'upload'; ?>",
          "<?php echo URL_CMS . $data['base_url'] . 'jcrop'; ?>");

  var checkExt1 = new RegExp(/^(jpg|JPG|JPEG|jpeg|png)$/);
  uploadImage('favicon', checkExt1,
          "<?php echo URL_CMS . $data['base_url'] . 'uploadfav'; ?>",
          "<?php echo URL_CMS . $data['base_url'] . 'jcrop'; ?>");
</script>