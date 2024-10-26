<?php
$checked = $info['value'] == 1 ? 'checked' : '';
?>
<input type="hidden" id="hd_<?php echo $info['id']; ?>" name="<?php echo $info['name']; ?>" 
       value="<?php echo $info['value']; ?>" />
<input class="checkvert" type="checkbox" onchange="isChecked('<?php echo $info['id']; ?>')" id="<?php echo $info['id']; ?>" name="<?php echo $info['id']; ?>" 
       data-on="Si" data-off="No" data-toggle="toggle" data-width="80" 
       data-onstyle="success" data-offstyle="warning" value="1" 
       <?php echo $checked; ?>>
<script>
  $(document).ready(function () {
    $('#<?php echo $info['id']; ?>').bootstrapToggle();
  });
</script>