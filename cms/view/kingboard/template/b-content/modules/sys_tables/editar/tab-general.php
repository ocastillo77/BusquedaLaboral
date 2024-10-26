<?php $tabla = $data['tabla']; ?>
<div class="col-md-6">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="nombre"><span class="obligatory">*</span> Nombre de la Tabla:</label>
        <div class="controls">
          <select id="nombre" name="<?php echo $tabla; ?>[Nombre]" data-rel="chosen">                							
            <option value="">- seleccione -</option>
            <?php
            if (isset($data['list_tables'])) :
              foreach ($data['list_tables'] as $item) :
                $table_name = Helper::formatTable($item['Tabla']);
                $select = $table_name == $data[$tabla]['Nombre'] ? 'selected' : '';

                if (!in_array($table_name, $data['tables_add'])) :
                  ?>
                  <option value="<?php echo $table_name; ?>" <?php echo $select; ?>><?php echo $table_name; ?></option>
                  <?php
                endif;
              endforeach;
            endif;
            ?>  
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="titulo">T&iacute;tulo de la Tabla:</label>
        <div class="controls">
          <input type="text" class="form-control" id="titulo" name="<?php echo $tabla; ?>[Titulo]" value="<?php if (isset($data[$tabla]['Titulo'])) echo $data[$tabla]['Titulo']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label">Activar FileManager:</label>
        <div class="controls">
          <?php
          $checked = isset($data[$tabla]['UseFileM']) && $data[$tabla]['UseFileM'] == 1 ? 'checked' : '';
          ?>
          <input class="checkvert" type="checkbox" id="destacado" name="<?php echo $tabla; ?>[UseFileM]" 
                 data-on="Si" data-off="No" data-toggle="toggle" data-width="80" 
                 data-onstyle="success" data-offstyle="warning" value="1" <?php echo $checked; ?>>
        </div>
      </div>
      <div class="cont-hint">
        <span class="obligatory">*</span>
        <p class="help-block">Los campos son obligatorios</p>
      </div>
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-cog"></i> Imagen Principal</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label label-custom">Imagen Pequeña:</label>
        <div class="controls row">
          <div class="col-md-6">
            <label class="control-label">Ancho</label>
            <input type="text" class="form-control" id="ptancho" name="<?php echo $tabla; ?>[PTAncho]" value="<?php echo isset($data[$tabla]['PTAncho']) ? $data[$tabla]['PTAncho'] : '200'; ?>" />            
          </div>
          <div class="col-md-6">
            <label class="control-label">Alto</label>
            <input type="text" class="form-control" id="ptalto" name="<?php echo $tabla; ?>[PTAlto]" value="<?php echo isset($data[$tabla]['PTAlto']) ? $data[$tabla]['PTAlto'] : '100'; ?>" />            
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label label-custom">Imagen Grande:</label>
        <div class="controls row">
          <div class="col-md-6">
            <label class="control-label">Ancho</label>
            <input type="text" class="form-control" id="piancho" name="<?php echo $tabla; ?>[PIAncho]" value="<?php echo isset($data[$tabla]['PIAncho']) ? $data[$tabla]['PIAncho'] : '600'; ?>" />            
          </div>
          <div class="col-md-6">
            <label class="control-label">Alto</label>
            <input type="text" class="form-control" id="pialto" name="<?php echo $tabla; ?>[PIAlto]" value="<?php echo isset($data[$tabla]['PIAlto']) ? $data[$tabla]['PIAlto'] : '300'; ?>" />            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-cog"></i> Imagen Galería</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label label-custom">Imagen Pequeña:</label>
        <div class="controls row">
          <div class="col-md-6">
            <label class="control-label">Ancho</label>
            <input type="text" class="form-control" id="ptancho" name="<?php echo $tabla; ?>[GTAncho]" value="<?php echo isset($data[$tabla]['GTAncho']) ? $data[$tabla]['GTAncho'] : '200'; ?>" />            
          </div>
          <div class="col-md-6">
            <label class="control-label">Alto</label>
            <input type="text" class="form-control" id="ptalto" name="<?php echo $tabla; ?>[GTAlto]" value="<?php echo isset($data[$tabla]['GTAlto']) ? $data[$tabla]['GTAlto'] : '100'; ?>" />            
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label label-custom">Imagen Grande:</label>
        <div class="controls row">
          <div class="col-md-6">
            <label class="control-label">Ancho</label>
            <input type="text" class="form-control" id="piancho" name="<?php echo $tabla; ?>[GIAncho]" value="<?php echo isset($data[$tabla]['GIAncho']) ? $data[$tabla]['GIAncho'] : '800'; ?>" />            
          </div>
          <div class="col-md-6">
            <label class="control-label">Alto</label>
            <input type="text" class="form-control" id="pialto" name="<?php echo $tabla; ?>[GIAlto]" value="<?php echo isset($data[$tabla]['GIAlto']) ? $data[$tabla]['GIAlto'] : '600'; ?>" />            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

