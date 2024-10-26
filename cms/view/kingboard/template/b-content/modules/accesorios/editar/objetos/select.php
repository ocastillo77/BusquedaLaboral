<?php ?>
<select id="<?php echo $info['id']; ?>" name="<?php echo $info['name']; ?>" data-rel="chosen">                							       
  <?php
  if (isset($info['datainfo']) && count($info['datainfo']) > 0) :
    foreach ($info['datainfo'] as $key => $value):
      $selected = $info['value'] == $key ? 'selected="selected"' : '';
      ?>								
      <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
      <?php
    endforeach;
  endif;
  ?>
</select>  
<script>
  $(document).ready(function () {
    $('#<?php echo $info['id']; ?>').chosen({width: '100%'});
  });
</script>