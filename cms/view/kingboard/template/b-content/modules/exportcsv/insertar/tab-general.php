<?php
$tabla = $data['tabla'];
?>
<div class="row">
  <div class="col-md-7">
    <div class="widget">
      <div class="widget-header">
        <h3><i class="fa fa-info-circle"></i> Contenido</h3>
      </div>
      <div class="widget-content">
        <div class="form-group">
          <label class="control-label" for="nombre"><span class="obligatory">*</span> Nombre:</label>
          <div class="controls">
            <input type="text" class="form-control" id="nombre" name="<?php echo $tabla; ?>[Nombre]" 
                   value="<?php echo isset($data[$tabla]['Nombre']) ? $data[$tabla]['Nombre'] : 'Lista de Productos CSV - ' . date('d/m/Y H:i'); ?>" />
            <p class="help-block"></p>
          </div>
        </div>    
        <div class="form-group">
          <label class="control-label">&iquest;Exportar todos los productos?</label>
          <div class="controls">
            <input onchange="changeFilter('filter');" class="checkvert" type="checkbox" 
                   id="filter" name="<?php echo $tabla; ?>[Todos]" 
                   data-on="Si" data-off="No" data-toggle="toggle" data-width="80" 
                   data-onstyle="success" data-offstyle="warning" value="1">
          </div>
        </div>
        <div id="box-date" class="form-group">
          <div class="row controls">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="fecha_ini">Fecha Inicio:</label>
                <div class="input-group">
                  <input type="text" class="form-control datepicker" id="fecha_ini" name="<?php echo $tabla; ?>[FechaIni]" 
                         value="<?php echo date('Y-m-d'); ?>">
                  <span onclick="$('#fecha_ini').focus();" class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>          
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="fecha_fin">Fecha Fin:</label>
                <div class="input-group">
                  <input type="text" class="form-control datepicker" id="fecha_fin" name="<?php echo $tabla; ?>[FechaFin]" 
                         value="<?php echo date('Y-m-d'); ?>" />
                  <span onclick="$('#fecha_fin').focus();" class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>
          </div> 
        </div>
        <div class="form-group">
          <label class="control-label" for="url">URL Archivo CSV:</label>
          <div class="controls">
            <div class="input-disabled">
              <?php echo URL_WEB . 'files/'; ?><span id="opt-filial"></span>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="widget">
      <div class="widget-header">
        <h3><i class="fa fa-cog"></i> Configuraci&oacute;n</h3>
      </div>
      <div class="widget-content">
        <div class="form-group">
          <label class="control-label" for="filial">Filial:</label>
          <div class="controls">
            <select onchange="changeFilial(this.value);" id="filial" name="<?php echo $tabla; ?>[FilialID]" data-rel="chosen">                							
              <?php
              if (isset($data['filiales'])) :
                foreach ($data['filiales'] as $item):
                  ?>								
                  <option value="<?php echo $item['ID']; ?>"><?php echo $item['Titulo']; ?></option>
                  <?php
                endforeach;
              endif;
              ?>
            </select>  
          </div>
        </div>  
        <div class="form-group">
          <label class="control-label" for="archivo">Nombre del Archivo:</label>
          <div class="controls">
            <input type="text" class="form-control disabled" id="archivo" name="<?php echo $tabla; ?>[Archivo]" 
                   value="<?php echo isset($data[$tabla]['Archivo']) ? $data[$tabla]['Archivo'] : 'productos.csv'; ?>" readonly="true">
            <p class="help-block"></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  var urlFilial = '<?php echo URL_CMS . $tabla . '/filial/'; ?>';

  function changeFilial(filialId) {
    $.ajax({
      url: urlFilial + filialId,
      success: function (data) {
        $('#opt-filial').html(data + '/' + $('#archivo').val());
      }
    });

  }

  function changeFilter(id) {
    if ($('#' + id).prop('checked')) {
      $('#box-date').hide();
    } else {
      $('#box-date').show();
    }
  }

  $('.datepicker').datepicker({
    dateFormat: 'yy-mm-dd',
    maxDate: new Date(),
    onSelect: function (dateText) {
      var fechaInicial = $('#fecha_ini').val();
      var fechaFinal = $('#fecha_fin').val();

      if (!compararFechas(fechaInicial, fechaFinal)) {
        alertMessage('danger', 'Por favor, seleccione una Fecha Final mayor o igual que la Fecha Inicial!');
        $('#fecha_fin').val(fechaInicial);
      }
    }
  });

  changeFilial(25);
</script>
