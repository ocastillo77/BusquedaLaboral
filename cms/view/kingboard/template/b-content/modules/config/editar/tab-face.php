<?php $tabla = $data['tabla']; ?>
<div class="col-md-8">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label"><span class="obligatory">*</span> ID de la Aplicación:</label>
        <div class="controls">
          <input type="text" class="form-control" id="fappid" name="<?php echo $tabla; ?>[FAppID]" value="<?php if (isset($data[$tabla]['FAppID'])) echo $data[$tabla]['FAppID']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label"><span class="obligatory">*</span> Contraseña de la Aplicación:</label>
        <div class="controls">
          <input type="text" class="form-control" id="fappsecret" name="<?php echo $tabla; ?>[FAppSecret]" value="<?php if (isset($data[$tabla]['FAppSecret'])) echo $data[$tabla]['FAppSecret']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label"><span class="obligatory">*</span> ID del Usuario:</label>
        <div class="controls">
          <input type="text" class="form-control" id="fuserid" name="<?php echo $tabla; ?>[FUserID]" value="<?php if (isset($data[$tabla]['FUserID'])) echo $data[$tabla]['FUserID']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label"><span class="obligatory">*</span> Token de Acceso:</label>
        <div class="controls">
          <input type="text" class="form-control" id="faccesstoken" name="<?php echo $tabla; ?>[FAccessToken]" value="<?php if (isset($data[$tabla]['FAccessToken'])) echo $data[$tabla]['FAccessToken']; ?>" />
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