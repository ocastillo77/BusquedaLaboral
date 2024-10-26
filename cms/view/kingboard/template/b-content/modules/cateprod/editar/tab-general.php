<?php
$tabla = $data['tabla'];
?>
<div class="row">
  <div class="col-md-8">
    <div class="widget">
      <div class="widget-header">
        <h3><i class="fa fa-info-circle"></i> Contenido</h3>
      </div>
      <div class="widget-content">
        <input type="hidden" name="<?php echo $tabla; ?>[Publico]" id="publico" value="<?php if (isset($data[$tabla]['Publico'])) echo $data[$tabla]['Publico']; ?>">
        <div class="form-group">
          <label class="control-label" for="nombre"><span class="obligatory">*</span> Nombre:</label>
          <div class="controls">
            <input type="text" class="form-control" id="nombre" name="<?php echo $tabla; ?>[Nombre]" value="<?php if (isset($data[$tabla]['Nombre'])) echo $data[$tabla]['Nombre']; ?>" />
            <p class="help-block"></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="meta-url"><span class="obligatory">*</span> Enlace Permanente:</label>
          <div class="controls">
            <input type="text" class="form-control" id="meta-url" name="<?php echo $tabla; ?>[URL]" value="<?php if (isset($data[$tabla]['URL'])) echo $data[$tabla]['URL']; ?>" />
            <p class="help-block">Su enlace se vera en: <?php echo URL_WEB . 'secciones/'; ?><strong id="friendly-url"><?php if (isset($data[$tabla]['URL'])) echo $data[$tabla]['URL']; ?></strong></p>
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
          <label class="control-label" for="posicion">Posición:</label>
          <div id="content-pos" class="controls">
            <?php include('mod-posicion.php'); ?>
          </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $('#select_fils').change(function () {
    var arString = new Array();
    $('#select_fils option:selected').each(function () {
      arString.push($(this).val());
    });
    $('#filiales').val(arString.join());
  });

  $(document).ready(function () {
    $('#nombre').keyup(function () {
      var value = $(this).val();
      $('#meta-url').val(str2url(value));
      updateFriendlyURL('meta-url', 'friendly-url');
    });

    $('#meta-url').keyup(function () {
      $(this).val(str2url($(this).val()));
      updateFriendlyURL('meta-url', 'friendly-url');
    });
  });
</script>