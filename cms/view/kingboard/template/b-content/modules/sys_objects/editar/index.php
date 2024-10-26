<form id="form" method="post" class="row">
  <input type="hidden" name="actualizar" value="1" />
  <?php include('tab-general.php'); ?>
  <div class="clear"></div>   
  <div class="col-md-12 text-right">
    <a onclick="validate(1);" class="btn btn-primary">Guardar</a>
    <a href="<?php echo URL_CMS . $data['base_url'] . 'listar'; ?>" class="btn btn-warning">Cancelar</a>
  </div>	
  <div class="clear"></div>	
</form>
<script>
  function validate(id) {
    $('#publico').val(id);
    $('#form').submit();
  }
</script>