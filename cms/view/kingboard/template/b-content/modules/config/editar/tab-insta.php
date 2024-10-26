<?php $tabla = $data['tabla']; ?>
<div class="col-md-8">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label"><span class="obligatory">*</span> Usuario o Correo Electrónico:</label>
        <div class="controls">
          <input type="text" class="form-control" id="iuser" name="<?php echo $tabla; ?>[IUser]" value="<?php if (isset($data[$tabla]['IUser'])) echo $data[$tabla]['IUser']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label"><span class="obligatory">*</span> Contraseña:</label>
        <div class="controls">
          <input type="text" class="form-control" id="ipass" name="<?php echo $tabla; ?>[IPass]" value="<?php if (isset($data[$tabla]['IPass'])) echo $data[$tabla]['IPass']; ?>" />
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