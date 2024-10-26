<?php $tabla = $data['tabla']; ?>
<input type="hidden" name="<?php echo $tabla; ?>[Publico]" id="publico" value="<?php if (isset($data[$tabla]['Publico'])) echo $data[$tabla]['Publico']; ?>">
<div class="col-md-8">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="titulo"><span class="obligatory">*</span> T&iacute;tulo:</label>
        <div class="controls">
          <input type="text" class="form-control" id="titulo" name="<?php echo $tabla; ?>[Titulo]" value="<?php if (isset($data[$tabla]['Titulo'])) echo $data[$tabla]['Titulo']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="imagen">&Iacute;cono:</label>
        <div class="controls">
          <input type="text" class="form-control" id="imagen" name="<?php echo $tabla; ?>[Icono]" value="<?php if (isset($data[$tabla]['Icono'])) echo $data[$tabla]['Icono']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="detalle">Url:</label>
        <div class="controls">
          <input type="text" class="form-control" id="url" name="<?php echo $tabla; ?>[Url]" value="<?php if (isset($data[$tabla]['Url'])) echo $data[$tabla]['Url']; ?>" />
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
      <ul class="nav nav-tabs">
        <li class="active">
          <a href="#image" data-toggle="tab">Datos</a>
        </li>
        <li>
          <a href="#info">Ubicaci&oacute;n</a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade in active" id="image">
          <div class="form-group">
            <label class="control-label">Tabla:</label>
            <div class="controls">
              <?php if (isset($data['list_tables'])) : ?>            	
                <select id="tabla" name="<?php echo $tabla; ?>[Tabla]" data-rel="chosen">                							
                  <option value="">Ninguna</option>
                  <?php
                  foreach ($data['list_tables'] as $list_tab) :
                    $select = ($list_tab['Nombre'] == $data[$tabla]['Tabla']) ? 'selected' : '';
                    ?>
                    <option value="<?php echo $list_tab['Nombre']; ?>" <?php echo $select; ?>><?php echo $list_tab['Nombre']; ?></option>
                  <?php endforeach; ?>
                </select>
              <?php endif; ?>              
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Roles de Acceso:</label>
            <div class="controls">
              <input type="hidden" id="roles" name="<?php echo $tabla; ?>[RolID]" value="<?php echo isset($data[$tabla]['RolID']) ? $data[$tabla]['RolID'] : ''; ?>">
              <?php if (isset($data['roles'])) : ?>
                <select id="select_rol" data-rel="chosen" multiple="multiple">
                  <?php
                  foreach ($data['roles'] as $role) :
                    $aRoles = explode(',', $data[$tabla]['RolID']);
                    $selected = (in_array($role['ID'], $aRoles)) ? 'selected="selected"' : '';
                    ?>
                    <option value="<?php echo $role['ID']; ?>" <?php echo $selected; ?>><?php echo $role['Nombre']; ?></option>
                  <?php endforeach; ?>
                </select>
              <?php endif; ?>
            </div>
          </div>
        </div>    
        <div class="clear"></div>         
        <div class="tab-pane fade in" id="info">
          <div class="form-group">
            <label class="control-label">Secci&oacute;n Padre:</label>
            <div class="controls">
              <input type="hidden" id="parent_ant" value="<?php if (isset($data[$tabla]['PadreID'])) echo $data[$tabla]['PadreID']; ?>">              
              <select id="parent" name="<?php echo $tabla; ?>[PadreID]" data-rel="chosen">                							
                <option value="0">Carpeta Ra&iacute;z</option>
                <?php if (isset($data['selectsec'])) echo $data['selectsec']; ?>
              </select>
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
        <div class="clear"></div>   
      </div>
    </div>
  </div>
</div>
<?php
$param = (isset($data[$tabla]['ID'])) ? $data[$tabla]['ID'] . '/' : '';
$url_change = URL_CMS . $data['base_url'] . 'select/' . $param;
?>
<script>
  $('#select_rol').change(function () {
    var arString = new Array();
    arString.push(0);
    $('#select_rol option:selected').each(function () {
      arString.push($(this).val());
    });
    $('#roles').val(arString.join());
  });

  $(document).ready(function () {
    $('#parent').change(function () {
      var parent = $('#parent option:selected').val();
      var prev = $('#parent_ant').val();
      var formData = {parent: parent, prev: prev};

      $.ajax({
        url: "<?php echo $url_change; ?>",
        type: 'POST',
        data: formData,
        success: function (data) {
          $('#parent_ant').val(parent);
          $('#sortable').remove();
          $('#content-pos').html(data);
        }
      });
    });
  });
</script>