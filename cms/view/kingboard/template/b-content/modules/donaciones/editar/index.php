<form id="form" method="post" class="row">
  <input type="hidden" name="actualizar" value="1" />
  <?php include('tab-general.php'); ?>
</form>
<script>
  function validate(id) {
    $('#publico').val(id);
    $('#form').submit();
  }
</script>