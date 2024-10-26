<?php $tabla = $data['tabla']; ?>
<div class="row">
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
                   value="<?php echo isset($data[$tabla]['Nombre']) ? $data[$tabla]['Nombre'] : ''; ?>" />
            <p class="help-block"></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label">Descarga Archivo CSV: 
            <?php
            $url_descarga = !empty($data[$tabla]['Archivo']) ?
              URL_GAL . $tabla . '/files/' . $data[$tabla]['Archivo'] : '#';
            ?>
            <a class="link-csv" href="<?php echo $url_descarga; ?>" target="_blank"><?php echo $data[$tabla]['Archivo']; ?></a>
          </label>
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
</div>

