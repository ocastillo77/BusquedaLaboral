<?php
$tabla = $data['tabla'];
$checked1 = isset($data[$tabla]['Publico']) && $data[$tabla]['Publico'] != 1 ? '' : 'checked="checked"';
?>
<div class="col-md-8">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group mb-3">
        <input id="publico" name="<?php echo $tabla . '[Publico]'; ?>" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="warning" data-on="Activo" data-off="Inactivo" value="1" <?php echo $checked1; ?>>
      </div>
      <div class="form-group">
        <label class="control-label" for="nombre"><span class="obligatory">*</span> Nombre y Apellidos:</label>
        <div class="controls">
          <input type="text" class="form-control" id="nombre" name="<?php echo $tabla; ?>[Nombre]" value="<?php if (isset($data[$tabla]['Nombre'])) echo $data[$tabla]['Nombre']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="email"><span class="obligatory">*</span> Correo Electr&oacute;nico:</label>
        <div class="controls">
          <input type="text" class="form-control" id="email" name="<?php echo $tabla; ?>[Email]" value="<?php if (isset($data[$tabla]['Email'])) echo $data[$tabla]['Email']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="contrasenia"><span class="obligatory">*</span> Contrase&ntilde;a:</label>
        <div class="controls">
          <input type="text" class="form-control" id="contrasenia" name="<?php echo $tabla; ?>[Contrasenia]" value="<?php if (isset($data[$tabla]['Contrasenia'])) echo $data[$tabla]['Contrasenia']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-6">
            <label class="control-label">Dirección:</label>
            <div class="controls">
              <input type="text" class="form-control" name="<?php echo $tabla; ?>[Direccion]" value="<?php echo (isset($data[$tabla]['Direccion'])) ? $data[$tabla]['Direccion'] : ''; ?>" />
            </div>
          </div>
          <div class="col-md-6">
            <label class="control-label">Localidad:</label>
            <div class="controls">
              <input type="text" class="form-control" name="<?php echo $tabla; ?>[Localidad]" value="<?php echo (isset($data[$tabla]['Localidad'])) ? $data[$tabla]['Localidad'] : ''; ?>" />
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-6">
            <label class="control-label">Provincia:</label>
            <div class="controls">
              <select id="provincia" name="<?php echo $tabla; ?>[ProvinciaID]" onchange="changeProvincia(this.value);" class="form-control">
                <option value="0">- Seleccione -</option>
                <?php
                if (isset($data['provincias']) && count($data['provincias']) > 0) :
                  foreach ($data['provincias'] as $item):
                    $selected = ($data[$tabla]['ProvinciaID'] == $item['ID']) ? 'selected="selected"' : '';
                ?>
                    <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                <?php
                  endforeach;
                endif;
                ?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-6">
            <label class="control-label">Celular:</label>
            <div class="controls">
              <input type="text" class="form-control" name="<?php echo $tabla; ?>[Celular]" value="<?php echo (isset($data[$tabla]['Celular'])) ? $data[$tabla]['Celular'] : ''; ?>" />
            </div>
          </div>
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
        <label class="control-label">Candidato Destacado:</label>
        <div class="controls">
          <?php
          $checked2 = isset($data[$tabla]['FotoValida']) && $data[$tabla]['FotoValida'] == 1 ? 'checked' : '';
          ?>
          <input class="checkvert" type="checkbox" id="destacado" name="<?php echo $tabla; ?>[FotoValida]"
            data-on="Si" data-off="No" data-toggle="toggle" data-width="80"
            data-onstyle="success" data-offstyle="warning" value="1" <?php echo $checked2; ?>>
        </div>
      </div>
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
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
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

  function changeProvincia(id) {
    $('#departamento').html('');

    $.ajax({
      dataType: "json",
      url: urlProv + id,
      success: function(data) {
        $('#departamento').append('<option value="">- seleccione -</option>');

        if (data != '') {
          $.each(data, function(i, row) {
            $('#departamento').append('<option value="' + row.ID + '">' + row.Nombre + '</option>');
          });
        }

        $('#departamento').trigger('chosen:updated');
      }
    });
  }

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