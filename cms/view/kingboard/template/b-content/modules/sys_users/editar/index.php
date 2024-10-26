<div class="top-actions">
  <a onclick="validate(1);" class="btn btn-primary">Guardar</a>
  <a href="<?php echo URL_CMS . $data['base_url'] . 'listar'; ?>" class="btn btn-warning">Cancelar</a>
</div>	
<div class="clear"></div>	
<form id="form" method="post" class="row">
  <input type="hidden" name="actualizar" value="1" />
  <?php include('tab-general.php'); ?>	
</form>
<div class="top-actions">
  <a onclick="validate(1);" class="btn btn-primary">Guardar</a>
  <a href="<?php echo URL_CMS . $data['base_url'] . 'listar'; ?>" class="btn btn-warning">Cancelar</a>
</div>	
<div class="clear"></div>	
<script>
  function validate(id) {
    $('#publico').val(id);
    $('#form').submit();
  }
</script>