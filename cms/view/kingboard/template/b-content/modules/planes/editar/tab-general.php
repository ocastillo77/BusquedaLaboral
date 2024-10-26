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
        <label class="control-label" for="nombre"><span class="obligatory">*</span> Nombre:</label>
        <div class="controls">
          <input type="text" class="form-control" id="nombre" name="<?php echo $tabla; ?>[Nombre]" value="<?php if (isset($data[$tabla]['Nombre'])) echo $data[$tabla]['Nombre']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="url">Precio Sin Descuento:</label>
        <div class="controls">
          <input type="text" class="form-control" id="precioant" name="<?php echo $tabla; ?>[PrecioAnt]" value="<?php if (isset($data[$tabla]['PrecioAnt'])) echo $data[$tabla]['PrecioAnt']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="url">Precio Final:</label>
        <div class="controls">
          <input type="text" class="form-control" id="precio" name="<?php echo $tabla; ?>[Precio]" value="<?php if (isset($data[$tabla]['Precio'])) echo $data[$tabla]['Precio']; ?>" />
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
        <label class="control-label"><span class="obligatory">*</span> Donante:</label>
        <div class="controls">
          <select id="categoria" name="<?php echo $tabla; ?>[CategoriaID]" data-rel="chosen">
            <option value="">- Seleccione -</option>
            <?php
            if (!empty($data['categorias'])) :
              foreach ($data['categorias'] as $item):
                $selected = !empty($data[$tabla]['CategoriaID']) && $data[$tabla]['CategoriaID'] == $item['ID'] ? 'selected="selected"' : '';
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
</div>
<script>
  $('#nombre').keyup(function() {
    value = $(this).val();
    $('#meta-url').val(str2url(value));
    updateFriendlyURL('meta-url', 'friendly-url');
  });
  $('#meta-url').keyup(function() {
    $(this).val(str2url($(this).val()));
    updateFriendlyURL('meta-url', 'friendly-url');
  });
</script>