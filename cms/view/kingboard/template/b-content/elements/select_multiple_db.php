<div class="form-group">
  <label class="control-label"><?php echo $item['title']; ?></label>
  <div class="controls">
    <input type="hidden" id="<?php echo $item['id']; ?>" name="<?php echo $item['name']; ?>" />
    <?php if (isset($item['list'])) : ?>
      <select id="sel_<?php echo $item['id']; ?>" data-rel="chosen" multiple="multiple">
        <?php
        foreach ($item['list'] as $row) :
          $aRows = explode(',', $item['value']);
          $selected = (in_array($row[$item['key']], $aRows)) ? 'selected="selected"' : '';
          ?>
          <option value="<?php echo $row['ID']; ?>" <?php echo $selected; ?>>
            <?php echo $row[$item['option']]; ?>
          </option>
        <?php endforeach; ?>
      </select>
    <?php endif; ?>
  </div>
</div>
<script>
  $('#sel_<?php echo $item['id']; ?>').change(function () {
    var arString = new Array();
    arString.push(0);
    $('#sel_<?php echo $item['id']; ?> option:selected').each(function () {
      arString.push($(this).val());
    });
    $('#<?php echo $item['id']; ?>').val(arString.join());
  }).change();
</script>