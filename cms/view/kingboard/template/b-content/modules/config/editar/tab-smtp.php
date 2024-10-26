<div class="col-md-6">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="smtp-server">Servidor:</label>
        <div class="controls">
          <input type="text" class="form-control" id="smtp-server" name="<?php echo $tabla; ?>[SMTPHost]" value="<?php echo (isset($data[$tabla]['SMTPHost'])) ? $data[$tabla]['SMTPHost'] : ''; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="smtp-port">Puerto:</label>
        <div class="controls">
          <input type="text" class="form-control" id="smtp-port" name="<?php echo $tabla; ?>[SMTPPort]" value="<?php echo (isset($data[$tabla]['SMTPPort'])) ? $data[$tabla]['SMTPPort'] : ''; ?>" />
          <p class="help-block"></p>
        </div>
      </div>          
    </div>
  </div>
</div>
<div class="col-md-6">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-cog"></i> Configuraci&oacute;n</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="smtp-email">Usuario:</label>
        <div class="controls">
          <input type="email" class="form-control" id="smtp-email" name="<?php echo $tabla; ?>[SMTPEmail]" value="<?php echo (isset($data[$tabla]['SMTPEmail'])) ? $data[$tabla]['SMTPEmail'] : ''; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="smtp-password">Contraseña:</label>
        <div class="controls">
          <input type="text" class="form-control" id="smtp-password" name="<?php echo $tabla; ?>[SMTPPassword]" value="<?php echo (isset($data[$tabla]['SMTPPassword'])) ? $data[$tabla]['SMTPPassword'] : ''; ?>" />
          <p class="help-block"></p>
        </div>
      </div>  
    </div>
  </div>
</div>
