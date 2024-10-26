<?php
$tabla = $data['tabla'];
$width = (isset($data['categoria'])) ? $data['categoria']['Width'] : 0;
$height = (isset($data['categoria'])) ? $data['categoria']['Height'] : 0;
?>
<input type="hidden" name="<?php echo $tabla; ?>[Publico]" id="publico" value="<?php if (isset($data[$tabla]['Publico'])) echo $data[$tabla]['Publico']; ?>">
<div class="col-md-8">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="nombre"><span class="obligatory">*</span> T&iacute;tulo:</label>
        <div class="controls">
          <input type="text" class="form-control" id="nombre" name="<?php echo $tabla; ?>[Nombre]" value="<?php if (isset($data[$tabla]['Nombre'])) echo $data[$tabla]['Nombre']; ?>" />
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
        <label class="control-label" for="ancho">Ancho:</label>
        <div class="controls">
          <input type="text" class="form-control" id="ancho" name="<?php echo $tabla; ?>[Width]" value="<?php if (isset($data[$tabla]['Width'])) echo $data[$tabla]['Width']; ?>" />
          <p class="help-block">Ancho en pixeles</p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="alto">Alto:</label>
        <div class="controls">
          <input type="text" class="form-control" id="alto" name="<?php echo $tabla; ?>[Height]" value="<?php if (isset($data[$tabla]['Height'])) echo $data[$tabla]['Height']; ?>" />
          <p class="help-block">Alto en pixeles</p>
        </div>
      </div>
    </div>
  </div>
</div>
