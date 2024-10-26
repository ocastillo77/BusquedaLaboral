<div class="col-md-8">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="meta-titulo">Meta T&iacute;tulo:</label>
        <div class="controls">
          <input type="text" class="form-control" id="meta-titulo" name="<?php echo $tabla; ?>[Titulo]" value="<?php if (isset($data[$tabla]['Titulo'])) echo $data[$tabla]['Titulo']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="meta-descripcion">Meta Descripci&oacute;n:</label>
        <div class="controls">
          <textarea id="meta-descripcion" name="<?php echo $tabla; ?>[Descripcion]" class="form-control autogrow" rows="1"><?php if (isset($data[$tabla]['Descripcion'])) echo $data[$tabla]['Descripcion']; ?></textarea>
          <p class="help-block"></p>
        </div>
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
        <label class="control-label" for="robots">Robots:</label>
        <div class="controls">
          <select name="<?php echo $tabla; ?>[Robots]" id="robots" data-rel="chosen">
            <?php
            $aRobots = array('index, follow', 'index, nofollow', 'noindex, follow', 'noindex, nofollow');
            foreach ($aRobots as $robots) :
              $selected = (isset($data[$tabla]['Robots']) && $data[$tabla]['Robots'] == $robots) ? 'selected="selected"' : '';
              ?>
              <option value="<?php echo $robots; ?>" <?php echo $selected; ?>><?php echo $robots; ?></option>
            <?php endforeach; ?>
          </select>
          <p class="help-block"></p>
        </div>
      </div>
    </div>
  </div>
</div>
