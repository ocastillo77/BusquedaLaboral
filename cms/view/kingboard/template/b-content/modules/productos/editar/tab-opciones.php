<?php
$tabla = $data['tabla'];
?>
<div class="col-md-6">
  <div class="widget-content">
    <div class="form-group">
      <label class="control-label">% Descuento:</label>
      <div class="controls">
        <input type="text" class="form-control" name="<?php echo $tabla; ?>[Descuento]" value="<?php echo (isset($data[$tabla]['Descuento'])) ? $data[$tabla]['Descuento'] : ''; ?>" />
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Fecha Inicio Descuento:</label>
      <div class="controls">
        <input type="text" class="form-control datepicker" name="<?php echo $tabla; ?>[FechaIniD]"
               autocomplete="off" value="<?php echo (isset($data[$tabla]['FechaIniD'])) ? $data[$tabla]['FechaIniD'] : ''; ?>" />
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Fecha Final Descuento:</label>
      <div class="controls">
        <input type="text" class="form-control datepicker" name="<?php echo $tabla; ?>[FechaFinD]"
               autocomplete="off" value="<?php echo (isset($data[$tabla]['FechaFinD'])) ? $data[$tabla]['FechaFinD'] : ''; ?>" />
      </div>
    </div>
    <div class="cont-hint">
      <span class="obligatory">*</span>
      <p class="help-block">Los campos son obligatorios</p>
    </div>
  </div>
</div>
<div class="col-md-6">
  <div class="widget-content">
    <div class="form-group">
      <label class="control-label">Color:</label>
      <div class="controls">
        <input type="text" class="form-control" name="<?php echo $tabla; ?>[Color]" value="<?php echo isset($data[$tabla]['Color']) ? $data[$tabla]['Color'] : ''; ?>" />
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Material:</label>
      <div class="controls">
        <input type="text" class="form-control" name="<?php echo $tabla; ?>[Material]" value="<?php echo (isset($data[$tabla]['Material'])) ? $data[$tabla]['Material'] : ''; ?>" />
      </div>
    </div>
  </div>
</div>
<script>
  $('.datepicker').datepicker({
    dateFormat: 'yy-mm-dd'
  });

  $(document).ready(function () {
    $('.fancybox').fancybox();
    $('.fancybox-media').attr('rel', 'media-gallery').fancybox({
      openEffect: 'none',
      closeEffect: 'none',
      prevEffect: 'none',
      nextEffect: 'none',
      arrows: false
    });
  });

  function deleteImage(code) {
    delImage(code,
      "<?php echo CMS_IMG . 'no-foto-150x100.jpg'; ?>",
      "<?php echo URL_CMS . $data['base_url'] . 'delimage'; ?>");
  }

  var checkExt = new RegExp(/^(jpg|jpeg|JPEG|JPG|png)$/);
  uploadImage('imagen', checkExt,
    "<?php echo URL_CMS . $data['base_url'] . 'upload/'; ?>",
    "<?php echo URL_CMS . $data['base_url'] . 'jcrop'; ?>");

  setTimeout(function () {
    set_editor('descripcion');
  }, 1000);

  $('#nombre').keyup(function () {
    value = $(this).val();
    $('#meta-url').val(str2url(value));
    updateFriendlyURL('meta-url', 'friendly-url');
  });

  $('#meta-url').keyup(function () {
    $(this).val(str2url($(this).val()));
    updateFriendlyURL('meta-url', 'friendly-url');
  });
</script>