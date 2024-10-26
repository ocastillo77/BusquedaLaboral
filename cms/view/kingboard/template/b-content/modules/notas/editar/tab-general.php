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
          <input type="text" class="form-control" id="nombre" name="<?php echo $tabla; ?>[Nombre]" 
                 value="<?php echo isset($data[$tabla]['Nombre']) ? $data[$tabla]['Nombre'] : 'Nota ' . date('Y-m-d H:i:s'); ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label">Código:</label>
        <div class="controls">
          <textarea id="comentario" name="<?php echo $tabla; ?>[Contenido]" class="form-control" rows="5"><?php echo isset($data[$tabla]['Contenido']) ? $data[$tabla]['Contenido'] : ''; ?></textarea>
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

    </div>
  </div>
</div>
