<?php $tabla = $data['tabla']; ?>
<div class="col-md-8">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="titulo">Título:</label>
        <div class="controls">
          <input type="text" class="form-control" id="titulo" name="<?php echo $tabla; ?>[Titulo]" value="<?php echo isset($data[$tabla]['Titulo']) ? $data[$tabla]['Titulo'] : ''; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="nombre">Nombre:</label>
        <div class="controls">
          <input type="text" class="form-control" id="nombre" name="<?php echo $tabla; ?>[Nombre]" value="<?php echo isset($data[$tabla]['Nombre']) ? $data[$tabla]['Nombre'] : ''; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="descripcion">Descripción:</label>
        <div class="controls">
          <textarea id="descripcion" name="<?php echo $tabla; ?>[Descripcion]" class="form-control" rows="2"><?php echo isset($data[$tabla]['Descripcion']) ? $data[$tabla]['Descripcion'] : ''; ?></textarea>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="tabla">Tabla:</label>
        <div class="controls">
          <input type="text" class="form-control" id="tabla" name="<?php echo $tabla; ?>[Tabla]" value="<?php echo isset($data[$tabla]['Tabla']) ? $data[$tabla]['Tabla'] : ''; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="whereis">Where:</label>
        <div class="controls">
          <input type="text" class="form-control" id="whereis" name="<?php echo $tabla; ?>[WhereIs]" value="<?php echo isset($data[$tabla]['WhereIs']) ? $data[$tabla]['WhereIs'] : ''; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="orderby">Order By:</label>
        <div class="controls">
          <input type="text" class="form-control" id="orderby" name="<?php echo $tabla; ?>[OrderBy]" value="<?php echo isset($data[$tabla]['OrderBy']) ? $data[$tabla]['OrderBy'] : ''; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="clave">Clave:</label>
        <div class="controls">
          <input type="text" class="form-control" id="clave" name="<?php echo $tabla; ?>[Clave]" value="<?php echo isset($data[$tabla]['Clave']) ? $data[$tabla]['Clave'] : ''; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="opcion">Opción:</label>
        <div class="controls">
          <input type="text" class="form-control" id="opcion" name="<?php echo $tabla; ?>[Opcion]" value="<?php echo isset($data[$tabla]['Opcion']) ? $data[$tabla]['Opcion'] : ''; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="onchange">OnChange:</label>
        <div class="controls">
          <input type="text" class="form-control" id="onchange" name="<?php echo $tabla; ?>[OnChange]" value="<?php echo isset($data[$tabla]['OnChange']) ? $data[$tabla]['OnChange'] : ''; ?>" />
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
      <h3><i class="fa fa-cog"></i> Configuración</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="formulario">Formulario:</label>
        <div class="controls">
          <select id="formulario" name="<?php echo $tabla; ?>[FormularioID]" data-rel="chosen">                							
            <option value="">- Seleccione -</option>            
            <?php
            if (isset($data['formularios']) && count($data['formularios']) > 0) :
              foreach ($data['formularios'] as $item):
                $selected = $data[$tabla]['FormularioID'] == $item['ID'] ? 'selected="selected"' : '';
                ?>								
                <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                <?php
              endforeach;
            endif;
            ?>
          </select>  
        </div>
      </div>  
      <div class="form-group">
        <label class="control-label" for="tipo">Tipo:</label>
        <div class="controls">
          <select id="tipo" name="<?php echo $tabla; ?>[TipoID]" data-rel="chosen">                							
            <option value="">- Seleccione -</option>            
            <?php
            if (isset($data['tipos']) && count($data['tipos']) > 0) :
              foreach ($data['tipos'] as $item):
                $selected = $data[$tabla]['TipoID'] == $item['ID'] ? 'selected="selected"' : '';
                ?>								
                <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                <?php
              endforeach;
            endif;
            ?>
          </select>  
        </div>
      </div>  
      <div class="form-group">
        <label class="control-label" for="pestania">Pestaña:</label>
        <div class="controls">
          <select id="pestania" name="<?php echo $tabla; ?>[TabID]" data-rel="chosen">                							
            <option value="">- Seleccione -</option>            
            <?php
            if (isset($data['pestanias']) && count($data['pestanias']) > 0) :
              foreach ($data['pestanias'] as $item):
                $selected = $data[$tabla]['TabID'] == $item['ID'] ? 'selected="selected"' : '';
                ?>								
                <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Titulo']; ?></option>
                <?php
              endforeach;
            endif;
            ?>
          </select>  
        </div>
      </div> 
      <div class="form-group">
        <label class="control-label" for="columna">Columna:</label>
        <div class="controls">
          <select id="columna" name="<?php echo $tabla; ?>[Columna]" data-rel="chosen">                							    
            <?php
            $columns = ['left' => 'Izquierda', 'right' => 'Derecha'];
            foreach ($columns as $key => $value):
              $selected = $data[$tabla]['Columna'] == $key ? 'selected="selected"' : '';
              ?>								
              <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
              <?php
            endforeach;
            ?>
          </select>  
        </div>
      </div>  
      <div class="form-group">
        <label class="control-label" for="filas">Filas:</label>
        <div class="controls">
          <input type="text" class="form-control" id="filas" name="<?php echo $tabla; ?>[Filas]" value="<?php echo isset($data[$tabla]['Filas']) ? $data[$tabla]['Filas'] : ''; ?>" />
          <p class="help-block"></p>
        </div>
      </div>      
      <div class="form-group">
        <label class="control-label">Obligatorio:</label>
        <div class="controls">
          <?php
          $checked = isset($data[$tabla]['Obligatorio']) && $data[$tabla]['Obligatorio'] == 1 ? 'checked' : '';
          ?>
          <input class="checkvert" type="checkbox" id="obligatorio" name="<?php echo $tabla; ?>[Obligatorio]" 
                 data-on="Si" data-off="No" data-toggle="toggle" data-width="80" 
                 data-onstyle="success" data-offstyle="warning" value="1" <?php echo $checked; ?>>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="posicion">Posici&oacute;n:</label>
        <div id="content-pos" class="controls">
          <?php include('mod-posicion.php'); ?>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>
</div>

