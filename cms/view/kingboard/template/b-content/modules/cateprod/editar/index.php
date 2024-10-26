<form id="form" method="post">
  <input type="hidden" name="actualizar" value="1">
  <?php include('tab-general.php'); ?>
  <div class="clear"></div>  
</form>
<script>
  function validate(id) {
    $('#publico').val(id);
    $('#form').submit();
  }
</script>