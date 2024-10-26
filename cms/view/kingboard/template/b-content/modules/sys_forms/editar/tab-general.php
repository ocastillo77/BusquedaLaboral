<?php $tabla = $data['tabla']; ?>
<div class="col-md-8">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="nombre">Nombre:</label>
        <div class="controls">
          <input type="text" class="form-control" id="nombre" name="<?php echo $tabla; ?>[Nombre]" value="<?php echo isset($data[$tabla]['Nombre']) ? $data[$tabla]['Nombre'] : ''; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="tabla">Tabla:</label>
        <div class="controls">
          <select id="tabla" name="<?php echo $tabla; ?>[Tabla]" data-rel="chosen">                							
            <option value="">- Seleccione -</option>            
            <?php
            if (isset($data['sel_tablas']) && count($data['sel_tablas']) > 0) :
              foreach ($data['sel_tablas'] as $item):
                $selected = $data[$tabla]['Tabla'] == $item['Nombre'] ? 'selected="selected"' : '';
                ?>								
                <option value="<?php echo $item['Nombre']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                <?php
              endforeach;
            endif;
            ?>
          </select>  
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
      <h3><i class="fa fa-cog"></i> Configuración</h3>
    </div>
    <div class="widget-content">      
      <div class="form-group">
        <label class="control-label">Activar Párrafos:</label>
        <div class="controls">
          <?php
          $checked = isset($data[$tabla]['ActivarTP']) && $data[$tabla]['ActivarTP'] == 1 ? 'checked' : '';
          ?>
          <input class="checkvert" type="checkbox" id="activartp" name="<?php echo $tabla; ?>[ActivarTP]" 
                 data-on="Si" data-off="No" data-toggle="toggle" data-width="80" 
                 data-onstyle="success" data-offstyle="warning" value="1" <?php echo $checked; ?>>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label">Activar Metatags:</label>
        <div class="controls">
          <?php
          $checked = isset($data[$tabla]['ActivarTM']) && $data[$tabla]['ActivarTM'] == 1 ? 'checked' : '';
          ?>
          <input class="checkvert" type="checkbox" id="activartm" name="<?php echo $tabla; ?>[ActivarTM]" 
                 data-on="Si" data-off="No" data-toggle="toggle" data-width="80" 
                 data-onstyle="success" data-offstyle="warning" value="1" <?php echo $checked; ?>>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label">Activar Galería:</label>
        <div class="controls">
          <?php
          $checked = isset($data[$tabla]['ActivarTG']) && $data[$tabla]['ActivarTG'] == 1 ? 'checked' : '';
          ?>
          <input class="checkvert" type="checkbox" id="activartg" name="<?php echo $tabla; ?>[ActivarTG]" 
                 data-on="Si" data-off="No" data-toggle="toggle" data-width="80" 
                 data-onstyle="success" data-offstyle="warning" value="1" <?php echo $checked; ?>>
        </div>
      </div>
    </div>
  </div>
</div>

