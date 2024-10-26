<form id="form" method="post">
  <input type="hidden" name="actualizar" value="1" />
  <?php include('tab-general.php'); ?>
  <div class="top-actions">
    <a onclick="validate(1);" class="btn btn-primary">Guardar</a>
    <a href="<?php echo URL_CMS . $data['base_url'] . 'listar'; ?>" class="btn btn-warning">Cancelar</a>
  </div>	
  <div class="clear"></div>	
</form>
<script type="text/javascript">
<!--//
  function validate(id) {
    $('#publico').val(id);
    $('#form').submit();
  }
//-->
</script>
