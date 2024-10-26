<form id="form" method="post" class="row">
  <input type="hidden" name="actualizar" value="1" />
  <?php include('tab-general.php'); ?>
</form>
<!-- END TABS NAVS -->
<script>
  function validate(id) {
    $('#publico').val(id);
    $('#form').submit();
  }
</script>