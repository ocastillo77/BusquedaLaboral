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
            <button onclick="check_email('<?php echo URL_CMS . $tabla . '/check_email'; ?>');" class="btn btn-default" type="button">Verificar</button>
          </span>
        </div>
        <p class="help-block"></p>
      </div>
      <div class="form-group">
        <label class="control-label" for="usuario">Usuario:</label>
        <div class="input-group searchbox">
          <input type="text" class="form-control" id="usuario" name="<?php echo $tabla; ?>[Usuario]" value="<?php if (isset($data[$tabla]['Usuario'])) echo $data[$tabla]['Usuario']; ?>" />
          <span class="input-group-btn">
            <button onclick="check_user('<?php echo URL_CMS . $tabla . '/check_user'; ?>');" class="btn btn-default" type="button">Verificar</button>
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
        <label class="control-label">Acceso:</label>
        <div class="controls">
          <?php if (isset($data['roles'])) : ?>
            <select id="roles" name="<?php echo $tabla; ?>[RolID]" data-rel="chosen">
              <?php
              foreach ($data['roles'] as $role) :
                $selected = ($role['ID'] == $data[$tabla]['RolID']) ? 'selected' : '';
                ?>
                <option value="<?php echo $role['ID']; ?>" <?php echo $selected; ?>><?php echo $role['Nombre']; ?></option>
              <?php endforeach; ?>
            </select>
          <?php endif; ?>
        </div>
      </div>
      <div class="form-group">
        <?php
        if (isset($data[$tabla]['TimeCreate'])) :
          $date = new DateTime($data[$tabla]['TimeCreate']);
          $fecha_creacion = $date->format('d/m/Y H:i:s');
          ?>
          <label class="control-label">Usuario creado el:</label>
          <span><?php echo $fecha_creacion; ?></span>
          <?php
        endif;
        ?>
        <?php
        if (isset($data[$tabla]['TimeUpdate'])) :
          $date = new DateTime($data[$tabla]['TimeUpdate']);
          $ultima_vez = $date->format('d/m/Y - H:i:s');
          ?>
          <label class="control-label">Accedi&oacute; por &uacute;ltima vez el:</label>        
          <span><?php echo $ultima_vez; ?></span>
        <?php endif; ?>
      </div>
    </div>
  </div>

