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
        <label class="control-label" for="url"><span class="obligatory">*</span> Enlace Externo:</label>
        <div class="controls">
          <input type="text" class="form-control" id="url" name="<?php echo $tabla; ?>[URL]" value="<?php if (isset($data[$tabla]['URL'])) echo $data[$tabla]['URL']; ?>" />
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
        <label class="control-label" for="icono">&Iacute;cono:</label>
        <div class="controls">
          <input type="text" class="form-control" id="icono" name="<?php echo $tabla; ?>[Icono]" value="<?php if (isset($data[$tabla]['Icono'])) echo $data[$tabla]['Icono']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>		
    </div>
  </div>
</div>
