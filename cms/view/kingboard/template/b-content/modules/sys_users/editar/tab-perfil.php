<?php $tabla = $data['tabla']; ?>
<div class="col-md-8">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="nombre"><span class="obligatory">*</span> Nombre y Apellidos:</label>
        <div class="controls">
          <input type="text" class="form-control" id="nombre" name="<?php echo $tabla; ?>[Nombre]" value="<?php if (isset($data[$tabla]['Nombre'])) echo $data[$tabla]['Nombre']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="email">Email:</label>
        <div class="input-group searchbox">
          <input type="text" class="form-control" id="email" name="<?php echo $tabla; ?>[Email]" value="<?php if (isset($data[$tabla]['Email'])) echo $data[$tabla]['Email']; ?>" />
          <span class="input-group-btn">
            <button onclick="check_email('<?php echo URL_CMS . 'sys_user/check_email'; ?>');" class="btn btn-default" type="button">Verificar</button>
          </span>
        </div>
        <p class="help-block"></p>
      </div>
      <div class="form-group">
        <label class="control-label" for="usuario">Usuario:</label>
        <div class="input-group searchbox">
          <input type="text" class="form-control" id="usuario" name="<?php echo $tabla; ?>[Usuario]" value="<?php if (isset($data[$tabla]['Usuario'])) echo $data[$tabla]['Usuario']; ?>" />
          <span class="input-group-btn">
            <button onclick="check_user('<?php echo URL_CMS . 'sys_user/check_user'; ?>');" class="btn btn-default" type="button">Verificar</button>
          </span>
        </div>
        <p class="help-block"></p>
      </div>
      <div class="form-group">
        <label class="control-label" for="contrasenia">Nueva Contrase&ntilde;a:</label>
        <div class="controls">
          <input type="text" class="form-control" id="contrasenia" name="<?php echo $tabla; ?>[Contrasenia]" value="" />
          <p class="help-block">No se muestra la contrase&ntilde;a por seguridad.</p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="descripcion">Biograf&iacute;a:</label>
        <div class="controls">
          <textarea id="descripcion" name="<?php echo $tabla; ?>[Descripcion]" class="form-control" rows="4"><?php if (isset($data[$tabla]['Descripcion'])) echo $data[$tabla]['Descripcion']; ?></textarea>
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
      <h3><i class="fa fa-cog"></i> Datos</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="imagen">Imagen:</label>
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
        </div>
      </div>
      <div class="form-group">
        <div class="controls">
          <?php
          if (isset($data[$tabla]['TimeCreate'])) :
            $date = new DateTime($data[$tabla]['TimeCreate']);
            $fecha_creacion = $date->format('d/m/y - H:i:s');
            ?>
            <label class="control-label">Fecha de Creación:</label>
            <span><?php echo $fecha_creacion; ?></span>
            <?php
          endif;
          ?>
          <?php
          if (isset($data[$tabla]['TimeUpdate'])) :
            $date = new DateTime($data[$tabla]['TimeUpdate']);
            $ultima_vez = $date->format('d/m/y - H:i:s');
            ?>
            <label class="control-label">Fecha de Actualización:</label>        
            <span><?php echo $ultima_vez; ?></span>
          <?php endif; ?>
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

  var checkExt = new RegExp(/^(jpg|JPG|JPEG|png)$/);
  uploadImage('imagen', checkExt,
          "<?php echo URL_CMS . $data['base_url'] . 'upload'; ?>",
          "<?php echo URL_CMS . $data['base_url'] . 'jcrop'; ?>");
</script>
